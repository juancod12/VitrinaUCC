<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    // Relaciones
    public function emprendedor()
    {
        return $this->belongsTo(PerfilEmprendedores::class, 'emprendedor_id');
    }

    public function imagenes() {
        return $this->hasMany(ImagenProducto::class, 'producto_id');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}