<script setup lang="ts">
    import useRol from '~/composables/mantenimiento/useRol';
    import useMenu from '~/composables/mantenimiento/useMenu';

    useHead({
        title: 'Roles',
    })
    definePageMeta({
        layout: 'app',
        middleware: ['acceso']
    })

    const rows:any = ref([]);
    const loading = ref(false);
    const visible = ref(false); // define si se muestra el modal o no
    const menuDialogVisible = ref(false); // define si se muestra el modal o no
    const per_page = ref(10);
    const totalRecords = ref(0);
    const estado = ref(-1);
    const term = ref('');
    const page = ref(1);
    const selectedRol:any = ref(null);
    const menus = ref([]);
    const estados = ref([
        {id: -1, nombre: 'Activo/Inactivo'},
        {id: 1, nombre: 'Activo'},
        {id: 0, nombre: 'Inactivo'},
    ]);
    const form:any = ref({});

    const {handleSuccess} = useSuccessHandler();
    const {
        createRol, 
        getRoles, 
        updateRolState, 
        updateRol,
        updateMenu
    } = useRol();
    const {
        getMenus
    } = useMenu();

    const onPage = (event:any) => {
        loadRows(event.page + 1);
    };

    const clearForm = () => {
        form.value = {
            id: 0,
            nombre: '',
        };
    }

    const loadRows = async (_page:number=1) => {
        !loading.value && (loading.value = true);
        try {
            page.value = _page;
            const data:any = await getRoles({
                'filters[term]': term.value,
                'filters[estado]': estado.value,
                'withs[0]': 'menus:id,nombre',
                'fields[0]':'id',
                'fields[1]':'nombre',
                'fields[3]':'estado',
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

    const getRolMenu = (rol:any) => {
        selectedRol.value = rol;
        getMenus({
            'wheres[estado]': 1,
            'wheres[padre_id]': 0,
            'withs[0]': 'menus:id,nombre,padre_id',
            'fields[0]': 'id',
            'fields[1]': 'nombre',
        }).then((data:any) => {
            menus.value = data.map((menu:any) => {
                menu.posee = rol.menus.some((e:any) => e.id === menu.id);
                menu.menus = menu.menus.map((menu:any) => {
                    menu.posee = rol.menus.some((e:any) => e.id === menu.id);
                    return menu;
                });
                return menu;
            });

            menuDialogVisible.value = true;
        });
    }

    const save = async () => {
        try {
            if(form.value?.id > 0)
                await updateRol(form.value.id, form.value);
            else
                await createRol(form.value);

            handleSuccess('Datos guardados correctamente');
            hideModal();
            loadRows();
        } catch (error) {
            console.log(error);
        }
    };

    const saveMenu = async () => {
        let _menus:any = menus.value.filter(menu => menu.posee).map(menu => menu.id);
        updateMenu(selectedRol.value?.id, {'menus': _menus}).then((res:any)=>{
            handleSuccess(res.message);
            hideMenuDialog();
            loadRows();
        })
    }

    const updateState = async (id:number) => {
        updateRolState(id).then(() => {
            handleSuccess('Estado actualizado correctamente');
            loadRows();
        });
    }

    const hideModal = () => {
        visible.value = false;
    };

    const hideMenuDialog = () => {
        menuDialogVisible.value = false;
    };

    const openFormModal = (data:any = null) => {
        clearForm();
        if(data) {
            form.value = {
                id: data.id,
                nombre: data.nombre
            };
        }

        visible.value = true;
    };

    const openMenuDialog = (rol:any) => {
        getRolMenu(rol);
    };

    onMounted(() => {
        loadRows();
    });
</script>
<template>
    <div>
        <div class="font-semibold text-2xl mb-4">Roles</div>

        <Toolbar class="mb-6">
            <template #start>
                <InputGroup class="me-2">
                    <InputText type="text" placeholder="Buscar por nombre" v-model="term" class="w-[300px]" />                    
                    <Button icon="pi pi-search" severity="primary" @click.prevent="loadRows(1)"/>
                </InputGroup>
                <Select v-model="estado" :options="estados" optionLabel="nombre" optionValue="id" class="w-full md:w-56 me-2" @change="loadRows(1)"/>
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
            <Column field="nombre" header="Nombre"></Column>
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
                        <Button icon="pi pi-pencil" class="p-button-rounded p-button-success me-2" @click.prevent="openFormModal(slotProps.data)"></Button>
                        <Button class="p-button-rounded p-button-warn p-mr-2" @click.prevent="openMenuDialog(slotProps.data)"><i class="ri-lock-line"></i></Button>
                    </div>
                </template>
            </Column>
        </DataTable>

        <Dialog
            header="Rol"
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
                    <div class="flex flex-col gap-2">
                        <label for="descripcion">Nombre</label>
                        <InputText id="descripcion" v-model="form.nombre" />
                    </div>
                </div>
            </form>
        </Dialog>

        <Dialog
            header="Gestionar menú"
            v-model:visible="menuDialogVisible"
            modal
            class="w-[350px] md:w-[500px] lg:w-[700px]"
        >
            <template #footer>
                <div class="w-full flex justify-between">
                    <Button label="Cancelar" icon="pi pi-times" plain text @click="hideMenuDialog" />
                    <Button label="Guardar" icon="pi pi-check" severity="primary" text @click="saveMenu" />
                </div>
            </template>
            <table class="table table-sm mb-0 align-middle w-full">
                <thead>
                    <tr class="bg-primary text-white">
                        <th>Nombre</th>
                        <th class="text-center">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="menu in menus" :key="'menu_'+menu.id">
                        <tr>
                            <td>{{ menu.nombre }}</td>
                            <td class="text-center">
                                <Checkbox v-model="menu.posee" :binary="true" />
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </Dialog>
    </div>
</template>