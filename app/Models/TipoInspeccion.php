<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoInspeccion extends Model
{
    use HasFactory;

    protected $table = 'tipo_inspeccion';

    protected $fillable = [
        'codigo', 'descripcion', 'estado'
    ];

    public $timestamps = false;
}
