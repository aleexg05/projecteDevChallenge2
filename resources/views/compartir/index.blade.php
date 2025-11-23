@extends('layouts.app')

@section('títol', 'Compartir llista')

@section('content')
<style>
    h1, h2, h3 {
        color: #ffffff;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
        font-weight: 600;
    }

    h3 {
        margin-top: 40px;
        margin-bottom: 20px;
    }

    body, p, label, span, div {
        color: #ffffff;
    }

    .form-control, input, select {
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

    .form-control:focus, select:focus {
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

    select option {
        background: #1a0b2e;
        color: #ffffff;
    }

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

    .btn-outline-primary {
        border-color: #a78bfa;
        color: #a78bfa;
        background-color: rgba(167, 139, 250, 0.1);
    }
    .btn-outline-primary:hover {
        background-color: #a78bfa;
        color: #1a0b2e;
    }

    .btn-outline-secondary {
        border-color: #60a5fa;
        color: #60a5fa;
        background-color: rgba(96, 165, 250, 0.1);
    }
    .btn-outline-secondary:hover {
        background-color: #60a5fa;
        color: #0f3460;
    }

    .btn-outline-danger {
        border-color: #ef4444;
        color: #ef4444;
        background-color: rgba(239, 68, 68, 0.1);
    }
    .btn-outline-danger:hover {
        background-color: #ef4444;
        color: #fff;
    }

    .list-group-item {
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        margin-bottom: 12px;
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        padding: 16px;
        transition: all 0.3s ease;
    }

    .list-group-item:hover {
        background: rgba(255, 255, 255, 0.1);
        box-shadow: 0 4px 12px rgba(167, 139, 250, 0.3);
    }

    .alert {
        border-radius: 8px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        color: #fff;
        margin-bottom: 20px;
    }

    .alert-success {
        background: rgba(34, 197, 94, 0.15);
        border-color: rgba(34, 197, 94, 0.5);
    }

    .alert-danger {
        background: rgba(239, 68, 68, 0.15);
        border-color: rgba(239, 68, 68, 0.5);
    }

    .alert-info {
        background: rgba(96, 165, 250, 0.15);
        border-color: rgba(96, 165, 250, 0.5);
    }

    .badge {
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 500;
    }

    .badge-lectura {
        background: rgba(96, 165, 250, 0.2);
        color: #60a5fa;
        border: 1px solid rgba(96, 165, 250, 0.5);
    }

    .badge-edicio {
        background: rgba(34, 197, 94, 0.2);
        color: #22c55e;
        border: 1px solid rgba(34, 197, 94, 0.5);
    }

    .container {
        max-width: 900px;
        margin: 0 auto;
    }

    .form-compartir {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 40px;
    }
</style>

<div class="container py-4">
    <h1>🔗 Compartir llista: {{ $llista->nom }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Formulari per compartir -->
    <div class="form-compartir">
        <h3>➕ Afegir persona</h3>
        <form action="{{ route('compartir.store', $llista->id_llista_compra) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email de l'usuari</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="usuari@example.com" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="permis" class="form-label">Permís</label>
                    <select name="permis" id="permis" class="form-control" required>
                        <option value="lectura">Només lectura 👁️</option>
                        <option value="edicio">Pot editar ✏️</option>
                    </select>
                </div>
                <div class="col-md-2 mb-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-outline-primary w-100">Compartir</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Llista d'usuaris amb accés -->
    <h3>👥 Persones amb accés</h3>
    @if($usuarisCompartits->count())
        <ul class="list-group">
            @foreach($usuarisCompartits as $usuari)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $usuari->name }}</strong>
                        <span class="text-muted">({{ $usuari->email }})</span>
                        <span class="badge badge-{{ $usuari->pivot->permis }}">
                            {{ $usuari->pivot->permis === 'lectura' ? '👁️ Lectura' : '✏️ Edició' }}
                        </span>
                    </div>
                    <div class="d-flex gap-2">
                        <form action="{{ route('compartir.permis', [$llista->id_llista_compra, $usuari->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="permis" value="{{ $usuari->pivot->permis === 'lectura' ? 'edicio' : 'lectura' }}">
                            <button type="submit" class="btn btn-sm btn-outline-secondary">
                                {{ $usuari->pivot->permis === 'lectura' ? '🔓 Donar edició' : '🔒 Només lectura' }}
                            </button>
                        </form>
                        <form action="{{ route('compartir.eliminar', [$llista->id_llista_compra, $usuari->id]) }}" method="POST" onsubmit="return confirm('Deixar de compartir amb aquest usuari?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-info">
            Encara no has compartit aquesta llista amb ningú.
        </div>
    @endif

    <div class="text-end mt-4">
        <a href="{{ route('llistes.editar', $llista->id_llista_compra) }}" class="btn btn-outline-secondary">← Tornar a la llista</a>
    </div>
</div>
@endsection