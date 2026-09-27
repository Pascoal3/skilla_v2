### 🗺️ MAPEAMENTO: Telas, Funcionalidades e Fluxo de Dados

Vamos dividir o sistema em "Módulos" (exatamente como estão nos quadrados do diagrama).

#### 1. Módulo de Autenticação & Perfis (A Base)

**Atores:** Cliente e Freelancer

- **Tela 1: Registo / Login.**
    
    - Fluxo: O utilizador insere os dados.
        
    - Destino: Tabela perfis (criação da conta).

- **Tela 2: Edição de Perfil (Dashboard Settings).**
    
    - O que faz: Cliente edita foto/bio. Freelancer edita foto, bio e adiciona Skills.
        
    - Origem/Destino: Lê e atualiza a tabela perfis. Salva habilidades na tabela perfil_habilidades. Ficheiros de imagem vão para o Storage do Laravel e o link fica no banco de dados.


Primeiro, **respira fundo**. É super normal sentir-se confuso nesta fase. O que tu tens nas mãos é um projeto de grande escala (um SaaS/Marketplace), e olhar para tudo ao mesmo tempo causa paralisia.

A excelente notícia é: **A tua documentação está incrivelmente bem feita.** O teu diagrama de caso de uso, os requisitos (funcionais e não funcionais), o guia de estilo e a modelagem do banco de dados (que ajustamos antes) estão alinhados. Tu já tens o mapa, só precisas de saber como ler e por onde começar a caminhar.

Vou "descodificar" o teu diagrama de caso de uso e cruzá-lo com a tua base de dados. Vou mapear exatamente **quais telas precisas criar, de onde vêm os dados e para onde vão.**

---

### 🗺️ MAPEAMENTO: Telas, Funcionalidades e Fluxo de Dados

Vamos dividir o teu sistema em "Módulos" (exatamente como estão nos quadrados do teu diagrama).

#### 1. Módulo de Autenticação & Perfis (A Base)

**Atores:** Cliente e Freelancer

- **Tela 1: Registo / Login.**
    
    - Fluxo: O utilizador insere os dados.
        
    - Destino: Tabela perfis (criação da conta).
        
- **Tela 2: Edição de Perfil (Dashboard Settings).**
    
    - O que faz: Cliente edita foto/bio. Freelancer edita foto, bio e adiciona Skills.
        
    - Origem/Destino: Lê e atualiza a tabela perfis. Salva habilidades na tabela perfil_habilidades. Ficheiros de imagem vão para o Storage do Laravel e o link fica no banco de dados.
        

#### 2. Módulo de Gestão de Jobs (Visão do Cliente)

**Ator Principal:** Cliente

- **Tela 3: Publicar Job (Aquele fluxo de 5 passos que vimos antes).**
    
    - O que faz: O cliente preenche título, escopo, orçamento, etc.
        
    - Destino: Tabela trabalhos (começa como 'rascunho', ao finalizar vai para 'aberto'). As skills vão para trabalho_habilidades.
        
- **Tela 4: Dashboard do Cliente (Meus Jobs).**
    
    - O que faz: Lista todos os jobs que o cliente publicou (ativos, pendentes, concluídos).
        
    - Origem: Tabela trabalhos onde cliente_id seja o utilizador atual.


Primeiro, **respira fundo**. É super normal sentir-se confuso nesta fase. O que tu tens nas mãos é um projeto de grande escala (um SaaS/Marketplace), e olhar para tudo ao mesmo tempo causa paralisia.

A excelente notícia é: **A tua documentação está incrivelmente bem feita.** O teu diagrama de caso de uso, os requisitos (funcionais e não funcionais), o guia de estilo e a modelagem do banco de dados (que ajustamos antes) estão alinhados. Tu já tens o mapa, só precisas de saber como ler e por onde começar a caminhar.

Vou "descodificar" o teu diagrama de caso de uso e cruzá-lo com a tua base de dados. Vou mapear exatamente **quais telas precisas criar, de onde vêm os dados e para onde vão.**

---

### 🗺️ MAPEAMENTO: Telas, Funcionalidades e Fluxo de Dados

Vamos dividir o teu sistema em "Módulos" (exatamente como estão nos quadrados do teu diagrama).

#### 1. Módulo de Autenticação & Perfis (A Base)

**Atores:** Cliente e Freelancer

- **Tela 1: Registo / Login.**
    
    - Fluxo: O utilizador insere os dados.
        
    - Destino: Tabela perfis (criação da conta).
        
- **Tela 2: Edição de Perfil (Dashboard Settings).**
    
    - O que faz: Cliente edita foto/bio. Freelancer edita foto, bio e adiciona Skills.
        
    - Origem/Destino: Lê e atualiza a tabela perfis. Salva habilidades na tabela perfil_habilidades. Ficheiros de imagem vão para o Storage do Laravel e o link fica no banco de dados.
        

#### 2. Módulo de Gestão de Jobs (Visão do Cliente)

**Ator Principal:** Cliente

- **Tela 3: Publicar Job (Aquele fluxo de 5 passos que vimos antes).**
    
    - O que faz: O cliente preenche título, escopo, orçamento, etc.
        
    - Destino: Tabela trabalhos (começa como 'rascunho', ao finalizar vai para 'aberto'). As skills vão para trabalho_habilidades.
        
- **Tela 4: Dashboard do Cliente (Meus Jobs).**
    
    - O que faz: Lista todos os jobs que o cliente publicou (ativos, pendentes, concluídos).
        
    - Origem: Tabela trabalhos onde cliente_id seja o utilizador atual.
        

#### 3. Módulo de Propostas e Busca (Visão do Freelancer)

**Ator Principal:** Freelancer

- **Tela 5: Explorar Jobs (Feed de vagas).**
    
    - O que faz: Lista todos os jobs com status 'aberto'. Tem filtros de busca e categoria.
        
    - Origem: Tabela trabalhos (trazendo informações do cliente via join com a tabela perfis).
        
- **Tela 6: Detalhe do Job & Envio de Proposta.**
    
    - O que faz: O freelancer lê o job, escreve a "cover letter" e define o seu preço.
        
    - Fluxo Logístico: Ao clicar em "Enviar", o sistema verifica se ele tem Créditos (saldo_creditos na tabela perfis). Se sim, desconta 5 créditos (Registo em transacoes_credito) e salva a proposta na tabela propostas.


#### 4. O Coração do Sistema: Contratação & Pagamentos (Escrow)

**Atores:** Cliente, Freelancer, Sistema

- **Tela 7: Visualizar Propostas (Dashboard Cliente).**
    
    - O que faz: Cliente vê a lista de quem se candidatou ao seu Job.
        
    - Origem: Tabela propostas ligadas àquele trabalho_id.
        
- **Ação Crítica (Aceitar Proposta & Realizar Depósito):**
    
    - O Fluxo no Backend (Invisível para o utilizador):
        
        1. O cliente clica em "Aceitar e Pagar".
            
        2. O sistema desconta o dinheiro da carteira (carteiras) do Cliente (Registo em transacoes_carteiras como saída).
            
        3. O sistema cria um registo na tabela **contratos**.
            
        4. O sistema cria um registo em **transacoes_escrow** com status 'retido'. O dinheiro está "congelado" no sistema.
            
        5. Cria-se uma sala de **conversas**.


#### 5. Módulo de Comunicação & Entrega

**Atores:** Ambos

- **Tela 8: Sala de Trabalho (Chat).**
    
    - O que faz: Onde a mágica acontece. Chat em tempo real.
        
    - Origem/Destino: Textos vão para a tabela mensagens. Ficheiros (PDFs, imagens) vão para o Storage do Laravel e o link (url) vai para a tabela mensagens.
        
- **Ação: Entregar Trabalho.**
    
    - O freelancer clica num botão "Submeter Trabalho Final". Muda o status do contratos para aguardando aprovação.


#### 6. Módulo de Aprovação & Avaliações

**Atores:** Ambos e Sistema

- **Ação Crítica (Aprovar Entrega & Liberar Pagamento):**
    
    - O Fluxo no Backend:
        
        1. Cliente clica em "Aprovar Trabalho".
            
        2. O **Sistema** altera o status em transacoes_escrow para 'liberado'.
            
        3. O **Sistema** credita o valor na carteira (carteiras) do Freelancer (Registo em transacoes_carteiras como entrada).
            
- **Tela 9: Deixar Avaliação.**
    
    - O que faz: Popup/Tela para dar as 5 estrelas e comentário.
        
    - Destino: Tabela avaliacoes. Uma vez salvo, dispara um trigger/evento para atualizar a média (avg_rating) na tabela perfis.


**Fase 1: A Fundação (1 Semana)**

- Esquece pagamentos e chats.
    
- Cria a base de dados usando o esquema DBML que consolidamos.
    
- Faz as telas de Login, Registo e Edição de Perfil de Cliente e Freelancer.
    
- Objetivo: Conseguir criar uma conta, fazer login e ver o nome no ecrã.
    

**Fase 2: O Mercado (1 a 2 Semanas)**

- Faz o Cliente conseguir postar um Job (o fluxo de 5 etapas).
    
- Faz a tela do Freelancer que lista os jobs (Feed).
    
- Faz o portfólio do Freelancer.
    
- Objetivo: Ter trabalhos publicados e visíveis, como se fosse um quadro de avisos.
    

**Fase 3: O "Aperto de Mão" (1 Semana)**

- Cria a lógica de "Enviar Proposta" e descontar o "crédito".
    
- Mostra ao Cliente a lista de quem enviou propostas.
    
- Objetivo: Conectar a necessidade do cliente com o interesse do freelancer.
    

**Fase 4: O Dinheiro (O Escrow Simulado) (1 a 2 Semanas)**

- Cria a tela "Minha Carteira" com um botão para adicionar fundos (simulado).
    
- Implementa o clique de "Aceitar Proposta": tira dinheiro da carteira do cliente e mete na tabela Escrow.
    
- Objetivo: Entender o fluxo de transações seguras.
    

**Fase 5: O Trabalho e Fim (1 Semana)**

- Implementa o Chat usando Pusher ou Laravel Reverb.
    
- Implementa o botão de "Trabalho Concluído" e "Aprovar".
    
- Ao aprovar, liberta o dinheiro para a carteira do freelancer.
    
- Sistema de Estrelas (Avaliações).


1. **"Fingir o Pagamento Multicaixa"**: O teu cliente vai a uma tela "Minha Carteira", clica em "Recarregar", seleciona "Multicaixa Express". O sistema cria um registo na tabela transacoes_carteiras com tipo: 'recarga', metodo_pagamento: 'multicaixa_express' e valor: +50.000 (positivo). Imediatamente, o saldo da carteiras dele sobe. Com esse saldo positivo, ele já pode Aceitar Propostas!
    
2. **A Ação do Cron Job (Sistema)**: Vais criar um Schedule Command no Laravel que corre todos os dias à meia-noite (->daily()). Ele vai olhar para a tabela trabalhos. Se o campo expira_em for menor que now() e o status for 'aberto', ele faz um UPDATE mudando o status para 'cancelado'. Simples e limpo.
    
3. **O Botão de Pânico (Disputas)**: Se o cliente odiar o trabalho, ele não clica em "Aprovar". Ele clica em "Reportar Problema / Cancelar". Isso muda o status_contrato para 'em_disputa' e cria um registo na tabela disputas. Se a disputa for dada a favor do cliente, o sistema regista em transacoes_carteiras um tipo: 'reembolso_escrow' com um valor positivo, devolvendo o dinheiro à carteira dele. O Escrow muda para 'devolvido_cliente'.