@extends('layouts.app')

@section('títol', 'Crear nova llista')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center text-success">➕ Nova llista de compra</h1>

    <form action="{{ route('llistes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nom" class="form-label">Nom de la llista</label>
            <input type="text" name="nom" id="nom" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Crear</button>
        <a href="{{ route('llistes.index') }}" class="btn btn-secondary">Cancel·lar</a>
    </form>
</div>
@endsection
