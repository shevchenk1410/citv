<?php namespace App\Http\Controllers;

use App\Http\Requests\FichaVehiculo\CreateRequest;
use App\Models\FichaVehiculo;
use App\Repositories\FichaVehiculoRepository;
use App\Services\FichaVehiculo\CreateService;

class FichaVehiculoController extends Controller {

    public function __construct(public FichaVehiculoRepository $repo)
    {}

    public function create(CreateRequest $request){
        return CreateService::execute($request->validated());
    }

    public function get(){
        $params = request()->all();

        if(auth()->user()->sucursal_id > 0)
            $params['wheres']['sucursal_id'] = auth()->user()->sucursal_id;

        $query = $this->repo->get($params['wheres'], $params['fields'] ?? ['*'], $params['withs'] ?? [])->orderBy('created_at','desc');

        if(isset($params['wheres']['per_page'])){
            $paginateData = $query->paginate($params['wheres']['per_page'])->toArray();
            $response = [
                'data' => $paginateData['data'],
                'total' => $paginateData['total'],
            ];
            return response()->json($response);
        }
        else
            return response()->json($query->get());
    }

    public function updatePoliza(FichaVehiculo $ficha){
        $params = request()->all(['TIPPOLIZA','NUMPOLIZA','FECINIPOLIZA','FECFINPOLIZA',]);
        $this->repo->update($ficha, $params);
        return response()->json(['message' => 'Poliza actualizada']);
    }
}