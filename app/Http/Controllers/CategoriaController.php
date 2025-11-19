<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\LlistaCompra;

class CategoriaController extends Controller
{
    /**
     * Mostra totes les categories.
     */
    public function index($id_llista)
    {
        // Carreguem la llista
        $llista = LlistaCompra::findOrFail($id_llista);

        // Categories només d'aquesta llista
        $categories = Categoria::where('id_llista_compra', $llista->id_llista_compra)->get();

        return view('categoria.index', compact('llista', 'categories'));
    }
    
    public function editar($id_categoria)
    {
        $categoria = Categoria::findOrFail($id_categoria);

        return view('categoria.editar', compact('categoria'));
    }


    public function eliminar($id)
    {
        $categoria = Categoria::findOrFail($id);

        // Eliminar productes associats abans d’eliminar la categoria
        $categoria->productes()->delete();

        $categoria->delete();

        return redirect()->route('categoria.index')
            ->with('success', 'Categoria i productes eliminats correctament.');
    }

    public function create($id_llista)
    {
        return view('categoria.create', compact('id_llista'));
    }

    public function store(Request $request, $id_llista)
    {
        // Validem el nom
        $request->validate([
            'nom_categoria' => 'required|string|max:50',
        ]);

        // Creem la categoria vinculada a la llista
        Categoria::create([
            'nom_categoria' => $request->nom_categoria,
            'id_llista_compra' => $id_llista,   // 🔹 aquí vinculem la categoria a la llista
        ]);

        return redirect()->route('llistes.editar', $id_llista)
            ->with('success', 'Categoria creada correctament.');
    }

    public function actualitzar(Request $request, $id_categoria)
    {
        $request->validate([
            'nom_categoria' => 'required|string|max:255',
        ]);

        $categoria = Categoria::findOrFail($id_categoria);
        $categoria->nom_categoria = $request->nom_categoria;
        $categoria->save();

        // 👉 Aquí fem la redirecció cap a l’índex de categories
        return redirect()->route('categoria.index')
            ->with('success', 'Categoria actualitzada correctament!');
    }
}
