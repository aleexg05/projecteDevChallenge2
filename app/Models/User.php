<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Llistes creades per l'usuari (propietari)
    public function llistesCreades()
    {
        return $this->hasMany(LlistaCompra::class, 'user_id');
    }

    // També mantenir l'àlies per compatibilitat
    public function llistesCompra()
    {
        return $this->llistesCreades();
    }

    // Llistes compartides amb l'usuari
    public function llistesCompartides()
    {
        return $this->belongsToMany(LlistaCompra::class, 'llista_compartida', 'id_usuari_compartit', 'id_llista_compra')
                    ->withPivot('permis')
                    ->withTimestamps();
    }

    // Totes les llistes a les quals té accés (pròpies + compartides)
    public function totesLesLlistes()
    {
        return $this->llistesCreades->merge($this->llistesCompartides);
    }
}