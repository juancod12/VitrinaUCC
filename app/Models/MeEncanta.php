<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class MeEncanta extends Model
{
    // Nombre de la tabla (opcional si sigues la convención)
    protected $table = 'me_encantas';

    protected $fillable = ['user_id', 'interaccionable_id', 'interaccionable_type'];

    /**
     * Obtener el modelo al que pertenece el "Me encanta" (Producto o Publicacion).
     */
    public function interaccionable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * El usuario que dio el "Me encanta".
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}