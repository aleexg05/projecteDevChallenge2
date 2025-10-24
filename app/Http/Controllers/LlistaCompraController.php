<?php
namespace App\Http\Controllers;

use App\Models\LlistaCompra;
use App\Models\Product;
use Illuminate\Http\Request;

class LlistaCompraController extends Controller
{
    public function index()
    {
        $listas = LlistaCompra::with(['items.product'])
            ->latest()
            ->paginate(12);

        // Calcular progreso para cada lista
        $listas->getCollection()->transform(function ($lista) {
            $lista->items_totales = $lista->items->count();
            $lista->items_completados = $lista->items->where('completado', true)->count();
            return $lista;
        });

        return view('llista-compras.index', compact('listas'));
    }

    public function create()
    {
        $products = Product::with('category')->orderBy('name')->get();
        return view('llista-compras.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'nullable|date',
        ]);

        $lista = LlistaCompra::create($validated);

        return redirect()->route('llista-compras.show', $lista)
            ->with('success', 'Lista creada correctamente');
    }

    public function show(LlistaCompra $llistaCompra)
    {
        $llistaCompra->load(['items.product.category', 'items.product.tags']);
        
        // Calcular progreso
        $llistaCompra->items_totales = $llistaCompra->items->count();
        $llistaCompra->items_completados = $llistaCompra->items->where('completado', true)->count();
        
        $products = Product::with('category')->orderBy('name')->get();
        
        return view('llista-compras.show', compact('llistaCompra', 'products'));
    }

    public function edit(LlistaCompra $llistaCompra)
    {
        return view('llista-compras.edit', compact('llistaCompra'));
    }

    public function update(Request $request, LlistaCompra $llistaCompra)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'nullable|date',
        ]);

        $llistaCompra->update($validated);

        return redirect()->route('llista-compras.show', $llistaCompra)
            ->with('success', 'Lista actualizada correctamente');
    }

    public function destroy(LlistaCompra $llistaCompra)
    {
        $llistaCompra->delete();

        return redirect()->route('llista-compras.index')
            ->with('success', 'Lista eliminada correctamente');
    }

    public function completar(LlistaCompra $lista)
    {
        $lista->update(['completada' => !$lista->completada]);

        return redirect()->back()
            ->with('success', $lista->completada ? 'Lista marcada como completada' : 'Lista marcada como activa');
    }

    public function toggleItem(LlistaCompra $lista, $itemId)
    {
        $item = $lista->items()->findOrFail($itemId);
        $item->update(['completado' => !$item->completado]);

        return redirect()->back()
            ->with('success', 'Item actualizado');
    }

    public function addProduct(Request $request, LlistaCompra $lista)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'cantidad' => 'nullable|integer|min:1',
            'notas' => 'nullable|string',
        ]);

        $lista->items()->create($validated);

        return redirect()->back()
            ->with('success', 'Producto añadido a la lista');
    }

    public function removeItem(LlistaCompra $lista, $itemId)
    {
        $item = $lista->items()->findOrFail($itemId);
        $item->delete();

        return redirect()->back()
            ->with('success', 'Producto eliminado de la lista');
    }

    public function duplicate(LlistaCompra $lista)
    {
        $nuevaLista = $lista->replicate();
        $nuevaLista->nombre = $lista->nombre . ' (Copia)';
        $nuevaLista->completada = false;
        $nuevaLista->save();

        // Copiar items
        foreach ($lista->items as $item) {
            $nuevoItem = $item->replicate();
            $nuevoItem->llista_compra_id = $nuevaLista->id;
            $nuevoItem->completado = false;
            $nuevoItem->save();
        }

        return redirect()->route('llista-compras.show', $nuevaLista)
            ->with('success', 'Lista duplicada correctamente');
    }
}