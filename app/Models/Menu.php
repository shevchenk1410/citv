<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';

    protected $fillable = [
        'nombre',
        'url',
        'icono',
        'padre_id',
        'orden',
        'estado',
    ];

    public function menu(){
        return $this->belongsTo(Menu::class, 'padre_id', 'id');
    }

    public function menus(){
        return $this->hasMany(Menu::class, 'padre_id', 'id');
    }

    public function scopeActivo($query){
        return $query->where('estado', 1);
    }

    public function scopeOrdenado($query){
        return $query->orderBy('orden');
    }

    public function scopePadres($query){
        return $query->where('padre_id', 0);
    }
}
