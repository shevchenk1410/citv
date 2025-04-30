<?php namespace App\Http\Controllers;

use App\Models\Aseguradora;
use App\Models\CategoriaVehicular;
use App\Models\TipoAmbito;
use App\Models\TipoInspeccion;
use App\Models\TipoServicio;
use App\Models\TipoPoliza;

class SistemaController extends Controller {

    public function get(){
        $params = request()->all();
        $result = [];


        if(isset($params['aseguradoras'])){
            $result['aseguradoras'] = Aseguradora::where('estado',1)->get();
        }

        if(isset($params['categorias'])){
            $result['categorias'] = CategoriaVehicular::where('estado',1)->get();
        }

        if(isset($params['tipos_ambito'])){
            $result['tipos_ambito'] = TipoAmbito::where('estado',1)->get();
        }

        if(isset($params['tipos_inspeccion'])){
            $result['tipos_inspeccion'] = TipoInspeccion::where('estado',1)->get();
        }

        if(isset($params['tipos_servicio'])){
            $result['tipos_servicio'] = TipoServicio::where('estado',1)->get();
        }

        if(isset($params['tipos_poliza'])){
            $result['tipos_poliza'] = TipoPoliza::where('estado',1)->get();
        }

        return response()->json($result);
    }

}