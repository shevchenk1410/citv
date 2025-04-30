<template>
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="rolModalLabel">Gestionar Menú</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card">
                <table class="table table-sm mb-0 align-middle">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th>Nombre</th>
                            <th class="text-center">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="menu in menus" :key="'menu_'+menu.id">
                            <tr>
                                <td>{{ menu.nombre }}</td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox"  v-model="menu.posee">
                                </td>
                            </tr>
                            <!--
                            <tr v-for="child in menu.menus" :key="'childmenu_'+child.id">
                                <td><span class="ms-3">{{ child.nombre }}</span></td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox"  v-model="child.posee">
                                </td>
                            </tr>
                            -->
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" @click.prevent="save()"><i class="ri-check-line"></i> Guardar</button>
        </div>
    </div>
</template>
<script>
import RolService from '@/services/rol.service.js';
import MenuService from '@/services/menu.service';

export default {
    data(){
        return {
            form: {},
            menus: [],
            errors: {},
            rol: {}
        }
    },
    methods: {
        getMenus(){
            MenuService.get({'withs':['menus:id,nombre,padre_id'], 'wheres':{estado:1, padre_id:0}, 'fields': ['id','nombre']})
                .then(data=>this.menus = data.map(menu => {
                    menu.posee = this.rol.menus.some(e => e.id === menu.id);
                    menu.menus = menu.menus.map(menu => {
                        menu.posee = this.rol.menus.some(e => e.id === menu.id);
                        return menu;
                    });
                    return menu;
                }));
        },
        init(rol){
            this.rol = rol;
            this.getMenus();
        },
        clearForm(){
            this.form = {
                id: 0,
                nombre: '',
            }
        },
        save(){
            let _menus = this.menus.filter(menu => menu.posee).map(menu => menu.id);
            RolService.updateMenu(this.rol.id, {'menus':_menus})
                .then(res => {
                    this.$alert(res.message, 'Éxito', 'success');
                    this.$emit('saved');
                    $('#menuListModal').modal('hide');
                }).catch(error => {
                    this.errors = error.response.data.errors;
                });
        }
    }
}
</script>