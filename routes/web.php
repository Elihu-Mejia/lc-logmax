<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/pokemones', function () {
    return Inertia::render('Welcome');
})->name('home');
