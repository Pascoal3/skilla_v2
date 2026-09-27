

```

<!DOCTYPE html>

<html class="light" lang="pt"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Skilla - Comprar Créditos</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800;900&amp;family=JetBrains+Mono:wght@400;500;700&amp;family=Hanken+Grotesk:wght@300;400;500;600;700&amp;family=Sora:wght@400;600;700;800&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glow-hover:hover {
            box-shadow: 0px 4px 20px rgba(47, 91, 255, 0.15);
        }
    </style>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "brand-blue": "#2F5BFF",
                        "brand-blue-light": "#EEF2FF",
                        "surface": "#F7F8FB",
                        "on-surface": "#1A1C1E",
                        "on-surface-variant": "#5F6368",
                        "outline-variant": "#E0E2E6",
                        "badge-green-bg": "#DCFCE7",
                        "badge-green-text": "#166534"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "16px",
                        "package": "14px",
                        "btn": "12px",
                        "full": "9999px"
                    },
                    "spacing": {
                        "margin-desktop": "40px",
                        "unit": "8px",
                        "gutter": "24px",
                        "margin-mobile": "16px",
                        "container-max": "1280px"
                    },
                    "fontFamily": {
                        "label-sm": ["JetBrains Mono"],
                        "headline-lg-mobile": ["Sora"],
                        "label-md": ["JetBrains Mono"],
                        "display-lg": ["Sora"],
                        "body-md": ["Hanken Grotesk"],
                        "body-lg": ["Hanken Grotesk"],
                        "headline-lg": ["Sora"],
                        "headline-md": ["Sora"]
                    },
                    "fontSize": {
                        "label-sm": ["12px", {"lineHeight": "16px", "fontWeight": "500"}],
                        "headline-lg-mobile": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.05em", "fontWeight": "500"}],
                        "display-lg": ["64px", {"lineHeight": "72px", "letterSpacing": "-0.04em", "fontWeight": "800"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "headline-lg": ["40px", {"lineHeight": "48px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}]
                    }
                },
            },
        }
    </script>
</head>
<body class="bg-[#D4FF00] text-on-surface font-body-md min-h-screen flex flex-col items-center">
<!-- Main Content Area -->
<main class="w-full max-w-[480px] px-4 py-8 flex flex-col gap-8 flex-grow">
<!-- Wallet Balance Card -->
<section class="bg-white rounded-xl p-6 border border-outline-variant shadow-sm transition-all hover:shadow-md" id="wallet-balance">
<div class="flex items-center gap-3 mb-2">
<span class="material-symbols-outlined text-brand-blue" style="font-variation-settings: 'FILL' 1;">account_balance_wallet</span>
<p class="font-label-md text-label-md text-on-surface-variant uppercase">Saldo da carteira</p>
</div>
<p class="font-headline-lg-mobile text-headline-lg-mobile text-brand-blue">125 000 Kz</p>
</section>
<!-- Credits Selection Section -->
<section id="package-selection">
<h2 class="font-label-md text-label-md text-on-surface-variant uppercase mb-4 px-1">Escolha um pacote</h2>
<div class="grid grid-cols-1 gap-4">
<!-- Package 1 -->
<label class="relative cursor-pointer group block">
<input class="peer hidden" name="credit_package" onchange="updateSummary(10, 5000)" type="radio" value="10"/>
<div class="package-card flex items-center justify-between p-5 bg-white rounded-package border border-outline-variant peer-checked:border-brand-blue peer-checked:bg-brand-blue-light/30 transition-all group-hover:border-brand-blue/40 shadow-sm">
<div class="flex flex-col">
<span class="font-headline-md text-headline-md text-on-surface">10</span>
<span class="font-label-sm text-label-sm text-on-surface-variant uppercase">créditos</span>
</div>
<div class="text-right">
<p class="font-body-lg text-body-lg font-bold text-on-surface">5 000 Kz</p>
</div>
<div class="radio-inner w-5 h-5 rounded-full border border-outline-variant absolute top-4 right-4 flex items-center justify-center bg-white peer-checked:border-brand-blue">
<div class="w-2.5 h-2.5 rounded-full bg-transparent peer-checked:bg-brand-blue"></div>
</div>
</div>
</label>
<!-- Package 2 (Selected State) -->
<label class="relative cursor-pointer group block">
<input checked="" class="peer hidden" name="credit_package" onchange="updateSummary(30, 12000)" type="radio" value="30"/>
<div class="package-card flex items-center justify-between p-5 bg-brand-blue-light border-2 border-brand-blue rounded-package transition-all shadow-sm">
<div class="flex flex-col">
<div class="flex items-center gap-2">
<span class="font-headline-md text-headline-md text-on-surface">30</span>
<span class="bg-badge-green-bg text-badge-green-text font-label-sm text-[10px] px-2 py-0.5 rounded-full uppercase tracking-tighter font-bold">Melhor valor</span>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant uppercase">créditos</span>
</div>
<div class="text-right">
<p class="font-body-lg text-body-lg font-bold text-on-surface">12 000 Kz</p>
</div>
<div class="radio-inner w-5 h-5 rounded-full border-2 border-brand-blue absolute top-4 right-4 flex items-center justify-center bg-brand-blue">
<div class="w-2 h-2 rounded-full bg-white"></div>
</div>
</div>
</label>
<!-- Package 3 -->
<label class="relative cursor-pointer group block">
<input class="peer hidden" name="credit_package" onchange="updateSummary(100, 35000)" type="radio" value="100"/>
<div class="package-card flex items-center justify-between p-5 bg-white rounded-package border border-outline-variant peer-checked:border-brand-blue peer-checked:bg-brand-blue-light/30 transition-all group-hover:border-brand-blue/40 shadow-sm">
<div class="flex flex-col">
<span class="font-headline-md text-headline-md text-on-surface">100</span>
<span class="font-label-sm text-label-sm text-on-surface-variant uppercase">créditos</span>
</div>
<div class="text-right">
<p class="font-body-lg text-body-lg font-bold text-on-surface">35 000 Kz</p>
</div>
<div class="radio-inner w-5 h-5 rounded-full border border-outline-variant absolute top-4 right-4 flex items-center justify-center bg-white"></div>
</div>
</label>
</div>
</section>
<!-- Confirmation Section -->
<section class="pb-8" id="confirmation">
<h2 class="font-label-md text-label-md text-on-surface-variant uppercase mb-4 px-1">Confirmação</h2>
<div class="bg-white rounded-xl p-6 border border-outline-variant shadow-sm flex flex-col gap-6">
<!-- Dynamic Message -->
<div class="flex gap-3 bg-surface p-4 rounded-lg border-l-4 border-brand-blue">
<span class="material-symbols-outlined text-brand-blue text-[20px]">info</span>
<p class="font-body-md text-body-md text-on-surface-variant">
                        Vai debitar <span class="text-on-surface font-bold" id="summary-debit-msg">12 000 Kz</span> da tua carteira
                    </p>
</div>
<!-- Details Grid -->
<div class="flex flex-col gap-3">
<div class="flex justify-between items-center">
<span class="text-on-surface-variant font-body-md">Pacote</span>
<span class="text-on-surface font-semibold" id="summary-pkg">30 créditos</span>
</div>
<div class="flex justify-between items-center">
<span class="text-on-surface-variant font-body-md">Custo</span>
<span class="text-on-surface font-semibold" id="summary-cost">12 000 Kz</span>
</div>
<div class="flex justify-between items-center">
<span class="text-on-surface-variant font-body-md">Saldo atual</span>
<span class="text-on-surface font-semibold">125 000 Kz</span>
</div>
<div class="pt-3 border-t border-outline-variant flex justify-between items-center">
<span class="text-on-surface-variant font-body-md">Saldo após compra</span>
<span class="text-brand-blue font-bold text-body-lg" id="summary-after">113 000 Kz</span>
</div>
</div>
<!-- Action Button -->
<div class="mt-4">
<button class="w-full bg-brand-blue text-white font-headline-md text-headline-md py-4 rounded-btn active:scale-95 transition-transform glow-hover shadow-lg cursor-pointer pointer-events-auto" id="buy-button">
                        Comprar
                    </button>
</div>
</div>
</section>
</main>
<!-- Scripts for Interaction -->
<script>
        const initialBalance = 125000;

        function updateSummary(credits, cost) {
            const afterBalance = initialBalance - cost;
            
            // Format thousands
            const formatCurrency = (val) => val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") + " Kz";

            document.getElementById('summary-debit-msg').innerText = formatCurrency(cost);
            document.getElementById('summary-pkg').innerText = `${credits} créditos`;
            document.getElementById('summary-cost').innerText = formatCurrency(cost);
            document.getElementById('summary-after').innerText = formatCurrency(afterBalance);
        }

        document.getElementById('buy-button').addEventListener('click', () => {
            const button = document.getElementById('buy-button');
            button.innerText = "Processando...";
            button.classList.add('opacity-80');
            button.disabled = true;
            
            // Mock transaction delay
            setTimeout(() => {
                alert('Compra realizada com sucesso!');
                button.innerText = "Comprar";
                button.classList.remove('opacity-80');
                button.disabled = false;
            }, 1500);
        });
    </script>
</body></html>
```

