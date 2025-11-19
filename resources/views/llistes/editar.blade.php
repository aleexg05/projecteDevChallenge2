@extends('layouts.app')

@section('títol', 'Editar llista de compra')

@section('content')
<style>
    .nom-producte.ratllat {
        text-decoration: line-through;
        opacity: 0.6;
    }

    .btn {
        padding: 10px 18px;
        border-radius: 6px;
        font-size: 14px;
        text-decoration: none;
        border: 1px solid #ccc;
        background-color: #fff;
        color: #333;
        transition: all 0.2s ease;
        display: inline-block;
    }

    .btn:hover {
        background-color: #f0f0f0;
    }

    .btn-outline-primary {
        border-color: #444;
        color: #444;
    }

    .btn-outline-primary:hover {
        background-color: #444;
        color: #fff;
    }

    .btn-outline-secondary {
        border-color: #888;
        color: #888;
    }

    .btn-outline-secondary:hover {
        background-color: #888;
        color: #fff;
    }

    .btn-outline-warning {
        border-color: #ffc107;
        color: #ffc107;
    }

    .btn-outline-warning:hover {
        background-color: #ffc107;
        color: #000;
    }

    .btn-outline-danger {
        border-color: #dc3545;
        color: #dc3545;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-main {
        border-color: #222;
        color: #222;
        font-weight: 500;
    }

    .btn-main:hover {
        background-color: #222;
        color: #fff;
    }

    .button-group {
        display: flex;
        gap: 24px;
        justify-content: center;
        margin-bottom: 32px;
    }

    .create-button {
        text-align: right;
        margin-bottom: 32px;
    }

    .list-group-item {
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        margin-bottom: 12px;
        background: #fafafa;
        padding: 16px;
    }
</style>
<div class="container py-4">
    <h1 class="mb-4 text-center text-warning">✏️ Editar llista: {{ $llista->nom }}</h1>

    <!-- Botons d'accions -->
    <div class="button-group justify-content-center mb-4">
        <a href="{{ route('llistes.editarNom', $llista->id_llista_compra) }}" class="btn btn-outline-primary">✏️ Canviar nom</a>

        <a href="{{ route('categories.index', $llista->id_llista_compra) }}" class="btn btn-outline-secondary">🏷️ Gestionar categories</a>
        <a href="{{ route('productes.index', $llista->id_llista_compra) }}" class="btn btn-outline-secondary">
            📦 Gestionar productes
        </a>
    </div>

    <!-- Productes actuals -->
    <h4 class="mt-4 mb-3">📦 Productes en aquesta llista</h4>
    @forelse($llista->productes as $producte)
    <div class="list-group-item">
        <form action="{{ route('productes.toggle', [$llista->id_llista_compra, $producte->id_producte]) }}" method="POST" style="display:inline;">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-link p-0 nom-producte {{ $estats[$producte->id_producte] ? 'ratllat' : '' }}">
                {{ $producte->nom_producte }}
            </button>
        </form>
        <span class="text-muted">({{ $producte->categoria->nom_categoria ?? 'Sense categoria' }})</span>
    </div>
    @empty
    <p class="text-muted">No hi ha productes en aquesta llista.</p>
    @endforelse

    <!-- Botó tornar -->
    <div class="text-end mt-4">
        <a href="{{ route('llistes.index') }}" class="btn btn-outline-primary">← Tornar a les llistes</a>
    </div>
</div>
@endsection