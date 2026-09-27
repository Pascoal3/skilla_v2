


```

<!DOCTYPE html><html class="light" lang="pt-AO" style="width: 1280px; height: 1270px; overflow: hidden; position: relative;"><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&amp;family=JetBrains+Mono:wght@500&amp;family=Hanken+Grotesk:wght@400;500&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<style>
        body {
            background-color: #D4FF00; /* Vibrant Lime Green */
            color: #000000;
            -webkit-font-smoothing: antialiased;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .card-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        input:focus {
            outline: none;
            border-color: #000000 !important;
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
                        "on-surface-variant": "#444444",
                        "outline": "#E5E7EB",
                        "sidebar-bg": "#000000",
                        "sidebar-text": "#FFFFFF",
                        "sidebar-active": "#D4FF00"
                    },
                    "fontFamily": {
                        "headline-md": ["Sora"],
                        "label-md": ["JetBrains Mono"],
                        "body-md": ["Hanken Grotesk"]
                    },
                    "fontSize": {
                        "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.05em", "fontWeight": "500"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}]
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-background min-h-screen flex flex-col items-center">
<main class="w-full max-w-[480px] px-4 py-8 space-y-6 md:ml-[240px]">
<!-- Card Saldo -->
<div class="bg-white border border-black/10 rounded-xl p-6 card-shadow">
<p class="font-label-md text-label-md text-on-surface-variant uppercase mb-1">Saldo disponível</p>
<h2 class="font-headline-md text-headline-md text-black">125 000 Kz</h2>
</div>
<!-- Seção Valor -->
<div class="space-y-3">
<div class="flex justify-between items-end">
<label class="font-label-md text-label-md text-black font-bold">VALOR A SACAR</label>
<button class="font-label-md text-label-md text-black hover:underline transition-all font-bold" onclick="document.getElementById('withdraw-input').value = '125000'">Tudo</button>
</div>
<div class="relative group">
<span class="absolute left-4 top-1/2 -translate-y-1/2 font-label-md text-black/60">Kz</span>
<input class="w-full bg-white border-2 border-black rounded-lg py-4 pl-12 pr-4 font-headline-md text-headline-md text-black focus:ring-0 transition-all" id="withdraw-input" placeholder="0" type="number">
</div>
<p class="font-label-md text-label-sm text-black/70 flex items-center gap-1">
<span class="material-symbols-outlined text-[14px]" data-icon="info">info</span>
                Mínimo 5 000 Kz
            </p>
</div>
<!-- Seção IBAN -->
<div class="space-y-3">
<label class="font-label-md text-label-md text-black font-bold uppercase">IBAN CADASTRADO</label>
<div class="bg-white border border-black/10 rounded-xl p-4 flex flex-col gap-4 card-shadow">
<div class="flex items-start justify-between">
<div class="flex gap-3">
<span class="material-symbols-outlined text-black" data-icon="account_balance">account_balance</span>
<span class="font-label-md text-label-md text-black break-all font-medium">AO06 1234 5678 9012 3456 7890 1</span>
</div>
</div>
<div class="flex gap-2">
<button class="flex-1 py-2 px-4 rounded border-2 border-black font-label-md text-label-md text-black hover:bg-black/5 transition-colors font-bold">Editar</button>
<button class="flex-1 py-2 px-4 rounded border-2 border-black font-label-md text-label-md text-black hover:bg-black/5 transition-colors font-bold">Trocar</button>
</div>
</div>
</div>
<!-- Card Resumo -->
<div class="bg-white border border-black/10 rounded-xl p-5 space-y-4 card-shadow">
<div class="flex justify-between items-center border-b border-black/10 pb-3">
<span class="font-body-md text-body-md text-on-surface-variant">Valor a sacar</span>
<span class="font-label-md text-label-md text-black font-bold">0 Kz</span>
</div>
<div class="flex justify-between items-center border-b border-black/10 pb-3">
<span class="font-body-md text-body-md text-on-surface-variant">Taxa de serviço</span>
<span class="font-label-md text-label-md text-black font-bold">Grátis</span>
</div>
<div class="flex justify-between items-center pt-1">
<span class="font-body-md text-body-md font-bold text-black">Total a receber</span>
<span class="font-headline-md text-headline-md text-black">0 Kz</span>
</div>
<div class="flex items-center justify-between bg-black/5 p-3 rounded-lg mt-2">
<div class="flex flex-col">
<span class="text-[10px] uppercase font-label-md text-on-surface-variant">IBAN Destino</span>
<span class="text-[12px] font-label-md text-black font-medium truncate max-w-[200px]">AO06...7890 1</span>
</div>
<button class="material-symbols-outlined text-black hover:opacity-70 transition-colors" data-icon="content_copy">content_copy</button>
</div>
</div>
<!-- Aviso -->
<div class="flex gap-3 bg-white border-2 border-black p-4 rounded-xl shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
<span class="material-symbols-outlined text-black" data-icon="warning">warning</span>
<p class="font-body-md text-[13px] leading-relaxed text-black font-medium">
                Ao confirmar, o valor será transferido para o IBAN indicado. Esta ação não pode ser desfeita.
            </p>
</div>
<!-- CTA -->
<button class="w-full bg-black text-[#D4FF00] font-headline-md text-[18px] py-4 rounded-xl font-bold shadow-xl hover:brightness-125 active:scale-[0.98] transition-all border-2 border-black">
            Confirmar saque
        </button>
<!-- Saques recentes -->
<div class="pt-8 space-y-4">
<h3 class="font-label-md text-label-md text-black font-bold uppercase">SAQUES RECENTES</h3>
<div class="space-y-2">
<!-- Item 1 -->
<div class="bg-white border border-black/10 rounded-lg p-3 flex justify-between items-center card-shadow">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-black/5 flex items-center justify-center">
<span class="material-symbols-outlined text-black" data-icon="pending">pending</span>
</div>
<div>
<p class="font-label-md text-label-md text-black font-bold">50 000 Kz</p>
<p class="font-body-md text-[12px] text-on-surface-variant">12 Mar, 2024</p>
</div>
</div>
<span class="px-2 py-1 rounded bg-black/5 text-black font-label-md text-[10px] uppercase border border-black font-bold">Pendente</span>
</div>
<!-- Item 2 -->
<div class="bg-white border border-black/10 rounded-lg p-3 flex justify-between items-center card-shadow">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-black/5 flex items-center justify-center text-black">
<span class="material-symbols-outlined" data-icon="check_circle">check_circle</span>
</div>
<div>
<p class="font-label-md text-label-md text-black font-bold">25 000 Kz</p>
<p class="font-body-md text-[12px] text-on-surface-variant">05 Mar, 2024</p>
</div>
</div>
<span class="px-2 py-1 rounded bg-black text-[#D4FF00] font-label-md text-[10px] uppercase border border-black font-bold">Concluído</span>
</div>
</div>
</div>
</main>
<!-- Side Navigation (Web Hidden Mobile) - High Contrast -->
<nav class="hidden md:flex fixed left-0 top-0 h-full w-[240px] flex-col py-8 bg-black z-40">
<div class="px-6 mb-8">
<h2 class="font-headline-sm text-2xl font-bold text-[#D4FF00]">Skilla</h2>
<p class="font-body-sm text-xs text-white/60">Freelance Marketplace</p>
</div>
<div class="flex flex-col flex-1">
<a class="text-white/80 px-6 py-3 flex items-center gap-3 hover:bg-white/10 transition-all" href="#">
<span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
<span class="font-label-md">Dashboard</span>
</a>
<a class="bg-[#D4FF00] text-black font-bold px-6 py-3 flex items-center gap-3 transition-all" href="#">
<span class="material-symbols-outlined" data-icon="account_balance_wallet">account_balance_wallet</span>
<span class="font-label-md">A Minha Carteira</span>
</a>
<a class="text-white/80 px-6 py-3 flex items-center gap-3 hover:bg-white/10 transition-all" href="#">
<span class="material-symbols-outlined" data-icon="work">work</span>
<span class="font-label-md">Os Meus Jobs</span>
</a>
<a class="text-white/80 px-6 py-3 flex items-center gap-3 hover:bg-white/10 transition-all" href="#">
<span class="material-symbols-outlined" data-icon="mail">mail</span>
<span class="font-label-md">Mensagens</span>
</a>
</div>
<div class="mt-auto px-6 py-8 border-t border-white/10">
<a class="text-white/80 py-2 flex items-center gap-3 hover:text-white transition-colors" href="#">
<span class="material-symbols-outlined" data-icon="settings">settings</span>
<span class="font-label-md">Definições</span>
</a>
<a class="text-red-400 mt-4 py-2 flex items-center gap-3 hover:text-red-300 transition-colors" href="#">
<span class="material-symbols-outlined" data-icon="logout">logout</span>
<span class="font-label-md">Terminar Sessão</span>
</a>
</div>
</nav>
<script>
        const input = document.getElementById('withdraw-input');
        input.addEventListener('input', (e) => {
            const val = e.target.value;
            const summaryDisplays = document.querySelectorAll('main .bg-white .font-label-md.text-black.font-bold, main .bg-white .font-headline-md.text-black');
            // Selectors updated to match new high-contrast classes
            const valSacar = summaryDisplays[0];
            const totalReceber = summaryDisplays[2];
            
            if (val) {
                const formatted = new Intl.NumberFormat('pt-AO').format(val).replace(',', ' ');
                if (valSacar) valSacar.textContent = `${formatted} Kz`;
                if (totalReceber) totalReceber.textContent = `${formatted} Kz`;
            } else {
                if (valSacar) valSacar.textContent = `0 Kz`;
                if (totalReceber) totalReceber.textContent = `0 Kz`;
            }
        });
    </script>
<div id="snapdom-sandbox" data-snapdom-sandbox="true" aria-hidden="true" style="position: absolute; left: -9999px; top: -9999px; width: 0px; height: 0px; overflow: hidden;"></div></body></html>
```