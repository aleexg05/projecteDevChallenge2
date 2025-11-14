<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarisLlistesCompraTable extends Migration
{
    public function up()
    {
        Schema::create('usuaris_llistes_compra', function (Blueprint $table) {
            $table->unsignedInteger('id_llista_compra');
            $table->unsignedBigInteger('user_id');

            // Clau forana cap a llistes_compra
            $table->foreign('id_llista_compra')
                  ->references('id_llista_compra')
                  ->on('llistes_compra')
                  ->onDelete('cascade'); // 👉 quan s’esborri la llista, s’esborra també la relació

            // Clau forana cap a users
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade'); // 👉 quan s’esborri l’usuari, s’esborra també la relació
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuaris_llistes_compra');
    }
}
