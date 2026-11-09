(() => {
  const STATUS_META = {
    em_revisao: { label: 'Em revisão', dot: '#D97706' },
    em_andamento: { label: 'Em andamento', dot: '#16A34A' },
    em_disputa: { label: 'Em disputa', dot: '#DC2626', strong: true },
    concluido: { label: 'Concluído', dot: '#A8A29E' },
    arquivado: { label: 'Arquivado', dot: '#78716C' },
  };

  function getInitials(nome) {
    if (!nome) return '??';
    const partes = nome.trim().split(/\s+/);
    if (partes.length === 1) return partes[0].slice(0, 2).toUpperCase();
    return (partes[0][0] + partes[partes.length - 1][0]).toUpperCase();
  }

  function formatKz(value) {
    if (value == null) return '—';
    const num = Number(value);
    if (isNaN(num)) return '—';
    return num.toLocaleString('pt-AO', { minimumFractionDigits: 0, maximumFractionDigits: 0 }) + ' Kz';
  }

  function formatTempo(dateString) {
    if (!dateString) return '';
    const date = new Date(dateString);
    if (isNaN(date.getTime())) return '';
    const today = new Date();
    const yesterday = new Date(today);
    yesterday.setDate(yesterday.getDate() - 1);

    const isToday = date.getDate() === today.getDate() &&
      date.getMonth() === today.getMonth() &&
      date.getFullYear() === today.getFullYear();

    const isYesterday = date.getDate() === yesterday.getDate() &&
      date.getMonth() === yesterday.getMonth() &&
      date.getFullYear() === yesterday.getFullYear();

    if (isToday) {
      return date.toLocaleTimeString('pt-PT', { hour: '2-digit', minute: '2-digit', hour12: false });
    }
    if (isYesterday) return 'Ontem';

    const anteontem = new Date(yesterday);
    anteontem.setDate(anteontem.getDate() - 1);
    const isAnteontem = date.getDate() === anteontem.getDate() &&
      date.getMonth() === anteontem.getMonth() &&
      date.getFullYear() === anteontem.getFullYear();

    if (isAnteontem) return 'Anteontem';

    return date.toLocaleDateString('pt-PT', { day: '2-digit', month: '2-digit' }).replace(/\//g, ' ');
  }

  function debounce(fn, ms) {
    let t;
    return (...args) => {
      clearTimeout(t);
      t = setTimeout(() => fn(...args), ms);
    };
  }

  function escapeHtml(s) {
    return String(s)
      .replaceAll('&', '&')
      .replaceAll('<', '<')
      .replaceAll('>', '>')
      .replaceAll('"', '"')
      .replaceAll("'", '&#039;');
  }

  const MOCK_CONVERSAS = [
    {
      id: 'conv-1',
      titulo: 'Sala de trabalho — Logo Skilla',
      nomeOutraParte: 'Nelson Cardoso',
      role: 'Freelancer',
      preview: 'Enviei as primeiras opções do logótipo. Podes validar?',
      isMine: false,
      status: 'em_revisao',
      escrowValor: 150000,
      updatedAt: new Date(Date.now() - 1000 * 60 * 30).toISOString(),
      unread: 3,
    },
    {
      id: 'conv-2',
      titulo: 'Website para Restaurante',
      nomeOutraParte: 'Ana Kiala',
      role: 'Freelancer',
      preview: 'Os ficheiros do Figma foram atualizados com as novas fotos.',
      isMine: false,
      status: 'em_andamento',
      escrowValor: 320000,
      updatedAt: new Date(Date.now() - 1000 * 60 * 60 * 3).toISOString(),
      unread: 1,
    },
    {
      id: 'conv-3',
      titulo: 'Identidade Visual Barber Shop',
      nomeOutraParte: 'Mário Fernandes',
      role: 'Cliente',
      preview: 'Tudo certo. O pagamento da primeira parcela foi libertado.',
      isMine: true,
      status: 'em_andamento',
      escrowValor: 85000,
      updatedAt: new Date(Date.now() - 1000 * 60 * 60 * 24).toISOString(),
      unread: 0,
    },
    {
      id: 'conv-4',
      titulo: 'Landing Page para App',
      nomeOutraParte: 'Beatriz Santos',
      role: 'Freelancer',
      preview: 'Perfeito, aguardo os próximos passos.',
      isMine: false,
      status: 'em_disputa',
      escrowValor: 210000,
      updatedAt: new Date(Date.now() - 1000 * 60 * 60 * 24 * 2).toISOString(),
      unread: 0,
    },
    {
      id: 'conv-5',
      titulo: 'E-commerce Simples',
      nomeOutraParte: 'Paulo Manuel',
      role: 'Cliente',
      preview: 'Projeto finalizado e arquivado.',
      isMine: false,
      status: 'concluido',
      escrowValor: null,
      updatedAt: new Date(Date.now() - 1000 * 60 * 60 * 24 * 10).toISOString(),
      unread: 0,
    },
  ];

  let state = {
    conversas: [],
    filtered: [],
    activeTab: 'todas',
    query: '',
  };

  let elements = {};

  function fetchConversas() {
    return new Promise((resolve) => {
      setTimeout(() => resolve(MOCK_CONVERSAS), 50);
    });
  }

  function getTabKey(conversa) {
    if (conversa.unread > 0) return 'nao_lidas';
    if (conversa.status === 'em_disputa') return 'disputa';
    if (conversa.status === 'em_andamento' || conversa.status === 'em_revisao') return 'ativas';
    if (conversa.status === 'concluido' || conversa.status === 'arquivado') return 'arquivadas';
    return 'todas';
  }

  function applyFilters() {
    let list = state.conversas;

    if (state.activeTab !== 'todas') {
      list = list.filter(c => getTabKey(c) === state.activeTab);
    }

    if (state.query) {
      const q = state.query.toLowerCase().trim();
      list = list.filter(c =>
        c.titulo.toLowerCase().includes(q) ||
        c.nomeOutraParte.toLowerCase().includes(q) ||
        c.preview.toLowerCase().includes(q)
      );
    }

    state.filtered = list;
    renderConversas(list);
    renderTabsCount();
  }

  function renderTabsCount() {
    const counts = {
      todas: state.conversas.length,
      nao_lidas: state.conversas.filter(c => c.unread > 0).length,
      ativas: state.conversas.filter(c => c.status === 'em_andamento' || c.status === 'em_revisao').length,
      disputa: state.conversas.filter(c => c.status === 'em_disputa').length,
      arquivadas: state.conversas.filter(c => c.status === 'concluido' || c.status === 'arquivado').length,
    };

    Object.entries(counts).forEach(([tab, count]) => {
      const badge = elements.tabsContainer?.querySelector(`[data-tab="${tab}"] .tab-count`);
      if (badge) {
        badge.textContent = count;
        badge.style.display = count > 0 ? 'inline-flex' : 'none';
      }
    });
  }

  function renderConversas(list) {
    const container = elements.list;
    const empty = elements.empty;

    if (!container) return;

    if (list.length === 0) {
      container.innerHTML = '';
      if (empty) empty.classList.remove('hidden');
      return;
    }

    if (empty) empty.classList.add('hidden');

    container.innerHTML = list.map(c => renderRow(c)).join('');

    container.querySelectorAll('.msg-row').forEach(row => {
      row.addEventListener('click', () => {
        const id = row.dataset.conversaId;
        sessionStorage.setItem('openConversaId', id);
        if (window.render) window.render('mensagens_sala');
      });
      row.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          row.click();
        }
      });
    });
  }

  function renderRow(c) {
    const meta = STATUS_META[c.status] || STATUS_META.em_andamento;
    const tempo = formatTempo(c.updatedAt);
    const escrowHtml = renderEscrow(c.escrowValor);
    const initials = getInitials(c.nomeOutraParte);
    const isUnread = c.unread > 0;
    const previewHtml = c.isMine
      ? `<span class="font-medium text-[#78716C]">Tu:</span> ${escapeHtml(c.preview)}`
      : escapeHtml(c.preview);

    return `
      <div class="msg-row flex flex-col md:flex-row md:items-center md:h-[72px] px-4 py-3.5 md:py-0 gap-2 md:gap-0 bg-white hover:bg-[#FAFAF9] transition-colors cursor-pointer border-0"
           data-conversa-id="${escapeHtml(c.id)}"
           tabindex="0"
           role="button"
           aria-label="${escapeHtml(c.titulo)}">
        <!-- Bloco A: Avatar + Título + Nome·Role (+ Tempo mobile) -->
        <div class="w-[320px] shrink-0 flex items-center pr-4 min-w-0 border-0">
          <div class="w-10 h-10 rounded-lg bg-[#F0EFED] text-[#44403C] text-[13px] font-semibold flex items-center justify-center shrink-0 mr-3 border-0">
            ${escapeHtml(initials)}
          </div>
          <div class="min-w-0 flex-1 border-0">
            <h2 class="text-[15px] font-semibold text-[#0A0A0A] truncate md:mb-0.5 border-0">${escapeHtml(c.titulo)}</h2>
            <p class="text-[13px] text-[#78716C] truncate mt-0.5 md:mt-0 border-0">
              ${escapeHtml(c.nomeOutraParte)} <span class="text-[#D6D3D1] mx-0.5 border-0">•</span> ${escapeHtml(c.role)}
            </p>
            <span class="md:hidden text-[12px] text-[#A8A29E] tabular-nums font-medium border-0">${escapeHtml(tempo)}</span>
          </div>
        </div>

        <!-- Bloco B: Preview (flex-1) -->
        <div class="pl-[52px] md:pl-0 md:flex-1 md:pr-6 truncate flex-1 min-w-0 border-0">
          <p class="text-[14px] text-[#44403C] truncate border-0">${previewHtml}</p>
        </div>

        <!-- Bloco C: Meta (Status + Escrow + Tempo desktop + Badge) -->
        <div class="pl-[52px] md:pl-0 flex items-center justify-between md:justify-start w-full md:w-auto flex-wrap gap-3 md:gap-0 border-0">
          <!-- Status -->
          <div class="w-[140px] shrink-0 flex items-center gap-2 md:w-[140px] border-0">
            <span class="w-1.5 h-1.5 rounded-full shrink-0 border-0" style="background:${meta.dot}"></span>
            <span class="text-[13px] font-medium text-[#44403C] ${meta.strong ? 'font-semibold text-[#B42318]' : ''} border-0">
              ${escapeHtml(meta.label)}
            </span>
          </div>

          <!-- Escrow -->
          <div class="w-[140px] shrink-0 text-right whitespace-nowrap md:w-[140px] flex flex-col items-end md:items-end border-0">
            ${escrowHtml}
          </div>

          <!-- Atividade: Tempo desktop + Badge -->
          <div class="w-[96px] shrink-0 flex items-center justify-end gap-2 hidden md:flex md:w-[96px] border-0">
            <span class="text-[12px] font-medium text-[#0A0A0A] tabular-nums whitespace-nowrap border-0">${escapeHtml(tempo)}</span>
            ${isUnread ? `
              <span class="inline-flex items-center justify-center min-w-[20px] h-[20px] px-1.5 rounded-[6px] bg-[#0A0A0A] text-[#D4FF00] text-[12px] font-semibold leading-none border-0">
                ${c.unread}
              </span>
            ` : ''}
          </div>
        </div>
      </div>
    `;
  }

  function renderEscrow(valor) {
    if (valor == null || valor === 0) {
      return `<span class="text-[14px] font-normal text-[#D6D3D1] border-0">—</span>`;
    }
    return `
      <div class="inline-flex items-center justify-end gap-1 text-[12px] text-[#A8A29E] w-full border-0">
        <svg class="w-3.5 h-3.5 flex-shrink-0 border-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
          <rect height="11" rx="2" ry="2" width="18" x="3" y="11"></rect>
          <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
        </svg>
        <span class="border-0">Em escrow</span>
      </div>
      <div class="text-[14px] font-semibold text-[#0A0A0A] tabular-nums mt-0.5 w-full text-right border-0">
        ${formatKz(valor)}
      </div>
    `;
  }

  function initSearch() {
    const input = elements.searchInput;
    const clearBtn = elements.searchClear;
    if (!input) return;

    const handleInput = debounce(() => {
      state.query = input.value;
      applyFilters();
      clearBtn?.classList.toggle('hidden', !input.value);
    }, 200);

    input.addEventListener('input', handleInput);

    clearBtn?.addEventListener('click', () => {
      input.value = '';
      state.query = '';
      applyFilters();
      clearBtn.classList.add('hidden');
      input.focus();
    });
  }

  function initTabs() {
    const tabs = elements.tabsContainer?.querySelectorAll('[data-tab]');
    if (!tabs) return;

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        tabs.forEach(t => {
          t.classList.remove('border-b-2', 'border-[#0A0A0A]', 'text-[#0A0A0A]', 'font-semibold');
          t.classList.add('text-[#78716C]', 'font-medium');
        });
        tab.classList.add('border-b-2', 'border-[#0A0A0A]', 'text-[#0A0A0A]', 'font-semibold');
        tab.classList.remove('text-[#78716C]', 'font-medium');
        state.activeTab = tab.dataset.tab;
        applyFilters();
      });
    });
  }

  function init(container) {
    elements = {
      container,
      searchInput: container.querySelector('#msgSearch'),
      searchClear: container.querySelector('#msgSearchClear'),
      tabsContainer: container.querySelector('#msgTabs'),
      list: container.querySelector('#msgList'),
      empty: container.querySelector('#msgEmpty'),
    };

    state = { ...state, activeTab: 'todas', query: '' };

    fetchConversas().then(conversas => {
      state.conversas = conversas;
      applyFilters();
    });

    initSearch();
    initTabs();
  }

  window.MensagensInbox = { init };
})();