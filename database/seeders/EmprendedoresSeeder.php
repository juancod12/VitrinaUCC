<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\PerfilEmprendedores;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmprendedoresSeeder extends Seeder
{
    public function run(): void
    {
        $emprendedores = [
            [
                'user' => [
                    'name'     => 'Asociación Eco-Sierra',
                    'email'    => 'ecosierra@vitrinaucc.com',
                    'password' => Hash::make('password'),
                    'rol'      => 'emprendedor',
                    'activo'   => true,
                    'bloqueado'=> false,
                ],
                'perfil' => [
                    'nombre_negocio'  => 'Asociación Eco-Sierra',
                    'descripcion'     => 'Productores de café orgánico de alta montaña en la Sierra Nevada.',
                    'telefono'        => '3101234567',
                    'correo_contacto' => 'ecosierra@vitrinaucc.com',
                    'verificado'      => true,
                ],
            ],
            [
                'user' => [
                    'name'     => 'Artesanías del Sol',
                    'email'    => 'artesaniasdelsol@vitrinaucc.com',
                    'password' => Hash::make('password'),
                    'rol'      => 'emprendedor',
                    'activo'   => true,
                    'bloqueado'=> false,
                ],
                'perfil' => [
                    'nombre_negocio'  => 'Artesanías del Sol',
                    'descripcion'     => 'Bolsos y accesorios tejidos a mano por artesanas wayuu.',
                    'telefono'        => '3202345678',
                    'correo_contacto' => 'artesaniasdelsol@vitrinaucc.com',
                    'verificado'      => true,
                ],
            ],
            [
                'user' => [
                    'name'     => 'Apicultura Central',
                    'email'    => 'apicultura@vitrinaucc.com',
                    'password' => Hash::make('password'),
                    'rol'      => 'emprendedor',
                    'activo'   => true,
                    'bloqueado'=> false,
                ],
                'perfil' => [
                    'nombre_negocio'  => 'Apicultura Central',
                    'descripcion'     => 'Miel pura y productos derivados de la colmena, cosechados naturalmente.',
                    'telefono'        => '3153456789',
                    'correo_contacto' => 'apicultura@vitrinaucc.com',
                    'verificado'      => true,
                ],
            ],
            [
                'user' => [
                    'name'     => 'Huerta Verde UCC',
                    'email'    => 'huertaverde@vitrinaucc.com',
                    'password' => Hash::make('password'),
                    'rol'      => 'emprendedor',
                    'activo'   => true,
                    'bloqueado'=> false,
                ],
                'perfil' => [
                    'nombre_negocio'  => 'Huerta Verde UCC',
                    'descripcion'     => 'Kits y materiales para crear tu propia huerta urbana en casa.',
                    'telefono'        => '3164567890',
                    'correo_contacto' => 'huertaverde@vitrinaucc.com',
                    'verificado'      => true,
                ],
            ],
            [
                'user' => [
                    'name'     => 'Cultura Viva',
                    'email'    => 'culturaviva@vitrinaucc.com',
                    'password' => Hash::make('password'),
                    'rol'      => 'emprendedor',
                    'activo'   => true,
                    'bloqueado'=> false,
                ],
                'perfil' => [
                    'nombre_negocio'  => 'Cultura Viva',
                    'descripcion'     => 'Artesanías tradicionales colombianas con historia y valor cultural.',
                    'telefono'        => '3175678901',
                    'correo_contacto' => 'culturaviva@vitrinaucc.com',
                    'verificado'      => true,
                ],
            ],
            [
                'user' => [
                    'name'     => 'Esencias Naturales',
                    'email'    => 'esenciasnaturales@vitrinaucc.com',
                    'password' => Hash::make('password'),
                    'rol'      => 'emprendedor',
                    'activo'   => true,
                    'bloqueado'=> false,
                ],
                'perfil' => [
                    'nombre_negocio'  => 'Esencias Naturales',
                    'descripcion'     => 'Jabones, cremas y productos de belleza 100% naturales y artesanales.',
                    'telefono'        => '3186789012',
                    'correo_contacto' => 'esenciasnaturales@vitrinaucc.com',
                    'verificado'      => true,
                ],
            ],
        ];

        foreach ($emprendedores as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['user']['email']],
                $data['user']
            );

            PerfilEmprendedores::firstOrCreate(
                ['user_id' => $user->id],
                $data['perfil']
            );
        }
    }
}