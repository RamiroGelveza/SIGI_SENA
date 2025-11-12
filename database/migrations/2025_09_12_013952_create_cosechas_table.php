<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cosechas', function (Blueprint $table) {
            $table->id();
            $table->date('fechaCreacion')->default(DB::raw('CURRENT_DATE'));
            $table->date('fechaSiembra');
            $table->date('fechaCosechaEstimada');
            $table->date('fechaCosechaReal');
            $table->integer('cantidadSembrada');
            $table->decimal('totalGastos');
            $table->decimal('totalIngresos');
            $table->decimal('utilidad');
            $table->string('notas');

            $table->unsignedBigInteger('idInvernadero');
            $table->foreign('idInvernadero')->references('id')->on('invernaderos');

            $table->unsignedBigInteger('idCultivo');
            $table->foreign('idCultivo')->references('id')->on('tiposCultivo');

            $table->unsignedBigInteger('idEstado');
            $table->foreign('idEstado')->references('id')->on('estadosCosecha');
            
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cosechas');
    }
};
