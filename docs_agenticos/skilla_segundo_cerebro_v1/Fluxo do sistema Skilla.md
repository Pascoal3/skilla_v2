Fluxo do sistema Skilla:

→

Ínicio → Botão começar grátis → Página de decisão de role → Escolha de role (cliente ou freelancer) → Escolheu cliente ?

# Sim: fluxo de cliente

```
Fluxo de cliente

→ Formulário de criação de conta → Verificar campos obrigatórios preenchidos, email válido, senha atende critérios ? confirmação de senha bate ? 

→ Sim → Submissão de formulário (antes de enviar rodar validação final no frontend, se inválido não envia para o backend, destaca erros, mantém na mesma tela) → Se válido → Enviar requisições ao backend (enviar requisições API (POST /registar), desabilitar botão, mostrar estado de loading) → Animação de loading {(sem mudar tela (enquanto a requisição está a ser feita), apenas mostrar loading no overaly leve, a requisição verifica se o email já existe, dados válidos, segurança ok)} → 

Resultado do backend {

Sucesso → Criar usuário e mostrar mensagem de sucesso {
OBS: Erros a evitar (mostrar loading antes de validar frontend, trocar de tela rápido demais (Piscar UI), não explicar o que está acontecendo, perder os dados do usuário ao dar erro)

→ Pós-sucesso{
Animação de overlay que mostra que a conta foi criada com sucesso e indica que o usuário será direcionado em breve, "Conta criada com sucesso, vamos começar em breve."
} 

→ Gerar sessão (no backend, Token JWT){
1. Usuário envia login (POST /login)
2. Backend valida dados
3. Servidor gera token (ex: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...), Esse token contém:

{
"user_id": 5,
"email": "user@email.com",
"exp": 1710000000
}
4. Servidor envia tóken. Ex: {
"token": "eyJhbGciOiJIUzI1NiIs..."
}

5. Cliente armazena (httpOnly Cookie)
   
6. Próximas requisições (Authorization: Bearer eyJhbGciOiJIUzI1NiIs...)
   
7. Backend valida token (verifica assinatura, verifica expiração, extrai user_id);

fim_gerar_sessao
} 

→ Tela onboarding leve (2-3 perguntas)

→ Tela de decisão: postar job agora ?

Agora (sim){

→ Loading (spinner), "A carregar" → Processo de criação de job{

→ Tela 1 (pedir título do job) → Tela 2 (seleção de habilidades requeridas) → Tela 3 (Definição de escopo e detlhes do projeto) → Tela 4 (Definição de orçamento do projeto) → Tela 5 (adicionar descrição - Criação de post de job) → Tela 6 (Revisão das info preenchidas, pode postar ou guardar como rascunho) → Decisão →

Postar{
	→ Loading spinner "Parabéns, o teu trabalho está a ser publicado" → 
	
	Tela de onboarding 1/3{
		Escolha do método de pagamento (multicaixa express, conta bancária ou Banco Skilla, esta tela possui dois botões: pular e continuar, o botão continuar fica desabilitado enquanto não for escolhido nenhum método de pagamento), se ele pular vai para a próxima tela de oboarding, mas com o dado vazio, por decidir depois ou se preencher também direciona para a próxima tela, mas com os dados (escolha, ou seja, o método de pagamento) já guardados.
	}
	Tela de onboarding 2/3{
		Tela de recomendação de freelancers de acordo com as habilidades necessárias do trabalho, nesta página aparecerão os freelancers cujas as habilidades fazem "match" com as habilidades necessárias para o trabalho.
	}
	Tela de onboarding 3/3{
		Nesta tela, mostramos os últimos passos que faltam para o usuário completar, por exemplo, se ele pulou a escolha do método de pagamento, pode configurar agora, ou se falta verificar o email ou o número de telefone, contém um botão de postar trabalho, "Postar trabalho".
	}
	
fim_postar
}

Não postar{
	Voltar para a dashboard de usuário;
}

fim_processo_criacao_job
}

fim_agora
}

→ Depois {
Levar para a dashboard com CTA, por exemplo: "Postar jobs agora".

fim_depois
}

fim_resultado_backend
}

	Erro → Mostrar mensagem de erro, exemplo: "Email já existe", "Dados inválidos", como usamos overlay, remove loading, mostra o erro na tela original, ex: "Este email já está em uso. Tente outro."
}



→  Não → Validação em tempo real (mostrar mensagem de erro inline imediata no frontend) → Desativar botão de submit
```

# Não: fluxo de freelancer
```

```