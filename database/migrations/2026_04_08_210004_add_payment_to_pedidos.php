<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->enum('metodo_pago', ['pse', 'tarjeta', 'contra_entrega'])->default('contra_entrega')->after('estado');
            $table->string('referencia_pago', 50)->nullable()->after('metodo_pago');
        });
    }

    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropColumn(['metodo_pago', 'referencia_pago']);
        });
    }
};
