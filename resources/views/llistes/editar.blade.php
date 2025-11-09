@extends('layouts.app')

@section('títol', 'Editar llista de compra')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center text-warning">✏️ Editar llista: {{ $llista->nom }}</h1>

    <!-- Formulari per editar el nom -->
    <form action="{{ route('llistes.actualitzar', $llista->id_llista_compra) }}" method="POST" class="mb-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom de la llista</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $llista->nom) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Desar canvis</button>
        <a href="{{ route('llistes.index') }}" class="btn btn-secondary">Cancel·lar</a>
    </form>

    <!-- Accions: afegir producte o categoria -->
    <div class="mb-4 d-flex justify-content-between">
        <a href="{{ route('productes.create', $llista->id_llista_compra) }}" class="btn btn-success">
            ➕ Afegir producte
        </a>
        <a href="{{ route('categories.create', $llista->id_llista_compra) }}" class="btn btn-secondary">➕ Nova categoria</a>

    </div>

    <!-- Productes actuals -->
    <h4 class="mt-4">📦 Productes en aquesta llista</h4>
    @forelse($llista->productes as $producte)
        <div class="card mb-2">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $producte->nom_producte }}</strong>
                    <span class="text-muted">({{ $producte->categoria->nom_categoria ?? 'Sense categoria' }})</span>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('productes.editar', $producte->id_producte) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('productes.eliminar', $producte->id_producte) }}" method="POST" onsubmit="return confirm('Eliminar producte?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">No hi ha productes en aquesta llista.</p>
    @endforelse
</div>
@endsection
