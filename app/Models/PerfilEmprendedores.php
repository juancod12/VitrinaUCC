<?php

namespace App\Models;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class PerfilEmprendedores extends Model
{
        protected $fillable = [
        'user_id', 
        'nombre_negocio', 
        'descripcion', 
        'telefono', 
        'correo_contacto', 
        'sitio_web', 
        'logo', 
        'banner'
    ];

    protected $casts = ['verificado' => 'boolean'];

    public function user() { return $this->belongsTo(User::class); }
    public function redes() { return $this->hasMany(RedSocial::class, 'emprendedor_id'); }
    public function infoPagos() { return $this->hasOne(InfoPago::class, 'emprendedor_id'); }
    public function productos() { return $this->hasMany(Producto::class, 'emprendedor_id'); }
    public function servicios() { return $this->hasMany(Servicio::class, 'emprendedor_id'); }
    public function publicaciones() { return $this->hasMany(Publicacion::class, 'emprendedor_id'); }

    public function isComplete()
    {
        $camposObligatorios = [
            'nombre_negocio', 
            'descripcion', 
            'telefono', 
            'correo_contacto'
        ];

        foreach ($camposObligatorios as $campo) {
            if (empty($this->$campo)) {
                return false;
            }
        }

        return true;
    }
}
