<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoPago extends Model
{
    protected $fillable = ['emprendedor_id', 'banco', 'tipo_cuenta', 'numero_cuenta', 'titular', 'nit_cc'];

    public function emprendedor() { return $this->belongsTo(PerfilEmprendedor::class, 'emprendedor_id'); }
}
