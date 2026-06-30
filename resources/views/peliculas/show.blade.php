<!DOCTYPE html>
<html lang="es" class="h-full bg-[#0f1014]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUISPETV - {{ $movie->title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full text-white font-sans overflow-x-hidden selection:bg-blue-500 selection:text-white pb-20">

    @include('partials.navbar')

    <main class="w-full h-auto relative pt-20">
        <div class="relative w-full h-[60vh] md:h-[70vh]">
            <img id="detail-backdrop" src="{{ asset('storage/' . $movie->poster_landscape) }}"
                 class="w-full h-full object-cover" alt="{{ $movie->title }}">

            <div class="absolute inset-0 bg-gradient-to-t from-[#0f1014] via-[#0f1014]/40 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#0f1014] via-transparent to-transparent"></div>

            <a href="{{ route('peliculas.welcome') }}" class="absolute top-10 left-4 md:left-12 bg-black/40 p-3 rounded-full hover:bg-white hover:text-black transition backdrop-blur-md border border-white/10 z-20">
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
            </a>
        </div>

        <div class="px-6 md:px-12 max-w-7xl mx-auto -mt-40 relative z-10">
            <div class="flex flex-col md:flex-row gap-8 items-end mb-12">
                <div class="hidden md:block w-64 flex-none rounded-2xl overflow-hidden shadow-2xl border border-white/10">
                    <img src="{{ asset('storage/' . $movie->poster_portrait) }}" class="w-full h-full object-cover">
                </div>

                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="px-3 py-1 bg-yellow-500 text-black font-black rounded-md text-sm italic">ULTRA HD</span>
                        <span class="text-slate-400 font-bold">{{ $movie->year }}</span>
                        <span class="text-slate-400 font-bold">|</span>
                        <span class="text-slate-400 font-bold uppercase">{{ is_array($movie->genres) ? implode(', ', $movie->genres) : $movie->genres }}</span>
                    </div>
                    <h1 class="text-5xl md:text-7xl font-black mb-6 drop-shadow-2xl text-white uppercase tracking-tighter">
                        {{ $movie->title }}
                    </h1>
                    <p class="text-slate-300 text-lg leading-relaxed max-w-3xl font-medium line-clamp-4">
                        {{ $movie->description }}
                    </p>
                </div>
            </div>

            <div class="mt-8 rounded-3xl overflow-hidden bg-black aspect-video shadow-[0_0_80px_rgba(0,0,0,0.6)] border border-white/5 relative group">
                <iframe
                    src="{{ $movie->video_url }}"
                    class="absolute inset-0 w-full h-full"
                    frameborder="0"
                    scrolling="no"
                    allowfullscreen
                    allow="autoplay; encrypted-media; picture-in-picture"
                    referrerpolicy="no-referrer">
                </iframe>
            </div>
        </div>
    </main>

    <style>
        /* Animación suave al cargar */
        main {
            animation: fadeIn 0.8s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</body>
</html>
