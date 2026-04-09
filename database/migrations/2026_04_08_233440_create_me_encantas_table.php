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
        Schema::create('me_encantas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Estos dos campos hacen la magia polimórfica
            $table->unsignedBigInteger('interaccionable_id'); // El ID (del producto o publicación)
            $table->string('interaccionable_type');         // El modelo (App\Models\Producto o App\Models\Publicacion)
            
            $table->timestamps();

            // Evita que un usuario de dos likes al mismo objeto
            $table->unique(['user_id', 'interaccionable_id', 'interaccionable_type'], 'user_like_unique');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('me_encantas');
    }
};
