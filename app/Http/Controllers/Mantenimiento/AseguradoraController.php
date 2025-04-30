<?php

namespace App\Http\Controllers\Mantenimiento;

use App\Models\Aseguradora;
use App\Http\Controllers\Controller;
use App\Http\Requests\Aseguradora\CreateRequest;
use App\Http\Requests\Aseguradora\UpdateRequest;
use App\Repositories\AseguradoraRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AseguradoraController extends Controller
{
    public function __construct(public AseguradoraRepository $repo){}

    public function search(Request $request): JsonResponse
    {
        $params = $request->only('filters', 'fields', 'withs');
        $query = $this->repo->search($params['filters'] ?? [], $params['fields'] ?? ['*'], $params['withs'] ?? []);

        if($request->has('per_page')){
            $result = $query->paginate($request->input('per_page'));
            return response()->json(
                [
                    'data' => $result->items(),
                    'total' => $result->total(),
                ]
            );
        }
        else
            return response()->json($query->get());
    }

    public function create(CreateRequest $request): JsonResponse
    {
        $aseguradora = $this->repo->create($request->validated());
        return response()->json($aseguradora, 201);
    }

    public function update(Aseguradora $aseguradora, UpdateRequest $request): JsonResponse
    {
        $this->repo->update($aseguradora, $request->validated());
        return response()->json(['status' => true], 200);
    }

    public function updateState(Aseguradora $aseguradora): JsonResponse
    {
        $this->repo->updateState($aseguradora);
        return response()->json(['status' => true], 200);
    }
}