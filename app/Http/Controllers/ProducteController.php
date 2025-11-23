<?php

namespace App\Http\Controllers;

use App\Models\Producte;
use App\Models\Categoria;
use App\Models\LlistaCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProducteController extends Controller
{
  public function index($id)
{
       $llista = \App\Models\LlistaCompra::with('productes.categoria')
        ->where('id_llista_compra', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    $productes = $llista->productes;

    return view('producte.index', compact('llista', 'productes'));
}



    // Formulari per crear un producte dins d'una llista
    public function create($id_llista)
{
    $llista = LlistaCompra::findOrFail($id_llista);

    // Categories només d’aquesta llista
    $categories = Categoria::where('id_llista_compra', $id_llista)->get();

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
    $producte = Producte::findOrFail($id);
    $categories = Categoria::where('id_llista_compra', $producte->id_llista_compra)->get();

    return view('producte.editar', compact('producte', 'categories'));
}

    // Actualitza el producte
    public function actualitzar(Request $request, $id_producte)
{
    $request->validate([
        'nom_producte' => 'required|string|max:255',
        'id_categoria' => 'required|integer',
        'etiqueta_producte' => 'nullable|string|max:255',
    ]);

    $producte = Producte::findOrFail($id_producte);

    // Actualitzem tots els camps
    $producte->nom_producte = $request->nom_producte;
    $producte->id_categoria = $request->id_categoria;
    $producte->etiqueta_producte = $request->etiqueta_producte;

    $producte->save();

    return redirect()->route('llistes.editar', $producte->id_llista_compra)
                     ->with('success', 'Producte actualitzat correctament!');
}

    public function eliminar($id)
{
    $producte = Producte::with('llista')
        ->where('id_producte', $id)
        ->whereHas('llista', fn($q) => $q->where('user_id', Auth::id()))
        ->firstOrFail();

    $producte->delete();

    return redirect()->route('llistes.editar', $producte->id_llista_compra)
                     ->with('success', 'Producte eliminat correctament.');
}

}
