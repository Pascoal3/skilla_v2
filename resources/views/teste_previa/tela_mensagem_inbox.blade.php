<!DOCTYPE html>

<html class="dark" lang="pt"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Skilla - Mensagens</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700&amp;family=JetBrains+Mono:wght@400;500;700&amp;family=Sora:wght@400;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "error-container": "#93000a",
                        "on-tertiary-fixed": "#191c22",
                        "tertiary-fixed": "#e0e2ec",
                        "secondary": "#c6c6cc",
                        "on-error": "#690005",
                        "surface-variant": "#323537",
                        "on-background": "#e0e3e5",
                        "on-secondary-fixed-variant": "#45474b",
                        "on-secondary-fixed": "#1a1c20",
                        "inverse-on-surface": "#2d3133",
                        "outline": "#8f9378",
                        "surface-bright": "#363a3b",
                        "on-primary": "#2b3400",
                        "on-primary-fixed-variant": "#3f4c00",
                        "error": "#ffb4ab",
                        "on-tertiary": "#2d3038",
                        "surface-container": "#1d2022",
                        "surface-container-lowest": "#0b0f10",
                        "on-error-container": "#ffdad6",
                        "primary": "#ffffff",
                        "on-tertiary-fixed-variant": "#44474e",
                        "surface-container-low": "#191c1e",
                        "surface-container-highest": "#323537",
                        "inverse-primary": "#556500",
                        "surface-tint": "#b4d400",
                        "surface-container-high": "#272a2c",
                        "secondary-fixed-dim": "#c6c6cc",
                        "primary-container": "#cdf200",
                        "on-secondary-container": "#b7b8be",
                        "on-primary-fixed": "#181e00",
                        "primary-fixed-dim": "#b4d400",
                        "inverse-surface": "#e0e3e5",
                        "surface": "#101415",
                        "on-surface": "#e0e3e5",
                        "on-secondary": "#2f3035",
                        "primary-fixed": "#cdf200",
                        "secondary-container": "#47494e",
                        "tertiary": "#ffffff",
                        "on-surface-variant": "#c5c9ac",
                        "secondary-fixed": "#e2e2e8",
                        "tertiary-container": "#e0e2ec",
                        "outline-variant": "#454932",
                        "background": "#101415",
                        "tertiary-fixed-dim": "#c4c6d0",
                        "on-tertiary-container": "#62646c",
                        "on-primary-container": "#5a6b00",
                        "surface-dim": "#101415"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "gutter": "24px",
                        "unit": "8px",
                        "margin-mobile": "16px",
                        "container-max": "1280px",
                        "margin-desktop": "40px"
                    },
                    "fontFamily": {
                        "label-sm": ["JetBrains Mono"],
                        "display-lg": ["Sora"],
                        "body-md": ["Hanken Grotesk"],
                        "body-lg": ["Hanken Grotesk"],
                        "label-md": ["JetBrains Mono"],
                        "headline-lg": ["Sora"],
                        "headline-md": ["Sora"],
                        "headline-lg-mobile": ["Sora"]
                    },
                    "fontSize": {
                        "label-sm": ["12px", { "lineHeight": "16px", "fontWeight": "500" }],
                        "display-lg": ["64px", { "lineHeight": "72px", "letterSpacing": "-0.04em", "fontWeight": "800" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "label-md": ["14px", { "lineHeight": "20px", "letterSpacing": "0.05em", "fontWeight": "500" }],
                        "headline-lg": ["40px", { "lineHeight": "48px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "headline-lg-mobile": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "700" }]
                    }
                }
            }
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-surface-container-lowest text-on-surface h-screen flex overflow-hidden">
<!-- Main Layout Area -->
<div class="flex-1 md:ml-64 flex flex-col h-full relative">
<!-- Main Content Canvas -->
<main class="flex-1 bg-primary-container overflow-y-auto pt-24 px-margin-mobile md:px-margin-desktop pb-12 w-full">
<div class="max-w-4xl mx-auto w-full">
<!-- Header Section -->
<div class="flex justify-between items-end mb-8">
<div>
<h2 class="text-headline-lg font-headline-lg text-surface-container-lowest tracking-tight mb-1">Mensagens</h2>
<p class="text-body-md font-body-md text-surface-container">Salas de trabalho vinculadas a contratos</p>
</div>
<div class="flex gap-3">
<button class="bg-surface-container-lowest text-primary-container p-2 rounded-lg flex items-center justify-center hover:bg-surface-container transition-colors">
<span class="material-symbols-outlined text-[20px]">more_horiz</span>
</button>
</div>
</div>
<!-- Search Input -->
<div class="mb-8 relative group">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-surface-variant group-focus-within:text-surface-container-lowest transition-colors">search</span>
<input class="w-full bg-tertiary text-on-tertiary border border-transparent focus:border-surface-container-lowest rounded-xl py-4 pl-12 pr-4 text-body-md font-body-md shadow-sm outline-none transition-all placeholder:text-surface-variant" placeholder="Pesquisar conversas" type="text"/>
</div>
<!-- Inbox List -->
<div class="flex flex-col gap-3">
<!-- Unread Item 1 -->
<div class="bg-tertiary rounded-xl p-4 flex items-center gap-4 cursor-pointer hover:shadow-md transition-all border border-transparent hover:border-surface-container-lowest group relative overflow-hidden">
<div class="absolute left-0 top-0 bottom-0 w-1 bg-surface-container-lowest"></div>
<img class="w-12 h-12 rounded-full object-cover bg-secondary" data-alt="A professional headshot of a graphic designer smiling in a bright, modern studio space. High-key lighting, vibrant colors." src="https://lh3.googleusercontent.com/aida-public/AB6AXuB8IpAPjEGC61SjgTvvLluR4_zqfrAtVfAG1nLoA4Zfx42cFBApbVfnCNatWg3ZgQ0Jy8EishspWdM6L54qGXtImKfZ4cAZgqNARagAMjsXuDzjs5s0UknIkMd8YEcZitS42-zQT0iImQOmju6A4mMNUhZxtlKyVqIeamyLUd4xbTGqpD0JfTOLgJkG8RytvVO78wDhUJ2DQZRZFdKCi8T25VinDqtC4RvyqDfOm2dKaKtGUraovX8BShqlw66lqyfhBMTq7PA27tw"/>
<div class="flex-1 min-w-0">
<h3 class="text-body-lg font-body-lg font-bold text-on-tertiary truncate">Sala de trabalho — Logo Skilla</h3>
<p class="text-body-md font-body-md text-surface-variant truncate font-semibold">Enviei as primeiras opções do logotipo. Pode validar?</p>
</div>
<div class="flex flex-col items-end gap-1 shrink-0">
<span class="text-label-sm font-label-sm text-surface-container-lowest font-bold">12:45</span>
<span class="bg-surface-container-lowest text-primary-container text-label-sm font-label-sm rounded-full px-2 py-0.5 min-w-[24px] text-center">3</span>
</div>
</div>
<!-- Unread Item 2 -->
<div class="bg-tertiary rounded-xl p-4 flex items-center gap-4 cursor-pointer hover:shadow-md transition-all border border-transparent hover:border-surface-container-lowest group relative overflow-hidden">
<div class="absolute left-0 top-0 bottom-0 w-1 bg-surface-container-lowest"></div>
<div class="w-12 h-12 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container shrink-0">
<span class="material-symbols-outlined">storefront</span>
</div>
<div class="flex-1 min-w-0">
<h3 class="text-body-lg font-body-lg font-bold text-on-tertiary truncate">Website para Restaurante</h3>
<p class="text-body-md font-body-md text-surface-variant truncate font-semibold">Os arquivos do Figma foram atualizados com as novas fotos.</p>
</div>
<div class="flex flex-col items-end gap-1 shrink-0">
<span class="text-label-sm font-label-sm text-surface-container-lowest font-bold">09:30</span>
<span class="bg-surface-container-lowest text-primary-container text-label-sm font-label-sm rounded-full px-2 py-0.5 min-w-[24px] text-center">1</span>
</div>
</div>
<!-- Read Item 1 -->
<div class="bg-tertiary rounded-xl p-4 flex items-center gap-4 cursor-pointer hover:shadow-md transition-all border border-transparent hover:border-surface-container-lowest group">
<img class="w-12 h-12 rounded-full object-cover bg-secondary" data-alt="A portrait of a creative director in a stylish office, warm lighting, approachable demeanor." src="https://lh3.googleusercontent.com/aida-public/AB6AXuD9p5NtQ7f1wLUB5hoOGxrkk54JWkNOfzMOuEnGvgLaR7mdRj6Gb1K6xhI5rUri7CGqnrkPi8fS2eqGVhRGW5BLPQcBFh7VLnFGgK_w3_I78Tf_Qrk63_0Kz-MQMDu1XDzIUn32k7tsQuVVbKOBj9lDaI0bq3uQnk5MzDQYDFEVAtRCgfiolFx9NZPS7kATHEoODg-qEOBcyRhgX4vjp9VLNnFcSHuZL4cF77YCcaNMW_Bq-QbYaTbaCtUjBhkfpq6qPzAMoRLgo5M"/>
<div class="flex-1 min-w-0">
<h3 class="text-body-lg font-body-lg text-on-tertiary truncate">Identidade Visual Barber Shop</h3>
<p class="text-body-md font-body-md text-surface-variant truncate">Tudo certo. O pagamento da primeira parcela foi liberado.</p>
</div>
<div class="flex flex-col items-end gap-1 shrink-0">
<span class="text-label-sm font-label-sm text-surface-variant">Ontem</span>
</div>
</div>
<!-- Read Item 2 -->
<div class="bg-tertiary rounded-xl p-4 flex items-center gap-4 cursor-pointer hover:shadow-md transition-all border border-transparent hover:border-surface-container-lowest group">
<div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container shrink-0">
<span class="material-symbols-outlined">smartphone</span>
</div>
<div class="flex-1 min-w-0">
<h3 class="text-body-lg font-body-lg text-on-tertiary truncate">Landing Page para App</h3>
<p class="text-body-md font-body-md text-surface-variant truncate">Perfeito, aguardo os próximos passos.</p>
</div>
<div class="flex flex-col items-end gap-1 shrink-0">
<span class="text-label-sm font-label-sm text-surface-variant">Segunda</span>
</div>
</div>
<!-- Read Item 3 -->
<div class="bg-tertiary rounded-xl p-4 flex items-center gap-4 cursor-pointer hover:shadow-md transition-all border border-transparent hover:border-surface-container-lowest group">
<div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container shrink-0">
<span class="material-symbols-outlined">shopping_cart</span>
</div>
<div class="flex-1 min-w-0">
<h3 class="text-body-lg font-body-lg text-on-tertiary truncate">E-commerce Simples</h3>
<p class="text-body-md font-body-md text-surface-variant truncate">Projeto finalizado e arquivado.</p>
</div>
<div class="flex flex-col items-end gap-1 shrink-0">
<span class="text-label-sm font-label-sm text-surface-variant">12 Mar</span>
</div>
</div>
</div>
</div>
</main>
</div>
</body></html>