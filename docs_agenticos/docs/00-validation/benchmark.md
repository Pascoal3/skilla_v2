# Benchmark — Plataformas Freelance de Referência

**Status:** Draft
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Critérios de Comparação

| Critério | Peso | Descrição |
|----------|------|-----------|
| Modelo de pagamento | Alto | Escrow, comissão, moeda local |
| Verificação de identidade | Alto | KYC, portfólio, avaliações |
| UX / Fluxo de contratação | Alto | Da busca ao pagamento |
| Monetização | Médio | Comissão, membership, créditos |
| Comunicação | Médio | Chat, arquivos, videochamada |
| Disputas / Mediação | Alto | Processo, SLA, decisão |
| Mobile / Responsividade | Médio | PWA, app nativo |
| Ecossistema local | Alto | Moeda, idioma, leis, pagamentos |

---

## Matriz Comparativa

| Feature | **Skilla (Target)** | **Upwork** | **Workana** | **99Freelas** | **Fiverr** | **Toptal** |
|---------|---------------------|------------|-------------|---------------|------------|------------|
| **Moeda local (Kz)** | ✅ Sim | ❌ USD | ❌ USD/BRL | ❌ BRL | ❌ USD | ❌ USD |
| **Pagamento local (Multicaixa)** | ✅ Planeado | ❌ | ❌ | ❌ | ❌ | ❌ |
| **Escrow** | ✅ Simulado (MVP) → Real | ✅ | ✅ | ✅ | ✅ (parcial) | ✅ |
| **Comissão** | 10% só no sucesso | 10–20% | 10–20% | 10–15% | 20% | Variável |
| **Créditos para propostas** | ✅ Sim | ✅ (Connects) | ✅ | ❌ | ❌ | N/A (curated) |
| **Boost de perfil** | ✅ Sim | ✅ | ✅ | ✅ | ❌ | N/A |
| **Verificação identidade** | ✅ BI/NIF/Telefone | ✅ (rigorosa) | ✅ | Básica | Básica | ✅ (rigorosa) |
| **Sistema de avaliações** | ✅ Bilateral | ✅ | ✅ | ✅ | ✅ | ✅ |
| **Chat em tempo real** | ✅ WebSocket (Reverb) | ✅ | ✅ | ✅ | ✅ | ✅ |
| **Upload de arquivos no chat** | ✅ Sim | ✅ | ✅ | ✅ | ✅ | ✅ |
| **Disputas / Mediação** | ✅ Admin decision | ✅ | ✅ | ✅ | Limitado | ✅ |
| **Expiração automática de jobs** | ✅ Cron (30 dias) | ✅ | ✅ | ✅ | N/A (gigs) | N/A |
| **Portfólio público** | ✅ Sim | ✅ | ✅ | ✅ | ✅ (gigs) | ✅ |
| **Busca por skills/categoria** | ✅ Sim | ✅ | ✅ | ✅ | ✅ | Curated |
| **Notificações push/email** | ✅ In-app (MVP) | ✅ | ✅ | ✅ | ✅ | ✅ |
| **Multi-idioma (pt-AO)** | ✅ Nativo | ❌ | pt-BR | pt-BR | ❌ | ❌ |
| **KYC simplificado** | ✅ Sim | Complexo | Médio | Baixo | Baixo | Alto |

---

## Lições Aprendidas

### Upwork
- **Connects (créditos)** funcionam para reduzir spam de propostas
- **Job Success Score** cria reputação mensurável
- **Escrow obrigatório** para contratos por hora e fixed-price > $500

### Workana
- **Membership tiers** (grátis, plus, premium) dão limites de propostas
- **Certificações de skills** validadas por testes
- **Foco LatAm** permite pagamentos locais em alguns países

### 99Freelas
- **Modelo simples**: comissão só no sucesso
- **Menos burocracia** para entrar
- **Gap**: sem escrow robusto, pagamentos diretos

### Fiverr
- **Modelo "gig" (produto pronto)** vs. "job" (projeto custom)
- **Upsell** via pacotes (básico, standard, premium)
- **Avaliação obrigatória** pós-entrega

### Toptal
- **Curated network**: só top 3% entram
- **Matching humano** + técnico
- **Preço premium** justificado por qualidade

---

## Decisões para o Skilla (Baseadas no Benchmark)

| Decisão | Referência | Justificativa |
|---------|------------|---------------|
| Créditos para propostas (1 crédito = 1 proposta) | Upwork Connects | Reduz spam, monetiza cedo |
| Boost de perfil pago em créditos | Workana / 99Freelas | Receita recorrente, visibilidade |
| Comissão 10% só no sucesso | 99Freelas / Upwork | Alinhamento, barreira baixa |
| Escrow simulado no MVP → real pós-MVP | Upwork / Workana | Confiança, diferenciação |
| Expiração automática de jobs (30 dias) | Upwork / Workana | Limpeza de base, urgência |
| Chat WebSocket (Laravel Reverb) | Todos | Tempo real é esperado |
| Disputa congela escrow + admin decide | Upwork | Proteção ambas partes |
| KYC leve (BI + telefone + selfie) | Upwork (simplificado) | Viável no MVP, escalável |

---

## Gaps do Benchmark que o Skilla Pode Explorar

1. **Pagamento nativo Multicaixa Express** — nenhuma plataforma tem
2. **Verificação via BI angolano** — identidade local forte
3. **UX em português angolano** — terminologia, moeda, cultura
4. **Comissão fixa 10% transparente** — sem tiers confusos
5. **Créditos grátis no onboarding (20)** — remove fricção inicial

---

## Related docs
- [market-research.md](market-research.md)
- [opportunities.md](opportunities.md)
- [../01-product/PRD.md](../01-product/PRD.md)
- [../01-product/business-rules.md](../01-product/business-rules.md)