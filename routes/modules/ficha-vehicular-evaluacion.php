<?php


use App\Http\Controllers\FichaVehiculoEvaluacionController;
use Illuminate\Support\Facades\Route;

Route::get('/fichas-vehiculares-elavuacion', [FichaVehiculoEvaluacionController::class, 'get']);
Route::post('/fichas-vehiculares-elavuacion', [FichaVehiculoEvaluacionController::class, 'create']);
Route::put('/fichas-vehiculares-elavuacion/{fichaVehiculoEvaluacion}', [FichaVehiculoEvaluacionController::class, 'update']);
Route::get('/fichas-vehiculares-elavuacion/{fichaVehiculoEvaluacion}', [FichaVehiculoEvaluacionController::class, 'show']);
