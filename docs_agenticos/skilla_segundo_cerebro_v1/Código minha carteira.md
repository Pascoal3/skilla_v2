

```


<!DOCTYPE html><html class="dark" lang="pt-AO"><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Skilla - A Minha Carteira</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&amp;family=Hanken+Grotesk:wght@400&amp;family=JetBrains+Mono:wght@500&amp;display=swap" rel="stylesheet">
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-container-low": "#191c1e",
                        "surface-tint": "#b4d400",
                        "surface-container": "#1d2022",
                        "on-tertiary-container": "#62646c",
                        "surface-container-high": "#272a2c",
                        "surface-container-highest": "#323537",
                        "error-container": "#93000a",
                        "on-primary-fixed-variant": "#3f4c00",
                        "on-primary-container": "#5a6b00",
                        "surface-bright": "#363a3b",
                        "outline": "#8f9378",
                        "inverse-surface": "#e0e3e5",
                        "tertiary-container": "#e0e2ec",
                        "secondary-container": "#47494e",
                        "surface-dim": "#101415",
                        "on-primary-fixed": "#181e00",
                        "tertiary": "#ffffff",
                        "on-secondary-container": "#b7b8be",
                        "surface-variant": "#323537",
                        "primary": "#ffffff",
                        "on-error": "#690005",
                        "on-background": "#e0e3e5",
                        "secondary-fixed": "#e2e2e8",
                        "outline-variant": "#454932",
                        "on-tertiary-fixed": "#191c22",
                        "primary-fixed-dim": "#b4d400",
                        "surface": "#101415",
                        "on-secondary-fixed-variant": "#45474b",
                        "on-primary": "#2b3400",
                        "surface-container-lowest": "#0b0f10",
                        "primary-container": "#cdf200",
                        "on-surface-variant": "#c5c9ac",
                        "on-error-container": "#ffdad6",
                        "inverse-on-surface": "#2d3133",
                        "on-secondary": "#2f3035",
                        "background": "#101415",
                        "on-tertiary-fixed-variant": "#44474e",
                        "on-tertiary": "#2d3038",
                        "tertiary-fixed": "#e0e2ec",
                        "on-surface": "#e0e3e5",
                        "primary-fixed": "#cdf200",
                        "on-secondary-fixed": "#1a1c20",
                        "inverse-primary": "#556500",
                        "tertiary-fixed-dim": "#c4c6d0",
                        "secondary": "#c6c6cc",
                        "secondary-fixed-dim": "#c6c6cc",
                        "error": "#ffb4ab",
                        "brand-orange": "#FF5722",
                        "brand-lime": "#D4FF00",
                        "brand-black": "#000000",
                        "brand-blue": "#0066FF"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "gutter": "24px",
                        "container-max": "1280px",
                        "unit": "8px",
                        "margin-mobile": "16px",
                        "margin-desktop": "40px"
                    },
                    "fontFamily": {
                        "display-lg": ["Sora"],
                        "label-sm": ["JetBrains Mono"],
                        "body-md": ["Hanken Grotesk"],
                        "body-lg": ["Hanken Grotesk"],
                        "headline-lg-mobile": ["Sora"],
                        "headline-md": ["Sora"],
                        "headline-lg": ["Sora"],
                        "label-md": ["JetBrains Mono"]
                    },
                    "fontSize": {
                        "display-lg": ["64px", {"lineHeight": "72px", "letterSpacing": "-0.04em", "fontWeight": "800"}],
                        "label-sm": ["12px", {"lineHeight": "16px", "fontWeight": "500"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "headline-lg-mobile": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "headline-lg": ["40px", {"lineHeight": "48px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.05em", "fontWeight": "500"}]
                    }
                }
            }
        }
    </script>
<style>
        .custom-glow {
            box-shadow: 0px 4px 20px rgba(217, 255, 0, 0.05);
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="bg-brand-lime text-on-surface font-body-md text-body-md overflow-x-hidden min-h-screen">
<!-- Mobile TopAppBar - Only visible on small screens -->
<nav class="md:hidden flex justify-between items-center w-full px-margin-mobile py-4 sticky top-0 z-50 bg-background border-b-2 border-outline-variant">
<div class="flex items-center gap-4">
<span class="text-headline-md font-headline-md tracking-tighter text-on-surface">Skilla</span>
</div>
<div class="flex items-center gap-4">
<span class="material-symbols-outlined text-secondary-container">search</span>
<span class="material-symbols-outlined text-secondary-container">notifications</span>
<img alt="User avatar" class="w-8 h-8 rounded-full border border-outline-variant" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBW051IkCVwLFK9Tx3xVu29WDoujSMURXPmh6Hy7uFVJZqYQ6KNnDaijrEEgByYpjxH6JmaDF6td5gbblRtBnKEsWtM_u7myuUdYQKUuguLh3qMwKvmXjIkU-SG-KdhbCa6NElskQOcZtpXWG_99K3W3quDymbulYEvBCv0e_AYkhYwYIPXNkntXs3Jo1u0YvbQx-Am0z37TByPGEL0HHGCtJ-Ss7jeZBho7bX6LSFEdnR2f7f7sBUsiXESe9FmoomzY1ZrqkIkGd8">
</div>
</nav>
<!-- Main Content Canvas -->
<main class="lg:ml-64 min-h-screen relative z-10 flex flex-col pb-20">
<!-- Header Section -->
<header class="w-full px-margin-mobile md:px-margin-desktop pt-8 pb-6 sticky top-0 z-30 bg-brand-lime shadow-sm">
<div class="max-w-container-max mx-auto">
<div class="flex flex-col md:flex-row gap-4 items-center justify-center relative">
<!-- Search Bar -->
<div class="relative w-full md:w-2/3 lg:w-1/2">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-brand-black">search</span>
<input class="w-full pl-12 pr-4 py-4 rounded-xl border-none bg-white text-brand-black placeholder-gray-500 font-body-lg text-body-lg focus:ring-2 focus:ring-brand-blue shadow-lg" placeholder="Pesquisar transações, faturas..." type="text">
</div>
<!-- Right Corner Info -->
<div class="hidden md:flex absolute right-0 top-1/2 -translate-y-1/2 items-center gap-4">
<button class="text-brand-black relative">
<span class="material-symbols-outlined text-[28px]">notifications</span>
<span class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full border-2 border-brand-lime"></span>
</button>
<img alt="User avatar" class="w-10 h-10 rounded-full border-2 border-brand-black" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBW051IkCVwLFK9Tx3xVu29WDoujSMURXPmh6Hy7uFVJZqYQ6KNnDaijrEEgByYpjxH6JmaDF6td5gbblRtBnKEsWtM_u7myuUdYQKUuguLh3qMwKvmXjIkU-SG-KdhbCa6NElskQOcZtpXWG_99K3W3quDymbulYEvBCv0e_AYkhYwYIPXNkntXs3Jo1u0YvbQx-Am0z37TByPGEL0HHGCtJ-Ss7jeZBho7bX6LSFEdnR2f7f7sBUsiXESe9FmoomzY1ZrqkIkGd8">
</div>
</div>
</div>
</header>
<!-- Wallet Content -->
<div class="max-w-container-max mx-auto w-full px-margin-mobile md:px-margin-desktop py-8 flex flex-col gap-10">
<!-- Title -->
<div>
<h2 class="text-display-lg font-display-lg text-brand-black mb-2">A Minha Carteira</h2>
<p class="text-body-lg text-gray-800">Gere os seus rendimentos e pagamentos de forma centralizada.</p>
</div>
<!-- Visão Geral -->
<section>
<h3 class="text-label-sm font-label-sm text-gray-600 uppercase tracking-[0.2em] mb-6 font-bold">Visão Geral</h3>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
<!-- Card 1: Saldo Disponível -->
<article class="bg-white rounded-2xl p-6 shadow-xl border border-transparent hover:border-brand-lime transition-all duration-300 group cursor-pointer relative overflow-hidden">
<div class="flex justify-between items-start mb-4">
<p class="text-label-md font-label-md text-gray-500">Saldo disponível (Kz)</p>
<span class="material-symbols-outlined text-green-600 bg-green-50 rounded-full p-1 text-[20px]">check_circle</span>
</div>
<h4 class="text-headline-lg font-headline-lg text-brand-black mb-2">125.000 Kz</h4>
<p class="text-label-sm font-label-sm text-gray-400">Valor pronto para usar.</p>
<span class="material-symbols-outlined absolute bottom-6 right-6 text-gray-300 opacity-0 group-hover:opacity-100 transition-opacity">chevron_right</span>
</article>
<!-- Card 2: Saldo Retido -->
<article class="bg-white rounded-2xl p-6 shadow-xl border-l-4 border-l-amber-500 hover:border-brand-lime transition-all duration-300 group cursor-pointer relative overflow-hidden">
<div class="flex justify-between items-start mb-4">
<p class="text-label-md font-label-md text-gray-500">Saldo retido em Escrow (Kz)</p>
<span class="bg-amber-100 text-amber-700 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider">Em escrow</span>
</div>
<h4 class="text-headline-lg font-headline-lg text-brand-black mb-2">80.000 Kz</h4>
<p class="text-label-sm font-label-sm text-gray-400">Valores reservados em pagamentos em andamento.</p>
<span class="material-symbols-outlined absolute bottom-6 right-6 text-gray-300 opacity-0 group-hover:opacity-100 transition-opacity">chevron_right</span>
</article>
<!-- Card 3: A Receber -->
<article class="bg-blue-50/50 rounded-2xl p-6 shadow-xl border border-blue-100 hover:border-brand-lime transition-all duration-300 group cursor-pointer relative overflow-hidden">
<div class="flex justify-between items-start mb-4">
<p class="text-label-md font-label-md text-blue-600">A receber (escrow retido)</p>
<span class="material-symbols-outlined text-blue-500 text-[20px]">schedule</span>
</div>
<h4 class="text-headline-lg font-headline-lg text-brand-black mb-2">45.000 Kz</h4>
<p class="text-label-sm font-label-sm text-blue-400/80">Recebíveis quando o escrow for liberado.</p>
<span class="material-symbols-outlined absolute bottom-6 right-6 text-blue-200 opacity-0 group-hover:opacity-100 transition-opacity">chevron_right</span>
</article>
</div>
</section>
<!-- Ações & Dados Bancários -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
<!-- Ações -->
<section>
<h3 class="text-label-sm font-label-sm text-gray-600 uppercase tracking-[0.2em] mb-6 font-bold">Ações</h3>
<div class="bg-white rounded-2xl p-6 shadow-xl flex flex-col gap-4">
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
<button class="flex items-center justify-center gap-2 bg-brand-blue text-white py-4 px-6 rounded-xl font-bold hover:bg-blue-700 transition-colors shadow-md">
<span class="material-symbols-outlined">add</span>
                            Carregar saldo
                        </button>
<button class="flex items-center justify-center gap-2 border-2 border-brand-blue text-brand-blue py-4 px-6 rounded-xl font-bold hover:bg-blue-50 transition-colors">
<span class="material-symbols-outlined">list_alt</span>
                            Ver extrato
                        </button>
</div>
<button class="flex items-center justify-center gap-2 border-2 border-brand-black bg-white text-brand-black py-4 px-6 rounded-xl font-bold hover:bg-brand-black hover:text-white transition-all shadow-sm">
<span class="material-symbols-outlined">logout</span>
                        Pedir saque
                    </button>
</div>
</section>
<!-- Dados Bancários -->
<section>
<h3 class="text-label-sm font-label-sm text-gray-600 uppercase tracking-[0.2em] mb-6 font-bold">Dados Bancários</h3>
<div class="bg-white rounded-2xl p-6 shadow-xl">
<div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
<div class="flex justify-between items-center mb-3">
<span class="text-label-sm font-label-sm text-gray-400 uppercase font-bold">IBAN Skilla</span>
<button class="text-brand-blue text-label-md font-label-md flex items-center gap-1 hover:underline">
<span class="material-symbols-outlined text-[18px]">content_copy</span>
                                Copiar
                            </button>
</div>
<p class="text-body-lg font-label-md text-brand-black font-mono break-all tracking-wider">AO06 1234 5678 9012 3456 7890 1</p>
</div>
<p class="text-label-sm font-label-sm text-gray-500 mt-4 flex items-center gap-2">
<span class="material-symbols-outlined text-[16px]">info</span>
                        Use este IBAN para transferências para a sua carteira.
                    </p>
</div>
</section>
</div>
<!-- Créditos -->
<section class="border-t border-brand-black/10 pt-10">
<h3 class="text-label-sm font-label-sm text-gray-600 uppercase tracking-[0.2em] mb-6 font-bold">Créditos</h3>
<div class="bg-white rounded-2xl p-6 shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
<div class="flex items-center gap-6">
<div class="bg-brand-black text-brand-lime w-16 h-16 rounded-2xl flex items-center justify-center">
<span class="text-headline-lg font-headline-lg">12</span>
</div>
<div>
<h4 class="text-headline-md font-headline-md text-brand-black">Créditos disponíveis</h4>
<p class="text-body-md text-gray-500">Use créditos para candidaturas e destaques.</p>
</div>
</div>
<div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
<button class="px-8 py-3 rounded-xl border-2 border-brand-blue text-brand-blue font-bold hover:bg-blue-50 transition-colors">Comprar créditos</button>
<button class="px-8 py-3 rounded-xl text-gray-500 font-bold hover:bg-gray-100 transition-colors">Extrato de créditos</button>
</div>
</div>
</section>
</div>
</main>
<!-- BottomNavBar - Only visible on small screens -->
<nav class="md:hidden w-full bg-surface-container py-2 px-4 flex justify-around items-center fixed bottom-0 left-0 z-50 border-t border-outline-variant shadow-[0_-4px_20px_rgba(0,0,0,0.5)]">
<a class="flex flex-col items-center p-2 text-on-surface-variant hover:text-on-surface" href="#">
<span class="material-symbols-outlined mb-1">home</span>
<span class="text-label-sm font-label-sm">Início</span>
</a>
<a class="flex flex-col items-center p-2 text-on-surface-variant hover:text-on-surface" href="#">
<span class="material-symbols-outlined mb-1">work</span>
<span class="text-label-sm font-label-sm">Jobs</span>
</a>
<a class="flex flex-col items-center p-2 text-brand-lime" href="#">
<span class="material-symbols-outlined mb-1" style="font-variation-settings: 'FILL' 1;">account_balance_wallet</span>
<span class="text-label-sm font-label-sm font-bold">Carteira</span>
</a>
<a class="flex flex-col items-center p-2 text-on-surface-variant hover:text-on-surface relative" href="#">
<span class="material-symbols-outlined mb-1">chat</span>
<span class="text-label-sm font-label-sm">Msg</span>
<span class="absolute top-1 right-2 w-2 h-2 bg-error rounded-full"></span>
</a>
</nav>
</body></html>
```

