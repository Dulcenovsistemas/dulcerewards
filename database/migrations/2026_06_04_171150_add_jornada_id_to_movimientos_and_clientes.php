<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('movimientos_puntos', function (Blueprint $table) {

            $table->foreignId('jornada_id')
                ->nullable()
                ->after('id')
                ->constrained('jornadas')
                ->nullOnDelete();
        });

        Schema::table('clientes', function (Blueprint $table) {

            $table->foreignId('jornada_id')
                ->nullable()
                ->after('id')
                ->constrained('jornadas')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('movimientos_puntos', function (Blueprint $table) {
            $table->dropForeign(['jornada_id']);
            $table->dropColumn('jornada_id');
        });

        Schema::table('clientes', function (Blueprint $table) {
            $table->dropForeign(['jornada_id']);
            $table->dropColumn('jornada_id');
        });
    }
};