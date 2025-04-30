<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAmbito extends Model
{
    use HasFactory;

    protected $table = 'tipo_ambito';

    protected $fillable = ['codigo', 'descripcion','estado'];

    public $timestamps = false;
}
