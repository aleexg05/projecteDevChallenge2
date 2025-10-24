<?php

namespace App\Http\Controllers;

use App\Models\Producte;
use Illuminate\Http\Request;

class ProducteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nom_producte' => 'required|string|max:20',
            'id_categoria' => 'required|exists:categories,id_categoria',
            'id_llista_compra' => 'required|exists:llistes_compra,id_llista_compra',
        ]);

        Producte::create($request->all());
        return redirect()->back()->with('success', 'Producte afegit!');
    }

    public function toggle(Producte $producte)
    {
        $producte->comprat = !$producte->comprat;
        $producte->save();

        return redirect()->back();
    }
}
