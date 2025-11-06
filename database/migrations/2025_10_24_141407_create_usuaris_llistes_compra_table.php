<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
{
    Schema::create('usuaris_llistes_compra', function (Blueprint $table) {
        $table->unsignedBigInteger('id_usuari');
        $table->unsignedBigInteger('id_llista_compra');

        $table->primary(['id_usuari', 'id_llista_compra']);

        $table->foreign('id_usuari')->references('id_usuari')->on('users')->onDelete('cascade');
        $table->foreign('id_llista_compra')->references('id_llista_compra')->on('llistes_compra')->onDelete('cascade');
    });
}


    public function down(): void
    {
        Schema::dropIfExists('usuaris_llistes_compra');
    }
};
