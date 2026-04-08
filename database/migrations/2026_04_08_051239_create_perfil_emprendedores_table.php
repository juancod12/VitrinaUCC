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
        Schema::create('perfil_emprendedores', function (Blueprint $table) {
            $table->id();

            // Relación con users
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('nombre_negocio');
            $table->text('descripcion')->nullable();

            $table->string('logo')->nullable();
            $table->string('banner')->nullable();

            $table->string('telefono')->nullable();
            $table->string('correo_contacto')->nullable();
            $table->string('sitio_web')->nullable();

            $table->boolean('verificado')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfil_emprendedores');
    }
};
