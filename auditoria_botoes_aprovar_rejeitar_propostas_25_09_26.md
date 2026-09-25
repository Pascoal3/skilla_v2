# Auditoria: Botões Aprovar/Rejeitar Propostas — Painel do Cliente

**Data:** 25/09/2026  
**Arquivos envolvidos:**
- `resources/views/painel/painel_cliente.blade.php` (template + SPA JS inline)
- `public/js/proposta.js` (lógica atual dos botões)

---

## 1. O Problema

**Sintoma:** Clicar em "Aprovar" (`.js-aceitar`) ou "Rejeitar" (`.js-rejeitar`) **não faz nada** na primeira navegação SPA. Só funciona após **recarregar a página inteira (F5)**.

**Comportamento esperado:**
- Clica "Aprovar" → status "Pendente" → "Aceito" (verde) + botões somem (`display: none`)
- Clica "Rejeitar" → status "Pendente" → "Rejeitado" (vermelho) + botões somem

---

## 2. Causa Raiz

### 2.1 Como está hoje

| Camada | O que faz |
|--------|-----------|
| `painel_cliente.blade.php:116` | `<script src="{{ asset('js/proposta.js') }}" defer></script>` — carrega o JS **uma vez** no load inicial |
| `public/js/proposta.js:1` | `document.addEventListener("DOMContentLoaded", ...)` — roda **uma única vez** quando o HTML original carrega |
| `proposta.js:29` | `view.addEventListener("click", ...)` — faz **event delegation** no `#view-propostas-freela` que existia no load inicial |

### 2.2 Por que falha no SPA

1. **Navegação SPA** (`#propostas`) chama `render('propostas')` → substitui `spaView.innerHTML` pelo template `App.templates.propostas`
2. O **novo HTML** tem os botões `.js-aceitar` / `.js-rejeitar` e cards `.neo-card`
3. Mas o **listener do `proposta.js`** ficou anexado no **antigo** `#view-propostas-freela` (que foi removido do DOM)
4. O `DOMContentLoaded` **não dispara novamente** — é evento de página, não de SPA

**Resultado:** Zero listeners ativos nos botões renderizados via SPA.

### 2.3 Por que "funciona após F5"

- F5 = navegação **não-SPA** (request HTTP completo)
- `DOMContentLoaded` dispara
- `proposta.js` roda e anexa no `#view-propostas-freela` que **já está no HTML inicial** (se a rota inicial for `propostas`) ou não roda nada (se a rota inicial for outra)

---

## 3. Estrutura Atual dos Cards (Template)

```html
<!-- Card com status "Pendente" — tem botões -->
<div class="neo-card bg-white border-2 border-background rounded-xxl p-6">
  <div class="flex justify-between items-start mb-6">
    <h2>Título do Trabalho</h2>
    <span class="bg-[#FFD700] text-background px-4 py-1 rounded-full ...">Pendente</span>
  </div>
  ...
  <div class="flex justify-end gap-4 mt-8 divDosIcones">
    <button class="... js-aceitar"><span class="material-symbols-outlined">check_circle</span></button>
    <button class="... js-rejeitar"><span class="material-symbols-outlined">cancel</span></button>
  </div>
</div>

<!-- Cards "Aceito" / "Rejeitado" — SEM botões (já vêm do template estático) -->
<span class="bg-[#4CAF50] ...">Aceito</span>
<span class="bg-[#FF5252] ...">Rejeitado</span>
```

**Observação:** O template é **estático** (hardcoded no `App.templates.propostas`). Não há dados dinâmicos vindos de API — tudo é mock.

---

## 4. Solução Correta (Padrão do Projeto)

O projeto já usa o padrão: **toda lógica de rota vai em `initRouteScripts(route)`** dentro do blade.

### 4.1 O que fazer

**Remover** a dependência do `proposta.js` externo e **mover a lógica para dentro do `initRouteScripts`**, num bloco `if (route === 'propostas')`.

### 4.2 Código a adicionar em `initRouteScripts` (linhas ~4460+)

```javascript
if (route === 'propostas') {
    const view = spaView.querySelector('#view-propostas-freela');
    if (!view) return;

    const baseClasses = [
        "text-white", "px-4", "py-1", "rounded-full",
        "font-label-md", "text-label-md", "border", "border-background"
    ];

    function getSpanEstado(card) {
        return card.querySelector(".flex.justify-between.items-start span");
    }

    function isPendente(card) {
        const span = getSpanEstado(card);
        return span && span.textContent.trim().toLowerCase() === "pendente";
    }

    function setEstado(card, texto, bgClass) {
        const span = getSpanEstado(card);
        if (!span) return;
        span.className = "";
        span.classList.add(bgClass, ...baseClasses);
        span.textContent = texto;
    }

    // Event delegation no container que SEMPRE existe no SPA
    view.addEventListener("click", (e) => {
        const btn = e.target.closest("button");
        if (!btn) return;

        const card = btn.closest(".neo-card");
        if (!card) return;

        const aceitar = btn.classList.contains("js-aceitar");
        const rejeitar = btn.classList.contains("js-rejeitar");
        if (!aceitar && !rejeitar) return;

        if (!isPendente(card)) return; // só age se estiver pendente

        if (aceitar) setEstado(card, "Aceito", "bg-[#4CAF50]");
        if (rejeitar) setEstado(card, "Rejeitado", "bg-[#FF5252]");

        // Esconde os botões
        const divIcones = card.querySelector(".divDosIcones");
        if (divIcones) divIcones.classList.add("hidden");
    });
}
```

### 4.3 Opcional: Limpar `proposta.js`

Depois de testar, pode **apagar** ou **esvaziar** `public/js/proposta.js` e remover a linha 116 do blade:
```html
<!-- REMOVER -->
<script src="{{ asset('js/proposta.js') }}" defer></script>
```

---

## 5. Checklist de Implementação

| Item | Status | Nota |
|------|--------|------|
| [ ] Adicionar bloco `if (route === 'propostas')` em `initRouteScripts` | **Pendente** | Copiar lógica de `proposta.js` adaptada para `spaView` |
| [ ] Testar navegação SPA: `inicio` → `propostas` → clicar Aprovar/Rejeitar | **Pendente** | Verificar mudança de cor + hide dos botões |
| [ ] Testar navegar para outra rota e voltar (`trabalhos` → `propostas`) | **Pendente** | Listeners devem seguir vivos (event delegation no `view`) |
| [ ] Remover `<script src="{{ asset('js/proposta.js') }}" defer>` do blade | **Pendente** | Após confirmar funcionando |
| [ ] (Futuro) Substituir template estático por dados reais de API | **Backlog** | Hoje é tudo mock no `App.templates.propostas` |

---

## 6. Por Que Não É "Defer" O Problema

O `defer` só garante que o script execute **depois do parse do HTML inicial**. O problema real é **ciclo de vida SPA vs. `DOMContentLoaded`**:

| Cenário | `DOMContentLoaded` | `render('propostas')` |
|---------|-------------------|----------------------|
| Load inicial (rota = propostas) | ✅ Dispara | ❌ Não chamado |
| Load inicial (rota ≠ propostas) | ✅ Dispara (view não existe) | ✅ Chamado depois via click |
| Navegação SPA posterior | ❌ Não dispara | ✅ Chamado |

**Conclusão:** Qualquer lógica que dependa de elementos renderizados via `render()` **deve** estar em `initRouteScripts(route)`.

---

## 7. Arquivo de Auditoria

Salvo em: `auditoria_botoes_aprovar_rejeitar_propostas_25_09_26.md`

---

**Próximo passo recomendado, meu querido lorde:** Quer que eu aplique a correção diretamente no `painel_cliente.blade.php` adicionando o bloco `if (route === 'propostas')` no `initRouteScripts`?