# Regras e Restrições do Projeto

## 1. Padrões de Código
- **Naming:** 
  - Variáveis e funções: `camelCase` (ex: `getUserData`).
  - Componentes e Classes: `PascalCase` (ex: `UserProfile`).
  - Arquivos: Igual ao componente principal (ex: `UserProfile.tsx`).
  - Constantes: `UPPER_SNAKE_CASE` (ex: `MAX_RETRY_ATTEMPTS`).
- **Formatação:** 
  - Seguir rigorosamente o `.prettierrc` e `.eslintrc`.
  - Máximo de 100 caracteres por linha.
- **Comentários:** 
  - Comentar apenas o "porquê" de lógica complexa, não o "o quê".
  - Usar JSDoc/TSDoc em funções públicas e APIs.

## 2. Arquitetura e Design
- **Padrão:** Clean Architecture / MVC (adaptar ao seu projeto).
- **Princípios:** 
  - SOLID (foco em Single Responsibility).
  - DRY (Não se repita) - Extrair utilitários se usar 3 vezes.
  - KISS (Keep It Simple, Stupid) - Evitar overengineering.
- **Gerenciamento de Estado:** 
  - Usar apenas Context API para globais simples.
  - Usar TanStack Query para dados de servidor.
  - Não usar Redux salvo se estritamente necessário.

## 3. Segurança
- **Variáveis de Ambiente:** 
  - NUNCA hardcodar chaves de API ou senhas no código.
  - Usar `process.env` ou `import.meta.env`.
- **Autenticação:** 
  - Tokens JWT devem ser armazenados em HttpOnly Cookies.
  - Validar permissão em cada endpoint (Middleware de Auth).
- **Inputs:** 
  - Validar todos os inputs com Zod ou Yup antes de processar.
  - Sanitizar inputs para prevenir XSS e SQL Injection.

## 4. Banco de Dados
- **Migrations:** 
  - Toda alteração no schema deve ter migration correspondente.
  - Nomes de tabelas: `snake_case` plural (ex: `user_profiles`).
  - Nomes de colunas: `snake_case` (ex: `created_at`).
- **Relacionamentos:** 
  - Sempre usar chaves estrangeiras com `ON DELETE CASCADE` quando apropriado.
  - Indexar colunas usadas em `WHERE` e `JOIN`.

## 5. Testes
- **Framework:** Jest / Vitest + React Testing Library.
- **Cobertura:** 
  - Testar caminhos felizes e erros esperados.
  - Não testar implementação interna, testar comportamento.
- **Nomeclatura:** `describe`, `it('deve fazer tal coisa quando...')`.

## 6. Instruções Específicas para IA
- **Não usar:** 
  - `any` no TypeScript (usar tipos explícitos ou interfaces).
  - Bibliotecas depreciadas (ex: `moment.js` -> usar `date-fns` ou `dayjs`).
  - `console.log` em produção (usar logger configurado).
- **Prioridade:** 
  - Legibilidade > Performance prematura.
  - Tipagem estática forte.
- **Resposta:** 
  - Entregar código completo, não snippets parciais ("... resto do código").
  - Explicar brevemente as mudanças feitas antes do código.

## 7. Do's and Don'ts (Lista Rápida)

| ✅ Fazer (Do's) | ❌ Não Fazer (Don'ts) |
| :--- | :--- |
| Usar async/await para assíncrono | Usar `.then()` encadeado |
| Tratar erros com try/catch específicos | Usar `try { ... } catch (e) {}` vazio |
| Extrair componentes grandes (>100 linhas) | Criar componentes "God Component" |
| Usar tipos definidos em `types/` | Repetir interfaces em vários arquivos |
| Validar dados na borda (API/Componente) | Confiar que o dado vem correto |