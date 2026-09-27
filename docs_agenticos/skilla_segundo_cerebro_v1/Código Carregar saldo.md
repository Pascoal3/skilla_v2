

```

<!DOCTYPE html><html class="light" lang="pt-BR"><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&amp;family=Hanken+Grotesk:wght@400;500;600&amp;family=JetBrains+Mono:wght@500&amp;family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<style>
        body { font-family: 'Inter', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border: 1px solid #E6E8EF;
        }
        .volt-glow:hover {
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.08);
        }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .modal-overlay { background: rgba(15, 17, 21, 0.6); }
        .bg-lime-main { background-color: #D4FF00; }
    </style>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary-fixed": "#e0e2ec",
                        "on-error": "#690005",
                        "on-secondary": "#2f3035",
                        "primary": "#111827",
                        "on-error-container": "#ffdad6",
                        "tertiary-fixed-dim": "#c4c6d0",
                        "surface-bright": "#ffffff",
                        "tertiary": "#111827",
                        "secondary-container": "#F3F4F6",
                        "on-secondary-container": "#6B7280",
                        "error-container": "#FEE2E2",
                        "primary-fixed": "#2F5BFF",
                        "on-surface": "#111827",
                        "background": "#D4FF00",
                        "on-tertiary-container": "#6B7280",
                        "outline-variant": "rgba(0,0,0,0.06)",
                        "inverse-surface": "#111827",
                        "surface-dim": "#D4FF00",
                        "surface-container-lowest": "#0b0f10",
                        "surface-container-low": "#FFFFFF",
                        "secondary-fixed-dim": "#c6c6cc",
                        "on-surface-variant": "#4B5563",
                        "secondary-fixed": "#e2e2e8",
                        "on-secondary-fixed": "#1a1c20",
                        "on-secondary-fixed-variant": "#45474b",
                        "on-primary-container": "#2F5BFF",
                        "surface-container-high": "#FFFFFF",
                        "on-primary": "#FFFFFF",
                        "primary-container": "#2F5BFF",
                        "outline": "#D1D5DB",
                        "surface-tint": "#2F5BFF",
                        "surface-variant": "#F9FAFB",
                        "on-primary-fixed-variant": "#1E40AF",
                        "on-primary-fixed": "#FFFFFF",
                        "surface-container-highest": "#F3F4F6",
                        "error": "#DC2626",
                        "primary-fixed-dim": "#2F5BFF",
                        "on-background": "#111827",
                        "on-tertiary": "#FFFFFF",
                        "inverse-primary": "#2F5BFF",
                        "secondary": "#4B5563",
                        "inverse-on-surface": "#FFFFFF",
                        "tertiary-container": "#F3F4F6",
                        "surface": "#FFFFFF",
                        "on-tertiary-fixed": "#111827",
                        "on-tertiary-fixed-variant": "#6B7280",
                        "surface-container": "#FFFFFF"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px",
                        "card": "24px"
                    },
                    "spacing": {
                        "margin-desktop": "40px",
                        "unit": "8px",
                        "margin-mobile": "16px",
                        "gutter": "24px",
                        "container-max": "1280px",
                        "section-gap": "48px"
                    },
                    "fontFamily": {
                        "label-md": ["JetBrains Mono"],
                        "headline-lg": ["Sora"],
                        "body-md": ["Hanken Grotesk"],
                        "headline-md": ["Sora"]
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-lime-main text-on-surface min-h-screen flex overflow-hidden">
<!-- Main Content -->
<main class="flex-1 flex flex-col bg-lime-main overflow-y-auto">
<!-- Top Bar -->
<header class="h-16 px-margin-desktop flex items-center justify-between bg-white border-b border-black/5 sticky top-0 z-40">
<div class="flex items-center gap-4">
<button class="p-2 hover:bg-surface-container-highest rounded-full transition-colors">
<span class="material-symbols-outlined text-primary-fixed">arrow_back</span>
</button>
<h2 class="text-headline-md font-bold text-on-surface">Carregar saldo</h2>
</div>
<div class="flex items-center gap-4">
<span class="material-symbols-outlined text-on-surface-variant cursor-pointer hover:text-on-surface">help</span>
<span class="material-symbols-outlined text-on-surface-variant cursor-pointer hover:text-on-surface">notifications</span>
</div>
</header>
<div class="max-w-[800px] w-full mx-auto px-margin-desktop py-section-gap space-y-gutter">
<!-- 1. ENTRADA DE VALOR -->
<section class="bg-white p-8 rounded-card border border-black/5 shadow-xl shadow-black/5 volt-glow transition-all">
<label class="block font-label-md text-on-surface-variant mb-4 uppercase tracking-widest text-xs font-bold">Valor (Kz)</label>
<div class="relative">
<input class="w-full bg-surface-variant border-2 border-outline-variant rounded-xl p-4 text-headline-md font-bold text-on-surface focus:border-primary-fixed focus:ring-0 transition-all outline-none" placeholder="0 Kz" type="text" value="2.000 Kz">
<span class="absolute right-4 top-1/2 -translate-y-1/2 text-error flex items-center gap-1 font-label-sm font-semibold">
<span class="material-symbols-outlined text-sm">error</span>
                        O valor mínimo é 2.000 Kz.
                    </span>
</div>
</section>
<!-- 2. MÉTODO DE RECARGA -->
<section class="bg-white p-8 rounded-card border border-black/5 shadow-xl shadow-black/5">
<label class="block font-label-md text-on-surface-variant mb-6 uppercase tracking-widest text-xs font-bold">Método de Recarga</label>
<div class="grid grid-cols-1 gap-4">
<!-- Desabilitado -->
<div class="flex items-center justify-between p-5 border border-outline-variant rounded-xl opacity-50 cursor-not-allowed bg-surface-variant grayscale">
<div class="flex items-center gap-4">
<span class="material-symbols-outlined text-3xl text-on-surface-variant">payments</span>
<div>
<p class="font-bold text-on-surface">Multicaixa Express</p>
<p class="text-sm text-on-surface-variant">Indisponível no momento</p>
</div>
</div>
<span class="material-symbols-outlined text-on-surface-variant">lock</span>
</div>
<!-- Selecionado -->
<div class="flex items-center justify-between p-5 border-2 border-[#2F5BFF] rounded-xl cursor-pointer bg-white ring-4 ring-[#2F5BFF]/5">
<div class="flex items-center gap-4">
<span class="material-symbols-outlined text-3xl text-[#2F5BFF]" style="font-variation-settings: 'FILL' 1;">account_balance</span>
<div>
<p class="font-bold text-on-surface">Banco Skilla</p>
<p class="text-sm text-on-surface-variant font-medium">Transferência instantânea</p>
</div>
</div>
<span class="material-symbols-outlined text-[#2F5BFF] font-bold" style="font-variation-settings: 'FILL' 1;">check_circle</span>
</div>
<!-- Desabilitado -->
<div class="flex items-center justify-between p-5 border border-outline-variant rounded-xl opacity-50 cursor-not-allowed bg-surface-variant grayscale">
<div class="flex items-center gap-4">
<span class="material-symbols-outlined text-3xl text-on-surface-variant">credit_card</span>
<div>
<p class="font-bold text-on-surface">Multicaixa</p>
<p class="text-sm text-on-surface-variant">Referência de pagamento</p>
</div>
</div>
<span class="material-symbols-outlined text-on-surface-variant">lock</span>
</div>
</div>
</section>
<!-- 3. RESUMO DA RECARGA -->
<section class="bg-white p-8 rounded-card border border-black/5 shadow-xl shadow-black/5 overflow-hidden relative">
<div class="absolute top-0 right-0 p-4 opacity-5">
<span class="material-symbols-outlined text-8xl text-on-surface">receipt_long</span>
</div>
<label class="block font-label-md text-on-surface-variant mb-6 uppercase tracking-widest text-xs font-bold">Resumo da Recarga</label>
<div class="space-y-4">
<div class="flex justify-between items-center py-2 border-b border-black/5">
<span class="text-on-surface-variant font-medium">Valor da recarga</span>
<span class="font-bold text-on-surface">2.000 Kz</span>
</div>
<div class="flex justify-between items-center py-2 border-b border-black/5">
<span class="text-on-surface-variant font-medium">Taxa de serviço</span>
<span class="font-bold text-green-600">0 Kz</span>
</div>
<div class="flex justify-between items-center pt-4">
<span class="text-headline-md font-bold text-on-surface">Total a pagar</span>
<span class="text-headline-md font-extrabold text-[#2F5BFF]">2.000 Kz</span>
</div>
</div>
</section>
<!-- Botão Primário -->
<div class="pt-8">
<button class="w-full bg-[#111827] hover:bg-black text-white font-bold py-5 rounded-card text-lg shadow-xl shadow-black/20 transition-all flex items-center justify-center gap-3 active:scale-[0.98]" onclick="toggleModal('successModal')">
                    Confirmar recarga
                    <span class="material-symbols-outlined">arrow_forward</span>
</button>
</div>
</div>
<!-- Footer -->
<footer class="w-full py-12 px-margin-desktop max-w-[1200px] mx-auto flex flex-col md:flex-row justify-between border-t border-black/10 mt-auto">
<p class="text-body-sm text-on-surface-variant font-medium">© 2024 Skilla Global Inc.</p>
<div class="flex gap-6 mt-4 md:mt-0">
<a class="text-body-sm text-on-surface-variant hover:text-black font-medium underline transition-all" href="#">Termos de Serviço</a>
<a class="text-body-sm text-on-surface-variant hover:text-black font-medium underline transition-all" href="#">Privacidade</a>
<a class="text-body-sm text-on-surface-variant hover:text-black font-medium underline transition-all" href="#">Ajuda</a>
</div>
</footer>
</main>
<!-- Overlay: Modal Informação -->
<div class="fixed inset-0 z-50 flex items-center justify-center p-6 modal-overlay hidden" id="infoModal">
<div class="bg-white max-w-md w-full rounded-card p-10 border border-outline-variant text-center shadow-2xl animate-in fade-in zoom-in duration-300">
<div class="w-20 h-20 bg-primary-fixed/10 rounded-full flex items-center justify-center mx-auto mb-6">
<span class="material-symbols-outlined text-4xl text-primary-fixed">info</span>
</div>
<h3 class="text-headline-md font-bold mb-2 text-on-surface">Informação</h3>
<p class="text-on-surface-variant mb-8 font-body-md">Esta funcionalidade de recarga via Multicaixa estará disponível em breve para todos os usuários.</p>
<button class="w-full py-4 bg-surface-variant border border-outline-variant rounded-xl font-bold hover:bg-gray-100 text-on-surface transition-all" onclick="toggleModal('infoModal')">
                OK
            </button>
</div>
</div>
<!-- Overlay: Sucesso -->
<div class="fixed inset-0 z-50 flex items-center justify-center p-6 modal-overlay hidden" id="successModal">
<div class="bg-white max-w-md w-full rounded-card p-10 border border-outline-variant text-center shadow-2xl animate-in fade-in zoom-in duration-300">
<div class="w-24 h-24 bg-green-500/10 rounded-full flex items-center justify-center mx-auto mb-8 relative">
<span class="material-symbols-outlined text-6xl text-green-600" style="font-variation-settings: 'FILL' 1;">check_circle</span>
<div class="absolute inset-0 rounded-full border-4 border-green-500 animate-ping opacity-20"></div>
</div>
<h3 class="text-headline-md font-bold mb-2 text-on-surface">Recarga concluída</h3>
<p class="text-on-surface-variant mb-10 font-body-md">Seu saldo de 2.000 Kz foi carregado com sucesso em sua conta Skilla.</p>
<div class="space-y-4">
<button class="w-full py-5 bg-[#2F5BFF] text-white font-extrabold rounded-xl hover:opacity-90 transition-all flex items-center justify-center gap-2">
<span class="material-symbols-outlined">list_alt</span>
                    Ver extrato
                </button>
<button class="w-full py-4 text-on-surface-variant font-medium hover:text-on-surface transition-all" onclick="toggleModal('successModal')">
                    Voltar para carteira
                </button>
</div>
</div>
</div>
<!-- Micro-interactions Script -->
<script>
        function toggleModal(id) {
            const modal = document.getElementById(id);
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            } else {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        // Attach listeners to disabled items
        document.querySelectorAll('.cursor-not-allowed').forEach(item => {
            item.addEventListener('click', () => toggleModal('infoModal'));
        });
    </script>
</body></html>
```