<?php

namespace App\Http\Controllers;

use App\Http\Requests\Usuario\CreateRequest;
use App\Http\Requests\Usuario\UpdateRequest;
use App\Models\Usuario;
use App\Repositories\UsuarioRepository;


class UsuarioController extends Controller
{
    public function __construct(public UsuarioRepository $repo)
    {}

    public function create(CreateRequest $request)
    {
        $params = $request->validated();
        $params['password'] = bcrypt($params['dni']);
        $this->repo->create($params);
        return response()->json(['message' => 'Usuario creado correctamente']);
    }

    public function search(){
        $params = request()->all();
        $query = $this->repo->search($params['filters'], $params['fields'] ?? ['*'], $params['withs'] ?? []);

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
    public function getAuth(){
        $auth = auth()->user()->load(['rol.menus' => function($query){
            $query->where('estado', 1)  // Solo menús estado = 1
                  ->with(['menus' => function($q){
                      $q->where('estado', 1)  // Solo submenús estado = 1
                        ->orderBy('orden');
                  }])
                  ->orderBy('orden');
        }]);

        return response()->json($auth);
    }

    public function update(Usuario $usuario, UpdateRequest $request){
        $this->repo->update($usuario, $request->validated());
        return response()->json(['message' => 'Usuario actualizado correctamente']);
    }

    public function updateState(Usuario $usuario)
    {
        $this->repo->updateState($usuario);
        return response()->json(['message' => 'Usuario actualizado correctamente']);
    }
}
