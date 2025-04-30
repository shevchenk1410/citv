<?php

namespace App\Repositories;

use App\Models\Rol;

class RolRepository
{
    public function create($data){
        return Rol::create($data);
    }

    public function get($filters = [], $fields = ['*'], $withs = []){
        $query = Rol::query();

        if(isset($filters['term']) && $filters['term'] !== ''){
            $term = $filters['term'];
            $query->where('nombre', 'LIKE', '%'.$term.'%');
        }

        if(isset($filters['estado']) && $filters['estado'] > -1){
            $query->where('estado', $filters['estado']);
        }

        if(count($withs) > 0){
            $query->with($withs);
        }

        return $query->select($fields);
    }

    public function update(Rol $rol, $data){
        $rol->update($data);
        return $rol;
    }

    public function updateMenu(Rol $rol, $menus){
        $rol->menus()->sync($menus);
        return $rol;
    }

    public function updateState(Rol $rol){
        $rol->update(['estado' => $rol->estado == 1 ? 0 : 1]);
        return $rol;
    }
}
