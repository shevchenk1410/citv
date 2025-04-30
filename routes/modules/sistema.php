<?php

use App\Http\Controllers\SistemaController;
use Illuminate\Support\Facades\Route;

Route::get('/sistema', [SistemaController::class, 'get']);
