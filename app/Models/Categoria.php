<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id_categoria';
    public $timestamps = false;

    protected $fillable = ['nom_categoria', 'id_llista_compra',];

    // Relació amb productes
    public function productes()
    {
        return $this->hasMany(Producte::class, 'id_categoria');
    }
     public function llista()
    {
        return $this->belongsTo(LlistaCompra::class, 'id_llista_compra');
    }
}
