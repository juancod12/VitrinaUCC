<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::create('publicaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emprendedor_id')->constrained('perfil_emprendedores')->onDelete('cascade');
            $table->string('titulo');
            $table->string('slug')->unique();
            $table->text('contenido');
            $table->string('multimedia')->nullable(); // Ruta del archivo
            $table->enum('tipo_multimedia', ['imagen', 'video', 'ninguno'])->default('ninguno');
            $table->string('seccion')->nullable(); // Ej: "Noticias", "Ofertas"
            $table->enum('estado', ['activo', 'borrador', 'oculto'])->default('activo');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publicaciones');
    }
};
