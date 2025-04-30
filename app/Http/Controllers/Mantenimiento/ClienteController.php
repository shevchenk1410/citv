<?php

namespace App\Http\Controllers\Mantenimiento;

use App\Models\Cliente;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cliente\CreateRequest;
use App\Http\Requests\Cliente\UpdateRequest;
use App\Repositories\ClienteRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ClienteController extends Controller
{
    public function __construct(public ClienteRepository $repo){}

    public function search(Request $request): JsonResponse
    {
        $params = $request->only('filters', 'fields', 'withs');
        $query = $this->repo->search($params['filters'], explode(',', $params['fields']), $params['withs']);

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
        $cliente = $this->repo->create($request->validated());
        return response()->json($cliente, 201);
    }

    public function update(Cliente $cliente, UpdateRequest $request): JsonResponse
    {
        $this->repo->update($cliente, $request->validated());
        return response()->json(['status' => true], 200);
    }

    public function updateState(Cliente $cliente): JsonResponse
    {
        $this->repo->updateState($cliente);
        return response()->json(['status' => true], 200);
    }
}