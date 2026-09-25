# Auditoria: Wizard "Publicar Trabalho" — Painel do Cliente

**Data:** 25/09/2026  
**Arquivo principal:** `resources/views/painel/painel_cliente.blade.php`  
**Contexto:** SPA client-side (Tailwind + JS vanilla), rotas via hash (`#rota`), templates em `App.templates`.

---

## 1. Estrutura Atual do Wizard

O wizard possui **6 etapas** (5 passos + revisão final), todos com templates completos em `App.templates`:

| Etapa | Template Key | Título | Status do Template |
|-------|--------------|--------|-------------------|
| 1 | `publicar_trabalho_step_1` | Título da vaga | ✅ Completo |
| 2 | `publicar_trabalho_step_2` | Competências | ✅ Completo |
| 3 | `publicar_trabalho_step_3` | Escopo / Duração / Experiência | ✅ Completo |
| 4 | `publicar_trabalho_step_4` | Orçamento (Fixado / Hora) | ✅ Completo + JS (`App.initPublicarTrabalhoStep4`, `App.setBudgetMode`) |
| 5 | `publicar_trabalho_step_5` | Descrição detalhada | ✅ Completo |
| 6 | `publicar_trabalho_review` | Revisão final | ⚠️ **Incompleto** (cortado no meio) |

**Navegação:** Botões `data-route="publicar_trabalho_step_X"` nos footers fixos de cada step.

---

## 2. Estado Atual da Lógica (JS)

### 2.1 Estado Global
```js
window.jobPostingData = { step: 1, title: "" };
```
- Existe mas **não é usado** de forma consistente entre steps.
- Não persiste dados dos steps 2–5.

### 2.2 Roteamento SPA (`render()` + `initRouteScripts()`)
- `render(route)` troca `spaView.innerHTML = App.templates[route]` e chama `initRouteScripts(route)`.
- `initRouteScripts` tem **blocos condicionais por rota**.

### 2.3 O que **já funciona**
| Rota | Lógica implementada |
|------|---------------------|
| `trabalhos` | Abre wizard via `#btn-adicionar-trabalhos` → `render('publicar_trabalho_step_1')` |
| `publicar_trabalho_step_1` | Bind parcial: botão "Voltar" volta para `trabalhos`; botão "Próximo" **só mostra alert** |
| `publicar_trabalho_step_4` | `App.initPublicarTrabalhoStep4()` inicializa tabs Fixado/Hora; `App.setBudgetMode()` exposto globalmente |

### 2.4 O que **NÃO funciona / está faltando**
| Item | Detalhe |
|------|---------|
| **Avanço real step 1 → 2** | `data-wiz-action="next"` só faz `alert('Step 1 OK...')`; não salva título nem muda rota |
| **Persistência entre steps** | `jobPostingData` não é preenchido nos steps 2–5 |
| **Init dos steps 2, 3, 5** | Não há blocos `if (route === 'publicar_trabalho_step_X')` em `initRouteScripts` |
| **Validação por step** | Só step 1 tem validação (title vazio); steps 2–5 sem validação |
| **Botão "Voltar" nos steps 2–5** | Usam `data-route` direto no HTML — funciona para navegação, mas **não restaura dados** já preenchidos |
| **Step 6 (Review)** | Template cortado; não há lógica de montagem do resumo nem envio final |
| **Submissão final (API)** | Ausente — nenhum `fetch` para `/api/jobs` ou similar |
| **Overlay/Modais do wizard** | Não há — o wizard roda full-page dentro do `#spa-view` |

---

## 3. Overlays / Modais Existentes (Referência)

O projeto já usa overlays em outras áreas (podem ser reaproveitados como padrão):

| Overlay | Local | Trigger | Fechamento |
|---------|-------|---------|------------|
| `modal-overlay` (carteira) | `carteira_carregar_saldo` | `[data-open-success-modal]` | `[data-close-modal]` |
| `successModal` | `carteira_carregar_saldo` | Sucesso de recarga | Botões internos |
| `modal-overlay` (proposta) | `trabalho_detalhe` | `[data-open-proposta-modal]` | `[data-close-proposta-modal]` + click fora |
| `deliverModal` | `mensagens_sala` | `#openDeliverModalBtn` | Botões + click fora |

**Padrão:** `fixed inset-0 z-[50-60] bg-obsidian/80 backdrop-blur` + `hidden`/`flex` toggle.

---

## 4. Checklist do que Precisa Ser Feito

### 4.1 Estado & Persistência (Prioridade Alta)
- [ ] Estender `jobPostingData` com campos de todos os steps:
  ```js
  {
    step: 1,
    title: "",
    skills: [],           // step 2
    scope: { size, duration, experience, conversion }, // step 3
    budget: { type: 'fixed'|'hourly', amountMin, amountMax, ... }, // step 4
    description: "",      // step 5
    attachments: []       // step 5 (opcional)
  }
  ```
- [ ] Criar helpers `saveStepData(step, data)` / `loadStepData(step)` que atualizam `jobPostingData`.
- [ ] No `render()`, **antes** de trocar template, salvar dados do step atual (via `beforeUnload` ou bind no botão "Próximo").

### 4.2 Navegação Real entre Steps (Prioridade Alta)
- [ ] Substituir `alert('Step 1 OK...')` por:
  ```js
  jobPostingData.title = value;
  jobPostingData.step = 2;
  render('publicar_trabalho_step_2');
  ```
- [ ] Adicionar blocos `initRouteScripts` para steps 2, 3, 5:
  - Bind "Voltar" → `render(stepAnterior)` (dados já estão em `jobPostingData`)
  - Bind "Próximo" → valida → salva → `render(stepSeguinte)`
  - Hidratar inputs com `jobPostingData` ao entrar no step.

### 4.3 Validação por Step (Prioridade Média)
| Step | Campos obrigatórios | Validação sugerida |
|------|---------------------|-------------------|
| 1 | `title` (min 5 chars) | Já parcial |
| 2 | `skills.length >= 1` | Checar chips selecionados |
| 3 | `scope.size`, `scope.duration`, `scope.experience` | Radio/select checados |
| 4 | `budget.type` + valores | Se fixo: valor > 0; se hora: min/max preenchidos |
| 5 | `description.length >= 50` | Contador de caracteres |

### 4.4 Step 4 — Orçamento (Já tem JS, precisa integração)
- `App.initPublicarTrabalhoStep4()` já inicializa tabs.
- **Faltando:** ler valores dos inputs (fixo/hora) ao clicar "Próximo" e salvar em `jobPostingData.budget`.

### 4.5 Step 6 — Revisão Final (Prioridade Alta)
- [ ] Completar template `publicar_trabalho_review` (está cortado).
- [ ] Montar resumo lendo `jobPostingData` (title, skills, scope, budget, description).
- [ ] Botão "Publicar vaga" → `POST /api/jobs` com payload completo.
- [ ] Sucesso → toast/overlay + `render('trabalhos')` ou `render('inicio')`.
- [ ] Erro → mostrar inline / overlay de erro.

### 4.6 API / Backend (Fora do escopo frontend, mas necessário)
- [ ] Endpoint `POST /api/jobs` (ou similar) que aceita o payload do wizard.
- [ ] Resposta: `{ success: true, jobId, url }` ou erro estruturado.
- [ ] CSRF token já disponível em `meta[name="csrf-token"]`.

### 4.7 UX / Polish (Prioridade Baixa)
- [ ] Indicador de progresso (stepper visual) no header de cada step — já existe barra no footer, mas não no topo.
- [ ] Persistência em `localStorage` para sobreviver a refresh acidental.
- [ ] Confirmação ao sair do wizard com dados não salvos (`beforeunload`).
- [ ] Acessibilidade: `aria-live` nos erros, foco automático no primeiro campo inválido.
- [ ] Mobile: footers fixos já têm media queries, testar em < 640px.

---

## 5. Arquivos / Locais de Alteração

| Arquivo | O que mexer |
|---------|-------------|
| `resources/views/painel/painel_cliente.blade.php` | **Único arquivo** — templates + JS inline. Todas as alterações aqui. |
| (Opcional) `public/js/wizard-publicar-trabalho.js` | Extrair lógica do wizard para arquivo separado (recomendado para manutenção). |

---

## 6. Plano de Ação Sugerido (Ordem Prática)

1. **Completar template `publicar_trabalho_review`** (copiar padrão dos outros steps, montar resumo via JS).
2. **Estender `jobPostingData`** com todos os campos.
3. **Implementar `saveStepData/loadStepData`** e chamar nos botões "Próximo"/"Voltar".
4. **Adicionar blocos `initRouteScripts` para steps 2, 3, 5** (hidratação + validação + navegação).
5. **Integrar step 4**: ler inputs dos painéis fixo/hora no "Próximo".
6. **Implementar submissão final no Review** (`fetch` + tratamento de resposta).
7. **Teste ponta-a-ponta**: Início → Título → Skills → Escopo → Orçamento → Descrição → Review → Publicar.
8. **Refatorar** (opcional): mover JS do wizard para `public/js/wizard-publicar-trabalho.js` e importar no blade.

---

## 7. Observações Finais

- O **visual está pronto** (5 steps + review com design consistente, neo-brutalism, lime/black).
- A **arquitetura SPA** já suporta navegação por hash e `render()` — basta ligar os pontos.
- **Nenhum overlay novo é necessário** para o fluxo principal; o wizard roda full-page no `#spa-view`. Overlays só se quiser confirmar saída ou mostrar sucesso/erro final.
- O template `publicar_trabalho_review` **está truncado** no arquivo — precisa ser completado (ver linhas ~3977–4019).

---

**Próximo passo recomendado:** Completar o template de Review e implementar a persistência `jobPostingData` + navegação real step 1→2. O resto segue o mesmo padrão.