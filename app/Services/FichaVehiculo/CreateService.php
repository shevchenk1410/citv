<?php namespace App\Services\FichaVehiculo;

use App\Exceptions\InvalidProcessException;
use App\Models\CategoriaVehicular;
use App\Repositories\FichaVehiculoRepository;
use App\Repositories\OperacionDiariaRepository;

class CreateService {

    public static function execute($data){
        $repo = new FichaVehiculoRepository();
        $operacionRepo = new OperacionDiariaRepository();

        $currentOperacion = $operacionRepo->get([
            'sucursal_id' => auth()->user()->sucursal_id,
            'fecha' => date('Y-m-d')
        ])->first();

        if(!$currentOperacion)
            throw new InvalidProcessException('No se ha aperturado la operación para el día de hoy');

        $categoria = CategoriaVehicular::where('codigo', $data['CATEGORIA'])->first();

        $data = [
            'cliente_id' => 0,
            'cliente2_id' => 0,
            'sucursal_id' => auth()->user()->sucursal_id,
            'usuario_id' => auth()->id(),
            'CIOD_CITV' => $currentOperacion->CIOD_CITV,
            'PLACA' => $data['PLACA'],
            'CATEGORIA' => $data['CATEGORIA'],
            'TIPSERVICIO' => $data['TIPSERVICIO'],
            'TIPAMBITO' => $data['TIPAMBITO'],
            'TIPINSPECCION' => $data['TIPINSPECCION'],
            'NUM_FICHA' => 'F' . mt_rand(10000000,99999999),
            'CATEGORIA_DESC' => $categoria->descripcion,
            'MARCA' => 'HYUNDAY',
            'MODELO' => 'COUNTY',
            'ANOFAB' => 2010,
            'COMBUSTIBLE' => 'DIESEL',
            'VINSERCHA' => 'VIN123456',
            'NUMEROMOTOR' => 'MOTOR123456',
            'CARROCERIA' => 'BUS',
            'NUMEROEJES' => 2,
            'NUMERORUEDAS' => 4,
            'NUMEROASIENTOS' => 32,
            'NUMEROPASAJEROS' => 30,
            'LARGO' => 10.5,
            'ANCHO' => 2.5,
            'ALTO' => 3.5,
            'COLOR' => 'BLANCO',
            'PESONETO' => 1000,
            'PESOBRUTO' => 2000,
            'PESOUTIL' => 1500,
            'NUMDOC_ULTREV' => '',
            'FECDOC_ULTREV' => '',
            'RAZSOCCITV_ULTREV' => '',
            'OBS_ULTREV' => '',
            'TIPPOLIZA' => '',
            'ASEGURADORA' => 0,
            'NUMPOLIZA' => '',
            'FECINIPOLIZA' => null,
            'FECFINPOLIZA' => null,
            'MENSAJE' => null
        ];

        return $repo->create($data);
    }
}
