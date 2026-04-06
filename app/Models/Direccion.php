<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $fillable = ['user_id', 'direccion', 'ciudad', 'departamento', 'principal'];

    protected $casts = ['principal' => 'boolean'];

    public function user() { return $this->belongsTo(User::class); }
}
