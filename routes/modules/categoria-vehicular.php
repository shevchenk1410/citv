<?php

use App\Http\Controllers\Mantenimiento\CategoriaVehicularController;
use Illuminate\Support\Facades\Route;

Route::get('/categorias-vehiculares', [CategoriaVehicularController::class, 'get']);
Route::post('/categorias-vehiculares', [CategoriaVehicularController::class, 'create']);
Route::put('/categorias-vehiculares/{tipo}', [CategoriaVehicularController::class, 'update']);
Route::patch('/categorias-vehiculares/{tipo}/estado', [CategoriaVehicularController::class, 'updateState']);