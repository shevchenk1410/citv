<template>
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="operacionModalLabel">{{ form?.id ? 'Editar' : 'Registrar' }} sucursal</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form  @submit.prevent="save()">
                <div class="mb-3">
                    <label>Sucursal</label>
                    <select class="form-control" v-model="form.sucursal_id">
                        <option value="0">Seleccionar</option>
                        <option v-for="sucursal in sucursales" :key="sucursal.id" :value="sucursal.id">{{ sucursal.nombre }}</option>
                    </select>
                    <small class="text-danger" v-if="errors?.sucursal_id">{{ errors.sucursal_id }}</small>
                </div>
                <div class="mb-3" v-if="form.sucursal_id>0">
                    <label>Código de Local</label>
                    <input type="text" class="form-control" disabled :value="codigo_local">
                </div>
                <div class="mb-3" v-if="form.sucursal_id>0">
                    <label>Fecha</label>
                    <input type="text" class="form-control" disabled :value="fecha_actual">
                </div>
                <div class="mb-3" v-if="form.sucursal_id>0">
                    <label>Hora</label>
                    <input type="text" class="form-control" disabled :value="hora_actual">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" @click.prevent="save()"><i class="ri-check-line"></i> Guardar</button>
        </div>
    </div>
</template>
<script>
import dayjs from 'dayjs';
import OperacionDiariaService from '@/services/operacion-diaria.service.js';
import SucursalService from '@/services/sucursal.service.js';
export default {
    data(){
        return {
            form: {},
            errors: {},
            sucursales: []
        }
    },
    computed:{
        codigo_local: function(){
            return this.form.sucursal_id ? this.sucursales.find(sucursal => sucursal.id == this.form.sucursal_id).codigo_local : '';
        },
        fecha_actual(){
            return dayjs().format('DD/MM/YYYY');
        },
        hora_actual(){
            return dayjs().format('hh:mm A');
        }
    },
    methods: {
        getSucursales(){
            SucursalService.get({'wheres': {'estado': 1}})
                .then(response => {
                    this.sucursales = response;
                });
        },
        init(){
            this.clearForm();
            this.getSucursales();
        },
        clearForm(){
            this.form = {
                sucursal_id: 0,
            }
        },
        save(){
            OperacionDiariaService.create(this.form)
                .then(response => {
                    this.errors = {};
                    this.$emit('saved');
                    $('#operacionModal').modal('hide');
                })
                .catch(error => {
                    this.errors = error.response?.data?.errors ?? {};
                });
        }
    }
}
</script>