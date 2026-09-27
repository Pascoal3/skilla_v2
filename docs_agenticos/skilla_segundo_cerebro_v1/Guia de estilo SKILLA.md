# 🎨 GUIA DE ESTILO - PLATAFORMA SKILLA

Vamos criar um guia de estilo completo e profissional para o teu projeto antes de gerar o prompt para o Google Stitch.

## **1. IDENTIDADE VISUAL**

### **Conceito**

- **Profissionalismo** com toque moderno
- **Confiança** e segurança
- **Acessibilidade** para o mercado angolano
- **Minimalismo** funcional

## **2. PALETA DE CORES**

### **Cores Primárias**

text

```
🔵 Azul Principal (Primary)
#2563EB - Confiança, profissionalismo, tecnologia
Uso: Botões principais, links, destaques

🟦 Azul Escuro (Dark)
#1E40AF - Solidez, autoridade
Uso: Cabeçalhos, textos importantes, navegação

⚪ Branco (White)
#FFFFFF - Limpeza, clareza
Uso: Fundos, cards, áreas de conteúdo
```

### **Cores Secundárias**

text

```
🟠 Laranja (Accent)
#F97316 - Energia, ação, destaque
Uso: CTAs secundários, notificações, badges

🟣 Roxo (Highlight)
#7C3AED - Criatividade, inovação
Uso: Funcionalidades premium, boost de perfil

🟢 Verde (Success)
#10B981 - Sucesso, aprovação
Uso: Mensagens de sucesso, status positivos

🔴 Vermelho (Error)
#EF4444 - Erro, alerta
Uso: Mensagens de erro, ações destrutivas

🟡 Amarelo (Warning)
#F59E0B - Aviso, atenção
Uso: Alertas, pendências
```

### **Cores Neutras**

text

```
⬛ Cinza Escuro (Text Primary)
#1F2937 - Textos principais

⬜ Cinza Médio (Text Secondary)
#6B7280 - Textos secundários, legendas

◻️ Cinza Claro (Border)
#E5E7EB - Bordas, separadores

⬜ Cinza Muito Claro (Background)
#F9FAFB - Fundos secundários, áreas de conteúdo
```

## **3. TIPOGRAFIA**

### **Fontes**

text

```
Fonte Principal: Inter
- Uso: Toda a interface
- Pesos: 400 (Regular), 500 (Medium), 600 (Semibold), 700 (Bold)

Fonte Secundária: Space Grotesk (opcional para títulos grandes)
- Uso: Títulos de destaque, landing page
- Pesos: 500, 700
```

### **Tamanhos de Texto**

text

```
H1 (Título Principal): 2.5rem (40px) - Bold
H2 (Título Seção): 2rem (32px) - Semibold
H3 (Subtítulo): 1.5rem (24px) - Semibold
H4 (Card Title): 1.25rem (20px) - Medium
Body Large: 1.125rem (18px) - Regular
Body: 1rem (16px) - Regular
Body Small: 0.875rem (14px) - Regular
Caption: 0.75rem (12px) - Regular
```

## **4. ESPAÇAMENTO**

text

```
Sistema de espaçamento baseado em múltiplos de 4px:

xs: 4px
sm: 8px
md: 16px
lg: 24px
xl: 32px
2xl: 48px
3xl: 64px
```

## **5. COMPONENTES UI**

### **Botões**

text

```
Botão Primário:
- Cor: #2563EB
- Texto: Branco (#FFFFFF)
- Padding: 12px 24px
- Border-radius: 8px
- Hover: #1E40AF
- Sombra: 0 2px 4px rgba(0,0,0,0.1)

Botão Secundário:
- Cor: Transparente
- Borda: 2px solid #2563EB
- Texto: #2563EB
- Padding: 12px 24px
- Border-radius: 8px
- Hover: fundo #EFF6FF

Botão Destrutivo:
- Cor: #EF4444
- Texto: Branco
- Mesmo formato do primário
```

### **Cards**

text

```
Background: #FFFFFF
Border: 1px solid #E5E7EB
Border-radius: 12px
Padding: 24px
Sombra: 0 1px 3px rgba(0,0,0,0.1)
Hover: Sombra mais intensa
```

### **Inputs**

text

```
Background: #FFFFFF
Border: 1px solid #D1D5DB
Border-radius: 8px
Padding: 12px 16px
Focus: Border #2563EB + Sombra azul suave
Texto: #1F2937
Placeholder: #9CA3AF
```

### **Badges/Tags**

text

```
Background: #EFF6FF
Texto: #2563EB
Padding: 4px 12px
Border-radius: 16px
Tamanho: 14px
```

## **6. ÍCONES**

text

```
Biblioteca: Heroicons ou Lucide Icons
Estilo: Outline (linhas) para ícones gerais
Estilo: Solid (preenchido) para ícones de status/notificação
Tamanho padrão: 20px ou 24px
Cor: Seguir contexto (primária, secundária ou neutra)
```

## **7. IMAGENS E ILUSTRAÇÕES**

text

```
Estilo: Moderno, flat design ou isométrico
Cores: Compatíveis com a paleta (azul e laranja predominantes)
Ilustrações: Para páginas vazias, onboarding, erros
Fotos: Arredondadas (border-radius: 8px para retangulares, 50% para perfis)
```

## **8. SOMBRAS**

text

```
Nível 1 (Cards): 0 1px 3px rgba(0,0,0,0.1)
Nível 2 (Modais): 0 4px 6px rgba(0,0,0,0.1)
Nível 3 (Dropdowns): 0 10px 15px rgba(0,0,0,0.1)
Nível 4 (Popups): 0 20px 25px rgba(0,0,0,0.15)
```

## **9. ANIMAÇÕES**

text

```
Transições: 200-300ms ease-in-out
Hover: Scale 1.02 ou mudança suave de cor
Loading: Spinners azuis (#2563EB)
Skeleton: Shimmer effect em #E5E7EB
```

## **10. LAYOUT**

text

```
Largura máxima do container: 1280px
Grid: 12 colunas
Gap padrão: 24px
Breakpoints:
  - Mobile: < 640px
  - Tablet: 640px - 1024px
  - Desktop: > 1024px
```

## **11. NAVEGAÇÃO**

text

```
Header:
- Background: #FFFFFF
- Altura: 64px
- Sombra: 0 1px 3px rgba(0,0,0,0.1)
- Logo à esquerda
- Menu ao centro/direita

Sidebar (se houver):
- Largura: 256px
- Background: #F9FAFB ou #FFFFFF
- Ícones + texto
```

## **12. ESTADOS VISUAIS**

text

```
Hover: Mudança suave de cor/sombra
Active: Escurecimento de 10%
Disabled: Opacidade 50% + cursor not-allowed
Loading: Skeleton ou spinner
Empty State: Ilustração + mensagem centralizada
Error State: Ícone vermelho + mensagem
Success State: Ícone verde + mensagem
```

## **13. MENSAGENS E FEEDBACKS**

text

```
Toast Notification:
- Posição: Top-right
- Background conforme tipo (verde/vermelho/amarelo/azul)
- Texto branco
- Ícone à esquerda
- Auto-close: 5 segundos

Alertas inline:
- Background suave da cor correspondente
- Borda à esquerda de 4px
- Ícone + mensagem
```

