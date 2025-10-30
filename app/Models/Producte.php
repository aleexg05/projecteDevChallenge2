<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producte extends Model
{
    use HasFactory;

    protected $table = 'productes';

    protected $fillable = [
        'id_producte',
        'nom_producte',
        'preu',
        'comprat',
        'id_categoria',
        'id_llista_compra'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    public function llista()
    {
        return $this->belongsTo(LlistaCompra::class, 'id_llista_compra', 'id_llista_compra');
    }
}
