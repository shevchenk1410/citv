<template>
    <div class="pt-lg-2">
        <h4 class="page-title mb-3">Registro de Menús</h4>
    </div>

    <div class="row row-cols-md-auto gx-2 align-items-end">
        <div class="col-auto mb-3">
            <label for="input-fecha">Buscar</label>
            <div class="input-group" style="width: 300px">
                <input type="text" class="form-control" placeholder="Buscar..." v-model="frmSearch.term" @keydown.enter="get(1)">
            </div>
        </div>
        <div class="col-12 mb-3">
            <button class="btn btn-primary" @click.prevent="openForm()">+ Menu</button>
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
                                <th>URL</th>
                                <th class="text-center">Icono</th>
                                <th >Menu Padre</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center" style="width:200px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="menu in menus" :key="'row_'+menu.id">
                                <td>{{ menu.nombre }}</td>
                                <td>{{ menu.url }}</td>
                                <td class="text-center"><i :class="menu.icono"></i></td>
                                <td>{{ menu?.menu?.nombre }}</td>
                                <td class="text-center">
                                    <div class="form-check form-switch d-inline">
                                        <input class="form-check-input" type="checkbox" role="switch" :id="'chkUsuario'+menu.id" true-value="1" false-value="0" v-model="menu.estado">
                                        <label class="form-check-label" for="chkUsuario{{menu.id}}">&nbsp;</label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-primary btn-sm" @click.prevent="openForm(menu)"><i class="ri-edit-line"></i></button>
                                </td>
                            </tr>

                            <tr v-if="!loading && menus.length < 1">
                                <td colspan="6" class="text-center"><i class="ri-information-line"></i> Sin registros</td>
                            </tr>
                            <tr v-if="loading">
                                <td colspan="6" class="text-center">Cargando...</td>
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


    <div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <MenuForm ref="menuForm" @saved="get" />
        </div>
    </div>
</template>
<script>
import Paginator from '@/components/Paginator.vue';
import MenuService from '@/services/menu.service';
import MenuForm from './components/MenuForm.vue';
export default {
    components: {
        Paginator,
        MenuForm
    },
    data(){
        return {
            frmSearch: {
                page: 1,
                per_page: 10,
                term: ''
            },
            loading: false,
            menus: [],
            padreMenus: [],
            total: 0
        }
    },
    created(){
        this.get();
        this.getPadres();
    },
    methods: {
        get(page=1){
            this.frmSearch.page = page;
            this.loading = true;
            this.menus = [];
            MenuService.get({wheres:this.frmSearch, withs: ['menu']})
                .then(data=>{
                    this.menus = data.data;
                    this.total = data.total;
                })
                .finally(()=>this.loading = false);
        },
        getPadres(){
            MenuService.get({wheres:{estado:1,padre_id:0}, fields:['id','nombre']})
                .then(data=>{
                    this.padreMenus = data;
                });
        },
        openForm(menu=null){
            this.$refs.menuForm.init(menu);
            this.$refs.menuForm.padreMenus = this.padreMenus;
            $('#menuModal').modal('show');
        }
    }
}
</script>