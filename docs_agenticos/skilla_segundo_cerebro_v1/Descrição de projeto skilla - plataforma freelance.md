# 📄 **DESCRIÇÃO DO PROJETO 

## **1. Introdução**

O presente projeto consiste no desenvolvimento de uma plataforma web freelance denominada **Skilla**, focada no mercado angolano.

O sistema tem como objetivo conectar clientes e freelancers de forma organizada, segura e eficiente, permitindo a contratação de serviços digitais como design gráfico e desenvolvimento web.

A plataforma surge como solução para a falta de estrutura e confiança no mercado freelance em Angola, oferecendo um ambiente centralizado com funcionalidades modernas como sistema de propostas, chat em tempo real e simulação de pagamentos com escrow.


## **2. Problema**

Atualmente, o mercado freelance em Angola apresenta diversas limitações que dificultam o crescimento e profissionalização do setor.

Os principais problemas identificados são:

### ❌ Falta de confiança

- Não existe verificação de profissionais
- Clientes não sabem quem realmente entrega
- Ausência de sistema de avaliações

### ❌ Falta de organização

- Comunicação feita via WhatsApp e redes sociais
- Ausência de um sistema centralizado
- Processo de contratação desorganizado

### ❌ Pagamentos inseguros

- Falta de sistema de escrow
- Pagamentos informais
- Ausência de garantias para ambas as partes

Diante destes problemas, torna-se necessário desenvolver uma solução tecnológica que organize e profissionalize este mercado.


## **3. Objetivos**

### 🎯 Objetivo Geral

Desenvolver uma plataforma web freelance funcional para o mercado angolano.

### 📌 Objetivos Específicos

- Criar sistema de autenticação de usuários
- Permitir publicação e gestão de trabalhos (jobs)
- Implementar sistema de propostas
- Desenvolver chat em tempo real
- Criar sistema de avaliações
- Simular sistema de pagamento com escrow
- Implementar notificações no sistema
- Garantir segurança básica da aplicação



## **4. Público-Alvo**

O sistema é direcionado para:

- Freelancers angolanos (designers e desenvolvedores web na fase inicial)
- Pequenas empresas e clientes que necessitam de serviços digitais



## **5. Funcionalidades do Sistema**

A plataforma apresenta as seguintes funcionalidades principais:

### 👤 Sistema de usuários

- Cadastro e login
- Perfis distintos (cliente e freelancer)
- Edição de perfil, bio e skills

### 💼 Gestão de trabalhos (Jobs)

- Criação de jobs por clientes
- Visualização e filtragem de jobs
- Definição de orçamento e tipo de trabalho

### 📩 Sistema de propostas

- Envio de propostas por freelancers
- Visualização e gestão de propostas pelo cliente

### 💬 Chat em tempo real

- Comunicação direta entre cliente e freelancer
- Envio de arquivos (PDF, imagens, links, etc.)

### ⭐ Sistema de avaliações

- Avaliação bilateral (cliente ↔ freelancer)
- Classificação por estrelas

### 📁 Portfólio

- Upload de projetos
- Exibição de trabalhos anteriores

### 🔍 Sistema de busca

- Busca por skills, categorias e avaliações
- Sugestão inteligente de freelancers

### 🔔 Notificações

- Novas propostas
- Mensagens recebidas
- Atualizações de jobs

### 📊 Dashboard

- Informações personalizadas para cada tipo de usuário
- Estatísticas de uso e desempenho



## **6. Fluxo de Funcionamento do Sistema**

O funcionamento do sistema segue o seguinte fluxo:

1. Cliente cria conta
2. Cliente publica um job
3. Freelancer cria conta
4. Freelancer visualiza jobs disponíveis
5. Freelancer envia proposta
6. Cliente analisa e aceita proposta
7. Cliente realiza depósito (simulado) via sistema de escrow
8. Comunicação é feita via chat
9. Freelancer entrega o trabalho
10. Cliente aprova o trabalho
11. Sistema libera o pagamento (simulado)
12. Ambas as partes realizam avaliação



## **7. Tecnologias Utilizadas**

### Backend

- Laravel (PHP)

### Frontend

- Blade (Laravel)
- HTML, CSS, JavaScript

### Base de Dados

- MySQL

### Serviços externos

- Laravel websocket (mensagens)
- Laravel notifications (notificações)
- Laravel Filesystem (upload de imagens)



## **8. Arquitetura do Sistema**

O sistema segue uma arquitetura baseada em:

- Padrão MVC (Model-View-Controller)
- API REST
- Autenticação com JWT
- Validação de dados e proteção de rotas

### Principais tabelas:

- Users
- Profiles
- Jobs
- Proposals
- Messages
- Reviews
- Notifications



## **9. Metodologia de Desenvolvimento**

O desenvolvimento do sistema foi dividido nas seguintes etapas:

1. Planejamento e definição do problema
2. Modelagem do sistema
3. Design da interface (UI/UX)
4. Desenvolvimento das funcionalidades
5. Testes do sistema
6. Ajustes e melhorias



## **10. Sistema de Pagamentos (Simulado)**

Foi implementado um sistema de escrow simulado com as seguintes características:

- Depósito de valores fictícios pelo cliente
- Valores ficam retidos na plataforma
- Liberação apenas após aprovação do trabalho

Este sistema tem como objetivo demonstrar o funcionamento de pagamentos seguros na plataforma.



## **11. Modelo de Monetização**

A plataforma apresenta um modelo baseado em:

- Créditos para envio de propostas
- Destaque de perfil (boost pago)
- Comissão de 10% por projeto concluído



## **12. Desafios Encontrados**

Durante a pesquisa, foram identificados alguns desafios:

- Implementação do sistema de chat em tempo real
- Organização do fluxo completo da plataforma
- Simulação do sistema de pagamentos
- Estruturação do banco de dados

Estes desafios serão resolvidos através de pesquisa, testes e ajustes progressivos.


# **13.  📋 Requisitos

## Requisitos não-funcionais

### RF01 — Gestão de Utilizadores

|ID|Requisito Funcional|
|---|---|
|RF01.1|O sistema deve permitir que um utilizador se **registe** na plataforma fornecendo nome, e-mail, senha e tipo de perfil (cliente ou freelancer)|
|RF01.2|O sistema deve permitir que um utilizador registado faça **login** com e-mail e senha|
|RF01.3|O sistema deve permitir que o utilizador faça **logout** da plataforma|
|RF01.4|O sistema deve permitir que o utilizador **edite o seu perfil**, incluindo nome, foto, bio, localização e skills|
|RF01.5|O sistema deve garantir **perfis distintos** com permissões e interfaces diferentes para clientes e freelancers|
|RF01.6|O sistema deve proteger rotas e funcionalidades conforme o **tipo de utilizador autenticado**|



### RF02 — Gestão de Jobs (Trabalhos)

|ID|Requisito Funcional|
|---|---|
|RF02.1|O sistema deve permitir que um **cliente publique um job**, informando título, descrição, categoria, orçamento e tipo de trabalho|
|RF02.2|O sistema deve permitir que o cliente **edite ou encerre** um job publicado|
|RF02.3|O sistema deve permitir que qualquer utilizador autenticado **visualize a listagem de jobs** disponíveis|
|RF02.4|O sistema deve permitir **filtrar jobs** por categoria, orçamento e tipo de trabalho|
|RF02.5|O sistema deve exibir o **detalhe completo de um job** ao ser selecionado|
|RF02.6|O sistema deve atualizar o **estado do job** ao longo do fluxo (aberto, em andamento, concluído, cancelado)|



### RF03 — Sistema de Propostas

|ID|Requisito Funcional|
|---|---|
|RF03.1|O sistema deve permitir que um **freelancer envie uma proposta** para um job, incluindo valor, prazo e descrição|
|RF03.2|O sistema deve permitir que o **cliente visualize todas as propostas** recebidas num job|
|RF03.3|O sistema deve permitir que o cliente **aceite ou recuse** uma proposta|
|RF03.4|O sistema deve permitir que o freelancer **visualize o estado** das suas propostas enviadas|
|RF03.5|Após a aceitação de uma proposta, o sistema deve **bloquear novas propostas** para aquele job|
|RF03.6|O sistema deve debitar **créditos do freelancer** ao enviar uma proposta|



### RF04 — Chat em Tempo Real

|ID|Requisito Funcional|
|---|---|
|RF04.1|O sistema deve permitir **comunicação em tempo real** entre cliente e freelancer após a aceitação de uma proposta|
|RF04.2|O sistema deve permitir o **envio de mensagens de texto** na conversa|
|RF04.3|O sistema deve permitir o **envio de ficheiros** (PDF, imagens, links) no chat|
|RF04.4|O sistema deve exibir o **histórico completo de mensagens** da conversa|
|RF04.5|O sistema deve indicar visualmente **mensagens recebidas e enviadas** de forma diferenciada|


### RF05 — Sistema de Pagamento com Escrow (Simulado)

|ID|Requisito Funcional|
|---|---|
|RF05.1|O sistema deve permitir que o cliente realize um **depósito simulado** após aceitar uma proposta|
|RF05.2|O sistema deve manter o valor **retido na plataforma** durante a execução do trabalho|
|RF05.3|O sistema deve permitir que o cliente **aprove o trabalho entregue** pelo freelancer|
|RF05.4|O sistema deve **liberar o pagamento simulado** ao freelancer após aprovação do cliente|
|RF05.5|O sistema deve exibir o **estado do pagamento** (pendente, retido, liberado) para ambas as partes|

### RF06 — Sistema de Avaliações

|ID|Requisito Funcional|
|---|---|
|RF06.1|O sistema deve permitir que o **cliente avalie o freelancer** após a conclusão do trabalho|
|RF06.2|O sistema deve permitir que o **freelancer avalie o cliente** após a conclusão do trabalho|
|RF06.3|A avaliação deve incluir **classificação por estrelas** (1 a 5) e comentário escrito|
|RF06.4|O sistema deve exibir a **média de avaliações** no perfil de cada utilizador|
|RF06.5|O sistema deve impedir que um utilizador **avalie mais de uma vez** o mesmo trabalho|

### RF07 — Portfólio

|ID|Requisito Funcional|
|---|---|
|RF07.1|O sistema deve permitir que o freelancer **adicione projetos ao portfólio**, incluindo título, descrição e imagem|
|RF07.2|O sistema deve permitir que o freelancer **edite ou remova** projetos do portfólio|
|RF07.3|O sistema deve **exibir o portfólio publicamente** no perfil do freelancer|

### RF08 — Sistema de Busca

|ID|Requisito Funcional|
|---|---|
|RF08.1|O sistema deve permitir **buscar freelancers** por nome, skill ou categoria|
|RF08.2|O sistema deve permitir **filtrar freelancers** por avaliação e área de atuação|
|RF08.3|O sistema deve apresentar **sugestões inteligentes** de freelancers conforme a busca realizada|
|RF08.4|O sistema deve permitir **buscar jobs** por palavra-chave e categoria|



### RF09 — Notificações

|ID|Requisito Funcional|
|---|---|
|RF09.1|O sistema deve notificar o cliente quando **uma nova proposta for recebida**|
|RF09.2|O sistema deve notificar o freelancer quando a sua **proposta for aceite ou recusada**|
|RF09.3|O sistema deve notificar o utilizador quando **receber uma nova mensagem** no chat|
|RF09.4|O sistema deve notificar as partes envolvidas sobre **atualizações de estado do job**|
|RF09.5|O sistema deve exibir as notificações no **painel interno da plataforma**|

### RF10 — Dashboard

|ID|Requisito Funcional|
|---|---|
|RF10.1|O sistema deve apresentar um **dashboard personalizado** para o cliente com os seus jobs, propostas recebidas e pagamentos|
|RF10.2|O sistema deve apresentar um **dashboard personalizado** para o freelancer com as suas propostas, trabalhos em curso e avaliações|
|RF10.3|O sistema deve exibir **estatísticas de desempenho**, como número de jobs concluídos e média de avaliação|

### RF11 — Monetização da Plataforma

| ID     | Requisito Funcional                                                                                    |
| ------ | ------------------------------------------------------------------------------------------------------ |
| RF11.1 | O sistema deve gerir um **saldo de créditos** por utilizador para envio de propostas                   |
| RF11.2 | O sistema deve permitir que o freelancer **adquira créditos** para continuar a enviar propostas        |
| RF11.3 | O sistema deve permitir que o freelancer **destaque o seu perfil** mediante pagamento (boost)          |
| RF11.4 | O sistema deve aplicar automaticamente uma **comissão de 10%** sobre o valor de cada projeto concluído |
|        |                                                                                                        |

## Requisitos Não-funcionais

### RNF01 — Segurança

|ID|Requisito Não Funcional|
|---|---|
|RNF01.1|O sistema deve **autenticar utilizadores via JWT**, garantindo que apenas utilizadores autorizados acedam às rotas protegidas|
|RNF01.2|As senhas dos utilizadores devem ser **armazenadas com hash** (bcrypt) na base de dados|
|RNF01.3|O sistema deve **validar todos os dados** recebidos pelo utilizador antes de os processar|
|RNF01.4|O sistema deve proteger contra ataques de **SQL Injection, XSS e CSRF**|
|RNF01.5|O sistema deve garantir que cada utilizador **acede apenas aos seus próprios dados**, impedindo acesso não autorizado a recursos de terceiros|
|RNF01.6|O sistema deve aplicar **controlo de acesso por perfil**, impedindo que um freelancer execute ações exclusivas de cliente e vice-versa|
|RNF01.7|Os ficheiros enviados na plataforma devem ser **validados por tipo e tamanho** antes de serem armazenados|

### RNF02 — Desempenho

|ID|Requisito Não Funcional|
|---|---|
|RNF02.1|O sistema deve carregar as páginas principais em **menos de 3 segundos** em condições normais de uso|
|RNF02.2|O sistema de **chat em tempo real** deve entregar mensagens com latência mínima, sem necessidade de recarregar a página|
|RNF02.3|As **consultas à base de dados** devem ser otimizadas com índices e relações bem definidas para evitar lentidão|
|RNF02.4|O sistema deve suportar o **uso simultâneo** por múltiplos utilizadores sem degradação perceptível do desempenho|



### RNF03 — Usabilidade

|ID|Requisito Não Funcional|
|---|---|
|RNF03.1|A interface deve ser **intuitiva e de fácil navegação**, permitindo que utilizadores sem experiência técnica utilizem a plataforma|
|RNF03.2|O sistema deve fornecer **mensagens de feedback claras** ao utilizador após cada ação (sucesso, erro, aviso)|
|RNF03.3|A plataforma deve apresentar **interfaces diferenciadas** e adequadas para cliente e freelancer|
|RNF03.4|Os formulários devem apresentar **validação em tempo real** com mensagens de erro descritivas|
|RNF03.5|O sistema deve ser utilizável nos **principais navegadores modernos** (Chrome, Firefox, Edge, Safari)|



### RNF04 — Responsividade

| ID      | Requisito Não Funcional                                                                                     |
| ------- | ----------------------------------------------------------------------------------------------------------- |
| RNF04.1 | A interface da plataforma deve ser **responsiva e adaptável** a diferentes tamanhos de ecrã (mobile-first)  |
| RNF04.2 | Os elementos visuais não devem **sobrepor-se ou distorcer-se** em resoluções menores                        |
| RNF04.3 | As funcionalidades principais devem estar **acessíveis em dispositivos móveis** sem perda de funcionalidade |

### RNF05 — Disponibilidade

|ID|Requisito Não Funcional|
|---|---|
|RNF05.1|O sistema deve estar **disponível continuamente** durante o período de utilização, com interrupções mínimas e planeadas|
|RNF05.2|Em caso de falha, o sistema deve apresentar **páginas de erro amigáveis** (404, 500) sem expor informações internas|

### RNF06 — Manutenibilidade

|ID|Requisito Não Funcional|
|---|---|
|RNF06.1|O código deve seguir o **padrão MVC** do Laravel, mantendo separação clara entre lógica, dados e apresentação|
|RNF06.2|O sistema deve ser desenvolvido com **código limpo, organizado e comentado**, facilitando futuras manutenções|
|RNF06.3|O sistema deve utilizar **migrations e seeders** do Laravel para controlo e versionamento da base de dados|
|RNF06.4|O projeto deve estar organizado em **módulos bem definidos**, permitindo a adição de novas funcionalidades sem impactar as existentes|

### RNF07 — Escalabilidade

|ID|Requisito Não Funcional|
|---|---|
|RNF07.1|A arquitetura do sistema deve permitir a **adição de novas funcionalidades** (ex: integração com Multicaixa, 2FA) sem reestruturação completa|
|RNF07.2|A base de dados deve ser **estruturada de forma normalizada**, suportando crescimento no volume de dados sem perda de integridade|
|RNF07.3|O sistema deve ser desenvolvido de forma a **suportar novos tipos de utilizadores ou categorias** de serviços no futuro|

### RNF08 — Confiabilidade

|ID|Requisito Não Funcional|
|---|---|
|RNF08.1|O sistema deve garantir a **integridade dos dados** através de transações na base de dados em operações críticas (ex: pagamento escrow)|
|RNF08.2|O sistema não deve **perder mensagens ou notificações** enviadas entre utilizadores|
|RNF08.3|As ações irreversíveis (ex: aprovação de pagamento) devem exigir **confirmação explícita** do utilizador antes de serem executadas|

### RNF09 — Armazenamento

|ID|Requisito Não Funcional|
|---|---|
|RNF09.1|Os ficheiros enviados (imagens, PDFs) devem ser **armazenados de forma organizada** utilizando o Laravel Filesystem|
|RNF09.2|O sistema deve definir um **limite máximo de tamanho** para ficheiros enviados pelos utilizadores|
|RNF09.3|As imagens de perfil e portfólio devem ser **comprimidas ou redimensionadas** quando necessário para otimização do espaço|

### RNF10 — Compatibilidade

|ID|Requisito Não Funcional|
|---|---|
|RNF10.1|O sistema deve ser desenvolvido com tecnologias **compatíveis com o ambiente de produção** (PHP, MySQL, Laravel)|
|RNF10.2|O sistema deve funcionar corretamente em **servidores Linux e Windows** (ambiente local e produção)|

# **14. Melhorias Futuras**

- Integração com Multicaixa Express
- Autenticação 2FA
- Notificações por SMS e email
- Sistema de moderação com Inteligência Artificial
- Expansão para novos nichos

# **15. Conclusão**

O desenvolvimento deste projeto permitiu consolidar conhecimentos em desenvolvimento web, arquitetura de sistemas e resolução de problemas.

Além disso, possibilitou a compreensão de como funcionam plataformas digitais reais, preparando o estudante para desafios do mercado profissional.


#  GUIA DE ESTILO - PLATAFORMA SKILLA

Vamos criar um guia de estilo completo e profissional para o teu projeto antes de gerar o prompt para o Google Stitch.

## **1. IDENTIDADE VISUAL**

### **Conceito**

- **Profissionalismo** com toque moderno
- **Confiança** e segurança
- **Acessibilidade** para o mercado angolano
- **Minimalismo** funcional

## **2. PALETA DE CORES**

### **Cores Primárias**

text

```
🔵 Azul Principal (Primary)
#2563EB - Confiança, profissionalismo, tecnologia
Uso: Botões principais, links, destaques

🟦 Azul Escuro (Dark)
#1E40AF - Solidez, autoridade
Uso: Cabeçalhos, textos importantes, navegação

⚪ Branco (White)
#FFFFFF - Limpeza, clareza
Uso: Fundos, cards, áreas de conteúdo
```

### **Cores Secundárias**

text

```
🟠 Laranja (Accent)
#F97316 - Energia, ação, destaque
Uso: CTAs secundários, notificações, badges

🟣 Roxo (Highlight)
#7C3AED - Criatividade, inovação
Uso: Funcionalidades premium, boost de perfil

🟢 Verde (Success)
#10B981 - Sucesso, aprovação
Uso: Mensagens de sucesso, status positivos

🔴 Vermelho (Error)
#EF4444 - Erro, alerta
Uso: Mensagens de erro, ações destrutivas

🟡 Amarelo (Warning)
#F59E0B - Aviso, atenção
Uso: Alertas, pendências
```

### **Cores Neutras**

text

```
⬛ Cinza Escuro (Text Primary)
#1F2937 - Textos principais

⬜ Cinza Médio (Text Secondary)
#6B7280 - Textos secundários, legendas

◻️ Cinza Claro (Border)
#E5E7EB - Bordas, separadores

⬜ Cinza Muito Claro (Background)
#F9FAFB - Fundos secundários, áreas de conteúdo
```

## **3. TIPOGRAFIA**

### **Fontes**

text

```
Fonte Principal: Inter
- Uso: Toda a interface
- Pesos: 400 (Regular), 500 (Medium), 600 (Semibold), 700 (Bold)

Fonte Secundária: Space Grotesk (opcional para títulos grandes)
- Uso: Títulos de destaque, landing page
- Pesos: 500, 700
```

### **Tamanhos de Texto**

text

```
H1 (Título Principal): 2.5rem (40px) - Bold
H2 (Título Seção): 2rem (32px) - Semibold
H3 (Subtítulo): 1.5rem (24px) - Semibold
H4 (Card Title): 1.25rem (20px) - Medium
Body Large: 1.125rem (18px) - Regular
Body: 1rem (16px) - Regular
Body Small: 0.875rem (14px) - Regular
Caption: 0.75rem (12px) - Regular
```

## **4. ESPAÇAMENTO**

text

```
Sistema de espaçamento baseado em múltiplos de 4px:

xs: 4px
sm: 8px
md: 16px
lg: 24px
xl: 32px
2xl: 48px
3xl: 64px
```

## **5. COMPONENTES UI**

### **Botões**

text

```
Botão Primário:
- Cor: #2563EB
- Texto: Branco (#FFFFFF)
- Padding: 12px 24px
- Border-radius: 8px
- Hover: #1E40AF
- Sombra: 0 2px 4px rgba(0,0,0,0.1)

Botão Secundário:
- Cor: Transparente
- Borda: 2px solid #2563EB
- Texto: #2563EB
- Padding: 12px 24px
- Border-radius: 8px
- Hover: fundo #EFF6FF

Botão Destrutivo:
- Cor: #EF4444
- Texto: Branco
- Mesmo formato do primário
```

### **Cards**

text

```
Background: #FFFFFF
Border: 1px solid #E5E7EB
Border-radius: 12px
Padding: 24px
Sombra: 0 1px 3px rgba(0,0,0,0.1)
Hover: Sombra mais intensa
```

### **Inputs**

text

```
Background: #FFFFFF
Border: 1px solid #D1D5DB
Border-radius: 8px
Padding: 12px 16px
Focus: Border #2563EB + Sombra azul suave
Texto: #1F2937
Placeholder: #9CA3AF
```

### **Badges/Tags**

text

```
Background: #EFF6FF
Texto: #2563EB
Padding: 4px 12px
Border-radius: 16px
Tamanho: 14px
```

## **6. ÍCONES**

text

```
Biblioteca: Heroicons ou Lucide Icons
Estilo: Outline (linhas) para ícones gerais
Estilo: Solid (preenchido) para ícones de status/notificação
Tamanho padrão: 20px ou 24px
Cor: Seguir contexto (primária, secundária ou neutra)
```

## **7. IMAGENS E ILUSTRAÇÕES**

text

```
Estilo: Moderno, flat design ou isométrico
Cores: Compatíveis com a paleta (azul e laranja predominantes)
Ilustrações: Para páginas vazias, onboarding, erros
Fotos: Arredondadas (border-radius: 8px para retangulares, 50% para perfis)
```

## **8. SOMBRAS**

text

```
Nível 1 (Cards): 0 1px 3px rgba(0,0,0,0.1)
Nível 2 (Modais): 0 4px 6px rgba(0,0,0,0.1)
Nível 3 (Dropdowns): 0 10px 15px rgba(0,0,0,0.1)
Nível 4 (Popups): 0 20px 25px rgba(0,0,0,0.15)
```

## **9. ANIMAÇÕES**

text

```
Transições: 200-300ms ease-in-out
Hover: Scale 1.02 ou mudança suave de cor
Loading: Spinners azuis (#2563EB)
Skeleton: Shimmer effect em #E5E7EB
```

## **10. LAYOUT**

text

```
Largura máxima do container: 1280px
Grid: 12 colunas
Gap padrão: 24px
Breakpoints:
  - Mobile: < 640px
  - Tablet: 640px - 1024px
  - Desktop: > 1024px
```

## **11. NAVEGAÇÃO**

text

```
Header:
- Background: #FFFFFF
- Altura: 64px
- Sombra: 0 1px 3px rgba(0,0,0,0.1)
- Logo à esquerda
- Menu ao centro/direita

Sidebar (se houver):
- Largura: 256px
- Background: #F9FAFB ou #FFFFFF
- Ícones + texto
```

## **12. ESTADOS VISUAIS**

text

```
Hover: Mudança suave de cor/sombra
Active: Escurecimento de 10%
Disabled: Opacidade 50% + cursor not-allowed
Loading: Skeleton ou spinner
Empty State: Ilustração + mensagem centralizada
Error State: Ícone vermelho + mensagem
Success State: Ícone verde + mensagem
```

## **13. MENSAGENS E FEEDBACKS**

text

```
Toast Notification:
- Posição: Top-right
- Background conforme tipo (verde/vermelho/amarelo/azul)
- Texto branco
- Ícone à esquerda
- Auto-close: 5 segundos

Alertas inline:
- Background suave da cor correspondente
- Borda à esquerda de 4px
- Ícone + mensagem
```

# Diagrama ER - descrição detalhada

O diagrama representa a estrutura de um sistema de marketplace freelance (tipo Upwork/Fiverr), onde existem **clientes, freelancers, trabalhos, propostas, contratos e comunicação**.

Ele está organizado em múltiplas entidades interligadas, garantindo **normalização, rastreabilidade e escalabilidade**.


## 1. Entidade: `profiles`

Esta é a entidade central do sistema (núcleo dos utilizadores).

### 🔹 Função:

Armazena os dados de todos os utilizadores, sejam:

- Clientes
- Freelancers
- Administradores

### 🔹 Principais atributos:

- `id` → identificador único
- `full_name`, `username`, `email`
- `role` → define o tipo de utilizador
- `bio`, `avatar_url`, `location`
- `credits_balance` → saldo interno
- `avg_rating`, `total_reviews`, `total_jobs_completed`
- `is_active`, `is_boosted`

### 🔹 Relacionamentos:

- 1:N com `jobs` (um cliente cria vários jobs)
- 1:N com `proposals` (um freelancer envia várias propostas)
- 1:N com `contracts` (participa como cliente ou freelancer)
- 1:N com `messages`, `notifications`, `reviews`, `boosts`


##  2. Entidade: `skills`

### 🔹 Função:

Armazena habilidades disponíveis na plataforma.

### 🔹 Relacionamentos:

- N:N com `profiles` (via `profile_skills`)
- N:N com `jobs` (via `job_skills`)

## 3. Tabela intermediária: `profile_skills`

Resolve relacionamento muitos-para-muitos:

- Um perfil pode ter várias skills
- Uma skill pode pertencer a vários perfis


## 🔗 4. Tabela intermediária: `job_skills`

Relaciona:

- Jobs ↔ Skills

Permite que um job exija múltiplas habilidades.

## 5. Entidade: `jobs`

### 🔹 Função:

Representa trabalhos publicados pelos clientes.

### 🔹 Atributos:

- `client_id` → dono do job
- `category_id`
- `title`, `description`
- `budget_min`, `budget_max`
- `work_type`, `deadline`
- `status`
- `views_count`

### 🔹 Relacionamentos:

- 1:N com `proposals`
- N:N com `skills`
- 1:1 com `contracts` (quando aceito)

## 6. Entidade: `proposals`

### 🔹 Função:

Propostas enviadas por freelancers.

### 🔹 Atributos:

- `job_id`
- `freelancer_id`
- `cover_letter`
- `proposed_value`
- `delivery_days`
- `status`

### 🔹 Relação:

- Muitos freelancers → 1 job

## 7. Entidade: `contracts`

### 🔹 Função:

Formaliza um acordo após aceitação de proposta.

### 🔹 Atributos:

- `job_id`, `proposal_id`
- `client_id`, `freelancer_id`
- `agreed_value`
- `platform_commission`
- `freelancer_amount`
- `deadline_date`
- `payment_status`
- `work_delivered_at`, `approved_at`

### 🔹 Relação:

- Base para:
    - pagamentos
    - mensagens
    - avaliações

## 8. Entidade: `escrow_transactions`

### 🔹 Função:

Gerir pagamentos seguros (escrow).

### 🔹 Atributos:

- `contract_id`
- `amount`, `commission_amount`
- `freelancer_net_amount`
- `deposited_at`, `released_at`

### 🔹 Importância:

Garante segurança financeira entre cliente e freelancer.

## 9. Entidade: `credit_transactions`

### 🔹 Função:

Controla movimentações internas de saldo.

### 🔹 Atributos:

- `user_id`
- `type` (entrada/saída)
- `amount`
- `balance_after`

## 10. Entidade: `categories`

### 🔹 Função:

Classificação dos jobs.

### 🔹 Relação:

- 1:N com `jobs`
- 1:N com `portfolio_items`

## 11. Entidade: `portfolio_items`

### 🔹 Função:

Portfólio dos freelancers.

### 🔹 Atributos:

- `freelancer_id`
- `title`, `description`
- `image_url`, `project_url`
- `category_id`

## 12. Entidade: `boosts`

### 🔹 Função:

Sistema de destaque pago para freelancers.

### 🔹 Atributos:

- `freelancer_id`
- `credits_spent`
- `started_at`, `expires_at`

## 13. Entidade: `notifications`

### 🔹 Função:

Notificações do sistema.

### 🔹 Atributos:

- `user_id`
- `type`, `title`, `body`
- `is_read`


## 14. Entidade: `conversations`

### 🔹 Função:

Representa uma conversa entre cliente e freelancer.

### 🔹 Relação:

- Ligada a um `contract`


## 15. Entidade: `messages`

### 🔹 Função:

Mensagens dentro das conversas.

### 🔹 Atributos:

- `conversation_id`
- `sender_id`
- `content`
- `file_url`, `file_name`

## 16. Entidade: `reviews`

### 🔹 Função:

Avaliações após conclusão do trabalho.

### 🔹 Atributos:

- `contract_id`
- `reviewer_id`
- `reviewed_id`
- `rating`, `comment`


# VISÃO GERAL DO FLUXO DO SISTEMA

O funcionamento segue esta lógica:

1. Cliente cria um **job**
2. Freelancers enviam **proposals**
3. Cliente aceita → cria um **contract**
4. Pagamento é gerido via **escrow_transactions**
5. Comunicação via **messages**
6. Após conclusão → **reviews**
7. Sistema usa:
    - `notifications`
    - `credits`
    - `boosts`

