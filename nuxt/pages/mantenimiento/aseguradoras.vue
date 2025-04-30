<script setup lang="ts">
    import useAseguradora from '~/composables/mantenimiento/useAseguradora';

    useHead({
        title: 'Aseguradoras',
    })
    definePageMeta({
        layout: 'app',
        middleware: ['acceso']
    })

    const rows:any = ref([]);
    const loading = ref(false);
    const visible = ref(false); // define si se muestra el modal o no
    const per_page = ref(20);
    const totalRecords = ref(0);
    const term = ref('');
    const estado = ref(-1);
    const tipo_poliza_id = ref(0);
    const page = ref(1);
    const tipos_polizas = ref([
        {id: 0, nombre: 'Polizas'},
        {id: 1, nombre: 'SOAT'},
        {id: 2, nombre: 'AFOCAT'},
    ]);
    const tipos_polizas_2 = ref([
        {id: 1, nombre: 'SOAT'},
        {id: 2, nombre: 'AFOCAT'},
    ]);
    const estados = ref([
        {id: -1, nombre: 'Activo/Inactivo'},
        {id: 1, nombre: 'Activo'},
        {id: 0, nombre: 'Inactivo'},
    ]);
    const form:any = ref({});

    const {handleSuccess} = useSuccessHandler();
    const {createAseguradora, getAseguradoras, updateAseguradora, updateAseguradoraState} = useAseguradora();

    const onPage = (event:any) => {
        loadRows(event.page + 1);
    };

    const loadRows = async (_page:number=1) => {
        !loading.value && (loading.value = true);
        try {
            page.value = _page;
            const data:any = await getAseguradoras({
                'filters[term]': term.value,
                'filters[estado]': estado.value,
                'filters[tipo_poliza_id]': tipo_poliza_id.value,
                'fields[]':['id','descripcion','tipo_poliza_id','estado'],
                'withs[]': 'tipo_poliza:id,codigo,descripcion',
                page: page.value,
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
                await updateAseguradora(form.value.id, form.value);
            else
                await createAseguradora(form.value);

            handleSuccess('Datos guardados correctamente');
            hideModal();
            loadRows(page.value);
        } catch (error) {
            console.log(error);
        }
    };

    const updateState = async (id:number) => {
        updateAseguradoraState(id).then(() => {
            handleSuccess('Estado actualizado correctamente');
            loadRows(page.value);
        });
    }

    const hideModal = () => {
        visible.value = false;
    };

    const openFormModal = (data:any = null) => {
        if(data) {
            form.value = {
                id: data.id,
                descripcion: data.descripcion,
                tipo_poliza_id: data.tipo_poliza_id,
            };
        } else {
            form.value = {
                id: 0,
                descripcion: '',
                tipo_poliza_id: 1,
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
        <div class="font-semibold text-2xl mb-4">Aseguradoras</div>

        <Toolbar class="mb-6">
            <template #start>
                <InputGroup class="me-2">
                    <InputText type="text" placeholder="Buscar por nombre" v-model="term" class="w-[300px]" />                    
                    <Button icon="pi pi-search" severity="primary" @click.prevent="loadRows(1)"/>
                </InputGroup>
                <Select v-model="estado" :options="estados" optionLabel="nombre" optionValue="id" class="w-full md:w-56 me-2" @change="loadRows(1)"/>
                <Select v-model="tipo_poliza_id" :options="tipos_polizas" optionLabel="nombre" optionValue="id" class="w-full md:w-56" @change="loadRows(1)"/>
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
            @page="onPage"
            >
            <template #empty><div class="text-center"><i class="ri-information-line"></i> <span>Sin registros</span></div></template>
            <Column field="id" header="Código"></Column>
            <Column field="descripcion" header="Descripcion"></Column>
            <Column field="tipo_poliza.codigo" header="Poliza"></Column>
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
            header="Aseguradora"
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
                        <label for="nombres">Descripción</label>
                        <InputText id="nombres" v-model="form.descripcion" />
                    </div>
                    <div class="flex flex-col gap-2 mb-3">
                        <label for="tipo_documento_id"></label>
                        <Select id="tipo_documento_id" v-model="form.tipo_poliza_id" :options="tipos_polizas_2" optionLabel="nombre" optionValue="id" />
                    </div>
                </div>
            </form>
        </Dialog>
    </div>
</template>
