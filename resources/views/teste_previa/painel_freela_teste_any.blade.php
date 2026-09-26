<!DOCTYPE html>
<html class="dark" lang="pt-AO">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Meta tags para dados de sistema -->
    <meta name="user-id" content="{{ auth()->id() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Skilla - Dashboard do Freelancer</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
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
                        "tertiary-fixed-dim": "#c6c6c6"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "2xl": "1.5rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "container-padding-mobile": "16px",
                        "gutter": "24px",
                        "base": "8px",
                        "container-padding-desktop": "32px",
                        "sidebar-width": "280px"
                    },
                    "fontFamily": {
                        "headline-sm": ["Space Grotesk"],
                        "body-lg": ["Inter"],
                        "display-lg": ["Space Grotesk"],
                        "label-sm": ["Space Grotesk"],
                        "headline-md": ["Space Grotesk"],
                        "display-lg-mobile": ["Space Grotesk"],
                        "body-md": ["Inter"],
                        "label-md": ["Space Grotesk"]
                    },
                    "fontSize": {
                        "headline-sm": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "display-lg": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "label-sm": ["12px", { "lineHeight": "16px", "fontWeight": "500" }],
                        "headline-md": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                        "display-lg-mobile": ["36px", { "lineHeight": "42px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
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
        .neon-accent { color: #CCFF00; }
        .bg-neon-accent { background-color: #CCFF00; }
        .text-black-pure { color: #000000; }
        .bg-black-pure { background-color: #000000; }

        .hard-shadow { box-shadow: 8px 8px 0px rgba(0,0,0,0.1); }
        .foto_cliente_postou_vaga{
            width: 3rem;
            height: 3rem;
            border-radius: 0.75rem;
            background-color: #ffffff;
            border: 1px solid #d1d5db;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card_proposta button:hover{
            color: black;
            background-color: #CCFF00;
            transition: 1s;
        }

        /* ---- CSS do Feed de Projetos ---- */
        .custom-glow { box-shadow: 0px 4px 20px rgba(217, 255, 0, 0.05); }
        .hover-glow:hover { box-shadow: 0px 4px 20px rgba(217, 255, 0, 0.15); border-color: #D4FF00; }
        input[type="checkbox"]:checked { background-color: #D4FF00; border-color: #D4FF00; }
        input[type="range"] { -webkit-appearance: none; width: 100%; background: transparent; }
        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            height: 16px;
            width: 16px;
            border-radius: 50%;
            background: #D4FF00;
            cursor: pointer;
            margin-top: -6px;
        }
        input[type="range"]::-webkit-slider-runnable-track {
            width: 100%;
            height: 4px;
            cursor: pointer;
            background: #323537;
            border-radius: 2px;
        }
    </style>
</head>

<body class="font-body-md text-body-md text-on-primary-fixed min-h-screen flex overflow-x-hidden">
<!-- SideNavBar -->
<nav class="hidden md:flex fixed left-0 top-0 h-full w-[280px] flex-col p-6 bg-primary-container dark:bg-primary-container z-50">
    <div class="mb-12 flex items-center gap-4">
        <span class="material-symbols-outlined text-secondary-container text-4xl" data-weight="fill" style="font-variation-settings: 'FILL' 1;">widgets</span>
        <div>
            <h1 class="font-display-lg text-headline-md font-black text-secondary dark:text-secondary m-0 leading-none">SKILLA</h1>
            <p class="font-label-sm text-label-sm text-on-primary-container">Plataforma de Freelance</p>
        </div>
    </div>

    <div class="flex-1 space-y-2">
        <a data-spa-link data-route="inicio"
           class="flex items-center gap-3 bg-[#CCFF00] text-black-pure rounded-lg px-4 py-3 font-bold transition-all"
           href="/freelancer/inicio">
            <span class="material-symbols-outlined">home</span>
            <span class="font-label-md text-label-md">Início</span>
        </a>

        <a data-spa-link data-route="trabalhos"
           class="flex items-center gap-3 text-on-primary-container hover:text-secondary px-4 py-3 transition-colors"
           href="/freelancer/trabalhos">
            <span class="material-symbols-outlined">work</span>
            <span class="font-label-md text-label-md">Trabalhos</span>
        </a>

        <a data-spa-link data-route="propostas"
           class="flex items-center gap-3 text-on-primary-container hover:text-secondary px-4 py-3 transition-colors"
           href="/freelancer/propostas">
            <span class="material-symbols-outlined">description</span>
            <span class="font-label-md text-label-md">Propostas</span>
        </a>

        <a data-spa-link data-route="mensagens"
           class="flex items-center gap-3 text-on-primary-container hover:text-secondary px-4 py-3 transition-colors"
           href="/freelancer/mensagens">
            <span class="material-symbols-outlined">chat</span>
            <span class="font-label-md text-label-md">Mensagens</span>
        </a>

        <a data-spa-link data-route="carteira"
           class="flex items-center gap-3 text-on-primary-container hover:text-secondary px-4 py-3 transition-colors"
           href="/freelancer/carteira">
            <span class="material-symbols-outlined">account_balance_wallet</span>
            <span class="font-label-md text-label-md">Carteira</span>
        </a>

        <a data-spa-link data-route="perfil"
           class="flex items-center gap-3 text-on-primary-container hover:text-secondary px-4 py-3 transition-colors"
           href="/freelancer/perfil">
            <span class="material-symbols-outlined">person</span>
            <span class="font-label-md text-label-md">Perfil</span>
        </a>

        <a data-spa-link data-route="definicoes"
           class="flex items-center gap-3 text-on-primary-container hover:text-secondary px-4 py-3 transition-colors"
           href="/freelancer/definicoes">
            <span class="material-symbols-outlined">settings</span>
            <span class="font-label-md text-label-md">Definições</span>
        </a>
    </div>

    <div class="mt-auto pt-6">
        <!-- Área do Usuário Sidebar (Dinâmica) -->
        <div class="flex items-center gap-3 mb-6 px-2">
            <img class="w-10 h-10 rounded-full border border-outline-variant" id="sidebar-user-avatar" src="" alt="Avatar">
            <div class="flex flex-col">
                <span class="text-white font-bold text-sm" id="sidebar-user-name">[Nome]</span>
                <span class="text-on-primary-container text-[11px]" id="sidebar-user-rating">⭐ 0.0 (País)</span>
            </div>
        </div>
        <a href="{{route('comprar_creditos')}}">
            <button  class="w-full font-label-md text-label-md py-3 rounded-lg font-bold hover:bg-secondary-fixed-dim transition-colors scale-98 active:scale-95 bg-[#CCFF00] text-black-pure">
                Comprar Créditos
            </button>
        </a>
        <div class="flex flex-col gap-2 mt-4 px-2">
            <a class="flex items-center gap-2 text-on-primary-container hover:text-secondary text-sm transition-colors" href="#">
                <span class="material-symbols-outlined text-[18px]">help_outline</span> Ajuda
            </a>
            <a class="flex items-center gap-2 text-on-primary-container hover:text-secondary text-sm transition-colors" href="#" onclick="logout(event)">
                <span class="material-symbols-outlined text-[18px]">logout</span> Terminar Sessão
            </a>
        </div>
    </div>
</nav>

<!-- Main Content Canvas -->
<main class="flex-1 w-full ml-0 md:ml-[280px] max-w-[calc(1440px-280px)] mx-auto flex flex-col min-h-screen">
    <!-- TopNavBar -->
    <header class="w-full h-20 px-container-padding-mobile md:px-container-padding-desktop flex justify-between items-center bg-transparent z-40">
        <!-- Mobile Menu Trigger -->
        <button class="md:hidden text-black-pure">
            <span class="material-symbols-outlined text-3xl">menu</span>
        </button>
        <div class="flex-1 flex justify-center md:justify-start">
            <div class="relative w-full max-w-md hidden md:block">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-tertiary-container">search</span>
                <input class="w-full pl-12 pr-4 py-3 rounded-full bg-white border border-outline focus:border-black-pure focus:ring-2 focus:ring-black-pure transition-all outline-none font-body-md text-on-primary-fixed" placeholder="Pesquisar projetos, clientes..." type="text">
            </div>
        </div>
        <div class="flex items-center gap-6">
            <button class="relative text-black-pure hover:opacity-80 transition-opacity">
                <span class="material-symbols-outlined text-2xl">notifications</span>
                <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-error rounded-full border-2 border-[#CCFF00]"></span>
            </button>
            <div class="w-10 h-10 rounded-full bg-white border border-outline overflow-hidden cursor-pointer hover:opacity-80 transition-opacity">
                <img alt="User Avatar" class="w-full h-full object-cover" id="header-user-avatar" src="">
            </div>
        </div>
    </header>

    <!-- Dashboard Content -->
    <div class="flex-1 p-container-padding-mobile md:p-container-padding-desktop flex flex-col gap-8 pb-20">

        <!-- SPA VIEWPORT -->
        <section id="spa-view" class="bg-[#CCFF00]">

            <!-- VIEW: INÍCIO -->
            <div id="view-inicio">
                <!-- Page Header (Gap/Margem adicionada aqui com mb-10) -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-10">
                    <div>
                        <h2 class="font-headline-md text-headline-md text-black-pure mb-2" id="greeting-user-name">Bom dia, [Nome] 👋</h2>
                        <p class="font-body-lg text-body-lg text-black-pure opacity-80">Aqui está o resumo da sua atividade</p>
                    </div>
                    <!-- Botão Explorar Trabalhos com ID para JS SPA -->
                    <button id="btn-explorar-trabalhos" class="bg-black-pure text-white px-6 py-3 rounded-full font-label-md text-label-md font-bold flex items-center gap-2 hover:bg-surface-container-highest transition-colors">
                        Explorar Trabalhos <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                    </button>
                </div>

                <!-- KPI Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                    <div class="glass-card p-8 hard-shadow flex flex-col gap-4 min-h-[160px]">
                        <div class="w-10 h-10 bg-black-pure rounded-lg flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[#CCFF00]">work</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="font-label-sm text-label-sm text-on-tertiary-container uppercase tracking-wider">Trabalhos em andamento</span>
                            <span class="font-display-lg text-headline-md font-bold text-black-pure leading-none truncate" id="metric-active-jobs">0</span>
                        </div>
                    </div>

                    <div class="glass-card p-8 hard-shadow flex flex-col gap-4 min-h-[160px] relative">
                        <div class="absolute top-6 right-6 shrink-0 hidden" id="badge-pending-proposals-container">
                            <span class="bg-[#CCFF00] text-black-pure font-label-sm text-[10px] px-2 py-1 rounded-full font-bold" id="badge-pending-proposals-text">0 PENDENTES</span>
                        </div>
                        <div class="w-10 h-10 bg-black-pure rounded-lg flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[#CCFF00]">description</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="font-label-sm text-label-sm text-on-tertiary-container uppercase tracking-wider">Propostas Enviadas</span>
                            <span class="font-display-lg text-headline-md font-bold text-black-pure leading-none truncate" id="metric-total-proposals">0</span>
                        </div>
                    </div>

                    <div class="glass-card p-8 hard-shadow flex flex-col gap-4 min-h-[160px]">
                        <div class="w-10 h-10 bg-black-pure rounded-lg flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[#CCFF00]">account_balance_wallet</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="font-label-sm text-label-sm text-on-tertiary-container uppercase tracking-wider">Total Ganho</span>
                            <span class="font-bold text-black-pure leading-none truncate" style="font-size: 24px;" id="metric-total-earned">KZS 0</span>
                        </div>
                    </div>

                    <div class="glass-card p-8 hard-shadow flex flex-col gap-4 min-h-[160px]">
                        <div class="w-10 h-10 bg-black-pure rounded-lg flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[#CCFF00]">toll</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="font-label-sm text-label-sm text-on-tertiary-container uppercase tracking-wider">Créditos</span>
                            <span class="font-bold text-black-pure leading-none truncate" style="font-size: 24px;" id="metric-credits">0</span>
                        </div>
                    </div>

                    <div class="glass-card p-8 hard-shadow flex flex-col gap-4 min-h-[160px]">
                        <div class="w-10 h-10 bg-black-pure rounded-lg flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[#CCFF00]">star</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="font-label-sm text-label-sm text-on-tertiary-container uppercase tracking-wider">Avaliação Média</span>
                            <span class="font-display-lg text-headline-md font-bold text-black-pure leading-none truncate" id="metric-average-rating">0.0</span>
                        </div>
                    </div>

                    <div class="glass-card p-8 hard-shadow flex flex-col gap-4 min-h-[160px]">
                        <div class="w-10 h-10 bg-black-pure rounded-lg flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[#CCFF00]">lock</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="font-label-sm text-label-sm text-on-tertiary-container uppercase tracking-wider">Em Escrow (Cativo)</span>
                            <span class="font-bold text-black-pure leading-none truncate" style="font-size: 24px;" id="metric-escrow-amount">KZS 0</span>
                        </div>
                    </div>

                    <div class="glass-card p-8 hard-shadow flex flex-col gap-4 min-h-[160px]">
                        <div class="w-10 h-10 bg-black-pure rounded-lg flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[#CCFF00]">trophy</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="font-label-sm text-label-sm text-on-tertiary-container uppercase tracking-wider">Trabalhos Concluídos</span>
                            <span class="font-bold text-black-pure leading-none truncate" style="font-size: 24px;" id="metric-completed-jobs">0</span>
                        </div>
                    </div>

                    <div class="glass-card p-8 hard-shadow flex flex-col gap-4 min-h-[160px]">
                        <div class="w-10 h-10 bg-black-pure rounded-lg flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[#CCFF00]">trending_up</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="font-label-sm text-label-sm text-on-tertiary-container uppercase tracking-wider">Taxa de Sucesso</span>
                            <span class="font-bold text-black-pure leading-none truncate" style="font-size: 24px;" id="metric-success-rate">0%</span>
                        </div>
                    </div>
                </div>

                <!-- Operational Section -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <div class="lg:col-span-7 flex flex-col gap-4">
                        <h3 class="font-headline-sm text-headline-sm text-black-pure px-2">Jobs Ativos</h3>
                        <div id="active-job-container"></div>
                    </div>

                    <div class="lg:col-span-5 flex flex-col gap-4">
                        <h3 class="font-headline-sm text-headline-sm text-black-pure px-2">Propostas</h3>
                        <div class="glass-card p-6 hard-shadow h-full flex flex-col">
                            <div class="flex-1 flex flex-col gap-4 mb-6" id="recent-proposals-container"></div>
                            <button class="w-full border-2 border-black-pure text-black-pure py-3 rounded-lg font-label-md text-label-md font-bold hover:bg-black-pure hover:text-white transition-colors mt-auto">
                                Ver Todas as Propostas
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Recommendations -->
                <div class="flex flex-col gap-6 mt-8">
                    <h3 class="font-headline-md text-headline-md text-black-pure">
                        Jobs Recomendados para Si
                        <a class="float-right text-black-pure text-sm font-bold underline" href="#">Ver todos</a>
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="recommended-jobs-container"></div>
                </div>
            </div>

        </section>
    </div>
</main>

<script src="{{ asset('js/painel_freelancer.js') }}"></script>

<script>
    async function logout(event) {
        event.preventDefault();
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        const response = await fetch('/logout-api', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });
        if (response.ok) {
            window.location.href = '/login';
        }
    }
</script>

<script>
    (function () {
        const links = document.querySelectorAll('[data-spa-link]');
        const spaView = document.getElementById('spa-view');
        if (!spaView || !links.length) return;

        // Templates
        const templates = {
            inicio: document.getElementById('view-inicio')?.outerHTML || ''
        };

        // Template: Feed de Trabalhos
        templates.trabalhos = `
            <div id="view-trabalhos" class="min-h-screen relative z-10 flex flex-col pb-20">
                <header class="w-full px-4 md:px-10 pt-8 pb-6 sticky top-0 md:top-0 z-30 bg-[#CCFF00] shadow-sm">
                    <div class="max-w-[1280px] mx-auto">
                        <div class="flex flex-col md:flex-row gap-4 items-center justify-center mb-6 relative">
                            
                        
                        </div>
                        <div class="flex overflow-x-auto gap-3 pb-2 scrollbar-hide no-scrollbar">
                            <button class="px-5 py-2 rounded-full bg-black text-[#D4FF00] font-bold whitespace-nowrap shadow-sm border border-black">Todos</button>
                            <button class="px-5 py-2 rounded-full bg-white text-black font-medium whitespace-nowrap hover:bg-gray-100 transition-colors shadow-sm">Design</button>
                            <button class="px-5 py-2 rounded-full bg-white text-black font-medium whitespace-nowrap hover:bg-gray-100 transition-colors shadow-sm">Desenvolvimento</button>
                            <button class="px-5 py-2 rounded-full bg-white text-black font-medium whitespace-nowrap hover:bg-gray-100 transition-colors shadow-sm">Mobile</button>
                            <button class="px-5 py-2 rounded-full bg-white text-[#FF5722] font-bold border border-[#FF5722] whitespace-nowrap hover:bg-orange-50 transition-colors shadow-sm flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]">local_fire_department</span> Urgente
                            </button>
                            <button class="px-5 py-2 rounded-full bg-white text-black font-medium whitespace-nowrap hover:bg-gray-100 transition-colors shadow-sm">Remoto</button>
                            <button class="px-5 py-2 rounded-full bg-white text-black font-medium whitespace-nowrap hover:bg-gray-100 transition-colors shadow-sm">Luanda</button>
                        </div>
                    </div>
                </header>

                <div class="max-w-[1280px] mx-auto w-full px-4 md:px-10 flex flex-col lg:flex-row gap-6 mt-4">
                    <aside class="w-full lg:w-1/4 flex flex-col gap-6">
                        <div class="bg-white rounded-2xl p-6 shadow-xl text-black">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-[24px] leading-[32px] font-semibold">Filtros</h2>
                                <button class="text-[12px] leading-[16px] font-medium text-gray-500 hover:text-[#FF5722] underline">Limpar</button>
                            </div>
                            <div class="mb-8">
                                <h3 class="text-[14px] leading-[20px] font-medium font-bold mb-4 uppercase tracking-wider">Orçamento (Kz)</h3>
                                <input class="w-full accent-[#D4FF00]" max="500000" min="10000" type="range" value="250000"/>
                                <div class="flex justify-between mt-2 text-[12px] leading-[16px] text-gray-600">
                                    <span>10K</span><span class="font-bold text-black">Até 250K</span><span>500K+</span>
                                </div>
                            </div>
                            <hr class="border-gray-200 mb-6"/>
                            <div class="mb-8">
                                <h3 class="text-[14px] leading-[20px] font-medium font-bold mb-4 uppercase tracking-wider">Prazo</h3>
                                <div class="flex flex-col gap-3">
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input class="form-checkbox rounded border-gray-300 w-5 h-5 focus:ring-[#D4FF00]" type="checkbox"/>
                                        <span class="text-[16px] leading-[24px] text-gray-700 group-hover:text-black">Menos de 1 semana</span>
                                    </label>
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input checked class="form-checkbox rounded border-gray-300 w-5 h-5 focus:ring-[#D4FF00] bg-black" type="checkbox"/>
                                        <span class="text-[16px] leading-[24px] text-gray-700 group-hover:text-black font-medium">1 a 4 semanas</span>
                                    </label>
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input class="form-checkbox rounded border-gray-300 w-5 h-5 focus:ring-[#D4FF00]" type="checkbox"/>
                                        <span class="text-[16px] leading-[24px] text-gray-700 group-hover:text-black">1 a 3 meses</span>
                                    </label>
                                </div>
                            </div>
                            <hr class="border-gray-200 mb-6"/>
                            <div class="mb-8">
                                <h3 class="text-[14px] leading-[20px] font-medium font-bold mb-4 uppercase tracking-wider">Nível de Experiência</h3>
                                <div class="flex flex-col gap-3">
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input class="form-checkbox rounded border-gray-300 w-5 h-5 focus:ring-[#D4FF00]" type="checkbox"/>
                                        <span class="text-[16px] leading-[24px] text-gray-700 group-hover:text-black flex-1">Júnior</span>
                                        <span class="text-[12px] leading-[16px] text-gray-400 bg-gray-100 px-2 py-1 rounded-md">45</span>
                                    </label>
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input class="form-checkbox rounded border-gray-300 w-5 h-5 focus:ring-[#D4FF00]" type="checkbox"/>
                                        <span class="text-[16px] leading-[24px] text-gray-700 group-hover:text-black flex-1">Pleno</span>
                                        <span class="text-[12px] leading-[16px] text-gray-400 bg-gray-100 px-2 py-1 rounded-md">112</span>
                                    </label>
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input checked class="form-checkbox rounded border-gray-300 w-5 h-5 focus:ring-[#D4FF00] bg-black" type="checkbox"/>
                                        <span class="text-[16px] leading-[24px] text-gray-700 group-hover:text-black flex-1 font-medium">Sênior</span>
                                        <span class="text-[12px] leading-[16px] text-gray-400 bg-gray-100 px-2 py-1 rounded-md">89</span>
                                    </label>
                                </div>
                            </div>
                            <button class="w-full py-4 bg-black text-white rounded-xl font-bold hover:bg-gray-800 transition-colors shadow-md mt-4">
                                Aplicar Filtros
                            </button>
                        </div>
                    </aside>

                    <section class="w-full lg:w-3/4 flex flex-col gap-5">
                        <div class="flex justify-between items-center bg-white/50 backdrop-blur-sm p-4 rounded-xl border border-white/40">
                            <p class="text-[16px] leading-[24px] font-medium text-black"><span class="font-bold">246</span> projetos encontrados</p>
                            <div class="flex items-center gap-2">
                                <span class="text-[12px] leading-[16px] font-medium text-gray-700">Ordenar por:</span>
                                <select class="bg-white border-none rounded-lg text-black font-medium text-[12px] leading-[16px] focus:ring-0 py-2 pl-3 pr-8 shadow-sm cursor-pointer">
                                    <option>Mais recentes</option>
                                    <option>Maior orçamento</option>
                                    <option>Mais propostas</option>
                                </select>
                            </div>
                        </div>

                        <!-- Card Destaque -->
                        <article class="bg-white rounded-2xl p-6 shadow-xl border-l-8 border-l-[#FF5722] relative group transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl text-black">
                            <div class="absolute -top-3 right-6 bg-[#FF5722] text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest shadow-md flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]">star</span> Destaque
                            </div>
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-4">
                                <h3 class="text-[24px] leading-[32px] font-semibold leading-tight group-hover:text-[#FF5722] transition-colors">Design de App Fintech + Dashboard Admin</h3>
                                <div class="bg-gray-50 px-4 py-2 rounded-lg border border-gray-100 shrink-0">
                                    <span class="text-[24px] leading-[32px] font-semibold font-bold block">1.500.000 Kz</span>
                                    <span class="text-[12px] leading-[16px] text-gray-500 uppercase tracking-wide">Orçamento Fixo</span>
                                </div>
                            </div>
                            <div class="flex flex-wrap items-center gap-4 text-[12px] leading-[16px] text-gray-600 mb-4">
                                <div class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">location_on</span> Remoto (Luanda)</div>
                                <div class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">schedule</span> 1 a 3 meses</div>
                                <div class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">work</span> Projeto Longo</div>
                                <div class="flex items-center gap-1 text-green-600"><span class="material-symbols-outlined text-[16px]">verified</span> Pagamento Verificado</div>
                            </div>
                            <p class="text-[16px] leading-[24px] text-gray-700 mb-6 line-clamp-2">
                                Procuramos um Product Designer (UI/UX) sênior para desenhar de raiz a nossa nova aplicação de mobile banking focada no mercado angolano, bem como o dashboard administrativo web para a equipa interna. Necessário portfólio forte em fintech.
                            </p>
                            <div class="flex flex-wrap gap-2 mb-6">
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-md text-[12px] leading-[16px] border border-gray-200">Figma</span>
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-md text-[12px] leading-[16px] border border-gray-200">UI/UX</span>
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-md text-[12px] leading-[16px] border border-gray-200">Fintech</span>
                            </div>
                            <hr class="border-gray-100 mb-4"/>
                            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                                <div class="flex items-center gap-3">
                                    <img alt="Client Avatar" class="w-10 h-10 rounded-full border-2 border-[#FF5722]" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBpq57DCqYCN3M32vbZwd5OS-DkMltmiYYIinWzDv7cGBAXTUHrJ8gveTiIZlW4Awi8g9YHeYUg12E8UhBQ9okGHZEFhlbex-F9D6cnwa6FLY2tEi4GnZfzgf-UWZu2BQtrqcaMMjFkIpVnwcpKjO1dTIsiCm5DqDE7LHD3R6Hln-c_ESx8_suqJUhotwqWa7hRAr5QCarDorfPwhL33dy1IYnnnHkCyI8OYwqS5AF8tt_d2SrNEEfKcICMY7yzOMHVfmByMKOEHVs"/>
                                    <div>
                                        <p class="text-[14px] leading-[20px] font-medium font-bold">Kamba Finance</p>
                                        <div class="flex items-center gap-1 text-[#FF5722]">
                                            <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                            <span class="text-[12px] leading-[16px] text-gray-500 ml-1">(12)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4 w-full md:w-auto">
                                    <div class="text-right hidden md:block">
                                        <p class="text-[14px] leading-[20px] font-medium font-bold text-gray-800">14 propostas</p>
                                        <p class="text-[12px] leading-[16px] text-gray-500">Publicado há 2h</p>
                                    </div>
                                    <button data-open-job class="flex-1 md:flex-none border-2 border-black text-black px-6 py-2 rounded-xl font-bold hover:bg-black hover:text-white transition-colors">Ver job</button>
                                </div>
                            </div>
                        </article>

                        <!-- Card Standard -->
                        <article class="bg-white rounded-2xl p-6 shadow-md border border-gray-100 transition-transform duration-300 hover:-translate-y-1 hover:shadow-xl text-black">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-4">
                                <h3 class="text-[24px] leading-[32px] font-semibold leading-tight hover:text-blue-600 transition-colors cursor-pointer">Desenvolvimento de Landing Page (React/Next.js)</h3>
                                <div class="bg-gray-50 px-4 py-2 rounded-lg border border-gray-100 shrink-0">
                                    <span class="text-[24px] leading-[32px] font-semibold font-bold block">85.000 Kz</span>
                                    <span class="text-[12px] leading-[16px] text-gray-500 uppercase tracking-wide">Orçamento Fixo</span>
                                </div>
                            </div>
                            <div class="flex flex-wrap items-center gap-4 text-[12px] leading-[16px] text-gray-600 mb-4">
                                <div class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">location_on</span> Remoto</div>
                                <div class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">schedule</span> Menos de 1 semana</div>
                            </div>
                            <p class="text-[16px] leading-[24px] text-gray-700 mb-6 line-clamp-2">
                                Preciso de um desenvolvedor front-end para criar uma landing page simples para um evento...
                            </p>
                            <hr class="border-gray-100 mb-4"/>
                            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-[18px]">M</div>
                                    <div><p class="text-[14px] leading-[20px] font-medium font-bold">Miguel Santos</p></div>
                                </div>
                                <div class="flex items-center gap-4 w-full md:w-auto">
                                    <div class="text-right hidden md:block">
                                        <p class="text-[14px] leading-[20px] font-medium font-bold text-gray-800">3 propostas</p>
                                    </div>
                                    <button data-open-job class="flex-1 md:flex-none border-2 border-black text-black px-6 py-2 rounded-xl font-bold hover:bg-black hover:text-white transition-colors">Ver job</button>
                                </div>
                            </div>
                        </article>
                    </section>
                </div>
            </div>
        `;

        // Template: Detalhe do Trabalho (Ajustado o STICKY WRAPPER na coluna da direita)
        templates.trabalho_detalhe = `
          <div id="view-trabalho-detalhe" class="min-h-screen bg-[#D4FF00]">
            <div class="p-6 md:p-8 space-y-8 max-w-[1280px] mx-auto w-full pb-20">
              <div class="flex flex-col gap-2">
                <a data-back-to-feed class="inline-flex items-center gap-2 font-label-md text-label-md text-black hover:opacity-70 transition-opacity font-bold" href="#">
                  <span class="material-symbols-outlined text-[18px]">arrow_back</span> Voltar ao feed
                </a>
                <div class="font-label-sm text-label-sm text-black opacity-70 flex items-center gap-2">
                  <a class="hover:underline" href="#">Início</a> &gt;
                  <a class="hover:underline" href="#">Jobs</a> &gt;
                  <a class="hover:underline" href="#">Design Gráfico</a> &gt;
                  <span>Identidade Visual</span>
                </div>
              </div>

              <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Coluna Esquerda: Detalhes -->
                <div class="lg:col-span-8 flex flex-col gap-6">
                  <div class="bg-white rounded-[24px] p-8 hard-shadow flex flex-col">
                    <div class="pb-8">
                      <span class="inline-block bg-[#D4FF00] text-black text-[12px] font-bold px-3 py-1 rounded-full mb-4">Design Gráfico</span>
                      <h1 class="font-headline-lg text-3xl md:text-4xl text-black mb-4">Criar identidade visual completa para empresa de logística em Luanda</h1>
                      <div class="flex flex-wrap gap-6 text-black">
                        <div class="flex items-center gap-2">
                          <span class="material-symbols-outlined text-[20px] opacity-70">location_on</span>
                          <span class="font-body-md text-body-md">Luanda (Remoto/Híbrido)</span>
                        </div>
                        <div class="flex items-center gap-2">
                          <span class="material-symbols-outlined text-[20px] opacity-70">schedule</span>
                          <span class="font-body-md text-body-md">Prazo: 15 dias</span>
                        </div>
                      </div>
                    </div>
                    <hr class="border-gray-100"/>
                    <div class="py-8 flex flex-col gap-4">
                      <h2 class="font-headline-sm text-black">Descrição do Projeto</h2>
                      <div class="font-body-md text-gray-700 space-y-4 break-words">
                        <p>Estamos à procura de um designer gráfico talentoso e experiente para desenvolver a identidade visual completa da nossa nova empresa de logística...</p>
                      </div>
                    </div>
                    <hr class="border-gray-100"/>
                    <div class="py-8 flex flex-col gap-4">
                      <h2 class="font-headline-sm text-black">O que precisamos (Entregáveis)</h2>
                      <ul class="flex flex-col gap-4 mt-2">
                        <li class="flex items-start gap-3">
                          <span class="material-symbols-outlined text-green-600 text-[24px]">check_circle</span>
                          <span class="font-body-md text-gray-700 break-words">Design de Logótipo (Versões principal, secundária e monocromática)</span>
                        </li>
                      </ul>
                    </div>
                  </div>

                  <div class="flex flex-col gap-8">
                    <div class="flex justify-between items-center">
                      <h2 class="font-headline-sm text-black flex items-center gap-3">
                        <span class="material-symbols-outlined">forum</span> Propostas recebidas (8)
                      </h2>
                    </div>
                    <div class="flex flex-col gap-6">
                      <!-- Exemplo Proposta -->
                      <div class="bg-white rounded-[24px] p-6 hard-shadow flex flex-col gap-4">
                        <div class="flex justify-between items-start">
                          <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center font-bold text-black border border-gray-200 shrink-0">MC</div>
                            <div class="flex flex-col">
                              <div class="flex items-center gap-2">
                                <p class="font-label-md font-bold text-black">Mário Costa</p>
                                <span class="text-yellow-600 text-sm font-bold">⭐ 4.8</span>
                              </div>
                              <p class="font-label-sm text-gray-700 font-bold mt-1">Designer Sénior</p>
                            </div>
                          </div>
                          <div class="text-right">
                            <p class="font-headline-sm text-black font-bold">80.000 Kz</p>
                          </div>
                        </div>
                        <div class="font-body-sm text-gray-600 line-clamp-3">Olá! Tenho mais de 5 anos de experiência...</div>
                        <div class="flex justify-between items-center pt-2">
                          <button class="bg-black text-white px-6 py-2 rounded-lg font-label-md text-sm font-bold hover:bg-gray-800 transition-colors">Ver perfil</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Coluna Direita: Sticky Sidebar Corrigida -->
                <div class="lg:col-span-4">
                  <!-- Wrapper Sticky que fixa TODO o conteúdo da direita ao rolar -->
                  <div class="sticky top-24 flex flex-col gap-6">
                    
                    <!-- Card de Acão / Enviar Proposta -->
                    <div class="bg-white rounded-[24px] p-8 hard-shadow flex flex-col gap-6">
                      <div class="flex flex-col gap-1">
                        <span class="font-label-sm text-gray-600 uppercase tracking-wider">Orçamento Fixo</span>
                        <span class="text-[40px] leading-none font-bold text-black">75.000 Kz</span>
                      </div>

                      <div class="grid grid-cols-3 gap-[20px] font-label-md text-black border-y border-gray-200 py-6">
                        <div class="flex flex-col items-center gap-2">
                          <span class="text-gray-600 text-[12px] text-center">Visualizações</span>
                          <span class="font-bold text-[20px]">42</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                          <span class="text-gray-600 text-[12px] text-center">Propostas</span>
                          <span class="font-bold text-[20px]">8</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                          <span class="text-gray-600 text-[12px] text-center">Entrevistas</span>
                          <span class="font-bold text-[20px]">1</span>
                        </div>
                      </div>

                      <div class="flex flex-col gap-4 mt-2">
                        <button class="w-full bg-[#FF7A1A] text-white py-4 rounded-xl font-label-md font-bold hover:bg-[#E66912] transition-colors shadow-md text-lg flex justify-center items-center">
                          Enviar Proposta
                        </button>
                        <button class="w-full border-2 border-black text-black py-4 rounded-xl font-label-md font-bold hover:bg-black hover:text-white transition-colors flex justify-center items-center gap-2">
                          <span class="material-symbols-outlined">favorite_border</span> Guardar Trabalho
                        </button>
                      </div>
                    </div>

                    <!-- Card Info Cliente -->
                    <div class="bg-white rounded-[24px] p-8 hard-shadow flex flex-col gap-4">
                      <h3 class="font-headline-sm text-black font-bold mb-2">Sobre o Cliente</h3>
                      <div class="flex items-center gap-4 mb-2">
                        <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center font-display-lg text-[24px] text-blue-800 font-bold border border-blue-200 shrink-0">RE</div>
                        <div>
                          <p class="font-card-title text-black font-bold">RápidaExpress Lda.</p>
                          <p class="font-label-sm text-gray-600 flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-[14px]">location_on</span> Angola, Luanda
                          </p>
                        </div>
                      </div>
                      <div class="flex flex-col gap-4 mt-4">
                        <div class="flex justify-between font-label-sm text-black">
                          <span class="text-gray-600">Trabalhos publicados</span><span class="font-bold">5</span>
                        </div>
                        <div class="flex justify-between font-label-sm text-black mt-2">
                          <span class="text-gray-600">Avaliação Média</span>
                          <span class="font-bold flex items-center text-yellow-600">⭐ 4.5 (3 reviews)</span>
                        </div>
                      </div>
                    </div>

                    <!-- Trabalhos Semelhantes -->
                    <div class="bg-white rounded-[24px] p-8 hard-shadow flex flex-col gap-4">
                      <h3 class="font-headline-sm text-black font-bold">Trabalhos Semelhantes</h3>
                      <div class="flex flex-col gap-5">
                        <a class="group flex flex-col gap-1" href="#">
                          <p class="font-label-md text-black font-bold group-hover:text-blue-600 transition-colors line-clamp-2">Re-branding para cadeia de supermercados</p>
                          <p class="font-label-sm text-gray-500">KZS 120.000,00 • Há 2 dias</p>
                        </a>
                      </div>
                    </div>

                  </div> <!-- Fim Wrapper Sticky -->
                </div>
              </div>
            </div>
          </div>
        `;

        function setActiveLink(route) {
            // Delegação para TODOS os links do SPA (funciona após qualquer render)
            spaView.addEventListener('click', (e) => {
                const link = e.target.closest('a[data-spa-link]');
                if (!link) return;

                e.preventDefault();
                const route = link.dataset.route;
                if (!route || !templates[route]) return;

                render(route, true, {
                    activeMenuRoute: link.dataset.activeMenuRoute || route,
                    hash: link.dataset.hash || route
                });
            });
        }

        function render(route, push = true, opts = {}) {
            if (!templates[route]) route = 'inicio';
            spaView.innerHTML = templates[route];

            const activeMenuRoute = opts.activeMenuRoute || route;
            setActiveLink(activeMenuRoute);

            if (push) {
                const hash = opts.hash || route;
                history.pushState({ route, opts }, '', `#${hash}`);
            }

            if (route === 'trabalhos') {
                document.title = 'Skilla - Feed de Projetos';
            } else if (route === 'trabalho_detalhe') {
                document.title = 'Skilla - Detalhes do Trabalho';
            } else {
                document.title = 'Skilla - Dashboard do Freelancer';
            }

            if (route === 'trabalhos') {
                spaView.querySelectorAll('[data-open-job]').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        e.preventDefault();
                        render('trabalho_detalhe', true, { activeMenuRoute: 'trabalhos', hash: 'trabalhos/detalhe' });
                    });
                });
            }

            if (route === 'trabalho_detalhe') {
                const back = spaView.querySelector('[data-back-to-feed]');
                if (back) {
                    back.addEventListener('click', (e) => {
                        e.preventDefault();
                        render('trabalhos', true);
                    });
                }
            }
        }

        // Delegação de eventos globais para o SPA view (para lidar com o botão do Início)
        spaView.addEventListener('click', (e) => {
            const btnExplorar = e.target.closest('#btn-explorar-trabalhos');
            if (btnExplorar) {
                e.preventDefault();
                render('trabalhos', true);
            }
        });

        // Delegação para TODOS os links do SPA (funciona após qualquer render)
        spaView.addEventListener('click', (e) => {
        const link = e.target.closest('a[data-spa-link]');
        if (!link) return;

        e.preventDefault();
        const route = link.dataset.route;
        if (!route || !templates[route]) return;

        render(route, true, {
            activeMenuRoute: link.dataset.activeMenuRoute || route,
            hash: link.dataset.hash || route
        });
        });

        window.addEventListener('popstate', (e) => {
            const stateRoute = e.state?.route;
            const stateOpts = e.state?.opts || {};
            const route = stateRoute || (location.hash || '#inicio').replace('#', '');
            render(route, false, stateOpts);
        });

        const initialRoute = (location.hash || '#inicio').replace('#', '');
        render(initialRoute, false);
    })();
</script>
</body>
</html>