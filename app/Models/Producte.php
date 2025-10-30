<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producte extends Model
{
    use HasFactory;

    protected $table = 'productes';

    protected $fillable = ['nom', 'preu', 'categoria_id'];

  public function categoria()
{
    return $this->belongsTo(Categoria::class, 'id_categoria');
}


    public function llistes()
    {
        return $this->belongsToMany(LlistaCompra::class, 'productes_llistes_compra', 'producte_id', 'llista_compra_id')
                    ->withPivot('quantitat');
    }
}
