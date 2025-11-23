@extends('layouts.app')

@section('títol', 'Etiquetes')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">🏷️ Etiquetes</h1>

    <div class="text-end mb-3">
        <a href="{{ route('etiquetes.create') }}" class="btn btn-main">➕ Nova etiqueta</a>
    </div>

    @forelse($etiquetes as $etiqueta)
        <div class="list-group-item d-flex justify-content-between align-items-center">
            <span>{{ $etiqueta->nom_etiqueta }}</span>
            <div>
                <a href="{{ route('etiquetes.edit', $etiqueta->id_etiqueta) }}" class="btn btn-outline-secondary">✏️ Editar</a>
                <form action="{{ route('etiquetes.destroy', $etiqueta->id_etiqueta) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">🗑️ Eliminar</button>
                </form>
            </div>
        </div>
    @empty
        <p class="text-muted">Encara no hi ha etiquetes creades.</p>
    @endforelse
</div>
@endsection
