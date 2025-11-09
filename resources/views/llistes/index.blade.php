@extends('layouts.app')

@section('títol', 'Les meves llistes de compra')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center text-primary">🛒 Les meves llistes de compra</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Botó per crear nova llista -->
    <div class="mb-4 text-end">
        <a href="{{ route('llistes.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Nova llista
        </a>
    </div>

    @if($llistes->count())
        <ul class="list-group">
            @foreach($llistes as $llista)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $llista->nom }}</strong>
                        <span class="text-muted ms-2">ID: {{ $llista->id_llista_compra }}</span>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('llistes.editar', $llista->id_llista_compra) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>
                        <form action="{{ route('llistes.eliminar', $llista->id_llista_compra) }}" method="POST" onsubmit="return confirm('Segur que vols eliminar aquesta llista?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-info text-center">
            No tens cap llista creada. <a href="{{ route('llistes.productes.create') }}">Crea una nova llista</a>.
        </div>
    @endif
</div>
@endsection
