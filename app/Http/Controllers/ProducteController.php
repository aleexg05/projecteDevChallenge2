<?php

namespace App\Http\Controllers;

use App\Models\Producte;
use App\Models\Categoria;
use App\Models\LlistaCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProducteController extends Controller
{
    // Formulari per crear un producte dins d'una llista
    public function create($id_llista)
    {
        $llista = LlistaCompra::where('id_llista_compra', $id_llista)
                              ->where('user_id', Auth::id())
                              ->firstOrFail();

        $categories = Categoria::all();

        return view('producte.create', compact('llista', 'categories'));
    }

    // Desa el producte
    public function store(Request $request, $id_llista)
    {
        $request->validate([
            'nom_producte' => 'required|string|max:255',
            'preu' => 'required|numeric|min:0',
            'id_categoria' => 'required|exists:categories,id_categoria',
            'etiqueta_producte' => 'nullable|string|max:50',
        ]);

        $llista = LlistaCompra::where('id_llista_compra', $id_llista)
                              ->where('user_id', Auth::id())
                              ->firstOrFail();

        Producte::create([
            'nom_producte' => $request->nom_producte,
            'preu' => $request->preu,
            'id_categoria' => $request->id_categoria,
            'etiqueta_producte' => $request->etiqueta_producte,
            'id_llista_compra' => $llista->id_llista_compra,
            'comprat' => false,
        ]);

        return redirect()->route('llistes.editar', $llista->id_llista_compra)
                         ->with('success', 'Producte creat correctament.');
    }

    // Formulari per editar
    public function editar($id)
    {
        $producte = Producte::with('llista')->findOrFail($id);

        if ($producte->llista->user_id !== Auth::id()) {
            abort(403);
        }

        $categories = Categoria::all();

        return view('producte.editar', compact('producte', 'categories'));
    }

    // Actualitza el producte
    public function actualitzar(Request $request, $id)
    {
        $request->validate([
            'nom_producte' => 'required|string|max:255',
            'preu' => 'required|numeric|min:0',
            'id_categoria' => 'required|exists:categories,id_categoria',
            'etiqueta_producte' => 'nullable|string|max:50',
            'comprat' => 'boolean',
        ]);

        $producte = Producte::with('llista')->findOrFail($id);

        if ($producte->llista->user_id !== Auth::id()) {
            abort(403);
        }

        $producte->update($request->only('nom_producte', 'preu', 'id_categoria', 'etiqueta_producte', 'comprat'));

        return redirect()->route('llistes.editar', $producte->id_llista_compra)
                         ->with('success', 'Producte actualitzat correctament.');
    }

    // Elimina el producte
    public function eliminar($id)
    {
        $producte = Producte::with('llista')->findOrFail($id);

        if ($producte->llista->user_id !== Auth::id()) {
            abort(403);
        }

        $producte->delete();

        return redirect()->route('llistes.editar', $producte->id_llista_compra)
                         ->with('success', 'Producte eliminat correctament.');
    }
}
