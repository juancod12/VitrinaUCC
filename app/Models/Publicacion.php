<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    protected $fillable = ['emprendedor_id', 'titulo', 'contenido', 'imagen', 'seccion', 'estado'];

    public function emprendedor() { return $this->belongsTo(PerfilEmprendedor::class, 'emprendedor_id'); }
    public function comentarios() { return $this->hasMany(Comentario::class); }
}
