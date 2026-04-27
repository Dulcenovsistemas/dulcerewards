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
        Schema::create('encuestas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained()->cascadeOnDelete();
            $table->foreignId('movimiento_id')->nullable()->constrained('movimientos_puntos')->nullOnDelete();
            $table->foreignId('sucursal_id')
                                ->nullable()
                                ->constrained('sucursales')
                                ->nullOnDelete();
            $table->tinyInteger('calificacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encuestas');
    }
};
