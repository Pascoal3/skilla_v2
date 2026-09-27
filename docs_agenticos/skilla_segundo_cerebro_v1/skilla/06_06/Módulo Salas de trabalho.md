## 1) O que o módulo de “Mensagens / Salas de Trabalho” precisa cobrir (escopo)

### 1.1. Chat em tempo real (estilo WhatsApp)

- **Lista de conversas** (inbox) com:
    - nome da sala (ex: _“Sala de trabalho — Logo Skilla”_)
    - última mensagem + hora
    - contador de não lidas
- **Tela de conversa** com:
    - mensagens em bolhas (cliente vs freelancer)
    - envio de texto
    - envio de anexos (ficheiro/imagem)
    - “visto / lida” (mínimo: lida/não lida)
    - scroll infinito / paginação (carregar mensagens antigas)

### 1.2. Sala vinculada ao contrato (regra central)

- A conversa **não é livre**: ela nasce de um **contrato**.
- Só pode participar:
    - `contrato.cliente_id`
    - `contrato.freelancer_id`
- Uma sala por contrato (o teu BD já indica `conversas.contrato_id unique`).

### 1.3. Ações de “aprovar” e “reprovar” dentro da sala

Dentro da sala (no topo, igual “header” do WhatsApp), mostrar um **card de status** do trabalho/contrato com botões:

- **Entregar trabalho** (freelancer)
- **Aprovar** (cliente) → modal confirmação
- **Reprovar / Abrir disputa** (cliente) → modal confirmação

> Importante: “reprovar permanente” sem disputa é arriscado. No teu projeto, o caminho natural é **Reprovar → abrir disputa** (com fundos congelados). Reprovar “sem disputa” quase sempre vira problema real (o freelancer fica sem mecanismo formal).

### 1.4. Estados que o chat deve respeitar

- Contrato **ativo**: chat aberto + botões habilitados
- Contrato **em_disputa**: chat pode ficar **somente leitura** ou continuar (mas com aviso “Em disputa”).
- Contrato **concluido/cancelado**: chat pode ficar **somente leitura** (histórico), anexos ainda acessíveis.

### 1.5. Notificações e presença (mínimo viável)

- Notificação (in-app) quando:
    - nova mensagem
    - freelancer entregou
    - cliente aprovou / reprovou (abriu disputa)
- Presença “online” é opcional; o essencial é **entrega confiável** das mensagens.

---

## 2) O que é essencial e você não mencionou (para não dar problemas na defesa)

### 2.1. “Entregas” não devem ser só texto no chat

Cria um conceito de **entrega do trabalho** (mesmo que simples) para formalizar:

- quando foi entregue
- o que foi entregue (link/arquivo)
- permite bloquear “aprovar” sem haver entrega

**MVP:** pode ser uma mensagem especial do tipo `entrega` (ver ajuste de DB abaixo), com campos de arquivo/link.

### 2.2. Leitura / não lidas por usuário (do jeito certo)

Hoje `mensagens.lida boolean` é fraco, porque:

- uma mensagem tem 2 participantes, mas “lida” depende de **quem** leu
- para lista de conversas, você precisa de contador e último lido

**MVP recomendado (sem explodir prazo):**

- na tabela `conversas`, adicionar:
    - `ultimo_lido_cliente_em`
    - `ultimo_lido_freelancer_em`  
        Assim você calcula “não lidas” por comparação com `mensagens.criado_em`.

### 2.3. Rate limit e anti-spam (para não derrubar o sistema)

- limitar envio: ex. 5 msgs/seg por conversa
- validar tamanho de mensagem e tipos de ficheiro
- bloquear anexos grandes (ex: 10MB)

### 2.4. Autorização forte (segurança)

- policies/guards garantindo que só cliente/freelancer do contrato:
    - podem abrir a sala
    - podem enviar mensagem
    - podem anexar ficheiro
    - podem aprovar/reprovar

### 2.5. Auditoria do “aprovar / reprovar”

A aprovação e reprovação são eventos críticos ligados ao dinheiro.

- salvar logs (pode ser via `transacoes_escrow`, timestamps no contrato e/ou mensagens de sistema)
- evitar duplo clique (idempotência)

---

## 3) Telas (UI) necessárias + o que cada uma deve ter (estilo WhatsApp)

### 3.1. Tela: “Mensagens” (Inbox / Lista de salas)

**Objetivo:** listar salas de trabalho.

**Componentes:**

- Search input (“Pesquisar conversas”)
- Lista com itens:
    - Avatar (cliente/freelancer)
    - Nome da sala: **“Sala de trabalho — {titulo_trabalho}”**
    - Última mensagem (preview)
    - Hora
    - Badge de não lidas

**Regras:**

- Mostrar somente conversas onde o usuário é cliente ou freelancer.
- Ordenar por `ultima_mensagem_em DESC`.

---

### 3.2. Tela: “Sala de trabalho” (Conversa)

**Objetivo:** conversar + controlar a execução/fecho do contrato.

**Header (topo, estilo WhatsApp):**

- Nome: “Sala de trabalho — Logo Skilla”
- Subtexto: “Contrato #... • Status: Ativo/Em disputa/Concluído”
- Botão “Ver detalhes” (abre drawer/modal)

**Painel “Detalhes do trabalho” (drawer/modal):**

- Título do job, orçamento/valor acordado, prazo, status
- Link “Abrir Job” (readonly) / “Ver proposta aceita”
- Estado do pagamento: retido / liberado / devolvido

**Área de mensagens:**

- Bolhas alinhadas esquerda/direita
- Mensagens de sistema destacadas:
    - “Freelancer entregou o trabalho”
    - “Cliente aprovou o trabalho”
    - “Disputa aberta”

**Composer (barra inferior):**

- Input texto
- Botão anexo (upload)
- Botão enviar

**Ações (importante para teu fluxo):**

- Se usuário = freelancer e contrato ativo:
    - Botão **“Entregar trabalho”** (abre modal)
- Se usuário = cliente e existe entrega pendente de decisão:
    - Botões: **“Aprovar”** e **“Reprovar”**

---

### 3.3. Modal: “Entregar trabalho” (freelancer)

**Componentes:**

- Campo mensagem (opcional): “Notas da entrega”
- Upload (ficheiro/imagem) e/ou link do drive
- Botão “Confirmar entrega”
- Botão “Cancelar”

**Regras:**

- Marca no contrato: `trabalho_entregue_em = now()`
- Cria mensagem tipo `entrega` (ou `arquivo/link` + flag)

---

### 3.4. Modal: “Confirmar aprovação” (cliente)

Texto: “Confirma que aprova o trabalho? O freelancer receberá o valor acordado.”

- Botões: Confirmar / Cancelar

**Backend (ao confirmar):**

- `EscrowService->liberar(contrato)`
- Atualiza `contratos.aprovado_em` + `status_contrato=concluido`

---

### 3.5. Modal: “Reprovar / abrir disputa”

Texto recomendado (mais alinhado ao teu RF05):  
“Pretende reprovar a entrega e abrir uma disputa? Os fundos ficarão congelados até resolução.”

- Botões: Confirmar / Cancelar

**Backend:**

- cria `disputas` (status `aberta`)
- atualiza `contratos.status_contrato = em_disputa`
- (escrow permanece `retido`)

> Se você insistir no “reprovar permanente” sem disputa, defina claramente o que acontece ao escrow (continua retido? reembolsa? cancela?). Para defesa, “Reprovar = Disputa” é mais coerente e seguro.

---

## 4) Fluxos principais (end-to-end)

### 4.1. Aceitar proposta → criar sala

1. Cliente aceita proposta
2. Backend cria:
    - `contratos`
    - `conversas` vinculada ao contrato (`contrato_id unique`)
3. Notificações:
    - freelancer notificado: “Proposta aceita — sala criada”
4. UI:
    - ambos veem a conversa no inbox

---

### 4.2. Enviar mensagem em tempo real

1. Usuário envia mensagem
2. Backend:
    - autoriza participante
    - salva em `mensagens`
    - atualiza `conversas.ultima_mensagem_em`
3. WebSocket:
    - broadcast para o outro participante (canal da conversa/contrato)
4. O receptor marca como não lida até abrir a sala.

---

### 4.3. Marcar como lida

1. Ao abrir a sala, frontend chama endpoint “marcar como lida”
2. Backend atualiza:
    - `conversas.ultimo_lido_cliente_em` ou `ultimo_lido_freelancer_em`

---

### 4.4. Entrega → Aprovação/Reprovação

- freelancer entrega (mensagem tipo entrega + timestamp no contrato)
- cliente aprova → libera escrow + fecha contrato
- cliente reprova → abre disputa + congela

---

## 5) Ajustes recomendados na modelagem (mínimos e muito úteis)

### 5.1. Conversas: último lido por participante (essencial)

Adicionar em `conversas`:

- `ultimo_lido_cliente_em timestamp null`
- `ultimo_lido_freelancer_em timestamp null`

### 5.2. Mensagens: “tipo sistema/entrega” (para formalizar eventos)

Seu DB já tem `tipo_mensagem`. Padronize:

- `texto`
- `arquivo`
- `imagem`
- `sistema` (ex: “cliente aprovou”)
- `entrega` (opcional, mas ajuda muito)

E campos úteis:

- `metadata json` (opcional) para guardar coisas como `entrega_links[]`, `nome_arquivo`, etc.

### 5.3. Índices (performance do inbox)

- `mensagens (conversa_id, criado_em)`
- `conversas (cliente_id, ultima_mensagem_em)`
- `conversas (freelancer_id, ultima_mensagem_em)`

---

## 6) Camadas Laravel (o que criar)

### 6.1. Policies (obrigatório)

- `ConversaPolicy`: view/sendMessage/markRead
- `ContratoPolicy`: approve/reject/dispute/deliver

### 6.2. Events + Broadcasting (WebSockets)

**Eventos:**

- `MessageSent`
- `WorkDelivered`
- `WorkApproved`
- `DisputeOpened`

**Canais:**

- `private-conversa.{conversaId}` ou `private-contrato.{contratoId}`  
    **Autorização do canal:** só cliente/freelancer do contrato.

### 6.3. Services (regra de negócio fora do controller)

- `ChatService`
    - `sendMessage(conversa, remetente, payload)`
    - `markAsRead(conversa, user)`
- `DeliveryService`
    - `deliverWork(contrato, freelancer, payload)`
- `ContractDecisionService`
    - `approve(contrato, cliente)` → chama `EscrowService->liberar`
    - `rejectAndOpenDispute(contrato, cliente, motivo)` → cria disputa

---

## 7) Rotas sugeridas (mínimo viável)

- `GET /mensagens` (inbox)
- `GET /conversas/{conversa}` (abrir sala)
- `GET /conversas/{conversa}/mensagens?before=...` (paginação)
- `POST /conversas/{conversa}/mensagens` (enviar)
- `POST /conversas/{conversa}/lidas` (marcar lida)

Ações do contrato dentro da sala:

- `POST /contratos/{contrato}/entregar`
- `POST /contratos/{contrato}/aprovar`
- `POST /contratos/{contrato}/reprovar` (abre disputa)

---

## 8) Ordem de implementação (plano exequível para defender em breve)

1. **Migrations pequenas**: ultimo_lido_* em conversas + índices + (opcional) metadata/tipo_mensagem padronizado
2. **Inbox UI** (estilo WhatsApp) lendo `conversas` e última msg
3. **Sala UI** (layout WhatsApp) + carregamento/paginação de mensagens
4. **Envio de mensagens (HTTP)** salvando no BD (sem real-time ainda)
5. **WebSockets** (Reverb/Pusher): broadcast `MessageSent` para atualizar em tempo real
6. **Marcar como lida** (ultimo_lido_*), badge de não lidas no inbox
7. **Upload de anexos** (Storage + validação)
8. **Entrega do trabalho** (modal + mensagem tipo `entrega` + `contratos.trabalho_entregue_em`)
9. **Aprovar/Reprovar** (modais + endpoints):
    - Aprovar → `EscrowService->liberar()` + mensagem de sistema
    - Reprovar → cria disputa + mensagem de sistema
10. **Polish para defesa**:

- bloquear botões conforme status
- mensagens de sistema bem visíveis
- “Detalhes do contrato” no drawer

---

## 9) Melhorias rápidas (alto impacto, baixo custo)

- **Mensagens de sistema** para cada etapa (aceite, entrega, aprovado, disputa) → aumenta clareza na demo
- **Drawer “Detalhes do trabalho”** dentro da sala (mostra valor, prazo, status pagamento)
- **Somente leitura quando concluído** (evita bugs e deixa profissional)
- **Idempotência** nos endpoints de aprovar/reprovar (evitar duplo clique liberar duas vezes)