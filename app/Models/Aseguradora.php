<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aseguradora extends Model
{
    use HasFactory;
    protected $table = 'aseguradora';

    protected $fillable = ['codigo', 'descripcion', 'tipo_poliza_id', 'estado'];

    public $timestamps = false;

    public function tipo_poliza(){
        return $this->belongsTo(TipoPoliza::class, 'tipo_poliza_id');
    
    }
}
