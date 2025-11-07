<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
       Schema::create('users', function (Blueprint $table) {
    $table->unsignedBigInteger('id_usuari');
    $table->primary('id_usuari');
    $table->string('name', 50); // Nom d’usuari
    $table->string('email', 50)->unique(); // Correu electrònic
    $table->string('password')->nullable();
    $table->rememberToken();
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
