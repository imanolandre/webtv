<!DOCTYPE html>

<html lang="es" class="h-full bg-[#0f1014]">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>QUISPETV - Detalle Película</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])



    <link rel="stylesheet" href="https://cdn.plyr.io/3.8.4/plyr.css" />

    <script src="https://cdn.plyr.io/3.8.4/plyr.js"></script>

</head>

<body class="h-full text-white font-sans overflow-x-hidden selection:bg-blue-500 selection:text-white pb-20">



    @include('partials.navbar') <main class="w-full h-auto relative pt-20">



        <div class="relative w-full h-[55vh]">

            <img id="detail-backdrop" src="{{ asset('assets/movies/backdrops/hoppers-operación-castor-horizontal.webp') }}" class="w-full h-full object-cover" alt="Backdrop">

            <div class="absolute inset-0 bg-gradient-to-t from-[#0f1014] via-[#0f1014]/80 to-transparent"></div>



            <button onclick="location.href='/peliculas'" class="absolute top-24 left-4 md:left-12 bg-black/40 p-3 rounded-full hover:bg-white hover:text-black transition backdrop-blur-md border border-white/10">

                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>

            </button>

        </div>



        <div class="px-4 md:px-12 max-w-6xl mx-auto -mt-24 relative z-10">

            <h1 id="detail-title" class="text-4xl md:text-6xl font-black mb-6 drop-shadow-lg text-white">Hoppers: Operación Castor</h1>



            <p id="detail-description" class="text-slate-300 text-lg leading-relaxed mb-12 font-medium">

                (Aquí va la descripción de la película). Clark Kent intenta equilibrar su herencia kryptoniana con su educación humana en Smallville...

            </p>



            <div id="media-player-container" class="mt-8 rounded-2xl overflow-hidden bg-black aspect-video shadow-[0_0_50px_rgba(0,0,0,0.8)] relative">

                <video id="player" controls playsinline>

                    <source id="video-source" src="https://pub-6336b00c4d014ae4bd3170adebc52ec4.r2.dev/SoloLevelingcap1.mp4" type="video/mp4">

                    <track id="video-subtitles" kind="captions" label="Español Latino" srclang="es" src="{{ asset('assets/movies/subs/hoppers.vtt') }}" default>

                    Tu navegador no soporta el reproductor.

                </video>

            </div>

        </div>



    </main>



    <script>

        // Inicializar Plyr con la configuración de TV (pero para video local)

        const player = new Plyr('#player', {

            controls: [

                'play-large',

                'play',

                'progress', // En películas, sí queremos progreso

                'current-time',

                'duration',

                'mute',

                'volume',

                'captions', // Botón CC para subtítulos

                'settings',

                'pip',

                'fullscreen',

            ],

            settings: ['quality', 'speed', 'captions'],

            quality: { default: 1080, options: [1080, 720, 480] }

        });



        //Efecto Navbar... (puedes reutilizar el script del welcome)

    </script>

</body>

</html>
