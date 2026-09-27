Middleware são “filtros” que interceptam as requisições antes de chegarem às APIs.  

Eles decidem: _pode passar ou não pode_.

No projeto (Skilla), não basta só `auth`. Nele contém:

- clientes
    
- freelancers
    
- dinheiro (escrow)
    
- mensagens privadas
    

Ou seja, precisamos de **um conjunto bem pensado de middlewares**.



# Middlewares essenciais para o teu sistema

## 1. `auth` (Autenticação)

Verifica se o utilizador está logado

Usado em:

- criar jobs
    
- enviar propostas
    
- mensagens
    
- pagamentos
    
- Acessar o painel

**Exemplo:**

```
GET /api/jobs   ❌ público
POST /api/jobs  ✅ auth obrigatório
```

---

## 2. `role` (Autorização por tipo de utilizador)

👉 Diferencia:

- client
    
- freelancer
    
- admin
    

**Exemplo:**

- Só **clientes** podem criar jobs
    
- Só **freelancers** podem enviar proposals
    

```
POST /jobs → role: client
POST /proposals → role: freelancer
```

---

## 3. `owner` (Dono do recurso)

👉 Garante que só o dono pode mexer nos seus dados

**Exemplo:**

- Editar perfil
    
- Apagar job
    
- Ver mensagens privadas
    

```
PUT /profiles/:id → só o dono pode editar
```

---

## 4. `canAccessContract`

👉 Muito importante no teu sistema

Verifica se o utilizador:

- é cliente OU
    
- é freelancer daquele contrato
    

Usado em:

- mensagens
    
- pagamentos
    
- reviews
    

---

## 5. `proposalOwner`

👉 Só quem criou a proposta pode alterá-la


## 6. `jobOwner`

👉 Só o cliente dono do job pode:

- editar
    
- apagar
    
- ver propostas
    


## 7. `verifiedUser` (opcional, mas profissional)

👉 Verifica se o utilizador confirmou email


## 8. `hasCredits`

👉 Essencial no teu sistema (tens credits + boosts)

Bloqueia ações se não tiver saldo:

- boost
    
- envio de proposta (se quiseres monetizar)
    


## 9. `paymentAuthorized`

👉 Segurança financeira

Garante que:

- pagamento pertence ao utilizador
    
- contrato é válido
    


## 10. `rateLimit` (anti-spam)

👉 Protege o sistema

Exemplo:

- login → 5 tentativas/min
    
- mensagens → limite por minuto
    


## 11. `isActive`

👉 Bloqueia contas desativadas


## 12. `adminOnly`

👉 Para rotas administrativas

- criar categorias
    
- gerir utilizadores
    

---

# 🧱 Exemplo real de uso (Laravel)

```id="k3l9x2"
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::post('/jobs', [JobController::class, 'store']);
});

Route::middleware(['auth', 'role:freelancer'])->group(function () {
    Route::post('/proposals', [ProposalController::class, 'store']);
});

Route::middleware(['auth', 'canAccessContract'])->group(function () {
    Route::get('/contracts/{id}', [ContractController::class, 'show']);
});
```

---

# 🧠 Organização recomendada

Cria uma pasta:

```
app/Http/Middleware/
```

E separa assim:

- Auth
    
- Roles
    
- Ownership
    
- Payments
    
- System
    

---

# 🔥 Middlewares mais importantes (resumo)

Se tiveres pouco tempo, foca nesses:

1. `auth`
    
2. `role`
    
3. `owner`
    
4. `canAccessContract`
    
5. `hasCredits`
    

👉 Isso já te coloca acima de 80% dos projetos académicos.

---

# 🎯 Conclusão

No projeto:

> **Middlewares não são opcionais, são obrigatórios para segurança, lógica e organização.**

Eles vão garantir:

- 🔐 segurança
    
- 🎯 regras de negócio corretas
    
- 🚀 escalabilidade
    

