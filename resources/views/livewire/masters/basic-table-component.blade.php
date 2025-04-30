<div>
    <div class="pt-lg-2">
        <h4 class="page-title mb-3">{{ $title }}</h4>
    </div>

    <div class="row">
        <div class="col-12 text-end mb-3">
            <button class="btn btn-primary" wire:click.prevent="openModal()">+ Añadir</button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover table-sm mb-0 align-middle">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th class="text-center">Código</th>
                                <th class="text-center">Descripción</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center" style="width:100px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $row)
                                <tr>
                                    <td class="text-center">{{ $row->codigo }}</td>
                                    <td class="text-center">{{ $row->descripcion }}</td>
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
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="{{ $modalId }}Label">{{ $form['codigo'] > 0 ? 'Editar' : 'Registrar' }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="save()" class="row">
                        <div class="col-lg-4 mb-3">
                            <label>Código</label>
                            <input type="text" class="form-control" wire:model="form.codigo" placeholder="Escribe el código">
                            @error('form.codigo') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-lg-8 mb-3">
                            <label>Descripción</label>
                            <input type="text" class="form-control" wire:model="form.descripcion" placeholder="Escribe la descripción">
                            @error('form.descripcion') <small class="text-danger">{{ $message }}</small> @enderror
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