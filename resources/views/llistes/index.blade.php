@extends('layouts.app')

@section('títol', 'Les meves llistes')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center text-primary">🛒 Les meves llistes de compra</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($llistes->count())
        <ul class="list-group">
            @foreach($llistes as $llista)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $llista->nom }}</span>
                    <div class="d-flex gap-2">
                        <a href="{{ route('llistes.editar', $llista->id_llista_compra) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('llistes.eliminar', $llista->id_llista_compra) }}" method="POST" onsubmit="return confirm('Eliminar aquesta llista?');">
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
            Encara no tens cap llista. <a href="{{ route('llistes.create') }}">Crea una nova llista</a>.
        </div>
    @endif
</div>
@endsection
