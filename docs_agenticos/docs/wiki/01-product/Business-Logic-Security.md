# Business-Logic-Security

## Status
Draft

## Last updated
2026-08-14

## Owner
TODO(USER)

## Links
- [[Functional-Requirements]]
- [[MVP-Scope]]
- [[Roadmap]]

## Lista de Regras (1..23)
1. Validação de propriedade do recurso antes de acesso.
2. Garantia de idempotência em operações críticas.
3. Controle de acesso baseado em papéis (RBAC).
4. Auditoria de todas as alterações de estado.
5. Criptografia de dados sensíveis em repouso e em trânsito.
6. Limitação de taxa (rate limiting) para endpoints de wrote.
7. Sanitização de entrada para evitar injection attacks.
8. Uso de prepared statements para queries dinâmicas.
9. Validação de tipos de dados em todas as APIs.
10. Política de senhas segura (complexidade, expiração).
11. Bloqueio de conta após número definido de tentativas falhas.
12. Registros de logs imutáveis e armazenados off‑site.
13. Análise estática de código em CI/CD.
14. Varredura de dependências em busca de vulnerabilidades.
15. Segregação de duties (separação de responsabilidades).
16. Controle de privilégios mínimos para contas de serviço.
17. Utilização de tokens de curta duração.
18. Revogação imediata de credenciais comprometidas.
19. Configuração de CORS restrita a domínios permitidos.
20. Headers de segurança (X‑Content‑Type‑Options, X‑Frame‑Options, CSP).
21. Anti‑CSRF tokens em todas as requisições state‑changing.
22. Monitoramento de anomalias em tempo real.
23. Pen‑testing anual ou após mudanças significativas.

## Adaptações do projeto
TODO(USER)

## Ameaças específicas do domínio
TODO(USER)