<?php
namespace App\Http\Controllers;

use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        $categories = Categoria::with('productes')->get();
        return view('index', compact('categories'));

    }
}