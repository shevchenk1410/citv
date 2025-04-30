<?php

use App\Http\Controllers\FichaVehiculoController;
use Illuminate\Support\Facades\Route;

Route::get('/fichas-vehiculares', [FichaVehiculoController::class, 'get']);
Route::post('/fichas-vehiculares', [FichaVehiculoController::class, 'create']);
Route::put('/fichas-vehiculares/{ficha}', [FichaVehiculoController::class, 'update']);
Route::patch('/fichas-vehiculares/{ficha}/poliza', [FichaVehiculoController::class, 'updatePoliza']);
