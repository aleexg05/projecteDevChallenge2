<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LlistaCompra extends Model
{
    protected $table = 'llista_compres';
    protected $primaryKey = 'id_llista_compra';
    protected $fillable = ['id_producte', 'id_categoria', 'id_usuari'];

    public function producte()
    {
        return $this->belongsTo(Product::class, 'id_producte');
    }

    public function categoria()
    {
        return $this->belongsTo(Category::class, 'id_categoria');
    }

    public function usuari()
    {
        return $this->belongsTo(User::class, 'id_usuari');
    }
}
