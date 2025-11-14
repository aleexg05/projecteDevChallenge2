@extends('layouts.app')

@section('títol', 'Crear producte')

@section('content')
<style>
    .btn {
    padding: 10px 18px;
    border-radius: 6px;
    font-size: 14px;
    text-decoration: none;
    border: 1px solid #ccc;
    background-color: #fff;
    color: #333;
    transition: all 0.2s ease;
    display: inline-block;
}
.btn:hover { background-color: #f0f0f0; }

.btn-outline-primary { border-color: #444; color: #444; }
.btn-outline-primary:hover { background-color: #444; color: #fff; }

.btn-outline-secondary { border-color: #888; color: #888; }
.btn-outline-secondary:hover { background-color: #888; color: #fff; }

.btn-outline-warning { border-color: #ffc107; color: #ffc107; }
.btn-outline-warning:hover { background-color: #ffc107; color: #000; }

.btn-outline-danger { border-color: #dc3545; color: #dc3545; }
.btn-outline-danger:hover { background-color: #dc3545; color: #fff; }

.btn-main { border-color: #222; color: #222; font-weight: 500; }
.btn-main:hover { background-color: #222; color: #fff; }

.button-group { display: flex; gap: 24px; justify-content: center; margin-bottom: 32px; }
.create-button { text-align: right; margin-bottom: 32px; }
.list-group-item { border: 1px solid #e0e0e0; border-radius: 6px; margin-bottom: 12px; background: #fafafa; padding: 16px; }

</style>
<div class="container py-4">
    <h1 class="mb-4 text-center text-success">➕ Crear producte</h1>

    <form action="{{ route('productes.store', $llista->id_llista_compra) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nom_producte" class="form-label">Nom del producte</label>
            <input type="text" name="nom_producte" id="nom_producte" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="id_categoria" class="form-label">Categoria</label>
            <select name="id_categoria" id="id_categoria" class="form-select" required>
                @foreach($categories as $categoria)
                    <option value="{{ $categoria->id_categoria }}">{{ $categoria->nom_categoria }}</option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="id_llista_compra" value="{{ $llista->id_llista_compra }}">
        <p class="form-text">Afegint producte a la llista: <strong>{{ $llista->nom }}</strong></p>

        <div class="mb-3">
            <label for="etiqueta_producte" class="form-label">Etiqueta</label>
            <input type="text" name="etiqueta_producte" id="etiqueta_producte" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-outline-primary">Crear producte</button>
<a href="{{ route('llistes.editar', $llista->id_llista_compra) }}" class="btn btn-outline-secondary">Cancel·lar</a>

    </form>
</div>
@endsection
