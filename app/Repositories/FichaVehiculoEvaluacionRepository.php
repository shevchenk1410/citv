<?php

namespace App\Repositories;

use App\Models\FichaVehiculoEvaluacion;


class FichaVehiculoEvaluacionRepository
{
    public function create($data)
    {
        return FichaVehiculoEvaluacion::create($data);
    }
    public function update(FichaVehiculoEvaluacion $fichaVehiculoEvaluacion, $data)
    {
        $fichaVehiculoEvaluacion->update($data);
        return $fichaVehiculoEvaluacion->fresh(); // Opcional, por si hay mutaciones
    }

    public function search($filters = [], $fields = ['*'], $withs = [])
    {
        $query = FichaVehiculoEvaluacion::query();

        if (isset($filters['term']) && $filters['term'] !== '') {
            $term = $filters['term'];
            $query->where(function ($query) use ($term) {
                $query->where('nombre', 'like', '%' . $term . '%')
                    ->orWhere('email', 'like', '%' . $term . '%')
                    ->orWhere('telefono', 'like', '%' . $term . '%')
                    ->orWhere('direccion', 'like', '%' . $term . '%')
                    ->orWhere('codigo_local', 'like', '%' . $term . '%');
            });
        }

        if (isset($filters['estado']) && $filters['estado'] > -1) {
            $query->where('estado', $filters['estado']);
        }

        if (count($withs) > 0) {
            $query->with($withs);
        }

        return $query->select($fields);
    }



    public function updateState(FichaVehiculoEvaluacion $fichaVehiculoEvaluacion)
    {
        $fichaVehiculoEvaluacion->update(['estado' => $fichaVehiculoEvaluacion->estado == 1 ? 0 : 1]);
        return $fichaVehiculoEvaluacion;
    }
}
