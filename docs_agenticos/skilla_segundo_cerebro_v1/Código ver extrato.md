



```


<!DOCTYPE html><html class="light" lang="pt" style="width: 1280px; height: 1024px; overflow: hidden; position: relative;"><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&amp;family=Hanken+Grotesk:wght@400;500;700&amp;family=JetBrains+Mono:wght@500&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<style>
        body {
            font-family: 'Hanken Grotesk', sans-serif;
            background-color: #D4FF00;
            color: #000000;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glow-hover:hover {
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border: 1px solid #000000;
        }
    </style>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#000000",
                        "on-primary": "#D4FF00",
                        "background": "#D4FF00",
                        "surface": "#FFFFFF",
                        "on-surface": "#000000",
                        "surface-container": "#FFFFFF",
                        "surface-container-high": "#F5F5F5",
                        "surface-container-highest": "#000000",
                        "outline": "#000000",
                        "outline-variant": "#E0E0E0",
                        "primary-container": "#000000",
                        "on-primary-container": "#FFFFFF",
                        "secondary-container": "#E0E0E0",
                        "on-surface-variant": "#424242"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "container-max": "1280px",
                        "gutter": "24px",
                        "unit": "8px",
                        "margin-mobile": "16px",
                        "margin-desktop": "40px"
                    },
                    "fontFamily": {
                        "display-lg": ["Sora"],
                        "body-lg": ["Hanken Grotesk"],
                        "headline-md": ["Sora"],
                        "headline-lg-mobile": ["Sora"],
                        "label-sm": ["JetBrains Mono"],
                        "headline-lg": ["Sora"],
                        "label-md": ["JetBrains Mono"],
                        "body-md": ["Hanken Grotesk"]
                    },
                    "fontSize": {
                        "display-lg": ["64px", {"lineHeight": "72px", "letterSpacing": "-0.04em", "fontWeight": "800"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "headline-lg-mobile": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "label-sm": ["12px", {"lineHeight": "16px", "fontWeight": "500"}],
                        "headline-lg": ["40px", {"lineHeight": "48px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.05em", "fontWeight": "500"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}]
                    }
                }
            }
        }
    </script>
</head>
<body class="overflow-x-hidden bg-background">
<!-- Main Content -->
<main class="md:ml-64 pt-24 pb-20 px-4 md:px-10 min-h-screen">
<div class="max-w-container-max mx-auto">
<!-- Header Section -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
<div>
<h1 class="font-headline-lg text-headline-lg text-black mb-1">Extrato</h1>
<p class="font-body-md text-black/70">Gerencie seu fluxo de caixa em Kwanzas (Kz)</p>
</div>
<button class="flex items-center gap-2 px-6 py-2 border-2 border-black text-black rounded-xl font-label-md hover:bg-black hover:text-background transition-all active:scale-95 w-fit">
<span class="material-symbols-outlined text-[20px]" data-icon="file_download">file_download</span>
                    Exportar
                </button>
</div>
<!-- Filters Section -->
<section class="mb-10">
<div class="flex flex-wrap items-center gap-3 mb-6">
<button class="flex items-center gap-2 bg-white px-4 py-2 rounded-xl border-2 border-black hover:bg-black hover:text-white transition-all group" id="toggleFilters">
<span class="material-symbols-outlined text-black group-hover:text-background">tune</span>
<span class="font-label-md">Filtrar transações</span>
<span class="bg-black text-background text-[10px] w-5 h-5 flex items-center justify-center rounded-full font-bold">2</span>
</button>
<div class="h-6 w-px bg-black/20 mx-2 hidden md:block"></div>
<span class="px-3 py-1 bg-white text-black border-2 border-black rounded-full font-label-sm flex items-center gap-2">
                        Últimos 30 dias <span class="material-symbols-outlined text-sm cursor-pointer">close</span>
</span>
<span class="px-3 py-1 bg-white text-black border-2 border-black rounded-full font-label-sm flex items-center gap-2">
                        Tipo: Recarga, Saque <span class="material-symbols-outlined text-sm cursor-pointer">close</span>
</span>
</div>
<!-- Collapsible Content -->
<div class="hidden grid grid-cols-1 md:grid-cols-3 gap-6 p-6 bg-white rounded-2xl border-2 border-black mb-8 animate-in fade-in slide-in-from-top-4 duration-300" id="filterPanel">
<div class="space-y-3">
<label class="font-label-sm text-black/60 uppercase tracking-wider">Período</label>
<select class="w-full bg-white border-2 border-black rounded-xl p-3 text-black font-body-md focus:ring-0">
<option>Últimos 7 dias</option>
<option selected="">Últimos 30 dias</option>
<option>Último trimestre</option>
<option>Personalizado</option>
</select>
</div>
<div class="space-y-3">
<label class="font-label-sm text-black/60 uppercase tracking-wider">Tipo de Transação</label>
<div class="flex flex-wrap gap-2">
<label class="cursor-pointer">
<input checked="" class="hidden peer" type="checkbox">
<span class="px-4 py-2 rounded-lg border-2 border-black bg-white peer-checked:bg-black peer-checked:text-background font-label-sm transition-all block">Recarga</span>
</label>
<label class="cursor-pointer">
<input checked="" class="hidden peer" type="checkbox">
<span class="px-4 py-2 rounded-lg border-2 border-black bg-white peer-checked:bg-black peer-checked:text-background font-label-sm transition-all block">Saque</span>
</label>
<label class="cursor-pointer">
<input class="hidden peer" type="checkbox">
<span class="px-4 py-2 rounded-lg border-2 border-black bg-white peer-checked:bg-black peer-checked:text-background font-label-sm transition-all block">Pagamento</span>
</label>
</div>
</div>
<div class="space-y-3">
<label class="font-label-sm text-black/60 uppercase tracking-wider">Status</label>
<select class="w-full bg-white border-2 border-black rounded-xl p-3 text-black font-body-md focus:ring-0">
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
<h3 class="font-label-md text-black mb-4 px-2 uppercase tracking-[0.1em] font-bold">Hoje</h3>
<div class="space-y-3">
<!-- Transaction Card 1 -->
<div class="group cursor-pointer flex items-center justify-between p-4 bg-white border-2 border-black rounded-2xl hover:bg-black hover:border-black transition-all glow-hover" onclick="showDetails('TX4928310')">
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-xl bg-black flex items-center justify-center text-background group-hover:bg-background group-hover:text-black">
<span class="material-symbols-outlined text-[28px]">arrow_upward</span>
</div>
<div>
<p class="font-headline-md text-body-md text-black group-hover:text-white">Recarga de Saldo</p>
<p class="font-body-md text-label-sm text-black/60 group-hover:text-white/60">Depósito via Multicaixa Express • 14:20</p>
</div>
</div>
<div class="text-right">
<p class="font-headline-md text-body-md text-black font-bold group-hover:text-background">+ 50.000,00 Kz</p>
<span class="inline-flex items-center gap-1.5 font-label-sm text-[10px] text-black px-2 py-0.5 rounded-full bg-background border border-black group-hover:border-background group-hover:bg-white/10 group-hover:text-background">
<span class="w-1.5 h-1.5 rounded-full bg-black group-hover:bg-background"></span> CONCLUÍDO
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
<p class="font-headline-md text-body-md text-black group-hover:text-white">Saque Bancário</p>
<p class="font-body-md text-label-sm text-black/60 group-hover:text-white/60">Transferência para BFA • 09:45</p>
</div>
</div>
<div class="text-right">
<p class="font-headline-md text-body-md text-black font-bold group-hover:text-white">- 125.000,00 Kz</p>
<span class="inline-flex items-center gap-1.5 font-label-sm text-[10px] text-black px-2 py-0.5 rounded-full bg-background border border-black group-hover:border-background group-hover:bg-white/10 group-hover:text-background">
<span class="w-1.5 h-1.5 rounded-full bg-black group-hover:bg-background"></span> CONCLUÍDO
                                </span>
</div>
</div>
</div>
</div>
<!-- Group: Ontem -->
<div>
<h3 class="font-label-md text-black mb-4 px-2 uppercase tracking-[0.1em] font-bold">Ontem</h3>
<div class="space-y-3">
<!-- Pending Transaction -->
<div class="group cursor-pointer flex items-center justify-between p-4 bg-white/70 border-2 border-black/10 rounded-2xl hover:bg-black hover:border-black transition-all">
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-xl bg-gray-200 flex items-center justify-center text-gray-500 group-hover:bg-white/20 group-hover:text-white">
<span class="material-symbols-outlined text-[28px]">schedule</span>
</div>
<div>
<p class="font-headline-md text-body-md text-black/60 group-hover:text-white">Pagamento de Projeto</p>
<p class="font-body-md text-label-sm text-black/40 group-hover:text-white/60">UI Design Kit Pro • 18:30</p>
</div>
</div>
<div class="text-right">
<p class="font-headline-md text-body-md text-black/60 font-bold group-hover:text-white">+ 210.000,00 Kz</p>
<span class="inline-flex items-center gap-1.5 font-label-sm text-[10px] text-black/60 px-2 py-0.5 rounded-full bg-gray-100 border border-black/10 group-hover:bg-white/10 group-hover:text-white group-hover:border-white/20">
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
<p class="font-headline-md text-body-md text-black group-hover:text-white">Assinatura Mensal</p>
<p class="font-body-md text-label-sm text-black/60 group-hover:text-white/60">Plano Skilla Pro • 12:00</p>
</div>
</div>
<div class="text-right">
<p class="font-headline-md text-body-md text-black font-bold group-hover:text-white">- 5.500,00 Kz</p>
<span class="inline-flex items-center gap-1.5 font-label-sm text-[10px] text-black px-2 py-0.5 rounded-full bg-background border border-black group-hover:border-background group-hover:bg-white/10 group-hover:text-background">
<span class="w-1.5 h-1.5 rounded-full bg-black group-hover:bg-background"></span> CONCLUÍDO
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
<h2 class="font-headline-md text-headline-md text-black">Detalhes</h2>
<p class="font-label-sm text-black/60">Referência: TX123456789</p>
</div>
<button class="material-symbols-outlined text-black p-2 hover:bg-background rounded-full transition-colors" onclick="closeModal()">close</button>
</div>
<div class="space-y-6">
<div class="flex flex-col items-center py-6 border-y-2 border-black/10">
<p class="font-label-sm text-black/60 mb-1 uppercase">Valor da Transação</p>
<p class="font-display-lg text-[32px] font-black text-black">+ 50.000,00 Kz</p>
<span class="mt-2 inline-flex items-center gap-1.5 font-label-sm text-black px-3 py-1 rounded-full bg-background border-2 border-black">
<span class="w-2 h-2 rounded-full bg-black"></span> Concluído
                    </span>
</div>
<div class="grid grid-cols-1 gap-4">
<div class="flex justify-between items-center">
<span class="font-body-md text-black/60">Origem</span>
<span class="font-label-md text-black font-bold">Cartão de Débito (**** 4291)</span>
</div>
<div class="flex justify-between items-center">
<span class="font-body-md text-black/60">Destino</span>
<span class="font-label-md text-black font-bold">Conta Principal Skilla</span>
</div>
<div class="flex justify-between items-center">
<span class="font-body-md text-black/60">Data e Hora</span>
<span class="font-label-md text-black font-bold">24 Out 2023, 14:20</span>
</div>
<div class="pt-4 mt-2 border-t-2 border-black/10">
<p class="font-label-sm text-black/60 mb-2">Descrição Completa</p>
<p class="font-body-md text-black">Recarga de carteira efetuada via aplicativo Multicaixa Express. Processado via rede EMIS com sucesso.</p>
</div>
</div>
<div class="flex gap-3 pt-4">
<button class="flex-1 bg-white border-2 border-black text-black py-3 rounded-xl font-label-md hover:bg-gray-100 transition-all flex items-center justify-center gap-2">
<span class="material-symbols-outlined text-[20px]">content_copy</span>
                        ID
                    </button>
<button class="flex-1 bg-black text-background py-3 rounded-xl font-label-md hover:scale-[1.02] transition-transform active:scale-95 flex items-center justify-center gap-2">
<span class="material-symbols-outlined text-[20px]">share</span>
                        Recibo
                    </button>
</div>
</div>
</div>
</div>
<!-- BottomNavBar (Mobile) -->
<nav class="fixed bottom-0 left-0 w-full z-50 flex justify-around items-center py-3 px-4 md:hidden bg-black border-t border-white/10">
<a class="flex flex-col items-center justify-center text-white/60" href="#">
<span class="material-symbols-outlined">home</span>
<span class="font-label-sm text-label-sm">Início</span>
</a>
<a class="flex flex-col items-center justify-center bg-background text-black rounded-full px-4 py-1" href="#">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">receipt_long</span>
<span class="font-label-sm text-label-sm">Extrato</span>
</a>
<a class="flex flex-col items-center justify-center text-white/60" href="#">
<span class="material-symbols-outlined">task_alt</span>
<span class="font-label-sm text-label-sm">Tasks</span>
</a>
<a class="flex flex-col items-center justify-center text-white/60" href="#">
<span class="material-symbols-outlined">person</span>
<span class="font-label-sm text-label-sm">Perfil</span>
</a>
</nav>
<script>
        // Toggle Filter Panel
        const toggleBtn = document.getElementById('toggleFilters');
        const filterPanel = document.getElementById('filterPanel');
        
        toggleBtn.addEventListener('click', () => {
            filterPanel.classList.toggle('hidden');
        });

        // Modal Logic
        const overlay = document.getElementById('modalOverlay');
        const content = document.getElementById('modalContent');

        function showDetails(txId) {
            overlay.classList.remove('pointer-events-none', 'opacity-0');
            content.classList.remove('translate-y-8');
            content.classList.add('translate-y-0');
        }

        function closeModal() {
            overlay.classList.add('pointer-events-none', 'opacity-0');
            content.classList.add('translate-y-8');
            content.classList.remove('translate-y-0');
        }

        // Close on backdrop click
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) closeModal();
        });
    </script>
<div id="snapdom-sandbox" data-snapdom-sandbox="true" aria-hidden="true" style="position: absolute; left: -9999px; top: -9999px; width: 0px; height: 0px; overflow: hidden;"></div></body></html>
```
