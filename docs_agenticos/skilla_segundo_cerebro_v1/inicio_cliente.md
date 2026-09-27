App.templates.inicio = `

            <div id="view-inicio" class="flex-1 p-6 md:p-8 space-y-6 max-w-container-max mx-auto w-full">

                <!-- Greeting Section -->

                    <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-2">

                        <div>

                            <h2 class="text-headline-lg font-headline-lg text-on-surface mb-1" id="greeting-user-name">Olá, [Nome] 👋</h2>

                            <p class="text-body-md font-body-md text-secondary">Tens <span class="font-semibold text-primary" id="greeting-new-proposals-count">0</span> propostas novas à espera de revisão.</p>

                        </div>

                        <button class="bg-[#1A1A1A] text-white text-label-md font-label-md px-4 py-2 rounded-lg hover:bg-black transition-colors flex items-center gap-2">

                            <span class="material-symbols-outlined text-[18px]">add</span>

                            Publicar Trabalho

                        </button>

                    </div>

                <!-- Metrics Grid -->

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                    <!-- Card 1: Trabalhos Publicados -->

                    <div class="bg-white border border-border-subtle rounded-[12px] p-5 flex flex-col justify-between">

                        <div class="flex justify-between items-start mb-4">

                            <div class="p-2 bg-[#1E1E1E] rounded-lg">

                                <span class="material-symbols-outlined text-[#CCFF00]">work</span>

                            </div>

                        </div>

                        <div>

                            <h3 class="text-label-md font-label-md text-secondary uppercase tracking-wider mb-1">Trabalhos Publicados</h3>

                            <p class="text-metric-lg font-metric-lg text-on-surface" id="metric-published-jobs">0</p>

                        </div>

                    </div>

                    <!-- Card 2: Propostas Recebidas -->

                    <div class="bg-white border border-border-subtle rounded-[12px] p-5 flex flex-col justify-between">

                        <div class="flex justify-between items-start mb-4">

                            <div class="p-2 bg-[#1E1E1E] rounded-lg">

                                <span class="material-symbols-outlined text-[#CCFF00]">description</span>

                            </div>

                            <span class="bg-[#CCFF00] text-[#1A1A1A] text-label-sm font-label-sm px-2 py-0.5 rounded-full flex items-center gap-1 hidden" id="badge-new-proposals">

                                <span class="material-symbols-outlined text-[14px]">arrow_upward</span>

                                <span id="badge-new-proposals-count">0</span> novas

                            </span>

                        </div>

                        <div>

                            <h3 class="text-label-md font-label-md text-secondary uppercase tracking-wider mb-1">Propostas Recebidas</h3>

                            <p class="text-metric-lg font-metric-lg text-on-surface" id="metric-received-proposals">0</p>

                        </div>

                    </div>

  

                    <!-- Card 3: Em Andamento -->

                    <div class="bg-white border border-border-subtle rounded-[12px] p-5 flex flex-col justify-between">

                        <div class="flex justify-between items-start mb-4">

                            <div class="p-2 bg-[#1E1E1E] rounded-lg">

                                <span class="material-symbols-outlined text-[#CCFF00]">schedule</span>

                            </div>

                        </div>

                        <div>

                            <h3 class="text-label-md font-label-md text-secondary uppercase tracking-wider mb-1">Em Andamento</h3>

                            <p class="text-metric-lg font-metric-lg text-on-surface" id="metric-in-progress">0</p>

                        </div>

                    </div>

  

                    <!-- Card 4: Concluídos -->

                    <div class="bg-white border border-border-subtle rounded-[12px] p-5 flex flex-col justify-between">

                        <div class="flex justify-between items-start mb-4">

                            <div class="p-2 bg-[#1E1E1E] rounded-lg">

                                <span class="material-symbols-outlined text-[#CCFF00]">check_circle</span>

                            </div>

                        </div>

                        <div>

                            <h3 class="text-label-md font-label-md text-secondary uppercase tracking-wider mb-1">Concluídos</h3>

                            <p class="text-metric-lg font-metric-lg text-on-surface" id="metric-completed">0</p>

                        </div>

                    </div>

                </div>

                <!-- Sections 1 & 2 Row -->

                <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

                    <!-- A Minha Carteira (60%) -->

                    <div class="lg:col-span-3 bg-white border border-border-subtle rounded-[12px] p-6 flex flex-col">

                        <h3 class="text-headline-sm font-headline-sm mb-6">A Minha Carteira Skilla</h3>

                        <div class="flex-1 flex flex-col justify-center">

                            <div class="mb-6">

                                <p class="text-body-sm font-body-sm text-secondary mb-1">Saldo Disponível</p>

                                <p class="text-metric-lg font-metric-lg text-[#1A1A1A]" id="wallet-balance">0,00 KZS</p>

                            </div>

                            <div class="mb-8 bg-[#1A1A1A] p-4 rounded-lg">

                                <p class="text-body-sm font-body-sm text-[#CCFF00] mb-1">Em Escrow (Cativos)</p>

                                <p class="text-headline-md font-headline-md text-[#CCFF00]" id="escrow-amount">0,00 KZS</p>

                            </div>

                            <div class="mt-auto">

                                <button class="w-full sm:w-auto border border-[#1A1A1A] text-[#1A1A1A] hover:bg-gray-100 text-label-md font-label-md px-6 py-2.5 rounded-lg transition-colors">

                                    Recarregar Saldo

                                </button>

                            </div>

                        </div>

                    </div>

  

                    <!-- Requer a Tua Atenção (40%) -->

                    <div class="lg:col-span-2 bg-white border border-border-subtle rounded-[12px] p-6 flex flex-col">

                        <div class="flex items-center gap-2 mb-6">

                            <span class="material-symbols-outlined text-status-warning-text">warning</span>

                            <h3 class="text-headline-sm font-headline-sm">Requer a Tua Atenção</h3>

                        </div>

                        <!-- Container Dinâmico para Alertas -->

                        <div class="space-y-4 flex-1" id="attention-needed-container">

                            <!-- Será preenchido pelo JS -->

                        </div>

                    </div>

                </div>

                <!-- Os Meus Jobs Ativos -->

                <div class="bg-white border border-border-subtle rounded-[12px] overflow-hidden">

                    <div class="p-6 border-b border-border-subtle flex justify-between items-center bg-white">

                        <h3 class="text-headline-sm font-headline-sm text-[#1E1E1E]">Os Meus Trabalhos ativos</h3>

                        <a class="text-[#1A1A1A] text-label-md font-label-md hover:underline" href="#">Ver todos</a>

                    </div>

                    <!-- Container Dinâmico para Jobs Ativos -->

                    <div class="divide-y divide-border-subtle" id="active-jobs-container">

                        <!-- Será preenchido pelo JS -->

                    </div>

                </div>

                <!-- Two Columns Bottom -->

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    <!-- Últimas Propostas -->

                    <div class="bg-white border border-border-subtle rounded-[12px] flex flex-col">

                        <div class="p-6 border-b border-border-subtle">

                            <h3 class="text-headline-sm font-headline-sm">Últimas Propostas Recebidas</h3>

                        </div>

                        <!-- Container Dinâmico para Propostas -->

                        <div class="p-6 space-y-4" id="recent-proposals-container">

                            <!-- Será preenchido pelo JS -->

                        </div>

                    </div>

  

                    <!-- Últimas Movimentações -->

                    <div class="bg-white border border-border-subtle rounded-[12px] flex flex-col">

                        <div class="p-6 border-b border-border-subtle flex justify-between items-center">

                            <h3 class="text-headline-sm font-headline-sm">Últimas Movimentações</h3>

                            <a class="text-[#1A1A1A] text-label-md font-label-md hover:underline" href="#">Histórico</a>

                        </div>

                        <div class="p-0">

                            <table class="w-full text-left">

                                <tbody class="divide-y divide-border-subtle" id="recent-transactions-container">

                                    <!-- Será preenchido pelo JS -->

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

        `;