<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\LlistaCompartida;

class LlistaCompra extends Model
{
    protected $table = 'llistes_compra';
    protected $primaryKey = 'id_llista_compra';
    protected $fillable = ['nom', 'user_id'];

    // ...existing code...

    // Llistes compartides amb altres usuaris
    public function compartides()
    {
        return $this->hasMany(LlistaCompartida::class, 'id_llista_compra', 'id_llista_compra');
    }

    // Usuaris amb qui està compartida la llista
    public function usuarisCompartits()
    {
        return $this->belongsToMany(User::class, 'llista_compartida', 'id_llista_compra', 'id_usuari_compartit')
                    ->withPivot('permis')
                    ->withTimestamps();
    }

    // Comprovar si un usuari té accés a la llista
    public function teAcces($userId)
    {
        return $this->user_id == $userId || 
               $this->usuarisCompartits()->where('id', $userId)->exists();
    }

    // Comprovar si un usuari pot editar
    public function potEditar($userId)
    {
        if ($this->user_id == $userId) {
            return true; // El propietari sempre pot editar
        }
        
        $compartit = $this->usuarisCompartits()
                          ->where('id', $userId)
                          ->first();
        
        return $compartit && $compartit->pivot->permis === 'edicio';
    }
}