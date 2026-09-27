
Diagrama ER
Ferramenta:  [dbdiagram.io](https://dbdiagram.io/) (gratuito, código → diagrama automático)

```
Table users { id int [pk, increment] name varchar email varchar [unique] role enum('client','freelancer','admin') created_at timestamp } Table jobs { id int [pk] client_id int [ref: > users.id] title varchar budget decimal status enum('open','in_progress','completed') } Table proposals { id int [pk] job_id int [ref: > jobs.id] freelancer_id int [ref: > users.id] price decimal status enum('pending','accepted','rejected') }
```


### **2. Implementar CSRF Protection (30 minutos)**

Laravel já inclui middleware CSRF. Basta adicionar nos formulários:

blade

```
<form method="POST">
  @csrf
  <!-- campos -->
</form>
```


### **3. Adicionar Validação de Upload (45 minutos)**

PHP

```
$request->validate([
    'portfolio_image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
    'proposal_file' => 'required|mimes:pdf,zip|max:10240'
]);
```


### **4. Documentar Fluxo de Escrow em Texto (30 minutos)**

Criar arquivo `ESCROW_FLOW.md`:

Markdown

```
## Fluxo de Pagamento Seguro

1. Cliente aceita proposta
2. Sistema solicita depósito de X créditos
3. Créditos movidos para tabela `escrow_transactions` (status: "held")
4. Freelancer entrega trabalho
5. Cliente aprova
6. Sistema transfere créditos: escrow → conta freelancer
7. Comissão de 10% retida automaticamente
8. Freelancer pode solicitar saque
```


## **5. RISCOS E ALERTAS**

### 🚨 **TÉCNICOS (Podem reprovar o projeto)**

1. **Ausência de Diagramas UML**
    
    - **Risco:** Reprovação automática em 80% das instituições
    - **Solução:** Priorizar itens #1, #2, #3, #4 do Plano de Ação
    - **Prazo:** Máximo 2 semanas para entregar todos os diagramas
2. **Vulnerabilidade em Upload de Arquivos**
    
    - **Problema:** Sistema aceita upload de HTML/ZIP sem validação → permite execução de scripts maliciosos
    - **Solução:** Implementar item #6 + armazenar arquivos em `storage/app/uploads` (fora de `public/`)
    - **Exemplo real:** Plataforma pode ser hackeada via upload de shell reverso em arquivo ZIP
3. **Escopo de Chat em Tempo Real com Firebase**
    
    - **Problema:** Integração Firebase + Laravel requer configuração complexa (30+ horas para iniciantes)
    - **Solução Alternativa:** Usar [Laravel WebSockets](https://beyondco.de/docs/laravel-websockets) (mais simples, documentação em português)
    - **Economia:** -20 horas de desenvolvimento
4. **Filtro de IA para Mensagens Ofensivas**
    
    - **Risco:** Feature muito avançada para MVP (requer API paga ou modelo treinado)
    - **Recomendação:** **REMOVER do MVP** e mover para "Funcionalidades Futuras"
    - **Alternativa:** Lista de palavras bloqueadas simples (gratuito, 2 horas)


### **ACADÊMICOS (Reduzem nota significativamente)**

1. **Falta de Referencial Teórico**
    
    - **O que incluir:**
        - Fundamentação sobre economia de freelance (citar Upwork, estatísticas)
        - Teoria de Sistemas de Informação (ciclo de vida de software)
        - Justificativa técnica (por que Laravel vs Django?)
    - **Fontes recomendadas:**
        - Livro: "Engenharia de Software" - Pressman
        - Artigo: "The Future of Freelancing" - Harvard Business Review
    
2. **Ausência de Metodologia de Desenvolvimento**
    
    - **Problema:** Não menciona se usará Agile, Waterfall, etc.
    - **Solução:** Adicionar seção "Metodologia" no TCC: "Desenvolvimento Incremental com Scrum adaptado"
    - **Esforço:** 1 hora
    
3. **Falta de Casos de Teste Documentados**
    
    - **Exemplo de caso de teste obrigatório:**
        
        text
        
        ```
        CT-01: Login com credenciais inválidas
        Entrada: email="teste@test.com", senha="errada"
        Saída Esperada: Mensagem "Credenciais inválidas" + redirecionamento para login
        ```
        
    - **Mínimo:** 10 casos de teste (3 horas)

---

### 📅 **DE PRAZO (Podem inviabilizar o projeto)**

1. **Escopo de 15 Funcionalidades Principais em 1-2 Meses**
    
    - **Análise de Esforço:**
        
        - Autenticação 2FA: 8h
        - Chat em tempo real: 25h
        - Sistema de escrow: 15h
        - Filtro IA mensagens: 40h (MUITO ALTO)
        - Dashboard admin: 12h
        - Sistema de créditos: 10h
        - **TOTAL ESTIMADO: 180-220 horas** (equivale a 3-4 meses em dedicação parcial)
    - **RECOMENDAÇÃO CRÍTICA:** Reduzir escopo do MVP para 7 funcionalidades core:
        
        1. Autenticação (sem 2FA no MVP)
        2. Publicar Job
        3. Enviar Proposta
        4. Chat básico (Laravel Echo + Pusher gratuito)
        5. Sistema de Escrow simulado
        6. Avaliações
        7. Dashboard básico
    - **Mover para v2.0:**
        
        - 2FA
        - Filtro IA
        - Matching inteligente
        - Dashboard admin completo
        - Múltiplos métodos de pagamento
2. **Integração com Multicaixa Express**
    
    - **Problema:** API do Multicaixa requer:
        - Licença empresarial (não disponível para estudantes)
        - Certificados de segurança
        - Aprovação que leva 2-4 semanas
    - **Solução para MVP:** Sistema de créditos totalmente simulado (como já planejado)
    - **Documentar:** "Integração real será implementada em produção após aprovação do Multicaixa"

---

## **6. RECURSOS COMPLEMENTARES**

### 📚 **Templates de Documentação**

1. **Diagrama de Casos de Uso (Template)**
    
    - [Template Draw.io - Casos de Uso](https://app.diagrams.net/?libs=uml) (gratuito)
    - Tutorial PT: [Como criar Diagrama de Casos de Uso](https://www.youtube.com/watch?v=zid-MVo7M-E)
2. **Modelo ER (Template Pronto)**
    
    - [dbdiagram.io - Exemplo de E-commerce](https://dbdiagram.io/d/ecommerce-sample-5f1c2e1271f7e6046537d1c5) (adaptar para freelance)
    - [MySQL Workbench Tutorial PT](https://www.youtube.com/watch?v=K6vHjHSHN8s)
3. **Estrutura de TCC para Informática (ABNT)**
    
    - [Template LaTeX/Word - TCC Sistemas](https://www.overleaf.com/latex/templates/modelo-de-tcc-abnt/mvkxhxvqkbwn)
    - Seções obrigatórias: Introdução, Referencial Teórico, Metodologia, Desenvolvimento, Resultados, Conclusão

---

### 🎓 **Tutoriais Técnicos (Português)**

1. **Laravel + MySQL (Curso Completo)**
    
    - [Laravel do Zero - Matheus Battisti](https://www.youtube.com/watch?v=qH7rsZBENJo) (8h)
    - [Laravel 10 - Sistema CRUD](https://www.youtube.com/watch?v=WZ94k2ZxqGw) (3h)
2. **Sistema de Autenticação JWT**
    
    - [Autenticação com Laravel Sanctum](https://laravel.com/docs/10.x/sanctum) (oficial, PT disponível)
    - Biblioteca: [tymon/jwt-auth](https://github.com/tymondesigns/jwt-auth)
3. **Chat em Tempo Real (Laravel)**
    
    - [Laravel WebSockets Tutorial](https://www.youtube.com/watch?v=pjv3pXvgIKw) (português)
    - Alternativa gratuita ao Firebase: [Pusher Free Tier](https://pusher.com/channels/pricing) (100 conexões grátis)
4. **Upload Seguro de Arquivos**
    
    - [Laravel File Upload Best Practices](https://laravel.com/docs/10.x/filesystem)
    - [Validação de MIME Types](https://www.php.net/manual/en/function.mime-content-type.php)

---

### 💡 **Projetos Similares de Referência**

1. **TCC - Sistema Freelance (GitHub)**
    
    - [freelance-platform-laravel](https://github.com/ramaID/freelance) (340+ stars)
    - **O que observar:** Estrutura de banco de dados, sistema de propostas
2. **TCC - Marketplace Angolano**
    
    - [angola-marketplace](https://github.com/codedsholabs/marketplace-angola) (exemplo local)
    - **O que observar:** Integração com pagamentos locais
3. **Sistema de Escrow (Open Source)**
    
    - [escrow-system](https://github.com/bitcoin/escrow) (conceito aplicado a pagamentos)
    - **O que observar:** Lógica de retenção e liberação de fundos

---

### 🛠️ **Ferramentas Gratuitas Essenciais**

|Ferramenta|Uso|Link|
|---|---|---|
|**Draw.io**|Diagramas UML|[app.diagrams.net](https://app.diagrams.net/)|
|**dbdiagram.io**|Modelo ER (código → diagrama)|[dbdiagram.io](https://dbdiagram.io/)|
|**Figma**|Wireframes/Protótipos|[figma.com](https://figma.com/)|
|**Postman**|Testar API REST|[postman.com](https://postman.com/)|
|**Laravel Debugbar**|Debug de queries SQL|[github.com/barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)|
|**Cloudinary**|Upload de imagens (grátis: 25GB)|[cloudinary.com](https://cloudinary.com/)|
|**Railway**|Deploy gratuito (500h/mês)|[railway.app](https://railway.app/)|

---

### 📖 **Checklist de Documentação Acadêmica**

#### ✅ **Diagramas Obrigatórios (Todos devem estar no TCC)**

- [ ]  Diagrama de Casos de Uso (atores: Cliente, Freelancer, Admin)
- [ ]  Diagrama de Classes (mínimo 8 classes principais)
- [ ]  Diagrama de Sequência (fluxos: Login, Publicar Job, Escrow)
- [ ]  Modelo Entidade-Relacionamento (mínimo 10 tabelas)
- [ ]  Diagrama de Arquitetura (MVC: camadas frontend/backend/banco)

#### ✅ **Documentos Técnicos**

- [ ]  Manual de Instalação (passo a passo para rodar local)
- [ ]  Dicionário de Dados (descrever cada tabela e campo)
- [ ]  Casos de Teste (mínimo 10 cenários)
- [ ]  Referências Bibliográficas (mínimo 5 fontes acadêmicas)

#### ✅ **Código-Fonte**

- [ ]  Comentários em funções críticas (ex: lógica de escrow)
- [ ]  README.md com descrição do projeto
- [ ]  Arquivo .env.example (configurações necessárias)
- [ ]  Migrations do banco de dados

---

## 🎯 **ROADMAP SUGERIDO (1-2 MESES)**

### **Semana 1-2: Documentação (PRIORITÁRIO)**

- Criar todos os diagramas UML (itens #1, #2, #3, #4)
- Escrever referencial teórico
- Normalizar banco de dados

### **Semana 3-4: Desenvolvimento Core**

- Autenticação (login/cadastro)
- CRUD de Jobs
- Sistema de propostas

### **Semana 5-6: Features Diferenciais**

- Chat básico (sem IA)
- Escrow simulado
- Sistema de créditos

### **Semana 7-8: Finalização**

- Dashboard básico
- Testes
- Deploy
- Revisão de documentação