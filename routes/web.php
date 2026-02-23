<?php

use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/pokemones', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/pokemon-list', [PokemonController::class, 'webIndex'])->name('pokemon.list');
