<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Coche;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;
class ReservaController extends Controller
{
    /**
     * Genera un código de reserva de 5 caracteres mixtos (letras y números)
     * Formato: 1 letra + 3 números + 1 letra (ejemplo: A123B, C456D, X789Y)
     * 
     * @return string
     */
    private function generarCodigoReserva()
    {
        // Letras del alfabeto (sin vocales para evitar palabras ofensivas)
        $letras = 'BCDFGHJKLMNPQRSTVWXYZ';
        $numeros = '0123456789';
        
        // Generar primera letra
        $primeraLetra = $letras[random_int(0, strlen($letras) - 1)];
        
        // Generar 3 números
        $tresNumeros = '';
        for ($i = 0; $i < 3; $i++) {
            $tresNumeros .= $numeros[random_int(0, strlen($numeros) - 1)];
        }
        
        // Generar última letra
        $ultimaLetra = $letras[random_int(0, strlen($letras) - 1)];
        
        $codigo = $primeraLetra . $tresNumeros . $ultimaLetra;
        
        // Verificar que el código no exista ya
        if (Reserva::where('numero_reserva', $codigo)->exists()) {
            // Si existe, generar uno nuevo recursivamente
            return $this->generarCodigoReserva();
        }
        
        return $codigo;
    }
    
    /**
     * Genera un código de reserva alternativo (más aleatorio)
     * Formato: 2 letras + 2 números + 1 letra (ejemplo: AB12C, XY34Z)
     * 
     * @return string
     */
    private function generarCodigoReservaAlternativo()
    {
        // Caracteres permitidos (sin I, O, 0, 1 para evitar confusión)
        $letras = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
        $numeros = '23456789';
        
        // Generar 2 letras
        $dosLetras = '';
        for ($i = 0; $i < 2; $i++) {
            $dosLetras .= $letras[random_int(0, strlen($letras) - 1)];
        }
        
        // Generar 2 números
        $dosNumeros = '';
        for ($i = 0; $i < 2; $i++) {
            $dosNumeros .= $numeros[random_int(0, strlen($numeros) - 1)];
        }
        
        // Generar última letra
        $ultimaLetra = $letras[random_int(0, strlen($letras) - 1)];
        
        $codigo = $dosLetras . $dosNumeros . $ultimaLetra;
        
        // Verificar que el código no exista ya
        if (Reserva::where('numero_reserva', $codigo)->exists()) {
            return $this->generarCodigoReservaAlternativo();
        }
        
        return $codigo;
    }
    
    /**
     * Genera un código totalmente aleatorio de 5 caracteres
     * Puede ser cualquier combinación de letras mayúsculas y números
     * 
     * @return string
     */
    private function generarCodigoReservaAleatorio()
    {
        // Caracteres permitidos (sin I, O, 0, 1 para evitar confusión)
        $caracteres = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $codigo = '';
        
        for ($i = 0; $i < 5; $i++) {
            $codigo .= $caracteres[random_int(0, strlen($caracteres) - 1)];
        }
        
        // Verificar que el código no exista ya
        if (Reserva::where('numero_reserva', $codigo)->exists()) {
            return $this->generarCodigoReservaAleatorio();
        }
        
        return $codigo;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Datos del cliente
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'telefono' => 'required|string|max:20',

            // Datos del coche
            'marca' => 'required|string|max:50',
            'modelo' => 'required|string|max:50',
            'matricula' => 'required|string|max:20',
            'color' => 'required|string|max:30',

            // Datos de la reserva
            'fecha_hora_llegada' => 'required|date',
            'fecha_hora_recogida' => 'required|date|after:fecha_hora_llegada',
            'vuelo' => 'nullable|string|max:20',
            'terminal' => 'required|string|max:10',
            'precio' => 'required|numeric|min:0',
            'eco_friendly' => 'boolean',
            'service_type' => 'nullable|string|max:50',
            'duration_days' => 'nullable|integer|min:1',
        ]);

        // Validar horas permitidas (07:00, 09:00, 11:00, 13:00, 14:00)
        $horaPermitida = date('H:i', strtotime($validated['fecha_hora_llegada']));
        $horasPermitidas = ['07:00', '09:00', '11:00', '13:00', '14:00'];
        
        if (!in_array($horaPermitida, $horasPermitidas)) {
            return response()->json([
                'success' => false,
                'message' => 'Selected time is not valid. Please choose: 07:00, 09:00, 11:00, 13:00, or 14:00.'
            ], 400);
        }

        // Verificar si la hora ya está ocupada
        $existeReserva = Reserva::where('fecha_hora_llegada', $validated['fecha_hora_llegada'])
            ->exists();

        if ($existeReserva) {
            return response()->json([
                'success' => false,
                'message' => 'Time slot already booked. Please choose another time.'
            ], 400);
        }

        try {
            DB::beginTransaction();

            // Crear o encontrar cliente
            $cliente = Cliente::firstOrCreate(
                ['email' => $validated['email']],
                [
                    'nombre' => $validated['nombre'],
                    'telefono' => $validated['telefono'],
                ]
            );

            // Crear o encontrar coche
            $coche = Coche::firstOrCreate(
                ['matricula' => $validated['matricula']],
                [
                    'cliente_id' => $cliente->id,
                    'marca' => $validated['marca'],
                    'modelo' => $validated['modelo'],
                    'color' => $validated['color'],
                ]
            );

            // Generar código de reserva único
            $codigoReserva = $this->generarCodigoReservaAleatorio(); // Puedes elegir el método que prefieras

            // Crear reserva
            $reserva = Reserva::create([
                'cliente_id' => $cliente->id,
                'coche_id' => $coche->id,
                'fecha_hora_llegada' => $validated['fecha_hora_llegada'],
                'fecha_hora_recogida' => $validated['fecha_hora_recogida'],
                'vuelo' => $validated['vuelo'] ?? null,
                'terminal' => $validated['terminal'],
                'precio' => $validated['precio'],
                'eco_friendly' => $validated['eco_friendly'] ?? false,
                'service_type' => $validated['service_type'] ?? 'meet_greet',
                'estado' => 'confirmed',
                'numero_reserva' => $codigoReserva, // Asignar el código generado
            ]);

            DB::commit();

            // ENVIAR CORREO DESPUÉS DE COMMIT
            try {
                Mail::to($cliente->email)
                    ->cc(env('MAIL_ADMIN_CC', 'admin@heathrow-airpark.com'))
                    ->send(new BookingConfirmation($reserva));
                
                \Log::info("Email sent successfully to: {$cliente->email}");
            } catch (\Exception $emailError) {
                \Log::error("Failed to send email: " . $emailError->getMessage());
                // NO hacemos rollback si falla el email, solo log
            }

            return response()->json([
                'success' => true,
                'message' => 'Booking created successfully',
                'email_sent' => true, // Indicar si se envió el email
                'data' => [
                    'numero_reserva' => $reserva->numero_reserva,
                    'reserva' => $reserva->load(['cliente', 'coche']),
                ]
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error creating booking',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Search by booking reference (existing)
    public function buscar(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'numero_reserva' => 'required|string',
        ]);

        $reserva = Reserva::with(['cliente', 'coche'])
            ->whereHas('cliente', function($query) use ($validated) {
                $query->where('email', $validated['email']);
            })
            ->where('numero_reserva', $validated['numero_reserva'])
            ->first();

        if (!$reserva) {
            return response()->json([
                'success' => false,
                'message' => 'Booking not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $this->formatBookingResponse($reserva)
        ]);
    }

    // NEW: Search by customer name and email
    public function buscarPorNombre(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email',
        ]);

        // Split full name into first and last name for better search
        $nameParts = explode(' ', trim($validated['nombre']));
        $firstName = $nameParts[0];
        $lastName = count($nameParts) > 1 ? end($nameParts) : '';

        $reserva = Reserva::with(['cliente', 'coche'])
            ->whereHas('cliente', function($query) use ($validated, $firstName, $lastName) {
                $query->where('email', $validated['email'])
                      ->where(function($q) use ($validated, $firstName, $lastName) {
                          // Search by full name
                          $q->where('nombre', 'LIKE', '%' . $validated['nombre'] . '%')
                            // Or by first name
                            ->orWhere('nombre', 'LIKE', $firstName . '%')
                            // Or by last name if provided
                            ->when($lastName, function($query) use ($lastName) {
                                return $query->orWhere('nombre', 'LIKE', '%' . $lastName . '%');
                            });
                      });
            })
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$reserva) {
            return response()->json([
                'success' => false,
                'message' => 'No booking found for this name and email'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $this->formatBookingResponse($reserva)
        ]);
    }

    // NEW: Search by email only (returns all bookings for that email)
    public function buscarPorEmail(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $reservas = Reserva::with(['cliente', 'coche'])
            ->whereHas('cliente', function($query) use ($validated) {
                $query->where('email', $validated['email']);
            })
            ->orderBy('fecha_hora_llegada', 'desc')
            ->get();

        if ($reservas->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No bookings found for this email'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $reservas->map(function($reserva) {
                return $this->formatBookingResponse($reserva);
            })
        ]);
    }

    // Helper method to format booking response
    private function formatBookingResponse($reserva)
    {
        return [
            'numero_reserva' => $reserva->numero_reserva,
            'cliente' => [
                'nombre' => $reserva->cliente->nombre,
                'email' => $reserva->cliente->email,
                'telefono' => $reserva->cliente->telefono,
            ],
            'coche' => [
                'marca' => $reserva->coche->marca,
                'modelo' => $reserva->coche->modelo,
                'matricula' => $reserva->coche->matricula,
                'color' => $reserva->coche->color,
            ],
            'fecha_hora_llegada' => $reserva->fecha_hora_llegada,
            'fecha_hora_recogida' => $reserva->fecha_hora_recogida,
            'vuelo' => $reserva->vuelo,
            'terminal' => $reserva->terminal,
            'precio' => $reserva->precio,
            'eco_friendly' => $reserva->eco_friendly,
            'service_type' => $reserva->service_type,
            'estado' => $reserva->estado,
            'created_at' => $reserva->created_at,
        ];
    }

    public function actualizar(Request $request, $id)
    {
        $validated = $request->validate([
            'estado' => 'sometimes|in:pending,confirmed,completed,cancelled',
            'fecha_hora_llegada' => 'sometimes|date',
            'fecha_hora_recogida' => 'sometimes|date|after:fecha_hora_llegada',
            'terminal' => 'sometimes|string|max:10',
            'vuelo' => 'nullable|string|max:20',
        ]);

        $reserva = Reserva::findOrFail($id);
        $reserva->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Booking updated successfully',
            'data' => $reserva->load(['cliente', 'coche'])
        ]);
    }

    public function listar()
    {
        $reservas = Reserva::with(['cliente', 'coche'])
            ->orderBy('fecha_hora_llegada', 'desc')
            ->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $reservas
        ]);
    }
public function checkAvailability(Request $request)
{
    $validated = $request->validate([
        'date' => 'required|date_format:Y-m-d'
    ]);

    $date = $validated['date'];
    
    // Definir todas las horas disponibles
    $allTimes = ['07:00', '09:00', '11:00', '13:00', '14:00'];
    
    // Obtener todas las horas reservadas para esta fecha (TANTO de llegada como de recogida)
    $bookedTimes = Reserva::whereDate('fecha_hora_llegada', $date)
        ->orWhereDate('fecha_hora_recogida', $date)
        ->get()
        ->flatMap(function ($reserva) use ($date) {
            $times = [];
            
            // Si es la fecha de llegada
            if (date('Y-m-d', strtotime($reserva->fecha_hora_llegada)) === $date) {
                $times[] = date('H:i', strtotime($reserva->fecha_hora_llegada));
            }
            
            // Si es la fecha de recogida
            if (date('Y-m-d', strtotime($reserva->fecha_hora_recogida)) === $date) {
                $times[] = date('H:i', strtotime($reserva->fecha_hora_recogida));
            }
            
            return $times;
        })
        ->unique()
        ->values()
        ->toArray();

    // Filtrar horas disponibles
    $availableTimes = array_filter($allTimes, function ($time) use ($bookedTimes) {
        return !in_array($time, $bookedTimes);
    });

    return response()->json([
        'success' => true,
        'date' => $date,
        'all_times' => $allTimes,
        'booked_times' => $bookedTimes,
        'available_times' => array_values($availableTimes),
        'available_count' => count($availableTimes),
        'max_slots_per_day' => 5,
        'message' => count($availableTimes) . ' of 5 slots available for ' . $date
    ]);
}
    public function mostrar($id)
    {
        $reserva = Reserva::with(['cliente', 'coche'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $this->formatBookingResponse($reserva)
        ]);
    }
}