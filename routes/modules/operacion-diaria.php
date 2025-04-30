<?php

use App\Http\Controllers\OperacionDiariaController;
use Illuminate\Support\Facades\Route;

Route::get('/operaciones-diarias', [OperacionDiariaController::class, 'get']);
Route::post('/operaciones-diarias', [OperacionDiariaController::class, 'create']);
Route::put('/operaciones-diarias/{operacion_diaria}', [OperacionDiariaController::class, 'update']);
Route::patch('/operaciones-diarias/{operacion_diaria}', [OperacionDiariaController::class, 'updateState']);
