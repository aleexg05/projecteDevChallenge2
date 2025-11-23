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
    Schema::create('etiqueta_producte', function (Blueprint $table) {
        $table->unsignedBigInteger('id_producte');
        $table->unsignedBigInteger('id_etiqueta');

        $table->foreign('id_producte')
              ->references('id_producte')
              ->on('productes')
              ->onDelete('cascade');

        $table->foreign('id_etiqueta')
              ->references('id_etiqueta')
              ->on('etiquetes')
              ->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etiqueta_producte');
    }
};
