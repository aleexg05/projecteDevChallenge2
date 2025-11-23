@extends('layouts.app')

@section('títol', 'Llistes compartides amb mi')

@section('content')
<style>
/* Botons principals centrats i separats */
.button-group {
    display: flex;
    justify-content: center;
    gap: 32px;
    margin-bottom: 40px;
}

/* Botons generals */
.btn {
    padding: 12px 20px;
    border-radius: 6px;
    font-size: 15px;
    text-decoration: none;
    border: 1px solid rgba(255, 255, 255, 0.3);
    background-color: rgba(255, 255, 255, 0.1);
    color: #fff;
    transition: all 0.2s ease;
    display: inline-block;
    margin-left: 20px;
    margin-bottom: 20px;
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

.btn-outline-warning {
    border-color: #ffc107;
    color: #ffc107;
    background-color: rgba(255, 193, 7, 0.1);
}
.btn-outline-warning:hover {
    background-color: #ffc107;
    color: #000;
}

.badge {
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 500;
    margin-left: 12px;
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

.list-group-item {
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    margin-bottom: 12px;
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
    padding: 20px;
}

.list-group-item:hover {
    background: rgba(255, 255, 255, 0.1);
    box-shadow: 0 4px 12px rgba(167, 139, 250, 0.3);
    transform: translateX(5px);
}

.alert {
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    color: #fff;
}

.text-muted {
    color: rgba(255, 255, 255, 0.6) !important;
}

h1 {
    color: #ffffff;
    text-align: center;
    margin-bottom: 30px;
    font-weight: 600;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.llista-info {
    color: #ffffff;
    font-size: 18px;
}

.llista-propietari {
    color: rgba(255, 255, 255, 0.7);
    font-size: 14px;
    margin-top: 4px;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
}
</style>

<div class="container py-4">
    <!-- Botons principals -->
    <div class="button-group text-center mb-5">
        <a href="{{ route('llistes.index') }}" class="btn btn-outline-primary">Les meves llistes</a>
        <a href="{{ route('compartir.compartides-amb-mi') }}" class="btn btn-outline-secondary">Llistes compartides amb mi</a>
    </div>

    <h1>🔗 Llistes compartides amb mi</h1>

    <!-- Llistes compartides -->
    @if($llistesCompartides->count())
        <ul class="list-group">
            @foreach($llistesCompartides as $llista)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <div class="llista-info">
                            <strong>{{ $llista->nom }}</strong>
                            <span class="badge badge-{{ $llista->pivot->permis }}">
                                {{ $llista->pivot->permis === 'lectura' ? '👁️ Lectura' : '✏️ Edició' }}
                            </span>
                        </div>
                        <div class="llista-propietari">
                            Compartida per: {{ $llista->creador->name }}
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('llistes.editar', $llista->id_llista_compra) }}" class="btn btn-sm btn-outline-warning">
                            {{ $llista->pivot->permis === 'edicio' ? 'Editar' : 'Veure' }}
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-info text-center">
            Encara no tens cap llista compartida amb tu.
        </div>
    @endif
</div>
@endsection