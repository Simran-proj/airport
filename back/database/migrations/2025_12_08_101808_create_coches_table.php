<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->string('marca', 50);
            $table->string('modelo', 50);
            $table->string('matricula', 20)->unique();
            $table->string('color', 30);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coches');
    }
};