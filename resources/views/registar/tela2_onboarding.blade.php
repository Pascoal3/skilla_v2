<!DOCTYPE html>

<html lang="pt-BR"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Skilla - Onboarding: Informações de Perfil</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "borderRadius": {
                        "DEFAULT": "1rem",
                        "lg": "2rem",
                        "xl": "3rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "section-gap": "120px",
                        "grid-gutter": "20px",
                        "container-padding": "24px",
                        "card-padding": "32px",
                        "base": "8px"
                    },
                    "fontFamily": {
                        "body-lg": ["Inter"],
                        "h2": ["Space Grotesk"],
                        "h3": ["Space Grotesk"],
                        "h1": ["Space Grotesk"],
                        "body-md": ["Inter"],
                        "label-caps": ["Space Grotesk"]
                    },
                    "fontSize": {
                        "body-lg": ["18px", { "lineHeight": "1.6", "letterSpacing": "0em", "fontWeight": "400" }],
                        "h2": ["48px", { "lineHeight": "1.1", "letterSpacing": "-0.03em", "fontWeight": "700" }],
                        "h3": ["32px", { "lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "600" }],
                        "h1": ["72px", { "lineHeight": "1.0", "letterSpacing": "-0.04em", "fontWeight": "700" }],
                        "body-md": ["16px", { "lineHeight": "1.5", "letterSpacing": "0em", "fontWeight": "400" }],
                        "label-caps": ["12px", { "lineHeight": "1.0", "letterSpacing": "0.1em", "fontWeight": "600" }]
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white text-gray-900 font-body-md min-h-screen flex flex-col selection:bg-[#E1F0B1] selection:text-gray-900">
<!-- Header / TopAppBar -->
<header class="w-full bg-white/90 backdrop-blur-md border-b border-gray-200 fixed top-0 z-50">
<div class="flex justify-between items-center w-full px-container-padding py-base max-w-7xl mx-auto h-[72px]">
<!-- Brand -->
<div class="flex items-center">
<span class="font-h3 text-h3 font-bold text-[#E1F0B1] tracking-tight drop-shadow-sm">Skilla</span>
</div>
<!-- Step Indicator -->
<div class="hidden md:flex flex-col items-end gap-1">
<span class="font-label-caps text-label-caps text-gray-500 uppercase">Passo 2 de 3</span>
<div class="flex items-center gap-2">
<div class="h-1 w-8 rounded-full bg-[#E1F0B1]"></div>
<div class="h-1 w-8 rounded-full bg-[#E1F0B1]"></div>
<div class="h-1 w-8 rounded-full bg-gray-200"></div>
</div>
</div>
<!-- Mobile Step Indicator (Simplified) -->
<div class="md:hidden flex items-center">
<span class="font-label-caps text-label-caps text-gray-500 uppercase">2 / 3</span>
</div>
</div>
</header>
<!-- Main Content -->
<main class="flex-grow flex flex-col items-center justify-center pt-[100px] pb-section-gap px-container-padding">
<div class="w-full max-w-2xl mx-auto flex flex-col gap-8">
<!-- Heading Section -->
<div class="text-center flex flex-col gap-4 mb-4">
<h1 class="font-h2 text-h2 text-gray-900">Conte-nos mais sobre você</h1>
<p class="font-body-lg text-body-lg text-gray-600 max-w-xl mx-auto">
                    Um perfil completo e profissional atrai clientes melhores e projetos mais lucrativos.
                </p>
</div>
<!-- Form Container -->
<div class="bg-white rounded-xl border border-gray-200 p-card-padding shadow-lg flex flex-col gap-8">
<!-- Avatar Upload Section -->
<div class="flex flex-col md:flex-row items-center gap-6 justify-center md:justify-start pb-6 border-b border-gray-200">
<div class="relative group cursor-pointer">
<div class="w-32 h-32 rounded-full bg-gray-50 border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden transition-all duration-300 group-hover:border-[#E1F0B1] group-hover:bg-white">
<span class="material-symbols-outlined text-[48px] text-gray-300 group-hover:text-[#E1F0B1] transition-colors">account_circle</span>
</div>
<div class="absolute bottom-0 right-0 bg-white rounded-full p-2 border border-gray-200 shadow-sm text-gray-500 group-hover:text-[#E1F0B1] transition-colors">
<span class="material-symbols-outlined text-[20px]">photo_camera</span>
</div>
</div>
<div class="flex flex-col gap-2 text-center md:text-left">
<button class="font-label-caps text-label-caps text-gray-700 hover:text-gray-900 transition-colors uppercase tracking-widest border border-gray-300 rounded-full px-6 py-2 w-fit mx-auto md:mx-0 hover:border-gray-400 bg-white" type="button">
                            Upload de Foto
                        </button>
<p class="font-body-md text-body-md text-gray-500 text-sm">
                            Sua foto é a primeira impressão do cliente.
                        </p>
</div>
</div>
<!-- Form Fields -->
<form class="flex flex-col gap-6">
<!-- Biografia -->
<div class="flex flex-col gap-2">
<div class="flex justify-between items-center">
<label class="font-label-caps text-label-caps text-gray-700 uppercase" for="biografia">Biografia</label>
<span class="font-body-md text-body-md text-gray-500 text-xs">0/500</span>
</div>
<textarea class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 font-body-md text-body-md text-gray-900 placeholder:text-gray-400 focus:border-[#E1F0B1] focus:ring-1 focus:ring-[#E1F0B1] transition-all resize-none shadow-sm" id="biografia" name="biografia" placeholder="Descreva suas experiências, ferramentas que domina e como você ajuda seus clientes..." rows="4"></textarea>
</div>
<!-- Grid for Localização & Telefone -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<!-- Localização -->
<div class="flex flex-col gap-2">
<label class="font-label-caps text-label-caps text-gray-700 uppercase" for="localizacao">Localização</label>
<div class="relative">
<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
<span class="material-symbols-outlined text-gray-400 text-[20px]">location_on</span>
</div>
<input class="w-full bg-white border border-gray-300 rounded-lg pl-10 pr-4 py-3 font-body-md text-body-md text-gray-900 placeholder:text-gray-400 focus:border-[#E1F0B1] focus:ring-1 focus:ring-[#E1F0B1] transition-all shadow-sm" id="localizacao" name="localizacao" placeholder="Ex: Luanda, Angola" type="text"/>
</div>
</div>
<!-- Telefone -->
<div class="flex flex-col gap-2">
<label class="font-label-caps text-label-caps text-gray-700 uppercase" for="telefone">Telefone</label>
<div class="relative">
<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
<span class="material-symbols-outlined text-gray-400 text-[20px]">call</span>
</div>
<input class="w-full bg-white border border-gray-300 rounded-lg pl-10 pr-4 py-3 font-body-md text-body-md text-gray-900 placeholder:text-gray-400 focus:border-[#E1F0B1] focus:ring-1 focus:ring-[#E1F0B1] transition-all shadow-sm" id="telefone" name="telefone" placeholder="+244 XXX XXX XXX" type="tel"/>
</div>
</div>
</div>
</form>
</div>
<!-- Actions Container -->
<div class="flex flex-col gap-4 items-center mt-4">
<button class="w-full md:w-auto min-w-[200px] bg-[#E1F0B1] text-gray-900 font-label-caps text-label-caps uppercase rounded-full px-8 py-4 hover:bg-[#d4e69c] transition-colors shadow-sm font-bold" type="button">
                    Continuar
                </button>
<div class="flex flex-col sm:flex-row gap-4 sm:gap-8 mt-2">
<a class="font-body-md text-body-md text-gray-600 hover:text-gray-900 transition-colors text-center" href="#">
                        Voltar para o cadastro
                    </a>
<a class="font-body-md text-body-md text-gray-500 hover:text-gray-900 transition-colors text-center" href="#">
                        Pular esta etapa
                    </a>
</div>
</div>
</div>
</main>
</body></html>