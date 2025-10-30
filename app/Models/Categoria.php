<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['nom_categoria'];

    public function productes()
    {
        return $this->hasMany(Producte::class, 'id_categoria', 'id_categoria');
    }
}
