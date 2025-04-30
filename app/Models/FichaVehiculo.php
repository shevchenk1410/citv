<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FichaVehiculo extends Model
{
    use HasFactory;

    protected $table = 'ficha_vehiculo';

    protected $fillable = [
        'cliente_id',
        'cliente2_id',
        'sucursal_id',
        'usuario_id',
        'CIOD_CITV',
        'PLACA',
        'CATEGORIA',
        'TIPSERVICIO',
        'TIPAMBITO',
        'TIPINSPECCION',
        'NUM_FICHA',
        'CATEGORIA_DESC',
        'MARCA',
        'MODELO',
        'ANOFAB',
        'COMBUSTIBLE',
        'VINSERCHA',
        'NUMEROMOTOR',
        'CARROCERIA',
        'NUMEROEJES',
        'NUMERORUEDAS',
        'NUMEROASIENTOS',
        'NUMEROPASAJEROS',
        'LARGO',
        'ANCHO',
        'ALTO',
        'COLOR',
        'PESONETO',
        'PESOBRUTO',
        'PESOUTIL',
        'NUMDOC_ULTREV',
        'FECDOC_ULTREV',
        'RAZSOCCITV_ULTREV',
        'OBS_ULTREV',
        'TIPPOLIZA',
        'ASEGURADORA',
        'NUMPOLIZA',
        'FECINIPOLIZA',
        'FECFINPOLIZA',
        'MENSAJE'
    ];

    public function sucursal(){
        return $this->belongsTo(Sucursal::class);
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function cliente2(){
        return $this->belongsTo(Cliente::class);
    }

    public function tipo_inspeccion(){
        return $this->belongsTo(TipoInspeccion::class, 'TIPINSPECCION', ownerKey: 'codigo');
    }
}
