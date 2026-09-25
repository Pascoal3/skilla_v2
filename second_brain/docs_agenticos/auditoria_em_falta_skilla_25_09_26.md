# Auditoria Completa: Funcionalidades em Falta no Projeto Skilla

**Data:** 25/09/2026  
**Versão:** 1.0  
**Baseado em:** 3 documentos de observação + análise completa da codebase (Laravel 11 + SPA vanilla JS + Tailwind)

---

## Sumário Executivo

O projeto possui uma base sólida: autenticação JWT em cookies HttpOnly, rotas protegidas por role, SPA client-side no painel, services para lógica de negócio, e templates bem estruturados. O gap principal está na **integração frontend-backend** (dados estáticos/mock nos templates SPA), **wizard de publicar trabalho incompleto**, **listeners SPA quebrados** (event delegation não rebindado), e **páginas legais/auxiliares ausentes**.

Total de itens identificados: **87** (53 de alta prioridade, 24 média, 10 baixa)

---

## 1. AUTENTICAÇÃO E SEGURANÇA

### 1.1 Login - Validação de email inválido ✅ **PARCIALMENTE RESOLVIDO**
- **Status:** Validação client-side existe em `login.js` (linhas 42-55), mas backend não valida formato antes de `JWTAuth::attempt()`
- **Arquivo:** `app/Http/Controllers/AuthController.php:95-107`, `public/js/login.js`
- **Solução:** Adicionar validação `email:required|email` no `$request->validate()` do login (já existe). Garantir que erro 401 retorna JSON com mensagem clara "Email ou senha inválidos" (já implementado).

### 1.2 Prevenção SQL Injection no Login ✅ **RESOLVIDO**
- **Status:** Laravel Eloquent + prepared statements protegem nativamente. `JWTAuth::attempt()` usa query builder segura.
- **Nenhuma ação necessária.**

### 1.3 Bloquear botão "Voltar" do browser após login ✅ **IMPLEMENTADO**
- **Status:** `login.js` linhas 105-123 implementa `history.pushState` lock + `popstate` handler
- **Arquivo:** `resources/views/registar/tela_login.blade.php:105-123`
- **Testar:** Login → navegar para painel → clicar voltar → deve permanecer no painel

### 1.4 Logout não funciona ❌ **ALTA PRIORIDADE**
- **Status:** `AuthController::logout()` (linha 189) usa `Auth::logout()` (session web) mas auth é JWT cookie. `logoutApi()` invalida token mas `logout()` redireciona com `redirect()->route('login')` sem limpar cookie corretamente.
- **Arquivo:** `app/Http/Controllers/AuthController.php:189-211`
- **Solução:** Unificar logout. Usar `logoutApi()` logic para ambos. Remover `Auth::logout()` e `session()->invalidate()`. Apenas invalidar JWT token + remover cookie `jwt_token`.

```php
// Em AuthController::logout()
public function logout(Request $request)
{
    $this->invalidateTokenFromCookie($request);
    return redirect()->route('login')->withCookie(cookie()->forget('jwt_token', '/'));
}
```

### 1.5 JWT deve ser HTTPOnly cookie only ✅ **JÁ IMPLEMENTADO**
- **Status:** `AuthController::withJwtCookie()` (linha 230-243) define `httponly: true`, `secure: config('session.secure')`, `samesite: 'Lax'`
- **Arquivo:** `app/Http/Controllers/AuthController.php:230-243`

---

## 2. PÁGINAS PÚBLICAS E LANDING PAGE

### 2.1 Botão "Ver tudo" → Página de Categorias ❌ **ALTA PRIORIDADE**
- **Status:** `inicio.blade.php` linha 300 tem botão "Ver Tudo" mas `href="#"` sem rota
- **Arquivo:** `resources/views/home/inicio.blade.php:300`
- **Solução:** Criar rota `/categorias` + controller + view. Atualizar `href="{{ route('categorias') }}"`

### 2.2 Página de Categorias ❌ **ALTA PRIORIDADE**
- **Status:** Não existe. Seção "Áreas" (linha 293-359) tem cards estáticos
- **Solução:** 
  1. Criar `CategoryController@index` 
  2. Rota `Route::get('/categorias', [CategoryController::class, 'index'])->name('categorias')`
  3. View `resources/views/categorias/index.blade.php` com grid dinâmico vindo de `JobCategory::withCount('jobs')->get()`

### 2.3 Página de Assinatura (Pricing) ❌ **ALTA PRIORIDADE**
- **Status:** Seção pricing existe em `inicio.blade.php:551-733` mas botões "Assinar Agora" / "Falar com Consultor" vão para `#`
- **Requisito:** Página `/assinatura?plano=pro|elite` com plano pré-selecionado
- **Solução:** 
  1. `AssinaturaController@create(Request $request)` lê `plano` do query string
  2. View com formulário Stripe/Multicaixa + seleção de plano pré-marcada
  3. Toggle "Freelancer/Empresa" antes dos cards (checklist item ✅)

### 2.4 Plano Business "Sob Consulta" ❌ **MÉDIA PRIORIDADE**
- **Status:** Card existe mas botão "Falar com Consultor" vai para `#`
- **Solução:** Modal/formulário curto (nome, email/WhatsApp, tamanho equipa) → redirect WhatsApp ou agendamento Calendly/Zoom

### 2.5 Páginas Legais Ausentes ❌ **ALTA PRIORIDADE (COMPLIANCE)**
| Página | Rota Sugerida | Status |
|--------|---------------|--------|
| Termos de Serviço (Cliente) | `/termos/cliente` | ❌ |
| Política de Privacidade (Cliente) | `/privacidade/cliente` | ❌ |
| Termos de Serviço (Freelancer) | `/termos/freelancer` | ❌ |
| Política de Privacidade (Freelancer) | `/privacidade/freelancer` | ❌ |

- **Solução:** 4 views Blade simples + rotas públicas no `web.php` + links no footer (já existem placeholders em `carteira_carregar_saldo` footer)

### 2.6 FAQ - Perguntas Frequentes ⚠️ **PARCIAL**
- **Status:** 5 FAQs hardcoded em `inicio.blade.php:740-790` (accordion funcional via JS)
- **Falta:** Mais perguntas + dados dinâmicos de CMS/config
- **Solução:** Model `Faq` + seeder + render dinâmico

### 2.7 Página 404 Personalizada ❌ **MÉDIA PRIORIDADE**
- **Status:** Não existe. Usa default do Laravel
- **Solução:** `resources/views/errors/404.blade.php` com design Skilla + botão "Voltar ao Início"

### 2.8 Modal de Reportar Erro ❌ **BAIXA PRIORIDADE**
- **Status:** Não existe
- **Solução:** Botão flutuante/global → modal com formulário (tipo, descrição, screenshot opcional) → `POST /api/reports` → `NotificationController` para admins

---

## 3. PAINEL DO CLIENTE

### 3.1 Wizard "Publicar Trabalho" ❌ **CRÍTICO - ALTA PRIORIDADE**
**Análise completa em:** `auditoria_wizard_publicar_trabalho_25_09_26.md`

**Estado Atual:**
- 6 templates existem: `step_1` a `step_5` + `review` (review **cortado/truncado**)
- `jobPostingData` global existe mas **não persiste** dados entre steps
- Step 1: Botão "Próximo" só faz `alert()` não avança
- Steps 2, 3, 5: **Zero lógica** em `initRouteScripts`
- Step 4: JS existe (`App.initPublicarTrabalhoStep4`) mas **não integrado** ao fluxo
- Step 6 (Review): Template incompleto + **sem submissão API**

**Arquivo único:** `resources/views/painel/painel_cliente.blade.php` (templates + JS inline)

**Plano de Ação (ordem):**
1. **Completar template `publicar_trabalho_review`** (copiar estrutura dos outros steps)
2. **Estender `jobPostingData`** com todos campos:
```js
window.jobPostingData = {
  step: 1,
  title: "",
  skills: [],
  scope: { size, duration, experience, conversion },
  budget: { type: 'fixed'|'hourly', amountMin, amountMax, ... },
  description: "",
  attachments: []
};
```
3. **Helpers** `saveStepData(step, data)` / `loadStepData(step)`
4. **Blocos `initRouteScripts`** para steps 2, 3, 5 (hidratação + validação + navegação)
5. **Integrar step 4:** ler inputs fixo/hora no "Próximo"
6. **Submissão final no Review:** `fetch('/api/jobs', {method:'POST', body: JSON.stringify(jobPostingData)})`
7. **Sucesso:** toast + `render('trabalhos')` ou `render('inicio')`

**Validações por step:**
| Step | Campos | Regra |
|------|--------|-------|
| 1 | title | min 5 chars |
| 2 | skills | ≥ 1 selecionada |
| 3 | size, duration, experience | radio/select checked |
| 4 | budget.type + valores | fixo: >0; hora: min/max preenchidos |
| 5 | description | min 50 chars |

### 3.2 Botões Aprovar/Rejeitar Propostas ❌ **ALTA PRIORIDADE**
**Análise completa em:** `auditoria_botoes_aprovar_rejeitar_propostas_25_09_26.md`

**Problema:** `proposta.js` carrega no `DOMContentLoaded` → listener anexado no HTML inicial. Navegação SPA (`render('propostas')`) substitui DOM → listeners perdidos.

**Solução:** Mover lógica para `initRouteScripts` dentro do blade:
```javascript
if (route === 'propostas') {
    const view = spaView.querySelector('#view-propostas-freela');
    if (!view) return;
    
    view.addEventListener("click", (e) => {
        const btn = e.target.closest("button");
        if (!btn) return;
        const card = btn.closest(".neo-card");
        if (!card) return;
        
        const aceitar = btn.classList.contains("js-aceitar");
        const rejeitar = btn.classList.contains("js-rejeitar");
        if (!aceitar && !rejeitar) return;
        
        // Só age se status "Pendente"
        const span = card.querySelector(".flex.justify-between.items-start span");
        if (!span || span.textContent.trim().toLowerCase() !== "pendente") return;
        
        if (aceitar) {
            span.className = "bg-[#4CAF50] text-white px-4 py-1 rounded-full ...";
            span.textContent = "Aceito";
        }
        if (rejeitar) {
            span.className = "bg-[#FF5252] text-white px-4 py-1 rounded-full ...";
            span.textContent = "Rejeitado";
        }
        // Esconder botões
        const divIcones = card.querySelector(".divDosIcones");
        if (divIcones) divIcones.classList.add("hidden");
    });
}
```
**Depois:** Remover `<script src="{{ asset('js/proposta.js') }}" defer>` do blade (linha 116)

### 3.3 Filtros de Trabalhos (Cliente) ❌ **ALTA PRIORIDADE**
- **Status:** Botões "Rascunhos, Abertos, Em andamento, Concluídos, Cancelados" existem no template mas **não filtram**
- **Dados:** Estáticos/mock no template `App.templates.trabalhos`
- **Solução:** 
  1. API endpoint `GET /api/cliente/jobs?status=aberto|rascunho|...`
  2. `JobController@index2` já tem lógica de filtros (linha 63-145) - reaproveitar
  3. No `initRouteScripts('trabalhos')`: fetch API + render dinâmico + event listeners nos tabs

### 3.4 Dados Dinâmicos no Dashboard Cliente ❌ **ALTA PRIORIDADE**
- **Status:** `DashboardController@clienteData` retorna `metrics: []` vazio (linha 33-40)
- **Métricas necessárias:** Trabalhos publicados, Propostas recebidas, Em andamento, Concluídos, Saldo, Escrow
- **Solução:** Implementar queries no `clienteData()` usando `Job`, `Proposal`, `Wallet` models

### 3.5 Botão "Ver Job" → Página de Detalhe ❌ **ALTA PRIORIDADE**
- **Status:** No template `trabalhos`, botão "Ver job" vai para `#` ou mesma página
- **Solução:** Rota `/cliente/jobs/{job}` + view dedicada (reaproveitar `layouts_freela/show.blade.php` adaptada para cliente)

---

## 4. PAINEL DO FREELANCER

### 4.1 Filtros de Trabalhos (Freelancer) ❌ **ALTA PRIORIDADE**
- **Status:** Mesmo problema do cliente - tabs não funcionam, dados estáticos
- **Solução:** Reaproveitar `JobController@index2` (linha 63-145) que já tem filtros completos (categoria, orçamento, prazo, nível, localização, ordenação)
- **View:** `resources/views/freelancer/jobs/index.blade.php` já existe e é completa

### 4.2 Módulo Propostas - Estado Dinâmico ❌ **ALTA PRIORIDADE**
- **Status:** Template `propostas` tem cards estáticos. Status não atualiza após aceitar/rejeitar
- **Fluxo descrito:** Freelancer envia proposta → success state (alert feio) → redirect automático para propostas → acompanhar status (pendente → aceite/rejeitada)
- **Solução:**
  1. API `GET /api/freelancer/proposals` retorna propostas reais com status
  2. `ProposalController@index` já existe (linha 140) - implementar
  3. Template dinâmico renderizado via JS
  4. Success state: toast/overlay bonito (não `alert()`)

### 4.3 Formulário Enviar Proposta ⚠️ **PARCIAL**
- **Status:** Modal existe em `layouts_freela/show.blade.php:455-545` com validação client-side
- **Problemas:**
  - Contador de palavras da carta (máx 2000) **não implementado**
  - Success state usa `alert()` feio
  - Redireciona automático mas sem feedback visual adequado
- **Solução:**
  1. Contador: `textarea.addEventListener('input', () => { count = value.split(/\s+/).filter(Boolean).length; updateUI() })`
  2. Aos 1800+ palavras: texto vermelho + warning
  3. Success: overlay/modal bonito + `render('propostas')` após 2s

### 4.4 Paginação Propostas ❌ **MÉDIA PRIORIDADE**
- **Status:** Não existe
- **Solução:** `ProposalController@index` com `paginate(10)` + controles de paginação no template

### 4.5 Módulo Mensagens - Botão "Ver Detalhes" ❌ **ALTA PRIORIDADE**
**Especificação completa no doc "Em falta na skilla.md" linhas 109-172**

**Requisitos do Modal:**
- Participantes (avatares, roles, presença)
- Contexto do trabalho (briefing, categoria, prazo, prioridade)
- Entregas e marcos (status, próximos passos)
- Pagamentos (plano, valores, taxas, status)
- Ficheiros/links (documentos fixados, anexos, links externos)
- Regras/segurança (confidencialidade, bloqueio, nível acesso)
- Ações rápidas (Ver projeto, Abrir contrato, Abrir disputa, Sair da sala)

**Regras de negócio:**
- Botão visível apenas se: contrato ativo + role cliente/freelancer/admin + status sala "Ativo" ou "Em revisão"
- Visibilidade por perfil: cliente vê pagamentos/marcos + anexos aprovados; freelancer vê notas/entrega/upload + anexos seus; admin vê tudo

**Solução:**
1. Rota `GET /api/chat/{conversaId}/details` → `ChatController@details`
2. Modal component reutilizável (padrão `deliverModal` em `mensagens-sala.js`)
3. Permissões via policy/ability check

### 4.6 Módulo Mensagens - Design ❌ **MÉDIA PRIORIDADE**
- **Status:** Fundo branco no chat, deveria ser verde (#CCFF00) mantendo balões atuais
- **Arquivo:** `painel_freelancer.blade.php` CSS linha 118-155 define `--primary-container: #C9F000` mas chat usa branco
- **Solução:** Ajustar CSS do chat para usar variáveis do tema

### 4.7 Enviar Ficheiros no Chat - Pré-visualização WhatsApp ❌ **ALTA PRIORIDADE**
- **Status:** `mensagens-sala.js` linhas 35-57 tem `appendMensagemFicheiro` básico
- **Requisito:** Preview tipo WhatsApp: título, tamanho (MB), formato, botão "X" (fecha), "Mais" (adiciona), "Enviar" → aviso no chat
- **Fluxo:** Clicar anexar → modal preview → confirmar → envia → mensagem no chat "Ficheiro enviado: nome.pdf (2.3 MB)"
- **Modal confirmação "X":** "Tem a certeza? Cancelar / Descartar"

### 4.8 Entregar Trabalho - Fluxo Completo ❌ **ALTA PRIORIDADE**
**Especificação no doc linhas 174-222**

**Fluxo:**
1. Freelancer clica "Entregar trabalho" → modal (notas opcional + anexos/link)
2. Envia → success state → fecha modal → barra mensagem oculta → msg "Info enviadas, aguarde resposta"
3. Cliente vê botão "Aprovar entrega" (só aparece após entrega)
4. Modal aprovação mostra: data/hora, ficheiros (título, formato, tamanho, botão "Visualizar")
5. Opção avaliar freelancer + comentário + nota "aprovação libera valor retido"
6. Botões: "Aprovar trabalho" (encerra sala) / "Solicitar revisões" (reabre chat + notificação)

**Backend:** `ContractController@submit` (linha 15-35) + `ContractController@approve` (linha 25-68) + `ContractService` já existem
**Frontend:** `deliverModal` em `tela_mensagem_sala_trabalho_teste.blade.php:409-488` já tem UI completa
**Falta:** Integração real + notificações + modal aprovação cliente

### 4.9 Carteira - Carregar Saldo ⚠️ **PARCIAL**
- **Status:** Template `carteira_carregar_saldo` completo em `painel_freelancer.blade.php:785-1100+` e `painel_cliente.blade.php:761+`
- **Problemas:**
  - Valor dinâmico: input digita → resumo atualiza (precisa JS bind)
  - Erro < 2000 Kz: mostrar erro (template tem span oculto)
  - Success modal: "Seu saldo de X" deve ser valor da recarga (dinâmico)
  - Registo no extrato: tipo "recarga de saldo", método, hora, data, valor, status
  - Ícones: seta cima (recarga), baixo (débito), relógio (pendente)
  - Exportar extrato PDF
  - Filtros extrato (modal como trabalhos)
  - IBAN Skilla dinâmico (já tem `IbanService`)

### 4.10 Carteira - Pedir Saque ⚠️ **PARCIAL**
- **Status:** Template existe em ambos painéis
- **Problemas:**
  - Saldo disponível dinâmico
  - Botão "Tudo" preenche input com saldo total
  - Erro < 5000 Kz
  - IBAN destino dinâmico
  - Valor a sacar = total a receber (dinâmico)
  - Botão copiar IBAN → clipboard + success state personalizado
  - Modal sucesso/erro igual ao carregar saldo
  - Registo no extrato: tipo "saque", método, hora, data, valor, status

### 4.11 Perfil do Freelancer (Público) ❌ **MÉDIA PRIORIDADE**
- **Status:** Rota `/perfil/{id}` existe (linha 161-163 web.php) → view `freelancer.profile.show` mas **view não existe**
- **Solução:** Criar `resources/views/freelancer/profile/show.blade.php` reaproveitando `layouts_freela/show.blade.php` adaptado

---

## 5. ADMINISTRADOR SKILLA

### 5.1 Dashboard Admin ❌ **ALTA PRIORIDADE**
- **Status:** Não existe painel admin
- **Requisitos:**
  - Créditos: cada user novo = 10 créditos; total créditos plataforma (grátis vs pagos)
  - Relatórios: erros reportados, disputas, reembolsos, queixas (filtros data/tipo + export)
  - Logs sistema: toda ação (trabalho postado, resolvido, proposta enviada) com ID, ação, status
  - Notificações admin
  - Tabela `perfis.saldo_creditos` somar todos

### 5.2 Roteamento Admin
- **Solução:** Middleware `role:admin` + prefix `/admin` + controllers dedicados

---

## 6. PROBLEMAS TÉCNICOS TRANSVERSAIS

### 6.1 Dados Mock/Estáticos nos Templates SPA ❌ **CRÍTICO**
**Afeta:** `painel_freelancer.blade.php` (templates `inicio`, `carteira`, `carteira_comprar_creditos`, `carteira_carregar_saldo`, `propostas`, `mensagens`, `perfil`, `trabalhos`) e `painel_cliente.blade.php`

**Padrão atual:** Templates têm HTML hardcoded com valores fixos (ex: `125.000 Kz`, `0 propostas`, jobs fake)
**Solução sistêmica:**
1. Cada template SPA deve ter `initRouteScripts(route)` que:
   - Faz `fetch` para API correspondente
   - Popula template via JS (ou usa Alpine.js/HTMX se migrar)
2. APIs já existem na maioria (`DashboardController@freelancerData`, `JobController@index2`, etc) mas retornam vazio/mock

### 6.2 Event Delegation SPA - Padrão Quebrado ❌ **CRÍTICO**
**Problema:** Scripts externos (`proposta.js`, `mensagens-sala.js`, `painel_freelancer.js`, `painel_cliente.js`) usam `DOMContentLoaded` → não rebindam em navegação SPA
**Solução padronizada:** **Toda lógica de interação deve estar em `initRouteScripts(route)` no blade principal**
- `proposta.js` → mover para `initRouteScripts('propostas')` ✅ (auditoria feita)
- `mensagens-sala.js` → já tem `window.initMensagensSala()` chamado no template, OK
- `painel_freelancer.js` / `painel_cliente.js` → migrar lógica para `initRouteScripts` de cada rota

### 6.3 API Endpoints Faltando / Incompletos
| Endpoint | Controller | Status | Necessário Para |
|----------|------------|--------|-----------------|
| `GET /api/cliente/dashboard` | `DashboardController@clienteData` | ⚠️ vazio | Dashboard cliente |
| `GET /api/freelancer/dashboard` | `DashboardController@freelancerData` | ⚠️ vazio | Dashboard freelancer |
| `GET /api/cliente/jobs` | `JobController` | ❌ | Filtros trabalhos cliente |
| `GET /api/freelancer/proposals` | `ProposalController@index` | ❌ | Lista propostas freelancer |
| `POST /api/jobs` | `JobController@store` | ⚠️ partial | Wizard publicar trabalho |
| `GET /api/chat/{id}/details` | `ChatController` | ❌ | Modal ver detalhes sala |
| `GET /api/wallet/balance` | `WalletController@balance` | ✅ existe | Carteira |
| `POST /api/wallet/deposit` | `WalletController@deposit` | ✅ existe | Carregar saldo |
| `GET /api/categories` | `CategoryController` | ❌ | Página categorias |
| `GET /api/faqs` | `FaqController` | ❌ | FAQ dinâmico |
| `POST /api/reports` | `ReportController` | ❌ | Reportar erro |
| `GET /admin/*` | `AdminController` | ❌ | Painel admin |

### 6.4 Overlay/Modal "Voltar ao Form" ❌ **MÉDIA PRIORIDADE**
- **Requisito:** "Overlay tem de ser camada da página do formulário, quando não validar dados volta ao form"
- **Solução:** Padrão de modal/overlay já existe (`modal-overlay` class). Garantir que validação client-side impede submit e foca campo inválido (já feito no `login.js`). Para forms complexos (wizard), validação por step já planejada.

### 6.5 Notificações Toast/Snackbar Padronizado ⚠️ **PARCIAL**
- **Status:** `showToast` existe em `layouts_freela/show.blade.php:658-678` e `painel_cliente.blade.php` tem versão própria
- **Solução:** Extrair para `public/js/toast.js` global + importar nos blades

---

## 7. MAPEAMENTO ARQUIVO → AÇÃO

| Arquivo | Ações Necessárias | Prioridade |
|---------|-------------------|------------|
| `resources/views/painel/painel_cliente.blade.php` | Completar wizard (review template), mover proposta.js para initRouteScripts, implementar initRouteScripts para trabalhos/propostas/mensagens/carteira, conectar APIs | **CRÍTICA** |
| `resources/views/painel/painel_freelancer.blade.php` | Migrar painel_freelancer.js para initRouteScripts, conectar APIs dashboard/trabalhos/propostas/mensagens/carteira, implementar contador palavras proposta, modal ver detalhes sala | **CRÍTICA** |
| `resources/views/home/inicio.blade.php` | Botão "Ver Tudo" → rota categorias, criar página categorias, página assinatura com plano pré-selecionado, plano business formulário, páginas legais, 404, modal reportar erro | **ALTA** |
| `app/Http/Controllers/AuthController.php` | Corrigir `logout()` para usar apenas invalidação JWT cookie | **ALTA** |
| `app/Http/Controllers/DashboardController.php` | Implementar `clienteData()` e `freelancerData()` com métricas reais | **ALTA** |
| `app/Http/Controllers/JobController.php` | Implementar `index2` para cliente (filtros), `store` para wizard, verificar `publish` | **ALTA** |
| `app/Http/Controllers/ProposalController.php` | Implementar `index` (freelancer), melhorar `store` (success toast, redirect) | **ALTA** |
| `app/Http/Controllers/ChatController.php` | Adicionar `details()` para modal ver detalhes | **ALTA** |
| `app/Http/Controllers/WalletController.php` | Implementar `balance`, `deposit`, `withdraw`, `extrato`, `exportPdf`, `copyIban` | **ALTA** |
| `routes/web.php` | Adicionar rotas: categorias, assinatura, páginas legais, 404, admin, chat details | **ALTA** |
| `routes/api.php` | Adicionar endpoints faltando (ver tabela 6.3) | **ALTA** |
| `public/js/login.js` | Já bom - apenas testar fluxo completo | **BAIXA** |
| `public/js/mensagens-sala.js` | Implementar preview ficheiro WhatsApp, modal confirmação, fluxo entrega/aprovação | **ALTA** |
| `resources/views/layouts_freela/show.blade.php` | Contador palavras carta proposta, success state bonito | **MÉDIA** |
| `app/Services/*` | Verificar se suportam novos endpoints (WalletService, JobService, ChatService, ContractService OK) | **MÉDIA** |

---

## 8. PLANO DE IMPLEMENTAÇÃO SUGERIDO (ORDEM PRÁTICA)

### Fase 1 - Fundação e Críticos (Semana 1-2)
1. **Corrigir logout** (`AuthController::logout`) - 30 min
2. **Mover `proposta.js` para `initRouteScripts`** no painel_cliente - 1h
3. **Completar template `publicar_trabalho_review`** - 2h
4. **Implementar `jobPostingData` persistência + navegação step 1→2** - 3h
5. **Implementar `DashboardController@clienteData/freelancerData`** com métricas reais - 4h
6. **Criar rotas + controllers básicos para APIs faltando** - 4h

### Fase 2 - Wizard Completo (Semana 2-3)
7. **Steps 2, 3, 5: initRouteScripts + validação + hidratação** - 6h
8. **Step 4: integrar budget inputs** - 2h
9. **Step 6 Review: montar resumo + submissão POST /api/jobs** - 4h
10. **Teste ponta-a-ponta wizard** - 2h

### Fase 3 - Dados Dinâmicos Painéis (Semana 3-4)
11. **Filtros trabalhos (cliente + freelancer)** usando `JobController@index2` - 4h
12. **Propostas freelancer dinâmicas** (`ProposalController@index`) - 3h
13. **Carteira: conectar carregar saldo/pedir saque/extrato/IBAN** - 6h
14. **Mensagens: modal ver detalhes + preview ficheiros** - 6h

### Fase 4 - Páginas Públicas e Compliance (Semana 4)
15. **Página categorias** - 3h
16. **Página assinatura com plano pré-selecionado** - 4h
17. **4 páginas legais** - 2h
18. **Página 404 + modal reportar erro** - 2h
19. **FAQ dinâmico** - 2h

### Fase 5 - Admin e Polish (Semana 5)
20. **Painel admin básico** - 8h
21. **Notificações toast global** - 2h
22. **Testes integração + bug fixes** - 8h

---

## 9. RISCOS E MITIGAÇÕES

| Risco | Probabilidade | Impacto | Mitigação |
|-------|---------------|---------|-----------|
| Quebrar SPA ao mover JS para initRouteScripts | Média | Alto | Testar cada rota após migração; manter backup do blade |
| Wizard publicar trabalho complexo | Alta | Alto | Dividir em PRs pequenos por step; testar isoladamente |
| APIs não performarem com dados reais | Baixa | Médio | Usar `withCount`, eager loading, paginação; indexes no DB |
| Inconsistência visual entre painéis | Média | Baixo | Design system já definido nas variáveis CSS; reaproveitar componentes |
| Migração de dados mock → real | Média | Médio | Seeders consistentes; feature flags para rollback |

---

## 10. CHECKLIST RESUMIDO POR PRIORIDADE

### 🔴 CRÍTICO (Bloqueiam fluxos principais)
- [ ] Corrigir logout JWT
- [ ] Mover proposta.js para initRouteScripts (painel cliente)
- [ ] Completar wizard publicar trabalho (6 steps + API)
- [ ] Conectar APIs dashboard (métricas reais)
- [ ] Filtros trabalhos (cliente + freelancer)
- [ ] Propostas freelancer dinâmicas

### 🟠 ALTA (Funcionalidades core incompletas)
- [ ] Página categorias + botão "Ver tudo"
- [ ] Página assinatura com plano pré-selecionado
- [ ] 4 páginas legais (termos/privacidade cliente/freelancer)
- [ ] Carteira: carregar saldo, pedir saque, extrato, IBAN, export PDF
- [ ] Modal ver detalhes sala mensagens
- [ ] Preview ficheiros WhatsApp + fluxo entrega/aprovação
- [ ] Contador palavras carta proposta
- [ ] Perfil freelancer público
- [ ] APIs faltando (tabela 6.3)

### 🟡 MÉDIA (UX e funcionalidades importantes)
- [ ] Plano Business formulário consultor
- [ ] Página 404 personalizada
- [ ] Modal reportar erro
- [ ] Paginação propostas
- [ ] Design chat (fundo verde)
- [ ] FAQ dinâmico
- [ ] Notificações toast global
- [ ] Overlay voltar ao form validação

### 🟢 BAIXA (Nice to have)
- [ ] Persistência wizard em localStorage
- [ ] Stepper visual progresso wizard
- [ ] Confirmação sair wizard dados não salvos
- [ ] Acessibilidade ARIA
- [ ] Testes mobile responsivos

---

## 11. OBSERVAÇÕES FINAIS

1. **Arquitetura SPA atual** funciona bem para navegação, mas **exige disciplina**: toda interação deve estar em `initRouteScripts(route)`. Scripts externos com `DOMContentLoaded` **não funcionam** em SPA.

2. **Backend está 70% pronto**: Services, Models, Controllers base existem. Falta popular controllers com queries reais e criar endpoints faltando.

3. **Frontend está 60% pronto**: Templates bonitos e completos (neo-brutalism, lime/black), mas **dados são estáticos**. A ponte JS→API é o gap principal.

4. **Wizard publicar trabalho** é o item mais complexo - 6 steps com validação, persistência, integração step 4, review dinâmico, submissão API. Recomendo **dedicar 1 dev full-time** por 3-4 dias.

5. **Não quebrar nada**: 
   - Manter rotas atuais funcionando
   - Adicionar novas rotas/controllers (não editar existentes sem teste)
   - Migrar JS gradualmente (testar rota por rota)
   - Usar feature flags se necessário

---

**Documento gerado automaticamente a partir de:**
- `Em falta no projeto skilla.md`
- `Em falta na skilla.md`  
- `Checklist skilla.md`
- Análise completa da codebase (Laravel 11, routes, controllers, services, models, views, JS)

**Próximo passo recomendado, meu querido lorde:** Iniciar pela Fase 1 - corrigir logout e mover `proposta.js` para `initRouteScripts` (vitórias rápidas que desbloqueiam teste imediato), depois atacar o wizard publicar trabalho que é o maior bloco.