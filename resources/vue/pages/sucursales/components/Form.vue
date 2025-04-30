<template>
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="sucursalModalLabel">{{ form?.id ? 'Editar' : 'Registrar' }} sucursal</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="row" @submit.prevent="save()">
                <div class="col-lg-4 mb-3">
                    <label>Código de Local</label>
                    <input type="text" maxlength="25" class="form-control" placeholder="Ingresa el Código del Local" v-model="form.codigo_local" :disabled="form.id>0">
                    <small class="text-danger" v-if="errors?.codigo_local">{{ errors.codigo_local }}</small>
                </div>
                <div class="col-lg-4 mb-3">
                    <label>Nombres</label>
                    <input type="text" class="form-control" placeholder="Escribe el nombre" v-model="form.nombre">
                    <small class="text-danger" v-if="errors?.nombre">{{ errors.nombre }}</small>
                </div>
                <div class="col-lg-4 mb-3">
                    <label>Dirección</label>
                    <input type="text" class="form-control" placeholder="Escribe la dirección" v-model="form.direccion">
                    <small class="text-danger" v-if="errors?.direccion">{{ errors.direccion }}</small>
                </div>
                <div class="col-lg-4 mb-3">
                    <label>E-mail</label>
                    <input type="email" class="form-control" placeholder="Escribe el email" v-model="form.email" >
                    <small class="text-danger" v-if="errors?.email">{{ errors.email }}</small>
                </div>
                <div class="col-lg-4 mb-3">
                    <label>Teléfono</label> 
                    <input type="text" class="form-control" placeholder="Escribe el teléfono" v-model="form.telefono" >
                    <small class="text-danger" v-if="errors?.telefono">{{ errors.telefono }}</small>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" @click.prevent="save()"><i class="ri-check-line"></i> Guardar</button>
        </div>
    </div>
</template>
<script>
import RolService from '@/services/rol.service';
import SucursalService from '@/services/sucursal.service.js';
export default {
    data(){
        return {
            form: {},
            errors: {},
            roles: []
        }
    },
    methods: {
        getRoles(){
            RolService.get({'wheres':{'estado':1}, 'fields':['id','nombre']})
                .then(data=>this.roles = data);
        },
        init(sucursal=null){
            this.getRoles();
            this.clearForm();
            if(sucursal){
                this.form = {...sucursal};
            }
        },
        clearForm(){
            this.form = {
                id: 0,
                codigo_local: '',
                nombre: '',
                direccion: '',
                email: '',
                telefono: '',
            }
        },
        save(){
            let promise = null;
            if(this.form.id > 0){
                promise = SucursalService.update(this.form.id, this.form);
            } else {
                promise = SucursalService.create(this.form);
            }

            promise.then(res => {
                this.$alert(res.message, 'Éxito', 'success');
                this.$emit('saved');
                this.clearForm();
                $('#sucursalModal').modal('hide');
            }).catch(error => {
                this.errors = error.response.data.errors;
            });
        }
    }
}
</script>