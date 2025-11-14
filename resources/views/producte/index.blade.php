@extends('layouts.app')

@section('títol', 'Gestionar productes')

@section('content')
<style>
/* Estil minimalista coherent */
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

.list-group { list-style: none; padding: 0; margin: 0; }
.list-group-item {
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    margin-bottom: 12px;
    background: #fafafa;
    padding: 16px;
}

.header-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}
</style>

<div class="container py-4">
    <div class="header-actions">
        <h1 class="mb-0">📦 Gestionar productes — {{ $llista->nom }}</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('productes.create', $llista->id_llista_compra) }}" class="btn btn-outline-primary">➕ Afegir producte</a>
            <a href="{{ route('llistes.editar', $llista->id_llista_compra) }}" class="btn btn-outline-secondary">← Tornar a la llista</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($productes->count())
        <ul class="list-group">
            @foreach($productes as $producte)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $producte->nom_producte }}</strong>
                        <span class="text-muted">({{ $producte->categoria->nom_categoria ?? 'Sense categoria' }})</span>
                        @if(!empty($producte->etiqueta_producte))
                            <span class="text-muted ms-2">— {{ $producte->etiqueta_producte }}</span>
                        @endif
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('productes.editar', $producte->id_producte) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                        <form action="{{ route('productes.eliminar', $producte->id_producte) }}" method="POST" onsubmit="return confirm('Eliminar producte?');">
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
            No hi ha productes en aquesta llista.
        </div>
    @endif
</div>
@endsection
