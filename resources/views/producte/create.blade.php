@extends('layouts.app')

@section('títol', 'Crear producte')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center text-success">➕ Crear producte</h1>

    <form action="{{ route('productes.store', $llista->id_llista_compra) }}" method="POST">
        @csrf

        <!-- Nom del producte -->
        <div class="mb-3">
            <label for="nom_producte" class="form-label">Nom del producte</label>
            <input type="text" name="nom_producte" id="nom_producte" class="form-control" required>
        </div>

        <!-- Categoria -->
        <div class="mb-3">
            <label for="id_categoria" class="form-label">Categoria</label>
            <select name="id_categoria" id="id_categoria" class="form-select" required>
                @foreach($categories as $categoria)
                    <option value="{{ $categoria->id_categoria }}">{{ $categoria->nom_categoria }}</option>
                @endforeach
            </select>
        </div>

        <!-- Llista de compra -->
        <input type="hidden" name="id_llista_compra" value="{{ $llista->id_llista_compra }}">
        <p class="form-text">Afegint producte a la llista: <strong>{{ $llista->nom }}</strong></p>

        <!-- Etiqueta -->
        <div class="mb-3">
            <label for="etiqueta_producte" class="form-label">Etiqueta</label>
            <input type="text" name="etiqueta_producte" id="etiqueta_producte" class="form-control" required>
        </div>

        <!-- Botons -->
        <button type="submit" class="btn btn-success">Crear producte</button>
        <a href="{{ route('llistes.editar', $llista->id_llista_compra) }}" class="btn btn-secondary">Cancel·lar</a>
    </form>
</div>
@endsection
