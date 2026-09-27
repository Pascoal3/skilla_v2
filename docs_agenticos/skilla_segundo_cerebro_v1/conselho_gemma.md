controllers, models e etc

### 📂 1. Estrutura de Pastas (Arquitetura Sugerida)

Além das pastas padrão do Laravel, adicionaremos a pasta `Services` e `Repositories`.


```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/               # Login, Registro, Recuperação de Senha
│   │   ├── Client/             # Dashboard Cliente, Gestão de Jobs, Aceite de Propostas
│   │   ├── Freelancer/         # Feed de Jobs, Envio de Propostas, Portfólio
│   │   ├── Admin/              # Gestão de Usuários, Resolução de Disputas
│   │   └── Common/             # Perfil, Carteira, Notificações
│   ├── Middleware/
│   │   └── CheckRole.php       # Verifica se é 'cliente', 'freelancer' ou 'admin'
│   └── Requests/               # Validações (JobRequest, ProposalRequest, etc.)
├── Models/                     # (Todos os modelos baseados no DBML)
├── Services/                   # O "Coração" da Lógica de Negócio
│   ├── PaymentService.php      # Lógica de Recarga e Transferências
│   ├── EscrowService.php       # Lógica de Retenção e Liberação de Fundos
│   ├── JobService.php          # Lógica de Publicação e Expiração
│   └── ProposalService.php     # Lógica de Créditos e Candidaturas
├── Console/
│   └── Commands/
│   │   └── CancelExpiredJobs.php # Cron Job para cancelar vagas
└── Providers/
```

---

### 🛠️ 2. Estrutura de Models (Relacionamentos)

Cada Model deve refletir a modelagem DBML. Exemplos dos principais:

- **Perfil:** `hasMany(Trabalho)`, `hasMany(Proposta)`, `hasOne(Carteira)`, `belongsToMany(Habilidade)`.
- **Trabalho:** `belongsTo(Perfil as Cliente)`, `belongsTo(Categoria)`, `belongsToMany(Habilidade)`, `hasMany(Proposta)`.
- **Proposta:** `belongsTo(Trabalho)`, `belongsTo(Perfil as Freelancer)`.
- **Contrato:** `belongsTo(Trabalho)`, `belongsTo(Proposta)`, `belongsTo(Perfil as Cliente)`, `belongsTo(Perfil as Freelancer)`.
- **TransacaoEscrow:** `belongsTo(Contrato)`, `belongsTo(Carteira as Origem)`, `belongsTo(Carteira as Destino)`.
- **Conversa:** `hasOne(Contrato)`, `hasMany(Mensagem)`.

---

### 🌐 3. Estrutura de APIs / Rotas

Mesmo usando Blade, organize as rotas por grupos de permissão.

#### **Rotas Públicas**

- `GET /` →→ Landing Page
- `GET /jobs` →→ Feed de Jobs (Visualização pública)
- `POST /register` →→ Cadastro

#### **Rotas Autenticadas (Middleware: auth)**

- `GET /profile` →→ Ver perfil
- `PUT /profile/update` →→ Editar perfil
- `GET /wallet` →→ Ver saldo e histórico
- `POST /wallet/recharge` →→ Simular recarga

#### **Rotas do Cliente (Middleware: role:cliente)**

- `GET /client/dashboard` →→ Meus Jobs
- `POST /client/jobs/create` →→ Wizard de 5 passos (Salvar rascunho/publicar)
- `GET /client/jobs/{id}/proposals` →→ Ver propostas recebidas
- `POST /client/proposals/{id}/accept` →→ **(Chama EscrowService)**

#### **Rotas do Freelancer (Middleware: role:freelancer)**

- `GET /freelancer/jobs` →→ Buscar jobs por skills
- `POST /freelancer/proposals/send` →→ **(Chama ProposalService para gastar créditos)**
- `POST /freelancer/contracts/{id}/submit` →→ Entregar trabalho final
- `POST /freelancer/portfolio` →→ Adicionar item ao portfólio

#### **Rotas de Comunicação (Middleware: contract_active)**

- `GET /chat/{contrato_id}` →→ Abrir chat
- `POST /chat/send` →→ Enviar mensagem/arquivo

#### **Rotas Administrativas (Middleware: role:admin)**

- `GET /admin/disputes` →→ Listar disputas abertas
- `POST /admin/disputes/{id}/resolve` →→ Decidir reembolso ou pagamento

---

### ⚙️ 4. Lógica dos Controllers e Services (Exemplos)

Para você não se confundir, veja como a responsabilidade é dividida:

**Exemplo: Aceitar Proposta**

1. **`ProposalController@accept`**:
    - Valida se o usuário é o dono do Job.
    - Chama `EscrowService->createContract($proposalId)`.
    - Retorna resposta de sucesso.
2. **`EscrowService->createContract($proposalId)`**:
    - Inicia uma `DB::beginTransaction()`.
    - Calcula valor da proposta + comissão.
    - Verifica se a `Carteira` do cliente tem saldo.
    - Cria registro em `transacoes_carteiras` (saída).
    - Cria registro em `contratos` (status: ativo).
    - Cria registro em `transacoes_escrow` (status: retido).
    - `DB::commit()`.

---

### 🌱 5. Seeders e Factories (Para Testes)

Você precisará de dados iniciais para o sistema não começar vazio.

- **`CategorySeeder`**: Cria categorias como "Design Gráfico", "Desenvolvimento Web", "Marketing Digital", "Escrita".
- **`SkillSeeder`**: Cria habilidades como "PHP", "Laravel", "Figma", "React", "Photoshop".
- **`UserSeeder`**: Cria 1 Admin, 5 Freelancers (com skills e portfólios) e 5 Clientes (com saldo em carteira).
- **`JobSeeder`**: Cria alguns jobs de exemplo em status 'aberto'.

---

### 🚀 Resumo da Ordem de Implementação (Roadmap Técnico)

Se eu fosse você, seguiria exatamente esta ordem de codificação:

1. **Migrations →→ Models →→ Seeders** (Cria a estrutura do banco e popula os dados).
2. **Auth System** (Login/Register com a coluna `funcao`).
3. **Perfil & Skills** (Telas de edição de perfil e vínculo de habilidades).
4. **Fluxo de Jobs** (Wizard de criação →→ Feed de vagas).
5. **Sistema de Propostas** (Envio de proposta →→ Desconto de créditos →→ Visualização pelo cliente).
6. **Sistema Financeiro (O mais difícil)** (Carteiras →→ Recarga simulada →→ Escrow ao aceitar proposta).
7. **Chat & Entrega** (Conversas vinculadas ao contrato →→ Botão de entrega).
8. **Fechamento** (Aprovação do cliente →→ Liberação do Escrow →→ Avaliações bilaterais).
9. **Automações** (Cron Job para expirar vagas).
10. **Disputas** (Fluxo de cancelamento e reembolso).

**Dica de Ouro:** Use `DB::transaction` em todas as partes financeiras. Se o sistema falhar ao criar o contrato, ele não pode tirar o dinheiro da carteira do cliente. Tudo ou nada!

**Deseja que eu comece a gerar o código de algum desses pontos especificamente (ex: as Migrations ou o EscrowService)?**