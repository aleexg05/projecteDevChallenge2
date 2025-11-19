<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LlistesCompraSeeder extends Seeder
{
    

    public function run(): void
    {   
        DB::table('llistes_compra')->insert([
    [
        'id_llista_compra' => 1,
        'nom'=> 'Llista setmanal',
        'user_id' => 1,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ],
    [
        'id_llista_compra' => 2,
        'nom'=> 'Caps de setmana',
        'user_id' => 1,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ],
]);

    }
} 
