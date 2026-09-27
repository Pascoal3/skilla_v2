# Guia de Documentação do Second Brain / LLM Wiki — Skilla

**Status:** Draft
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Objetivo

Criar uma wiki técnica persistente para o projeto Skilla, organizando conhecimento em uma estrutura navegável e versionada.

---

## Regras de escrita

- Use português técnico (pt-BR) em todo o conteúdo.
- Para termos em inglês, inclua a tradução na primeira ocorrência (ex.: RAG (geração aumentada por recuperação)).
- Mantenha tom neutro e técnico; evite vocativos ou linguagem de chat.
- Quando for atualizar um documento, adicione `Last updated: YYYY-MM-DD` e ajuste o campo **Status** conforme a evolução.

---

## Estrutura obrigatória de cada documento

Todo arquivo Markdown deve conter no topo (logo após o título):

```markdown
**Status:** Draft | In Review | Approved
**Owner:** TODO(USER)
**Last updated:** YYYY-MM-DD
```

E ao final, seção **Related docs** com links absolutos dentro de `docs/`:

```markdown
## Related docs
- [Documento relacionado](../caminho/para/doc.md)
```

---

## Política de links entre documentos

- Sempre que um documento referenciar outro, use links absolutos dentro da estrutura `docs/`.
- Prefira links para documentos na mesma estrutura `docs/` (não use `../wiki/` ou `../raw/` pois esta wiki unifica ambos).
- Exemplos:
  - `[PRD](../01-product/PRD.md)`
  - `[Database Schema](../03-data/database-schema.md)`

---

## Criação de ADRs (Architecture Decision Records)

- Crie ADRs somente quando precisar registrar uma decisão arquitetural que tenha consequências significativas.
- Use a pasta `docs/02-architeture/ADRs/` para armazenar os arquivos.
- Cada ADR deve conter as secções: **Status**, **Context**, **Decision**, **Consequences**, **Alternatives Considered**.
- O nome do arquivo segue o padrão `####-short-description.md` (ex.: `0001-laravel-mvc-framework.md`).
- Numeração sequencial começando em 0001.

---

## Política de atualizações

- Cada documento deve conter a linha `Last updated: YYYY-MM-DD` próximo ao cabeçalho.
- O campo **Status** pode assumir os valores: `Draft | In Review | Approved`.
- Mudanças que alterem a arquitetura ou requisitos devem passar por revisão e alterar o status para `Approved`.

---

## Política de proprietários

- Cada documento possui um campo **Owner: TODO(USER)** que deve ser preenchido pelo responsável pela área correspondente.

---

## Convenções de nomenclatura do projeto

| Termo | Definição |
|-------|-----------|
| **job** / **trabalho** | Unidade de trabalho publicada por um cliente (tabela `trabalhos`) |
| **wallet** / **carteira** | Carteira digital do usuário ou da plataforma (tabela `carteiras`) |
| **escrow** | Conta de retenção de valores durante a execução do contrato (tabela `transacoes_escrow`) |
| **disputa** | Conflito aberto sobre um contrato (tabela `disputas`) |
| **proposta** | Oferta de freelancer para um job (tabela `propostas`) |
| **contrato** | Acordo formalizado após aceitação de proposta (tabela `contratos`) |
| **créditos** | Saldo interno usado para envio de propostas (campo `saldo_creditos` em `perfis`) |
| **perfil** | Usuário da plataforma (cliente, freelancer ou admin) — tabela `perfis` |

---

## Related docs
- [README.md](README.md) — Índice da wiki