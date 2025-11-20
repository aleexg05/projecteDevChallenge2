<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LlistaCompartida extends Model
{
    protected $table = 'llista_compartida';
    protected $primaryKey = 'id_compartit';

    protected $fillable = [
        'id_llista_compra',
        'id_usuari_compartit',
        'permis',
    ];

    // Relació amb la llista
    public function llista()
    {
        return $this->belongsTo(LlistaCompra::class, 'id_llista_compra', 'id_llista_compra');
    }

    // Relació amb l'usuari
    public function usuari()
    {
        return $this->belongsTo(User::class, 'id_usuari_compartit');
    }
}
