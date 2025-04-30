<?php

use App\Http\Controllers\Mantenimiento\ClienteController;
use Illuminate\Support\Facades\Route;

Route::get("/clientes", [ClienteController::class, 'search']);
Route::post("/clientes", [ClienteController::class, 'create']);
Route::put("/clientes/{cliente}", [ClienteController::class, 'update']);
Route::patch("/clientes/{cliente}/estado", [ClienteController::class, 'updateState']);