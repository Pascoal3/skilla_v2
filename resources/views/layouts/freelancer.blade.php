{{-- resources/views/layouts/freelancer.blade.php --}}
<!DOCTYPE html>
<html class="dark" lang="pt-AO">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="user-id" content="{{ auth()->id() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Skilla - @yield('title', 'Painel do Freelancer')</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@400;500;600;700;900&display=swap" rel="stylesheet">

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "error-container": "#93000a",
                        "on-secondary-container": "#556d00",
                        "on-tertiary-container": "#757575",
                        "inverse-surface": "#e2e2e2",
                        "on-secondary-fixed-variant": "#3c4d00",
                        "on-tertiary": "#303030",
                        "on-primary-fixed-variant": "#474747",
                        "on-primary-fixed": "#1b1b1b",
                        "outline": "#988e90",
                        "tertiary-fixed": "#e2e2e2",
                        "primary": "#c6c6c6",
                        "on-error": "#690005",
                        "surface-container-highest": "#353535",
                        "secondary-fixed-dim": "#abd600",
                        "background": "#131313",
                        "on-secondary-fixed": "#161e00",
                        "surface-bright": "#393939",
                        "surface-container": "#1f1f1f",
                        "primary-container": "#000000",
                        "surface-container-lowest": "#0e0e0e",
                        "surface-tint": "#c6c6c6",
                        "inverse-primary": "#5e5e5e",
                        "surface-variant": "#353535",
                        "secondary": "#ffffff",
                        "on-primary": "#303030",
                        "on-surface": "#e2e2e2",
                        "on-surface-variant": "#cfc4c5",
                        "surface-container-high": "#2a2a2a",
                        "on-primary-container": "#757575",
                        "surface-dim": "#131313",
                        "primary-fixed-dim": "#c6c6c6",
                        "on-secondary": "#283500",
                        "on-error-container": "#ffdad6",
                        "secondary-fixed": "#c3f400",
                        "primary-fixed": "#e2e2e2",
                        "tertiary-container": "#000000",
                        "on-background": "#e2e2e2",
                        "surface-container-low": "#1b1b1b",
                        "inverse-on-surface": "#303030",
                        "secondary-container": "#c3f400",
                        "tertiary": "#c6c6c6",
                        "on-tertiary-fixed-variant": "#474747",
                        "surface": "#131313",
                        "on-tertiary-fixed": "#1b1b1b",
                        "outline-variant": "#4c4546",
                        "error": "#ffb4ab",
                        "tertiary-fixed-dim": "#c6c6c6",
                        "brand-lime": "#CCFF00",
                        "brand-orange": "#FF7A1A",
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "2xl": "1.5rem",
                        "full": "9999px"
                    },
                    spacing: {
                        "container-padding-mobile": "16px",
                        "gutter": "24px",
                        "base": "8px",
                        "container-padding-desktop": "32px",
                        "sidebar-width": "280px"
                    },
                    fontFamily: {
                        "headline-sm": ["Space Grotesk"],
                        "body-lg": ["Inter"],
                        "display-lg": ["Space Grotesk"],
                        "label-sm": ["Space Grotesk"],
                        "headline-md": ["Space Grotesk"],
                        "body-md": ["Inter"],
                        "label-md": ["Space Grotesk"]
                    },
                    fontSize: {
                        "headline-sm": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "display-lg": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "label-sm": ["12px", { "lineHeight": "16px", "fontWeight": "500" }],
                        "headline-md": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "label-md": ["14px", { "lineHeight": "20px", "letterSpacing": "0.05em", "fontWeight": "500" }]
                    }
                }
            }
        }
    </script>

    <style>
        body { background-color: #CCFF00; }
        .glass-card { background: #FFFFFF; border-radius: 24px; }
        .hard-shadow { box-shadow: 8px 8px 0px rgba(0,0,0,0.1); }
        .nav-active {
            background-color: #CCFF00;
            color: #000000;
            border-radius: 0.5rem;
            font-weight: 700;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            transition: all 0.2s;
            border-radius: 0.5rem;
            color: #757575;
        }
        .nav-item:hover:not(.nav-active) {
            background-color: #1a1a1a;
            color: #ffffff;
        }
        /* Scrollbar customizada */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 3px; }
        /* Range slider */
        input[type="range"] { -webkit-appearance: none; width: 100%; background: transparent; }
        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            height: 18px; width: 18px;
            border-radius: 50%;
            background: #CCFF00;
            cursor: pointer;
            margin-top: -7px;
            border: 2px solid #000;
        }
        input[type="range"]::-webkit-slider-runnable-track {
            width: 100%; height: 4px;
            cursor: pointer;
            background: #e5e7eb;
            border-radius: 2px;
        }
        /* Line clamp */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    @stack('styles')
</head>
<body class="font-body-md text-body-md min-h-screen flex overflow-x-hidden">

    {{-- ========== SIDEBAR ========== --}}
    <nav class="hidden md:flex fixed left-0 top-0 h-full w-[280px] flex-col p-6 bg-primary-container z-50 overflow-y-auto">
        {{-- Logo --}}
        <div class="mb-10 flex items-center gap-3">
            <span class="material-symbols-outlined text-secondary-container text-4xl"
                  style="font-variation-settings: 'FILL' 1;">widgets</span>
            <div>
                <h1 class="font-display-lg text-headline-sm font-black text-white m-0 leading-none">SKILLA</h1>
                <p class="font-label-sm text-label-sm text-on-primary-container mt-0.5">Freelancer Hub</p>
            </div>
        </div>

        {{-- Nav Links --}}
        <div class="flex-1 flex flex-col gap-1">
            <a href="{{ route('freelancer.dashboard') }}"
               class="nav-item {{ request()->routeIs('freelancer.dashboard') ? 'nav-active' : '' }}">
                <span class="material-symbols-outlined">home</span>
                <span class="font-label-md text-label-md">Início</span>
            </a>
            <a href="{{ route('freelancer.jobs.index') }}"
               class="nav-item {{ request()->routeIs('freelancer.jobs.*') ? 'nav-active' : '' }}">
                <span class="material-symbols-outlined">work</span>
                <span class="font-label-md text-label-md">Jobs</span>
            </a>
            <a href="{{ route('freelancer.proposals.index') }}"
               class="nav-item {{ request()->routeIs('freelancer.proposals.*') ? 'nav-active' : '' }}">
                <span class="material-symbols-outlined">description</span>
                <span class="font-label-md text-label-md">Propostas</span>
            </a>
            <a href="{{ route('freelancer.messages.index') }}"
               class="nav-item {{ request()->routeIs('freelancer.messages.*') ? 'nav-active' : '' }}">
                <span class="material-symbols-outlined">chat</span>
                <span class="font-label-md text-label-md">Mensagens</span>
                @if(auth()->user()->unread_messages_count > 0)
                    <span class="ml-auto bg-red-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">
                        {{ auth()->user()->unread_messages_count }}
                    </span>
                @endif
            </a>
            <a href="{{ route('freelancer.wallet.index') }}"
               class="nav-item {{ request()->routeIs('freelancer.wallet.*') ? 'nav-active' : '' }}">
                <span class="material-symbols-outlined">account_balance_wallet</span>
                <span class="font-label-md text-label-md">Carteira</span>
            </a>
            <a href="{{ route('freelancer.profile.index') }}"
               class="nav-item {{ request()->routeIs('freelancer.profile.*') ? 'nav-active' : '' }}">
                <span class="material-symbols-outlined">person</span>
                <span class="font-label-md text-label-md">Perfil</span>
            </a>
            <a href="{{ route('freelancer.settings.index') }}"
               class="nav-item {{ request()->routeIs('freelancer.settings.*') ? 'nav-active' : '' }}">
                <span class="material-symbols-outlined">settings</span>
                <span class="font-label-md text-label-md">Definições</span>
            </a>
        </div>

        {{-- Footer da Sidebar --}}
        <div class="mt-auto pt-6 border-t border-gray-800">
            <div class="flex items-center gap-3 mb-4 px-2">
                <img class="w-10 h-10 rounded-full border border-gray-700 object-cover"
                     src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=CCFF00&color=000' }}"
                     alt="Avatar">
                <div>
                    <p class="text-white font-bold text-sm leading-tight">{{ auth()->user()->name }}</p>
                    <p class="text-on-primary-container text-[11px] mt-0.5">
                        ⭐ {{ auth()->user()->freelancer->rating ?? '0.0' }} (Angola)
                    </p>
                </div>
            </div>
            <a href="{{ route('freelancer.credits.index') }}"
               class="w-full block text-center font-label-md text-label-md py-3 rounded-lg font-bold bg-brand-lime text-black hover:opacity-90 transition-opacity mb-4">
                Comprar Créditos
            </a>
            <div class="flex flex-col gap-1 px-2">
                <a href="#" class="nav-item text-sm">
                    <span class="material-symbols-outlined text-[18px]">help_outline</span> Ajuda
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-item w-full text-left text-sm">
                        <span class="material-symbols-outlined text-[18px]">logout</span> Terminar Sessão
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- ========== MAIN ========== --}}
    <main class="flex-1 ml-0 md:ml-[280px] flex flex-col min-h-screen">
        {{-- Header --}}
        <header class="w-full h-20 px-6 md:px-8 flex justify-between items-center bg-brand-lime sticky top-0 z-40 border-b border-black/10">
            <button class="md:hidden text-black">
                <span class="material-symbols-outlined text-3xl">menu</span>
            </button>
            <div class="flex-1 flex justify-start">
                <div class="relative w-full max-w-md hidden md:block">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">search</span>
                    <input class="w-full pl-12 pr-4 py-3 rounded-full bg-white border border-gray-200 focus:border-black focus:ring-2 focus:ring-black transition-all outline-none font-body-md text-black"
                           placeholder="Pesquisar projetos, clientes..."
                           type="text">
                </div>
            </div>
            <div class="flex items-center gap-4">
                <button class="relative text-black hover:opacity-80 transition-opacity">
                    <span class="material-symbols-outlined text-2xl">notifications</span>
                    <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-600 rounded-full border-2 border-brand-lime"></span>
                </button>
                <img class="w-10 h-10 rounded-full border-2 border-black object-cover cursor-pointer"
                     src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=CCFF00&color=000' }}"
                     alt="Avatar">
            </div>
        </header>

        {{-- Page Content --}}
        <div class="flex-1 bg-brand-lime">
            @yield('content')
        </div>

        {{-- Footer --}}
        <footer class="bg-brand-lime border-t border-black/10 px-8 py-6">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <span class="text-black font-black text-lg">SKILLA</span>
                    <p class="text-black/70 text-sm">© {{ date('Y') }} Skilla - Feito em Luanda</p>
                </div>
                <div class="flex items-center gap-6">
                    <a href="#" class="text-black text-sm hover:underline">Sobre</a>
                    <a href="#" class="text-black text-sm hover:underline">Termos</a>
                    <a href="#" class="text-black text-sm hover:underline">Privacidade</a>
                    <a href="#" class="text-black text-sm hover:underline">Suporte</a>
                </div>
            </div>
        </footer>
    </main>

    {{-- Mobile Bottom Nav --}}
    <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-black border-t border-gray-800 px-4 py-2 flex justify-around items-center z-50">
        <a href="{{ route('freelancer.dashboard') }}" class="flex flex-col items-center gap-0.5 {{ request()->routeIs('freelancer.dashboard') ? 'text-brand-lime' : 'text-gray-500' }}">
            <span class="material-symbols-outlined text-[22px]">home</span>
            <span class="text-[10px] font-medium">Início</span>
        </a>
        <a href="{{ route('freelancer.jobs.index') }}" class="flex flex-col items-center gap-0.5 {{ request()->routeIs('freelancer.jobs.*') ? 'text-brand-lime' : 'text-gray-500' }}">
            <span class="material-symbols-outlined text-[22px]">work</span>
            <span class="text-[10px] font-medium">Jobs</span>
        </a>
        <a href="{{ route('freelancer.proposals.index') }}" class="flex flex-col items-center gap-0.5 {{ request()->routeIs('freelancer.proposals.*') ? 'text-brand-lime' : 'text-gray-500' }}">
            <span class="material-symbols-outlined text-[22px]">description</span>
            <span class="text-[10px] font-medium">Propostas</span>
        </a>
        <a href="{{ route('freelancer.messages.index') }}" class="flex flex-col items-center gap-0.5 {{ request()->routeIs('freelancer.messages.*') ? 'text-brand-lime' : 'text-gray-500' }}">
            <span class="material-symbols-outlined text-[22px]">chat</span>
            <span class="text-[10px] font-medium">Mensagens</span>
        </a>
        <a href="{{ route('freelancer.profile.index') }}" class="flex flex-col items-center gap-0.5 {{ request()->routeIs('freelancer.profile.*') ? 'text-brand-lime' : 'text-gray-500' }}">
            <span class="material-symbols-outlined text-[22px]">person</span>
            <span class="text-[10px] font-medium">Perfil</span>
        </a>
    </nav>

    @stack('scripts')
</body>
</html>