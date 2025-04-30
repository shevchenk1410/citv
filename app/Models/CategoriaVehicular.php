<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaVehicular extends Model
{
    use HasFactory;

    protected $table = 'categoria_vehicular';

    protected $fillable = [
        'codigo', 'descripcion', 'estado'
    ];

    public $timestamps = false;
}
