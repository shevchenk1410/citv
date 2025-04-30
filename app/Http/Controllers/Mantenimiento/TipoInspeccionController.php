<?php namespace App\Http\Controllers\Mantenimiento;

use App\Models\TipoInspeccion as Model;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TipoInspeccionController extends Controller {

    public function get(Request $request){
        $params = $request->all();

        $rows = Model::query();
        
        if(isset($params['term']) && $params['term'] != '')
            $rows->where('descripcion','LIKE','%'.$params['term'].'%');

        if(isset($params['estado']) && $params['estado'] > -1)
            $rows->where('estado', $params['estado']);
        
        $rows = $rows->orderBy('codigo')->select(['id','codigo','descripcion','estado']);
        
        if(isset($params['per_page']))
            $rows = $rows->paginate($params['per_page']);
        else
            $rows = $rows->get();

        return response()->json($rows, 200);
    }

    public function create(){
        $params = request()->only('codigo','descripcion');
        $tipo = Model::create($params);
        return response()->json($tipo, 201);
    }

    public function update(Model $tipo){
        $params = request()->only('codigo','descripcion');
        $tipo->update($params);
        return response()->json(['status'=>true], 200);
    }

    public function updateState(Model $tipo){
        $tipo->update(['estado' => $tipo->estado == 1 ? '0' : '1']);
        return response()->json(['status'=>true], 200);
    }

}