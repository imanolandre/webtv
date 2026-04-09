<nav x-data="mainApp"
    class="fixed w-full z-50 transition-all duration-300 bg-slate-950/80 backdrop-blur-md border-b border-white/10 sticky top-0">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">

            <div class="absolute inset-y-0 left-0 flex items-center md:hidden">
                <button @click="mobileMenu = !mobileMenu" type="button"
                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-white/5 hover:text-white focus:outline-none">
                    <svg x-show="!mobileMenu" class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg x-show="mobileMenu" x-cloak class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="flex flex-1 items-center justify-center md:items-stretch md:justify-start">
                <div class="flex shrink-0 items-center">
                    <h1 class="text-2xl font-black tracking-tighter text-blue-500 italic cursor-pointer drop-shadow-lg" onclick="location.href='/'">
                        PRUEBA<span class="text-white">TV</span>
                    </h1>
                </div>

                <div class="hidden md:ml-10 md:block">
                    <div class="flex space-x-8 items-center h-full">
                        <a href="/" class="group relative py-2 text-sm font-semibold text-slate-300 hover:text-white transition-colors">
                            Inicio
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-500 transform origin-left transition-transform duration-300 {{ request()->is('/') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                        </a>
                        <a href="/tv" class="group relative py-2 text-sm font-semibold text-slate-300 hover:text-white transition-colors">
                            TV en Vivo
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-500 transform origin-left transition-transform duration-300 {{ request()->is('tv') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                        </a>
                        <a href="/peliculas" class="group relative py-2 text-sm font-semibold text-slate-300 hover:text-white transition-colors">
                            Películas
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-500 transform origin-left transition-transform duration-300 {{ request()->is('peliculas*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                        </a>
                        <a href="#" class="group relative py-2 text-sm font-semibold text-slate-300 hover:text-white transition-colors">
                            Series
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-500 transform origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100"></span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="hidden md:flex items-center justify-end gap-4 ml-auto">
                @auth
                    <div class="flex items-center gap-3 border-l border-white/10 pl-4">
                        <div class="flex flex-col items-end">
                            <span class="text-sm font-semibold text-white leading-tight">{{ auth()->user()->name }}</span>
                            <span class="text-xs text-slate-400 leading-tight">Administrador</span>
                        </div>
                        <a href="/admin" class="flex items-center justify-center w-9 h-9 rounded-full bg-blue-600/20 text-blue-500 border border-blue-500/30 font-bold hover:bg-blue-600 hover:text-white transition-all shadow-lg shadow-blue-500/20 title="Ir al Panel">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </a>
                    </div>
                @else
                    <a href="/admin/login" class="inline-flex items-center justify-center px-5 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-500 transition-all shadow-[0_0_15px_rgba(37,99,235,0.3)] hover:shadow-[0_0_20px_rgba(37,99,235,0.5)]">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Iniciar sesión
                    </a>
                @endauth
            </div>

        </div>
    </div>

    <div x-show="mobileMenu"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="md:hidden bg-slate-950 border-b border-white/10 shadow-2xl">
        <div class="space-y-1 px-4 pt-2 pb-4">
            <a href="/" class="block rounded-md px-3 py-3 text-base font-medium {{ request()->is('/') ? 'text-blue-500 bg-white/5' : 'text-slate-300' }}">Inicio</a>
            <a href="/tv" class="block rounded-md px-3 py-3 text-base font-medium {{ request()->is('tv') ? 'text-blue-500 bg-white/5' : 'text-slate-300' }}">TV en Vivo</a>
            <a href="/peliculas" class="block rounded-md px-3 py-3 text-base font-medium {{ request()->is('peliculas*') ? 'text-blue-500 bg-white/5' : 'text-slate-300' }}">Películas</a>
            <a href="#" class="block rounded-md px-3 py-3 text-base font-medium text-slate-300">Series</a>
        </div>

        <div class="border-t border-slate-800/50 p-4">
            @auth
                <div class="flex items-center gap-3 mb-4 px-2">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-600/20 text-blue-500 border border-blue-500/30 font-bold text-lg">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="text-base font-medium text-white">{{ auth()->user()->name }}</div>
                        <div class="text-sm text-slate-400">Administrador</div>
                    </div>
                </div>
                <a href="/admin" class="flex w-full items-center justify-center rounded-lg bg-white/5 px-3 py-3 text-base font-medium text-white hover:bg-white/10 transition-colors">
                    Ir al Panel
                </a>
            @else
                <a href="/admin/login" class="flex w-full items-center justify-center rounded-lg bg-blue-600 px-3 py-3 text-base font-medium text-white shadow-sm hover:bg-blue-500 transition-all">
                    Iniciar sesión
                </a>
            @endauth
        </div>
    </div>
</nav>
