# FLUXO 2 — TOKEN (JWT)

Agora o moderno 👇

---

## 📌 PASSO A PASSO

### 1. Usuário envia login

```
POST /login
```

---

### 2. Backend valida dados

---

### 3. Servidor gera TOKEN

Exemplo de JWT:

```
eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...
```

👉 Esse token contém:

```
{  "user_id": 5,  "email": "user@email.com",  "exp": 1710000000}
```

---

### 4. Servidor envia token

```
{  "token": "eyJhbGciOiJIUzI1NiIs..."}
```

---

### 5. Cliente armazena

- localStorage ❌ (menos seguro)
- httpOnly cookie ✅ (melhor)

---

### 6. Próximas requisições

```
Authorization: Bearer eyJhbGciOiJIUzI1NiIs...
```

---

### 7. Backend valida token

- Verifica assinatura
- Verifica expiração
- Extrai user_id