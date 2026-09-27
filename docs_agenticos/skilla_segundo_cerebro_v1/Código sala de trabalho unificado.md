
```

<!DOCTYPE html>

<html lang="pt"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Skilla - Sala de Trabalho (Conversa)</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&amp;family=JetBrains+Mono:wght@400;500&amp;family=Sora:wght@600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          "colors": {
                  "tertiary-fixed": "#e0e2ec",
                  "inverse-on-surface": "#2d3133",
                  "on-primary-fixed-variant": "#3f4c00",
                  "on-tertiary-fixed": "#191c22",
                  "primary-fixed-dim": "#b4d400",
                  "background": "#101415",
                  "on-primary-fixed": "#181e00",
                  "on-surface-variant": "#c5c9ac",
                  "outline": "#8f9378",
                  "surface-container-low": "#191c1e",
                  "on-error-container": "#ffdad6",
                  "on-tertiary-fixed-variant": "#44474e",
                  "on-secondary-fixed": "#1a1c20",
                  "tertiary-container": "#e0e2ec",
                  "surface-variant": "#323537",
                  "on-tertiary-container": "#62646c",
                  "on-surface": "#e0e3e5",
                  "tertiary-fixed-dim": "#c4c6d0",
                  "surface-bright": "#363a3b",
                  "outline-variant": "#454932",
                  "surface-container-lowest": "#0b0f10",
                  "on-secondary-fixed-variant": "#45474b",
                  "on-background": "#e0e3e5",
                  "inverse-primary": "#556500",
                  "on-tertiary": "#2d3038",
                  "on-error": "#690005",
                  "error-container": "#93000a",
                  "surface-container-high": "#272a2c",
                  "primary-container": "#cdf200",
                  "primary": "#ffffff",
                  "on-primary-container": "#5a6b00",
                  "secondary": "#c6c6cc",
                  "tertiary": "#ffffff",
                  "on-primary": "#2b3400",
                  "on-secondary-container": "#b7b8be",
                  "surface-container": "#1d2022",
                  "surface-dim": "#101415",
                  "surface-container-highest": "#323537",
                  "on-secondary": "#2f3035",
                  "inverse-surface": "#e0e3e5",
                  "surface-tint": "#b4d400",
                  "secondary-fixed": "#e2e2e8",
                  "surface": "#101415",
                  "secondary-container": "#47494e",
                  "secondary-fixed-dim": "#c6c6cc",
                  "primary-fixed": "#cdf200",
                  "error": "#ffb4ab"
          },
          "borderRadius": {
                  "DEFAULT": "0.25rem",
                  "lg": "0.5rem",
                  "xl": "0.75rem",
                  "full": "9999px"
          },
          "spacing": {
                  "margin-mobile": "16px",
                  "gutter": "24px",
                  "margin-desktop": "40px",
                  "unit": "8px",
                  "container-max": "1280px"
          },
          "fontFamily": {
                  "label-sm": [
                          "JetBrains Mono"
                  ],
                  "body-lg": [
                          "Hanken Grotesk"
                  ],
                  "label-md": [
                          "JetBrains Mono"
                  ],
                  "headline-md": [
                          "Sora"
                  ],
                  "display-lg": [
                          "Sora"
                  ],
                  "body-md": [
                          "Hanken Grotesk"
                  ],
                  "headline-lg-mobile": [
                          "Sora"
                  ],
                  "headline-lg": [
                          "Sora"
                  ]
          },
          "fontSize": {
                  "label-sm": [
                          "12px",
                          {
                                  "lineHeight": "16px",
                                  "fontWeight": "500"
                          }
                  ],
                  "body-lg": [
                          "18px",
                          {
                                  "lineHeight": "28px",
                                  "fontWeight": "400"
                          }
                  ],
                  "label-md": [
                          "14px",
                          {
                                  "lineHeight": "20px",
                                  "letterSpacing": "0.05em",
                                  "fontWeight": "500"
                          }
                  ],
                  "headline-md": [
                          "24px",
                          {
                                  "lineHeight": "32px",
                                  "fontWeight": "600"
                          }
                  ],
                  "display-lg": [
                          "64px",
                          {
                                  "lineHeight": "72px",
                                  "letterSpacing": "-0.04em",
                                  "fontWeight": "800"
                          }
                  ],
                  "body-md": [
                          "16px",
                          {
                                  "lineHeight": "24px",
                                  "fontWeight": "400"
                          }
                  ],
                  "headline-lg-mobile": [
                          "32px",
                          {
                                  "lineHeight": "40px",
                                  "letterSpacing": "-0.02em",
                                  "fontWeight": "700"
                          }
                  ],
                  "headline-lg": [
                          "40px",
                          {
                                  "lineHeight": "48px",
                                  "letterSpacing": "-0.02em",
                                  "fontWeight": "700"
                          }
                  ]
          }
        }
      }
    }
  </script>
<style>
    .material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
    .material-symbols-outlined.fill {
      font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
    
    /* Custom Scrollbar for Chat */
    ::-webkit-scrollbar {
      width: 6px;
    }
    ::-webkit-scrollbar-track {
      background: transparent;
    }
    ::-webkit-scrollbar-thumb {
      background-color: rgba(205, 242, 0, 0.3); /* primary-fixed */
      border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb:hover {
      background-color: rgba(205, 242, 0, 0.6);
    }
  </style>
</head>
<body class="bg-[#D4FF00] text-black font-body-md text-body-md h-screen overflow-hidden flex">
<!-- Mobile TopAppBar (hidden on md) -->
<header class="md:hidden fixed top-0 w-full z-50 bg-white border-b border-gray-200 flex justify-between items-center h-16 px-margin-mobile">
<div class="font-display-lg text-headline-md font-black text-primary-fixed">Skilla</div>
<div class="flex gap-4">
<span class="material-symbols-outlined text-black">info</span>
<span class="material-symbols-outlined text-black">more_vert</span>
</div>
</header>
<!-- Main Content Area -->
<!-- On desktop, offset by sidebar width (ml-64). On mobile, offset by top/bottom nav. -->
<main class="flex-1 lg:ml-64 h-full flex flex-col bg-[#D4FF00] relative pt-16 md:pt-0 pb-[72px] lg:pb-0 overflow-hidden">
<!-- Chat Header (Fixed at top of chat area) -->
<div class="bg-white border-b border-gray-200 px-margin-mobile md:px-gutter py-4 flex justify-between items-center shrink-0 shadow-sm z-20 rounded-b-xl lg:rounded-none">
<div class="flex items-center gap-4">
<!-- Client Avatar -->
<div class="w-12 h-12 rounded-full overflow-hidden border-2 border-primary-fixed hidden sm:block">
<img alt="Client Logo" class="w-full h-full object-cover" data-alt="A sleek corporate logo icon representing a modern tech startup. The design features sharp geometric shapes in deep obsidian black against a stark white background, conveying a sense of premium quality and electric efficiency." src="https://lh3.googleusercontent.com/aida-public/AB6AXuB3mnX26vKnjiE7lkgPOzM_-P8x_gLtdhDtE4diNxIzJIMUPkVYMUyAgSJ1mooqjvIT6Wonn8Z1YXlTB22X4UUTfKQDx-Yqxk35-8dHhsfGvxaC3iZf2ZoFtHEBjqNbxaPZJgyeDCxem8wUV-MckGB6o9g3DD5__hK_SV4OOxMoLzpq8CbymlDAEnj2QrELQFpFRxWdbEYxpZK0h6xVRgY-fijAPbErhvj3gphkeCcZIaaekpXNmpnk46tPZ_GdOpZ8Dbnusgplt0I"/>
</div>
<div>
<h1 class="font-headline-md text-headline-md text-black">Sala de trabalho — Logo Skilla</h1>
<div class="flex items-center gap-2 mt-1">
<span class="font-label-sm text-label-sm text-gray-500 uppercase tracking-wider">Contrato #1024</span>
<span class="w-1.5 h-1.5 rounded-full bg-primary-fixed"></span>
<span class="font-label-sm text-label-sm text-primary-fixed font-bold">Status: Ativo</span>
</div>
</div>
</div>
<button class="hidden sm:flex px-4 py-2 bg-gray-50 border border-gray-200 text-black rounded-lg font-label-md text-label-md hover:border-primary-fixed transition-colors items-center gap-2">
<span class="material-symbols-outlined text-[18px]">visibility</span>
        Ver detalhes
      </button>
<!-- Mobile Details Icon -->
<button class="sm:hidden p-2 text-gray-500 hover:text-primary-fixed">
<span class="material-symbols-outlined">info</span>
</button>
</div>
<!-- Chat Messages Area (Scrollable) -->
<div class="flex-1 overflow-y-auto bg-white p-margin-mobile md:p-gutter flex flex-col gap-6 relative">
<!-- System Message -->
<div class="flex justify-center my-4">
<div class="bg-gray-100 border border-gray-200 px-4 py-2 rounded-full font-label-sm text-label-sm text-gray-600 text-center max-w-md shadow-sm">
          O contrato foi iniciado. Podes usar esta sala para comunicar e enviar ficheiros.
        </div>
</div>
<!-- Message (Client - Left) -->
<div class="flex flex-col items-start gap-1 max-w-[85%] md:max-w-[70%]">
<div class="flex items-end gap-2">
<div class="w-8 h-8 rounded-full overflow-hidden shrink-0 border border-gray-200 bg-gray-100">
<img alt="Client" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAdsdrxNRELguNRZj1IJOZLygHNtSPVOgi8_ZOn-y4IAJOwfmHVOgkqbnYLILHPczmdjFaeFVkGoCeuimXarQp-jNI4jpQEi7BS42bFszr6a1SUMqjy5migHyRF47acCZAfTwj-NZbm6AD6PgoHzW8ZJPOl7CY7zokqiujQ4Vl42jeLt1j6ehPipnSZsO-gS9Ifl8eLLgwtxqhOZ1LW41bTrZzWpNVxaNSpBtNa4XPslv47OIYZroenTGJ8WsGiZxzNP6qPwF3IQWQ"/>
</div>
<div class="bg-gray-50 text-black border border-gray-200 p-4 rounded-2xl rounded-bl-sm shadow-sm">
<p class="font-body-md text-body-md">Olá! Obrigado por aceitares o projeto. Estamos muito entusiasmados para ver as tuas ideias para o logo da Skilla.</p>
</div>
</div>
<span class="font-label-sm text-label-sm text-gray-500 ml-10">10:00 AM</span>
</div>
<!-- Message (Freelancer - Right) -->
<div class="flex flex-col items-end gap-1 self-end max-w-[85%] md:max-w-[70%]">
<div class="flex items-end gap-2 flex-row-reverse">
<div class="w-8 h-8 rounded-full overflow-hidden shrink-0 border border-gray-200 bg-gray-100">
<img alt="Freelancer" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBVh9mjw_BNDKV0SQb7r7p6eg28yfNAcoDEVFV3yOooMbrvXBMvLQ1DgzGQ7Asu-RLUS8V8yJmetSFOkiDuuC7mSSWjhABZZ6B8k__8evJeWMGv6wjNtCdFKKAfojUlhvxoWJ1_lCqGX8Xq3wLfhfk74dE74jCej86W65UJshxxJgL-vOFxhRYZ0b8KoaQW0OXxU4sW--xTiKVQ-i_seqAaCrvQz1sJuEssSxojG1Vm5sCP7NYdeUmPfGXgFulzHQXKKCqlDlBCNUI"/>
</div>
<div class="bg-white text-black border border-gray-200 p-4 rounded-2xl rounded-br-sm shadow-md">
<p class="font-body-md text-body-md">Olá! O prazer é meu. Já estive a ler o briefing. Têm alguma preferência de cor além do que está no documento?</p>
</div>
</div>
<span class="font-label-sm text-label-sm text-gray-500 mr-10">10:15 AM</span>
</div>
<!-- Message (Client - Left) -->
<div class="flex flex-col items-start gap-1 max-w-[85%] md:max-w-[70%]">
<div class="flex items-end gap-2">
<div class="w-8 h-8 rounded-full overflow-hidden shrink-0 border border-gray-200 bg-gray-100">
<img alt="Client" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCMtEUukVwRHLJWA5VJMB_Z2OEDM67ml2iqohOuys-svJk8tZVdelRDaJULTvOOg0b09uYDnfHIOJrt2t-12khyF2esX0rUUL_JW6GpRkT2PuByURWoEUzSdlGi-geyI9Ij2VJgooVx3yw5EisDpkaE-oIzQ8F2Qimq7zaWYpL-MTaxbxSaX3sroKwzML6rQpdvI80i2nCEXkkoleLyixfrCncdLCOsnBVfYB9WSCzb4YuFPRVuCHhzcorTBK65jo3wW8_hAtzCtpE"/>
</div>
<div class="bg-gray-50 text-black border border-gray-200 p-4 rounded-2xl rounded-bl-sm shadow-sm">
<p class="font-body-md text-body-md">Queremos algo que transmita 'energia' e 'eficiência'. Talvez explorar tons de verde ou amarelo néon, mas mantendo um ar profissional SaaS.</p>
</div>
</div>
<span class="font-label-sm text-label-sm text-gray-500 ml-10">10:22 AM</span>
</div>
<!-- Message (Freelancer - Right) -->
<div class="flex flex-col items-end gap-1 self-end max-w-[85%] md:max-w-[70%]">
<div class="flex items-end gap-2 flex-row-reverse">
<div class="w-8 h-8 rounded-full overflow-hidden shrink-0 border border-gray-200 bg-gray-100">
<img alt="Freelancer" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCb9jdD_yRthmEprVP0ea3a8-bww_hRnImKg7n83h3HhxGlMyegvdSlKyHybq31r6trs2NNkh2GhHRvq4Jj_4e_AJNVN2zGvMAk9HywKw68WCUzjJrzRJoOo72cScpBzB1MuhtpfLvFl-NyymlR76vcU3yar2CODAm2u6kv6G02j-vkD8bJDR3eGtWZ4BR2KndHT8pXJ1lruZ4EU0bROMPf-dYpvJtYEgPOh_N5tWgNHrFm2DRk-KYQc5ngF9BOWLakraXevaHXe88"/>
</div>
<div class="bg-white text-black border border-gray-200 p-4 rounded-2xl rounded-br-sm shadow-md">
<p class="font-body-md text-body-md">Perfeito. 'Neo-Brutalism' misturado com 'High-End SaaS' parece o caminho. Vou preparar alguns rascunhos iniciais.</p>
</div>
</div>
<span class="font-label-sm text-label-sm text-gray-500 mr-10">10:30 AM</span>
</div>
<!-- System Message -->
<div class="flex justify-center my-4">
<div class="bg-gray-100 border border-gray-200 px-4 py-2 rounded-full font-label-sm text-label-sm text-gray-600 text-center max-w-md shadow-sm">
          Ficheiro anexado: 'skilla_brand_guidelines_v1.pdf'
        </div>
</div>
<!-- Message (Client - Left) -->
<div class="flex flex-col items-start gap-1 max-w-[85%] md:max-w-[70%]">
<div class="flex items-end gap-2">
<div class="w-8 h-8 rounded-full overflow-hidden shrink-0 border border-gray-200 bg-gray-100">
<img alt="Client" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD_7HpkQlvWrDJO81nsCR4JzInDcoNgIAYKbC4qYmXGcof3aZDBnoUy_Qy_87_BqBrc4doYgvlGQheL8QhDJcL81bg5SGhiVfIDuY_U7xvkZQ2oaiolthsRo5O69XePpsNXyWsPX_xmj-pIMqvaXQQOelFHiBSAUjgO0UD21Op62cYl8lKKuoWqKq7BqUNLOGPeHKDLTpJQxmz7VYqvnpHrpQhwBC0XRj6iaikikansYSgz0PpnPN4o2TQZ-RA0_ymdadsimmoAn0g"/>
</div>
<div class="bg-gray-50 text-black border border-gray-200 p-4 rounded-2xl rounded-bl-sm shadow-sm">
<p class="font-body-md text-body-md">Acabei de enviar as guidelines antigas, apenas como referência do que NÃO queremos fazer. Ignora a paleta antiga.</p>
</div>
</div>
<span class="font-label-sm text-label-sm text-gray-500 ml-10">10:35 AM</span>
</div>
<!-- Message (Freelancer - Right) -->
<div class="flex flex-col items-end gap-1 self-end max-w-[85%] md:max-w-[70%]">
<div class="flex items-end gap-2 flex-row-reverse">
<div class="w-8 h-8 rounded-full overflow-hidden shrink-0 border border-gray-200 bg-gray-100">
<img alt="Freelancer" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDsEBlojcd2zurnGbBmWqrsITHv5CYOl1IMzIPbUmeIFpj-bJs8AAtlvpcqT-ir7Z5yWCqd2pgX0YD-p0IO37Xf5_-Q8fZbwheoFJA0gE2f9vtmcI7wv5vdoCdLMBO2arxTyrHQWFDNn5H9tiA0OY9aFylBv6C1zrGTBgjVnVNe8mjPnLE7jdodTm7PCr52sG_98dtnHE5SuIEvWYDYS120EDssyrrC_cY2hjRxWIXihz5QSNWrWMkePFAh-2ECB3SjJFxD1VnT3ag"/>
</div>
<div class="bg-white text-black border border-gray-200 p-4 rounded-2xl rounded-br-sm shadow-md">
<p class="font-body-md text-body-md">Recebido. Vou focar-me no contraste alto. Em 48h envio as primeiras 3 propostas.</p>
</div>
</div>
<span class="font-label-sm text-label-sm text-gray-500 mr-10">10:40 AM</span>
</div>
<!-- Dummy space to ensure last message is above the footer -->
<div class="h-10 shrink-0"></div>
</div>
<!-- Floating Action / Delivery Button -->
<div class="absolute bottom-[80px] md:bottom-[90px] left-0 w-full flex justify-center px-4 pointer-events-none z-30">
<button class="pointer-events-auto bg-[#D4FF00] text-black border border-transparent shadow-lg font-label-md text-label-md font-bold py-3 px-8 rounded-full flex items-center gap-2 hover:bg-[#b4d400] transition-colors group">
<span class="material-symbols-outlined text-black group-hover:scale-110 transition-transform">task_alt</span>
        Entregar trabalho
      </button>
</div>
<!-- Chat Composer Footer -->
<div class="bg-white border-t border-gray-200 p-3 md:p-4 shrink-0 z-20">
<div class="max-w-4xl mx-auto flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl p-2 focus-within:border-primary-fixed transition-colors shadow-sm">
<button class="p-2 text-gray-500 hover:text-primary-fixed transition-colors rounded-lg hover:bg-gray-100">
<span class="material-symbols-outlined">attach_file</span>
</button>
<input class="flex-1 bg-transparent border-none focus:ring-0 text-black font-body-md text-body-md placeholder:text-gray-400" placeholder="Escreve uma mensagem..." type="text"/>
<button class="w-10 h-10 bg-primary-fixed text-black rounded-lg flex items-center justify-center hover:opacity-90 transition-opacity">
<span class="material-symbols-outlined text-[20px]">send</span>
</button>
</div>
</div>
</main>
<!-- Mobile BottomNavBar (Hidden on lg) -->
<nav class="fixed bottom-0 w-full lg:hidden rounded-t-xl bg-white border-t border-gray-200 shadow-[0px_-4px_20px_rgba(0,0,0,0.05)] z-50 flex justify-around items-center px-4 py-2">
<!-- Inactive -->
<a class="flex flex-col items-center justify-center text-gray-500 p-2 hover:bg-gray-50 rounded-xl" href="#">
<span class="material-symbols-outlined">home</span>
<span class="font-label-sm text-label-sm mt-1">Home</span>
</a>
<!-- Active -->
<a class="flex flex-col items-center justify-center bg-primary-fixed text-black rounded-xl p-2 scale-90 duration-150" href="#">
<span class="material-symbols-outlined fill" style="font-variation-settings: 'FILL' 1;">chat_bubble</span>
<span class="font-label-sm text-label-sm mt-1 font-bold">Chat</span>
</a>
<!-- Inactive -->
<a class="flex flex-col items-center justify-center text-gray-500 p-2 hover:bg-gray-50 rounded-xl" href="#">
<span class="material-symbols-outlined">task_alt</span>
<span class="font-label-sm text-label-sm mt-1">Deliver</span>
</a>
<!-- Inactive -->
<a class="flex flex-col items-center justify-center text-gray-500 p-2 hover:bg-gray-50 rounded-xl" href="#">
<span class="material-symbols-outlined">person</span>
<span class="font-label-sm text-label-sm mt-1">Me</span>
</a>
</nav>
</body></html>
```


```

<!DOCTYPE html>

<html class="dark" lang="pt"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&amp;family=Hanken+Grotesk:wght@400;500&amp;family=JetBrains+Mono:wght@500&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-surface-variant": "#c5c9ac",
                        "on-primary-container": "#5a6b00",
                        "surface-container": "#1d2022",
                        "surface-variant": "#323537",
                        "secondary-container": "#47494e",
                        "primary-fixed-dim": "#b4d400",
                        "on-secondary-fixed-variant": "#45474b",
                        "on-primary-fixed": "#181e00",
                        "on-background": "#e0e3e5",
                        "on-tertiary-fixed": "#191c22",
                        "surface-tint": "#b4d400",
                        "surface-container-high": "#272a2c",
                        "secondary-fixed-dim": "#c6c6cc",
                        "tertiary-fixed": "#e0e2ec",
                        "on-tertiary": "#2d3038",
                        "tertiary-container": "#e0e2ec",
                        "on-primary": "#2b3400",
                        "tertiary-fixed-dim": "#c4c6d0",
                        "surface": "#101415",
                        "on-error": "#690005",
                        "primary": "#ffffff",
                        "tertiary": "#ffffff",
                        "primary-container": "#cdf200",
                        "on-secondary-container": "#b7b8be",
                        "on-secondary": "#2f3035",
                        "on-tertiary-container": "#62646c",
                        "surface-bright": "#363a3b",
                        "secondary-fixed": "#e2e2e8",
                        "outline": "#8f9378",
                        "on-tertiary-fixed-variant": "#44474e",
                        "outline-variant": "#454932",
                        "surface-container-low": "#191c1e",
                        "inverse-on-surface": "#2d3133",
                        "secondary": "#c6c6cc",
                        "on-error-container": "#ffdad6",
                        "error-container": "#93000a",
                        "background": "#101415",
                        "surface-container-lowest": "#0b0f10",
                        "inverse-primary": "#556500",
                        "primary-fixed": "#cdf200",
                        "on-secondary-fixed": "#1a1c20",
                        "on-primary-fixed-variant": "#3f4c00",
                        "on-surface": "#e0e3e5",
                        "error": "#ffb4ab",
                        "surface-dim": "#101415",
                        "inverse-surface": "#e0e3e5",
                        "surface-container-highest": "#323537"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px",
                        "modal": "24px"
                    },
                    "fontFamily": {
                        "body-lg": ["Hanken Grotesk"],
                        "label-md": ["JetBrains Mono"],
                        "headline-lg": ["Sora"],
                        "label-sm": ["JetBrains Mono"],
                        "headline-md": ["Sora"],
                        "body-md": ["Hanken Grotesk"]
                    },
                    "fontSize": {
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.05em", "fontWeight": "500"}],
                        "headline-lg": ["40px", {"lineHeight": "48px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "label-sm": ["12px", {"lineHeight": "16px", "fontWeight": "500"}],
                        "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}]
                    }
                }
            }
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .modal-shadow {
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e2e8;
            border-radius: 10px;
        }
    </style>
</head>
<body class="bg-background font-body-md text-on-background overflow-hidden">
<!-- Mock Background: Skilla Workroom -->
<div class="fixed inset-0 grid grid-cols-[280px_1fr] z-0 overflow-hidden">
<!-- Canvas -->
<main class="bg-primary-container p-10 flex flex-col gap-6 opacity-40">
<header class="flex justify-between items-center">
<div class="h-12 w-64 bg-black/10 rounded-xl"></div>
<div class="flex gap-4">
<div class="h-12 w-12 bg-black/10 rounded-full"></div>
<div class="h-12 w-32 bg-black/10 rounded-xl"></div>
</div>
</header>
<div class="grid grid-cols-3 gap-6 flex-1">
<div class="col-span-2 bg-white/20 rounded-3xl border-2 border-black/5"></div>
<div class="bg-white/20 rounded-3xl border-2 border-black/5"></div>
</div>
</main>
</div>
<!-- Modal Backdrop -->
<div class="fixed inset-0 bg-black/70 backdrop-blur-[4px] z-[60] flex items-center justify-center p-4">
<!-- Modal Container -->
<div class="bg-white text-black w-full max-w-[560px] rounded-modal border-[2px] border-black modal-shadow flex flex-col overflow-hidden animate-in fade-in zoom-in duration-300">
<!-- Header -->
<div class="px-8 pt-8 pb-6 flex justify-between items-start">
<div>
<h1 class="font-headline-md text-[26px] font-extrabold leading-tight tracking-tight">Entregar trabalho</h1>
<p class="font-body-md text-slate-500 text-sm mt-1">Envie notas e anexos para concluir a entrega.</p>
</div>
<button class="w-10 h-10 rounded-full flex items-center justify-center hover:bg-slate-100 transition-colors group">
<span class="material-symbols-outlined text-slate-900">close</span>
</button>
</div>
<!-- Modal Content Scrollable Area -->
<div class="px-8 flex-1 overflow-y-auto custom-scrollbar space-y-8 pb-8">
<!-- Delivery Notes Section -->
<div class="space-y-3">
<label class="font-label-sm uppercase tracking-[0.15em] text-slate-500 block">NOTAS DA ENTREGA (OPCIONAL)</label>
<textarea class="w-full min-h-[120px] rounded-xl border-[2px] border-black p-4 font-body-md focus:ring-0 focus:border-primary-container transition-colors placeholder:text-slate-400" placeholder="Descreva o que foi entregue, instruções de uso, credenciais de teste, próximos passos..."></textarea>
<p class="font-body-md text-slate-500 text-[13px]">Estas notas serão enviadas ao cliente.</p>
</div>
<!-- Attachments Section -->
<div class="space-y-6">
<div class="space-y-3">
<label class="font-label-sm uppercase tracking-[0.15em] text-slate-500 block">ANEXOS E/OU LINK</label>
<!-- Dropzone -->
<div class="relative group cursor-pointer">
<input class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" type="file"/>
<div class="border-[2px] border-dashed border-black rounded-2xl p-8 flex flex-col items-center justify-center text-center bg-white group-hover:bg-slate-50 transition-all">
<span class="material-symbols-outlined text-[40px] mb-3 text-slate-900" style="font-variation-settings: 'wght' 300;">upload</span>
<p class="font-headline-md text-base font-bold">Arraste ficheiros aqui ou clique para selecionar</p>
<p class="font-body-md text-slate-500 text-[13px] mt-1">PDF, ZIP, PNG, JPG (máx. 25MB)</p>
</div>
</div>
</div>
<!-- Project Link Input -->
<div class="space-y-3">
<div class="relative flex items-center">
<span class="material-symbols-outlined absolute left-4 text-slate-400">link</span>
<input class="w-full h-[56px] pl-12 pr-4 rounded-xl border-[2px] border-black font-body-md focus:ring-0 focus:border-primary-container transition-colors placeholder:text-slate-400" placeholder="Cole um link (Google Drive, GitHub, Figma...)" type="url"/>
</div>
<p class="font-body-md text-slate-500 text-[13px]">Certifique-se de que o link está acessível ao cliente.</p>
</div>
</div>
</div>
<!-- Footer -->
<div class="px-8 py-6 border-t border-slate-100 flex items-center justify-end gap-3 bg-slate-50/50">
<button class="px-6 py-3 rounded-xl border-[2px] border-black bg-white font-headline-md text-sm font-bold hover:bg-slate-50 active:scale-95 transition-all">
                    Cancelar
                </button>
<button class="px-6 py-3 rounded-xl bg-black text-primary-container font-headline-md text-sm font-bold flex items-center gap-2 hover:brightness-125 active:scale-95 transition-all">
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">check</span>
                    Confirmar entrega
                </button>
</div>
</div>
</div>
<!-- Micro-interaction Script -->
<script>
        // Placeholder for future logic like file upload handling or close animation
        document.querySelectorAll('button, input, textarea').forEach(el => {
            el.addEventListener('mousedown', () => {
                if(!el.classList.contains('active:scale-95')) {
                    el.classList.add('scale-95');
                }
            });
            el.addEventListener('mouseup', () => {
                el.classList.remove('scale-95');
            });
            el.addEventListener('mouseleave', () => {
                el.classList.remove('scale-95');
            });
        });
    </script>
</body></html>
```