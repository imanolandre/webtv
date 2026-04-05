<!DOCTYPE html>
<html lang="es" class="h-full bg-slate-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRUEBA TV LAB - Andre</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.8.4/plyr.css" />
    <script src="https://cdn.plyr.io/3.8.4/plyr.js"></script>
</head>
<body class="h-full text-slate-200 font-sans">
@include('partials.navbar') <main class="w-full h-auto relative pt-20"></main>
    <div class="max-w-6xl mx-auto p-4 md:p-8">
        <header class="mb-8 flex justify-between items-center border-b border-slate-800 pb-4">
            <a href="/" class="text-2xl font-black tracking-tighter text-blue-500 italic">PRUEBA<span class="text-white">TV</span></a>
            <div class="flex items-center gap-2">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                </span>
                <span class="text-[10px] font-mono text-slate-500 uppercase tracking-widest">Server Online</span>
            </div>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <div class="lg:col-span-3">
                <div class="rounded-3xl overflow-hidden shadow-2xl border border-white/5 bg-black">
                    <div class="plyr__video-embed" id="player-container">
                        <video id="player" style="--plyr-color-main: #551ac2;" crossorigin playsinline>
                            <track kind="captions" label="Español" srclang="es" src="{{ asset('assets/captions.vtt') }}" default />
                        </video>
                    </div>
                </div>

                <div class="mt-4 flex items-center justify-between">
                    <h2 id="channel-title" class="text-xl font-bold tracking-tight text-slate-300">Selecciona una señal</h2>
                    <span class="text-[10px] bg-red-600/20 text-red-500 px-2 py-1 rounded font-black">PLYR PRO ENGINE</span>
                </div>
            </div>

            <div class="space-y-4">
                <h3 class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em]">Señales Disponibles</h3>

                <div class="grid grid-cols-1 gap-3">
                    <button onclick="changeChannel('TV Perú HD', 'https://cdnhd.iblups.com/hls/777b4d4cc0984575a7d14f6ee57dbcaf7.m3u8')"
                            class="flex items-center gap-4 p-4 rounded-2xl bg-slate-900/50 border border-slate-800 hover:border-blue-500/50 hover:bg-slate-800 transition-all group text-left">
                        <div class="w-12 h-12 bg-red-600/10 rounded-xl flex items-center justify-center font-black text-red-500 group-hover:scale-110 transition-transform">TV</div>
                        <div>
                            <span class="block font-bold text-sm">TV Perú</span>
                            <span class="text-[10px] text-slate-500 font-medium italic uppercase">Nacional</span>
                        </div>
                    </button>
                    <button onclick="changeChannel('America HD', 'https://pe-p1-p-e-xm11.cdn.mdstrm.com/live-stream-secure/6099b04d9418ac082441dd74/publish/media_2500.m3u8?aid=5b8ea6f89ff52d0770a144c4&uid=EWpu89AxiuZXl1zRQkDAbK52xNd3iz7F&sid=TMHyxEtF1ZpaxRYqphueE1cMgBGfRaWT&pid=XJwQeddTdcXSBGF71lctlou0gcxtt552&pid_dvr=rhfb0d8jp3zNYrXHSu078MrSaFgaARWk&ref=https%3A%2F%2Ftvgo.americatv.com.pe%2F&without_cookies=false&listenerid=&dnt=true&access_token=3DOP4PEV1sk7ZmeLo1PbbLNU8ljMTgIlMC5BH6pAA8b8ovoptmObHS14tPUTb6fMuErzBxx8wdr&es=pe-p1-p-e-xm11.cdn.mdstrm.com&ote=1774906844994&ot=TD5VqkWcS6qJQenYi3b3Gg&proto=https&pz=us&CMCD=cid%3D%226099b04d9418ac082441dd74%22%2Cmtp%3D172600%2Cot%3Dm%2Csf%3Dh%2Csid%3D%22XJwQeddTdcXSBGF71lctlou0gcxtt552%22')"
                            class="flex items-center gap-4 p-4 rounded-2xl bg-slate-900/50 border border-slate-800 hover:border-blue-500/50 hover:bg-slate-800 transition-all group text-left">
                        <div class="w-12 h-12 bg-orange-600/10 rounded-xl flex items-center justify-center font-black text-orange-500 group-hover:scale-110 transition-transform">A</div>
                        <div>
                            <span class="block font-bold text-sm">America</span>
                            <span class="text-[10px] text-slate-500 font-medium italic uppercase">Nacional</span>
                        </div>
                    </button>
                    <button onclick="changeChannel('Latina HD', 'https://jireh-5-hls-video-us-isp.dps.live/hls-video/567ffde3fa319fadf3419efda25619456231dfea/latina/latina.smil/latina/livestream2/chunks.m3u8?dpssid=b2110077021369c84caf88be4&sid=ba5t1l1xb297962774569c84d20e8887&ndvc=0')"
                            class="flex items-center gap-4 p-4 rounded-2xl bg-slate-900/50 border border-slate-800 hover:border-blue-500/50 hover:bg-slate-800 transition-all group text-left">
                        <div class="w-12 h-12 bg-green-600/10 rounded-xl flex items-center justify-center font-black text-green-500 group-hover:scale-110 transition-transform">L</div>
                        <div>
                            <span class="block font-bold text-sm">Latina</span>
                            <span class="text-[10px] text-slate-500 font-medium italic uppercase">Nacional</span>
                        </div>
                    </button>
                    <button onclick="changeChannel('Unitel HD', 'https://play.agenciastreaming.com:8081/uniteltv/index.m3u8')"
                            class="flex items-center gap-4 p-4 rounded-2xl bg-slate-900/50 border border-slate-800 hover:border-blue-500/50 hover:bg-slate-800 transition-all group text-left">
                        <div class="w-12 h-12 bg-blue-600/10 rounded-xl flex items-center justify-center font-black text-blue-500 group-hover:scale-110 transition-transform">U</div>
                        <div>
                            <span class="block font-bold text-sm">Unitel</span>
                            <span class="text-[10px] text-slate-500 font-medium italic uppercase">Nacional</span>
                        </div>
                    </button>
                    <button onclick="changeChannel('ATV HD', 'https://d2qsan2ut81n2k.cloudfront.net/live/25046411-8673-4dec-8ae8-5b41984f34e1/medialist_15609871089997455276_hls.m3u8')"
                            class="flex items-center gap-4 p-4 rounded-2xl bg-slate-900/50 border border-slate-800 hover:border-blue-500/50 hover:bg-slate-800 transition-all group text-left">
                        <div class="w-12 h-12 bg-blue-600/10 rounded-xl flex items-center justify-center font-black text-blue-500 group-hover:scale-110 transition-transform">ATV</div>
                        <div>
                            <span class="block font-bold text-sm">ATV</span>
                            <span class="text-[10px] text-slate-500 font-medium italic uppercase">Nacional</span>
                        </div>
                    </button>
                    <button onclick="changeChannel('Willax HD', 'https://live2.eu-north-1b.cf.dmcdn.net/sec2(izHeCHgEQt_BD7NXxg4oAZug7tUmDES6sr9gYxIiaGc56s38-S5gPEeVQbz9W4M4cQK5nIXP9da0vNaQ48vbCjePCfZfZ5j60imtSgbZdjQ3qOA7ZzSskguaRVlantGx)/cloud/3/x9s3ad6/s/live-1080.m3u8')"
                            class="flex items-center gap-4 p-4 rounded-2xl bg-slate-900/50 border border-slate-800 hover:border-blue-500/50 hover:bg-slate-800 transition-all group text-left">
                        <div class="w-12 h-12 bg-red-600/10 rounded-xl flex items-center justify-center font-black text-red-500 group-hover:scale-110 transition-transform">W</div>
                        <div>
                            <span class="block font-bold text-sm">Willax</span>
                            <span class="text-[10px] text-slate-500 font-medium italic uppercase">Nacional</span>
                        </div>
                    </button>
                    <button onclick="changeChannel('CadenaTV HD', 'https://tv.bitstreaming.net:3789/live/cdntvlive.m3u8')"
                            class="flex items-center gap-4 p-4 rounded-2xl bg-slate-900/50 border border-slate-800 hover:border-blue-500/50 hover:bg-slate-800 transition-all group text-left">
                        <div class="w-12 h-12 bg-cyan-600/10 rounded-xl flex items-center justify-center font-black text-cyan-500 group-hover:scale-110 transition-transform">CT</div>
                        <div>
                            <span class="block font-bold text-sm">CadenaTV</span>
                            <span class="text-[10px] text-slate-500 font-medium italic uppercase">Nacional</span>
                        </div>
                    </button>
                    <button onclick="changeChannel('Panamericana TV', 'https://cdnhd.iblups.com/hls/b4cc747e23fe4f2ea3ff35c8a07dc9b0.m3u8')"
                        class="flex items-center gap-4 p-4 rounded-2xl bg-slate-900/50 border border-slate-800 hover:border-blue-500/50 hover:bg-slate-800 transition-all group text-left">
                    <div class="w-12 h-12 bg-yellow-600/10 rounded-xl flex items-center justify-center font-black text-yellow-500 group-hover:scale-110 transition-transform">P</div>
                    <div>
                        <span class="block font-bold text-sm">Panamericana</span>
                        <span class="text-[10px] text-slate-500 font-medium italic uppercase">Nacional</span>
                    </div>
                </button>
                    <button onclick="changeChannel('Señal de Prueba', 'https://test-streams.mux.dev/x36xhzz/x36xhzz.m3u8')"
                            class="flex items-center gap-4 p-4 rounded-2xl bg-slate-900/50 border border-slate-800 hover:border-blue-500/50 hover:bg-slate-800 transition-all group text-left">
                        <div class="w-12 h-12 bg-blue-600/10 rounded-xl flex items-center justify-center font-black text-blue-500 group-hover:scale-110 transition-transform">P</div>
                        <div>
                            <span class="block font-bold text-sm">Prueba Mux</span>
                            <span class="text-[10px] text-slate-500 font-medium italic uppercase">Global Test</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>

   <script>
        const video = document.getElementById('player');
        const title = document.getElementById('channel-title');

        // 1. Inicializar Plyr con TODAS las opciones de la imagen 1
        const player = new Plyr(video, {
            controls: [
                'play-large',   // Botón de play central grande
                'play',
                //'progress',      // Barra de progreso con previsualización
                'current-time',
                'duration',

                'mute',
                'volume',
                'captions',      // Botón CC de subtítulos
                'settings',      // Tuerca de configuración (Calidad, Velocidad)
                'pip',           // Picture-in-Picture
                'airplay',
                 'playing',
                'fullscreen',
            ],
            settings: ['quality', 'speed', 'captions'], // Opciones dentro de la tuerca
            tooltips: { controls: true, seek: true },
            invertTime: false,
            displayDuration: true,

            // CONFIGURACIÓN DE VISTA PREVIA (Para la miniatura al pasar el mouse)
            // NOTA: Esto requiere que tengas un archivo de "sprites" o miniaturas cargado.
            // Plyr no las genera automáticamente de un stream HLS.
            // Es una característica más avanzada de backend.
            previewThumbnails: {
                enabled: true,
                // Usamos Laravel assets() para las rutas correctas
                src: "{{ asset('assets/thumbnails.vtt') }}"
            },

            quality: { default: 1080, options: [1080, 720, 480] }
        });

        let hls = null;

        function changeChannel(name, m3u8Url) {
            title.innerText = name;

            if (hls) hls.destroy();

            // Usamos tu proxy de Laravel
            const proxyUrl = `/stream-proxy?url=${encodeURIComponent(m3u8Url)}`;

            if (Hls.isSupported()) {
                hls = new Hls();
                hls.loadSource(proxyUrl);
                hls.attachMedia(video);

                hls.on(Hls.Events.MANIFEST_PARSED, (event, data) => {
                    // Actualizar las opciones de calidad en Plyr dinámicamente basadas en el HLS
                    const availableQualities = data.levels.map(l => l.height).filter(h => h > 0); // Filtrar resoluciones válidas

                    player.config.quality = {
                        default: availableQualities[availableQualities.length - 1], // Iniciar en máx calidad
                        options: availableQualities,
                        // Forzar el cambio de calidad en HLS cuando el usuario elige en Plyr
                        onChange: (newQuality) => {
                            data.levels.forEach((level, levelIndex) => {
                                if (level.height === newQuality) {
                                    hls.currentLevel = levelIndex;
                                }
                            });
                        }
                    };

                    // Opcional: Auto-play al cargar el canal
                    video.play();

                    // Forzar el inicio en máxima calidad
                    hls.currentLevel = data.levels.length - 1;
                });

                // Manejo de errores HLS
                hls.on(Hls.Events.ERROR, (event, data) => {
                    if (data.fatal) {
                        console.error("Fatal HLS error:", data.type);
                        title.innerText = "Error de señal";
                    }
                });

            } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
                // Soporte nativo para Safari (Mac/iOS)
                video.src = proxyUrl;
            }
        }
    </script>
</body>
</html>
