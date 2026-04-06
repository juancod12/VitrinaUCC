<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedSocial extends Model
{
    protected $fillable = ['emprendedor_id', 'plataforma', 'url'];

    public function emprendedor() { return $this->belongsTo(PerfilEmprendedor::class, 'emprendedor_id'); }
}
