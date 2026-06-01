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