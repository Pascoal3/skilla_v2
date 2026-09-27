Esta é uma **excelente** forma de trabalharmos! Escrever o fluxo em texto (pseudocódigo de UX) é uma técnica fantástica chamada User Flow Mapping. Eu consigo perfeitamente visualizar o teu quadro no Canva a partir disto.

A tua lógica de validação Frontend 

```
→→
```

 Backend 

```
→→
```

 JWT 

```
→→
```

 Feedback Visual está com nível de **Desenvolvedor Sénior**. Tens a preocupação exata com a experiência do utilizador (UX), como evitar piscar telas, manter os dados se der erro, e usar cookies HttpOnly para o JWT (que é a forma mais segura).

Vou fazer o mapeamento técnico detalhado deste teu fluxo de **Cliente**, ligando cada tela diretamente à nossa modelagem de banco de dados (DBML).

No final, dou-te um pequeno conselho de UX sobre a parte final do teu fluxo.

---

### 🗺️ ROADMAP TÉCNICO: Fluxo do Cliente Skilla

#### **Fase 0: A Porta de Entrada**

- **Telas:** Landing Page 
    
    ```
    →→
    ```
    
     Modal "Começar Grátis" 
    
    ```
    →→
    ```
    
     Tela Seleção de Role.
    
- **Ação:** O usuário clica em "Sou Cliente".
    
- **Dados:** Apenas estado (state) no Frontend. Nada vai para o BD ainda.
    

#### **Fase 1: Registo e Autenticação (O Núcleo)**

- **Tela:** Formulário de Registo de Cliente.
    
- **Ação:** Preenchimento de Nome, Email, Senha. Validações Frontend. Submissão (POST /api/registar).
    
- **Mapeamento de Base de Dados:**
    
    - **Destino:** Tabela perfis
        
    - Campos preenchidos: nome_completo, email, funcao (definido como 'cliente'), nome_usuario (podes gerar automaticamente a partir do nome), esta_ativo (true).
        
    - **Destino 2:** Tabela carteiras (Opcional, mas recomendado criar a carteira vazia logo no registo).
        
        - Campos: usuario_id = ID do perfil recém-criado, saldo_creditos = 20.
            
    - Nota Técnica de Segurança: No nosso DBML não colocamos o campo senha na tabela perfis. Em Laravel, geralmente mantemos a tabela padrão users (id, email, password) apenas para login, e ligamos 1:1 à nossa tabela perfis. Ou, podes simplesmente adicionar o campo password_hash na tabela perfis.
        
- **Saída:** Geração do Token JWT (como descreveste de forma perfeita) e animação de sucesso.
    

#### **Fase 2: A Decisão (Onboarding Leve)**

- **Tela:** "Postar job agora?"
    
- **Ação (Não):** Redireciona para a **Dashboard**.
    
    - Dados: SELECT * FROM trabalhos WHERE cliente_id = [meu_id] (Retorna vazio).
        
- **Ação (Sim):** Inicia o Wizard de criação de Job.
    

#### **Fase 3: Criação de Job (O Rascunho)**

O utilizador passa pelas Telas 1 a 5. Como ele pode desistir a meio, o ideal é criar o registo na Base de Dados logo no Passo 1 como rascunho, e ir fazendo UPDATE nos passos seguintes.

- **Tela 1 (Título) & Tela 3 (Escopo) & Tela 4 (Orçamento) & Tela 5 (Descrição)**
    
    - **Destino:** Tabela trabalhos
        
    - Campos Atualizados: titulo, tamanho_projeto, duracao_estimada, tipo_trabalho, orcamento_fixo (ou taxas por hora), descricao.
        
    - Status atual: status = 'rascunho'.
        
- **Tela 2 (Habilidades)**
    
    - **Destino:** Tabela trabalho_habilidades
        
    - Ação: Associa o trabalho_id aos IDs das habilidades selecionadas (habilidade_id).
        
- **Tela 6 (Revisão)**
    
    - **Origem:** Lê todos os dados salvos acima da tabela trabalhos e mostra na tela.
        

#### **Fase 4: Publicação e Onboarding Final**

Aqui o teu fluxo tem as 3 telas de Onboarding (Método de Pagamento 

```
→→
```

 Match de Freelancers 

```
→→
```

 Revisão Final).

- **Tela Onboarding 1/3 (Método de Pagamento)**
    
    - O que acontece: Ele escolhe como vai querer depositar dinheiro na plataforma futuramente.
        
    - Destino: Podes guardar isto no LocalStorage do navegador por agora, ou criar um campo metodo_pagamento_preferido na tabela carteiras.
        
- **Tela Onboarding 2/3 (Recomendação de Freelancers)**
    
    - Ação (A Mágica da Busca): O Backend vai procurar os melhores candidatos para o trabalho que acabou de ser desenhado.
        
    - Origem dos Dados (A Query): O sistema faz um SELECT na tabela perfis (funcao = 'freelancer'), cruzando (JOIN) com perfil_habilidades onde as habilidade_id sejam iguais às que o cliente exigiu na Tabela trabalho_habilidades do Job dele.
        
    - Exibição: Mostra a foto, nome e avaliacao_media desses freelancers na tela.
        
- **Tela Onboarding 3/3 (Verificações Finais e Botão Definitivo "Postar")**
    
    - Ação: Clique no botão "Postar Trabalho".
        
    - **Destino (Crucial):** O sistema faz um UPDATE na tabela trabalhos.
        
    - Campo Atualizado: Muda o status de 'rascunho' para **'aberto'**.
        
    - Saída: Redireciona para a **Dashboard** (Onde ele finalmente vê o Job listado como "Aberto e à procura de propostas").
        

---

### 💡 Consultoria de UX/UI (O que melhorar na tua lógica)

O teu fluxo está 95% perfeito. O único ponto de atrito (fricção) que notei está na passagem da Tela 6 para as telas de Onboarding.

**Como Melhorar (O Ajuste Fino):**

1. Na Tela 6 (Revisão), muda o botão "Postar" para **"Avançar para Configurações Finais"** ou **"Concluir Configuração"**.
    
2. Passa pelas telas de Onboarding 1/3 e 2/3 normalmente.
    
3. Na Tela 3/3, aí sim, colocas o grande botão **"Publicar Trabalho Agora"**. É aqui que o spinner roda e o BD muda o status para 'aberto'.
    

### Próximos Passos

O fluxo do Cliente até a postagem do primeiro trabalho está mapeado técnica e visualmente. O BD suporta isto a 100%.

Quando estiveres pronto, podes escrever e mandar o **Fluxo de Freelancer** (Registo, criação de portfólio, achar o job que este cliente acabou de postar, e gastar o crédito para enviar a proposta). Estou pronto para analisar e mapear!



### 🟢 FASE 1: O Registo e Onboarding do Freelancer

**Tela 1 - Registo Inicial (Criar Conta)**

- **O que pede:** Nome completo, Email, Senha.
    
- **Onde é guardado:**
    
    - Tabela perfis: Campos nome_completo, email, funcao (guardado como 'freelancer'), saldo_creditos (sistema preenche com 10 por defeito).
        
    - Tabela carteiras: Cria automaticamente uma carteira para ele. Campos usuario_id (ligado ao perfil) e saldo_creditos (inicia a 20, porque são dados 20 grátis ao registar conta pela primeira vez).
        
- **Onde será exibido depois:** O nome e email serão exibidos no menu da conta dele, no chat de mensagens e no card de propostas que os clientes vão ver.
    

**Tela 2 - Onboarding: Informações de Perfil**

- **O que pede:** Foto de perfil (Avatar), Biografia (resumo sobre ele), Localização (ex: Luanda) e Telefone.
    
- **Onde é guardado:** Tabela perfis (faz-se um UPDATE no perfil recém-criado). Campos url_avatar (após upload para o servidor), bio, localizacao, telefone.
    
- **Onde será exibido depois:** Na página de perfil público dele e no cabeçalho das propostas que ele enviar. A bio ajuda o cliente a decidir se ele é bom.
    

**Tela 3 - Onboarding: Seleção de Habilidades (Skills)**

- **O que pede:** Selecionar múltiplas habilidades (ex: UI/UX, Laravel, Photoshop).
    
- **Onde lê:** Tabela habilidades (para listar as opções disponíveis no ecrã).
    
- **Onde é guardado:** Tabela intermediária perfil_habilidades. Cria um registo associando o perfil_id dele com cada habilidade_id escolhida.
    
- **Onde será exibido depois:** No perfil público dele em formato de "tags" (badges azuis). Também é **crucial** para o motor de busca: o sistema vai ler esta tabela para recomendar este freelancer a clientes que publiquem jobs com estas mesmas habilidades.
    

**Tela 4 - Onboarding: Primeiro Item do Portfólio (Opcional)**

- **O que pede:** Título do projeto antigo, descrição, imagem do projeto e link.
    
- **Onde é guardado:** Tabela itens_portfolio. Campos titulo, descricao, url_imagem, freelancer_id.
    
- **Onde será exibido depois:** Numa grelha/galeria no perfil público do freelancer, servindo como "montra" do seu trabalho para convencer os clientes.
    

---

### 🔵 FASE 2: A Procura e a Candidatura (Encontrar o Job)

**Tela 5 - Feed de Trabalhos (Explorar Jobs)**

- **O que mostra:** Uma lista de cards com as vagas disponíveis.
    
- **De onde vêm os dados:** Tabela trabalhos. O sistema faz um SELECT puxando trabalhos onde status seja 'aberto'. Mostra os campos titulo, orcamento_fixo (ou taxa por hora), tamanho_projeto e o criado_em (para mostrar "Publicado há 2 horas").
    
- **Onde será exibido depois:** O freelancer clica num destes cards para ir para a Tela 6.
    

**Tela 6 - Detalhe da Vaga (Página do Job)**

- **O que mostra:** Toda a informação detalhada do projeto que o Cliente escreveu.
    
- **De onde vêm os dados:**
    
    - Tabela trabalhos: Lê o campo descricao, duracao_estimada, nivel_experiencia.
        
    - Tabela trabalho_anexos: Lê os links dos ficheiros (se o cliente tiver anexado referências de PDF/imagens).
        
    - Tabela perfis: Mostra um pequeno card sobre o Cliente (dono da vaga), lendo o nome_completo e a avaliacao_media (para o freelancer saber se é um bom cliente).
        

**Tela 7 - Formulário de Envio de Proposta**

- **O que pede:** Carta de apresentação (porque é o melhor para o trabalho?), Valor proposto (pode negociar o valor do cliente) e Prazo de entrega (em dias).
    
- **A Lógica de Segurança (Antes de gravar):** O sistema verifica a Tabela perfis, campo saldo_creditos. Se for >= 1, ele deixa avançar.
    
- **Onde é guardado (São 3 ações no Banco):**
    
    1. Tabela propostas: Salva carta_apresentacao, valor_proposto, dias_entrega, o job_id, o freelancer_id, e status fica 'pendente'.
        
    2. Tabela perfis: Faz um UPDATE subtraindo 1 no saldo_creditos do freelancer.
        
    3. Tabela transacoes_credito (Opcional/Auditoria): Salva um registo com tipo = 'debito_proposta', valor -1.
        
- **Onde será exibido depois:** Na "Tela de Gestão de Propostas" do Cliente (que vai ler a tabela propostas para decidir quem contratar).
    

---

### 🟣 FASE 3: O "Aperto de Mão" e o Escrow (Voltamos à Visão do Cliente)

**Tela 8 - Checkout / Contratação (Ação do Cliente)**

- **Contexto:** O Cliente viu a proposta do freelancer e clicou em "Aceitar e Pagar".
    
- **A Lógica de Segurança:** Verifica a Tabela carteiras do Cliente. Se o saldo for suficiente para pagar o valor_proposto, avança.
    
- **Onde é guardado (A Mágica Financeira do Sistema - 5 Ações!):**
    
    1. **A Carteira:** Faz UPDATE na tabela carteiras do Cliente, subtraindo o valor. Regista o movimento na tabela transacoes_carteiras (tipo='debito_escrow').
        
    2. **O Contrato:** Cria registo na Tabela contratos. Salva o valor_acordado, dias_entrega, status_contrato = 'ativo', e status_pagamento = 'retido'.
        
    3. **O Escrow:** Cria registo na Tabela transacoes_escrow. O dinheiro fica retido aqui. Regista carteira_origem_id (Cliente) e carteira_destino_id (Freelancer). Status = 'retido'.
        
    4. **A Vaga:** Faz UPDATE na Tabela trabalhos. Muda o status para 'em_andamento'. Atualiza a Tabela propostas, mudando a proposta do freelancer selecionado para 'aceita'.
        
    5. **A Comunicação:** Cria um registo vazio na Tabela conversas associado a este novo contrato_id.
        
- **Onde será exibido depois:** Ambos são redirecionados para a Tela de Chat (Sala de Trabalho). O painel de ambos mostraará o Job como "Em andamento".
    

---

### 🟠 FASE 4: O Trabalho e a Libertação de Fundos

**Tela 9 - Sala de Trabalho (Chat e Ficheiros)**

- **O que pede:** Envio de mensagens de texto e anexos.
    
- **Onde é guardado:** Tabela mensagens. Salva o conteudo, remetente_id (quem escreveu) e vincula ao conversa_id. Se for ficheiro, salva a url_arquivo.
    
- **Onde será exibido depois:** Em tempo real na mesma tela para a outra parte ler (usando o WebSockets do Laravel).
    

**Tela 10 - Entrega e Aprovação (O Fim do Projeto)**

- **Ação do Freelancer:** Clica em "Submeter Trabalho Final".
    
    - Onde guarda: UPDATE em contratos, preenche o timestamp trabalho_entregue_em.
        
- **Ação do Cliente:** Revê os ficheiros finais no chat e clica em **"Aprovar e Libertar Pagamento"**.
    
- **Onde é guardado (Libertação do Escrow):**
    
    1. **Contrato:** UPDATE em contratos -> status_contrato = 'concluido'.
        
    2. **Escrow:** UPDATE em transacoes_escrow -> status_pagamento = 'liberado'.
        
    3. **A Carteira do Freelancer:** UPDATE na carteiras do Freelancer, adicionando o valor (menos os 10% da plataforma). Regista em transacoes_carteiras (tipo='credito_escrow').
        
- **Onde será exibido depois:** O Freelancer vai ao ecrã "A minha carteira" e vê o seu saldo positivo (Kz) e o histórico da transação concluída!
    

**Tela 11 - Avaliação (Review)**

- **O que pede:** Popup com 5 Estrelas e uma caixa de comentário de feedback.
    
- **Onde é guardado:** Tabela avaliacoes. Salva nota (1 a 5), comentario, quem avaliou e quem foi avaliado.
    
- **Efeito Automático:** O sistema faz a média de todas as notas do freelancer na tabela avaliacoes e dá um UPDATE direto no campo avaliacao_media da tabela perfis.
    
- **Onde será exibido depois:** No perfil público e em futuros jobs em que o utilizador participe (é o selo de confiança dele para próximos clientes).


---

Admin

### 🛡️ FASE 1: O Centro de Comando (Dashboard)

**Tela 1 - Login Administrativo**

- **Onde é verificado:** O processo de login é o mesmo, mas o backend verifica a tabela perfis. Se o campo funcao for diferente de 'admin', o sistema barra o acesso a este painel e redireciona para a área normal.
    

**Tela 2 - Dashboard (A Visão Global)**

- **O que mostra:** KPIs (Key Performance Indicators) da plataforma. Dinheiro a circular, total de utilizadores, alertas de disputas.
    
- **De onde vêm os dados (Múltiplos SELECTS e COUNTS):**
    
    - Total de Utilizadores: Conta registos na tabela perfis.
        
    - Jobs Ativos: Conta registos na tabela trabalhos onde status = 'aberto'.
        
    - Dinheiro Preso no Sistema: Soma (SUM) o campo valor da tabela transacoes_escrow onde status_pagamento = 'retido'.
        
    - Lucro da Plataforma: Soma (SUM) o campo valor_comissao dos contratos concluídos.
        

---

### 👮 FASE 2: Moderação (Gerir Utilizadores e Jobs)

**Tela 3 - Lista de Utilizadores (Clientes e Freelancers)**

- **O que mostra:** Uma tabela com todos os registos. Permite ver quem está a ser muito mal avaliado ou a cometer fraudes.
    
- **De onde vêm os dados:** Tabela perfis.
    
- **Ação Crítica - Banir/Suspender Utilizador:**
    
    - Onde é guardado: O Admin clica num botão de "Suspender Conta". O sistema faz um UPDATE na tabela perfis mudando o campo **esta_ativo** de true para **false**.
        
    - Efeito prático: Na próxima vez que esse utilizador tentar fazer login, o JWT falha e diz "A sua conta foi suspensa pela administração".
        

**Tela 4 - Gestão de Jobs (Auditoria de Vagas)**

- **O que mostra:** Todas as vagas publicadas. Serve para apagar vagas com conteúdo ilegal, ofensivo ou spam.
    
- **De onde vêm os dados:** Tabela trabalhos.
    
- **Ação Crítica - Apagar/Cancelar Vaga:**
    
    - Onde é guardado: UPDATE na tabela trabalhos, mudando o status para 'cancelado'.
        

---

### ⚖️ FASE 3: O Tribunal (Resolução de Disputas)

Esta é a tarefa mais importante e complexa do Administrador.

**Contexto:** O Freelancer entregou o trabalho, mas o Cliente odiou e diz que foi burla. O Cliente clicou em "Abrir Disputa". O dinheiro do Escrow congelou.

**Tela 5 - Painel de Disputas**

- **O que mostra:** Uma lista de alertas de conflitos abertos.
    
- **De onde vêm os dados:** Tabela disputas onde status = 'aberta'.
    

**Tela 6 - Sala de Julgamento (Detalhe da Disputa)**

- **O que o Admin vê para tomar uma decisão:**
    
    - O motivo da disputa (Tabela disputas).
        
    - O que foi acordado no início (Lê a Tabela trabalhos e propostas).
        
    - **A Prova (Chat):** O Admin tem permissão para ler o histórico na Tabela mensagens vinculada àquele contrato. Ele vai ler o chat para ver quem tem razão e se o freelancer entregou os ficheiros prometidos.
        

**Ação Crítica - Tomar uma Decisão (O Veredito):**  
O Admin escreve a justificação no campo decisao_admin (Tabela disputas) e clica num de dois botões:

- 🔴 **Botão A: Decisão a favor do Cliente (Freelancer não cumpriu):**
    
    1. UPDATE em disputas (status = 'resolvida_cliente').
        
    2. UPDATE em transacoes_escrow (status_pagamento = 'devolvido_cliente').
        
    3. UPDATE em carteiras do Cliente devolvendo o valor. Gera registo em transacoes_carteiras (tipo = 'reembolso_escrow').
        
    4. UPDATE em contratos (status_contrato = 'cancelado').
        
- 🟢 **Botão B: Decisão a favor do Freelancer (Cliente está a tentar não pagar por um trabalho feito):**
    
    1. UPDATE em disputas (status = 'resolvida_freelancer').
        
    2. UPDATE em transacoes_escrow (status_pagamento = 'liberado').
        
    3. UPDATE em carteiras do Freelancer enviando o valor (menos a comissão). Gera registo em transacoes_carteiras (tipo = 'credito_escrow').
        
    4. UPDATE em contratos (status_contrato = 'concluido').
        

---

### 📈 FASE 4: O Cofre (Relatórios Financeiros)

**Tela 7 - Relatórios de Faturação da Skilla**

- **O que mostra:** Gráficos e tabelas com o dinheiro real que a plataforma ganhou.
    
- **De onde vêm os dados (As fontes de lucro da plataforma):**
    
    1. **Comissões (10%):** O Admin vê a soma do campo valor_comissao da tabela transacoes_escrow (apenas de contratos com status 'liberado').
        
    2. **Venda de Destaques/Boosts:** Lê a tabela transacoes_credito filtrando por tipo = 'compra_destaque' ou 'compra_credito'.
        

---

### Resumo do Papel do Admin no Sistema:

Enquanto os Clientes e Freelancers interagem através de formulários coloridos e botões simpáticos, o **Administrador é quem gere as Tabelas de Estado** (esta_ativo, status, status_contrato).

O painel de Admin não precisa de ser muito bonito, mas tem de ser **extremamente funcional e apresentar dados em tempo real**. É ele que garante que a Skilla é um ambiente confiável para se fazer negócios em Angola.