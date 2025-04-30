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
                    <label for="">Placa</label>
                    <input type="text" class="form-control" placeholder="Nro. de placa">
                </div>
                <div class="col-12 mb-3">
                    <label for="">Categoría</label>
                    <select name="" id="" class="form-control">
                        <option value="">Seleccione</option>
                        @foreach($categorias as $r)
                            <option value="{{ $r->codigo }}">{{ $r->descripcion }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <label for="">Tipo de Servicio</label>
                    <select name="" id="" class="form-control">
                        <option value="">Seleccione</option>
                        @foreach($tipos_servicio as $r)
                            <option value="{{ $r->codigo }}">{{ $r->descripcion }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <label for="">Ambito</label>
                    <select name="" id="" class="form-control">
                        <option value="">Seleccione</option>
                        @foreach($tipos_ambito as $r)
                            <option value="{{ $r->codigo }}">{{ $r->descripcion }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <label for="">Tipo de Inspección</label>
                    <select name="" id="" class="form-control">
                        <option value="">Seleccione</option>
                        @foreach($tipos_inspeccion as $r)
                            <option value="{{ $r->codigo }}">{{ $r->descripcion }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <button class="btn btn-success"><i class="ri-search-2-line"></i> GENERAR</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">2. Tarjeta de Propiedad y Poliza de Seguro</h5>
        </div>
        <div class="card-body">
            <ul class="nav nav-pills" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="tarjeta-propiedad-tab" data-bs-toggle="tab" data-bs-target="#tarjeta-propiedad" type="button" role="tab" aria-controls="tarjeta-propiedad" aria-selected="true">Tarjeta de Propiedad</button>
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
                                <label for="">Número de Ficha</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Placa</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Categoria</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Marca</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Modelo</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Año de Fabricación</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Combustible</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">VIN/Serie Chasis</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Número de Motor</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Descripción de la carrocería</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Número de ejes</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Número de ruedas</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Número de asientos</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Número de Pasajeros</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Largo</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Ancho</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Alto</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Color</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Peso Neto</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Peso Bruto</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Peso Util</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <hr>
                        <h5>Ultima revisión</h5>
                        <div class="row">
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Número de Documento</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Fecha del documento</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Empresa</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="">Observaciones</label>
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
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Tipo de Poliza</label>
                                <select class="form-control">
                                    @foreach($tipos_poliza as $poliza)
                                        <option value="{{ $poliza->id }}">{{ $poliza->codigo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Número de Poliza</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Fecha Inicio</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <label for="">Fecha Fin</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
