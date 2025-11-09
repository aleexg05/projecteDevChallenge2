<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Mostra totes les categories.
     */
    public function create($id_llista)
{
    return view('categoria.create', compact('id_llista'));
}

public function store(Request $request, $id_llista)
{
    $validated = $request->validate([
        'nom_categoria' => 'required|string|max:100',
    ]);

    Categoria::create([
        'nom_categoria' => $validated['nom_categoria'],
    ]);

    return redirect()->route('llistes.editar', $id_llista)
                     ->with('success', 'Categoria creada correctament!');
}

public function actualitzar(Request $request, $id_categoria)
{
    $request->validate([
        'nom_categoria' => 'required|string|max:255',
    ]);

    $categoria = Categoria::findOrFail($id_categoria);
    $categoria->nom_categoria = $request->nom_categoria;
    $categoria->save();

    // Si vols redirigir a una llista concreta, cal passar l'id
    $id_llista = $request->input('id_llista_compra');

    return redirect()->route('llistes.editar', $id_llista)
                     ->with('success', 'Categoria actualitzada correctament!');
}


}
