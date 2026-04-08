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
@include('partials.navbar')
<main class="w-full h-auto relative pt-20">
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
                    @foreach($channels as $channel)
                        <button onclick="changeChannel('{{ $channel->name }}', '{{ $channel->stream_url }}')"
                                class="flex items-center gap-4 p-4 rounded-2xl bg-slate-900/50 border border-slate-800 hover:border-blue-500/50 hover:bg-slate-800 transition-all group text-left">

                            <div class="w-12 h-12 rounded-xl flex items-center justify-center font-black overflow-hidden bg-slate-800/50 group-hover:scale-110 transition-transform">
                                @if($channel->logo)
                                    <img src="{{ Storage::url($channel->logo) }}" alt="{{ $channel->name }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-blue-500">{{ strtoupper(substr($channel->name, 0, 2)) }}</span>
                                @endif
                            </div>

                            <div>
                                <span class="block font-bold text-sm">{{ $channel->name }}</span>
                                <span class="text-[10px] text-slate-500 font-medium italic uppercase">{{ $channel->type }}</span>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    const video = document.getElementById('player');
    const title = document.getElementById('channel-title');

    const player = new Plyr(video, {
        controls: ['play-large', 'play', 'current-time', 'duration', 'mute', 'volume', 'captions', 'settings', 'pip', 'airplay', 'fullscreen'],
        settings: ['quality', 'speed', 'captions'],
        tooltips: { controls: true, seek: true },
        quality: { default: 1080, options: [1080, 720, 480] }
    });

    let hls = null;

    function changeChannel(name, m3u8Url) {
        title.innerText = name;
        if (hls) hls.destroy();
        const proxyUrl = `/stream-proxy?url=${encodeURIComponent(m3u8Url)}`;

        if (Hls.isSupported()) {
            hls = new Hls();
            hls.loadSource(proxyUrl);
            hls.attachMedia(video);
            hls.on(Hls.Events.MANIFEST_PARSED, (event, data) => {
                video.play();
            });
        } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
            video.src = proxyUrl;
        }
    }
</script>
</body>
</html>
