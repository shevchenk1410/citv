<script setup lang="ts">
import dayjs from 'dayjs';
import useTipoAmbito from '~/composables/mantenimiento/useTipoAmbito';
import useTipoInspeccion from '~/composables/mantenimiento/useTipoInspeccion';
import useTipoServicio from '~/composables/mantenimiento/useTipoServicio';
import useCategoriaVehicular from '~/composables/mantenimiento/useCategoriaVehicular';
import useFichaVehicular from '~/composables/procesos/useFichaVehicular';
import useFichaVehicularEva from '~/composables/procesos/useFichaVehicularEvaluacion';
import useAseguradora from '~/composables/mantenimiento/useAseguradora';
import { useRouter } from 'vue-router';
useHead({
    title: 'Ingreso al Counter'
});
definePageMeta({
    layout: 'app',
    middleware: ['acceso']
});

const route = useRoute();
const fichaId = route.query.id;
const { getAseguradoras } = useAseguradora();
const { getCategoriasVehiculares } = useCategoriaVehicular();
const { getTiposAmbitos } = useTipoAmbito();
const { getTiposInspecciones } = useTipoInspeccion();
const { getTiposServicios } = useTipoServicio();
const { createFichaVehicular, updatePoliza, getFichaVehicularId, updateFichaVehicular } = useFichaVehicular();
const { createFichaVehicularEva, getFichaVehicularEvaId, updateFichaVehicularEva } = useFichaVehicularEva();
const { handleSuccess } = useSuccessHandler();
const { handleError } = useErrorHandler();

const router = useRouter();
const _aseguradoras = ref([]);
const aseguradoras = computed(() => _aseguradoras.value.filter((item: any) => item.tipo_poliza_id == ficha.value.TIPPOLIZA));
const categorias = ref([]);
const tipos_ambito = ref([]);
const tipos_inspeccion = ref([]);
const tipos_servicio = ref([]);
const tipo_servicio_seleccion = ref([]);
const tipo_ambito_seleccion = ref([]);
const tipos_poliza = ref([
    { id: '1', codigo: 'SOAT' },
    { id: '2', codigo: 'AFOCAT' }
]);
const reglaSeleccion = ref(true);
const flagCard3 = ref(false);

const errors: any = ref({});
const errorsInspeccion: any = ref({});
const ficha: any = ref({});
const inspeccion: any = ref({});
const form = ref({
    PLACA: '',
    CATEGORIA: '',
    TIPSERVICIO: '',
    TIPAMBITO: '',
    TIPINSPECCION: ''
});
console.log(ficha.value);
//Temporizador de Inactividad
let timer: ReturnType<typeof setTimeout>;
let warningTimeout: ReturnType<typeof setTimeout>;

const INACTIVITY_LIMIT = 10 * 60 * 1000; // 2 minutos
const WARNING_TIME = 2 * 60 * 1000; // 1

watchEffect(async () => {
    console.log('hola');
    console.log(fichaId);
    if (fichaId) {
        const response = await getFichaVehicularId(Number(fichaId));
        console.log(response.ASEGURADORA);
        ficha.value = {
            ...response
        };
        form.value = {
            PLACA: response.PLACA ?? '',
            CATEGORIA: response.CATEGORIA ?? {},
            TIPSERVICIO: response.TIPSERVICIO ?? {},
            TIPAMBITO: response.TIPAMBITO ?? {},
            TIPINSPECCION: response.TIPINSPECCION ?? {}
        };
        console.log(ficha.value.evaluacion);
        if (ficha.value.evaluacion != null) {
            inspeccion.value = ficha.value.evaluacion;
            console.log(inspeccion.value);
            flagCard3.value = true;
        }
        // Aquí puedes asignarla a una variable `ref` para mostrarla en el template
    } else {
        ficha.TIPPOLIZA = '1';
    }
});
const create = () => {
    errors.value = {};
    createFichaVehicular(form.value)
        .then((response: any) => {
            ficha.value = response;
        })
        .catch((error) => {
            errors.value = error.response._data.errors;
        });
};
const updateFichaPoliza = () => {
    errors.value = {};
    updatePoliza(ficha.value.id, {
        TIPPOLIZA: ficha.value.TIPPOLIZA,
        ASEGURADORA: ficha.value.ASEGURADORA,
        NUMPOLIZA: ficha.value.NUMPOLIZA,
        FECINIPOLIZA: dayjs(ficha.value.FECINIPOLIZA).format('YYYY-MM-DD'),
        FECFINPOLIZA: dayjs(ficha.value.FECFINPOLIZA).format('YYYY-MM-DD')
    })
        .then((response: any) => {
            handleSuccess(response.message);
        })
        .catch((error) => {
            errors.value = error.response._data.errors;
        });
};
const updateDetallesVehiculo = () => {
    errors.value = {};
    updateFichaVehicular(ficha.value.id, ficha.value)
        .then((response: any) => {
            handleSuccess(response.message);
            if(!flagCard3.value){
                onGuardarFichaEvaluacion();
                flagCard3.value = true;
            }
        })
        .catch((error) => {
            errors.value = error.response._data.errors;
        });
};
// const reglas_inspeccion = [
//     { tipo: '1', ambito: '1', servicio: '0,2' },
//     { tipo: '2', ambito: '1-5', servicio: '1-23' },
//     { tipo: '3', ambito: '0-5', servicio: '0-23' },
//     { tipo: '4', ambito: '1', servicio: '0,2' },
//     { tipo: '5', ambito: '1-5', servicio: '1-23' }
// ];
const reglas_inspeccion = [
    { tipo: '1', ambito: '0', servicio: '0' },
    { tipo: '2', ambito: '1-5', servicio: '1-23' },
    { tipo: '3', ambito: '0-5', servicio: '0-23' },
    { tipo: '4', ambito: '0', servicio: '0' },
    { tipo: '5', ambito: '1-5', servicio: '1-23' }
];

function parseRangoFlexible(rango: string): number[] {
    const result = new Set<number>();
    rango = rango.replace(/(\d+-\d+)-/g, '$1,').replace(/-$/, '');
    const partes = rango.split(',');
    partes.forEach((parte) => {
        if (parte.includes('-')) {
            const [start, end] = parte.split('-').map(Number);
            for (let i = start; i <= end; i++) {
                result.add(i);
            }
        } else {
            result.add(Number(parte));
        }
    });

    return Array.from(result);
}

//resstructurar combos tipoambito , tipo servicios
const configurarWatchers = () => {
    if (!fichaId) {
        console.log('Configurando watchers para fichaId:', fichaId);
        console.log('hola');
        // Este watch solo se configura cuando existe fichaId
        watch(
            () => form.value.TIPINSPECCION,
            (nuevoValor) => {
                const regla = reglas_inspeccion.find((r) => r.tipo === String(nuevoValor));
                if (!regla) return;

                reglaSeleccion.value = false;

                const ambitoCodigos = parseRangoFlexible(regla.ambito);
                const servicioCodigos = parseRangoFlexible(regla.servicio);

                tipo_ambito_seleccion.value = tipos_ambito.value.filter((i) => ambitoCodigos.includes(i.codigo));
                tipo_servicio_seleccion.value = tipos_servicio.value.filter((i) => servicioCodigos.includes(i.codigo));

                form.value.TIPAMBITO = tipo_ambito_seleccion.value[0]?.codigo;
                form.value.TIPSERVICIO = tipo_servicio_seleccion.value[0]?.codigo;
            }
        );
    }
};
watch(
    () => ficha.value.TIPPOLIZA,
    (nuevoValor) => {
        //if (!nuevoValor) return;

        getAseguradoras({
            'filters[estado]': 1,
            'filters[tipo_poliza_id]': nuevoValor, // Aquí filtramos por el tipo seleccionado
            'fields[0]': 'id',
            'fields[1]': 'descripcion',
            'fields[2]': 'tipo_poliza_id'
        }).then((response: any) => {
            _aseguradoras.value = response.map((a: any) => ({
                ...a,
                codigo: String(a.codigo)
            }));
            if (!_aseguradoras.value.some((a: any) => a.id === ficha.value.ASEGURADORA)) {
                ficha.value.ASEGURADORA = '';
            }
        });
    },
    { immediate: true } // Se ejecuta también en el primer render si ya hay valor
);

onBeforeMount(() => {
    getCategoriasVehiculares({ estado: 1 }).then((response: any) => {
        categorias.value = response;
    });

    getTiposInspecciones({ estado: 1 }).then((response: any) => {
        tipos_inspeccion.value = response;
    });

    getTiposAmbitos({ estado: 1 }).then((response: any) => {
        tipos_ambito.value = response;
        tipo_ambito_seleccion.value = response;
    });

    getTiposServicios({ estado: 1 }).then((response: any) => {
        tipos_servicio.value = response;
        tipo_servicio_seleccion.value = response;
    });

    // getAseguradoras({
    //     'filters[estado]': 1,
    //     'fields[0]': 'id',
    //     'fields[1]': 'descripcion',
    //     'fields[2]': 'tipo_poliza_id'
    // }).then((response: any) => {
    //     _aseguradoras.value = response;
    // });
});
function startInactivityTimer() {
    clearTimeout(timer);
    clearTimeout(warningTimeout);

    warningTimeout = setTimeout(() => {
        handleError(' Queda 30 seg de inactividad');
    }, WARNING_TIME);

    timer = setTimeout(() => {
        router.push('/ingreso-counter');
        handleError(' Tiempo de inactividad agotado (1 minutos)');
    }, INACTIVITY_LIMIT);
}

function resetTimerOnActivity() {
    startInactivityTimer();
}

const cargarDatosIniciales = async () => {
    try {
        configurarWatchers();
    } catch (error) {
        console.error('Error al cargar datos iniciales:', error);
    }
};
const onGuardarFichaEvaluacion = () => {
    errorsInspeccion.value = {};
    console.log('guardar');
    console.log(inspeccion.value);
    if (inspeccion.value.id !== undefined) {
        console.log('UPDATE');
        //update
        updateFichaVehicularEva(inspeccion.value.id, inspeccion.value)
            .then((response: any) => {
                handleSuccess(response.message);
                inspeccion.value.value = response;
            })
            .catch((error) => {
                errorsInspeccion.value = error.response._data.errors;
            });
    } else {
        //guardar
        console.log('CREAR');
        console.log(ficha.value.id);
        inspeccion.value.ficha_vehiculo_id = ficha.value.id;
        createFichaVehicularEva(inspeccion.value)
            .then((response: any) => {
                console.log("CREADO")
                console.log(response.data)
                inspeccion.value = response.data;
                ///ficha.value.evaluacion = response.data
                console.log(inspeccion.value.value)
            })
            .catch((error) => {
                errorsInspeccion.value = error.response._data.errors;
            });
    }
};
const ejes = [1, 2, 3, 4, 5];
function calcularFrenoEstacionamiento(inspeccion: Ref<any>) {
    let totalFuerza = 0;
    let totalPeso = 0;

    for (const eje of ejes) {
        const peso = parseFloat(inspeccion.value[`FE_EJE${eje}_PESO`]) || 0;
        const der = parseFloat(inspeccion.value[`FE_EJE${eje}_FUERZA_DER`]) || 0;
        const izq = parseFloat(inspeccion.value[`FE_EJE${eje}_FUERZA_IZQ`]) || 0;

        totalPeso += peso;
        totalFuerza += der + izq;
    }

    // Cálculo de eficiencia con multiplicador de 100
    const eficiencia = totalPeso > 0 ? (totalFuerza * 100) / totalPeso : 0;
    const eficienciaLimitada = Math.min(eficiencia, 100);
    inspeccion.value.FE_EFICIENCIA_TOTAL = parseFloat(eficienciaLimitada.toFixed(2));

    // Lógica del resultado
    let resultado = 'D';
    if (eficiencia >= 16) resultado = 'A'; // Ajustado a 16% para coincidir con la tabla
    if (eficiencia === 0) resultado = 'R';

    inspeccion.value.FE_RESULTADO = resultado;
}
function calcularFrenoServicio(inspeccion: Ref<any>) {
    const ejes = [1, 2, 3, 4, 5];
    let totalFuerza = 0;
    let totalPeso = 0;

    for (const eje of ejes) {
        const peso = parseFloat(inspeccion.value[`FS_EJE${eje}_PESO`]) || 0;
        const der = parseFloat(inspeccion.value[`FS_EJE${eje}_FUERZA_DER`]) || 0;
        const izq = parseFloat(inspeccion.value[`FS_EJE${eje}_FUERZA_IZQ`]) || 0;

        if (der > 0 || izq > 0) {
            const mayor = Math.max(der, izq);
            const diferencia = Math.abs(der - izq);
            const desequilibrio = mayor > 0 ? (diferencia / mayor) * 100 : 0;
            inspeccion.value[`FS_EJE${eje}_DESEQUILIBRIO`] = desequilibrio.toFixed(2);
        } else {
            // Si no hay datos válidos, dejarlo vacío o como null
            inspeccion.value[`FS_EJE${eje}_DESEQUILIBRIO`] = null;
        }

        totalPeso += peso;
        totalFuerza += der + izq;
    }

    const eficiencia = totalPeso > 0 ? (totalFuerza * 1000) / totalPeso : 0;
    const eficienciaLimitada = Math.min(eficiencia, 100);
    inspeccion.value.FS_EFICIENCIA_TOTAL = parseFloat(eficienciaLimitada.toFixed(2));

    let resultado = 'D'; // Desaprobado por defecto
    if (eficiencia >= 50) resultado = 'A';
    if (eficiencia === 0) resultado = 'R'; // Por ejemplo, 0 podría ser Rechazado

    inspeccion.value.FS_RESULTADO = resultado;
}
function calcularFrenoEmergencia(inspeccion: Ref<any>) {
    let totalFuerza = 0;
    let totalPeso = 0;

    // Calcular el total de peso y fuerza para todos los ejes
    for (const eje of ejes) {
        const peso = parseFloat(inspeccion.value[`FEM_EJE${eje}_PESO`]) || 0;
        const der = parseFloat(inspeccion.value[`FEM_EJE${eje}_FUERZA_DER`]) || 0;
        const izq = parseFloat(inspeccion.value[`FEM_EJE${eje}_FUERZA_IZQ`]) || 0;

        totalPeso += peso;
        totalFuerza += der + izq;

        // Calcular el desequilibrio para cada eje si ambas fuerzas existen
        if (der > 0 && izq > 0) {
            const max = Math.max(der, izq);
            const min = Math.min(der, izq);
            const desequilibrio = max > 0 ? ((max - min) / max) * 100 : 0;
            inspeccion.value[`FEM_EJE${eje}_DESEQUILIBRIO`] = parseFloat(desequilibrio.toFixed(2));
        } else {
            inspeccion.value[`FEM_EJE${eje}_DESEQUILIBRIO`] = 0;
        }
    }

    // Calcular la eficiencia total
    const eficiencia = totalPeso > 0 ? (totalFuerza * 100) / totalPeso : 0;
    const eficienciaLimitada = Math.min(eficiencia, 100);
    inspeccion.value.FEM_EFICIENCIA_TOTAL = parseFloat(eficienciaLimitada.toFixed(2));

    // Determinar el resultado según la normativa para frenos de emergencia
    // Para frenos de emergencia normalmente se requiere una eficiencia mínima del 20%
    let resultado = 'D';
    if (eficiencia >= 20) resultado = 'A';
    if (eficiencia === 0) resultado = 'R';

    inspeccion.value.FEM_RESULTADO = resultado;
}
function calcularAlineamiento(inspeccion: Ref<any>) {
    for (const eje of ejes) {
        const valor = inspeccion.value[`AL_EJE${eje}_DESVIACION`];
        const desviacion = parseFloat(valor);

        let resultado = '';

        // Solo calcular si el valor ingresado es un número válido
        if (!isNaN(desviacion) && valor !== '') {
            resultado = desviacion <= 7 ? 'A' : 'D';
        }

        inspeccion.value[`AL_EJE${eje}_RESULTADO`] = resultado;
    }
}

function calcularProfundidadNeumaticos(inspeccion: Ref<any>) {
    for (const eje of ejes) {
        const valorDer = inspeccion.value[`NEU_EJE${eje}_MEDIDA_DER`];
        const valorIzq = inspeccion.value[`NEU_EJE${eje}_MEDIDA_IZQ`];

        const medidaDer = parseFloat(valorDer);
        const medidaIzq = parseFloat(valorIzq);

        let resultado = '';

        // Verificar si al menos una medida es numéricamente válida
        const derValido = !isNaN(medidaDer);
        const izqValido = !isNaN(medidaIzq);

        if (derValido || izqValido) {
            if (medidaDer >= 6 && medidaIzq >= 6) {
                resultado = 'A'; // Aprobado
            } else if (medidaDer < 1.6 || medidaIzq < 1.6) {
                resultado = 'R'; // Rechazado
            } else {
                resultado = 'D'; // Defectuoso
            }
        }

        inspeccion.value[`NEU_EJE${eje}_RESULTADO`] = resultado;
    }
}

function calcularSuspencion(inspeccion: Ref<any>) {
    const parseNumber = (value) => parseFloat(value) || 0;

    // Obtener valores como números
    const delIzq = parseNumber(inspeccion.value.SUSP_DELANTERA_IZQ);
    const delDer = parseNumber(inspeccion.value.SUSP_DELANTERA_DER);
    const postIzq = parseNumber(inspeccion.value.SUSP_POSTERIOR_IZQ);
    const postDer = parseNumber(inspeccion.value.SUSP_POSTERIOR_DER);

    // Calcular desviaciones
    const calcDesviacion = (izq, der) => {
        const suma = izq + der;
        if (suma === 0) return 0; // Evitar división por cero
        return (Math.abs(izq - der) / suma) * 100;
    };

    const desvDelantera = calcDesviacion(delIzq, delDer);
    const desvPosterior = calcDesviacion(postIzq, postDer);

    // Redondear a 2 decimales
    const redondear = (num) => Math.round(num * 100) / 100;

    // Guardar las desviaciones
    inspeccion.value.SUSP_DELANTERA_DESV = redondear(desvDelantera);
    inspeccion.value.SUSP_POSTERIOR_DESV = redondear(desvPosterior);

    // Calcular resultado final (A = Aprobado, R = Rechazado)
    const resultadoDelantera = desvDelantera <= 20 ? 'A' : 'R';
    const resultadoPosterior = desvPosterior <= 20 ? 'A' : 'R';

    // Guardar resultados individuales (corregido nombre de las propiedades)
    inspeccion.value.SUSP_DELANTERA_RESULTADO = resultadoDelantera;
    inspeccion.value.SUSP_POSTERIOR_RESULTADO = resultadoPosterior;

    // Resultado Final (si ambos son A = A; si alguno es R = R)
    inspeccion.value.SUSP_RESULTADO_FINAL = resultadoDelantera === 'A' && resultadoPosterior === 'A' ? 'A' : 'R';
}

function calcularPruebaLuces(inspeccion: Ref<any>) {
    const tiposLuces = ['BAJA', 'ALTA', 'ADICIONAL', 'NEBLINEROS'];

    for (const tipo of tiposLuces) {
        const valorDer = inspeccion.value[`LUZ_${tipo}_DER`];
        const valorIzq = inspeccion.value[`LUZ_${tipo}_IZQ`];

        // Verificamos si son enteros positivos
        const esEnteroDer = valorDer !== '' && !isNaN(valorDer) && Number.isInteger(Number(valorDer)) && Number(valorDer) > 0;
        const esEnteroIzq = valorIzq !== '' && !isNaN(valorIzq) && Number.isInteger(Number(valorIzq)) && Number(valorIzq) > 0;

        // Si ambos valores son enteros positivos
        if (esEnteroDer && esEnteroIzq) {
            inspeccion.value[`LUZ_${tipo}_RESULTADO`] = 'A'; // Aprobado
            inspeccion.value[`LUZ_${tipo}_ALINEAMIENTO`] = 'OK'; // OK
        }
        // Si solo un valor es entero positivo
        else if (esEnteroDer || esEnteroIzq) {
            inspeccion.value[`LUZ_${tipo}_RESULTADO`] = 'A'; // Aprobado
            inspeccion.value[`LUZ_${tipo}_ALINEAMIENTO`] = 'OK'; // OK
        }
        // Si hay valores pero no son enteros positivos
        else if ((valorDer !== undefined && valorDer !== '') || (valorIzq !== undefined && valorIzq !== '')) {
            inspeccion.value[`LUZ_${tipo}_RESULTADO`] = 'R'; // Rechazado
            inspeccion.value[`LUZ_${tipo}_ALINEAMIENTO`] = ''; // No OK
        }
        // Si no hay ningún valor
        else {
            inspeccion.value[`LUZ_${tipo}_RESULTADO`] = '';
            inspeccion.value[`LUZ_${tipo}_ALINEAMIENTO`] = '';
        }
    }
}

// Esta función normaliza el alineamiento para que siempre se guarde bien (OK, OKK, OKOK, OK|OK, OKK|OK, etc.)
function normalizarAlineamiento(valor: string): string {
    if (!valor) return '';

    const partes = valor.split('|').map((p) => p.trim().toUpperCase());

    // Filtra solo valores que contengan OK en cualquier forma
    const valoresValidos = partes.filter((p) => p.includes('OK'));

    // Elimina duplicados
    const unicos = [...new Set(valoresValidos)];

    return unicos.join('|');
}
function calcularEmisionesGases(inspeccion: Ref<any>) {
    const coRalenti = parseFloat(inspeccion.value.EMIS_CO_RALENTI) || 0;
    const coAceleracion = parseFloat(inspeccion.value.EMIS_CO_ACELERACION) || 0;
    const hcRalenti = parseFloat(inspeccion.value.EMIS_HC_RALENTI) || 0;
    const hcAceleracion = parseFloat(inspeccion.value.EMIS_HC_ACELERACION) || 0;

    let resultado = '';

    // Si todos los valores están por debajo o iguales a los umbrales
    if (coRalenti <= 1.0 && coAceleracion <= 1.0 && hcRalenti <= 100 && hcAceleracion <= 100) {
        resultado = 'A'; // Aprobado
    } else if (coRalenti > 2.0 || coAceleracion > 2.0 || hcRalenti > 300 || hcAceleracion > 300) {
        resultado = 'R'; // Rechazado
    } else {
        resultado = 'D'; // Deficiente
    }

    inspeccion.value.EMIS_RESULTADO = resultado;
}
function calcularEmisionesSonoras(inspeccion: Ref<any>) {
    const db = parseFloat(inspeccion.value.EMIS_SONORA_DB) || 0;
    let resultado = '';

    if (db <= 80) {
        resultado = 'A'; // Aprobado
    } else if (db > 80 && db <= 95) {
        resultado = 'D'; // Deficiente
    } else {
        resultado = 'R'; // Rechazado
    }

    inspeccion.value.EMIS_SONORA_RESULTADO = resultado;
}
watchEffect(() => {
    calcularFrenoEstacionamiento(inspeccion);
    calcularFrenoServicio(inspeccion);
    calcularFrenoEmergencia(inspeccion);
    calcularAlineamiento(inspeccion);
    calcularProfundidadNeumaticos(inspeccion);
    calcularPruebaLuces(inspeccion);
    calcularSuspencion(inspeccion);
    calcularEmisionesGases(inspeccion);
    calcularEmisionesSonoras(inspeccion);
});
onMounted(() => {
    cargarDatosIniciales();
    document.addEventListener('mousemove', resetTimerOnActivity);
    document.addEventListener('keydown', resetTimerOnActivity);
    startInactivityTimer();
});

onBeforeUnmount(() => {
    document.removeEventListener('mousemove', resetTimerOnActivity);
    document.removeEventListener('keydown', resetTimerOnActivity);
    clearTimeout(timer);
    clearTimeout(warningTimeout);
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
                        <InputText maxlength="6" placeholder="Nro. de placa" v-model="form.PLACA" class="w-full border rounded-md p-2" />
                        <small class="text-red-500" v-if="errors?.PLACA">{{ errors.PLACA[0] }}</small>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Categoría</label>
                        <Dropdown v-model="form.CATEGORIA" :disabled="ficha?.id > 0" :options="categorias" option-label="descripcion" option-value="codigo" placeholder="Seleccione" class="w-full" />
                        <small class="text-red-500" v-if="errors?.CATEGORIA">{{ errors.CATEGORIA[0] }}</small>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Tipo de Inspección</label>
                        <Dropdown v-model="form.TIPINSPECCION" :disabled="ficha?.id > 0" :options="tipos_inspeccion" option-label="descripcion" option-value="codigo" placeholder="Seleccione" class="w-full" />
                        <small class="text-red-500" v-if="errors?.TIPINSPECCION">{{ errors.TIPINSPECCION[0] }}</small>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Ámbito</label>
                        <Dropdown v-model="form.TIPAMBITO" :disabled="ficha?.id > 0 || reglaSeleccion" :options="tipo_ambito_seleccion" option-label="descripcion" option-value="codigo" placeholder="Seleccione" class="w-full" />
                        <small class="text-red-500" v-if="errors?.TIPAMBITO">{{ errors.TIPAMBITO[0] }}</small>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Tipo de Servicio</label>
                        <Dropdown v-model="form.TIPSERVICIO" :disabled="ficha?.id > 0 || reglaSeleccion" :options="tipo_servicio_seleccion" option-label="descripcion" option-value="codigo" placeholder="Seleccione" class="w-full" />
                        <small class="text-red-500" v-if="errors?.TIPSERVICIO">{{ errors.TIPSERVICIO[0] }}</small>
                    </div>

                    <div class="mb-4">
                        <label class="md:block hidden mb-1">&nbsp;</label>
                        <Button label="GENERAR" icon="ri-search-2-line" class="p-button-success w-full" @click.prevent="create()" :disabled="ficha?.id > 0" />
                    </div>
                </div>
            </template>
        </Card>

        <Card v-if="ficha?.id > 0">
            <template #title>
                <div class="flex items-center justify-between">
                    <span class="text-lg font-semibold">2. Tarjeta de propiedad y Póliza de seguro</span>
                    <Button icon="pi pi-save" label="Guardar" @click="updateDetallesVehiculo" />
                </div>
            </template>
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
                                        <small class="text-red-500" v-if="errors?.NUM_FICHA">{{ errors.NUM_FICHA[0] }}</small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-1">Placa</label>
                                        <InputText type="text" class="w-full" v-model="ficha.PLACA" />
                                        <small class="text-red-500" v-if="errors?.PLACA">{{ errors.PLACA[0] }}</small>
                                    </div>
                                </div>
                                <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-4">
                                    <div class="mb-3">
                                        <label class="block mb-1">Categoria</label>
                                        <InputText type="text" class="w-full" v-model="ficha.CATEGORIA_DESC" />
                                        <small class="text-red-500" v-if="errors?.CATEGORIA_DESC">{{ errors.CATEGORIA_DESC[0] }}</small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-1">Marca</label>
                                        <InputText type="text" class="w-full" v-model="ficha.MARCA" />
                                        <small class="text-red-500" v-if="errors?.MARCA">{{ errors.MARCA[0] }}</small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-1">Año de Fabricación</label>
                                        <InputText type="text" class="w-full" v-model="ficha.ANOFAB" />
                                        <small class="text-red-500" v-if="errors?.ANOFAB">{{ errors.ANOFAB[0] }}</small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-1">Modelo</label>
                                        <InputText type="text" class="w-full" v-model="ficha.MODELO" />
                                        <small class="text-red-500" v-if="errors?.MODELO">{{ errors.MODELO[0] }}</small>
                                    </div>
                                </div>
                                <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4">
                                    <div class="mb-3">
                                        <label class="block mb-1">Combustible</label>
                                        <InputText type="text" class="w-full" v-model="ficha.COMBUSTIBLE" />
                                        <small class="text-red-500" v-if="errors?.COMBUSTIBLE">{{ errors.COMBUSTIBLE[0] }}</small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-1">Descripción de la carrocería</label>
                                        <InputText type="text" class="w-full" v-model="ficha.CARROCERIA" />
                                        <small class="text-red-500" v-if="errors?.CARROCERIA">{{ errors.CARROCERIA[0] }}</small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-1">Número de ejes</label>
                                        <InputText type="text" class="w-full" v-model="ficha.NUMEROEJES" />
                                        <small class="text-red-500" v-if="errors?.NUMEROEJES">{{ errors.NUMEROEJES[0] }}</small>
                                    </div>
                                </div>
                                <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-4">
                                    <div class="mb-3">
                                        <label class="block mb-1">Color</label>
                                        <InputText type="text" class="w-full" v-model="ficha.COLOR" />
                                        <small class="text-red-500" v-if="errors?.COLOR">{{ errors.COLOR[0] }}</small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-1">Número de Motor</label>
                                        <InputText type="text" class="w-full" v-model="ficha.NUMEROMOTOR" />
                                        <small class="text-red-500" v-if="errors?.NUMEROMOTOR">{{ errors.NUMEROMOTOR[0] }}</small>
                                    </div>
                                </div>
                                <div class="grid lg:grid-cols-4 md-grid-cols-2 grid-cols-1 gap-4">
                                    <div class="mb-3">
                                        <label class="block mb-1">VIN/Serie Chasis</label>
                                        <InputText type="text" class="w-full" v-model="ficha.VINSERCHA" />
                                        <small class="text-red-500" v-if="errors?.VINSERCHA">{{ errors.VINSERCHA[0] }}</small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-1">Ruedas</label>
                                        <InputText type="text" class="w-full" v-model="ficha.NUMERORUEDAS" />
                                        <small class="text-red-500" v-if="errors?.NUMERORUEDAS">{{ errors.NUMERORUEDAS[0] }}</small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-1">Pasajeros</label>
                                        <InputText type="text" class="w-full" v-model="ficha.NUMEROPASAJEROS" />
                                        <small class="text-red-500" v-if="errors?.NUMEROPASAJEROS">{{ errors.NUMEROPASAJEROS[0] }}</small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="block mb-1">Asientos</label>
                                        <InputText type="text" class="w-full" v-model="ficha.NUMEROASIENTOS" />
                                        <small class="text-red-500" v-if="errors?.NUMEROASIENTOS">{{ errors.NUMEROASIENTOS[0] }}</small>
                                    </div>
                                </div>
                                <div class="grid lg:grid-cols-6 md:grid-cols-3 grid-cols-2 gap-4">
                                    <div class="col mb-3">
                                        <label class="block mb-1">Peso Neto</label>
                                        <InputText type="text" class="w-full" v-model="ficha.PESONETO" />
                                        <small class="text-red-500" v-if="errors?.PESONETO">{{ errors.PESONETO[0] }}</small>
                                    </div>
                                    <div class="col mb-3">
                                        <label class="block mb-1">Peso Bruto</label>
                                        <InputText type="text" class="w-full" v-model="ficha.PESOBRUTO" />
                                        <small class="text-red-500" v-if="errors?.PESOBRUTO">{{ errors.PESOBRUTO[0] }}</small>
                                    </div>
                                    <div class="col mb-3">
                                        <label class="block mb-1">Carga Util</label>
                                        <InputText type="text" class="w-full" v-model="ficha.PESOUTIL" />
                                        <small class="text-red-500" v-if="errors?.PESOUTIL">{{ errors.PESOUTIL[0] }}</small>
                                    </div>
                                    <div class="col mb-3">
                                        <label class="block mb-1">Longitud</label>
                                        <InputText type="text" class="w-full" v-model="ficha.LARGO" />
                                        <small class="text-red-500" v-if="errors?.LARGO">{{ errors.LARGO[0] }}</small>
                                    </div>
                                    <div class="col mb-3">
                                        <label class="block mb-1">Altura</label>
                                        <InputText type="text" class="w-full" v-model="ficha.ALTO" />
                                        <small class="text-red-500" v-if="errors?.ALTO">{{ errors.ALTO[0] }}</small>
                                    </div>
                                    <div class="col mb-3">
                                        <label class="block mb-1">Ancho</label>
                                        <InputText type="text" class="w-full" v-model="ficha.ANCHO" />
                                        <small class="text-red-500" v-if="errors?.ANCHO">{{ errors.ANCHO[0] }}</small>
                                    </div>
                                </div>
                            </div>
                        </TabPanel>
                        <TabPanel value="1">
                            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-4">
                                <div class="mb-3">
                                    <label class="block mb-1">Número de Documento</label>
                                    <InputText type="text" class="w-100" v-model="ficha.NUMDOC_ULTREV" />
                                    <small class="text-red-500" v-if="errors?.NUMDOC_ULTREV">{{ errors.NUMDOC_ULTREV[0] }}</small>
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-1">Fecha del documento</label>
                                    <InputText type="text" class="w-100" v-model="ficha.FECDOC_ULTREV" />
                                    <small class="text-red-500" v-if="errors?.FECDOC_ULTREV">{{ errors.FECDOC_ULTREV[0] }}</small>
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-1">Empresa</label>
                                    <InputText type="text" class="w-100" v-model="ficha.RAZSOCCITV_ULTREV" />
                                    <small class="text-red-500" v-if="errors?.RAZSOCCITV_ULTREV">{{ errors.RAZSOCCITV_ULTREV[0] }}</small>
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
                                    <Select class="w-full" :options="tipos_poliza" optionLabel="codigo" optionValue="id" v-model="ficha.TIPPOLIZA" placeholder="Seleccione" />
                                    <small class="text-red-500" v-if="errors?.TIPPOLIZA">{{ errors.TIPPOLIZA[0] }}</small>
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-1">Aseguradora</label>
                                    <Select class="w-full" :options="aseguradoras" filter optionLabel="descripcion" optionValue="id" v-model="ficha.ASEGURADORA" placeholder="Seleccione" />
                                    <small class="text-red-500" v-if="errors?.ASEGURADORA">{{ errors.ASEGURADORA[0] }}</small>
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-1">Número de Poliza</label>
                                    <InputText type="text" class="w-full" v-model="ficha.NUMPOLIZA" />
                                    <small class="text-red-500" v-if="errors?.NUMPOLIZA">{{ errors.NUMPOLIZA[0] }}</small>
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-1">Fecha Inicio</label>
                                    <DatePicker v-model="ficha.FECINIPOLIZA" class="w-full" ateFormat="dd/mm/yy" />
                                    <small class="text-red-500" v-if="errors?.FECINIPOLIZA">{{ errors.FECINIPOLIZA[0] }}</small>
                                </div>
                                <div class="mb-3">
                                    <label class="block mb-1">Fecha Fin</label>
                                    <DatePicker v-model="ficha.FECFINPOLIZA" class="w-full" dateFormat="dd/mm/yy" />
                                    <small class="text-red-500" v-if="errors?.FECFINPOLIZA">{{ errors.FECFINPOLIZA[0] }}</small>
                                </div>
                                <div class="mb-3">
                                    <label class="md:block hidden mb-1">&nbsp;</label>
                                    <Button label="Guardar Poliza" class="w-full" severity="primary" @click.prevent="updateFichaPoliza()" />
                                </div>
                            </div>
                        </TabPanel>
                    </TabPanels>
                </Tabs>
            </template>
        </Card>
        <div class="font-semibold text-2xl mb-4"></div>
        <Card v-if="flagCard3">
            <template #title>
                <div class="flex items-center justify-between">
                    <span class="text-lg font-semibold">3. Evaluacion Tecnica</span>
                    <Button icon="pi pi-save" label="Guardar" @click="onGuardarFichaEvaluacion" />
                </div>
            </template>
            <template #content>
                <Tabs value="0">
                    <TabList>
                        <Tab value="0">Ficha</Tab>
                        <!-- <Tab value="1">Alineamiento, Prof de Neumaticos y Prueba de Luces</Tab>
                        <Tab value="2">Pruebas de Suspencion, Emision de Gases y Emisiones sonoras</Tab> -->
                    </TabList>
                    <TabPanels>
                        <TabPanel value="0">
                            <!-- <h1 class="text-2xl font-bold text-center mb-6">Pruebas de Frenos</h1> -->
                            <div class="flex justify-between space-x-4">
                                <div class="w-1/3">
                                    <div class="service-brake-form">
                                        <div class="overflow-hidden rounded-lg shadow-sm border border-slate-200 bg-white">
                                            <table class="w-full text-sm border-collapse">
                                                <thead>
                                                    <tr>
                                                        <th colspan="7" class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-3 font-medium text-left">
                                                            <div class="flex items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                                </svg>
                                                                <span>Freno de Servicio</span>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                    <tr class="bg-slate-100">
                                                        <th class="p-3 font-medium text-slate-700 text-left border-b-2 border-slate-200">Ejes</th>
                                                        <th class="p-3 font-medium text-slate-700 text-center border-b-2 border-slate-200">Peso (Kg)</th>
                                                        <th colspan="2" class="p-3 font-medium text-slate-700 text-center border-b-2 border-slate-200">
                                                            <span class="flex justify-center gap-1 items-center"> Fuerza de Frenado (kN) </span>
                                                        </th>
                                                        <th class="p-3 font-medium text-slate-700 text-center border-b-2 border-slate-200">Deseq. (%)</th>
                                                        <th class="p-3 font-medium text-slate-700 text-center border-b-2 border-slate-200">Eficiencia (%)</th>
                                                        <th class="p-3 font-medium text-slate-700 text-center border-b-2 border-slate-200">Resultado</th>
                                                    </tr>
                                                    <tr class="bg-slate-50">
                                                        <th class="p-2 font-normal text-slate-600 text-center"></th>
                                                        <th class="p-2 font-normal text-slate-600 text-center"></th>
                                                        <th class="p-2 font-normal text-slate-600 text-center">Der.</th>
                                                        <th class="p-2 font-normal text-slate-600 text-center">Izq.</th>
                                                        <th class="p-2 font-normal text-slate-600 text-center"></th>
                                                        <th class="p-2 font-normal text-slate-600 text-center"></th>
                                                        <th class="p-2 font-normal text-slate-600 text-center"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">1</td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FS_EJE1_PESO" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                            <small class="text-red-500" v-if="errorsInspeccion?.FS_EJE1_PESO">{{ errors.FS_EJE1_PESO[0] }}</small>
                                                        </td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FS_EJE1_FUERZA_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                            <small class="text-red-500" v-if="errorsInspeccion?.FS_EJE1_FUERZA_DER">{{ errors.FS_EJE1_FUERZA_DER[0] }}</small>
                                                        </td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FS_EJE1_FUERZA_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                            <small class="text-red-500" v-if="errorsInspeccion?.FS_EJE1_FUERZA_IZQ">{{ errors.FS_EJE1_FUERZA_IZQ[0] }}</small>
                                                        </td>
                                                        <td class="border border-gray-300 p-2 ">
                                                            {{ inspeccion.FS_EJE1_DESEQUILIBRIO }}
                                                            <small class="text-red-500" v-if="errorsInspeccion?.FS_EJE1_DESEQUILIBRIO">{{ errors.FS_EJE1_DESEQUILIBRIO[0] }}</small>
                                                        </td>
                                                        <td class="border border-gray-300 p-2 align-middle text-center" :rowspan="5">{{ inspeccion.FS_EFICIENCIA_TOTAL }}</td>
                                                        <td class="border border-gray-300 p-2 align-middle text-center font-bold" :rowspan="5">{{ inspeccion.FS_RESULTADO }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">2</td>
                                                        <td class="border border-gray-300 p-2"><InputText class="w-full text-center" v-model="inspeccion.FS_EJE2_PESO" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" /></td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FS_EJE2_FUERZA_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FS_EJE2_FUERZA_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2">
                                                            {{ inspeccion.FS_EJE2_DESEQUILIBRIO }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">3</td>
                                                        <td class="border border-gray-300 p-2"><InputText class="w-full text-center" v-model="inspeccion.FS_EJE3_PESO" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" /></td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FS_EJE3_FUERZA_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FS_EJE3_FUERZA_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2">
                                                            {{ inspeccion.FS_EJE3_DESEQUILIBRIO }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">4</td>
                                                        <td class="border border-gray-300 p-2"><InputText class="w-full text-center" v-model="inspeccion.FS_EJE4_PESO" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" /></td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FS_EJE4_FUERZA_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FS_EJE4_FUERZA_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2">
                                                            {{ inspeccion.FS_EJE4_DESEQUILIBRIO }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">5</td>
                                                        <td class="border border-gray-300 p-2"><InputText class="w-full text-center" v-model="inspeccion.FS_EJE5_PESO" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" /></td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FS_EJE5_FUERZA_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FS_EJE5_FUERZA_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2">
                                                            {{ inspeccion.FS_EJE5_DESEQUILIBRIO }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-1/3">
                                    <div class="service-brake-form">
                                        <div class="overflow-x-auto rounded-lg shadow-sm">
                                            <table class="w-full text-sm border-collapse">
                                                <thead>
                                                    <tr>
                                                        <th colspan="6" class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-3 font-medium text-left">
                                                            <div class="flex items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                                </svg>
                                                                <span>Freno de Estacionamiento</span>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                    <tr class="bg-slate-100">
                                                        <th class="p-3 font-medium text-slate-700 text-left border-b-2 border-slate-200">Ejes</th>
                                                        <th class="p-3 font-medium text-slate-700 text-center border-b-2 border-slate-200">Peso (Kg)</th>
                                                        <th colspan="2" class="p-3 font-medium text-slate-700 text-center border-b-2 border-slate-200">
                                                            <span class="flex justify-center gap-1 items-center">
                                                                Fuerza de Frenado (kN)
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                            </span>
                                                        </th>
                                                        <th class="p-3 font-medium text-slate-700 text-center border-b-2 border-slate-200">Eficiencia (%)</th>
                                                        <th class="p-3 font-medium text-slate-700 text-center border-b-2 border-slate-200">Resultado</th>
                                                    </tr>
                                                    <tr class="bg-slate-50">
                                                        <th class="p-2 font-normal text-slate-600 text-center"></th>
                                                        <th class="p-2 font-normal text-slate-600 text-center"></th>
                                                        <th class="p-2 font-normal text-slate-600 text-center">Der.</th>
                                                        <th class="p-2 font-normal text-slate-600 text-center">Izq.</th>
                                                        <th class="p-2 font-normal text-slate-600 text-center"></th>
                                                        <th class="p-2 font-normal text-slate-600 text-center"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">1</td>
                                                        <td class="border border-gray-300 p-2"><InputText class="w-full text-center" v-model="inspeccion.FE_EJE1_PESO" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" /></td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FE_EJE1_FUERZA_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FE_EJE1_FUERZA_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2 align-middle text-center" :rowspan="5">{{ inspeccion.FE_EFICIENCIA_TOTAL }}</td>
                                                        <td class="border border-gray-300 p-2 align-middle text-center font-bold" :rowspan="5">{{ inspeccion.FE_RESULTADO }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">2</td>
                                                        <td class="border border-gray-300 p-2"><InputText class="w-full text-center" v-model="inspeccion.FE_EJE2_PESO" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" /></td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FE_EJE2_FUERZA_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FE_EJE2_FUERZA_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">3</td>
                                                        <td class="border border-gray-300 p-2"><InputText class="w-full text-center" v-model="inspeccion.FE_EJE3_PESO" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" /></td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FE_EJE3_FUERZA_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FE_EJE3_FUERZA_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">4</td>
                                                        <td class="border border-gray-300 p-2"><InputText class="w-full text-center" v-model="inspeccion.FE_EJE4_PESO" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" /></td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FE_EJE4_FUERZA_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FE_EJE4_FUERZA_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">5</td>
                                                        <td class="border border-gray-300 p-2"><InputText class="w-full text-center" v-model="inspeccion.FE_EJE5_PESO" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" /></td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FE_EJE5_FUERZA_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FE_EJE5_FUERZA_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-1/3">
                                    <div class="service-brake-form">
                                        <div class="overflow-x-auto rounded-lg shadow-sm">
                                            <table class="w-full text-sm border-collapse">
                                                <thead>
                                                    <tr>
                                                        <th colspan="7" class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-3 font-medium text-left">
                                                            <div class="flex items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                                </svg>
                                                                <span>Freno de Emergencia</span>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                    <tr class="bg-slate-100">
                                                        <th class="p-3 font-medium text-slate-700 text-left border-b-2 border-slate-200">Ejes</th>
                                                        <th class="p-3 font-medium text-slate-700 text-center border-b-2 border-slate-200">Peso (Kg)</th>
                                                        <th colspan="2" class="p-3 font-medium text-slate-700 text-center border-b-2 border-slate-200">
                                                            <span class="flex justify-center gap-1 items-center">
                                                                Fuerza de Frenado (kN)
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                            </span>
                                                        </th>

                                                        <th class="p-3 font-medium text-slate-700 text-center border-b-2 border-slate-200">Eficiencia (%)</th>
                                                        <th class="p-3 font-medium text-slate-700 text-center border-b-2 border-slate-200">Resultado</th>
                                                    </tr>
                                                    <tr class="bg-slate-50">
                                                        <th class="p-2 font-normal text-slate-600 text-center"></th>
                                                        <th class="p-2 font-normal text-slate-600 text-center"></th>
                                                        <th class="p-2 font-normal text-slate-600 text-center">Der.</th>
                                                        <th class="p-2 font-normal text-slate-600 text-center">Izq.</th>
                                                        <th class="p-2 font-normal text-slate-600 text-center"></th>
                                                        <th class="p-2 font-normal text-slate-600 text-center"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">1</td>
                                                        <td class="border border-gray-300 p-2"><InputText class="w-full text-center" v-model="inspeccion.FEM_EJE1_PESO" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" /></td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FEM_EJE1_FUERZA_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FEM_EJE1_FUERZA_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2 align-middle text-center" :rowspan="5">{{ inspeccion.FEM_EFICIENCIA_TOTAL }}</td>
                                                        <td class="border border-gray-300 p-2 align-middle text-center font-bold" :rowspan="5">{{ inspeccion.FEM_RESULTADO }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">2</td>
                                                        <td class="border border-gray-300 p-2"><InputText class="w-full text-center" v-model="inspeccion.FEM_EJE2_PESO" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" /></td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FEM_EJE2_FUERZA_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FEM_EJE2_FUERZA_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">3</td>
                                                        <td class="border border-gray-300 p-2"><InputText class="w-full text-center" v-model="inspeccion.FEM_EJE3_PESO" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" /></td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FEM_EJE3_FUERZA_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FEM_EJE3_FUERZA_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">4</td>
                                                        <td class="border border-gray-300 p-2"><InputText class="w-full text-center" v-model="inspeccion.FEM_EJE4_PESO" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" /></td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FEM_EJE4_FUERZA_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FEM_EJE4_FUERZA_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">5</td>
                                                        <td class="border border-gray-300 p-2"><InputText class="w-full text-center" v-model="inspeccion.FEM_EJE5_PESO" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" /></td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FEM_EJE5_FUERZA_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.FEM_EJE5_FUERZA_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h1 class="text-2xl font-bold text-center mb-6"></h1>
                            <div class="flex justify-between space-x-4">
                                <div class="w-1/3">
                                    <div class="service-brake-form">
                                        <div class="overflow-x-auto rounded-lg shadow-sm">
                                            <table class="w-full text-sm border-collapse">
                                                <thead>
                                                    <tr>
                                                        <th colspan="3" class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-3 font-medium text-left">
                                                            <div class="flex items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                                </svg>
                                                                <span>PRUEBA DE ALINEAMIENTO</span>
                                                            </div>
                                                        </th>
                                                        <th colspan="3" class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-3 font-medium text-left">
                                                            <div class="flex items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                                </svg>
                                                                <span>PROF. DE NEUMÁTICOS</span>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                    <tr class="bg-slate-50">
                                                        <th style="height: 77px" class="border-b border-slate-200 p-2 font-normal text-slate-600 text-center">Ejes</th>
                                                        <th style="height: 77px" class="border-b border-slate-200 p-2 font-normal text-slate-600 text-center">Desviación (m/km)</th>
                                                        <th style="height: 77px" class="border-b border-slate-200 p-2 font-normal text-slate-600 text-center">Resultado</th>
                                                        <th style="height: 77px" class="border-b border-slate-200 p-2 font-normal text-slate-600 text-center">Ejes</th>
                                                        <th style="height: 77px" class="border-b border-slate-200 p-2 font-normal text-slate-600 text-center">Medida Obtenida (mm)</th>
                                                        <th style="height: 77px" class="border-b border-slate-200 p-2 font-normal text-slate-600 text-center">Resultado</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">1°</td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.AL_EJE1_DESVIACION" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2 text-center  font-bold    ">{{ inspeccion.AL_EJE1_RESULTADO }}</td>
                                                        <td class="border border-gray-300 p-2 text-center">1°</td>
                                                        <td class="border border-gray-300 p-2">
                                                            <div class="flex gap-2">
                                                                <InputText class="w-full text-center" v-model="inspeccion.NEU_EJE1_MEDIDA_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                                <InputText class="w-full text-center" v-model="inspeccion.NEU_EJE1_MEDIDA_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                            </div>
                                                        </td>
                                                        <td class="border border-gray-300 p-2 text-center font-bold">{{ inspeccion.NEU_EJE1_RESULTADO }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">2°</td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.AL_EJE2_DESVIACION" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2 text-center  font-bold">{{ inspeccion.AL_EJE2_RESULTADO }}</td>
                                                        <td class="border border-gray-300 p-2 text-center">2°</td>
                                                        <td class="border border-gray-300 p-2">
                                                            <div class="flex gap-2">
                                                                <InputText class="w-full text-center" v-model="inspeccion.NEU_EJE2_MEDIDA_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                                <InputText class="w-full text-center" v-model="inspeccion.NEU_EJE2_MEDIDA_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                            </div>
                                                        </td>
                                                        <td class="border border-gray-300 p-2 text-center  font-bold">{{ inspeccion.NEU_EJE2_RESULTADO }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">3°</td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.AL_EJE3_DESVIACION" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2 text-center  font-bold">{{ inspeccion.AL_EJE3_RESULTADO }}</td>
                                                        <td class="border border-gray-300 p-2 text-center">3°</td>
                                                        <td class="border border-gray-300 p-2">
                                                            <div class="flex gap-2">
                                                                <InputText class="w-full text-center" v-model="inspeccion.NEU_EJE3_MEDIDA_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                                <InputText class="w-full text-center" v-model="inspeccion.NEU_EJE3_MEDIDA_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                            </div>
                                                        </td>
                                                        <td class="border border-gray-300 p-2 text-center  font-bold">{{ inspeccion.NEU_EJE3_RESULTADO }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">4°</td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.AL_EJE4_DESVIACION" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2 text-center  font-bold">{{ inspeccion.AL_EJE4_RESULTADO }}</td>
                                                        <td class="border border-gray-300 p-2 text-center">4°</td>
                                                        <td class="border border-gray-300 p-2">
                                                            <div class="flex gap-2">
                                                                <InputText class="w-full text-center" v-model="inspeccion.NEU_EJE4_MEDIDA_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                                <InputText class="w-full text-center" v-model="inspeccion.NEU_EJE4_MEDIDA_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                            </div>
                                                        </td>
                                                        <td class="border border-gray-300 p-2 text-center  font-bold">{{ inspeccion.NEU_EJE4_RESULTADO }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">5°</td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.AL_EJE5_DESVIACION" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2 text-center  font-bold">{{ inspeccion.AL_EJE5_RESULTADO }}</td>
                                                        <td class="border border-gray-300 p-2 text-center">5°</td>
                                                        <td class="border border-gray-300 p-2">
                                                            <div class="flex gap-2">
                                                                <InputText class="w-full text-center" v-model="inspeccion.NEU_EJE5_MEDIDA_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                                <InputText class="w-full text-center" v-model="inspeccion.NEU_EJE5_MEDIDA_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                            </div>
                                                        </td>
                                                        <td class="border border-gray-300 p-2 text-center  font-bold">{{ inspeccion.NEU_EJE5_RESULTADO }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-1/3">
                                    <div class="service-brake-form">
                                        <div class="overflow-x-auto rounded-lg shadow-sm">
                                            <table class="w-full text-sm border-collapse">
                                                <thead>
                                                    <tr>
                                                        <th colspan="5" class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-3 font-medium text-left">
                                                            <div class="flex items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                                </svg>
                                                                <span>Pruebas de Luces</span>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                    <tr class="bg-slate-100">
                                                        <th class="p-3 font-medium text-slate-700 text-left border-b-2 border-slate-200">Tipo de Luz</th>
                                                        <th colspan="2" class="p-3 font-medium text-slate-700 text-center border-b-2 border-slate-200">
                                                            <span class="flex justify-center gap-1 items-center"> Medida Obtenida (Lux o C) </span>
                                                        </th>
                                                        <th class="p-3 font-medium text-slate-700 text-center border-b-2 border-slate-200">Alineamiento</th>
                                                        <th class="p-3 font-medium text-slate-700 text-center border-b-2 border-slate-200">Resultado</th>
                                                    </tr>
                                                    <tr class="bg-slate-50">
                                                        <th class="p-2 font-normal text-slate-600 text-center"></th>
                                                        <th class="p-2 font-normal text-slate-600 text-center">Izq.</th>
                                                        <th class="p-2 font-normal text-slate-600 text-center">Der.</th>
                                                        <th class="p-2 font-normal text-slate-600 text-center"></th>
                                                        <th class="p-2 font-normal text-slate-600 text-center"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">Bajas</td>
                                                        <td class="border border-gray-300 p-2"><InputText class="w-full text-center" v-model="inspeccion.LUZ_BAJA_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" /></td>
                                                        <td class="border border-gray-300 p-2"><InputText class="w-full text-center" v-model="inspeccion.LUZ_BAJA_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" /></td>
                                                        <td class="border border-gray-300 p-2 text-center font-bold">{{ inspeccion.LUZ_BAJA_ALINEAMIENTO }}</td>
                                                        <td class="border border-gray-300 p-2  text-center font-bold">{{ inspeccion.LUZ_BAJA_RESULTADO }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">Altas</td>
                                                        <td class="border border-gray-300 p-2"><InputText class="w-full text-center" v-model="inspeccion.LUZ_ALTA_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" /></td>
                                                        <td class="border border-gray-300 p-2"><InputText class="w-full text-center" v-model="inspeccion.LUZ_ALTA_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" /></td>
                                                        <td class="border border-gray-300 p-2  text-center font-bold">{{ inspeccion.LUZ_ALTA_ALINEAMIENTO }}</td>
                                                        <td class="border border-gray-300 p-2  text-center font-bold">{{ inspeccion.LUZ_ALTA_RESULTADO }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">Alta Adicional</td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.LUZ_ADICIONAL_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.LUZ_ADICIONAL_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2  text-center font-bold">{{ inspeccion.LUZ_ADICIONAL_ALINEAMIENTO }}</td>
                                                        <td class="border border-gray-300 p-2  text-center font-bold">{{ inspeccion.LUZ_ADICIONAL_RESULTADO }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">Neblineros</td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.LUZ_NEBLINEROS_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.LUZ_NEBLINEROS_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2  text-center font-bold">{{ inspeccion.LUZ_NEBLINEROS_ALINEAMIENTO }}</td>
                                                        <td class="border border-gray-300 p-2  text-center font-bold">{{ inspeccion.LUZ_NEBLINEROS_RESULTADO }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center" colspan="5">(1): Indicar la desviacion de la luz a la IZQ - / DER + / INF - / SUP+</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-1/3">
                                    <div class="service-brake-form">
                                        <div class="overflow-x-auto rounded-lg shadow-sm">
                                            <table class="w-full text-sm border-collapse">
                                                <thead>
                                                    <tr>
                                                        <th colspan="4" class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-3 font-medium text-left">
                                                            <div class="flex items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                                </svg>
                                                                <span>Pruebas de Suspensión</span>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                    <tr class="bg-slate-100">
                                                        <th colspan="2" style="height: 90px" class="text-center border-b-2 border-slate-200 p-3 font-medium text-slate-700">
                                                            Delantera <br />
                                                            (%)
                                                        </th>
                                                        <th colspan="2" style="height: 90px" class="text-center border-b-2 border-slate-200 p-3 font-medium text-slate-700">
                                                            Posterior <br />
                                                            (%)
                                                        </th>
                                                    </tr>
                                                    <tr class="bg-slate-50">
                                                        <th class="p-2 font-normal text-slate-600 text-center border-b border-slate-200 w-1/4">Lado</th>
                                                        <th class="p-2 font-normal text-slate-600 text-center border-b border-slate-200 w-1/4">Valor</th>
                                                        <th class="p-2 font-normal text-slate-600 text-center border-b border-slate-200 w-1/4">Lado</th>
                                                        <th class="p-2 font-normal text-slate-600 text-center border-b border-slate-200 w-1/4">Valor</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">Izq.</td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.SUSP_DELANTERA_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2 text-center">Izq.</td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.SUSP_POSTERIOR_IZQ" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">Der.</td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.SUSP_DELANTERA_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2 text-center">Der.</td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.SUSP_POSTERIOR_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">Desv.</td>
                                                        <td class="border border-gray-300 p-2 text-center">{{ inspeccion.SUSP_DELANTERA_DESV }}</td>
                                                        <td class="border border-gray-300 p-2 text-center">Desv.</td>
                                                        <td class="border border-gray-300 p-2 text-center">{{ inspeccion.SUSP_POSTERIOR_DESV }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">Resultado</td>
                                                        <td class="border border-gray-300 p-2  text-center font-bold">
                                                            {{ inspeccion.SUSP_DELANTERA_RESULTADO }}
                                                        </td>
                                                        <td class="border border-gray-300 p-2 text-center">Resultado</td>
                                                        <td class="border border-gray-300 p-2  text-center font-bold">
                                                            {{ inspeccion.SUSP_POSTERIOR_RESULTADO }}
                                                        </td>
                                                    </tr>
                                                    <tr class="bg-gray-50 font-semibold">
                                                        <td colspan="2" class="border border-gray-300 p-2  text-center font-bold">Resultado Final</td>
                                                        <td colspan="2" class="border border-gray-300 p-2  text-center font-bold ">{{ inspeccion.SUSP_RESULTADO_FINAL }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h1 class="text-2xl font-bold text-center mb-6"></h1>
                            <div class="flex justify-between items-stretch space-x-4">
                                <!-- Tabla de Emisiones de Gases (66%) -->
                                <div class="w-2/3">
                                    <div class="service-brake-form h-full">
                                        <div class="overflow-x-auto rounded h-full border border-gray-300">
                                            <table class="w-full text-xs h-full">
                                                <thead></thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center align-top border border-gray-300" rowspan="5">
                                                            <div class="h-full flex items-center justify-center bg-gradient-to-r from-blue-600 to-blue-800 text-white p-3 font-medium text-left">EMISION DE GASES</div>
                                                        </td>
                                                        <td class="border border-gray-300 p-2 text-center">Temp. Aceite (C°)</td>
                                                        <td class="border border-gray-300 p-2">
                                                            <div style="display: flex; justify-content: center; align-items: center; height: 100%">
                                                                <InputText class="w-2/5 text-center" v-model="inspeccion.EMIS_TEMP_ACEITE" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                                <span style="margin: 0 10px; text-align: center">/</span>
                                                                <InputText class="w-2/5 text-center" v-model="inspeccion.EMIS_TEMP_ACEITE_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                            </div>
                                                        </td>
                                                        <td class="border border-gray-300 p-2 text-center">CO Ralenti (%)</td>
                                                        <td class="border border-gray-300 p-2"><InputText class="w-full text-center" v-model="inspeccion.EMIS_CO_RALENTI" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" /></td>
                                                        <td class="border border-gray-300 p-2 text-center">CO Acel (%)</td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.EMIS_CO_ACELERACION" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2  text-center font-bold w-20" >Resultado</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">RPM</td>
                                                        <td class="border border-gray-300 p-2">
                                                            <div style="display: flex; justify-content: center; align-items: center; height: 100%">
                                                                <InputText class="w-2/5 text-center" v-model="inspeccion.EMIS_RPM" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                                <span style="margin: 0 10px; text-align: center">/</span>
                                                                <InputText class="w-2/5 text-center" v-model="inspeccion.EMIS_RPM_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                            </div>
                                                        </td>
                                                        <td class="border border-gray-300 p-2 text-center">CO + CO₂ Ralenti (%)</td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.EMIS_CO2_RALENTI" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2 text-center">CO + CO₂ Acel (%)</td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.EMIS_CO2_ACELERACION" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2  text-center font-bold w-20" rowspan="3">{{ inspeccion.EMIS_RESULTADO }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center">Opacidad (m¹)</td>
                                                        <td class="border border-gray-300 p-2">
                                                            <div style="display: flex; justify-content: center; align-items: center; height: 100%">
                                                                <InputText class="w-2/5 text-center" v-model="inspeccion.EMIS_OPACIDAD" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                                <span style="margin: 0 10px; text-align: center">/</span>
                                                                <InputText class="w-2/5 text-center" v-model="inspeccion.EMIS_OPACIDAD_DER" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                            </div>
                                                        </td>

                                                        <td class="border border-gray-300 p-2 text-center">HC Ralenti (ppm)</td>
                                                        <td class="border border-gray-300 p-2"><InputText class="w-full text-center" v-model="inspeccion.EMIS_HC_RALENTI" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" /></td>
                                                        <td class="border border-gray-300 p-2 text-center">HC Acel (ppm)</td>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.EMIS_HC_ACELERACION" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <!-- Puedes agregar una fila vacía si necesitas alinear alturas con precisión -->
                                                        <td colspan="6" class="border border-gray-300 p-2"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tabla de Emisiones Sonoras (33%) -->
                                <div class="w-1/3">
                                    <div class="service-brake-form h-full">
                                        <div class="overflow-x-auto rounded h-full border border-gray-300">
                                            <table class="w-full text-xs h-full">
                                                <thead></thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2 text-center align-middle bg-gradient-to-r from-blue-600 to-blue-800 text-white p-3 font-medium text-left" rowspan="2">EMISIONES SONORAS</td>
                                                        <td class="border border-gray-300 p-2  text-center font-bold">Sonómetro (dB)</td>
                                                        <td class="border border-gray-300 p-2  text-center font-bold">Resultado</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-300 p-2">
                                                            <InputText class="w-full text-center" v-model="inspeccion.EMIS_SONORA_DB" v-keyfilter="{ pattern: /^(\d{0,8})(\.\d{0,2})?$/, validateOnly: true }" />
                                                        </td>
                                                        <td class="border border-gray-300 p-2  text-center font-bold">
                                                            {{ inspeccion.EMIS_SONORA_RESULTADO }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </TabPanel>
                        <TabPanel value="1"> </TabPanel>
                        <TabPanel value="2"> </TabPanel>
                    </TabPanels>
                </Tabs>
            </template>
        </Card>
    </div>
</template>
