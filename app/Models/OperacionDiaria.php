<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperacionDiaria extends Model
{
    use HasFactory;

    protected $table = 'operacion_diaria';

    protected $fillable = [
        'sucursal_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'CODENTIDA',
        'CODLOCAL',
        'CODIV',
        'CIOD_CITV',
        'MENSAJE',
        'NUMTRADIA',
        'NUMCERTI',
        'NUMINFOR',
        'NUMANUL',
        //'ucierre',
    ];

    public function sucursal(){
        return $this->belongsTo(Sucursal::class);
    }
}
