<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
{
    Schema::create('usuaris_llistes_compra', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('id_llista_compra');

            $table->primary(['user_id', 'id_llista_compra']);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_llista_compra')->references('id_llista_compra')->on('llistes_compra')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuaris_llistes_compra');
    }
};
