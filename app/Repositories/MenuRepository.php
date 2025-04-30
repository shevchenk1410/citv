<?php

namespace App\Repositories;

use App\Models\Menu as Model;

class MenuRepository
{
    public function create($data){
        return Model::create($data);
    }

    public function get($wheres = [], $fields = ['*'], $withs = []){
        $query = Model::query();

        if(isset($wheres['term']) && $wheres['term'] !== ''){
            $term = $wheres['term'];
            $query->where('nombre', 'LIKE', '%'.$term.'%');
        }

        if(isset($wheres['estado']) && $wheres['estado'] > -1){
            $query->where('estado', $wheres['estado']);
        }

        if(isset($wheres['padre_id']) && $wheres['padre_id'] >= 0){
            $query->where('padre_id', $wheres['padre_id']);
        }

        if(count($withs) > 0){
            $query->with($withs);
        }

        return $query->orderBy('padre_id')->orderBy('orden')->select($fields);
    }

    public function update(Model $model, $data){
        $model->update($data);
        return $model;
    }

    public function updateState(Model $model){
        $model->update(['estado' => $model->estado == 1 ? 0 : 1]);
        return $model;
    }
}
