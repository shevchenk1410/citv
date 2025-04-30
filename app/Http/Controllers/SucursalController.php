<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sucursal\CreateRequest;
use App\Http\Requests\Sucursal\UpdateRequest;
use App\Models\Sucursal;
use App\Repositories\SucursalRepository;


class SucursalController extends Controller
{
    public function __construct(public SucursalRepository $repo)
    {}

    public function create(CreateRequest $request)
    {
        $params = $request->validated();
        $this->repo->create($params);
        return response()->json(['message' => 'Sucursal creada correctamente']);
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

    public function update(Sucursal $sucursal, UpdateRequest $request){
        $this->repo->update($sucursal, $request->validated());
        return response()->json(['message' => 'Sucursal actualizada correctamente']);
    }

    public function updateState(Sucursal $sucursal)
    {
        $this->repo->updateState($sucursal);
        return response()->json(['message' => 'Sucursal actualizada correctamente']);
    }
}
