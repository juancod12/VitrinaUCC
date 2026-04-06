<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = ['user_id', 'publicacion_id', 'producto_id', 'contenido', 'eliminado_emprendedor', 'eliminado_admin'];

    protected $casts = ['eliminado_emprendedor' => 'boolean', 'eliminado_admin' => 'boolean'];

    public function user() { return $this->belongsTo(User::class); }
    public function publicacion() { return $this->belongsTo(Publicacion::class); }
    public function producto() { return $this->belongsTo(Producto::class); }
}
