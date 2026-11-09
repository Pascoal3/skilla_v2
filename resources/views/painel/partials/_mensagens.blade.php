<div id="view-mensagens" class="flex min-h-screen bg-[#D4FF00]">
  <div class="w-full max-w-[1100px] mx-auto px-margin-mobile md:px-margin-desktop pb-10 pt-6">
    <!-- Header Section -->
    <div class="flex justify-between items-start mb-4">
      <div>
        <h2 class="text-headline-lg font-headline-lg text-surface-container-lowest tracking-tight mb-1">Mensagens</h2>
        <p class="text-body-md font-body-md text-surface-container">Salas de trabalho vinculadas a contratos</p>
      </div>
      <button class="bg-tertiary text-surface-container-lowest p-2 rounded-full flex items-center justify-center hover:bg-[rgba(16,16,16,.04)] transition-colors border border-[rgba(0,0,0,.08)]" aria-label="Mais opções">
        <span class="material-symbols-outlined text-[20px]">more_horiz</span>
      </button>
    </div>

    <!-- Search Input -->
    <div class="mb-6 relative group">
      <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#A8A29E]">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" x2="16.65" y1="21" y2="16.65"></line>
        </svg>
      </span>
      <input
        id="msgSearch"
        class="w-full h-[44px] pl-10 pr-12 bg-white border border-[#E7E5E4] rounded-lg text-[14px] text-[#0A0A0A] placeholder-[#A8A29E] focus:outline-none focus:border-[#0A0A0A] focus:ring-[3px] focus:ring-[#D4FF00]/45 hover:border-[#0A0A0A] transition-all"
        placeholder="Pesquisar conversas..."
        type="text"
        autocomplete="off"
      />
      <button
        id="msgSearchClear"
        class="hidden absolute right-3 top-1/2 -translate-y-1/2 text-[#A8A29E] hover:text-[#0A0A0A] transition-colors"
        aria-label="Limpar pesquisa"
      >
        <span class="material-symbols-outlined text-[20px]">close</span>
      </button>
    </div>

    <!-- Filter Tabs -->
    <div id="msgTabs" class="border-b border-[#E7E5E4] mb-5" role="tablist" aria-label="Filtrar conversas">
      <div class="flex items-center gap-6 overflow-x-auto pb-1">
        <button
          data-tab="todas"
          class="relative pb-3 text-[14px] font-semibold text-[#0A0A0A] border-b-2 border-[#0A0A0A] -mb-[1px] whitespace-nowrap flex items-center gap-1.5"
          role="tab"
          aria-selected="true"
          aria-controls="panel-todas"
        >
          Todas
        </button>
        <button
          data-tab="nao_lidas"
          class="relative pb-3 text-[14px] font-medium text-[#78716C] hover:text-[#0A0A0A] transition-colors whitespace-nowrap flex items-center gap-1.5"
          role="tab"
          aria-selected="false"
          aria-controls="panel-nao_lidas"
        >
          Não lidas
          <span class="tab-count inline-flex items-center justify-center min-w-[18px] h-[18px] px-1.5 rounded-full bg-[#0A0A0A] text-[#D4FF00] text-[11px] font-semibold leading-none" style="display:none;">0</span>
        </button>
        <button
          data-tab="ativas"
          class="relative pb-3 text-[14px] font-medium text-[#78716C] hover:text-[#0A0A0A] transition-colors whitespace-nowrap flex items-center gap-1.5"
          role="tab"
          aria-selected="false"
          aria-controls="panel-ativas"
        >
          Ativas
          <span class="tab-count inline-flex items-center justify-center min-w-[18px] h-[18px] px-1.5 rounded-full bg-[#0A0A0A] text-[#D4FF00] text-[11px] font-semibold leading-none" style="display:none;">0</span>
        </button>
        <button
          data-tab="disputa"
          class="relative pb-3 text-[14px] font-medium text-[#78716C] hover:text-[#0A0A0A] transition-colors whitespace-nowrap flex items-center gap-1.5"
          role="tab"
          aria-selected="false"
          aria-controls="panel-disputa"
        >
          Em disputa
          <span class="tab-count inline-flex items-center justify-center min-w-[18px] h-[18px] px-1.5 rounded-full bg-[#0A0A0A] text-[#D4FF00] text-[11px] font-semibold leading-none" style="display:none;">0</span>
        </button>
        <button
          data-tab="arquivadas"
          class="relative pb-3 text-[14px] font-medium text-[#78716C] hover:text-[#0A0A0A] transition-colors whitespace-nowrap flex items-center gap-1.5"
          role="tab"
          aria-selected="false"
          aria-controls="panel-arquivadas"
        >
          Arquivadas
          <span class="tab-count inline-flex items-center justify-center min-w-[18px] h-[18px] px-1.5 rounded-full bg-[#0A0A0A] text-[#D4FF00] text-[11px] font-semibold leading-none" style="display:none;">0</span>
        </button>
      </div>
    </div>

    <!-- Conversation List Container -->
    <div class="border border-[#E7E5E4] rounded-lg bg-white overflow-hidden">
      <!-- Column Header (Desktop only) -->
      <div class="hidden md:flex items-center px-4 py-2.5 border-b border-[#E7E5E4] bg-[#FAFAF9] text-[12px] font-medium text-[#A8A29E]">
        <div class="w-[320px] shrink-0">Contrato</div>
        <div class="flex-1 min-w-0 pr-6">Última mensagem</div>
        <div class="w-[140px] shrink-0">Estado</div>
        <div class="w-[140px] shrink-0 text-right whitespace-nowrap">Escrow</div>
        <div class="w-[96px] shrink-0 text-right">Atividade</div>
      </div>

      <!-- Rows Container -->
      <div id="msgList" class="divide-y divide-[#E7E5E4]">
        <!-- Rows injected by JS -->
      </div>

      <!-- Empty State -->
      <div id="msgEmpty" class="hidden px-6 py-12 text-center">
        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-[#F0EFED] flex items-center justify-center">
          <span class="material-symbols-outlined text-[#44403C] text-[24px]">chat_bubble_outline</span>
        </div>
        <p class="text-[15px] font-medium text-[#0A0A0A] mb-1">Nenhuma conversa ainda</p>
        <p class="text-[13px] text-[#78716C]">As conversas aparecem aqui quando uma proposta é aceite</p>
      </div>
    </div>
  </div>
</div>