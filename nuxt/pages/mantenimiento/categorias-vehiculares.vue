<script setup lang="ts">
import useCategoriaVehicular from '~/composables/mantenimiento/useCategoriaVehicular';
//import useSuccessHandler from '~/composables/useSuccessHandler';

useHead({
    title: 'Categorías Vehiculares',
});

definePageMeta({
    layout: 'app',
    middleware: ['acceso']
});

const rows = ref<any[]>([]);
const loading = ref(false);
const visible = ref(false);
const per_page = ref(10);
const totalRecords = ref(0);
const term = ref('');
const form = ref({
    id: 0,
    codigo: '',
    descripcion: ''
});

const { handleSuccess } = useSuccessHandler();
const {
    createCategoriaVehicular,
    getCategoriasVehiculares,
    updateCategoriaVehicularState,
    updateCategoriaVehicular
} = useCategoriaVehicular();

const onPage = (event: any) => {
    loadRows(event.page + 1);
};

const loadRows = async (page: number = 1) => {
    if (!loading.value) {
        loading.value = true;
        try {
            const data: any = await getCategoriasVehiculares({ term: term.value, page, per_page: per_page.value });
            rows.value = data.data.map((item: any) => ({
                ...item,
                estado: item.estado === 1
            }));
            totalRecords.value = data.total;
        } catch (error) {
            console.error(error);
        } finally {
            loading.value = false;
        }
    }
};

const save = async () => {
    try {
        if (form.value.id > 0) {
            await updateCategoriaVehicular(form.value.id, form.value);
        } else {
            await createCategoriaVehicular(form.value);
        }
        handleSuccess('Datos guardados correctamente');
        hideModal();
        loadRows();
    } catch (error) {
        console.error(error);
    }
};

const updateState = async (id: number) => {
    try {
        await updateCategoriaVehicularState(id);
        handleSuccess('Estado actualizado correctamente');
        loadRows();
    } catch (error) {
        console.error(error);
    }
};

const hideModal = () => {
    visible.value = false;
};

const openFormModal = (data: any = null) => {
    form.value = data ? { ...data } : { id: 0, codigo: '', descripcion: '' };
    visible.value = true;
};

onMounted(() => {
    loadRows();
});
</script>
<template>
    <div>
        <div class="font-semibold text-2xl mb-4">Categorías Vehiculares</div>

        <Toolbar class="mb-6">
            <template #start>
                <InputGroup>
                    <InputText type="text" placeholder="Buscar por nombre" v-model="term" class="w-[300px]" />                    
                    <Button icon="pi pi-search" severity="primary" @click.prevent="loadRows(1)"/>
                </InputGroup>
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
                    <div class="text-center w-full">Código</div>
                </template>
                <template #body="slotProps">
                    <div class="text-center">{{slotProps.data.codigo}}</div>
                </template>
            </Column>
            <Column field="descripcion" header="Descripción"></Column>
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
            header="Tipo de Ambito"
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
                        <label for="codigo">Código</label>
                        <InputText id="codigo" v-model="form.codigo" />
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="descripcion">Descripción</label>
                        <InputText id="descripcion" v-model="form.descripcion" />
                    </div>
                </div>
            </form>
        </Dialog>
    </div>
</template>
