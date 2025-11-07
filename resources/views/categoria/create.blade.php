@extends('layouts.app') {{-- Si tens una plantilla base --}}

@section('content')
<div class="container">
    <h2>Crear nova llista de compra</h2>

    <form action="{{ route('llista_compra.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nom_llista" class="form-label">Nom de la llista</label>
            <input type="text" name="nom_llista" id="nom_llista" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="descripcio" class="form-label">Descripció</label>
            <textarea name="descripcio" id="descripcio" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
