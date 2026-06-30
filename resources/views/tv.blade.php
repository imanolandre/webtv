<!DOCTYPE html>
<html lang="es" class="h-full bg-slate-950 overflow-hidden">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRUEBA TV LAB - Andre</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.8.4/plyr.css" />
    <script src="https://cdn.plyr.io/3.8.4/plyr.js"></script>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.5); /* slate-900 */
            border-radius: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(51, 65, 85, 0.8); /* slate-700 */
            border-radius: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(71, 85, 105, 1); /* slate-600 */
        }
        /* 1. Botón de Play central (gigante) transparente */
        .plyr__control--overlaid {
            background: transparent !important;
        }

        /* Pequeño efecto de zoom al pasar el mouse para compensar la falta de fondo */
        .plyr__control--overlaid:hover {
            background: #ffffff44 !important;
        }

        /* 2. Barra de volumen de color blanco */
        .plyr__volume input[type="range"] {
            --plyr-color-main: #ffffff !important;
        }
        /* 3. Forzar tamaño completo del reproductor en todo momento */
        .plyr {
            width: 100% !important;
            height: 100% !important;
        }
        .plyr__video-wrapper {
            width: 100% !important;
            height: 100% !important;
            background: #000000; /* Fondo negro mientras carga */
        }
        .plyr video {
            object-fit: contain; /* Asegura que el video mantenga su proporción 16:9 sin deformarse */
        }
    </style>
</head>

<body class="h-screen text-slate-200 font-sans flex flex-col overflow-hidden bg-slate-950">
    @include('partials.navbar')

    <main class="w-full flex-1 min-h-0 p-4 md:p-6 lg:px-8 flex flex-col">

        <div class="grid grid-cols-1 xl:grid-cols-12  min-h-0">

            <div class="xl:col-span-9 flex flex-col min-w-0">

                <div class="w-full aspect-video lg:flex-1 overflow-hidden shadow-2xl relative flex items-center justify-center rounded-xl bg-black">

                    <div id="player-placeholder" class="absolute inset-0 flex flex-col items-center justify-center text-slate-500 z-20 bg-slate-900/50 backdrop-blur-sm transition-opacity duration-500">
                        <svg class="w-12 h-12 md:w-20 md:h-20 mb-2 md:mb-4 opacity-40 text-blue-500 2xl:scale-150" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        <h3 class="text-lg md:text-xl font-medium 2xl:scale-150 text-slate-300">Pantalla en espera</h3>
                        <p class="text-xs md:text-sm mt-1 2xl:scale-150 md:mt-2 opacity-70">Selecciona un canal</p>
                    </div>

                    <div id="player-container" class="absolute inset-0 hidden z-10 w-full h-full">
                        <div id="native-player-wrapper" class=" w-full h-full">
                            <video id="player" crossorigin playsinline>
                                <track kind="captions" label="Español" srclang="es" src="{{ asset('assets/captions.vtt') }}" default />
                            </video>
                        </div>
                        <iframe
                            id="iframe-player"
                            class="absolute top-0 left-0 w-full h-full hidden bg-black rounded-xl"
                            frameborder="0"
                            allow="autoplay; encrypted-media; clipboard-write"
                            allowfullscreen="true"
                            webkitallowfullscreen="true"
                            mozallowfullscreen="true">
                        </iframe>
                    </div>

                </div>
            </div>

            <div class="xl:col-span-3  flex flex-col min-h-0 bg-slate-900/20 border border-slate-800/50 rounded-xl p-3 ">

                <h3 class="text-[10px] 2xl:text-xl font-bold text-slate-500 uppercase tracking-[0.2em] mb-3 shrink-0 flex items-center justify-between ">
                    <span>Señales Disponibles</span>
                    <span class="bg-blue-500/20 p-2 text-white px-2 py-0.5 rounded text-[8px] 2xl:text-[16px]">{{ count($channels) }}</span>
                </h3>

                <div class="flex-1 overflow-y-auto pr-2 space-y-2 custom-scrollbar ">
                    @foreach($channels as $channel)
                        <button onclick="changeChannel('{{ $channel->name }}', '{{ $channel->stream_url }}')"
                                data-stream="{{ $channel->stream_url }}"
                                class="channel-btn w-full flex items-center gap-3 md:gap-4 p-2 md:p-3 2xl:p-5 rounded-2xl bg-slate-900/60 border border-slate-800 hover:border-blue-500/50 hover:bg-slate-800 transition-all group text-left">
                            <div class="2xl:w-16 2xl:h-16 w-10 h-10 md:w-12 md:h-12 rounded-xl flex items-center justify-center font-black overflow-hidden bg-black shadow-md group-hover:scale-105 transition-transform shrink-0">
                                @if($channel->logo)
                                    <img src="{{ Storage::url($channel->logo) }}" alt="{{ $channel->name }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-blue-500">{{ strtoupper(substr($channel->name, 0, 2)) }}</span>
                                @endif
                            </div>

                            <div class="overflow-hidden">
                                <span class="block font-bold text-sm 2xl:text-xl truncate text-slate-300 group-hover:text-white transition-colors">{{ $channel->name }}</span>
                                <span class="text-[10px] 2xl:text-[15px] text-slate-500 font-medium italic uppercase flex items-center gap-1 mt-0.5">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $channel->type === 'Nacional' ? 'bg-green-500' : 'bg-orange-500' }}"></span>
                                    {{ $channel->type }}
                                </span>
                            </div>
                        </button>
                    @endforeach
                </div>

            </div>
        </div>
    </main>

<script>
    const video = document.getElementById('player');
    const iframe = document.getElementById('iframe-player');
    const nativeWrapper = document.getElementById('native-player-wrapper');
    // Elementos del Empty State
    const playerPlaceholder = document.getElementById('player-placeholder');
    const playerContainer = document.getElementById('player-container');

    const player = new Plyr(video, {
        controls: ['play-large', 'play', 'mute', 'volume', 'settings', 'pip', 'airplay', 'fullscreen'],
        settings: ['quality', 'speed', 'captions'],
        tooltips: { controls: true, seek: true },
        quality: { default: 1080, options: [1080, 720, 480] }
    });

    let hls = null;
    let currentStreamUrl = null; // Variable para recordar qué canal está activo

    function changeChannel(name, streamUrl) {
        // --- LÓGICA DE DOBLE CLIC (MISMO CANAL) ---
        if (currentStreamUrl === streamUrl) {
            if (iframe.style.display === 'block') {
                if (iframe.requestFullscreen) { iframe.requestFullscreen(); }
                else if (iframe.webkitRequestFullscreen) { iframe.webkitRequestFullscreen(); }
                else if (iframe.mozRequestFullScreen) { iframe.mozRequestFullScreen(); }
            } else {
                player.fullscreen.enter();
            }
            return;
        }

        currentStreamUrl = streamUrl;

        // --- NUEVA LÓGICA DE RESALTADO PERMANENTE ---
        document.querySelectorAll('.channel-btn').forEach(btn => {
            if (btn.getAttribute('data-stream') === streamUrl) {
                // Estado ACTIVO (Brillante y azul)
                btn.classList.add('bg-slate-800', 'border-blue-500', 'ring-1', 'ring-blue-500/50');
                btn.classList.remove('bg-slate-900/60', 'border-slate-800');
            } else {
                // Estado INACTIVO (Apagado)
                btn.classList.remove('bg-slate-800', 'border-blue-500', 'ring-1', 'ring-blue-500/50');
                btn.classList.add('bg-slate-900/60', 'border-slate-800');
            }
        });
        // -------------------------------------------

        // 1. Ocultar el estado vacío y mostrar los reproductores
        playerPlaceholder.style.opacity = '0';
        setTimeout(() => {
            playerPlaceholder.style.display = 'none';
            playerContainer.classList.remove('hidden');
        }, 300); // Pequeña transición suave

        // Limpiar el reproductor HLS nativo si estaba activo
        if (hls) {
            hls.destroy();
            hls = null;
        }

        video.pause();

        const isIframe = streamUrl.includes('iblups.com') || !streamUrl.includes('.m3u8');

        if (isIframe) {
            nativeWrapper.style.display = 'none';
            iframe.style.display = 'block';
            iframe.src = streamUrl;
        } else {
            // MODO NATIVO HLS
            iframe.style.display = 'none';
            iframe.src = '';
            nativeWrapper.style.display = 'block';

            const proxyUrl = `/stream-proxy?url=${encodeURIComponent(streamUrl)}`;

            if (Hls.isSupported()) {
                hls = new Hls({
                    liveSyncDurationCount: 3,
                    enableWorker: true,
                    lowLatencyMode: true
                });

                hls.loadSource(proxyUrl);
                hls.attachMedia(video);

                hls.on(Hls.Events.MANIFEST_PARSED, () => {
                    video.play().catch(() => console.log("Autoplay bloqueado"));
                });

                hls.on(Hls.Events.ERROR, function (event, data) {
                    if (data.fatal && data.type === Hls.ErrorTypes.NETWORK_ERROR) {
                        hls.startLoad();
                    }
                });
            } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
                video.src = proxyUrl;
                video.addEventListener('loadedmetadata', () => video.play());
            }
        }
    }
</script>
</body>
</html>
