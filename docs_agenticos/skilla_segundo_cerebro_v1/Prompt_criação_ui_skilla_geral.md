```
# 🎨 PROMPT PARA DESIGN DE TELAS - PLATAFORMA SKILLA

---

## 📋 CONTEXTO DO PROJETO

Você é um designer UI/UX especializado em plataformas web. Sua tarefa é criar o design de uma tela para a **Skilla**, uma plataforma de freelancing focada no mercado angolano que conecta clientes e freelancers de serviços digitais (design gráfico e desenvolvimento web).

A plataforma oferece funcionalidades como:
- Sistema de autenticação e perfis diferenciados
- Publicação e gestão de trabalhos (jobs)
- Sistema de propostas
- Chat em tempo real
- Pagamento com escrow (simulado)
- Avaliações bilaterais
- Portfólio de projetos
- Notificações em tempo real

**Público-alvo**: Freelancers angolanos (designers e developers) e pequenas empresas/clientes que necessitam de serviços digitais.

---

## 🎨 GUIA DE ESTILO OBRIGATÓRIO

### **PALETA DE CORES**

**Cores Primárias:**
- Azul Principal: `#2563EB` (botões principais, links, destaques)
- Azul Escuro: `#1E40AF` (cabeçalhos, navegação, textos importantes)
- Branco: `#FFFFFF` (fundos, cards, áreas de conteúdo)

**Cores Secundárias:**
- Laranja: `#F97316` (CTAs secundários, notificações, badges)
- Roxo: `#7C3AED` (funcionalidades premium, boost)
- Verde: `#10B981` (sucesso, aprovações)
- Vermelho: `#EF4444` (erros, alertas)
- Amarelo: `#F59E0B` (avisos, pendências)

**Cores Neutras:**
- Cinza Escuro: `#1F2937` (textos principais)
- Cinza Médio: `#6B7280` (textos secundários)
- Cinza Claro: `#E5E7EB` (bordas, separadores)
- Cinza Muito Claro: `#F9FAFB` (fundos secundários)

---

### **TIPOGRAFIA**

**Fonte Principal**: Inter (toda a interface)
- Pesos disponíveis: 400 (Regular), 500 (Medium), 600 (Semibold), 700 (Bold)

**Hierarquia de Tamanhos:**
- H1 (Título Principal): 40px - Bold
- H2 (Título de Seção): 32px - Semibold
- H3 (Subtítulo): 24px - Semibold
- H4 (Título de Card): 20px - Medium
- Body Large: 18px - Regular
- Body: 16px - Regular
- Body Small: 14px - Regular
- Caption: 12px - Regular


### **COMPONENTES UI**

**Botões:**


Primário:

- Background: #2563EB
- Texto: #FFFFFF
- Padding: 12px 24px
- Border-radius: 8px
- Hover: #1E40AF
- Sombra: 0 2px 4px rgba(0,0,0,0.1)

Secundário:

- Background: Transparente
- Border: 2px solid #2563EB
- Texto: #2563EB
- Padding: 12px 24px
- Border-radius: 8px
- Hover: Background #EFF6FF

Destrutivo:

- Background: #EF4444
- Texto: #FFFFFF
- Mesmo formato do primário





**Cards:**


- Background: #FFFFFF
- Border: 1px solid #E5E7EB
- Border-radius: 12px
- Padding: 24px
- Sombra: 0 1px 3px rgba(0,0,0,0.1)
- Hover: Sombra mais pronunciada



**Inputs/Formulários:**


- Background: #FFFFFF
- Border: 1px solid #D1D5DB
- Border-radius: 8px
- Padding: 12px 16px
- Focus: Border #2563EB + sombra azul suave
- Texto: #1F2937
- Placeholder: #9CA3AF


**Badges/Tags:**


- Background: #EFF6FF
- Texto: #2563EB
- Padding: 4px 12px
- Border-radius: 16px
- Fonte: 14px Medium

text





### **ÍCONES**

- Estilo: Outline (linhas) para ícones gerais
- Estilo: Solid (preenchido) para status/notificações
- Tamanho padrão: 20px ou 24px
- Biblioteca sugerida: Heroicons ou Lucide Icons
- Cor: Seguir contexto da interface



### **ESPAÇAMENTO**

Sistema baseado em múltiplos de 4px:
- XS: 4px
- SM: 8px
- MD: 16px
- LG: 24px
- XL: 32px
- 2XL: 48px
- 3XL: 64px

---

### **SOMBRAS**

- Nível 1 (Cards): `0 1px 3px rgba(0,0,0,0.1)`
- Nível 2 (Modais): `0 4px 6px rgba(0,0,0,0.1)`
- Nível 3 (Dropdowns): `0 10px 15px rgba(0,0,0,0.1)`
- Nível 4 (Popups): `0 20px 25px rgba(0,0,0,0.15)`

---

### **LAYOUT E GRID**

- Largura máxima do container: 1280px
- Sistema de grid: 12 colunas
- Gap padrão entre elementos: 24px
- Breakpoints:
  - Mobile: < 640px
  - Tablet: 640px - 1024px
  - Desktop: > 1024px

---

### **NAVEGAÇÃO/HEADER**


- Background: #FFFFFF
- Altura: 64px
- Sombra: 0 1px 3px rgba(0,0,0,0.1)
- Logo à esquerda
- Menu de navegação ao centro/direita
- Ícones de perfil/notificações à direita


---

### **ESTADOS VISUAIS**

- **Hover**: Mudança suave de cor ou sombra (transição 200-300ms)
- **Active**: Escurecimento de 10%
- **Disabled**: Opacidade 50% + cursor not-allowed
- **Loading**: Skeleton shimmer em #E5E7EB ou spinner azul
- **Empty State**: Ilustração centralizada + mensagem amigável
- **Error State**: Ícone vermelho + mensagem de erro
- **Success State**: Ícone verde + mensagem de sucesso

---

### **NOTIFICAÇÕES/FEEDBACKS**

**Toast Notification:**


- Posição: Top-right
- Background: Verde/Vermelho/Amarelo/Azul (conforme tipo)
- Texto: Branco
- Ícone à esquerda
- Border-radius: 8px
- Sombra nível 3



**Alertas Inline:**

- Background suave da cor correspondente
- Borda esquerda: 4px (cor sólida)
- Ícone + texto
- Padding: 16px
- Border-radius: 8px



---

## 🎯 PRINCÍPIOS DE DESIGN A SEGUIR

1. **Profissionalismo**: Visual limpo, moderno e confiável
2. **Clareza**: Informações hierarquizadas e de fácil leitura
3. **Consistência**: Usar componentes padronizados do guia
4. **Responsividade**: Design adaptável para mobile, tablet e desktop
5. **Acessibilidade**: Contraste adequado, textos legíveis, espaçamento confortável
6. **Foco no usuário**: Interface intuitiva que não requer explicações
7. **Minimalismo funcional**: Apenas elementos necessários, sem poluição visual


## 📱 REQUISITOS TÉCNICOS

- **Resolução Desktop**: 1440px de largura (design base)
- **Resolução Mobile**: 375px de largura (iPhone base)
- **Formato de entrega**: Preferencialmente telas em alta resolução
- **Componentes**: Devem ser visualmente consistentes entre telas
- **Interações**: Indicar estados de hover, active e disabled quando relevante

---

## ✍️ DESCRIÇÃO DA TELA A DESENHAR

**[PREENCHA AQUI A DESCRIÇÃO DETALHADA DA TELA]**

---

**Exemplo de preenchimento:**


Tela: Dashboard do Cliente

Descrição:  
Esta é a tela principal que o cliente vê após fazer login. Ela deve conter:

1. Header fixo no topo com:
    
    - Logo "Skilla" à esquerda
    - Menu com links: "Meus Jobs", "Encontrar Freelancers", "Mensagens"
    - Ícone de notificações (com badge vermelho mostrando "3")
    - Avatar do usuário com dropdown
2. Seção de boas-vindas:
    
    - Título: "Olá, [Nome do Cliente]!"
    - Subtítulo: "Gerir os teus projetos nunca foi tão fácil"
3. Cards de estatísticas (4 cards em linha):
    
    - Jobs Ativos (número grande + ícone)
    - Propostas Recebidas (número + badge laranja)
    - Jobs Concluídos (número + ícone verde)
    - Valor Investido (em Kz)
4. Seção "Meus Jobs Ativos":
    
    - Título da seção
    - Botão "Criar Novo Job" (primário, azul)
    - Lista de cards de jobs (3 visíveis):
        - Cada card contém:
            - Título do job
            - Categoria (badge azul)
            - Orçamento
            - Número de propostas recebidas
            - Status (badge verde "Em andamento" ou azul "Aberto")
            - Botão "Ver Detalhes"
5. Seção "Propostas Recentes":
    
    - Título da seção
    - Tabela ou lista com:
        - Nome do freelancer (com avatar pequeno)
        - Job relacionado
        - Valor proposto
        - Prazo
        - Botão "Ver Proposta"
6. Sidebar direita (opcional):
    
    - Card com "Freelancers em Destaque"
    - Card com dicas/tutoriais

A tela deve ser clean, profissional e facilitar a navegação rápida do cliente.

text



---

## 🎨 INSTRUÇÕES FINAIS PARA O DESIGN

1. Siga **rigorosamente** o guia de estilo fornecido (cores, tipografia, componentes)
2. Priorize a **hierarquia visual** - elementos mais importantes devem ter mais destaque
3. Use **espaçamento generoso** - evite amontoar elementos
4. Aplique **sombras sutis** para criar profundidade
5. Utilize **ícones consistentes** da mesma família
6. Garanta **contraste adequado** para acessibilidade (mínimo WCAG AA)
7. Crie um design **responsivo** - mostre versão desktop e mobile
8. Indique **estados interativos** quando necessário
9. Use **imagens placeholder** realistas (avatares, logos, fotos)
10. Mantenha o design **moderno e atual** (2025/2026)


```