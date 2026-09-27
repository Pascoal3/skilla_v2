
Página de formulário de cliente

- [ ] Fazer input sanetization nos campos (primeiro nome, sobrenome) não pode ser permitido digitar número, símbolos e outras coisas além de caracteres

- [ ] Fazer a verificação do email, não pode começar com número, só pode ser "@gmail", "@hotmail", "@yahoo" e outros provedores de email conhecidos
- [ ] Tratar SQL injection


Página de formulário de freela

- [ ] Fazer input sanetization nos campos (primeiro nome, sobrenome) não pode ser permitido digitar número, símbolos e outras coisas além de caracteres

- [ ] Fazer a verificação do email, não pode começar com número, só pode ser "@gmail", "@hotmail", "@yahoo" e outros provedores de email conhecidos
- [ ] Tratar SQL injection


- [ ] Tela de login (cliente e freelancer)

- [ ] Overlays

Logs

Usuário → ação → sistema → tabela logs
- [ ] Criação de conta
- [ ] Login
- [ ] Logout
- [ ] Alteração de perfil
- [ ] Recarga de créditos
- [ ] Recarga de saldo em kzs
- [ ] Transferência de saldo (trabalho pago)
- [ ] 


Middlewares
- [ ] Para acessar o painel (precisa estar logado), caso alguém tente colocar a rota /painel/cliente ou /painel/freelancer, verificar se está logado e se não redirecionar à página de login.
- [ ] 


O que alterar em ambos 

js/formulario.js

registar/cliente
registar/freela
Rotas
Model Auth.php
Overlays
