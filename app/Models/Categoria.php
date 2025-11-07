<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    // Nom de la taula
    protected $table = 'categories';

    // Clau primària personalitzada
    protected $primaryKey = 'id_categoria';

    // Camps que es poden omplir en massa
    protected $fillable = [
        'nom_categoria',
        'descripcio',
    ];

    // Relació: una categoria té molts productes
    public function productes()
    {
        return $this->hasMany(Producte::class, 'id_categoria', 'id_categoria');
    }
}
