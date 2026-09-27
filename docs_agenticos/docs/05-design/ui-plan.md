# Plano de UI/UX — Skilla

**Status:** Draft
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Princípios de Design

| Princípio | Descrição |
|-----------|-----------|
| **Confiança Primeiro** | Visual limpo, profissional, transmite segurança (escrow, verificação) |
| **Mobile-First** | 80%+ tráfego mobile; breakpoints: <640, 640–1024, >1024 |
| **Acessibilidade (WCAG AA)** | Contraste 4.5:1, foco visível, labels, alt text, navegação teclado |
| **Feedback Imediato** | Toast (sucesso/erro), loading states, empty states ilustrados |
| **Consistência** | Design system (cores, tipografia, espaçamento, componentes) |
| **Clareza Financeira** | Valores em Kz sempre visíveis, comissão transparente, saldos em tempo real |

---

## Identidade Visual

### Paleta de Cores (Tailwind CSS v4)

```css
/* Cores Primárias */
--color-primary-50: #eff6ff;
--color-primary-100: #dbeafe;
--color-primary-500: #2563eb;  /* Azul Principal - Confiança, CTAs primários */
--color-primary-600: #1d4ed8;
--color-primary-700: #1e40af;  /* Azul Escuro - Headers, navegação */
--color-primary-900: #1e3a8a;

/* Cores de Acento */
--color-accent-500: #f97316;   /* Laranja - Energia, CTAs secundários, badges */
--color-highlight-500: #7c3aed; /* Roxo - Premium, boost perfil */

/* Cores Semânticas */
--color-success-500: #10b981;  /* Verde - Sucesso, aprovado, liberado */
--color-warning-500: #f59e0b;  /* Amarelo - Aviso, pendente, expira em breve */
--color-error-500: #ef4444;    /* Vermelho - Erro, rejeitado, disputa */

/* Neutras */
--color-gray-50: #f9fafb;      /* Background secundário */
--color-gray-100: #f3f4f6;     /* Borders sutis */
--color-gray-200: #e5e7eb;     /* Borders, divisores */
--color-gray-300: #d1d5db;     /* Input borders */
--color-gray-500: #6b7280;     /* Texto secundário, placeholders */
--color-gray-700: #374151;     /* Texto corpo */
--color-gray-900: #111827;     /* Texto principal, headers */
--color-white: #ffffff;        /* Cards, backgrounds */
```

### Tipografia (Inter + Space Grotesk)

| Uso | Fonte | Tamanho | Peso | Line Height |
|-----|-------|---------|------|-------------|
| H1 (Hero) | Space Grotesk | 2.5rem (40px) | 700 | 1.2 |
| H2 (Section) | Space Grotesk | 2rem (32px) | 600 | 1.3 |
| H3 (Card Title) | Inter | 1.5rem (24px) | 600 | 1.4 |
| H4 (Subtitle) | Inter | 1.25rem (20px) | 500 | 1.4 |
| Body Large | Inter | 1.125rem (18px) | 400 | 1.6 |
| Body | Inter | 1rem (16px) | 400 | 1.6 |
| Body Small | Inter | 0.875rem (14px) | 400 | 1.5 |
| Caption | Inter | 0.75rem (12px) | 400 | 1.5 |
| Button | Inter | 1rem (16px) | 500 | 1.0 |

### Espaçamento (Sistema 4px)

| Token | Valor | Uso |
|-------|-------|-----|
| `space-1` | 4px | Gap ícones, padding mínimo |
| `space-2` | 8px | Gap interno componentes |
| `space-3` | 12px | Padding small |
| `space-4` | 16px | **Base unit** — padding médio, gap grid |
| `space-5` | 20px | Padding large |
| `space-6` | 24px | Gap seções, padding card |
| `space-8` | 32px | Gap grandes seções |
| `space-10` | 40px | Hero padding |
| `space-12` | 48px | Section spacing |
| `space-16` | 64px | Layout spacing |

### Border Radius

| Token | Valor | Uso |
|-------|-------|-----|
| `rounded-sm` | 4px | Badges, tags |
| `rounded-md` | 8px | **Default** — Inputs, buttons, cards |
| `rounded-lg` | 12px | Cards destacados, modais |
| `rounded-xl` | 16px | Containers grandes |
| `rounded-full` | 9999px | Avatares, pills, badges circulares |

### Sombras (Elevation)

| Nível | Sombra | Uso |
|-------|--------|-----|
| `shadow-sm` | `0 1px 2px rgba(0,0,0,0.05)` | Cards hover, inputs focus |
| `shadow-md` | `0 4px 6px rgba(0,0,0,0.07)` | Cards default, dropdowns |
| `shadow-lg` | `0 10px 15px rgba(0,0,0,0.1)` | Modais, sidebars |
| `shadow-xl` | `0 20px 25px rgba(0,0,0,0.15)` | Overlays, drawers |

---

## Componentes Base (Design System)

### Botões

```tsx
// Variants
<Button variant="primary">    // bg-primary-500 text-white hover:bg-primary-600
<Button variant="secondary">  // bg-white border-primary-500 text-primary-500 hover:bg-primary-50
<Button variant="outline">    // border-gray-300 text-gray-700 hover:bg-gray-50
<Button variant="ghost">      // text-gray-600 hover:bg-gray-100
<Button variant="destructive"> // bg-error-500 text-white hover:bg-error-600
<Button variant="success">    // bg-success-500 text-white

// Sizes
<Button size="sm">   // px-3 py-1.5 text-sm
<Button size="md">   // px-4 py-2 text-base  (DEFAULT)
<Button size="lg">   // px-6 py-3 text-lg
<Button size="icon"> // p-2 (square)

// States
<Button disabled>    // opacity-50 cursor-not-allowed
<Button loading>     // spinner + texto "A processar..."
```

### Inputs & Formulários

```tsx
<Input 
  label="Email"
  placeholder="seu@email.com"
  error="Email inválido"
  helperText="Usamos para login e notificações"
/>

// Estados
// Default: border-gray-300
// Focus: border-primary-500 ring-2 ring-primary-500/20
// Error: border-error-500 + texto erro error-500
// Disabled: bg-gray-50 cursor-not-allowed
```

### Cards

```tsx
<Card className="border border-gray-200 hover:shadow-md transition-shadow">
  <CardHeader>
    <CardTitle>Título</CardTitle>
    <CardDescription>Subtítulo opcional</CardDescription>
  </CardHeader>
  <CardContent>Conteúdo</CardContent>
  <CardFooter>Ações</CardFooter>
</Card>

// Variants
<Card variant="elevated">    // shadow-md, sem border
<Card variant="outlined">    // border-gray-200 (DEFAULT)
<Card variant="filled">      // bg-gray-50
<Card variant="interactive"> // hover:shadow-lg cursor-pointer
```

### Badges / Tags / Status

```tsx
<Badge variant="default">     // bg-gray-100 text-gray-700
<Badge variant="primary">     // bg-primary-100 text-primary-700
<Badge variant="success">     // bg-success-100 text-success-700
<Badge variant="warning">     // bg-warning-100 text-warning-700
<Badge variant="error">       // bg-error-100 text-error-700
<Badge variant="accent">      // bg-accent-100 text-accent-700 (boost)
<Badge variant="highlight">   // bg-highlight-100 text-highlight-700 (premium)

// Status específicos do domínio
<StatusBadge status="rascunho" />      // gray
<StatusBadge status="aberto" />        // primary
<StatusBadge status="em_andamento" />  // accent
<StatusBadge status="concluido" />     // success
<StatusBadge status="cancelado" />     // error
<StatusBadge status="em_disputa" />    // warning
<StatusBadge status="retido" />        // warning
<StatusBadge status="liberado" />      // success
<StatusBadge status="devolvido_cliente" /> // error
```

### Avatares

```tsx
<Avatar src="/path/to/image.jpg" fallback="JS" size="md" />
// Sizes: xs(24), sm(32), md(40), lg(48), xl(64), 2xl(80)
// Fallback: iniciais do nome
// Status ring: online (green), offline (gray), busy (orange)
```

### Tabelas (Data Dense)

```tsx
<Table>
  <TableHeader>
    <TableRow>
      <TableHead>Coluna</TableHead>
      <TableHead className="text-right">Valor</TableHead>
      <TableHead>Ações</TableHead>
    </TableRow>
  </TableHeader>
  <TableBody>
    <TableRow className="hover:bg-gray-50">
      <TableCell>Dado</TableCell>
      <TableCell className="text-right font-mono">15.000,00 Kz</TableCell>
      <TableCell><Button variant="ghost" size="sm">Ver</Button></TableCell>
    </TableRow>
  </TableBody>
</Table>
```

### Empty States

```tsx
<EmptyState
  icon={InboxIcon}
  title="Nenhuma proposta ainda"
  description="Suas propostas enviadas aparecerão aqui."
  action={<Button>Explorar Jobs</Button>}
/>
```

### Loading States

```tsx
<Skeleton className="h-4 w-3/4" />        // Texto
<Skeleton className="h-12 w-full" />      // Card
<Skeleton className="h-8 w-20 rounded" /> // Botão
<Spinner size="md" />                     // Overlay loading
```

### Toast Notifications

```tsx
// Posicionamento: top-right
// Auto-close: 5s (sucesso/info), 8s (erro/aviso)
// Types:
<Toast type="success" title="Sucesso!" description="Proposta enviada." />
<Toast type="error" title="Erro" description="Créditos insuficientes." />
<Toast type="warning" title="Atenção" description="Job expira em 2 dias." />
<Toast type="info" title="Info" description="Nova mensagem recebida." />
```

---

## Layout & Grid

### Container Principal
```tsx
<div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
  {/* Conteúdo */}
</div>
```

### Grid System (12 colunas)
```tsx
<div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
  {/* Cards responsivos */}
</div>
```

### Sidebar Layout (Dashboard)
```tsx
<div className="flex min-h-screen bg-gray-50">
  <aside className="w-64 bg-white border-r border-gray-200 hidden lg:block">
    {/* Navigation */}
  </aside>
  <main className="flex-1 p-6 lg:p-8">
    {/* Content */}
  </main>
</div>
```

### Header (Top Bar)
```tsx
<header className="h-16 bg-white border-b border-gray-200 sticky top-0 z-40">
  <div className="max-w-7xl mx-auto px-4 h-full flex items-center justify-between">
    <Logo />
    <Navigation />
    <UserMenu />
  </div>
</header>
```

---

## Páginas-Chave (Wireframes Descritivos)

### 1. Landing Page (`/`)
- **Hero**: H1 "Trabalho seguro, pagamento garantido" + CTA "Começar como Cliente" / "Começar como Freelancer"
- **Value Props**: 3 cards (Escrow, Verificação, Pagamento Kz)
- **Como Funciona**: 4 passos (Cliente publica → Freelancer propõe → Escrow → Entrega)
- **Depoimentos**: Carousel (futuro)
- **Footer**: Links, redes sociais, legal

### 2. Escolha de Função (`/escolher-funcao`)
- Dois cards grandes lado a lado (mobile: stack)
- **Cliente**: "Quero contratar" + ícone briefcase + benefícios
- **Freelancer**: "Quero trabalhar" + ícone laptop + benefícios
- Cada card = link para registro específico

### 3. Registro (`/registar/cliente` | `/registar/freelancer`)
- Formulário em card centralizado (max-w-md)
- Steps: Dados pessoais → Conta → Perfil (opcional)
- Validação inline + força senha
- Terms checkbox + LGPD link

### 4. Dashboard Cliente (`/painel/cliente`)
- **Header**: Saudação + saldo carteira + créditos (se freelancer)
- **Tabs**: Meus Jobs | Propostas Recebidas | Pagamentos | Configurações
- **Meus Jobs**: Table com status badges, ações (ver, editar, cancelar)
- **Propostas Recebidas**: Cards por job → lista propostas com aceitar/rejeitar
- **Empty States**: "Nenhum job publicado" + CTA "Criar Job"

### 5. Dashboard Freelancer (`/painel/freelancer`)
- **Header**: Saudação + avatar + avaliação + saldo créditos/Kz
- **Tabs**: Feed de Jobs | Minhas Propostas | Trabalhos | Carteira | Perfil
- **Feed Jobs**: Cards com título, orçamento, prazo, skills, cliente, botão "Propor"
- **Filtros**: Sidebar colapsável (mobile: bottom sheet)

### 6. Wizard Criar Job (5 Steps)
- **Progress Stepper** no topo (1–5)
- **Step 1**: Básico (titulo, categoria, tipo)
- **Step 2**: Orçamento (fixo vs hora, valores)
- **Step 3**: Detalhes (descrição, tamanho, duração, nível, prazo, anexos)
- **Step 4**: Skills (multi-select com busca)
- **Step 5**: Revisão (resumo completo) → Botão "Publicar" ou "Salvar Rascunho"
- Navegação: Anterior/Próximo + Salvar Rascunho sempre visível

### 7. Detalhe Job (`/jobs/{id}`)
- **Header**: Título, categoria, badges (urgente, remoto, destaque), cliente
- **Sidebar**: Orçamento, prazo, nível, cliente (avatar, avaliação, jobs concluídos)
- **Tabs**: Descrição | Anexos | Propostas (se cliente) | Jobs Similares
- **Ações**: Salvar/Remover favoritos, Compartilhar, Denunciar
- **Se Freelancer**: Botão fixo bottom "Enviar Proposta" (se elegível)

### 8. Sala de Trabalho / Chat (`/chat/{conversaId}`)
- **Header**: Nome do outro participante + avatar + status online + badge contrato
- **Lista Mensagens**: Auto-scroll bottom; agrupamento por data; bolhas diferenciadas (enviado/recebido)
- **Input Área**: Textarea auto-resize + botão anexo (PDF, img) + botão enviar (Enter para enviar, Shift+Enter nova linha)
- **Anexos**: Preview inline (imagem) / link download (PDF)
- **Ações Contrato**: Botões fixos top-right "Entregar Trabalho" / "Aprovar" (conforme role + estado)

### 9. Carteira (`/carteira`)
- **Saldo Principal**: Grande, destaque (Kz)
- **Tabs**: Extrato | Recargar | Sacar (futuro) | Créditos
- **Extrato**: Tabela (Data, Tipo, Descrição, Entrada/Saída, Saldo)
- **Recarga**: Formulário valor + método (MVP: comprovante upload) → status pendente
- **Créditos**: Saldo créditos + pacotes cards (comprar) + boost card

### 10. Perfil Público (`/perfil/{id}`)
- **Header**: Avatar XL, nome, username, badges (verificado, destaque), avaliação média + estrelas
- **Tabs**: Sobre | Portfólio | Avaliações
- **Sobre**: Bio, localização, skills tags, stats (jobs concluídos, taxa resposta)
- **Portfólio**: Grid 3 colunas (imagem + título + categoria)
- **Avaliações**: Lista com nota, comentário, data, autor

---

## Acessibilidade (WCAG 2.1 AA)

- **Contraste**: Todos os textos ≥ 4.5:1 (body), ≥ 3:1 (large text)
- **Foco Visível**: `focus-visible: ring-2 ring-primary-500 ring-offset-2`
- **Navegação Teclado**: Tab order lógico; skip link "Pular para conteúdo principal"
- **ARIA**: `aria-label` em botões ícone; `aria-live="polite"` em toasts; `role="alert"` em erros
- **Alt Text**: Todas imagens decorativas `alt=""`; informativas com descrição
- **Formulários**: `<label>` associado a `<input>`; `aria-describedby` para helper/error
- **Modais**: Trap focus; `Esc` fecha; backdrop click fecha; restore focus ao fechar

---

## Responsividade (Breakpoints Tailwind)

| Breakpoint | Classe | Largura | Uso |
|------------|--------|---------|-----|
| Mobile | (default) | < 640px | Stack vertical, bottom sheets, hamburger menu |
| Tablet | `md:` | 640–1023px | 2 colunas, sidebar colapsável |
| Desktop | `lg:` | 1024–1279px | 3 colunas, sidebar fixa, header completo |
| Large | `xl:` | 1280–1535px | Container max-w-7xl, spacing generoso |
| 2XL | `2xl:` | ≥ 1536px | Max width 1440px para conteúdo denso |

---

## Animações & Micro-interações

| Elemento | Animação | Duração | Easing |
|----------|----------|---------|--------|
| Button hover | `scale-[1.02]` | 150ms | ease-out |
| Button active | `scale-[0.98]` | 50ms | ease-in |
| Card hover | `shadow-md → shadow-lg` | 200ms | ease-out |
| Modal enter | `opacity-0 → opacity-100 + scale-95 → scale-100` | 200ms | ease-out |
| Toast enter | `translate-x-full → translate-x-0` | 300ms | ease-out |
| Skeleton pulse | `bg-gray-200 → bg-gray-300 → bg-gray-200` | 1.5s | infinite |
| Tab switch | `fade-in` | 150ms | ease-out |
| Accordion | `height-auto` + `opacity` | 200ms | ease-out |

---

## Dark Mode (Futuro v1.0)

- Strategy: `class` strategy (Tailwind `dark:` variant)
- Toggle: Header + localStorage + `prefers-color-scheme`
- Cores: Inverter neutras (gray-50 ↔ gray-900), manter semânticas
- Imagens: `dark:` variants para logos/ilustrações

---

## Related docs
- [screen-mapping.md](screen-mapping.md)
- [screen-specification.md](screen-specification.md)
- [component-library.md](component-library.md)
- [../01-product/user-flow.md](../01-product/user-flow.md)
- [../01-product/use-cases.md](../01-product/use-cases.md)
- [../04-api/api-specification.md](../04-api/api-specification.md)