<!DOCTYPE html>
<html lang="pt-AO">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    
    <!-- Meta tags para dados de sistema (Adicionado) -->
    <meta name="user-id" content="{{ auth()->id() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Skilla - Painel de cliente</title>
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
    <div style="display: flex; gap: 5px;" class="px-6 mb-8">
        <nav><span style="display:inline" class="material-symbols-outlined text-secondary-container text-4xl" data-weight="fill" style="font-variation-settings: 'FILL' 1;">widgets</span>  </nav>
        <nav>
            <h1 class="text-headline-md font-headline-md font-bold text-white">Skilla</h1>
            <p class="text-body-sm font-body-sm text-gray-300">Plataforma Freelance</p>
        </nav>
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
        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-white hover:bg-gray-800 transition-colors" href="#" onclick="logout(event)">
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
            <!-- Área do Utilizador (Dinâmica) -->
            <div class="flex items-center gap-2 cursor-pointer">
                <div class="text-right">
                    <h2 class="text-headline-lg font-headline-lg text-on-surface mb-0" id="header-user-name">[Nome]</h2>
                    
                </div>
                <span class="material-symbols-outlined text-[18px] hidden sm:block text-secondary">expand_more</span>
            </div>
        </div>
    </header>
    <!-- Dashboard Canvas -->
    <main class="flex-1 p-6 md:p-8 space-y-6 max-w-container-max mx-auto w-full">
        <!-- Greeting Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-2">
            <div>
                <h2 class="text-headline-lg font-headline-lg text-on-surface mb-1" id="greeting-user-name">Olá, [Nome] 👋</h2>
                <p class="text-body-md font-body-md text-secondary">Tens <span class="font-semibold text-primary" id="greeting-new-proposals-count">0</span> propostas novas à espera de revisão.</p>
            </div>
            <button class="bg-[#1A1A1A] text-white text-label-md font-label-md px-4 py-2 rounded-lg hover:bg-black transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">add</span>
                Publicar Trabalho
            </button>
        </div>
        <!-- Metrics Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Card 1: Trabalhos Publicados -->
            <div class="bg-white border border-border-subtle rounded-[12px] p-5 flex flex-col justify-between">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-[#1E1E1E] rounded-lg">
                        <span class="material-symbols-outlined text-[#CCFF00]">work</span>
                    </div>
                </div>
                <div>
                    <h3 class="text-label-md font-label-md text-secondary uppercase tracking-wider mb-1">Trabalhos Publicados</h3>
                    <p class="text-metric-lg font-metric-lg text-on-surface" id="metric-published-jobs">0</p>
                </div>
            </div>
            
            <!-- Card 2: Propostas Recebidas -->
            <div class="bg-white border border-border-subtle rounded-[12px] p-5 flex flex-col justify-between">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-[#1E1E1E] rounded-lg">
                        <span class="material-symbols-outlined text-[#CCFF00]">description</span>
                    </div>
                    <span class="bg-[#CCFF00] text-[#1A1A1A] text-label-sm font-label-sm px-2 py-0.5 rounded-full flex items-center gap-1 hidden" id="badge-new-proposals">
                        <span class="material-symbols-outlined text-[14px]">arrow_upward</span> 
                        <span id="badge-new-proposals-count">0</span> novas
                    </span>
                </div>
                <div>
                    <h3 class="text-label-md font-label-md text-secondary uppercase tracking-wider mb-1">Propostas Recebidas</h3>
                    <p class="text-metric-lg font-metric-lg text-on-surface" id="metric-received-proposals">0</p>
                </div>
            </div>

            <!-- Card 3: Em Andamento -->
            <div class="bg-white border border-border-subtle rounded-[12px] p-5 flex flex-col justify-between">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-[#1E1E1E] rounded-lg">
                        <span class="material-symbols-outlined text-[#CCFF00]">schedule</span>
                    </div>
                </div>
                <div>
                    <h3 class="text-label-md font-label-md text-secondary uppercase tracking-wider mb-1">Em Andamento</h3>
                    <p class="text-metric-lg font-metric-lg text-on-surface" id="metric-in-progress">0</p>
                </div>
            </div>

            <!-- Card 4: Concluídos -->
            <div class="bg-white border border-border-subtle rounded-[12px] p-5 flex flex-col justify-between">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-[#1E1E1E] rounded-lg">
                        <span class="material-symbols-outlined text-[#CCFF00]">check_circle</span>
                    </div>
                </div>
                <div>
                    <h3 class="text-label-md font-label-md text-secondary uppercase tracking-wider mb-1">Concluídos</h3>
                    <p class="text-metric-lg font-metric-lg text-on-surface" id="metric-completed">0</p>
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
                <!-- Container Dinâmico para Alertas -->
                <div class="space-y-4 flex-1" id="attention-needed-container">
                    <!-- Será preenchido pelo JS -->
                </div>
            </div>
        </div>
        <!-- Os Meus Jobs Ativos -->
        <div class="bg-white border border-border-subtle rounded-[12px] overflow-hidden">
            <div class="p-6 border-b border-border-subtle flex justify-between items-center bg-white">
                <h3 class="text-headline-sm font-headline-sm text-[#1E1E1E]">Os Meus Trabalhos ativos</h3>
                <a class="text-[#1A1A1A] text-label-md font-label-md hover:underline" href="#">Ver todos</a>
            </div>
            <!-- Container Dinâmico para Jobs Ativos -->
            <div class="divide-y divide-border-subtle" id="active-jobs-container">
                <!-- Será preenchido pelo JS -->
            </div>
        </div>
        <!-- Two Columns Bottom -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Últimas Propostas -->
            <div class="bg-white border border-border-subtle rounded-[12px] flex flex-col">
                <div class="p-6 border-b border-border-subtle">
                    <h3 class="text-headline-sm font-headline-sm">Últimas Propostas Recebidas</h3>
                </div>
                <!-- Container Dinâmico para Propostas -->
                <div class="p-6 space-y-4" id="recent-proposals-container">
                    <!-- Será preenchido pelo JS -->
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
                            <!-- Será preenchido pelo JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Script do Cliente -->
<script src="{{ asset('js/painel_cliente.js') }}"></script>
<script>
async function logout(event) {
    // Impede o comportamento padrão do link (recarregar a página ou ir para #)
    event.preventDefault();
    
    // Tenta obter o token CSRF do meta tag (padrão do Laravel)
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    const response = await fetch('/logout-api', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'Content-Type': 'application/json' // Recomendado adicionar
        }
    });
    
    // Se a resposta for ok (status 200-299), redireciona para o login
    if (response.ok) {
        window.location.href = '/login';
    } else {
        console.error('Erro ao terminar sessão');
    }
}
</script>
</body>
</html>