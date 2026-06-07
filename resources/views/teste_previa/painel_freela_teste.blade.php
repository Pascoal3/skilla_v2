<!DOCTYPE html>
<html lang="pt-AO">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Meta tags para dados de sistema -->
    <meta name="user-id" content="{{ auth()->id() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Skilla - Dashboard do Freelancer</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries">document.addEventListener('click', function(e) {
    const link = e.target.closest('a[data-spa-link]');
    if (!link) return;
    e.preventDefault();
    const route = link.dataset.route;
    render(route, true, { activeMenuRoute: route });
});
</script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries">document.addEventListener('click', function(e) {
    const link = e.target.closest('a[data-spa-link]');
    if (!link) return;
    e.preventDefault();
    const route = link.dataset.route;
    render(route, true, { activeMenuRoute: route });
});
</script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&family=Hanken+Grotesk:wght@400&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Hanken+Grotesk:wght@400;500&family=JetBrains+Mono:wght@500&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@100..900&family=JetBrains+Mono:wght@100..900&family=Sora:wght@100..900&display=swap" rel="stylesheet"/>
    <!-- Fontes extras (para as telas da Carteira) -->
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
    document.addEventListener('click', function(e) {
    const link = e.target.closest('a[data-spa-link]');
    if (!link) return;
    e.preventDefault();
    const route = link.dataset.route;
    render(route, true, { activeMenuRoute: route });
});
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

<script src="{{ asset('js/painel_freelancer.js') }}">

    document.addEventListener('click', function(e) {
    const link = e.target.closest('a[data-spa-link]');
    if (!link) return;
    e.preventDefault();
    const route = link.dataset.route;
    render(route, true, { activeMenuRoute: route });
});
</script>

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

        // Templates
        const templates = {
            inicio: document.getElementById('view-inicio')?.outerHTML || ''
        };

        // Delegação de eventos única
        spaView.addEventListener('click', function(e) {
            const link = e.target.closest('a[data-spa-link]');
            if (!link) return;
            e.preventDefault();
            const route = link.dataset.route;
            render(route, true, { activeMenuRoute: route });
        });

        // Define o link ativo no menu
        function setActiveLink(route) {
            const links = spaView.querySelectorAll('a[data-spa-link]');
            links.forEach(link => {
                const isActive = link.dataset.route === route;
                if (isActive) {
                    link.classList.add('bg-[#CCFF00]', 'text-black-pure', 'rounded-lg', 'font-bold');
                    link.classList.remove('text-on-primary-container', 'hover:text-secondary');
                } else {
                    link.classList.remove('bg-[#CCFF00]', 'text-black-pure', 'rounded-lg', 'font-bold');
                    link.classList.add('text-on-primary-container', 'hover:text-secondary');
                }
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
        }

        // Delegação de eventos para a sidebar (que está dentro do spaView)
        spaView.addEventListener('click', function(e) {
            // Verifica se é um link da sidebar
            const spaLink = e.target.closest('a[data-spa-link]');
            if (spaLink) {
                e.preventDefault();
                const route = spaLink.dataset.route;
                render(route, true, { activeMenuRoute: route });
            }
        });

        // ============================
        // Template: Carteira (Minha Carteira - principal)
        // ============================
        templates.carteira = `
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

        // ============================
        // Template: Carteira > Comprar créditos
        // ============================
        templates.carteira_comprar_creditos = `
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

        // ============================
        // Template: Carteira > Carregar saldo
        // ============================
        templates.carteira_carregar_saldo = `
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

        // ============================
        // Template: Carteira > Pedir saque
        // ============================
        templates.carteira_pedir_saque = `
            <div id="view-carteira-pedir-saque" class="bg-[#D4FF00] min-h-screen flex flex-col items-center">
            <main class="w-full max-w-[480px] px-4 py-8 space-y-6">

                <!-- Breadcrumb -->
                <div class="text-[12px] leading-[16px] text-black/70 flex items-center gap-2">
                <a class="hover:underline" href="#carteira">Carteira</a> &gt;
                <a class="hover:underline" href="#carteira">Minha carteira</a> &gt;
                <span>Pedir saque</span>
                </div>

                <!-- Top mini header com voltar -->
                <div class="flex items-center gap-3">
                <button data-wallet-back class="p-2 bg-white/70 hover:bg-white rounded-full transition-colors border border-black/10" type="button">
                    <span class="material-symbols-outlined text-black">arrow_back</span>
                </button>
                <h2 class="text-[24px] leading-[32px] font-semibold text-black" style="font-family: Sora, ui-sans-serif, system-ui;">Pedir saque</h2>
                </div>

                <!-- Card Saldo -->
                <div class="bg-white border border-black/10 rounded-xl p-6" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                <p class="text-[14px] leading-[20px] tracking-[0.05em] text-[#444444] uppercase mb-1" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Saldo disponível</p>
                <h2 class="text-[24px] leading-[32px] font-semibold text-black" style="font-family: Sora, ui-sans-serif, system-ui;">125 000 Kz</h2>
                </div>

                <!-- Seção Valor -->
                <div class="space-y-3">
                <div class="flex justify-between items-end">
                    <label class="text-[14px] leading-[20px] tracking-[0.05em] text-black font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">VALOR A SACAR</label>
                    <button data-withdraw-fill-all class="text-[14px] leading-[20px] tracking-[0.05em] text-black hover:underline transition-all font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;" type="button">Tudo</button>
                </div>
                <div class="relative group">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-black/60" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Kz</span>
                    <input class="w-full bg-white border-2 border-black rounded-lg py-4 pl-12 pr-4 text-[24px] leading-[32px] font-semibold text-black focus:ring-0 transition-all"
                        id="withdraw-input" placeholder="0" type="number" style="font-family: Sora, ui-sans-serif, system-ui;">
                </div>
                <p class="text-[12px] leading-[16px] text-black/70 flex items-center gap-1" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">
                    <span class="material-symbols-outlined text-[14px]">info</span>
                    Mínimo 5 000 Kz
                </p>
                </div>

                <!-- Seção IBAN -->
                <div class="space-y-3">
                <label class="text-[14px] leading-[20px] tracking-[0.05em] text-black font-bold uppercase" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">IBAN CADASTRADO</label>
                <div class="bg-white border border-black/10 rounded-xl p-4 flex flex-col gap-4" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                    <div class="flex items-start justify-between">
                    <div class="flex gap-3">
                        <span class="material-symbols-outlined text-black">account_balance</span>
                        <span class="text-[14px] leading-[20px] tracking-[0.05em] text-black break-all font-medium" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">
                        AO06 1234 5678 9012 3456 7890 1
                        </span>
                    </div>
                    </div>
                    <div class="flex gap-2">
                    <button class="flex-1 py-2 px-4 rounded border-2 border-black text-[14px] leading-[20px] tracking-[0.05em] text-black hover:bg-black/5 transition-colors font-bold"
                            style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;" type="button">Editar</button>
                    <button class="flex-1 py-2 px-4 rounded border-2 border-black text-[14px] leading-[20px] tracking-[0.05em] text-black hover:bg-black/5 transition-colors font-bold"
                            style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;" type="button">Trocar</button>
                    </div>
                </div>
                </div>

                <!-- Card Resumo -->
                <div class="bg-white border border-black/10 rounded-xl p-5 space-y-4" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                <div class="flex justify-between items-center border-b border-black/10 pb-3">
                    <span class="text-[16px] leading-[24px] text-[#444444]" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">Valor a sacar</span>
                    <span data-withdraw-summary-value class="text-[14px] leading-[20px] tracking-[0.05em] text-black font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">0 Kz</span>
                </div>
                <div class="flex justify-between items-center border-b border-black/10 pb-3">
                    <span class="text-[16px] leading-[24px] text-[#444444]" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">Taxa de serviço</span>
                    <span class="text-[14px] leading-[20px] tracking-[0.05em] text-black font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Grátis</span>
                </div>
                <div class="flex justify-between items-center pt-1">
                    <span class="text-[16px] leading-[24px] font-bold text-black" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">Total a receber</span>
                    <span data-withdraw-summary-total class="text-[24px] leading-[32px] font-semibold text-black" style="font-family: Sora, ui-sans-serif, system-ui;">0 Kz</span>
                </div>
                <div class="flex items-center justify-between bg-black/5 p-3 rounded-lg mt-2">
                    <div class="flex flex-col">
                    <span class="text-[10px] uppercase text-[#444444]" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">IBAN Destino</span>
                    <span class="text-[12px] text-black font-medium truncate max-w-[200px]" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">AO06...7890 1</span>
                    </div>
                    <button class="material-symbols-outlined text-black hover:opacity-70 transition-colors" type="button">content_copy</button>
                </div>
                </div>

                <!-- Aviso -->
                <div class="flex gap-3 bg-white border-2 border-black p-4 rounded-xl shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <span class="material-symbols-outlined text-black">warning</span>
                <p class="text-[13px] leading-relaxed text-black font-medium" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">
                    Ao confirmar, o valor será transferido para o IBAN indicado. Esta ação não pode ser desfeita.
                </p>
                </div>

                <!-- CTA -->
                <button class="w-full bg-black text-[#D4FF00] text-[18px] py-4 rounded-xl font-bold shadow-xl hover:brightness-125 active:scale-[0.98] transition-all border-2 border-black"
                        style="font-family: Sora, ui-sans-serif, system-ui;" type="button">
                Confirmar saque
                </button>

                <!-- Saques recentes -->
                <div class="pt-8 space-y-4">
                <h3 class="text-[14px] leading-[20px] tracking-[0.05em] text-black font-bold uppercase" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">SAQUES RECENTES</h3>
                <div class="space-y-2">

                    <!-- Item 1 -->
                    <div class="bg-white border border-black/10 rounded-lg p-3 flex justify-between items-center" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-black/5 flex items-center justify-center">
                        <span class="material-symbols-outlined text-black">pending</span>
                        </div>
                        <div>
                        <p class="text-[14px] leading-[20px] tracking-[0.05em] text-black font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">50 000 Kz</p>
                        <p class="text-[12px] text-[#444444]" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">12 Mar, 2024</p>
                        </div>
                    </div>
                    <span class="px-2 py-1 rounded bg-black/5 text-black text-[10px] uppercase border border-black font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Pendente</span>
                    </div>

                    <!-- Item 2 -->
                    <div class="bg-white border border-black/10 rounded-lg p-3 flex justify-between items-center" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-black/5 flex items-center justify-center text-black">
                        <span class="material-symbols-outlined">check_circle</span>
                        </div>
                        <div>
                        <p class="text-[14px] leading-[20px] tracking-[0.05em] text-black font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">25 000 Kz</p>
                        <p class="text-[12px] text-[#444444]" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">05 Mar, 2024</p>
                        </div>
                    </div>
                    <span class="px-2 py-1 rounded bg-black text-[#D4FF00] text-[10px] uppercase border border-black font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Concluído</span>
                    </div>

                </div>
                </div>
            </main>
            </div>
        `;

        // ============================
        // Template: Carteira > Ver extrato
        // ============================
        templates.carteira_ver_extrato = `
            <div id="view-carteira-ver-extrato" class="overflow-x-hidden bg-[#D4FF00] min-h-screen">
            <main class="pt-10 pb-20 px-4 md:px-10 min-h-screen">
                <div class="max-w-[1280px] mx-auto">

                <!-- Breadcrumb + voltar -->
                <div class="flex items-center justify-between gap-4 mb-8">
                    <div class="text-[12px] leading-[16px] text-black/70 flex items-center gap-2">
                    <a class="hover:underline" href="#carteira">Carteira</a> &gt;
                    <a class="hover:underline" href="#carteira">Minha carteira</a> &gt;
                    <span>Extrato</span>
                    </div>

                    <button data-wallet-back class="flex items-center gap-2 px-4 py-2 border-2 border-black text-black rounded-xl font-bold hover:bg-black hover:text-[#D4FF00] transition-all active:scale-95 w-fit" type="button">
                    <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                    Voltar
                    </button>
                </div>

                <!-- Header Section -->
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                    <div>
                    <h1 class="text-[40px] leading-[48px] tracking-[-0.02em] font-bold text-black mb-1" style="font-family: Sora, ui-sans-serif, system-ui;">Extrato</h1>
                    <p class="text-[16px] leading-[24px] text-black/70" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">Gerencie seu fluxo de caixa em Kwanzas (Kz)</p>
                    </div>
                    <button class="flex items-center gap-2 px-6 py-2 border-2 border-black text-black rounded-xl font-bold hover:bg-black hover:text-[#D4FF00] transition-all active:scale-95 w-fit" type="button">
                    <span class="material-symbols-outlined text-[20px]">file_download</span>
                    Exportar
                    </button>
                </div>

                <!-- Filters Section -->
                <section class="mb-10">
                    <div class="flex flex-wrap items-center gap-3 mb-6">
                    <button class="flex items-center gap-2 bg-white px-4 py-2 rounded-xl border-2 border-black hover:bg-black hover:text-white transition-all group" id="toggleFilters" type="button">
                        <span class="material-symbols-outlined text-black group-hover:text-[#D4FF00]">tune</span>
                        <span class="font-bold">Filtrar transações</span>
                        <span class="bg-black text-[#D4FF00] text-[10px] w-5 h-5 flex items-center justify-center rounded-full font-bold">2</span>
                    </button>

                    <div class="h-6 w-px bg-black/20 mx-2 hidden md:block"></div>

                    <span class="px-3 py-1 bg-white text-black border-2 border-black rounded-full text-[12px] leading-[16px] flex items-center gap-2 font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">
                        Últimos 30 dias <span class="material-symbols-outlined text-sm cursor-pointer">close</span>
                    </span>

                    <span class="px-3 py-1 bg-white text-black border-2 border-black rounded-full text-[12px] leading-[16px] flex items-center gap-2 font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">
                        Tipo: Recarga, Saque <span class="material-symbols-outlined text-sm cursor-pointer">close</span>
                    </span>
                    </div>

                    <!-- Collapsible Content -->
                    <div class="hidden grid grid-cols-1 md:grid-cols-3 gap-6 p-6 bg-white rounded-2xl border-2 border-black mb-8 animate-in fade-in slide-in-from-top-4 duration-300" id="filterPanel">
                    <div class="space-y-3">
                        <label class="text-[12px] leading-[16px] text-black/60 uppercase tracking-wider font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Período</label>
                        <select class="w-full bg-white border-2 border-black rounded-xl p-3 text-black focus:ring-0" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">
                        <option>Últimos 7 dias</option>
                        <option selected="">Últimos 30 dias</option>
                        <option>Último trimestre</option>
                        <option>Personalizado</option>
                        </select>
                    </div>

                    <div class="space-y-3">
                        <label class="text-[12px] leading-[16px] text-black/60 uppercase tracking-wider font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Tipo de Transação</label>
                        <div class="flex flex-wrap gap-2">
                        <label class="cursor-pointer">
                            <input checked="" class="hidden peer" type="checkbox">
                            <span class="px-4 py-2 rounded-lg border-2 border-black bg-white peer-checked:bg-black peer-checked:text-[#D4FF00] text-[12px] leading-[16px] font-bold transition-all block" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Recarga</span>
                        </label>
                        <label class="cursor-pointer">
                            <input checked="" class="hidden peer" type="checkbox">
                            <span class="px-4 py-2 rounded-lg border-2 border-black bg-white peer-checked:bg-black peer-checked:text-[#D4FF00] text-[12px] leading-[16px] font-bold transition-all block" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Saque</span>
                        </label>
                        <label class="cursor-pointer">
                            <input class="hidden peer" type="checkbox">
                            <span class="px-4 py-2 rounded-lg border-2 border-black bg-white peer-checked:bg-black peer-checked:text-[#D4FF00] text-[12px] leading-[16px] font-bold transition-all block" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Pagamento</span>
                        </label>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="text-[12px] leading-[16px] text-black/60 uppercase tracking-wider font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Status</label>
                        <select class="w-full bg-white border-2 border-black rounded-xl p-3 text-black focus:ring-0" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">
                        <option>Todos os status</option>
                        <option selected="">Concluído</option>
                        <option>Pendente</option>
                        <option>Cancelado</option>
                        </select>
                    </div>
                    </div>
                </section>

                <!-- Transactions List -->
                <div class="space-y-10">
                    <!-- Group: Hoje -->
                    <div>
                    <h3 class="text-[14px] leading-[20px] tracking-[0.1em] uppercase font-bold text-black mb-4 px-2" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Hoje</h3>
                    <div class="space-y-3">

                        <!-- Transaction Card 1 -->
                        <div data-tx-card data-tx-id="TX4928310" class="group cursor-pointer flex items-center justify-between p-4 bg-white border-2 border-black rounded-2xl hover:bg-black hover:border-black transition-all glow-hover">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-black flex items-center justify-center text-[#D4FF00] group-hover:bg-[#D4FF00] group-hover:text-black">
                            <span class="material-symbols-outlined text-[28px]">arrow_upward</span>
                            </div>
                            <div>
                            <p class="text-[16px] leading-[24px] font-semibold text-black group-hover:text-white" style="font-family: Sora, ui-sans-serif, system-ui;">Recarga de Saldo</p>
                            <p class="text-[12px] leading-[16px] text-black/60 group-hover:text-white/60" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">Depósito via Multicaixa Express • 14:20</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-[16px] leading-[24px] text-black font-bold group-hover:text-[#D4FF00]" style="font-family: Sora, ui-sans-serif, system-ui;">+ 50.000,00 Kz</p>
                            <span class="inline-flex items-center gap-1.5 text-[10px] text-black px-2 py-0.5 rounded-full bg-[#D4FF00] border border-black group-hover:border-[#D4FF00] group-hover:bg-white/10 group-hover:text-[#D4FF00] font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">
                            <span class="w-1.5 h-1.5 rounded-full bg-black group-hover:bg-[#D4FF00]"></span> CONCLUÍDO
                            </span>
                        </div>
                        </div>

                        <!-- Transaction Card 2 -->
                        <div class="group cursor-pointer flex items-center justify-between p-4 bg-white border-2 border-black rounded-2xl hover:bg-black transition-all glow-hover">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center text-red-600 group-hover:bg-red-600 group-hover:text-white">
                            <span class="material-symbols-outlined text-[28px]">arrow_downward</span>
                            </div>
                            <div>
                            <p class="text-[16px] leading-[24px] font-semibold text-black group-hover:text-white" style="font-family: Sora, ui-sans-serif, system-ui;">Saque Bancário</p>
                            <p class="text-[12px] leading-[16px] text-black/60 group-hover:text-white/60" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">Transferência para BFA • 09:45</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-[16px] leading-[24px] text-black font-bold group-hover:text-white" style="font-family: Sora, ui-sans-serif, system-ui;">- 125.000,00 Kz</p>
                            <span class="inline-flex items-center gap-1.5 text-[10px] text-black px-2 py-0.5 rounded-full bg-[#D4FF00] border border-black group-hover:border-[#D4FF00] group-hover:bg-white/10 group-hover:text-[#D4FF00] font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">
                            <span class="w-1.5 h-1.5 rounded-full bg-black group-hover:bg-[#D4FF00]"></span> CONCLUÍDO
                            </span>
                        </div>
                        </div>

                    </div>
                    </div>

                    <!-- Group: Ontem -->
                    <div>
                    <h3 class="text-[14px] leading-[20px] tracking-[0.1em] uppercase font-bold text-black mb-4 px-2" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Ontem</h3>
                    <div class="space-y-3">

                        <!-- Pending Transaction -->
                        <div class="group cursor-pointer flex items-center justify-between p-4 bg-white/70 border-2 border-black/10 rounded-2xl hover:bg-black hover:border-black transition-all">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-gray-200 flex items-center justify-center text-gray-500 group-hover:bg-white/20 group-hover:text-white">
                            <span class="material-symbols-outlined text-[28px]">schedule</span>
                            </div>
                            <div>
                            <p class="text-[16px] leading-[24px] font-semibold text-black/60 group-hover:text-white" style="font-family: Sora, ui-sans-serif, system-ui;">Pagamento de Projeto</p>
                            <p class="text-[12px] leading-[16px] text-black/40 group-hover:text-white/60" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">UI Design Kit Pro • 18:30</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-[16px] leading-[24px] text-black/60 font-bold group-hover:text-white" style="font-family: Sora, ui-sans-serif, system-ui;">+ 210.000,00 Kz</p>
                            <span class="inline-flex items-center gap-1.5 text-[10px] text-black/60 px-2 py-0.5 rounded-full bg-gray-100 border border-black/10 group-hover:bg-white/10 group-hover:text-white group-hover:border-white/20 font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">
                            <span class="w-1.5 h-1.5 rounded-full bg-gray-400 animate-pulse group-hover:bg-white"></span> PENDENTE
                            </span>
                        </div>
                        </div>

                        <!-- Card 4 -->
                        <div class="group cursor-pointer flex items-center justify-between p-4 bg-white border-2 border-black rounded-2xl hover:bg-black transition-all glow-hover">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center text-red-600 group-hover:bg-red-600 group-hover:text-white">
                            <span class="material-symbols-outlined text-[28px]">arrow_downward</span>
                            </div>
                            <div>
                            <p class="text-[16px] leading-[24px] font-semibold text-black group-hover:text-white" style="font-family: Sora, ui-sans-serif, system-ui;">Assinatura Mensal</p>
                            <p class="text-[12px] leading-[16px] text-black/60 group-hover:text-white/60" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">Plano Skilla Pro • 12:00</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-[16px] leading-[24px] text-black font-bold group-hover:text-white" style="font-family: Sora, ui-sans-serif, system-ui;">- 5.500,00 Kz</p>
                            <span class="inline-flex items-center gap-1.5 text-[10px] text-black px-2 py-0.5 rounded-full bg-[#D4FF00] border border-black group-hover:border-[#D4FF00] group-hover:bg-white/10 group-hover:text-[#D4FF00] font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">
                            <span class="w-1.5 h-1.5 rounded-full bg-black group-hover:bg-[#D4FF00]"></span> CONCLUÍDO
                            </span>
                        </div>
                        </div>

                    </div>
                    </div>
                </div>

                </div>
            </main>

            <!-- Modal: Transaction Details -->
            <div class="fixed inset-0 z-[100] bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity duration-300 pointer-events-none opacity-0" id="modalOverlay">
                <div class="bg-white border-4 border-black w-full max-w-md rounded-3xl p-8 transform translate-y-8 transition-transform duration-300" id="modalContent">
                <div class="flex justify-between items-start mb-6">
                    <div>
                    <h2 class="text-[24px] leading-[32px] font-semibold text-black" style="font-family: Sora, ui-sans-serif, system-ui;">Detalhes</h2>
                    <p class="text-[12px] leading-[16px] text-black/60 font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Referência: <span data-modal-ref>TX123456789</span></p>
                    </div>
                    <button class="material-symbols-outlined text-black p-2 hover:bg-[#D4FF00] rounded-full transition-colors" type="button" data-close-extrato-modal>close</button>
                </div>

                <div class="space-y-6">
                    <div class="flex flex-col items-center py-6 border-y-2 border-black/10">
                    <p class="text-[12px] leading-[16px] text-black/60 mb-1 uppercase font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Valor da Transação</p>
                    <p class="text-[32px] font-black text-black" style="font-family: Sora, ui-sans-serif, system-ui;">+ 50.000,00 Kz</p>
                    <span class="mt-2 inline-flex items-center gap-1.5 text-black px-3 py-1 rounded-full bg-[#D4FF00] border-2 border-black font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">
                        <span class="w-2 h-2 rounded-full bg-black"></span> Concluído
                    </span>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                    <div class="flex justify-between items-center">
                        <span class="text-black/60" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">Origem</span>
                        <span class="text-black font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Cartão de Débito (**** 4291)</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-black/60" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">Destino</span>
                        <span class="text-black font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Conta Principal Skilla</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-black/60" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">Data e Hora</span>
                        <span class="text-black font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">24 Out 2023, 14:20</span>
                    </div>
                    <div class="pt-4 mt-2 border-t-2 border-black/10">
                        <p class="text-[12px] leading-[16px] text-black/60 mb-2 font-bold" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Descrição Completa</p>
                        <p class="text-black" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">Recarga de carteira efetuada via aplicativo Multicaixa Express. Processado via rede EMIS com sucesso.</p>
                    </div>
                    </div>

                    <div class="flex gap-3 pt-4">
                    <button class="flex-1 bg-white border-2 border-black text-black py-3 rounded-xl font-bold hover:bg-gray-100 transition-all flex items-center justify-center gap-2" type="button" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">
                        <span class="material-symbols-outlined text-[20px]">content_copy</span>
                        ID
                    </button>
                    <button class="flex-1 bg-black text-[#D4FF00] py-3 rounded-xl font-bold hover:scale-[1.02] transition-transform active:scale-95 flex items-center justify-center gap-2" type="button" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">
                        <span class="material-symbols-outlined text-[20px]">share</span>
                        Recibo
                    </button>
                    </div>
                </div>
                </div>
            </div>
            </div>
        `;

        // Template: Feed de Trabalhos
        templates.trabalhos = `
            <div id="view-trabalhos" class="min-h-screen relative z-10 flex flex-col pb-20">
                <header class="w-full px-4 md:px-10 pt-8 pb-6 sticky top-0 md:top-0 z-30 bg-[#CCFF00] shadow-sm">
                    <div class="max-w-[1280px] mx-auto">
                        
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
                            <p class="text-[16px] leading-[24px] font-medium text-black"><span class="font-bold">2</span> projetos encontrados</p>
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

        // ===== TEMPLATE: TRABALHO DETALHE + MODAL ENVIAR PROPOSTA (com a estilização original) =====
        templates.trabalho_detalhe = `
            <div id="view-trabalho-detalhe" class="min-h-screen bg-[#D4FF00]">
                <div class="p-6 md:p-8 space-y-8 max-w-[1280px] mx-auto w-full pb-20">
                <div class="flex flex-col gap-2">
                    <div class="font-label-sm text-label-sm text-black opacity-70 flex items-center gap-2">
                    <a class="hover:underline" href="#">Início</a> &gt;
                    <a class="hover:underline" href="#">Trabalhos</a> &gt;
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
                    <div class="sticky top-24 flex flex-col gap-6">

                        <!-- Card de Ação / Enviar Proposta -->
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
                            <button
                            type="button"
                            data-open-proposta-modal
                            class="w-full bg-[#FF7A1A] text-white py-4 rounded-xl font-label-md font-bold hover:bg-[#E66912] transition-colors shadow-md text-lg flex justify-center items-center"
                            >
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

                    </div>
                    </div>
                </div>
                </div>

                <!-- MODAL: Enviar Proposta (NÃO corta conteúdo; só fica hidden/mostra) -->
                <div class="fixed inset-0 z-[60] bg-obsidian/80 backdrop-blur-md hidden items-center justify-center p-4"
                    id="modal-overlay"
                    aria-hidden="true">
                <div class="bg-white text-obsidian w-full max-w-2xl rounded-2xl border-[2px] border-obsidian high-contrast-shadow overflow-hidden transform transition-all duration-300 scale-100 opacity-100"
                    id="modal-content"
                    role="dialog"
                    aria-modal="true">

                    <div class="px-8 pt-8 pb-4 flex justify-between items-start">
                    <div>
                        <h2 class="font-headline-md text-headline-md text-obsidian mb-1">Enviar Proposta</h2>
                        <p class="font-body-md text-obsidian/60">Preencha os detalhes para concorrer a este trabalho.</p>
                    </div>

                    <button class="p-2 hover:bg-obsidian/5 rounded-full transition-colors group"
                            type="button"
                            data-close-proposta-modal
                            aria-label="Fechar">
                        <span class="material-symbols-outlined text-obsidian text-2xl group-hover:rotate-90 transition-transform duration-200">close</span>
                    </button>
                    </div>

                    <form id="proposta-form" class="px-8 py-4 space-y-6">
                    <div class="space-y-2">
                        <label class="block font-label-md text-label-md uppercase tracking-wider text-obsidian">Carta de apresentação</label>
                        <div class="relative">
                        <textarea class="w-full bg-obsidian/5 border-2 border-obsidian rounded-xl p-4 font-body-md text-obsidian placeholder:text-obsidian/40 resize-none transition-all"
                                    id="cover-letter"
                                    maxlength="2000"
                                    placeholder="Escreva uma breve apresentação..."
                                    rows="5"></textarea>
                        <div class="absolute bottom-3 right-4 font-label-sm text-label-sm text-obsidian/40" id="char-counter">0/2000</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                        <label class="block font-label-md text-label-md uppercase tracking-wider text-obsidian">Valor proposto (Kz)</label>
                        <div class="relative">
                            <input class="w-full bg-obsidian/5 border-2 border-obsidian rounded-xl p-4 font-body-md text-obsidian placeholder:text-obsidian/40 transition-all pr-12"
                                id="proposta-valor"
                                placeholder="Ex.: 150000"
                                type="number"
                                min="0"
                                required />
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 font-label-md text-obsidian/40">Kz</span>
                        </div>
                        </div>

                        <div class="space-y-2">
                        <label class="block font-label-md text-label-md uppercase tracking-wider text-obsidian">Dias de entrega</label>
                        <div class="relative">
                            <input class="w-full bg-obsidian/5 border-2 border-obsidian rounded-xl p-4 font-body-md text-obsidian placeholder:text-obsidian/40 transition-all"
                                id="proposta-dias"
                                placeholder="Ex.: 7"
                                type="number"
                                min="1"
                                required />
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 font-label-md text-obsidian/40">Dias</span>
                        </div>
                        </div>
                    </div>
                    </form>

                    <div class="px-8 pb-8 pt-4 flex flex-col sm:flex-row-reverse items-center justify-between gap-6">
                    <button class="w-full sm:w-auto bg-obsidian text-volt-lime font-headline-md text-label-md px-8 py-4 rounded-full hover:scale-105 active:scale-95 transition-all shadow-[0px_4px_20px_rgba(212,255,0,0.15)] flex items-center justify-center gap-2"
                            type="submit"
                            form="proposta-form">
                        <span>Enviar Proposta</span>
                        <span class="text-[10px] opacity-80 font-label-sm bg-volt-lime/20 px-2 py-0.5 rounded-full">(gasta 1 crédito)</span>
                    </button>

                    <a class="text-obsidian font-label-md border-b-2 border-transparent hover:border-obsidian transition-all py-1"
                        href="#"
                        data-close-proposta-modal>
                        Cancelar
                    </a>
                    </div>

                </div>
                </div>
            </div>
        `;


        // ============================
        // Template: Carteira > Extrato de créditos
        // ============================
        templates.carteira_extrato_creditos = `
            <div id="view-carteira-extrato-creditos" class="flex min-h-screen bg-[#D4FF00] text-black">
            <main class="flex-1 pb-24 md:pb-8">
                <div class="mt-10 max-w-[640px] mx-auto px-4 md:px-0">

                <!-- Breadcrumb + voltar -->
                <div class="flex items-center justify-between gap-3 mb-8">
                    <div class="text-[12px] leading-[16px] text-black/70 flex items-center gap-2">
                    <a class="hover:underline" href="#carteira">Carteira</a> &gt;
                    <a class="hover:underline" href="#carteira">Minha carteira</a> &gt;
                    <span>Extrato de créditos</span>
                    </div>

                
                </div>

                <!-- Balance Card -->
                <section class="mb-8">
                    <div class="bg-white border border-black/10 rounded-2xl p-8 relative overflow-hidden group hover:border-black/30 transition-all duration-300 shadow-sm">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-[#D4FF00]/20 blur-[60px]"></div>

                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-black/5 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-[#F59E0B]" style="font-variation-settings: 'FILL' 1;">stars</span>
                        </div>
                        <h3 class="text-[16px] leading-[24px] text-gray-600" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">Créditos disponíveis</h3>
                    </div>

                    <div class="flex items-baseline gap-2">
                        <span class="text-[56px] font-bold text-black leading-none" style="font-family: Sora, ui-sans-serif, system-ui;">30</span>
                        <span class="text-[18px] leading-[28px] text-gray-600" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">créditos</span>
                    </div>

                    <div class="mt-6 flex gap-3">
                        <button data-go-add-creditos class="flex-1 py-3 bg-black text-[#D4FF00] text-[14px] leading-[20px] font-bold rounded-lg hover:opacity-90 active:scale-95 transition-all"
                                style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;" type="button">
                        Adicionar créditos
                        </button>

                        <button class="px-4 py-3 border border-gray-300 text-black text-[14px] leading-[20px] rounded-lg hover:bg-gray-100 transition-all"
                                style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;" type="button">
                        Como funciona?
                        </button>
                    </div>
                    </div>
                </section>

                <!-- Filters Section -->
                <section class="mb-8 space-y-4">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="relative inline-block w-full md:w-auto">
                        <select class="appearance-none w-full md:w-56 bg-white border border-gray-300 text-black text-[14px] leading-[20px] px-4 py-2.5 rounded-xl focus:ring-1 focus:ring-black outline-none cursor-pointer"
                                style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">
                        <option>Últimos 30 dias</option>
                        <option>Últimos 7 dias</option>
                        <option>Mês atual</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-2.5 text-gray-600 pointer-events-none">expand_more</span>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <button class="px-4 py-2 rounded-full border border-emerald-500/30 bg-emerald-500/10 text-emerald-600 text-[12px] leading-[16px] font-bold flex items-center gap-2 hover:bg-emerald-500/20 transition-all"
                                style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;" type="button">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        Compra
                        </button>

                        <button class="px-4 py-2 rounded-full border border-blue-500/30 bg-blue-500/10 text-blue-600 text-[12px] leading-[16px] font-bold flex items-center gap-2 hover:bg-blue-500/20 transition-all"
                                style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;" type="button">
                        <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                        Proposta
                        </button>

                        <button class="px-4 py-2 rounded-full border border-amber-500/30 bg-amber-500/10 text-amber-600 text-[12px] leading-[16px] font-bold flex items-center gap-2 hover:bg-amber-500/20 transition-all"
                                style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;" type="button">
                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                        Destaque
                        </button>
                    </div>
                    </div>
                </section>

                <!-- Transaction List -->
                <section class="space-y-6">
                    <!-- Group: Hoje -->
                    <div>
                    <h4 class="text-[14px] leading-[20px] text-gray-600 px-2 mb-3" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Hoje</h4>
                    <div class="space-y-3">
                        <!-- Transaction Item: Outflow -->
                        <div data-credit-item class="bg-white border border-black/10 p-4 rounded-xl flex items-center justify-between hover:border-black/30 transition-all group cursor-pointer shadow-sm">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-600">
                            <span class="material-symbols-outlined">send</span>
                            </div>
                            <div>
                            <h5 class="text-[16px] leading-[24px] font-bold text-black" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">Proposta #54321</h5>
                            <p class="text-[12px] leading-[16px] text-gray-600" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Hoje, 10:15 • Proposta enviada</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-[16px] leading-[24px] font-bold text-[#DC2626]" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">- 2</span>
                            <p class="text-[12px] leading-[16px] text-gray-600" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Saldo: 20</p>
                        </div>
                        </div>

                        <!-- Transaction Item: Highlight -->
                        <div data-credit-item class="bg-white border border-black/10 p-4 rounded-xl flex items-center justify-between hover:border-black/30 transition-all group cursor-pointer shadow-sm">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-amber-500/10 flex items-center justify-center text-amber-600">
                            <span class="material-symbols-outlined">bolt</span>
                            </div>
                            <div>
                            <h5 class="text-[16px] leading-[24px] font-bold text-black" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">Upgrade: Destaque Topo</h5>
                            <p class="text-[12px] leading-[16px] text-gray-600" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Hoje, 08:30 • Projeto: App Delivery</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-[16px] leading-[24px] font-bold text-[#DC2626]" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">- 5</span>
                            <p class="text-[12px] leading-[16px] text-gray-600" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Saldo: 22</p>
                        </div>
                        </div>
                    </div>
                    </div>

                    <!-- Group: Ontem -->
                    <div>
                    <h4 class="text-[14px] leading-[20px] text-gray-600 px-2 mb-3" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Ontem</h4>
                    <div class="space-y-3">
                        <!-- Transaction Item: Inflow -->
                        <div data-credit-item class="bg-white border border-black/10 p-4 rounded-xl flex items-center justify-between hover:border-black/30 transition-all group cursor-pointer shadow-sm">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-emerald-500/10 flex items-center justify-center text-emerald-600">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            </div>
                            <div>
                            <h5 class="text-[16px] leading-[24px] font-bold text-black" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">Compra de pacote — 10 créditos</h5>
                            <p class="text-[12px] leading-[16px] text-gray-600" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">15 Jan, 14:32 • Cartão de crédito</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-[16px] leading-[24px] font-bold text-[#16A34A]" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">+ 10</span>
                            <p class="text-[12px] leading-[16px] text-gray-600" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Saldo: 30</p>
                        </div>
                        </div>

                        <!-- Transaction Item: System Bonus -->
                        <div data-credit-item class="bg-white border border-black/10 p-4 rounded-xl flex items-center justify-between hover:border-black/30 transition-all group cursor-pointer opacity-80 shadow-sm">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-black/10 flex items-center justify-center text-black">
                            <span class="material-symbols-outlined">redeem</span>
                            </div>
                            <div>
                            <h5 class="text-[16px] leading-[24px] font-bold text-black" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">Bônus de Indicação</h5>
                            <p class="text-[12px] leading-[16px] text-gray-600" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">15 Jan, 11:00 • Programa Skilla+</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-[16px] leading-[24px] font-bold text-[#16A34A]" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">+ 2</span>
                            <p class="text-[12px] leading-[16px] text-gray-600" style="font-family: JetBrains Mono, ui-monospace, SFMono-Regular;">Saldo: 20</p>
                        </div>
                        </div>
                    </div>
                    </div>
                </section>

                <!-- Bottom Illustration / CTA -->
                <section class="mt-12 py-10 text-center border-t border-black/10">
                    <p class="text-[16px] leading-[24px] text-gray-600 mb-6" style="font-family: Hanken Grotesk, ui-sans-serif, system-ui;">
                    Precisa de mais visibilidade? Use seus créditos para destacar seu perfil.
                    </p>
                </section>

                </div>
            </main>
            </div>
        `;

        templates.mensagens = `
            <div id="view-mensagens" class="flex min-h-screen bg-[#D4FF00]">
                <style>
                #view-mensagens{
                    --primary-container: #D4FF00;
                    --tertiary: #FFFFFF;
                    --on-tertiary: #101010;

                    --surface-container-lowest: #101010;
                    --surface-container: rgba(16,16,16,.70);
                    --surface-variant: rgba(16,16,16,.55);

                    --secondary: #E9E9E9;
                    --secondary-container: #E9E9E9;
                    --on-secondary-container: #101010;
                    --on-primary-container: #101010;
                }

                #view-mensagens .bg-tertiary{ background: var(--tertiary) !important; }
                #view-mensagens .text-on-tertiary{ color: var(--on-tertiary) !important; }

                #view-mensagens .text-surface-container-lowest{ color: var(--surface-container-lowest) !important; }
                #view-mensagens .text-surface-container{ color: var(--surface-container) !important; }
                #view-mensagens .text-surface-variant{ color: var(--surface-variant) !important; }

                #view-mensagens .bg-surface-container-lowest{ background: var(--surface-container-lowest) !important; }
                #view-mensagens .text-primary-container{ color: var(--primary-container) !important; }

                #view-mensagens .bg-secondary{ background: var(--secondary) !important; }
                #view-mensagens .bg-secondary-container{ background: var(--secondary-container) !important; }
                #view-mensagens .text-on-secondary-container{ color: var(--on-secondary-container) !important; }
                #view-mensagens .text-on-primary-container{ color: var(--on-primary-container) !important; }

                #view-mensagens input.bg-tertiary{
                    background: var(--tertiary) !important;
                    color: var(--on-tertiary) !important;
                }
                </style>

                <div class="max-w-4xl mx-auto w-full px-margin-mobile md:px-margin-desktop pb-10">

                <!-- Header Section -->
                <div class="flex justify-between items-end mb-6">
                    <div>
                    <h2 class="text-headline-lg font-headline-lg text-surface-container-lowest tracking-tight mb-1">Mensagens</h2>
                    <p class="text-body-md font-body-md text-surface-container">Salas de trabalho vinculadas a contratos</p>
                    </div>
                    <div class="flex gap-3">
                    <button class="bg-surface-container-lowest text-primary-container p-2 rounded-lg flex items-center justify-center hover:bg-surface-container transition-colors">
                        <span class="material-symbols-outlined text-[20px]">more_horiz</span>
                    </button>
                    </div>
                </div>

                <!-- Search Input -->
                <div class="mb-6 relative group">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-surface-variant group-focus-within:text-surface-container-lowest transition-colors">search</span>
                    <input
                    class="w-full bg-tertiary text-on-tertiary border border-transparent focus:border-surface-container-lowest rounded-xl py-3 pl-12 pr-4 text-body-md font-body-md shadow-sm outline-none transition-all placeholder:text-surface-variant"
                    placeholder="Pesquisar conversas"
                    type="text"
                    />
                </div>

                <!-- Inbox List -->
                <div class="flex flex-col gap-2">

                    <!-- Unread Item 1 -->
                    <div data-open-chat class="bg-tertiary rounded-xl px-3 py-3 flex items-center gap-3 cursor-pointer hover:shadow-md transition-all border border-transparent hover:border-surface-container-lowest group relative overflow-hidden">
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-surface-container-lowest"></div>
                    <img class="w-10 h-10 rounded-full object-cover bg-secondary"
                        alt="Avatar"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuB8IpAPjEGC61SjgTvvLluR4_zqfrAtVfAG1nLoA4Zfx42cFBApbVfnCNatWg3ZgQ0Jy8EishspWdM6L54qGXtImKfZ4cAZgqNARagAMjsXuDzjs5s0UknIkMd8YEcZitS42-zQT0iImQOmju6A4mMNUhZxtlKyVqIeamyLUd4xbTGqpD0JfTOLgJkG8RytvVO78wDhUJ2DQZRZFdKCi8T25VinDqtC4RvyqDfOm2dKaKtGUraovX8BShqlw66lqyfhBMTq7PA27tw"/>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-body-md font-body-lg font-bold text-on-tertiary truncate">Sala de trabalho — Logo Skilla</h3>
                        <p class="text-body-sm font-body-md text-surface-variant truncate font-semibold">Enviei as primeiras opções do logotipo. Pode validar?</p>
                    </div>
                    <div class="flex flex-col items-end gap-1 shrink-0">
                        <span class="text-label-sm font-label-sm text-surface-container-lowest font-bold">12:45</span>
                        <span class="bg-surface-container-lowest text-primary-container text-label-sm font-label-sm rounded-full px-2 py-0.5 min-w-[22px] text-center">3</span>
                    </div>
                    </div>

                    <!-- Unread Item 2 -->
                    <div data-open-chat class="bg-tertiary rounded-xl px-3 py-3 flex items-center gap-3 cursor-pointer hover:shadow-md transition-all border border-transparent hover:border-surface-container-lowest group relative overflow-hidden">
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-surface-container-lowest"></div>
                    <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container shrink-0">
                        <span class="material-symbols-outlined text-[20px]">storefront</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-body-md font-body-lg font-bold text-on-tertiary truncate">Website para Restaurante</h3>
                        <p class="text-body-sm font-body-md text-surface-variant truncate font-semibold">Os arquivos do Figma foram atualizados com as novas fotos.</p>
                    </div>
                    <div class="flex flex-col items-end gap-1 shrink-0">
                        <span class="text-label-sm font-label-sm text-surface-container-lowest font-bold">09:30</span>
                        <span class="bg-surface-container-lowest text-primary-container text-label-sm font-label-sm rounded-full px-2 py-0.5 min-w-[22px] text-center">1</span>
                    </div>
                    </div>

                    <!-- Read Item 1 -->
                    <div data-open-chat class="bg-tertiary rounded-xl px-3 py-3 flex items-center gap-3 cursor-pointer hover:shadow-md transition-all border border-transparent hover:border-surface-container-lowest group">
                    <img class="w-10 h-10 rounded-full object-cover bg-secondary"
                        alt="Avatar"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuD9p5NtQ7f1wLUB5hoOGxrkk54JWkNOfzMOuEnGvgLaR7mdRj6Gb1K6xhI5rUri7CGqnrkPi8fS2eqGVhRGW5BLPQcBFh7VLnFGgK_w3_I78Tf_Qrk63_0Kz-MQMDu1XDzIUn32k7tsQuVVbKOBj9lDaI0bq3uQnk5MzDQYDFEVAtRCgfiolFx9NZPS7kATHEoODg-qEOBcyRhgX4vjp9VLNnFcSHuZL4cF77YCcaNMW_Bq-QbYaTbaCtUjBhkfpq6qPzAMoRLgo5M"/>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-body-md font-body-lg text-on-tertiary truncate">Identidade Visual Barber Shop</h3>
                        <p class="text-body-sm font-body-md text-surface-variant truncate">Tudo certo. O pagamento da primeira parcela foi liberado.</p>
                    </div>
                    <div class="flex flex-col items-end gap-1 shrink-0">
                        <span class="text-label-sm font-label-sm text-surface-variant">Ontem</span>
                    </div>
                    </div>

                    <!-- Read Item 2 -->
                    <div data-open-chat class="bg-tertiary rounded-xl px-3 py-3 flex items-center gap-3 cursor-pointer hover:shadow-md transition-all border border-transparent hover:border-surface-container-lowest group">
                    <div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container shrink-0">
                        <span class="material-symbols-outlined text-[20px]">smartphone</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-body-md font-body-lg text-on-tertiary truncate">Landing Page para App</h3>
                        <p class="text-body-sm font-body-md text-surface-variant truncate">Perfeito, aguardo os próximos passos.</p>
                    </div>
                    <div class="flex flex-col items-end gap-1 shrink-0">
                        <span class="text-label-sm font-label-sm text-surface-variant">Segunda</span>
                    </div>
                    </div>

                    <!-- Read Item 3 -->
                    <div data-open-chat class="bg-tertiary rounded-xl px-3 py-3 flex items-center gap-3 cursor-pointer hover:shadow-md transition-all border border-transparent hover:border-surface-container-lowest group">
                    <div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container shrink-0">
                        <span class="material-symbols-outlined text-[20px]">shopping_cart</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-body-md font-body-lg text-on-tertiary truncate">E-commerce Simples</h3>
                        <p class="text-body-sm font-body-md text-surface-variant truncate">Projeto finalizado e arquivado.</p>
                    </div>
                    <div class="flex flex-col items-end gap-1 shrink-0">
                        <span class="text-label-sm font-label-sm text-surface-variant">12 Mar</span>
                    </div>
                    </div>

                </div>
                </div>
            </div>
        `;

        templates.mensagens_sala = `
            <div id="view-mensagens-sala" class="flex min-h-screen bg-[#D4FF00]">
                                <!-- Mobile TopAppBar (hidden on md) -->
                        <header class="md:hidden fixed top-0 w-full z-50 bg-white border-b border-gray-200 flex justify-between items-center h-16 px-margin-mobile">
                        <div class="font-display-lg text-headline-md font-black text-primary-fixed">Skilla</div>
                        <div class="flex gap-4">
                            <span class="material-symbols-outlined text-black">info</span>
                            <span class="material-symbols-outlined text-black">more_vert</span>
                        </div>
                        </header>

                        <!-- Main Content Area -->
                        <main class="flex-1 w-full min-h-screen flex flex-col bg-[#D4FF00] relative pt-16 md:pt-0 pb-[72px] lg:pb-0 overflow-hidden">

                        <!-- Voltar -->
                        <div class="px-margin-mobile md:px-gutter pt-4">
                            <button data-back-to-inbox class="inline-flex items-center gap-2 font-label-md text-label-md text-black font-bold hover:opacity-70">
                            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                            Voltar às mensagens
                            </button>
                        </div>

                        <!-- Chat Header -->
                        <div class="bg-white border-b border-gray-200 px-margin-mobile md:px-gutter py-4 flex justify-between items-center shrink-0 shadow-sm z-20 rounded-b-xl lg:rounded-none">
                            <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-primary-fixed hidden sm:block">
                                <img
                                alt="Client Logo"
                                class="w-full h-full object-cover"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuB3mnX26vKnjiE7lkgPOzM_-P8x_gLtdhDtE4diNxIzJIMUPkVYMUyAgSJ1mooqjvIT6Wonn8Z1YXlTB22X4UUTfKQDx-Yqxk35-8dHhsfGvxaC3iZf2ZoFtHEBjqNbxaPZJgyeDCxem8wUV-MckGB6o9g3DD5__hK_SV4OOxMoLzpq8CbymlDAEnj2QrELQFpFRxWdbEYxpZK0h6xVRgY-fijAPbErhvj3gphkeCcZIaaekpXNmpnk46tPZ_GdOpZ8Dbnusgplt0I"
                                />
                            </div>
                            <div>
                                <h1 class="font-headline-md text-headline-md text-black">Sala de trabalho — Logo Skilla</h1>
                                <div class="flex items-center gap-2 mt-1">
                                <span class="font-label-sm text-label-sm text-gray-500 uppercase tracking-wider">Contrato #1024</span>
                                <span class="w-1.5 h-1.5 rounded-full bg-primary-fixed"></span>
                                <span class="font-label-sm text-label-sm text-primary-fixed font-bold">Status: Ativo</span>
                                </div>
                            </div>
                            </div>

                            <button class="hidden sm:flex px-4 py-2 bg-gray-50 border border-gray-200 text-black rounded-lg font-label-md text-label-md hover:border-primary-fixed transition-colors items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">visibility</span>
                            Ver detalhes
                            </button>

                            <button class="sm:hidden p-2 text-gray-500 hover:text-primary-fixed">
                            <span class="material-symbols-outlined">info</span>
                            </button>
                        </div>

                        <!-- Chat Messages Area -->
                        <div class="flex-1 overflow-y-auto bg-white p-margin-mobile md:p-gutter flex flex-col gap-6 relative">

                            <div class="flex justify-center my-4">
                            <div class="bg-gray-100 border border-gray-200 px-4 py-2 rounded-full font-label-sm text-label-sm text-gray-600 text-center max-w-md shadow-sm">
                                O contrato foi iniciado. Pode usar esta sala para comunicar e enviar ficheiros.
                            </div>
                            </div>

                            <div class="flex flex-col items-start gap-1 max-w-[85%] md:max-w-[70%]">
                            <div class="flex items-end gap-2">
                                <div class="w-8 h-8 rounded-full overflow-hidden shrink-0 border border-gray-200 bg-gray-100">
                                <img
                                    alt="Client"
                                    class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAdsdrxNRELguNRZj1IJOZLygHNtSPVOgi8_ZOn-y4IAJOwfmHVOgkqbnYLILHPczmdjFaeFVkGoCeuimXarQp-jNI4jpQEi7BS42bFszr6a1SUMqjy5migHyRF47acCZAfTwj-NZbm6AD6PgoHzW8ZJPOl7CY7zokqiujQ4Vl42jeLt1j6ehPipnSZsO-gS9Ifl8eLLgwtxqhOZ1LW41bTrZzWpNVxaNSpBtNa4XPslv47OIYZroenTGJ8WsGiZxzNP6qPwF3IQWQ"
                                />
                                </div>
                                <div class="bg-gray-50 text-black border border-gray-200 p-4 rounded-2xl rounded-bl-sm shadow-sm">
                                <p class="font-body-md text-body-md">
                                    Olá! Obrigado por aceitares o projeto. Estamos muito entusiasmados para ver as tuas ideias para o logo da Skilla.
                                </p>
                                </div>
                            </div>
                            <span class="font-label-sm text-label-sm text-gray-500 ml-10">10:00 AM</span>
                            </div>

                            <div class="flex flex-col items-end gap-1 self-end max-w-[85%] md:max-w-[70%]">
                            <div class="flex items-end gap-2 flex-row-reverse">
                                <div class="w-8 h-8 rounded-full overflow-hidden shrink-0 border border-gray-200 bg-gray-100">
                                <img
                                    alt="Freelancer"
                                    class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBVh9mjw_BNDKV0SQb7r7p6eg28yfNAcoDEVFV3yOooMbrvXBMvLQ1DgzGQ7Asu-RLUS8V8yJmetSFOkiDuuC7mSSWjhABZZ6B8k__8evJeWMGv6wjNtCdFKKAfojUlhvxoWJ1_lCqGX8Xq3wLfhfk74dE74jCej86W65UJshxxJgL-vOFxhRYZ0b8KoaQW0OXxU4sW--xTiKVQ-i_seqAaCrvQz1sJuEssSxojG1Vm5sCP7NYdeUmPfGXgFulzHQXKKCqlDlBCNUI"
                                />
                                </div>
                                <div class="bg-white text-black border border-gray-200 p-4 rounded-2xl rounded-br-sm shadow-md">
                                <p class="font-body-md text-body-md">
                                    Olá! O prazer é meu. Já estive a ler o briefing. Têm alguma preferência de cor além do que está no documento?
                                </p>
                                </div>
                            </div>
                            <span class="font-label-sm text-label-sm text-gray-500 mr-10">10:15 AM</span>
                            </div>

                            <div class="flex flex-col items-start gap-1 max-w-[85%] md:max-w-[70%]">
                            <div class="flex items-end gap-2">
                                <div class="w-8 h-8 rounded-full overflow-hidden shrink-0 border border-gray-200 bg-gray-100">
                                <img
                                    alt="Client"
                                    class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCMtEUukVwRHLJWA5VJMB_Z2OEDM67ml2iqohOuys-svJk8tZVdelRDaJULTvOOg0b09uYDnfHIOJrt2t-12khyF2esX0rUUL_JW6GpRkT2PuByURWoEUzSdlGi-geyI9Ij2VJgooVx3yw5EisDpkaE-oIzQ8F2Qimq7zaWYpL-MTaxbxSaX3sroKwzML6rQpdvI80i2nCEXkkoleLyixfrCncdLCOsnBVfYB9WSCzb4YuFPRVuCHhzcorTBK65jo3wW8_hAtzCtpE"
                                />
                                </div>
                                <div class="bg-gray-50 text-black border border-gray-200 p-4 rounded-2xl rounded-bl-sm shadow-sm">
                                <p class="font-body-md text-body-md">
                                    Queremos algo que transmita 'energia' e 'eficiência'. Talvez explorar tons de verde ou amarelo néon, mas mantendo um ar profissional SaaS.
                                </p>
                                </div>
                            </div>
                            <span class="font-label-sm text-label-sm text-gray-500 ml-10">10:22 AM</span>
                            </div>

                            <div class="flex flex-col items-end gap-1 self-end max-w-[85%] md:max-w-[70%]">
                            <div class="flex items-end gap-2 flex-row-reverse">
                                <div class="w-8 h-8 rounded-full overflow-hidden shrink-0 border border-gray-200 bg-gray-100">
                                <img
                                    alt="Freelancer"
                                    class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCb9jdD_yRthmEprVP0ea3a8-bww_hRnImKg7n83h3HhxGlMyegvdSlKyHybq31r6trs2NNkh2GhHRvq4Jj_4e_AJNVN2zGvMAk9HywKw68WCUzjJrzRJoOo72cScpBzB1MuhtpfLvFl-NyymlR76vcU3yar2CODAm2u6kv6G02j-vkD8bJDR3eGtWZ4BR2KndHT8pXJ1lruZ4EU0bROMPf-dYpvJtYEgPOh_N5tWgNHrFm2DRk-KYQc5ngF9BOWLakraXevaHXe88"
                                />
                                </div>
                                <div class="bg-white text-black border border-gray-200 p-4 rounded-2xl rounded-br-sm shadow-md">
                                <p class="font-body-md text-body-md">
                                    Perfeito. 'Neo-Brutalism' misturado com 'High-End SaaS' parece o caminho. Vou preparar alguns rascunhos iniciais.
                                </p>
                                </div>
                            </div>
                            <span class="font-label-sm text-label-sm text-gray-500 mr-10">10:30 AM</span>
                            </div>

                            <div class="flex justify-center my-4">
                            <div class="bg-gray-100 border border-gray-200 px-4 py-2 rounded-full font-label-sm text-label-sm text-gray-600 text-center max-w-md shadow-sm">
                                Ficheiro anexado: 'skilla_brand_guidelines_v1.pdf'
                            </div>
                            </div>

                            <div class="flex flex-col items-start gap-1 max-w-[85%] md:max-w-[70%]">
                            <div class="flex items-end gap-2">
                                <div class="w-8 h-8 rounded-full overflow-hidden shrink-0 border border-gray-200 bg-gray-100">
                                <img
                                    alt="Client"
                                    class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuD_7HpkQlvWrDJO81nsCR4JzInDcoNgIAYKbC4qYmXGcof3aZDBnoUy_Qy_87_BqBrc4doYgvlGQheL8QhDJcL81bg5SGhiVfIDuY_U7xvkZQ2oaiolthsRo5O69XePpsNXyWsPX_xmj-pIMqvaXQQOelFHiBSAUjgO0UD21Op62cYl8lKKuoWqKq7BqUNLOGPeHKDLTpJQxmz7VYqvnpHrpQhwBC0XRj6iaikikansYSgz0PpnPN4o2TQZ-RA0_ymdadsimmoAn0g"
                                />
                                </div>
                                <div class="bg-gray-50 text-black border border-gray-200 p-4 rounded-2xl rounded-bl-sm shadow-sm">
                                <p class="font-body-md text-body-md">
                                    Acabei de enviar as guidelines antigas, apenas como referência do que NÃO queremos fazer. Ignora a paleta antiga.
                                </p>
                                </div>
                            </div>
                            <span class="font-label-sm text-label-sm text-gray-500 ml-10">10:35 AM</span>
                            </div>

                            <div class="flex flex-col items-end gap-1 self-end max-w-[85%] md:max-w-[70%]">
                            <div class="flex items-end gap-2 flex-row-reverse">
                                <div class="w-8 h-8 rounded-full overflow-hidden shrink-0 border border-gray-200 bg-gray-100">
                                <img
                                    alt="Freelancer"
                                    class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDsEBlojcd2zurnGbBmWqrsITHv5CYOl1IMzIPbUmeIFpj-bJs8AAtlvpcqT-ir7Z5yWCqd2pgX0YD-p0IO37Xf5_-Q8fZbwheoFJA0gE2f9vtmcI7wv5vdoCdLMBO2arxTyrHQWFDNn5H9tiA0OY9aFylBv6C1zrGTBgjVnVNe8mjPnLE7jdodTm7PCr52sG_98dtnHE5SuIEvWYDYS120EDssyrrC_cY2hjRxWIXihz5QSNWrWMkePFAh-2ECB3SjJFxD1VnT3ag"
                                />
                                </div>
                                <div class="bg-white text-black border border-gray-200 p-4 rounded-2xl rounded-br-sm shadow-md">
                                <p class="font-body-md text-body-md">
                                    Recebido. Vou focar-me no contraste alto. Em 48h envio as primeiras 3 propostas.
                                </p>
                                </div>
                            </div>
                            <span class="font-label-sm text-label-sm text-gray-500 mr-10">10:40 AM</span>
                            </div>

                            <div class="h-10 shrink-0"></div>
                        </div>

                        <!-- Floating Action / Delivery Button -->
                        <div class="absolute bottom-[80px] md:bottom-[90px] left-0 w-full flex justify-center px-4 pointer-events-none z-30">
                            <button id="openDeliverModalBtn" class="pointer-events-auto bg-[#D4FF00] text-black border border-transparent shadow-lg font-label-md text-label-md font-bold py-3 px-8 rounded-full flex items-center gap-2 hover:bg-[#b4d400] transition-colors group">
                            <span class="material-symbols-outlined text-black group-hover:scale-110 transition-transform">task_alt</span>
                            Entregar trabalho
                            </button>
                        </div>

                        <!-- Chat Composer Footer -->
                        <div class="bg-white border-t border-gray-200 p-3 md:p-4 shrink-0 z-20">
                            <div class="max-w-4xl mx-auto flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl p-2 focus-within:border-primary-fixed transition-colors shadow-sm">
                            <button class="p-2 text-gray-500 hover:text-primary-fixed transition-colors rounded-lg hover:bg-gray-100">
                                <span class="material-symbols-outlined">attach_file</span>
                            </button>
                            <input class="flex-1 bg-transparent border-none focus:ring-0 text-black font-body-md text-body-md placeholder:text-gray-400" placeholder="Escreve uma mensagem..." type="text" />
                            <button class="w-10 h-10 bg-primary-fixed text-black rounded-lg flex items-center justify-center hover:opacity-90 transition-opacity">
                                <span class="material-symbols-outlined text-[20px]">send</span>
                            </button>
                            </div>
                        </div>
                        </main>

                        <!-- MODAL: Entregar trabalho (inicialmente escondido) -->
                        <div id="deliverModal" class="fixed inset-0 bg-black/70 backdrop-blur-[4px] z-[60] hidden items-center justify-center p-4 overflow-y-auto">
                        <div class="bg-white text-black w-full max-w-[560px] my-8 rounded-modal border-[2px] border-black modal-shadow flex flex-col overflow-hidden animate-in fade-in zoom-in duration-300 max-h-[calc(100vh-2rem)] sm:max-h-[calc(100vh-4rem)] min-h-0">
                            <div class="px-8 pt-8 pb-6 flex justify-between items-start">
                            <div>
                                <h1 class="font-headline-md text-[26px] font-extrabold leading-tight tracking-tight">Entregar trabalho</h1>
                                <p class="font-body-md text-slate-500 text-sm mt-1">Envie notas e anexos para concluir a entrega.</p>
                            </div>
                            <button id="closeDeliverModalBtn" class="w-10 h-10 rounded-full flex items-center justify-center hover:bg-slate-100 transition-colors group" type="button" aria-label="Fechar">
                                <span class="material-symbols-outlined text-slate-900">close</span>
                            </button>
                            </div>

                            <div class="px-8 flex-1 min-h-0 overflow-y-auto custom-scrollbar space-y-8 pb-8">
                            <div class="space-y-3">
                                <label class="font-label-sm uppercase tracking-[0.15em] text-slate-500 block">NOTAS DA ENTREGA (OPCIONAL)</label>
                                <textarea class="w-full min-h-[120px] rounded-xl border-[2px] border-black p-4 font-body-md focus:ring-0 focus:border-primary-container transition-colors placeholder:text-slate-400"
                                placeholder="Descreva o que foi entregue, instruções de uso, credenciais de teste, próximos passos..."></textarea>
                                <p class="font-body-md text-slate-500 text-[13px]">Estas notas serão enviadas ao cliente.</p>
                            </div>

                            <div class="space-y-6">
                                <div class="space-y-3">
                                <label class="font-label-sm uppercase tracking-[0.15em] text-slate-500 block">ANEXOS E/OU LINK</label>
                                <div class="relative group cursor-pointer">
                                    <input class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" type="file" />
                                    <div class="border-[2px] border-dashed border-black rounded-2xl p-8 flex flex-col items-center justify-center text-center bg-white group-hover:bg-slate-50 transition-all">
                                    <span class="material-symbols-outlined text-[40px] mb-3 text-slate-900" style="font-variation-settings: 'wght' 300;">upload</span>
                                    <p class="font-headline-md text-base font-bold">Arraste ficheiros aqui ou clique para selecionar</p>
                                    <p class="font-body-md text-slate-500 text-[13px] mt-1">PDF, ZIP, PNG, JPG (máx. 25MB)</p>
                                    </div>
                                </div>
                                </div>

                                <div class="space-y-3">
                                <div class="relative flex items-center">
                                    <span class="material-symbols-outlined absolute left-4 text-slate-400">link</span>
                                    <input class="w-full h-[56px] pl-12 pr-4 rounded-xl border-[2px] border-black font-body-md focus:ring-0 focus:border-primary-container transition-colors placeholder:text-slate-400"
                                    placeholder="Cole um link (Google Drive, GitHub, Figma...)" type="url" />
                                </div>
                                <p class="font-body-md text-slate-500 text-[13px]">Certifique-se de que o link está acessível ao cliente.</p>
                                </div>
                            </div>
                            </div>

                            <div class="px-8 py-6 border-t border-slate-100 flex items-center justify-end gap-3 bg-slate-50/50">
                            <button id="cancelDeliverModalBtn" class="px-6 py-3 rounded-xl border-[2px] border-black bg-white font-headline-md text-sm font-bold hover:bg-slate-50 active:scale-95 transition-all" type="button">
                                Cancelar
                            </button>
                            <button class="px-6 py-3 rounded-xl bg-black text-primary-container font-headline-md text-sm font-bold flex items-center gap-2 hover:brightness-125 active:scale-95 transition-all" type="button">
                                <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">check</span>
                                Confirmar entrega
                            </button>
                            </div>
                        </div>
                        </div>
            </div>  
        `;

        templates.propostas = `

            <div id="view-propostas-freela" class="bg-[#CCFF00] font-body-md text-on-background">

                <!-- Main Content Canvas -->
                <!-- Header Actions -->
                <header class="flex justify-between items-center mb-12">
                    <div>
                    <h2 class="font-headline-lg text-black text-[40px] font-bold">Minhas Propostas</h2>
                    <div class="h-1.5 w-24 bg-black mt-2"></div>
                    </div>

                    <div class="flex items-center gap-4">
                    <div class="relative" id="propostas-search-wrap">
                        <input id="propostas-search"
                        class="bg-white border-2 border-black rounded-full px-6 py-3 w-80 text-black font-label-md focus:outline-none focus:ring-2 focus:ring-black/20"
                        placeholder="Procurar propostas..." type="text"/>
                        <span class="material-symbols-outlined absolute right-5 top-1/2 -translate-y-1/2 text-black" data-icon="search">search</span>
                    </div>
                    </div>
                </header>

                <!-- Proposals List Section -->
                <section class=" flex flex-col gap-6 max-w-5xl">

                    <!-- Card 1 -->
                    <div data-open-proposta="1042" class="proposal-card bg-white border-2 border-black rounded-[24px] p-8 flex flex-col gap-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] transition-transform hover:-translate-y-1 glow-hover">
                    <div class="flex justify-between items-start">
                        <a class="font-headline-md text-black hover:underline underline-offset-4 decoration-2" href="#">
                        Desenvolvimento de Landing Page de Alta Conversão
                        </a>
                        <span class="px-4 py-1.5 bg-[#4ADE80] border-2 border-black rounded-full text-black font-bold text-sm">Aceita</span>
                    </div>
                    <div class="grid grid-cols-4 gap-4 border-t-2 border-black/10 pt-6">
                        <div><p class="font-label-sm text-[10px] text-black/50 uppercase mb-1">Data de envio</p><p class="font-label-md text-black">12/10/2024</p></div>
                        <div><p class="font-label-sm text-[10px] text-black/50 uppercase mb-1">Valor proposto</p><p class="font-label-md text-black">150.000 Kz</p></div>
                        <div><p class="font-label-sm text-[10px] text-black/50 uppercase mb-1">Prazo de entrega</p><p class="font-label-md text-black">7 dias</p></div>
                        <div><p class="font-label-sm text-[10px] text-black/50 uppercase mb-1">ID</p><p class="font-label-md text-black">#1042</p></div>
                    </div>
                    </div>

                    <!-- Card 2 -->
                    <div data-open-proposta="1055" class="proposal-card bg-white border-2 border-black rounded-[24px] p-8 flex flex-col gap-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] transition-transform hover:-translate-y-1 glow-hover">
                    <div class="flex justify-between items-start">
                        <a class="font-headline-md text-black hover:underline underline-offset-4 decoration-2" href="#">App Mobile de Entrega (UI/UX Design)</a>
                        <span class="px-4 py-1.5 bg-[#FACC15] border-2 border-black rounded-full text-black font-bold text-sm">Pendente</span>
                    </div>
                    <div class="grid grid-cols-4 gap-4 border-t-2 border-black/10 pt-6">
                        <div><p class="font-label-sm text-[10px] text-black/50 uppercase mb-1">Data de envio</p><p class="font-label-md text-black">15/10/2024</p></div>
                        <div><p class="font-label-sm text-[10px] text-black/50 uppercase mb-1">Valor proposto</p><p class="font-label-md text-black">450.000 Kz</p></div>
                        <div><p class="font-label-sm text-[10px] text-black/50 uppercase mb-1">Prazo de entrega</p><p class="font-label-md text-black">21 dias</p></div>
                        <div><p class="font-label-sm text-[10px] text-black/50 uppercase mb-1">ID</p><p class="font-label-md text-black">#1055</p></div>
                    </div>
                    </div>

                    <!-- Card 3 -->
                    <div data-open-proposta="1031" class="proposal-card bg-white border-2 border-black rounded-[24px] p-8 flex flex-col gap-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] transition-transform hover:-translate-y-1 glow-hover">
                    <div class="flex justify-between items-start">
                        <a class="font-headline-md text-black hover:underline underline-offset-4 decoration-2" href="#">Identidade Visual para Startup de Fintech</a>
                        <span class="px-4 py-1.5 bg-[#F87171] border-2 border-black rounded-full text-black font-bold text-sm">Rejeitada</span>
                    </div>
                    <div class="grid grid-cols-4 gap-4 border-t-2 border-black/10 pt-6">
                        <div><p class="font-label-sm text-[10px] text-black/50 uppercase mb-1">Data de envio</p><p class="font-label-md text-black">08/10/2024</p></div>
                        <div><p class="font-label-sm text-[10px] text-black/50 uppercase mb-1">Valor proposto</p><p class="font-label-md text-black">200.000 Kz</p></div>
                        <div><p class="font-label-sm text-[10px] text-black/50 uppercase mb-1">Prazo de entrega</p><p class="font-label-md text-black">14 dias</p></div>
                        <div><p class="font-label-sm text-[10px] text-black/50 uppercase mb-1">ID</p><p class="font-label-md text-black">#1031</p></div>
                    </div>
                    </div>

                    <!-- Card 4 -->
                    <div data-open-proposta="1062" class="proposal-card bg-white border-2 border-black rounded-[24px] p-8 flex flex-col gap-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] transition-transform hover:-translate-y-1 glow-hover">
                    <div class="flex justify-between items-start">
                        <a class="font-headline-md text-black hover:underline underline-offset-4 decoration-2" href="#">Manutenção de Banco de Dados E-commerce</a>
                        <span class="px-4 py-1.5 bg-[#FACC15] border-2 border-black rounded-full text-black font-bold text-sm">Pendente</span>
                    </div>
                    <div class="grid grid-cols-4 gap-4 border-t-2 border-black/10 pt-6">
                        <div><p class="font-label-sm text-[10px] text-black/50 uppercase mb-1">Data de envio</p><p class="font-label-md text-black">18/10/2024</p></div>
                        <div><p class="font-label-sm text-[10px] text-black/50 uppercase mb-1">Valor proposto</p><p class="font-label-md text-black">75.000 Kz</p></div>
                        <div><p class="font-label-sm text-[10px] text-black/50 uppercase mb-1">Prazo de entrega</p><p class="font-label-md text-black">3 dias</p></div>
                        <div><p class="font-label-sm text-[10px] text-black/50 uppercase mb-1">ID</p><p class="font-label-md text-black">#1062</p></div>
                    </div>
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-end items-center gap-2 mt-4 pb-10">
                    <button class="bg-white border-2 border-black px-4 py-2 font-bold text-black rounded-lg hover:bg-black hover:text-white transition-colors">Anterior</button>
                    <div class="flex gap-1">
                        <button class="w-10 h-10 border-2 border-black bg-black text-white rounded-lg font-bold">1</button>
                        <button class="w-10 h-10 border-2 border-black bg-white text-black rounded-lg font-bold hover:bg-black/5">2</button>
                        <button class="w-10 h-10 border-2 border-black bg-white text-black rounded-lg font-bold hover:bg-black/5">3</button>
                        <span class="flex items-end px-2 text-black font-bold pb-2">...</span>
                        <button class="w-10 h-10 border-2 border-black bg-white text-black rounded-lg font-bold hover:bg-black/5">8</button>
                    </div>
                    <button class="bg-white border-2 border-black px-4 py-2 font-bold text-black rounded-lg hover:bg-black hover:text-white transition-colors">Próxima</button>
                    </div>

                </section>

                <!-- Footer -->
                <footer class="mt-auto flex justify-between items-center w-full py-8 text-black border-t border-black/10">
                    <div class="font-label-sm text-label-sm font-bold">SKILLA © 2024 - Feito em Luanda</div>
                    <div class="flex gap-6">
                    <a class="font-label-sm text-label-sm opacity-70 hover:opacity-100 underline decoration-2 underline-offset-4" href="#">Termos</a>
                    <a class="font-label-sm text-label-sm opacity-70 hover:opacity-100" href="#">Privacidade</a>
                    <a class="font-label-sm text-label-sm opacity-70 hover:opacity-100" href="#">Suporte</a>
                    </div>
                </footer>
            </div>
        `;


         // Define o link ativo no menu
  function setActiveLink(route) {
    const links = spaView.querySelectorAll('a[data-spa-link]');
    links.forEach(link => {
      const isActive = link.dataset.route === route;
      if (isActive) {
        link.classList.add('bg-[#CCFF00]', 'text-black-pure', 'rounded-lg', 'font-bold');
        link.classList.remove('text-on-primary-container', 'hover:text-secondary');
      } else {
        link.classList.remove('bg-[#CCFF00]', 'text-black-pure', 'rounded-lg', 'font-bold');
        link.classList.add('text-on-primary-container', 'hover:text-secondary');
      }
    });
  }

  // abrir modal proposta
  const open = e.target.closest('[data-open-proposta-modal]');
  if (open) {
    e.preventDefault();
    const overlay = spaView.querySelector('#modal-overlay');
    if (!overlay) return;
    overlay.classList.remove('hidden');
    overlay.classList.add('flex');
    document.body.style.overflow = 'hidden';
    spaView.querySelector('#cover-letter')?.focus();
    return;
  }

  // fechar modal proposta
  const close = e.target.closest('[data-close-proposta-modal]');
  if (close) {
    e.preventDefault();
    const overlay = spaView.querySelector('#modal-overlay');
    if (!overlay) return;
    overlay.classList.add('hidden');
    overlay.classList.remove('flex');
    document.body.style.overflow = '';
    return;
  }

  // clicar no backdrop fecha
  if (e.target && e.target.id === 'modal-overlay') {
    const overlay = e.target;
    overlay.classList.add('hidden');
    overlay.classList.remove('flex');
    document.body.style.overflow = '';
    return;
  }
});

        function walletSetModalOpen(modalEl, open) {
            if (!modalEl) return;
            if (open) {
                modalEl.classList.remove('pointer-events-none', 'opacity-0', 'hidden');
                modalEl.classList.add('opacity-100');
            } else {
                modalEl.classList.add('pointer-events-none', 'opacity-0');
                modalEl.classList.remove('opacity-100');
            }
        }

        function walletSetOverlayModalOpen(modalEl, contentEl, open) {
            if (!modalEl || !contentEl) return;
            if (open) {
                modalEl.classList.remove('pointer-events-none', 'opacity-0');
                contentEl.classList.remove('translate-y-8');
                contentEl.classList.add('translate-y-0');
            } else {
                modalEl.classList.add('pointer-events-none', 'opacity-0');
                contentEl.classList.add('translate-y-8');
                contentEl.classList.remove('translate-y-0');
            }
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
            
             if (route === 'carteira_comprar_creditos') {
                document.title = 'Skilla - Comprar Créditos';
            }else if (route === 'carteira_extrato_creditos') {
                document.title = 'Skilla - Extrato de Créditos';
            }else if (route === 'trabalhos') {
                document.title = 'Skilla - Feed de Projetos';
            } else if (route === 'trabalho_detalhe') {
                document.title = 'Skilla - Detalhes do Trabalho';
            } else if (route === 'carteira') {
                document.title = 'Skilla - A Minha Carteira';
            } else if (route === 'carteira_carregar_saldo') {
                document.title = 'Skilla - Carregar saldo';
            } else if (route === 'carteira_pedir_saque') {
                document.title = 'Skilla - Pedir saque';
            } else if (route === 'carteira_ver_extrato') {
                document.title = 'Skilla - Extrato';
            }  else if (route === 'mensagens') {
            document.title = 'Skilla - Mensagens';
            } else if (route === 'mensagens_sala') {
            document.title = 'Skilla - Sala de Trabalho';
            }else if (route === 'propostas') {
            document.title = 'Skilla - Minhas Propostas';
            }else {
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
                    // =========================
                    // MODAL: Enviar Proposta
                    // =========================
                    const overlay = spaView.querySelector('#modal-overlay');
                    const openBtn = spaView.querySelector('[data-open-proposta-modal]');
                    const closeEls = spaView.querySelectorAll('[data-close-proposta-modal]');

                    const cover = spaView.querySelector('#cover-letter');
                    const counter = spaView.querySelector('#char-counter');
                    const form = spaView.querySelector('#proposta-form');

                    const valorInput = spaView.querySelector('#proposta-valor');
                    const diasInput = spaView.querySelector('#proposta-dias');

                    const openModal = () => {
                        if (!overlay) return;

                        overlay.classList.remove('hidden');
                        overlay.classList.add('flex');
                        overlay.setAttribute('aria-hidden', 'false');

                        // Focar no textarea ao abrir
                        setTimeout(() => {
                        cover?.focus();
                        }, 0);
                    };

                    const closeModal = (e) => {
                        e?.preventDefault?.();

                        if (!overlay) return;

                        overlay.classList.add('hidden');
                        overlay.classList.remove('flex');
                        overlay.setAttribute('aria-hidden', 'true');
                    };

                    // Abrir modal
                    openBtn?.addEventListener('click', openModal);

                    // Fechar modal pelos botões/links com data-close-proposta-modal
                    closeEls.forEach((el) => {
                        el.addEventListener('click', closeModal);
                    });

                    // Fechar ao clicar fora do conteúdo
                    overlay?.addEventListener('click', (e) => {
                        if (e.target === overlay) {
                        closeModal(e);
                        }
                    });

                    // Fechar com ESC
                    const onEsc = (e) => {
                        if (
                        e.key === 'Escape' &&
                        overlay &&
                        !overlay.classList.contains('hidden')
                        ) {
                        closeModal(e);
                        }
                    };

                    document.addEventListener('keydown', onEsc);

                    // Contador de caracteres
                    const updateCounter = () => {
                        if (!cover || !counter) return;
                        counter.textContent = `${cover.value.length}/2000`;
                    };

                    cover?.addEventListener('input', updateCounter);
                    updateCounter();

                    // Submit do formulário
                    form?.addEventListener('submit', (e) => {
                        e.preventDefault();

                        const payload = {
                        coverLetter: cover?.value?.trim() || '',
                        valor: Number(valorInput?.value || 0),
                        dias: Number(diasInput?.value || 0),
                        };

                        // Validação simples
                        if (!payload.coverLetter) {
                        cover?.focus();
                        return;
                        }

                        if (!payload.valor || payload.valor <= 0) {
                        valorInput?.focus();
                        return;
                        }

                        if (!payload.dias || payload.dias <= 0) {
                        diasInput?.focus();
                        return;
                        }

                        console.log('Enviar proposta:', payload);

                        // TODO: aqui ligas à tua API / backend
                        // Exemplo:
                        // await enviarProposta(payload);

                        closeModal();
                    });
            }

            // Eventos da subview Extrato de Créditos
            if (route === 'carteira_extrato_creditos') {
                // voltar
                const backBtn = spaView.querySelector('[data-wallet-back]');
                if (backBtn) {
                    backBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        render('carteira', true, { activeMenuRoute: 'carteira', hash: 'carteira' });
                    });
                }

                // botão "Adicionar créditos" -> abre comprar créditos (se já integraste)
                const btnAdd = spaView.querySelector('[data-go-add-creditos]');
                if (btnAdd) {
                    btnAdd.addEventListener('click', (e) => {
                        e.preventDefault();
                        // se a tua rota for exatamente carteira_comprar_creditos:
                        render('carteira_comprar_creditos', true, { activeMenuRoute: 'carteira', hash: 'carteira/comprar-creditos' });
                    });
                }

                // micro-interaction (apenas itens do extrato)
                spaView.querySelectorAll('[data-credit-item]').forEach(item => {
                    item.addEventListener('click', () => {
                        item.style.transform = 'scale(0.98)';
                        setTimeout(() => { item.style.transform = 'scale(1)'; }, 100);
                    });
                });
            }

            // Eventos da Carteira (Minha carteira)
            if (route === 'carteira') {
                spaView.querySelectorAll('[data-wallet-action]').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        e.preventDefault();
                        const action = btn.getAttribute('data-wallet-action');

                        if (action === 'carregar-saldo') {
                            render('carteira_carregar_saldo', true, { activeMenuRoute: 'carteira', hash: 'carteira/carregar-saldo' });
                            return;
                        }
                        if (action === 'comprar-creditos') {
                            render('carteira_comprar_creditos', true, { activeMenuRoute: 'carteira', hash: 'carteira/comprar-creditos' });
                            return;
                        }
                        if (action === 'comprar-creditos') {
                            render('carteira_comprar_creditos', true, { activeMenuRoute: 'carteira', hash: 'carteira/comprar-creditos' });
                            return;
                        } 

                        if (action === 'pedir-saque') {
                            render('carteira_pedir_saque', true, { activeMenuRoute: 'carteira', hash: 'carteira/pedir-saque' });
                            return;
                        }

                        if (action === 'ver-extrato') {
                            render('carteira_ver_extrato', true, { activeMenuRoute: 'carteira', hash: 'carteira/extrato' });
                            return;
                        }
                        if (action === 'extrato-creditos') {
                            render('carteira_extrato_creditos', true, { activeMenuRoute: 'carteira', hash: 'carteira/extrato-creditos' });
                            return;
                        }

                        // próximos: comprar-creditos, extrato-creditos
                        console.log('wallet action:', action);
                    });
                });
            }
            
            // Eventos Comprar Créditos
            if (route === 'carteira_comprar_creditos') {
                const backBtn = spaView.querySelector('[data-wallet-back]');
                if (backBtn) {
                    backBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        render('carteira', true, { activeMenuRoute: 'carteira', hash: 'carteira' });
                    });
                }

                const initialBalance = 125000;

                const formatCurrency = (val) => {
                    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") + " Kz";
                };

                const debitMsg = spaView.querySelector('#summary-debit-msg');
                const pkg = spaView.querySelector('#summary-pkg');
                const costEl = spaView.querySelector('#summary-cost');
                const afterEl = spaView.querySelector('#summary-after');

                function updateSummary(credits, cost) {
                    const afterBalance = initialBalance - cost;
                    if (debitMsg) debitMsg.innerText = formatCurrency(cost);
                    if (pkg) pkg.innerText = `${credits} créditos`;
                    if (costEl) costEl.innerText = formatCurrency(cost);
                    if (afterEl) afterEl.innerText = formatCurrency(afterBalance);
                }

                // Bind radios
                spaView.querySelectorAll('input[name="credit_package"]').forEach(radio => {
                    radio.addEventListener('change', () => {
                        const credits = Number(radio.getAttribute('data-credits') || 0);
                        const cost = Number(radio.getAttribute('data-cost') || 0);
                        updateSummary(credits, cost);
                    });
                });

                // inicializa com o selecionado
                const selected = spaView.querySelector('input[name="credit_package"]:checked');
                if (selected) {
                    updateSummary(
                        Number(selected.getAttribute('data-credits') || 0),
                        Number(selected.getAttribute('data-cost') || 0)
                    );
                }

                // Botão comprar
                const buyBtn = spaView.querySelector('#buy-button');
                if (buyBtn) {
                    buyBtn.addEventListener('click', () => {
                        buyBtn.innerText = "Processando...";
                        buyBtn.classList.add('opacity-80');
                        buyBtn.disabled = true;

                        setTimeout(() => {
                            alert('Compra realizada com sucesso!');
                            buyBtn.innerText = "Comprar";
                            buyBtn.classList.remove('opacity-80');
                            buyBtn.disabled = false;
                        }, 1500);
                    });
                }
            }

            // Eventos da subview Carregar Saldo
            if (route === 'carteira_carregar_saldo') {
                // voltar
                const backBtn = spaView.querySelector('[data-wallet-back]');
                if (backBtn) {
                    backBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        render('carteira', true, { activeMenuRoute: 'carteira', hash: 'carteira' });
                    });
                }

                // abrir modal sucesso
                const successOpenBtn = spaView.querySelector('[data-open-success-modal]');
                const successModal = spaView.querySelector('#successModal');
                const infoModal = spaView.querySelector('#infoModal');

                function setModalOpen(modal, open) {
                    if (!modal) return;
                    if (open) {
                        modal.classList.remove('hidden');
                        modal.classList.add('flex');
                    } else {
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                    }
                }

                if (successOpenBtn) {
                    successOpenBtn.addEventListener('click', () => setModalOpen(successModal, true));
                }

                // fechar modais (botões com data-close-modal)
                spaView.querySelectorAll('[data-close-modal]').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const id = btn.getAttribute('data-close-modal');
                        setModalOpen(spaView.querySelector('#' + CSS.escape(id)), false);
                    });
                });

                // clicar nos itens desabilitados -> abre info modal
                spaView.querySelectorAll('.wallet-disabled-item').forEach(item => {
                    item.addEventListener('click', () => setModalOpen(infoModal, true));
                });

                // ações do modal sucesso
                const btnGoExtrato = spaView.querySelector('[data-success-go-extrato]');
                const btnBackWallet = spaView.querySelector('[data-success-back-wallet]');

                if (btnBackWallet) {
                    btnBackWallet.addEventListener('click', () => {
                        setModalOpen(successModal, false);
                        render('carteira', true, { activeMenuRoute: 'carteira', hash: 'carteira' });
                    });
                }

                if (btnGoExtrato) {
                    btnGoExtrato.addEventListener('click', () => {
                        setModalOpen(successModal, false);
                        render('carteira_ver_extrato', true, { activeMenuRoute: 'carteira', hash: 'carteira/extrato' });
                    });
                }
            }

            // Eventos da subview Pedir Saque
            if (route === 'carteira_pedir_saque') {
                const backBtn = spaView.querySelector('[data-wallet-back]');
                if (backBtn) {
                    backBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        render('carteira', true, { activeMenuRoute: 'carteira', hash: 'carteira' });
                    });
                }

                const input = spaView.querySelector('#withdraw-input');
                const btnAll = spaView.querySelector('[data-withdraw-fill-all]');
                const valSacarEl = spaView.querySelector('[data-withdraw-summary-value]');
                const totalEl = spaView.querySelector('[data-withdraw-summary-total]');

                function formatAO(n) {
                    try { return new Intl.NumberFormat('pt-AO').format(n).replace(',', ' '); }
                    catch { return String(n); }
                }

                function updateSummary(val) {
                    const num = val ? Number(val) : 0;
                    const formatted = num ? `${formatAO(num)} Kz` : '0 Kz';
                    if (valSacarEl) valSacarEl.textContent = formatted;
                    if (totalEl) totalEl.textContent = formatted;
                }

                if (btnAll && input) {
                    btnAll.addEventListener('click', () => {
                        input.value = '125000';
                        updateSummary(input.value);
                        input.dispatchEvent(new Event('input', { bubbles: true }));
                    });
                }

                if (input) input.addEventListener('input', (e) => updateSummary(e.target.value));
            }

            // Eventos da subview Ver Extrato
            if (route === 'carteira_ver_extrato') {
                const backBtn = spaView.querySelector('[data-wallet-back]');
                if (backBtn) {
                    backBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        render('carteira', true, { activeMenuRoute: 'carteira', hash: 'carteira' });
                    });
                }

                // Toggle Filter Panel
                const toggleBtn = spaView.querySelector('#toggleFilters');
                const filterPanel = spaView.querySelector('#filterPanel');
                if (toggleBtn && filterPanel) {
                    toggleBtn.addEventListener('click', () => {
                        filterPanel.classList.toggle('hidden');
                    });
                }

                // Modal Logic
                const overlay = spaView.querySelector('#modalOverlay');
                const content = spaView.querySelector('#modalContent');
                const closeBtn = spaView.querySelector('[data-close-extrato-modal]');
                const refEl = spaView.querySelector('[data-modal-ref]');

                function showDetails(txId) {
                    if (refEl) refEl.textContent = txId;
                    walletSetOverlayModalOpen(overlay, content, true);
                }

                function closeModal() {
                    walletSetOverlayModalOpen(overlay, content, false);
                }

                spaView.querySelectorAll('[data-tx-card]').forEach(card => {
                    card.addEventListener('click', () => {
                        const id = card.getAttribute('data-tx-id') || 'TX123456789';
                        showDetails(id);
                    });
                });

                if (closeBtn) closeBtn.addEventListener('click', closeModal);

                // Close on backdrop click
                if (overlay) {
                    overlay.addEventListener('click', (e) => {
                        if (e.target === overlay) closeModal();
                    });
                }
            }
            
            // =====================
        // SPA: Mensagens (Inbox)
        // =====================
        if (route === 'mensagens') {
            // clicar em qualquer item (lido/não-lido) -> abrir sala
            spaView.querySelectorAll('[data-open-chat]').forEach(item => {
            item.addEventListener('click', (e) => {
            e.preventDefault();
            render('mensagens_sala', true, {
            activeMenuRoute: 'mensagens',
            hash: 'mensagens/sala'
                    });
                });
            });
        }

        if (route === 'propostas') {
            // Pesquisa
            const input = spaView.querySelector('#propostas-search');
            const cards = Array.from(spaView.querySelectorAll('.proposal-card'));

            if (input) {
                input.addEventListener('input', () => {
                const q = input.value.trim().toLowerCase();
                cards.forEach(card => {
                    const text = card.innerText.toLowerCase();
                    card.style.display = text.includes(q) ? '' : 'none';
                });
                });
            }

            // Evitar que links com # naveguem
            spaView.querySelectorAll('#view-propostas-freela a[href="#"]').forEach(a => {
                a.addEventListener('click', (e) => e.preventDefault());
            });
            /* 
                            // Abrir detalhe ao clicar no card (agora com data-open-proposta)
            spaView.querySelectorAll('[data-open-proposta]').forEach(card => {
                card.addEventListener('click', (e) => {
                e.preventDefault();
                render('propostas_detalhe', true, {
                    activeMenuRoute: 'propostas',
                    hash: 'propostas/detalhe'
                });
                });
            });
            */

            
        }


        // =============================
        // SPA: Mensagens (Sala de chat)
        // =============================
        if (route === 'mensagens_sala') {
            // voltar para inbox
            const back = spaView.querySelector('[data-back-to-inbox]');
                if (back) {
                    back.addEventListener('click', (e) => {
                    e.preventDefault();
                    render('mensagens', true, {
                        activeMenuRoute: 'mensagens',
                        hash: 'mensagens'
                    });
                    });
                }

            // modal entregar trabalho
            const modal = spaView.querySelector('#deliverModal');
            const openBtn = spaView.querySelector('#openDeliverModalBtn');
            const closeBtn = spaView.querySelector('#closeDeliverModalBtn');
            const cancelBtn = spaView.querySelector('#cancelDeliverModalBtn');

            function openModal() {
                if (!modal) return;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                modal.setAttribute('aria-hidden', 'false');
                document.body.classList.add('overflow-hidden');
            }

            function closeModal() {
                if (!modal) return;
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                modal.setAttribute('aria-hidden', 'true');
                document.body.classList.remove('overflow-hidden');
            }

            if (openBtn) openBtn.addEventListener('click', openModal);
            if (closeBtn) closeBtn.addEventListener('click', closeModal);
            if (cancelBtn) cancelBtn.addEventListener('click', closeModal);

            // fechar ao clicar no backdrop
            if (modal) {
                modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
                });
            }

            // fechar com ESC (remove handler anterior para evitar duplicar a cada render)
            if (window.__deliverEscHandler) {
                document.removeEventListener('keydown', window.__deliverEscHandler);
            }
            window.__deliverEscHandler = (e) => {
                if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) closeModal();
            };
            document.addEventListener('keydown', window.__deliverEscHandler);
        }

           

        }


  // abrir modal proposta
  const open = e.target.closest('[data-open-proposta-modal]');
  if (open) {
    e.preventDefault();
    const overlay = spaView.querySelector('#modal-overlay');
    if (!overlay) return;
    overlay.classList.remove('hidden');
    overlay.classList.add('flex');
    document.body.style.overflow = 'hidden';
    spaView.querySelector('#cover-letter')?.focus();
    return;
  }

  // fechar modal proposta
  const close = e.target.closest('[data-close-proposta-modal]');
  if (close) {
    e.preventDefault();
    const overlay = spaView.querySelector('#modal-overlay');
    if (!overlay) return;
    overlay.classList.add('hidden');
    overlay.classList.remove('flex');
    document.body.style.overflow = '';
    return;
  }

  // clicar no backdrop fecha
  if (e.target && e.target.id === 'modal-overlay') {
    const overlay = e.target;
    overlay.classList.add('hidden');
    overlay.classList.remove('flex');
    document.body.style.overflow = '';
    return;
  }
});

        
        
    })();


    /* ========================================
            
    Código script do modal enviar proposta 
    
    */ ========================================

     // Character counter logic
        const textarea = document.getElementById('cover-letter');
        const counter = document.getElementById('char-counter');

        textarea.addEventListener('input', (e) => {
            const length = e.target.value.length;
            counter.textContent = `${length}/2000`;
            if (length > 1900) {
                counter.classList.add('text-error');
            } else {
                counter.classList.remove('text-error');
            }
        });

        // Close modal function
        function closeModal() {
            const content = document.getElementById('modal-content');
            const overlay = document.getElementById('modal-overlay');
            
            content.classList.add('scale-95', 'opacity-0');
            overlay.classList.add('opacity-0');
            
            setTimeout(() => {
                // In a real app, you'd navigate or remove the element
                alert('Modal fechado. Voltando para Minhas Propostas.');
            }, 300);
        }

        // Close on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
        });

        // Simple entrance animation trigger
        window.onload = () => {
            const content = document.getElementById('modal-content');
            content.classList.add('scale-100', 'opacity-100');
        };

        

document.addEventListener('keydown', (e) => {
  if (e.key !== 'Escape') return;
  const overlay = spaView.querySelector('#modal-overlay');
  if (overlay && !overlay.classList.contains('hidden')) {
    overlay.classList.add('hidden');
    overlay.classList.remove('flex');
    document.body.style.overflow = '';
  }
});


document.addEventListener('click', function(e) {
    const link = e.target.closest('a[data-spa-link]');
    if (!link) return;
    e.preventDefault();
    const route = link.dataset.route;
    render(route, true, { activeMenuRoute: route });
});
</script>
</body>
</html>
