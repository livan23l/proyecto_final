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
        Schema::create('votaciones_candidatos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('votacion_id');
            $table->unsignedBigInteger('candidato_id');
            $table->unsignedBigInteger('votos')->default(0);  // Los votos que tiene ese candidato en particular.
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
        Schema::dropIfExists('votaciones_candidatos');
    }
};
