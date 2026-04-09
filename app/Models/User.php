<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use App\Models\Favorito;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
   // app/Models/User.php
    protected $fillable = ['name', 'email', 'password', 'rol', 'activo', 'bloqueado'];

    protected $casts = ['activo' => 'boolean', 'bloqueado' => 'boolean'];

    public function perfilComprador() { return $this->hasOne(PerfilComprador::class); }
    public function perfilEmprendedor()
    {
        return $this->hasOne(PerfilEmprendedores::class, 'user_id');
    }
    public function direcciones() { return $this->hasMany(Direccion::class); }
    public function comentarios() { return $this->hasMany(Comentario::class); }
    public function pedidos() { return $this->hasMany(Pedido::class, 'comprador_id'); }
    public function favoritos() { return $this->hasMany(Favorito::class); }
    public function productosFavoritos() { return $this->belongsToMany(Producto::class, 'favoritos'); }

    public function esAdmin() { return $this->rol === 'admin'; }
    public function esEmprendedor() { return $this->rol === 'emprendedor'; }
    public function esComprador() { return $this->rol === 'comprador'; }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
