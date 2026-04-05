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

        <div class="relative w-full h-[80vh] flex items-center mb-10">
            <div class="absolute inset-0">
                <img src="{{ asset('assets/movies/backdrops/hoppers-operación-castor-horizontal.webp') }}" alt="Hoppers backdrop" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-[#0f1014] via-[#0f1014]/60 to-transparent"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-[#0f1014] via-transparent to-transparent"></div>
            </div>

            <div class="relative z-10 px-4 md:px-12 max-w-3xl mt-20">
                <h2 class="text-5xl md:text-7xl font-black mb-4 tracking-tight drop-shadow-xl text-white">HOPPERS</h2>

                <div class="flex gap-4 text-sm font-bold mb-6 text-slate-300 items-center">
                    <span class="text-green-500">98% para ti</span>
                    <span>2024</span>
                    <span class="border border-slate-500 px-2 py-0.5 rounded text-xs">13+</span>
                    <span>1h 45m</span>
                    <span class="bg-white/20 px-2 py-0.5 rounded text-xs">4K HDR</span>
                </div>

                <p class="text-slate-200 text-lg mb-8 line-clamp-3 drop-shadow-md font-medium">
                    (Aquí va la descripción de la película). Clark Kent intenta equilibrar su herencia kryptoniana...
                </p>

                <div class="flex gap-4">
                    <a href="/peliculas/hoppers-operacion-castor" class="bg-white text-black px-8 py-3 rounded-lg font-bold text-lg hover:bg-white/80 transition flex items-center gap-2 hover:scale-105">
                        <svg class="w-7 h-7 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        Ver Ahora
                    </button>
                    <button class="bg-slate-500/40 text-white px-8 py-3 rounded-lg font-bold text-lg hover:bg-slate-500/60 transition backdrop-blur-md flex items-center gap-2 hover:scale-105">
                        <svg class="w-7 h-7 fill-current" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                        Más Info
                    </button>
                </div>
            </div>
        </div>

        <div class="px-4 md:px-12">
            <h3 class="text-xl md:text-2xl font-bold mb-4 text-slate-100">Catálogo de Películas</h3>
            <div class="flex gap-4 overflow-x-auto pb-8 pt-4">

                <div class="min-w-[140px] md:min-w-[200px] cursor-pointer hover:scale-110 transition-all duration-300 rounded-xl overflow-hidden shadow-2xl border border-white/5"
                     onclick="location.href='/peliculas/hoppers-operacion-castor'">
                    <img src="{{ asset('assets/movies/covers/hoppers-operación-castor.webp') }}"
                         class="w-full h-[210px] md:h-[300px] object-cover" alt="Hoppers poster">
                </div>

            </div>
        </div>

    </main>

    <script>
        //Efecto Navbar... (puedes reutilizar el script del welcome)
    </script>
</body>
</html>
