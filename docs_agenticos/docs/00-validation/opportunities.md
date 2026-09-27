# Oportunidades — Skilla

**Status:** Draft
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Oportunidades Priorizadas (Matriz Impacto × Esforço)

| # | Oportunidade | Impacto | Esforço | Prioridade | Fase |
|---|--------------|---------|---------|------------|------|
| 1 | Integração Multicaixa Express (recarga/saque) | Crítico | Alto | P0 | Pós-MVP |
| 2 | KYC com BI angolano (validação automática via API gov) | Alto | Alto | P1 | v1.0 |
| 3 | App mobile (PWA → nativo) | Alto | Médio | P1 | v1.0 |
| 4 | Matching inteligente (skills + histórico + localização) | Alto | Alto | P2 | v1.5 |
| 5 | Programa de indicação (referral credits) | Médio | Baixo | P1 | MVP+ |
| 6 | Marketplace de "gigs" (serviços padronizados) | Médio | Médio | P2 | v1.5 |
| 7 | Skilla Academy (cursos, certificações) | Médio | Alto | P3 | v2.0 |
| 8 | API pública para integrações (ERP, CRM) | Baixo | Alto | P3 | v2.0 |
| 9 | White-label para agências | Baixo | Alto | P3 | v2.0 |
| 10 | Expansão para outros países PALOP | Alto | Muito Alto | P3 | v3.0 |

---

## Detalhamento das Top 5

### 1. Integração Multicaixa Express (P0)
**Descrição:** Permitir recarga de carteira e saque via Multicaixa Express (USSD / App / Referência Multicaixa).
**Por que é crítico:** Principal meio de pagamento digital em Angola; sem isso, a plataforma depende de transferência bancária manual (fricção alta).
**Requisitos técnicos:**
- Parceria com EMIS / banco emissor
- API de geração de referências Multicaixa
- Webhook de confirmação de pagamento
- Conciliação automática
**Riscos:** Burocracia bancária, homologação, taxas de transação.
**Assumptions:** Parceria viável em 3–6 meses; taxas ~1–2% por transação.

### 2. KYC com BI Angolano (P1)
**Descrição:** Validação de identidade via número de BI + selfie + verificação facial (liveness).
**Por que é importante:** Cria confiança real, reduz fraude, habilita limites maiores de saque.
**Abordagem MVP:** Upload manual + revisão admin (baixo esforço).
**Abordagem v1.0:** Integração com Registo Civil / SGM (Serviço de Migração) ou provedor biométrico local.
**Requisitos legais:** LGPD Angola (Lei 22/11), consentimento explícito, retenção mínima.

### 3. App Mobile / PWA (P1)
**Descrição:** Experiência mobile-first (80%+ do tráfego esperado vem de mobile).
**Estratégia:**
- MVP: PWA com service worker, notificações push (Web Push API), instalação "Add to Home Screen"
- v1.0: React Native / Flutter wrapper (WebView + native bridges para push, biometria, câmera)
**Features mobile-críticas:** Chat (push), upload foto documento (KYC), notificações de proposta/contrato.

### 4. Matching Inteligente (P2)
**Descrição:** Algoritmo que sugere freelancers para jobs e jobs para freelancers.
**Inputs:** Skills, categoria, localização, avaliação, taxa de resposta, histórico de conclusão, disponibilidade.
**MVP:** Regras heurísticas (score ponderado simples).
**v1.5:** ML colaborativo (content-based + collaborative filtering).
**Dados necessários:** Logs de interação (views, aplicações, aceitações, conclusões).

### 5. Programa de Indicação (P1 — MVP+)
**Descrição:** Usuário convida amigo → ambos ganham créditos quando o indicado completa primeira ação (job ou proposta).
**Mecânica:**
- Cliente indica cliente: +10 créditos cada quando indicado publica 1º job
- Freelancer indica freelancer: +10 créditos cada quando indicado envia 1ª proposta
- Cross-indicação: +5 créditos cada
**Controle:** Anti-fraude (dispositivo, IP, KYC), limite mensal.

---

## Oportunidades de Receita (Além da Comissão 10%)

| Fonte | Modelo | Estimativa (Ano 1) | Status |
|-------|--------|-------------------|--------|
| Comissão 10% sobre projetos | Transacional | Core | Implementado |
| Venda de pacotes de créditos | Pré-pago | Alta | Implementado (simulado) |
| Boost de perfil (destaque) | Recorrente / pontual | Média | Implementado |
| Assinatura Premium (freelancer) | Mensal (limites maiores, analytics) | Média | Planejado v1.0 |
| Assinatura Enterprise (clientes) | Mensal (jobs ilimitados, branding) | Baixa | Planejado v1.5 |
| Taxa de saque (acima de X gratis/mês) | Transacional | Baixa | Planejado v1.0 |
| Publicidade / Destaque de jobs | CPM / CPC | Baixa | P2 |
| Skilla Academy (cursos) | Venda única / assinatura | Média | P3 |

---

## Parcerias Estratégicas

| Parceiro | Valor | Status |
|----------|-------|--------|
| Banco (BFA, BAI, Standard) | Multicaixa, contas digitais, KYC | Prospecção |
| Instituto de Telecomunicações (ITEL) | Infraestrutura, validação SMS | Prospecção |
| Universidades / Institutos (ISUTIC, IMETRO) | Talent pipeline, certificação | Conversas iniciais |
| Incubadoras (Fábrica de Ideias, Seedstars) | Early adopters, mentoria | Networking |
| Associações de freelancers / devs | Comunidade, feedback, evangelização | Em andamento |

---

## Riscos e Mitigações

| Risco | Probabilidade | Impacto | Mitigação |
|-------|---------------|---------|-----------|
| Atraso parceria Multicaixa | Alta | Crítico | MVP com recarga manual (admin aprova comprovante); PIX-like local via transferência |
| Baixa adesão inicial (chicken-egg) | Média | Alto | Onboarding ativo: captar 50 freelancers + 20 clientes beta; casos de sucesso documentados |
| Fraude (contas falsas, chargeback simulado) | Média | Alto | Rate limit, KYC progressivo, moderação admin, logs de auditoria |
| Concorrente global entra no mercado | Baixa | Médio | Foco hyperlocal (Kz, BI, Multicaixa, pt-AO), community-first |
| Regulamentação fintech muda | Baixa | Alto | Acompanhar BNA, estrutura modular para adaptação |

---

## Related docs
- [market-research.md](market-research.md)
- [benchmark.md](benchmark.md)
- [../01-product/PRD.md](../01-product/PRD.md)
- [../01-product/MVP-scope.md](../01-product/MVP-scope.md)
- [../02-architeture/dev-plan.md](../02-architeture/dev-plan.md)