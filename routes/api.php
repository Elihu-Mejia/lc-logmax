<?php

use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;

Route::get('/pokemon/details', [PokemonController::class, 'indexDetails']);
Route::get('/pokemon/{name}/details', [PokemonController::class, 'show']);
Route::get('/pokemon/{key?}', [PokemonController::class, 'index']);