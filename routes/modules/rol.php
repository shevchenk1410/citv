<?php

use App\Http\Controllers\RolController;
use Illuminate\Support\Facades\Route;

Route::get('/roles', [RolController::class, 'get']);
Route::post('/roles', [RolController::class, 'create']);
Route::put('/roles/{rol}', [RolController::class, 'update']);
Route::put('/roles/{rol}/menu', [RolController::class, 'updateMenu']);
Route::patch('/roles/{rol}/estado', [RolController::class, 'updateEstado']);