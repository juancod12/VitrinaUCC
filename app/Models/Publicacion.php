<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
// ESTAS IMPORTACIONES SON VITALES PARA QUE NO DE ERROR "NOT FOUND"
use App\Models\PerfilEmprendedores;
use App\Models\Comentario;
use App\Models\MeEncanta;

class Publicacion extends Model
{
    protected $table = 'publicaciones';
    
    protected $fillable = [
        'emprendedor_id', 
        'titulo', 
        'slug', 
        'contenido', 
        'multimedia', 
        'tipo_multimedia', 
        'seccion', 
        'estado'
    ];

    // Boot para generar el slug automáticamente
    protected static function boot() {
        parent::boot();
        static::creating(function ($publicacion) {
            if (empty($publicacion->slug)) {
                $publicacion->slug = Str::slug($publicacion->titulo) . '-' . uniqid();
            }
        });
    }

    /**
     * Relación con el Perfil del Emprendedor
     */
    public function emprendedor() {
        return $this->belongsTo(PerfilEmprendedores::class, 'emprendedor_id');
    }

    /**
     * Obtener todos los comentarios (Relación Polimórfica)
     */
    public function comentarios()
    {
        return $this->morphMany(Comentario::class, 'comentable');
    }

    /**
     * Obtener todos los "Me encanta" (Relación Polimórfica)
     */
    public function meEncantas()
    {
        // Asegúrate de que en el modelo MeEncanta el método se llame 'interaccionable'
        return $this->morphMany(MeEncanta::class, 'interaccionable');
    }

    /**
     * Función auxiliar para saber si el usuario actual le dio "Me encanta"
     */
    public function isLikedBy($user)
    {
        if (!$user) return false;
        return $this->meEncantas()->where('user_id', $user->id)->exists();
    }
}