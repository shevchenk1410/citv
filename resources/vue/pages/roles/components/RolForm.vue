<template>
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="rolModalLabel">{{ form?.id ? 'Editar' : 'Registrar' }} rol</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="row" @submit.prevent="save()">
                <div class="mb-3">
                    <label>Nombre</label>
                    <input type="text" class="form-control" placeholder="Escribe el nombre" v-model="form.nombre">
                    <small class="text-danger" v-if="errors?.nombre">{{ errors.nombre }}</small>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" @click.prevent="save()"><i class="ri-check-line"></i> Guardar</button>
        </div>
    </div>
</template>
<script>
import RolService from '@/services/rol.service.js';
export default {
    data(){
        return {
            form: {},
            errors: {}
        }
    },
    methods: {
        init(rol=null){
            this.clearForm();
            if(rol){
                this.form = {...rol};
            }
        },
        clearForm(){
            this.form = {
                id: 0,
                nombre: '',
            }
        },
        save(){
            let promise = null;
            if(this.form.id > 0){
                promise = RolService.update(this.form.id, this.form);
            } else {
                promise = RolService.create(this.form);
            }

            promise.then(res => {
                this.$alert(res.message, 'Éxito', 'success');
                this.$emit('saved');
                this.clearForm();
                $('#rolModal').modal('hide');
            }).catch(error => {
                this.errors = error.response.data.errors;
            });
        }
    }
}
</script>