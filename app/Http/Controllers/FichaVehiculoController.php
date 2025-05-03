<?php

namespace App\Http\Controllers;

use App\Http\Requests\FichaVehiculo\CreateRequest;
use App\Http\Requests\FichaVehiculo\UpdatePolizaRequest;
use App\Http\Requests\FichaVehiculo\UpdateRequest;
use App\Models\FichaVehiculo;
use App\Repositories\FichaVehiculoRepository;
use App\Services\FichaVehiculo\CreateService;

class FichaVehiculoController extends Controller
{

    public function __construct(public FichaVehiculoRepository $repo) {}

    public function create(CreateRequest $request)
    {
        return CreateService::execute($request->validated());
    }

    public function get()
    {
        $params = request()->all();

        if (auth()->user()->sucursal_id > 0)
            $params['wheres']['sucursal_id'] = auth()->user()->sucursal_id;

        // Extraer page y per_page manualmente de wheres (si los mandaste ahí)
        $perPage = $params['wheres']['per_page'] ?? null;
        $page = $params['wheres']['page'] ?? 1;  // Default page=1

        // Remover per_page y page de los wheres (no son filtros)
        unset($params['wheres']['per_page']);
        unset($params['wheres']['page']);

        $query = $this->repo->get(
            $params['wheres'] ?? [],
            $params['fields'] ?? ['*'],
            $params['withs'] ?? []
        )->orderBy('created_at', 'desc');

        if ($perPage) {
            $paginateData = $query->paginate($perPage, ['*'], 'page', $page)->toArray();
            $response = [
                'data' => $paginateData['data'],
                'total' => $paginateData['total'],
            ];
            return response()->json($response);
        } else {
            return response()->json($query->get());
        }
    }

    public function show($id)
    {
        $ficha = $this->repo->show($id);
        return response()->json($ficha);
    }

    public function update(FichaVehiculo $ficha, UpdateRequest $data)
    {
        $evaluacionActualizada = $this->repo->update($ficha, $data->validated());

        return response()->json([
            'message' => 'Ficha Vehiculo actualizada correctamente',
            'data' => $evaluacionActualizada  // 👈 esto retorna lo que guardó
        ]);
    }


    public function updatePoliza(FichaVehiculo $ficha, UpdatePolizaRequest $request)
    {
        $this->repo->update($ficha, $request->validated());

        return response()->json(['message' => 'Póliza actualizada']);
    }
}
