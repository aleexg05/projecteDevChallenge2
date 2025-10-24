<!-- @extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center">🛒 Llista de la Compra</h1>

    {{-- Mostrar missatges d’error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Llistat de categories --}}
    @foreach ($categories as $categoria)
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">{{ $categoria->nom_categoria }}</h4>
            </div>

            <div class="card-body">
                {{-- Productes de la categoria --}}
                @if ($categoria->productes->count() > 0)
                    <ul class="list-group mb-3">
                        @foreach ($categoria->productes as $producte)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <form action="{{ route('productes.toggle', $producte) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success">
                                            @if ($producte->comprat)
                                                ✅
                                            @else
                                                ☐
                                            @endif
                                        </button>
                                    </form>

                                    <span class="@if($producte->comprat) text-decoration-line-through text-muted @endif ms-2">
                                        {{ $producte->nom_producte }}
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No hi ha productes en aquesta categoria.</p>
                @endif

                {{-- Formulari per afegir productes --}}
                <form action="{{ route('productes.store') }}" method="POST" class="d-flex gap-2">
                    @csrf
                    <input type="hidden" name="id_categoria" value="{{ $categoria->id_categoria }}">
                    <input type="text" name="nom_producte" class="form-control" placeholder="Afegeix un nou producte..." required>
                    <button type="submit" class="btn btn-primary">Afegir</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection -->
