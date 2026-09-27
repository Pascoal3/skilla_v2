# 1. Arquitetura técnica detalhada

Diagrama de arquitetura (descrição detalhada)

Estrutura de pastas do Laravel

Padrão de organização de controllers, models, services

Estratégia de API (rotas, versionamento)



# 2. Modelo de dados completo

Diagrama ER (descrição detalhada)

Migrations principais

Seeders de dados iniciais



# 3. Especificação de rotas e endpoints

Listas de rotas principais (web e API)

Middlewares essenciais

Grupos de rotas por funcionalidade (módulo)

Documentação de endpoints da API



# 4. Regras de negócio detalhadas

4.1 Sistema de crédito

4.1.2 Quantos créditos por proposta ?

2.1.3 Como adquirir créditos ?

2.1.4 Créditos iniciais ao registrar ?



4.2 Sistema de Escrow

4.2.1 Fluxo completo de estados 

4.2.2 Tempo de retenção

4.2.3 Políticas de cancelamento e reembolso (versão futura)



4.3 Comissão de 10% (versão futura)

4.3.1 Como é calculada ?

4.3.2 Quando é debitada ?

4.3.3 Onde fica registada ?


4.4 Boost de perfil

4.4.1 Duração do boost ?

4.4.2 Preço ?

4.4.3 Como afeta a visibilidade ?



# 5. Gestão de ficheiros e uploads

5.1 Tipos de ficheires aceitos (já mencionado: PDF, imagens), zip, links;

5.2 Tamanhos máximos ?

5.3 Estrutura de armazenamento (storage/public) ?

5.4 Validação de MIME types



# 6. Sistema de notificações

6.1 Tipos de notificações ?

6.2 Canais (in-app ? email ? SMS ?)



# 7. Segurança e autenticação

7.1 Estratégia JWT (refresh tokens ? Duração ?)

7.2 Proteção CSRF em formulários Blade

7.3 Validação e sanetização de inputs

7.4 Hash de senhas

7.5 Proteção de rotas



# 8. Gestão de estados e workflows

8.1 Estados de um Job (draft → open → in_progress → completed → cancelled)

8.2Estados de uma Proposta (sent → accepted → rejected → withdrawn)

8.3 Estados de Pagamento (pending → held → released → failed)

8.4 Transições permitidas entre estados



# 9. Mapa de telas

9.1 Lista completa de todas as telas

9.2 Hierarquia de navegação

9.3 Fluxos de utilizador (user flows)

