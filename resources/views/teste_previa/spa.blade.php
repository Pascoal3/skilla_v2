<!DOCTYPE html>
<html lang="pt-AO">
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
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Hanken+Grotesk:wght@400;500;600;700&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">

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
                        "tertiary-fixed-dim": "#c6c6c6",
                        "obsidian": "#101010",
                        "volt-lime": "#D4FF00",
                        "black-pure": "#000000"
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
                        "sidebar-width": "280px",
                        "margin-mobile": "16px",
                        "margin-desktop": "32px"
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
        :root{
            /* Fundo da página (verde forte) */
            --primary-container: #C9F000;

            /* Cards e input (branco) */
            --tertiary: #FFFFFF;
            --on-tertiary: #101010;

            /* Textos */
            --surface-container-lowest: #101010; /* título/ícones */
            --surface-container: rgba(16,16,16,.70); /* subtítulo */
            --surface-variant: rgba(16,16,16,.55);   /* previews/placeholder */

            /* Outros (avatares/bolas) */
            --secondary: #E9E9E9;
            --secondary-container: #E9E9E9;
            --on-secondary-container: #101010;
            --on-primary-container: #101010;
        }
        html, body { background: var(--primary-container); }
        .bg-primary-container{ background: var(--primary-container); }
        .bg-tertiary{ background: var(--tertiary); }
        .text-on-tertiary{ color: var(--on-tertiary); }

        .text-surface-container-lowest{ color: var(--surface-container-lowest); }
        .text-surface-container{ color: var(--surface-container); }
        .text-surface-variant{ color: var(--surface-variant); }

        .bg-surface-container-lowest{ background: var(--surface-container-lowest); }
        .text-primary-container{ color: var(--primary-container); }

        .bg-secondary{ background: var(--secondary); }
        .bg-secondary-container{ background: var(--secondary-container); }
        .text-on-secondary-container{ color: var(--on-secondary-container); }
        .text-on-primary-container{ color: var(--on-primary-container); }
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

        /* Utilitário (usado no template Trabalhos) */
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

        /* CSS da tela Carregar Saldo (mantido) */
        .volt-glow:hover { box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.08); }
        .modal-overlay { background: rgba(15, 17, 21, 0.6); }
        .bg-lime-main { background-color: #D4FF00; }

        /* CSS da tela Extrato (mantido) */
        .glow-hover:hover { box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1); }
        .glass-panel {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border: 1px solid #000000;
        }
        .material-symbols-outlined{
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glow-hover:hover{
        box-shadow: 0px 4px 20px rgba(217, 255, 0, 0.15);
        }
            /* Se tu estiveres a montar views dentro de um #app, NÃO uses <body> aqui.
            Em vez disso, usamos um wrapper para não estragar outras páginas. */
        #view-propostas-freela{
            color: #e0e3e5;
            min-height: 100vh;
            width: 100%;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .high-contrast-shadow {
            box-shadow: 8px 8px 0px 0px rgba(0,0,0,1);
        }
        input:focus, textarea:focus {
            outline: none;
            border-color: #D4FF00 !important;
            box-shadow: 0 0 0 2px rgba(212, 255, 0, 0.2);
        }
    </style>
</head>

<body class="font-body-md text-body-md text-on-primary-fixed min-h-screen flex overflow-x-hidden">
<!-- SideNavBar -->
<nav class="hidden md:flex fixed left-0 top-0 h-full w-[280px] flex-col p-6 bg-primary-container dark:bg-primary-container z-50">
    <div class="mb-8 flex items-center gap-4">
        <span class="material-symbols-outlined text-secondary-container text-4xl" data-weight="fill" style="font-variation-settings: 'FILL' 1;">widgets</span>
        <div>
            <h1 class="font-display-lg text-headline-md font-black text-secondary dark:text-secondary m-0 leading-none">SKILLA</h1>
            <p class="font-label-sm text-label-sm text-on-primary-container">Plataforma de Freelance</p>
        </div>
    </div>

    <div class="flex-1 space-y-2">
        <a data-spa-link data-route="inicio"
           class="flex items-center gap-3 bg-[#CCFF00] text-black-pure rounded-lg px-4 py-3 font-bold transition-all"
           href="#inicio">
            <span class="material-symbols-outlined">home</span>
            <span class="font-label-md text-label-md">Início</span>
        </a>

        <a data-spa-link data-route="trabalhos"
           class="flex items-center gap-3 text-on-primary-container hover:text-secondary px-4 py-3 transition-colors"
           href="#trabalhos">
            <span class="material-symbols-outlined">work</span>
            <span class="font-label-md text-label-md">Trabalhos</span>
        </a>

        <a data-spa-link data-route="propostas"
           class="flex items-center gap-3 text-on-primary-container hover:text-secondary px-4 py-3 transition-colors"
           href="#propostas">
            <span class="material-symbols-outlined">description</span>
            <span class="font-label-md text-label-md">Propostas</span>
        </a>

        <a data-spa-link data-route="mensagens"
           class="flex items-center gap-3 text-on-primary-container hover:text-secondary px-4 py-3 transition-colors"
           href="#mensagens">
            <span class="material-symbols-outlined">chat</span>
            <span class="font-label-md text-label-md">Mensagens</span>
        </a>

        <a data-spa-link data-route="carteira"
           class="flex items-center gap-3 text-on-primary-container hover:text-secondary px-4 py-3 transition-colors"
           href="#carteira">
            <span class="material-symbols-outlined">account_balance_wallet</span>
            <span class="font-label-md text-label-md">Carteira</span>
        </a>

        <a data-spa-link data-route="perfil"
           class="flex items-center gap-3 text-on-primary-container hover:text-secondary px-4 py-3 transition-colors"
           href="#perfil">
            <span class="material-symbols-outlined">person</span>
            <span class="font-label-md text-label-md">Perfil</span>
        </a>

        <a data-spa-link data-route="definicoes"
           class="flex items-center gap-3 text-on-primary-container hover:text-secondary px-4 py-3 transition-colors"
           href="#definicoes">
            <span class="material-symbols-outlined">settings</span>
            <span class="font-label-md text-label-md">Definições</span>
        </a>
    </div>

    <div class="mt-auto pt-6">
        
        <button  class="w-full font-label-md text-label-md py-3 rounded-lg font-bold hover:bg-secondary-fixed-dim transition-colors scale-98 active:scale-95 bg-[#CCFF00] text-black-pure">
            Comprar Créditos
        </button>
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
                <img alt="User Avatar" class="w-full h-full object-cover" id="header-user-avatar" src="https://ui-avatars.com/api/?name=Freelancer&background=random">
            </div>
        </div>
    </header>

    <!-- Dashboard Content -->
    <div class="flex-1 p-container-padding-mobile md:p-container-padding-desktop flex flex-col gap-8 pb-20">

        <!-- SPA VIEWPORT -->
        <section id="spa-view" class="bg-[#CCFF00]"></section>
    </div>
</main>

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
        const spaView = document.getElementById('spa-view');
        if (!spaView) return;

        // --- OBJETO APP (Padrão solicitado) ---
        window.App = {
            templates: {},
            spaView: spaView,
            render: render
        };

        // Templates (Conteúdo Integral Restaurado)
        App.templates.inicio = `
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
        `;

        App.templates.carteira = `
            <div id="view-carteira" class="min-h-screen relative z-10 flex flex-col pb-20">
                <div class="max-w-[1280px] mx-auto w-full px-4 md:px-10 py-8 flex flex-col gap-10">

                    <!-- Skeleton path -->
                    <div class="font-label-sm text-label-sm text-black opacity-70 flex items-center gap-2">
                    <a class="hover:underline" href="#carteira">Carteira</a> &gt;
                    <span>Minha carteira</span>
                    </div>

                    <!-- Title -->
                    <div>
                    <h2 class="text-[64px] leading-[72px] tracking-[-0.04em] font-extrabold text-black mb-2" style="font-family: Sora, ui-sans-serif, system-ui;">
                        A Minha Carteira
                    </h2>
                    <p class="text-[18px] leading-[28px] text-gray-800">
                        Gere os seus rendimentos e pagamentos de forma centralizada.
                    </p>
                    </div>

                    <!-- Visão Geral -->
                    <section>
                    <h3 class="text-[12px] leading-[16px] font-bold text-gray-600 uppercase tracking-[0.2em] mb-6" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">
                        Visão Geral
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <article class="bg-white rounded-2xl p-6 shadow-xl border border-transparent hover:border-[#D4FF00] transition-all duration-300 group cursor-pointer relative overflow-hidden">
                        <div class="flex justify-between items-start mb-4">
                            <p class="text-[14px] leading-[20px] tracking-[0.05em] text-gray-500" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Saldo disponível (Kz)</p>
                            <span class="material-symbols-outlined text-green-600 bg-green-50 rounded-full p-1 text-[20px]">check_circle</span>
                        </div>
                        <h4 class="text-[40px] leading-[48px] tracking-[-0.02em] font-bold text-black mb-2" style="font-family: Sora, ui-sans-serif, system-ui;">125.000 Kz</h4>
                        <p class="text-[12px] leading-[16px] text-gray-400" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Valor pronto para usar.</p>
                        <span class="material-symbols-outlined absolute bottom-6 right-6 text-gray-300 opacity-0 group-hover:opacity-100 transition-opacity">chevron_right</span>
                        </article>

                        <article class="bg-white rounded-2xl p-6 shadow-xl border-l-4 border-l-amber-500 hover:border-[#D4FF00] transition-all duration-300 group cursor-pointer relative overflow-hidden">
                        <div class="flex justify-between items-start mb-4">
                            <p class="text-[14px] leading-[20px] tracking-[0.05em] text-gray-500" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Saldo retido em Escrow (Kz)</p>
                            <span class="bg-amber-100 text-amber-700 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider">Em escrow</span>
                        </div>
                        <h4 class="text-[40px] leading-[48px] tracking-[-0.02em] font-bold text-black mb-2" style="font-family: Sora, ui-sans-serif, system-ui;">80.000 Kz</h4>
                        <p class="text-[12px] leading-[16px] text-gray-400" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Valores reservados em pagamentos em andamento.</p>
                        <span class="material-symbols-outlined absolute bottom-6 right-6 text-gray-300 opacity-0 group-hover:opacity-100 transition-opacity">chevron_right</span>
                        </article>

                        <article class="bg-blue-50/50 rounded-2xl p-6 shadow-xl border border-blue-100 hover:border-[#D4FF00] transition-all duration-300 group cursor-pointer relative overflow-hidden">
                        <div class="flex justify-between items-start mb-4">
                            <p class="text-[14px] leading-[20px] tracking-[0.05em] text-blue-600" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">A receber (escrow retido)</p>
                            <span class="material-symbols-outlined text-blue-500 text-[20px]">schedule</span>
                        </div>
                        <h4 class="text-[40px] leading-[48px] tracking-[-0.02em] font-bold text-black mb-2" style="font-family: Sora, ui-sans-serif, system-ui;">45.000 Kz</h4>
                        <p class="text-[12px] leading-[16px] text-blue-400/80" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Recebíveis quando o escrow for liberado.</p>
                        <span class="material-symbols-outlined absolute bottom-6 right-6 text-blue-200 opacity-0 group-hover:opacity-100 transition-opacity">chevron_right</span>
                        </article>
                    </div>
                    </section>

                    <!-- Ações & Dados Bancários -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <section>
                        <h3 class="text-[12px] leading-[16px] font-bold text-gray-600 uppercase tracking-[0.2em] mb-6" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">
                        Ações
                        </h3>
                        <div class="bg-white rounded-2xl p-6 shadow-xl flex flex-col gap-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <button data-wallet-action="carregar-saldo" class="flex items-center justify-center gap-2 bg-[#0066FF] text-white py-4 px-6 rounded-xl font-bold hover:bg-blue-700 transition-colors shadow-md">
                            <span class="material-symbols-outlined">add</span>
                            Carregar saldo
                            </button>
                            <button data-wallet-action="ver-extrato" class="flex items-center justify-center gap-2 border-2 border-[#0066FF] text-[#0066FF] py-4 px-6 rounded-xl font-bold hover:bg-blue-50 transition-colors">
                            <span class="material-symbols-outlined">list_alt</span>
                            Ver extrato
                            </button>
                        </div>

                        <button data-wallet-action="pedir-saque" class="flex items-center justify-center gap-2 border-2 border-black bg-white text-black py-4 px-6 rounded-xl font-bold hover:bg-black hover:text-white transition-all shadow-sm">
                            <span class="material-symbols-outlined">logout</span>
                            Pedir saque
                        </button>
                        </div>
                    </section>

                    <section>
                        <h3 class="text-[12px] leading-[16px] font-bold text-gray-600 uppercase tracking-[0.2em] mb-6" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">
                        Dados Bancários
                        </h3>
                        <div class="bg-white rounded-2xl p-6 shadow-xl">
                        <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                            <div class="flex justify-between items-center mb-3">
                            <span class="text-[12px] leading-[16px] font-bold text-gray-400 uppercase" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">IBAN Skilla</span>
                            <button data-wallet-action="copiar-iban" class="text-[#0066FF] text-[14px] leading-[20px] tracking-[0.05em] flex items-center gap-1 hover:underline">
                                <span class="material-symbols-outlined text-[18px]">content_copy</span>
                                Copiar
                            </button>
                            </div>
                            <p class="text-[18px] leading-[28px] text-black font-mono break-all tracking-wider">AO06 1234 5678 9012 3456 7890 1</p>
                        </div>
                        <p class="text-[12px] leading-[16px] text-gray-500 mt-4 flex items-center gap-2" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">
                            <span class="material-symbols-outlined text-[16px]">info</span>
                            Use este IBAN para transferências para a sua carteira.
                        </p>
                        </div>
                    </section>
                    </div>

                    <!-- Créditos -->
                    <section class="border-t border-black/10 pt-10">
                    <h3 class="text-[12px] leading-[16px] font-bold text-gray-600 uppercase tracking-[0.2em] mb-6" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">
                        Créditos
                    </h3>
                    <div class="bg-white rounded-2xl p-6 shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
                        <div class="flex items-center gap-6">
                        <div class="bg-black text-[#D4FF00] w-16 h-16 rounded-2xl flex items-center justify-center">
                            <span class="text-[40px] leading-[48px] font-bold" style="font-family: Sora, ui-sans-serif, system-ui;">12</span>
                        </div>
                        <div>
                            <h4 class="text-[24px] leading-[32px] font-semibold text-black" style="font-family: Sora, ui-sans-serif, system-ui;">Créditos disponíveis</h4>
                            <p class="text-[16px] leading-[24px] text-gray-500">Use créditos para candidaturas e destaques.</p>
                        </div>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                        <button data-wallet-action="comprar-creditos" class="px-8 py-3 rounded-xl border-2 border-[#0066FF] text-[#0066FF] font-bold hover:bg-blue-50 transition-colors">Comprar créditos</button>
                        <button data-wallet-action="extrato-creditos" class="px-8 py-3 rounded-xl text-gray-500 font-bold hover:bg-gray-100 transition-colors">Extrato de créditos</button>
                        </div>
                    </div>
                    </section>

                </div>
            </div>
        `;

        App.templates.carteira_comprar_creditos = `
            <div id="view-carteira-comprar-creditos" class="bg-[#D4FF00] text-[#1A1C1E] min-h-screen flex flex-col items-center">
                <main class="w-full max-w-[480px] px-4 py-8 flex flex-col gap-8 flex-grow">

                    <!-- Breadcrumb + voltar -->
                    <div class="flex items-center justify-between gap-3">
                    <div class="text-[12px] leading-[16px] text-black/70 flex items-center gap-2">
                        <a class="hover:underline" href="#carteira">Carteira</a> &gt;
                        <a class="hover:underline" href="#carteira">Minha carteira</a> &gt;
                        <span>Comprar créditos</span>
                    </div>

                    <button data-wallet-back class="flex items-center gap-2 px-4 py-2 border-2 border-black text-black rounded-xl font-bold hover:bg-black hover:text-[#D4FF00] transition-all active:scale-95 w-fit" type="button">
                        <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                        Voltar
                    </button>
                    </div>

                    <!-- Wallet Balance Card -->
                    <section class="bg-white rounded-xl p-6 border border-[#E0E2E6] shadow-sm transition-all hover:shadow-md" id="wallet-balance">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="material-symbols-outlined text-[#2F5BFF]" style="font-variation-settings: 'FILL' 1;">account_balance_wallet</span>
                        <p class="text-[14px] leading-[20px] tracking-[0.05em] text-[#5F6368] uppercase" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Saldo da carteira</p>
                    </div>
                    <p class="text-[32px] leading-[40px] tracking-[-0.02em] font-bold text-[#2F5BFF]" style="font-family: Sora, ui-sans-serif, system-ui;">125 000 Kz</p>
                    </section>

                    <!-- Credits Selection Section -->
                    <section id="package-selection">
                    <h2 class="text-[14px] leading-[20px] tracking-[0.05em] text-[#5F6368] uppercase mb-4 px-1" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Escolha um pacote</h2>

                    <div class="grid grid-cols-1 gap-4">
                        <!-- Package 1 -->
                        <label class="relative cursor-pointer group block">
                        <input class="peer hidden" name="credit_package" type="radio" value="10" data-credits="10" data-cost="5000"/>
                        <div class="package-card flex items-center justify-between p-5 bg-white rounded-[14px] border border-[#E0E2E6] peer-checked:border-[#2F5BFF] peer-checked:bg-[#EEF2FF]/30 transition-all group-hover:border-[#2F5BFF]/40 shadow-sm">
                            <div class="flex flex-col">
                            <span class="text-[24px] leading-[32px] font-semibold text-[#1A1C1E]" style="font-family: Sora, ui-sans-serif, system-ui;">10</span>
                            <span class="text-[12px] leading-[16px] text-[#5F6368] uppercase" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">créditos</span>
                            </div>
                            <div class="text-right">
                            <p class="text-[18px] leading-[28px] font-bold text-[#1A1C1E]" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">5 000 Kz</p>
                            </div>
                            <div class="radio-inner w-5 h-5 rounded-full border border-[#E0E2E6] absolute top-4 right-4 flex items-center justify-center bg-white peer-checked:border-[#2F5BFF]">
                            <div class="w-2.5 h-2.5 rounded-full bg-transparent peer-checked:bg-[#2F5BFF]"></div>
                            </div>
                        </div>
                        </label>

                        <!-- Package 2 (Selected State) -->
                        <label class="relative cursor-pointer group block">
                        <input checked class="peer hidden" name="credit_package" type="radio" value="30" data-credits="30" data-cost="12000"/>
                        <div class="package-card flex items-center justify-between p-5 bg-[#EEF2FF] border-2 border-[#2F5BFF] rounded-[14px] transition-all shadow-sm">
                            <div class="flex flex-col">
                            <div class="flex items-center gap-2">
                                <span class="text-[24px] leading-[32px] font-semibold text-[#1A1C1E]" style="font-family: Sora, ui-sans-serif, system-ui;">30</span>
                                <span class="bg-[#DCFCE7] text-[#166534] text-[10px] px-2 py-0.5 rounded-full uppercase tracking-tighter font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Melhor valor</span>
                            </div>
                            <span class="text-[12px] leading-[16px] text-[#5F6368] uppercase" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">créditos</span>
                            </div>
                            <div class="text-right">
                            <p class="text-[18px] leading-[28px] font-bold text-[#1A1C1E]" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">12 000 Kz</p>
                            </div>
                            <div class="radio-inner w-5 h-5 rounded-full border-2 border-[#2F5BFF] absolute top-4 right-4 flex items-center justify-center bg-[#2F5BFF]">
                            <div class="w-2 h-2 rounded-full bg-white"></div>
                            </div>
                        </div>
                        </label>

                        <!-- Package 3 -->
                        <label class="relative cursor-pointer group block">
                        <input class="peer hidden" name="credit_package" type="radio" value="100" data-credits="100" data-cost="35000"/>
                        <div class="package-card flex items-center justify-between p-5 bg-white rounded-[14px] border border-[#E0E2E6] peer-checked:border-[#2F5BFF] peer-checked:bg-[#EEF2FF]/30 transition-all group-hover:border-[#2F5BFF]/40 shadow-sm">
                            <div class="flex flex-col">
                            <span class="text-[24px] leading-[32px] font-semibold text-[#1A1C1E]" style="font-family: Sora, ui-sans-serif, system-ui;">100</span>
                            <span class="text-[12px] leading-[16px] text-[#5F6368] uppercase" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">créditos</span>
                            </div>
                            <div class="text-right">
                            <p class="text-[18px] leading-[28px] font-bold text-[#1A1C1E]" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">35 000 Kz</p>
                            </div>
                            <div class="radio-inner w-5 h-5 rounded-full border border-[#E0E2E6] absolute top-4 right-4 flex items-center justify-center bg-white"></div>
                        </div>
                        </label>
                    </div>
                    </section>

                    <!-- Confirmation Section -->
                    <section class="pb-8" id="confirmation">
                    <h2 class="text-[14px] leading-[20px] tracking-[0.05em] text-[#5F6368] uppercase mb-4 px-1" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Confirmação</h2>

                    <div class="bg-white rounded-xl p-6 border border-[#E0E2E6] shadow-sm flex flex-col gap-6">
                        <!-- Dynamic Message -->
                        <div class="flex gap-3 bg-[#F7F8FB] p-4 rounded-lg border-l-4 border-[#2F5BFF]">
                        <span class="material-symbols-outlined text-[#2F5BFF] text-[20px]">info</span>
                        <p class="text-[16px] leading-[24px] text-[#5F6368]" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">
                            Vai debitar <span class="text-[#1A1C1E] font-bold" id="summary-debit-msg">12 000 Kz</span> da tua carteira
                        </p>
                        </div>

                        <!-- Details Grid -->
                        <div class="flex flex-col gap-3" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">
                        <div class="flex justify-between items-center">
                            <span class="text-[#5F6368]">Pacote</span>
                            <span class="text-[#1A1C1E] font-semibold" id="summary-pkg">30 créditos</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[#5F6368]">Custo</span>
                            <span class="text-[#1A1C1E] font-semibold" id="summary-cost">12 000 Kz</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[#5F6368]">Saldo atual</span>
                            <span class="text-[#1A1C1E] font-semibold">125 000 Kz</span>
                        </div>
                        <div class="pt-3 border-t border-[#E0E2E6] flex justify-between items-center">
                            <span class="text-[#5F6368]">Saldo após compra</span>
                            <span class="text-[#2F5BFF] font-bold text-[18px] leading-[28px]" id="summary-after">113 000 Kz</span>
                        </div>
                        </div>

                        <!-- Action Button -->
                        <div class="mt-4">
                        <button class="w-full bg-[#2F5BFF] text-white text-[24px] leading-[32px] py-4 rounded-[12px] active:scale-95 transition-transform shadow-lg glow-hover-blue cursor-pointer pointer-events-auto font-semibold"
                                id="buy-button" type="button" style="font-family: Sora, ui-sans-serif, system-ui;">
                            Comprar
                        </button>
                        </div>
                    </div>
                    </section>

                </main>
            </div>
        `;

        App.templates.carteira_carregar_saldo = `
            <div id="view-carteira-carregar-saldo" class="min-h-screen bg-lime-main text-[#111827] overflow-hidden">
                <main class="flex-1 flex flex-col bg-lime-main overflow-y-auto">

                    <!-- Breadcrumb -->
                    <div class="max-w-[800px] w-full mx-auto px-4 md:px-[40px] pt-6">
                    <div class="text-[12px] leading-[16px] text-black/70 flex items-center gap-2">
                        <a class="hover:underline" href="#carteira">Carteira</a> &gt;
                        <a class="hover:underline" href="#carteira">Minha carteira</a> &gt;
                        <span>Carregar saldo</span>
                    </div>
                    </div>

                    <div class="max-w-[800px] w-full mx-auto px-4 md:px-[40px] py-12 space-y-6">

                    <!-- 1. ENTRADA DE VALOR -->
                    <section class="bg-white p-8 rounded-[24px] border border-black/5 shadow-xl shadow-black/5 volt-glow transition-all">
                        <label class="block text-gray-600 mb-4 uppercase tracking-widest text-xs font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Valor (Kz)</label>
                        <div class="relative">
                        <input class="w-full bg-[#F9FAFB] border-2 border-black/5 rounded-xl p-4 text-[24px] leading-[32px] font-bold text-[#111827] focus:border-[#2F5BFF] focus:ring-0 transition-all outline-none"
                                placeholder="0 Kz" type="text" value="2.000 Kz">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[#DC2626] flex items-center gap-1 text-[12px] leading-[16px] font-semibold">
                            <span class="material-symbols-outlined text-sm">error</span>
                            O valor mínimo é 2.000 Kz.
                        </span>
                        </div>
                    </section>

                    <!-- 2. MÉTODO DE RECARGA -->
                    <section class="bg-white p-8 rounded-[24px] border border-black/5 shadow-xl shadow-black/5">
                        <label class="block text-gray-600 mb-6 uppercase tracking-widest text-xs font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Método de Recarga</label>
                        <div class="grid grid-cols-1 gap-4">
                        <!-- Desabilitado -->
                        <div class="wallet-disabled-item flex items-center justify-between p-5 border border-gray-300 rounded-xl opacity-50 cursor-not-allowed bg-[#F9FAFB] grayscale">
                            <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-3xl text-gray-600">payments</span>
                            <div>
                                <p class="font-bold text-[#111827]">Multicaixa Express</p>
                                <p class="text-sm text-gray-600">Indisponível no momento</p>
                            </div>
                            </div>
                            <span class="material-symbols-outlined text-gray-600">lock</span>
                        </div>

                        <!-- Selecionado -->
                        <div class="flex items-center justify-between p-5 border-2 border-[#2F5BFF] rounded-xl cursor-pointer bg-white ring-4 ring-[#2F5BFF]/5">
                            <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-3xl text-[#2F5BFF]" style="font-variation-settings: 'FILL' 1;">account_balance</span>
                            <div>
                                <p class="font-bold text-[#111827]">Banco Skilla</p>
                                <p class="text-sm text-gray-600 font-medium">Transferência instantânea</p>
                            </div>
                            </div>
                            <span class="material-symbols-outlined text-[#2F5BFF] font-bold" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        </div>

                        <!-- Desabilitado -->
                        <div class="wallet-disabled-item flex items-center justify-between p-5 border border-gray-300 rounded-xl opacity-50 cursor-not-allowed bg-[#F9FAFB] grayscale">
                            <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-3xl text-gray-600">credit_card</span>
                            <div>
                                <p class="font-bold text-[#111827]">Multicaixa</p>
                                <p class="text-sm text-gray-600">Referência de pagamento</p>
                            </div>
                            </div>
                            <span class="material-symbols-outlined text-gray-600">lock</span>
                        </div>
                        </div>
                    </section>

                    <!-- 3. RESUMO DA RECARGA -->
                    <section class="bg-white p-8 rounded-[24px] border border-black/5 shadow-xl shadow-black/5 overflow-hidden relative">
                        <div class="absolute top-0 right-0 p-4 opacity-5">
                        <span class="material-symbols-outlined text-8xl text-[#111827]">receipt_long</span>
                        </div>
                        <label class="block text-gray-600 mb-6 uppercase tracking-widest text-xs font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Resumo da Recarga</label>
                        <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-black/5">
                            <span class="text-gray-600 font-medium">Valor da recarga</span>
                            <span class="font-bold text-[#111827]">2.000 Kz</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-black/5">
                            <span class="text-gray-600 font-medium">Taxa de serviço</span>
                            <span class="font-bold text-green-600">0 Kz</span>
                        </div>
                        <div class="flex justify-between items-center pt-4">
                            <span class="text-[24px] leading-[32px] font-bold text-[#111827]" style="font-family: Sora, ui-sans-serif, system-ui;">Total a pagar</span>
                            <span class="text-[24px] leading-[32px] font-extrabold text-[#2F5BFF]" style="font-family: Sora, ui-sans-serif, system-ui;">2.000 Kz</span>
                        </div>
                        </div>
                    </section>

                    <!-- Botão Primário -->
                    <div class="pt-8">
                        <button data-open-success-modal class="w-full bg-[#111827] hover:bg-black text-white font-bold py-5 rounded-[24px] text-lg shadow-xl shadow-black/20 transition-all flex items-center justify-center gap-3 active:scale-[0.98]" type="button">
                        Confirmar recarga
                        <span class="material-symbols-outlined">arrow_forward</span>
                        </button>
                    </div>
                    </div>

                    <!-- Footer -->
                    <footer class="w-full py-12 px-4 md:px-[40px] max-w-[1200px] mx-auto flex flex-col md:flex-row justify-between border-t border-black/10 mt-auto">
                    <p class="text-[12px] leading-[16px] text-gray-600 font-medium">© 2024 Skilla Global Inc.</p>
                    <div class="flex gap-6 mt-4 md:mt-0">
                        <a class="text-[12px] leading-[16px] text-gray-600 hover:text-black font-medium underline transition-all" href="#">Termos de Serviço</a>
                        <a class="text-[12px] leading-[16px] text-gray-600 hover:text-black font-medium underline transition-all" href="#">Privacidade</a>
                        <a class="text-[12px] leading-[16px] text-gray-600 hover:text-black font-medium underline transition-all" href="#">Ajuda</a>
                    </div>
                    </footer>
                </main>

                <!-- Overlay: Modal Informação -->
                <div class="fixed inset-0 z-50 items-center justify-center p-6 modal-overlay hidden" id="infoModal">
                    <div class="bg-white max-w-md w-full rounded-[24px] p-10 border border-black/5 text-center shadow-2xl animate-in fade-in zoom-in duration-300">
                    <div class="w-20 h-20 bg-[#2F5BFF]/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="material-symbols-outlined text-4xl text-[#2F5BFF]">info</span>
                    </div>
                    <h3 class="text-[24px] leading-[32px] font-bold mb-2 text-[#111827]" style="font-family: Sora, ui-sans-serif, system-ui;">Informação</h3>
                    <p class="text-gray-600 mb-8" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">
                        Esta funcionalidade de recarga via Multicaixa estará disponível em breve para todos os usuários.
                    </p>
                    <button class="w-full py-4 bg-[#F9FAFB] border border-black/5 rounded-xl font-bold hover:bg-gray-100 text-[#111827] transition-all" type="button" data-close-modal="infoModal">
                        OK
                    </button>
                    </div>
                </div>

                <!-- Overlay: Sucesso -->
                <div class="fixed inset-0 z-50 items-center justify-center p-6 modal-overlay hidden" id="successModal">
                    <div class="bg-white max-w-md w-full rounded-[24px] p-10 border border-black/5 text-center shadow-2xl animate-in fade-in zoom-in duration-300">
                    <div class="w-24 h-24 bg-green-500/10 rounded-full flex items-center justify-center mx-auto mb-8 relative">
                        <span class="material-symbols-outlined text-6xl text-green-600" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        <div class="absolute inset-0 rounded-full border-4 border-green-500 animate-ping opacity-20"></div>
                    </div>
                    <h3 class="text-[24px] leading-[32px] font-bold mb-2 text-[#111827]" style="font-family: Sora, ui-sans-serif, system-ui;">Recarga concluída</h3>
                    <p class="text-gray-600 mb-10" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">
                        Seu saldo de 2.000 Kz foi carregado com sucesso em sua conta Skilla.
                    </p>
                    <div class="space-y-4">
                        <button class="w-full py-5 bg-[#2F5BFF] text-white font-extrabold rounded-xl hover:opacity-90 transition-all flex items-center justify-center gap-2" type="button" data-success-go-extrato>
                        <span class="material-symbols-outlined">list_alt</span>
                        Ver extrato
                        </button>
                        <button class="w-full py-4 text-gray-600 font-medium hover:text-[#111827] transition-all" type="button" data-success-back-wallet>
                        Voltar para carteira
                        </button>
                    </div>
                    </div>
                </div>
            </div>
        `;

        App.templates.carteira_pedir_saque = `
            <div id="view-carteira-pedir-saque" class="bg-[#D4FF00] min-h-screen flex flex-col items-center">
            <main class="w-full max-w-[480px] px-4 py-8 space-y-6">
                <div class="text-[12px] text-black/70 flex items-center gap-2">
                <a class="hover:underline" href="#carteira">Carteira</a> &gt; <a class="hover:underline" href="#carteira">Minha carteira</a> &gt; <span>Pedir saque</span>
                </div>
                <div class="bg-white border border-black/10 rounded-xl p-6 shadow-sm">
                    <p class="text-xs uppercase text-gray-500 mb-1">Saldo disponível</p>
                    <h2 class="text-2xl font-bold text-black">125 000 Kz</h2>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-end">
                        <label class="text-xs font-bold uppercase">VALOR A SACAR</label>
                        <button data-withdraw-fill-all class="text-xs font-bold hover:underline">Tudo</button>
                    </div>
                    <input class="w-full bg-white border-2 border-black rounded-lg py-4 px-4 text-2xl font-semibold" id="withdraw-input" placeholder="0" type="number">
                </div>
                <button class="w-full bg-black text-[#D4FF00] text-[18px] py-4 rounded-xl font-bold border-2 border-black">Confirmar saque</button>
            </main>
            </div>
        `;

        App.templates.carteira_ver_extrato = `
            <div id="view-carteira-ver-extrato" class="overflow-x-hidden bg-[#D4FF00] min-h-screen">
            <main class="pt-10 pb-20 px-4 md:px-10 max-w-[1280px] mx-auto">
                <div class="flex items-center justify-between gap-4 mb-8">
                    <div class="text-[12px] text-black/70 flex items-center gap-2">
                        <a class="hover:underline" href="#carteira">Carteira</a> &gt; <a class="hover:underline" href="#carteira">Minha carteira</a> &gt; <span>Extrato</span>
                    </div>
                    <button data-wallet-back class="flex items-center gap-2 px-4 py-2 border-2 border-black rounded-xl font-bold hover:bg-black hover:text-[#D4FF00]">
                        <span class="material-symbols-outlined text-[20px]">arrow_back</span>Voltar
                    </button>
                </div>
                <h1 class="text-4xl font-bold mb-8">Extrato</h1>
                <div class="space-y-4">
                     <div class="bg-white p-6 rounded-2xl border-2 border-black flex justify-between items-center shadow-lg">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-black text-[#D4FF00] flex items-center justify-center rounded-xl font-bold">↑</div>
                            <div>
                                <p class="font-bold">Recarga de Saldo</p>
                                <p class="text-xs text-gray-500">Hoje, 14:20</p>
                            </div>
                        </div>
                        <p class="font-bold">+ 50.000 Kz</p>
                     </div>
                </div>
            </main>
            </div>
        `;

        App.templates.trabalhos = `
            <div id="view-trabalhos" class="min-h-screen relative z-10 flex flex-col pb-20">
                <header class="w-full px-4 md:px-10 pt-8 pb-6 sticky top-0 z-30 bg-[#CCFF00] border-b border-black/10">
                    <div class="max-w-[1280px] mx-auto flex gap-3 overflow-x-auto no-scrollbar scrollbar-hide">
                         <button class="px-5 py-2 rounded-full bg-black text-[#D4FF00] font-bold whitespace-nowrap">Todos</button>
                         <button class="px-5 py-2 rounded-full bg-white text-black font-medium whitespace-nowrap">Design</button>
                         <button class="px-5 py-2 rounded-full bg-white text-black font-medium whitespace-nowrap">Desenvolvimento</button>
                    </div>
                </header>
                <div class="max-w-[1280px] mx-auto w-full px-4 md:px-10 grid lg:grid-cols-4 gap-6 mt-4">
                    <aside class="col-span-1 hidden lg:block">
                        <div class="bg-white rounded-2xl p-6 shadow-xl border-2 border-black">
                             <h4 class="font-bold mb-4">Filtros</h4>
                             <label class="flex items-center gap-2 mb-2"><input type="checkbox" checked> Sênior</label>
                        </div>
                    </aside>
                    <section class="lg:col-span-3 space-y-6">
                         <article class="bg-white rounded-2xl p-8 shadow-xl border-l-8 border-l-[#FF5722] transform hover:scale-[1.01] transition-all">
                             <h3 class="text-2xl font-bold mb-2">Design de App Fintech + Dashboard Admin</h3>
                             <p class="text-gray-600 mb-6 line-clamp-2">Procuramos Product Designer Sênior para conceber de raiz...</p>
                             <div class="flex justify-between items-center pt-4 border-t">
                                 <span class="text-2xl font-bold">1.500.000 Kz</span>
                                 <button data-spa-link data-route="trabalho_detalhe" class="bg-black text-white px-6 py-2 rounded-xl font-bold">Ver job</button>
                             </div>
                         </article>
                    </section>
                </div>
            </div>
        `;

        App.templates.trabalho_detalhe = `
            <div id="view-trabalho-detalhe" class="min-h-screen bg-[#D4FF00] pb-20">
                <div class="max-w-[1280px] mx-auto p-4 md:p-8 flex flex-col gap-8">
                    <button data-spa-link data-route="trabalhos" class="flex items-center gap-2 font-bold"><span class="material-symbols-outlined">arrow_back</span>Voltar</button>
                    <div class="grid lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-2 bg-white p-8 rounded-[32px] hard-shadow space-y-6 border-2 border-black">
                            <h1 class="text-4xl font-bold">Identidade visual para empresa de logística</h1>
                            <p class="text-gray-700 leading-relaxed">Descrição detalhada do projeto aqui...</p>
                        </div>
                        <aside class="space-y-6">
                            <div class="bg-white p-8 rounded-[32px] hard-shadow border-2 border-black text-center space-y-6">
                                <p class="text-4xl font-bold">75.000 Kz</p>
                                <button onclick="App.render('proposta_modal')" class="w-full bg-[#FF7A1A] text-white py-4 rounded-xl font-bold text-xl shadow-lg">Enviar Proposta</button>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        `;

        App.templates.propostas = `
            <div id="view-propostas" class="bg-[#CCFF00] min-h-screen p-4 md:p-8">
                <h2 class="text-5xl font-extrabold text-black mb-10">Minhas Propostas</h2>
                <div class="space-y-6 max-w-4xl">
                     <div class="bg-white border-4 border-black p-8 rounded-[32px] hard-shadow flex justify-between items-center group cursor-pointer">
                        <div><h4 class="text-xl font-bold group-hover:underline">Landing Page Alta Conversão</h4><p class="text-sm text-gray-500">ID #1042 • Aceita</p></div>
                        <span class="bg-green-400 border-2 border-black px-4 py-1 rounded-full font-bold">Aceita</span>
                     </div>
                </div>
            </div>
        `;

        App.templates.mensagens = `
             <div id="view-mensagens" class="bg-[#D4FF00] min-h-screen p-4 md:p-8">
                <h2 class="text-4xl font-bold mb-8">Mensagens</h2>
                <div class="max-w-3xl space-y-2">
                     <div data-spa-link data-route="mensagens_sala" class="bg-white p-4 rounded-xl hard-shadow border-2 border-black flex items-center gap-4 cursor-pointer hover:bg-gray-50">
                        <div class="w-12 h-12 bg-black rounded-full flex items-center justify-center text-[#D4FF00] font-bold underline font-display-lg">RS</div>
                        <div class="flex-1"><h4 class="font-bold">Sala de trabalho — Logo Skilla</h4><p class="text-sm text-gray-500">Pode validar os novos rascunhos?</p></div>
                        <span class="bg-black text-[#D4FF00] text-xs font-bold px-2 py-1 rounded-full">3</span>
                     </div>
                </div>
             </div>
        `;

        App.templates.mensagens_sala = `
             <div id="view-mensagens-sala" class="h-[calc(100vh-10rem)] bg-white rounded-3xl border-4 border-black flex flex-col overflow-hidden shadow-2xl">
                <header class="p-6 border-b-4 border-black bg-gray-50 flex justify-between items-center">
                    <button data-spa-link data-route="mensagens" class="material-symbols-outlined font-bold">arrow_back</button>
                    <h4 class="font-bold">Sala de trabalho — Logo Skilla</h4>
                    <button class="bg-black text-white px-4 py-2 rounded-lg font-bold">Detalhes</button>
                </header>
                <div class="flex-1 p-6 overflow-y-auto space-y-4">
                    <div class="bg-gray-100 p-4 rounded-xl border-2 border-black self-start max-w-[70%]">Olá! Ansioso para ver as ideias.</div>
                </div>
                <footer class="p-4 border-t-4 border-black flex gap-2">
                    <input class="flex-1 border-2 border-black rounded-xl px-4 py-3" placeholder="Mensagem..." type="text">
                    <button class="bg-black text-[#D4FF00] px-6 rounded-xl"><span class="material-symbols-outlined">send</span></button>
                </footer>
             </div>
        `;

        // Funções de Apoio SPA
        function setActiveLink(route) {
            const links = document.querySelectorAll('[data-spa-link]');
            links.forEach(link => {
                const isMatch = link.dataset.route === route || (route.startsWith('carteira') && link.dataset.route === 'carteira');
                if (isMatch) {
                    link.classList.add('bg-[#CCFF00]', 'text-black-pure', 'rounded-lg', 'font-bold');
                    link.classList.remove('text-on-primary-container', 'hover:text-secondary');
                } else {
                    link.classList.remove('bg-[#CCFF00]', 'text-black-pure', 'rounded-lg', 'font-bold');
                    link.classList.add('text-on-primary-container', 'hover:text-secondary');
                }
            });
        }

        function render(route, push = true) {
            if (!App.templates[route]) route = 'inicio';
            spaView.innerHTML = App.templates[route];

            setActiveLink(route);
            if (push) history.pushState({ route }, '', `#${route}`);
            
            // Re-vincular Lógica de Eventos (Original Restorada)
            initRouteScripts(route);
        }

        function initRouteScripts(route) {
            console.log('SPA Render:', route);
            
            // Lógica Carteira
            if (route === 'carteira') {
                 spaView.querySelectorAll('[data-wallet-action]').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        const action = btn.getAttribute('data-wallet-action');
                        if (action === 'carregar-saldo') render('carteira_carregar_saldo');
                        if (action === 'ver-extrato') render('carteira_ver_extrato');
                        if (action === 'pedir-saque') render('carteira_pedir_saque');
                    });
                });
            }

            if (route === 'carteira_carregar_saldo') {
                 const modal = spaView.querySelector('#successModal');
                 spaView.querySelector('[data-open-success-modal]')?.addEventListener('click', () => {
                     modal.classList.remove('hidden');
                     modal.classList.add('flex');
                 });
                 spaView.querySelector('[data-success-back-wallet]')?.addEventListener('click', () => render('carteira'));
            }
        }

        // Navegação Global
        document.addEventListener('click', (e) => {
            const link = e.target.closest('[data-spa-link]');
            if (link) {
                e.preventDefault();
                render(link.dataset.route || link.getAttribute('data-route'));
            }
        });

        window.addEventListener('popstate', (e) => {
            if (e.state && e.state.route) render(e.state.route, false);
        });

        // Init
        document.addEventListener('DOMContentLoaded', () => {
            const initial = window.location.hash.substring(1) || 'inicio';
            render(initial);
        });

    })();
</script>
</body>
</html>