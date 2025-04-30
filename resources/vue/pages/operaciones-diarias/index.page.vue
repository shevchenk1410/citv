<template>
    <div class="pt-lg-2">
        <h4 class="page-title mb-3">Operaciones Diarias</h4>
    </div>

    <div class="row row-cols-md-auto gx-2 align-items-end">
        <div class="col-12 mb-3">
            <button class="btn btn-primary" @click.prevent="openForm()">+ Aperturar</button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive mb-3">
                    <table class="table table-hover table-sm mb-0 align-middle">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th>Fecha</th>
                                <th>Sucursal</th>
                                <th>Cod. Inicio Operación</th>
                                <th class="text-center">Apertura</th>
                                <th class="text-center">Cierre</th>
                                <th class="text-end">Nro.Trans. Exitosas</th>
                                <th class="text-end">Nro.Cert. Generados</th>
                                <th class="text-end">Nro.Inf. Generados</th>
                                <th class="text-end">Nro.Anul. Realizadas</th>
                                <th class="text-center" style="width:200px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="operacion in operaciones_diarias" :key="'row_'+operacion.id">
                                <td>{{ operacion.fecha }}</td>
                                <td>{{ operacion.sucursal.nombre }}</td>
                                <td >{{ operacion.CIOD_CITV }}</td>
                                <td class="text-center">{{ operacion.hora_inicio }}</td>
                                <td class="text-center">{{ operacion.hora_fin }}</td>
                                <td class="text-end">{{ operacion.NUMTRADIA }}</td>
                                <td class="text-end">{{ operacion.NUMCERTI }}</td>
                                <td class="text-end">{{ operacion.NUMINFOR }}</td>
                                <td class="text-end">{{ operacion.NUMANUL }}</td>
                                <td class="text-center">
                                    <!--<button class="btn btn-primary btn-sm" @click.prevent="openForm(operacion)"><i class="ri-edit-line"></i></button>-->
                                </td>
                            </tr>

                            <tr v-if="!loading && operaciones_diarias.length < 1">
                                <td colspan="10" class="text-center"><i class="ri-information-line"></i> Sin registros</td>
                            </tr>
                            <tr v-if="loading">
                                <td colspan="10" class="text-center">Cargando...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="px-3">
                    <Paginator v-model="frmSearch.page" :perPage="frmSearch.per_page" :total="total" @update:modelValue="get($event)"></Paginator>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="operacionModal" tabindex="-1" aria-labelledby="operacionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <Form ref="operacionForm" @saved="get"></Form>
        </div>
    </div>
</template>
<script>
import Paginator from '@/components/Paginator.vue';
import OperacionDiariaService from '@/services/operacion-diaria.service';
import Form from './components/Form.vue';

import {dateFormat} from '@/filters/date-format.filter.js';

export default {
    components: {
        Paginator,
        Form
    },
    data(){
        return {
            frmSearch: {
                page: 1,
                per_page: 10,
                term: ''
            },
            loading: false,
            operaciones_diarias: [],
            total: 0
        }
    },
    created(){
        this.get();
    },
    methods: {
        get(page=1){
            this.frmSearch.page = page;
            this.loading = true;
            this.operaciones_diarias = [];
            OperacionDiariaService.get({'wheres':this.frmSearch, 'withs':['sucursal:id,nombre,codigo_local']})
                .then(data=>{
                    this.operaciones_diarias = data.data.map(operacion=>{
                        operacion.fecha = dateFormat(operacion.fecha, 'DD/MM/YYYY');
                        operacion.hora_inicio = dateFormat(operacion.fecha + ' ' + operacion.hora_inicio, 'hh:mm A');
                        operacion.hora_fin = operacion.hora_fin ? dateFormat(operacion.fecha + ' ' + operacion.hora_fin, 'hh:mm A') : '-';
                        return operacion;
                    });
                    this.total = data.total;
                })
                .finally(()=>this.loading = false);
        },
        openForm(operacion=null){
            this.$refs.operacionForm.init(operacion);
            $('#operacionModal').modal('show');
        },
        updateState(operacion){
            OperacionDiariaService.updateState(operacion.id)
                .then((res)=>this.$alert(res.message,'Éxito','success'));
        }
    }
}
</script>