<?php

use App\Http\Controllers\OperacionDiariaController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;

Route::post('reporte/generar-pdf', [PDFController::class, 'generarPDF']);
