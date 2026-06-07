<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Skilla</title>
</head>

<body class="min-h-screen">

  <!-- SideNavBar -->
  <nav class="hidden md:flex fixed left-0 top-0 h-full w-[280px] flex-col p-6 bg-primary-container dark:bg-primary-container z-50">
    <div class="mb-8 flex items-center gap-4">
      <span class="material-symbols-outlined text-secondary-container text-4xl" data-weight="fill" style="font-variation-settings: 'FILL' 1;">widgets</span>
      <div>
        <h1 class="font-display-lg text-headline-md font-black text-secondary dark:text-secondary m-0 leading-none">SKILLA</h1>
        <p class="font-label-sm text-label-sm text-on-primary-container">Plataforma de Freelance</p>
      </div>
    </div>

    <div class="flex-1 space-y-2">
      <a data-spa-link data-route="inicio"
         class="flex items-center gap-3 bg-[#CCFF00] text-black-pure rounded-lg px-4 py-3 font-bold transition-all"
         href="#inicio">
        <span class="material-symbols-outlined">home</span>
        <span class="font-label-md text-label-md">Início</span>
      </a>

      <a data-spa-link data-route="trabalhos"
         class="flex items-center gap-3 text-on-primary-container hover:text-secondary px-4 py-3 transition-colors"
         href="#trabalhos">
        <span class="material-symbols-outlined">work</span>
        <span class="font-label-md text-label-md">Trabalhos</span>
      </a>

      <a data-spa-link data-route="propostas"
         class="flex items-center gap-3 text-on-primary-container hover:text-secondary px-4 py-3 transition-colors"
         href="#propostas">
        <span class="material-symbols-outlined">description</span>
        <span class="font-label-md text-label-md">Propostas</span>
      </a>

      <a data-spa-link data-route="mensagens"
         class="flex items-center gap-3 text-on-primary-container hover:text-secondary px-4 py-3 transition-colors"
         href="#mensagens">
        <span class="material-symbols-outlined">chat</span>
        <span class="font-label-md text-label-md">Mensagens</span>
      </a>

      <a data-spa-link data-route="carteira"
         class="flex items-center gap-3 text-on-primary-container hover:text-secondary px-4 py-3 transition-colors"
         href="#carteira">
        <span class="material-symbols-outlined">account_balance_wallet</span>
        <span class="font-label-md text-label-md">Carteira</span>
      </a>

      <a data-spa-link data-route="perfil"
         class="flex items-center gap-3 text-on-primary-container hover:text-secondary px-4 py-3 transition-colors"
         href="#perfil">
        <span class="material-symbols-outlined">person</span>
        <span class="font-label-md text-label-md">Perfil</span>
      </a>

      <a data-spa-link data-route="definicoes"
         class="flex items-center gap-3 text-on-primary-container hover:text-secondary px-4 py-3 transition-colors"
         href="#definicoes">
        <span class="material-symbols-outlined">settings</span>
        <span class="font-label-md text-label-md">Definições</span>
      </a>
    </div>

    <div class="mt-auto pt-6">
      <button class="w-full font-label-md text-label-md py-3 rounded-lg font-bold hover:bg-secondary-fixed-dim transition-colors scale-98 active:scale-95 bg-[#CCFF00] text-black-pure">
        Comprar Créditos
      </button>

      <div class="flex flex-col gap-2 mt-4 px-2">
        <a class="flex items-center gap-2 text-on-primary-container hover:text-secondary text-sm transition-colors" href="#">
          <span class="material-symbols-outlined text-[18px]">help_outline</span> Ajuda
        </a>
        <a class="flex items-center gap-2 text-on-primary-container hover:text-secondary text-sm transition-colors" href="#" onclick="logout(event)">
          <span class="material-symbols-outlined text-[18px]">logout</span> Terminar Sessão
        </a>
      </div>
    </div>
  </nav>

  <!-- SPA View -->
  <main id="spaView" class="min-h-screen md:ml-[280px]"></main>

  <script>
    // =========================
    // BASE
    // =========================
    window.templates = window.templates || {};
    const templates = window.templates;
    const spaView = document.getElementById('spaView');

    function getRouteFromHash() {
      const raw = (location.hash || '#inicio').slice(1);
      return raw || 'inicio';
    }

    // =========================
    // ACTIVE STATE DO MENU
    // =========================
    function setActiveLink(activeRoute) {
      document.querySelectorAll('a[data-spa-link][data-route]').forEach(a => {
        const isActive = a.dataset.route === activeRoute;

        a.classList.remove('bg-[#CCFF00]', 'text-black-pure', 'rounded-lg', 'font-bold');
        a.classList.remove('text-on-primary-container');

        if (isActive) {
          a.classList.add('bg-[#CCFF00]', 'text-black-pure', 'rounded-lg', 'font-bold');
        } else {
          a.classList.add('text-on-primary-container');
        }
      });
    }

    // =========================
    // TITULOS (EDITA AQUI)
    // =========================
    function updateTitle(route) {
      if (route === 'carteira_comprar_creditos') {
        document.title = 'Skilla - Comprar Créditos';
      } else if (route === 'carteira_extrato_creditos') {
        document.title = 'Skilla - Extrato de Créditos';
      } else if (route === 'trabalhos') {
        document.title = 'Skilla - Trabalhos';
      } else if (route === 'propostas') {
        document.title = 'Skilla - Propostas';
      } else if (route === 'mensagens') {
        document.title = 'Skilla - Mensagens';
      } else {
        document.title = 'Skilla';
      }
    }

    // =========================
    // RENDER (HASH-BASED)
    // =========================
    function render(route, push = true, opts = {}) {
      if (!templates[route]) route = 'inicio';

      spaView.innerHTML = templates[route];

      const activeMenuRoute = opts.activeMenuRoute || route;
      setActiveLink(activeMenuRoute);

      updateTitle(route);

      if (push) {
        // garante hash correto
        if (location.hash !== '#' + route) location.hash = route;
      }
    }

    // =========================
    // NAVEGAÇÃO (DELEGAÇÃO)
    // =========================
    document.addEventListener('click', (e) => {
      const a = e.target.closest('a[data-spa-link][data-route]');
      if (!a) return;

      e.preventDefault();
      const route = a.dataset.route;

      render(route, true, { activeMenuRoute: route });
    });

    // =========================
    // BACK/FORWARD E DIGITAR HASH
    // =========================
    window.addEventListener('hashchange', () => {
      render(getRouteFromHash(), false, {});
    });

    // =========================
    // TEMPLATES (COLA AQUI)
    // =========================
    // Exemplo:
    // templates.inicio = `<div>...</div>`;
    // templates.trabalhos = `...`;
    // templates.propostas = `...`;
    // templates.trabalho_detalhe = `...`;
    //
    // >>>> COLE TODOS OS SEUS templates.xxx = `...`; AQUI <<<<

    // =========================
    // INICIAL
    // =========================
    render(getRouteFromHash(), false, {});
  </script>
</body>
</html>