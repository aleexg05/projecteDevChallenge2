<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */

  public function run(): void
{
    $this->call([
        UserSeeder::class,             // Primer: crea els usuaris
        CategoriesSeeder::class,       // Segon: crea les categories
        LlistesCompraSeeder::class,    // Tercer: crea les llistes de compra
        ProducteSeeder::class,         // Quart: crea els productes
        SessionSeeder::class,          // Últim: crea la sessió per l'usuari
    ]);
}


}

