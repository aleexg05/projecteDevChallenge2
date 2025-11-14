@extends('layouts.app')

@section('títol', 'Les meves llistes de compra')

@section('content')
<div class="container py-4">
    <style>
  /* Botons principals centrats i separats */
.button-group {
    display: flex;
    justify-content: center;
    gap: 32px;
    margin-bottom: 40px;
}

/* Botó de crear llista més avall i a la dreta */
.create-button {
    text-align: right;
    margin-right:60px;
    margin-bottom: 32px;
    
}

/* Botons generals */
.btn {
    padding: 12px 20px;
    border-radius: 6px;
    font-size: 15px;
    text-decoration: none;
    border: 1px solid #ccc;
    background-color: #fff;
    color: #333;
    transition: all 0.2s ease;
    display: inline-block;
    margin-left:20px;
    margin-bottom:20px; 
}

.btn:hover {
    background-color: #f0f0f0;
}

/* Variants minimalistes */
.btn-outline-primary {
    border-color: #444;
    color: #444;
}
.btn-outline-primary:hover {
    background-color: #444;
    color: #fff;
}

.btn-outline-secondary {
    border-color: #888;
    color: #888;
}
.btn-outline-secondary:hover {
    background-color: #888;
    color: #fff;
}

.btn-main {
    border-color: #222;
    color: #222;
    font-weight: 500;
}
.btn-main:hover {
    background-color: #222;
    color: #fff;
}#nomLlista{
    margin-left:20px;
    margin-bottom:40px;
}#botoEditar{
margin-top:10px;
}



    </style>

    <!-- Botons superiors -->
    <!-- Botons principals -->
<div class="button-group text-center mb-5">
    <a href="{{ route('llistes.index') }}" class="btn btn-outline-primary">Les meves llistes</a>
    <a href="{{ route('llistes.index') }}" class="btn btn-outline-secondary">Llistes compartides amb mi</a>
</div>

<!-- Botó de crear llista -->
<div class="create-button">
    <a href="{{ route('llistes.create') }}" class="btn btn-main">+ Crear llista</a>
</div>


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Llistes -->
    @if($llistes->count())
        <ul class="list-group">
            @foreach($llistes as $llista)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong id="nomLlista">{{ $llista->nom }}</strong>
                    <div class="d-flex gap-2">
                        <a id="botoEditar" href="{{ route('llistes.editar', $llista->id_llista_compra) }}" class="btn btn-sm btn-outline-warning">
                            Editar
                        </a>
                        <form action="{{ route('llistes.eliminar', $llista->id_llista_compra) }}" method="POST" onsubmit="return confirm('Segur que vols eliminar aquesta llista?');">
                            @csrf
                            @method('DELETE')
                            <button id="botoEliminar" type="submit" class="btn btn-sm btn-outline-danger">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-info text-center">
            No tens cap llista creada. <a href="{{ route('llistes.create') }}">Crea una nova llista</a>.
        </div>
    @endif
</div>
@endsection
