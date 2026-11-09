# Auditoria Read-Only: Template Mensagens (Inbox)

---

## 1. Como funciona hoje

### 1.1 Onde `App.templates.mensagens` está definido
| Ficheiro | Linha | Contexto |
|----------|-------|----------|
| `resources/views/painel/painel_freelancer.blade.php` | 2097 | Template principal (freelancer) |
| `resources/views/painel/painel_cliente.blade.php` | 1981 | Template principal (cliente) — **idêntico ao freelancer** |
| `resources/views/teste_previa/spa.blade.php` | 2099 | Cópia de teste |
| `resources/views/teste_previa/painel_freela_teste.blade.php` | 2103 | Cópia de teste |
| `resources/views/teste_previa/painel_freela_teste2.blade.php` | 2110 | Cópia de teste |
| `resources/views/teste_previa/painel_cliente_teste.blade.php` | 1978 | Cópia de teste |

> **Nota**: Todas as 6 ocorrências são **cópia exata** do mesmo template literal. Não há divergência entre freelancer/cliente.

---

### 1.2 Pipeline de renderização (SPA)
```
User clica link [data-spa-link data-route="mensagens"]
         │
         ▼
render('mensagens')  ──►  spaView.innerHTML = App.templates.mensagens
         │
         ▼
initRouteScripts('mensagens')  ──►  Anexa listeners em [data-open-chat]
         │
         ▼
Click na row  ──►  render('mensagens_sala')
```

**Ficheiros envolvidos:**
- `resources/views/painel/painel_freelancer.blade.php` (linhas 2934–2943 `render()`, 3112–3117 lógica mensagens)
- `resources/views/painel/painel_cliente.blade.php` (lógica idêntica)

**Montagem:** `spaView` = `document.getElementById('dynamic-content')` (definido no layout do painel).

---

### 1.3 Origem dos dados (HOJE)
- **Zero chamadas API** para listar conversas.
- O template **É o dado**: 5 itens *hardcoded* no template literal (linhas 2247–2324 freelancer / 2131–2208 cliente).
- API existente **apenas** para sala de chat:
  - `GET /api/chat/{conversaId}/messages` → lista mensagens da conversa
  - `POST /api/chat/send` → envia mensagem

---

### 1.4 Formato do objeto "conversa" (implícito no template)
| Campo | Exemplo | Origem |
|-------|---------|--------|
| `id` | (implícito, sem `data-id`) | — |
| `titulo` | "Sala de trabalho — Logo Skilla" | Hardcoded |
| `nomeOutraParte` | "Nelson Cardoso" | Hardcoded |
| `roleOutraParte` | "Freelancer" / "Cliente" | Hardcoded |
| `preview` | "Enviei as primeiras opções…" | Hardcoded |
| `isUnread` | `true` → class `is-unread` | Hardcoded |
| `naoLidas` | `3`, `1` | Hardcoded (badge) |
| `tempo` | "12:45", "Ontem", "Segunda", "12 Mar" | Hardcoded |
| `avatar` | URL Google ou ícone Material (`storefront`, `smartphone`) | Hardcoded |
| `escrow` | **Não existe** no template antigo | — |
| `statusContrato` | **Não existe** no template antigo | — |

---

### 1.5 Eventos e interações atuais
| Evento | Seletor / Hook | Ação |
|--------|----------------|------|
| Abrir chat | `[data-open-chat]` (click) | `render('mensagens_sala')` |
| Voltar inbox | `[data-back-to-inbox]` (click) | `render('mensagens')` |
| Pesquisa | `<input placeholder="Pesquisar conversas">` | **Sem handler** |
| Tabs filtro | **Não existem** no template antigo | — |
| More actions | `button[more_horiz]` | **Sem handler** |

---

### 1.6 Navegação para detalhe/chat
- Hash-based: `#mensagens` ↔ `#mensagens_sala`
- `history.pushState({ route }, '', \`#${route}\`)`
- **Nenhum ID de contrato/conversa** passado na navegação (a sala abre sempre o mesmo mock).

---

### 1.7 CSS / JS — tudo inline no template literal
- **CSS**: Bloco `<style>` de ~200 linhas dentro do template (variáveis CSS custom + utilitários `.chat-row`, `.badge-unread`, `.inset-divider`, etc.)
- **JS**: Função `initRouteScripts(route)` no blade (linhas 2945–3456) — anexa listeners pós-render.
- **Ícones**: Material Symbols Outlined (Google Fonts CDN)
- **Fontes**: Inter + Space Grotesk + Sora + Hanken Grotesk + JetBrains Mono (todas via Google Fonts CDN)
- **Tailwind**: CDN com config inline (`tailwind.config` no `<head>`) — **não há build step**.

---

### 1.8 Dependências de estilo (projeto)
| Item | Estado |
|------|--------|
| Tailwind | **CDN only** (`https://cdn.tailwindcss.com?plugins=forms,container-queries`) — sem `tailwind.config.js` no repo |
| Inter font | **Já importada globalmente** no `<head>` do SPA |
| Ícones | Material Symbols Outlined (SVG via font) — **não usa Lucide** |
| Variáveis CSS | Definidas no `:root` do SPA + sobrescritas no `#view-mensagens` |

---

## 2. Contrato de dados + eventos a preservar (tabela)

| Requisito | Detalhe | Onde vive hoje |
|-----------|---------|----------------|
| **Lista de conversas** | Array de objetos com campos abaixo | Hardcoded no template (precisa vir de API) |
| `id` (UUID) | Chave primária da conversa | **Ausente** — adicionar `data-conversa-id` |
| `titulo` | Nome da sala / título do trabalho | `h3` |
| `nomeOutraParte` | Nome do freelancer ou cliente | Subtítulo "Nome • Role" |
| `roleOutraParte` | "Freelancer" \| "Cliente" | Subtítulo |
| `preview` | Última mensagem (truncada) | `p` preview |
| `previewIsOwn` | Boolean — se a última msg é do utilizador atual | **Novo**: prefixo "Tu:" no Stitch |
| `isUnread` | Boolean | Class `is-unread` na row |
| `naoLidas` | Number (badge count) | `.badge-unread` |
| `tempo` | String formatada ("12:45", "Ontem", "12 Mar") | `.meta-col > span` |
| `avatarUrl` \| `avatarFallback` | Imagem ou inicial/ícone | `img` ou `div` com ícone |
| `statusContrato` | Enum: `em_revisao` \| `em_andamento` \| `em_disputa` \| `concluido` | **Novo** (Stitch tem) |
| `escrow` | Objeto: `{ label: "Em escrow", valor: 150000, moeda: "Kz" }` | **Novo** (Stitch tem) |
| **Evento: abrir chat** | Click na row → navegar para sala com `conversaId` | `[data-open-chat]` |
| **Evento: pesquisa** | Input `oninput` → filtro client-side ou debounce API | Input existe, **sem handler** |
| **Evento: tabs filtro** | Click tab → filtro local ou query API | **Não existe** (Stitch tem 5 tabs) |
| **Evento: voltar** | Back button na sala → `#mensagens` | `[data-back-to-inbox]` |
| **Formatação Kz** | `Intl.NumberFormat('pt-AO', {currency:'AOA'}).format(v).replace('AOA','KZS')` | `formatCurrency()` em `dashboard.js` / `painel_*.js` |

---

## 3. Diferenças: Antigo vs Novo (Stitch)

| Categoria | Antigo (template atual) | Novo (Stitch) | Decisão |
|-----------|-------------------------|---------------|---------|
| **Layout geral** | Lista "card" iOS-style (avatar + texto + meta col 60px) | **Tabela colunas fixas** (Contrato 320px \| Última msg flex \| Estado 140px \| Escrow 140px \| Atividade 96px) | **Adaptar** — novo design é desktop-first; precisa versão mobile empilhada |
| **Header de colunas** | **Não existe** | Sim: `<div class="flex ... bg-[#FAFAF9]">` com 5 colunas | **Criar** — adicionar linha de header |
| **Status** | Pill badge (verde/amarelo/vermelho) com texto | **Dot simples** (w-1.5 h-1.5 rounded-full) + texto ao lado | **Adaptar** — mapear status → cor do dot |
| **Badge não-lidas** | Pill preto (var(--surface-container-lowest)) + texto lima (var(--primary-container)) | **Quadrado arredondado** (min-w-[20px] h-[20px] bg-[#0A0A0A] text-[#D4FF00] rounded-[6px]) | **Manter estilo Stitch** (preto + lima) |
| **Coluna Escrow** | **Não existe** | **2 linhas**: (ícone cadeado + "Em escrow") + valor `tabular-nums` | **Criar** — requer dados do contrato |
| **Coluna Atividade** | Tempo + badge (ou spacer vazio) | Tempo `tabular-nums` + badge (se unread) ou spacer | **Adaptar** — manter `tabular-nums` |
| **Pré-visualização msg** | Texto simples | Com prefixo **"Tu:"** (font-medium text-[#78716C]) se própria | **Adaptar** — adicionar lógica `previewIsOwn` |
| **Subtítulo row** | Apenas título | **Título + "Nome • Role"** (text-[#78716C] + separator •) | **Adaptar** — adicionar campos |
| **Avatar** | 40px circular (img ou bg-primary-container + ícone) | 40px **rounded-lg** (não circular) + bg-[#F0EFED] + iniciais | **Adaptar** — `rounded-lg` + fallback iniciais |
| **Hover row** | `var(--row-hover)` (rgba(16,16,16,.035)) | `hover:bg-[#FAFAF9]` | **Manter Stitch** (mais visível) |
| **Divider** | Inset (começa após avatar) | **Full-width** `divide-y divide-[#E7E5E4]` no container | **Adaptar** — divider full-width |
| **Tabs filtro** | **Não existem** | 5 tabs: Todas / Não lidas / Ativas / Em disputa / Arquivadas (underline style) | **Criar** — lógica de filtro client-side + estado ativo |
| **Pesquisa** | Input solto, sem handler | Input com ícone SVG inline, focus ring lima | **Adaptar** — anexar handler debounce |
| **Responsividade** | Mobile-first (max-w-4xl, px-margin-mobile, chat-row flex wrap) | **Desktop-only**: `max-w-[1100px]`, `h-[72px]` fixo, `w-[320px]/[140px]/[96px]` fixos | **Reescrever** — mobile precisa layout empilhado (ver §4) |
| **Cores** | CSS variables (--primary-container #D4FF00, --surface-container-lowest #101010, etc.) | **Hardcoded hex**: #0A0A0A, #D4FF00, #FAFAF9, #E7E5E4, #78716C, #A8A29E, #D6D3D1, #44403C | **Unificar** — usar tokens do projeto (CSS vars) onde possível |
| **Fontes** | Inter + Space Grotesk (via Tailwind config) | **Apenas Inter** (importada no HTML) | **Manter projeto** (Inter + Space Grotesk) |

---

## 4. O que será preciso para implementar (lista concreta)

### 4.1 Ficheiros a mexer
| Ficheiro | Ação |
|----------|------|
| `resources/views/painel/painel_freelancer.blade.php` | Substituir `App.templates.mensagens` (linha 2097) + atualizar `initRouteScripts('mensagens')` |
| `resources/views/painel/painel_cliente.blade.php` | **Mesma alteração** (linha 1981) — manter sincronizado |
| `public/js/dashboard.js` ou novo `public/js/mensagens-inbox.js` | Extrair lógica de inbox (fetch, render, filter, search) para módulo reutilizável |
| `routes/api.php` | Adicionar `GET /api/conversas` (listar conversas do utilizador autenticado) |
| `app/Http/Controllers/ConversationController.php` | **Novo controller** — `index()` retorna conversas com relacionamentos (contract, job, outra parte, última msg, contagem unread, escrow) |
| `app/Models/Conversation.php` | Adicionar accessors / scopes: `scopeForUser()`, `withLastMessage()`, `withUnreadCount()`, `withEscrow()` |

### 4.2 Funções a reescrever / criar
| Função | Descrição |
|--------|-----------|
| `fetchConversas(filtros?)` | `fetch('/api/conversas?tab=...&q=...')` → retorna array normalizado |
| `renderConversas(list, container)` | Gera HTML das rows via template string (ou `document.createElement`) |
| `formatTempo(date)` | Reutilizar `formatDateLabel` existente (linha 2885) |
| `formatKz(value)` | Reutilizar `formatCurrency` existente |
| `getStatusDotColor(status)` | Mapeamento: `em_revisao`→#D97706 (amber), `em_andamento`→#16A34A (green), `em_disputa`→#DC2626 (red), `concluido`→#A8A29E (neutral) |
| `getStatusLabel(status)` | Texto legível: "Em revisão", "Em andamento", "Em disputa", "Concluído" |
| `filterConversas(list, tab, query)` | Filtro client-side (tabs + search) — evita round-trip API a cada keystroke |
| `debounce(fn, ms)` | Utilitário para search input |

### 4.3 Novo mapeamento status → cor do dot
| Status BD / Enum | Label PT | Cor dot (hex) | Tailwind approx |
|------------------|----------|---------------|-----------------|
| `em_revisao` / `pending_review` | Em revisão | `#D97706` | `amber-600` |
| `em_andamento` / `in_progress` | Em andamento | `#16A34A` | `green-600` |
| `em_disputa` / `dispute` | Em disputa | `#DC2626` | `red-600` |
| `concluido` / `completed` | Concluído | `#A8A29E` | `stone-400` |
| `arquivado` / `archived` | Arquivado | `#78716C` | `stone-500` |

### 4.4 Formato escrow (novo)
```js
// Vem do Contract.valor_acordado + Contract.status_pagamento
escrow: {
  label: 'Em escrow',           // fixo ou "Libertado" se status_pagamento === 'released'
  valor: 150000,                // number (centavos ou unidades? confirmar)
  moeda: 'Kz',
  icon: 'lock'                  // SVG inline do Stitch
}
```
- Se `status_pagamento === 'released'` ou contrato concluído → mostrar `—` (em-dash) como no Stitch row 5.

### 4.5 Badges não-lidas (Stitch style)
```html
<span class="inline-flex items-center justify-center min-w-[20px] h-[20px] px-1.5 rounded-[6px] bg-[#0A0A0A] text-[#D4FF00] text-[12px] font-semibold leading-none">
  3
</span>
```
- **Não usar** `badge-unread` antigo (pill preto+lima com CSS vars).
- Aplicar `tabular-nums` no tempo e no valor escrow.

### 4.6 Search + Tabs (estado local)
```js
let state = {
  conversas: [],      // cache completo
  activeTab: 'todas', // 'todas' | 'nao_lidas' | 'ativas' | 'disputa' | 'arquivadas'
  query: ''
};

function applyFilters() {
  let list = state.conversas;
  if (state.activeTab !== 'todas') list = list.filter(c => c.tabKey === state.activeTab);
  if (state.query) list = list.filter(c => c.titulo.includes(query) || c.nomeOutraParte.includes(query) || c.preview.includes(query));
  renderConversas(list);
}
```
- Tabs no Stitch: `Todas` (default ativo), `Não lidas`, `Ativas`, `Em disputa`, `Arquivadas`.
- Mapear `tabKey` na conversa: `isUnread`→`nao_lidas`, `statusContrato===em_andamento`→`ativas`, `statusContrato===em_disputa`→`disputa`, `statusContrato===concluido`→`arquivadas`.

### 4.7 Row click → navegação com ID
```js
row.addEventListener('click', () => {
  const conversaId = row.dataset.conversaId;
  // Guardar no sessionStorage ou state global para a sala saber qual abrir
  sessionStorage.setItem('openConversaId', conversaId);
  render('mensagens_sala');
});
```
- Sala (`mensagens_sala`) deve ler `sessionStorage.getItem('openConversaId')` e chamar `fetch('/api/chat/'+id+'/messages')`.

---

## 5. Plano de implementação proposto (SEM EXECUTAR)

### Passo 1 — Backend: API de listagem de conversas
1. Criar `ConversationController@index(Request $request)`
   - Query: `Conversation::where('cliente_id', auth()->id())->orWhere('freelancer_id', auth()->id())`
   - Eager load: `contract.job`, `contract.client`, `contract.freelancer`, `messages()` (latest), `unreadCount`
   - Retornar JSON com campos normalizados (ver §2)
2. Registrar rota: `Route::get('/conversas', [ConversationController::class, 'index'])` em `routes/api.php`

### Passo 2 — Frontend: Módulo mensagens-inbox.js
1. Criar `public/js/mensagens-inbox.js` (ESM ou IIFE) com:
   - `fetchConversas()`
   - `renderConversas(list)`
   - `bindEvents(container)` (search, tabs, row click)
   - `filterAndRender()`
2. Importar no blade (`<script type="module" src="/js/mensagens-inbox.js"></script>`) ou carregar via script tag.

### Passo 3 — Substituir template `App.templates.mensagens`
1. Novo template literal **sem dados hardcoded** — apenas estrutura:
   - Header (título + subtítulo + more_horiz)
   - Search input (com ícone SVG inline, `id="search-conversas"`)
   - Tabs filtro (5 buttons, `data-tab="..."`, `role="tablist"`)
   - Container tabela: header row + `<div class="divide-y">` para rows
   - Row template (função JS que recebe objeto conversa → HTML string)
2. Manter CSS vars do projeto (`--primary-container`, etc.) — **não hardcodear hex** do Stitch.
3. Adicionar `data-conversa-id="{{ $conversa->id }}"` em cada row.

### Passo 4 — Atualizar `initRouteScripts('mensagens')`
1. Remover listeners antigos `[data-open-chat]`.
2. Chamar `MensagensInbox.init(spaView)` (ou similar) que:
   - Faz fetch inicial
   - Renderiza
   - Anexa search/tabs/row listeners

### Passo 5 — Responsividade (mobile 390px / tablet)
| Breakpoint | Layout |
|------------|--------|
| **Mobile (< 640px)** | **Empilhado**: Row vira card vertical — Avatar + Título + Nome•Role em cima; Preview linha cheia; Chips: Status dot+label \| Escrow (2 linhas) \| Tempo + badge. Sem colunas fixas. |
| **Tablet (640–1024px)** | **Híbrido**: Mostrar 3 colunas principais (Contrato + Preview + Estado/Escrow/Atividade colapsados em 2 colunas). `h-[72px]` → `min-h-[72px]`. |
| **Desktop (≥ 1024px)** | **Stitch fiel**: 5 colunas fixas, `h-[72px]`, `tabular-nums`. |

**Implementação CSS**: Usar `grid` com `grid-template-columns` responsivo + `hidden md:table-cell` para header cols, ou abordagem **card → table** com `@container` queries (Tailwind `container-queries` plugin já ativo no CDN).

### Passo 6 — Integração sala de chat (`mensagens_sala`)
1. Ler `sessionStorage.getItem('openConversaId')` no `initRouteScripts('mensagens_sala')`.
2. Fetch `/api/chat/{id}/messages` e renderizar histórico.
3. Atualizar header da sala com dados do contrato (título, status, escrow).

### Passo 7 — Limpeza
1. Remover CSS inline antigo do template (bloco `<style>` de 200 linhas).
2. Remover duplicatas nos 4 ficheiros `teste_previa/*` (ou apontar para partial compartilhado).
3. Unificar `painel_freelancer` e `painel_cliente` para usar **mesmo partial** (ex: `@include('painel.partials.mensagens-inbox')`).

---

## 6. Riscos e perguntas para mim

| # | Risco / Pergunta | Impacto | Necessita decisão |
|---|------------------|---------|-------------------|
| 1 | **API `/api/conversas` não existe** — quem cria o controller? Backend (Laravel) ou mock temporário no frontend? | Bloqueia Passo 1 | **Sim** — confirmar se backend team entrega ou faço mock localStorage |
| 2 | **Campo `status_contrato` / `status_pagamento`** no modelo `Contract` — quais valores reais existem no BD? (ex: `pending`, `active`, `disputed`, `completed`, `archived`) | Mapeamento status → dot/label/tab | **Sim** — preciso dos enums reais |
| 3 | **Escrow**: `valor_acordado` está em centavos (int) ou unidades (float)? Formato `150.000 Kz` sugere milhares com separador — confirmar. | Formatação correta | **Sim** |
| 4 | **Unread count**: Como calcular? `Message::where('conversa_id', $id)->where('remetente_id', '!=', auth()->id())->whereNull('lida_em')->count()`? Existe campo `lida_em`? | Badge preciso | **Sim** — verificar schema `messages` |
| 5 | **Avatar**: O utilizador tem `foto_perfil` no modelo `Perfil`? Fallback para iniciais (primeiras letras nome) ou ícone por role? | Row avatar | **Sim** — verificar `Perfil` model |
| 6 | **Tabs "Ativas" / "Arquivadas"**: Definição de "ativa" = `status_contrato IN ('em_andamento','em_revisao')`? "Arquivada" = `concluido` ou `arquivado` explícito? | Filtro tabs | **Sim** |
| 7 | **Responsividade**: O Stitch é desktop-only. Queres que eu desenhe o mobile/tablet do zero (card empilhado) ou tens wireframe/referência? | UI/UX mobile | **Sim** — confirmar se prossigo com proposta própria |
| 8 | **CSS vars vs Stitch hex**: O projeto usa CSS vars (`--primary-container`, `--surface-container-lowest`). O Stitch usa hex hardcoded. Manter vars do projeto (mais consistente) ou adotar paleta Stitch? | Design system | **Recomendo manter vars do projeto** — só ajustar se aprovado |
| 9 | **Duplicação templates**: 6 ficheiros blade com cópia idêntica. Queres que eu centralize num partial Blade (`@include('painel.partials.mensagens-inbox')`) agora ou depois? | Manutenibilidade | **Sim** — recomendo fazer no Passo 7 |
| 10 | **TypeScript / Build step**: Projeto é vanilla JS + Tailwind CDN. Sem bundler. O novo módulo `mensagens-inbox.js` deve ser ESModule (`type="module"`) ou IIFE global? | Carregamento | **Recomendo IIFE global** (`window.MensagensInbox = ...`) para manter compatibilidade atual |
| 11 | **Acessibilidade**: Tabs precisam `role="tablist"`, `aria-selected`, `aria-controls`. Rows precisam `role="button" tabindex="0"` + `keydown Enter/Space`. Incluir no Passo 3? | A11y | **Sim** — incluir baseline |
| 12 | **Testes**: Existe suite de testes (Pest, PHPUnit, Vitest, Cypress)? Como validar a nova API e UI? | QA | **Informar** |

---

**Próximo passo aguardado:** Resposta aos itens da seção 6 (especialmente 1–6) para iniciar implementação.