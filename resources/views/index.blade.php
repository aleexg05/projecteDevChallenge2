@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Categories i productes</h1>

    @foreach($categories as $categoria)
        <div class="card mb-4">
            <div class="card-header">
                <h2>{{ $categoria->nom }}</h2>
            </div>
            <div class="card-body">
                @if($categoria->productes->count())
                    <ul class="list-group">
                        @foreach($categoria->productes as $producte)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $producte->nom }}
                                <span class="badge bg-success rounded-pill">{{ $producte->preu }} €</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Aquesta categoria no té cap producte.</p>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
