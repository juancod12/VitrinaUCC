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
        Schema::create('publicacions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emprendedor_id')->constrained('perfil_emprendedors')->onDelete('cascade');
            $table->string('titulo');
            $table->text('contenido');
            $table->string('imagen')->nullable();
            $table->enum('seccion', ['hoy', 'vitrina'])->default('hoy');
            $table->enum('estado', ['activo', 'oculto'])->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publicacions');
    }
};
