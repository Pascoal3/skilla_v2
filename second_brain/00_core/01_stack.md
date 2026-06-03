# 🛠️ Tech Stack — Skilla

## 📌 Visão Geral

A Skilla é uma plataforma web freelance desenvolvida com foco em desempenho, organização do código e facilidade de manutenção.

A arquitetura segue o padrão MVC (Model-View-Controller), utilizando Laravel como framework principal e MySQL para persistência de dados.

---

# 🔧 Linguagens Utilizadas

| Tecnologia        | Versão   |
| ----------------- | -------- |
| PHP               | 8.4+     |
| HTML5             | Latest   |
| CSS3              | Latest   |
| JavaScript (ES6+) | Latest   |
| SQL               | MySQL 8+ |
| Tailwind          | Latest   |

---

# 🚀 Frameworks

## Laravel

**Versão:** 12.x

**Função no Projeto:**

* Estrutura principal do backend.
* Sistema de rotas.
* Controllers.
* Models e ORM Eloquent.
* Middleware.
* Validações.
* Migrations.
* Seeders.
* Sistema de autenticação.
* Gestão de sessões.
* Agendamento de tarefas (Task Scheduling).

---

# 🎨 Frontend

## Laravel Blade

**Versão:** Integrado ao Laravel 12

**Função no Projeto:**

* Renderização de páginas dinâmicas.
* Componentização de interfaces.
* Reutilização de layouts.
* Integração direta com o backend.

---

# 📚 Bibliotecas Utilizadas

## Font Awesome

**Função:**

* Ícones da interface.

---

## Google Fonts (Inter)

**Função:**

* Tipografia principal da plataforma.

---

# 🗄️ Banco de Dados

## MySQL

**Versão:** 8.0+

**Função:**

* Armazenamento de dados.
* Gestão de relacionamentos.
* Transações financeiras (Wallets e Escrow).
* Auditoria de operações.

---

# ⚙️ Ferramentas de Desenvolvimento

## Composer

**Função:**

* Gestão de dependências PHP.

---

## NPM

**Função:**

* Gestão de dependências JavaScript.

---

## Git

**Função:**

* Controle de versão.
* Colaboração e histórico do projeto.

---

## GitHub

**Função:**

* Hospedagem do repositório.
* Gestão de branches.
* Integração contínua.

---

# 🏗️ Arquitetura

## Padrão Arquitetural

MVC (Model-View-Controller)

### Model

Responsável pela manipulação dos dados e comunicação com a base de dados.

### View

Responsável pela interface do utilizador através do Blade.

### Controller

Responsável pela lógica de negócio e comunicação entre Model e View.

---

# 📂 Estrutura Principal

```text
app/
├── Http/
│   ├── Controllers/
│   └── Middleware/

resources/
├── views/

routes/
├── web.php

database/
├── migrations/
├── seeders/

public/
```

---

# 🔐 Segurança

* Proteção CSRF nativa do Laravel.
* Hash de palavras-passe com Bcrypt.
* Middleware de autenticação.
* Validação de dados no servidor.
* Proteção contra SQL Injection através do Eloquent ORM.

---

# 📈 Escalabilidade

A stack foi escolhida para permitir:

* Crescimento modular.
* Facilidade de manutenção.
* Separação de responsabilidades.
* Integração futura com APIs externas.
* Implementação de WebSockets para chat em tempo real.
* Integração futura com gateways de pagamento.
* Implementação futura de microserviços, caso necessário.

---

# 📅 Última Atualização

Junho de 2026
