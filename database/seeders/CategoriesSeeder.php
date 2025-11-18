<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Suposem que existeix una llista amb id_llista_compra = 1
        DB::table('categories')->insert([
            [
                'id_categoria' => 1,
                'nom_categoria' => 'Begudes',
                'id_llista_compra' => 1, // 🔹 vinculem la categoria a la llista 1
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_categoria' => 2,
                'nom_categoria' => 'Snacks',
                'id_llista_compra' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_categoria' => 3,
                'nom_categoria' => 'Fruites i verdures',
                'id_llista_compra' => 2, // 🔹 aquesta categoria pertany a la llista 2
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
