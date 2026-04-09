<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Usuario admin de prueba
        User::firstOrCreate(
            ['email' => 'admin@vitrinaucc.com'],
            [
                'name'     => 'Administrador',
                'password' => Hash::make('password'),
                'rol'      => 'admin',
                'activo'   => true,
                'bloqueado'=> false,
            ]
        );

        // Usuario comprador de prueba
        User::firstOrCreate(
            ['email' => 'comprador@vitrinaucc.com'],
            [
                'name'     => 'Comprador Test',
                'password' => Hash::make('password'),
                'rol'      => 'comprador',
                'activo'   => true,
                'bloqueado'=> false,
            ]
        );

        // Orden importante: primero emprendedores, luego productos
        $this->call([
            EmprendedoresSeeder::class,
            ProductosSeeder::class,
        ]);
    }
}