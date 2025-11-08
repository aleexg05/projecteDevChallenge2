@extends('layouts.app')

@section('títol', 'Eliminar productes')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center text-danger">🗑️ Eliminar productes</h1>

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
