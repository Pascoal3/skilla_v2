 Plataforma freelance angolana
 
# Estratégia e base:

**Público-alvo**: Angola;

**Nichos iniciais**: Design e Desenvolvimento web, estes serão os únicos nichos numa fase inicial, mas na versão completa serão acrescidos vários, tais como marketing, gestor de redes sociais e etc.


## Problema

Hoje, o mercado funciona assim:

Freelancers → procuram clientes no WhatsApp

Clientes → não confiam em freelancers

Pagamentos → difíceis, inseguros ou informais

Sem histórico → ninguém sabe quem é bom


Existem 3 grandes problemas:


1\. ❌ Falta de confiança

Ninguém sabe:

- Quem é profissional de verdade

- Quem vai entregar


2\. ❌ Falta de organização

Tudo acontece apenas por causa de:

* WhatsApp

* Instagram

* Indicações

👉 Não há sistema centralizado


3\. ❌ Pagamentos complicados

* Sem escrow (pagamento assegurado)

* Sem proteção

* Sem garantia


## MVP vs Versão completa

#### **MVP**

* Pagamento simulado
* Escrow implementado (sistema de pagamento fake, só para demonstração)
* Fácil orientação no sistema
* Sistema intuitivo
* Freelancers locais verificados
* Chat em tempo real
* Notificações in-app


#### **Versão completa**

* ###### Pagamento autenticado dos freelancers via multicaixa express e transferência bancária
* Autenticação 2FA SMS/TOTP
* **Pagamento autenticado (carregamento de créditos) via multicaixa express e transferência bancária**
* Filtro de mensagens usando IA e envio de relatórios para o admin via e-mail
* Notificações SMS e email


## 🧩 Como o projeto deve funcionar (fluxo ideal)


- Cliente cria conta

- Publica job

- Freelancer cria conta 

- Freelancer vê jobs disponíveis

- Freelancer entra (clica) no job

- Freelancer vê detalhes do job 

- Freelancer envia proposta

- Cliente recebe notificação de candidato (proposta recebida)

- Cliente abre painel de decisão

- Cliente aceita

- Depósito de valores com escrow
1 - Depósito dos valores em kzs
2 - Créditos vão para a conta do cliente
3 - O cliente aceita depositar os x créditos para o projeto
4 - A plataforma mete os créditos em escrow

- Conversam no chat (mensagens, envio de PDF, HTML, Link, JPG, ZIP, PNG e SVG do trabalho do freelancer) para o cliente aprovar

- Cliente aprova e decide concluir

- Trabalho concluído

- O cliente recebe a mensagem para confirmar que está satisfeito com o trabalho e pretende pagar o freelancer

- O cliente confirma

- Os créditos (para saque) são enviados para a conta do freelancer

- Avaliação de ambos


# Propostas de valor: 

"Freelancers pagos com Multicaixa express"

"Trabalhar de casa em Angola nunca foi tão fácil"

# Modelo de monetização:

* Créditos para enviar propostas (dados créditos grátis ao criar conta)

* Destaque de perfil ("faça seu perfil aparecer primeiro")

* Comissão de 10% por cada job concluído

## Pacote de créditos

Créditos serão carregados ou adicionados através do pagamento em kwanzas, pelo multicaixa ou express, por referência ou carregamento através da integração do express no site.


👉 Créditos grátis iniciais serão atribuídos

→ 20 créditos ao criar conta

→ Remove fricção inicial 


* Créditos serão usados para enviar propostas
* Comissão (quando conclui o projeto é retirada a comissão de 10%)

| Créditos | Pacote      | Preço     |
| -------- | ----------- | --------- |
| 20       | Iniciante   | 5.000kzs  |
| 50       | Crescimento | 8.000kzs  |
| 100      | Pro         | 15.000kzs |
| 250      | Elite       | 20.000kzs |
Personalizado: Ter uma calculadora que mede o valor de acordo com o input.

Calculadora: Valor (que pretende investir em kzs), total de créditos recebidos e número de propostas potenciais (que poderá enviar com esses créditos).


**Limitar propostas por projeto**

Máximo de 10-15 projetos

→ Isso aumenta valor percebido

→ Facilita os clientes, não têm de analisar 100 propostas só para escolher um candidato

→ Freelancers competem menos, mais ROI


👉 **Boost Pago (upgrades)**

→ Destacar proposta + 5 créditos

→ Aparecer primeiro + 10 créditos



**Insight**

Ajustar automaticamente, a partir de fórmulas:

* Projetos com mais concorrências, mais créditos
* Projetos urgentes, mais créditos
* Clientes premium, projetos mais caros


# Referências

#### Americanas:
* UpWork
* Fiverr 
* Freelancer (freelancer.com)


### Estilo de site: SPA (single page)


# Stack:

* Backend: Laravel 
* Frontend: Laravel (blade template)
* Base de dados: MySQL
* Firebase (chat + notificações)
* 2º opção para chat: Laravel (integração de pacote de web socket)
* Cloudinary (upload de imagens)


# Problema:

Em Angola, o freelance ainda funciona muito mais por WhatsApp, indicação ou networking direto.

Na maioria dos casos, ganhas mais dinheiro falando direto com empresas do que usando plataformas locais.





#### Quem será a Skilla ?

A Skilla não será só um site, será um sistema com:

* Marketplace (clientes + freelancers)

* Sistema de confiança (reviews, verificação)

* Pagamentos seguros (escrow)

* Matching inteligente (jobs ↔ talentos)




#### MVP (O que deve ter obrigatoriamente)

Para termos uma plataforma profissional, prometemos entregar:


##### 1\. 👤 Sistema de autenticação

* Cadastro/Login (cliente e freelancer)

* Perfis separados:

* Freelancer (skills, portfólio, preço)

* Cliente (empresa/nome, descrição)


👉 Extra:

Upload de foto

Bio profissional

Skills com tags





##### 2\. 💼 Publicação e visualização de trabalhos

👤Cliente (contratante) pode:

* Criar job (título, descrição, orçamento)

* Escolher tipo, ou seja, modalidade de trabalho (Preço fixo ou Por hora)



👤Freelancer pode:

* Ver jobs

* Filtrar (categoria, preço)

* Enviar proposta



##### 3\. 📩 Sistema de propostas (Essencial)


👤Freelancer envia proposta

👤Cliente vê:

* Preço

* Mensagem

* Perfil do freelancer

👉 Classificada como funcionalidade mais essencial e importante



##### 4\. 💬 Chat em tempo real


Cliente ↔ Freelancer

Poderá ser um sistema simples (WebSocket ou Firebase)

🤖Funcionalidade por implementar: Filtro de palavras ofensivas com IA, a IA analisa a mensagem enviada em segundos e remove a mensagem se contiver palavras ofensivas, inapropriadas ou que ferem tanto freelancer, quanto cliente.

Depois disso envia um relatório para o admin, via e-mail contendo o ID do usuário, nome, role, mensagem, hora de envio, id do projeto em que foi enviado, para quem enviou, contexto da mensagem e mais.

👉 Isso ajudará a aumentar bastante o realismo do projeto





##### 5\. ⭐ Sistema de avaliações

Depois do trabalho:

👤Cliente avalia freelancer (1–5 estrelas)

👤Freelancer avalia cliente (1-5 estrelas)


👉 Isso ajudará a criar confiança (essencial)



##### 6\. 📁 Portfólio do freelancer

* Upload de projetos

* Imagens + descrição


##### 7\. 🔍 Sistema de busca

Buscar freelancers por:

Skill

Categoria

Rating

🤖Matching com IA para sistema de busca:

```
Sugere freelancers com base no job

Exemplo:

Job (pesquisado): “criar website”

Sistema sugere devs web

Job (pesquisado): "Logo"

Sistema sugere designers gráficos
```



## 💡 Funcionalidades diferenciais:


##### 🔐 8. Simulação de pagamento (escrow fake)

* Cliente “deposita” valor (simulado)

* Só libera após conclusão



👉 O que é o escrow ?

Escrow é um sistema onde o dinheiro fica guardado por um intermediário até o trabalho ser concluído, esse intermediário pode ser a própria plataforma freelance.


Explicação simples (sem complicação)


Imagina isto:

* Cliente quer um website
  
* Freelancer aceita fazer



👉 Em vez de pagar direto ao freelancer:


* Cliente paga à plataforma (escrow)

* O dinheiro fica “congelado”

* Freelancer faz o trabalho

* Cliente aprova


👉 Só então:

7\. A plataforma libera o dinheiro ao freelancer




##### 📊 10. Dashboard

Para cada user:

* Jobs ativos

* Ganhos

* Propostas enviadas





##### 🔔 11. Notificações

* Nova proposta

* Mensagem recebida

* Job aceito

* Job em revisão





##### 2\. Branding

→ Nome (curto, fácil, sem acento)
→ Domínio disponível (.com ou .ao)
→ Logo
→ Paleta de cores
→ Tipografia
→ Tom de comunicação


💡 Dica:

Evitar nomes genéricos tipo “FreelaPro”

Pensar em algo tipo: “TaskLink”, “Skilla”, “Workao”







##### 3\. Arquitetura do Sistema

**Stack**

Backend → Laravel
Frontend → Blade (Laravel)
Base de dados → MySQL

**Serviços externos**

Firebase (chat + notificações)
Cloudinary (upload de imagens)

Estrutura de pastas
API REST 
Sistema de autenticação (JWT ou Firebase)
Segurança básica (hash de senha, validações)
Validação de inputs
Proteção de rotas


### 3.1 **UI/UX** (não será só "bonito")

→ Design responsivo (mobile first)
→ Navegação simples
→ Loading states
→ Feedback visual (erro/sucesso)
→ UX do fluxo completa 



##### 4\. Banco de Dados (CRÍTICO)

Por modelar melhor depois:

→ Users

→ Profiles

→ Jobs

→ Proposals

→ Messages

→ Reviews

→ Notifications




##### 5\. Módulos principais (CORE)

👤 Usuários

→ Cadastro/Login

→ Autenticação (JWT)

→ Autenticação 2FA

→ Perfil editável

→ Upload de foto



###### 💼 Jobs

→ Criar job

→ Listar jobs

→ Filtros


###### 📩 Propostas

→ Enviar proposta

→ Aceitar/rejeitar


###### 💬 Chat

→ Mensagens em tempo real

→ Filtros de mensagens com IA





###### ⭐ Avaliações

→ Sistema de rating





###### 🎨 6. UI/UX

→ Design responsivo (mobile FIRST)

→ Navegação simples

→ Loading states (spinners)

→ Feedback visual (sucesso/erro)

→ UX do fluxo completo (job → proposta → chat)


##### 🔐 7. Segurança

→ Hash de senha (bcrypt)

→ Proteção de rotas

→ Validação de inputs

→ Prevenção essencial de SQL Injection

→ Autenticação 2FA

→ Autenticação de login/cadastro JWT





##### 💰 8. Sistema de pagamentos (mesmo que simulado)

→ Carteira do usuário (saldo fake)

→ “Depósito” pelo cliente

→ Liberação após conclusão




##### 🔔 9. Sistema de notificações

→ Nova proposta

→ Mensagem recebida

→ Job aceito




##### 📊 10. Dashboard

**ADMIN**

- Total de usuários ativos no sistema
- Versão do sistema (EX: Skilla_v1.0)
- Queixas/reclamações
- Anúncios (criar, editar e eliminar)
- Relatórios (visualizar na tela e gerar PDF) → filtrados por intervalo de data (ex: desde 01/03/26 até 06/04/26) ou mês (jobs criados, jobs ativos, freelancers ativos, clientes ativos, créditos totais


**CLIENTE**

- Jobs publicados
- Taxa de contratação (opcional)
- Total gasto na plataforma
- Avaliação média
- Membro desde
- Verificação


**FREELANCER**

- Jobs ativos
- Propostas enviadas
- Ganhos (total) 
- Total de trabalhos concluídos


##### 🔍 11. Busca e filtros

- Buscar freelancers

- Filtrar por skill

- Filtrar por preço/rating




##### 🚀 12. Diferenciais 

- Perfis verificados

- Badge “Top Freelancer”

- Portfólio com imagens

- Sistema de categorias





##### 🧪 13. Testes

- Testar fluxo completo

- Criar contas fake (cliente + freelancer)

- Testar erros (inputs inválidos)


##### 🌐 14. Deploy (muito importante)

- Frontend (Vercel)

- Backend (Railway / Render)

- Base de dados online

- Domínio configurado


##### 📄 15. Documentação 

- README.md

- Explicação da arquitetura

- Fluxo do sistema

- Decisões técnicas







