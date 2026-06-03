# 📄 **DESCRIÇÃO DO PROJETO - SKILLA**

## **1. Introdução**

O presente projeto consiste no desenvolvimento de uma plataforma web freelance denominada **Skilla**, focada no mercado angolano.

O sistema tem como objetivo conectar clientes e freelancers de forma organizada, segura e eficiente, permitindo a contratação de serviços digitais como design gráfico e desenvolvimento web.

A plataforma surge como solução para a falta de estrutura e confiança no mercado freelance em Angola, oferecendo um ambiente centralizado com funcionalidades modernas como sistema de propostas, chat em tempo real, gestão de carteiras (wallets) e simulação de pagamentos com escrow.

---

## **2. Problema**

Atualmente, o mercado freelance em Angola apresenta diversas limitações que dificultam o crescimento e a profissionalização do setor. Os principais problemas identificados são:

### ❌ Falta de confiança

- Não existe verificação de profissionais.
    
- Clientes não sabem quem realmente entrega o trabalho.
    
- Ausência de um sistema estruturado de avaliações.
    

### ❌ Falta de organização

- Comunicação dispersa (feita via WhatsApp e redes sociais).
    
- Ausência de um sistema centralizado para gerir ficheiros e prazos.
    
- Processo de contratação informal e desorganizado.
    

### ❌ Pagamentos inseguros

- Ausência de garantias para ambas as partes (o cliente tem medo de pagar adiantado; o freelancer tem medo de trabalhar e não receber).
    
- Falta de mecanismos formais para resolução de disputas.
    

Diante destes problemas, torna-se necessário desenvolver uma solução tecnológica que organize, proteja e profissionalize este mercado.

---

## **3. Objetivos**

### 🎯 Objetivo Geral

Desenvolver uma plataforma web freelance segura e funcional, adaptada à realidade do mercado angolano.

### 📌 Objetivos Específicos

- Criar sistema de autenticação e gestão de perfis (Clientes e Freelancers).
    
- Permitir a publicação estruturada de trabalhos (fluxo de etapas e rascunhos).
    
- Implementar um sistema interno de Carteiras Virtuais (Wallets) para simulação de fundos.
    
- Garantir segurança financeira através de um sistema de pagamento Escrow.
    
- Desenvolver chat em tempo real integrado aos contratos.
    
- Criar um sistema de Resolução de Disputas.
    
- Implementar avaliações bilaterais.
    
- Desenvolver automações de sistema (Cron Jobs) para expirar vagas e gerir status.
    

---

## **4. Público-Alvo**

O sistema é direcionado para:

- **Freelancers angolanos:** Profissionais de serviços digitais (designers, desenvolvedores web, copywriters, etc.) em fase inicial ou estabelecidos.
    
- **Clientes:** Pequenas empresas, empreendedores e particulares que necessitam de serviços digitais sob demanda.
    

---

## **5. Funcionalidades Principais do Sistema**

### 👤 Sistema de Usuários

- Cadastro, login e gestão de conta.
    
- Perfis com interfaces distintas baseadas na funcao (cliente ou freelancer).
    

### 💼 Gestão de Trabalhos (Jobs)

- Criação de jobs guiada em 5 passos (Título, Habilidades, Escopo, Orçamento, Descrição).
    
- Sistema de Rascunhos antes da publicação final.
    
- Autocancelamento de vagas inativas pelo sistema.
    

### 💰 Sistema de Carteiras e Pagamentos (Escrow)

- **Carteira Virtual (Wallet):** Recarga de saldo simulada (ex: via Multicaixa Express).
    
- **Escrow:** Retenção de fundos do cliente no momento da contratação e libertação para o freelancer apenas após a aprovação do trabalho.
    

### ⚖️ Resolução de Disputas

- Mecanismo para congelar o contrato caso haja problemas na entrega.
    
- Possibilidade de reembolso do Escrow para a carteira do cliente.
    

### 📩 Sistema de Propostas

- Freelancers enviam propostas mediante o gasto de "Créditos" da plataforma.
    
- Clientes gerem, analisam e aceitam as propostas recebidas.
    

### 💬 Comunicação e Entregas

- Chat em tempo real restrito aos utilizadores com contrato ativo.
    
- Partilha de ficheiros e links centralizada.
    

### ⭐ Reputação e Busca

- Sistema inteligente de busca por competências.
    
- Avaliações bilaterais com impacto direto na média visível do perfil.
    

---

## **6. Fluxo de Funcionamento do Sistema**

O funcionamento do sistema segue uma jornada lógica e segura:

1. **Registo:** Cliente e Freelancer criam as suas contas.
    
2. **Recarga:** Cliente adiciona fundos à sua Carteira Skilla (Simulado).
    
3. **Publicação:** Cliente publica um trabalho detalhado (Job).
    
4. **Candidatura:** Freelancer gasta um crédito e envia uma proposta.
    
5. **Aceitação & Escrow:** O Cliente aceita a proposta. O valor acordado é imediatamente **deduzido da carteira do cliente e retido pelo sistema (Escrow)**.
    
6. **Execução:** Comunicação e partilha de ficheiros via chat interno.
    
7. **Submissão:** Freelancer entrega o projeto final.
    
8. **Decisão do Cliente:**
    
    - Cenário A (Sucesso): Cliente aprova. O sistema transfere o dinheiro do Escrow para a carteira do Freelancer (menos a comissão).
        
    - Cenário B (Disputa): Cliente rejeita. Uma disputa é aberta, o dinheiro fica congelado até resolução (podendo resultar em reembolso).
        
9. **Conclusão:** Ambas as partes avaliam a experiência.
    

---

## **7. Tecnologias Utilizadas**

- **Backend:** Laravel (PHP)
    
- **Frontend:** Blade (Laravel), HTML, CSS, JavaScript (Alpine.js/Tailwind recomendados)
    
- **Base de Dados:** MySQL / PostgreSQL
    
- **Websockets:** Laravel Reverb ou Pusher (Para chat e notificações)
    
- **Agendamento:** Laravel Task Scheduling (Cron Jobs para automações do "Sistema")
    

---

## **8. Arquitetura do Sistema**

- Padrão estrutural **MVC (Model-View-Controller)**.
    
- Separação clara de responsabilidades no Banco de Dados (ver detalhes no fim do documento).
    
- Autenticação e proteção de rotas por perfis de acesso.
    
- Sistema transacional para garantir integridade financeira (DB Transactions).
    

---

## **9. Metodologia de Desenvolvimento**

1. Modelagem de Dados e Casos de Uso (Concluído).
    
2. Prototipagem da Interface (UI/UX) baseada no Guia de Estilo.
    
3. Desenvolvimento Back-end (Autenticação, CRUDs principais).
    
4. Desenvolvimento de Lógica Complexa (Sistema Financeiro, Escrow, Disputas).
    
5. Integração em Tempo Real (Chat, Notificações).
    
6. Testes unitários e de integração.
    
7. Deploy e Ajustes.
    

---

## **10. 📋 Requisitos Funcionais (Atualizados)**

### RF01 — Gestão de Utilizadores

|   |   |
|---|---|
|ID|Requisito|
|RF01.1|O sistema deve permitir registo e login com distinção de função (cliente/freelancer).|
|RF01.2|O sistema deve permitir edição completa de perfil (foto, bio, skills).|
|RF01.3|O sistema deve adaptar a interface e menus consoante o tipo de perfil logado.|

### RF02 — Gestão de Jobs (Trabalhos)

|   |   |
|---|---|
|ID|Requisito|
|RF02.1|O sistema deve permitir criar trabalhos em formato de rascunho (wizard de 5 etapas) antes de publicar.|
|RF02.2|O sistema deve permitir definir orçamentos fixos ou taxas por hora.|
|RF02.3|**O "Sistema" (Cron Job) deve cancelar automaticamente jobs abertos que ultrapassem a data de expiração.**|

### RF03 — Propostas e Contratação

|   |   |
|---|---|
|ID|Requisito|
|RF03.1|O freelancer deve poder enviar propostas deduzindo "créditos" do seu saldo.|
|RF03.2|O cliente deve poder visualizar todas as propostas e aceitar apenas uma.|
|RF03.3|A aceitação de uma proposta deve gerar um "Contrato" formal no sistema.|

### RF04 — Carteiras (Wallets) e Escrow

|   |   |
|---|---|
|ID|Requisito|
|RF04.1|O sistema deve disponibilizar uma "Carteira" para cada utilizador com saldo em Kz.|
|RF04.2|O cliente deve poder realizar recargas simuladas na sua carteira.|
|RF04.3|Ao aceitar uma proposta, o sistema deve **reter (Escrow)** os fundos automaticamente da carteira do cliente.|
|RF04.4|Após aprovação do trabalho, o Escrow deve creditar automaticamente a carteira do freelancer.|

### RF05 — Resolução de Disputas (NOVO)

|   |   |
|---|---|
|ID|Requisito|
|RF05.1|O sistema deve permitir que um contrato seja colocado "Em Disputa" em caso de conflito.|
|RF05.2|Enquanto em disputa, os fundos do Escrow não podem ser movimentados pelas partes.|
|RF05.3|O sistema deve permitir o encerramento da disputa com o reembolso (parcial ou total) para a carteira do cliente.|

### RF06 — Comunicação e Avaliações

|   |   |
|---|---|
|ID|Requisito|
|RF06.1|O sistema deve permitir chat em tempo real e envio de ficheiros apenas entre partes com contrato ativo.|
|RF06.2|Ambas as partes devem poder avaliar-se de 1 a 5 estrelas após a conclusão do contrato.|

---

## **11. Requisitos Não-Funcionais**

(Mantêm-se iguais aos definidos na versão anterior: Segurança, Desempenho, Usabilidade, Responsividade, Disponibilidade, Manutenibilidade, Escalabilidade, Confiabilidade, Armazenamento e Compatibilidade).

---

## **12. Modelo de Monetização**

- **Venda de Créditos:** Freelancers compram pacotes de créditos para enviar mais propostas.
    
- **Boost de Perfil:** Freelancers pagam para aparecer no topo das pesquisas.
    
- **Comissão da Plataforma:** Retenção automática de 10% sobre o valor de cada projeto concluído com sucesso.
    

---

## **13. Melhorias Futuras**

- Integração real com API do Multicaixa Express / Referências.
    
- Autenticação de 2 Fatores (2FA).
    
- Verificação de Identidade (KYC).
    
- Moderação assistida por Inteligência Artificial no Chat.
    

---

## **14. GUIA DE ESTILO UI/UX**

(O Guia de Estilo visual mantém-se intacto conforme documentado anteriormente, utilizando Azul Principal #2563EB, tipografia Inter, e design limpo e responsivo).

---

## **15. DIAGRAMA ER E ARQUITETURA DE DADOS (Atualizado)**

O Banco de Dados foi estruturado para garantir normalização e rastreabilidade total (Auditoria Financeira).

### 🔹 1. Módulo de Perfis e Skills

- **perfis:** Armazena clientes, freelancers e admins. Possui saldo_creditos, funcao, métricas de avaliação.
    
- **habilidades / perfil_habilidades / trabalho_habilidades:** Sistema de tags N:N para matching inteligente.
    

### 🔹 2. Módulo de Trabalhos e Propostas

- **trabalhos:** Criado pelo cliente. Possui escopo, orçamento, status (rascunho, aberto) e expira_em para controlo do sistema.
    
- **trabalho_anexos:** Ficheiros de apoio à descrição da vaga.
    
- **propostas:** Ofertas dos freelancers com o valor proposto e dias de entrega.
    

### 🔹 3. Módulo de Contratos e Disputas

- **contratos:** O elo principal gerado após aceitação. Define o valor_acordado e a data_limite.
    
- **disputas (NOVO):** Regista conflitos num contrato, bloqueando pagamentos até resolução administrativa.
    

### 🔹 4. Módulo Financeiro Escrow (O Coração Seguro da Skilla)

- **carteiras:** Saldo real disponível de cada utilizador.
    
- **transacoes_carteiras:** Histórico de entradas (recargas, pagamentos recebidos) e saídas (saques, retenções).
    
- **transacoes_escrow:** A ponte de segurança. Liga a carteira de origem (cliente) à carteira de destino (freelancer). O dinheiro fica num estado retido até ser alterado para liberado (vai para o freelancer) ou devolvido_cliente (em caso de disputa ganha).
    

### 🔹 5. Módulo de Comunicação

- **conversas / mensagens:** Chat associado diretamente a um contrato.
    
- **notificacoes:** Alertas do sistema.
    

### 🔹 6. Módulo de Monetização e Reputação

- **transacoes_credito:** Auditoria do gasto/compra de créditos (moeda interna para propostas).
    
- **avaliacoes:** Feedback pós-projeto.
    
- **destaques:** Boosts pagos de perfil.