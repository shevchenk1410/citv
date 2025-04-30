<div>
    <div class="pt-lg-2">
        <h4 class="page-title mb-3">Registro de Clientes</h4>
    </div>

    <div class="row row-cols-md-auto gx-2 align-items-end">
        <div class="col-12 mb-3">
            <label for="input-fecha">Buscar cliente</label>
            <div class="input-group" style="width: 300px">
                <input type="text" class="form-control" placeholder="Buscar por DNI, nombres, apellidos..." wire:model.live.debounce.250ms="term">
                @if($term!=='')
                    <button class="btn btn-danger" wire:click="clearTerm()"><i class="ri-close-line"></i></button>
                @endif
            </div>
        </div>
        <div class="col-12 mb-3">
            <button class="btn btn-primary" wire:click.prevent="create()">+ Cliente</button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover table-sm mb-0 align-middle">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th>ID</th>
                                <th>Nombres y Apellidos / Razón Social</th>
                                <th>E-mail</th>
                                <th>Teléfono</th>
                                <th>Fec. Registro</th>
                                <th class="text-center" style="width:200px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($clientes as $cliente)
                                <tr>
                                    <td>{{ $cliente->tipo_documento->nombre }} {{ $cliente->numero_documento }}</td>
                                    <td>{{ $cliente->nombres }} {{ $cliente->apellidos }}</td>
                                    <td>{{ $cliente->email }}</td>
                                    <td>{{ $cliente->telefono }}</td>
                                    <td>{{ $cliente->created_at->format('d/m/Y') }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm me-2" wire:click.prevent="edit({{$cliente}})"><i class="ri-edit-line"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center"><i class="ri-information-line"></i> Sin registros</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="{{ $modalId }}Label">{{ $form['id'] > 0 ? 'Editar' : 'Registrar' }} cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="{{ $form['id'] == 0 ? "store" : "update(".$form['id'].")" }}">
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Tipo de Documento</label>
                            <div class="col-sm-9">
                                <select class="form-select" wire:model.live="form.tipo_documento_id">
                                    @foreach($tipos_documento as $td)
                                        <option value="{{ $td->id }}">{{ $td->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('form.tipo_documento_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Número de Documento</label>
                            <div class="col-sm-9">
                                <input type="text" maxlength="8" class="form-control" wire:model="form.numero_documento" {{ $form['id'] > 0 ? 'disabled' : '' }}>
                                @error('form.numero_documento') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">{{ $form['tipo_documento_id'] != 6 ? 'Nombres' : 'Razón Social' }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" wire:model="form.nombres">
                                @error('form.nombres') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        @if($form['tipo_documento_id'] != 6)
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Apellidos</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" wire:model="form.apellidos">
                                @error('form.apellidos') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        @endif
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">E-mail</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" wire:model="form.email">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Teléfono</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" wire:model="form.telefono">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" wire:click.prevent="{{ $form['id'] == 0 ? "store" : "update(".$form['id'].")" }}"><i class="ri-check-line"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>

</div>