<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('llista_compartida', function (Blueprint $table) {
            $table->id('id_compartit');
            $table->unsignedBigInteger('id_llista_compra');
            $table->unsignedBigInteger('id_usuari_compartit'); // Usuari amb qui es comparteix
            $table->enum('permis', ['lectura', 'edicio'])->default('lectura');
            $table->timestamps();

            // Claus foranes
            $table->foreign('id_llista_compra')
                ->references('id_llista_compra')
                ->on('llistes_compra')
                ->onDelete('cascade');

            $table->foreign('id_usuari_compartit')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            // Evitar duplicats: una llista només es pot compartir una vegada amb el mateix usuari
            $table->unique(['id_llista_compra', 'id_usuari_compartit']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('llista_compartida');
    }
};
