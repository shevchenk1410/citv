<?php

namespace App\Repositories;
use App\Models\OperacionDiaria;


class OperacionDiariaRepository
{
    public function create($data){
        return OperacionDiaria::create($data);
    }

    public function get($wheres = [], $fields = ['*'], $withs = []){
        $query = OperacionDiaria::query();

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

    public function update(OperacionDiaria $operacion_diaria, $data){
        $operacion_diaria->update($data);
        return $operacion_diaria;
    }
}
