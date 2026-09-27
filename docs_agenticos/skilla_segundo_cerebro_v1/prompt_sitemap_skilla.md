Baseado nessas informações, preciso que crie um roadmap para o desenvolvimento do sistema, com base nos autores, requisitos e as informações do próprio sistema, quero um planeamento das telas do sistema, quero saber quantas telas devem ter, o que devem ter, como deve ser o layout delas, como por exemplo: cabeçalho (logo, âncoras e botões de login), main (hero section, seção de descrição da plataforma e etc), seguindo essa ordem, precisa ser uma espécie de sitemap explicativo, onde mostras primeiro, as necessidades do sistema para cada autor, depois, qual tela resolve qual problema e o que deve ir nessa tela, como form, seção, footer e tudo mais, até agora, só pensei nessas três telas: Telas

Tela 1: Landing (início)

Página dedicada para visitantes (pessoas sem login/cadastro)

Objetivo: Informar aos visitantes, que visitam pela primeira vez o que é a plataforma, o que podem fazer na plataforma, como funciona a plataforma e etc.

Ter opção de criar conta e logar.



Tela 2: Feed de jobs 

Lateral esquerda conta com form de filtros

Objetivo: Mostrar os jobs disponíveis, filtrar para encontrar jobs específicos, mostrar detalhes para tornar mais fácil a tomada de decisão (ex: filtros como categoria (design ou dev)

orçamento (1,000kzs até 300.000kzs)

prazo de entrega (menos de 1 semana, 1-2 semanas, até 1 mês, mais de 1 mês).

nível de freelancer (iniciante, intermédio e especialista)

Localização (Luanda ou Remoto)

Lateral direita conta com seção onde aparecem os jobs



Tela 3: Detalhe + proposta

Ter botão de voltar ao feed (de jobs)



info_sistema:

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

 