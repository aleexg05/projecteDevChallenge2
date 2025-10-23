<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // Mostra totes les categories i els seus productes
    public function index()
    {
        $categories = Category::with('products')->get();
        return view('products.index', compact('categories'));
    }

    // Desa un nou producte
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        // Classificació automàtica (extra)
        $autoCategories = [
            'llet' => 'Làctics',
            'iogurt' => 'Làctics',
            'aigua' => 'Begudes',
            'poma' => 'Fruita',
        ];

        $nameLower = strtolower($request->name);
        $categoryName = $autoCategories[$nameLower] ?? null;

        if ($categoryName) {
            $category = Category::firstOrCreate(['name' => $categoryName]);
            $validated['category_id'] = $category->id;
        }

        // Si no s’ha assignat categoria, usa “Altres”
        if (empty($validated['category_id'])) {
            $category = Category::firstOrCreate(['name' => 'Altres']);
            $validated['category_id'] = $category->id;
        }

        Product::create($validated);

        return redirect()->back();
    }

    // Canvia l’estat de completat
    public function toggleCompleted(Product $product)
    {
        $product->update(['completed' => !$product->completed]);
        return redirect()->back();
    }
}
