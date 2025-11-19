@extends('layouts.app')

@section('títol', 'Eliminar productes')

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

    .btn-warning {
        background-color: rgba(255, 193, 7, 0.2);
        border-color: #ffc107;
        color: #ffc107;
    }

    .btn-warning:hover {
        background-color: #ffc107;
        color: #000;
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
    <h1 class="mb-4 text-center">🗑️ Eliminar productes</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($productes->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Preu</th>
                    <th>Accions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productes as $producte)
                    <tr>
                        <td>{{ $producte->id_producte }}</td>
                        <td>{{ $producte->nom_producte }}</td>
                        <td>{{ number_format($producte->preu, 2) }} €</td>
                        <td class="d-flex gap-2">
                            <a href="{{ route('producte.editar', $producte->id_producte) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('producte.eliminar', $producte->id_producte) }}" method="POST" onsubmit="return confirm('Segur que vols eliminar aquest producte?');">
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
        <div class="alert alert-warning">No hi ha productes disponibles.</div>
    @endif
</div>
@endsection