<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comentario extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar masivamente.
     * * CRÍTICO: Se añade 'estrellas' para que el controlador pueda guardarlo.
     */
    protected $fillable = [
        'user_id',
        'contenido',
        'estrellas',
        'comentable_id',
        'comentable_type',
    ];

    /**
     * Obtener el modelo poseedor del comentario (Publicación o Producto).
     * Esto habilita la relación polimórfica en tu base de datos.
     */
    public function comentable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Obtener el usuario que realizó el comentario.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function getFechaHumanizadaAttribute()
    {
        return $this->created_at->diffForHumans();
    }

}
