<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\LlistaCompra;

class ProductController extends Controller
{
    /**
     * Muestra la página principal con las listas de compra
     */
    public function index()
    {
        // Obtener todas las listas de compra paginadas
        $listas = LlistaCompra::with(['items.product'])
            ->latest()
            ->paginate(9);

        // Calcular items completados y totales para cada lista
        $listas->getCollection()->transform(function ($lista) {
            $lista->items_totales = $lista->items->count();
            $lista->items_completados = $lista->items->where('completado', true)->count();
            return $lista;
        });

        // Estadísticas generales
        $stats = [
            'activas' => LlistaCompra::where('completada', false)->count(),
            'productos' => Product::count(),
            'categorias' => Category::count(),
        ];

        return view('index', compact('listas', 'stats'));
    }

    /**
     * Guarda un nuevo producto
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        // Clasificación automática (extra)
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

        // Si no se ha asignado categoría, usa "Altres"
        if (empty($validated['category_id'])) {
            $category = Category::firstOrCreate(['name' => 'Altres']);
            $validated['category_id'] = $category->id;
        }

        Product::create($validated);

        return redirect()->back()->with('success', 'Producto creado correctamente');
    }

    /**
     * Cambia el estado de completado
     */
    public function toggleCompleted(Product $product)
    {
        $product->update(['completed' => !$product->completed]);
        return redirect()->back();
    }
}