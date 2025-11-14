@extends('layouts.app')

@section('títol', 'Editar producte')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center text-warning">✏️ Editar producte</h1>

    <form action="{{ route('productes.actualitzar', $producte->id_producte) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nom del producte -->
        <div class="mb-3">
            <label for="nom_producte" class="form-label">Nom del producte</label>
            <input type="text" name="nom_producte" id="nom_producte" class="form-control"
                   value="{{ old('nom_producte', $producte->nom_producte) }}" required>
        </div>

        <!-- Categoria -->
        <div class="mb-3">
            <label for="id_categoria" class="form-label">Categoria</label>
            <select name="id_categoria" id="id_categoria" class="form-select" required>
                @foreach($categories as $categoria)
                    <option value="{{ $categoria->id_categoria }}"
                        @if($producte->id_categoria == $categoria->id_categoria) selected @endif>
                        {{ $categoria->nom_categoria }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Etiqueta -->
        <div class="mb-3">
            <label for="etiqueta_producte" class="form-label">Etiqueta</label>
            <input type="text" name="etiqueta_producte" id="etiqueta_producte" class="form-control"
                   value="{{ old('etiqueta_producte', $producte->etiqueta_producte) }}" required>
        </div>

        <!-- Botons -->
        <button type="submit" class="btn btn-primary">Desar canvis</button>
        <a href="{{ route('llistes.editar', $producte->id_llista_compra) }}" class="btn btn-secondary">Cancel·lar</a>
    </form>
</div>
@endsection
