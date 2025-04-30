<?php

use App\Http\Controllers\Mantenimiento\AseguradoraController;
use Illuminate\Support\Facades\Route;

Route::get('/aseguradoras', [AseguradoraController::class, 'search']);
Route::post('/aseguradoras', [AseguradoraController::class, 'create']);
Route::put('/aseguradoras/{aseguradora}', [AseguradoraController::class, 'update']);
Route::patch('/aseguradoras/{aseguradora}/estado', [AseguradoraController::class, 'updateState']);
