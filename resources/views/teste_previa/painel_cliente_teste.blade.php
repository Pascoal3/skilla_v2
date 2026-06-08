<!DOCTYPE html>
<html lang="pt-AO">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Meta tags para dados de sistema -->
    <meta name="user-id" content="{{ auth()->id() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Skilla - Painel do Cliente</title>
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
        #greeting-new-proposals-count{
            color: black;
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
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glow-hover:hover {
            box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.12);
        }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #D4FF00; }
        ::-webkit-scrollbar-thumb { background: #000000; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #333333; }
        
        /* High Contrast Specifics */
        .card-shadow {
            box-shadow: 6px 6px 0px 0px #000000;
        }
        .bg-white{
            color: black;
        }
        .card-metrica{
            color: black;
        }
        .neo-shadow {
            box-shadow: 6px 6px 0px 0px #000000;
        }
        .neo-shadow-sm {
            box-shadow: 4px 4px 0px 0px #000000;
        }
        .neo-border {
            border: 2px solid #000000;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
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
            <span class="font-label-md text-label-md">Os meus trabalhos</span>
        </a>

        <a data-spa-link data-route="propostas"
           class="flex items-center gap-3 text-on-primary-container hover:text-secondary px-4 py-3 transition-colors"
           href="#propostas">
            <span class="material-symbols-outlined">description</span>
            <span class="font-label-md text-label-md">Propostas recebidas</span>
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
            <span class="font-label-md text-label-md">O meu Perfil</span>
        </a>

    </div>

    <div class="mt-auto pt-6">
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
        <section id="spa-view" class="bg-[#CCFF00] w-full"></section>
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
            <div id="view-inicio" class="p-6 md:p-8 space-y-6 max-w-container-max mx-auto w-full pb-20">

                    <!-- ------------------------------------ -->
                    <!-- Greeting Section                      -->
                    <!-- ------------------------------------ -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-2">
                        <div>
                        <h2 class="font-headline-md text-headline-md text-black-pure mb-2" id="greeting-user-name">
                            Bom dia, [Nome] 👋
                        </h2>
                        <p class="text-body-md font-body-md text-black-pure">
                            Tens <span class="span_numero font-semibold" id="greeting-new-proposals-count">0</span> propostas novas à espera de revisão.
                        </p>
                        </div>
                        <button class="bg-[#1A1A1A] text-white text-label-md font-label-md px-4 py-2 rounded-lg hover:bg-black transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">add</span>
                        Publicar Trabalho
                        </button>
                    </div>

                    <!-- ------------------------------------ -->
                    <!-- Metrics Grid                          -->
                    <!-- ------------------------------------ -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                        <!-- Card 1: Trabalhos Publicados -->
                        <div class="bg-white border border-border-subtle rounded-[12px] p-5 flex flex-col justify-between text-black">
                        <div class="flex justify-between items-start mb-4">
                            <div class="p-2 bg-[#1E1E1E] rounded-lg">
                            <span class="material-symbols-outlined text-[#CCFF00]">work</span>
                            </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <span class="font-label-sm text-label-sm text-on-tertiary-container uppercase tracking-wider">Trabalhos Publicados</span>
                                <span class="font-display-lg text-headline-md font-bold text-black-pure leading-none truncate" id="metric-published-jobs">0</span>
                            </div>
                        </div>

                        <!-- Card 2: Propostas Recebidas -->
                        <div class="bg-white border border-border-subtle rounded-[12px] p-5 flex flex-col justify-between text-black">
                        <div class="flex justify-between items-start mb-4">
                            <div class="p-2 bg-[#1E1E1E] rounded-lg">
                            <span class="material-symbols-outlined text-[#CCFF00]">description</span>
                            </div>
                            <span class="bg-[#CCFF00] text-[#1A1A1A] text-label-sm font-label-sm px-2 py-0.5 rounded-full flex items-center gap-1 hidden" id="badge-new-proposals">
                            <span class="material-symbols-outlined text-[14px]">arrow_upward</span>
                            <span id="badge-new-proposals-count">0</span> novas
                            </span>
                        </div>
                        <div class="flex flex-col gap-1">
                                <span class="font-label-sm text-label-sm text-on-tertiary-container uppercase tracking-wider">Propostas Recebidas</span>
                                <span class="font-display-lg text-headline-md font-bold text-black-pure leading-none truncate" id="metric-received-proposals">0</span>
                            </div>
                        </div>

                        <!-- Card 3: Em Andamento -->
                        <div class="bg-white border border-border-subtle rounded-[12px] p-5 flex flex-col justify-between text-black">
                        <div class="flex justify-between items-start mb-4">
                            <div class="p-2 bg-[#1E1E1E] rounded-lg">
                            <span class="material-symbols-outlined text-[#CCFF00]">schedule</span>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1">
                                <span class="font-label-sm text-label-sm text-on-tertiary-container uppercase tracking-wider">Em Andamento</span>
                                <span class="font-display-lg text-headline-md font-bold text-black-pure leading-none truncate" id="metric-in-progress">0</span>
                            </div>
                        </div>

                        <!-- Card 4: Concluídos -->
                        <div class=" bg-white border border-border-subtle rounded-[12px] p-5 flex flex-col justify-between text-black">
                        <div class="flex justify-between items-start mb-4">
                            <div class="p-2 bg-[#1E1E1E] rounded-lg">
                            <span class="material-symbols-outlined text-[#CCFF00]">check_circle</span>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1">
                                <span class="font-label-sm text-label-sm text-on-tertiary-container uppercase tracking-wider">Concluídos</span>
                                <span class="font-display-lg text-headline-md font-bold text-black-pure leading-none truncate" id="metric-completed">0</span>
                            </div>
                        </div>

                    </div>

                    <!-- ------------------------------------ -->
                    <!-- Carteira + Atenção (60/40)            -->
                    <!-- ------------------------------------ -->
                    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

                        <!-- A Minha Carteira (60%) -->
                        <div class="lg:col-span-3 bg-white border border-border-subtle rounded-[12px] p-6 flex flex-col">
                        <h3 class="text-headline-sm font-headline-sm mb-6">A Minha Carteira Skilla</h3>
                        <div class="flex-1 flex flex-col justify-center">
                            <div class="mb-6">
                            <p class="text-body-sm font-body-sm text-secondary mb-1">Saldo Disponível</p>
                            <p class="text-metric-lg font-metric-lg text-[#1A1A1A]" id="wallet-balance">0,00 KZS</p>
                            </div>
                            <div class="mb-8 bg-[#1A1A1A] p-4 rounded-lg">
                            <p class="text-body-sm font-body-sm text-[#CCFF00] mb-1">Em Escrow (Cativos)</p>
                            <p class="text-headline-md font-headline-md text-[#CCFF00]" id="escrow-amount">0,00 KZS</p>
                            </div>
                            <div class="mt-auto">
                            <button class="w-full sm:w-auto border border-[#1A1A1A] text-[#1A1A1A] hover:bg-gray-100 text-label-md font-label-md px-6 py-2.5 rounded-lg transition-colors">
                                Recarregar Saldo
                            </button>
                            </div>
                        </div>
                        </div>

                        <!-- Requer a Tua Atenção (40%) -->
                        <div class="lg:col-span-2 bg-white border border-border-subtle rounded-[12px] p-6 flex flex-col">
                        <div class="flex items-center gap-2 mb-6">
                            <span class="material-symbols-outlined text-status-warning-text">warning</span>
                            <h3 class="text-headline-sm font-headline-sm">Requer a Tua Atenção</h3>
                        </div>
                        <div class="space-y-4 flex-1" id="attention-needed-container">
                            <!-- Preenchido pelo JS -->
                        </div>
                        </div>

                    </div>

                    <!-- ------------------------------------ -->
                    <!-- Os Meus Trabalhos Ativos              -->
                    <!-- ------------------------------------ -->
                    <div class="bg-white border border-border-subtle rounded-[12px] overflow-hidden">
                        <div class="p-6 border-b border-border-subtle flex justify-between items-center bg-white">
                        <h3 class="text-headline-sm font-headline-sm text-[#1E1E1E]">Os Meus Trabalhos ativos</h3>
                        <a class="text-[#1A1A1A] text-label-md font-label-md hover:underline" href="#">Ver todos</a>
                        </div>
                        <div class="divide-y divide-border-subtle" id="active-jobs-container">
                        <!-- Preenchido pelo JS -->
                        </div>
                    </div>

                    <!-- ------------------------------------ -->
                    <!-- Propostas + Movimentações (50/50)     -->
                    <!-- ------------------------------------ -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                        <!-- Últimas Propostas -->
                        <div class="bg-white border border-border-subtle rounded-[12px] flex flex-col">
                        <div class="p-6 border-b border-border-subtle">
                            <h3 class="text-headline-sm font-headline-sm">Últimas Propostas Recebidas</h3>
                        </div>
                        <div class="p-6 space-y-4" id="recent-proposals-container">
                            <!-- Preenchido pelo JS -->
                        </div>
                        </div>

                        <!-- Últimas Movimentações -->
                        <div class="bg-white border border-border-subtle rounded-[12px] flex flex-col">
                        <div class="p-6 border-b border-border-subtle flex justify-between items-center">
                            <h3 class="text-headline-sm font-headline-sm">Últimas Movimentações</h3>
                            <a class="text-[#1A1A1A] text-label-md font-label-md hover:underline" href="#">Histórico</a>
                        </div>
                        <div class="p-0">
                            <table class="w-full text-left">
                            <tbody class="divide-y divide-border-subtle" id="recent-transactions-container">
                                <!-- Preenchido pelo JS -->
                            </tbody>
                            </table>
                        </div>
                        </div>

                    </div>

            </div>
                    <!-- FIM view-inicio -->
        `;

        App.templates.carteira = `
            <div id="view-carteira" class="min-h-screen relative z-10 flex flex-col pb-20">
                <div class="max-w-[1280px] mx-auto w-full px-4 md:px-10 py-8 flex flex-col gap-10">

                    <!-- Skeleton path -->
                    <div class="font-label-sm text-label-sm text-black opacity-70 flex items-center gap-2">
                    <a class="hover:underline" data-spa-link data-route="carteira" href="#carteira">Carteira</a> &gt;
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


                </div>
            </div>
        `;


        App.templates.carteira_carregar_saldo = `
            <div id="view-carteira-carregar-saldo" class="min-h-screen bg-lime-main text-[#111827] overflow-hidden">
                <main class="flex-1 flex flex-col bg-lime-main overflow-y-auto">

                    <!-- Breadcrumb -->
                    <div class="max-w-[800px] w-full mx-auto px-4 md:px-[40px] pt-6">
                    <div class="text-[12px] leading-[16px] text-black/70 flex items-center gap-2">
                        <a class="hover:underline" data-spa-link data-route="carteira" href="#carteira">Carteira</a> &gt;
                        <a class="hover:underline" data-spa-link data-route="carteira" href="#carteira">Minha carteira</a> &gt;
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

                    <!-- Breadcrumb -->
                    <div class="text-[12px] leading-[16px] text-black/70 flex items-center gap-2">
                    <a class="hover:underline" data-spa-link data-route="carteira" href="#carteira">Carteira</a> &gt;
                    <a class="hover:underline" data-spa-link data-route="carteira" href="#carteira">Minha carteira</a> &gt;
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

        App.templates.carteira_ver_extrato = `
            <div id="view-carteira-ver-extrato" class="overflow-x-hidden bg-[#D4FF00] min-h-screen">
                <main class="pt-10 pb-20 px-4 md:px-10 min-h-screen">
                    <div class="max-w-[1280px] mx-auto">

                    <!-- Breadcrumb + voltar -->
                    <div class="flex items-center justify-between gap-4 mb-8">
                        <div class="text-[12px] leading-[16px] text-black/70 flex items-center gap-2">
                        <a class="hover:underline" data-spa-link data-route="carteira" href="#carteira">Carteira</a> &gt;
                        <a class="hover:underline" data-spa-link data-route="carteira" href="#carteira">Minha carteira</a> &gt;
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

        App.templates.trabalhos = `
            <div id="view-trabalhos" class="min-h-screen relative z-10 flex flex-col pb-20 w-full">
                <main class="p-8 pl-0 lg:p-12 lg:pl-0">
                    <!-- Header Section -->
                    <header class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-[50px]">
                    <div>
                    <h2 class="text-5xl font-black uppercase italic tracking-tighter border-b-[8px] border-black inline-block">
                                        Meus Trabalhos
                                    </h2>
                    </div>
                    <div class="flex items-center gap-4">
                        <!-- Botão Explorar Trabalhos com ID para JS SPA -->
                        <button id="btn-adicionar-trabalhos" class="bg-black-pure text-white px-6 py-3 rounded-lg font-label-md text-label-md font-bold flex items-center gap-2 hover:bg-surface-container-highest transition-colors">
                            <span class="material-symbols-outlined text-[20px]">add</span>
                            Adicionar Trabalhos
                        </button>
                    </div>
                    </header>
                    <!-- Tabs Section -->
                    <nav class="flex flex-wrap gap-3 mb-12">
                    <button class="px-6 py-2 bg-black text-white neo-border font-bold rounded-full transition-transform active:scale-95">Rascunhos</button>
                    <button class="px-6 py-2 bg-white text-black neo-border font-bold rounded-full hover:bg-gray-100 transition-all">Abertos</button>
                    <button class="px-6 py-2 bg-white text-black neo-border font-bold rounded-full hover:bg-gray-100 transition-all">Em andamento</button>
                    <button class="px-6 py-2 bg-white text-black neo-border font-bold rounded-full hover:bg-gray-100 transition-all">Concluídos</button>
                    <button class="px-6 py-2 bg-white text-black neo-border font-bold rounded-full hover:bg-gray-100 transition-all">Cancelados</button>
                    </nav>
                    <!-- Job Cards Grid -->
                    <section class="grid grid-cols-1 gap-8 mb-12">
                    <!-- Card 1 -->
                    <article class="bg-white neo-border neo-shadow rounded-neo p-8 transition-all hover:translate-x-[-4px] hover:translate-y-[-4px] hover:shadow-[10px_10px_0px_0px_#000]">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                    <h3 class="text-2xl font-black uppercase tracking-tight">Desenvolvimento de App Mobile E-commerce</h3>
                    <span class="px-4 py-1 bg-[#FFD600] neo-border rounded-full font-mono-bold text-xs uppercase">Em Aberto</span>
                    </div>
                    <hr class="border-gray-200 mb-8">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div>
                    <p class="font-label-sm text-gray-500 uppercase mb-1">Data de Publicação</p>
                    <p class="font-mono-bold text-black">12/OUT/2023</p>
                    </div>
                    <div>
                    <p class="font-label-sm text-gray-500 uppercase mb-1">Valor Estimado</p>
                    <p class="font-mono-bold text-black">15.000 Kz</p>
                    </div>
                    <div>
                    <p class="font-label-sm text-gray-500 uppercase mb-1">Propostas</p>
                    <p class="font-mono-bold text-black">08 Recebidas</p>
                    </div>
                    <div>
                    <p class="font-label-sm text-gray-500 uppercase mb-1">ID</p>
                    <p class="font-mono-bold text-black">#1031</p>
                    </div>
                    </div>
                    <div class="flex justify-end gap-4 mt-8">
                    <button class="p-2 neo-border rounded-lg bg-white hover:bg-primary-container transition-colors">
                    <span class="material-symbols-outlined" data-icon="edit">edit</span>
                    </button>
                    <button class="p-2 neo-border rounded-lg bg-white hover:bg-primary-container transition-colors">
                    <span class="material-symbols-outlined" data-icon="visibility">visibility</span>
                    </button>
                    </div>
                    </article>
                    <!-- Card 2 -->
                    <article class="bg-white neo-border neo-shadow rounded-neo p-8 transition-all hover:translate-x-[-4px] hover:translate-y-[-4px] hover:shadow-[10px_10px_0px_0px_#000]">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                    <h3 class="text-2xl font-black uppercase tracking-tight">Redesign de Interface SaaS Financeiro</h3>
                    <span class="px-4 py-1 bg-[#00E5FF] neo-border rounded-full font-mono-bold text-xs uppercase">Em Progresso</span>
                    </div>
                    <hr class="border-gray-200 mb-8">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div>
                    <p class="font-label-sm text-gray-500 uppercase mb-1">Data de Publicação</p>
                    <p class="font-mono-bold text-black">05/OUT/2023</p>
                    </div>
                    <div>
                    <p class="font-label-sm text-gray-500 uppercase mb-1">Valor Estimado</p>
                    <p class="font-mono-bold text-black">8.200 Kz</p>
                    </div>
                    <div>
                    <p class="font-label-sm text-gray-500 uppercase mb-1">Propostas</p>
                    <p class="font-mono-bold text-black">15 Recebidas</p>
                    </div>
                    <div>
                    <p class="font-label-sm text-gray-500 uppercase mb-1">ID</p>
                    <p class="font-mono-bold text-black">#1032</p>
                    </div>
                    </div>
                    <div class="flex justify-end gap-4 mt-8">
                    <button class="p-2 neo-border rounded-lg bg-white hover:bg-primary-container transition-colors">
                    <span class="material-symbols-outlined" data-icon="edit">edit</span>
                    </button>
                    <button class="p-2 neo-border rounded-lg bg-white hover:bg-primary-container transition-colors">
                    <span class="material-symbols-outlined" data-icon="visibility">visibility</span>
                    </button>
                    </div>
                    </article>
                    <!-- Card 3 -->
                    <article class="bg-white neo-border neo-shadow rounded-neo p-8 transition-all hover:translate-x-[-4px] hover:translate-y-[-4px] hover:shadow-[10px_10px_0px_0px_#000]">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                    <h3 class="text-2xl font-black uppercase tracking-tight">Criação de Identidade Visual Tech</h3>
                    <span class="px-4 py-1 bg-[#FF9100] neo-border rounded-full font-mono-bold text-xs uppercase">Aguardando</span>
                    </div>
                    <hr class="border-gray-200 mb-8">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div>
                    <p class="font-label-sm text-gray-500 uppercase mb-1">Data de Publicação</p>
                    <p class="font-mono-bold text-black">28/SET/2023</p>
                    </div>
                    <div>
                    <p class="font-label-sm text-gray-500 uppercase mb-1">Valor Estimado</p>
                    <p class="font-mono-bold text-black">4.500 Kz</p>
                    </div>
                    <div>
                    <p class="font-label-sm text-gray-500 uppercase mb-1">Propostas</p>
                    <p class="font-mono-bold text-black">03 Recebidas</p>
                    </div>
                    <div>
                    <p class="font-label-sm text-gray-500 uppercase mb-1">ID</p>
                    <p class="font-mono-bold text-black">#1033</p>
                    </div>
                    </div>
                    <div class="flex justify-end gap-4 mt-8">
                    <button class="p-2 neo-border rounded-lg bg-white hover:bg-primary-container transition-colors">
                    <span class="material-symbols-outlined" data-icon="edit">edit</span>
                    </button>
                    <button class="p-2 neo-border rounded-lg bg-white hover:bg-primary-container transition-colors">
                    <span class="material-symbols-outlined" data-icon="visibility">visibility</span>
                    </button>
                    </div>
                    </article>
                    </section>
                    <!-- Pagination Section -->
                    <footer class="flex items-center justify-between mt-12 pb-12"><div class="flex items-center gap-2">
                    <button class="px-6 py-3 bg-white neo-border neo-shadow-sm font-bold uppercase hover:translate-x-[-2px] hover:translate-y-[-2px] transition-all">Anterior</button>
                    <div class="flex gap-2">
                        <button class="w-12 h-12 bg-black text-white neo-border font-bold text-lg">1</button>
                        <button class="w-12 h-12 bg-white text-black neo-border font-bold text-lg hover:bg-gray-100 transition-colors">2</button>
                        <button class="w-12 h-12 bg-white text-black neo-border font-bold text-lg hover:bg-gray-100 transition-colors">3</button>
                        <div class="w-12 h-12 flex items-center justify-center font-bold">...</div>
                        <button class="w-12 h-12 bg-white text-black neo-border font-bold text-lg hover:bg-gray-100 transition-colors">12</button>
                    </div>
                    <button class="px-6 py-3 bg-white neo-border neo-shadow-sm font-bold uppercase hover:translate-x-[-2px] hover:translate-y-[-2px] transition-all">Próxima</button>
                    </div></footer>
                    </main>
            </div>
        `;

        App.templates.trabalho_detalhe = `
            <div id="view-trabalho-detalhe" class="min-h-screen bg-[#D4FF00]">
                <div class="p-6 md:p-8 space-y-8 max-w-[1280px] mx-auto w-full pb-20">
                <div class="flex flex-col gap-2">
                    <div class="font-label-sm text-label-sm text-black opacity-70 flex items-center gap-2">
                    <a class="hover:underline" data-spa-link data-route="inicio" href="#inicio">Início</a> &gt;
                    <a class="hover:underline" data-spa-link data-route="trabalhos" href="#trabalhos">Trabalhos</a> &gt;
                    <span>Detalhe do Trabalho</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    <!-- Coluna Esquerda: Detalhes -->
                    <div class="lg:col-span-8 flex flex-col gap-6">
                        <div class="bg-white rounded-[24px] p-8 hard-shadow flex flex-col">
    
                            <!-- Job Header Section -->
                            <div class="pb-8">
                                <div class="flex justify-between items-start mb-4">
                                    <span class="inline-block bg-[#D4FF00] text-black text-[12px] font-bold px-3 py-1 rounded-full">Design Gráfico</span>
                                    <div class="flex gap-2">
                                        <span class="material-symbols-outlined text-gray-500 hover:text-black cursor-pointer transition-colors text-[20px]">link</span>
                                        <span class="material-symbols-outlined text-gray-500 hover:text-black cursor-pointer transition-colors text-[20px]">push_pin</span>
                                    </div>
                                </div>

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
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-[20px] opacity-70">bolt</span>
                                        <span class="font-body-md text-body-md font-bold text-green-600">Aberto a propostas</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-[20px] opacity-70">calendar_today</span>
                                        <span class="font-body-md text-body-md">Publicado há 2 horas</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Bar -->
                            <div class="flex gap-3 pb-8 flex-wrap">
                                <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-700 text-xs font-bold px-3 py-1.5 rounded-full border border-gray-200">
                                    <span class="material-symbols-outlined text-[14px]">credit_card</span> Multicaixa Express
                                </span>
                                <span class="inline-flex items-center gap-1 bg-green-50 text-green-700 text-xs font-bold px-3 py-1.5 rounded-full border border-green-200">
                                    <span class="material-symbols-outlined text-[14px]">verified_user</span> Cliente Verificado
                                </span>
                                <span class="inline-flex items-center gap-1 bg-yellow-50 text-yellow-700 text-xs font-bold px-3 py-1.5 rounded-full border border-yellow-200">
                                    <span class="material-symbols-outlined text-[14px]">star</span> Job em Destaque
                                </span>
                            </div>

                            <hr class="border-gray-100">

                            <!-- Project Description Section -->
                            <div class="py-8 flex flex-col gap-4">
                                <h2 class="font-headline-sm text-black">Descrição do Projeto</h2>
                                <div class="font-body-md text-gray-700 space-y-4 break-words leading-[1.6]">
                                    <p>Estamos à procura de um designer gráfico talentoso e experiente para desenvolver a identidade visual completa da nossa nova empresa de logística, a "RápidaExpress", focada em entregas last-mile na grande Luanda.</p>
                                    <p>Precisamos de algo moderno, que transmita confiança, velocidade e inovação tecnológica. O design deve ser facilmente aplicável tanto em meios digitais (app, website) como físicos (uniformes, viaturas de entrega, embalagens).</p>
                                    <p>A entrega final deve incluir todos os ficheiros abertos e um manual de normas da marca detalhado.</p>
                                </div>
                            </div>

                            <hr class="border-gray-100">

                            <!-- Deliverables Section -->
                            <div class="py-8 flex flex-col gap-4">
                                <h2 class="font-headline-sm text-black">O que precisamos (Entregáveis)</h2>
                                <ul class="flex flex-col gap-4 mt-2">
                                    <li class="flex items-start gap-3">
                                        <span class="material-symbols-outlined text-green-600 text-[24px]">check_circle</span>
                                        <span class="font-body-md text-gray-700 break-words">Design de Logótipo (Versões principal, secundária e monocromática)</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="material-symbols-outlined text-green-600 text-[24px]">check_circle</span>
                                        <span class="font-body-md text-gray-700 break-words">Paleta de cores e tipografia institucional</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="material-symbols-outlined text-green-600 text-[24px]">check_circle</span>
                                        <span class="font-body-md text-gray-700 break-words">Design para cartões de visita e papel timbrado</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="material-symbols-outlined text-green-600 text-[24px]">check_circle</span>
                                        <span class="font-body-md text-gray-700 break-words">Mockups de aplicação em viatura (carrinha) e uniforme (t-shirt/boné)</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="material-symbols-outlined text-green-600 text-[24px]">check_circle</span>
                                        <span class="font-body-md text-gray-700 break-words">Manual de Normas da Marca (Brandbook em PDF)</span>
                                    </li>
                                </ul>
                            </div>

                            <hr class="border-gray-100">

                            <!-- Skills Section -->
                            <div class="py-8 flex flex-col gap-4">
                                <h2 class="font-headline-sm text-black">Competências necessárias</h2>
                                <div class="flex flex-wrap gap-3 mt-2">
                                    <span class="px-4 py-2 bg-gray-100 border border-gray-200 rounded-full font-label-md text-gray-800">Adobe Illustrator</span>
                                    <span class="px-4 py-2 bg-gray-100 border border-gray-200 rounded-full font-label-md text-gray-800">Adobe Photoshop</span>
                                    <span class="px-4 py-2 bg-gray-100 border border-gray-200 rounded-full font-label-md text-gray-800">Design de Identidade Visual</span>
                                    <span class="px-4 py-2 bg-gray-100 border border-gray-200 rounded-full font-label-md text-gray-800">Branding</span>
                                    <span class="px-4 py-2 bg-gray-100 border border-gray-200 rounded-full font-label-md text-gray-800">Figma</span>
                                </div>
                            </div>

                            <hr class="border-gray-100">

                            <!-- Screening Questions Section -->
                            <div class="pt-8 flex flex-col gap-4">
                                <h2 class="font-headline-sm text-black flex items-center gap-2">
                                    <span class="material-symbols-outlined text-orange-500">help</span> Perguntas de triagem
                                </h2>
                                <p class="font-body-md text-gray-700 mb-2">Terá de responder a estas perguntas ao enviar a sua proposta:</p>
                                <div class="flex flex-col gap-4">
                                    <div class="bg-gray-50 border-l-[4px] border-orange-400 p-4 rounded-r-lg">
                                        <p class="font-body-md text-black font-semibold">1. Pode partilhar o seu portfólio com trabalhos semelhantes na área de transportes/logística?</p>
                                    </div>
                                    <div class="bg-gray-50 border-l-[4px] border-orange-400 p-4 rounded-r-lg">
                                        <p class="font-body-md text-black font-semibold">2. Qual é a sua disponibilidade para eventuais reuniões presenciais em Luanda (Talatona)?</p>
                                    </div>
                                </div>
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

        App.templates.propostas = `
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
            </div>
        `;

        App.templates.mensagens = `
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

        App.templates.mensagens_sala = `
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
                    <button data-spa-link data-route="mensagens" class="inline-flex items-center gap-2 font-label-md text-label-md text-black font-bold hover:opacity-70">
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

        App.templates.perfil =`
            <div id="view-perfil" class="bg-[#CCFF00] text-black font-body-md text-body-md">
                <main class="max-w-7xl mx-auto px-margin-mobile md:px-margin-desktop py-12 min-h-screen">
                    
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                    <!-- Local Anchor Navigation -->
                    <nav class="lg:col-span-3 space-y-1">
                        <a
                        class="flex items-center gap-3 px-4 py-3 border-2 border-black bg-black text-white font-label-md text-label-md transition-all duration-200"
                        href="#minha-info"
                        >
                        <span class="material-symbols-outlined text-[20px]">person</span>
                        Minha informação
                        </a>

                        <a class="flex items-center gap-3 px-4 py-3 text-black/80 hover:text-black font-label-md text-label-md transition-all duration-200" href="#">
                        <span class="material-symbols-outlined text-[20px]">payments</span>
                        Faturação e pagamentos
                        </a>

                        <a class="flex items-center gap-3 px-4 py-3 text-black/80 hover:text-black font-label-md text-label-md transition-all duration-200" href="#">
                        <span class="material-symbols-outlined text-[20px]">shield</span>
                        Palavra-passe e segurança
                        </a>

                        <a class="flex items-center gap-3 px-4 py-3 text-black/80 hover:text-black font-label-md text-label-md transition-all duration-200" href="#">
                        <span class="material-symbols-outlined text-[20px]">notifications</span>
                        Definições de notificações
                        </a>

                        <a class="flex items-center gap-3 px-4 py-3 text-black/80 hover:text-black font-label-md text-label-md transition-all duration-200" href="#">
                        <span class="material-symbols-outlined text-[20px]">groups</span>
                        Teams
                        </a>

                        <a class="flex items-center gap-3 px-4 py-3 text-black/80 hover:text-black font-label-md text-label-md transition-all duration-200" href="#">
                        <span class="material-symbols-outlined text-[20px]">settings</span>
                        Preferências
                        </a>
                    </nav>

                    <!-- Main Content Area -->
                    <div class="lg:col-span-9 space-y-8">
                        <!-- Section: Minha informação -->
                        <section id="minha-info" class="bg-white border-2 border-black p-8 relative card-shadow">
                        <button class="absolute top-6 right-6 p-2 hover:bg-black/5 text-black transition-colors">
                            <span class="material-symbols-outlined">edit</span>
                        </button>

                        <div class="flex flex-col md:flex-row gap-8 items-start">
                            <div class="relative group">
                            <img
                                alt="Profile"
                                class="w-32 h-32 object-cover border-2 border-black grayscale hover:grayscale-0 transition-all duration-500"
                                src="/img/foto_perfil_exemplar.png"
                            />
                            <div class="absolute -bottom-2 -right-2 bg-black text-white p-1.5 border border-black">
                                <span class="material-symbols-outlined text-[18px]" data-weight="fill">verified</span>
                            </div>
                            </div>

                            <div class="flex-1 space-y-4">
                            <div>
                                <h2 class="font-headline-md text-headline-md text-black">Pedro Manuel</h2>
                                <p class="font-label-md text-label-md text-black/70">@pedromanuel</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-black">
                                <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">work</span>
                                <span class="font-body-md">Designer UI/UX Senior</span>
                                </div>
                                <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">location_on</span>
                                <span class="font-body-md">Luanda, Angola</span>
                                </div>
                            </div>

                            <p class="text-black leading-relaxed max-w-2xl">
                                Apaixonado por criar experiências digitais que fundem funcionalidade técnica com estética brutalista.
                                Especialista em sistemas de design escaláveis e interfaces de alta performance para produtos SaaS globais.
                            </p>

                            <div class="flex flex-wrap gap-2 pt-2">
                                <span class="px-3 py-1 bg-black text-white font-label-sm text-label-sm uppercase tracking-wider">Interface Design</span>
                                <span class="px-3 py-1 bg-black text-white font-label-sm text-label-sm uppercase tracking-wider">Figma Expert</span>
                                <span class="px-3 py-1 bg-black text-white font-label-sm text-label-sm uppercase tracking-wider">Prototyping</span>
                                <span class="px-3 py-1 bg-black text-white font-label-sm text-label-sm uppercase tracking-wider">React UI</span>
                            </div>
                            </div>
                        </div>
                        </section>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Section: Informação de contacto -->
                        <section class="bg-white border-2 border-black p-8 relative card-shadow">
                            <button class="absolute top-6 right-6 p-2 hover:bg-black/5 text-black transition-colors">
                            <span class="material-symbols-outlined">edit</span>
                            </button>

                            <h3 class="font-headline-md text-headline-md text-black mb-6">Informação de contacto</h3>

                            <div class="space-y-4">
                            <div class="flex flex-col">
                                <span class="font-label-sm text-label-sm text-black/70 uppercase mb-1">Email</span>
                                <span class="text-black font-body-md">pe*********@skilla.com</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-label-sm text-label-sm text-black/70 uppercase mb-1">Telemóvel</span>
                                <span class="text-black font-body-md">+244 923 *** 456</span>
                            </div>
                            </div>
                        </section>

                        <!-- Section: Destacar perfil -->
                        <section class="bg-black p-8 flex flex-col justify-between items-start border-none group overflow-hidden relative card-shadow">
                            <div class="absolute -right-8 -top-8 w-32 h-32 bg-white opacity-10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
                            <div class="relative z-10">
                            <h3 class="font-headline-md text-headline-md text-white mb-2">Alcance mais clientes</h3>
                            <p class="text-white font-body-md mb-6 opacity-80">
                                Promova o seu perfil para o topo das pesquisas e receba 3x mais propostas diretas.
                            </p>
                            </div>
                            <button class="px-6 py-3 bg-white text-black font-label-md text-label-md border-2 border-white hover:bg-black hover:text-white transition-all duration-200 relative z-10">
                            Destacar perfil
                            </button>
                        </section>
                        </div>

                        <!-- Portfólio em destaque -->
                        <section class="space-y-6 pt-4">
                        <div class="flex justify-between items-end">
                            <div>
                            <h3 class="font-headline-md text-headline-md text-black">Portfólio em destaque</h3>
                            <p class="text-black/70 font-body-md">Exiba os seus melhores trabalhos para potenciais clientes.</p>
                            </div>
                            <a class="text-black font-bold font-label-md text-label-md flex items-center gap-1 hover:underline underline-offset-4" href="#">
                            Gerir portfólio
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                            </a>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="group cursor-pointer">
                            <div class="aspect-video overflow-hidden bg-white border-2 border-black mb-3 relative card-shadow transition-transform hover:-translate-y-1">
                                <img class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 group-hover:scale-110"
                                alt="Project 1"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBLapq4NnoPNElbAVd9m_VWF8nmc0zPd0k4mM42Day2e_E-iRgRrb-EGtmgIdmZ4aREoS7rvWff5Dag4CSa_LvmbxFCO08KAfJYkFa3D1reRSfPteTMoyCpKwbSdQfQfXT6V7MnCLb51cX4m2IPYEtZNRM-YWXfgCzFwURdmY2V898T8Walttt7ozTrZede2lI60FfrWru-lcvqxJ2wpTMMEBbmgi3EY8JQLWpjRA4i4OTEJ-WmGzHPV4Yi4UhsZFgf1Tb843Pn0xU" />
                            </div>
                            <h4 class="font-label-md text-label-md text-black group-hover:underline decoration-2 transition-colors">NovaPay Mobile App</h4>
                            <p class="font-label-sm text-label-sm text-black/70 uppercase">Fintech • 2023</p>
                            </div>

                            <div class="group cursor-pointer">
                            <div class="aspect-video overflow-hidden bg-white border-2 border-black mb-3 relative card-shadow transition-transform hover:-translate-y-1">
                                <img class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 group-hover:scale-110"
                                alt="Project 2"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuD14VabbFyfYxboRlBjHkRAYZBbxAQXXmK-ewnGbtEDcEiLSEBjnkOgxQOSSK89cZxWRVA4WfAqk5BbQdonraNXUyDiDUKFOOGEhrtSU375GB6-_3zLWbKUenOO2QIyccZlB-bmYfe85lenHmj4ILbrase_vqdEcyeF-_A5-h1oeIMD-UngkK1vVusAI3bqO4KdV886-mNAa4QRY2PgK_Qx0TdQLt44lYe7h6MqfV5tz9i33GjDa6052hYkPmy2Yp3x-dvSNo8FJak" />
                            </div>
                            <h4 class="font-label-md text-label-md text-black group-hover:underline decoration-2 transition-colors">Kinetix Design System</h4>
                            <p class="font-label-sm text-label-sm text-black/70 uppercase">Design System • 2024</p>
                            </div>

                            <div class="group cursor-pointer">
                            <div class="aspect-video overflow-hidden bg-white border-2 border-black mb-3 relative card-shadow transition-transform hover:-translate-y-1">
                                <img class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 group-hover:scale-110"
                                alt="Project 3"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDmZnYVCZiBL3lE639tZin3AcmhPR0LjGMxg6n-5w8k__IXlwAsCz0unBtb3zUVamifLC79zFyFim82h7lEAMyn2ETUGBO6iNBwsFAxHr9x8Pxx0uWnq8VU9N9Q9TDzjPl3Tj3I1XXiY-o9UXs2LdXzJyBWsjDmnE8zRa78Q-rmyDp0wv7ZKYExFATyHO0mLZ46YpWKVdHfrTIJTAKOeBLLGcDUptg37erP19ElN7xa1gDCSf62_M7aWykqCl8bqp1iMYoEeEIV00M" />
                            </div>
                            <h4 class="font-label-md text-label-md text-black group-hover:underline decoration-2 transition-colors">Vortex Analytics Web</h4>
                            <p class="font-label-sm text-label-sm text-black/70 uppercase">Dashboards • 2023</p>
                            </div>
                        </div>
                        </section>

                        <div class="pt-12 border-t border-black flex justify-end items-center gap-4">
                        <button class="px-6 py-2 text-black/70 hover:text-black font-label-md text-label-md transition-colors">Descartar</button>
                        <button class="px-8 py-3 bg-black text-white font-label-md text-label-md border-2 border-black hover:bg-white hover:text-black transition-all">
                            Guardar alterações
                        </button>
                        </div>
                    </div>
                    </div>
                </main>
            </div>
        `;

        // Funções de Apoio SPA
        function setActiveLink(route) {
            const links = document.querySelectorAll('[data-spa-link]');
            links.forEach(link => {
                const linkRoute = link.dataset.route || link.getAttribute('data-route');
                const isMatch = linkRoute === route || 
                               (route.startsWith('carteira') && linkRoute === 'carteira') ||
                               (route === 'trabalho_detalhe' && linkRoute === 'trabalhos') ||
                               (route === 'mensagens_sala' && linkRoute === 'mensagens');
                               
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
            window.scrollTo(0, 0);

            setActiveLink(route);
            if (push) history.pushState({ route }, '', `#${route}`);
            
            initRouteScripts(route);
        }

        function initRouteScripts(route) {
            console.log('SPA Render:', route);
            
            // Voltar Global
            spaView.querySelectorAll('[data-wallet-back], [data-back-to-inbox], [data-success-back-wallet]').forEach(btn => {
                btn.addEventListener('click', () => {
                    if (btn.hasAttribute('data-back-to-inbox')) render('mensagens');
                    else render('carteira');
                });
            });

            // Lógica Carteira
            if (route === 'carteira') {
                 spaView.querySelectorAll('[data-wallet-action]').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        const action = btn.getAttribute('data-wallet-action');
                        if (action === 'carregar-saldo') render('carteira_carregar_saldo');
                        if (action === 'ver-extrato') render('carteira_ver_extrato');
                        if (action === 'pedir-saque') render('carteira_pedir_saque');
                        if (action === 'comprar-creditos') render('carteira_comprar_creditos');
                        if (action === 'extrato-creditos') render('carteira_extrato_creditos');
                        if (action === 'copiar-iban') {
                            navigator.clipboard.writeText("AO06 1234 5678 9012 3456 7890 1");
                            alert("IBAN copiado!");
                        }
                    });
                });
            }

            if (route === 'carteira_comprar_creditos') {
                const summaryCost = spaView.querySelector('#summary-cost');
                const summaryPkg = spaView.querySelector('#summary-pkg');
                const summaryDebit = spaView.querySelector('#summary-debit-msg');
                const summaryAfter = spaView.querySelector('#summary-after');
                const buyBtn = spaView.querySelector('#buy-button');
                const balance = 125000;

                spaView.querySelectorAll('input[name="credit_package"]').forEach(radio => {
                    radio.addEventListener('change', () => {
                        const credits = radio.dataset.credits;
                        const cost = parseInt(radio.dataset.cost);
                        summaryPkg.innerText = `${credits} créditos`;
                        summaryCost.innerText = `${cost.toLocaleString()} Kz`;
                        summaryDebit.innerText = `${cost.toLocaleString()} Kz`;
                        summaryAfter.innerText = `${(balance - cost).toLocaleString()} Kz`;
                    });
                });

                buyBtn?.addEventListener('click', () => {
                    alert('Compra de créditos realizada com sucesso!');
                    render('carteira');
                });
            }

            if (route === 'carteira_carregar_saldo') {
                 const modal = spaView.querySelector('#successModal');
                 spaView.querySelector('[data-open-success-modal]')?.addEventListener('click', () => {
                     modal?.classList.remove('hidden');
                     modal?.classList.add('flex');
                 });
                 spaView.querySelector('[data-success-go-extrato]')?.addEventListener('click', () => render('carteira_ver_extrato'));
            }

            if (route === 'carteira_extrato_creditos') {
                spaView.querySelector('[data-go-add-creditos]')?.addEventListener('click', () => render('carteira_comprar_creditos'));
            }

            // Lógica Trabalhos
            if (route === 'trabalhos') {
                spaView.querySelectorAll('[data-open-job]').forEach(btn => {
                    btn.addEventListener('click', () => render('trabalho_detalhe'));
                });
            }

            if (route === 'trabalho_detalhe') {
                const modal = spaView.querySelector('#modal-overlay');
                spaView.querySelector('[data-open-proposta-modal]')?.addEventListener('click', () => {
                    modal?.classList.remove('hidden');
                    modal?.classList.add('flex');
                });
                spaView.querySelectorAll('[data-close-proposta-modal]').forEach(btn => {
                    btn.addEventListener('click', () => {
                        modal?.classList.add('hidden');
                        modal?.classList.remove('flex');
                    });
                });
                spaView.querySelector('#proposta-form')?.addEventListener('submit', (e) => {
                    e.preventDefault();
                    alert('Proposta enviada com sucesso!');
                    render('propostas');
                });
            }

            // Lógica Mensagens
            if (route === 'mensagens') {
                spaView.querySelectorAll('[data-open-chat]').forEach(card => {
                    card.addEventListener('click', () => render('mensagens_sala'));
                });
            }

            if (route === 'inicio') {
                spaView.querySelector('#btn-explorar-trabalhos')?.addEventListener('click', () => render('trabalhos'));
            }
        }

        // Navegação Global
        document.addEventListener('click', (e) => {
            const el = e.target.closest('[data-spa-link], [data-route], a[href^="#"]');
            if (el) {
                if (el.tagName === 'A' && el.getAttribute('href') === '#') return;

                const route = el.dataset.route || el.getAttribute('data-route') || el.getAttribute('href')?.substring(1);
                if (route && (App.templates[route] || route === 'inicio')) {
                    e.preventDefault();
                    render(route);
                }
            }
        });

        window.addEventListener('popstate', (e) => {
            if (e.state && e.state.route) {
                render(e.state.route, false);
            } else {
                const hash = window.location.hash.substring(1) || 'inicio';
                render(hash, false);
            }
        });

        // Init
        document.addEventListener('DOMContentLoaded', () => {
            const initial = window.location.hash.substring(1) || 'inicio';
            render(initial);
        });

    })();
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                
                // Active state toggle
                document.querySelectorAll('nav a').forEach(a => {
                    a.classList.remove('bg-primary', 'text-white', 'border-2', 'border-primary');
                    a.classList.add('text-on-surface-variant', 'hover:text-black');
                });
                this.classList.add('bg-primary', 'text-white', 'border-2', 'border-primary');
                this.classList.remove('text-on-surface-variant', 'hover:text-black');
            }
        });
    });

    // Micro-interactions for neo-brutalism feel
        document.querySelectorAll('button, article').forEach(el => {
            el.addEventListener('mousedown', () => {
                if(el.classList.contains('neo-shadow')) {
                    el.style.transform = 'translate(4px, 4px)';
                    el.style.boxShadow = '2px 2px 0px 0px #000';
                }
                if(el.classList.contains('neo-shadow-sm')) {
                    el.style.transform = 'translate(2px, 2px)';
                    el.style.boxShadow = '1px 1px 0px 0px #000';
                }
            });
            el.addEventListener('mouseup', () => {
                el.style.transform = '';
                el.style.boxShadow = '';
            });
            el.addEventListener('mouseleave', () => {
                el.style.transform = '';
                el.style.boxShadow = '';
            });
        });
</script>
</body>
</html>