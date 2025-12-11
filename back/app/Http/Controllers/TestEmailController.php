<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class TestEmailController extends Controller
{
    /**
     * Enviar correo de prueba
     */
    public function sendTestEmail(Request $request)
    {
        try {
            // Validar que el email esté presente
            $request->validate([
                'email' => 'required|email'
            ]);
            
            $email = $request->input('email');
            
            // Enviar correo
            Mail::to($email)->send(new BookingConfirmation());
            
            Log::info('Correo de prueba enviado a: ' . $email);
            
            return response()->json([
                'success' => true,
                'message' => 'Correo de prueba enviado exitosamente a ' . $email,
                'data' => [
                    'email' => $email,
                    'timestamp' => now()->toDateTimeString()
                ]
            ], 200);
            
        } catch (\Exception $e) {
            Log::error('Error al enviar correo de prueba: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error al enviar el correo: ' . $e->getMessage(),
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Verificar configuración de correo
     */
    public function checkMailConfig()
    {
        $config = [
            'mailer' => config('mail.default'),
            'host' => config('mail.mailers.smtp.host'),
            'port' => config('mail.mailers.smtp.port'),
            'from_address' => config('mail.from.address'),
            'from_name' => config('mail.from.name'),
            'encryption' => config('mail.mailers.smtp.encryption'),
        ];
        
        return response()->json([
            'success' => true,
            'mail_config' => $config
        ]);
    }
}