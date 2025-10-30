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
        // CategoriesSeeder::class,
        // LlistesCompraSeeder::class,
        ProducteSeeder::class,
    ]);
}

}

