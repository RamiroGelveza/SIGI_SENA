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
        Schema::create('mantenimientoInvernadero', function (Blueprint $table) {
            $table->id();
            $table->date('fechaMantenimiento')->default(DB::raw('CURRENT_DATE'));
            $table->decimal('costoMantenimiento',10,2);
            $table->string('descripcion');

            $table->unsignedBigInteger('idInvernadero');
            $table->foreign('idInvernadero')->references('id')->on('invernaderos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimientoInvernadero');
    }
};
