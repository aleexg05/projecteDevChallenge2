<?php

namespace App\Http\Controllers;

use App\Models\Producte;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProducteController extends Controller
{
    public function create()
{
    $categories = Categoria::all();
    return view('producte.create', compact('categories'));
}

public function store(Request $request)
{
    $request->validate([
        'nom_producte' => 'required|string|max:255',
        'preu' => 'required|numeric|min:0',
        'id_categoria' => 'required|exists:categories,id_categoria',
    ]);

    Producte::create($request->all());

    return redirect()->route('categoria.eliminarCategoria')->with('success', 'Producte creat correctament.');
}

public function editar($id)
{
    $producte = Producte::findOrFail($id);
    $categories = Categoria::all();
    return view('producte.editar', compact('producte', 'categories'));
}

public function actualitzar(Request $request, $id)
{
    $request->validate([
        'nom_producte' => 'required|string|max:255',
        'preu' => 'required|numeric|min:0',
        'id_categoria' => 'required|exists:categories,id_categoria',
    ]);

    return redirect()->route('categoria.eliminarCategoria')->with('success', 'Producte actualitzat correctament.');
}
}

    return redirect()->route('categoria.eliminarCategoria')->with('success', 'Producte actualitzat correctament.');

