<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Mostra el panell de l'usuari amb les seves llistes
    public function dashboard()
    {
        $usuari = Auth::user();

        // Llistes creades per l'usuari
        $llistesPropies = $usuari->llistesCreades()->get();

        // Llistes compartides amb l'usuari
        $llistesCompartides = $usuari->llistesCompartides()->get();

        return view('usuari.dashboard', compact('llistesPropies', 'llistesCompartides'));
    }

   
}
