<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function(){
	Route::post('/login', [AuthController::class, 'doLogin'])->name('do-login');
});


Route::middleware('auth:sanctum')->group(function(){
	foreach (glob(__DIR__."/modules/*.php") as $filename){
		require $filename;
	}
});