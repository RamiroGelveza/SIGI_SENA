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
        Schema::create('invernaderos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100);
            $table->integer('tamaño');
            $table->decimal('costoConstruccion', 10, 2);
            # $table->decimal('rendimiento',10,2);

            $table ->unsignedBigInteger('idFinca');
            $table->foreign('idFinca')->references('id')->on('fincas');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invernaderos');
    }
};
