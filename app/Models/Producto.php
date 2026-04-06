<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['emprendedor_id', 'nombre', 'descripcion', 'precio', 'stock', 'imagen_principal', 'estado', 'eliminado_admin'];

    protected $casts = ['eliminado_admin' => 'boolean', 'precio' => 'decimal:2'];

    public function emprendedor() { return $this->belongsTo(PerfilEmprendedor::class, 'emprendedor_id'); }
    public function imagenes() { return $this->hasMany(ImagenProducto::class); }
    public function comentarios() { return $this->hasMany(Comentario::class); }
}
