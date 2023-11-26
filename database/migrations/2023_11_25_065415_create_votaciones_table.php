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
        Schema::create('votaciones', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("tipo");  // Presidencial, Diputación o Senaduría.
            $table->string("alcance");  // Federal o Estatal.
            $table->string("zona");  // "México" en caso de ser federal o el estado de otro modo.
            $table->integer("votos")->default(0);  // Cantidad total de votos.
            $table->integer("votos_null")->default(0);  // Cantidad de votos nulos.
            $table->text("descripcion");  // Una descripción de la votación.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votaciones');
    }
};
