<?php

namespace App\Repositories;

use App\Models\FichaVehiculo;


class FichaVehiculoRepository
{
    public function create($data)
    {
        return FichaVehiculo::create($data);
    }

    public function get($wheres = [], $fields = ['*'], $withs = [])
    {
        $query = FichaVehiculo::query();

        // Filtro por término de búsqueda (PLACA)
        if (isset($wheres['term']) && $wheres['term'] !== '') {
            $term = $wheres['term'];
            $query->where('PLACA', 'LIKE', '%' . $term . '%');
        }

        // Filtro por sucursal
        if (isset($wheres['sucursal_id'])) {
            $query->where('sucursal_id', $wheres['sucursal_id']);
        }

        // Lógica de filtrado por fecha y estado
        if (isset($wheres['fecha']) && $wheres['fecha'] !== '') {
            $fechaHoy = $wheres['fecha'];
            $fechaLimite = date('Y-m-d', strtotime('-30 days')); // Fecha límite para fichas desaprobadas

            $query->where(function ($q) use ($fechaHoy, $fechaLimite) {
                // Fichas del día actual (cualquier estado)
                $q->whereDate('created_at', $fechaHoy)
                    // O fichas desaprobadas dentro del período de 30 días
                    ->orWhere(function ($subQ) use ($fechaLimite) {
                        $subQ->where('estado', 2) // Desaprobado
                            ->whereDate('created_at', '>', $fechaLimite); // Creadas dentro de los últimos 30 días
                    });
            });
        }

        // Agregar campo de días restantes para caducidad (solo para fichas desaprobadas)
        $query->selectRaw('*, CASE
                            WHEN estado = 2 THEN
                                GREATEST(0, DATEDIFF(DATE_ADD(created_at, INTERVAL 30 DAY), CURDATE()))
                            ELSE NULL
                          END as dias_restantes');

        // Cargar relaciones
        if (count($withs) > 0) {
            $query->with($withs);
        }

        return $query;
    }

    public function show(int $id)
    {
        return FichaVehiculo::with('evaluacion')->findOrFail($id);
    }

    public function update(FichaVehiculo $ficha, $data)
    {
        $ficha->update($data);
        return $ficha;
    }
}
