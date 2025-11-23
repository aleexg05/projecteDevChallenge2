<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    use HasFactory;

    protected $table = 'etiquetes';
    protected $primaryKey = 'id_etiqueta';

    protected $fillable = ['nom_etiqueta'];

    // Relació many-to-many amb Producte
    public function productes()
    {
        return $this->belongsToMany(
            Producte::class,
            'etiqueta_producte',   // taula pivot
            'id_etiqueta',         // clau de la etiqueta a pivot
            'id_producte'          // clau del producte a pivot
        );
    }
}
