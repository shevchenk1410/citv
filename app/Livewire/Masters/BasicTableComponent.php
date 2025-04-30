<?php

namespace App\Livewire\Masters;

use Livewire\Component;

class BasicTableComponent extends Component
{

    public $modalId = 'rowModal';

    public $model;

    public $title;

    public $data;

    public $form;

    public $table;

    public function mount(){
        $this->resetForm();
        $this->model = new $this->model;
        $this->getData();
    }

    public function render()
    {
        return view('livewire.masters.basic-table-component');
    }

    public function getData(){
        $this->data = $this->model->all();
    }

    public function openModal($row = null){
        if($row){
            $this->form['id'] = $row['id'];
            $this->form['codigo'] = $row['codigo'];
            $this->form['descripcion'] = $row['descripcion'];
        } else {
            $this->resetForm();
        }

        $this->dispatch('open-modal', $this->modalId);
    }

    public function save(){
        $this->validate([
            'form.codigo' => ['required', $this->form['id'] > 0 ? 'unique:'.$this->table.',codigo,'.$this->form['id'] : 'unique:'.$this->table.',codigo'],
            'form.descripcion' => 'required'
        ], [
            'form.codigo.required' => 'El campo código es requerido',
            'form.codigo.unique' => 'El código ya se encuentra registrado',
            'form.descripcion.required' => 'El campo descripción es requerido'
        ]);

        if($this->form['id'] > 0){
            $row = $this->model->find($this->form['id']);
            $row->update($this->form);
        } else {
            $this->model->create($this->form);
        }

        $this->dispatch('close-modal', $this->modalId);
        $this->dispatch('msg', 'Datos guardado con éxito');
        $this->getData();
    }

    public function updateEstado($id){
        $row = $this->model->find($id);
        $row->update(['estado' => $row->estado == 1 ? '0' : '1']);
        $this->dispatch('msg', 'Datos actualizado con éxito');
    }

    private function resetForm(){
        $this->form = [
            'id' => 0,
            'codigo' => '',
            'descripcion' => ''
        ];
    }
}
