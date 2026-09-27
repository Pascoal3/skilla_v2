Para implementar o **mapeamento de dados dinâmicos** nos seus painéis (Cliente e Freelancer), você precisa de **3 componentes principais**:

---

## 🔧 **1. Backend (Laravel) - Configuração de Rotas e Controladores**

### **Rotas (routes/web.php)**
```php
// Para painel do cliente
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/painel/cliente', [ClientDashboardController::class, 'index'])->name('painel.cliente');
    Route::get('/api/cliente/dados', [ClientDashboardController::class, 'getData'])->name('api.cliente.dados');

    // Para painel do freelancer
    Route::get('/painel/freelancer', [FreelancerDashboardController::class, 'index'])->name('painel.freelancer');
    Route::get('/api/freelancer/dados', [FreelancerDashboardController::class, 'getData'])->name('api.freelancer.dados');
});
```

---

---

## 📊 **2. Controladores (App/Http/Controllers)**

### **ClientDashboardController.php**
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientDashboardController extends Controller
{
    public function index()
    {
        return view('painel.cliente');
    }

    public function getData(Request $request)
    {
        $user = Auth::user();

        // Dados do usuário
        $userData = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar ?? asset('img/foto_perfil_exemplar.png'),
        ];

        // Dados do painel (exemplo com valores estáticos, substitua pelos seus modelos)
        $dashboardData = [
            'new_proposals' => 4, // Propostas novas
            'published_jobs' => 3, // Trabalhos publicados
            'received_proposals' => 12, // Propostas recebidas
            'in_progress' => 1, // Em andamento
            'completed' => 8, // Concluídos
            'wallet_balance' => 50000, // Saldo disponível (KZS)
            'escrow_amount' => 25000, // Em Escrow (KZS)
        ];

        // Propostas recentes (exemplo)
        $recentProposals = [
            [
                'freelancer_name' => 'Miguel Fernandes',
                'freelancer_avatar' => asset('img/foto_perfil_exemplar.png'),
                'specialty' => 'UI/UX Designer',
                'rating' => 4.9,
                'amount' => 75000,
                'job_title' => 'Desenvolvimento de Website Corporativo'
            ],
            [
                'freelancer_name' => 'Carla Mendes',
                'freelancer_avatar' => asset('img/foto_perfil_exemplar.png'),
                'specialty' => 'Web Developer',
                'rating' => 5.0,
                'amount' => 120000,
                'job_title' => 'Landing Page para Startup'
            ]
        ];

        // Trabalhos ativos (exemplo)
        $activeJobs = [
            [
                'title' => 'Desenvolvimento de Website Corporativo',
                'client' => 'TechAngola Solutions',
                'amount' => 65000,
                'progress' => 60,
                'deadline' => '5 dias'
            ]
        ];

        return response()->json([
            'user' => $userData,
            'dashboard' => $dashboardData,
            'recent_proposals' => $recentProposals,
            'active_jobs' => $activeJobs,
        ]);
    }
}
```

---

### **FreelancerDashboardController.php**
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FreelancerDashboardController extends Controller
{
    public function index()
    {
        return view('painel.freelancer');
    }

    public function getData(Request $request)
    {
        $user = Auth::user();

        // Dados do usuário
        $userData = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar ?? asset('img/foto_perfil_exemplar.png'),
            'rating' => 4.9, // Avaliação média
        ];

        // Dados do painel (exemplo)
        $dashboardData = [
            'active_jobs' => 2, // Trabalhos ativos
            'total_proposals' => 5, // Propostas enviadas
            'pending_proposals' => 3, // Propostas pendentes
            'total_earned' => 120000, // Total ganho (KZS)
            'credits' => 20, // Créditos
            'escrow_amount' => 25000, // Em Escrow (KZS)
            'completed_jobs' => 38, // Jobs concluídos
        ];

        // Job ativo (exemplo)
        $activeJob = [
            'title' => 'Redesenho UI/UX App Mobile',
            'client' => 'TechAngola Solutions',
            'amount' => 65000,
            'progress' => 60,
            'deadline' => '5 dias'
        ];

        // Propostas recentes (exemplo)
        $recentProposals = [
            [
                'job_title' => 'E-commerce Fashion',
                'client' => 'Loja Virtual LDA',
                'amount' => 45000,
                'status' => 'pending' // pending, accepted, rejected
            ],
            [
                'job_title' => 'Landing Page FinTech',
                'client' => 'Fintech Angola',
                'amount' => 80000,
                'status' => 'accepted'
            ],
            [
                'job_title' => 'Logo Startup',
                'client' => 'Startup Inovadora',
                'amount' => 15000,
                'status' => 'rejected'
            ]
        ];

        // Jobs recomendados (exemplo)
        $recommendedJobs = [
            [
                'title' => 'Desenvolvimento Frontend React',
                'client' => 'FintechLuanda',
                'client_avatar' => asset('img/foto_perfil_exemplar.png'),
                'budget' => 90000,
                'description' => 'Precisamos de um desenvolvedor para criar um dashboard administrativo responsivo usando React e Tailwind.',
                'skills' => ['React', 'TailwindCSS']
            ],
            [
                'title' => 'Design de Identidade Visual',
                'client' => 'Agência Criativa LDA',
                'client_avatar' => asset('img/foto_perfil_exemplar.png'),
                'budget' => 35000,
                'description' => 'Criar logótipo, paleta de cores e guia de estilo básico para uma nova pastelaria em Luanda.',
                'skills' => ['Branding', 'Illustrator']
            ],
            [
                'title' => 'Redação de Artigos Blog Tech',
                'client' => 'Consulting Partners',
                'client_avatar' => asset('img/foto_perfil_exemplar.png'),
                'budget' => 20000,
                'description' => 'Procuramos redator para 4 artigos mensais sobre tecnologia e inovação no mercado angolano.',
                'skills' => ['Copywriting', 'SEO']
            ]
        ];

        return response()->json([
            'user' => $userData,
            'dashboard' => $dashboardData,
            'active_job' => $activeJob,
            'recent_proposals' => $recentProposals,
            'recommended_jobs' => $recommendedJobs,
        ]);
    }
}
```

---

---

## 🌐 **3. Frontend (JavaScript) - Preenchimento Dinâmico**

### **Crie o arquivo `resources/js/dashboard.js`**
```javascript
document.addEventListener('DOMContentLoaded', function() {
    // Função para formatar moeda (KZS)
    function formatCurrency(value) {
        return new Intl.NumberFormat('pt-AO', {
            style: 'currency',
            currency: 'AOA',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(value).replace('AOA', 'KZS');
    }

    // Função para obter a cor do status
    function getStatusColor(status) {
        const colors = {
            'pending': 'orange-500',
            'accepted': 'green-500',
            'rejected': 'red-500',
            'in_progress': 'blue-500',
            'completed': 'green-500'
        };
        return colors[status] || 'gray-500';
    }

    // Função para obter o fundo do status
    function getStatusBg(status) {
        const bg = {
            'pending': '#FFF3E0',
            'accepted': '#E8F5E9',
            'rejected': '#FFEBEE',
            'in_progress': '#E3F2FD',
            'completed': '#E8F5E9'
        };
        return bg[status] || '#F5F5F5';
    }

    // Função para obter a cor do texto do status
    function getStatusText(status) {
        const text = {
            'pending': '#E65100',
            'accepted': '#2E7D32',
            'rejected': '#C62828',
            'in_progress': '#1565C0',
            'completed': '#2E7D32'
        };
        return text[status] || '#333';
    }

    // Função para buscar dados do painel
    async function fetchDashboardData() {
        try {
            const path = window.location.pathname.includes('freelancer')
                ? '/api/freelancer/dados'
                : '/api/cliente/dados';

            const response = await fetch(path, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Falha ao carregar dados do painel');
            }

            return await response.json();
        } catch (error) {
            console.error('Erro ao buscar dados:', error);
            return null;
        }
    }

    // Função para preencher o painel do CLIENTE
    function fillClientDashboard(data) {
        if (!data) return;

        // Preencher nome do usuário
        const userNameElements = document.querySelectorAll('#user-name, .user-greeting');
        userNameElements.forEach(el => {
            el.textContent = `Olá, ${data.user.name} 👋`;
        });

        // Preencher notificação de propostas novas
        const newProposalsElement = document.querySelector('#new-proposals');
        if (newProposalsElement) {
            newProposalsElement.textContent = `${data.dashboard.new_proposals} propostas novas`;
        }

        // Preencher métricas
        const metrics = {
            'published-jobs': data.dashboard.published_jobs,
            'received-proposals': data.dashboard.received_proposals,
            'in-progress': data.dashboard.in_progress,
            'completed': data.dashboard.completed,
            'wallet-balance': formatCurrency(data.dashboard.wallet_balance),
            'escrow-amount': formatCurrency(data.dashboard.escrow_amount)
        };

        for (const [id, value] of Object.entries(metrics)) {
            const element = document.getElementById(id);
            if (element) {
                element.textContent = value;
            }
        }

        // Preencher propostas recentes
        const proposalsContainer = document.querySelector('#recent-proposals');
        if (proposalsContainer && data.recent_proposals.length > 0) {
            proposalsContainer.innerHTML = data.recent_proposals.map(proposal => `
                <div class="flex items-center gap-4 p-4 border border-border-subtle rounded-lg hover:bg-light-gray transition-colors">
                    <img src="${proposal.freelancer_avatar}" alt="${proposal.freelancer_name}" class="w-12 h-12 rounded-full">
                    <div class="flex-1">
                        <h4 class="font-medium">${proposal.freelancer_name}</h4>
                        <p class="text-body-sm font-body-sm text-secondary">
                            ${proposal.specialty} • ⭐ ${proposal.rating}
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold">${formatCurrency(proposal.amount)}</p>
                        <a href="#" class="text-sm text-primary hover:underline">Ver Proposta</a>
                    </div>
                </div>
            `).join('');
        }

        // Preencher trabalhos ativos
        const jobsContainer = document.querySelector('#active-jobs');
        if (jobsContainer && data.active_jobs.length > 0) {
            jobsContainer.innerHTML = data.active_jobs.map(job => `
                <div class="p-4 sm:p-6 hover:bg-light-gray transition-colors flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h4 class="text-body-md font-body-md font-medium mb-1">${job.title}</h4>
                        <p class="text-body-sm font-body-sm text-secondary">
                            Publicado há 2 dias • ${job.client}
                        </p>
                    </div>
                    <span class="bg-[#1A1A1A] text-[#CCFF00] px-3 py-1 rounded-full text-label-sm font-label-sm">
                        Aberto
                    </span>
                </div>
            `).join('');
        }
    }

    // Função para preencher o painel do FREELANCER
    function fillFreelancerDashboard(data) {
        if (!data) return;

        // Preencher nome do usuário
        const userNameElements = document.querySelectorAll('#user-name, .user-greeting');
        userNameElements.forEach(el => {
            const hour = new Date().getHours();
            let greeting = 'Bom dia';
            if (hour >= 12 && hour < 18) greeting = 'Boa tarde';
            else if (hour >= 18) greeting = 'Boa noite';

            el.textContent = `${greeting}, ${data.user.name} 👋`;
        });

        // Preencher métricas
        const metrics = {
            'active-jobs': data.dashboard.active_jobs,
            'total-proposals': data.dashboard.total_proposals,
            'pending-proposals': `${data.dashboard.pending_proposals} PENDENTES`,
            'total-earned': formatCurrency(data.dashboard.total_earned),
            'credits': data.dashboard.credits,
            'escrow-amount': formatCurrency(data.dashboard.escrow_amount),
            'completed-jobs': data.dashboard.completed_jobs,
            'average-rating': data.user.rating
        };

        for (const [id, value] of Object.entries(metrics)) {
            const element = document.getElementById(id);
            if (element) {
                element.textContent = value;
            }
        }

        // Preencher job ativo
        const activeJobContainer = document.querySelector('#active-job');
        if (activeJobContainer && data.active_job) {
            activeJobContainer.innerHTML = `
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h4 class="font-headline-sm text-[20px] leading-tight text-black-pure mb-1">
                            ${data.active_job.title}
                        </h4>
                        <span class="inline-block bg-[#CCFF00] text-black-pure text-[10px] font-bold px-2 py-0.5 rounded-full mt-2">
                            Entrega em ${data.active_job.deadline}
                        </span>
                        <p class="font-body-md text-body-md text-on-tertiary-container flex items-center gap-2">
                            <span class="material-symbols-outlined text-[16px]">domain</span>
                            ${data.active_job.client}
                        </p>
                    </div>
                    <span class="font-headline-sm text-[20px] text-black-pure whitespace-nowrap">
                        ${formatCurrency(data.active_job.amount)}
                    </span>
                </div>
                <div class="mb-6">
                    <div class="flex justify-between font-label-sm text-label-sm mb-2 text-black-pure">
                        <span>Progresso</span>
                        <span>${data.active_job.progress}%</span>
                    </div>
                    <div class="w-full bg-primary h-2 rounded-full overflow-hidden">
                        <div class="bg-black-pure h-full" style="width: ${data.active_job.progress}%"></div>
                    </div>
                </div>
                <a class="inline-flex items-center gap-2 font-label-md text-label-md font-bold text-black-pure hover:opacity-70 transition-opacity" href="#">
                    Ver Sala de Trabalho <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>
            `;
        }

        // Preencher propostas recentes
        const proposalsContainer = document.querySelector('#recent-proposals');
        if (proposalsContainer && data.recent_proposals.length > 0) {
            proposalsContainer.innerHTML = data.recent_proposals.map(proposal => {
                const statusClass = getStatusColor(proposal.status);
                const statusBg = getStatusBg(proposal.status);
                const statusText = getStatusText(proposal.status);

                return `
                    <div class="flex items-center justify-between p-3 rounded-lg hover:bg-surface-container-lowest transition-colors group cursor-pointer border border-transparent hover:border-outline-variant">
                        <div>
                            <p class="font-label-md text-label-md text-black-pure font-bold">
                                <span class="inline-block w-2 h-2 rounded-full bg-${statusClass} mr-2"></span>
                                ${proposal.job_title}
                            </p>
                            <p class="font-label-sm text-label-sm text-on-tertiary-container">${proposal.client}</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-[10px] font-bold" style="background-color: ${statusBg}; color: ${statusText};">
                            ${proposal.status.toUpperCase()}
                        </span>
                    </div>
                `;
            }).join('');
        }

        // Preencher jobs recomendados
        const jobsContainer = document.querySelector('#recommended-jobs');
        if (jobsContainer && data.recommended_jobs.length > 0) {
            jobsContainer.innerHTML = data.recommended_jobs.map(job => `
                <div class="card_proposta glass-card p-6 hard-shadow flex flex-col gap-4 border border-transparent hover:border-black-pure transition-colors">
                    <div class="flex justify-between items-start">
                        <img class="foto_cliente_postou_vaga" src="${job.client_avatar}" alt="${job.client}">
                        <span class="font-headline-sm text-[18px] text-black-pure">${formatCurrency(job.budget)}</span>
                    </div>
                    <div>
                        <h4 class="font-headline-sm text-[20px] leading-tight text-black-pure mb-2">${job.title}</h4>
                        <p class="text-[12px] text-on-tertiary-container -mt-1 mb-2">${job.client}</p>
                        <p class="font-body-md text-[14px] text-on-tertiary-container line-clamp-2">${job.description}</p>
                    </div>
                    <div class="flex flex-wrap gap-2 mt-auto pt-4">
                        ${job.skills.map(skill => `
                            <span class="px-3 py-1 bg-surface-container-lowest border border-outline rounded-full font-label-sm text-[11px] text-black-pure" style="background-color: #F0F0F0; border-color: #E0E0E0;">
                                ${skill}
                            </span>
                        `).join('')}
                    </div>
                    <button class="w-full border-2 border-black-pure text-black-pure py-2.5 mt-4 rounded-lg font-label-md text-label-md font-bold hover:bg-black-pure hover:text-white transition-colors">
                        Enviar Proposta
                    </button>
                </div>
            `).join('');
        }
    }

    // Inicializar
    fetchDashboardData().then(data => {
        if (window.location.pathname.includes('freelancer')) {
            fillFreelancerDashboard(data);
        } else {
            fillClientDashboard(data);
        }
    });
});
```

---

---

## 📄 **4. Modificações nos Templates Blade**

### **Painel do Cliente (painel/cliente.blade.php)**
Adicione **IDs** aos elementos que serão preenchidos dinamicamente:

```blade
<!-- No head -->
<meta name="user-id" content="{{ auth()->id() }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Na saudação -->
<h2 class="text-headline-lg font-headline-lg text-on-surface mb-1" id="user-name">Olá, Pascoal 👋</h2>
<p class="text-body-md font-body-md text-secondary">Tens <span class="font-semibold text-primary" id="new-proposals">4 propostas novas</span> à espera de revisão.</p>

<!-- Nos cards de métricas -->
<p class="text-metric-lg font-metric-lg text-on-surface" id="published-jobs">3</p>
<p class="text-metric-lg font-metric-lg text-on-surface" id="received-proposals">12</p>
<p class="text-metric-lg font-metric-lg text-on-surface" id="in-progress">1</p>
<p class="text-metric-lg font-metric-lg text-on-surface" id="completed">8</p>
<p class="text-metric-lg font-metric-lg text-[#1A1A1A]" id="wallet-balance">50.000,00 KZS</p>
<p class="text-headline-md font-headline-md text-[#CCFF00]" id="escrow-amount">25.000,00 KZS</p>

<!-- Container para propostas recentes -->
<div id="recent-proposals">
    <!-- Será preenchido pelo JS -->
</div>

<!-- Container para trabalhos ativos -->
<div id="active-jobs">
    <!-- Será preenchido pelo JS -->
</div>
```

---

### **Painel do Freelancer (painel/freelancer.blade.php)**
Adicione **IDs** aos elementos:

```blade
<!-- No head -->
<meta name="user-id" content="{{ auth()->id() }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Na saudação -->
<h2 class="font-headline-md text-headline-md text-black-pure mb-2" id="user-name">Bom dia, Pascoal 👋</h2>

<!-- Nos cards de métricas -->
<span class="font-display-lg text-headline-md font-bold text-black-pure leading-none truncate" id="active-jobs">2</span>
<span class="font-display-lg text-headline-md font-bold text-black-pure leading-none truncate" id="total-proposals">5</span>
<span class="font-bold text-black-pure leading-none truncate" style="font-size: 24px;" id="pending-proposals">3 PENDENTES</span>
<span class="font-bold text-black-pure leading-none truncate" style="font-size: 24px;" id="total-earned">KZS 120K</span>
<span class="font-bold text-black-pure leading-none truncate" style="font-size: 24px;" id="credits">20</span>
<span class="font-bold text-black-pure leading-none truncate" style="font-size: 24px;" id="escrow-amount">KZS 25K</span>
<span class="font-display-lg text-headline-md font-bold text-black-pure leading-none truncate" id="average-rating">4.9</span>
<span class="font-bold text-black-pure leading-none truncate" style="font-size: 24px;" id="completed-jobs">38</span>

<!-- Container para job ativo -->
<div id="active-job" class="glass-card p-6 hard-shadow border-l-8 border-black-pure">
    <!-- Será preenchido pelo JS -->
</div>

<!-- Container para propostas recentes -->
<div id="recent-proposals" class="flex-1 flex flex-col gap-4 mb-6">
    <!-- Será preenchido pelo JS -->
</div>

<!-- Container para jobs recomendados -->
<div id="recommended-jobs" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Será preenchido pelo JS -->
</div>
```

---

---

## 🚀 **5. Incluir o JavaScript no Blade**
No final do body de **ambos os templates**, adicione:
```blade
<script src="{{ asset('js/dashboard.js') }}"></script>
```

---

---

## 🔐 **6. Configurar o Middleware de Autenticação**
Crie um middleware para verificar se o usuário é **cliente** ou **freelancer**:

### **Criar Middleware**
```bash
php artisan make:middleware CheckUserRole
```

### **Editar o Middleware (app/Http/Middleware/CheckUserRole.php)**
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Verifique se o usuário tem o papel correto
        // Assumindo que você tem uma coluna 'role' na tabela users
        if ($user->role !== $role) {
            abort(403, 'Acesso não autorizado.');
        }

        return $next($request);
    }
}
```

### **Registrar o Middleware (app/Http/Kernel.php)**
Adicione no array `$routeMiddleware`:
```php
'client' => \App\Http\Middleware\CheckUserRole::class . ':cliente',
'freelancer' => \App\Http\Middleware\CheckUserRole::class . ':freelancer',
```

---

---

## 📌 **7. Estrutura do Banco de Dados (Exemplo)**
Aqui está um exemplo de como suas tabelas poderiam ser estruturadas:

### **Tabela `users`**
| Coluna       | Tipo         | Descrição                     |
|--------------|--------------|-------------------------------|
| id           | bigIncrements| ID do usuário                 |
| name         | string       | Nome do usuário               |
| email        | string       | Email do usuário              |
| password     | string       | Senha criptografada           |
| role         | string       | 'cliente' ou 'freelancer'     |
| avatar       | string       | URL do avatar                 |
| created_at   | timestamp    | Data de criação               |
| updated_at   | timestamp    | Data de atualização           |

---

### **Tabela `clients`** (se precisar de dados específicos do cliente)
| Coluna       | Tipo         | Descrição                     |
|--------------|--------------|-------------------------------|
| id           | bigIncrements| ID do cliente                 |
| user_id      | foreignId    | Relacionamento com users      |
| company_name | string       | Nome da empresa (opcional)    |
| balance      | decimal      | Saldo disponível              |
| created_at   | timestamp    | Data de criação               |
| updated_at   | timestamp    | Data de atualização           |

---

### **Tabela `freelancers`** (se precisar de dados específicos do freelancer)
| Coluna       | Tipo         | Descrição                     |
|--------------|--------------|-------------------------------|
| id           | bigIncrements| ID do freelancer              |
| user_id      | foreignId    | Relacionamento com users      |
| specialty    | string       | Especialidade                 |
| rating       | decimal      | Avaliação média               |
| credits      | integer      | Créditos disponíveis          |
| bio          | text         | Biografia                     |
| created_at   | timestamp    | Data de criação               |
| updated_at   | timestamp    | Data de atualização           |

---

### **Tabela `jobs`** (Trabalhos)
| Coluna       | Tipo         | Descrição                     |
|--------------|--------------|-------------------------------|
| id           | bigIncrements| ID do trabalho                |
| client_id    | foreignId    | Relacionamento com clients    |
| title        | string       | Título do trabalho            |
| description  | text         | Descrição do trabalho         |
| budget       | decimal      | Orçamento                     |
| status       | string       | 'open', 'in_progress', etc.    |
| deadline     | date         | Prazo                         |
| created_at   | timestamp    | Data de criação               |
| updated_at   | timestamp    | Data de atualização           |

---
### **Tabela `proposals`** (Propostas)
| Coluna       | Tipo         | Descrição                     |
|--------------|--------------|-------------------------------|
| id           | bigIncrements| ID da proposta                |
| job_id       | foreignId    | Relacionamento com jobs       |
| freelancer_id| foreignId    | Relacionamento com freelancers|
| amount       | decimal      | Valor da proposta             |
| message      | text         | Mensagem da proposta          |
| status       | string       | 'pending', 'accepted', etc.   |
| created_at   | timestamp    | Data de criação               |
| updated_at   | timestamp    | Data de atualização           |

---
---

## 🎯 **8. Fluxo de Trabalho**
1. **Usuário faz login** → Laravel autentica e armazena o ID do usuário na sessão.
2. **Usuário acessa o painel** → Middleware verifica o papel (`cliente` ou `freelancer`).
3. **Página carrega** → JavaScript busca os dados via AJAX.
4. **Backend retorna JSON** → Controlador retorna os dados do usuário e do painel.
5. **JavaScript preenche o HTML** → Funções `fillClientDashboard` ou `fillFreelancerDashboard` preenchem os elementos.

---

---
## ✅ **Resumo do que você precisa fazer:**

| Passo | Ação | Arquivo/Comando |
|-------|------|------------------|
| 1 | Criar controladores | `php artisan make:controller ClientDashboardController` e `php artisan make:controller FreelancerDashboardController` |
| 2 | Adicionar rotas | `routes/web.php` |
| 3 | Criar middleware | `php artisan make:middleware CheckUserRole` |
| 4 | Registrar middleware | `app/Http/Kernel.php` |
| 5 | Adicionar IDs ao HTML | `painel/cliente.blade.php` e `painel/freelancer.blade.php` |
| 6 | Criar arquivo JS | `resources/js/dashboard.js` |
| 7 | Incluir JS no Blade | Adicionar `<script src="{{ asset('js/dashboard.js') }}"></script>` |
| 8 | Configurar banco de dados | Criar tabelas conforme necessário |

---
---
## 💡 **Dicas Finais**
1. **Teste os endpoints** usando o Postman ou o navegador para verificar se os dados estão sendo retornados corretamente.
2. **Use o console do navegador** para depurar o JavaScript e verificar se os dados estão chegando.
3. **Comece com dados estáticos** nos controladores e depois substitua por consultas ao banco de dados.
4. **Valide os dados** no backend para evitar erros no frontend.

---
---
## 📚 **Exemplo de Consulta ao Banco de Dados (ClientDashboardController)**
Se você já tiver as tabelas criadas, substitua os dados estáticos por consultas reais:

```php
public function getData(Request $request)
{
    $user = Auth::user();
    $client = $user->client; // Assumindo que tem relação hasOne com Client

    // Dados do usuário
    $userData = [
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'avatar' => $user->avatar ?? asset('img/foto_perfil_exemplar.png'),
    ];

    // Dados do painel (consultas reais)
    $dashboardData = [
        'new_proposals' => $client->jobs()
            ->withCount(['proposals' => function($query) {
                $query->where('created_at', '>', now()->subDays(7));
            }])
            ->get()
            ->sum('proposals_count'),

        'published_jobs' => $client->jobs()->count(),
        'received_proposals' => $client->jobs()->with('proposals')->get()->pluck('proposals')->flatten()->count(),
        'in_progress' => $client->jobs()->where('status', 'in_progress')->count(),
        'completed' => $client->jobs()->where('status', 'completed')->count(),
        'wallet_balance' => $client->balance,
        'escrow_amount' => $client->jobs()->whereIn('status', ['in_progress', 'pending_payment'])->sum('escrow_amount'),
    ];

    // Propostas recentes
    $recentProposals = $client->jobs()
        ->with(['proposals' => function($query) {
            $query->with('freelancer.user')->latest()->take(2);
        }])
        ->whereHas('proposals')
        ->latest()
        ->take(2)
        ->get()
        ->pluck('proposals')
        ->flatten()
        ->map(function($proposal) {
            return [
                'freelancer_name' => $proposal->freelancer->user->name,
                'freelancer_avatar' => $proposal->freelancer->user->avatar ?? asset('img/foto_perfil_exemplar.png'),
                'specialty' => $proposal->freelancer->specialty,
                'rating' => $proposal->freelancer->rating,
                'amount' => $proposal->amount,
                'job_title' => $proposal->job->title
            ];
        });

    // Trabalhos ativos
    $activeJobs = $client->jobs()
        ->whereIn('status', ['open', 'in_progress'])
        ->with('client')
        ->latest()
        ->take(3)
        ->get()
        ->map(function($job) {
            return [
                'title' => $job->title,
                'client' => $job->client->company_name ?? $job->client->user->name,
                'amount' => $job->budget,
                'progress' => 0, // Você pode calcular o progresso com base em milestones
                'deadline' => $job->deadline->diffForHumans()
            ];
        });

    return response()->json([
        'user' => $userData,
        'dashboard' => $dashboardData,
        'recent_proposals' => $recentProposals,
        'active_jobs' => $activeJobs,
    ]);
}
```

---
Com essa implementação, seus painéis **vão carregar os dados dinamicamente** de acordo com o usuário logado! 🚀






## 🔧 Ajustes no Frontend (JavaScript dos Forms)

**No script de registro, atualize o handling de sucesso:**

JavaScript

```
if (response.ok) {
    const data = await response.json();
    
    // Esconder loading
    if (loadingOverlay) loadingOverlay.classList.add('hidden');
    
    // Mostrar overlay de sucesso
    const successOverlay = document.getElementById('success-overlay');
    if (successOverlay) {
        successOverlay.classList.remove('hidden');
    }
    
    // Redirecionar após 3 segundos
    setTimeout(() => {
        // O cookie JWT já está no navegador, o middleware vai autenticar
        window.location.href = data.redirect || 
            (data.role === 'cliente' ? '/painel/cliente' : '/painel/freelancer');
    }, 3000);
}
```

**No script de login:**

JavaScript

```
const response = await fetch('/login', {
    method: 'POST',
    body: formData,
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    }
});
```

**No link de logout das dashboards:**

HTML

```
<a href="#" onclick="logout(event)">
    <span class="material-symbols-outlined">logout</span> Sair
</a>

<script>
async function logout(event) {
    event.preventDefault();
    
    const response = await fetch('/logout-api', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
            'Accept': 'application/json'
        }
    });
    
    if (response.ok) {
        window.location.href = '/login';
    }
}
</script>
```

---

## 🚦 Rotas Atualizadas

**Arquivo: `routes/web.php`**

PHP

```
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Rotas Públicas
Route::get('/login', function() {
    return view('auth.login');
})->name('login');

Route::get('/registar/cliente', function() {
    return view('registar.cliente');
})->name('registar.cliente');

Route::get('/registar/freelancer', function() {
    return view('registar.freelancer');
})->name('registar.freelancer');

// Auth Routes
Route::post('/registar', [AuthController::class, 'registar'])->name('registar');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout-api', [AuthController::class, 'logoutApi'])->name('logout.api');
Route::get('/check-auth', [AuthController::class, 'checkAuth'])->name('check.auth');
Route::post('/refresh-token', [AuthController::class, 'refresh'])->name('refresh.token');

// Rotas Protegidas
Route::middleware(['auth.jwt'])->group(function () {
    Route::get('/painel/cliente', [DashboardController::class, 'cliente'])
        ->name('painel.cliente');
    
    Route::get('/painel/freelancer', [DashboardController::class, 'freelancer'])
        ->name('painel.freelancer');
    
    Route::get('/api/freelancer/dashboard', [DashboardController::class, 'freelancerData'])
        ->name('api.freelancer.dashboard');
    
    Route::get('/api/cliente/dashboard', [DashboardController::class, 'clienteData'])
        ->name('api.cliente.dashboard');
});
```