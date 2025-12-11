<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Reserva extends Model
{
    protected $fillable = [
        'cliente_id',
        'coche_id',
        'fecha_hora_llegada',
        'fecha_hora_recogida',
        'vuelo',
        'terminal',
        'precio',
        'estado',
        'numero_reserva',
        'eco_friendly',
    ];

    protected $casts = [
        'fecha_hora_llegada' => 'datetime',
        'fecha_hora_recogida' => 'datetime',
        'precio' => 'decimal:2',
        'eco_friendly' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($reserva) {
            if (empty($reserva->numero_reserva)) {
                $reserva->numero_reserva = 'HDR-' . strtoupper(Str::random(8));
            }
        });
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function coche(): BelongsTo
    {
        return $this->belongsTo(Coche::class);
    }
}