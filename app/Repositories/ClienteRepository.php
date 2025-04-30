<?php

namespace App\Repositories;
use App\Models\Cliente;
use Illuminate\Support\Facades\Log;

class ClienteRepository
{
    public function create($data){
        return Cliente::create($data);
    }

    public function search($filters = [], $fields = ['*'], $withs = []){
        $query = Cliente::query();
        if(isset($filters['term']) && $filters['term'] !== ''){
            $query->where(function($query) use ($filters){
                $query->where('nombres', 'like', '%'.$filters['term'].'%')
                    ->orWhere('apellidos', 'like', '%'.$filters['term'].'%')
                    ->orWhere('numero_documento', 'like', '%'.$filters['term'].'%')
                    ->orWhere('email', 'like', '%'.$filters['term'].'%')
                    ->orWhere('telefono', 'like', '%'.$filters['term'].'%');
            });
        }

        if(isset($filters['estado']) && $filters['estado'] > -1)
            $query->where('estado', $filters['estado']);
        
        if(count($withs) > 0)
            $query->with($withs);

        return $query->select($fields);
    }

    public function update(Cliente $cliente, $data){
        $cliente->update($data);
        return $cliente;
    }

    public function updateState(Cliente $cliente){
        $cliente->update(['estado' => $cliente->estado == 1 ? 0 : 1]);
        return $cliente;
    }
}
