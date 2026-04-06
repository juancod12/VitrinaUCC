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
        // database/migrations/xxxx_add_rol_to_users_table.php
        Schema::table('users', function (Blueprint $table) {
            $table->enum('rol', ['admin', 'emprendedor', 'comprador'])->default('comprador')->after('email');
            $table->boolean('activo')->default(true)->after('rol');
            $table->boolean('bloqueado')->default(false)->after('activo');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
