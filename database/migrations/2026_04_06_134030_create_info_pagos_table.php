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
        Schema::create('info_pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emprendedor_id')->constrained('perfil_emprendedors')->onDelete('cascade');
            $table->string('banco');
            $table->string('tipo_cuenta');
            $table->string('numero_cuenta');
            $table->string('titular');
            $table->string('nit_cc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_pagos');
    }
};
