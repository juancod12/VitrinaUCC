<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerfilComprador extends Model
{
    protected $fillable = ['user_id', 'telefono', 'ciudad', 'departamento', 'foto', 'bio'];

    public function user() { return $this->belongsTo(User::class); }
}
