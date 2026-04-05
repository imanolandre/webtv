<!DOCTYPE html>
<html lang="es" class="h-full bg-[#0a0a0a]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUISPETV - Inicio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        /* Ocultar barra de desplazamiento para los sliders horizontales */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        /* Ajustes del botón de flecha de Swiper */
        .swiper-button-next, .swiper-button-prev {
            color: #eab308 !important; /* Color amarillo/dorado */
            opacity: 0;
            transition: opacity 0.3s;
        }
        .swiper:hover .swiper-button-next,
        .swiper:hover .swiper-button-prev {
            opacity: 1;
        }
    </style>
</head>
<body class="h-full text-white font-sans overflow-x-hidden selection:bg-yellow-500 selection:text-black">

    @include('partials.navbar')

    <main class="w-full h-auto relative pb-20">

        <div class="swiper heroSwiper w-full h-[75vh] md:h-[85vh] relative group">
            <div class="swiper-wrapper">

                <div class="swiper-slide relative w-full h-full">
                    <img src="{{ asset('assets/movies/backdrops/hoppers-operacion-castor-horizontal.webp') }}" class="absolute inset-0 w-full h-full object-cover" alt="Proyecto">

                    <div class="absolute inset-0 bg-gradient-to-r from-[#0a0a0a] via-[#0a0a0a]/60 to-transparent"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-transparent to-transparent"></div>

                    <div class="absolute bottom-20 left-4 md:left-16 max-w-3xl z-10">
                        <h1 class="text-4xl md:text-6xl font-black mb-3 drop-shadow-lg tracking-tight">Proyecto Fin del Mundo</h1>
                        <div class="flex items-center gap-3 text-sm md:text-base font-medium text-gray-300 mb-4">
                            <span>2h 36m</span>
                            <span>•</span>
                            <span>2026</span>
                            <span class="bg-white/20 px-2 py-0.5 rounded text-xs">HD</span>
                        </div>
                        <p class="text-slate-300 text-base md:text-lg mb-8 line-clamp-3 md:line-clamp-4 max-w-2xl drop-shadow-md">
                            El profesor de ciencias Ryland Grace despierta en una nave espacial a años luz de su hogar sin recordar quién es ni cómo llegó allí. A medida que recupera la memoria, comienza a descubrir su misión...
                        </p>

                        <div class="flex items-center gap-4">
                            <button onclick="location.href='/peliculas/proyecto-fin-del-mundo'" class="bg-yellow-500 hover:bg-yellow-400 text-black font-bold py-3 px-8 rounded-md flex items-center gap-2 transition-transform hover:scale-105">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                Ver ahora
                            </button>
                            <button class="bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold py-3 px-6 rounded-md flex items-center gap-2 transition-colors backdrop-blur-sm">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                                Mi lista
                            </button>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide relative w-full h-full">
                    <img src="https://image.tmdb.org/t/p/original/tElnmtQ6sn9q4HLfoO6DqbVG10U.jpg" class="absolute inset-0 w-full h-full object-cover" alt="Superman">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#0a0a0a] via-[#0a0a0a]/60 to-transparent"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-transparent to-transparent"></div>
                    <div class="absolute bottom-20 left-4 md:left-16 max-w-3xl z-10">
                        <h1 class="text-4xl md:text-6xl font-black mb-3 drop-shadow-lg tracking-tight">Superman</h1>
                        <div class="flex items-center gap-3 text-sm md:text-base font-medium text-gray-300 mb-4">
                            <span class="text-yellow-500 font-bold">8.5/10</span>
                            <span>•</span>
                            <span>2025</span>
                        </div>
                        <p class="text-slate-300 text-base md:text-lg mb-8 line-clamp-3">Clark Kent intenta equilibrar su herencia kryptoniana con su educación humana en Smallville, enfrentándose a un mundo que no lo comprende.</p>
                        <div class="flex items-center gap-4">
                            <button class="bg-yellow-500 hover:bg-yellow-400 text-black font-bold py-3 px-8 rounded-md flex items-center gap-2">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg> Ver ahora
                            </button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="swiper-button-next hidden md:flex"></div>
            <div class="swiper-button-prev hidden md:flex"></div>
        </div>


        <div class="px-4 md:px-16 mt-8 relative z-20">
            <div class="flex justify-between items-end mb-4 pr-4">
                <h2 class="text-2xl md:text-3xl font-bold tracking-tight">Películas</h2>
                <a href="/peliculas" class="text-sm md:text-base text-gray-400 hover:text-yellow-500 transition-colors flex items-center gap-1 font-medium">
                    Ver mas <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>

            <div class="flex gap-4 overflow-x-auto snap-x snap-mandatory scrollbar-hide pb-6 pt-2">

                <div onclick="location.href='/peliculas/hoppers'" class="min-w-[140px] md:min-w-[200px] snap-start relative group cursor-pointer transition-all duration-300 hover:-translate-y-2">
                    <div class="rounded-xl overflow-hidden shadow-xl aspect-[2/3] relative">
                        <img src="{{ asset('assets/movies/covers/hoppers-operación-castor.webp') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Hoppers">
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <div class="bg-yellow-500 p-3 rounded-full text-black transform scale-50 group-hover:scale-100 transition-transform duration-300">
                                <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </div>
                    </div>
                    <h3 class="mt-3 text-sm md:text-base font-medium text-gray-200 truncate group-hover:text-white">Hoppers: Operación Castor</h3>
                </div>

                <div class="min-w-[140px] md:min-w-[200px] snap-start relative group cursor-pointer transition-all duration-300 hover:-translate-y-2">
                    <div class="rounded-xl overflow-hidden shadow-xl aspect-[2/3] relative bg-slate-800">
                        <img src="https://image.tmdb.org/t/p/w500/A0b8xN1yV4cK4u3Nl7kH9f5Y1A9.jpg" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Cover">
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <div class="bg-yellow-500 p-3 rounded-full text-black transform scale-50 group-hover:scale-100 transition-transform duration-300">
                                <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </div>
                    </div>
                    <h3 class="mt-3 text-sm md:text-base font-medium text-gray-200 truncate group-hover:text-white">Depredador: Tierras Salvajes</h3>
                </div>

                </div>
        </div>

        <div class="px-4 md:px-16 mt-6 relative z-20">
            <div class="flex justify-between items-end mb-4 pr-4">
                <h2 class="text-2xl md:text-3xl font-bold tracking-tight">Series</h2>
                <a href="/series" class="text-sm md:text-base text-gray-400 hover:text-yellow-500 transition-colors flex items-center gap-1 font-medium">
                    Ver mas <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>

            <div class="flex gap-4 overflow-x-auto snap-x snap-mandatory scrollbar-hide pb-6 pt-2">

                <div class="min-w-[140px] md:min-w-[200px] snap-start relative group cursor-pointer transition-all duration-300 hover:-translate-y-2">
                    <div class="rounded-xl overflow-hidden shadow-xl aspect-[2/3] relative bg-slate-800">
                        <div class="absolute top-0 right-4 bg-yellow-500 text-black text-[10px] font-black px-2 py-1 rounded-b-md z-10 shadow-lg">NUEVO</div>
                        <img src="https://image.tmdb.org/t/p/w500/wRkjIGUqaCGhwOVLlHzk8Qk1u73.jpg" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Fallout">
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <div class="bg-yellow-500 p-3 rounded-full text-black transform scale-50 group-hover:scale-100 transition-transform duration-300">
                                <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </div>
                    </div>
                    <h3 class="mt-3 text-sm md:text-base font-medium text-gray-200 truncate group-hover:text-white">Fallout</h3>
                </div>

                </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        // Inicializar el Slider Principal (Hero)
        const swiper = new Swiper('.heroSwiper', {
            loop: true,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
            },
            effect: 'fade', // Transición suave entre banners
            fadeEffect: {
                crossFade: true
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

        // Efecto Navbar transparente a sólido al hacer scroll
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (nav) {
                if (window.scrollY > 50) {
                    nav.classList.add('bg-[#0a0a0a]', 'border-b', 'border-white/5');
                    nav.classList.remove('bg-transparent', 'bg-gradient-to-b');
                } else {
                    nav.classList.remove('bg-[#0a0a0a]', 'border-b', 'border-white/5');
                    nav.classList.add('bg-transparent');
                }
            }
        });
    </script>
</body>
</html>
