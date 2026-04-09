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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('contenido');
            
            // Agregamos la columna para la calificación por estrellas
            // Se usa unsignedTinyInteger porque es un número pequeño (1-5)
            $table->unsignedTinyInteger('estrellas')->default(5);
            
            // Campos para la relación polimórfica
            $table->unsignedBigInteger('comentable_id');
            $table->string('comentable_type');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};