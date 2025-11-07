<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::table('categories')->insert([
        [
            // Elimina 'id_categoria' => 1,
            'nom_categoria' => 'Begudes',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        ]);
    }
}
