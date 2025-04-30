<?php

namespace App\Repositories;
use App\Models\Aseguradora;

class AseguradoraRepository
{
    public function create($data){
        return Aseguradora::create($data);
    }

    public function search($filters = [], $fields = ['*'], $withs = []){
        $query = Aseguradora::query();
        if(isset($filters['term']) && $filters['term'] !== ''){
            $query->where(function($query) use ($filters){
                $query->where('descripcion', 'like', '%'.$filters['term'].'%');
            });
        }

        if(isset($filters['tipo_poliza_id']) && $filters['tipo_poliza_id'] > 0)
            $query->where('tipo_poliza_id', $filters['tipo_poliza_id']);

        if(isset($filters['estado']) && $filters['estado'] > -1)
            $query->where('estado', $filters['estado']);
        
        if(count($withs) > 0)
            $query->with($withs);

        return $query->select($fields);
    }

    public function update(Aseguradora $aseguradora, $data){
        $aseguradora->update($data);
        return $aseguradora;
    }

    public function updateState(Aseguradora $aseguradora){
        $aseguradora->update(['estado' => $aseguradora->estado == 1 ? 0 : 1]);
        return $aseguradora;
    }
}
