@extends('layouts.app')

@section('títol', 'Gestionar categories')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center text-info">🏷️ Categories</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($categories->count())
        <ul class="list-group">
            @foreach($categories as $categoria)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $categoria->nom_categoria }}</span>
                    <div class="d-flex gap-2">
                        <!-- Botó editar -->
                        <a href="{{ route('categoria.editar', $categoria->id_categoria) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>

                        <!-- Formulari eliminar -->
                        <form action="{{ route('categoria.eliminar', $categoria->id_categoria) }}" method="POST" onsubmit="return confirm('Eliminar categoria?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-info text-center">
            No hi ha categories creades.
        </div>
    @endif
       <a href="{{ route('llistes.index') }}" class="btn btn-info ms-2">Tornar a les llistes</a>
</div>
@endsection
