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
        Schema::create('noticias', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 255);
            $table->mediumText('contenido');
            $table->enum("origen", ["Federal", "Estatal"])->default("Federal");
            $table->string("zona");
            $table->unsignedBigInteger('votos_tot')->default(0);
            $table->string("categ_select");  // Auxiliar para mostrar las categorías.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noticias');
    }
};
