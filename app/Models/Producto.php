<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Producto extends Model
{
    protected $fillable = [
        'emprendedor_id',
        'categoria_id',
        'nombre',
        'slug',
        'descripcion',
        'precio',
        'stock',
        'imagen_principal',
        'estado',
        'eliminado_admin'
    ];

    protected $casts = [
        'eliminado_admin' => 'boolean',
        'precio' => 'decimal:2'
    ];

    // 🔥 SLUG automático
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($producto) {
            $slug = Str::slug($producto->nombre);
            $count = self::where('slug', 'LIKE', "{$slug}%")->count();
            $producto->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }

    // --- RELACIONES ---

    public function emprendedor()
    {
        return $this->belongsTo(PerfilEmprendedores::class, 'emprendedor_id');
    }

    public function imagenes() {
        return $this->hasMany(ImagenProducto::class, 'producto_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    /**
     * Relación polimórfica para Comentarios
     */
    public function comentarios(): MorphMany
    {
        return $this->morphMany(Comentario::class, 'comentable');
    }

    /**
     * Relación polimórfica para Me Encanta
     */
    public function meEncantas(): MorphMany
    {
        return $this->morphMany(MeEncanta::class, 'interaccionable');
    }

    // --- MÉTODOS DE APOYO (HELPERS) ---

    /**
     * 🔥 ESTO ES LO QUE FALTA PARA TU ERROR 500
     * Verifica si el usuario actual le dio "Me gusta"
     */
    public function isLikedBy($user): bool
    {
        if (!$user) return false;

        return $this->meEncantas()
                    ->where('user_id', $user->id)
                    ->exists();
    }
}