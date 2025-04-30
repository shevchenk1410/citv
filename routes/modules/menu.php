<?php

use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/menus', [MenuController::class, 'get']);
Route::post('/menus', [MenuController::class, 'create']);
Route::put('/menus/{menu}', [MenuController::class, 'update']);
Route::patch('/menus/{menu}/estado', [MenuController::class, 'updateEstado']);