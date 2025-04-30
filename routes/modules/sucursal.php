<?php

use App\Http\Controllers\SucursalController;
use Illuminate\Support\Facades\Route;

Route::get('/sucursales', [SucursalController::class, 'get']);
Route::post('/sucursales', [SucursalController::class, 'create']);
Route::put('/sucursales/{sucursal}', [SucursalController::class, 'update']);
Route::patch('/sucursales/{sucursal}/estado', [SucursalController::class, 'updateState']);
