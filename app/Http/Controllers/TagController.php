<?php
namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount('products')->paginate(20);
        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags',
        ]);

        Tag::create($validated);

        return redirect()->route('tags.index')
            ->with('success', 'Etiqueta creada correctamente');
    }

    public function show(Tag $tag)
    {
        $tag->load('products');
        return view('tags.show', compact('tag'));
    }

    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id,
        ]);

        $tag->update($validated);

        return redirect()->route('tags.index')
            ->with('success', 'Etiqueta actualizada correctamente');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('tags.index')
            ->with('success', 'Etiqueta eliminada correctamente');
    }

    public function products(Tag $tag)
    {
        $products = $tag->products()->with('category')->paginate(12);
        return view('tags.products', compact('tag', 'products'));
    }
}