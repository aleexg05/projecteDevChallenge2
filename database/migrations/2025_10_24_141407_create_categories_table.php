<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->unsignedBigInteger('id_categoria');
            $table->primary('id_categoria');


            $table->string('nom_categoria', 20);
            $table->unsignedBigInteger('id_llista_compra')->after('id_categoria');
    $table->foreign('id_llista_compra')->references('id_llista_compra')->on('llistes_compra')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
