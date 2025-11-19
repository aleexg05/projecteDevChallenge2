@extends('layouts.app')

@section('títol', 'Crear nova llista')

@section('content')
<style>
/* Títols */
h1, h2, h3, h4, h5 {
    color: #ffffff;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

/* Text general */
body, p, label, span, div {
    color: #ffffff;
}

/* Formularis */
.form-control, input, textarea, select {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: #ffffff;
    backdrop-filter: blur(10px);
    padding: 10px 15px;
    border-radius: 6px;
    transition: all 0.2s ease;
}

.form-control::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.form-control:focus {
    background: rgba(255, 255, 255, 0.15);
    border-color: #a78bfa;
    color: #ffffff;
    box-shadow: 0 0 0 0.2rem rgba(167, 139, 250, 0.25);
    outline: none;
}

.form-label {
    color: #ffffff;
    font-weight: 500;
    margin-bottom: 8px;
}

/* Botons */
.btn {
    padding: 10px 18px;
    border-radius: 6px;
    font-size: 14px;
    text-decoration: none;
    border: 1px solid rgba(255, 255, 255, 0.3);
    background-color: rgba(255, 255, 255, 0.1);
    color: #fff;
    transition: all 0.2s ease;
    display: inline-block;
    margin-right: 10px;
}

.btn:hover {
    background-color: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
}

.btn-success {
    border-color: #22c55e;
    color: #22c55e;
    background-color: rgba(34, 197, 94, 0.1);
}

.btn-success:hover {
    background-color: #22c55e;
    color: #fff;
}

.btn-secondary {
    border-color: #60a5fa;
    color: #60a5fa;
    background-color: rgba(96, 165, 250, 0.1);
}

.btn-secondary:hover {
    background-color: #60a5fa;
    color: #0f3460;
}

.container {
    max-width: 600px;
    margin: 0 auto;
}

h1 {
    text-align: center;
    margin-bottom: 30px;
    font-weight: 600;
}
</style>
<div class="container py-4">
    <h1 class="mb-4">➕ Nova llista de compra</h1>

    <form action="{{ route('llistes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nom" class="form-label">Nom de la llista</label>
            <input type="text" name="nom" id="nom" class="form-control" placeholder="Escriu el nom de la llista..." required>
        </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success">✅ Crear llista</button>
            <a href="{{ route('llistes.index') }}" class="btn btn-secondary">❌ Cancel·lar</a>
        </div>
    </form>
</div>
@endsection