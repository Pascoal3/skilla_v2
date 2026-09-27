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

- **Para Freelancer (somente Freelancer)**
    
    - Se `contrato.status_contrato = ativo`:
        - Botão **“Entregar trabalho”** (abre **3.3 Modal Entregar trabalho**)
    - Se `contrato.status_contrato != ativo`:
        - Botão escondido ou desabilitado (exibir motivo: “Contrato concluído/em disputa”)

**Regras de acesso:**

- Só abre a sala quem for `cliente_id` ou `freelancer_id` do contrato.
- Se `status_contrato = em_disputa`:
    - (Recomendado) chat continua, mas mostra banner “Em disputa”.
    - Alternativa: chat somente leitura (mais simples e mais seguro).

---

### 3.3. Modal: **“Entregar trabalho”**

**Usuário:** **Somente Freelancer**

**Componentes:**

- Campo mensagem (opcional): “Notas da entrega”
- Upload (ficheiro/imagem) e/ou link (Drive/GitHub/Figma)
- Botão “Confirmar entrega”
- Botão “Cancelar”

**Regras:**

- Só pode abrir/confirmar se:
    - usuário autenticado = `contrato.freelancer_id`
    - `contrato.status_contrato = ativo`
    - `contrato.status_pagamento = retido` (recomendado garantir que há escrow)
- Ao confirmar:
    - Atualiza contrato: `trabalho_entregue_em = now()`
    - Cria mensagem tipo `entrega` (ou `sistema` + anexo/link)
    - Notifica o cliente