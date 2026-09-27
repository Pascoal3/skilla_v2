Painel Cliente

```
<!DOCTYPE html>

  

<html lang="pt-AO"><head>

<meta charset="utf-8"/>

<meta content="width=device-width, initial-scale=1.0" name="viewport"/>

<title>Skilla - Client Dashboard</title>

<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>

<script id="tailwind-config">

        tailwind.config = {

            darkMode: "class",

            theme: {

                extend: {

                    "colors": {

                        "status-active-bg": "#D1FAE5",

                        "secondary-container": "#d5e0f8",

                        "primary-fixed-dim": "#7bd8b1",

                        "surface": "#f8f9ff",

                        "on-secondary-fixed-variant": "#3c475a",

                        "on-surface-variant": "#3e4943",

                        "on-secondary-container": "#586377",

                        "surface-tint": "#006c4e",

                        "on-primary-container": "#9ffdd3",

                        "on-tertiary-fixed-variant": "#653e00",

                        "background-start": "#FAFBFC",

                        "on-tertiary": "#ffffff",

                        "tertiary-container": "#945d00",

                        "surface-container-highest": "#d3e4fe",

                        "on-error-container": "#93000a",

                        "secondary": "#545f73",

                        "tertiary": "#734700",

                        "on-error": "#ffffff",

                        "surface-container-lowest": "#ffffff",

                        "error-container": "#ffdad6",

                        "inverse-on-surface": "#eaf1ff",

                        "on-surface": "#0b1c30",

                        "surface-container-low": "#eff4ff",

                        "background": "#f8f9ff",

                        "surface-container": "#e5eeff",

                        "white": "#FFFFFF",

                        "on-secondary": "#ffffff",

                        "light-gray": "#F8FAFC",

                        "surface-variant": "#d3e4fe",

                        "status-warning-text": "#EF4444",

                        "status-warning-bg": "#FEE2E2",

                        "secondary-fixed": "#d8e3fb",

                        "on-primary-fixed": "#002115",

                        "outline-variant": "#bdc9c1",

                        "on-primary": "#ffffff",

                        "error": "#ba1a1a",

                        "on-primary-fixed-variant": "#00513a",

                        "tertiary-fixed-dim": "#ffb95f",

                        "inverse-surface": "#213145",

                        "secondary-fixed-dim": "#bcc7de",

                        "outline": "#6e7a73",

                        "primary-fixed": "#97f5cc",

                        "on-tertiary-fixed": "#2a1700",

                        "status-pending-bg": "#FEF3C7",

                        "border-subtle": "#E2E8F0",

                        "primary": "#005d42",

                        "inverse-primary": "#7bd8b1",

                        "on-secondary-fixed": "#111c2d",

                        "on-tertiary-container": "#ffe6cc",

                        "background-end": "#F1F5F9",

                        "tertiary-fixed": "#ffddb8",

                        "surface-dim": "#cbdbf5",

                        "primary-container": "#047857",

                        "on-background": "#0b1c30",

                        "surface-container-high": "#dce9ff",

                        "surface-bright": "#f8f9ff"

                    },

                    "borderRadius": {

                        "DEFAULT": "0.25rem",

                        "lg": "0.5rem",

                        "xl": "0.75rem",

                        "full": "9999px"

                    },

                    "spacing": {

                        "margin-mobile": "16px",

                        "container-max": "1440px",

                        "margin-desktop": "32px",

                        "unit": "4px",

                        "gutter": "24px"

                    },

                    "fontFamily": {

                        "body-lg": ["Inter"],

                        "body-sm": ["Inter"],

                        "body-md": ["Inter"],

                        "headline-sm": ["Inter"],

                        "headline-lg": ["Inter"],

                        "headline-md": ["Inter"],

                        "headline-xl": ["Inter"],

                        "label-md": ["Inter"],

                        "label-sm": ["Inter"],

                        "metric-lg": ["Inter"]

                    },

                    "fontSize": {

                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],

                        "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],

                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],

                        "headline-sm": ["20px", {"lineHeight": "28px", "letterSpacing": "-0.01em", "fontWeight": "600"}],

                        "headline-lg": ["30px", {"lineHeight": "38px", "letterSpacing": "-0.02em", "fontWeight": "700"}],

                        "headline-md": ["24px", {"lineHeight": "32px", "letterSpacing": "-0.02em", "fontWeight": "600"}],

                        "headline-xl": ["36px", {"lineHeight": "44px", "letterSpacing": "-0.02em", "fontWeight": "700"}],

                        "label-md": ["13px", {"lineHeight": "18px", "letterSpacing": "0.01em", "fontWeight": "500"}],

                        "label-sm": ["12px", {"lineHeight": "16px", "fontWeight": "600"}],

                        "metric-lg": ["32px", {"lineHeight": "40px", "fontWeight": "600"}]

                    }

                }

            }

        }

    </script>

</head>

<body class="bg-[#CCFF00] font-body-md text-on-surface flex min-h-screen">

<!-- SideNavBar -->

<aside class="hidden md:flex fixed left-0 top-0 h-full flex-col py-6 bg-[#1A1A1A] border-r border-[#1A1A1A] w-64 md:w-72 z-40">

<div class="px-6 mb-8">

<h1 class="text-headline-md font-headline-md font-bold text-white">Skilla</h1>

<p class="text-body-sm font-body-sm text-gray-300">Plataforma Freelance</p>

</div>

<nav class="flex-1 px-4 space-y-1">

<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-[#CCFF00] text-[#1A1A1A] scale-[0.98] transition-transform duration-150" href="#">

<span class="material-symbols-outlined text-[20px]">dashboard</span>

<span class="text-label-md font-label-md">Painel</span>

</a>

<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-white hover:bg-gray-800 transition-colors" href="#">

<span class="material-symbols-outlined text-[20px]">work</span>

<span class="text-label-md font-label-md">Os Meus Trabalhos</span>

</a>

<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-white hover:bg-gray-800 transition-colors" href="#">

<span class="material-symbols-outlined text-[20px]">description</span>

<span class="text-label-md font-label-md">Propostas Recebidas</span>

</a>

<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-white hover:bg-gray-800 transition-colors" href="#">

<span class="material-symbols-outlined text-[20px]">mail</span>

<span class="text-label-md font-label-md">Mensagens</span>

</a>

<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-white hover:bg-gray-800 transition-colors" href="#">

<span class="material-symbols-outlined text-[20px]">account_balance_wallet</span>

<span class="text-label-md font-label-md">A Minha Carteira</span>

</a>

<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-white hover:bg-gray-800 transition-colors" href="#">

<span class="material-symbols-outlined text-[20px]">star</span>

<span class="text-label-md font-label-md">Avaliações</span>

</a>

<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-white hover:bg-gray-800 transition-colors" href="#">

<span class="material-symbols-outlined text-[20px]">person</span>

<span class="text-label-md font-label-md">O Meu Perfil</span>

</a>

</nav>

<div class="px-4 mt-auto border-t border-gray-800 pt-4 space-y-1">

<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-white hover:bg-gray-800 transition-colors" href="#">

<span class="material-symbols-outlined text-[20px]">settings</span>

<span class="text-label-md font-label-md">Definições</span>

</a>

<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-white hover:bg-gray-800 transition-colors" href="#">

<span class="material-symbols-outlined text-[20px]">logout</span>

<span class="text-label-md font-label-md">Terminar Sessão</span>

</a>

</div>

</aside>

<!-- Main Content Area -->

<div class="flex-1 md:ml-64 lg:ml-72 flex flex-col min-h-screen">

<!-- TopNavBar -->

<header class="bg-white border-b border-border-subtle flex justify-between items-center w-full px-margin-desktop h-16 sticky top-0 z-50">

<div class="flex items-center md:hidden">

<h1 class="text-headline-md font-headline-md font-bold text-primary">Skilla</h1>

</div>

<div class="hidden md:flex flex-1 max-w-md ml-4">

<div class="relative w-full">

<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-secondary text-[20px]">search</span>

<input class="w-full pl-10 pr-4 py-2 bg-light-gray border border-border-subtle rounded-lg text-body-sm font-body-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-shadow" placeholder="Pesquisar..." type="text"/>

</div>

</div>

<div class="flex items-center gap-4 ml-auto">

<button class="text-secondary hover:bg-light-gray p-2 rounded-full transition-colors relative">

<span class="material-symbols-outlined">notifications</span>

<span class="absolute top-2 right-2 w-2 h-2 bg-status-warning-text rounded-full"></span>

</button>

<button class="flex items-center gap-2 hover:bg-light-gray p-1 pr-3 rounded-full transition-colors border border-transparent hover:border-border-subtle">

<img alt="User avatar" class="w-8 h-8 rounded-full border border-border-subtle" data-alt="foto_perfil" src="/img/foto_perfil_exemplar.png"/>

<span class="text-label-md font-label-md hidden sm:block">Pascoal</span>

<span class="material-symbols-outlined text-[18px] hidden sm:block text-secondary">expand_more</span>

</button>

</div>

</header>

<!-- Dashboard Canvas -->

<main class="flex-1 p-6 md:p-8 space-y-6 max-w-container-max mx-auto w-full">

<!-- Greeting -->

<div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-2">

<div>

<h2 class="text-headline-lg font-headline-lg text-on-surface mb-1">Olá, Pascoal 👋</h2>

<p class="text-body-md font-body-md text-secondary">Tens <span class="font-semibold text-primary">4 propostas novas</span> à espera de revisão.</p>

</div>

<button class="bg-[#1A1A1A] text-white text-label-md font-label-md px-4 py-2 rounded-lg hover:bg-black transition-colors flex items-center gap-2">

<span class="material-symbols-outlined text-[18px]">add</span>

                    Publicar Trabalho

                </button>

</div>

<!-- Metrics Grid -->

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

<div class="bg-white border border-border-subtle rounded-[12px] p-5 flex flex-col justify-between">

<div class="flex justify-between items-start mb-4">

<div class="p-2 bg-[#1E1E1E] rounded-lg">

<span class="material-symbols-outlined text-[#CCFF00]">work</span>

</div>

</div>

<div>

<h3 class="text-label-md font-label-md text-secondary uppercase tracking-wider mb-1">Trabalhos Publicados</h3>

<p class="text-metric-lg font-metric-lg text-on-surface">3</p>

</div>

</div>

<div class="bg-white border border-border-subtle rounded-[12px] p-5 flex flex-col justify-between">

<div class="flex justify-between items-start mb-4">

<div class="p-2 bg-[#1E1E1E] rounded-lg">

<span class="material-symbols-outlined text-[#CCFF00]">description</span>

</div>

<span class="bg-[#CCFF00] text-[#1A1A1A] text-label-sm font-label-sm px-2 py-0.5 rounded-full flex items-center gap-1">

<span class="material-symbols-outlined text-[14px]">arrow_upward</span> 4 novas

                        </span>

</div>

<div>

<h3 class="text-label-md font-label-md text-secondary uppercase tracking-wider mb-1">Propostas Recebidas</h3>

<p class="text-metric-lg font-metric-lg text-on-surface">12</p>

</div>

</div>

<div class="bg-white border border-border-subtle rounded-[12px] p-5 flex flex-col justify-between">

<div class="flex justify-between items-start mb-4">

<div class="p-2 bg-[#1E1E1E] rounded-lg">

<span class="material-symbols-outlined text-[#CCFF00]">schedule</span>

</div>

</div>

<div>

<h3 class="text-label-md font-label-md text-secondary uppercase tracking-wider mb-1">Em Andamento</h3>

<p class="text-metric-lg font-metric-lg text-on-surface">1</p>

</div>

</div>

<div class="bg-white border border-border-subtle rounded-[12px] p-5 flex flex-col justify-between">

<div class="flex justify-between items-start mb-4">

<div class="p-2 bg-[#1E1E1E] rounded-lg">

<span class="material-symbols-outlined text-[#CCFF00]">check_circle</span>

</div>

</div>

<div>

<h3 class="text-label-md font-label-md text-secondary uppercase tracking-wider mb-1">Concluídos</h3>

<p class="text-metric-lg font-metric-lg text-on-surface">8</p>

</div>

</div>

</div>

<!-- Sections 1 & 2 Row -->

<div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

<!-- A Minha Carteira (60%) -->

<div class="lg:col-span-3 bg-white border border-border-subtle rounded-[12px] p-6 flex flex-col">

<h3 class="text-headline-sm font-headline-sm mb-6">A Minha Carteira Skilla</h3>

<div class="flex-1 flex flex-col justify-center">

<div class="mb-6">

<p class="text-body-sm font-body-sm text-secondary mb-1">Saldo Disponível</p>

<p class="text-metric-lg font-metric-lg text-[#1A1A1A]">50.000,00 KZS</p>

</div>

<div class="mb-8 bg-[#1A1A1A] p-4 rounded-lg">

<p class="text-body-sm font-body-sm text-[#CCFF00] mb-1">Em Escrow (Cativos)</p>

<p class="text-headline-md font-headline-md text-[#CCFF00]">25.000,00 KZS</p>

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

<div class="space-y-4 flex-1">

<div class="p-4 border border-border-subtle rounded-lg hover:border-status-warning-text/30 transition-colors cursor-pointer">

<div class="flex justify-between items-start mb-2">

<h4 class="text-label-md font-label-md font-semibold">Design de Flyer Promocional</h4>

</div>

<span class="inline-flex items-center gap-1 bg-status-warning-bg text-status-warning-text px-2.5 py-1 rounded-full text-label-sm font-label-sm">

<span class="material-symbols-outlined text-[14px]">error</span>

                                Ação Necessária

                            </span>

</div>

<div class="p-4 border border-border-subtle rounded-lg hover:border-status-pending-bg transition-colors cursor-pointer">

<div class="flex justify-between items-start mb-2">

<h4 class="text-label-md font-label-md font-semibold">Website Corporativo</h4>

</div>

<span class="inline-flex items-center gap-1 bg-[#CCFF00] text-[#1A1A1A] px-2.5 py-1 rounded-full text-label-sm font-label-sm">

<span class="material-symbols-outlined text-[14px]">payments</span>

                                Aguarda Pagamento

                            </span>

</div>

</div>

</div>

</div>

<!-- Os Meus Jobs Ativos -->

<div class="bg-white border border-border-subtle rounded-[12px] overflow-hidden">

<div class="p-6 border-b border-border-subtle flex justify-between items-center bg-white">

<h3 class="text-headline-sm font-headline-sm text-[#1E1E1E]">Os Meus Jobs Ativos</h3>

<a class="text-[#1A1A1A] text-label-md font-label-md hover:underline" href="#">Ver todos</a>

</div>

<div class="divide-y divide-border-subtle">

<div class="p-4 sm:p-6 hover:bg-light-gray transition-colors flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">

<div>

<h4 class="text-body-md font-body-md font-medium mb-1">Desenvolvimento de Website Corporativo</h4>

<p class="text-body-sm font-body-sm text-secondary">Publicado há 2 dias • 5 propostas</p>

</div>

<span class="bg-[#1A1A1A] text-[#CCFF00] px-3 py-1 rounded-full text-label-sm font-label-sm">

                            Aberto

                        </span>

</div>

<div class="p-4 sm:p-6 hover:bg-light-gray transition-colors flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">

<div>

<h4 class="text-body-md font-body-md font-medium mb-1">Criação de Logótipo para Startup</h4>

<p class="text-body-sm font-body-sm text-secondary">Iniciado há 1 semana • Miguel Fernandes</p>

</div>

<span class="bg-[#CCFF00] text-[#1A1A1A] px-3 py-1 rounded-full text-label-sm font-label-sm">

                            Em Andamento

                        </span>

</div>

<div class="p-4 sm:p-6 hover:bg-light-gray transition-colors flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">

<div>

<h4 class="text-body-md font-body-md font-medium mb-1">Design de Flyer Promocional</h4>

<p class="text-body-sm font-body-sm text-secondary">Entregue hoje • Carla Mendes</p>

</div>

<span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-label-sm font-label-sm">

                            Aguarda Revisão

                        </span>

</div>

</div>

</div>

<!-- Two Columns Bottom -->

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

<!-- Últimas Propostas -->

<div class="bg-white border border-border-subtle rounded-[12px] flex flex-col">

<div class="p-6 border-b border-border-subtle">

<h3 class="text-headline-sm font-headline-sm">Últimas Propostas Recebidas</h3>

</div>

<div class="p-6 space-y-4">

<div class="flex items-center gap-4 p-4 border border-border-subtle rounded-lg hover:border-gray-300 transition-colors">

<img alt="Miguel Fernandes" class="w-12 h-12 rounded-full border border-border-subtle" data-alt="A portrait of a male freelance graphic designer. Bright, modern lighting. The background is simple and unobtrusive. The mood is professional and creative. High-quality corporate aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCLkFSjka4Mk6j29pb4Fa0JxERxxeUgjYPre55bYjKxfskKoXAIRE2ju-e1C4EUupBL3WuNVZwihfTOfctIOQB1YUyGOPGzXtVyDlEEvuqNEtW_Jo3iwJdYUeunFHKyw5iaXUOSZyJWLHvVBq7e_OgIcEdZp3xMwqpDAGI06p_jFS2mwrSW1BlRFxpI1prJWk6SD5pzLd7-EEmp5zNzZdOMy14dpRFcQmNxucICJ-CIdVMKNpNqU3t-ItamDlbn2e4l-NlJMMd_BzE"/>

<div class="flex-1">

<h4 class="text-label-md font-label-md font-medium">Miguel Fernandes</h4>

<p class="text-body-sm font-body-sm text-secondary">UI/UX Designer • 4.9 <span class="material-symbols-outlined text-[14px] text-[#F59E0B] align-middle">star</span></p>

</div>

<div class="text-right">

<p class="text-label-md font-label-md font-semibold text-on-surface">75.000 KZS</p>

<a class="text-[#1A1A1A] text-label-sm font-label-sm hover:underline" href="#">Ver Proposta</a>

</div>

</div>

<div class="flex items-center gap-4 p-4 border border-border-subtle rounded-lg hover:border-gray-300 transition-colors">

<img alt="Carla Mendes" class="w-12 h-12 rounded-full border border-border-subtle" data-alt="A portrait of a female freelance web developer. Soft, bright lighting typical of modern corporate SaaS headshots. Clean background. Professional, approachable, and tech-savvy mood." src="https://lh3.googleusercontent.com/aida-public/AB6AXuA106bkiw1dyC4OxgzJ4WLSZ4VXV5eTfSIxazG71GIPKBt_LkRDGLL_Y80u6QiMP7Zj4FtOwHinatz9U7qYP0tXRfYZ8HzHns7k1ezBK74eb0bndTEbvJae9zRMlZED0HBjktmeygCUt0RRiW8cVJ_gitCkU1it8PPrdG_LQLD4zksdaHyALG4iPuun4PTCOCf8wsJNv7xyY9Di960zKnLMalB1ofVD0ofZjvKwQ3lA41eM1Z-iYvbLic9YbJ8_ESYfr_gW4TgrbQU"/>

<div class="flex-1">

<h4 class="text-label-md font-label-md font-medium">Carla Mendes</h4>

<p class="text-body-sm font-body-sm text-secondary">Web Developer • 5.0 <span class="material-symbols-outlined text-[14px] text-[#F59E0B] align-middle">star</span></p>

</div>

<div class="text-right">

<p class="text-label-md font-label-md font-semibold text-on-surface">120.000 KZS</p>

<a class="text-[#1A1A1A] text-label-sm font-label-sm hover:underline" href="#">Ver Proposta</a>

</div>

</div>

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

<tbody class="divide-y divide-border-subtle">

<tr class="hover:bg-light-gray transition-colors">

<td class="p-4 pl-6">

<div class="flex items-center gap-3">

<div class="p-2 bg-status-active-bg rounded-lg">

<span class="material-symbols-outlined text-[18px] text-primary">arrow_downward</span>

</div>

<div>

<p class="text-label-md font-label-md font-medium">Carregamento</p>

<p class="text-body-sm font-body-sm text-secondary">Hoje, 10:45</p>

</div>

</div>

</td>

<td class="p-4 pr-6 text-right">

<p class="text-label-md font-label-md font-semibold text-primary">+50.000,00 KZS</p>

</td>

</tr>

<tr class="hover:bg-light-gray transition-colors">

<td class="p-4 pl-6">

<div class="flex items-center gap-3">

<div class="p-2 bg-light-gray border border-border-subtle rounded-lg">

<span class="material-symbols-outlined text-[18px] text-secondary">lock</span>

</div>

<div>

<p class="text-label-md font-label-md font-medium">Escrow: Website Corp.</p>

<p class="text-body-sm font-body-sm text-secondary">Ontem, 14:20</p>

</div>

</div>

</td>

<td class="p-4 pr-6 text-right">

<p class="text-label-md font-label-md font-semibold text-secondary">-25.000,00 KZS</p>

</td>

</tr>

<tr class="hover:bg-light-gray transition-colors">

<td class="p-4 pl-6">

<div class="flex items-center gap-3">

<div class="p-2 bg-status-warning-bg rounded-lg">

<span class="material-symbols-outlined text-[18px] text-status-warning-text">arrow_upward</span>

</div>

<div>

<p class="text-label-md font-label-md font-medium">Pagamento: Logo Startup</p>

<p class="text-body-sm font-body-sm text-secondary">12 Out, 09:15</p>

</div>

</div>

</td>

<td class="p-4 pr-6 text-right">

<p class="text-label-md font-label-md font-semibold text-on-surface">-15.000,00 KZS</p>

</td>

</tr>

</tbody>

</table>

</div>

</div>

</div>

</main>

</div>

</body>

</html>
```


Painel Freelancer

```
<!DOCTYPE html><html class="dark" lang="pt-AO" style=""><head>

<meta charset="utf-8">

<meta content="width=device-width, initial-scale=1.0" name="viewport">

<title>Skilla - Dashboard do Freelancer</title>

<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com" rel="preconnect">

<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Space+Grotesk:wght@400;500;600;700;900&amp;display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">

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

        .glass-card {

            background: #FFFFFF;

            border-radius: 24px;

        }

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

<div class="flex-1 space-y-2"><a class="flex items-center gap-3 bg-[#CCFF00] text-black-pure rounded-lg px-4 py-3 font-bold transition-all" href="#"><span class="material-symbols-outlined">home</span><span class="font-label-md text-label-md">Início</span></a><a class="flex items-center gap-3 text-on-primary-container hover:text-secondary px-4 py-3 transition-colors" href="#"><span class="material-symbols-outlined">work</span><span class="font-label-md text-label-md">Jobs</span></a><a class="flex items-center gap-3 text-on-primary-container hover:text-secondary px-4 py-3 transition-colors" href="#"><span class="material-symbols-outlined">description</span><span class="font-label-md text-label-md">Propostas</span></a><a class="flex items-center gap-3 text-on-primary-container hover:text-secondary px-4 py-3 transition-colors" href="#"><span class="material-symbols-outlined">chat</span><span class="font-label-md text-label-md">Mensagens</span></a><a class="flex items-center gap-3 text-on-primary-container hover:text-secondary px-4 py-3 transition-colors" href="#"><span class="material-symbols-outlined">account_balance_wallet</span><span class="font-label-md text-label-md">Carteira</span></a><a class="flex items-center gap-3 text-on-primary-container hover:text-secondary px-4 py-3 transition-colors" href="#"><span class="material-symbols-outlined">person</span><span class="font-label-md text-label-md">Perfil</span></a><a class="flex items-center gap-3 text-on-primary-container hover:text-secondary px-4 py-3 transition-colors" href="#"><span class="material-symbols-outlined">settings</span><span class="font-label-md text-label-md">Definições</span></a></div>

<div class="mt-auto pt-6"><div class="flex items-center gap-3 mb-6 px-2"><img class="w-10 h-10 rounded-full border border-outline-variant" src="https://lh3.googleusercontent.com/aida-public/AB6AXuACkNeAdgRKTgml0NZtO_4TicTmRkeipk8Rp1WuBgQKe0obDA0KJR9gf_tSu1Tkb1bzAg-Ll1ampHvnu_eTwyE3HkVu53epFGozzLkfVLIBB6qGbss5G0REPQwVSIa9E7yKk4tRpj75lA_putJeiHq0G2pXGo2oeyQWAQX5E731X_LHadiEHgufsMTJDIV3d-xIHLUB5QO2GDYB-yGWMdIdH6bxdSu8EpeP1e8xP05ztxYTRJxduyKjPrNSABJArFWxYtxzgbrG7J4"><div class="flex flex-col"><span class="text-white font-bold text-sm">Rafael Neto</span><span class="text-on-primary-container text-[11px]">⭐ 4.9 (Angola)</span></div></div>

<button class="w-full font-label-md text-label-md py-3 rounded-lg font-bold hover:bg-secondary-fixed-dim transition-colors scale-98 active:scale-95 bg-[#CCFF00] text-black-pure">

                Comprar Créditos

            </button><div class="flex flex-col gap-2 mt-4 px-2"><a class="flex items-center gap-2 text-on-primary-container hover:text-secondary text-sm transition-colors" href="#"><span class="material-symbols-outlined text-[18px]">help_outline</span> Ajuda</a><a class="flex items-center gap-2 text-on-primary-container hover:text-secondary text-sm transition-colors" href="#"><span class="material-symbols-outlined text-[18px]">logout</span> Sair</a></div>

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

<img alt="User Avatar" class="w-full h-full object-cover" data-alt="Close up portrait of a young professional African man with a neat beard, looking directly at camera with a confident smile. Studio lighting, clean white background, high contrast, sharp focus. Modern professional aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuACkNeAdgRKTgml0NZtO_4TicTmRkeipk8Rp1WuBgQKe0obDA0KJR9gf_tSu1Tkb1bzAg-Ll1ampHvnu_eTwyE3HkVu53epFGozzLkfVLIBB6qGbss5G0REPQwVSIa9E7yKk4tRpj75lA_putJeiHq0G2pXGo2oeyQWAQX5E731X_LHadiEHgufsMTJDIV3d-xIHLUB5QO2GDYB-yGWMdIdH6bxdSu8EpeP1e8xP05ztxYTRJxduyKjPrNSABJArFWxYtxzgbrG7J4">

</div>

</div>

</header>

<!-- Dashboard Content -->

<div class="flex-1 p-container-padding-mobile md:p-container-padding-desktop flex flex-col gap-8 pb-20">

<!-- Page Header -->

<div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6">

<div>

<h2 class="font-headline-md text-headline-md text-black-pure mb-2">Bom dia, Pascoal 👋</h2>

<p class="font-body-lg text-body-lg text-black-pure opacity-80">Aqui está o resumo da sua atividade</p>

</div>

<button class="bg-black-pure text-white px-6 py-3 rounded-full font-label-md text-label-md font-bold flex items-center gap-2 hover:bg-surface-container-highest transition-colors">

                    Explorar Trabalhos <span class="material-symbols-outlined text-[20px]">arrow_forward</span>

</button>

</div>

<!-- KPI Row -->

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">

    <!-- Card 1: Trabalhos ativos -->

    <div class="glass-card p-8 hard-shadow flex flex-col gap-4 min-h-[160px]">

        <div class="w-10 h-10 bg-black-pure rounded-lg flex items-center justify-center shrink-0">

            <span class="material-symbols-outlined text-[#CCFF00]">work</span>

        </div>

        <div class="flex flex-col gap-1">

            <span class="font-label-sm text-label-sm text-on-tertiary-container uppercase tracking-wider">Trabalhos Ativos</span>

            <span class="font-display-lg text-headline-md font-bold text-black-pure leading-none truncate">2</span>

        </div>

    </div>

    <!-- Card 2: Propostas enviadas -->

    <div class="glass-card p-8 hard-shadow flex flex-col gap-4 min-h-[160px] relative">

        <div class="absolute top-6 right-6 shrink-0">

            <span class="bg-[#CCFF00] text-black-pure font-label-sm text-[10px] px-2 py-1 rounded-full font-bold">3 PENDENTES</span>

        </div>

        <div class="w-10 h-10 bg-black-pure rounded-lg flex items-center justify-center shrink-0">

            <span class="material-symbols-outlined text-[#CCFF00]">description</span>

        </div>

        <div class="flex flex-col gap-1">

            <span class="font-label-sm text-label-sm text-on-tertiary-container uppercase tracking-wider">Propostas Enviadas</span>

            <span class="font-display-lg text-headline-md font-bold text-black-pure leading-none truncate">5</span>

        </div>

    </div>

    <!-- Card 3: Ganhos totais -->

    <div class="glass-card p-8 hard-shadow flex flex-col gap-4 min-h-[160px]">

        <div class="w-10 h-10 bg-black-pure rounded-lg flex items-center justify-center shrink-0">

            <span class="material-symbols-outlined text-[#CCFF00]">account_balance_wallet</span>

        </div>

        <div class="flex flex-col gap-1">

            <span class="font-label-sm text-label-sm text-on-tertiary-container uppercase tracking-wider">Total Ganho</span>

            <span class="font-bold text-black-pure leading-none truncate" style="font-size: 24px;" title="KZS 120.000,00">KZS 120K</span>

        </div>

    </div>

    <!-- Card 4: Créditos totais -->

    <div class="glass-card p-8 hard-shadow flex flex-col gap-4 min-h-[160px]">

        <div class="w-10 h-10 bg-black-pure rounded-lg flex items-center justify-center shrink-0">

            <span class="material-symbols-outlined text-[#CCFF00]">toll</span>

        </div>

        <div class="flex flex-col gap-1">

            <span class="font-label-sm text-label-sm text-on-tertiary-container uppercase tracking-wider">Créditos</span>

            <span class="font-bold text-black-pure leading-none truncate" style="font-size: 24px;" title="20">20</span>

        </div>

    </div>

    <!-- Card 5: Average Rating -->

    <div class="glass-card p-8 hard-shadow flex flex-col gap-4 min-h-[160px]">

        <div class="w-10 h-10 bg-black-pure rounded-lg flex items-center justify-center shrink-0">

            <span class="material-symbols-outlined text-[#CCFF00]">star</span>

        </div>

        <div class="flex flex-col gap-1">

            <span class="font-label-sm text-label-sm text-on-tertiary-container uppercase tracking-wider">Avaliação Média</span>

            <span class="font-display-lg text-headline-md font-bold text-black-pure leading-none truncate">4.9</span>

        </div>

    </div>

  

    <!-- Card 6: Em Escrow (Cativo) -->

    <div class="glass-card p-8 hard-shadow flex flex-col gap-4 min-h-[160px]">

        <div class="w-10 h-10 bg-black-pure rounded-lg flex items-center justify-center shrink-0">

            <span class="material-symbols-outlined text-[#CCFF00]">lock</span>

        </div>

        <div class="flex flex-col gap-1">

            <span class="font-label-sm text-label-sm text-on-tertiary-container uppercase tracking-wider">Em Escrow (Cativo)</span>

            <span class="font-bold text-black-pure leading-none truncate" style="font-size: 24px;" title="KZS 25.000,00">KZS 25K</span>

        </div>

    </div>

  

    <!-- Card 7: Jobs Concluídos -->

    <div class="glass-card p-8 hard-shadow flex flex-col gap-4 min-h-[160px]">

        <div class="w-10 h-10 bg-black-pure rounded-lg flex items-center justify-center shrink-0">

            <span class="material-symbols-outlined text-[#CCFF00]">trophy</span>

        </div>

        <div class="flex flex-col gap-1">

            <span class="font-label-sm text-label-sm text-on-tertiary-container uppercase tracking-wider">Jobs Concluídos</span>

            <span class="font-bold text-black-pure leading-none truncate" style="font-size: 24px;" title="38">38</span>

        </div>

    </div>

    <!-- Card 8: Avaliação Média -->

    <div class="glass-card p-8 hard-shadow flex flex-col gap-4 min-h-[160px]">

        <div class="w-10 h-10 bg-black-pure rounded-lg flex items-center justify-center shrink-0">

            <span class="material-symbols-outlined text-[#CCFF00]">star</span>

        </div>

        <div class="flex flex-col gap-1">

            <span class="font-label-sm text-label-sm text-on-tertiary-container uppercase tracking-wider">Avaliação Média</span>

            <span class="font-bold text-black-pure leading-none truncate" style="font-size: 24px;" title="4.9">4.9</span>

        </div>

    </div>

  

</div>

<!-- Operational Section -->

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

<!-- Left Column (60%) -->

<div class="lg:col-span-7 flex flex-col gap-4">

<h3 class="font-headline-sm text-headline-sm text-black-pure px-2">Jobs Ativos</h3>

<div class="glass-card p-6 hard-shadow border-l-8 border-black-pure">

<div class="flex justify-between items-start mb-6">

<div>

<h4 class="font-headline-sm text-[20px] leading-tight text-black-pure mb-1">Redesenho UI/UX App Mobile</h4><span class="inline-block bg-[#CCFF00] text-black-pure text-[10px] font-bold px-2 py-0.5 rounded-full mt-2">Entrega em 5 dias</span>

<p class="font-body-md text-body-md text-on-tertiary-container flex items-center gap-2">

<span class="material-symbols-outlined text-[16px]">domain</span> TechAngola Solutions

                                </p>

</div>

<span class="font-headline-sm text-[20px] text-black-pure whitespace-nowrap">KZS 65.000,00</span>

</div>

<div class="mb-6">

<div class="flex justify-between font-label-sm text-label-sm mb-2 text-black-pure">

<span class="">Progresso</span>

<span class="">60%</span>

</div>

<div class="w-full bg-primary h-2 rounded-full overflow-hidden">

<div class="bg-black-pure h-full w-[60%]"></div>

</div>

</div>

<a class="inline-flex items-center gap-2 font-label-md text-label-md font-bold text-black-pure hover:opacity-70 transition-opacity" href="#">

                            Ver Sala de Trabalho <span class="material-symbols-outlined text-[18px]">arrow_forward</span>

</a>

</div>

</div>

<!-- Right Column (40%) -->

<div class="lg:col-span-5 flex flex-col gap-4">

<h3 class="font-headline-sm text-headline-sm text-black-pure px-2">Propostas</h3>

<div class="glass-card p-6 hard-shadow h-full flex flex-col">

<div class="flex-1 flex flex-col gap-4 mb-6">

<!-- Item 1 -->

<div class="flex items-center justify-between p-3 rounded-lg hover:bg-surface-container-lowest transition-colors group cursor-pointer border border-transparent hover:border-outline-variant">

<div>

<p class="font-label-md text-label-md text-black-pure font-bold"><span class="inline-block w-2 h-2 rounded-full bg-orange-500 mr-2"></span>E-commerce Fashion</p>

<p class="font-label-sm text-label-sm text-on-tertiary-container">KZS 45.000,00</p>

</div>

<span class="px-3 py-1 rounded-full text-[10px] font-bold bg-[#FFF3E0] text-[#E65100] border border-[#FFCC80]">PENDENTE</span>

</div>

<!-- Item 2 -->

<div class="flex items-center justify-between p-3 rounded-lg hover:bg-surface-container-lowest transition-colors group cursor-pointer border border-transparent hover:border-outline-variant">

<div>

<p class="font-label-md text-label-md text-black-pure font-bold"><span class="inline-block w-2 h-2 rounded-full bg-green-500 mr-2"></span>Landing Page FinTech</p>

<p class="font-label-sm text-label-sm text-on-tertiary-container">KZS 80.000,00</p>

</div>

<span class="px-3 py-1 rounded-full text-[10px] font-bold bg-[#E8F5E9] text-[#2E7D32] border border-[#A5D6A7]">ACEITE</span>

</div>

<!-- Item 3 -->

<div class="flex items-center justify-between p-3 rounded-lg hover:bg-surface-container-lowest transition-colors group cursor-pointer border border-transparent hover:border-outline-variant">

<div>

<p class="font-label-md text-label-md text-black-pure font-bold"><span class="inline-block w-2 h-2 rounded-full bg-red-500 mr-2"></span>Logo Startup</p>

<p class="font-label-sm text-label-sm text-on-tertiary-container">KZS 15.000,00</p>

</div>

<span class="px-3 py-1 rounded-full text-[10px] font-bold bg-[#FFEBEE] text-[#C62828] border border-[#EF9A9A]">RECUSADA</span>

</div>

</div>

<button class="w-full border-2 border-black-pure text-black-pure py-3 rounded-lg font-label-md text-label-md font-bold hover:bg-black-pure hover:text-white transition-colors mt-auto">

                            Ver Todas as Propostas

                        </button>

</div>

</div>

</div>

<!-- Recommendations -->

<div class="flex flex-col gap-6 mt-8">

        <h3 class="font-headline-md text-headline-md text-black-pure">Jobs Recomendados para Si <a class="float-right text-black-pure text-sm font-bold underline" href="#">Ver todos</a></h3>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

<!-- Rec Card 1 -->

    <div class="card_proposta glass-card p-6 hard-shadow flex flex-col gap-4 border border-transparent hover:border-black-pure transition-colors">

    <div class="flex justify-between items-start">

    <img class="foto_cliente_postou_vaga" src="/img/foto_perfil_exemplar.png" alt="">

        <span class="font-headline-sm text-[18px] text-black-pure">KZS 90.000,00 /h</span>

    </div>

    <div>

        <h4 class="font-headline-sm text-[20px] leading-tight text-black-pure mb-2">Desenvolvimento Frontend React</h4><p class="text-[12px] text-on-tertiary-container -mt-1 mb-2">FintechLuanda</p>

        <p class="font-body-md text-[14px] text-on-tertiary-container line-clamp-2">Precisamos de um desenvolvedor para criar um dashboard administrativo responsivo usando React e Tailwind.</p>

    </div>

    <div class="flex flex-wrap gap-2 mt-auto pt-4">

        <span class="px-3 py-1 bg-surface-container-lowest border border-outline rounded-full font-label-sm text-[11px] text-black-pure" style="background-color: #F0F0F0; border-color: #E0E0E0;">React</span>

        <span class="px-3 py-1 bg-surface-container-lowest border border-outline rounded-full font-label-sm text-[11px] text-black-pure" style="background-color: #F0F0F0; border-color: #E0E0E0;">TailwindCSS</span>

    </div>

    <button class="w-full border-2 border-black-pure text-black-pure py-2.5 mt-4 rounded-lg font-label-md text-label-md font-bold hover:bg-black-pure hover:text-white transition-colors">

                            Enviar Proposta

                        </button>

</div>

<!-- Rec Card 2 -->

    <div class="card_proposta glass-card p-6 hard-shadow flex flex-col gap-4 border border-transparent hover:border-black-pure transition-colors">

        <div class="flex justify-between items-start">

            <img class="foto_cliente_postou_vaga" src="/img/foto_perfil_exemplar.png" alt="">

            <span class="font-headline-sm text-[18px] text-black-pure">KZS 35.000,00 /h</span>

        </div>

        <div>

            <h4 class="font-headline-sm text-[20px] leading-tight text-black-pure mb-2">Design de Identidade Visual</h4><p class="text-[12px] text-on-tertiary-container -mt-1 mb-2">Agência Criativa LDA</p>

            <p class="font-body-md text-[14px] text-on-tertiary-container line-clamp-2">Criar logótipo, paleta de cores e guia de estilo básico para uma nova pastelaria em Luanda.</p>

        </div>

        <div class="flex flex-wrap gap-2 mt-auto pt-4">

            <span class="px-3 py-1 bg-surface-container-lowest border border-outline rounded-full font-label-sm text-[11px] text-black-pure" style="background-color: #F0F0F0; border-color: #E0E0E0;">Branding</span>

            <span class="px-3 py-1 bg-surface-container-lowest border border-outline rounded-full font-label-sm text-[11px] text-black-pure" style="background-color: #F0F0F0; border-color: #E0E0E0;">Illustrator</span>

        </div>

        <button class="w-full border-2 border-black-pure text-black-pure py-2.5 mt-4 rounded-lg font-label-md text-label-md font-bold hover:bg-black-pure hover:text-white transition-colors">

            Enviar Proposta

        </button>

    </div>

<!-- Rec Card 3 -->

<div class="card_proposta glass-card p-6 hard-shadow flex flex-col gap-4 border border-transparent hover:border-black-pure transition-colors">

<div class="flex justify-between items-start">

<img class="foto_cliente_postou_vaga" src="/img/foto_perfil_exemplar.png" alt="">

<span class="font-headline-sm text-[18px] text-black-pure">KZS 20.000,00 /h</span>

</div>

<div>

<h4 class="font-headline-sm text-[20px] leading-tight text-black-pure mb-2">Redação de Artigos Blog Tech</h4><p class="text-[12px] text-on-tertiary-container -mt-1 mb-2">Consulting Partners</p>

<p class="font-body-md text-[14px] text-on-tertiary-container line-clamp-2">Procuramos redator para 4 artigos mensais sobre tecnologia e inovação no mercado angolano.</p>

</div>

<div class="flex flex-wrap gap-2 mt-auto pt-4">

<span class="px-3 py-1 bg-surface-container-lowest border border-outline rounded-full font-label-sm text-[11px] text-black-pure" style="background-color: #F0F0F0; border-color: #E0E0E0;">Copywriting</span>

<span class="px-3 py-1 bg-surface-container-lowest border border-outline rounded-full font-label-sm text-[11px] text-black-pure" style="background-color: #F0F0F0; border-color: #E0E0E0;">SEO</span>

</div>

<button class="w-full border-2 border-black-pure text-black-pure py-2.5 mt-4 rounded-lg font-label-md text-label-md font-bold hover:bg-black-pure hover:text-white transition-colors">

                            Enviar Proposta

                        </button>

</div>

</div>

</div>

</div>

</main>

  
  
  
  

</body></html>
```