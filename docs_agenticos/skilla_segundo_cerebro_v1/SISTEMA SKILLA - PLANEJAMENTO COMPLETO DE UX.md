# PRÉ-ANÁLISE: FLUXO PRINCIPAL (12 PASSOS)

Antes dos blocos, este é o fluxo core para identificar telas obrigatórias:

```
1.  Visitante acessa landing page
2.  Visitante se regista (Cliente ou Freelancer)
3.  Usuário faz login
4.  Cliente publica um job
5.  Freelancer navega no feed de jobs
6.  Freelancer acessa detalhe do job e envia proposta
7.  Cliente recebe notificação e avalia propostas
8.  Cliente aceita proposta → contrato criado
9.  Pagamento simulado (escrow) é activado
10. Partes comunicam via chat em tempo real
11. Freelancer entrega → Cliente aprova
12. Avaliações mútuas → pagamento liberado
```

# BLOCO 1: NECESSIDADES POR ATOR

|Ator|Necessidade / Dor|Requisito relacionado|
|---|---|---|
|**Visitante**|Entender o que é a plataforma antes de se comprometer|RF01 (Landing)|
|**Visitante**|Registar-se de forma simples como Cliente ou Freelancer|RF02 (Registo)|
|**Visitante**|Ver exemplos de trabalhos e credibilidade da plataforma|RF01 (Social proof)|
|**Visitante**|Recuperar senha caso esqueça as credenciais|RF02 (Auth)|
|**Cliente**|Publicar jobs com descrição clara, prazo e orçamento|RF03 (Jobs)|
|**Cliente**|Gerir todos os seus jobs num só lugar|RF03 (Dashboard)|
|**Cliente**|Receber e comparar propostas de freelancers|RF04 (Propostas)|
|**Cliente**|Aceitar uma proposta e formalizar contrato|RF04/RF05|
|**Cliente**|Comunicar com o freelancer de forma segura|RF06 (Chat)|
|**Cliente**|Fazer pagamento simulado (escrow) com segurança|RF08 (Escrow)|
|**Cliente**|Avaliar o freelancer após conclusão do trabalho|RF09 (Avaliações)|
|**Cliente**|Receber notificações sobre propostas e entregas|RF10 (Notificações)|
|**Cliente**|Gerir perfil e dados da conta|RF02/RF07|
|**Freelancer**|Descobrir jobs relevantes para as suas competências|RF03 (Feed)|
|**Freelancer**|Enviar propostas competitivas com valor e prazo|RF04 (Propostas)|
|**Freelancer**|Construir portfólio visível para atrair clientes|RF07 (Portfólio)|
|**Freelancer**|Comunicar com o cliente durante o projecto|RF06 (Chat)|
|**Freelancer**|Acompanhar estado das suas propostas e contratos|RF05/RF04|
|**Freelancer**|Receber avaliações positivas para aumentar reputação|RF09|
|**Freelancer**|Receber pagamento após aprovação do cliente|RF08 (Escrow)|
|**Freelancer**|Receber notificações de resposta às propostas|RF10|
|**Freelancer**|Gerir perfil profissional e competências|RF07|

# BLOCO 2: SITEMAP EXPLICATIVO

> **Nota de fusão:** Identifiquei 16 telas candidatas. Apliquei fusões nos seguintes casos:
> 
> - **Login + Registo** → mantidos separados (fluxos e campos distintos)
> - **Dashboard Cliente + Dashboard Freelancer** → telas separadas (dados e acções completamente diferentes — RF03 vs RF04/RF07)
> - **Listagem de Propostas (Cliente)** → fundida no Dashboard do Cliente como tab/secção (evita tela extra de baixo valor isolado)
> - **Perfil público do Freelancer** → tela própria (resolve RF07 + RF09, consumida por Clientes e Visitantes)
> - **Notificações** → implementada como componente global + tela de centro de notificações (RF10)
> - **Recuperar Senha** → tela dedicada (segurança, RF02)
> 
> Total final: 12 telas.


|Código|Nome da Tela|Ator(es)|Problema que resolve|RFs atendidos|
|---|---|---|---|---|
|**T01**|Landing Page|Visitante|Apresentar a plataforma, gerar confiança e converter visitantes em registos|RF01.1, RF01.2|
|**T02**|Registo|Visitante|Criar conta como Cliente ou Freelancer com dados básicos|RF02.1, RF02.2|
|**T03**|Login|Visitante / Todos|Autenticar usuário existente de forma segura|RF02.3, RF02.4|
|**T04**|Recuperar Senha|Visitante / Todos|Permitir reset de senha via e-mail|RF02.5|
|**T05**|Dashboard — Cliente|Cliente|Visão geral dos jobs publicados, propostas recebidas e contratos activos|RF03.1, RF03.2, RF04.1, RF04.2, RF05.1, RF10.1|
|**T06**|Dashboard — Freelancer|Freelancer|Visão geral de propostas enviadas, contratos activos, ganhos e notificações|RF04.3, RF05.2, RF07.1, RF08.2, RF10.1|
|**T07**|Feed de Jobs|Freelancer|Descobrir e filtrar jobs publicados por clientes|RF03.3, RF03.4|
|**T08**|Detalhe do Job + Envio de Proposta|Freelancer / Cliente|Ver detalhes completos de um job e enviar proposta (Freelancer) ou gerir propostas recebidas (Cliente)|RF03.5, RF04.1, RF04.2, RF04.3|
|**T09**|Publicar / Editar Job|Cliente|Criar ou editar um job com título, descrição, orçamento e prazo|RF03.1, RF03.2, RF03.6|
|**T10**|Chat — Conversa|Cliente / Freelancer|Comunicação em tempo real dentro de um contrato activo|RF06.1, RF06.2, RF06.3|
|**T11**|Perfil Público do Freelancer|Visitante / Cliente / Freelancer|Ver portfólio, competências, avaliações e histórico de um freelancer|RF07.1, RF07.2, RF09.1, RF09.2|
|**T12**|Editar Perfil + Portfólio|Cliente / Freelancer|Gerir dados pessoais, foto, competências e itens do portfólio|RF02.6, RF07.1, RF07.2, RF07.3|

