<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('productes', function (Blueprint $table) {
            $table->unsignedBigInteger('id_producte');
            $table->primary('id_producte');
            $table->string('nom_producte', 20);
            $table->boolean('comprat')->default(false);
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_llista_compra');
            $table->timestamps();

            $table->foreign('id_categoria')
                  ->references('id_categoria')
                  ->on('categories')
                  ->onDelete('restrict');

            $table->foreign('id_llista_compra')
                  ->references('id_llista_compra')
                  ->on('llistes_compra')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productes');
    }
};
