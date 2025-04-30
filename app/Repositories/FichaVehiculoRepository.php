<?php

namespace App\Repositories;
use App\Models\FichaVehiculo;


class FichaVehiculoRepository
{
    public function create($data){
        return FichaVehiculo::create($data);
    }

    public function get($wheres = [], $fields = ['*'], $withs = []){
        $query = FichaVehiculo::query();

        if(isset($wheres['sucursal_id'])){
            $query->where('sucursal_id', $wheres['sucursal_id']);
        }

        if(isset($wheres['fecha'])){
            $query->where('fecha', $wheres['fecha']);
        }

        if(count($withs) > 0){
            $query->with($withs);
        }

        return $query->select($fields);
    }

    public function update(FichaVehiculo $ficha, $data){
        $ficha->update($data);
        return $ficha;
    }
}
