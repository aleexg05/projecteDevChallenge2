@extends('layouts.app')

@section('títol', 'Editar producte')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center text-warning">✏️ Editar producte</h1>

<form action="{{ route('productes.actualitzar', $producte->id_producte) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom_producte" class="form-label">Nom del producte</label>
            <input type="text" name="nom_producte" id="nom_producte" class="form-control" value="{{ old('nom_producte', $producte->nom_producte) }}" required>
        </div>

      

        <div class="mb-3">
            <label for="id_categoria" class="form-label">Categoria</label>
            <select name="id_categoria" id="id_categoria" class="form-select" required>
                @foreach($categories as $categoria)
                    <option value="{{ $categoria->id_categoria }}" @if($producte->id_categoria == $categoria->id_categoria) selected @endif>
                        {{ $categoria->nom_categoria }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Desar canvis</button>
        <a href="{{ route('categoria.eliminarCategoria') }}" class="btn btn-secondary">Cancel·lar</a>
    </form>
</div>
@endsection
