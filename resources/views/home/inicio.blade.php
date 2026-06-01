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
        @keyframes marquee {
            from { transform: translateX(0); }
            to { transform: translateX(-50%); }
        }
</style>

<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
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
                    "on-tertiary-fixed-variant": "#474646"
            },
            "borderRadius": {
                    "DEFAULT": "1rem",
                    "lg": "2rem",
                    "xl": "3rem",
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
                    "body-lg": ["Inter"]
            },
            "fontSize": {
                    "headline-md": ["48px", {"lineHeight": "120%", "fontWeight": "600"}],
                    "display-lg": ["64px", {"lineHeight": "110%", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "display-xl": ["96px", {"lineHeight": "100%", "letterSpacing": "-0.04em", "fontWeight": "700"}],
                    "body-md": ["16px", {"lineHeight": "160%", "fontWeight": "400"}],
                    "label-caps": ["14px", {"lineHeight": "100%", "fontWeight": "700"}],
                    "body-lg": ["20px", {"lineHeight": "160%", "fontWeight": "400"}]
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
<div class="mt-6 font-bold text-secondary-fixed">142 Jobs Ativos</div>
<i class="fa-solid fa-arrow-up-right-from-square absolute top-6 right-6 text-slate-600 group-hover:text-secondary-fixed group-hover:translate-x-1 group-hover:-translate-y-1 transition-all"></i>


</div>
<!-- Bento Card 2 -->
<div class="group bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-secondary-fixed transition-all cursor-pointer relative overflow-hidden">
<div class="text-4xl mb-6">💻</div>
<h3 class="text-2xl font-bold text-white mb-2">Web Dev</h3>
<p class="text-slate-400">Landing pages, e-commerce e sites corporativos.</p>
<div class="mt-6 font-bold text-secondary-fixed">89 Jobs Ativos</div>
<i class="fa-solid fa-arrow-up-right-from-square material-symbols-outlined absolute top-6 right-6 text-slate-600 group-hover:text-secondary-fixed transition-all"></i>
</div>
<!-- Bento Card 3 -->
<div class="group bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-secondary-fixed transition-all cursor-pointer relative overflow-hidden">
<div class="text-4xl mb-6">📱</div>
<h3 class="text-2xl font-bold text-white mb-2">Mobile Apps</h3>
<p class="text-slate-400">Apps nativos para iOS e Android em Luanda.</p>
<div class="mt-6 font-bold text-secondary-fixed">34 Jobs Ativos</div>
<i class="fa-solid fa-arrow-up-right-from-square material-symbols-outlined absolute top-6 right-6 text-slate-600 group-hover:text-secondary-fixed transition-all"></i>
</div>
<!-- Bento Card 4 -->
<div class="group bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-secondary-fixed transition-all cursor-pointer relative overflow-hidden">
<div class="text-4xl mb-6">📈</div>
<h3 class="text-2xl font-bold text-white mb-2">MKT Digital</h3>
<p class="text-slate-400">Gestão de tráfego pago e estratégia de vendas.</p>
<div class="mt-6 font-bold text-secondary-fixed">212 Jobs Ativos</div>
<i class="fa-solid fa-arrow-up-right-from-square material-symbols-outlined absolute top-6 right-6 text-slate-600 group-hover:text-secondary-fixed transition-all"></i>
</div>
<!-- Bento Card 5 -->
<div class="group bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-secondary-fixed transition-all cursor-pointer relative overflow-hidden">
<div class="text-4xl mb-6">✍️</div>
<h3 class="text-2xl font-bold text-white mb-2">Copywriting</h3>
<p class="text-slate-400">Textos persuasivos que vendem em Kwanza.</p>
<div class="mt-6 font-bold text-secondary-fixed">56 Jobs Ativos</div>
<i class="fa-solid fa-arrow-up-right-from-square material-symbols-outlined absolute top-6 right-6 text-slate-600 group-hover:text-secondary-fixed transition-all"></i>
</div>
<!-- Bento Card 6 -->
<div class="group bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-secondary-fixed transition-all cursor-pointer relative overflow-hidden">
<div class="text-4xl mb-6">🎥</div>
<h3 class="text-2xl font-bold text-white mb-2">Edição Vídeo</h3>
<p class="text-slate-400">Reels, YouTube e vídeos institucionais.</p>
<div class="mt-6 font-bold text-secondary-fixed">77 Jobs Ativos</div>
<i class="fa-solid fa-arrow-up-right-from-square material-symbols-outlined absolute top-6 right-6 text-slate-600 group-hover:text-secondary-fixed transition-all"></i>
</div>
<!-- Bento Card 7 -->
<div class="group bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-secondary-fixed transition-all cursor-pointer relative overflow-hidden">
<div class="text-4xl mb-6">🎧</div>
<h3 class="text-2xl font-bold text-white mb-2">Áudio & Música</h3>
<p class="text-slate-400">Produção de jingles e spots publicitários.</p>
<div class="mt-6 font-bold text-secondary-fixed">28 Jobs Ativos</div>
<i class="fa-solid fa-arrow-up-right-from-square material-symbols-outlined absolute top-6 right-6 text-slate-600 group-hover:text-secondary-fixed transition-all"></i>
</div>
<!-- Bento Card 8 -->
<div class="group bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-secondary-fixed transition-all cursor-pointer relative overflow-hidden">
<div class="text-4xl mb-6"><i class="fa-solid fa-screwdriver-wrench"></i></div>
<h3 class="text-2xl font-bold text-white mb-2">Suporte Técnico</h3>
<p class="text-slate-400">Análise de dados e automação de processos.</p>
<div class="mt-6 font-bold text-secondary-fixed">15 Jobs Ativos</div>
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
<div class="font-bold">Ricardo Antunes</div>
<div class="text-sm opacity-60">Diretor, CrioLuanda</div>
</div>
</div>
</div>
<div class="bg-slate-50 p-8 rounded-2xl border-l-4 border-secondary-fixed">
<p class="italic text-lg text-slate-700 mb-6">"Como freelancer, a Skilla mudou a minha vida. Consigo clientes sérios e o pagamento cai sempre no prazo combinado."</p>
<div class="flex items-center gap-4">
<img class="img_testemunho" src="{{ asset('img/foto_perfil_exemplar.png') }}" alt="">
<div>
<div class="font-bold">Sara Gomes</div>
<div class="text-sm opacity-60">Redatora Freelancer</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Segurança Section -->
<section class="py-section-gap bg-slate-950 px-6 md:px-margin-desktop relative overflow-hidden">
<div class="max-w-4xl mx-auto text-center relative z-10">
<div class="inline-flex items-center gap-2 bg-emerald-500/10 text-emerald-500 px-4 py-2 rounded-full font-bold uppercase text-xs mb-8">
<span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">shield</span> Pagamento 100% Protegido
            </div>
<h2 class="font-display-lg text-display-lg uppercase text-white mb-8">Trabalhe Sem Medo de <span class="text-emerald-500">Burla</span></h2>
<p class="text-slate-400 text-body-lg mb-16">Nosso sistema de Escrow garante que seu dinheiro esteja seguro até ao final do projeto.</p>
<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
<div class="p-6 bg-slate-900 rounded-xl border border-slate-800">
<div class="text-emerald-500 font-black text-xl mb-2">01</div>
<div class="text-white font-bold uppercase text-sm">Depósito</div>
<p class="text-xs text-slate-500 mt-2">Você faz o pagamento inicial.</p>
</div>
<div class="p-6 bg-slate-900 rounded-xl border border-slate-800">
<div class="text-emerald-500 font-black text-xl mb-2">02</div>
<div class="text-white font-bold uppercase text-sm">Retido</div>
<p class="text-xs text-slate-500 mt-2">O valor fica guardado na Skilla.</p>
</div>
<div class="p-6 bg-slate-900 rounded-xl border border-slate-800">
<div class="text-emerald-500 font-black text-xl mb-2">03</div>
<div class="text-white font-bold uppercase text-sm">Aprovado</div>
<p class="text-xs text-slate-500 mt-2">Você recebe e aprova o trabalho.</p>
</div>
<div class="p-6 bg-slate-900 rounded-xl border border-slate-800">
<div class="text-emerald-500 font-black text-xl mb-2">04</div>
<div class="text-white font-bold uppercase text-sm">Liberado</div>
<p class="text-xs text-slate-500 mt-2">O freelancer recebe o valor.</p>
</div>
</div>
</div>
<!-- Background Decor -->
<div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-emerald-500/5 blur-[120px] rounded-full -z-0"></div>
</section>
<!-- Preços Section -->
<section class="py-section-gap bg-secondary-container px-6 md:px-margin-desktop" id="precos">
<div class="max-w-7xl mx-auto">
<h2 class="font-display-lg text-display-lg uppercase text-on-secondary text-center mb-20">Escolha o seu <span class="bg-primary-container text-white px-4 italic">Plano</span></h2>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
<!-- Plan 1 -->
<div class="bg-slate-950 p-8 rounded-3xl border-2 border-slate-900 flex flex-col h-full group hover:border-primary-container transition-all">
<div class="text-secondary-fixed font-black text-sm uppercase mb-4">Iniciante</div>
<div class="text-4xl font-black text-white mb-6">Grátis</div>
<div class="text-secondary-fixed text-xs mb-6">20 Créditos dados ao criar conta</div>
<ul class="space-y-4 mb-10 flex-grow">
<li class="flex items-center gap-3 text-slate-400 text-sm"><i class="fa-solid fa-circle-check material-symbols-outlined text-primary-container text-lg"></i> 4 Candidaturas</li>
<li class="flex items-center gap-3 text-slate-400 text-sm"><i class="fa-solid fa-circle-check material-symbols-outlined text-primary-container text-lg"></i> Chat Básico</li>
<li class="flex items-center gap-3 text-slate-400 text-sm"><i class="fa-solid fa-circle-check material-symbols-outlined text-primary-container text-lg"></i> Perfil Padrão</li>
</ul>
<button class="w-full py-3 border-2 border-white text-white rounded-full font-bold hover:bg-white hover:text-slate-950 transition-all">Começar</button>
</div>
<!-- Plan 2 -->
<div class="bg-slate-950 p-8 rounded-3xl border-2 border-slate-900 flex flex-col h-full group hover:border-primary-container transition-all">
<div class="text-secondary-fixed font-black text-sm uppercase mb-4">Pro</div>
<div class="text-4xl font-black text-white mb-1">15.000 <span class="text-lg opacity-40">Kz/mês</span></div>
<div class="text-secondary-fixed text-xs mb-6">50 Créditos Incluídos</div>
<ul class="space-y-4 mb-10 flex-grow">
<li class="flex items-center gap-3 text-slate-400 text-sm"><i class="fa-solid fa-circle-check material-symbols-outlined text-primary-container text-lg"></i> Candidaturas Ilimitadas</li>
<li class="flex items-center gap-3 text-slate-400 text-sm"><i class="fa-solid fa-circle-check material-symbols-outlined text-primary-container text-lg"></i> Selo de Verificado</li>
<li class="flex items-center gap-3 text-slate-400 text-sm"><i class="fa-solid fa-circle-check material-symbols-outlined text-primary-container text-lg"></i> Suporte Prioritário</li>
</ul>
<button class="w-full py-3 border-2 border-white text-white rounded-full font-bold hover:bg-white hover:text-slate-950 transition-all">Assinar Agora</button>
</div>
<!-- Plan 3 (Featured) -->
<div class="bg-slate-950 p-8 rounded-3xl border-2 border-primary-container flex flex-col h-full relative scale-105 shadow-2xl z-10">
<div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-primary-container text-white px-4 py-1 rounded-full text-xs font-black uppercase">Mais Popular</div>
<div class="text-secondary-fixed font-black text-sm uppercase mb-4">Elite</div>
<div class="text-4xl font-black text-white mb-1">35.000 <span class="text-lg opacity-40">Kz/mês</span></div>
<div class="text-secondary-fixed text-xs mb-6">150 Créditos Incluídos</div>
<ul class="space-y-4 mb-10 flex-grow">
<li class="flex items-center gap-3 text-white text-sm"><i class="fa-solid fa-star material-symbols-outlined text-secondary-fixed text-lg"></i> Destaque nos Resultados</li>
<li class="flex items-center gap-3 text-white text-sm"><i class="fa-solid fa-star material-symbols-outlined text-secondary-fixed text-lg"></i> Taxa de Saque 0%</li>
<li class="flex items-center gap-3 text-white text-sm"><i class="fa-solid fa-star material-symbols-outlined text-secondary-fixed text-lg"></i> Portfólio Premium</li>
<li class="flex items-center gap-3 text-white text-sm"><i class="fa-solid fa-star material-symbols-outlined text-secondary-fixed text-lg"></i> Manager de Conta</li>
</ul>
<button class="w-full py-4 bg-primary-container text-white rounded-full font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-500/20">Assinar Elite</button>
</div>
<!-- Plan 4 -->
<div class="bg-slate-950 p-8 rounded-3xl border-2 border-slate-900 flex flex-col h-full group hover:border-primary-container transition-all">
<div class="text-secondary-fixed font-black text-sm uppercase mb-4">Business</div>
<div class="text-4xl font-black text-white mb-6">Sob Consulta</div>
<ul class="space-y-4 mb-10 flex-grow">
<li class="flex items-center gap-3 text-slate-400 text-sm"><i class="fa-solid fa-star material-symbols-outlined text-primary-container text-lg"></i> Multi-contas Equipa</li>
<li class="flex items-center gap-3 text-slate-400 text-sm"><i class="fa-solid fa-star material-symbols-outlined text-primary-container text-lg"></i> Faturação em Lote</li>
<li class="flex items-center gap-3 text-slate-400 text-sm"><i class="fa-solid fa-star material-symbols-outlined text-primary-container text-lg"></i> API de Integração</li>
</ul>
<button class="w-full py-3 border-2 border-white text-white rounded-full font-bold hover:bg-white hover:text-slate-950 transition-all">Falar com Consultor</button>
</div>
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
<section class="py-24 px-6 md:px-margin-desktop">
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
<!-- Footer -->
<footer class="bg-slate-950 pt-20 pb-10 border-t-2 border-slate-800 text-slate-400">
    <div class="max-w-7xl mx-auto px-6 md:px-12">
        
        <!-- Top Section: Grid de Conteúdo e Newsletter -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 mb-20">
            
            <!-- Coluna da Marca -->
            <div class="lg:col-span-4">
                <div class="text-3xl font-black text-white mb-6 font-h1 uppercase tracking-tighter">
                    SKILLA<span class="text-[#D6FF2A]">.</span>
                </div>
                <p class="text-slate-500 mb-8 max-w-xs leading-relaxed">
                    Elevando o padrão do freelancing digital em Angola. Conectamos os melhores talentos às empresas mais inovadoras.
                </p>
            </div>

            <!-- Colunas de Links -->
            <div class="lg:col-span-4 grid grid-cols-2 gap-8">
                <div>
                    <h4 class="font-label-caps uppercase text-white mb-6 tracking-widest text-xs font-bold">Plataforma</h4>
                    <ul class="space-y-4">
                        <li><a class="hover:text-[#D6FF2A] transition-all text-sm uppercase tracking-wide block group flex items-center gap-2" href="#">
                            <span class="w-0 group-hover:w-2 h-px bg-[#D6FF2A] transition-all"></span> Como Funciona
                        </a></li>
                        <li><a class="hover:text-[#D6FF2A] transition-all text-sm uppercase tracking-wide block group flex items-center gap-2" href="#">
                            <span class="w-0 group-hover:w-2 h-px bg-[#D6FF2A] transition-all"></span> Freelancers
                        </a></li>
                        <li><a class="hover:text-[#D6FF2A] transition-all text-sm uppercase tracking-wide block group flex items-center gap-2" href="#">
                            <span class="w-0 group-hover:w-2 h-px bg-[#D6FF2A] transition-all"></span> Categorias
                        </a></li>
                        <li><a class="hover:text-[#D6FF2A] transition-all text-sm uppercase tracking-wide block group flex items-center gap-2" href="#">
                            <span class="w-0 group-hover:w-2 h-px bg-[#D6FF2A] transition-all"></span> Preços
                        </a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-label-caps uppercase text-white mb-6 tracking-widest text-xs font-bold">Recursos</h4>
                    <ul class="space-y-4">
                        <li><a class="hover:text-[#D6FF2A] transition-all text-sm uppercase tracking-wide block group flex items-center gap-2" href="#">
                            <span class="w-0 group-hover:w-2 h-px bg-[#D6FF2A] transition-all"></span> Blog
                        </a></li>
                        <li><a class="hover:text-[#D6FF2A] transition-all text-sm uppercase tracking-wide block group flex items-center gap-2" href="#">
                            <span class="w-0 group-hover:w-2 h-px bg-[#D6FF2A] transition-all"></span> Suporte
                        </a></li>
                        <li><a class="hover:text-[#D6FF2A] transition-all text-sm uppercase tracking-wide block group flex items-center gap-2" href="#">
                            <span class="w-0 group-hover:w-2 h-px bg-[#D6FF2A] transition-all"></span> FAQ
                        </a></li>
                        <li><a class="hover:text-[#D6FF2A] transition-all text-sm uppercase tracking-wide block group flex items-center gap-2" href="#">
                            <span class="w-0 group-hover:w-2 h-px bg-[#D6FF2A] transition-all"></span> Comunidade
                        </a></li>
                    </ul>
                </div>
            </div>

            <!-- Newsletter Section -->
            <div class="lg:col-span-4">
                <h4 class="font-label-caps uppercase text-white mb-6 tracking-widest text-xs font-bold">Fique por dentro</h4>
                <p class="text-sm text-slate-500 mb-4">Receba as melhores oportunidades de trabalho e dicas de carreira.</p>
                <form class="flex gap-2">
                    <input type="email" placeholder="Seu melhor e-mail" 
                           class="bg-slate-900 border border-slate-800 text-white text-sm rounded-lg px-4 py-3 w-full focus:outline-none focus:border-[#D6FF2A] transition-all">
                    <button class="bg-[#D6FF2A] text-slate-950 px-4 py-3 rounded-lg font-bold text-xs uppercase hover:brightness-110 transition-all">
                        OK
                    </button>
                </form>
            </div>
        </div>

        <!-- Bottom Bar: Copyright e Legal -->
        <div class="pt-10 border-t border-slate-900 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="text-xs text-slate-600">
                © 2024 <span class="text-slate-400 font-bold">SKILLA</span>. Todos os direitos reservados.
            </div>
            <div class="flex gap-8 text-xs uppercase tracking-widest">
                <a href="#" class="hover:text-white transition-all">Termos de Uso</a>
                <a href="#" class="hover:text-white transition-all">Privacidade</a>
                <a href="#" class="hover:text-white transition-all">Segurança</a>
            </div>
            <div class="text-xs text-slate-600 italic">
                Feito com em Angola
            </div>
        </div>
    </div>
</footer>
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