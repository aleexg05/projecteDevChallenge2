@extends('layouts.app')

@section('títol', 'Gestionar categories')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center text-danger">🗑️ Eliminar categories</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($categories->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Accions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $categoria)
                    <tr>
                        <td>{{ $categoria->id_categoria }}</td>
                        <td>{{ $categoria->nom_categoria }}</td>
                        <td>
                            <form action="{{ route('categoria.eliminar', $categoria->id_categoria) }}" method="POST" onsubmit="return confirm('Segur que vols eliminar aquesta categoria?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning">No hi ha categories disponibles.</div>
    @endif
</div>
@endsection
