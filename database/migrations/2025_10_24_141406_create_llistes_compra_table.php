<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
{
    Schema::create('llistes_compra', function (Blueprint $table) {
    $table->unsignedBigInteger('id_llista_compra');
    $table->primary('id_llista_compra');

    $table->unsignedBigInteger('user_id');
    $table->timestamps();

    $table->foreign('user_id')
          ->references('id') // ← aquí está el cambio
          ->on('users')
          ->onDelete('cascade');
});


}


    

    public function down(): void
    {
        Schema::dropIfExists('llistes_compra');
    }
};
