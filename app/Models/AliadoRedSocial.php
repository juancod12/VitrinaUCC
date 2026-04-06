<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AliadoRedSocial extends Model
{
    protected $fillable = ['aliado_id', 'plataforma', 'url'];

    public function aliado() { return $this->belongsTo(Aliado::class); }
}
