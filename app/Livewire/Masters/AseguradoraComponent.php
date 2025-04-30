<?php

namespace App\Livewire\Masters;

use App\Models\Aseguradora;
use App\Models\TipoPoliza;
use Livewire\Component;
use Livewire\WithPagination;

class AseguradoraComponent extends Component
{
    use WithPagination;

    public $modalId = 'aseguradoraModal';

    public $form;

    public $search_params;

    public function __construct(){
        $this->search_params = [
            'term' => '',
            'tipo_poliza_id' => '',
            'estado' => ''
        ];

        $this->resetForm();
    }

    public function render()
    {
        if($this->search_params['term'] !== '')
            $this->resetPage();

        $tipos_polizas = TipoPoliza::where('estado', 1)->get();

        $aseguradoras = Aseguradora::where('descripcion','LIKE','%'.$this->search_params['term'].'%');

        if($this->search_params['tipo_poliza_id'] != '')
            $aseguradoras->where('tipo_poliza_id', $this->search_params['tipo_poliza_id']);

        if($this->search_params['estado'] != '')
            $aseguradoras->where('estado', $this->search_params['estado']);
        
        $aseguradoras = $aseguradoras->with('tipo_poliza')->paginate(20);

        return view('livewire.masters.aseguradora-component', compact('aseguradoras', 'tipos_polizas'));
    }

    public function clearTerm(){
        $this->search_params['term'] = '';
        $this->resetPage();
    }

    public function openModal($row = null){
        if($row){
            $this->form['id'] = $row['id'];
            $this->form['descripcion'] = $row['descripcion'];
            $this->form['tipo_poliza_id'] = $row['tipo_poliza_id'];
        } else {
            $this->resetForm();
        }

        $this->dispatch('open-modal', $this->modalId);
    }

    public function save(){
        $this->validate([
            'form.descripcion' => 'required',
            'form.tipo_poliza_id' => 'required|numeric|min:1'
        ], [
            'form.descripcion.required' => 'El campo descripción es requerido',
            'form.tipo_poliza_id.required' => 'El campo tipo de póliza es requerido',
            'form.tipo_poliza_id.numeric' => 'El campo tipo de póliza debe ser numérico',
            'form.tipo_poliza_id.min' => 'El campo tipo de póliza debe ser mayor a 0'
        ]);

        if($this->form['id'] > 0){
            $row = Aseguradora::find($this->form['id']);
            $row->update($this->form);
        } else {
            Aseguradora::create($this->form);
        }

        $this->dispatch('close-modal', $this->modalId);
        $this->dispatch('msg', 'Datos de aseguradora guardado con éxito');
    }

    public function updateEstado(Aseguradora $aseguradora){
        $aseguradora->update(['estado' => $aseguradora->estado == 1 ? '0' : '1']);
        $this->dispatch('msg', 'Datos de aseguradora actualizado con éxito');
    }

    private function resetForm(){
        $this->form = [
            'id' => 0,
            'descripcion' => '',
            'tipo_poliza_id' => 0
        ];
    }
}
