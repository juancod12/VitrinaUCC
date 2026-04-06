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
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emprendedor_id')->constrained('perfil_emprendedors')->onDelete('cascade');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->decimal('precio_desde', 10, 2)->nullable();
            $table->string('modalidad')->nullable();
            $table->string('imagen')->nullable();
            $table->enum('estado', ['activo', 'inactivo', 'eliminado'])->default('activo');
            $table->boolean('eliminado_admin')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
