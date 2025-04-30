<?php

namespace App\Repositories;
use App\Models\Sucursal;


class SucursalRepository
{
    public function create($data){
        return Sucursal::create($data);
    }

    public function search($filters = [], $fields = ['*'], $withs = []){
        $query = Sucursal::query();

        if(isset($filters['term']) && $filters['term'] !== ''){
            $term = $filters['term'];
            $query->where(function($query) use ($term){
                $query->where('nombre', 'like', '%'.$term.'%')
                    ->orWhere('email', 'like', '%'.$term.'%')
                    ->orWhere('telefono', 'like', '%'.$term.'%')
                    ->orWhere( 'direccion', 'like', '%'.$term.'%')
                    ->orWhere('codigo_local', 'like', '%'.$term.'%');
            });
        }

        if(isset($filters['estado']) && $filters['estado'] > -1){
            $query->where('estado', $filters['estado']);
        }

        if(count($withs) > 0){
            $query->with($withs);
        }

        return $query->select($fields);
    }

    public function update(Sucursal $sucursal, $data){
        $sucursal->update($data);
        return $sucursal;
    }

    public function updateState(Sucursal $sucursal){
        $sucursal->update(['estado' => $sucursal->estado == 1 ? 0 : 1]);
        return $sucursal;
    }
}
