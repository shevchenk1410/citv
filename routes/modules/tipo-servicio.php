<?php

use App\Http\Controllers\Mantenimiento\TipoServicioController;
use Illuminate\Support\Facades\Route;

Route::get('/tipos-servicios', [TipoServicioController::class, 'get']);
Route::post('/tipos-servicios', [TipoServicioController::class, 'create']);
Route::put('/tipos-servicios/{tipo}', [TipoServicioController::class, 'update']);
Route::patch('/tipos-servicios/{tipo}/estado', [TipoServicioController::class, 'updateState']);
