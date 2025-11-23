@extends('layouts.app')

@section('títol', 'Editar etiqueta')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">✏️ Editar etiqueta</h1>

    <form action="{{ route('etiquetes.update', $etiqueta->id_etiqueta) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom_etiqueta" class="form-label">Nom de l’etiqueta</label>
            <input type="text" name="nom_etiqueta" id="nom_etiqueta" 
                   class="form-control" value="{{ $etiqueta->nom_etiqueta }}" required maxlength="50">
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-main">💾 Guardar canvis</button>
            <a href="{{ route('etiquetes.index') }}" class="btn btn-outline-primary">← Tornar</a>
        </div>
    </form>
</div>
@endsection
