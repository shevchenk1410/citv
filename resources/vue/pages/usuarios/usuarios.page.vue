<template>
    <div class="pt-lg-2">
        <h4 class="page-title mb-3">Registro de Usuarios</h4>
    </div>

    <div class="row row-cols-md-auto gx-2 align-items-end">
        <div class="col-auto mb-3">
            <label for="input-fecha">Buscar Usuario</label>
            <div class="input-group" style="width: 300px">
                <input type="text" class="form-control" placeholder="Buscar por DNI, nombres, apellidos..." v-model="frmSearch.term" @keydown.enter="get(1)">
            </div>
        </div>
        <div class="col-12 mb-3">
            <button class="btn btn-primary" @click.prevent="openForm()">+ Usuario</button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive mb-3">
                    <table class="table table-hover table-sm mb-0 align-middle">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th>DNI</th>
                                <th>Nombres y Apellidos</th>
                                <th>Rol</th>
                                <th>Sucursal</th>
                                <th>E-mail</th>
                                <th>Teléfono</th>
                                <th class="text-center">Fec. Registro</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center" style="width:200px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="usuario in usuarios" :key="'row_'+usuario.id">
                                <td>{{ usuario.dni }}</td>
                                <td>{{ usuario.nombres }} {{ usuario.apellidos }}</td>
                                <td >{{ usuario?.rol?.nombre ?? '-' }}</td>
                                <td >{{ usuario?.sucursal?.nombre ?? 'Sin sucursal' }}</td>
                                <td>{{ usuario.email }}</td>
                                <td>{{ usuario.telefono }}</td>
                                <td class="text-center">{{ usuario.created_at }}</td>
                                <td class="text-center">
                                    <div class="form-check form-switch d-inline">
                                        <input class="form-check-input" type="checkbox" role="switch" :id="'chkUsuario'+usuario.id" true-value="1" false-value="0" v-model="usuario.estado" @change="updateState(usuario)">
                                        <label class="form-check-label" for="chkUsuario{{usuario.id}}">&nbsp;</label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-primary btn-sm" @click.prevent="openForm(usuario)"><i class="ri-edit-line"></i></button>
                                </td>
                            </tr>

                            <tr v-if="!loading && usuarios.length < 1">
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


    <div class="modal fade" id="usuarioModal" tabindex="-1" aria-labelledby="usuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <UsuarioForm ref="usuarioForm" @saved="get" />
        </div>
    </div>
</template>
<script>
import Paginator from '@/components/Paginator.vue';
import RolService from '@/services/rol.service';
import UsuarioService from '@/services/usuario.service';
import UsuarioForm from './components/UsuarioForm.vue';

import {dateFormat} from '@/filters/date-format.filter.js';

export default {
    components: {
        Paginator,
        UsuarioForm
    },
    data(){
        return {
            frmSearch: {
                page: 1,
                per_page: 10,
                term: ''
            },
            loading: false,
            usuarios: [],
            total: 0
        }
    },
    created(){
        this.get();
        this.getRoles();
    },
    methods: {
        get(page=1){
            this.frmSearch.page = page;
            this.loading = true;
            this.usuarios = [];
            UsuarioService.get({'wheres':this.frmSearch, 'withs':['rol:id,nombre','sucursal:id,nombre']})
                .then(data=>{
                    this.usuarios = data.data.map(usuario=>{
                        usuario.created_at = dateFormat(usuario.created_at, 'DD/MM/YYYY');
                        return usuario;
                    });
                    this.total = data.total;
                })
                .finally(()=>this.loading = false);
        },
        getRoles(){
            RolService.get({'wheres':{'estado':1}, 'fields':['id','nombre']})
                .then(data=>this.roles = data);
        },
        openForm(usuario=null){
            this.$refs.usuarioForm.init(usuario);
            $('#usuarioModal').modal('show');
        },
        updateState(usuario){
            UsuarioService.updateState(usuario.id)
                .then((res)=>this.$alert(res.message,'Éxito','success'));
        }
    }
}
</script>