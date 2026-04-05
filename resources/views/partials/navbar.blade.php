<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <nav class="fixed w-full z-50 transition-all duration-300 bg-gradient-to-b from-black/90 to-transparent p-4 md:px-12 flex justify-between items-center" id="navbar">
        <div class="flex items-center gap-10">
            <h1 class="text-3xl font-black tracking-tighter text-blue-500 italic cursor-pointer drop-shadow-lg" onclick="location.href='/'">
                PRUEBA<span class="text-white">TV</span>
            </h1>
            <div class="hidden md:flex gap-6 text-sm font-semibold text-slate-300">
                <a href="/" class="hover:text-white transition">Inicio</a>
                <a href="/tv" class="hover:text-white transition">TV en Vivo</a>
                <a href="/peliculas" class="hover:text-white transition">Películas</a>
                <a href="#" class="hover:text-white transition">Series</a>
            </div>
        </div>
    </nav>
</body>
</html>
