<?php

namespace App\Http\Controllers;

//use App\Http\Requests\OperacionDiaria\CreateRequest;
//use App\Http\Requests\OperacionDiaria\UpdateRequest;
use App\Models\OperacionDiaria;
use App\Models\Sucursal;
use App\Repositories\OperacionDiariaRepository;
use Illuminate\Http\Request;

class OperacionDiariaController extends Controller
{
    public function __construct(public OperacionDiariaRepository $repo)
    {}

    public function create(Request $request)
    {
        $sucursal = Sucursal::find($request->sucursal_id);

        // Validar si ya existe registro con la sucursal_id y fecha
        $operacion_diaria = $this->repo->get(['sucursal_id' => $request->sucursal_id, 'fecha' => date('Y-m-d')])->first();
        if($operacion_diaria)
            return response()->json(['message' => 'Ya existe un registro de operacion diaria para la sucursal seleccionada'], 400);

        $this->repo->create([
            'sucursal_id' => $request->sucursal_id,
            'fecha' => date('Y-m-d'),
            'hora_inicio' => date('H:i:s'),
            'CODLOCAL' => $sucursal->codigo_local,
            'CODENTIDA' => 'E00000001',
            'CODIV' => 'XYL54ENGMKA49FG21',
            'CIOD_CITV' => 'CITV' . mt_rand(10000000,99999999),
        ]);
        return response()->json(['message' => 'Registro de operacion diaria creado correctamente']);
    }

    public function get(){
        $params = request()->all();

        if(auth()->user()->sucursal_id > 0)
            $params['wheres']['sucursal_id'] = auth()->user()->sucursal_id;

        $query = $this->repo->get($params['wheres'], $params['fields'] ?? ['*'], $params['withs'] ?? []);

        if(isset($params['wheres']['per_page'])){
            $paginateData = $query->paginate($params['wheres']['per_page'])->toArray();
            $response = [
                'data' => $paginateData['data'],
                'total' => $paginateData['total'],
            ];
            return response()->json($response);
        }
        else
            return response()->json($query->get());
    }

    /*
    public function update(OperacionDiaria $operacion_diaria, UpdateRequest $request){
        $this->repo->update($operacion_diaria, $request->validated());
        return response()->json(['message' => 'OperacionDiaria actualizada correctamente']);
    }*/
}
