<script setup lang="ts">
    import useCliente from '~/composables/mantenimiento/useCliente';

    useHead({
        title: 'Clientes',
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
    const tipos_documentos = ref([
        {'id':1, 'nombre':'DNI'},
        {'id':4, 'nombre':'C.E.'},
        {'id':6, 'nombre':'RUC'},
        {'id':7, 'nombre':'Pasaporte'},
    ])
    const form = ref({
        id: 0,
        tipo_documento_id: 1,
        numero_documento: '',
        nombres: '',
        apellidos: '',
        email: '',
        telefono: '',
    });

    const {handleSuccess} = useSuccessHandler();
    const {createCliente, getClientes, updateCliente, updateClienteState} = useCliente();

    const onPage = (event:any) => {
        loadRows(event.page + 1);
    };

    const loadRows = (page:number=1) => {
        if(loading.value) return;
        loading.value = true;
        getClientes({
            'filters[term]': term.value,
            'filters[estado]': estado.value,
            'fields':'id,tipo_documento_id,numero_documento,nombres,apellidos,email,telefono,estado',
            'withs[]': 'tipo_documento:id,nombre',
            page,
            per_page: per_page.value
        }).then((data:any)=>{
            rows.value = data.data.map((item: any) => {
                item.estado = item.estado === 1;
                return item;
            });
            totalRecords.value = data.total;
        }).finally(()=>{
            loading.value = false;
        });
    };

    const save = async () => {
        try {
            if(form.value.id > 0)
                await updateCliente(form.value.id, form.value);
            else
                await createCliente(form.value);

            handleSuccess('Datos guardados correctamente');
            hideModal();
            loadRows();
        } catch (error) {
            console.log(error);
        }
    };

    const updateState = async (id:number) => {
        updateClienteState(id).then(() => {
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
                tipo_documento_id: data.tipo_documento_id,
                numero_documento: data.numero_documento,
                nombres: data.nombres,
                apellidos: data.apellidos,
                email: data.email,
                telefono: data.telefono,
            };
        } else {
            form.value = {
                id: 0,
                tipo_documento_id: 1,
                numero_documento: '',
                nombres: '',
                apellidos: '',
                email: '',
                telefono: '',
            };
        }

        visible.value = true;
    };

    onBeforeMount(() => {
        loadRows();
    });
</script>
<template>
    <div>
        <div class="font-semibold text-2xl mb-4">Clientes</div>

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
            </template>>
            <template #empty><div class="text-center"><i class="ri-information-line"></i> <span>Sin registros</span></div></template>
            <Column>
                <template #header>
                    <div class="text-center w-full">ID</div>
                </template>
                <template #body="slotProps">
                    <div class="text-center">{{slotProps.data.id}}</div>
                </template>
            </Column>
            <Column>
                <template #header>
                    <div class="text-center w-full">Nro. Documento</div>
                </template>
                <template #body="slotProps">
                    <div class="text-center">{{slotProps.data.tipo_documento?.nombre}} {{slotProps.data.numero_documento}}</div>
                </template>
            </Column>
            <Column>
                <template #header>Nombres y apellidos/Razón Social</template>
                <template #body="slotProps">
                    <div>{{slotProps.data.nombres}} {{slotProps.data.apellidos}}</div>
                </template>
            </Column>
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
                        <label for="tipo_documento_id">Tipo de Documento</label>
                        <Select id="tipo_documento_id" v-model="form.tipo_documento_id" :options="tipos_documentos" optionLabel="nombre" optionValue="id" />
                    </div>
                    <div class="flex flex-col gap-2 mb-3">
                        <label for="nombres">Número de documento</label>
                        <InputText id="nombres" v-model="form.numero_documento" />
                    </div>
                    <div class="flex flex-col gap-2 mb-3">
                        <label for="nombres">{{ form.tipo_documento_id == 6 ? 'Razón Social' : 'Nombres'  }}</label>
                        <InputText id="nombres" v-model="form.nombres" />
                    </div>
                    <div class="flex flex-col gap-2 mb-3" v-if="form.tipo_documento_id != 6">
                        <label for="apellidos">Apellidos</label>
                        <InputText id="apellidos" v-model="form.apellidos" />
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
