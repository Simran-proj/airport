<?php

use App\Http\Controllers\ReservaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TestEmailController;
use Illuminate\Support\Facades\Route;
// Rutas para correo
Route::prefix('mail')->group(function () {
    Route::get('/config', [TestEmailController::class, 'checkMailConfig']);
    Route::post('/test', [TestEmailController::class, 'sendTestEmail']);
    
    // Nueva ruta para probar correo con datos de reserva
    Route::post('/test-booking', function () {
        try {
            // Crear una reserva de prueba
            $reserva = \App\Models\Reserva::with(['cliente', 'coche'])->latest()->first();
            
            if (!$reserva) {
                return response()->json([
                    'success' => false,
                    'message' => 'No hay reservas en la base de datos para probar'
                ]);
            }
            
            \Mail::to('simrrann00@gmail.com')
                ->send(new \App\Mail\BookingConfirmation($reserva));
            
            return response()->json([
                'success' => true,
                'message' => 'Correo de reserva de prueba enviado',
                'reserva_id' => $reserva->id,
                'reserva_reference' => $reserva->numero_reserva,
                'email' => $reserva->cliente->email
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    });
});

// Otras rutas existentes...
Route::get('/check-availability', [ReservaController::class, 'checkAvailability']);

Route::prefix('reservas')->group(function () {
    Route::post('/', [ReservaController::class, 'store']);
    Route::post('/buscar', [ReservaController::class, 'buscar']);
    Route::post('/buscar-por-nombre', [ReservaController::class, 'buscarPorNombre']);
    Route::post('/buscar-por-email', [ReservaController::class, 'buscarPorEmail']);
    Route::get('/{id}', [ReservaController::class, 'mostrar']);
    Route::put('/{id}', [ReservaController::class, 'actualizar']);
});

Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {
    Route::get('/reservas', [ReservaController::class, 'listar']);
    
    Route::prefix('horarios')->group(function () {
        Route::get('/', [AdminController::class, 'index']);
        Route::post('/', [AdminController::class, 'store']);
        Route::get('/{id}', [AdminController::class, 'show']);
        Route::put('/{id}', [AdminController::class, 'update']);
        Route::delete('/{id}', [AdminController::class, 'destroy']);
    });
});