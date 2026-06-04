document.addEventListener('DOMContentLoaded', function() {
    // --- Funções Utilitárias Compartilhadas ---
    function formatCurrency(value) {
        return new Intl.NumberFormat('pt-AO', {
            style: 'currency',
            currency: 'AOA',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(value).replace('AOA', 'KZS');
    }

    async function fetchDashboardData() {
        try {
            const response = await fetch('/api/cliente/dados', {
                method: 'GET',
                credentials: 'include', // 👈 ISTO É O PROBLEMA
                headers: {
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error('Falha ao carregar dados do painel');
            return await response.json();
        } catch (error) {
            console.error('Erro ao buscar dados:', error);
            return null;
        }
    }
    async function logout(event) {
    // Impede o comportamento padrão do link (recarregar a página ou ir para #)
    event.preventDefault();
    
    // Tenta obter o token CSRF do meta tag (padrão do Laravel)
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    const response = await fetch('/logout-api', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'Content-Type': 'application/json' // Recomendado adicionar
        }
    });
    
    // Se a resposta for ok (status 200-299), redireciona para o login
    if (response.ok) {
        window.location.href = '/login';
    } else {
        console.error('Erro ao terminar sessão');
    }
}

    // --- Lógica Específica do CLIENTE ---
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
            if (element) element.textContent = value;
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
    

    // Inicializar
    fetchDashboardData().then(data => fillClientDashboard(data));
});