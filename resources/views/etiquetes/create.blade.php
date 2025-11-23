@extends('layouts.app')

@section('títol', 'Crear etiqueta')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">🏷️ Crear nova etiqueta</h1>

    <form action="{{ route('etiquetes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nom_etiqueta" class="form-label">Nom de l’etiqueta</label>
            <input type="text" name="nom_etiqueta" id="nom_etiqueta" 
                   class="form-control" required maxlength="50">
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-main">➕ Crear etiqueta</button>
            <a href="{{ route('etiquetes.index') }}" class="btn btn-outline-primary">← Tornar</a>
        </div>
    </form>
</div>
@endsection
