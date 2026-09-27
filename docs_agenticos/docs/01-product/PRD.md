# Product Requirements Document (PRD) — Skilla

**Status:** Draft
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Visão do Produto

**Skilla** é a primeira plataforma freelance nativa de Angola, conectando clientes e freelancers de serviços digitais (design, desenvolvimento, marketing, etc.) em um ambiente seguro, organizado e com pagamentos em Kwanza (Kz) via escrow.

**Missão:** Profissionalizar o mercado freelance angolano eliminando barreiras de confiança, organização e pagamentos.

**Visão de longo prazo:** Tornar-se a infraestrutura de trabalho digital de referência em Angola e expandir para países PALOP.

---

## Problema

O mercado freelance em Angola sofre com três gargalos críticos:

1. **Falta de confiança:** Sem verificação de identidade, sem avaliações, sem garantia de entrega/pagamento.
2. **Falta de organização:** Comunicação dispersa (WhatsApp/Instagram), fluxo informal, sem contratos padronizados.
3. **Pagamentos inseguros:** Transferências diretas sem proteção, sem Multicaixa integrado, sem escrow.

---

## Objetivos do Produto

| Objetivo | Métrica de Sucesso (KPI) | Prazo |
|----------|--------------------------|-------|
| Lançar MVP funcional | 100 freelancers ativos, 50 clientes ativos, 200 jobs publicados | Mês 3 |
| Validar modelo de confiança | ≥ 70% taxa de conclusão de jobs aceitos; ≤ 5% disputas | Mês 6 |
| Alcançar product-market fit | 500 usuários ativos/mês; receita ≥ 500.000 Kz/mês | Mês 12 |
| Integrar Multicaixa Express | ≥ 50% transações via Multicaixa | Mês 9–12 |

---

## Público-Alvo

### Primário
- **Freelancers angolanos** (designers gráficos, desenvolvedores web, redatores, marketers) — júnior a pleno, 20–35 anos, renda alvo 100k–1M Kz/mês.
- **Pequenas empresas e empreendedores angolanos** — precisam de serviços digitais pontuais, orçamento 50k–500k Kz/projeto.

### Secundário
- Agências que terceirizam overflow
- Estudantes de tech/design em transição para mercado
- ONGs / setor público com demandas digitais

---

## Proposta de Valor

| Para Freelancers | Para Clientes |
|------------------|---------------|
| Acesso a clientes verificados | Freelancers verificados (BI, portfólio, avaliações) |
| Pagamento garantido via escrow | Controle de orçamento, propostas comparáveis |
| Reputação portável (avaliações, portfólio) | Fluxo organizado: briefing → proposta → contrato → entrega |
| Créditos grátis no início (20) | Sem custo para publicar jobs |
| Boost de perfil para mais visibilidade | Pagamento em Kz (futuro: Multicaixa) |

---

## Principais Jornadas

### Jornada do Cliente
1. **Cadastro** → escolhe "Cliente" → preenche dados + província
2. **Publica Job** → wizard 5 passos (título, escopo, orçamento, skills, anexos) → rascunho → publica
3. **Recebe Propostas** → vê freelancers, portfólios, avaliações, valores
4. **Aceita Proposta** → sistema debita carteira → cria contrato + escrow (retido) + abre chat
5. **Acompanha Execução** → chat, arquivos, marcos
6. **Aprova Entrega** → libera escrow (90% freelancer, 10% plataforma) → avalia freelancer

### Jornada do Freelancer
1. **Cadastro** → escolhe "Freelancer" → preenche skills, portfólio, bio
2. **Explora Jobs** → filtros (categoria, orçamento, prazo, nível)
3. **Envia Proposta** → gasta 1 crédito → carta + valor + prazo
4. **Aceitação** → notificado → chat aberto → executa trabalho
6. **Entrega Trabalho** → marca "entregue" no contrato
7. **Recebe Pagamento** → cliente aprova → 90% vai para carteira → pode sacar
8. **Avalia Cliente** → reputação bilateral

---

## Métricas de Sucesso (KPIs)

### Aquisição
- **CAC (Custo de Aquisição por Cliente):** < 5.000 Kz
- **Cadastros/mês:** > 200 (pós-MVP)
- **Taxa conversão visita → cadastro:** > 8%

### Ativação
- **Freelancers que enviam ≥ 1 proposta nos 7 dias:** > 40%
- **Clientes que publicam ≥ 1 job nos 7 dias:** > 30%
- **Jobs com ≥ 3 propostas:** > 60%

### Retenção
- **Retenção 30 dias (freelancers ativos):** > 35%
- **Retenção 30 dias (clientes ativos):** > 25%
- **Jobs concluídos / Jobs aceitos:** > 70%

### Receita
- **MRR (Monthly Recurring Revenue):** > 500.000 Kz (mês 12)
- **Take rate efetivo:** ~10% (comissão) + créditos + boost
- **LTV / CAC:** > 3

### Qualidade
- **Taxa de disputa:** < 5%
- **Tempo médio resolução disputa:** < 7 dias
- **NPS (Net Promoter Score):** > 40

---

## Escopo (Alto Nível)

### Dentro do Escopo (MVP → v1.0)
- Autenticação JWT + perfis (cliente/freelancer)
- Wizard de publicação de jobs (rascunho → publicado)
- Busca e filtros de jobs
- Sistema de propostas com créditos
- Aceitação de proposta → contrato + escrow simulado
- Chat em tempo real (WebSocket) com arquivos
- Entrega + aprovação + liberação escrow
- Avaliações bilaterais
- Carteira digital (saldo, extrato, recarga simulada)
- Créditos (compra, gasto, boost)
- Notificações in-app
- Expiração automática de jobs (cron 30 dias)
- Disputas (abertura, congelamento, decisão admin)
- Admin panel básico (usuários, jobs, contratos, disputas)

### Fora do Escopo (Pós-v1.0)
- Integração Multicaixa Express real
- KYC automatizado (BI + selfie + liveness)
- App mobile nativo (PWA no MVP)
- Matching inteligente (ML)
- Assinaturas Premium / Enterprise
- API pública / Webhooks
- Skilla Academy (cursos)
- Expansão PALOP
- Videochamada no chat
- Contratos por marcos (milestones)
- Seguro de projeto opcional

---

## Critérios de Aceite do Produto (Produto)

1. Cliente consegue publicar job em < 5 min (wizard completo)
2. Freelancer consegue enviar proposta em < 2 min
3. Aceitação → contrato + escrow + chat em < 3 seg
4. Chat entrega mensagens em < 500ms (latência local)
5. Aprovação → liberação carteira em < 2 seg (transação DB)
6. Extrato de carteira e créditos sempre consistente (transações ACID)
7. Jobs expiram automaticamente aos 30 dias (status: cancelado)
8. Disputa congela 100% do valor no escrow até decisão
9. Sistema suporta 100 usuários simultâneos sem degradação
10. Deploy em VPS Ubuntu + MySQL + Nginx + Supervisor + Reverb

---

## Related docs
- [MVP-scope.md](MVP-scope.md)
- [functional-requirements.md](functional-requirements.md)
- [non-functional-requirements.md](non-functional-requirements.md)
- [business-rules.md](business-rules.md)
- [user-flow.md](user-flow.md)
- [use-cases.md](use-cases.md)
- [../02-architeture/TRD.md](../02-architeture/TRD.md)
- [../02-architeture/dev-plan.md](../02-architeture/dev-plan.md)