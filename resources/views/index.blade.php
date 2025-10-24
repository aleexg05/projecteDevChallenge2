@extends('layouts.app')

@section('títol', 'Categories i productes')

@section('content')
<div class="container py-4">
    <h1 class="mb-5 text-center text-primary">🛒 Categories i productes</h1>

    @foreach($categories as $categoria)
        <div class="card shadow-sm mb-5 border-0">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h2 class="h5 mb-0 text-dark">{{ $categoria->nom }}</h2>
                <span class="badge bg-secondary">{{ $categoria->productes->count() }} productes</span>
            </div>
            <div class="card-body bg-white">
                @if($categoria->productes->count())
                    <ul class="list-group list-group-flush">
                        @foreach($categoria->productes as $producte)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-3">
                                    <i class="bi bi-box-seam text-primary fs-5"></i>
                                    <span class="fw-semibold">{{ $producte->nom }}</span>
                                </div>
                                <span class="badge bg-success fs-6">{{ number_format($producte->preu, 2) }} €</span>
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
