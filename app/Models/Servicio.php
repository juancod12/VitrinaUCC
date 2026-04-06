<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $fillable = ['emprendedor_id', 'nombre', 'descripcion', 'precio_desde', 'modalidad', 'imagen', 'estado', 'eliminado_admin'];

    protected $casts = ['eliminado_admin' => 'boolean'];

    public function emprendedor() { return $this->belongsTo(PerfilEmprendedor::class, 'emprendedor_id'); }
}
