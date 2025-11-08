<?php

namespace App\Http\Controllers;

use App\Models\LlistaCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LlistaCompraController extends Controller
{
    public function index()
{
    $usuari = Auth::user();
    $llistes = $usuari->llistesCreades()->get();

    return view('llistes.index', compact('llistes'));
}

public function create()
{
    return view('llistes.create');
}

public function store(Request $request)
{
    $request->validate(['nom' => 'required|string|max:50']);

    LlistaCompra::create([
        'id_llista_compra' => now()->timestamp, // o UUID si prefereixes
        'nom' => $request->nom,
        'user_id' => Auth::id(),
    ]);

    return redirect()->route('llistes.index')->with('success', 'Llista creada correctament.');
}

public function editar($id)
{
    $llista = LlistaCompra::where('id_llista_compra', $id)->where('user_id', Auth::id())->firstOrFail();
    return view('llistes.editar', compact('llista'));
}

public function actualitzar(Request $request, $id)
{
    $request->validate(['nom' => 'required|string|max:50']);

    $llista = LlistaCompra::where('id_llista_compra', $id)->where('user_id', Auth::id())->firstOrFail();
    $llista->update(['nom' => $request->nom]);

    return redirect()->route('llistes.index')->with('success', 'Llista actualitzada.');
}

public function eliminar($id){
    return redirect()->route('llistes.index')->with('success', 'Llista eliminada.');
    }
}
    $llista->delete();

    return redirect()->route('llistes.index')->with('success', 'Llista eliminada.');

