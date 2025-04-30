<?php

namespace App\Livewire\Masters;

use App\Models\Usuario;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class UsuarioComponent extends Component
{

    use WithPagination;

    public $form = [];

    public $modalId = 'usuarioModal';

    public $term = '';

    public function __construct(){
        $this->resetForm();
    }

    public function render()
    {
        $term = $this->term;

        $usuarios = Usuario::where(function($query) use ($term){
            $query->where('nombres', 'like', "%$term%")
                ->orWhere('apellidos', 'like', "%$term%")
                ->orWhere('telefono', 'like', "%$term%")
                ->orWhere('dni', 'like', "%$term%")
                ->orWhere('email', 'like', "%$term%");
        })->paginate(20);

        return view('livewire.masters.usuario-component', compact('usuarios'));
    }

    public function clearTerm()
    {
        $this->resetPage();
        $this->term = '';
    }

    public function create()
    {
        $this->resetForm();
        $this->dispatch('open-modal', $this->modalId);
    }

    public function edit($user)
    {
        $this->resetForm();
        $this->form['id'] = $user['id'];
        $this->form['dni'] = $user['dni'];
        $this->form['nombres'] = $user['nombres'];
        $this->form['apellidos'] = $user['apellidos'];
        $this->form['email'] = $user['email'];
        $this->form['telefono'] = $user['telefono'];

        $this->dispatch('open-modal', $this->modalId);
    }

    public function delete($user_id)
    {
        $this->dispatch('delete', eventName: 'delete-usuario', id: $user_id);
    }

    #[On('delete-usuario')] 
    public function destroy($id)
    {
        Usuario::destroy($id);
        $this->dispatch('msg', 'Usuario eliminado con éxito');
    }

    public function store()
    {
        $this->validate([
            'form.dni' => 'required|unique:usuario,dni',
            'form.nombres' => 'required',
            'form.apellidos' => 'required',
            'form.email' => 'nullable',
            'form.telefono' => 'nullable',
        ], [
            'form.dni.required' => 'El campo número de documento es obligatorio',
            'form.dni.unique' => 'El número de documento ya se encuentra registrado',
            'form.nombres.required' => 'El campo nombres es obligatorio',
            'form.apellidos.required' => 'El campo apellidos es obligatorio',
        ]);

        $params = $this->form;
        $params['estado'] = 1;

        Usuario::create($params);

        $this->dispatch('close-modal', $this->modalId);
        $this->dispatch('msg', 'Usuario registrado con éxito');
    }

    public function update(Usuario $model)
    {
        $this->validate([
            'form.dni' => 'required',
            'form.nombres' => 'required',
            'form.apellidos' => 'required',
            'form.email' => 'nullable',
            'form.telefono' => 'nullable',
        ], [
            'form.dni.required' => 'El campo número de documento es obligatorio',
            'form.nombres.required' => 'El campo nombres es obligatorio',
            'form.apellidos.required' => 'El campo apellidos es obligatorio',
        ]);

        $model->update($this->form);

        $this->dispatch('close-modal', $this->modalId);
        $this->dispatch('msg', 'Datos del usuario actualizado con éxito');
    }

    public function updateEstado(Usuario $usuario){
        $usuario->estado = $usuario->estado == 1 ? 0 : 1;
        $usuario->save();
        $this->dispatch('msg', 'Estado del usuario actualizado con éxito');
    }

    private function resetForm()
    {
        $this->form = [
            'id' => 0,
            'dni' => '',
            'nombres' => '',
            'apellidos' => '',
            'email' => '',
            'telefono' => '',
        ];
    }
}
