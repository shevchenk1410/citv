<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'rol';

    protected $fillable = [
        'nombre',
        'estado',
    ];

    public function scopeActivos($query)
    {
        return $query->where('estado', 1);
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'rol_menu', 'rol_id', 'menu_id');
    }
}
