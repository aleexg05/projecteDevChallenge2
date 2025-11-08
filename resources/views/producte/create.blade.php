@extends('layouts.app')

@section('títol', 'Crear producte')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center text-success">➕ Crear producte</h1>

    <form action="{{ route('producte.store') }}" method="POST">
        @csrf

        <!-- Nom del producte -->
        <div class="mb-3">
            <label for="nom_producte" class="form-label">Nom del producte</label>
            <input type="text" name="nom_producte" id="nom_producte" class="form-control" required>
        </div>

        <!-- Comprat -->
        <div class="mb-3 form-check">
            <input type="checkbox" name="comprat" id="comprat" class="form-check-input" value="1">
            <label for="comprat" class="form-check-label">Comprat</label>
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
        <div class="mb-3">
            <label for="id_llista_compra" class="form-label">Llista de compra</label>
            <select name="id_llista_compra" id="id_llista_compra" class="form-select" required>
                @foreach($llistes as $llista)
                    <option value="{{ $llista->id_llista_compra }}">{{ $llista->nom_llista }}</option>
                @endforeach
            </select>
        </div>

        <!-- Etiqueta -->
        <div class="mb-3">
            <label for="etiqueta_producte" class="form-label">Etiqueta</label>
            <input type="text" name="etiqueta_producte" id="etiqueta_producte" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Crear producte</button>
        <a href="{{ route('categoria.eliminarCategoria') }}" class="btn btn-secondary">Cancel·lar</a>
    </form>
</div>
@endsection
