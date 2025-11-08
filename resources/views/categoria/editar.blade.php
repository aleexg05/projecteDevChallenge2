@extends('layouts.app')

@section('títol', 'Editar categoria')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center text-warning">✏️ Editar categoria</h1>

    <form action="{{ route('categoria.actualitzar', $categoria->id_categoria) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom_categoria" class="form-label">Nom de la categoria</label>
            <input type="text" name="nom_categoria" id="nom_categoria" class="form-control" value="{{ old('nom_categoria', $categoria->nom_categoria) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Desar canvis</button>
        <a href="{{ route('categoria.eliminarCategoria') }}" class="btn btn-secondary">Cancel·lar</a>
    </form>
</div>
@endsection
