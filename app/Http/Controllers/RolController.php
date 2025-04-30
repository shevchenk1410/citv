<?php

namespace App\Http\Controllers;

use App\Http\Requests\Rol\CreateRequest;
use App\Http\Requests\Rol\UpdateRequest;
use App\Models\Rol;
use App\Repositories\RolRepository;


class RolController extends Controller
{
    public function __construct(public RolRepository $repo)
    {}

    public function create(CreateRequest $request)
    {
        $this->repo->create($request->validated());
        return response()->json(['message' => 'Rol creado correctamente']);
    }

    public function get(){
        $params = request()->all();
        $query = $this->repo->get($params['filters'], $params['fields'] ?? ['*'], $params['withs'] ?? []);

        if(isset($params['per_page'])){
            $paginateData = $query->paginate($params['per_page'])->toArray();
            $response = [
                'data' => $paginateData['data'],
                'total' => $paginateData['total'],
            ];
            return response()->json($response);
        }
        else
            return response()->json($query->get());
    }

    public function update(Rol $rol, UpdateRequest $request){
        $this->repo->update($rol, $request->validated());
        return response()->json(['message' => 'Rol actualizado correctamente']);
    }

    public function updateMenu(Rol $rol){
        $this->repo->updateMenu($rol, request()->get('menus'));
        return response()->json(['message' => 'Menu del Rol actualizado correctamente']);
    }

    public function updateEstado(Rol $rol)
    {
        $this->repo->updateState($rol);
        return response()->json(['message' => 'Rol actualizado correctamente']);
    }
}
