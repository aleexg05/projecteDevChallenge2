<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use App\Models\LlistaCompra;
use App\Models\Etiqueta;

class Producte extends Model
{
    use HasFactory;

    protected $table = 'productes';

    protected $primaryKey = 'id_producte'; // 👉 añade esto

    protected $fillable = [
        'nom_producte',
        'id_categoria',
        'id_llista_compra',
        'etiqueta_producte',
        'comprat'
    ];

    protected $casts = [
        'comprat' => 'boolean',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

public function llista()
{
    return $this->belongsTo(LlistaCompra::class, 'id_llista_compra', 'id_llista_compra');
}

public function etiquetes()
{
    return $this->belongsToMany(Etiqueta::class, 'etiqueta_producte', 'id_producte', 'id_etiqueta');
}

}
