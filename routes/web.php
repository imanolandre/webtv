<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StreamController;
use App\Models\Channel; // Importamos el modelo
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Movie;

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



// Listado de Películas
Route::get('/peliculas', function () {
    $heroMovies = Movie::where('is_visible', true)->orderBy('year', 'desc')->orderBy('created_at', 'desc')->take(5)->get();
    $topMovies = Movie::where('is_visible', true)->orderBy('created_at', 'desc')->take(8)->get();
    $allMovies = Movie::where('is_visible', true)->get();

    return view('peliculas.welcome', compact('heroMovies', 'topMovies', 'allMovies'));
})->name('peliculas.welcome');

// Detalle de la Película (Dinámico)
Route::get('/peliculas/{id}', function ($id) {
    $movie = Movie::findOrFail($id); // Busca la película o lanza 404
    return view('peliculas.show', compact('movie'));
})->name('peliculas.show');

// Proxy de Streaming
Route::get('/stream-proxy', [StreamController::class, 'play'])->name('stream.proxy');
Route::get('/stream-auto', [StreamController::class, 'autoFetchChannel'])->name('stream.auto');

// Endpoints de Streaming
Route::get('/stream/dynamic/america', [StreamController::class, 'getAmericaTvUrl']);
Route::get('/video-stream/{filename}', [StreamController::class, 'streamMovie'])->name('video.stream');

});


