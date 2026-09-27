# Os meus trabalhos - página onde lista todos os trabalhos postados pelo cliente
No card tem o título do trabalho, estado, data de publicação, valor estimado, nº de propostas e ID.
Botão de editar e de visualizar (completo).


# Propostas recebidas - página em que são listadas todas as propostas recebidas de freelas ao cliente

Cards que contêm o título do trabalho que está associada a proposta, estado(pendente, aceito, rejeitado), para os cards com estado aceito e rejeitado não tem botão de ação, mas para todas as pendentes, tem botão de ação "aceitar (ícone de check)" e "recusar (ícone de x)", ao clicar num desses botões, muda o estado da proposta e automaticamente desabilita os botões de decisão, porque já foram decididos, data de envio (no formato dd/mm/aaaa), valor proposto (quantia + "Kz", ex: 450.000 Kz), prazo de entrega (dias) e o ID da proposta ("#" + número, ex: #0001)


# Mensagens 
## 1) Tela inicial: **Mensagens (Inbox / lista de salas de trabalho)**

### 1.1 Cabeçalho da página

- No topo existe um título principal: **“Mensagens”**.
- Abaixo (ou como subtítulo) aparece a contextualização: **“Salas de trabalho vinculadas a contratos”**.
- Do lado direito do cabeçalho há um botão de ações (ícone de **três pontos**), que sugere acesso a opções adicionais (ex.: filtros, configurações, etc.).

### 1.2 Lista de conversas (cards de salas)

Abaixo do cabeçalho, a página apresenta uma lista vertical de **cards**, onde cada card representa uma **sala de trabalho** (um chat relacionado a um contrato).

Cada item da lista contém, de forma consistente:

**(a) Avatar/foto do participante**

- À esquerda do card aparece uma **foto do freelancer** (ou um ícone quando não há foto).
- Este avatar serve como reconhecimento rápido da pessoa associada à sala.

**(b) Título do projeto/sala (linha principal)**

- Ao lado do avatar, em destaque, aparece o **nome da sala de trabalho** ou uma descrição intuitiva do projeto.
- Exemplo de padrão:
    - **“Sala de trabalho — Logo Skilla”**
    - **“Sala de trabalho — Identidade visual Barber Shop”**
    - ou ainda títulos diretos do projeto como **“Website para Restaurante”**, **“Landing Page para App”**.

**(c) Prévia da última mensagem (linha secundária)**

- Logo abaixo do título existe uma **prévia do último conteúdo trocado** (última mensagem recebida ou enviada).
- Essa prévia ajuda o utilizador a entender rapidamente “o que está pendente” sem abrir o chat.
- Exemplos visíveis:
    - “Enviei as primeiras opções do logotipo. Pode validar?”
    - “Os arquivos do Figma foram atualizados com as novas fotos.”
    - “Tudo certo. O pagamento da primeira parcela foi liberado.”

**(d) Timestamp (hora/data da última mensagem)**

- No canto direito do card aparece o **timestamp** da última atividade.
- O formato varia conforme a recência:
    - **Hora** (ex.: “12:45”, “09:30”) quando foi hoje.
    - **“Ontem”** quando foi no dia anterior.
    - **Dia da semana** (ex.: “Segunda”) para mensagens mais antigas na mesma semana.
    - **Data curta** (ex.: “12 Mar”) quando já é mais antigo.

**(e) Indicador de mensagens não lidas (badge)**

- Para algumas salas, aparece um **badge circular com número** (ex.: “3”, “1”) indicando **quantidade de mensagens não lidas**.
- Esse badge fica próximo do timestamp no lado direito, servindo como chamada visual de prioridade.

### 1.3 Comportamento esperado

- Cada card funciona como um atalho: ao tocar/clique, o utilizador entra na **Sala de trabalho** correspondente (chat do contrato).

Na hora de dinamizar os dados, ao criar o card via js, é muito importante que esta seja a estrutura do card: 

```
<div data-open-chat class="bg-tertiary rounded-xl px-3 py-3 flex items-center gap-3 cursor-pointer hover:shadow-md transition-all border border-transparent hover:border-surface-container-lowest group relative overflow-hidden">

                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-surface-container-lowest"></div>

                    <img class="w-10 h-10 rounded-full object-cover bg-secondary"

                        alt="Avatar"

                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuB8IpAPjEGC61SjgTvvLluR4_zqfrAtVfAG1nLoA4Zfx42cFBApbVfnCNatWg3ZgQ0Jy8EishspWdM6L54qGXtImKfZ4cAZgqNARagAMjsXuDzjs5s0UknIkMd8YEcZitS42-zQT0iImQOmju6A4mMNUhZxtlKyVqIeamyLUd4xbTGqpD0JfTOLgJkG8RytvVO78wDhUJ2DQZRZFdKCi8T25VinDqtC4RvyqDfOm2dKaKtGUraovX8BShqlw66lqyfhBMTq7PA27tw"/>

                    <div class="flex-1 min-w-0">

                        <h3 class="text-body-md font-body-lg font-bold text-on-tertiary truncate">Sala de trabalho — Logo Skilla</h3>

                        <p class="text-body-sm font-body-md text-surface-variant truncate font-semibold">Enviei as primeiras opções do logotipo. Pode validar?</p>

                    </div>

                    <div class="flex flex-col items-end gap-1 shrink-0">

                        <span class="text-label-sm font-label-sm text-surface-container-lowest font-bold">12:45</span>

                        <span class="bg-surface-container-lowest text-primary-container text-label-sm font-label-sm rounded-full px-2 py-0.5 min-w-[22px] text-center">3</span>

                    </div>

                    </div>
```

Não pode faltar "data-open-chat" a frente do selector div, senão não será identificado e formatado como mensagem.

Além disso, tem de colocar o sistema a direcionar cada mensagem da inbox à sua sala de trabalho, neste momento todas direcionam à uma só.



# Módulo: Sala de Trabalho do Cliente (Contrato Ativo)

## 1. Visão Geral e Regras de Negócio (Triggers)

A Sala de Trabalho não é um simples chat; é o ambiente onde o contrato é executado.

- **Criação (Trigger de Entrada):** Esta sala é gerada automaticamente no momento em que o cliente **aceita a proposta de um freelancer** para um trabalho publicado. Sendo a plataforma focada num único profissional por projeto, este aceite formaliza o contrato.
- **Gestão de Estados:**
    - Assim que a proposta é aceite, o anúncio original do trabalho transita para o estado **"Arquivado"/"Em andamento"), garantindo que desaparece da página pública de trabalhos ativos dos restantes freelancers.
    - A Sala de Trabalho, por sua vez, assume o estado de **"Contrato Ativo"**.
    - _Regra de Exibição:_ A sala só é listada no _Inbox_ (mensagens) de ambos os utilizadores enquanto existir um vínculo (contrato ativo, em revisão ou aguardando aprovação).

---

## 2. Estrutura da Interface do Chat (A Sala)

A interface principal de comunicação segue um layout limpo e focado na troca de informações e ficheiros.

### 2.1. Cabeçalho (Header)

- **Identificação:** Exibe o avatar do freelancer e o título do projeto em destaque (ex: _"Sala de trabalho — Logo Skilla"_).
- **Metadados:** Logo abaixo do título, em texto menor, exibe o número identificador do contrato (ex: _CONTRATO #1024_) e o estado atual (ex: _Status: Ativo_).
- **Ações:** Um botão **"Ver detalhes"** no canto superior direito para aceder aos termos completos do contrato, valores e escopo original.

### 2.2. Histórico de Conversa (Feed de Mensagens)

- **Mensagens de Sistema:** Pílulas visuais centralizadas a cinzento que documentam eventos neutros (ex: _"O contrato foi iniciado..."_, _"Ficheiro anexado..."_).
- **Mensagens do Cliente:** Alinhadas à esquerda, com o respetivo avatar e hora de envio abaixo do balão.
- **Mensagens do Freelancer:** Alinhadas à direita, com o respetivo avatar e hora de envio.

### 2.3. Área de Composição (Footer)

Fixa no fundo do ecrã, contém:

- Botão com ícone de clipe (**Anexar**) para envio de ficheiros.
- Campo de texto com o placeholder _"Escreve uma mensagem..."_.
- Botão de **Enviar** (ícone de avião de papel).

---

## 3. Ação Condicional: O Botão "Aprovar Entrega"

Existe uma regra de interface vital nesta tela:

- **Estado Oculto:** Durante o decorrer normal do projeto, não existe botão de aprovação.
- **Estado Visível (Trigger):** Quando o freelancer conclui o projeto e clica no seu próprio botão de **"Entregar Trabalho"** (do lado dele), a sala de trabalho do cliente é atualizada. Passa a flutuar no centro inferior do ecrã um botão de destaque amarelo (com ícone de _check_): **"Aprovar entrega"**.
- Este botão é a ponte para o modal de finalização do contrato.

---

## 4. Modal de "Aprovação da Entrega"

Ao clicar no botão flutuante, abre-se um modal detalhado (overlay) que obriga o cliente a tomar uma decisão formal sobre o trabalho recebido.

### 4.1. Informação da Entrega

- **Cabeçalho:** Título "Aprovação da Entrega" acompanhado do _timestamp_ exato de quando o freelancer submeteu o trabalho (ex: _Entregue em 01/10/2025 às 14:32_).
- **Nota do Freelancer:** Uma caixa de texto exibindo a mensagem final do profissional (ex: _"Finalizei todas as telas... Fico à disposição para ajustes."_).

### 4.2. Secção "Ficheiros Entregues"

Lista todos os ficheiros definitivos anexados na entrega oficial. Cada ficheiro é um cartão (card) que contém:

- Ícone representativo do formato (PDF, Imagem, etc.).
- Nome do ficheiro e tamanho (ex: _Projeto_Final.pdf | 2.4 MB_).
- Um botão **"Visualizar"** (escuro/preto) para o cliente analisar o ficheiro antes de tomar a sua decisão.

### 4.3. Avaliação e Liberação de Fundos

- **Aviso de Negócio:** Um texto crítico informa o cliente: _"A aprovação irá liberar o valor retido ao Freelancer."_ (Confirma o funcionamento por _Escrow_ / pagamento retido).
- **Sistema de Rating (Estrelas):** 5 estrelas para classificar a qualidade do serviço.
- **Comentário (Feedback):** Uma caixa de texto para deixar um comentário opcional (o fundo verde na imagem sugere o estado _focus/active_ ao digitar).

### 4.4. Botões de Decisão (Call to Actions)

O cliente tem 3 caminhos possíveis no final do modal:

1. **Aprovar trabalho** (Botão primário, amarelo): Confirma que o trabalho está correto, encerra o contrato, liberta os fundos para o freelancer e publica a avaliação.
2. **Solicitar revisões** (Botão secundário, contorno): Rejeita a entrega atual, mantém os fundos retidos, altera o estado do projeto para "Em revisão" e permite que o freelancer submeta novos ficheiros.
3. **Abrir disputa** (Botão destrutivo, vermelho, ícone de alerta): Aciona a mediação da plataforma caso haja um desacordo irreconciliável sobre o que foi entregue vs. o que foi contratado.

Na barra inferior mais escura, existe a opção de **"Cancelar"** (apenas fecha o modal sem tomar nenhuma ação, mantendo o status pendente).

Para fazer esta troca de mensagens em tempo real, quero usar Laravel Reverb.