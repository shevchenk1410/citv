<?php

namespace App\Http\Controllers;

use App\Http\Requests\Menu\CreateRequest;
use App\Http\Requests\Menu\UpdateRequest;
use App\Models\Menu as Model;
use App\Repositories\MenuRepository as Repo;


class MenuController extends Controller
{
    public function __construct(public Repo $repo)
    {}

    public function create(CreateRequest $request)
    {
        $this->repo->create($request->validated());
        return response()->json(['message' => 'Menu creado correctamente']);
    }

    public function get(){
        $params = request()->all();
        $query = $this->repo->get($params['wheres'] ?? [], $params['fields'] ?? ['*'], $params['withs'] ?? []);

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

    public function update(Model $menu, UpdateRequest $request){
        $this->repo->update($menu, $request->validated());
        return response()->json(['message' => 'Menu actualizado correctamente']);
    }

    public function updateEstado(Model $menu)
    {
        $this->repo->updateState($menu);
        return response()->json(['message' => 'Menu actualizado correctamente']);
    }
}
