<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StreamController;
use Illuminate\Http\Request;

// Página de aterrizaje (Landing Page)
Route::get('/', function () {
    return view('welcome');
});

// Sección de TV en Vivo (tu vista existente)
Route::get('/tv', function () {
    return view('tv');
});

// NUEVO: Catálogo de Películas (tipo imagen 2)
Route::get('/peliculas', function () {
    return view('peliculas.welcome');
})->name('peliculas.welcome');

// NUEVO: Vista detallada de una Película (con Plyr)
Route::get('/peliculas/{slug}', function ($slug) {
    // Aquí puedes buscar la película por su slug. De momento es un ejemplo estático.
    if ($slug === 'hoppers-operacion-castor') {
        return view('peliculas.show');
    }
    abort(404);
})->name('peliculas.show');

// Proxy de Streaming (tu ruta existente)
Route::get('/stream-proxy', [StreamController::class, 'play'])->name('stream.proxy');

// NUEVO: Endpoint para obtener la URL dinámica de América TV para el frontend
Route::get('/stream/dynamic/america', [StreamController::class, 'getAmericaTvUrl']);
Route::get('/video-stream/{filename}', [StreamController::class, 'streamMovie'])->name('video.stream');
