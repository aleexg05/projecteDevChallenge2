<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LlistaCompra;
use App\Models\LlistaCompartida;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CompartirController extends Controller
{
    // Mostrar la pàgina per compartir una llista
    public function index($id_llista)
    {
        $llista = LlistaCompra::findOrFail($id_llista);

        // Verificar que l'usuari és el propietari
        if ($llista->user_id !== Auth::id()) {
            return redirect()->route('llistes.index')->with('error', 'No tens permís per compartir aquesta llista.');
        }

        // Obtenir usuaris amb qui està compartida
        $usuarisCompartits = $llista->usuarisCompartits;

        return view('compartir.index', compact('llista', 'usuarisCompartits'));
    }

    // Compartir la llista amb un usuari
    public function compartir(Request $request, $id_llista)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'permis' => 'required|in:lectura,edicio',
        ]);

        $llista = LlistaCompra::findOrFail($id_llista);

        // Verificar que l'usuari és el propietari
        if ($llista->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'No tens permís per compartir aquesta llista.');
        }

        // Buscar l'usuari per email
        $usuari = User::where('email', $request->email)->first();

        // No es pot compartir amb un mateix
        if ($usuari->id === Auth::id()) {
            return redirect()->back()->with('error', 'No pots compartir la llista amb tu mateix.');
        }

        // Comprovar si ja està compartida
        $jaCompartida = LlistaCompartida::where('id_llista_compra', $id_llista)
            ->where('id_usuari_compartit', $usuari->id)
            ->exists();

        if ($jaCompartida) {
            return redirect()->back()->with('error', 'Aquesta llista ja està compartida amb aquest usuari.');
        }

        // Crear la compartició
        LlistaCompartida::create([
            'id_llista_compra' => $id_llista,
            'id_usuari_compartit' => $usuari->id,
            'permis' => $request->permis,
        ]);

        return redirect()->back()->with('success', "Llista compartida amb {$usuari->name} correctament!");
    }

    // Deixar de compartir amb un usuari
    public function deixarCompartir($id_llista, $id_usuari)
    {
        $llista = LlistaCompra::findOrFail($id_llista);

        // Verificar que l'usuari és el propietari
        if ($llista->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'No tens permís.');
        }

        LlistaCompartida::where('id_llista_compra', $id_llista)
            ->where('id_usuari_compartit', $id_usuari)
            ->delete();

        return redirect()->back()->with('success', 'Accés eliminat correctament.');
    }

    // Canviar permisos d'un usuari
    public function canviarPermis(Request $request, $id_llista, $id_usuari)
    {
        $request->validate([
            'permis' => 'required|in:lectura,edicio',
        ]);

        $llista = LlistaCompra::findOrFail($id_llista);

        // Verificar que l'usuari és el propietari
        if ($llista->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'No tens permís.');
        }

        LlistaCompartida::where('id_llista_compra', $id_llista)
            ->where('id_usuari_compartit', $id_usuari)
            ->update(['permis' => $request->permis]);

        return redirect()->back()->with('success', 'Permisos actualitzats correctament.');
    }

    // Mostrar llistes compartides amb mi
    public function llistesCompartidesAmbMi()
    {
        $llistesCompartides = Auth::user()->llistesCompartides;

        return view('compartir.compartides-amb-mi', compact('llistesCompartides'));
    }
}
