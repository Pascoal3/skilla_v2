### 3.1. Tela: **“Mensagens” (Inbox / Lista de salas)**

**Usuário:** **Ambos (Cliente e Freelancer)**

**Objetivo:** listar salas de trabalho (conversas) associadas a contratos.

**Componentes:**

- Search input (“Pesquisar conversas”)
- Lista com itens:
    - Avatar do outro participante
    - Nome da sala: **“Sala de trabalho — {titulo_trabalho}”**
    - Última mensagem (preview)
    - Hora
    - Badge de não lidas

**Regras:**

- Mostrar somente conversas onde:
    - `conversas.cliente_id = auth()->id()` **OU**
    - `conversas.freelancer_id = auth()->id()`
- Ordenar por `ultima_mensagem_em DESC`.
- Ao clicar numa conversa, abre **3.2 Sala de trabalho**.

---

### 3.2. Tela: **“Sala de trabalho” (Conversa)**

**Usuário:** **Ambos (Cliente e Freelancer)**  
_(mesma tela, mas ações/botões variam conforme função e estado do contrato)_

**Objetivo:** conversar em tempo real + gerir entrega/aprovação/disputa do contrato.

**Header (topo, estilo WhatsApp):**

- Nome: “Sala de trabalho — {Título do Job}”
- Subtexto: “Contrato #... • Status: Ativo/Em disputa/Concluído”
- Botão “Ver detalhes” (abre drawer/modal)

**Painel “Detalhes do trabalho” (drawer/modal)**  
**Usuário:** **Ambos**

- Título do job, valor acordado, prazo, status do contrato
- Link “Abrir Job” (readonly) / “Ver proposta aceita”
- Estado do pagamento: `retido` / `liberado` / `devolvido_cliente`

**Área de mensagens**  
**Usuário:** **Ambos**

- Bolhas alinhadas esquerda/direita (remetente vs destinatário)
- Mensagens de sistema destacadas:
    - “Freelancer entregou o trabalho”
    - “Cliente aprovou o trabalho”
    - “Disputa aberta”

**Composer (barra inferior)**  
**Usuário:** **Ambos** _(se contrato permitir chat)_

- Input texto
- Botão anexo (upload)
- Botão enviar

**Ações (barra/área fixa dentro da sala — varia por usuário):**

- **Para Cliente (somente Cliente)**
    
    - Se existir entrega pendente (ex: `contrato.trabalho_entregue_em != null` e `contrato.aprovado_em == null` e `contrato.status_contrato = ativo`):
        - Botões:
            - **“Aprovar”** (abre **3.4 Modal Confirmar aprovação**)
            - **“Reprovar”** (abre **3.5 Modal Reprovar / abrir disputa**)
    - Se ainda não houver entrega:
        - Botões não aparecem (ou aparecem desabilitados com tooltip “Aguardando entrega”)

**Regras de acesso:**

- Só abre a sala quem for `cliente_id` ou `freelancer_id` do contrato.
- Se `status_contrato = em_disputa`:
    - (Recomendado) chat continua, mas mostra banner “Em disputa”.
    - Alternativa: chat somente leitura (mais simples e mais seguro).

---

### 3.4. Modal: **“Confirmar aprovação”**

**Usuário:** **Somente Cliente**

Texto: “Confirma que aprova o trabalho? O freelancer receberá o valor acordado.”

**Componentes:**

- Botões: “Confirmar” / “Cancelar”

**Regras:**

- Só pode aprovar se:
    - usuário = `contrato.cliente_id`
    - `contrato.status_contrato = ativo`
    - `contrato.status_pagamento = retido`
    - existe entrega (`trabalho_entregue_em != null`)
- Ao confirmar (backend):
    - `EscrowService->liberar(contrato)`
    - Atualiza:
        - `contratos.aprovado_em = now()`
        - `contratos.status_contrato = concluido`
    - Cria mensagem de sistema “Cliente aprovou o trabalho”
    - Notifica freelancer

---

### 3.5. Modal: **“Reprovar / abrir disputa”**

**Usuário:** **Somente Cliente**

Texto: “Pretende reprovar a entrega e abrir uma disputa? Os fundos ficarão congelados até resolução.”

**Componentes:**

- (Recomendado) Campo “Motivo da disputa” (obrigatório, curto)
- Botões: “Confirmar” / “Cancelar”

**Regras:**

- Só pode reprovar/abrir disputa se:
    - usuário = `contrato.cliente_id`
    - `contrato.status_contrato = ativo`
    - `contrato.status_pagamento = retido`
    - existe entrega (`trabalho_entregue_em != null`) _(opcional, mas recomendado)_
- Ao confirmar (backend):
    - cria `disputas` (status `aberta`, `aberta_por = cliente_id`)
    - atualiza `contratos.status_contrato = em_disputa`
    - escrow permanece `retido`
    - cria mensagem de sistema “Disputa aberta”
    - notifica freelancer (e admin se existir)