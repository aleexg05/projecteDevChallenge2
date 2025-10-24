<?php
use App\Models\LlistaCompra;
use Illuminate\Http\Request;

class LlistaCompraController extends Controller
{
    public function index($id_usuari)
    {
        $llistes = LlistaCompra::where('id_usuari', $id_usuari)->get();
        return view('llistes.index', compact('llistes'));
    }

    public function compartir(Request $request)
    {
        DB::table('usuaris_llistes_compra')->insert([
            'id_usuari' => $request->id_usuari,
            'id_llista_compra' => $request->id_llista_compra,
        ]);

        return redirect()->back()->with('success', 'Llista compartida!');
    }
}
