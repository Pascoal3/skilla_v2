Clicando no botão de "Explorar trabalhos" ou "Trabalhos" leva para a página de feed de jobs.

Quando um cliente posta um trabalho, ele vai para a página de feed de jobs, com estado aberto.

Quando o freela abre esse trabalho, lê e fica interessado, manda uma proposta, descontado a quantidade de créditos para a mesma, verifica-se se tem suficiente, se sim, desconta-se, senão, aparece aviso que não é suficiente num modal com CTA para carregar.

Quando clica no botão "Carteira" leva para a página de carteira, onde vamos encontrar a escolha do método de pagamento, ao escolher banco skilla, ele leva a página do banco skilla, onde o sistema permite, de acordo à função:

cliente{
	carregar saldo (kzs), sempre que fizer uma operação, sendo validada como não, precisa criar um log, por exemplo, quando uso o multicaixa express, se eu eu fizer uma transferência, ele vem o estado, mesmo que não "foi", ele aparece como "pendente" ou "não-efetuada".
}

