@extends('layouts.app')

@section('títol', 'Categories i productes')

@section('content')
<div class="container py-4">
    <h1 class="mb-5 text-center text-primary display-5">🛒 Categories i productes</h1>

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
