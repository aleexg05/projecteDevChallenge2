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
   public function eliminar($id_categoria)
{
    $categoria = Categoria::find($id_categoria);

    if ($categoria) {
        $categoria->delete();
        return redirect()->route('index');
    }
}
   

public function eliminarCategoria()
{
    $categories = Categoria::all();
    return view('categoria.eliminarCategoria', compact('categories'));
}

// Mostrar el formulari d'edició
public function editar($id_categoria)
{
    $categoria = Categoria::findOrFail($id_categoria);
    return view('categoria.editar', compact('categoria'));
}

// Actualitzar la categoria
public function actualitzar(Request $request, $id_categoria)
{
    $request->validate([
        'nom_categoria' => 'required|string|max:255',
    ]);

    $categoria = Categoria::findOrFail($id_categoria);
    $categoria->nom_categoria = $request->nom_categoria;
    $categoria->save();

    return redirect()->route('index')->with('success', 'Categoria actualitzada correctament.');
}


}
