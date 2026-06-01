<!DOCTYPE html>

<html class="light" lang="pt-BR"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Skilla - Onboarding</title>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@700&family=Inter:wght@400;600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<!-- Tailwind -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                "on-error": "#690005",
                "on-primary-fixed-variant": "#3e4c00",
                "primary-fixed-dim": "#b0d500",
                "on-secondary-container": "#cdd7ff",
                "outline-variant": "#454933",
                "on-background": "#000033",
                "surface-container": "#1e2114",
                "on-secondary-fixed": "#00174b",
                "tertiary-fixed-dim": "#c0c6db",
                "surface-variant": "#333628",
                "surface-container-low": "#1a1d10",
                "primary-fixed": "#caf216",
                "surface-container-lowest": "#0d0f05",
                "surface": "#121509",
                "on-surface": "#000033",
                "secondary-fixed-dim": "#b4c5ff",
                "surface-container-highest": "#333628",
                "error": "#ffb4ab",
                "on-tertiary-container": "#5d6476",
                "inverse-on-surface": "#2f3224",
                "on-primary-fixed": "#171e00",
                "on-tertiary": "#293040",
                "secondary": "#2563EB",
                "surface-tint": "#b0d500",
                "background": "#D9FF00",
                "tertiary-fixed": "#dce2f7",
                "on-error-container": "#ffdad6",
                "inverse-surface": "#e3e4d0",
                "on-primary": "#2a3400",
                "on-tertiary-fixed": "#141b2b",
                "outline": "#8f9379",
                "on-surface-variant": "#000033",
                "error-container": "#93000a",
                "secondary-fixed": "#dbe1ff",
                "on-secondary-fixed-variant": "#003ea8",
                "on-secondary": "#002a78",
                "surface-container-high": "#292b1e",
                "primary-container": "#caf216",
                "on-primary-container": "#586c00",
                "tertiary": "#ffffff",
                "tertiary-container": "#dce2f7",
                "surface-bright": "#383b2c",
                "primary": "#0A0A0A",
                "inverse-primary": "#536600",
                "secondary-container": "#2563EB",
                "surface-dim": "#121509",
                "on-tertiary-fixed-variant": "#404758",
                "brand-navy": "#0A0A0A",
                "brand-royal": "#2563EB",
                "neon-yellow": "#D9FF00"
            },
            "borderRadius": {
                "DEFAULT": "1rem",
                "lg": "2rem",
                "xl": "3rem",
                "full": "9999px"
            },
            "spacing": {
                "grid-gutter": "20px",
                "base": "8px",
                "section-gap": "120px",
                "container-padding": "24px",
                "card-padding": "32px"
            },
            "fontFamily": {
                "label-caps": ["Space Grotesk"],
                "h1": ["Space Grotesk"],
                "body-md": ["Inter"],
                "h2": ["Space Grotesk"],
                "body-lg": ["Inter"],
                "h3": ["Space Grotesk"]
            }
          },
        },
      }
</script>
<style>
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css");
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .premium-shadow {
            box-shadow: 0 10px 30px -5px rgba(0, 0, 51, 0.1);
        }
        .premium-shadow-hover:hover {
            box-shadow: 0 20px 40px -10px rgba(0, 0, 51, 0.15);
            transform: translateY(-4px);
        }
        .btn-glow:hover {
            box-shadow: 0 0 20px rgba(37, 99, 235, 0.4);
        }
        i{
            color: black;
        }
        #logo_plataforma{
            width: 80px;
            height: 80px;
        }
</style>
</head>
<body class="bg-background min-h-screen flex flex-col font-body-md text-on-surface antialiased">
<!-- Navbar -->
<nav class="flex justify-between items-center w-full px-8 md:px-16 py-5 bg-brand-navy fixed top-0 z-50">
<img id="logo_plataforma" src="{{asset('img/logo_skilla8-removebg-preview.png')}}" alt="">

<div class="hidden md:flex gap-10 items-center">
<a class="text-white/90 hover:text-brand-royal transition-colors duration-300 font-semibold" href="#">Trabalhos</a>
<a class="text-white/90 hover:text-brand-royal transition-colors duration-300 font-semibold" href="#">Talentos</a>
<button class="bg-brand-royal text-white px-8 py-2.5 rounded-full font-bold hover:brightness-110 transition-all duration-300">
            Começar
        </button>
</div>
</nav>
<!-- Main Content Canvas -->
<main class="flex-grow flex flex-col items-center justify-center pt-40 pb-24 px-6">
<div class="max-w-4xl w-full text-center">
<!-- Hero Section -->
<section class="mb-12">
<h1 class="font-h1 text-5xl md:text-7xl text-brand-navy mb-6 tracking-tight leading-[1.1]">
                Vamos configurar sua conta
            </h1>
<p class="font-body-lg text-lg md:text-xl text-brand-navy/80 max-w-2xl mx-auto">
                O que você pretende fazer principalmente no Skilla? Escolha o perfil que melhor se adapta aos seus objetivos hoje.
            </p>
</section>
<!-- Selection Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full mb-16">
<!-- Card 1: Employer -->
<button class="group relative flex items-center justify-between p-10 bg-white border-2 border-transparent rounded-2xl premium-shadow premium-shadow-hover transition-all duration-500 text-left hover:border-brand-royal" data-role="client" id="btn-card1">
<div id="card1" class="flex flex-col gap-3 pr-4">
<span class="font-h3 text-2xl text-brand-navy group-hover:text-brand-royal transition-colors" data-title>Publicar vagas e contratar</span>
<p class="font-body-md text-brand-navy/60 leading-relaxed">Procure talentos globais e gerencie seus projetos com facilidade.</p>
</div>
<div id="div_icone1" class="flex-shrink-0 w-20 h-20 bg-neon-yellow rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
<span class="material-symbols-outlined text-brand-navy text-4xl" style="font-variation-settings: 'FILL' 1;"><i class="bi bi-briefcase-fill"></i></span>
</div>
<!-- Selection Indicator -->
<div class="absolute top-6 right-6 w-7 h-7 border-2 border-brand-navy/20 rounded-full group-hover:border-brand-royal flex items-center justify-center transition-all">
<div class="w-3.5 h-3.5 bg-brand-royal rounded-full opacity-0" data-indicator="dot"></div>
</div>
</button>
<!-- Card 2: Professional -->
<button class="group relative flex items-center justify-between p-10 bg-white border-2 border-transparent rounded-2xl premium-shadow premium-shadow-hover transition-all duration-500 text-left hover:border-brand-royal" data-role="freelancer" id="btn-card2">
<div id="card2" class="flex flex-col gap-3 pr-4">
<span class="font-h3 text-2xl text-brand-navy group-hover:text-brand-royal transition-colors" data-title>Trabalhar e ser pago</span>
<p class="font-body-md text-brand-navy/60 leading-relaxed">Encontre oportunidades exclusivas e desenvolva sua carreira digital.</p>
</div>
<div id="div_icone2" class="flex-shrink-0 w-20 h-20 bg-neon-yellow rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
<span class="material-symbols-outlined text-brand-navy text-4xl" style="font-variation-settings: 'FILL' 1;"><i class="bi bi-cash-coin"></i></span>
</div>
<!-- Selection Indicator -->
<div class="absolute top-6 right-6 w-7 h-7 border-2 border-brand-navy/20 rounded-full group-hover:border-brand-royal flex items-center justify-center transition-all">
<div class="w-3.5 h-3.5 bg-brand-royal rounded-full opacity-0" data-indicator="dot"></div>
</div>
</button>
</div>
<p id="aviso-selecao" class="text-red-500 text-sm text-center hidden mt-2">
     Por favor, selecione uma opção antes de continuar.
</p>
<input type="hidden" id="selected-role" name="role" value="">
<!-- Primary Action -->
<div class="flex flex-col items-center gap-6">
<!-- Primary Action -->
<div class="flex flex-col items-center gap-6">
    <a id="btn-criar-conta" 
       class="w-full md:w-auto min-w-[340px] bg-brand-navy text-white px-14 py-5 rounded-full font-h3 text-lg btn-glow hover:scale-[1.02] transition-all duration-300 premium-shadow opacity-50 pointer-events-none cursor-not-allowed flex items-center justify-center" 
       href="javascript:void(0)">
        Criar minha conta
    </a>
    <!-- ... resto do link de login ... -->
</div>
<div class="font-body-md text-brand-navy/70">
                Já tem uma conta? 
                <a class="text-brand-royal font-bold hover:underline underline-offset-4 transition-all" href="#">Entrar</a>
</div>
</div>
</div>
</main>
<!-- Footer -->
<footer class="w-full px-8 md:px-16 py-12 flex flex-col md:flex-row justify-between items-center gap-6 bg-[#F8F8F8] border-t border-brand-navy/5">
<div class="font-h2 text-2xl text-brand-navy font-bold">Skilla</div>
<div class="flex gap-8">
<a class="font-body-md text-brand-navy/60 hover:text-brand-navy transition-all duration-300" href="#">Termos</a>
<a class="font-body-md text-brand-navy/60 hover:text-brand-navy transition-all duration-300" href="#">Privacidade</a>
<a class="font-body-md text-brand-navy/60 hover:text-brand-navy transition-all duration-300" href="#">Suporte</a>
</div>
<div class="font-body-md text-sm text-brand-navy/40">
        © 2026 Skilla. Creative Digital Excellence.
    </div>
</footer>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const cards = document.querySelectorAll('[data-role]');
  const btnCriarConta = document.getElementById('btn-criar-conta');
  const avisoSelecao = document.getElementById('aviso-selecao');
  const hiddenInput = document.getElementById('selected-role');

  const routes = {
    'client': "{{ route('registar.cliente') }}",
    'freelancer': "{{ route('registar.freela') }}"
  };

  cards.forEach(card => {
    card.addEventListener('click', function() {
      // Limpar seleções anteriores
      cards.forEach(c => {
        c.classList.remove('border-brand-royal');
        c.classList.add('border-transparent');
        c.querySelector('[data-indicator="dot"]')?.classList.add('opacity-0');
        c.querySelector('.flex-shrink-0')?.classList.remove('scale-110');
        const t = c.querySelector('[data-title]');
        if (t) { t.classList.remove('text-brand-royal'); t.classList.add('text-brand-navy'); }
      });

      // Aplicar seleção atual
      this.classList.remove('border-transparent');
      this.classList.add('border-brand-royal');
      this.querySelector('[data-indicator="dot"]')?.classList.remove('opacity-0');
      this.querySelector('.flex-shrink-0')?.classList.add('scale-110');
      const title = this.querySelector('[data-title]');
      if (title) { title.classList.remove('text-brand-navy'); title.classList.add('text-brand-royal'); }

      // Atualizar Input e Botão
      const role = this.dataset.role;
      hiddenInput.value = role;
      
      if (btnCriarConta) {
        btnCriarConta.href = routes[role]; // Define o link real
        btnCriarConta.classList.remove('opacity-50', 'pointer-events-none', 'cursor-not-allowed');
      }

      avisoSelecao?.classList.add('hidden');
    });
  });

  // Validação extra ao clicar
  btnCriarConta.addEventListener('click', function(e) {
    if (!hiddenInput.value) {
      e.preventDefault();
      avisoSelecao?.classList.remove('hidden');
    }
  });
});
</script>
</body>


</html>
