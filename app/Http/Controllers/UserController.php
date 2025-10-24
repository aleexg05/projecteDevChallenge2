<?php
use App\Models\Usuari;

class UsuariController extends Controller
{
    public function show($id)
    {
        $usuari = Usuari::with('llistes')->findOrFail($id);
        return view('usuaris.show', compact('usuari'));
    }
}
