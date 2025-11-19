
@extends('layouts.app')

@section('títol', 'Gestionar categories')

@section('content')
<style>
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
    .btn:hover { background-color: #f0f0f0; }

    .btn-outline-primary { border-color: #444; color: #444; }
    .btn-outline-primary:hover { background-color: #444; color: #fff; }

    .btn-outline-secondary { border-color: #888; color: #888; }
    .btn-outline-secondary:hover { background-color: #888; color: #fff; }

    .btn-outline-warning { border-color: #ffc107; color: #ffc107; }
    .btn-outline-warning:hover { background-color: #ffc107; color: #000; }

    .btn-outline-danger { border-color: #dc3545; color: #dc3545; }
    .btn-outline-danger:hover { background-color: #dc3545; color: #fff; }

    .btn-main { border-color: #222; color: #222; font-weight: 500; }
    .btn-main:hover { background-color: #222; color: #fff; }

    .button-group { display: flex; gap: 24px; justify-content: center; margin-bottom: 32px; }
    .create-button { text-align: right; margin-bottom: 32px; }
    .list-group-item { border: 1px solid #e0e0e0; border-radius: 6px; margin-bottom: 12px; background: #fafafa; padding: 16px; }
</style>

<div class="container py-4">
    <h1 class="mb-4 text-center text-info">
        🏷️ Categories de la llista: {{ $llista->nom }}
    </h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Botó per crear nova categoria -->
    <div class="create-button mb-4">
        <a href="{{ route('categories.create', $llista->id_llista_compra) }}" class="btn btn-outline-primary">
            ➕ Crear nova categoria
        </a>
    </div>

    @if($categories->count())
        <ul class="list-group">
            @foreach($categories as $categoria)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $categoria->nom_categoria }}</span>
                    <div class="d-flex gap-2">
                        <a href="{{ route('categories.editar', $categoria->id_categoria) }}" class="btn btn-sm btn-outline-warning">
                            Editar
                        </a>
                        <form action="{{ route('categories.eliminar', $categoria->id_categoria) }}" method="POST" onsubmit="return confirm('Eliminar categoria?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-info text-center">
            No hi ha categories creades per aquesta llista.
        </div>
    @endif

    <div class="text-end mt-4">
        <a href="{{ route('llistes.editar', $llista->id_llista_compra) }}" class="btn btn-outline-primary">
            ← Tornar a la llista
        </a>
    </div>
</div>
@endsection 