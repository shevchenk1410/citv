<?php

use App\Http\Controllers\Mantenimiento\TipoInspeccionController;
use Illuminate\Support\Facades\Route;

Route::get('/tipos-inspecciones', [TipoInspeccionController::class, 'get']);
Route::post('/tipos-inspecciones', [TipoInspeccionController::class, 'create']);
Route::put('/tipos-inspecciones/{tipo}', [TipoInspeccionController::class, 'update']);
Route::patch('/tipos-inspecciones/{tipo}/estado', [TipoInspeccionController::class, 'updateState']);