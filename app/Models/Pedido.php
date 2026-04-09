<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'comprador_id', 'total', 'estado',
        'direccion_entrega', 'metodo_pago', 'referencia_pago'
    ];

    protected $casts = ['total' => 'decimal:2'];

    public function comprador() { return $this->belongsTo(User::class, 'comprador_id'); }
    public function items() { return $this->hasMany(PedidoItem::class); }
}
