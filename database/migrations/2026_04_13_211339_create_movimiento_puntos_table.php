<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('movimientos_puntos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cliente_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sucursal_id')->constrained('sucursales')->cascadeOnDelete();
            $table->foreignId('usuario_id')->constrained('users')->cascadeOnDelete();

            $table->string('ciudad'); // clave para validación rápida

            $table->integer('puntos'); // +1, -10, etc.
            $table->enum('tipo', ['acumulado', 'canjeado']);

            $table->string('descripcion')->nullable(); // opcional (ej: compra, promo)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimiento_puntos');
    }
};
