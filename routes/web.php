<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProducteController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LlistaCompraController;
use App\Http\Controllers\CompartirController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutes de llistes de compra
    Route::get('/llistes', [LlistaCompraController::class, 'index'])->name('llistes.index');
    Route::get('/llistes/create', [LlistaCompraController::class, 'create'])->name('llistes.create');
    Route::post('/llistes', [LlistaCompraController::class, 'store'])->name('llistes.store');
    Route::get('/llistes/{id}/editar', [LlistaCompraController::class, 'editar'])->name('llistes.editar');
    Route::get('/llistes/{id}/editarNom', [LlistaCompraController::class, 'editarNom'])->name('llistes.editarNom');
    Route::put('/llistes/{id}', [LlistaCompraController::class, 'actualitzar'])->name('llistes.actualitzar');
    Route::delete('/llistes/{id}', [LlistaCompraController::class, 'eliminar'])->name('llistes.eliminar');

    // Rutes de categories
    Route::get('/llistes/{id_llista}/categories', [CategoriaController::class, 'index'])->name('categories.index');
    Route::get('/llistes/{id_llista}/categories/create', [CategoriaController::class, 'create'])->name('categories.create');
    Route::post('/llistes/{id_llista}/categories', [CategoriaController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id_categoria}/editar', [CategoriaController::class, 'editar'])->name('categories.editar');
    Route::put('/categories/{id_categoria}', [CategoriaController::class, 'actualitzar'])->name('categories.actualitzar');
    Route::delete('/categories/{id}', [CategoriaController::class, 'eliminar'])->name('categories.eliminar');

    // Rutes de productes
    Route::get('/llistes/{id_llista}/productes', [ProducteController::class, 'index'])->name('productes.index');
    Route::get('/llistes/{id_llista}/productes/create', [ProducteController::class, 'create'])->name('productes.create');
    Route::post('/llistes/{id_llista}/productes', [ProducteController::class, 'store'])->name('productes.store');
    Route::get('/productes/{id_producte}/editar', [ProducteController::class, 'editar'])->name('productes.editar');
    Route::put('/productes/{id_producte}', [ProducteController::class, 'actualitzar'])->name('productes.actualitzar');
    Route::delete('/productes/{id}', [ProducteController::class, 'eliminar'])->name('productes.eliminar');
    Route::put('/llistes/{id_llista}/productes/{id_producte}/toggle', [ProducteController::class, 'toggle'])->name('productes.toggle');

    // ===== RUTES DE COMPARTIR =====

    // Veure llistes compartides amb mi
    Route::get('/compartides-amb-mi', [CompartirController::class, 'llistesCompartidesAmbMi'])->name('compartir.compartides-amb-mi');

    // Gestionar comparticions d'una llista (només propietari)
    Route::get('/llistes/{id_llista}/compartir', [CompartirController::class, 'index'])->name('compartir.index');
    Route::post('/llistes/{id_llista}/compartir', [CompartirController::class, 'compartir'])->name('compartir.store');
    Route::delete('/llistes/{id_llista}/compartir/{id_usuari}', [CompartirController::class, 'deixarCompartir'])->name('compartir.eliminar');
    Route::put('/llistes/{id_llista}/compartir/{id_usuari}/permis', [CompartirController::class, 'canviarPermis'])->name('compartir.permis');
});

require __DIR__ . '/auth.php';
