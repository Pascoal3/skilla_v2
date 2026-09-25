
![[Pasted image 20260817010928.png]]

Botão "Ver tudo" deve levar à página de categorias

Páginas de:
- [ ] Termos de serviço (cliente)
- [ ] Política de privacidade (cliente)
- [ ] Termos de serviço (freela)
- [ ] Políticas de privacidade (freela)

Página de ver perfil do freela:

![[Pasted image 20260822135302.png]]

- [ ] Página 404 personalizada
- [ ] Modal de reportar erro
- [ ] Esqueceu a senha 
- [ ] Login não tem prevenção contra SQL injection
- [x] Login não mostra erro com email inválido, tem de validar 
- [ ] ![[Pasted image 20260822140756.png]]


- Eu só garantiria que a página de assinatura já venha **com o plano pré-selecionado** (Pro/Elite) para não obrigar o usuário a escolher de novo.
- 1. **Plano Business “Sob consulta”**
    
    - “Falar com Consultor” está bom.
    - Ideal: levar para um formulário curto (nome, email/WhatsApp, tamanho da equipa) **ou WhatsApp**, mas deixando claro o canal.

Pode valer ter um toggle “Freelancer/Empresa” antes dos cards para não misturar expectativas.


![[Pasted image 20260817012130.png]]
No módulo mensagens e salas de trabalho precisa melhorar o design.

![[Pasted image 20260817012157.png]]

![[Pasted image 20260817012217.png]]

![[Pasted image 20260817012226.png]]

Começar por tirar esse fundo branco, o fundo continuará verde, com os balões de conversa do jeito que estão, o botão de aprovar entrega e enviar trabalho continuam os mesmos, a barra inferior de escrever mensagens continua a mesma também.

No login, quando o usuário loga não pode ser possível voltar ao login.

![[Pasted image 20260817012623.png]]

Essa seta de voltar tem de estar bloqueada.

O wizard de publicar trabalhos não está a funcionar.

![[Pasted image 20260817012732.png]]

![[Pasted image 20260817012747.png]]

Estes botões precisam estar a funcionar.

Os botões de filtro também (rascunhos, abertos, em andamento, concluídos, cancelados) quando apertados aparecem apenas aqueles respondestes.

Depois de aceitar ou rejeitar uma proposta, se recarregar a página não pode voltar a aparecer os botões de aceitar e rejeitar.

![[Pasted image 20260817013135.png]]

Os botões de aceitar/rejeitar não estão a funcionar sem recarregar a página, deve ser o defer, depois tem de ver.

Ainda tratar do logout e etc.


Painel freela

No módulo Trabalhos, os filtros não estão a funcionar, sem contar que os dados não estão dinâmicos.

![[Pasted image 20260817121932.png]]

Estes filtros também precisam funcionar.

![[Pasted image 20260817122008.png]]![[Pasted image 20260817122021.png]]

Além destes também.


![[Pasted image 20260817122112.png]]

Este número precisa estar dinâmico, além de meter o "ordenar por" a funcionar.

![[Pasted image 20260817122212.png]]

O botão "Ver job" precisa levar à página de detalhe do trabalho dedicada, nesse momento só está a levar a mesma página com info estática.

![[Pasted image 20260817122302.png]]

No módulo Propostas: ![[Pasted image 20260817122703.png]]

O estado precisa ser dinâmico, logo que ele vai à página de trabalho, vê o trabalho, vai à página de detalhes, aperta em "Enviar proposta", depois ele preenche o form, que pede 

Form de enviar proposta: 
![[Pasted image 20260817122855.png]]

A área da carta de apresentação não está a contar as palavras, sendo que tem um máximo de 2000 palavras, deve contar, e quase a chegar ao limite, deixar as palavras vermelhas e deixar um alerta, do tipo "Número de palavas excedidos" ou assim.

Depois de preencher tudo correto, ele aparece o success state, nesse momento está a aparecer um alert: ![[Pasted image 20260817123217.png]]

Mas é preciso melhorar isso, além disso, já está a redirecionar à página de propostas automaticamente depois de enviar proposta, para ele acompanhar já o estado da proposta, primeiro pendente, depois aceite ou rejeitada.

![[Pasted image 20260817123334.png]]

A paginação também não está a funcionar.

Módulo mensagens do freela: 

![[Pasted image 20260817123505.png]]

Botão "ver detalhes" deve funcionar, vai mostrar um pop-up (modal) com os detalhes da sala de trabalho, deve aparecer: 

- Participantes – lista de membros com papéis (cliente, freelancer, admin), avatares e indicadores de presença. 
- Contexto do trabalho – briefing/resumo, categoria, prazo, prioridade.
- Entregas e marcos – lista de marcos, estado (concluído, em progresso, pendente), próximos passos.
- Pagamentos – plano de pagamento, valores, taxas, estado (pendente, pago, sobrevivido).
- Ficheiros/links – documentos fixados, anexos relevantes, links externos (Drive, GitHub, etc.).
- Regras/segurança – políticas de confidencialidade, bloqueio da sala, nível de acesso por perfil.
- Ações rápidas – botões para “Ver projeto”, “Abrir contrato”, “Abrir disputa”, “Sair da sala”, etc.

2) Critérios de UX
- Must‑have:
  - Botão “Ver detalhes” visível apenas para usuários com permissão de visualização (cliente, freelancer, admin).
  - Modal abre com foco no primeiro campo (cabeçalho) e permite fechar com “Esc” ou overlay.
  - Estado de carregamento simples (spinner ou overlay semi‑transparente).
  - Mensagem de erro amigável caso a sala esteja arquivada ou o usuário não tenha acesso.

- Nice‑to‑have:
  - Animação de entrada/saída suave.
  - Resumo visual de status (ex.: cor de badge).
  - Ícone de “pin” para salas em destaque.
  - Tooltip com descrição resumida ao passar o mouse no botão.

3) Regras de negócio
- O botão aparece se:
  - O contrato da sala estiver ativo e o usuário possuir alguma das roles “cliente”, “freelancer” ou “admin”.
  - O status da sala for “Ativo” ou “Em revisão”.

- Visibilidade de dados por perfil:
  - Cliente vê todas as informações de pagamentos e marcos, mas só pode ver anexos aprovados.
  - Freelancer vê notas de entrega, área de upload e anexos ligados ao seu trabalho, mas não vê detalhes de faturamento.
  - Admin tem acesso total a todas as seções.

- Campos derivados:
  - “Status calculado” = “Ativo” se pelo menos um marco estiver em progresso ou houver pagamentos pendentes.
  - “Próximos passos” gerado a partir dos marcos com prazo ≤ 7 dias.

4) Referências encontradas no segundo cérebro
- Título: SISTEMA SKILLA - PLANEJAMENTO COMPLETO DE UX
  - Caminho: SISTEMA SKILLA - PLANEJAMENTO COMPLETO DE UX.md
  - Trecho: “Modal de entrega deve conter áreas de notas, anexos e link, com botões de cancelar e confirmar.”
  - Data/Versão: 2026‑08‑12 v1.3

- Título: 06_06\Sala de trabalho telas cliente.md
  - Caminho: 06_06\Sala de trabalho telas cliente.md
  - Trecho: “Botão ‘Ver detalhes’ aciona modal que exibe cabeçalho, participantes e histórico de entregas.”
  - Data/Versão: 2026‑07‑28 v2.0

- Título: [[skilla]]\06_06\Sala de trabalho código unido com modal entregar trabalho.md (arquivo analisado)
  - Caminho: [[skilla]]\06_06\Sala de trabalho código unido com modal entregar trabalho.md
  - Trecho: “Modal‘Entregar trabalho’ inclui textarea de notas, área de upload de ficheiros, campo de link efooter com ‘Cancelar’/‘Confirmar entrega’.”
  - Data/Versão: 2026‑08‑01 v1.7

5) Lacunas e perguntas
- Que informações exatamente devem constar no cabeçalho (ID, número do contrato, data de início)?
- Quais campos de pagamento são obbligatórios e quais são opcionais?
- Como deve ser tratada a visualização de ficheiros anexados para cada perfil (cliente vs freelancer)?
- Existe necessidade de integração com um sistema de gestão de marcos externo (ex.: Trello, Asana)?
- Quais são os limites de tamanho dos anexos e dos links que podem ser exibidos no modal?


Botão "Entregar trabalho", abre o modal de entregar trabalho:

![[Pasted image 20260817124936.png]]
![[Pasted image 20260817125037.png]]

O success e error state continuam como alerts.

![[Pasted image 20260817125200.png]]

Já tem o success state ao enviar ficheiros, aparece o título, formato e tamanho.

Mas agora, o máximo são 25MB, o que significa que o error state tem de aparecer informando quando passa disso.

Depois de enviar trabalho, aparece o success state, depois dele fechar o modal de sucesso, a barra de mandar mensagens fica oculta e aparece uma mensagem a informar que as info foram enviadas, aguardar a resposta do cliente, para o cliente, o botão "Aprovar entrega" só aparece depois do freela apertar no botão "Entregar trabalho", onde ele vai preencher as notas da entrega (opcional), os anexos ou link (google drive, github, etc)

Quando mandar, o botão "Aprovar entrega" aparece ao cliente, informando que já foi um trabalho entregue, mostrando: 

![[Pasted image 20260817130302.png]]

Data e hora da entrega, ficheiro(s) entregue(s), títulos dos mesmos, formatos e tamanhos, com o botão "visualizar" que quando apertado, precisa mostrar o mesmo, seja por modal ou quê, depois definir.

![[Pasted image 20260817130450.png]]

Tem a opção de avaliar freelancer, comentário opcional, a nota de informação que informa que a aprovação irá liberar o valor retido ao freelancer.

E os botões de aprovar trabalho, que vai encerrar a sala de trabalho, porque o trabalho estará concluído, solicitar revisões, por exemplo, quando o cliente pede alteração no chat, o freela terminou as alterações, e sente-se preparado para entregar, entrega, o cliente vê, e nota que o freela não fez todas as correções, ainda tem mais, então o cliente clica em "Solicitar revisões", para reabrir o chat de conversa, quando isso acontecer, o freela recebe uma notificação dizendo que o sala de trabalho com ID tal, foi reaberta, porque o cliente solicitou revisões, o mesmo aviso vai para o chat, como este: 

![[Pasted image 20260817130959.png]]

Quando clicar em enviar ficheiro: 

![[Pasted image 20260817131137.png]]

Tem de aparecer uma pré-visualização de envio de ficheiro como no Whatsapp:

![[Pasted image 20260817131240.png]]

Mostrando o título do ficheiro, tamanho (MB), formato, não precisa de pré-visualização do ficheiro, porque essa tecnologia do Adobe Acrobat não terá.

Ao clicar no "x", fecha a janela e volta ao chat, ao clicar em mais, dá para adicionar mais ficheiros, ao enviar aparece o aviso no chat: 

![[Pasted image 20260817131343.png]]

Ao clicar no "x" aparece o modal de confirmação: 

![[Pasted image 20260817131601.png]]

Se cancelar, volta à janela de envio de ficheiro, senão, se clicar em "descartar" volta ao chat e fecha a janela de envio de ficheiros.

O nome mais correto (e padrão de UX) para essa “janela” é:

**Modal de envio de ficheiros**  
(opcionalmente: **Modal de anexos**)


Módulo carteira

Carteira → Carregar saldo

Valor de recarga: 

O valor predefinido são 2.000kzs
![[Pasted image 20260817133124.png]]

Apenas quando for menor a 2.000kzs, deve aparecer este erro:
![[Pasted image 20260817133044.png]]

O valor da recarga e total a pagar do resumo da recarga deve ser o mesmo escolhido no input valor (kz), deve estar dinâmico, está a digitar, está a aparecer.

![[Pasted image 20260817133247.png]]

No modal de sucesso: ![[Pasted image 20260817133425.png]]

O seu saldo de x, esse valor tem de estar dinâmico, tem de ser o valor da recarga.

Quando ele carrega, precisa ter um registo no extrato, como este: 

![[Pasted image 20260817133606.png]]

tipo de operação (recarga de saldo), método de recarga (depósito/recarga via x), hora, data, valor e estado.

ícone de seta para cima se for recarga, seta para baixo se for débito/saque, relógio se for pendente.

![[Pasted image 20260817133848.png]]

Os valores seguindo a mesma lógica, + para recargas, pagamentos, pagamentos retidos no escrow e - para débitos, transferências, assinaturas, como por exemplo, os planos da [[skilla]] e etc.

O botão de exportar precisa exportar o extrato em PDF.

![[Pasted image 20260817134029.png]]

Os filtros precisam funcionar, precisa ter um modal para filtros, como nos trabalhos.

O IBAN [[skilla]] precisa ser dado dinamicamente:

![[Pasted image 20260817134508.png]]


Carteira → Pedir saque

![[Pasted image 20260817134938.png]]

Aparecer o saldo disponível dinamicamente.

No valor a sacar, quando clicar em tudo, o input é preenchido automaticamente com o saldo disponível.

Quando for menor a 5.000kzs aparece mensagem de erro.

Este é para indicar o IBAN que será enviado o dinheiro.

![[Pasted image 20260817135116.png]]

Devia aparecer o método de pagamento, mas depois será definido.

![[Pasted image 20260817135256.png]]

O valor a sacar tem de ser igual ao valor a sacar e o total a receber, está a escrever, está a aparecer.

O botão de copiar IBAN tem de funcionar, copiando para o clipboard.

Ao clicar em confimar saque:

![[Pasted image 20260817135424.png]]

Aparecer o modal de sucesso ou erro, o modal de sucesso será igual ao modal de carregar créditos: 

![[Pasted image 20260817135502.png]]

"Saque concluído", "Seu saldo de x está a ser processado para ser enviado" ou assim, botão de ver extrato e voltar para a carteira.

# Admnistrador da Skilla

Cada usuário que cria conta recebe 10 créditos, a cada usuário que criar aparece o total de créditos na plataforma: separar os gratuitos e os carregados (pagos)

Ver relatórios (erros reportados, disputas, reembolsos, queixa de freela, queixa de cliente e etc), também pode filtrar por data, tipo e etc, e exportar.

Ter acesso aos logs do sistema: Sempre que um trabalho for postado, resolvido, proposta enviada, tudo, sempre ter as info completas no log (ID, ação, status e etc.

Receber notificações.

Na tabela perfis tem o saldo_creditos, deverá somar todos os saldos de créditos.

![[Pasted image 20260921211501.png]]

Ter um success state personalizado para depois de copiar o IBAN.

![[Pasted image 20260921212201.png]]

Esse botão de criar perfil na seção de CTA precisa levar a uma página de validação (precisa escolher o plano primeiro).



![[Pasted image 20260921212402.png]]

![[Pasted image 20260921212422.png]]

Depois de apertar em terminar sessão ele leva para o login, mas se clicar na seta de voltar ele volta para o painel.


Não dá para postar trabalho, adicionar wizard de adicionar trabalho.

![[Pasted image 20260922230124.png]]

