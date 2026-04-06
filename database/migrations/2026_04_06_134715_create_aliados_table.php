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
        Schema::create('aliados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('logo')->nullable();
            $table->string('imagen_banner')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('sitio_web')->nullable();
            $table->enum('categoria', ['empresa', 'institución', 'persona', 'entidad']);
            $table->string('correo')->nullable();
            $table->string('telefono')->nullable();
            $table->boolean('activo')->default(true);
            $table->integer('orden')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aliados');
    }
};
