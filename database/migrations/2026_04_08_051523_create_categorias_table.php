<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        $categorias = [
            'Artesanías y Manualidades',
            'Gastronomía y Comida Típica',
            'Repostería y Pastelería',
            'Moda y Textil',
            'Joyería y Bisutería',
            'Belleza y Cuidado Personal',
            'Decoración y Hogar',
            'Plantas y Jardinería',
            'Productos Orgánicos',
            'Tecnología y Gadgets',
            'Juguetería Didáctica',
            'Arte y Pintura',
            'Mascotas (Accesorios y Snacks)',
            'Bebidas Artesanales',
            'Papelería y Diseño',
            'Salud y Medicina Natural',
            'Calzado y Cuero',
            'Libros y Literatura',
            'Deportes y Vida Fit',
            'Eco-productos y Reciclaje'
        ];

        foreach ($categorias as $category) {
            DB::table('categorias')->insert([
                'nombre' => $category,
                'slug' => Str::slug($category),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};