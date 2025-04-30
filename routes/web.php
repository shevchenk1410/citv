<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

//Route::post('/login', [AuthController::class, 'doLogin'])->name('do-login');

Route::middleware('auth:sanctum')->group(function(){
  //Route::post('/salir', [AuthController::class, 'doLogout'])->name('logout');
});

/*
Route::middleware('guest')->group(function(){
  
});
*/

/*
Route::middleware('auth')->group(function(){
  Route::post('/salir', [AuthController::class, 'doLogout'])->name('logout');

  foreach (glob(__DIR__."/modules/*.php") as $filename){
		require $filename;
  }
});
*/
