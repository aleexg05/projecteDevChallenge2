@extends('layouts.app')

@section('títol', 'Gestionar categories')

@section('content')
<style>
    h1 {
        color: #ffffff;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .table {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        overflow: hidden;
    }

    .table thead {
        background: rgba(255, 255, 255, 0.1);
    }

    .table th,
    .table td {
        color: #ffffff;
        border-color: rgba(255, 255, 255, 0.2);
        padding: 12px;
    }

    .table-bordered {
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .alert {
        border-radius: 8px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        color: #fff;
    }

    .alert-success {
        background: rgba(34, 197, 94, 0.15);
        border-color: rgba(34, 197, 94, 0.5);
    }

    .alert-danger {
        background: rgba(239, 68, 68, 0.15);
        border-color: rgba(239, 68, 68, 0.5);
    }

    .alert-warning {
        background: rgba(255, 193, 7, 0.15);
        border-color: rgba(255, 193, 7, 0.5);
    }

    .btn-danger {
        background-color: rgba(239, 68, 68, 0.2);
        border-color: #ef4444;
        color: #ef4444;
    }

    .btn-danger:hover {
        background-color: #ef4444;
        color: #fff;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
    }
</style>

<div class="container py-4">
    <h1 class="mb-4 text-center">🗑️ Eliminar categories</h1>

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