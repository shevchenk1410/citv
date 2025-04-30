<template>
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="menuModalLabel">{{ form?.id ? 'Editar' : 'Registrar' }} menu</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form @submit.prevent="save()">
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label text-md-end">Nombre</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" v-model="form.nombre">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label text-md-end">URL</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" v-model="form.url">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label text-md-end">Icono (clase de remixicon)</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" v-model="form.icono">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label text-md-end">Menu Padre</label>
                    <div class="col-sm-8">
                        <select class="form-control" v-model="form.padre_id">
                            <option value="0">Ninguno</option>
                            <option v-for="menu in padreMenus" :key="menu.id" :value="menu.id">{{ menu.nombre }}</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label text-md-end">Orden</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" v-model="form.orden">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" @click.prevent="save()"><i class="ri-check-line"></i> Guardar</button>
        </div>
    </div>
</template>
<script>
import MenuService from '@/services/menu.service.js';
export default {
    data(){
        return {
            form: {},
            errors: {},
            padreMenus: []
        }
    },
    methods: {
        init(menu=null){
            this.clearForm();
            if(menu){
                this.form = {...menu};
            }
        },
        clearForm(){
            this.form = {
                id: 0,
                nombre: '',
                url: '',
                icono: '',
                padre_id: 0,
                orden: 1
            }
        },
        save(){
            let promise = null;
            if(this.form.id > 0){
                promise = MenuService.update(this.form.id, this.form);
            } else {
                promise = MenuService.create(this.form);
            }

            promise.then(res => {
                this.$alert(res.message, 'Éxito', 'success');
                this.$emit('saved');
                this.clearForm();
                $('#menuModal').modal('hide');
            }).catch(error => {
                this.errors = error.response.data.errors;
            });
        }
    }
}
</script>