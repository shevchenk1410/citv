<script setup lang="ts">
    import dayjs from 'dayjs';
    import useOperacionDiaria from '~/composables/procesos/useOperacionDiaria';
    import useSucursal from '~/composables/mantenimiento/useSucursal';
    import useRol from '~/composables/mantenimiento/useRol';

    useHead({
        title: 'Operaciones Diarias',
    })
    definePageMeta({
        layout: 'app',
        middleware: ['acceso']
    })

    const {handleSuccess} = useSuccessHandler();
    const {createOperacionDiaria, getOperacionesDiarias, updateOperacionDiaria, updateOperacionDiariaState} = useOperacionDiaria();
    const { getSucursales } = useSucursal();
    const { getRoles } = useRol();

    const rows:any = ref([]);
    const loading = ref(false);
    const visible = ref(false); // define si se muestra el modal o no
    const page = ref(1);
    const per_page = ref(10);
    const totalRecords = ref(0);
    const term = ref('');
    const sucursales:any = ref([]);
    const roles = ref([]);
    const form:any = ref({});
    const errors:any = ref({});

    const fecha_actual = computed(() => dayjs().format('DD/MM/YYYY'));
    const hora_actual = computed(() => dayjs().format('hh:mm A'));
    const codigo_local = computed(() => {
        return sucursales.value.find((sucursal:any) => sucursal.id === form.value.sucursal_id)?.codigo_local ?? '';
    });

    

    const clearForm = () => {
        form.value = {
            sucursal_id: 0
        };
    };

    const onPage = (event:any) => {
        loadRows(event.page + 1);
    };

    const loadRows = async (_page:number=1) => {
        !loading.value && (loading.value = true);
        page.value = _page;

        try {
            const data:any = await getOperacionesDiarias({
                'wheres[term]': term.value,
                'wheres[page]': page.value,
                'wheres[per_page]': per_page.value,
                'withs[0]':'sucursal:id,nombre,codigo_local',
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

    const save = () => {
        createOperacionDiaria(form.value).then((res:any) => {
            handleSuccess(res.message);
            hideModal();
            loadRows(1);
        }).catch((error:any) => {
            if(error?.response?.status === 422)
                errors.value = error.response._data.errors;
        });
    }
    /*
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
    }*/

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
            'fields':'id,nombre,codigo_local',
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
        <div class="font-semibold text-2xl mb-4">Operaciones Diarias</div>

        <Toolbar class="mb-6">
            <template #end>
                <Button label="Aperturar" icon="pi pi-plus" severity="primary" class="mr-2" @click="openFormModal(null)"></Button>
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
            size="small"
            @page="onPage"
            >
            <template #loading>
                <div class="text-center text-[24px]"><i class="ri-loader-line ri-spin"></i> Cargando</div>
            </template>
            <template #empty><div class="text-center"><i class="ri-information-line"></i> <span>Sin registros</span></div></template>
            <Column field="fecha" header="Fecha"></Column>
            <Column field="sucursal.nombre" header="Sucursal"></Column>
            <Column field="CIOD_CITV" header="Cod. Inicio Operación"></Column>
            <Column field="hora_inicio" header="Apertura"></Column>
            <Column field="hora_fin" header="Cierre"></Column>
            <Column field="NUMTRADIA" header="Nro. Trans. Exitosas"></Column>
            <Column field="NUMCERTI" header="Nro. Cert. Generados"></Column>
            <Column field="NUMINFOR" header="Nro. Inf. Generados"></Column>
            <Column field="NUMANUL" header="Nro. Anul. Realizadas"></Column>
        </DataTable>

        <Dialog
            header="Aperturar Operación Diaria"
            v-model:visible="visible"
            modal
            class="w-[350px]"
        >
        <template #footer>
            <div class="w-full flex justify-between">
                <Button label="Cancelar" icon="pi pi-times" plain text @click="hideModal" />
                <Button label="Guardar" icon="pi pi-check" severity="primary" text @click="save" />
            </div>
        </template>

        <div class="mb-3">
            <label>Sucursal</label>
            <div>
                <Select v-model="form.sucursal_id" :options="sucursales" optionLabel="nombre" optionValue="id" placeholder="Seleccione" class="w-full"></Select>
            </div>
        </div>
        <div class="mb-3" v-if="form.sucursal_id>0">
            <label>Código Local</label>
            <div>
                <InputText type="text" class="w-full" disabled :value="codigo_local" />
            </div>
        </div>
        <div class="mb-3" v-if="form.sucursal_id>0">
            <label>Fecha</label>
            <div>
                <InputText type="text" class="w-full" disabled :value="fecha_actual" />
            </div>
        </div>
        <div class="mb-3" v-if="form.sucursal_id>0">
            <label>Hora</label>
            <div>
                <InputText type="text" class="w-full" disabled :value="hora_actual" />
            </div>
        </div>
    </Dialog>
    </div>
</template>
