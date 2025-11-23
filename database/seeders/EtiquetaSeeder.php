<?php
use Illuminate\Database\Seeder;
use App\Models\Etiqueta;

class EtiquetesSeeder extends Seeder
{
    public function run(): void
    {
        $etiquetes = [
            'Eco',
            'Sense gluten',
            'Oferta',
            'Favorit',
            'Temporal',
        ];

        foreach ($etiquetes as $nom) {
            Etiqueta::create(['nom_etiqueta' => $nom]);
        }
    }
}
