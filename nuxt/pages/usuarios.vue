<script setup lang="ts">
    import useUsuario from '~/composables/mantenimiento/useUsuario';
    import useSucursal from '~/composables/mantenimiento/useSucursal';
    import useRol from '~/composables/mantenimiento/useRol';

    useHead({
        title: 'Usuarios',
    })
    definePageMeta({
        layout: 'app',
        middleware: ['acceso']
    })

    const {handleSuccess} = useSuccessHandler();
    const {createUsuario, getUsuarios, updateUsuario, updateUsuarioState} = useUsuario();
    const { getSucursales } = useSucursal();
    const { getRoles } = useRol();

    const rows:any = ref([]);
    const loading = ref(false);
    const visible = ref(false); // define si se muestra el modal o no
    const per_page = ref(10);
    const totalRecords = ref(0);
    const term = ref('');
    const estado = ref(-1);
    const estados = ref([
        {id: -1, nombre: 'Activo/Inactivo'},
        {id: 1, nombre: 'Activo'},
        {id: 0, nombre: 'Inactivo'},
    ]);
    const sucursales = ref([]);
    const roles = ref([]);
    const form:any = ref({});
    const errors:any = ref({});

    const clearForm = () => {
        form.value = {
            id: 0,
            dni: '',
            nombres: '',
            apellidos: '',
            email: '',
            telefono: '',
            rol_id: 0,
            sucursal_id: 0,
        };
    };

    const onPage = (event:any) => {
        loadRows(event.page + 1);
    };

    const loadRows = async (page:number=1) => {
        !loading.value && (loading.value = true);
        try {
            const data:any = await getUsuarios({
                'filters[term]': term.value,
                'filters[estado]': estado.value,
                'fields[0]':'id',
                'fields[1]':'nombres',
                'fields[2]':'apellidos',
                'fields[3]':'email',
                'fields[4]':'telefono',
                'fields[5]':'dni',
                'fields[6]':'estado',
                'fields[7]':'rol_id',
                'fields[8]':'sucursal_id',
                'withs[0]':'rol:id,nombre',
                'withs[1]':'sucursal:id,nombre',
                page,
                per_page: per_page.value
            });
            rows.value = data.data.map((item: any) => {
                item.estado = item.estado === 1;
                return item;
            });
            totalRecords.value = data.total;
            loading.value = false;
        } catch (error) {
            console.log(error);
        }
    };

    const save = async () => {
        try {
            if(form.value.id > 0)
                await updateUsuario(form.value.id, form.value);
            else
                await createUsuario(form.value);

            handleSuccess('Datos guardados correctamente');
            hideModal();
            loadRows();
        } catch (error:any) {
            if(error?.response?.status === 422)
                errors.value = error.response._data.errors;
        }
    };

    const updateState = async (id:number) => {
        updateUsuarioState(id).then(() => {
            handleSuccess('Estado actualizado correctamente');
            loadRows();
        });
    }

    const hideModal = () => {
        visible.value = false;
    };

    const openFormModal = (data:any = null) => {
        clearForm();
        if(data) {
            form.value = {
                id: data.id,
                dni: data.dni,
                nombres: data.nombres,
                apellidos: data.apellidos,
                email: data.email,
                telefono: data.telefono,
                rol_id: data.rol_id,
                sucursal_id: data.sucursal_id,
            };
        }
        visible.value = true;
    };

    onMounted(() => {
        loadRows();

        getSucursales({
            'fields':'id,nombre',
            'filters[estado]': 1
        }).then((data:any) => {
            sucursales.value = data;
        });

        getRoles({
            'fields[0]':'id',
            'fields[1]':'nombre',
            'filters[estado]': 1
        }).then((data:any) => {
            roles.value = data;
        });
    });
</script>
<template>
    <div>
        <div class="font-semibold text-2xl mb-4">Usuarios</div>

        <Toolbar class="mb-6">
            <template #start>
                <InputGroup class="me-2">
                    <InputText type="text" placeholder="Buscar por nombre" v-model="term" class="w-[300px]" />                    
                    <Button icon="pi pi-search" severity="primary" @click.prevent="loadRows(1)"/>
                </InputGroup>
                <Select v-model="estado" :options="estados" optionLabel="nombre" optionValue="id" class="w-full md:w-56" @change="loadRows(1)"/>
            </template>

            <template #end>
                <Button label="Nuevo" icon="pi pi-plus" severity="primary" class="mr-2" @click="openFormModal(null)"></Button>
            </template>
        </Toolbar>

        <DataTable
            :value="rows"
            stripedRows
            paginator
            :rows="per_page"
            :totalRecords="totalRecords"
            :loading="loading"
            :lazy="true"
            @page="onPage"
            >
            <template #loading>
                <div class="text-center text-[24px]"><i class="ri-loader-line ri-spin"></i> Cargando</div>
            </template>
            <template #empty><div class="text-center"><i class="ri-information-line"></i> <span>Sin registros</span></div></template>
            <Column field="dni" header="DNI"></Column>
            <Column field="rol.nombre" header="Rol"></Column>
            <Column field="sucursal.nombre" header="Nombre"></Column>
            <Column field="nombres" header="Nombres"></Column>
            <Column field="apellidos" header="Apellidos"></Column>
            <Column field="email" header="Email"></Column>
            <Column field="telefono" header="Teléfono"></Column>
            <Column>
                <template #header>
                    <div class="text-center w-full">Estado</div>
                </template>
                <template #body="slotProps">
                    <div class="text-center">
                        <ToggleSwitch v-model="slotProps.data.estado" @change="updateState(slotProps.data.id)"/>
                    </div>
                </template>
            </Column>
            <Column>
                <template #header>
                    <div class="text-center w-full">Acciones</div>
                </template>
                <template #body="slotProps">
                    <div class="text-center w-full">
                        <Button icon="pi pi-pencil" class="p-button-rounded p-button-success p-mr-2" @click.prevent="openFormModal(slotProps.data)"></Button>
                    </div>
                </template>
            </Column>
        </DataTable>

        <Dialog
            header="Usuario"
            v-model:visible="visible"
            modal
            class="w-[350px] md:w-[500px] lg:w-[700px]"
        >
            <template #footer>
                <div class="w-full flex justify-between">
                    <Button label="Cancelar" icon="pi pi-times" plain text @click="hideModal" />
                    <Button label="Guardar" icon="pi pi-check" severity="primary" text @click="save" />
                </div>
            </template>

            <form @submit.prevent="save">
                <div class="grid lg:grid-cols-3 gap-x-4">
                    <div class="mb-3">
                        <label>Documento de Identidad</label>
                        <InputText maxlength="8" class="w-full" placeholder="Ingresa el DNI" v-model="form.dni" :disabled="form?.id>0" />
                        <small class="text-red-500" v-if="errors?.dni">{{ errors.dni[0] }}</small>
                    </div>
                    <div class="mb-3">
                        <label>Nombres</label>
                        <InputText class="w-full" placeholder="Escribe los nombres" v-model="form.nombres" />
                        <small class="text-red-500" v-if="errors?.nombres">{{ errors.nombres[0] }}</small>
                    </div>
                    <div class="mb-3">
                        <label>Apellidos</label>
                        <InputText class="w-full" placeholder="Escribe los apellidos" v-model="form.apellidos" />
                        <small class="text-red-500" v-if="errors?.apellidos">{{ errors.apellidos[0] }}</small>
                    </div>
                </div>
                <div class="grid lg:grid-cols-4 gap-x-4">
                    <div class="mb-3">
                        <label>E-mail</label>
                        <InputText type="email" class="w-full" placeholder="Escribe el email" v-model="form.email" />
                        <small class="text-red-500" v-if="errors?.email">{{ errors.email[0] }}</small>
                    </div>
                    <div class="mb-3">
                        <label>Teléfono</label> 
                        <InputText type="phone" class="w-full" placeholder="Escribe el teléfono" v-model="form.telefono" />
                        <small class="text-red-500" v-if="errors?.telefono">{{ errors.telefono[0] }}</small>
                    </div>
                    <div class="mb-3">
                        <label>Sucursal</label>
                        <Select class="w-full" v-model="form.sucursal_id" :options="sucursales" optionLabel="nombre" optionValue="id" placeholder="Seleccione"/> 
                        <small class="text-red-500" v-if="errors?.sucursal_id">{{ errors.sucursal_id[0] }}</small>
                    </div>
                    <div class="mb-3">
                        <label>Rol</label> 
                        <Select class="w-full" v-model="form.rol_id" :options="roles" optionLabel="nombre" optionValue="id" placeholder="Seleccione"/>
                        <small class="text-red-500" v-if="errors?.rol_id">{{ errors.rol_id[0] }}</small>
                    </div>
                </div>
            </form>
        </Dialog>
    </div>
</template>
