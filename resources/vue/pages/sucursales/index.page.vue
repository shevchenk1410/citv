<template>
    <div class="pt-lg-2">
        <h4 class="page-title mb-3">Registro de Sucursales</h4>
    </div>

    <div class="row row-cols-md-auto gx-2 align-items-end">
        <div class="col-auto mb-3">
            <label for="input-fecha">Buscar Sucursal</label>
            <div class="input-group" style="width: 300px">
                <input type="text" class="form-control" placeholder="Buscar por nombre, direccion, telefono, email, codigo de local" v-model="frmSearch.term" @keydown.enter="get(1)">
            </div>
        </div>
        <div class="col-12 mb-3">
            <button class="btn btn-primary" @click.prevent="openForm()">+ Sucursal</button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive mb-3">
                    <table class="table table-hover table-sm mb-0 align-middle">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th>Cod. Local</th>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>E-mail</th>
                                <th>Teléfono</th>
                                <th class="text-center">Fec. Registro</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center" style="width:200px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="sucursal in sucursales" :key="'row_'+sucursal.id">
                                <td>{{ sucursal.codigo_local }}</td>
                                <td>{{ sucursal.nombre }}</td>
                                <td >{{ sucursal.direccion }}</td>
                                <td>{{ sucursal.email }}</td>
                                <td>{{ sucursal.telefono }}</td>
                                <td class="text-center">{{ sucursal.created_at }}</td>
                                <td class="text-center">
                                    <div class="form-check form-switch d-inline">
                                        <input class="form-check-input" type="checkbox" role="switch" :id="'chkUsuario'+sucursal.id" true-value="1" false-value="0" v-model="sucursal.estado" @change="updateState(sucursal)">
                                        <label class="form-check-label" for="chkUsuario{{sucursal.id}}">&nbsp;</label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-primary btn-sm" @click.prevent="openForm(sucursal)"><i class="ri-edit-line"></i></button>
                                </td>
                            </tr>

                            <tr v-if="!loading && sucursales.length < 1">
                                <td colspan="8" class="text-center"><i class="ri-information-line"></i> Sin registros</td>
                            </tr>
                            <tr v-if="loading">
                                <td colspan="8" class="text-center">Cargando...</td>
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


    <div class="modal fade" id="sucursalModal" tabindex="-1" aria-labelledby="sucursalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <Form ref="sucursalForm" @saved="get" />
        </div>
    </div>
</template>
<script>
import Paginator from '@/components/Paginator.vue';
import RolService from '@/services/rol.service';
import SucursalService from '@/services/sucursal.service';
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
            sucursales: [],
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
            this.sucursales = [];
            SucursalService.get({'wheres':this.frmSearch})
                .then(data=>{
                    this.sucursales = data.data.map(sucursal=>{
                        sucursal.created_at = dateFormat(sucursal.created_at, 'DD/MM/YYYY');
                        return sucursal;
                    });
                    this.total = data.total;
                })
                .finally(()=>this.loading = false);
        },
        openForm(sucursal=null){
            this.$refs.sucursalForm.init(sucursal);
            $('#sucursalModal').modal('show');
        },
        updateState(sucursal){
            SucursalService.updateState(sucursal.id)
                .then((res)=>this.$alert(res.message,'Éxito','success'));
        }
    }
}
</script>