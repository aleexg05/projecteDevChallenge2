<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProducteLlistaCompra extends Pivot
{
    protected $table = 'productes_llistes_compra';

    protected $fillable = ['llista_compra_id', 'producte_id', 'quantitat'];
}
