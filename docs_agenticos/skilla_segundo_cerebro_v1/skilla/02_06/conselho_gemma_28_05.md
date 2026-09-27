Sobre o banco skilla

Para configurar o backend da **Skilla** com segurança e organização, você não deve tentar criar tudo de uma vez. O segredo de sistemas financeiros e de marketplace é a **estratégia de camadas**.

Abaixo está o seu **Plano de Ação Passo a Passo**.

---

### 🛠️ Fase 1: Fundação e Infraestrutura de Segurança

Antes de criar as tabelas, precisamos preparar o Laravel para lidar com UUIDs e segurança financeira.

1. **Configuração de UUIDs:** Como sua modelagem usa `uuid [pk]`, o Laravel não fará isso automaticamente (ele usa inteiros).
    - **Ação:** Crie um `Trait` chamado `HasUuid` para ser usado em todas as Models. Este trait deve sobrescrever o método `booting` para gerar o UUID ao criar o registro.
2. **Segurança de Autenticação:**
    - **Ação:** Instale o **Laravel Sanctum** (para APIs) ou configure o **Breeze/Jetstream** (se for Blade).
    - **Ação:** Configure o `password_hash` para usar **Argon2id** (definido no `config/hashing.php`), que é mais seguro que o Bcrypt.
3. **Middleware de Funções (Roles):**
    - **Ação:** Crie um Middleware chamado `CheckRole`. Ele deve verificar a coluna `funcao` na tabela `perfis` (cliente | freelancer | admin). Se um freelancer tentar acessar a rota de "Publicar Job", o middleware bloqueia.

---

### 👤 Fase 2: Gestão de Identidade (Perfil e Skills)

Aqui criamos a base de quem é quem na plataforma.

1. **Migrations:**
    - `perfis` (Cuidado: renomeie a tabela `users` padrão do Laravel para `perfis` ou faça a Model `User` apontar para a tabela `perfis`).
    - `categorias` →→ `habilidades` →→ `perfil_habilidades`.
2. **Models:**
    - `Perfil`: Defina os relacionamentos `belongsToMany` para Habilidades.
    - `Habilidade` e `Categoria`.
3. **Controllers:**
    - `AuthController`: Registro e Login.
    - `PerfilController`: Atualização de bio, foto e skills.

---

### 💼 Fase 3: Ciclo de Vida do Trabalho (Jobs)

Agora implementamos a lógica de "Rascunho →→ Publicado".

1. **Migrations:**
    - `trabalhos` →→ `trabalho_habilidades` →→ `trabalho_anexos`.
2. **Models:**
    - `Trabalho`: Implemente **Scopes** no Eloquent. Ex: `scopeAbertos($query)` para filtrar apenas trabalhos com `status = 'aberto'`.
3. **Controllers:**
    - `JobController`:
        - `store()`: Salva como `status = 'rascunho'`.
        - `publish()`: Valida se todos os campos obrigatórios estão preenchidos e altera para `status = 'aberto'`.
4. **Segurança:**
    - **Policy:** Crie `JobPolicy` para garantir que apenas o dono do job possa editá-lo ou publicá-lo.

---

### 💰 Fase 4: O "Banco Skilla" (Financeiro e Escrow)

Esta é a parte mais crítica. **Não use Controllers simples aqui, use Services.**

1. **Migrations:**
    - `carteiras` →→ `transacoes_carteiras` →→ `propostas` →→ `contratos` →→ `transacoes_escrow`.
2. **A Camada de Serviço (`PaymentService`):**
    - Não coloque a lógica de dinheiro no Controller. Crie uma classe `App\Services\PaymentService`.
    - **Método `executeEscrow()`**: Deve usar `DB::transaction` para tirar dinheiro do cliente e criar o registro no escrow.
    - **Método `releasePayment()`**: Deve calcular a comissão, creditar o freelancer e creditar a carteira da plataforma.
3. **Models:**
    - `Carteira`: Use o método `lockForUpdate()` em todas as consultas de saldo para evitar _Race Conditions_.
    - `TransacaoCarteira`: Registre cada movimento (quem enviou, quem recebeu).
4. **Controllers:**
    - `ProposalController`: Gestão de propostas e gasto de créditos.
    - `ContractController`: Aceite de proposta e trigger do pagamento Escrow.

---

### 💬 Fase 5: Comunicação e Finalização

O sistema de chat e a entrega do valor.

1. **Migrations:**
    - `conversas` →→ `mensagens` →→ `avaliacoes` →→ `disputas`.
2. **Real-time:**
    - **Ação:** Instale o **Laravel Reverb** (ou Pusher) para as mensagens do chat e notificações.
3. **Fluxo de Fechamento:**
    - Implemente o botão "Aprovar Trabalho" →→ Chama o `PaymentService` →→ Libera o dinheiro do Escrow →→ Altera status do contrato para `concluido`.

---

### ⚙️ Fase 6: Automações (Cron Jobs)

Para a plataforma "viver" sozinha.

1. **Task Scheduling (`app/Console/Kernel.php`):**
    - **Job Expiration:** Um comando que roda a cada hora para procurar `trabalhos` onde `expira_em < now()` e altera o status para `cancelado`.
    - **Destaques:** Um comando que verifica `destaques.expira_em` e altera `perfis.esta_destacado = false`.

---

### 🚀 Resumo da Ordem de Implementação (Checklist)

- [ ]  **Semana 1:** Setup Laravel + UUID Trait + Middleware de Role + Auth.
- [ ]  **Semana 2:** Migrations de Perfis, Skills e Categorias + CRUD de Perfil.
- [ ]  **Semana 3:** Fluxo de Trabalhos (Rascunho →→ Publicação) + Upload de Anexos.
- [ ]  **Semana 4:** `PaymentService` + Migrations Financeiras + Lógica de Escrow (A parte mais difícil).
- [ ]  **Semana 5:** Sistema de Propostas →→ Contratos →→ Chat.
- [ ]  **Semana 6:** Disputas, Avaliações e Cron Jobs de Expiração.

### ⚠️ Dica de Segurança Final:

Sempre que for mexer com a tabela `carteiras` ou `transacoes_escrow`, use este padrão no seu código:

PHP

```
DB::transaction(function () {
    $carteira = Carteira::where('id', $id)->lockForUpdate()->first();
    // ... lógica de soma/subtração ...
    $carteira->save();
});
```

Isso impede que o usuário tente "hackear" o saldo fazendo várias requisições simultâneas ao servidor.