<script setup lang="ts">
    import dayjs from 'dayjs';
    import useTipoAmbito from '~/composables/mantenimiento/useTipoAmbito';
    import useTipoInspeccion from '~/composables/mantenimiento/useTipoInspeccion';
    import useTipoServicio from '~/composables/mantenimiento/useTipoServicio';
    import useCategoriaVehicular from '~/composables/mantenimiento/useCategoriaVehicular';
    import useFichaVehicular from '~/composables/procesos/useFichaVehicular';
    import useAseguradora from '~/composables/mantenimiento/useAseguradora';

    useHead({
        title: 'Ingreso al Counter',
    })
    definePageMeta({
        layout: 'app',
        middleware: ['acceso']
    })

    const { getAseguradoras } = useAseguradora();
    const { getCategoriasVehiculares } = useCategoriaVehicular();
    const { getTiposAmbitos } = useTipoAmbito();
    const { getTiposInspecciones } = useTipoInspeccion();
    const { getTiposServicios } = useTipoServicio();
    const { createFichaVehicular, updatePoliza } = useFichaVehicular();
    const { handleSuccess } = useSuccessHandler();


    const _aseguradoras = ref([]);
    const aseguradoras = computed(()=>_aseguradoras.value.filter((item:any)=>item.tipo_poliza_id == ficha.value.TIPPOLIZA));
    const categorias = ref([]);
    const tipos_ambito = ref([]);
    const tipos_inspeccion = ref([]);
    const tipos_servicio = ref([]);
    const tipos_poliza = ref([
        {id:1, codigo:'SOAT'},
        {id:2, codigo:'AFOCAT'}
    ]);

    const errors:any = ref({});
    const ficha:any = ref({});
    const form = ref({
        PLACA: '',
        CATEGORIA: '',
        TIPSERVICIO: '',
        TIPAMBITO: '',
        TIPINSPECCION: ''
    });

    const create = ()=>{
        createFichaVehicular(form.value).then((response:any)=>{
            ficha.value = response;
        }).catch((error)=>{
            errors.value = error.response._data.errors;
        });
    }

    const updateFichaPoliza = () => {
        updatePoliza(ficha.value.id, {
            TIPPOLIZA: ficha.value.TIPPOLIZA,
            ASEGURADORA: ficha.value.ASEGURADORA,
            NUMPOLIZA: ficha.value.NUMPOLIZA,
            FECINIPOLIZA: dayjs(ficha.value.FECINIPOLIZA).format('YYYY-MM-DD'),
            FECFINPOLIZA: dayjs(ficha.value.FECFINPOLIZA).format('YYYY-MM-DD')
        }).then((response:any)=>{
            handleSuccess(response.message);
        }).catch((error)=>{
            errors.value = error.response._data.errors;
        });
    }

    onBeforeMount(()=>{
        getCategoriasVehiculares({estado:1}).then((response:any)=>{
            categorias.value = response;
        });

        getTiposAmbitos({estado:1}).then((response:any)=>{
            tipos_ambito.value = response;
        });

        getTiposInspecciones({estado:1}).then((response:any)=>{
            tipos_inspeccion.value = response;
        });

        getTiposServicios({estado:1}).then((response:any)=>{
            tipos_servicio.value = response;
        });

        getAseguradoras({
            'filters[estado]':1,
            'fields[0]': 'id',
            'fields[1]': 'descripcion',
            'fields[2]': 'tipo_poliza_id',
        }).then((response:any)=>{
            _aseguradoras.value = response;
        });
    });

</script>
<template>
    <div>
        <div class="font-semibold text-2xl mb-4">Ingreso al Counter</div>
        <Card class="mb-3">
            <template #title>1. Generar número de Ficha</template>
            <template #content>
                <div class="grid lg:grid-cols-6 md:grid-cols-3 grid-cols-1 gap-4">
                    <div class="mb-4">
                        <label class="block mb-1">Placa</label>
                        <InputText
                            maxlength="6"
                            placeholder="Nro. de placa"
                            v-model="form.PLACA"
                            class="w-full border rounded-md p-2"
                        />
                        <small class="text-red-500" v-if="errors?.PLACA">{{ errors.PLACA[0] }}</small>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block mb-1">Categoría</label>
                        <Dropdown
                            v-model="form.CATEGORIA"
                            :disabled="ficha?.id > 0"
                            :options="categorias"
                            option-label="descripcion"
                            option-value="codigo"
                            placeholder="Seleccione"
                            class="w-full"
                        />
                        <small class="text-red-500" v-if="errors?.CATEGORIA">{{ errors.CATEGORIA[0] }}</small>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Tipo de Servicio</label>
                        <Dropdown
                            v-model="form.TIPSERVICIO"
                            :disabled="ficha?.id > 0"
                            :options="tipos_servicio"
                            option-label="descripcion"
                            option-value="codigo"
                            placeholder="Seleccione"
                            class="w-full"
                        />
                        <small class="text-red-500" v-if="errors?.TIPSERVICIO">{{ errors.TIPSERVICIO[0] }}</small>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Ámbito</label>
                        <Dropdown
                            v-model="form.TIPAMBITO"
                            :disabled="ficha?.id > 0"
                            :options="tipos_ambito"
                            option-label="descripcion"
                            option-value="codigo"
                            placeholder="Seleccione"
                            class="w-full"
                        />
                        <small class="text-red-500" v-if="errors?.TIPAMBITO">{{ errors.TIPAMBITO[0] }}</small>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Tipo de Inspección</label>
                        <Dropdown
                            v-model="form.TIPINSPECCION"
                            :disabled="ficha?.id > 0"
                            :options="tipos_inspeccion"
                            option-label="descripcion"
                            option-value="codigo"
                            placeholder="Seleccione"
                            class="w-full"
                        />
                        <small class="text-red-500" v-if="errors?.TIPINSPECCION">{{ errors.TIPINSPECCION[0] }}</small>
                    </div>

                    <div class="mb-4">
                        <label class="md:block hidden mb-1">&nbsp;</label>
                        <Button
                            label="GENERAR"
                            icon="ri-search-2-line"
                            class="p-button-success w-full"
                            @click.prevent="create()"
                            :disabled="ficha?.id > 0"
                        />
                    </div>
                </div>
            </template>
        </Card>

        <Card v-if="ficha?.id>0">
            <template #title>2. Tarjeta de propiedad y Poliza de seguro</template>
            <template #content>
                <Tabs value="0">
                    <TabList>
                        <Tab value="0">Tarjeta de Propiedad</Tab>
                        <Tab value="1">Última Inspección</Tab>
                        <Tab value="2">Póliza de Seguro</Tab>
                    </TabList>
                    <TabPanels>
                        <TabPanel value="0">
                            <div class="py-2">
                                <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4">
                                    <div class="mb-3">
                                        <label class="block mb-1">Número de Ficha</label>
                                        <InputText type="text" class="w-full" v-model="ficha.NUM_FICHA" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-1">Placa</label>
                                        <InputText type="text" class="w-full" v-model="ficha.PLACA" />
                                    </div>
                                </div>
                                <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-4">
                                    <div class="mb-3">
                                        <label class="block mb-1">Categoria</label>
                                        <InputText type="text" class="w-full" v-model="ficha.CATEGORIA_DESC" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-1">Marca</label>
                                        <InputText type="text" class="w-full" v-model="ficha.MARCA" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-1">Año de Fabricación</label>
                                        <InputText type="text" class="w-full" v-model="ficha.ANOFAB" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-1">Modelo</label>
                                        <InputText type="text" class="w-full" v-model="ficha.MODELO" />
                                    </div>
                                </div>
                                <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4">
                                    <div class="mb-3">
                                        <label class="block mb-1">Combustible</label>
                                        <InputText type="text" class="w-full" v-model="ficha.COMBUSTIBLE" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-1">Descripción de la carrocería</label>
                                        <InputText type="text" class="w-full" v-model="ficha.CARROCERIA" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-1">Número de ejes</label>
                                        <InputText type="text" class="w-full" v-model="ficha.NUMEROEJES" />
                                    </div>
                                </div>
                                <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-4">
                                    <div class="mb-3">
                                        <label class="block mb-1">Color</label>
                                        <InputText type="text" class="w-full" v-model="ficha.COLOR" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-1">Número de Motor</label>
                                        <InputText type="text" class="w-full" v-model="ficha.NUMEROMOTOR" />
                                    </div>
                                </div>
                                <div class="grid lg:grid-cols-4 md-grid-cols-2 grid-cols-1 gap-4">
                                    <div class="mb-3">
                                        <label class="block mb-1">VIN/Serie Chasis</label>
                                        <InputText type="text" class="w-full" v-model="ficha.VINSERCHA" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-1">Ruedas</label>
                                        <InputText type="text" class="w-full" v-model="ficha.NUMERORUEDAS" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-1">Pasajeros</label>
                                        <InputText type="text" class="w-full" v-model="ficha.NUMEROPASAJEROS" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-1">Asientos</label>
                                        <InputText type="text" class="w-full" v-model="ficha.NUMEROASIENTOS" />
                                    </div>
                                </div>
                                <div class="grid lg:grid-cols-6 md:grid-cols-3 grid-cols-2 gap-4">
                                    <div class="col mb-3">
                                        <label class="block mb-1">Peso Neto</label>
                                        <InputText type="text" class="w-full" v-model="ficha.PESONETO" />
                                    </div>
                                    <div class="col mb-3">
                                        <label class="block mb-1">Peso Bruto</label>
                                        <InputText type="text" class="w-full" v-model="ficha.PESOBRUTO" />
                                    </div>
                                    <div class="col mb-3">
                                        <label class="block mb-1">Carga Util</label>
                                        <InputText type="text" class="w-full" v-model="ficha.PESOUTIL" />
                                    </div>
                                    <div class="col mb-3">
                                        <label class="block mb-1">Longitud</label>
                                        <InputText type="text" class="w-full" v-model="ficha.LARGO" />
                                    </div>
                                    <div class="col mb-3">
                                        <label class="block mb-1">Altura</label>
                                        <InputText type="text" class="w-full" v-model="ficha.ALTO" />
                                    </div>
                                    <div class="col mb-3">
                                        <label class="block mb-1">Ancho</label>
                                        <InputText type="text" class="w-full" v-model="ficha.ANCHO" />
                                    </div>
                                </div>
                            </div>
                        </TabPanel>
                        <TabPanel value="1">
                            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-4">
                                <div class="mb-3">
                                    <label class="block mb-1">Número de Documento</label>
                                    <InputText type="text" class="w-100" v-model="ficha.NUMDOC_ULTREV" />
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-1">Fecha del documento</label>
                                    <InputText type="text" class="w-100" v-model="ficha.FECDOC_ULTREV" />
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-1">Empresa</label>
                                    <InputText type="text" class="w-100" v-model="ficha.RAZSOCCITV_ULTREV" />
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-1">Observaciones</label>
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <tbody>
                                                <tr>
                                                    <td>Sin observaciones</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </TabPanel>
                        <TabPanel value="2">
                            <div class="grid lg:grid-cols-6 md:grid-cols-3 grid-cols-2 gap-4">
                                <div class="mb-3">
                                    <label class="block mb-1">Tipo de Poliza</label>
                                    <Select class="w-full" :options="tipos_poliza" optionLabel="codigo" optionValue="id" v-model="ficha.TIPPOLIZA" placeholder="Seleccione"/>
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-1">Aseguradora</label>
                                    <Select class="w-full" :options="aseguradoras" optionLabel="descripcion" optionValue="id" v-model="ficha.ASEGURADORA" placeholder="Seleccione"/>
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-1">Número de Poliza</label>
                                    <InputText type="text" class="w-full" v-model="ficha.NUMPOLIZA" />
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-1">Fecha Inicio</label>
                                    <DatePicker v-model="ficha.FECINIPOLIZA" class="w-full" ateFormat="dd/mm/yy" />
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-1">Fecha Fin</label>
                                    <DatePicker v-model="ficha.FECFINPOLIZA" class="w-full" dateFormat="dd/mm/yy" />
                                </div>
                                <div class="mb-3">
                                    <label class="md:block hidden mb-1">&nbsp;</label>
                                    <Button label="Guardar" class="w-full" severity="primary" @click.prevent="updateFichaPoliza()" />
                                </div>
                            </div>
                        </TabPanel>
                    </TabPanels>
                </Tabs>
            </template>
        </Card>
    </div>
</template>