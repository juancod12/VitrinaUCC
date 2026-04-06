<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aliado extends Model
{
    protected $fillable = ['nombre', 'logo', 'imagen_banner', 'descripcion', 'sitio_web', 'categoria', 'correo', 'telefono', 'activo', 'orden'];

    protected $casts = ['activo' => 'boolean'];

    public function redes() { return $this->hasMany(AliadoRedSocial::class); }
}
