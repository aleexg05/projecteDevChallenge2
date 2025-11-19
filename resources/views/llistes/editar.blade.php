@extends('layouts.app')

@section('títol', 'Editar llista de compra')

@section('content')
<style>
    .nom-producte.ratllat {
        text-decoration: line-through;
        opacity: 0.6;
        color: rgba(255, 255, 255, 0.5);
    }

    .nom-producte {
        color: #ffffff;
        text-decoration: none;
    }

    .btn {
        padding: 10px 18px;
        border-radius: 6px;
        font-size: 14px;
        text-decoration: none;
        border: 1px solid rgba(255, 255, 255, 0.3);
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
        transition: all 0.2s ease;
        display: inline-block;
    }

    .btn:hover {
        background-color: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .btn-link {
        border: none;
        background: transparent;
        padding: 0;
    }

    .btn-link:hover {
        transform: none;
        box-shadow: none;
        text-decoration: underline;
    }

    .btn-outline-primary {
        border-color: #a78bfa;
        color: #a78bfa;
        background-color: rgba(167, 139, 250, 0.1);
    }
    .btn-outline-primary:hover {
        background-color: #a78bfa;
        color: #1a0b2e;
    }

    .btn-outline-secondary {
        border-color: #60a5fa;
        color: #60a5fa;
        background-color: rgba(96, 165, 250, 0.1);
    }
    .btn-outline-secondary:hover {
        background-color: #60a5fa;
        color: #0f3460;
    }

    .btn-outline-warning {
        border-color: #ffc107;
        color: #ffc107;
        background-color: rgba(255, 193, 7, 0.1);
    }
    .btn-outline-warning:hover {
        background-color: #ffc107;
        color: #000;
    }

    .btn-outline-danger {
        border-color: #ef4444;
        color: #ef4444;
        background-color: rgba(239, 68, 68, 0.1);
    }
    .btn-outline-danger:hover {
        background-color: #ef4444;
        color: #fff;
    }

    .btn-main {
        border: none;
        background: linear-gradient(135deg, #a78bfa, #60a5fa);
        color: #1a0b2e;
        font-weight: 600;
    }
    .btn-main:hover {
        background: linear-gradient(135deg, #8b5cf6, #3b82f6);
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
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        margin-bottom: 12px;
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        padding: 16px;
        transition: all 0.3s ease;
    }

    .list-group-item:hover {
        background: rgba(255, 255, 255, 0.1);
        box-shadow: 0 4px 12px rgba(167, 139, 250, 0.3);
    }

    .text-muted {
        color: rgba(255, 255, 255, 0.6) !important;
    }

    h1, h4 {
        color: #ffffff;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
        font-weight: 600;
    }

    h4 {
        margin-top: 40px;
        margin-bottom: 20px;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
    }
</style>
<div class="container py-4">
    <h1 class="mb-4">✏️ Editar llista: {{ $llista->nom }}</h1>

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
            <button type="submit" class="btn btn-link nom-producte {{ $estats[$producte->id_producte] ? 'ratllat' : '' }}">
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