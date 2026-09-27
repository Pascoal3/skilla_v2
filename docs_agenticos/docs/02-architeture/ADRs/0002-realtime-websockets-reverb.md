# ADR 0002: Estratégia de Tempo Real — Laravel Reverb (WebSockets)

**Status:** Accepted
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Context

O Skilla requer comunicação **tempo real** para:
- Chat 1:1 entre cliente e freelancer (mensagens, arquivos)
- Notificações instantâneas (nova proposta, mensagem, entrega, aprovação, disputa)
- Indicadores de presença (online/offline, digitando)
- Atualizações de UI sem polling (contadores, badges, status)

Requisitos:
- Latência < 200ms (mesma região)
- Escala para 10k conexões simultâneas (futuro)
- Autenticação integrada com JWT existente
- Canais privados por conversa (autorização granular)
- Custo operacional baixo (MVP self-hosted)
- Protocolo padrão (compatível com clientes JS/Pusher)

Alternativas consideradas:
1. **Pusher (SaaS)** — Gerenciado, escalável, mas custo alto (~$49/mês 100k msgs → inviável long-term)
2. **Soketi (Open Source, Node.js)** — Compatível Pusher, mas menos maduro, single-threaded Node, sem suporte oficial Laravel
3. **Centrifugo (Go)** — Performático, mas protocolo próprio, complexo integração Laravel Echo
4. **Laravel Echo Server (Node, deprecated)** — Não mantido
5. **Laravel Reverb (PHP, Oficial)** — **Escolhido**
6. **Polling (HTTP Long/Short)** — Simples, mas latência alta, carga servidor, não "tempo real" verdadeiro

---

## Decision

Adotar **Laravel Reverb v1.x** como servidor WebSocket nativo, utilizando:

- **Protocolo**: Pusher Protocol v7 (compatível com `laravel-echo`, `pusher-js`)
- **Autenticação**: Canais privados `private-conversation.{id}` com `Broadcast::channel()` validando Policy
- **Escala Horizontal**: Redis Pub/Sub entre múltiplos processos Reverb (`REVERB_HOST=0.0.0.0`, `REVERB_PORT=8080`)
- **SSL/TLS**: WSS via Nginx proxy (termination) → Reverb HTTP interno
- **Eventos Broadcast**: `MessageSent`, `MessageRead`, `TypingIndicator`, `NotificationCreated`
- **Presence Channels** (futuro): `presence-conversation.{id}` para lista online/digitando
- **Rate Limit**: Middleware custom 30 msg/min/user + burst protection

### Arquitetura
```
Client (Blade + Alpine + Echo) 
    ↓ WSS (TLS)
Nginx (SSL Termination + Rate Limit)
    ↓ HTTP (internal)
Reverb Process 1  ←→  Redis Pub/Sub  ←→  Reverb Process N
    ↓                     ↑
Laravel App (Broadcast) 
```

### Configuração Crítica
```env
# .env
BROADCAST_DRIVER=reverb
REVERB_APP_ID=skilla
REVERB_APP_KEY=local-key
REVERB_APP_SECRET=local-secret
REVERB_HOST=0.0.0.0
REVERB_PORT=8080
REVERB_SCHEME=http          # interno; Nginx faz HTTPS
REVERB_DEBUG=false
```

```php
// routes/channels.php
Broadcast::channel('conversation.{conversaId}', function (Perfil $user, string $conversaId) {
    return $user->can('access', Conversation::find($conversaId));
});
```

---

## Consequences

### Positivas
- **Zero Custo Licença**: Open source (MIT), self-hosted
- **Integração Nativa**: `Broadcast` facade, `ShouldBroadcast`, `InteractsWithSockets` — zero glue code
- **Escala Horizontal**: Redis Pub/Sub permite múltiplos Reverb behind load balancer
- **Mesmo Runtime PHP**: Compartilha pool PHP-FPM (opcional), mesmo código, mesma linguagem
- **Protocol Standard**: Pusher v7 → clientes JS (`pusher-js`, `laravel-echo`) prontos
- **Auth Integrada**: Policies Laravel funcionam direto nos canais

### Negativas
- **Maturidade**: v1.x (lançado 2024); menos battle-tested que Pusher/Soketi
- **Single-threaded por processo**: Requer múltiplos workers para CPU-bound (mitigado: I/O bound, Redis pub/sub)
- **Memory Leaks Potenciais**: Long-running PHP process (mitigado: `max_requests` no Supervisor, monitoramento)
- **SSL Termination Externo**: Reverb não termina TLS nativamente (requer Nginx/Traefik)

### Riscos e Mitigações
| Risco | Probabilidade | Impacto | Mitigação |
|-------|---------------|---------|-----------|
| Instabilidade Reverb em prod | Média | Alto | Testes carga k6 (10k conn); health check `/up`; Supervisor `autorestart=true`; fallback polling HTTP se down |
| Memory leak long-running | Baixa | Médio | `max_requests=1000` Supervisor; monitor `memory_mb` via Prometheus; restart diário agendado |
| Redis Pub/Sub bottleneck | Baixa | Alto | Redis Cluster (v1.0); sharding canais por `conversaId % shards` |
| DoS via WebSocket | Média | Alto | Rate limit Nginx (`limit_req_zone`); middleware Reverb 30msg/min; conexão max 60s idle timeout |

---

## Alternatives Considered

| Alternativa | Custo | Complexidade | Escalabilidade | Integração Laravel | Decisão |
|-------------|-------|--------------|----------------|-------------------|---------|
| **Pusher SaaS** | Alto ($$$) | Baixa | Alta | Nativa | Rejeitado (custo) |
| **Soketi** | Zero (self-host) | Média | Média (Node single-thread) | Boa (Pusher protocol) | Rejeitado (menos maduro, Node extra) |
| **Centrifugo** | Zero (self-host) | Alta | Muito Alta | Média (proto próprio) | Rejeitado (complexidade) |
| **Polling HTTP** | Zero | Baixa | Baixa (carga DB) | Nativa | Rejeitado (UX ruim, não real-time) |
| **Mercure (PHP)** | Zero | Média | Média | Boa (Hub Symfony) | Rejeitado (ecossistema menor) |

---

## Related docs
- [tech-stack.md](tech-stack.md)
- [architeture-document.md](architeture-document.md) (sequência chat)
- [TRD.md](TRD.md) (WebSocket specs)
- [security-guidelines.md](security-guidelines.md) (WS security)
- [../01-product/functional-requirements.md](../01-product/functional-requirements.md) (RF04)
- [../04-api/api-specification.md](../04-api/api-specification.md) (chat endpoints)