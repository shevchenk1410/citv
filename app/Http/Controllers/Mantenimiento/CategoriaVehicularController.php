<?php

namespace App\Http\Controllers\Mantenimiento;

use App\Models\CategoriaVehicular as Model;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoriaVehicularController extends Controller
{
    public function get(Request $request): JsonResponse
    {
        $params = $request->all();

        $query = Model::query();

        if (!empty($params['term'])) {
            $query->where('descripcion', 'LIKE', '%' . $params['term'] . '%');
        }

        if (isset($params['estado']) && $params['estado'] > -1) {
            $query->where('estado', $params['estado']);
        }

        $query->orderBy('codigo')->select(['id', 'codigo', 'descripcion', 'estado']);

        $rows = isset($params['per_page']) ? $query->paginate($params['per_page']) : $query->get();

        return response()->json($rows, 200);
    }

    public function create(Request $request): JsonResponse
    {
        $params = $request->only('codigo', 'descripcion');
        $tipo = Model::create($params);

        return response()->json($tipo, 201);
    }

    public function update(Request $request, Model $tipo): JsonResponse
    {
        $params = $request->only('codigo', 'descripcion');
        $tipo->update($params);

        return response()->json(['status' => true], 200);
    }

    public function updateState(Model $tipo): JsonResponse
    {
        $tipo->update(['estado' => $tipo->estado == 1 ? 0 : 1]);

        return response()->json(['status' => true], 200);
    }
}