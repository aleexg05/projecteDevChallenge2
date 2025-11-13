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
            'id_categoria' => 'required|exists:categories,id_categoria',
            'etiqueta_producte' => 'required|string|max:50',
        ]);

        $llista = LlistaCompra::where('id_llista_compra', $id_llista)
                              ->where('user_id', Auth::id())
                              ->firstOrFail();

        Producte::create([
            'nom_producte' => $request->nom_producte,
            'id_categoria' => $request->id_categoria,
            'id_llista_compra' => $llista->id_llista_compra,
            'etiqueta_producte' => $request->etiqueta_producte,
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
            'id_categoria' => 'required|exists:categories,id_categoria',
        ]);

        $producte = Producte::with('llista')
            ->where('id_producte', $id)
            ->whereHas('llista', fn($q) => $q->where('user_id', Auth::id()))
            ->firstOrFail();

        $producte->update($request->only(['nom_producte', 'id_categoria']));

        return redirect()->route('llistes.editar', $producte->id_llista_compra)
                         ->with('success', 'Producte actualitzat correctament.');
    }
}
