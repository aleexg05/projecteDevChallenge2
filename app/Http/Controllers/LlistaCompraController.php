<?php

namespace App\Http\Controllers;
use App\Models\User;



use App\Models\LlistaCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LlistaCompraController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $usuari */
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
    $llista = LlistaCompra::with('productes.categoria') // carrega productes i la seva categoria
                ->where('id_llista_compra', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

    return view('llistes.editar', compact('llista'));
}


  public function actualitzar(Request $request, $id)
{
        
    $request->validate(['nom' => 'required|string|max:50']);

    $llista = LlistaCompra::where('id_llista_compra', $id)
                          ->where('user_id', Auth::id())
                          ->firstOrFail();
$llista->nom = $request->nom;
$llista->save();


    if ($llista->nom !== $request->nom) {
        $llista->nom = $request->nom;
        $llista->save();
        return redirect()->route('llistes.index')->with('success', 'Llista actualitzada.');
    }

    return redirect()->route('llistes.index')->with('info', 'No s\'han fet canvis.');
}


    public function eliminar($id)
    {
        $llista = LlistaCompra::where('id_llista_compra', $id)->where('user_id', Auth::id())->firstOrFail();
        $llista->delete();

        return redirect()->route('llistes.index')->with('success', 'Llista eliminada.');
    }
}

