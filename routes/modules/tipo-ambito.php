<?php

use App\Http\Controllers\Mantenimiento\TipoAmbitoController;
use Illuminate\Support\Facades\Route;

Route::get('/tipos-ambitos', [TipoAmbitoController::class, 'get']);
Route::post('/tipos-ambitos', [TipoAmbitoController::class, 'create']);
Route::put('/tipos-ambitos/{tipo}', [TipoAmbitoController::class, 'update']);
Route::patch('/tipos-ambitos/{tipo}/estado', [TipoAmbitoController::class, 'updateState']);