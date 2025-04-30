<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/usuarios', [UsuarioController::class, 'search']);
Route::post('/usuarios', [UsuarioController::class, 'create']);
Route::put('/usuarios/{usuario}', [UsuarioController::class, 'update']);
Route::patch('/usuarios/{usuario}/estado', [UsuarioController::class, 'updateState']);

Route::get('/usuario', [UsuarioController::class, 'getAuth']);