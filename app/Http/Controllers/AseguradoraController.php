<?php namespace App\Http\Controllers;

use App\Models\Aseguradora;
use Illuminate\Http\Request;

class AseguradoraController extends Controller {

    public function get(Request $request){
        $params = $request->all();

        $aseguradoras = Aseguradora::query();
        
        if(isset($params['term']) && $params['term'] != '')
            $aseguradoras->where('descripcion','LIKE','%'.$params['term'].'%');

        if(isset($params['tipo_poliza_id']) && $params['tipo_poliza_id'] != '')
            $aseguradoras->where('tipo_poliza_id', $params['tipo_poliza_id']);

        if(isset($params['estado']) && $params['estado'] > -1)
            $aseguradoras->where('estado', $params['estado']);
        
        $aseguradoras = $aseguradoras->with('tipo_poliza')->paginate($params['per_page'] ?? 20);

        return response()->json($aseguradoras, 200);
    }

    public function create(){

    }

    public function update(Aseguradora $aseguradora){

    }

    public function updateState(Aseguradora $aseguradora){
        $aseguradora->update(['estado' => $aseguradora->estado == 1 ? '0' : '1']);
        return response()->json(['status'=>true], 200);
    }

}