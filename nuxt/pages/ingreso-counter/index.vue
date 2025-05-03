<script setup lang="ts">
import dayjs from 'dayjs';
import useFichaVehicular from '~/composables/procesos/useFichaVehicular';
import useSucursal from '~/composables/mantenimiento/useSucursal';
import useRol from '~/composables/mantenimiento/useRol';
import useReporte from '~/composables/useReporte';
import { useRouter } from 'vue-router';

useHead({
    title: 'Ingreso al Counter'
});
definePageMeta({
    layout: 'app',
    middleware: ['acceso']
});

const { handleSuccess } = useSuccessHandler();
const { createFichaVehicular, getFichasVehiculares, updateFichaVehicular, updateFichaVehicularState } = useFichaVehicular();
const { getSucursales } = useSucursal();
const { getRoles } = useRol();
const { generarReporteUsuariosPorAccion } = useReporte();
const { handleReport } = useReportHandler();

const router = useRouter();
const rows: any = ref([]);
const loading = ref(false);
const visible = ref(false); // define si se muestra el modal o no
const page = ref(1);
const per_page = ref(10);
const totalRecords = ref(0);
const term = ref('');
const sucursales: any = ref([]);
const roles = ref([]);
const form: any = ref({});
const errors: any = ref({});

const fecha_actual = computed(() => dayjs().format('DD/MM/YYYY'));
const fecha_actual_search = computed(() => dayjs().format('DD/MM/YYYY'));
const hora_actual = computed(() => dayjs().format('hh:mm A'));
const codigo_local = computed(() => {
    return sucursales.value.find((sucursal: any) => sucursal.id === form.value.sucursal_id)?.codigo_local ?? '';
});
const clearForm = () => {
    form.value = {
        sucursal_id: 0
    };
};

const onPage = (event: any) => {
    loadRows(event.page + 1);
};

const loadRows = async (_page: number = 1) => {
    !loading.value && (loading.value = true);
    page.value = _page;

    try {
        const data: any = await getFichasVehiculares({
            'wheres[term]': term.value,
            //'wheres[fecha]': '2024-10-27', // Ejemplo '2024-04-30'
            'wheres[fecha]': dayjs().format('YYYY-MM-DD'),
            'wheres[page]': page.value,
            'wheres[per_page]': per_page.value,
            'withs[0]': 'sucursal:id,nombre,codigo_local',
            'withs[1]': 'tipo_inspeccion:codigo,descripcion',
            'withs[2]': 'usuario:id,nombres,apellidos'
        });

        rows.value = data.data.map((item: any) => {
            item.created_at = dayjs(item.created_at).format('DD/MM/YYYY hh:mm A');

            // Añadir etiqueta de caducidad si es relevante
            if (item.estado === 2 && item.dias_restantes !== null) {
                item.caducidad_texto = `Caduca en ${item.dias_restantes} días`;
            }

            return item;
        });
        totalRecords.value = data.total;
        loading.value = false;
    } catch (error) {
        console.log(error);
    }
};

const save = () => {
    createFichaVehicular(form.value)
        .then((res: any) => {
            handleSuccess(res.message);
            hideModal();
            loadRows(1);
        })
        .catch((error: any) => {
            if (error?.response?.status === 422) errors.value = error.response._data.errors;
        });
};
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

const openFormModal = (data: any = null) => {
    clearForm();
    if (data) {
        form.value = {
            id: data.id,
            dni: data.dni,
            nombres: data.nombres,
            apellidos: data.apellidos,
            email: data.email,
            telefono: data.telefono,
            rol_id: data.rol_id,
            sucursal_id: data.sucursal_id
        };
    }
    visible.value = true;
};
const goToFicha = (ficha: any) => {
  router.push({ path: '/ingreso-counter/ficha_vehicular', query: { id: ficha.id } });
};

const generarYMostrarReporte = async (fichaSelect:any) => {
    console.log(fichaSelect.id)
  const payload = {
    funcion: "getFichaTecnica",
    params: "accion^3|ficha_vehicular_id^"+fichaSelect.id,
    version: "v1",
    tipo: "pdf",
    custom_title: "Certificado de Inspeccion Tecnica Vehicular"
  };

  const response: any = await generarReporteUsuariosPorAccion(payload);

  if (response instanceof Blob) {
    const blobUrl = URL.createObjectURL(response);
    handleReport(blobUrl); // ahora sí funciona con tu iframe
  } else {
    console.error("No se pudo generar el reporte");
  }
};


onMounted(() => {
    loadRows();

    getSucursales({
        fields: 'id,nombre,codigo_local',
        'filters[estado]': 1
    }).then((data: any) => {
        sucursales.value = data;
    });

    getRoles({
        'fields[0]': 'id',
        'fields[1]': 'nombre',
        'filters[estado]': 1
    }).then((data: any) => {
        roles.value = data;
    });
});
const estadoNombre = (estado: number): string => {
    switch (estado) {
        case 0:
            return 'ELIMINADO';
        case 1:
            return 'PENDIENTE';
        case 2:
            return 'DESAPROBADO';
        case 3:
            return 'APROBADO';
        default:
            return 'DESCONOCIDO';
    }
};

const estadoColor = (estado: number): string => {
    switch (estado) {
        case 0:
            return '#6c757d'; // Gris
        case 1:
            return '#ffc107'; // Amarillo
        case 2:
            return '#dc3545'; // Rojo
        case 3:
            return '#28a745'; // Verde
        default:
            return '#6c757d'; // Gris por defecto
    }
};
</script>
<template>
    <div>
        <div class="font-semibold text-2xl mb-4">Ingreso al Counter</div>

        <Toolbar class="mb-6">
            <template #start>
                <InputGroup class="me-2">
                    <InputText type="text" placeholder="Buscar por Placa" v-model="term" class="w-[300px]" />
                    <Button icon="pi pi-search" severity="primary" @click.prevent="loadRows(1)" />
                </InputGroup>
                <!-- <Select v-model="estado" :options="estados" optionLabel="nombre" optionValue="id" class="w-full md:w-56" @change="loadRows(1)"/> -->
            </template>
            <template #end>
                <Button as="router-link" label="Registrar Vehículo" icon="pi pi-plus" severity="warn" class="mr-2" to="/ingreso-counter/ficha_vehicular"></Button>
            </template>
        </Toolbar>

        <DataTable :value="rows" stripedRows paginator :rows="per_page" :totalRecords="totalRecords" :loading="loading" :lazy="true" size="small" @page="onPage">
            <template #loading>
                <div class="text-center text-[24px]"><i class="ri-loader-line ri-spin"></i> Cargando</div>
            </template>
            <template #empty
                ><div class="text-center"><i class="ri-information-line"></i> <span>Sin registros</span></div></template
            >
            <Column field="NUM_FICHA" header="Nro. Ficha"></Column>
            <Column field="PLACA" header="Placa"></Column>
            <Column field="tipo_inspeccion.descripcion" header="Tipo Inspección"></Column>
            <Column field="created_at" header="Fec. Ingreso"></Column>
            <Column header="Usuario">
                <template #body="slotProps"> {{ slotProps.data.usuario?.nombres }} {{ slotProps.data.usuario?.apellidos }} </template>
            </Column>
            <Column header="Estado">
                <template #body="slotProps">
                    <span class="px-2 py-1 rounded-full text-white text-xs font-semibold" :style="{ backgroundColor: estadoColor(slotProps.data.estado) }">
                        {{ estadoNombre(slotProps.data.estado) }}
                    </span>
                </template>
            </Column>
            <Column field="caducidad_texto" header="Dias Faltanes" :style="{ width: '6%' }"></Column>
            <Column>
                <template #header>
                    <div class="text-center w-full">Acciones</div>
                </template>
                <template #body="slotProps">
                    <div class="text-center w-full">
                        <Button icon="pi pi-pencil" class="p-button-rounded p-button-warn me-2" @click.prevent="goToFicha(slotProps.data)" :disabled="!(slotProps.data.estado === 1 || slotProps.data.estado === 2)"                        ></Button>
                        <Button icon="pi pi-eye" class="p-button-rounded p-button-primary me-2" @click.prevent="generarYMostrarReporte(slotProps.data)"></Button>
                    </div>
                </template>
            </Column>
        </DataTable>

        <Dialog header="Aperturar Operación Diaria" v-model:visible="visible" modal class="w-[350px]">
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
            <div class="mb-3" v-if="form.sucursal_id > 0">
                <label>Código Local</label>
                <div>
                    <InputText type="text" class="w-full" disabled :value="codigo_local" />
                </div>
            </div>
            <div class="mb-3" v-if="form.sucursal_id > 0">
                <label>Fecha</label>
                <div>
                    <InputText type="text" class="w-full" disabled :value="fecha_actual" />
                </div>
            </div>
            <div class="mb-3" v-if="form.sucursal_id > 0">
                <label>Hora</label>
                <div>
                    <InputText type="text" class="w-full" disabled :value="hora_actual" />
                </div>
            </div>
        </Dialog>
    </div>
</template>
