<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('emprendedor_id')
                ->constrained('perfil_emprendedores')
                ->onDelete('cascade');

            // Cambia 'categories' por 'categorias'
            $table->foreignId('categoria_id')
                ->constrained('categorias') 
                ->onDelete('cascade');

            $table->string('nombre');
            $table->string('slug')->unique();

            $table->text('descripcion')->nullable();
            $table->decimal('precio', 10, 2);
            $table->integer('stock')->default(0);

            $table->string('imagen_principal')->nullable();

            $table->enum('estado', ['activo', 'inactivo', 'eliminado'])
                ->default('activo');

            $table->boolean('eliminado_admin')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};