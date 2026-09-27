
Este é o seu **Mapa de Implementação**. Seguir esta ordem é fundamental porque o sistema tem muitas dependências (ex: você não pode criar um Contrato sem que exista uma Proposta, e não pode ter uma Proposta sem um Trabalho).

Dividi em **Sprints** para que você não se sinta sobrecarregado.

---

### 🟢 SPRINT 1: A Fundação (Identidade e Acesso)

_O objetivo aqui é ter usuários logados e perfis configurados._

**1. Migrations (Nesta ordem):**

- [ ]  `create_perfis_table`
- [ ]  `create_habilidades_table`
- [ ]  `create_perfil_habilidades_table`
- [ ]  `create_categorias_table`
- [ ]  `create_carteiras_table` (Cada perfil nasce com uma carteira)

**2. Models & Relacionamentos:**

- [ ]  `Perfil` →→ `Carteira`, `Habilidade`
- [ ]  `Habilidade` →→ `Perfil`
- [ ]  `Categoria`

**3. Controllers & Rotas:**

- [ ]  `AuthController` (Register/Login)
- [ ]  `ProfileController` (Edição de bio, foto e seleção de skills)

**4. Seeders:**

- [ ]  `CategoriaSeeder`
- [ ]  `HabilidadeSeeder`

---

### 🔵 SPRINT 2: O Mercado (Demandas e Ofertas)

_O objetivo aqui é permitir que o Cliente publique e o Freelancer encontre trabalho._

**1. Migrations (Nesta ordem):**

- [ ]  `create_trabalhos_table`
- [ ]  `create_trabalho_habilidades_table`
- [ ]  `create_trabalho_anexos_table`
- [ ]  `create_itens_portfolio_table`

**2. Models & Relacionamentos:**

- [ ]  `Trabalho` →→ `Perfil (Cliente)`, `Categoria`, `Habilidade`
- [ ]  `PortfolioItem` →→ `Perfil (Freelancer)`

**3. Services:**

- [ ]  `JobService`: Lógica para salvar rascunhos e publicar trabalho.

**4. Controllers & Rotas:**

- [ ]  `JobController` (Cliente: criar/editar; Freelancer: listar/filtrar)
- [ ]  `PortfolioController` (Freelancer: gerir portfólio)

---

### 🟡 SPRINT 3: A Conexão (Propostas e Créditos)

_O objetivo é o Freelancer "pagar" para se candidatar e o Cliente analisar._

**1. Migrations (Nesta ordem):**

- [ ]  `create_propostas_table`
- [ ]  `create_transacoes_credito_table`

**2. Models & Relacionamentos:**

- [ ]  `Proposta` →→ `Trabalho`, `Perfil (Freelancer)`

**3. Services:**

- [ ]  `ProposalService`: Lógica de verificar saldo de créditos →→ descontar crédito →→ criar proposta.

**4. Controllers & Rotas:**

- [ ]  `ProposalController` (Freelancer: enviar; Cliente: listar e analisar)

---

### 🔴 SPRINT 4: O Coração Financeiro (Escrow e Contratos)

_A parte mais crítica. Transformar a proposta em um compromisso financeiro._

**1. Migrations (Nesta ordem):**

- [ ]  `create_contratos_table`
- [ ]  `create_transacoes_carteiras_table`
- [ ]  `create_transacoes_escrow_table`

**2. Models & Relacionamentos:**

- [ ]  `Contrato` →→ `Trabalho`, `Proposta`, `Perfil (Cliente/Freelancer)`
- [ ]  `TransacaoCarteira` →→ `Carteira`
- [ ]  `TransacaoEscrow` →→ `Contrato`, `Carteira (Origem/Destino)`

**3. Services (A lógica pesada):**

- [ ]  `PaymentService`: Lógica de recarga simulada de saldo na carteira.
- [ ]  `EscrowService`: Lógica de: Aceitar Proposta →→ Tirar dinheiro da carteira →→ Criar Contrato →→ Bloquear no Escrow.

**4. Controllers & Rotas:**

- [ ]  `WalletController` (Recargas e histórico)
- [ ]  `ContractController` (Aceite de proposta e gestão de status)

---

### 🟣 SPRINT 5: Execução e Entrega (Chat e Conclusão)

_Onde o trabalho acontece e o dinheiro é liberado._

**1. Migrations (Nesta ordem):**

- [ ]  `create_conversas_table`
- [ ]  `create_mensagens_table`
- [ ]  `create_avaliacoes_table`
- [ ]  `create_notificacoes_table`

**2. Models & Relacionamentos:**

- [ ]  `Conversa` →→ `Contrato`
- [ ]  `Mensagem` →→ `Conversa`, `Perfil`
- [ ]  `Avaliacao` →→ `Contrato`, `Perfil (Avaliador/Avaliado)`

**3. Services:**

- [ ]  `ChatService`: Gestão de mensagens e arquivos.
- [ ]  `DeliveryService`: Lógica de: Submeter Trabalho →→ Aprovar →→ Liberar Escrow →→ Pagar Freelancer.

**4. Controllers & Rotas:**

- [ ]  `ChatController` (Mensagens em tempo real)
- [ ]  `ReviewController` (Sistema de estrelas)

---

### ⚪ SPRINT 6: Governança e Automação (Finalização)

_Segurança, Admin e limpeza do sistema._

**1. Migrations (Nesta ordem):**

- [ ]  `create_disputas_table`
- [ ]  `create_destaques_table`

**2. Models & Relacionamentos:**

- [ ]  `Disputa` →→ `Contrato`, `Perfil`
- [ ]  `Destaque` →→ `Perfil`

**3. Console Commands (Cron Jobs):**

- [ ]  `CancelExpiredJobs`: Comando que roda diariamente para cancelar jobs vencidos.

**4. Controllers & Rotas:**

- [ ]  `DisputeController` (Admin: resolver disputa e decidir reembolso)
- [ ]  `BoostController` (Freelancer: pagar por destaque)

---

### 📝 Checklist de Validação Final (Antes do Deploy)

- [ ]  **Testar Fluxo Feliz:** Registro →→ Recarga →→ Job →→ Proposta →→ Contrato →→ Entrega →→ Pagamento →→ Avaliação.
- [ ]  **Testar Fluxo de Erro:** Tentar enviar proposta sem créditos.
- [ ]  **Testar Segurança:** Tentar entrar no chat de um contrato que não me pertence.
- [ ]  **Testar Transações:** Simular falha no banco ao criar contrato e ver se o dinheiro não sumiu da carteira (DB Transactions).