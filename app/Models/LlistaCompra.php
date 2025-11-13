<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LlistaCompra extends Model
{
    use HasFactory;

    protected $table = 'llistes_compra';

    protected $primaryKey = 'id_llista_compra'; // 👉 afegeix això

    protected $fillable = ['nom', 'user_id'];

    public $timestamps = true;

    public function creador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function productes()
    {
        return $this->hasMany(Producte::class, 'id_llista_compra', 'id_llista_compra');
    }

    public function usuarisCompartits()
    {
        return $this->belongsToMany(User::class, 'usuaris_llistes_compra', 'id_llista_compra', 'user_id');
    }
}
