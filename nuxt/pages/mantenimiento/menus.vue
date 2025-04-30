<script setup lang="ts">
import useMenu from '~/composables/mantenimiento/useMenu';

useHead({
    title: 'Menús',
})

definePageMeta({
    layout: 'app',
    middleware: ['acceso']
})

const {handleSuccess} = useSuccessHandler();
const {
    getMenus,
    createMenu,
    updateMenu,
    updateMenuState,
} = useMenu();

const form:any = ref({});
const errors:any = ref({});
const loading:any = ref(false);
const menus = ref([]);
const term = ref('');
const padreMenus:any = ref([]);
const page = ref(1);
const per_page = ref(20);
const totalRecords = ref(0);
const visibleForm = ref(false);

const clearForm = () => {
    form.value = {
        id: 0,
        nombre: '',
        url: '',
        icono: '',
        padre_id: 0,
        orden: 1
    }
}

const getPadreMenus = () => {
    getMenus({
        'wheres[padre_id]': 0,
        'wheres[estado]': 1,
        'fields[0]':'id',
        'fields[1]':'nombre',
    }).then((data:any)=>{
        padreMenus.value = [{id:0,nombre:'Sin Menú'}].concat(data);
    });
}

const hideModal = () => {
    visibleForm.value = false;
}

const loadRows = (_page:number=1) => {
    if(loading.value) return;
    loading.value = true;
    page.value = _page;
    getMenus({
        'wheres[term]': term.value,
        'wheres[page]': page.value,
        'wheres[per_page]': per_page.value,
        'withs[0]':'menu'
    }).then((data:any)=>{
        menus.value = data.data.map((item:any) => {
            item.estado = item.estado === 1;
            return item;
        });
        totalRecords.value = data.total;
    }).finally(()=>loading.value = false);
}

const openFormModal = (data:any=null) => {
    clearForm();
    getPadreMenus();
    if(data){
        form.value = {
            id: data.id,
            nombre: data.nombre,
            url: data.url,
            icono: data.icono,
            padre_id: data.padre_id,
            orden: data.orden
        }
    }
    visibleForm.value = true;
}

const onPage = (event:any) => {
    loadRows(event.page + 1);
};

const save = async () => {
    try {
        if(form.value.id > 0)
            await updateMenu(form.value.id, form.value);
        else
            await createMenu(form.value);

        handleSuccess('Datos guardados correctamente');
        hideModal();
        loadRows();
    } catch (error:any) {
        if(error?.response?.status === 422)
            errors.value = error.response._data.errors;
    }
}

const updateState = async (id:number) => {
    updateMenuState(id).then(() => {
        handleSuccess('Estado actualizado correctamente');
        loadRows();
    });
}

onBeforeMount(()=>{
    loadRows();
});
</script>
<template>
<div>
    <div class="font-semibold text-2xl mb-4">Menús</div>

    <Toolbar class="mb-6">
        <template #start>
            <InputGroup class="me-2">
                <InputText type="text" placeholder="Buscar por nombre" v-model="term" class="w-[300px]" />                    
                <Button icon="pi pi-search" severity="primary" @click.prevent="loadRows(1)"/>
            </InputGroup>
        </template>

        <template #end>
            <Button label="Nuevo" icon="pi pi-plus" severity="primary" class="mr-2" @click="openFormModal(null)"></Button>
        </template>
    </Toolbar>

    <DataTable
            :value="menus"
            stripedRows
            paginator
            :rows="per_page"
            :totalRecords="totalRecords"
            :loading="loading"
            :lazy="true"
            @page="onPage"
            >
            <template #empty><div class="text-center"><i class="ri-information-line"></i> <span>Sin registros</span></div></template>
            <template #loading>
                <div class="text-center text-[24px]"><i class="ri-loader-line ri-spin"></i> Cargando</div>
            </template>>
            <Column field="nombre" header="Nombre"></Column>
            <Column field="url" header="URL"></Column>
            <Column>
                <template #header>
                    <div class="text-center w-full">Menú Padre</div>
                </template>
                <template #body="slotProps">
                    <div class="text-center">{{ slotProps.data?.menu?.nombre ?? '-' }}</div>
                </template>
            </Column>
            <Column>
                <template #header>
                    <div class="text-center w-full">Icono</div>
                </template>
                <template #body="slotProps">
                    <div class="text-center"><i v-if="slotProps.data.icono" class="text-lg" :class="slotProps.data.icono"></i> {{ slotProps.data.icono ?? '' }}</div>
                </template>
            </Column>
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
        header="Menu"
        v-model:visible="visibleForm"
        modal
        class="w-[350px] md:w-[500px] lg:w-[700px]"
        >
        <template #footer>
            <div class="w-full flex justify-between">
                <Button label="Cancelar" icon="pi pi-times" plain text @click="hideModal" />
                <Button label="Guardar" icon="pi pi-check" severity="primary" text @click="save" />
            </div>
        </template>


        <div class="mb-3">
            <label>Nombre</label>
            <InputText class="w-full" placeholder="Ingresa el nombre" v-model="form.nombre" :disabled="form?.id>0" />
            <small class="text-red-500" v-if="errors?.nombre">{{ errors.nombre[0] }}</small>
        </div>
        <div class="mb-3">
            <label>URL</label>
            <InputText class="w-full" placeholder="Escribe la url" v-model="form.url" />
            <small class="text-red-500" v-if="errors?.url">{{ errors.url[0] }}</small>
        </div>
        <div class="mb-3">
            <label>Icono (clase de remixicon)</label>
            <InputText class="w-full" placeholder="Escribe la clase del icono" v-model="form.icono" />
            <small class="text-red-500" v-if="errors?.icono">{{ errors.icono[0] }}</small>
        </div>
        <div class="mb-3">
            <label>Menú Padre</label>
            <div>
                <Select v-model="form.padre_id" :options="padreMenus" optionLabel="nombre" optionValue="id" placeholder="Seleccione" class="w-full"></Select>
            </div>
        </div>
        <div class="mb-3">
            <label>Orden</label>
            <InputText type="number" class="w-full" placeholder="Escribe la clase del icono" v-model="form.orden" />
            <small class="text-red-500" v-if="errors?.orden">{{ errors.orden[0] }}</small>
        </div>
    </Dialog>
</div>
</template>