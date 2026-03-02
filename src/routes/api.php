<?php
use App\Http\Controllers\PdfController;

Route::post('/invoice', [PdfController::class, 'invoice']);