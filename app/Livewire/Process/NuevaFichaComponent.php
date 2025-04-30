<?php

namespace App\Livewire\Process;

use App\Models\CategoriaVehicular;
use App\Models\TipoAmbito;
use App\Models\TipoInspeccion;
use App\Models\TipoPoliza;
use App\Models\TipoServicio;
use Livewire\Component;

class NuevaFichaComponent extends Component
{

    public $categorias;
    public $tipos_ambito;
    public $tipos_servicio;
    public $tipos_inspeccion;
    public $tipos_poliza;

    public function __construct(){
        $this->categorias = CategoriaVehicular::where('estado', 1)->get();
        $this->tipos_ambito = TipoAmbito::where('estado', 1)->get();
        $this->tipos_servicio = TipoServicio::where('estado', 1)->get();
        $this->tipos_inspeccion = TipoInspeccion::where('estado', 1)->get();
        $this->tipos_poliza = TipoPoliza::where('estado', 1)->get();
    }

    public function render()
    {
        return view('livewire.process.nueva-ficha-component');
    }
}
