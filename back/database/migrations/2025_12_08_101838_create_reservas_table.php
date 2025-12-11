<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('coche_id')->constrained('coches')->onDelete('cascade');
            $table->dateTime('fecha_hora_llegada');
            $table->dateTime('fecha_hora_recogida');
            $table->string('vuelo', 20)->nullable();
            $table->string('terminal', 10);
            $table->decimal('precio', 10, 2);
            
            // CAMBIO IMPORTANTE: Estados en inglés
            $table->enum('estado', [
                'pending',      // pendiente
                'confirmed',    // confirmada
                'completed',    // completada
                'cancelled'     // cancelada
            ])->default('pending');
            
            $table->string('numero_reserva', 50)->unique();
            $table->boolean('eco_friendly')->default(false);
            $table->string('service_type', 50)->nullable()->default('meet_greet');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};