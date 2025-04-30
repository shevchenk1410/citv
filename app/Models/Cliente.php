<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';

    protected $fillable = [
        'tipo_documento_id',
        'numero_documento',
        'nombres',
        'apellidos',
        'email',
        'telefono',
        'whatsapp',
        'estado'
    ];

    public function tipo_documento()
    {
        return $this->belongsTo(TipoDocumento::class);
    }
}
