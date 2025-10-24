<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LlistaCompra extends Model
{
    use HasFactory;

    protected $table = 'llistes_compra';

    protected $fillable = ['nom', 'user_id'];

    public function creador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function productes()
    {
        return $this->belongsToMany(Producte::class, 'productes_llistes_compra', 'llista_compra_id', 'producte_id')
                    ->withPivot('quantitat');
    }

    public function usuarisCompartits()
    {
        return $this->belongsToMany(User::class, 'usuaris_llistes_compra', 'id_llista_compra', 'user_id');
    }
}
