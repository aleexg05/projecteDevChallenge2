@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear nova categoria</h2>

    <form action="{{ route('categoria.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nom_categoria" class="form-label">Nom de la categoria</label>
            <input type="text" name="nom_categoria" id="nom_categoria" class="form-control" required>
        </div>

       

        <button type="submit" class="btn btn-primary">Guardar categoria</button>
    </form>
</div>
@endsection
