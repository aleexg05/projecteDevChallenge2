@extends('layouts.app')

@section('títol', 'Categories i productes')

@section('content')
<div class="container py-4">
    <h1 class="mb-5 text-center text-primary display-5">🛒 Categories i productes</h1>

    <!-- Secció de llistes de compra -->
    @auth
    <div class="card shadow-sm mb-5 border border-success-subtle">
        <div class="card-header bg-success-subtle d-flex justify-content-between align-items-center px-4 py-3">
            <h2 class="h5 mb-0 text-dark">📋 Les meves llistes de compra</h2>
            <a href="{{ route('categoria.create') }}" class="btn btn-success btn-sm">
                <i class="bi bi-plus-circle"></i> Nova categoria
            </a>
        </div>
        <div class="card-body bg-white px-4 py-3">
            <div class="row g-3">
                <div class="col-md-6">
                    <i class="bi bi-list-check fs-4"></i>
                    <div class="mt-2">Les meves llistes</div>
                </div>

                <!-- Botó NOU PRODUCTE -->
                <a href="{{ route('producte.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle"></i> Nou producte
                </a>

                <!-- Botó ELIMINAR CATEGORIES -->
                <a href="{{ route('categoria.eliminarCategoria') }}" class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i> Eliminar categories
                </a>

                <div class="col-md-6">
                    <i class="bi bi-share fs-4"></i>
                    <div class="mt-2">Llistes compartides</div>
                </div>
            </div>
        </div>
    </div>
    @endauth

    <!-- Categories i productes -->
    @foreach($categories as $categoria)
        <div class="card shadow-sm mb-5 border-0">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <h2 class="h5 mb-0 text-dark">{{ $categoria->nom_categoria }}</h2>
                    <a href="{{ route('categoria.editar', $categoria->id_categoria) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i> Editar
                    </a>
                </div>
                <span class="badge bg-secondary">{{ $categoria->productes->count() }} productes</span>
            </div>
            <div class="card-body bg-white">
                @if($categoria->productes->count())
                    <ul class="list-group list-group-flush">
                        @foreach($categoria->productes as $producte)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-3">
                                    <i class="bi bi-box-seam text-primary fs-5"></i>
                                    <span class="fw-semibold">{{ $producte->nom_producte }}</span>
                                    @if($producte->comprat)
                                        <span class="badge bg-info">Comprat</span>
                                    @endif
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-success fs-6">{{ number_format($producte->preu, 2) }} €</span>
                                    <a href="{{ route('producte.editar', $producte->id_producte) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('producte.eliminar', $producte->id_producte) }}" method="POST" onsubmit="return confirm('Segur que vols eliminar aquest producte?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="alert alert-warning mb-0">
                        Aquesta categoria no té cap producte.
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
