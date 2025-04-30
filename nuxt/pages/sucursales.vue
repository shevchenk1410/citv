<script setup lang="ts">
    import useSucursal from '~/composables/mantenimiento/useSucursal';

    useHead({
        title: 'Sucursales',
    })
    definePageMeta({
        layout: 'app',
        middleware: ['acceso']
    })

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
    const form = ref({
        id: 0,
        codigo_local: '',
        nombre: '',
        direccion: '',
        email: '',
        telefono: '',
    });

    const {handleSuccess} = useSuccessHandler();
    const {createSucursal, getSucursales, updateSucursal, updateSucursalState} = useSucursal();

    const onPage = (event:any) => {
        loadRows(event.page + 1);
    };

    const loadRows = async (page:number=1) => {
        !loading.value && (loading.value = true);
        try {
            const data:any = await getSucursales({
                'filters[term]': term.value,
                'filters[estado]': estado.value,
                'fields':'id,codigo_local,nombre,direccion,telefono,email,estado',
                page,
                per_page: per_page.value
            });
            rows.value = data.map((item: any) => {
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
                await updateSucursal(form.value.id, form.value);
            else
                await createSucursal(form.value);

            handleSuccess('Datos guardados correctamente');
            hideModal();
            loadRows();
        } catch (error) {
            console.log(error);
        }
    };

    const updateState = async (id:number) => {
        updateSucursalState(id).then(() => {
            handleSuccess('Estado actualizado correctamente');
            loadRows();
        });
    }

    const hideModal = () => {
        visible.value = false;
    };

    const openFormModal = (data:any = null) => {
        if(data) {
            form.value = {
                id: data.id,
                codigo_local: data.codigo_local,
                nombre: data.nombre,
                direccion: data.direccion,
                telefono: data.telefono,
                email: data.email,
            };
        } else {
            form.value = {
                id: 0,
                codigo_local: '',
                nombre: '',
                direccion: '',
                telefono: '',
                email: '',
            };
        }

        visible.value = true;
    };

    onMounted(() => {
        loadRows();
    });
</script>
<template>
    <div>
        <div class="font-semibold text-2xl mb-4">Sucursales</div>

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
            :lazy="true"
            :loading="loading"
            @page="onPage"
            >
            <template #loading>
                <div class="text-center text-[24px]"><i class="ri-loader-line ri-spin"></i> Cargando</div>
            </template>
            <template #empty><div class="text-center"><i class="ri-information-line"></i> <span>Sin registros</span></div></template>
            <Column field="codigo_local" header="Cod. Local"></Column>
            <Column field="nombre" header="Nombre"></Column>
            <Column field="direccion" header="Dirección"></Column>
            <Column field="telefono" header="Teléfono"></Column>
            <Column field="email" header="E-mail"></Column>
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
            header="Cliente"
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
                <div class="p-fluid">
                    <div class="flex flex-col gap-2 mb-3">
                        <label for="tipo_documento_id">Código de local</label>
                        <InputText id="nombres" v-model="form.codigo_local" />
                    </div>
                    <div class="flex flex-col gap-2 mb-3">
                        <label for="nombres">Nombre</label>
                        <InputText id="nombres" v-model="form.nombre" />
                    </div>
                    <div class="flex flex-col gap-2 mb-3">
                        <label for="nombres">Dirección</label>
                        <InputText id="nombres" v-model="form.direccion" />
                    </div>
                    <div class="flex flex-col gap-2 mb-3">
                        <label for="email">Email</label>
                        <InputText type="email" id="email" v-model="form.email" />
                    </div>
                    <div class="flex flex-col gap-2 mb-3">
                        <label for="telefono">Teléfono</label>
                        <InputText id="telefono" v-model="form.telefono" />
                    </div>
                </div>
            </form>
        </Dialog>
    </div>
</template>
