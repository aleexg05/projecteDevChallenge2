<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\LlistaCompra;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtenim la primera llista de compra (o crea una si no existeix)
        $llista = LlistaCompra::first();
        
        if (!$llista) {
            $llista = LlistaCompra::create([
                'nom' => 'Llista de la compra',
                'user_id' => 1, // Assegura't que existeix un usuari amb ID 1
            ]);
        }

        $categories = [
            'Fruites i verdures',
            'Carn i peix',
            'Làctics i ous',
            'Pa i pastisseria',
            'Congelats',
            'Begudes',
            'Conserves',
            'Pasta i arròs',
            'Snacks i dolços',
            'Neteja',
            'Higiene personal',
            'Altres',
        ];

        foreach ($categories as $nom) {
            Categoria::create([
                'nom_categoria' => $nom,
                'id_llista_compra' => $llista->id_llista_compra,
            ]);
        }
    }
}