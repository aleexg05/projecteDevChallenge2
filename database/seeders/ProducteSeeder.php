<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class ProducteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     DB::table('productes')->insert([
            [
                'id_producte' => 1002,
                'nom_producte' => 'Plàtan',
                'preu' => 0.95,
                'comprat' => true,
                'id_categoria' => 1,
                'id_llista_compra' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_producte' => 1003,
                'nom_producte' => 'Aigua',
                'preu' => 0.60,
                'comprat' => false,
                'id_categoria' => 2,
                'id_llista_compra' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
