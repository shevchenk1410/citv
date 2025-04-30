<?php

namespace App\Repositories;
use App\Models\Usuario;


class UsuarioRepository
{
    public function create($data){
        return Usuario::create($data);
    }

    public function search($wheres = [], $fields = ['*'], $withs = []){
        $query = Usuario::query();

        if(isset($wheres['term']) && $wheres['term'] !== ''){
            $term = $wheres['term'];
            $query->where(function($query) use ($term){
                $query->where('nombres', 'like', '%'.$term.'%')
                    ->orWhere('dni', 'like', '%'.$term.'%')
                    ->orWhere('apellidos', 'like', '%'.$term.'%')
                    ->orWhere('email', 'like', '%'.$term.'%')
                    ->orWhere('telefono', 'like', '%'.$term.'%');
            });
        }

        if(isset($wheres['estado']) && $wheres['estado'] > -1){
            $query->where('estado', $wheres['estado']);
        }

        if(isset($wheres['rol_id']) && $wheres['rol_id'] > 0){
            $query->where('rol_id', $wheres['rol_id']);
        }

        if(count($withs) > 0){
            $query->with($withs);
        }

        return $query->select($fields);
    }

    public function update(Usuario $usuario, $data){
        $usuario->update($data);
        return $usuario;
    }

    public function updateState(Usuario $usuario){
        $usuario->update(['estado' => $usuario->estado == 1 ? 0 : 1]);
        return $usuario;
    }
}
