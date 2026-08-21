<!DOCTYPE html>

<html class="dark" lang="pt-AO">

<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>SKILLA | A Maior Rede de Freelancers de Angola</title>
<link rel="icon" type="image/x-icon" href="/favicon.svg">
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;900;family=Inter:wght@300;400;500;600;700;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1;display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<style>
    /* Seus estilos originais */
    .sr-only {
      position: absolute; width: 1px; height: 1px;
      padding: 0; margin: -1px; overflow: hidden;
      clip: rect(0,0,0,0); white-space: nowrap; border-width: 0;
    }
    .text-balance {
      text-wrap: balance;
    }
    .marquee {
        overflow: hidden;
        display: flex;
    }
    .marquee-content {
        display: flex;
        width: max-content;
        gap: 3rem;
        will-change: transform;
        animation: marquee 20s linear infinite;
    }
    .texto_black {
        color: #121414;
    }
    @keyframes marquee {
        from { transform: translateX(0); }
        to { transform: translateX(-50%); }
    }

    /* Novos estilos do Stitch (Material Symbols) */
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
</style>

<!-- 2. SCRIPT TAILWIND UNIFICADO -->
<script id="tailwind-config">
    tailwind.config = {
        darkMode: "class", // Mantido para compatibilidade
        theme: {
          extend: {
            /* --- CORES ORIGINAIS DO SITE (Mantidas) --- */
            "colors": {
                "tertiary-fixed-dim": "#c9c6c5",
                "tertiary": "#c9c6c5",
                "surface-dim": "#121414",
                "on-primary-fixed": "#00174b",
                "surface-container": "#1e2020",
                "on-surface-variant": "#c3c6d7",
                "surface": "#121414",
                "secondary-container": "#c7f000",
                "primary-container": "#2563eb",
                "on-secondary": "#2a3400",
                "on-tertiary": "#313030",
                "on-error": "#690005",
                "secondary": "#fbffe0",
                "on-primary-fixed-variant": "#003ea8",
                "secondary-fixed-dim": "#b0d500",
                "primary-fixed": "#dbe1ff",
                "error-container": "#93000a",
                "on-primary-container": "#eeefff",
                "on-background": "#e2e2e2",
                "primary-fixed-dim": "#b4c5ff",
                "tertiary-fixed": "#e5e2e1",
                "secondary-fixed": "#c9f308",
                "surface-container-low": "#1a1c1c",
                "on-secondary-container": "#576a00",
                "on-secondary-fixed-variant": "#3e4c00",
                "on-surface": "#e2e2e2",
                "primary": "#b4c5ff",
                "surface-container-highest": "#333535",
                "outline-variant": "#434655",
                "tertiary-container": "#6e6d6d",
                "on-tertiary-fixed": "#1c1b1b",
                "surface-tint": "#b4c5ff",
                "background": "#121414",
                "surface-container-lowest": "#0c0f0f",
                "inverse-surface": "#e2e2e2",
                "on-secondary-fixed": "#171e00",
                "surface-variant": "#333535",
                "inverse-primary": "#0053db",
                "on-primary": "#002a78",
                "outline": "#8d90a0",
                "on-error-container": "#ffdad6",
                "inverse-on-surface": "#2f3131",
                "on-tertiary-container": "#f3f0ef",
                "surface-container-high": "#282a2b",
                "surface-bright": "#38393a",
                "error": "#ffb4ab",
                "on-tertiary-fixed-variant": "#474646",
                
                /* --- NOVAS CORES PARA PRICING (Estilo Stitch/Clean) --- */
                /* Estas cores criam o tema claro apenas para esta seção */
                "pricing-bg": "#f9f9ff",          /* Fundo geral da seção (opcional, se quiser destacar) */
                "pricing-card": "#ffffff",        /* Fundo branco dos cards */
                "pricing-text-main": "#151c27",   /* Texto escuro principal */
                "pricing-text-muted": "#4c4546",  /* Texto secundário */
                "pricing-btn": "#000000",         /* Botão preto (estilo Stitch) */
                "pricing-btn-text": "#ffffff",    /* Texto do botão */
                "pricing-accent": "#4F46E5",      /* Cor de destaque (Badge Popular) */
                "pricing-border": "#e2e8f8",      /* Bordas suaves */
            },
            
            "borderRadius": {
                "DEFAULT": "1rem",
                "lg": "2rem",
                "xl": "3rem",
                "2xl": "1.5rem", /* Adicionado do Stitch */
                "full": "9999px"
            },
            "spacing": {
                "section-gap": "120px",
                "margin-desktop": "64px",
                "unit": "8px",
                "margin-mobile": "20px",
                "gutter": "24px"
            },
            "fontFamily": {
                "headline-md": ["Space Grotesk"],
                "display-lg": ["Space Grotesk"],
                "display-xl": ["Space Grotesk"],
                "body-md": ["Inter"],
                "label-caps": ["Space Grotesk"],
                "body-lg": ["Inter"],
                "sans": ["Inter", "sans-serif"] /* Adicionado para garantir Inter nos cards */
            },
            "fontSize": {
                "headline-md": ["48px", {"lineHeight": "120%", "fontWeight": "600"}],
                "display-lg": ["64px", {"lineHeight": "110%", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                "display-xl": ["96px", {"lineHeight": "100%", "letterSpacing": "-0.04em", "fontWeight": "700"}],
                "body-md": ["16px", {"lineHeight": "160%", "fontWeight": "400"}],
                "label-caps": ["14px", {"lineHeight": "100%", "fontWeight": "700"}],
                "body-lg": ["20px", {"lineHeight": "160%", "fontWeight": "400"}],
                /* Fontes auxiliares para o Pricing */
                "pricing-title": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                "pricing-price": ["32px", {"lineHeight": "40px", "fontWeight": "700"}],
            },
            /* --- SOMBRAS DO STITCH (Adicionadas) --- */
            "boxShadow": {
                'ambient': '0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02)',
                'ambient-hover': '0 25px 30px -5px rgba(0, 0, 0, 0.08), 0 15px 15px -5px rgba(0, 0, 0, 0.04)',
                'ambient-highlight': '0 30px 40px -10px rgba(0, 0, 0, 0.1), 0 20px 20px -10px rgba(0, 0, 0, 0.05)',
                'btn-ambient': '0 10px 15px -3px rgba(0, 0, 0, 0.2), 0 4px 6px -2px rgba(0, 0, 0, 0.1)',
                'btn-ambient-hover': '0 15px 20px -3px rgba(0, 0, 0, 0.3), 0 8px 10px -2px rgba(0, 0, 0, 0.15)'
            }
          },
        },
    }
</script>
<script src="{{ asset('js/inicio.js') }}"></script>

</head>
<body class="bg-surface font-body-md text-on-surface custom-scrollbar">
<!-- Header -->
<header class="bg-white dark:bg-slate-950 fixed top-0 w-full z-50 border-b-2 border-slate-900 dark:border-slate-800">
<nav id="nav_logo" class="flex justify-between items-center px-6 py-4 max-w-full mx-auto">
<div class="text-2xl font-black text-slate-900 dark:text-white uppercase font-headline-md tracking-tight"><img id="logo_plataforma" src="{{ asset('img/logo_skilla8-removebg-preview.png') }}" alt=""></div>
<div class="hidden md:flex items-center gap-8 font-label-caps uppercase text-sm">
<a class="text-slate-700 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-300" href="#como-funciona">Como Funciona</a>
<a class="text-slate-700 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-300" href="#freelancers">Freelancers</a>
<a class="text-slate-700 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-300" href="#areas">Categorias</a>
<a class="text-slate-700 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-300" href="#precos">Preços</a>
<a class="text-slate-700 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-300" href="#faq">FAQ</a>
</div>
<div class="flex items-center gap-4">
<a href="{{ route('login') }}"
   class="hidden md:block px-6 py-2 border-2 border-blue-600 text-blue-600 rounded-full">
    Entrar
</a>
<a href="{{ route('pagina_escolher_funcao') }}"
   class="px-6 py-2 bg-blue-600 text-white font-bold rounded-full hover:bg-blue-700 transition-all active:scale-95 flex items-center gap-2 w-fit">
    Começar Grátis 
    <i class="fa-solid fa-arrow-right"></i>
</a>
</div>
</nav>
</header>
<!-- Hero Section -->
<section class="pt-32 pb-20 bg-secondary-container text-on-secondary px-6 md:px-margin-desktop overflow-hidden relative" id="hero">
<div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
<div class="lg:col-span-7 z-10">
<h1 class="font-display-xl text-display-xl uppercase mb-8 leading-none">
                    POTENCIALIZE <span class="block">O SEU NEGÓCIO</span> <span class="text-primary-container italic">COM TALENTO</span> ANGOLANO.
                </h1>
<p class="font-body-lg text-body-lg mb-12 max-w-2xl text-on-secondary-container">
                    A plataforma líder em Angola para conectar empresas aos melhores freelancers do mercado digital. Qualidade, rapidez e pagamentos seguros.
                </p>
<div class="flex flex-col sm:flex-row gap-4">
<a href="{{ route('registar.cliente') }}" class="px-8 py-4 bg-primary-container text-white rounded-full font-bold text-lg flex items-center justify-center gap-3 hover:shadow-xl transition-all">
                        Contratar Freelancer  <i class="fa-solid fa-arrow-up-right-from-square"></i>
</a>
<a href="{{ route('registar.freela') }}" class="px-8 py-4 border-2 border-primary-container text-primary-container rounded-full font-bold text-lg flex items-center justify-center hover:bg-primary-container/10 transition-all">
                        Trabalhar como Freelancer
                    </a>
</div>
<div class="mt-16 flex flex-wrap gap-6">
<div class="bg-white/80 backdrop-blur p-4 rounded-xl border border-black/10 flex items-center gap-4 shadow-sm">
<div class="bg-secondary-fixed p-3 rounded-full">
<i id="icone_grupo" class="fa-solid fa-people-group"></i>
</div>
<div>
<div class="font-bold text-xl">+500</div>
<div class="text-sm uppercase font-bold opacity-60">Freelancers</div>
</div>
</div>
<div class="bg-white/80 backdrop-blur p-4 rounded-xl border border-black/10 flex items-center gap-4 shadow-sm">
<div class="bg-primary-fixed p-3 rounded-full">
<i id="icone_pastinha_trabalho" class="fa-duotone fa-solid fa-briefcase"></i>
</div>
<div>
<div class="font-bold text-xl">+1.200</div>
<div class="text-sm uppercase font-bold opacity-60">Trabalhos Concluídos</div>
</div>
</div>
</div>
</div>
<div class="lg:col-span-5 relative">
<div class="aspect-[4/5] rounded-3xl overflow-hidden border-4 border-slate-900 shadow-[20px_20px_0px_0px_rgba(37,99,235,1)]">
<img alt="Hero Talento Angolano" class="w-full h-full object-cover" src="{{asset('img/personagem_hero_section.png') }}" alt="">
</div>
<div class="absolute -bottom-6 -left-6 bg-slate-900 text-white p-6 rounded-2xl max-w-[200px] hidden md:block">
<p class="font-bold text-sm leading-tight italic">"Encontrei o meu designer em 24h. Incrível!"</p>
<div class="mt-2 text-xs opacity-60">— Ayla Jorge, CEO</div>
</div>
</div>
</div>
</section>
<!-- Marquee Ticker -->
<div class="bg-slate-950 py-6 border-y-2 border-slate-800 overflow-hidden">
<div class="marquee">
<div class="marquee-content">
<span class="text-secondary-fixed font-display-lg text-4xl uppercase tracking-tighter">Design Gráfico</span>
<span class="text-white/20 text-4xl">★</span>
<span class="text-secondary-fixed font-display-lg text-4xl uppercase tracking-tighter">Desenvolvimento Web</span>
<span class="text-white/20 text-4xl">★</span>
<span class="text-secondary-fixed font-display-lg text-4xl uppercase tracking-tighter">Social Media</span>
<span class="text-white/20 text-4xl">★</span>
<span class="text-secondary-fixed font-display-lg text-4xl uppercase tracking-tighter">Copywriting</span>
<span class="text-white/20 text-4xl">★</span>
<span class="text-secondary-fixed font-display-lg text-4xl uppercase tracking-tighter">Marketing Digital</span>
<span class="text-white/20 text-4xl">★</span>
<!-- Duplicate for seamless scroll -->
<span class="text-secondary-fixed font-display-lg text-4xl uppercase tracking-tighter">Design Gráfico</span>
<span class="text-white/20 text-4xl">★</span>
<span class="text-secondary-fixed font-display-lg text-4xl uppercase tracking-tighter">Desenvolvimento Web</span>
<span class="text-white/20 text-4xl">★</span>
<span class="text-secondary-fixed font-display-lg text-4xl uppercase tracking-tighter">Social Media</span>
<span class="text-white/20 text-4xl">★</span>
<span class="text-secondary-fixed font-display-lg text-4xl uppercase tracking-tighter">Copywriting</span>
<span class="text-white/20 text-4xl">★</span>
<span class="text-secondary-fixed font-display-lg text-4xl uppercase tracking-tighter">Marketing Digital</span>
<span class="text-white/20 text-4xl">★</span>
</div>
</div>
</div>
<!-- Categorias Section -->
<section class="py-section-gap bg-slate-900 px-6 md:px-margin-desktop" id="areas">
<div class="max-w-7xl mx-auto">
<div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
<div class="max-w-2xl">
<h2 class="font-display-lg text-display-lg uppercase text-white leading-none mb-6">Explore por <span class="text-secondary-fixed">Categorias</span></h2>
<p class="text-slate-400 text-body-lg">Dos projetos mais simples aos mais complexos, temos o especialista certo para si.</p>
</div>
<button class="text-white font-bold uppercase tracking-widest flex items-center gap-2 hover:text-secondary-fixed transition-all border-b-2 border-secondary-fixed pb-2">
                    Ver Tudo <i class="fa-solid fa-arrow-right material-symbols-outlined"></i>
</button>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
<!-- Bento Card 1 -->
<div class="group bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-secondary-fixed transition-all cursor-pointer relative overflow-hidden">
<div class="text-4xl mb-6">🎨</div>
<h3 class="text-2xl font-bold text-white mb-2">Design Gráfico</h3>
<p class="text-slate-400">Logos, branding e artes para redes sociais.</p>
<div class="mt-6 font-bold text-secondary-fixed">142 trabalhos ativos</div>
<i class="fa-solid fa-arrow-up-right-from-square absolute top-6 right-6 text-slate-600 group-hover:text-secondary-fixed group-hover:translate-x-1 group-hover:-translate-y-1 transition-all"></i>


</div>
<!-- Bento Card 2 -->
<div class="group bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-secondary-fixed transition-all cursor-pointer relative overflow-hidden">
<div class="text-4xl mb-6">💻</div>
<h3 class="text-2xl font-bold text-white mb-2">Web Dev</h3>
<p class="text-slate-400">Landing pages, e-commerce e sites corporativos.</p>
<div class="mt-6 font-bold text-secondary-fixed">89 trabalhos ativos</div>
<i class="fa-solid fa-arrow-up-right-from-square material-symbols-outlined absolute top-6 right-6 text-slate-600 group-hover:text-secondary-fixed transition-all"></i>
</div>
<!-- Bento Card 3 -->
<div class="group bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-secondary-fixed transition-all cursor-pointer relative overflow-hidden">
<div class="text-4xl mb-6">📱</div>
<h3 class="text-2xl font-bold text-white mb-2">Mobile Apps</h3>
<p class="text-slate-400">Apps nativos para iOS e Android em Luanda.</p>
<div class="mt-6 font-bold text-secondary-fixed">34 trabalhos ativos</div>
<i class="fa-solid fa-arrow-up-right-from-square material-symbols-outlined absolute top-6 right-6 text-slate-600 group-hover:text-secondary-fixed transition-all"></i>
</div>
<!-- Bento Card 4 -->
<div class="group bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-secondary-fixed transition-all cursor-pointer relative overflow-hidden">
<div class="text-4xl mb-6">📈</div>
<h3 class="text-2xl font-bold text-white mb-2">MKT Digital</h3>
<p class="text-slate-400">Gestão de tráfego pago e estratégia de vendas.</p>
<div class="mt-6 font-bold text-secondary-fixed">212 trabalhos ativos</div>
<i class="fa-solid fa-arrow-up-right-from-square material-symbols-outlined absolute top-6 right-6 text-slate-600 group-hover:text-secondary-fixed transition-all"></i>
</div>
<!-- Bento Card 5 -->
<div class="group bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-secondary-fixed transition-all cursor-pointer relative overflow-hidden">
<div class="text-4xl mb-6">✍️</div>
<h3 class="text-2xl font-bold text-white mb-2">Copywriting</h3>
<p class="text-slate-400">Textos persuasivos que vendem em Kwanza.</p>
<div class="mt-6 font-bold text-secondary-fixed">56 trabalhos ativos</div>
<i class="fa-solid fa-arrow-up-right-from-square material-symbols-outlined absolute top-6 right-6 text-slate-600 group-hover:text-secondary-fixed transition-all"></i>
</div>
<!-- Bento Card 6 -->
<div class="group bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-secondary-fixed transition-all cursor-pointer relative overflow-hidden">
<div class="text-4xl mb-6">🎥</div>
<h3 class="text-2xl font-bold text-white mb-2">Edição Vídeo</h3>
<p class="text-slate-400">Reels, YouTube e vídeos institucionais.</p>
<div class="mt-6 font-bold text-secondary-fixed">77 trabalhos ativos</div>
<i class="fa-solid fa-arrow-up-right-from-square material-symbols-outlined absolute top-6 right-6 text-slate-600 group-hover:text-secondary-fixed transition-all"></i>
</div>
<!-- Bento Card 7 -->
<div class="group bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-secondary-fixed transition-all cursor-pointer relative overflow-hidden">
<div class="text-4xl mb-6">🎧</div>
<h3 class="text-2xl font-bold text-white mb-2">Áudio & Música</h3>
<p class="text-slate-400">Produção de jingles e spots publicitários.</p>
<div class="mt-6 font-bold text-secondary-fixed">28 trabalhos ativos</div>
<i class="fa-solid fa-arrow-up-right-from-square material-symbols-outlined absolute top-6 right-6 text-slate-600 group-hover:text-secondary-fixed transition-all"></i>
</div>
<!-- Bento Card 8 -->
<div class="group bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-secondary-fixed transition-all cursor-pointer relative overflow-hidden">
<div class="text-4xl mb-6"><i class="fa-solid fa-screwdriver-wrench"></i></div>
<h3 class="text-2xl font-bold text-white mb-2">Suporte Técnico</h3>
<p class="text-slate-400">Análise de dados e automação de processos.</p>
<div class="mt-6 font-bold text-secondary-fixed">15 trabalhos ativos</div>
<i class="fa-solid fa-arrow-up-right-from-square material-symbols-outlined absolute top-6 right-6 text-slate-600 group-hover:text-secondary-fixed transition-all"></i>
</div>
</div>
</div>
</section>
<!-- Como Funciona Section -->
<section class="py-section-gap bg-secondary-container px-6 md:px-margin-desktop" id="como-funciona">
<div class="max-w-7xl mx-auto">
<h2 class="font-display-lg text-display-lg uppercase text-on-secondary text-center mb-20">Como a <span class="bg-primary-container text-white px-4">Skilla</span> Funciona</h2>
<div class="grid grid-cols-1 md:grid-cols-3 gap-12">
<div class="relative bg-slate-950 p-10 rounded-3xl group hover:-translate-y-2 transition-all">
<div class="absolute -top-6 -left-6 w-16 h-16 bg-primary-container text-white font-display-lg flex items-center justify-center rounded-full border-4 border-secondary-container">1</div>
<i class="fa-solid fa-magnifying-glass material-symbols-outlined text-secondary-fixed text-5xl mb-6"></i>
<h3 class="text-2xl font-bold text-white mb-4 uppercase">Poste um Projeto</h3>
<p class="text-slate-400">Descreva o que precisa, o prazo e o seu orçamento. Receba propostas em minutos de talentos verificados.</p>
</div>
<div class="relative bg-slate-950 p-10 rounded-3xl group hover:-translate-y-2 transition-all">
<div class="absolute -top-6 -left-6 w-16 h-16 bg-primary-container text-white font-display-lg flex items-center justify-center rounded-full border-4 border-secondary-container">2</div>
<i class="fa-sharp fa-solid fa-handshake material-symbols-outlined text-secondary-fixed text-5xl mb-6"></i>
<h3 class="text-2xl font-bold text-white mb-4 uppercase">Escolha o Expert</h3>
<p class="text-slate-400">Analise portfólios, avaliações de outros clientes e converse diretamente via chat seguro da plataforma.</p>
</div>
<div class="relative bg-slate-950 p-10 rounded-3xl group hover:-translate-y-2 transition-all">
<div class="absolute -top-6 -left-6 w-16 h-16 bg-primary-container text-white font-display-lg flex items-center justify-center rounded-full border-4 border-secondary-container">3</div>
<i class="fa-solid fa-shield-halved text-secondary-fixed text-5xl mb-6"></i>
<h3 class="text-2xl font-bold text-white mb-4 uppercase">Pague com Segurança</h3>
<p class="text-slate-400">O dinheiro fica retido na Skilla até que aprove o trabalho final. Zero riscos, total transparência.</p>
</div>
</div>
</div>
</section>



<!-- Freelancers Destaque Section -->
<section class="py-section-gap bg-slate-900 px-6 md:px-margin-desktop overflow-hidden" id="freelancers">
<div class="max-w-7xl mx-auto">
<div class="mb-16">
<h2 class="font-display-lg text-display-lg uppercase text-white leading-none">Nossos <span class="italic text-primary-container underline">Top Players</span></h2>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<!-- Freelancer 1 -->
<div class="bg-white group overflow-hidden rounded-2xl border-b-8 border-primary-container hover:border-secondary-fixed transition-all">
<div class="aspect-[1/1] overflow-hidden relative">
<img alt="Maura Fernandes" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500" src="{{asset('img/personagem2.png')}}" >
<div class="absolute top-4 left-4 bg-secondary-fixed px-3 py-1 rounded-full font-bold text-xs text-slate-900 flex items-center gap-1">
<i class="fa-solid fa-circle-check material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1;"></i> VERIFICADO
</div>
</div>
<div class="p-8 text-slate-900">
<div class="flex justify-between items-start mb-4">
<div>
<h3 class="text-2xl font-black uppercase">Maura Fernandes</h3>
<p class="text-slate-500 font-bold">Designer UI/UX</p>
        </div>
<div class="text-right">
<div class="font-black text-xl">4.9</div>
<div class="flex text-yellow-400">
        <i class="fa-solid fa-star material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;"></i>
        <i class="fa-solid fa-star material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;"></i>
        <i class="fa-solid fa-star material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;"></i>
        <i class="fa-solid fa-star material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;"></i>
        <i class="fa-solid fa-star material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;"></i></div>
</div>
</div>
<div class="flex flex-wrap gap-2 mb-6">
<span class="bg-slate-100 px-3 py-1 rounded-full text-xs font-bold">Figma</span>
<span class="bg-slate-100 px-3 py-1 rounded-full text-xs font-bold">Branding</span>
<span class="bg-slate-100 px-3 py-1 rounded-full text-xs font-bold">Webflow</span>
</div>
<button class="w-full py-4 bg-slate-900 text-white rounded-xl font-bold hover:bg-primary-container transition-all flex items-center justify-center gap-2">
                            Ver Perfil <i class="fa-solid fa-eye material-symbols-outlined"></i>
</button>
</div>
</div>

<!-- Freelancer 2 -->

<div class="bg-white group overflow-hidden rounded-2xl border-b-8 border-primary-container hover:border-secondary-fixed transition-all">
<div class="aspect-[1/1] overflow-hidden relative">
<img alt="Mauro Silva" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500" src="{{asset('img/personagem3.png')}}">
<div class="absolute top-4 left-4 bg-secondary-fixed px-3 py-1 rounded-full font-bold text-xs text-slate-900 flex items-center gap-1">
<i class="fa-solid fa-circle-check material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1;"></i> MELHOR CLASSIFICADO
                        </div>
</div>
<div class="p-8 text-slate-900">
<div class="flex justify-between items-start mb-4">
<div>
<h3 class="text-2xl font-black uppercase">Mauro Silva</h3>
<p class="text-slate-500 font-bold">Desenvolvedor Fullstack</p>
</div>
<div class="text-right">
<div class="font-black text-xl">5.0</div>
<div class="flex text-yellow-400"><i class="fa-solid fa-star material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;"></i><i class="fa-solid fa-star material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;"></i><i class="fa-solid fa-star material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;"></i><i class="fa-solid fa-star material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;"></i><i class="fa-solid fa-star material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;"></i></div>
</div>
</div>
<div class="flex flex-wrap gap-2 mb-6">
<span class="bg-slate-100 px-3 py-1 rounded-full text-xs font-bold">React</span>
<span class="bg-slate-100 px-3 py-1 rounded-full text-xs font-bold">Laravel</span>
<span class="bg-slate-100 px-3 py-1 rounded-full text-xs font-bold">Python</span>
</div>
<button class="w-full py-4 bg-slate-900 text-white rounded-xl font-bold hover:bg-primary-container transition-all flex items-center justify-center gap-2">
                            Ver Perfil <i class="fa-solid fa-eye material-symbols-outlined"></i>
</button>
</div>
</div>

<!-- Freelancer 3 -->

<div class="bg-white group overflow-hidden rounded-2xl border-b-8 border-primary-container hover:border-secondary-fixed transition-all">
<div class="aspect-[1/1] overflow-hidden relative">
<img alt="Cátia Bento" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500" src="{{asset('img/personagem4.png')}}">
<div class="absolute top-4 left-4 bg-secondary-fixed px-3 py-1 rounded-full font-bold text-xs text-slate-900 flex items-center gap-1">
<i class="fa-solid fa-circle-check material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1;"></i> VERIFICADO
                        </div>
</div>
<div class="p-8 text-slate-900">
<div class="flex justify-between items-start mb-4">
<div>
<h3 class="text-2xl font-black uppercase">Cátia Bento</h3>
<p class="text-slate-500 font-bold">Gestora de Redes</p>
</div>
<div class="text-right">
<div class="font-black text-xl">4.8</div>
<div class="flex text-yellow-400"><i class="fa-solid fa-star material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;"></i><i class="fa-solid fa-star material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;"></i><i class="fa-solid fa-star material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;"></i><i class="fa-solid fa-star material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;"></i><i class="fa-solid fa-star-half material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;"></i></div>
</div>
</div>
<div class="flex flex-wrap gap-2 mb-6">
<span class="bg-slate-100 px-3 py-1 rounded-full text-xs font-bold">Anúncios</span>
<span class="bg-slate-100 px-3 py-1 rounded-full text-xs font-bold">Criação de conteúdo</span>
<span class="bg-slate-100 px-3 py-1 rounded-full text-xs font-bold">Reels</span>
</div>
<button class="w-full py-4 bg-slate-900 text-white rounded-xl font-bold hover:bg-primary-container transition-all flex items-center justify-center gap-2">
                            Ver Perfil <i class="fa-solid fa-eye material-symbols-outlined"></i>
</button>
</div>
</div>
</div>
</div>
</section>
<!-- Prova Social Section -->
<section class="py-section-gap bg-white px-6 md:px-margin-desktop">
<div class="max-w-7xl mx-auto">
<div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
<div>
<h2 class="font-display-lg text-display-lg uppercase text-slate-900 leading-none mb-12">O Impacto da <span class="text-primary-container">Skilla</span> em Números</h2>
<div class="grid grid-cols-2 gap-8">
<div>
<div class="text-6xl font-black text-primary-container mb-2">15M+</div>
<div class="font-label-caps uppercase text-slate-500 tracking-widest">Kz Movimentados</div>
</div>
<div>
<div class="text-6xl font-black text-primary-container mb-2">98%</div>
<div class="font-label-caps uppercase text-slate-500 tracking-widest">Satisfação</div>
</div>
<div>
<div class="text-6xl font-black text-primary-container mb-2">2.5k</div>
<div class="font-label-caps uppercase text-slate-500 tracking-widest">Projetos/Mês</div>
</div>
<div>
<div class="text-6xl font-black text-primary-container mb-2">24h</div>
<div class="font-label-caps uppercase text-slate-500 tracking-widest">Média Resposta</div>
</div>
</div>
</div>
<div class="space-y-6">
<div class="bg-slate-50 p-8 rounded-2xl border-l-4 border-primary-container">
<p class="italic text-lg text-slate-700 mb-6">"Conseguimos escalar nossa agência de marketing usando apenas freelancers da Skilla. A qualidade é top e o processo é sem stress."</p>
<div class="flex items-center gap-4">
<img class="img_testemunho" src="{{ asset('img/foto_perfil_exemplar.png') }}" alt="">
<div>
<div class="texto_black font-bold text-dark">Ricardo Antunes</div>
<div class="texto_black text-sm opacity-60">Diretor, CrioLuanda</div>
</div>
</div>
</div>
<div class="bg-slate-50 p-8 rounded-2xl border-l-4 border-secondary-fixed">
<p class="italic text-lg text-slate-700 mb-6">"Como freelancer, a Skilla mudou a minha vida. Consigo clientes sérios e o pagamento cai sempre no prazo combinado."</p>
<div class="flex items-center gap-4">
<img class="img_testemunho" src="{{ asset('img/foto_perfil_exemplar.png') }}" alt="">
<div>
<div class="texto_black font-bold text-dark">Sara Gomes</div>
<div class="texto_black text-sm opacity-60">Redatora Freelancer</div>
</div>
</div>
</div>
</div>
</div>
</section>


<!-- Começo: Escrow Section -->


<section id="pricing" class="w-full max-w-7xl mx-auto px-gutter py-16 md:py-24 bg-secondary-container">

    

    <!-- Pricing Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 items-start relative">

        <!-- Card 1: Iniciante -->
        <div class="bg-pricing-card rounded-2xl p-8 shadow-ambient hover:shadow-ambient-hover transition-all duration-300 flex flex-col h-full border border-pricing-border">
            <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center mb-6 text-pricing-text-main">
                <!-- Ícone Foguete SVG -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                </svg>
            </div>
            <h3 class="text-pricing-title font-bold text-pricing-text-main mb-2">Iniciante</h3>
            <div class="flex items-baseline mb-8">
                <span class="text-pricing-price font-bold text-pricing-text-main tracking-tight">Grátis</span>
            </div>
            <a class="w-full text-center border-2 border-gray-300 text-pricing-text-main font-bold rounded-full py-3 mb-8 hover:border-pricing-btn hover:bg-gray-50 transition-colors duration-200" href="{{ route('registar.freela') }}">Registar grátis</a>
            <ul class="flex flex-col gap-4 text-body-md text-pricing-text-main flex-grow">
                <li class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-pricing-text-main mt-0.5 flex-shrink-0">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                    <span>20 Créditos ao criar conta</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-pricing-text-main mt-0.5 flex-shrink-0">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                    <span>4 Candidaturas</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-pricing-text-main mt-0.5 flex-shrink-0">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                    <span>Chat Básico</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-pricing-text-main mt-0.5 flex-shrink-0">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                    <span>Perfil Padrão</span>
                </li>
                <li class="flex items-start gap-3 text-pricing-text-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                    <span class="text-sm">Não precisa cartão de crédito</span>
                </li>
            </ul>
        </div>

        <!-- Card 2: Pro -->
        <div class="bg-pricing-card rounded-2xl p-8 shadow-ambient hover:shadow-ambient-hover transition-all duration-300 flex flex-col h-full border border-pricing-border">
            <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center mb-6 text-pricing-text-main">
                <!-- Ícone Raio SVG -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                </svg>
            </div>
            <h3 class="text-pricing-title font-bold text-pricing-text-main mb-2">Pro</h3>
            <div class="flex items-baseline mb-8">
                <span class="text-pricing-price font-bold text-pricing-text-main tracking-tight">15.000</span>
                <span class="text-body-md text-pricing-text-muted ml-2">Kz/mês</span>
            </div>
            <a class="w-full text-center bg-pricing-btn text-pricing-btn-text font-bold rounded-full py-3 mb-8 shadow-btn-ambient hover:shadow-btn-ambient-hover transform hover:-translate-y-0.5 transition-all duration-200" href="#">Assinar Agora</a>
            <ul class="flex flex-col gap-4 text-body-md text-pricing-text-main flex-grow">
                <li class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-pricing-text-main mt-0.5 flex-shrink-0">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                    <span>50 Créditos Incluídos</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-pricing-text-main mt-0.5 flex-shrink-0">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                    <span>Candidaturas Ilimitadas</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-pricing-text-main mt-0.5 flex-shrink-0">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                    <span>Selo de Verificado</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-pricing-text-main mt-0.5 flex-shrink-0">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                    <span>Suporte Prioritário</span>
                </li>
            </ul>
        </div>

        <!-- Card 3: Elite (HIGHLIGHTED) -->
        <div class="bg-pricing-card rounded-2xl p-8 shadow-ambient-highlight transform md:-translate-y-4 transition-all duration-300 flex flex-col h-full border-2 border-pricing-accent/30 relative">
            <!-- Badge -->
            <div class="absolute -top-4 right-8 bg-pricing-accent text-white font-bold text-xs px-4 py-1.5 rounded-full shadow-lg z-10 uppercase tracking-wide">
                Mais Popular
            </div>
            <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center mb-6 text-pricing-accent">
                <!-- Ícone Diamante SVG -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
            </div>
            <h3 class="text-pricing-title font-bold text-pricing-text-main mb-2">Elite</h3>
            <div class="flex items-baseline mb-8">
                <span class="text-pricing-price font-bold text-pricing-text-main tracking-tight">35.000</span>
                <span class="text-body-md text-pricing-text-muted ml-2">Kz/mês</span>
            </div>
            <a class="w-full text-center bg-pricing-btn text-pricing-btn-text font-bold rounded-full py-3 mb-8 shadow-btn-ambient hover:shadow-btn-ambient-hover transform hover:-translate-y-0.5 transition-all duration-200" href="#">Assinar Elite</a>
            <ul class="flex flex-col gap-4 text-body-md text-pricing-text-main flex-grow">
                <li class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-pricing-accent mt-0.5 flex-shrink-0">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                    <span>150 Créditos Incluídos</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-pricing-accent mt-0.5 flex-shrink-0">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                    <span>Destaque nos Resultados</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-pricing-accent mt-0.5 flex-shrink-0">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                    <span>Taxa de Saque 0%</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-pricing-accent mt-0.5 flex-shrink-0">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                    <span>Portfólio Premium</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-pricing-accent mt-0.5 flex-shrink-0">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                    <span>Manager de Conta</span>
                </li>
            </ul>
        </div>

        <!-- Card 4: Business -->
        <div class="bg-pricing-card rounded-2xl p-8 shadow-ambient hover:shadow-ambient-hover transition-all duration-300 flex flex-col h-full border border-pricing-border">
            <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center mb-6 text-pricing-text-main">
                <!-- Ícone Prédio SVG -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                </svg>
            </div>
            <h3 class="text-pricing-title font-bold text-pricing-text-main mb-2">Business</h3>
            <div class="flex items-baseline mb-8">
                <span class="text-[28px] font-bold text-pricing-text-main tracking-tight leading-tight">Sob Consulta</span>
            </div>
            <a class="w-full text-center border-2 border-gray-300 text-pricing-text-main font-bold rounded-full py-3 mb-8 hover:border-pricing-btn hover:bg-gray-50 transition-colors duration-200" href="#">Falar com Consultor</a>
            <ul class="flex flex-col gap-4 text-body-md text-pricing-text-main flex-grow">
                <li class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-pricing-text-main mt-0.5 flex-shrink-0">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                    <span>Multi-contas Equipa</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-pricing-text-main mt-0.5 flex-shrink-0">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                    <span>Faturação em Lote</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-pricing-text-main mt-0.5 flex-shrink-0">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                    <span>API de Integração</span>
                </li>
            </ul>
        </div>

    </div>
</section>





<!-- FAQ Section -->
<section class="py-section-gap bg-slate-900 px-6 md:px-margin-desktop" id="faq">
<div class="max-w-4xl mx-auto">
<h2 class="font-display-lg text-display-lg uppercase text-white mb-16 text-center">Perguntas <span class="text-secondary-fixed">Frequentes</span></h2>
<div class="space-y-4">
<div class="bg-slate-800 rounded-2xl overflow-hidden">
<button class="w-full p-6 text-left flex justify-between items-center group faq-toggle">
<span class="text-white font-bold text-lg">Como faço para receber pagamentos?</span>
<i class="fa-solid fa-chevron-down material-symbols-outlined text-slate-500 group-hover:text-white transition-all"></i>
</button>
<div class="px-6 pb-6 text-slate-400 text-sm hidden">
                        Pode receber via transferência bancária direta para qualquer banco nacional (BAI, BFA, etc.) ou através da sua carteira digital Skilla em 48h úteis após a aprovação do cliente.
                    </div>
</div>
<div class="bg-slate-800 rounded-2xl overflow-hidden">
<button class="w-full p-6 text-left flex justify-between items-center group faq-toggle">
<span class="text-white font-bold text-lg">A Skilla cobra comissão sobre os projetos?</span>
<i class="fa-solid fa-chevron-down material-symbols-outlined text-slate-500 group-hover:text-white transition-all"></i>
</button>
<div class="px-6 pb-6 text-slate-400 text-sm hidden">
                        Sim, a plataforma retém uma comissão de 10% sobre o valor de cada projeto concluído com sucesso para manter a infraestrutura e a segurança do sistema.
                    </div>
</div>
<div class="bg-slate-800 rounded-2xl overflow-hidden">
<button class="w-full p-6 text-left flex justify-between items-center group faq-toggle">
<span class="text-white font-bold text-lg">Os freelancers são realmente de Angola?</span>
<i class="fa-solid fa-chevron-down material-symbols-outlined text-slate-500 group-hover:text-white transition-all"></i>
</button>
<div class="px-6 pb-6 text-slate-400 text-sm hidden">
                        A maioria sim, mas a plataforma está aberta a talentos da CPLP. No entanto, focamos no mercado angolano para garantir facilidade de comunicação e pagamentos.
                    </div>
</div>
<div class="bg-slate-800 rounded-2xl overflow-hidden">
<button class="w-full p-6 text-left flex justify-between items-center group faq-toggle">
<span class="text-white font-bold text-lg">Como funciona o sistema Escrow?</span>
<i class="fa-solid fa-chevron-down material-symbols-outlined text-slate-500 group-hover:text-white transition-all"></i>
</button>
<div class="px-6 pb-6 text-slate-400 text-sm hidden">
                        O Escrow é a nossa garantia de segurança: quando você contrata um freelancer, o valor é retido pela Skilla. O dinheiro só é liberado para o profissional após você aprovar a entrega final do trabalho.
                    </div>
</div>
<div class="bg-slate-800 rounded-2xl overflow-hidden">
<button class="w-full p-6 text-left flex justify-between items-center group faq-toggle">
<span class="text-white font-bold text-lg">O que são os "Créditos" para freelancers?</span>
<i class="fa-solid fa-chevron-down material-symbols-outlined text-slate-500 group-hover:text-white transition-all"></i>
</button>
<div class="px-6 pb-6 text-slate-400 text-sm hidden">
                        Para garantir a qualidade das candidaturas, os freelancers utilizam créditos para enviar propostas. Isso evita spam e garante que apenas profissionais realmente interessados e qualificados se candidatem aos projetos.
                    </div>
</div>
<div class="bg-slate-800 rounded-2xl overflow-hidden">
<button class="w-full p-6 text-left flex justify-between items-center group faq-toggle">
<span class="text-white font-bold text-lg">O que acontece se houver um problema na entrega do trabalho?</span>
<i class="fa-solid fa-chevron-down material-symbols-outlined text-slate-500 group-hover:text-white transition-all"></i>
</button>
<div class="px-6 pb-6 text-slate-400 text-sm hidden">
                        Você pode abrir uma "Disputa". O pagamento fica congelado e o sistema de resolução de disputas da Skilla intervém para garantir que o trabalho seja corrigido ou que o valor seja reembolsado para a sua carteira.
                    </div>
</div>
<div class="bg-slate-800 rounded-2xl overflow-hidden">
<button class="w-full p-6 text-left flex justify-between items-center group faq-toggle">
<span class="text-white font-bold text-lg">Como posso adicionar fundos à minha carteira?</span>
<i class="fa-solid fa-chevron-down material-symbols-outlined text-slate-500 group-hover:text-white transition-all"></i>
</button>
<div class="px-6 pb-6 text-slate-400 text-sm hidden">
                        A recarga de saldo é feita de forma simples e rápida através da sua carteira virtual, simulando a integração com serviços como o Multicaixa Express.
                    </div>
</div>
<div class="bg-slate-800 rounded-2xl overflow-hidden">
<button class="w-full p-6 text-left flex justify-between items-center group faq-toggle">
<span class="text-white font-bold text-lg">Como posso saber se um freelancer é confiável?</span>
<i class="fa-solid fa-chevron-down material-symbols-outlined text-slate-500 group-hover:text-white transition-all"></i>
</button>
<div class="px-6 pb-6 text-slate-400 text-sm hidden">
                        Verifique o portfólio do profissional, a média de avaliações bilaterais deixadas por outros clientes e procure pelo selo de "Verificado", que indica profissionais validados pela plataforma.
                    </div>
</div>
<div class="bg-slate-800 rounded-2xl overflow-hidden">
<button class="w-full p-6 text-left flex justify-between items-center group faq-toggle">
<span class="text-white font-bold text-lg">Posso editar um projeto antes de publicá-lo?</span>
<i class="fa-solid fa-chevron-down material-symbols-outlined text-slate-500 group-hover:text-white transition-all"></i>
</button>
<div class="px-6 pb-6 text-slate-400 text-sm hidden">
                        Sim! Nosso sistema de criação de Jobs possui um fluxo de 5 etapas com a função de "Rascunho", permitindo que você refine o escopo e o orçamento antes de torná-lo público.
                    </div>
</div>
<div class="bg-slate-800 rounded-2xl overflow-hidden">
<button class="w-full p-6 text-left flex justify-between items-center group faq-toggle">
<span class="text-white font-bold text-lg">O que acontece com as vagas que ficam abertas por muito tempo?</span>
<i class="fa-solid fa-chevron-down material-symbols-outlined text-slate-500 group-hover:text-white transition-all"></i>
</button>
<div class="px-6 pb-6 text-slate-400 text-sm hidden">
                        Para manter a plataforma atualizada, o sistema possui automações (Cron Jobs) que cancelam automaticamente vagas inativas que ultrapassam a data de expiração definida.
                    </div>
</div>
</div>
</div>
</section>
<!-- Final CTA -->
<section class="bg-secondary-container py-24 px-6 md:px-margin-desktop">
<div class="max-w-7xl mx-auto rounded-[3rem] bg-gradient-to-br from-primary-container to-blue-800 p-12 md:p-20 text-white relative overflow-hidden">
<div class="grid grid-cols-1 lg:grid-cols-2 gap-16 relative z-10">
<div class="border-b lg:border-b-0 lg:border-r border-white/20 pb-12 lg:pb-0 lg:pr-12">
<h3 class="font-display-lg text-5xl uppercase mb-6 leading-tight">Precisa de um <span class="italic">Expert?</span></h3>
<p class="text-blue-100 text-lg mb-10">Contrate os melhores freelancers de Angola agora e tire a sua ideia do papel.</p>
<a href="{{ route('registar.cliente') }}">
    <button class="px-10 py-5 bg-white text-primary-container font-black rounded-full uppercase tracking-widest hover:bg-secondary-fixed hover:text-slate-900 transition-all flex items-center gap-3">
                            Postar Trabalho <i class="fa-solid fa-circle-plus material-symbols-outlined"></i>
    </button>
</a>
</div>
<div class="lg:pl-12">
<h3 class="font-display-lg text-5xl uppercase mb-6 leading-tight">Quer ser um <span class="italic text-secondary-fixed">Skillano?</span></h3>
<p class="text-blue-100 text-lg mb-10">Trabalhe em projetos incríveis e seja pago no prazo. Sua carreira começa aqui.</p>
<a href="{{ route('registar.freela') }}">
    <button class="px-10 py-5 bg-slate-950 text-white font-black rounded-full uppercase tracking-widest hover:bg-white hover:text-slate-950 transition-all flex items-center gap-3">
                            Criar Perfil <i class="fa-solid fa-user-plus material-symbols-outlined"></i>
    </button>
</a>
</div>
</div>
<!-- Decor circles -->
<div class="absolute -bottom-20 -right-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
<div class="absolute top-0 left-0 w-40 h-40 bg-secondary-fixed/20 rounded-full blur-3xl"></div>
</div>
</section>

<!-- Transição (horizonte) entre a secção lime e o footer escuro -->
<div class="bg-secondary-container">
  <svg
    class="w-full h-[120px] md:h-[160px] text-surface-container-lowest block"
    viewBox="0 0 1440 220"
    preserveAspectRatio="none"
    aria-hidden="true">
    <!-- Cole aqui o conteúdo do footer-horizon.svg (apenas os <path> / <g>) -->
  </svg>
</div>


<script>
  document.getElementById('footer-year').textContent = new Date().getFullYear();
</script>
<!-- Cookie Consent -->
<!-- 
<div class="fixed bottom-0 left-0 w-full bg-slate-950 border-t-2 border-primary-container p-4 md:p-6 z-[100] flex flex-col md:flex-row justify-between items-center gap-4">
<p class="text-slate-400 text-sm max-w-2xl text-center md:text-left">
            Usamos cookies para melhorar sua experiência na Skilla. Ao continuar navegando, você concorda com nossa <a class="text-blue-400 underline" href="#">Política de Privacidade</a>.
        </p>
<div class="flex gap-4">
<button class="px-6 py-2 text-slate-400 font-bold text-sm uppercase">Recusar</button>
<button class="px-8 py-2 bg-primary-container text-white font-bold rounded-full text-sm uppercase">Aceitar Tudo</button>
</div>
</div>

-->


</body>

</html>