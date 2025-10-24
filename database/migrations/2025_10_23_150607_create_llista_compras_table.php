<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('llista_compres', function (Blueprint $table) {
            $table->id('id_llista_compra'); // 🔹 Clau primària
            $table->foreignId('id_producte')->constrained('products')->onDelete('cascade');
            $table->foreignId('id_categoria')->constrained('categories')->onDelete('cascade');
            $table->foreignId('id_usuari')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('llista_compres');
    }
};
