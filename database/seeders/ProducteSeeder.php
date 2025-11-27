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
                'id_producte'     => 1,
                'nom_producte'    => 'Plàtan',
                'id_categoria'    => 1,
                'id_llista_compra'=> 1,
                'etiqueta_producte'=> 'Bonpreu',
                'comprat'         => false, // 👈 afegit
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ],
        ]);
    }
}
