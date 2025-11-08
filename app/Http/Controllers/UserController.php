<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Mostra el panell de l'usuari amb les seves llistes
    public function dashboard()
    {
        /** @var \App\Models\User $usuari */
        $usuari = Auth::user();

        // Llistes creades per l'usuari
        $llistesPropies = $usuari->llistesCreades()->get();

        // Llistes compartides amb l'usuari
        $llistesCompartides = $usuari->llistesCompartides()->get();

        return view('usuari.dashboard', compact('llistesPropies', 'llistesCompartides'));
    }

    // Opcional: mostra el perfil de l'usuari
    public function perfil()
    {
        /** @var \App\Models\User $usuari */
        $usuari = Auth::user();
        return view('usuari.perfil', compact('usuari'));
    }

    // Opcional: actualitza dades bàsiques de l'usuari
    public function actualitzarPerfil(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:users,email,' . Auth::id(),
        ]);

        /** @var \App\Models\User $usuari */
        $usuari = Auth::user();
        $usuari->update($request->only('name', 'email'));

        return redirect()->back()->with('success', 'Perfil actualitzat correctament.');
    }
}
