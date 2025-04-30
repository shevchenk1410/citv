<template>
    <div>
        <div class="pt-lg-2">
            <h4 class="page-title mb-3">Ingreso a Counter</h4>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">1. Generar número de Ficha</h5>
            </div>
            <div class="card-body">
                <div class="row row-cols-lg-auto gx-2 align-items-end">
                    <div class="col-12 mb-3">
                        <label >Placa</label>
                        <input type="text" maxlength="6" class="form-control" placeholder="Nro. de placa" v-model="form.PLACA">
                        <small class="text-danger" v-if="errors?.PLACA">{{ errors.PLACA }}</small>
                    </div>
                    <div class="col-12 mb-3">
                        <label >Categoría</label>
                        <select class="form-control" v-model="form.CATEGORIA" :disabled="ficha?.id>0">
                            <option value="">Seleccione</option>
                            <option v-for="item in categorias" :value="item.codigo" :key="'categoria_'+item.id">{{ item.descripcion }}</option>
                        </select>
                        <small class="text-danger" v-if="errors?.PLACA">{{ errors.PLACA }}</small>
                    </div>
                    <div class="col-12 mb-3">
                        <label >Tipo de Servicio</label>
                        <select class="form-control" v-model="form.TIPSERVICIO" :disabled="ficha?.id>0">
                            <option value="">Seleccione</option>
                            <option v-for="item in tipos_servicio" :value="item.codigo" :key="'categoria_'+item.id">{{ item.descripcion }}</option>
                        </select>
                        <small class="text-danger" v-if="errors?.TIPSERVICIO">{{ errors.PLACA }}</small>
                    </div>
                    <div class="col-12 mb-3">
                        <label >Ambito</label>
                        <select class="form-control" v-model="form.TIPAMBITO" :disabled="ficha?.id>0">
                            <option value="">Seleccione</option>
                            <option v-for="item in tipos_ambito" :value="item.codigo" :key="'categoria_'+item.id">{{ item.descripcion }}</option>
                        </select>
                        <small class="text-danger" v-if="errors?.TIPAMBITO">{{ errors.PLACA }}</small>
                    </div>
                    <div class="col-12 mb-3">
                        <label >Tipo de Inspección</label>
                        <select class="form-control" v-model="form.TIPINSPECCION" :disabled="ficha?.id>0">
                            <option value="">Seleccione</option>
                            <option v-for="item in tipos_inspeccion" :value="item.codigo" :key="'categoria_'+item.id">{{ item.descripcion }}</option>
                        </select>
                        <small class="text-danger" v-if="errors?.PLACA">{{ errors.TIPINSPECCION }}</small>
                    </div>
                    <div class="col-12 mb-3">
                        <button type="button" class="btn btn-success" @click.prevent="create()" :disabled="ficha?.id>0"><i class="ri-search-2-line"></i> GENERAR</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" v-if="ficha?.id > 0">
            <div class="card-header">
                <h5 class="card-title mb-0">2. Tarjeta de Propiedad y Poliza de Seguro</h5>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tarjeta-propiedad-tab" data-bs-toggle="tab" data-bs-target="#tarjeta-propiedad" type="button" role="tab" aria-controls="tarjeta-propiedad" aria-selected="true">Tarjeta de Propiedad</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="inspeccion-tab" data-bs-toggle="tab" data-bs-target="#inspeccion" type="button" role="tab" aria-controls="inspeccion" aria-selected="false">Ultima Inspección</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="poliza-tab" data-bs-toggle="tab" data-bs-target="#poliza" type="button" role="tab" aria-controls="poliza" aria-selected="false">Poliza de Seguro</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tarjeta-propiedad" role="tabpanel" aria-labelledby="tarjeta-propiedad-tab">
                        <div class="py-2">
                            <div class="row">
                                <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                    <label >Número de Ficha</label>
                                    <input type="text" class="form-control" v-model="ficha.NUM_FICHA">
                                </div>
                                <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                    <label >Placa</label>
                                    <input type="text" class="form-control" v-model="ficha.PLACA">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-12 mb-3">
                                    <label >Categoria</label>
                                    <input type="text" class="form-control" v-model="ficha.CATEGORIA_DESC">
                                </div>
                                <div class="col-md-3 col-12 mb-3">
                                    <label >Marca</label>
                                    <input type="text" class="form-control" v-model="ficha.MARCA">
                                </div>
                                <div class="col-md-3 col-12 mb-3">
                                    <label >Año de Fabricación</label>
                                    <input type="text" class="form-control" v-model="ficha.ANOFAB">
                                </div>
                                <div class="col-md-3 col-12 mb-3">
                                    <label >Modelo</label>
                                    <input type="text" class="form-control" v-model="ficha.MODELO">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-12 mb-3">
                                    <label >Combustible</label>
                                    <input type="text" class="form-control" v-model="ficha.COMBUSTIBLE">
                                </div>
                                <div class="col-md-4 col-12 mb-3">
                                    <label >Descripción de la carrocería</label>
                                    <input type="text" class="form-control" v-model="ficha.CARROCERIA">
                                </div>
                                <div class="col-md-4 col-12 mb-3">
                                    <label >Número de ejes</label>
                                    <input type="text" class="form-control" v-model="ficha.NUMEROEJES">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12 mb-3">
                                    <label >Color</label>
                                    <input type="text" class="form-control" v-model="ficha.COLOR">
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label >Número de Motor</label>
                                    <input type="text" class="form-control" v-model="ficha.NUMEROMOTOR">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12 mb-3">
                                    <label >VIN/Serie Chasis</label>
                                    <input type="text" class="form-control" v-model="ficha.VINSERCHA">
                                </div>
                                <div class="col-md-2 col-12 mb-3">
                                    <label >Ruedas</label>
                                    <input type="text" class="form-control" v-model="ficha.NUMERORUEDAS">
                                </div>
                                <div class="col-md-2 col-12 mb-3">
                                    <label >Pasajeros</label>
                                    <input type="text" class="form-control" v-model="ficha.NUMEROPASAJEROS">
                                </div>
                                <div class="col-md-2 col-12 mb-3">
                                    <label >Asientos</label>
                                    <input type="text" class="form-control" v-model="ficha.NUMEROASIENTOS">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label >Peso Neto</label>
                                    <input type="text" class="form-control" v-model="ficha.PESONETO">
                                </div>
                                <div class="col mb-3">
                                    <label >Peso Bruto</label>
                                    <input type="text" class="form-control" v-model="ficha.PESOBRUTO">
                                </div>
                                <div class="col mb-3">
                                    <label >Carga Util</label>
                                    <input type="text" class="form-control" v-model="ficha.PESOUTIL">
                                </div>
                                <div class="col mb-3">
                                    <label >Longitud</label>
                                    <input type="text" class="form-control" v-model="ficha.LARGO">
                                </div>
                                <div class="col mb-3">
                                    <label >Altura</label>
                                    <input type="text" class="form-control" v-model="ficha.ALTO">
                                </div>
                                <div class="col mb-3">
                                    <label >Ancho</label>
                                    <input type="text" class="form-control" v-model="ficha.ANCHO">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="inspeccion" role="tabpanel" aria-labelledby="inspeccion-tab">
                        <div class="py-2">
                            <div class="row">
                                <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                    <label >Número de Documento</label>
                                    <input type="text" class="form-control" v-model="ficha.NUMDOC_ULTREV">
                                </div>
                                <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                    <label >Fecha del documento</label>
                                    <input type="text" class="form-control" v-model="ficha.FECDOC_ULTREV">
                                </div>
                                <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                    <label >Empresa</label>
                                    <input type="text" class="form-control" v-model="ficha.RAZSOCCITV_ULTREV">
                                </div>
                                <div class="col-12">
                                    <label >Observaciones</label>
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <tbody>
                                                <tr>
                                                    <td>Sin observaciones</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="poliza" role="tabpanel" aria-labelledby="poliza-tab">
                        <div class="py-2">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-12 mb-3">
                                    <label >Tipo de Poliza</label>
                                    <select class="form-control" v-model="ficha.TIPPOLIZA">
                                        <option v-for="item in tipos_poliza" :value="item.id" :key="'categoria_'+item.id">{{ item.codigo }}</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12 mb-3">
                                    <label >Número de Poliza</label>
                                    <input type="text" class="form-control" v-model="ficha.NUMPOLIZA">
                                </div>
                                <div class="col-lg-3 col-md-6 col-12 mb-3">
                                    <label >Fecha Inicio</label>
                                    <input type="date" class="form-control" v-model="ficha.FECINIPOLIZA">
                                </div>
                                <div class="col-lg-3 col-md-6 col-12 mb-3">
                                    <label >Fecha Fin</label>
                                    <input type="date" class="form-control" v-model="ficha.FECFINPOLIZA">
                                </div>
                                <div>
                                    <button type="button" class="btn btn-primary" @click.prevent="updatePoliza()">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import SistemaService from '@/services/sistema.service';
import FichaVehicularService from '@/services/ficha-vehicular.service';

export default {
    data(){
        return {
            ficha: {},
            form: {
                PLACA: '',
                CATEGORIA: '',
                TIPSERVICIO: '',
                TIPAMBITO: '',
                TIPINSPECCION: ''
            },
            errors: {},
            categorias: [],
            tipos_servicio: [],
            tipos_ambito: [],
            tipos_inspeccion: [],
            tipos_poliza: [],
            aseguradoras: []
        };
    },
    created(){
        this.getListas();
    },
    methods: {
        create(){
            FichaVehicularService.create(this.form).then(res=>{
                this.ficha = res;
            }).catch(error=>{
                this.errors = error.response.data.errors;
            });
        },
        getListas(){
            SistemaService.get({aseguradoras:1,categorias:1,tipos_ambito:1,tipos_inspeccion:1,tipos_servicio:1,tipos_poliza:1}).then(res=>{
                this.categorias = res.categorias;
                this.tipos_servicio = res.tipos_servicio;
                this.tipos_ambito = res.tipos_ambito;
                this.tipos_inspeccion = res.tipos_inspeccion;
                this.tipos_poliza = res.tipos_poliza;
                this.aseguradoras = res.aseguradoras;
            });
        },
        updatePoliza(){
            FichaVehicularService.updatePoliza(this.ficha.id, {
                TIPPOLIZA: this.ficha.TIPPOLIZA,
                NUMPOLIZA: this.ficha.NUMPOLIZA,
                FECINIPOLIZA: this.ficha.FECINIPOLIZA,
                FECFINPOLIZA: this.ficha.FECFINPOLIZA
            }).then(res=>{
                this.$alert(res.message,'Éxito','success');
            });
        }
    }
}
</script>