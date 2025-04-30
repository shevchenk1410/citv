<template>
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="usuarioModalLabel">{{ form?.id ? 'Editar' : 'Registrar' }} usuario</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="row" @submit.prevent="save()">
                <div class="col-lg-4 mb-3">
                    <label>Documento de Identidad</label>
                    <input type="text" maxlength="8" class="form-control" placeholder="Ingresa el DNI" v-model="form.dni" :disabled="form.id>0">
                    <small class="text-danger" v-if="errors?.dni">{{ errors.dni }}</small>
                </div>
                <div class="col-lg-4 mb-3">
                    <label>Nombres</label>
                    <input type="text" class="form-control" placeholder="Escribe los nombres" v-model="form.nombres">
                    <small class="text-danger" v-if="errors?.nombres">{{ errors.nombres }}</small>
                </div>
                <div class="col-lg-4 mb-3">
                    <label>Apellidos</label>
                    <input type="text" class="form-control" placeholder="Escribe los apellidos" v-model="form.apellidos">
                    <small class="text-danger" v-if="errors?.apellidos">{{ errors.apellidos }}</small>
                </div>
                <div class="col-lg-3 mb-3">
                    <label>E-mail</label>
                    <input type="email" class="form-control" placeholder="Escribe el email" v-model="form.email" >
                    <small class="text-danger" v-if="errors?.email">{{ errors.email }}</small>
                </div>
                <div class="col-lg-3 mb-3">
                    <label>Teléfono</label> 
                    <input type="text" class="form-control" placeholder="Escribe el teléfono" v-model="form.telefono" >
                    <small class="text-danger" v-if="errors?.telefono">{{ errors.telefono }}</small>
                </div>
                <div class="col-lg-3 mb-3">
                    <label>Sucursal</label> 
                    <select class="form-control" v-model="form.sucursal_id">
                        <option :value="0">Sin Sucursal</option>
                        <option v-for="rol in sucursales" :key="rol.id" :value="rol.id">{{ rol.nombre }}</option>
                    </select>
                    <small class="text-danger" v-if="errors?.rol_id">{{ errors.rol_id }}</small>
                </div>
                <div class="col-lg-3 mb-3">
                    <label>Rol</label> 
                    <select class="form-control" v-model="form.rol_id">
                        <option :value="0">Selecciona un rol</option>
                        <option v-for="rol in roles" :key="rol.id" :value="rol.id">{{ rol.nombre }}</option>
                    </select>
                    <small class="text-danger" v-if="errors?.rol_id">{{ errors.rol_id }}</small>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" @click.prevent="save()"><i class="ri-check-line"></i> Guardar</button>
        </div>
    </div>
</template>
<script>
import SucursalService from '@/services/sucursal.service';
import RolService from '@/services/rol.service';
import UsuarioService from '@/services/usuario.service.js';
export default {
    data(){
        return {
            form: {},
            errors: {},
            roles: [],
            sucursales: [],
        }
    },
    methods: {
        getRoles(){
            RolService.get({'wheres':{'estado':1}, 'fields':['id','nombre']})
                .then(data=>this.roles = data);
        },
        getSucursales(){
            SucursalService.get({'wheres':{'estado':1}, 'fields':['id','nombre']})
                .then(data=>this.sucursales = data);
        },
        init(usuario=null){
            this.getRoles();
            this.getSucursales();
            this.clearForm();
            if(usuario){
                this.form = {...usuario};
            }
        },
        clearForm(){
            this.form = {
                id: 0,
                dni: '',
                nombres: '',
                apellidos: '',
                email: '',
                telefono: '',
                rol_id: 0,
                sucursal_id: 0,
            }
        },
        save(){
            let promise = null;
            if(this.form.id > 0){
                promise = UsuarioService.update(this.form.id, this.form);
            } else {
                promise = UsuarioService.create(this.form);
            }

            promise.then(res => {
                this.$alert(res.message, 'Éxito', 'success');
                this.$emit('saved');
                this.clearForm();
                $('#usuarioModal').modal('hide');
            }).catch(error => {
                this.errors = error.response.data.errors;
            });
        }
    }
}
</script>