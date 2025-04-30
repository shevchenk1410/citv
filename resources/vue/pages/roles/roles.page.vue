<template>
    <div class="pt-lg-2">
        <h4 class="page-title mb-3">Registro de Roles</h4>
    </div>

    <div class="row row-cols-md-auto gx-2 align-items-end">
        <div class="col-auto mb-3">
            <label for="input-fecha">Buscar rol</label>
            <div class="input-group" style="width: 300px">
                <input type="text" class="form-control" placeholder="Buscar por nombres..." v-model="frmSearch.term" @keydown.enter="get(1)">
            </div>
        </div>
        <div class="col-12 mb-3">
            <button class="btn btn-primary" @click.prevent="openForm()">+ Rol</button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive mb-3">
                    <table class="table table-hover table-sm mb-0 align-middle">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th>Nombre</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center" style="width:200px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="rol in roles" :key="'row_'+rol.id">
                                <td>{{ rol.nombre }}</td>
                                <td class="text-center">
                                    <div class="form-check form-switch d-inline">
                                        <input class="form-check-input" type="checkbox" role="switch" :id="'chkRol'+rol.id" true-value="1" false-value="0" v-model="rol.estado" @change="updateState(rol)">
                                        <label class="form-check-label" for="chkRol{{rol.id}}">&nbsp;</label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-primary btn-sm me-2" @click.prevent="openForm(rol)"><i class="ri-edit-line"></i></button>
                                    <button class="btn btn-warning btn-sm" @click.prevent="openMenuList(rol)"><i class="ri-lock-line"></i></button>
                                </td>
                            </tr>

                            <tr v-if="!loading && roles.length < 1">
                                <td colspan="3" class="text-center"><i class="ri-information-line"></i> Sin registros</td>
                            </tr>
                            <tr v-if="loading">
                                <td colspan="3" class="text-center">Cargando...</td>
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


    <div class="modal fade" id="rolModal" tabindex="-1" aria-labelledby="rolModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <RolForm ref="rolForm" @saved="get" />
        </div>
    </div>

    <div class="modal fade" id="menuListModal" tabindex="-1" aria-labelledby="menuListModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <MenuList ref="menuList" @saved="get" />
        </div>
    </div>
</template>
<script>
import Paginator from '@/components/Paginator.vue';
import MenuService from '@/services/menu.service';
import RolService from '@/services/rol.service';
import RolForm from './components/RolForm.vue';
import MenuList from './components/MenuList.vue';

export default {
    components: {
        MenuList,
        Paginator,
        RolForm
    },
    data(){
        return {
            frmSearch: {
                page: 1,
                per_page: 10,
                term: ''
            },
            loading: false,
            roles: [],
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
            this.roles = [];
            RolService.get({'filters':this.frmSearch, 'withs':['menus:id,nombre'], 'fields': ['id','nombre','estado']})
                .then(data=>{
                    this.roles = data.data;
                    this.total = data.total;
                })
                .finally(()=>this.loading = false);
        },
        openForm(rol=null){
            this.$refs.rolForm.init(rol);
            $('#rolModal').modal('show');
        },
        openMenuList(rol=null){
            this.$refs.menuList.init(rol);
            $('#menuListModal').modal('show');
        },
        updateState(rol){
            RolService.updateState(rol.id)
                .then((res)=>this.$alert(res.message,'Éxito','success'));
        }
    }
}
</script>