<!DOCTYPE html>
<html lang="es" class="h-full bg-[#0f1014]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUISPETV - Películas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full text-white font-sans overflow-x-hidden selection:bg-blue-500 selection:text-white pb-20">

    @include('partials.navbar') <main class="w-full h-full relative pt-20">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

        <div class="bg-[#0f0f0f] text-white min-h-screen font-sans">

            <section class="relative h-[85vh] w-full">
                <div class="swiper hero-swiper h-full w-full">
                    <div class="swiper-wrapper">
                        @foreach($heroMovies as $movie)
                        <div class="swiper-slide relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-black via-black/60 to-transparent z-10"></div>
                            <img src="{{ asset('storage/' . $movie->poster_landscape) }}" class="w-full h-full object-cover">

                            <div class="absolute bottom-20 left-10 md:left-20 z-20 max-w-2xl">
                                <h1 class="text-5xl md:text-7xl font-bold mb-4 uppercase tracking-tighter">{{ $movie->title }}</h1>
                                <div class="flex items-center gap-4 mb-6 text-sm text-gray-300">
                                    <span class="bg-yellow-500 text-black px-2 py-0.5 rounded font-bold">7.6 /10</span>
                                    <span>{{ $movie->year }}</span>
                                    <span>1h 47m</span> </div>
                                <p class="text-gray-300 text-lg mb-8 line-clamp-3">
                                    {{ $movie->description }}
                                </p>
                                <div class="flex gap-4">
                                    <a href="{{ route('peliculas.show', $movie->id) }}" class="bg-white text-black px-8 py-3 rounded-md font-bold hover:bg-gray-200 transition flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                        VER AHORA
                                    </a>
                                    <button class="bg-white/20 backdrop-blur-md px-8 py-3 rounded-md font-bold hover:bg-white/30 transition">
                                        + MIS FAVORITOS
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </section>

            <section class="py-12 px-10">
                <h2 class="text-xl font-bold mb-8 uppercase tracking-widest text-gray-400">Top Películas del Día</h2>
                <div class="flex gap-6 overflow-x-auto pb-4 scrollbar-hide">
                    @foreach($topMovies as $index => $movie)
                    <div class="relative flex-none w-48 group">
                        <span class="absolute -left-6 bottom-0 text-[120px] font-black leading-none text-white/10 italic group-hover:text-white/20 transition-colors z-0">
                            {{ $index + 1 }}
                        </span>
                        <a href="{{ route('peliculas.show', $movie->id) }}" class="group block">
                            <div class="relative overflow-hidden rounded-xl aspect-[2/3] mb-3 shadow-lg border border-white/5">
                                <img src="{{ asset('storage/' . $movie->poster_portrait) }}" class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-115">
                                </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </section>

            <section class="py-12 px-10">
                <h2 class="text-xl font-bold mb-8 uppercase tracking-widest text-gray-400">Películas</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-7 gap-6">
                    @foreach($allMovies as $movie)
                    <a href="{{ route('peliculas.show', $movie->id) }}" class="group block">
                        <div class="relative overflow-hidden rounded-xl aspect-[2/3] mb-3 shadow-lg border border-white/5">
                            <img src="{{ asset('storage/' . $movie->poster_portrait) }}"
                                class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-115">

                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <div class="p-3 bg-white/20 backdrop-blur-sm rounded-full">
                                    <svg class="w-8 h-8" fill="white" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </div>
                            </div>
                        </div>
                        <h3 class="text-sm font-semibold truncate group-hover:text-yellow-500 transition-colors">
                            {{ $movie->title }}
                        </h3>
                    </a>
                    @endforeach
                </div>
            </section>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            const swiper = new Swiper('.hero-swiper', {
                loop: true,
                autoplay: { delay: 5000 },
                pagination: { el: '.swiper-pagination', clickable: true },
            });
        </script>

        <style>
            /* Ocultar barra de scroll en el Top 10 */
            .scrollbar-hide::-webkit-scrollbar { display: none; }
            .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

            /* Zoom personalizado */
            .group-hover\:scale-115:hover { transform: scale(1.15); }
        </style>
</body>
</html>
