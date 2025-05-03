<?php

namespace App\Http\Controllers;

use App\Models\FichaVehiculoEvaluacion;
use App\Repositories\FichaVehiculoEvaluacionRepository;
use App\Http\Requests\FichaVehiculoEvaluacion\CreateRequest;
use App\Http\Requests\FichaVehiculoEvaluacion\UpdateRequest;


class FichaVehiculoEvaluacionController extends Controller
{
    public function __construct(public FichaVehiculoEvaluacionRepository $repo)
    {}

    public function update(FichaVehiculoEvaluacion $fichaVehiculoEvaluacion, UpdateRequest $request)
    {
        $evaluacionActualizada = $this->repo->update($fichaVehiculoEvaluacion, $request->validated());

        return response()->json([
            'message' => 'Evaluacion Tecnica del Vehiculo actualizada correctamente',
            'data' => $evaluacionActualizada  // 👈 esto retorna lo que guardó
        ]);
    }


    public function show(FichaVehiculoEvaluacion $ficha) {
        return response()->json($ficha);
    }

    public function create(CreateRequest $request)
    {
        $params = $request->validated();
        $ficha = $this->repo->create($params);
        return response()->json([
            'message' => 'FichaVehiculoEvaluacion creada correctamente',
            'data' => $ficha
        ]);
    }

    public function get(){
        $params = request()->all();
        $query = $this->repo->search($params['filters'], explode(',', $params['fields']), $params['withs'] ?? []);

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

    public function updateState(FichaVehiculoEvaluacion $fichaVehiculoEvaluacion)
    {
        $this->repo->updateState($fichaVehiculoEvaluacion);
        return response()->json(['message' => 'Evaluacion Tecnica del Vehiuclo actualizada correctamente']);
    }
}
