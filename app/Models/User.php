<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Laravel ja assumeix 'users' i 'id', així que no cal especificar-ho
    // Si vols mantenir-ho explícitament:
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
    'name',
    'email',
    'password',
];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relació 1:N amb llistes creades
   public function llistesCreades()
{
    return $this->hasMany(LlistaCompra::class, 'user_id');
}


    // Relació N:M amb llistes compartides
    public function llistesCompartides()
    {
        return $this->belongsToMany(LlistaCompra::class, 'usuaris_llistes_compra', 'user_id', 'id_llista_compra');
    }
}
