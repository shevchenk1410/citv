<?php

namespace App\Livewire\Masters;

use App\Models\Cliente;
use App\Models\TipoDocumento;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ClienteComponent extends Component
{

    use WithPagination;

    public $form = [];

    public $tipos_documento;

    public $modalId = 'clienteModal';

    public $term = '';

    public function __construct(){
        $this->tipos_documento = TipoDocumento::all();

        $this->resetForm();
    }

    public function render()
    {
        $term = $this->term;

        $clientes = Cliente::where(function($query) use ($term){
            $query->where('nombres', 'like', "%$term%")
                ->orWhere('apellidos', 'like', "%$term%")
                ->orWhere('numero_documento', 'like', "%$term%")
                ->orWhere('telefono', 'like', "%$term%")
                ->orWhere('email', 'like', "%$term%");
        })->with('tipo_documento')->paginate(20);

        return view('livewire.masters.cliente-component', compact('clientes'));
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
        $this->form['numero_documento'] = $user['numero_documento'];
        $this->form['nombres'] = $user['nombres'];
        $this->form['apellidos'] = $user['apellidos'];
        $this->form['email'] = $user['email'];
        $this->form['telefono'] = $user['telefono'];

        $this->dispatch('open-modal', $this->modalId);
    }

    public function delete($user_id)
    {
        $this->dispatch('delete', eventName: 'delete-cliente', id: $user_id);
    }

    #[On('delete-cliente')] 
    public function destroy($id)
    {
        Cliente::destroy($id);
        $this->dispatch('msg', 'Cliente eliminado con éxito');
    }
    public function store()
    {
        $params = $this->validate([
            'form.tipo_documento_id' => 'required|numeric|min:1',
            'form.numero_documento' => 'required',
            'form.nombres' => 'required',
            'form.apellidos' => 'required_unless:form.tipo_documento_id,6',
            'form.telefono' => 'nullable',
            'form.email' => 'nullable',
        ], [
            'form.tipo_documento_id.required' => 'El campo tipo de documento es obligatorio',
            'form.nombres.required' => 'El campo nombres es obligatorio',
            'form.apellidos.required_unless' => 'El campo apellidos es obligatorio',
            'form.numero_documento.required' => 'El campo número de documento es obligatorio',
        ]);

        Cliente::create($this->form);

        $this->dispatch('close-modal', $this->modalId);
        $this->dispatch('msg', 'Cliente registrado con éxito');
    }

    public function update(Cliente $cliente)
    {
        $this->validate([
            'form.nombres' => 'required',
            'form.apellidos' => 'required',
            'form.numero_documento' => 'required',
            'form.telefono' => 'nullable',
            'form.email' => 'nullable',
        ], [
            'form.nombres.required' => 'El campo nombres es obligatorio',
            'form.apellidos.required' => 'El campo apellidos es obligatorio',
            'form.numero_documento.required' => 'El campo número de documento es obligatorio',
        ]);

        $cliente->update($this->form);

        $this->dispatch('close-modal', $this->modalId);
        $this->dispatch('msg', 'Datos del cliente actualizado con éxito');
    }

    private function resetForm()
    {
        $this->form = [
            'id' => 0,
            'tipo_documento_id' => 1,
            'nombres' => '',
            'apellidos' => '',
            'numero_documento' => '',
            'telefono' => '',
            'email' => '',
        ];
    }
}
