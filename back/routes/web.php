<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestEmailController; // Añade esto


// Rutas para pruebas de correo
Route::prefix('mail')->group(function () {
    // Verificar configuración de correo
    Route::get('/config', [TestEmailController::class, 'checkMailConfig']);
    
    // Enviar correo de prueba
    Route::post('/test', [TestEmailController::class, 'sendTestEmail']);
});


Route::get('/', function () {
    return view('welcome');
});
