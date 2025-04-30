<div>
    <div class="pt-lg-2">
        <h4 class="page-title mb-4">Lista de Aseguradoras</h4>
    </div>

    <div class="row row-cols-lg-auto gx-2 align-items-end">
        <div class="col-auto mb-3">
            <label for="input-fecha">Buscar aseguradora</label>
            <div class="input-group" style="width: 300px">
                <input type="text" class="form-control" placeholder="Buscar por nombre" wire:model.live.debounce.250ms="search_params.term">
                @if($search_params['term']!=='')
                    <button class="btn btn-danger" wire:click="clearTerm()"><i class="ri-close-line"></i></button>
                @endif
            </div>
        </div>
        <div class="col-auto mb-3">
            <label for="input-fecha">Tipo de Poliza</label>
            <select class="form-control" wire:model.live="search_params.tipo_poliza_id">
                <option value="">Todos</option>
                @foreach($tipos_polizas as $poliza)
                    <option value="{{ $poliza->id }}">{{ $poliza->codigo }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-auto mb-3">
            <label for="input-fecha">Estado</label>
            <select class="form-control" wire:model.live="search_params.estado">
                <option value="">Todos</option>
                <option value="1">Habilitado</option>
                <option value="0">No habilitado</option>
            </select>
        </div>
        <div class="col-12 mb-3">
            <button class="btn btn-primary" wire:click.prevent="openModal()">+ Aseguradora</button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                @if( $aseguradoras->hasPages() )
                    <div class="pt-3 px-3">
                        {{ $aseguradoras->links() }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-hover table-sm mb-0 align-middle">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th class="text-center">ID</th>
                                <th >Nombre</th>
                                <th class="text-center">Tipo de Poliza</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center" style="width:100px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($aseguradoras as $row)
                                <tr>
                                    <td class="text-center">{{ $row->id }}</td>
                                    <td >{{ $row->descripcion }}</td>
                                    <td class="text-center">{{ $row->tipo_poliza->codigo ?? '' }}</td>
                                    <td class="text-center">
                                        <div class="form-check form-switch d-inline">
                                            <input class="form-check-input" type="checkbox" role="switch" id="chkUsuario{{$row->id}}" wire:change="updateEstado({{$row->id}})" {{ $row->estado == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="chkUsuario{{$row->id}}">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm" wire:click.prevent="openModal({{$row}})"><i class="ri-edit-line"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center"><i class="ri-information-line"></i> Sin registros</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if( $aseguradoras->hasPages() )
                    <div class="pt-3 px-3">
                        {{ $aseguradoras->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="{{ $modalId }}Label">{{ $form['id'] > 0 ? 'Editar' : 'Registrar' }} Aseguradora</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="save()" class="row">
                        <div class="col-lg-8 mb-3">
                            <label>Nombre</label>
                            <input type="text" class="form-control" wire:model="form.descripcion" placeholder="Escribe la descripción">
                            @error('form.descripcion') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label>Tipo de Poliza</label>
                            <select name="" id="" class="form-control" wire:model="form.tipo_poliza_id">
                                <option value="">Selecciona</option>
                                @foreach($tipos_polizas as $poliza)
                                    <option value="{{ $poliza->id }}">{{ $poliza->codigo }}</option>
                                @endforeach
                            </select>
                            @error('form.tipo_poliza_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" wire:click.prevent="save()"><i class="ri-check-line"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>