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
            <a href="{{ route('llista_compra.create') }}" class="btn btn-success btn-sm">
                <i class="bi bi-plus-circle"></i> Nova llista
            </a>
        </div>
        <div class="card-body bg-white px-4 py-3">
            <div class="row g-3">
                <div class="col-md-6">
                    <a href="{{ route('llistes.index') }}" class="btn btn-outline-primary w-100 py-3">
                        <i class="bi bi-list-check fs-4"></i>
                        <div class="mt-2">Les meves llistes</div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('llistes.shared') }}" class="btn btn-outline-info w-100 py-3">
                        <i class="bi bi-share fs-4"></i>
                        <div class="mt-2">Llistes compartides</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endauth

    <!-- Categories i productes (codi existent) -->
    @foreach($categories as $categoria)
    <div class="card shadow-sm mb-5 border border-primary-subtle">
        <div class="card-header bg-primary-subtle d-flex justify-content-between align-items-center px-4 py-3">
            <h2 class="h5 mb-0 text-dark">{{ $categoria->nom_categoria }}</h2>
            <span class="badge bg-primary">{{ $categoria->productes->count() }} productes</span>
        </div>
        <div class="card-body bg-white px-4 py-3">
            @if($categoria->productes->count())
            <ul class="list-group list-group-flush">
                @foreach($categoria->productes as $producte)
                <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-3">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-box-seam text-primary fs-4"></i>
                        <div>
                            <div class="fw-semibold fs-6">{{ $producte->nom_producte }}</div>
                            @if($producte->comprat)
                            <span class="badge bg-info mt-1">Comprat</span>
                            @endif
                        </div>
                    </div>
                    <span class="badge bg-success fs-6 px-3 py-2">{{ number_format($producte->preu, 2) }} €</span>
                </li>
                @endforeach
            </ul>
            @else
            <div class="alert alert-warning mb-0 px-3 py-2">
                Aquesta categoria no té cap producte.
            </div>
            @endif
        </div>
    </div>
    @endforeach
</div>
@endsection