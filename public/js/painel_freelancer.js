document.addEventListener('DOMContentLoaded', function() {
     const navLinks = document.querySelectorAll('.nav-link');
    const contentArea = document.getElementById('dynamic-content');

    // 1. Definição dos conteúdos de cada página (Simulando módulos)
    const pages = {
        home: `
            <!-- Copie aqui todo o HTML original do seu dashboard (do Page Header até as recomendações) -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
                <div>
                    <h2 class="font-headline-md text-headline-md text-black-pure mb-2">Bom dia, [Nome] 👋</h2>
                    <p class="font-body-lg text-body-lg text-black-pure opacity-80">Aqui está o resumo da sua atividade</p>
                </div>
                <button class="bg-black-pure text-white px-6 py-3 rounded-full font-label-md text-label-md font-bold flex items-center gap-2 hover:bg-surface-container-highest transition-colors">
                    Explorar Trabalhos <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                </button>
            </div>
            <!-- ... restante dos KPIs e Jobs ... -->
        `,
        jobs: `
            <div class="flex flex-col gap-6">
                <h2 class="font-headline-md text-headline-md text-black-pure">Explorar Trabalhos</h2>
                <p class="text-black-pure">Lista de trabalhos disponíveis será carregada aqui...</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="glass-card p-6 hard-shadow">Job Exemplo 1</div>
                    <div class="glass-card p-6 hard-shadow">Job Exemplo 2</div>
                </div>
            </div>
        `,
        proposals: `
            <div class="flex flex-col gap-6">
                <h2 class="font-headline-md text-headline-md text-black-pure">Minhas Propostas</h2>
                <p class="text-black-pure">Aqui você gerencia as propostas enviadas.</p>
            </div>
        `,
        messages: `
            <div class="flex flex-col gap-6">
                <h2 class="font-headline-md text-headline-md text-black-pure">Mensagens</h2>
                <p class="text-black-pure">Sua caixa de entrada de chat.</p>
            </div>
        `
    };

    // 2. Função para mudar de página
    function navigateTo(pageId) {
        // Trocar conteúdo
        if (pages[pageId]) {
            contentArea.innerHTML = pages[pageId];
        } else {
            contentArea.innerHTML = `<h2 class="text-black-pure">Página ${pageId} em construção...</h2>`;
        }

        // Atualizar Estilo dos Botões
        navLinks.forEach(link => {
            if (link.getAttribute('data-page') === pageId) {
                // Estilo Ativo (Verde)
                link.classList.add('bg-[#CCFF00]', 'text-black-pure', 'font-bold');
                link.classList.remove('text-on-primary-container', 'hover:text-secondary');
            } else {
                // Estilo Inativo
                link.classList.remove('bg-[#CCFF00]', 'text-black-pure', 'font-bold');
                link.classList.add('text-on-primary-container', 'hover:text-secondary');
            }
        });
    }

    // 3. Adicionar eventos de clique
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const pageId = link.getAttribute('data-page');
            navigateTo(pageId);
        });
    });
    // --- Funções Utilitárias Compartilhadas ---
    function formatCurrency(value) {
        return new Intl.NumberFormat('pt-AO', {
            style: 'currency',
            currency: 'AOA',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(value).replace('AOA', 'KZS');
    }

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

    async function fetchDashboardData() {
        try {
            const response = await fetch('/api/freelancer/dados', {
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

    // --- Lógica Específica do FREELANCER ---
    function fillFreelancerDashboard(data) {
        if (!data) return;

        // Preencher nome do usuário com saudação por horário
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
            if (element) element.textContent = value;
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
    fetchDashboardData().then(data => fillFreelancerDashboard(data));
});