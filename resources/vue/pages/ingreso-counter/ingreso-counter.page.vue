<template>
    <div class="pt-lg-2">
        <h4 class="page-title mb-3">Ingreso al Counter</h4>
    </div>

    <div class="row row-cols-md-auto gx-2 align-items-end">
        <div class="col-12 mb-3">
            <a class="btn btn-primary" href="/nueva-ficha"><i class="ri-car-line"></i> Registrar Vehiculo</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive mb-3">
                    <table class="table table-hover table-sm mb-0 align-middle">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th>#Ing. Counter</th>
                                <th>Propietario</th>
                                <th>Placa</th>
                                <th>Fec.Ing.</th>
                                <th>Fec.Ter.</th>
                                <th>Tipo Insp.</th>
                                <th># Cert</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="ficha in fichas" :key="'row_'+ficha.id">
                                <td>{{ ficha.NUM_FICHA }}</td>
                                <td>..</td>
                                <td>{{ ficha.PLACA }}</td>
                                <td>{{  ficha.created_at }}</td>
                                <td>-</td>
                                <td>{{ ficha.tipo_inspeccion.descripcion }}</td>  
                                <td>...</td>
                                <td>...</td>
                            </tr>

                            <tr v-if="!loading && fichas.length < 1">
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
</template>
<script>
import Paginator from '@/components/Paginator.vue';
import FichaVehicularService from '@/services/ficha-vehicular.service';


import {dateFormat} from '@/filters/date-format.filter.js';

export default {
    components: {
        Paginator,
    },
    data(){
        return {
            frmSearch: {
                page: 1,
                per_page: 10,
                term: ''
            },
            loading: false,
            fichas: [],
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
            this.fichas = [];
            FichaVehicularService.get({'wheres':this.frmSearch, 'withs':['sucursal:id,nombre,codigo_local','tipo_inspeccion:codigo,descripcion']})
                .then(data=>{
                    this.fichas = data.data.map(ficha=>{
                        ficha.created_at = dateFormat(ficha.created_at, 'DD/MM/YYYY hh:mm A');
                        return ficha;
                    });
                    this.total = data.total;
                })
                .finally(()=>this.loading = false);
        },
        openForm(ficha=null){
            this.$refs.operacionForm.init(ficha);
            $('#operacionModal').modal('show');
        },
        updateState(ficha){
            FichaVehicularService.updateState(ficha.id)
                .then((res)=>this.$alert(res.message,'Éxito','success'));
        }
    }
}
</script>