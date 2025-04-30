<div>
    <div class="pt-lg-2">
        <h4 class="page-title mb-3">Registro de Usuarios</h4>
    </div>

    <div class="row row-cols-md-auto gx-2 align-items-end">
        <div class="col-auto mb-3">
            <label for="input-fecha">Buscar Usuario</label>
            <div class="input-group" style="width: 300px">
                <input type="text" class="form-control" placeholder="Buscar por DNI, nombres, apellidos..." wire:model.live.debounce.250ms="term">
                @if($term!=='')
                    <button class="btn btn-danger" wire:click="clearTerm()"><i class="ri-close-line"></i></button>
                @endif
            </div>
        </div>
        <div class="col-12 mb-3">
            <button class="btn btn-primary" wire:click.prevent="create()">+ Usuario</button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                
                <div class="table-responsive">
                    <table class="table table-hover table-sm mb-0 align-middle">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th>DNI</th>
                                <th>Nombres y Apellidos</th>
                                <th>E-mail</th>
                                <th>Teléfono</th>
                                <th class="text-center">Fec. Registro</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center" style="width:200px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->dni }}</td>
                                    <td>{{ $usuario->nombres }} {{ $usuario->apellidos }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>{{ $usuario->telefono }}</td>
                                    <td class="text-center">{{ $usuario->created_at ? $usuario->created_at->format('d/m/Y') : '' }}</td>
                                    <td class="text-center">
                                        <div class="form-check form-switch d-inline">
                                            <input class="form-check-input" type="checkbox" role="switch" id="chkUsuario{{$usuario->id}}" wire:change="updateEstado({{$usuario->id}})" {{ $usuario->estado == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="chkUsuario{{$usuario->id}}">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm" wire:click.prevent="edit({{$usuario}})"><i class="ri-edit-line"></i></button>
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
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="{{ $modalId }}Label">{{ $form['id'] > 0 ? 'Editar' : 'Registrar' }} usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="{{ $form['id'] == 0 ? "store" : "update(".$form['id'].")" }}" class="row">
                        <div class="col-lg-4 mb-3">
                            <label>Documento de Identidad</label>
                            <input type="text" maxlength="8" class="form-control" wire:model="form.dni" {{ $form['id'] > 0 ? 'disabled' : '' }} placeholder="Ingresa el DNI">
                            @error('form.dni') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label>Nombres</label>
                            <input type="text" class="form-control" wire:model="form.nombres" placeholder="Escribe los nombres">
                            @error('form.nombres') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label>Apellidos</label>
                            <input type="text" class="form-control" wire:model="form.apellidos" placeholder="Escribe los apellidos">
                            @error('form.apellidos') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label>E-mail</label>
                            <input type="email" class="form-control" wire:model="form.email"  placeholder="Escribe el email">
                            @error('form.email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label>Teléfono</label> 
                            <input type="text" class="form-control" wire:model="form.telefono"  placeholder="Escribe el teléfono">
                            @error('form.telefono') <small class="text-danger">{{ $message }}</small> @enderror
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