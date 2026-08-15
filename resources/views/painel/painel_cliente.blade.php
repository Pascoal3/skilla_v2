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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Space+Grotesk:wght@400;500;600;700;900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&amp;family=Hanken+Grotesk:wght@400;500;600;700&amp;family=JetBrains+Mono:wght@500&amp;display=swap" rel="stylesheet">

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
    <script src="{{ asset('js/mensagens-sala.js') }}" defer></script>

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
        .text-verde{ color: #CCFF00;}
        body { 
            background-color: #CCFF00; 
    
        }
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
        .neo-shadow {
            box-shadow: 6px 6px 0px 0px #000000;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .neo-card {
            box-shadow: 4px 4px 0px 0px #101415;
        }
        .neo-button:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px #101415;
        }
        .neo-button:active {
            transform: translate(0px, 0px);
            box-shadow: 2px 2px 0px 0px #101415;
        }
    </style>
    <script src="{{ asset('js/proposta.js') }}" defer></script>
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
                <input class="w-full pl-12 pr-4 py-3 rounded-full bg-white border border-outline focus:border-black-pure focus:ring-2 focus:ring-black-pure transition-all outline-none font-body-md text-on-primary-fixed" placeholder="Pesquisar projetos, freelancers..." type="text">
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
    <div flex-1 px-container-padding-mobile md:px-container-padding-desktop pb-20 flex flex-col gap-8">

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

        window.jobPostingData = window.jobPostingData || {
            step: 1,
            title: ""
        };
        const WizardPublicarTrabalho = {
        open() {
            jobPostingData.step = 1;
            render('publicar_trabalho_step_1');
        },

        bind() {
            const titleEl = spaView.querySelector('#wiz-title');
            const errEl = spaView.querySelector('#wiz-title-error');

            // hidratar se já tiver valor
            if (titleEl) titleEl.value = jobPostingData.title || '';

            titleEl?.addEventListener('input', () => {
            jobPostingData.title = titleEl.value;
            if (errEl) errEl.classList.add('hidden');
            });

            spaView.querySelectorAll('[data-wiz-action="back"]').forEach(btn => {
            btn.addEventListener('click', () => render('trabalhos'));
            });

            spaView.querySelectorAll('[data-wiz-action="next"]').forEach(btn => {
            btn.addEventListener('click', () => {
                const value = (titleEl?.value || '').trim();
                if (!value) {
                if (errEl) errEl.classList.remove('hidden');
                titleEl?.focus();
                return;
                }
                jobPostingData.title = value;

                alert('Step 1 OK. Próximo passo ainda não implementado.');
            });
            });
        }
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
                            <p class="text-body-sm font-body-sm text-black-pure mb-1">Saldo Disponível</p>
                            <p class="text-metric-lg font-metric-lg text-[#1A1A1A]" id="wallet-balance">0,00 KZS</p>
                            </div>
                            <div class="mb-8 bg-[#1A1A1A] p-4 rounded-lg">
                            <p class="text-body-sm font-body-sm text-[#CCFF00] mb-1">Em Escrow (Cativos)</p>
                            <p class="text-headline-md font-headline-md text-[#CCFF00]" id="escrow-amount">0,00 KZS</p>
                            </div>
                            <div class="mt-auto">
                                <button id="botaoDirecionarCarregarSaldo" class="group flex items-center justify-center gap-2 bg-[#CCFF00] text-black-pure py-4 px-6 rounded-xl font-bold shadow-md transform transition-all duration-200 ease-out hover:scale-[1.02]">
                                    <span class="material-symbols-outlined transition-transform duration-300 ease-in-out group-hover:rotate-90">
                                        add
                                    </span>
                                    Carregar saldo
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
                                placeholder="0 Kz" type="text" value="2.000">
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
                <main class="w-full mx-auto px-margin-mobile md:px-gutter pt-8 pb-20">
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
<button class="p-2 neo-border rounded-lg bg-white hover:bg-[#CCFF00] transition-colors group">
    <span class="material-symbols-outlined group-hover:text-black transition-colors" data-icon="edit">
        edit
    </span>
</button>

<button class="p-2 neo-border rounded-lg bg-white hover:bg-[#CCFF00] transition-colors group">
    <span class="material-symbols-outlined group-hover:text-black transition-colors" data-icon="visibility">
        visibility
    </span>
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
<button class="p-2 neo-border rounded-lg bg-white hover:bg-[#CCFF00] transition-colors group">
    <span class="material-symbols-outlined group-hover:text-black transition-colors" data-icon="edit">
        edit
    </span>
</button>

<button class="p-2 neo-border rounded-lg bg-white hover:bg-[#CCFF00] transition-colors group">
    <span class="material-symbols-outlined group-hover:text-black transition-colors" data-icon="visibility">
        visibility
    </span>
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
<button class="p-2 neo-border rounded-lg bg-white hover:bg-[#CCFF00] transition-colors group">
    <span class="material-symbols-outlined group-hover:text-black transition-colors" data-icon="edit">
        edit
    </span>
</button>

<button class="p-2 neo-border rounded-lg bg-white hover:bg-[#CCFF00] transition-colors group">
    <span class="material-symbols-outlined group-hover:text-black transition-colors" data-icon="visibility">
        visibility
    </span>
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
            <div id="view-propostas-freela" class="bg-[#CCFF00] font-body-md text-on-background w-full">

                <main class="w-full mx-auto px-margin-mobile md:px-gutter pt-8 pb-20">
                    <!-- Header / Topbar -->
                    <header class="flex flex-col md:flex-row items-center justify-between gap-4 mb-12">
                    <h1 class="text-5xl text-black uppercase italic tracking-tighter border-b-[8px] border-black inline-block">Propostas Recebidas</h1>
                    </header>
                    <nav class="flex flex-wrap gap-3 mb-12">
                        <button class="px-6 py-2 bg-black text-white neo-border font-bold rounded-full transition-transform active:scale-95">Aceitas</button>
                        <button class="px-6 py-2 bg-white text-black neo-border font-bold rounded-full hover:bg-gray-100 transition-all">Pendente</button>
                        <button class="px-6 py-2 bg-white text-black neo-border font-bold rounded-full hover:bg-gray-100 transition-all">Rejeitadas</button>
                    </nav>
                    <!-- Proposals List -->
                    <div class="space-y-6">
                        <!-- Card 1 -->
                        <div class="neo-card bg-white border-2 border-background rounded-xxl p-6 transition-all hover:scale-[1.01]">
                            <div class="flex justify-between items-start mb-6">
                                <h2 class="font-headline-md text-headline-md text-background max-w-[70%]">Desenvolvimento de Landing Page de Alta Conversão</h2>
                                <span class="bg-[#4CAF50] text-white px-4 py-1 rounded-full font-label-md text-label-md border border-background">Aceito</span>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div>
                                    <p class="text-label-sm font-label-sm text-gray-600 uppercase">Data de envio</p>
                                    <p class="font-bold text-background">18/12/2024</p>
                                </div>
                                <div>
                                <p class="text-label-sm font-label-sm text-gray-600 uppercase">Valor proposto</p>
                                <p class="font-bold text-background">150.000 Kz</p>
                                </div>
                                <div>
                                <p class="text-label-sm font-label-sm text-gray-600 uppercase">Prazo de entrega</p>
                                <p class="font-bold text-background">7 dias</p>
                                </div>
                                <div>
                                <p class="text-label-sm font-label-sm text-gray-600 uppercase">ID</p>
                                <p class="font-bold text-background">#1042</p>
                            </div>
                            
                        
                        </div>    
                        
                </div>
                <!-- Card 2 -->
                <div class="neo-card bg-white border-2 border-background rounded-xxl p-6 transition-all hover:scale-[1.01]">
                <div class="flex justify-between items-start mb-6">
                <h2 class="font-headline-md text-headline-md text-background max-w-[70%]">App Mobile de Entrega (UI/UX Design)</h2>
                <span class="bg-[#FFD700] text-background px-4 py-1 rounded-full font-label-md text-label-md border border-background">Pendente</span>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div>
                <p class="text-label-sm font-label-sm text-gray-600 uppercase">Data de envio</p>
                <p class="font-bold text-background">28/05/2024</p>
                </div>
                <div>
                <p class="text-label-sm font-label-sm text-gray-600 uppercase">Valor proposto</p>
                <p class="font-bold text-background">450.000 Kz</p>
                </div>
                <div>
                <p class="text-label-sm font-label-sm text-gray-600 uppercase">Prazo de entrega</p>
                <p class="font-bold text-background">21 dias</p>
                </div>
                <div>
                <p class="text-label-sm font-label-sm text-gray-600 uppercase">ID</p>
                <p class="font-bold text-background">#1055</p>
                </div>
                </div>
                <div class="flex justify-end gap-4 mt-8 divDosIcones">
  <button class="p-2 neo-border rounded-lg bg-white hover:bg-[#CCFF00] transition-colors group js-aceitar">
    <span class="material-symbols-outlined group-hover:text-black transition-colors">check_circle</span>
  </button>

  <button class="p-2 neo-border rounded-lg bg-white hover:bg-[#CCFF00] transition-colors group js-rejeitar">
    <span class="material-symbols-outlined group-hover:text-black transition-colors">cancel</span>
  </button>
</div>
                </div>
                <!-- Card 3 -->
                <div class="neo-card bg-white border-2 border-background rounded-xxl p-6 transition-all hover:scale-[1.01]">
                <div class="flex justify-between items-start mb-6">
                <h2 class="font-headline-md text-headline-md text-background max-w-[70%]">Identidade Visual para Startup de Fintech</h2>
                <span class="bg-[#FF5252] text-white px-4 py-1 rounded-full font-label-md text-label-md border border-background">Rejeitado</span>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div>
                <p class="text-label-sm font-label-sm text-gray-600 uppercase">Data de envio</p>
                <p class="font-bold text-background">18/03/2024</p>
                </div>
                <div>
                <p class="text-label-sm font-label-sm text-gray-600 uppercase">Valor proposto</p>
                <p class="font-bold text-background">200.000 Kz</p>
                </div>
                <div>
                <p class="text-label-sm font-label-sm text-gray-600 uppercase">Prazo de entrega</p>
                <p class="font-bold text-background">14 dias</p>
                </div>
                <div>
                <p class="text-label-sm font-label-sm text-gray-600 uppercase">ID</p>
                <p class="font-bold text-background">#1031</p>
                </div>
                </div>
                </div>
                <!-- Card 4 -->
                <div id="card4-proposta" class="neo-card bg-white border-2 border-background rounded-xxl p-6 transition-all hover:scale-[1.01]">
                <div class="flex justify-between items-start mb-6">
                <h2 class="font-headline-md text-headline-md text-background max-w-[70%]">Manutenção de Banco de Dados e-Commerce</h2>
                <span class="bg-[#FFD700] text-background px-4 py-1 rounded-full font-label-md text-label-md border border-background">Pendente</span>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div>
                <p class="text-label-sm font-label-sm text-gray-600 uppercase">Data de envio</p>
                <p class="font-bold text-background">18/01/2024</p>
                </div>
                <div>
                <p class="text-label-sm font-label-sm text-gray-600 uppercase">Valor proposto</p>
                <p class="font-bold text-background">75.000 Kz</p>
                </div>
                <div>
                <p class="text-label-sm font-label-sm text-gray-600 uppercase">Prazo de entrega</p>
                <p class="font-bold text-background">3 dias</p>
                </div>
                <div>
                <p class="text-label-sm font-label-sm text-gray-600 uppercase">ID</p>
                <p class="font-bold text-background">#1062</p>
                </div>
                </div>
                <div class="flex justify-end gap-4 mt-8 divDosIcones">
  <button class="p-2 neo-border rounded-lg bg-white hover:bg-[#CCFF00] transition-colors group js-aceitar">
    <span class="material-symbols-outlined group-hover:text-black transition-colors">check_circle</span>
  </button>

  <button class="p-2 neo-border rounded-lg bg-white hover:bg-[#CCFF00] transition-colors group js-rejeitar">
    <span class="material-symbols-outlined group-hover:text-black transition-colors">cancel</span>
  </button>
</div>
                </div>
                <!-- Card 5 -->
                <div id="card5-proposta" class="neo-card bg-white border-2 border-background rounded-xxl p-6 transition-all hover:scale-[1.01]">
                <div class="flex justify-between items-start mb-6">
                <h2 class="font-headline-md text-headline-md text-background max-w-[70%]">Criação de Website Institucional Responsivo</h2>
                <span class="bg-[#FFD700] text-background px-4 py-1 rounded-full font-label-md text-label-md border border-background">Pendente</span>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div>
                <p class="text-label-sm font-label-sm text-gray-600 uppercase">Data de envio</p>
                <p class="font-bold text-background">02/02/2024</p>
                </div>
                <div>
                <p class="text-label-sm font-label-sm text-gray-600 uppercase">Valor proposto</p>
                <p class="font-bold text-background">320.000 Kz</p>
                </div>
                <div>
                <p class="text-label-sm font-label-sm text-gray-600 uppercase">Prazo de entrega</p>
                <p class="font-bold text-background">10 dias</p>
                </div>
                <div>
                <p class="text-label-sm font-label-sm text-gray-600 uppercase">ID</p>
                <p class="font-bold text-background">#1070</p>
                </div>
                </div>
                <div class="flex justify-end gap-4 mt-8 divDosIcones">
  <button class="p-2 neo-border rounded-lg bg-white hover:bg-[#CCFF00] transition-colors group js-aceitar">
    <span class="material-symbols-outlined group-hover:text-black transition-colors">check_circle</span>
  </button>

  <button class="p-2 neo-border rounded-lg bg-white hover:bg-[#CCFF00] transition-colors group js-rejeitar">
    <span class="material-symbols-outlined group-hover:text-black transition-colors">cancel</span>
  </button>
</div>
                </div>
                
                </div>
                <!-- Pagination -->
                <footer class="mt-16 flex justify-center">
                <nav class="flex items-center gap-2">
                <button class="neo-button bg-white border-2 border-background px-4 py-2 rounded-lg font-label-md text-label-md transition-all">Anterior</button>
                <div class="flex gap-1">
                <button class="w-10 h-10 flex items-center justify-center border-2 border-background bg-background text-white rounded-lg font-label-md">1</button>
                <button class="w-10 h-10 flex items-center justify-center border-2 border-background bg-white text-background rounded-lg font-label-md hover:bg-gray-100">2</button>
                <button class="w-10 h-10 flex items-center justify-center border-2 border-background bg-white text-background rounded-lg font-label-md hover:bg-gray-100">3</button>
                <span class="w-10 h-10 flex items-center justify-center font-bold text-black">...</span>
                </div>
                <button class="neo-button bg-white border-2 border-background px-4 py-2 rounded-lg font-label-md text-label-md transition-all">Próximo</button>
                </nav>
                </footer>
                </main>
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
                                <span class="w-1.5 h-1.5 rounded-full bg-[#CCFF00] text-verde"></span>
                                <span class="font-label-sm text-label-sm  font-bold text-verde">Estado: <span id="estado_contrato">Ativo</span></span>
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
                        <div id="chat-messages" class="flex-1 overflow-y-auto bg-white p-margin-mobile md:p-gutter flex flex-col gap-6 relative">

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

                        <!-- Floating Action / Approve Button -->
                        <div class="absolute bottom-[80px] md:bottom-[90px] left-0 w-full flex justify-center px-4 pointer-events-none z-30">
                            <button id="openDeliverModalBtn" class="pointer-events-auto bg-[#D4FF00] text-black border border-transparent shadow-lg font-label-md text-label-md font-bold py-3 px-8 rounded-full flex items-center gap-2 hover:bg-[#b4d400] transition-colors group">
                            <span class="material-symbols-outlined text-black group-hover:scale-110 transition-transform">verified</span>
                            Aprovar entrega
                            </button>
                        </div>

                        <!-- Chat Composer Footer -->
                        <div class="bg-white border-t border-gray-200 p-3 md:p-4 shrink-0 z-20">
                            <div class="max-w-4xl mx-auto flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl p-2 focus-within:border-primary-fixed transition-colors shadow-sm">
                            <label for="deliverFile"
                            class="inline-flex p-2 text-gray-500 hover:text-primary-fixed transition-colors rounded-lg hover:bg-gray-100 cursor-pointer">
                            <span class="material-symbols-outlined">attach_file</span>
                            </label>
                            <input id="deliverFile" type="file" class="hidden" />
                            <input id="chat-input" class="flex-1 bg-transparent border-none focus:ring-0 text-black font-body-md text-body-md placeholder:text-gray-400" placeholder="Escreve uma mensagem..." type="text" />
                            <button id="chat-send-btn" class="w-10 h-10 bg-primary-fixed text-black rounded-lg flex items-center justify-center hover:opacity-90 transition-opacity">
                                <span class="material-symbols-outlined text-[20px]">send</span>
                            </button>
                            </div>
                        </div>
                        </main>

                        <!-- MODAL: Aprovar Entrega -->
                        <div id="deliverModal" class="modal-backdrop fixed inset-0 bg-black/60 backdrop-blur-[3px] z-[100] hidden items-center justify-center p-4">
                        <div class="bg-white border border-outline-variant/30 shadow-[0_10px_40px_rgba(0,0,0,0.15)] rounded-xl w-full max-w-[520px] max-h-[92vh] overflow-hidden flex flex-col transition-all duration-300 transform scale-100">
                            <!-- Header -->
                            <div class="flex items-center justify-between px-6 pt-6 pb-4 shrink-0">
                            <h2 class="font-headline-md text-headline-md text-black">Aprovação da Entrega</h2>
                            <button id="closeDeliverModalBtn" class="w-10 h-10 rounded-full flex items-center justify-center hover:bg-slate-100 transition-all duration-300 ease-in-out group" type="button" aria-label="Fechar">
                                <span class="material-symbols-outlined text-slate-900 transition-transform duration-300 ease-in-out group-hover:rotate-90"> close </span>
                            </button>
                            </div>
                            <!-- Scrollable Body -->
                            <div class="px-6 pb-6 overflow-y-auto custom-scrollbar flex-1 space-y-6">
                            <!-- Submission Info -->
                            <div class="flex items-center gap-2 text-on-surface-variant">
                                <span class="material-symbols-outlined text-[18px] text-black">schedule</span>
                                <span class="font-label-md text-label-md text-black">Entregue em 01/10/2025 às 14:32</span>
                            </div>
                            <!-- Message Box -->
                            <div class="bg-grey border border-outline-variant/20 rounded-xl p-4">
                                <p class="font-body-md text-secondary leading-relaxed text-black">
                                Olá! Finalizei todas as telas do projeto conforme conversamos. O manual do cliente contém as instruções para exportação de assets e uso da biblioteca de componentes. Fico à disposição para eventuais ajustes.
                                </p>
                            </div>
                            <!-- Files Section -->
                            <div class="space-y-3">
                                <h3 class="font-label-sm text-label-sm tracking-widest uppercase text-black">Ficheiros Entregues</h3>
                                <div class="space-y-2">
                                <!-- File Row 1 -->
                                <div class="flex items-center justify-between p-3 bg-[#f8f9fa] rounded-lg border border-outline-variant/20">
                                    <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 flex items-center justify-center bg-white border border-outline-variant/20 rounded">
                                        <span class="material-symbols-outlined text-black">picture_as_pdf</span>
                                    </div>
                                    <div>
                                        <p class="font-label-md text-label-md font-bold text-black">Projeto_Final.pdf</p>
                                        <p class="font-label-sm text-label-sm text-black">2.4 MB</p>
                                    </div>
                                    </div>
                                    <button class="px-3 py-1.5 border border-outline-variant/40 rounded-md font-label-sm text-label-sm text-secondary bg-surface-container-high transition-colors">Visualizar</button>
                                </div>
                                <!-- File Row 2 -->
                                <div class="flex items-center justify-between p-3 bg-[#f8f9fa] rounded-lg border border-outline-variant/20">
                                    <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 flex items-center justify-center bg-white border border-outline-variant/20 rounded">
                                        <span class="material-symbols-outlined text-black">image</span>
                                    </div>
                                    <div>
                                        <p class="font-label-md text-label-md text-black font-bold">Mockups_Entrega.png</p>
                                        <p class="font-label-sm text-label-sm text-black">1.8 MB</p>
                                    </div>
                                    </div>
                                    <button class="px-3 py-1.5 border border-outline-variant/40 rounded-md font-label-sm text-label-sm text-secondary bg-surface-container-high transition-colors">Visualizar</button>
                                </div>
                                <!-- File Row 3 -->
                                <div class="flex items-center justify-between p-3 bg-[#f8f9fa] rounded-lg border border-outline-variant/20">
                                    <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 flex items-center justify-center bg-white border border-outline-variant/20 rounded">
                                        <span class="material-symbols-outlined text-black">description</span>
                                    </div>
                                    <div>
                                        <p class="font-label-md text-label-md text-black font-bold">Manual_do_Cliente.pdf</p>
                                        <p class="font-label-sm text-label-sm text-black">512 KB</p>
                                    </div>
                                    </div>
                                    <button class="px-3 py-1.5 border border-outline-variant/40 rounded-md font-label-sm text-label-sm text-secondary bg-surface-container-high transition-colors">Visualizar</button>
                                </div>
                                </div>
                            </div>
                            <!-- Evaluation Section -->
                            <div class="pt-2">
                                <div class="flex flex-col gap-1 mb-4">
                                <h3 class="font-headline-md text-[18px] text-black">Avalie o Freelancer</h3>
                                <p class="font-label-sm text-label-sm text-black">A aprovação irá liberar o valor retido ao Freelancer.</p>
                                </div>
                                <!-- Star Rating -->
                                <div class="space-y-4">
                                <div class="flex items-center gap-1" id="star-rating-container">
                                    <button class="star-btn material-symbols-outlined text-[32px] text-black hover:scale-110 transition-transform cursor-pointer" data-value="1" style="font-variation-settings: 'FILL' 0;">star</button>
                                    <button class="star-btn material-symbols-outlined text-[32px] text-black hover:scale-110 transition-transform cursor-pointer" data-value="2" style="font-variation-settings: 'FILL' 0;">star</button>
                                    <button class="star-btn material-symbols-outlined text-[32px] text-black hover:scale-110 transition-transform cursor-pointer" data-value="3" style="font-variation-settings: 'FILL' 0;">star</button>
                                    <button class="star-btn material-symbols-outlined text-[32px] text-black hover:scale-110 transition-transform cursor-pointer" data-value="4" style="font-variation-settings: 'FILL' 0;">star</button>
                                    <button class="star-btn material-symbols-outlined text-[32px] text-black hover:scale-110 transition-transform cursor-pointer" data-value="5" style="font-variation-settings: 'FILL' 0;">star</button>
                                </div>
                                <textarea id="reviewComment" class="w-full bg-[#CCFF00] border-outline-variant/30 rounded-xl p-3 text-black-pure font-body-md focus:border-primary-fixed focus:ring-1 focus:ring-primary-fixed transition-all" placeholder="Escreva um comentário opcional..." rows="3"></textarea>
                                </div>
                            </div>
                            <!-- Action Buttons -->
                            <div class="space-y-3 pt-4 border-t border-outline-variant/20">
                                <button id="confirmDeliverBtn" class="w-full h-12 flex items-center justify-center gap-2 bg-[#CCFF00] text-on-primary font-bold rounded-xl glow-hover transition-all active:scale-95 shadow-sm">
                                <span class="material-symbols-outlined">check_circle</span>
                                Aprovar trabalho
                                </button>
                                <button id="requestRevisionBtn" class="w-full h-12 flex items-center justify-center gap-2 bg-white border border-outline-variant/40 text-black font-semibold rounded-xl hover:bg-surface-container hover:text-white transition-all active:scale-95">
                                Solicitar revisões
                                </button>
                                <button id="openDisputeBtn" class="w-full h-12 flex items-center justify-center gap-2 bg-[#ba1a1a] text-white font-semibold rounded-xl hover:opacity-90 transition-all active:scale-95 shadow-sm">
                                <span class="material-symbols-outlined">warning</span>
                                Abrir disputa
                                </button>
                            </div>
                            </div>
                            <!-- Footer -->
                            <div class="px-6 py-4 bg-surface-container-low border-t border-outline-variant/10 flex justify-end items-center shrink-0">
                            <button id="cancelDeliverModalBtn" class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" type="button">
                                Cancelar
                            </button>
                            </div>
                        </div>
                        </div>
            </div>  
        `;

        App.templates.perfil =`
            <div id="view-perfil" class="bg-[#CCFF00] text-black font-body-md text-body-md">
                <main class="max-w-[1000px] mx-auto px-margin-mobile md:px-margin-desktop py-12 flex flex-col gap-8">
<!-- Top Card: Identity -->
<section class="bg-white neo-border neo-shadow p-6 md:p-10 flex flex-col md:flex-row gap-8 relative overflow-hidden">
<div class="flex-shrink-0">
<div class="w-32 h-32 md:w-48 md:h-48 neo-border overflow-hidden bg-surface-container-highest">
<img class="w-full h-full object-cover" data-alt="foto_cliente" src="/img/foto_perfil_exemplar.png"/>
</div>
</div>
<div class="flex flex-col flex-grow">
<div class="flex justify-between items-start w-full">
<div>
<h2 class="font-headline-lg text-black mb-1">Pedro Manuel</h2>
<p class="font-label-md text-black opacity-70 mb-4 uppercase tracking-widest">Diretor Geral • Luanda, Angola</p>
</div>
<button class="bg-white neo-border neo-shadow neo-shadow-hover px-4 py-2 flex items-center gap-2 font-bold hover:bg-[#CCFF00] transition-colors">
<span class="material-symbols-outlined text-sm">cancel</span>
                        EDITAR
</button>
</div>
<p class="font-body-lg text-black max-w-2xl mb-8 leading-relaxed">
                    Estrategista focado na transformação digital e escalabilidade de infraestruturas logísticas no mercado angolano. Com mais de 15 anos de experiência na liderança de equipas multidisciplinares.
                </p>
<div class="flex flex-wrap gap-2">
<span class="bg-black text-white font-label-md px-3 py-1 neo-border">E-COMMERCE</span>
<span class="bg-black text-white font-label-md px-3 py-1 neo-border">LOGÍSTICA</span>
<span class="bg-black text-white font-label-md px-3 py-1 neo-border">SAAS</span>
</div>
</div>
</section>
<!-- Central Grid: Contact & Metrics -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
<!-- Contact Info Card -->
<section class="bg-white neo-border neo-shadow p-8 flex flex-col justify-between">
<div>
<h3 class="font-headline-md text-black mb-8 border-b-4 border-black pb-2">Informação de contacto</h3>
<div class="space-y-6 mb-10">
<div class="flex flex-col">
<span class="font-label-sm text-black opacity-50 uppercase mb-1">EMAIL:</span>
<span class="font-label-md text-black text-lg">pedro.m@empresa.ao</span>
</div>
<div class="flex flex-col">
<span class="font-label-sm text-black opacity-50 uppercase mb-1">TELEFONE:</span>
<span class="font-label-md text-black text-lg">+244 923 000 000</span>
</div>
<div class="flex flex-col">
<span class="font-label-sm text-black opacity-50 uppercase mb-1">SITE:</span>
<span class="font-label-md text-black text-lg">www.empresa.ao</span>
</div>
<div class="flex flex-col">
<span class="font-label-sm text-black opacity-50 uppercase mb-1">Nº DO BILHETE:</span>
<span class="font-label-md text-black text-lg">000567890LA042</span>
</div>
</div>
</div>
<button class="w-full bg-white neo-border neo-shadow neo-shadow-hover py-4 font-headline-md text-sm uppercase tracking-tighter hover:bg-[#CCFF00] transition-colors">
                    ACTUALIZAR INFORMAÇÕES
                </button>
</section>
<!-- Metrics Card -->
<section class="bg-black neo-border neo-shadow p-8 flex flex-col justify-between text-white">
<div>
<h3 class="font-headline-md text-white mb-8 border-b-4 border-white pb-2">As suas Métricas</h3>
<div class="grid grid-cols-2 gap-y-10 gap-x-4 mb-10">
<div class="flex flex-col">
<span class="font-label-sm text-white opacity-60 uppercase mb-1">TRABALHOS:</span>
<span class="font-display-lg text-[40px] leading-none font-black">12</span>
</div>
<div class="flex flex-col">
<span class="font-label-sm text-white opacity-60 uppercase mb-1">CONTRATOS:</span>
<span class="font-display-lg text-[40px] leading-none font-black">8</span>
</div>
<div class="flex flex-col">
<span class="font-label-sm text-white opacity-60 uppercase mb-1">INVESTIDO:</span>
<span class="font-display-lg text-[32px] leading-none font-black text-neo-lime">850.000 <span class="text-xl">Kz</span></span>
</div>
<div class="flex flex-col">
<span class="font-label-sm text-white opacity-60 uppercase mb-1">AVALIAÇÕES:</span>
<span class="font-display-lg text-[32px] leading-none font-black text-neo-lime">4.9 ★</span>
</div>
</div>
</div>
<button class="w-full bg-white text-black neo-border rounded-full py-3 font-bold hover:bg-[#CCFF00] transition-colors flex items-center justify-center gap-2">
<span class="material-symbols-outlined">payments</span>
                    Ver Financeiro Completo
                </button>
</section>
</div>
<!-- System Actions Footer -->
<footer class="flex justify-end items-center gap-8 mt-4 mb-20">
<button class="font-bold text-black hover:underline underline-offset-4 decoration-4">
                Descartar
            </button>
<button class="bg-black text-white neo-border neo-shadow neo-shadow-hover px-10 py-5 font-headline-md text-lg tracking-tight uppercase hover:bg-white hover:text-black transition-all">
                Guardar alterações
            </button>
</footer>
</main>
            </div>
        `;

App.templates.publicar_trabalho_step_1 = `
  <div id="view-publicar-trabalho-step-1" style="margin:0; padding:0; min-height:100vh; font-family:'Space Grotesk', ui-sans-serif, system-ui, -apple-system, sans-serif; color:#000; box-sizing:border-box;">
    
    <!-- CSS local do template (escopado pelo id) -->
        <style>
        #view-publicar-trabalho-step-1, 
        #view-publicar-trabalho-step-1 * { box-sizing: border-box; }

        /* Variáveis para facilitar ajuste ao teu layout */
        #view-publicar-trabalho-step-1{
            --sidebar-w: 300px;     /* ajusta aqui se a sidebar tiver outra largura */
            --maxw: 1100px;
            --pad-x: 40px;

            --lime: #CCFF00;
            --black: #000000;
            --white: #ffffff;
            --muted: rgba(0,0,0,.65);
        }

        #view-publicar-trabalho-step-1 .content-shell{
            min-height: 100vh;
            background: var(--lime);
            position: relative;
            padding-bottom: 116px; /* espaço para footer fixo */
        }

        #view-publicar-trabalho-step-1 .content-header{
            position: sticky;
            top: 0;
            z-index: 10;
            background: var(--lime);
            border-bottom: 1px solid rgba(0,0,0,.06);
        }

        #view-publicar-trabalho-step-1 .content-header__inner{
            max-width: var(--maxw);
            margin: 0 auto;
            padding: 24px var(--pad-x);
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:16px;
        }

        #view-publicar-trabalho-step-1 .brand{
            font-weight: 900;
            letter-spacing: -0.04em;
            font-size: 24px;
            text-transform: uppercase;
        }

        #view-publicar-trabalho-step-1 .link-btn{
            border:0;
            background:transparent;
            color: rgba(0,0,0,.8);
            font-weight:700;
            cursor:pointer;
            font-size:14px;
            text-transform:uppercase;
            padding:0;
        }

        #view-publicar-trabalho-step-1 .content-main{
            max-width: var(--maxw);
            margin: 0 auto;
            padding: 60px var(--pad-x);
        }

        #view-publicar-trabalho-step-1 .step-grid{
            display:grid;
            grid-template-columns: 1fr;
            gap:40px;
            align-items:start;
        }

        #view-publicar-trabalho-step-1 .step-meta{
            display:inline-flex;
            align-items:center;
            gap:12px;
            font-weight:700;
            font-size:14px;
            color: var(--black);
        }

        #view-publicar-trabalho-step-1 .step-count{
            padding: 4px 12px;
            border-radius: 999px;
            background: var(--black);
            color: var(--lime);
        }

        #view-publicar-trabalho-step-1 .step-title{
            margin: 24px 0 20px;
            font-size: clamp(32px, 5vw, 56px);
            line-height: 1;
            letter-spacing: -0.05em;
            font-weight: 900;
        }

        #view-publicar-trabalho-step-1 .step-desc{
            margin:0;
            font-size:18px;
            line-height:1.5;
            color: var(--muted);
            max-width: 40ch;
        }

        #view-publicar-trabalho-step-1 .step-form{
            display:flex;
            flex-direction:column;
            gap:24px;
        }

        #view-publicar-trabalho-step-1 .field__label{
            display:block;
            font-size:15px;
            font-weight:800;
            margin-bottom:12px;
            color: var(--black);
        }

        #view-publicar-trabalho-step-1 .editor{
            background: var(--white);
            border: 2px solid var(--black);
            border-radius: 12px;
            padding: 20px;
        }

        #view-publicar-trabalho-step-1 .editor__editable{
            min-height: 80px;
            outline:none;
            font-size:18px;
            font-weight:600;
            line-height:1.4;
        }

        #view-publicar-trabalho-step-1 .wavy-error{
            text-decoration-line: underline;
            text-decoration-style: wavy;
            text-decoration-color: #FF3B30;
            text-underline-offset: 4px;
            text-decoration-thickness: 2px;
        }

        #view-publicar-trabalho-step-1 .hint{
            display:flex;
            align-items:flex-start;
            gap:12px;
            margin-top:16px;
            color: var(--black);
            font-size:14px;
            font-weight:600;
        }

        #view-publicar-trabalho-step-1 .hint__icon{
            width:24px;
            height:24px;
            display:grid;
            place-items:center;
            border-radius:6px;
            background: var(--black);
            color: var(--lime);
            flex: 0 0 auto;
        }

        #view-publicar-trabalho-step-1 .examples{
            margin-top: 8px;
            background: rgba(255,255,255,.5);
            border: 2px solid var(--black);
            border-radius: 12px;
            padding: 24px;
        }

        #view-publicar-trabalho-step-1 .examples__title{
            margin:0 0 16px;
            font-size:14px;
            font-weight:900;
            text-transform:uppercase;
            letter-spacing:.05em;
        }

        #view-publicar-trabalho-step-1 .examples__list{
            margin:0;
            padding-left:0;
            list-style:none;
            color: var(--black);
            display:flex;
            flex-direction:column;
            gap:12px;
        }

        #view-publicar-trabalho-step-1 .examples__list li{
            position:relative;
            padding-left:24px;
            font-size:15px;
            font-weight:600;
            line-height:1.4;
        }

        #view-publicar-trabalho-step-1 .examples__list li span.bullet{
            position:absolute;
            left:0;
            font-weight:900;
        }

        /* Footer fixo limitado ao content (não invade sidebar) */
        #view-publicar-trabalho-step-1 .content-footer{
            position: fixed;
            bottom: 0;
            left: var(--sidebar-w);
            width: calc(100% - var(--sidebar-w));
            background: var(--lime);
            border-top: 2px solid var(--black);
            z-index: 20;
        }

        #view-publicar-trabalho-step-1 .progress{
            height: 8px;
            background: rgba(0,0,0,.1);
        }

        #view-publicar-trabalho-step-1 .progress__bar{
            width: 20%;
            height: 100%;
            background: var(--black);
        }

        #view-publicar-trabalho-step-1 .content-footer__inner{
            height: 80px;
            max-width: var(--maxw);
            margin: 0 auto;
            padding: 0 var(--pad-x);
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap: 12px;
        }

        #view-publicar-trabalho-step-1 .btn{
            height: 48px;
            padding: 0 32px;
            border-radius: 12px;
            font-weight: 800;
            font-size: 15px;
            cursor: pointer;
            border: 2px solid var(--black);
            text-transform: uppercase;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            background: transparent;
            color: var(--black);
        }

        #view-publicar-trabalho-step-1 .btn--primary{
            background: var(--black);
            color: var(--lime);
        }

        /* Responsivo */
        @media (max-width: 899px) {
            #view-publicar-trabalho-step-1 .content-shell { margin-left: 0; }
            #view-publicar-trabalho-step-1 .content-footer { left: 0; width: 100%; }
            #view-publicar-trabalho-step-1 .content-main { padding: 40px 20px; }
            #view-publicar-trabalho-step-1{ --pad-x: 20px; }
        }
        @media (min-width: 1024px) {
            #view-publicar-trabalho-step-1 .step-grid{
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            }
        }
        </style>

    <div class="content-shell">

      <main class="content-main">
        <div class="step-grid">
          <!-- Coluna esquerda -->
          <section class="step-info">
            <div class="step-meta">
              <span class="step-count">1/5</span>
              <span class="step-label">Publicação de vaga</span>
            </div>

            <h1 class="step-title">Vamos começar com um título forte.</h1>

            <p class="step-desc">
              Isso ajuda sua publicação a se destacar para os candidatos certos. É a primeira coisa que eles verão,
              portanto, seja descritivo o suficiente.
            </p>
          </section>

          <!-- Coluna direita -->
          <section class="step-form">
            <div class="field">
              <label class="field__label" for="job-title">
                Escreva um título para sua publicação de vaga
              </label>

              <div class="editor" aria-label="Título da vaga">
                <div class="editor__editable" contenteditable="true" id="job-title" spellcheck="false">
                  Ex: Designer de UI/UX que conecta pessoas usando sites
                  <span class="wavy-error">magistrais</span>
                </div>
              </div>

              <div class="hint">
                <span class="hint__icon" aria-hidden="true">✦</span>
                <span class="hint__text">Vamos combiná-lo com candidatos especializados em Design UX/UI.</span>
              </div>
            </div>

            <div class="examples">
              <h3 class="examples__title">Exemplos de títulos</h3>
              <ul class="examples__list">
                <li><span class="bullet">→</span> Desenvolver site WordPress para empresa de contabilidade</li>
                <li><span class="bullet">→</span> Experiência em Realidade Aumentada necessária para aplicativo iOS</li>
                <li><span class="bullet">→</span> Desenvolvedor necessário para atualizar a UI do painel SaaS</li>
              </ul>
            </div>
          </section>
        </div>
      </main>

      <!-- Footer fixo limitado ao content -->
      <footer class="content-footer">
  <div class="progress">
    <div class="progress__bar"></div>
  </div>

  <div class="content-footer__inner">
    <button class="btn btn--ghost" type="button" data-route="os_meus_trabalhos">
      Voltar
    </button>

    <button class="btn btn--primary" type="button" data-route="publicar_trabalho_step_2">
      Próximo: Habilidades
    </button>
  </div>
</footer>
    </div>
  </div>
`;

App.templates.publicar_trabalho_step_2 = `
  <div id="view-publicar-trabalho-step-2" style="font-family:'Space Grotesk', sans-serif; background-color:#111; margin:0; padding:0; min-height:100vh; color:#000000; box-sizing:border-box;">
    
    <style>
      #view-publicar-trabalho-step-2,
      #view-publicar-trabalho-step-2 * {
        box-sizing: border-box;
      }

      @media (max-width: 1024px) {
        #view-publicar-trabalho-step-2 .publicar-step-2-main {
          grid-template-columns: 1fr !important;
          gap: 48px !important;
        }
      }

      @media (max-width: 899px) {
        #view-publicar-trabalho-step-2 .publicar-step-2-shell {
          margin-left: 0 !important;
        }

        #view-publicar-trabalho-step-2 .publicar-step-2-footer {
          left: 0 !important;
          width: 100% !important;
        }

        #view-publicar-trabalho-step-2 .publicar-step-2-header,
        #view-publicar-trabalho-step-2 .publicar-step-2-main {
          padding-left: 20px !important;
          padding-right: 20px !important;
        }

        #view-publicar-trabalho-step-2 .publicar-step-2-footer-inner {
          padding-left: 20px !important;
          padding-right: 20px !important;
        }
      }

      @media (max-width: 640px) {
        #view-publicar-trabalho-step-2 .publicar-step-2-shell {
          padding-bottom: 150px !important;
        }

        #view-publicar-trabalho-step-2 .publicar-step-2-footer {
          height: auto !important;
        }

        #view-publicar-trabalho-step-2 .publicar-step-2-footer-inner {
          flex-direction: column !important;
          align-items: stretch !important;
          gap: 12px !important;
          padding: 16px 20px !important;
        }

        #view-publicar-trabalho-step-2 .publicar-step-2-footer-inner button {
          width: 100% !important;
        }

        #view-publicar-trabalho-step-2 .publicar-step-2-recommended {
          flex-direction: column !important;
          align-items: flex-start !important;
        }
      }
    </style>

    <div class="publicar-step-2-shell" style=" min-height:100vh; background-color:#CCFF00; position:relative; padding-bottom:88px; display:flex; flex-direction:column; box-sizing:border-box;">
      
      

      <main class="publicar-step-2-main" style="max-width:1200px; width:100%; margin:0 auto; padding:40px; display:grid; grid-template-columns:5fr 7fr; gap:80px; flex:1; box-sizing:border-box;">
        
        <!-- Coluna Esquerda -->
        <section style="display:flex; flex-direction:column; gap:24px; box-sizing:border-box;">
          <div style="display:flex; align-items:center; gap:12px; font-weight:700; font-size:14px;">
            <span style="background:#000000; color:#CCFF00; padding:6px 12px; border-radius:999px;">2/5</span>
            <span>Publicação de vaga</span>
          </div>

          <h1 style="font-size:48px; font-weight:800; line-height:1.1; letter-spacing:-0.03em; margin:0;">
            Quais são as principais competências necessárias para o seu projeto?
          </h1>

          <p style="font-size:18px; line-height:1.6; color:rgba(0, 0, 0, 0.65); max-width:400px; margin:0;">
            Isso ajuda a encontrar os talentos certos. Pode adicionar até 10 competências.
          </p>
        </section>

        <!-- Coluna Direita -->
        <section style="display:flex; flex-direction:column; gap:32px; box-sizing:border-box;">
          
          <div style="display:flex; flex-direction:column; gap:12px; box-sizing:border-box;">
            <label for="competencias-input" style="font-size:14px; font-weight:800; text-transform:uppercase;">
              Procure ou adicione competências
            </label>

            <div style="position:relative; box-sizing:border-box;">
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" style="position:absolute; left:16px; top:50%; transform:translateY(-50%); width:20px; height:20px;" viewBox="0 0 24 24" aria-hidden="true">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" x2="16.65" y1="21" y2="16.65"></line>
              </svg>
              <input id="competencias-input" type="text" placeholder="Ex: Figma, React, Prototipagem" style="width:100%; height:56px; background:#FFFFFF; border:2px solid #000000; border-radius:12px; padding:0 48px; font-size:16px; font-family:inherit; outline:none; box-sizing:border-box;" />
            </div>
          </div>

          <div class="publicar-step-2-recommended" style="background:rgba(255, 255, 255, 0.5); border:2px solid #000000; border-radius:12px; padding:20px; display:flex; align-items:center; gap:16px; box-sizing:border-box;">
            <div style="width:48px; height:48px; background:#FFFFFF; border:2px solid #000000; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:14px; flex-shrink:0;">2/3</div>
            <p style="flex:1; font-size:14px; font-weight:600; line-height:1.4; margin:0;">
              2 de 3 competências recomendadas selecionadas
            </p>
            <button style="background:transparent; border:2px solid #000000; border-radius:12px; padding:8px 16px; font-weight:800; font-size:12px; text-transform:uppercase; cursor:pointer; font-family:inherit; box-sizing:border-box;">
              Sugerir com IA
            </button>
          </div>

          <div style="display:flex; flex-wrap:wrap; gap:8px; box-sizing:border-box;">
            <div style="background:#000000; color:#CCFF00; padding:8px 16px; border-radius:999px; font-size:14px; font-weight:700; display:flex; align-items:center; gap:8px;">
              Design de Interface <span style="cursor:pointer; font-size:18px; line-height:1;">×</span>
            </div>
            <div style="background:#000000; color:#CCFF00; padding:8px 16px; border-radius:999px; font-size:14px; font-weight:700; display:flex; align-items:center; gap:8px;">
              UX Design <span style="cursor:pointer; font-size:18px; line-height:1;">×</span>
            </div>
          </div>

          <div style="display:flex; flex-direction:column; gap:24px; box-sizing:border-box;">
            
            <div style="display:flex; flex-direction:column; gap:12px; box-sizing:border-box;">
              <label style="font-size:14px; font-weight:800; text-transform:uppercase;">Design de Interface</label>
              <div style="display:flex; flex-wrap:wrap; gap:10px; box-sizing:border-box;">
                <div style="background:#FFFFFF; border:2px solid #000000; border-radius:12px; padding:8px 16px; font-size:14px; font-weight:700; cursor:pointer; display:flex; align-items:center; gap:8px;">
                  Design Mobile
                  <span style="background:#CCFF00; color:#000000; font-size:10px; padding:2px 6px; border-radius:4px; border:1px solid #000000; font-weight:800;">98% match</span>
                </div>
                <div style="background:#FFFFFF; border:2px solid #000000; border-radius:12px; padding:8px 16px; font-size:14px; font-weight:700; cursor:pointer; display:flex; align-items:center; gap:8px;">
                  Web Design
                  <span style="background:#CCFF00; color:#000000; font-size:10px; padding:2px 6px; border-radius:4px; border:1px solid #000000; font-weight:800;">98% match</span>
                </div>
              </div>
            </div>

            <div style="display:flex; flex-direction:column; gap:12px; box-sizing:border-box;">
              <label style="font-size:14px; font-weight:800; text-transform:uppercase;">Design de Experiência</label>
              <div style="display:flex; flex-wrap:wrap; gap:10px; box-sizing:border-box;">
                <div style="background:#FFFFFF; border:2px solid #000000; border-radius:12px; padding:8px 16px; font-size:14px; font-weight:700; cursor:pointer;">Arquitetura de Informação</div>
                <div style="background:#FFFFFF; border:2px solid #000000; border-radius:12px; padding:8px 16px; font-size:14px; font-weight:700; cursor:pointer;">Testes de Usabilidade</div>
                <div style="background:#FFFFFF; border:2px solid #000000; border-radius:12px; padding:8px 16px; font-size:14px; font-weight:700; cursor:pointer;">User Research</div>
              </div>
            </div>

            <div style="display:flex; flex-direction:column; gap:12px; box-sizing:border-box;">
              <label style="font-size:14px; font-weight:800; text-transform:uppercase;">Ferramentas</label>
              <div style="display:flex; flex-wrap:wrap; gap:10px; box-sizing:border-box;">
                <div style="background:#FFFFFF; border:2px solid #000000; border-radius:12px; padding:8px 16px; font-size:14px; font-weight:700; cursor:pointer;">Figma</div>
                <div style="background:#FFFFFF; border:2px solid #000000; border-radius:12px; padding:8px 16px; font-size:14px; font-weight:700; cursor:pointer;">Adobe XD</div>
                <div style="background:#FFFFFF; border:2px solid #000000; border-radius:12px; padding:8px 16px; font-size:14px; font-weight:700; cursor:pointer;">Sketch</div>
              </div>
            </div>

          </div>
        </section>
      </main>

      <footer class="publicar-step-2-footer" style="position:fixed; bottom:0; left:300px; width:calc(100% - 300px); height:88px; background-color:#CCFF00; border-top:2px solid #000000; display:flex; flex-direction:column; z-index:100; box-sizing:border-box;">
  <div style="height:8px; background:transparent; width:100%; box-sizing:border-box;">
    <div style="height:8px; background:#000000; width:40%;"></div>
  </div>

  <div class="publicar-step-2-footer-inner" style="flex:1; display:flex; justify-content:space-between; align-items:center; padding:0 40px; max-width:1200px; width:100%; margin:0 auto; box-sizing:border-box;">
    <button
      type="button"
      data-route="publicar_trabalho_step_1"
      style="height:48px; padding:0 32px; border-radius:12px; border:2px solid #000000; font-weight:800; font-size:14px; text-transform:uppercase; cursor:pointer; display:flex; align-items:center; justify-content:center; background:transparent; color:#000000; font-family:inherit;">
      Voltar
    </button>

    <button
      type="button"
      data-route="publicar_trabalho_step_3"
      style="height:48px; padding:0 32px; border-radius:12px; border:2px solid #000000; font-weight:800; font-size:14px; text-transform:uppercase; cursor:pointer; display:flex; align-items:center; justify-content:center; background:#000000; color:#CCFF00; font-family:inherit;">
      Próximo: Escopo
    </button>
  </div>
</footer>
    </div>
  </div>
`;

App.templates.publicar_trabalho_step_3 = `
<div id="view-publicar-trabalho-step-3" style="font-family: 'Space Grotesk', sans-serif; background-color: #111; margin: 0; padding: 0; color: #000000; box-sizing: border-box;">
  <div style="min-height: 100vh; background-color: #CCFF00; position: relative; padding-bottom: 88px; display: flex; flex-direction: column; box-sizing: border-box;">
    
    <main style="max-width: 1200px; width: 100%; margin: 0 auto; padding: 40px; display: grid; grid-template-columns: 5fr 7fr; gap: 80px; flex: 1; box-sizing: border-box;">
      <!-- Coluna Esquerda -->
      <section style="display: flex; flex-direction: column; gap: 24px; box-sizing: border-box;">
        <div style="display: flex; align-items: center; gap: 12px; font-weight: 700; font-size: 14px;">
          <span style="background: #000000; color: #CCFF00; padding: 6px 12px; border-radius: 999px;">3/5</span>
          <span>Publicação de vaga</span>
        </div>
        <h1 style="font-size: 48px; font-weight: 800; line-height: 1.1; letter-spacing: -0.03em; margin: 0;">Agora, estime o escopo do seu trabalho.</h1>
        <p style="font-size: 18px; line-height: 1.6; color: rgba(0, 0, 0, 0.65); max-width: 400px; margin: 0;">Considere o tamanho do seu projeto e o tempo que ele irá levar.</p>
      </section>
      <!-- Coluna Direita -->
      <section style="display: flex; flex-direction: column; gap: 32px; box-sizing: border-box;">
        <div style="display: flex; flex-direction: column; gap: 12px;">
          <label style="font-size: 14px; font-weight: 800; text-transform: uppercase;">Tamanho do projeto</label>
          <div style="display: flex; flex-direction: column; gap: 12px;">
            <div style="background: #FFFFFF; border: 2px solid #000000; border-radius: 12px; padding: 16px; cursor: pointer;">
              <div style="font-weight: 800; font-size: 16px; margin-bottom: 4px;">Grande</div>
              <div style="font-size: 14px; color: rgba(0,0,0,0.6);">Iniciativas complexas e de longo prazo. (Ex: Design e desenvolvimento de um site completo)</div>
            </div>
            <div style="background: #000000; color: #CCFF00; border: 2px solid #000000; border-radius: 12px; padding: 16px; cursor: pointer;">
              <div style="font-weight: 800; font-size: 16px; margin-bottom: 4px;">Médio</div>
              <div style="font-size: 14px; color: rgba(204,255,0,0.8);">Projetos bem definidos. (Ex: Criação de um logotipo ou design de landing page)</div>
            </div>
            <div style="background: #FFFFFF; border: 2px solid #000000; border-radius: 12px; padding: 16px; cursor: pointer;">
              <div style="font-weight: 800; font-size: 16px; margin-bottom: 4px;">Pequeno</div>
              <div style="font-size: 14px; color: rgba(0,0,0,0.6);">Tarefas rápidas e diretas. (Ex: Edição de uma foto ou revisão de texto)</div>
            </div>
          </div>
        </div>
        <div style="display: flex; flex-direction: column; gap: 12px;">
          <label style="font-size: 14px; font-weight: 800; text-transform: uppercase;">Duração</label>
          <div style="background: #FFFFFF; border: 2px solid #000000; border-radius: 12px; padding: 16px; font-weight: 700;">1 a 3 meses</div>
        </div>
        <div style="display: flex; flex-direction: column; gap: 12px;">
          <label style="font-size: 14px; font-weight: 800; text-transform: uppercase;">Nível de experiência</label>
          <div style="background: #FFFFFF; border: 2px solid #000000; border-radius: 12px; padding: 16px; font-weight: 700;">Intermediário</div>
          <p style="font-size: 13px; color: rgba(0,0,0,0.6); margin: 0;">Isso não irá restringir as propostas, mas ajuda a combinar a expertise com o seu orçamento.</p>
        </div>
        <div style="display: flex; flex-direction: column; gap: 12px;">
          <div style="display: flex; justify-content: space-between; align-items: center;">
            <label style="font-size: 14px; font-weight: 800; text-transform: uppercase;">Efetivação</label>
            <a href="#" style="font-size: 12px; font-weight: 700; color: #000; text-decoration: underline;">Saiba mais</a>
          </div>
          <p style="font-size: 14px; margin: 0;">Essa vaga é uma oportunidade de efetivação após contrato?</p>
          <div style="display: flex; gap: 12px;">
            <div style="flex: 1; background: #FFFFFF; border: 2px solid #000000; border-radius: 12px; padding: 12px; text-align: center; font-weight: 700; font-size: 14px; cursor: pointer;">Sim, pode se tornar full time</div>
            <div style="flex: 1; background: #FFFFFF; border: 2px solid #000000; border-radius: 12px; padding: 12px; text-align: center; font-weight: 700; font-size: 14px; cursor: pointer;">Não, por enquanto</div>
          </div>
        </div>
      </section>
    </main>
    <footer class="publicar-step-3-footer" style="position:fixed; bottom:0; left:300px; width:calc(100% - 300px); height:88px; background-color:#CCFF00; border-top:2px solid #000000; display:flex; flex-direction:column; z-index:100; box-sizing:border-box;">
  <div style="height:8px; background:transparent; width:100%; box-sizing:border-box;">
    <div style="height:8px; background:#000000; width:60%;"></div>
  </div>

  <div class="publicar-step-3-footer-inner" style="flex:1; display:flex; justify-content:space-between; align-items:center; padding:0 40px; max-width:1200px; width:100%; margin:0 auto; box-sizing:border-box;">
    <button
      type="button"
      data-route="publicar_trabalho_step_2"
      style="height:48px; padding:0 32px; border-radius:12px; border:2px solid #000000; font-weight:800; font-size:14px; text-transform:uppercase; cursor:pointer; display:flex; align-items:center; justify-content:center; background:transparent; color:#000000; font-family:inherit;">
      Voltar
    </button>

    <button
      type="button"
      data-route="publicar_trabalho_step_4"
      style="height:48px; padding:0 32px; border-radius:12px; border:2px solid #000000; font-weight:800; font-size:14px; text-transform:uppercase; cursor:pointer; display:flex; align-items:center; justify-content:center; background:#000000; color:#CCFF00; font-family:inherit;">
      PRÓXIMO: ORÇAMENTO
    </button>
  </div>
</footer>
  </div>
</div>
`;


App.templates.publicar_trabalho_step_4 = `
  <div id="view-publicar-trabalho-step-4" style="font-family:'Space Grotesk', sans-serif; margin:0; padding:0; min-height:100vh; color:#000000; box-sizing:border-box;">
    
    <style>
      #view-publicar-trabalho-step-4,
      #view-publicar-trabalho-step-4 * {
        box-sizing: border-box;
      }

      #view-publicar-trabalho-step-4 .step-4-shell {
        
        min-height: 100vh;
        background-color: #CCFF00;
        position: relative;
        padding-bottom: 88px;
        display: flex;
        flex-direction: column;
      }

      #view-publicar-trabalho-step-4 .step-4-header {
        padding: 28px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        width: 100%;
        margin: 0 auto;
      }

      #view-publicar-trabalho-step-4 .step-4-main {
        max-width: 1200px;
        width: 100%;
        margin: 0 auto;
        padding: 40px;
        display: grid;
        grid-template-columns: 5fr 7fr;
        gap: 80px;
        flex: 1;
      }

      #view-publicar-trabalho-step-4 .budget-tabs {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
      }

      #view-publicar-trabalho-step-4 .budget-tab {
        width: 100%;
        background: #FFFFFF;
        color: #000000;
        border: 2px solid #000000;
        border-radius: 12px;
        padding: 20px;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        gap: 12px;
        font-family: inherit;
        text-align: left;
      }

      #view-publicar-trabalho-step-4 .budget-tab.is-active {
        background: #000000;
        color: #CCFF00;
      }

      #view-publicar-trabalho-step-4 .budget-tab__top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
      }

      #view-publicar-trabalho-step-4 .budget-tab__icon svg {
        width: 24px;
        height: 24px;
        display: block;
        stroke: currentColor;
      }

      #view-publicar-trabalho-step-4 .budget-tab__radio {
        width: 20px;
        height: 20px;
        border: 2px solid currentColor;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
      }

      #view-publicar-trabalho-step-4 .budget-tab__radio::after {
        content: "";
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: currentColor;
        opacity: 0;
      }

      #view-publicar-trabalho-step-4 .budget-tab.is-active .budget-tab__radio::after {
        opacity: 1;
      }

      #view-publicar-trabalho-step-4 .budget-tab__label {
        font-weight: 800;
        font-size: 16px;
      }

      #view-publicar-trabalho-step-4 .budget-panel {
        display: none;
        flex-direction: column;
        gap: 24px;
      }

      #view-publicar-trabalho-step-4 .budget-panel.is-active {
        display: flex;
      }

      #view-publicar-trabalho-step-4 .muted {
        font-size: 14px;
        color: rgba(0,0,0,0.7);
        margin: 0;
      }

      #view-publicar-trabalho-step-4 .field-group {
        display: flex;
        flex-direction: column;
        gap: 12px;
      }

      #view-publicar-trabalho-step-4 .field-label {
        font-size: 14px;
        font-weight: 800;
        text-transform: uppercase;
      }

      #view-publicar-trabalho-step-4 .field-display {
        background: #FFFFFF;
        border: 2px solid #000000;
        border-radius: 12px;
        padding: 16px;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        font-weight: 800;
        font-size: 24px;
      }

      #view-publicar-trabalho-step-4 .field-note {
        font-size: 12px;
        color: rgba(0,0,0,0.5);
        margin: 0;
      }

      #view-publicar-trabalho-step-4 .two-cols {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
      }

      #view-publicar-trabalho-step-4 .small-field {
        background: #FFFFFF;
        border: 2px solid #000000;
        border-radius: 12px;
        padding: 16px;
        display: flex;
        justify-content: flex-end;
        align-items: baseline;
      }

      #view-publicar-trabalho-step-4 .small-field strong {
        font-size: 20px;
      }

      #view-publicar-trabalho-step-4 .small-field span {
        font-size: 14px;
        color: rgba(0,0,0,0.5);
        margin-left: 4px;
      }

      #view-publicar-trabalho-step-4 .insight-box {
        background: rgba(0,0,0,0.05);
        border-radius: 12px;
        padding: 24px;
        display: flex;
        flex-direction: column;
        gap: 20px;
      }

      #view-publicar-trabalho-step-4 .insight-box p {
        margin: 0;
      }

      #view-publicar-trabalho-step-4 .chart-stack {
        display: flex;
        flex-direction: column;
        gap: 8px;
      }

      #view-publicar-trabalho-step-4 .chart-bars-fixed {
        display: flex;
        align-items: flex-end;
        gap: 4px;
        height: 60px;
        justify-content: center;
      }

      #view-publicar-trabalho-step-4 .chart-bars-fixed .bar-light {
        width: 24px;
        background: #FFF;
        border: 1px solid #000;
      }

      #view-publicar-trabalho-step-4 .chart-bars-fixed .bar-dark {
        width: 24px;
        background: #000;
      }

      #view-publicar-trabalho-step-4 .chart-axis-fixed {
        display: flex;
        justify-content: space-between;
        font-size: 10px;
        font-weight: 700;
        color: rgba(0,0,0,0.6);
      }

      #view-publicar-trabalho-step-4 .hourly-chart-wrap {
        display: flex;
        gap: 20px;
        align-items: flex-end;
        padding-top: 10px;
      }

      #view-publicar-trabalho-step-4 .hourly-chart-y {
        writing-mode: vertical-rl;
        transform: rotate(180deg);
        font-size: 11px;
        color: rgba(0,0,0,0.5);
        font-weight: 600;
        text-transform: uppercase;
        white-space: nowrap;
      }

      #view-publicar-trabalho-step-4 .hourly-chart-main {
        flex-grow: 1;
      }

      #view-publicar-trabalho-step-4 .hourly-chart-bars {
        display: flex;
        align-items: flex-end;
        gap: 4px;
        height: 80px;
        border-bottom: 2px solid #000;
      }

      #view-publicar-trabalho-step-4 .hourly-chart-bars .bar {
        flex: 1;
        border: 1px solid #000;
        border-bottom: none;
      }

      #view-publicar-trabalho-step-4 .hourly-chart-bars .bar-dark {
        background: #000;
      }

      #view-publicar-trabalho-step-4 .hourly-chart-bars .bar-light {
        background: #FFF;
      }

      #view-publicar-trabalho-step-4 .hourly-chart-x {
        text-align: center;
        margin-top: 8px;
        font-size: 11px;
        color: rgba(0,0,0,0.5);
        font-weight: 600;
        text-transform: uppercase;
      }

      #view-publicar-trabalho-step-4 .budget-link {
        font-size: 14px;
        font-weight: 700;
        color: #000;
        text-decoration: underline;
      }

      #view-publicar-trabalho-step-4 .step-4-footer {
        position: fixed;
        bottom: 0;
        left: 300px;
        width: calc(100% - 300px);
        height: 88px;
        background-color: #CCFF00;
        border-top: 2px solid #000000;
        display: flex;
        flex-direction: column;
        z-index: 100;
      }

      #view-publicar-trabalho-step-4 .step-4-footer-progress {
        height: 8px;
        width: 100%;
      }

      #view-publicar-trabalho-step-4 .step-4-footer-progress-bar {
        height: 8px;
        background: #000000;
        width: 80%;
      }

      #view-publicar-trabalho-step-4 .step-4-footer-inner {
        flex: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 40px;
        max-width: 1200px;
        width: 100%;
        margin: 0 auto;
      }

      #view-publicar-trabalho-step-4 .footer-btn {
        height: 48px;
        padding: 0 32px;
        border-radius: 12px;
        border: 2px solid #000000;
        font-weight: 800;
        font-size: 14px;
        text-transform: uppercase;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: inherit;
      }

      #view-publicar-trabalho-step-4 .footer-btn--ghost {
        background: transparent;
        color: #000000;
      }

      #view-publicar-trabalho-step-4 .footer-btn--primary {
        background: #000000;
        color: #CCFF00;
      }

      @media (max-width: 1024px) {
        #view-publicar-trabalho-step-4 .step-4-main {
          grid-template-columns: 1fr !important;
          gap: 48px !important;
        }
      }

      @media (max-width: 899px) {
        #view-publicar-trabalho-step-4 .step-4-shell {
          margin-left: 0 !important;
        }

        #view-publicar-trabalho-step-4 .step-4-footer {
          left: 0 !important;
          width: 100% !important;
        }

        #view-publicar-trabalho-step-4 .step-4-header,
        #view-publicar-trabalho-step-4 .step-4-main {
          padding-left: 20px !important;
          padding-right: 20px !important;
        }

        #view-publicar-trabalho-step-4 .step-4-footer-inner {
          padding-left: 20px !important;
          padding-right: 20px !important;
        }
      }

      @media (max-width: 640px) {
        #view-publicar-trabalho-step-4 .step-4-shell {
          padding-bottom: 150px !important;
        }

        #view-publicar-trabalho-step-4 .budget-tabs,
        #view-publicar-trabalho-step-4 .two-cols {
          grid-template-columns: 1fr !important;
        }

        #view-publicar-trabalho-step-4 .step-4-footer {
          height: auto !important;
        }

        #view-publicar-trabalho-step-4 .step-4-footer-inner {
          flex-direction: column !important;
          align-items: stretch !important;
          gap: 12px !important;
          padding: 16px 20px !important;
        }

        #view-publicar-trabalho-step-4 .step-4-footer-inner button {
          width: 100% !important;
        }

        #view-publicar-trabalho-step-4 .hourly-chart-wrap {
          gap: 12px !important;
        }
      }
    </style>

    <div class="step-4-shell">
      

      <main class="step-4-main">
        <!-- Coluna Esquerda -->
        <section style="display:flex; flex-direction:column; gap:24px;">
          <div style="display:flex; align-items:center; gap:12px; font-weight:700; font-size:14px;">
            <span style="background:#000000; color:#CCFF00; padding:6px 12px; border-radius:999px;">4/5</span>
            <span>Publicação de vaga</span>
          </div>

          <h1 style="font-size:48px; font-weight:800; line-height:1.1; letter-spacing:-0.03em; margin:0;">
            Fale-nos sobre o orçamento do seu projecto.
          </h1>

          <p style="font-size:18px; line-height:1.6; color:rgba(0, 0, 0, 0.65); max-width:400px; margin:0;">
            Esta informação ajuda-nos a encontrar os melhores talentos para o seu orçamento e garante que recebe propostas realistas.
          </p>
        </section>

        <!-- Coluna Direita -->
        <section style="display: flex; flex-direction: column; gap: 32px; box-sizing: border-box;">
  
  <!-- Tabs -->
  <div style="display: flex; gap: 16px;">
    
    <button
  id="budget-panel-hourly"
  type="button"
  onclick="App.setBudgetMode('hourly')"
  style="flex: 1; background: #FFFFFF; border: 2px solid #000000; border-radius: 12px; padding: 20px; cursor: pointer; display: flex; flex-direction: column; gap: 12px; font-family: inherit; color: #000000;">
  <div style="display: flex; justify-content: space-between; align-items: flex-start;">
    <span class="material-symbols-outlined" style="font-size: 24px;">schedule</span>
    <div id="budget-radio-hourly" style="width: 20px; height: 20px; border: 2px solid #000; border-radius: 50%;"></div>
  </div>
  <div style="font-weight: 800; font-size: 16px; text-align: left;">Taxa por hora</div>
</button>

    <button
  id="budget-panel-fixed"
  type="button"
  onclick="App.setBudgetMode('fixed')"
  style="flex: 1; background: #000000; color: #CCFF00; border: 2px solid #000000; border-radius: 12px; padding: 20px; cursor: pointer; display: flex; flex-direction: column; gap: 12px; font-family: inherit;">
  <div style="display: flex; justify-content: space-between; align-items: flex-start;">
    <span class="material-symbols-outlined" style="font-size: 24px;">sell</span>
    <div id="budget-radio-fixed" style="width: 20px; height: 20px; border: 2px solid #CCFF00; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
      <div style="width: 10px; height: 10px; background: #CCFF00; border-radius: 50%;"></div>
    </div>
  </div>
  <div style="font-weight: 800; font-size: 16px; text-align: left;">Preço Fixo</div>
</button>
  </div>

  <!-- Painel Preço Fixo -->
  <div id="budget-panel-fixed" style="display: flex; flex-direction: column; gap: 32px;">
    <p style="font-size: 14px; color: rgba(0,0,0,0.7); margin: 0;">
      Defina um valor total para o projeto e pague ao final ou por marcos de entrega.
    </p>

    <div style="display: flex; flex-direction: column; gap: 12px;">
      <label style="font-size: 14px; font-weight: 800; text-transform: uppercase;">
        Qual é a melhor estimativa de custo para o seu projeto?
      </label>
      <div style="background: #FFFFFF; border: 2px solid #000000; border-radius: 12px; padding: 16px; display: flex; justify-content: flex-end; align-items: center; font-weight: 800; font-size: 24px;">
        Kz 95.000,00
      </div>
      <p style="font-size: 12px; color: rgba(0,0,0,0.5); margin: 0;">
        Pode negociar este valor com o talento antes de iniciar o trabalho.
      </p>
    </div>

    <div style="background: rgba(0,0,0,0.05); border-radius: 12px; padding: 24px; display: flex; flex-direction: column; gap: 20px;">
      <p style="font-size: 14px; margin: 0; font-weight: 500;">
        Esta é a faixa média para projetos similares. Clientes costumam pagar entre
        <span style="font-weight: 800;">Kz 70.000,00</span> e
        <span style="font-weight: 800;">Kz 120.000,00</span>.
      </p>

      <div style="display: flex; flex-direction: column; gap: 8px;">
        <div style="display: flex; align-items: flex-end; gap: 4px; height: 60px; justify-content: center;">
          <div style="width: 24px; height: 20%; background: #FFF; border: 1px solid #000;"></div>
          <div style="width: 24px; height: 40%; background: #FFF; border: 1px solid #000;"></div>
          <div style="width: 24px; height: 70%; background: #000;"></div>
          <div style="width: 24px; height: 100%; background: #000;"></div>
          <div style="width: 24px; height: 85%; background: #000;"></div>
          <div style="width: 24px; height: 60%; background: #000;"></div>
          <div style="width: 24px; height: 30%; background: #FFF; border: 1px solid #000;"></div>
          <div style="width: 24px; height: 15%; background: #FFF; border: 1px solid #000;"></div>
        </div>

        <div style="display: flex; justify-content: space-between; font-size: 10px; font-weight: 700; color: rgba(0,0,0,0.6);">
          <span>Kz 20k</span>
          <span>Kz 70k</span>
          <span>Kz 120k</span>
          <span>Kz 200k+</span>
        </div>
      </div>
    </div>

    <a href="#" style="font-size: 14px; font-weight: 700; color: #000; text-decoration: underline;">
      Não está pronto para definir um orçamento?
    </a>
  </div>

  <!-- Painel Taxa por Hora -->
  <div id="budget-panel-hourly" style="display: none; flex-direction: column; gap: 32px;">
    
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
      <div style="display: flex; flex-direction: column; gap: 8px;">
        <label style="font-weight: 800; font-size: 14px; text-transform: uppercase;">De</label>
        <div style="background-color: #FFF; border: 2px solid #000; border-radius: 12px; padding: 16px; display: flex; justify-content: flex-end; align-items: baseline;">
          <span style="font-weight: 800; font-size: 20px; color: #000;">Kz 15.000,00</span>
          <span style="font-size: 14px; color: rgba(0,0,0,0.4); margin-left: 4px;">/hr</span>
        </div>
      </div>

      <div style="display: flex; flex-direction: column; gap: 8px;">
        <label style="font-weight: 800; font-size: 14px; text-transform: uppercase;">Até</label>
        <div style="background-color: #FFF; border: 2px solid #000; border-radius: 12px; padding: 16px; display: flex; justify-content: flex-end; align-items: baseline;">
          <span style="font-weight: 800; font-size: 20px; color: #000;">Kz 35.000,00</span>
          <span style="font-size: 14px; color: rgba(0,0,0,0.4); margin-left: 4px;">/hr</span>
        </div>
      </div>
    </div>

    <div style="background: rgba(0,0,0,0.05); border-radius: 12px; padding: 24px; display: flex; flex-direction: column; gap: 20px;">
      <div>
        <p style="margin: 0; font-weight: 800; font-size: 16px;">Taxas médias:</p>
        <p style="margin: 4px 0 0 0; font-size: 14px; color: #000; line-height: 1.4;">
          As taxas para este tipo de projeto costumam variar entre
          <b>Kz 20.000,00</b> e <b>Kz 45.000,00</b> por hora no mercado Angolano.
        </p>
      </div>

      <div style="display: flex; gap: 20px; align-items: flex-end; padding-top: 10px;">
        <div style="writing-mode: vertical-rl; transform: rotate(180deg); font-size: 11px; color: rgba(0,0,0,0.5); font-weight: 600; text-transform: uppercase; white-space: nowrap;">
          Nº de vagas similares
        </div>

        <div style="flex-grow: 1;">
          <div style="display: flex; align-items: flex-end; gap: 4px; height: 80px; border-bottom: 2px solid #000;">
            <div style="flex: 1; height: 20%; background-color: #FFF; border: 1px solid #000; border-bottom: none;"></div>
            <div style="flex: 1; height: 35%; background-color: #FFF; border: 1px solid #000; border-bottom: none;"></div>
            <div style="flex: 1; height: 60%; background-color: #000; border: 1px solid #000; border-bottom: none;"></div>
            <div style="flex: 1; height: 90%; background-color: #000; border: 1px solid #000; border-bottom: none;"></div>
            <div style="flex: 1; height: 75%; background-color: #000; border: 1px solid #000; border-bottom: none;"></div>
            <div style="flex: 1; height: 50%; background-color: #000; border: 1px solid #000; border-bottom: none;"></div>
            <div style="flex: 1; height: 25%; background-color: #FFF; border: 1px solid #000; border-bottom: none;"></div>
            <div style="flex: 1; height: 15%; background-color: #FFF; border: 1px solid #000; border-bottom: none;"></div>
          </div>

          <div style="text-align: center; margin-top: 8px; font-size: 11px; color: rgba(0,0,0,0.5); font-weight: 600; text-transform: uppercase;">
            taxa por hora (Kz)
          </div>
        </div>
      </div>
    </div>

    <a href="#" style="font-size: 14px; font-weight: 700; color: #000; text-decoration: underline;">
      Não está pronto para definir uma taxa por hora?
    </a>
  </div>
</section>
      </main>

      <footer class="step-4-footer">
        <div class="step-4-footer-progress">
          <div class="step-4-footer-progress-bar"></div>
        </div>

        <div class="step-4-footer-inner">
          <button class="footer-btn footer-btn--ghost" type="button" data-route="publicar_trabalho_step_3">
            Voltar
          </button>

          <button class="footer-btn footer-btn--primary" type="button" data-route="publicar_trabalho_step_5">
            PRÓXIMO: DESCRIÇÃO
          </button>
        </div>
      </footer>
    </div>
  </div>
`;

App.templates.publicar_trabalho_step_5 = `
  <div id="view-publicar-trabalho-step-5" style="font-family:'Space Grotesk', sans-serif; background-color:#111; margin:0; padding:0; min-height:100vh; color:#000000; box-sizing:border-box;">
    
    <style>
      #view-publicar-trabalho-step-5,
      #view-publicar-trabalho-step-5 * {
        box-sizing: border-box;
      }

      @media (max-width: 1024px) {
        #view-publicar-trabalho-step-5 .publicar-step-5-main {
          grid-template-columns: 1fr !important;
          gap: 48px !important;
        }
      }

      @media (max-width: 899px) {
        #view-publicar-trabalho-step-5 .publicar-step-5-shell {
          margin-left: 0 !important;
        }

        #view-publicar-trabalho-step-5 .publicar-step-5-footer {
          left: 0 !important;
          width: 100% !important;
        }

        #view-publicar-trabalho-step-5 .publicar-step-5-header,
        #view-publicar-trabalho-step-5 .publicar-step-5-main {
          padding-left: 20px !important;
          padding-right: 20px !important;
        }

        #view-publicar-trabalho-step-5 .publicar-step-5-footer-inner {
          padding-left: 20px !important;
          padding-right: 20px !important;
        }
      }

      @media (max-width: 640px) {
        #view-publicar-trabalho-step-5 .publicar-step-5-shell {
          padding-bottom: 150px !important;
        }

        #view-publicar-trabalho-step-5 .publicar-step-5-meta {
          flex-direction: column !important;
          align-items: flex-start !important;
          gap: 8px !important;
        }

        #view-publicar-trabalho-step-5 .publicar-step-5-footer {
          height: auto !important;
        }

        #view-publicar-trabalho-step-5 .publicar-step-5-footer-inner {
          flex-direction: column !important;
          align-items: stretch !important;
          gap: 12px !important;
          padding: 16px 20px !important;
        }

        #view-publicar-trabalho-step-5 .publicar-step-5-footer-inner button {
          width: 100% !important;
        }
      }
    </style>

    <div class="publicar-step-5-shell" style="min-height:100vh; background-color:#CCFF00; position:relative; padding-bottom:88px; display:flex; flex-direction:column; box-sizing:border-box;">
      
      <header class="publicar-step-5-header" style="padding:28px 40px; display:flex; justify-content:space-between; align-items:center; max-width:1200px; width:100%; margin:0 auto; box-sizing:border-box;">
        <div style="font-weight:800; font-size:24px; letter-spacing:-0.02em;">SKILLA</div>
        <button style="background:none; border:none; font-weight:700; font-size:14px; cursor:pointer; text-transform:uppercase; font-family:inherit;">Sair</button>
      </header>

      <main class="publicar-step-5-main" style="max-width:1200px; width:100%; margin:0 auto; padding:40px; display:grid; grid-template-columns:5fr 7fr; gap:80px; flex:1; box-sizing:border-box;">
        
        <!-- Coluna Esquerda -->
        <section style="display:flex; flex-direction:column; gap:24px; box-sizing:border-box;">
          <div style="display:flex; align-items:center; gap:12px; font-weight:700; font-size:14px;">
            <span style="background:#000000; color:#CCFF00; padding:6px 12px; border-radius:999px;">5/5</span>
            <span>Publicação de vaga</span>
          </div>

          <h1 style="font-size:48px; font-weight:800; line-height:1.1; letter-spacing:-0.03em; margin:0;">
            Descreva o trabalho detalhadamente.
          </h1>

          <p style="font-size:18px; line-height:1.6; color:rgba(0, 0, 0, 0.65); max-width:400px; margin:0;">
            Isso ajuda os freelancers a entenderem exatamente o que você precisa. Seja claro sobre entregas e prazos.
          </p>
        </section>

        <!-- Coluna Direita -->
        <section style="display:flex; flex-direction:column; gap:32px; box-sizing:border-box;">
          <div style="display:flex; flex-direction:column; gap:12px;">
            <label for="publicar-trabalho-descricao" style="font-size:14px; font-weight:800; text-transform:uppercase;">
              Descreva o que você precisa
            </label>

            <textarea
              id="publicar-trabalho-descricao"
              placeholder="Já tem uma descrição? Cole-a aqui!"
              style="width:100%; height:300px; background:#FFFFFF; border:2px solid #000000; border-radius:12px; padding:16px; font-family:inherit; font-size:16px; box-sizing:border-box; resize:none;"
            ></textarea>

            <div class="publicar-step-5-meta" style="display:flex; justify-content:space-between; font-size:12px; color:rgba(0,0,0,0.6); font-weight:500; gap:12px;">
              <span>50.000 caracteres restantes</span>
              <a href="#" style="color:#000; text-decoration:underline;">Veja exemplos de descrições eficazes</a>
            </div>
          </div>

          <div style="background:rgba(255,255,255,0.5); border:2px solid #000000; border-radius:12px; padding:24px; display:flex; flex-direction:column; gap:12px;">
            <div style="font-weight:800; font-size:16px;">Dicas para uma boa descrição:</div>

            <ul style="margin:0; padding-left:20px; display:flex; flex-direction:column; gap:8px; font-size:14px; line-height:1.4;">
              <li>Detalhe as habilidades necessárias.</li>
              <li>Explique o objetivo do projecto.</li>
              <li>Mencione o prazo de entrega.</li>
            </ul>
          </div>

          <button style="width:fit-content; height:48px; padding:0 32px; border-radius:12px; border:2px solid #000000; background:transparent; color:#000000; font-weight:800; font-size:14px; text-transform:uppercase; cursor:pointer; font-family:inherit;">
            Anexar arquivo
          </button>
        </section>
      </main>

      <footer class="publicar-step-5-footer" style="position:fixed; bottom:0; left:300px; width:calc(100% - 300px); height:88px; background-color:#CCFF00; border-top:2px solid #000000; display:flex; flex-direction:column; z-index:100; box-sizing:border-box;">
        <div style="height:8px; background:transparent; width:100%; box-sizing:border-box;">
          <div style="height:8px; background:#000000; width:100%;"></div>
        </div>

        <div class="publicar-step-5-footer-inner" style="flex:1; display:flex; justify-content:space-between; align-items:center; padding:0 40px; max-width:1200px; width:100%; margin:0 auto; box-sizing:border-box;">
          <button data-route="publicar_trabalho_step_4" style="height:48px; padding:0 32px; border-radius:12px; border:2px solid #000000; font-weight:800; font-size:14px; text-transform:uppercase; cursor:pointer; display:flex; align-items:center; justify-content:center; background:transparent; color:#000000; font-family:inherit;">
            Voltar
          </button>

          <button data-route="publicar_trabalho_review" style="height:48px; padding:0 32px; border-radius:12px; border:2px solid #000000; font-weight:800; font-size:14px; text-transform:uppercase; cursor:pointer; display:flex; align-items:center; justify-content:center; background:#000000; color:#CCFF00; font-family:inherit;">
            PRÓXIMO: REVISAR
          </button>
        </div>
      </footer>
    </div>
  </div>
`;


App.templates.publicar_trabalho_review = `
  <div id="view-publicar-trabalho-review" style="font-family:'Hanken Grotesk', sans-serif; background-color:#CCFF00; margin:0; padding:0; min-height:100vh; color:#101415; box-sizing:border-box;">
    
    <style>
      #view-publicar-trabalho-review,
      #view-publicar-trabalho-review * {
        box-sizing: border-box;
      }

      #view-publicar-trabalho-review .space-font {
        font-family: 'Space Grotesk', sans-serif;
      }

      #view-publicar-trabalho-review .review-shell {
        min-height: 100vh;
        background-color: #CCFF00;
        position: relative;
        padding-bottom: 96px;
        display: flex;
        flex-direction: column;
        margin-left: 0 !important;
      }

      #view-publicar-trabalho-review .review-header {
        background: #CCFF00;
        border-bottom: 1px solid rgba(16,20,21,.12);
        position: sticky;
        top: 0;
        z-index: 30;
      }

      #view-publicar-trabalho-review .review-header-inner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        padding: 20px 40px;
        max-width: 1200px;
        margin: 0 auto;
        gap: 16px;
      }

      #view-publicar-trabalho-review .review-main {
        flex: 1;
        padding: 32px 40px 128px 40px;
        max-width: 1200px;
        width: 100%;
        margin: 0 auto;
      }

      #view-publicar-trabalho-review .review-topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-bottom: 32px;
      }

      #view-publicar-trabalho-review .review-card {
        background-color: #FFFFFF;
        border: 2px solid #101415;
        border-radius: 12px;
        transition: transform .2s ease, box-shadow .2s ease;
      }

      #view-publicar-trabalho-review .review-card:hover {
        transform: translateY(-2px);
        box-shadow: 4px 4px 0px #101415;
      }

      #view-publicar-trabalho-review .btn-primary-black {
        background-color: #101415;
        color: #CCFF00;
        transition: all .2s ease;
      }

      #view-publicar-trabalho-review .btn-primary-black:active {
        transform: scale(.96);
        opacity: .9;
      }

      #view-publicar-trabalho-review .btn-ghost {
        background: transparent;
        border: 2px solid #101415;
        color: #101415;
      }

      #view-publicar-trabalho-review .skill-tag {
        background: #101415;
        color: #FFFFFF;
        padding: 4px 12px;
        border-radius: 100px;
        font-family: 'JetBrains Mono', monospace;
        font-size: 12px;
      }

      #view-publicar-trabalho-review {
  --sidebar-w: 300px;
  
}
#view-publicar-trabalho-review .review-footer {
  position: fixed;
  bottom: 0;
  
  width: 82% !important;
  background: #FFFFFF;
  border-top: 2px solid #101415;
  z-index: 50;
}

      #view-publicar-trabalho-review .review-footer-progress {
        height: 6px;
        width: 100%;
        background: rgba(16,20,21,.10);
      }

      #view-publicar-trabalho-review .review-footer-progress-bar {
        height: 100%;
        width: 100%;
        background: #101415;
        box-shadow: 0 0 15px rgba(204,255,0,.5);
      }

      #view-publicar-trabalho-review .review-footer-inner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 16px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
      }

      @media (max-width: 899px) {
        #view-publicar-trabalho-review .review-header-inner,
        #view-publicar-trabalho-review .review-main,
        #view-publicar-trabalho-review .review-footer-inner {
          padding-left: 20px !important;
          padding-right: 20px !important;
        }

        #view-publicar-trabalho-review .review-topbar {
          flex-direction: column;
          align-items: flex-start;
        }
      }

      @media (max-width: 640px) {
        #view-publicar-trabalho-review .review-shell {
          padding-bottom: 150px !important;
        }

        #view-publicar-trabalho-review .review-footer-inner {
          flex-direction: column !important;
          align-items: stretch !important;
        }

        #view-publicar-trabalho-review .review-footer-actions {
          width: 100%;
          display: flex;
          flex-direction: column;
          gap: 12px;
        }

        #view-publicar-trabalho-review .review-footer-actions button,
        #view-publicar-trabalho-review .review-footer-inner > button,
        #view-publicar-trabalho-review .review-topbar button {
          width: 100%;
          justify-content: center;
        }

        #view-publicar-trabalho-review .review-card {
          padding: 18px !important;
        }
      }
    </style>

    <div class="review-shell">
      

      <main class="review-main">
        <div class="review-topbar">
          <h1 class="space-font" style="margin:0; font-size:48px; font-weight:800; line-height:1; letter-spacing:-0.03em;">
            Detalhes da vaga
          </h1>

          <button class="btn-primary-black" type="button" style="border:0; padding:14px 28px; border-radius:999px; font-weight:800; font-size:18px; display:inline-flex; align-items:center; gap:10px; cursor:pointer; font-family:inherit;">
            <span>Publicar esta vaga</span>
            <span style="font-size:18px; line-height:1;">➜</span>
          </button>
        </div>

        <div style="display:flex; flex-direction:column; gap:16px;">
          
          <!-- Card 1 -->
          <div class="review-card" style="padding:24px; display:flex; justify-content:space-between; align-items:flex-start; gap:16px;">
            <div style="display:flex; flex-direction:column; gap:6px;">
              <span style="font-size:12px; color:rgba(16,20,21,.5); text-transform:uppercase; letter-spacing:.14em; font-weight:800;">
                Título da vaga
              </span>
              <h2 class="space-font" style="margin:0; font-size:24px; font-weight:800; line-height:1.2;">
                UI/UX designer que conecta pessoas usando websites impecáveis
              </h2>
            </div>

            <button type="button" style="border:0; background:transparent; cursor:pointer; padding:8px; border-radius:999px; font-size:18px;">
              ✎
            </button>
          </div>

          <!-- Card 2 -->
          <div class="review-card" style="padding:24px; display:flex; justify-content:space-between; align-items:flex-start; gap:16px;">
            <div style="display:flex; flex-direction:column; gap:6px;">
              <span style="font-size:12px; color:rgba(16,20,21,.5); text-transform:uppercase; letter-spacing:.14em; font-weight:800;">
                Descrição
              </span>
              <p style="margin:0; font-size:16px; line-height:1.6; color:rgba(16,20,21,.8);">
                Eu sou muito bom no meu trabalho, quero dizer, conectar pessoas é a minha especialidade. Busco alguém que possa traduzir essa visão em uma experiência digital única.
              </p>
            </div>

            <button type="button" style="border:0; background:transparent; cursor:pointer; padding:8px; border-radius:999px; font-size:18px;">
              ✎
            </button>
          </div>

          <!-- Card 3 -->
          <div class="review-card" style="padding:24px; display:flex; justify-content:space-between; align-items:flex-start; gap:16px;">
            <div style="display:flex; flex-direction:column; gap:6px;">
              <span style="font-size:12px; color:rgba(16,20,21,.5); text-transform:uppercase; letter-spacing:.14em; font-weight:800;">
                Categoria
              </span>
              <p class="space-font" style="margin:0; font-size:18px; font-weight:800;">
                UX/UI Design
              </p>
            </div>

            <button type="button" style="border:0; background:transparent; cursor:pointer; padding:8px; border-radius:999px; font-size:18px;">
              ✎
            </button>
          </div>

          <!-- Card 4 -->
          <div class="review-card" style="padding:24px; display:flex; justify-content:space-between; align-items:flex-start; gap:16px;">
            <div style="display:flex; flex-direction:column; gap:8px; width:100%;">
              <span style="font-size:12px; color:rgba(16,20,21,.5); text-transform:uppercase; letter-spacing:.14em; font-weight:800;">
                Competências
              </span>

              <div style="display:flex; flex-wrap:wrap; gap:8px;">
                <span class="skill-tag">CSS</span>
                <span class="skill-tag">Graphic Design</span>
                <span class="skill-tag">Mobile App Design</span>
                <span class="skill-tag">Mockup</span>
                <span class="skill-tag">UX Research</span>
                <span class="skill-tag">User Interface Design</span>
                <span class="skill-tag">Web Design</span>
              </div>
            </div>

            <button type="button" style="border:0; background:transparent; cursor:pointer; padding:8px; border-radius:999px; font-size:18px;">
              ✎
            </button>
          </div>

          <!-- Card 5 -->
          <div class="review-card" style="padding:24px; display:flex; justify-content:space-between; align-items:flex-start; gap:16px;">
            <div style="display:flex; flex-direction:column; gap:6px;">
              <span style="font-size:12px; color:rgba(16,20,21,.5); text-transform:uppercase; letter-spacing:.14em; font-weight:800;">
                Âmbito
              </span>
              <p class="space-font" style="margin:0; font-size:18px; font-weight:800;">
                Médio · 1 a 3 meses · Intermediário
              </p>
            </div>

            <button type="button" style="border:0; background:transparent; cursor:pointer; padding:8px; border-radius:999px; font-size:18px;">
              ✎
            </button>
          </div>

          <!-- Card 6 -->
          <div class="review-card" style="padding:24px; display:flex; justify-content:space-between; align-items:flex-start; gap:16px;">
            <div style="display:flex; flex-direction:column; gap:6px;">
              <span style="font-size:12px; color:rgba(16,20,21,.5); text-transform:uppercase; letter-spacing:.14em; font-weight:800;">
                Orçamento
              </span>
              <p class="space-font" style="margin:0; font-size:24px; font-weight:800;">
                Preço fixo · Kz 95.000,00
              </p>
            </div>

            <button type="button" style="border:0; background:transparent; cursor:pointer; padding:8px; border-radius:999px; font-size:18px;">
              ✎
            </button>
            
          </div>

        </div>
        
      </main>

      <footer class="review-footer">
        <div class="review-footer-progress">
          <div class="review-footer-progress-bar"></div>
        </div>

        <div class="review-footer-inner">
          <button
            class="btn-ghost"
            type="button"
            data-route="publicar_trabalho_step_5"
            style="padding:10px 24px; border-radius:999px; font-weight:800; display:inline-flex; align-items:center; gap:8px; cursor:pointer; font-family:inherit; font-size:14px;">
            <span>←</span>
            <span>Voltar</span>
          </button>

          <div class="review-footer-actions" style="display:flex; align-items:center; gap:24px;">
            <span style="font-size:12px; font-weight:800; color:rgba(16,20,21,.4); text-transform:uppercase; letter-spacing:.08em;">
              Pronto para lançar
            </span>

            <button
              class="btn-primary-black"
              type="button"
              style="border:0; padding:14px 32px; border-radius:999px; font-weight:800; font-size:18px; cursor:pointer; font-family:inherit;">
              Publicar vaga
            </button>
          </div>
        </div>
      </footer>
    </div>
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
             if (route === 'publicar_trabalho_step_4' && App.initPublicarTrabalhoStep4) {
                App.initPublicarTrabalhoStep4();
            }
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

            // Abrir detalhe do trabalho
            spaView.querySelectorAll('[data-open-job]').forEach(btn => {
                btn.addEventListener('click', () => render('trabalho_detalhe'));
            });

            // Abrir wizard
            spaView.querySelector('#btn-adicionar-trabalhos')
                ?.addEventListener('click', () => render('publicar_trabalho_step_1'));
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

            if (route === 'publicar_trabalho_step_1') {
                // binds do wizard
                const titleEl = spaView.querySelector('#wiz-title');
                const errEl = spaView.querySelector('#wiz-title-error');

                spaView.querySelector('[data-wiz-action="back"]')?.addEventListener('click', () => render('trabalhos'));

                spaView.querySelector('[data-wiz-action="next"]')?.addEventListener('click', () => {
                    const value = (titleEl?.value || '').trim();
                    if (!value) { errEl?.classList.remove('hidden'); return; }
                    // salva no estado e avança...
                });
            }

            // Lógica Mensagens
            if (route === 'mensagens') {
                spaView.querySelectorAll('[data-open-chat]').forEach(card => {
                    card.addEventListener('click', () => render('mensagens_sala'));
                });
            }

            if (route === 'mensagens_sala') {
                
                const modal = spaView.querySelector('#deliverModal');
                const openBtn = spaView.querySelector('#openDeliverModalBtn');
                const closeBtn = spaView.querySelector('#closeDeliverModalBtn');
                const cancelBtn = spaView.querySelector('#cancelDeliverModalBtn');
                const confirmBtn = spaView.querySelector('#confirmDeliverBtn');
                const fileInput = spaView.querySelector('#deliverFile');
                const dropzone = spaView.querySelector('#deliverDropzone');
                const linkInput = spaView.querySelector('#deliverLink');
                const notesTextarea = spaView.querySelector('#deliverNotes');
                
                
                // Open modal
                openBtn?.addEventListener('click', () => {
                    modal?.classList.remove('hidden');
                    modal?.classList.add('flex');
                });

                // Close modal helper
                const closeModal = () => {
                    modal?.classList.add('hidden');
                    modal?.classList.remove('flex');
                    if (notesTextarea) notesTextarea.value = '';
                    if (linkInput) linkInput.value = '';
                    if (fileInput) fileInput.value = '';
                    if (dropzone) {
                        const dropzoneText = dropzone.querySelector('p.font-headline-md');
                        const dropzoneSubtext = dropzone.querySelector('p.font-body-md');
                        const dropzoneIcon = dropzone.querySelector('span.material-symbols-outlined');
                        if (dropzoneText) dropzoneText.textContent = 'Arraste ficheiros aqui ou clique para selecionar';
                        if (dropzoneSubtext) dropzoneSubtext.textContent = 'PDF, ZIP, PNG, JPG (máx. 25MB)';
                        if (dropzoneIcon) dropzoneIcon.textContent = 'upload';
                    }
                };

                closeBtn?.addEventListener('click', closeModal);
                cancelBtn?.addEventListener('click', closeModal);
                modal?.addEventListener('click', (e) => {
                    if (e.target === modal) closeModal();
                });

                // Dropzone file change handling
                fileInput?.addEventListener('change', () => {
                    if (fileInput.files && fileInput.files.length > 0) {
                        const file = fileInput.files[0];
                        const dropzoneText = dropzone.querySelector('p.font-headline-md');
                        const dropzoneSubtext = dropzone.querySelector('p.font-body-md');
                        const dropzoneIcon = dropzone.querySelector('span.material-symbols-outlined');
                        
                        if (dropzoneText) dropzoneText.textContent = `Ficheiro selecionado: ${file.name}`;
                        if (dropzoneSubtext) {
                            const sizeMB = (file.size / (1024 * 1024)).toFixed(2);
                            dropzoneSubtext.textContent = `Tamanho: ${sizeMB} MB`;
                        }
                        if (dropzoneIcon) dropzoneIcon.textContent = 'check_circle';
                    }
                });

                // Drag & Drop visual feedback
                if (dropzone) {
                    ['dragenter', 'dragover'].forEach(eventName => {
                        dropzone.addEventListener(eventName, () => {
                            dropzone.querySelector('div').classList.add('bg-slate-50', 'border-primary-fixed');
                        });
                    });
                    ['dragleave', 'drop'].forEach(eventName => {
                        dropzone.addEventListener(eventName, () => {
                            dropzone.querySelector('div').classList.remove('bg-slate-50', 'border-primary-fixed');
                        });
                    });
                }

                // Confirm delivery action
                confirmBtn?.addEventListener('click', () => {
                    const notes = notesTextarea ? notesTextarea.value.trim() : '';
                    const link = linkInput ? linkInput.value.trim() : '';
                    const hasFile = fileInput && fileInput.files && fileInput.files.length > 0;
                    const fileName = hasFile ? fileInput.files[0].name : '';

                    if (!notes && !link && !hasFile) {
                        alert('Por favor, adicione notas, um link ou um ficheiro para realizar a entrega.');
                        return;
                    }

                    // Simulated upload delay
                    const originalBtnHTML = confirmBtn.innerHTML;
                    confirmBtn.disabled = true;
                    confirmBtn.innerHTML = '<span class="material-symbols-outlined animate-spin text-[20px]">sync</span> A enviar...';

                    setTimeout(() => {
                        confirmBtn.disabled = false;
                        confirmBtn.innerHTML = originalBtnHTML;

                        // Insert new bubble in the chat messages container
                        const messagesContainer = spaView.querySelector('main div.overflow-y-auto');
                        if (messagesContainer) {
                            const bubble = document.createElement('div');
                            bubble.className = 'flex flex-col items-end gap-1 self-end max-w-[85%] md:max-w-[70%] animate-in fade-in slide-in-from-bottom duration-300';
                            
                            let attachmentsHTML = '';
                            if (hasFile) {
                                attachmentsHTML += `
                                    <div class="mt-3 p-3 bg-slate-50 border border-slate-200 rounded-xl flex items-center gap-3 w-full">
                                        <span class="material-symbols-outlined text-slate-700">description</span>
                                        <div class="flex-1 min-w-0 text-left">
                                            <p class="font-label-md text-sm font-bold text-slate-900 truncate">${fileName}</p>
                                            <p class="font-body-md text-xs text-slate-500">Documento de entrega</p>
                                        </div>
                                    </div>
                                `;
                            }
                            if (link) {
                                attachmentsHTML += `
                                    <div class="mt-3 p-3 bg-slate-50 border border-slate-200 rounded-xl flex items-center gap-3 w-full">
                                        <span class="material-symbols-outlined text-slate-700">link</span>
                                        <div class="flex-1 min-w-0 text-left">
                                            <a href="${link}" target="_blank" class="font-label-md text-sm font-bold text-blue-600 hover:underline truncate block">${link}</a>
                                            <p class="font-body-md text-xs text-slate-500 font-medium">Link externo do projeto</p>
                                        </div>
                                    </div>
                                `;
                            }

                            bubble.innerHTML = `
                                <div class="flex items-end gap-2 flex-row-reverse w-full">
                                    <div class="w-8 h-8 rounded-full overflow-hidden shrink-0 border border-gray-200 bg-gray-100">
                                        <img alt="Freelancer" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBVh9mjw_BNDKV0SQb7r7p6eg28yfNAcoDEVFV3yOooMbrvXBMvLQ1DgzGQ7Asu-RLUS8V8yJmetSFOkiDuuC7mSSWjhABZZ6B8k__8evJeWMGv6wjNtCdFKKAfojUlhvxoWJ1_lCqGX8Xq3wLfhfk74dE74jCej86W65UJshxxJgL-vOFxhRYZ0b8KoaQW0OXxU4sW--xTiKVQ-i_seqAaCrvQz1sJuEssSxojG1Vm5sCP7NYdeUmPfGXgFulzHQXKKCqlDlBCNUI" />
                                    </div>
                                    <div class="bg-white text-black border-2 border-black p-5 rounded-2xl rounded-tr-sm shadow-md w-full text-left">
                                        <div class="flex items-center gap-2 text-green-600 mb-2">
                                            <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                            <span class="font-label-md text-sm font-bold uppercase tracking-wider">Trabalho Entregue</span>
                                        </div>
                                        ${notes ? `<p class="font-body-md text-body-md text-slate-800 italic bg-slate-50 p-3 rounded-lg border border-slate-100 mb-2">"${notes}"</p>` : ''}
                                        ${attachmentsHTML}
                                    </div>
                                </div>
                                <span class="font-label-sm text-label-sm text-gray-500 mr-10">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span>
                            `;
                            
                            const spacer = messagesContainer.querySelector('.h-10.shrink-0');
                            if (spacer) {
                                messagesContainer.insertBefore(bubble, spacer);
                            } else {
                                messagesContainer.appendChild(bubble);
                            }

                            // Scroll to bottom
                            messagesContainer.scrollTo({
                                top: messagesContainer.scrollHeight,
                                behavior: 'smooth'
                            });
                        }

                        // Update Status Badge in Header
                        const statusBadge = spaView.querySelector('span.text-primary-fixed.font-bold');
                        if (statusBadge) {
                            statusBadge.textContent = 'Status: Em Revisão';
                            statusBadge.className = 'font-label-sm text-label-sm text-amber-600 font-bold';
                        }

                        closeModal();
                        alert('Entrega realizada com sucesso!');
                    }, 1200);
                });

                // Implement chat composer functionality
                const chatInput = spaView.querySelector('#chat-input');
                const chatSendBtn = spaView.querySelector('#chat-send-btn');
                const messagesContainer = spaView.querySelector('main div.overflow-y-auto');

                const sendTextMessage = () => {
                    const text = chatInput ? chatInput.value.trim() : '';
                    if (!text) return;

                    if (chatInput) chatInput.value = '';

                    const bubble = document.createElement('div');
                    bubble.className = 'flex flex-col items-end gap-1 self-end max-w-[85%] md:max-w-[70%] animate-in fade-in slide-in-from-bottom duration-300 w-full';
                    bubble.innerHTML = `
                        <div class="flex items-end gap-2 flex-row-reverse w-full">
                            <div class="w-8 h-8 rounded-full overflow-hidden shrink-0 border border-gray-200 bg-gray-100">
                                <img alt="Freelancer" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBVh9mjw_BNDKV0SQb7r7p6eg28yfNAcoDEVFV3yOooMbrvXBMvLQ1DgzGQ7Asu-RLUS8V8yJmetSFOkiDuuC7mSSWjhABZZ6B8k__8evJeWMGv6wjNtCdFKKAfojUlhvxoWJ1_lCqGX8Xq3wLfhfk74dE74jCej86W65UJshxxJgL-vOFxhRYZ0b8KoaQW0OXxU4sW--xTiKVQ-i_seqAaCrvQz1sJuEssSxojG1Vm5sCP7NYdeUmPfGXgFulzHQXKKCqlDlBCNUI" />
                            </div>
                            <div class="bg-white text-black border border-gray-200 p-4 rounded-2xl rounded-br-sm shadow-md text-left">
                                <p class="font-body-md text-body-md">${text}</p>
                            </div>
                        </div>
                        <span class="font-label-sm text-label-sm text-gray-500 mr-10">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span>
                    `;

                    const spacer = messagesContainer?.querySelector('.h-10.shrink-0');
                    if (messagesContainer) {
                        if (spacer) {
                            messagesContainer.insertBefore(bubble, spacer);
                        } else {
                            messagesContainer.appendChild(bubble);
                        }
                        messagesContainer.scrollTo({
                            top: messagesContainer.scrollHeight,
                            behavior: 'smooth'
                        });
                    }
                };

                chatSendBtn?.addEventListener('click', sendTextMessage);
                chatInput?.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        sendTextMessage();
                    }
                });
            }

            if (route === 'inicio') {
                spaView.querySelector('#btn-explorar-trabalhos')?.addEventListener('click', () => render('trabalhos'));
                spaView.querySelector('#botaoDirecionarCarregarSaldo')?.addEventListener('click', () => render('carteira_carregar_saldo'));
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

        document.querySelectorAll('.neo-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translate(-4px, -4px)';
                card.style.boxShadow = '8px 8px 0px 0px #101415';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translate(0px, 0px)';
                card.style.boxShadow = '4px 4px 0px 0px #101415';
            });
        });
        document.querySelectorAll('.neo-shadow-hover').forEach(button => {
            button.addEventListener('mousedown', () => {
                button.style.transform = 'translate(4px, 4px)';
                button.classList.remove('neo-shadow');
            });
            button.addEventListener('mouseup', () => {
                button.style.transform = 'translate(0px, 0px)';
                button.classList.add('neo-shadow');
            });
            button.addEventListener('mouseleave', () => {
                button.style.transform = 'translate(0px, 0px)';
                button.classList.add('neo-shadow');
            });
        });

        // Atmospheric micro-interaction: The profile card responds slightly to mouse movement
        const profileCard = document.querySelector('section.bg-white');
        if (profileCard) {
            document.addEventListener('mousemove', (e) => {
                const xAxis = (window.innerWidth / 2 - e.pageX) / 100;
                const yAxis = (window.innerHeight / 2 - e.pageY) / 100;
                // Only very subtle to maintain the rigid "Neo-brutalism" feel
                // profileCard.style.transform = `rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
         });
        }

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

        // Função para salvar mensagem no localStorage e notificar outras páginas
        function saveMessageToLocalStorage(message, isUser = true) {
            const messages = JSON.parse(localStorage.getItem('skilla_messages') || '[]');
            const newMessage = {
                id: Date.now(),
                text: message,
                timestamp: new Date().toISOString(),
                isUser: isUser,
                avatar: isUser ? 
                    "https://lh3.googleusercontent.com/aida-public/AB6AXuBVh9mjw_BNDKV0SQb7r7p6eg28yfNAcoDEVFV3yOooMbrvXBMvLQ1DgzGQ7Asu-RLUS8V8yJmetSFOkiDuuC7mSSWjhABZZ6B8k__8evJeWMGv6wjNtCdFKKAfojUlhvxoWJ1_lCqGX8Xq3wLfhfk74dE74jCej86W65UJshxxJgL-vOFxhRYZ0b8KoaQW0OXxU4sW--xTiKVQ-i_seqAaCrvQz1sJuEssSxojG1Vm5sCP7NYdeUmPfGXgFulzHQXKKCqlDlBCNUI" :
                    "https://lh3.googleusercontent.com/aida-public/AB6AXuAdsdrxNRELguNRZj1IJOZLygHNtSPVOgi8_ZOn-y4IAJOwfmHVOgkqbnYLILHPczmdjFaeFVkGoCeuimXarQp-jNI4jpQEi7BS42bFszr6a1SUMqjy5migHyRF47acCZAfTwj-NZbm6AD6PgoHzW8ZJPOl7CY7zokqiujQ4Vl42jeLt1j6ehPipnSZsO-gS9Ifl8eLLgwtxqhOZ1LW41bTrZzWpNVxaNSpBtNa4XPslv47OIYZroenTGJ8WsGiZxzNP6qPwF3IQWQ"
            };
            messages.push(newMessage);
            localStorage.setItem('skilla_messages', JSON.stringify(messages));
            
            // Notificar outras páginas sobre nova mensagem
            window.dispatchEvent(new CustomEvent('skilla-message-received', {
                detail: newMessage
            }));
        }

        // Modificar a função sendTextMessage para salvar no localStorage
        const originalSendTextMessage = sendTextMessage;
        sendTextMessage = () => {
            originalSendTextMessage();
            const chatInput = spaView.querySelector('#chat-input');
            if (chatInput && chatInput.value.trim()) {
                saveMessageToLocalStorage(chatInput.value.trim(), true);
            }
        };
    });
    document.getElementById("deliverFile").addEventListener("change", (e) => {
  const file = e.target.files?.[0];
  if (file) console.log("Selecionado:", file.name, file.size);
});

document.addEventListener('click', function(e) {
  const hourlyTab = e.target.closest('#budget-tab-hourly');
  const fixedTab = e.target.closest('#budget-tab-fixed');

  if (!hourlyTab && !fixedTab) return;

  const tabHourly = document.getElementById('budget-tab-hourly');
  const tabFixed = document.getElementById('budget-tab-fixed');
  const panelHourly = document.getElementById('budget-panel-hourly');
  const panelFixed = document.getElementById('budget-panel-fixed');
  const radioHourly = document.getElementById('budget-radio-hourly');
  const radioFixed = document.getElementById('budget-radio-fixed');

  if (hourlyTab) {
    tabHourly.style.background = '#000000';
    tabHourly.style.color = '#CCFF00';

    tabFixed.style.background = '#FFFFFF';
    tabFixed.style.color = '#000000';

    radioHourly.style.border = '2px solid #CCFF00';
    radioHourly.innerHTML = '<div style="width:10px;height:10px;background:#CCFF00;border-radius:50%;"></div>';

    radioFixed.style.border = '2px solid #000000';
    radioFixed.innerHTML = '';

    panelHourly.style.display = 'flex';
    panelFixed.style.display = 'none';
  }

  if (fixedTab) {
    tabFixed.style.background = '#000000';
    tabFixed.style.color = '#CCFF00';

    tabHourly.style.background = '#FFFFFF';
    tabHourly.style.color = '#000000';

    radioFixed.style.border = '2px solid #CCFF00';
    radioFixed.innerHTML = '<div style="width:10px;height:10px;background:#CCFF00;border-radius:50%;"></div>';

    radioHourly.style.border = '2px solid #000000';
    radioHourly.innerHTML = '';

    panelFixed.style.display = 'flex';
    panelHourly.style.display = 'none';
  }
});

App.initPublicarTrabalhoStep4 = function () {
  const root = document.getElementById('view-publicar-trabalho-step-4');
  if (!root) return;

  const tabHourly = root.querySelector('#budget-tab-hourly');
  const tabFixed = root.querySelector('#budget-tab-fixed');
  const panelHourly = root.querySelector('#budget-panel-hourly');
  const panelFixed = root.querySelector('#budget-panel-fixed');
  const radioHourly = root.querySelector('#budget-radio-hourly');
  const radioFixed = root.querySelector('#budget-radio-fixed');

  if (!tabHourly || !tabFixed || !panelHourly || !panelFixed || !radioHourly || !radioFixed) {
    return;
  }

  function setMode(mode) {
    if (mode === 'hourly') {
      tabHourly.style.background = '#000000';
      tabHourly.style.color = '#CCFF00';

      tabFixed.style.background = '#FFFFFF';
      tabFixed.style.color = '#000000';

      radioHourly.style.border = '2px solid #CCFF00';
      radioHourly.innerHTML = '<div style="width:10px;height:10px;background:#CCFF00;border-radius:50%;"></div>';

      radioFixed.style.border = '2px solid #000000';
      radioFixed.innerHTML = '';

      panelHourly.style.display = 'flex';
      panelFixed.style.display = 'none';
    } else {
      tabFixed.style.background = '#000000';
      tabFixed.style.color = '#CCFF00';

      tabHourly.style.background = '#FFFFFF';
      tabHourly.style.color = '#000000';

      radioFixed.style.border = '2px solid #CCFF00';
      radioFixed.innerHTML = '<div style="width:10px;height:10px;background:#CCFF00;border-radius:50%;"></div>';

      radioHourly.style.border = '2px solid #000000';
      radioHourly.innerHTML = '';

      panelFixed.style.display = 'flex';
      panelHourly.style.display = 'none';
    }
  }

  tabHourly.onclick = function () {
    setMode('hourly');
  };

  tabFixed.onclick = function () {
    setMode('fixed');
  };

  setMode('fixed'); // estado inicial
};

App.setBudgetMode = function(mode) {
  const root = document.getElementById('view-publicar-trabalho-step-4');
  if (!root) return;

  const tabHourly = root.querySelector('#budget-tab-hourly');
  const tabFixed = root.querySelector('#budget-tab-fixed');

  const panelHourly = root.querySelector('#budget-panel-hourly');
  const panelFixed = root.querySelector('#budget-panel-fixed');

  const radioHourly = root.querySelector('#budget-radio-hourly');
  const radioFixed = root.querySelector('#budget-radio-fixed');

  if (!tabHourly || !tabFixed || !panelHourly || !panelFixed || !radioHourly || !radioFixed) {
    return;
  }

  if (mode === 'hourly') {
    tabHourly.style.background = '#000000';
    tabHourly.style.color = '#CCFF00';

    tabFixed.style.background = '#FFFFFF';
    tabFixed.style.color = '#000000';

    radioHourly.style.border = '2px solid #CCFF00';
    radioHourly.innerHTML = '<div style="width:10px;height:10px;background:#CCFF00;border-radius:50%;"></div>';

    radioFixed.style.border = '2px solid #000000';
    radioFixed.innerHTML = '';

    panelHourly.style.display = 'flex';
    panelFixed.style.display = 'none';
  } else {
    tabFixed.style.background = '#000000';
    tabFixed.style.color = '#CCFF00';

    tabHourly.style.background = '#FFFFFF';
    tabHourly.style.color = '#000000';

    radioFixed.style.border = '2px solid #CCFF00';
    radioFixed.innerHTML = '<div style="width:10px;height:10px;background:#CCFF00;border-radius:50%;"></div>';

    radioHourly.style.border = '2px solid #000000';
    radioHourly.innerHTML = '';

    panelFixed.style.display = 'flex';
    panelHourly.style.display = 'none';
  }
};
    
</script>
</body>
</html>