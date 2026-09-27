# Índice do Second Brain / LLM Wiki — Skilla

Este documento serve como ponto de entrada para navegar pela estrutura de documentação do projeto Skilla.

**Status:** Draft
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Estrutura da Wiki

### 00-validation — Validação de Mercado
- [market-research.md](00-validation/market-research.md) — Pesquisa de mercado e análise de concorrência
- [benchmark.md](00-validation/benchmark.md) — Benchmark de plataformas freelance
- [opportunities.md](00-validation/opportunities.md) — Oportunidades identificadas

### 01-product — Produto
- [PRD.md](01-product/PRD.md) — Product Requirements Document
- [MVP-scope.md](01-product/MVP-scope.md) — Escopo do MVP
- [functional-requirements.md](01-product/functional-requirements.md) — Requisitos funcionais (RFs)
- [non-functional-requirements.md](01-product/non-functional-requirements.md) — Requisitos não-funcionais (RNFs)
- [business-rules.md](01-product/business-rules.md) — Regras de negócio do domínio
- [business-logic-security.md](01-product/business-logic-security.md) — Riscos de fraude e controles de segurança
- [user-flow.md](01-product/user-flow.md) — Fluxos de usuário (cliente e freelancer)
- [use-cases.md](01-product/use-cases.md) — Casos de uso detalhados

### 02-architeture — Arquitetura
- [TRD.md](02-architeture/TRD.md) — Technical Requirements Document
- [architeture-document.md](02-architeture/architeture-document.md) — Documento de arquitetura
- [tech-stack.md](02-architeture/tech-stack.md) — Stack tecnológica
- [dev-plan.md](02-architeture/dev-plan.md) — Plano de desenvolvimento por marcos
- [coding-standards.md](02-architeture/coding-standards.md) — Padrões de código
- [security-guidelines.md](02-architeture/security-guidelines.md) — Diretrizes de segurança
- [ADRs/](02-architeture/ADRs/) — Architecture Decision Records
  - [0001-laravel-mvc-framework.md](02-architeture/ADRs/0001-laravel-mvc-framework.md)
  - [0002-realtime-websockets-reverb.md](02-architeture/ADRs/0002-realtime-websockets-reverb.md)
  - [0003-escrow-audit-trail.md](02-architeture/ADRs/0003-escrow-audit-trail.md)

### 03-data — Dados
- [database-schema.md](03-data/database-schema.md) — Esquema do banco de dados
- [database-dbml.md](03-data/database-dbml.md) — DBML do banco de dados
- [data-mapping.md](03-data/data-mapping.md) — Mapeamento de dados entre módulos
- [data-dictionary.md](03-data/data-dictionary.md) — Dicionário de dados

### 04-api — API
- [api-specification.md](04-api/api-specification.md) — Especificação de endpoints

### 05-design — Design
- [ui-plan.md](05-design/ui-plan.md) — Diretrizes UI/UX
- [screen-mapping.md](05-design/screen-mapping.md) — Mapa de telas por perfil
- [screen-specification.md](05-design/screen-specification.md) — Especificação detalhada de telas
- [component-library.md](05-design/component-library.md) — Biblioteca de componentes

### 06-environment — Ambiente
- [environment-specification.md](06-environment/environment-specification.md) — Especificação de ambientes

### 07-maintenance — Manutenção
- [changelog.md](07-maintenance/changelog.md) — Changelog do projeto

---

## Como usar

- Documentos em **docs/** representam as decisões definitivas do projeto.
- Cada documento possui campos **Status** (Draft | In Review | Approved), **Owner** e **Last updated**.
- Links internos usam caminhos absolutos dentro de `docs/`.
- ADRs registram decisões arquiteturais com consequências significativas.

---

## Related docs
- [documentation_guide.md](documentation_guide.md) — Guia de documentação e padrões