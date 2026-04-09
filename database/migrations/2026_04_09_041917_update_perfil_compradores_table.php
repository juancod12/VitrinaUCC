<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Si la tabla ya existe (con campos básicos), agregar columnas nuevas
        if (Schema::hasTable('perfil_compradors') || Schema::hasTable('perfil_compradores')) {
            $tabla = Schema::hasTable('perfil_compradors') ? 'perfil_compradors' : 'perfil_compradores';
            
            Schema::table($tabla, function (Blueprint $table) use ($tabla) {
                if (!Schema::hasColumn($tabla, 'ciudad')) {
                    $table->string('ciudad', 100)->nullable();
                }
                if (!Schema::hasColumn($tabla, 'departamento')) {
                    $table->string('departamento', 100)->nullable();
                }
                if (!Schema::hasColumn($tabla, 'bio')) {
                    $table->text('bio')->nullable();
                }
            });
        } else {
            // Si no existe, crearla completa
            Schema::create('perfil_compradors', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('telefono', 20)->nullable();
                $table->string('ciudad', 100)->nullable();
                $table->string('departamento', 100)->nullable();
                $table->string('foto')->nullable();
                $table->text('bio')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        // No eliminar en down para evitar pérdida de datos
    }
};