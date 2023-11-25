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
        Schema::create('votacion_candidatos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('votacion_id');
            $table->unsignedBigInteger('candidato_id');
            $table->integer('votos');  // Cantidad de votos
            $table->timestamps();
        
            $table->foreign('votacion_id')->references('id')->on('votaciones');
            $table->foreign('candidato_id')->references('id')->on('candidatos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votacion_candidatos');
    }
};
