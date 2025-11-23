<?php

namespace App\Http\Controllers;

use App\Models\Etiqueta;
use Illuminate\Http\Request;

class EtiquetesController extends Controller
{
    // Llista totes les etiquetes
    public function index()
    {
        $etiquetes = Etiqueta::all();
        return view('etiquetes.index', compact('etiquetes'));
    }

    // Formulari de creació
    public function create()
    {
        return view('etiquetes.create');
    }

    // Desa una nova etiqueta
    public function store(Request $request)
    {
        $request->validate([
            'nom_etiqueta' => 'required|string|max:50',
        ]);

        Etiqueta::create([
            'nom_etiqueta' => $request->nom_etiqueta,
        ]);

        return redirect()->route('etiquetes.index')
                         ->with('success', 'Etiqueta creada correctament!');
    }

    // Formulari d’edició
    public function edit(Etiqueta $etiqueta)
    {
        return view('etiquetes.edit', compact('etiqueta'));
    }

    // Actualitza una etiqueta
    public function update(Request $request, Etiqueta $etiqueta)
    {
        $request->validate([
            'nom_etiqueta' => 'required|string|max:50',
        ]);

        $etiqueta->update([
            'nom_etiqueta' => $request->nom_etiqueta,
        ]);

        return redirect()->route('etiquetes.index')
                         ->with('success', 'Etiqueta actualitzada correctament!');
    }

    // Elimina una etiqueta
    public function destroy(Etiqueta $etiqueta)
    {
        $etiqueta->delete();

        return redirect()->route('etiquetes.index')
                         ->with('success', 'Etiqueta eliminada correctament!');
    }
}
