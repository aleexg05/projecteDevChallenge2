<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Mostra totes les categories.
     */
    public function index()
    {
        $categories = Categoria::all();
        return view('index', compact('categories'));
    }

    /**
     * Mostra el formulari per crear una nova categoria.
     */
    public function create()
    {
        return view('categoria.create');
    }

    /**
     * Desa una nova categoria a la base de dades.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_categoria' => 'required|string|max:100',
        ]);

        Categoria::create([
            'nom_categoria' => $validated['nom_categoria'],
        ]);

        return redirect()->route('categoria.index')->with('success', 'Categoria creada correctament!');
    }
    public function eliminar()
{
    $categories = Categoria::all();
    return view('categoria.eliminar', compact('categories'));
}
    
}
