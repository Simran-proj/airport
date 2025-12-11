<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\Reserva; 
class AdminController extends Controller
{
  // Listar horarios de un día específico y su disponibilidad
public function index(Request $request)
{
    $fecha = $request->query('fecha') ?? date('Y-m-d');

    $horas = ['09:00', '12:00', '16:00'];
    $horarios = [];

    foreach ($horas as $hora) {
        $fechaHora = $fecha . ' ' . $hora . ':00';
        $ocupada = Reserva::where('fecha_hora_llegada', $fechaHora)->exists();

        $horarios[] = [
            'fecha_hora' => $fechaHora,
            'disponible' => !$ocupada,
        ];
    }

    return response()->json(['success' => true, 'data' => $horarios]);
}

// Actualizar la disponibilidad manualmente (solo admin)
public function update(Request $request, $id)
{
    $validated = $request->validate([
        'disponible' => 'required|boolean',
    ]);

    $horario = Horario::findOrFail($id);
    $horario->update($validated);

    return response()->json([
        'success' => true,
        'message' => 'Horario actualizado',
        'data' => $horario
    ]);
}


    // Crear un horario
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fecha_hora' => 'required|date|unique:horarios,fecha_hora',
            'disponible' => 'required|boolean',
        ]);

        $horario = Horario::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Horario creado',
            'data' => $horario
        ]);
    }

    // Mostrar un horario
    public function show($id)
    {
        $horario = Horario::findOrFail($id);
        return response()->json(['success' => true, 'data' => $horario]);
    }

   
    // Eliminar horario
    public function destroy($id)
    {
        $horario = Horario::findOrFail($id);
        $horario->delete();

        return response()->json(['success' => true, 'message' => 'Horario eliminado']);
    }
}
