<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locacoes', function (Blueprint $table) {
            $table->id('id_loc');
            $table->dateTime('data_inicio_periodo_loc');
            $table->dateTime('data_final_previsto_periodo_loc');
            $table->dateTime('data_final_realizado_periodo_loc');
            $table->float('valor_diaria_loc', 8, 2);
            $table->integer('km_inicial_loc');
            $table->integer('km_final_loc');
            $table->unsignedBigInteger('id_cli_fk');
            $table->unsignedBigInteger('id_car_fk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locacoes');
    }
};