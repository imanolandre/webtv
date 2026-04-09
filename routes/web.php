<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StreamController;
use App\Models\Channel; // Importamos el modelo
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Todas estas rutas requieren estar logueado
Route::middleware(['checkRole'])->group(function () {

// Página de aterrizaje (Landing Page)
Route::get('/', function () {
    return view('welcome');
});

// Sección de TV en Vivo - DINÁMICA
Route::get('/tv', function () {
    // Obtenemos solo los canales activos para mostrar en el frontend
    $channels = $canales = Channel::all();
    return view('tv', compact('channels'));
});

// Catálogo de Películas
Route::get('/peliculas', function () {
    return view('peliculas.welcome');
})->name('peliculas.welcome');

// Vista detallada de una Película
Route::get('/peliculas/{slug}', function ($slug) {
    if ($slug === 'hoppers-operacion-castor') {
        return view('peliculas.show');
    }
    abort(404);
})->name('peliculas.show');

// Proxy de Streaming
Route::get('/stream-proxy', [StreamController::class, 'play'])->name('stream.proxy');

// Endpoints de Streaming
Route::get('/stream/dynamic/america', [StreamController::class, 'getAmericaTvUrl']);
Route::get('/video-stream/{filename}', [StreamController::class, 'streamMovie'])->name('video.stream');

});


