@extends('layouts.freelancer')

@section('title', $job->title . ' - Skilla')

@section('content')
<div class="p-6 md:p-8 pb-24 md:pb-8 max-w-7xl mx-auto">

    {{-- Breadcrumbs --}}
    <div class="mb-6 flex flex-col gap-1">
        <a href="{{ route('freelancer.jobs.index') }}"
           class="inline-flex items-center gap-2 text-black font-bold text-sm hover:opacity-70 transition-opacity">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            Voltar ao feed
        </a>
        <nav class="text-xs text-black/60 flex items-center gap-1 flex-wrap">
            <a href="{{ route('freelancer.dashboard') }}" class="hover:underline">Início</a>
            <span>&rsaquo;</span>
            <a href="{{ route('freelancer.jobs.index') }}" class="hover:underline">Jobs</a>
            <span>&rsaquo;</span>
            <a href="{{ route('freelancer.jobs.index', ['category' => $job->category->slug ?? '']) }}"
               class="hover:underline">{{ $job->category->name ?? 'Geral' }}</a>
            <span>&rsaquo;</span>
            <span class="text-black font-medium truncate max-w-[200px]">{{ $job->title }}</span>
        </nav>
    </div>

    {{-- Layout: 70/30 --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        {{-- ===== COLUNA PRINCIPAL (70%) ===== --}}
        <div class="lg:col-span-8 flex flex-col gap-6">

            {{-- Card Monolítico Principal --}}
            <div class="glass-card hard-shadow overflow-hidden">
                <div class="p-8">

                    {{-- Header do Job --}}
                    <div class="pb-8">
                        <div class="flex justify-between items-start mb-4">
                            <span class="inline-block bg-brand-lime text-black text-xs font-bold px-3 py-1 rounded-full">
                                {{ $job->category->name ?? 'Geral' }}
                            </span>
                            <div class="flex gap-2">
                                <button onclick="copyJobLink()"
                                        title="Copiar link"
                                        class="text-gray-400 hover:text-black transition-colors p-1 rounded-lg hover:bg-gray-100">
                                    <span class="material-symbols-outlined text-[20px]">link</span>
                                </button>
                                <button onclick="saveJob({{ $job->id }})"
                                        id="save-btn-{{ $job->id }}"
                                        title="Guardar job"
                                        class="text-gray-400 hover:text-black transition-colors p-1 rounded-lg hover:bg-gray-100">
                                    <span class="material-symbols-outlined text-[20px]">push_pin</span>
                                </button>
                            </div>
                        </div>

                        <h1 class="font-display-lg text-2xl md:text-3xl font-bold text-black mb-5 leading-tight">
                            {{ $job->title }}
                        </h1>

                        <div class="flex flex-wrap gap-4 text-sm text-black">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px] text-gray-500">location_on</span>
                                {{ $job->location ?? 'Remoto' }}
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px] text-gray-500">schedule</span>
                                Prazo: {{ $job->deadline_label }}
                            </div>
                            @if($job->proposals_open)
                                <div class="flex items-center gap-2 text-green-600 font-bold">
                                    <span class="material-symbols-outlined text-[18px]">bolt</span>
                                    Aberto a propostas
                                </div>
                            @else
                                <div class="flex items-center gap-2 text-red-500 font-bold">
                                    <span class="material-symbols-outlined text-[18px]">block</span>
                                    Fechado
                                </div>
                            @endif
                            <div class="flex items-center gap-2 text-gray-500">
                                <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                                Publicado {{ $job->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>

                    {{-- Badges de Status --}}
                    <div class="flex flex-wrap gap-2 pb-8">
                        @if($job->accepts_multicaixa)
                            <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-700 text-xs font-bold px-3 py-1.5 rounded-full border border-gray-200">
                                <span class="material-symbols-outlined text-[14px]">credit_card</span>
                                Multicaixa Express
                            </span>
                        @endif
                        @if($job->client->is_verified)
                            <span class="inline-flex items-center gap-1 bg-green-50 text-green-700 text-xs font-bold px-3 py-1.5 rounded-full border border-green-200">
                                <span class="material-symbols-outlined text-[14px]">verified_user</span>
                                Cliente Verificado
                            </span>
                        @endif
                        @if($job->is_featured)
                            <span class="inline-flex items-center gap-1 bg-yellow-50 text-yellow-700 text-xs font-bold px-3 py-1.5 rounded-full border border-yellow-200">
                                <span class="material-symbols-outlined text-[14px]">star</span>
                                Job em Destaque
                            </span>
                        @endif
                        @if($job->is_urgent)
                            <span class="inline-flex items-center gap-1 bg-red-50 text-red-600 text-xs font-bold px-3 py-1.5 rounded-full border border-red-200">
                                <span class="material-symbols-outlined text-[14px]">local_fire_department</span>
                                Urgente
                            </span>
                        @endif
                    </div>

                    <hr class="border-gray-100">

                    {{-- Descrição --}}
                    <div class="py-8">
                        <h2 class="font-headline-sm text-[20px] font-bold text-black mb-4">
                            Descrição do Projeto
                        </h2>
                        <div class="text-body-md text-gray-700 space-y-4 leading-relaxed break-words">
                            {!! nl2br(e($job->description)) !!}
                        </div>
                    </div>

                    <hr class="border-gray-100">

                    {{-- Entregáveis --}}
                    @if($job->deliverables->count() > 0)
                        <div class="py-8">
                            <h2 class="font-headline-sm text-[20px] font-bold text-black mb-4">
                                O que precisamos (Entregáveis)
                            </h2>
                            <ul class="flex flex-col gap-4">
                                @foreach($job->deliverables as $deliverable)
                                    <li class="flex items-start gap-3">
                                        <span class="material-symbols-outlined text-green-600 text-[22px] shrink-0 mt-0.5"
                                              style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                        <span class="text-body-md text-gray-700 break-words leading-relaxed">
                                            {{ $deliverable->description }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <hr class="border-gray-100">
                    @endif

                    {{-- Skills --}}
                    @if($job->skills->count() > 0)
                        <div class="py-8">
                            <h2 class="font-headline-sm text-[20px] font-bold text-black mb-4">
                                Competências necessárias
                            </h2>
                            <div class="flex flex-wrap gap-3">
                                @foreach($job->skills as $skill)
                                    <span class="px-4 py-2 bg-gray-100 border border-gray-200 rounded-full text-xs font-bold text-gray-700">
                                        {{ $skill->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        <hr class="border-gray-100">
                    @endif

                    {{-- Perguntas de Triagem --}}
                    @if($job->screeningQuestions->count() > 0)
                        <div class="pt-8">
                            <h2 class="font-headline-sm text-[20px] font-bold text-black mb-2 flex items-center gap-2">
                                <span class="material-symbols-outlined text-brand-orange">help</span>
                                Perguntas de triagem
                            </h2>
                            <p class="text-body-md text-gray-500 mb-5">
                                Terá de responder a estas perguntas ao enviar a sua proposta:
                            </p>
                            <div class="flex flex-col gap-4">
                                @foreach($job->screeningQuestions as $index => $question)
                                    <div class="bg-gray-50 border-l-4 border-brand-orange p-4 rounded-r-xl">
                                        <p class="text-body-md text-black font-semibold leading-relaxed break-words">
                                            {{ $index + 1 }}. {{ $question->question }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ===== PROPOSTAS RECEBIDAS ===== --}}
            @if($job->proposals->count() > 0)
                <div class="glass-card p-6 md:p-8 hard-shadow">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="font-headline-sm text-[20px] font-bold text-black flex items-center gap-2">
                            <span class="material-symbols-outlined">forum</span>
                            Propostas recebidas ({{ $job->proposals->count() }})
                        </h2>
                    </div>

                    <div class="flex flex-col gap-6">
                        @foreach($job->proposals->take(3) as $proposal)
                            <div class="border border-gray-100 rounded-2xl p-6 hover:border-gray-300 transition-colors">
                                {{-- Header da Proposta --}}
                                <div class="flex justify-between items-start gap-4 mb-4">
                                    <div class="flex items-center gap-3">
                                        @if($proposal->freelancer->avatar_url)
                                            <img src="{{ $proposal->freelancer->avatar_url }}"
                                                 alt="{{ $proposal->freelancer->name }}"
                                                 class="w-12 h-12 rounded-full object-cover border border-gray-200 shrink-0">
                                        @else
                                            <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center font-bold text-black border border-gray-200 shrink-0">
                                                {{ strtoupper(substr($proposal->freelancer->name, 0, 2)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <div class="flex items-center gap-2 flex-wrap">
                                                <p class="font-bold text-black text-sm">
                                                    {{ $proposal->freelancer->name }}
                                                </p>
                                                @if($proposal->freelancer->rating > 0)
                                                    <span class="text-yellow-500 text-sm font-bold">
                                                        ⭐ {{ number_format($proposal->freelancer->rating, 1) }}
                                                    </span>
                                                @endif
                                            </div>
                                            @if($proposal->freelancer->completed_jobs_count > 0)
                                                <p class="text-xs text-gray-500">
                                                    +{{ $proposal->freelancer->completed_jobs_count }} trabalhos realizados
                                                </p>
                                            @endif
                                            <p class="text-xs text-gray-700 font-bold mt-0.5">
                                                {{ $proposal->freelancer->title ?? 'Freelancer' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-right shrink-0">
                                        <p class="font-bold text-black text-lg">
                                            {{ number_format($proposal->amount, 0, ',', '.') }} Kz
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            em {{ $proposal->delivery_days }} {{ $proposal->delivery_days === 1 ? 'dia' : 'dias' }}
                                        </p>
                                    </div>
                                </div>

                                {{-- Pitch --}}
                                @if($proposal->cover_letter)
                                    <p class="text-body-md text-gray-600 line-clamp-3 mb-4 leading-relaxed">
                                        {{ $proposal->cover_letter }}
                                    </p>
                                @endif

                                {{-- Footer --}}
                                <div class="flex justify-between items-center pt-2 border-t border-gray-100">
                                    @if($proposal->accepts_multicaixa)
                                        <span class="inline-flex items-center gap-1 bg-red-50 text-red-600 text-[10px] font-bold px-2 py-1 rounded-full border border-red-100">
                                            <span class="w-1.5 h-1.5 bg-red-600 rounded-full"></span>
                                            Multicaixa
                                        </span>
                                    @else
                                        <span></span>
                                    @endif
                                    <a href="{{ route('freelancer.profile.show', $proposal->freelancer->id) }}"
                                       class="bg-black text-white px-5 py-2 rounded-xl text-xs font-bold hover:bg-gray-800 transition-colors">
                                        Ver perfil
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($job->proposals->count() > 3)
                        <div class="flex justify-center mt-6">
                            <a href="#all-proposals"
                               class="font-bold text-black text-sm hover:underline flex items-center gap-2">
                                Ver todas as {{ $job->proposals->count() }} propostas
                                <span class="material-symbols-outlined text-[18px]">arrow_downward</span>
                            </a>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        {{-- ===== SIDEBAR DIREITA (30%) ===== --}}
        <div class="lg:col-span-4 flex flex-col gap-6">

            {{-- Card de Orçamento + CTA --}}
            <div class="glass-card p-6 hard-shadow sticky top-24 flex flex-col gap-6">
                {{-- Orçamento --}}
                <div>
                    <span class="text-xs text-gray-500 uppercase tracking-wider font-bold">Orçamento Fixo</span>
                    <h2 class="text-4xl font-black text-black mt-1 leading-none">
                        {{ number_format($job->budget, 0, ',', '.') }} Kz
                    </h2>
                    <div class="flex flex-wrap gap-2 mt-3">
                        @if($job->accepts_multicaixa)
                            <span class="bg-gray-100 text-gray-700 text-[10px] font-bold px-2 py-1 rounded border border-gray-200">
                                Multicaixa Express
                            </span>
                        @endif
                        <span class="bg-gray-100 text-gray-700 text-[10px] font-bold px-2 py-1 rounded border border-gray-200">
                            {{ $job->deadline_label }}
                        </span>
                    </div>
                </div>

                {{-- Estatísticas --}}
                <div class="grid grid-cols-3 gap-4 border-y border-gray-100 py-5">
                    <div class="flex flex-col items-center gap-1">
                        <span class="text-xs text-gray-500 text-center leading-tight">Visualizações</span>
                        <span class="font-black text-xl text-black">{{ $job->views_count }}</span>
                    </div>
                    <div class="flex flex-col items-center gap-1">
                        <span class="text-xs text-gray-500 text-center leading-tight">Propostas</span>
                        <span class="font-black text-xl text-black">{{ $job->proposals_count }}</span>
                    </div>
                    <div class="flex flex-col items-center gap-1">
                        <span class="text-xs text-gray-500 text-center leading-tight">Entrevistas</span>
                        <span class="font-black text-xl text-black">{{ $job->interviews_count ?? 0 }}</span>
                    </div>
                </div>

                {{-- CTAs --}}
                <div class="flex flex-col gap-3">
                    @if($job->proposals_open)
                        @if($alreadyApplied)
                            <button disabled
                                    class="w-full bg-gray-200 text-gray-500 py-4 rounded-xl font-bold text-sm cursor-not-allowed flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                Proposta Enviada
                            </button>
                        @else
                            <button onclick="openProposalModal({{ $job->id }})"
                                    class="w-full bg-brand-orange text-white py-4 rounded-xl font-bold text-lg hover:bg-orange-600 transition-colors shadow-md flex items-center justify-center gap-2">
                                Enviar Proposta
                            </button>
                        @endif
                    @else
                        <button disabled
                                class="w-full bg-gray-200 text-gray-500 py-4 rounded-xl font-bold text-sm cursor-not-allowed">
                            Projeto Encerrado
                        </button>
                    @endif

                    <button onclick="toggleSaveJob({{ $job->id }})"
                            id="save-job-btn"
                            class="w-full border-2 border-black text-black py-3.5 rounded-xl font-bold text-sm hover:bg-black hover:text-white transition-colors flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">{{ $isSaved ? 'favorite' : 'favorite_border' }}</span>
                        {{ $isSaved ? 'Job Guardado' : 'Guardar Trabalho' }}
                    </button>
                </div>
            </div>

            {{-- Card do Cliente --}}
            <div class="glass-card p-6 hard-shadow">
                <h3 class="font-bold text-black text-[18px] mb-5">Sobre o Cliente</h3>
                <div class="flex items-center gap-3 mb-5">
                    @if($job->client->avatar_url)
                        <img src="{{ $job->client->avatar_url }}"
                             alt="{{ $job->client->name }}"
                             class="w-14 h-14 rounded-full object-cover border border-gray-200 shrink-0">
                    @else
                        <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center font-black text-xl text-blue-800 border border-blue-200 shrink-0">
                            {{ strtoupper(substr($job->client->name, 0, 2)) }}
                        </div>
                    @endif
                    <div>
                        <p class="font-bold text-black">{{ $job->client->name }}</p>
                        <p class="text-xs text-gray-500 flex items-center gap-1 mt-0.5">
                            <span class="material-symbols-outlined text-[14px]">location_on</span>
                            {{ $job->client->location ?? 'Angola' }}
                        </p>
                    </div>
                </div>

                <div class="flex flex-col gap-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Trabalhos publicados</span>
                        <span class="font-bold text-black">{{ $job->client->jobs_count ?? 0 }}</span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Taxa de contratação</span>
                            <span class="font-bold text-black">{{ $job->client->hire_rate ?? 0 }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 h-2 rounded-full overflow-hidden">
                            <div class="bg-green-500 h-full rounded-full"
                                 style="width: {{ $job->client->hire_rate ?? 0 }}%"></div>
                        </div>
                    </div>
                    @if($job->client->rating > 0)
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Avaliação Média</span>
                            <span class="font-bold text-yellow-500">
                                ⭐ {{ number_format($job->client->rating, 1) }}
                                ({{ $job->client->reviews_count }} reviews)
                            </span>
                        </div>
                    @endif
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Membro desde</span>
                        <span class="font-bold text-black">
                            {{ $job->client->created_at->format('M Y') }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Jobs Similares --}}
            @if($similarJobs->count() > 0)
                <div class="glass-card p-6 hard-shadow">
                    <h3 class="font-bold text-black text-[18px] mb-4">Trabalhos Semelhantes</h3>
                    <div class="flex flex-col gap-4">
                        @foreach($similarJobs as $similar)
                            <a href="{{ route('freelancer.jobs.show', $similar->id) }}"
                               class="group flex flex-col gap-1 pb-4 border-b border-gray-100 last:border-0 last:pb-0">
                                <p class="font-bold text-black text-sm group-hover:text-brand-orange transition-colors line-clamp-2 leading-snug">
                                    {{ $similar->title }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    KZS {{ number_format($similar->budget, 0, ',', '.') }}
                                    &bull; {{ $similar->created_at->diffForHumans() }}
                                </p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- ===== MODAL DE PROPOSTA ===== --}}
<div id="proposal-modal"
     class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[100] hidden items-center justify-center p-4"
     onclick="closeModalOnBackdrop(event)">
    <div class="bg-white rounded-3xl p-8 w-full max-w-2xl max-h-[90vh] overflow-y-auto shadow-2xl"
         id="proposal-modal-content">

        <div class="flex justify-between items-start mb-6">
            <div>
                <h2 class="font-bold text-black text-2xl">Enviar Proposta</h2>
                <p class="text-gray-500 text-sm mt-1">{{ $job->title }}</p>
            </div>
            <button onclick="closeProposalModal()"
                    class="text-gray-400 hover:text-black transition-colors p-1 rounded-lg hover:bg-gray-100">
                <span class="material-symbols-outlined text-[24px]">close</span>
            </button>
        </div>

        <form id="proposal-form"
              action="{{ route('freelancer.proposals.store') }}"
              method="POST"
              class="flex flex-col gap-5">
            @csrf
            <input type="hidden" name="job_id" value="{{ $job->id }}">

            {{-- Valor da Proposta --}}
            <div>
                <label class="block text-sm font-bold text-black mb-2">
                    Valor da Proposta (Kz) <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-bold text-sm">Kz</span>
                    <input type="number"
                           name="amount"
                           min="1"
                           placeholder="Ex: 75000"
                           required
                           class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl text-black font-bold text-lg focus:border-black focus:ring-0 outline-none transition-colors">
                </div>
                <p class="text-xs text-gray-400 mt-1">
                    Orçamento do cliente: {{ number_format($job->budget, 0, ',', '.') }} Kz
                </p>
            </div>

            {{-- Prazo --}}
            <div>
                <label class="block text-sm font-bold text-black mb-2">
                    Prazo de Entrega (dias) <span class="text-red-500">*</span>
                </label>
                <input type="number"
                       name="delivery_days"
                       min="1"
                       placeholder="Ex: 14"
                       required
                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-black focus:border-black focus:ring-0 outline-none transition-colors">
            </div>

            {{-- Carta de Apresentação --}}
            <div>
                <label class="block text-sm font-bold text-black mb-2">
                    Carta de Apresentação <span class="text-red-500">*</span>
                </label>
                <textarea name="cover_letter"
                          rows="5"
                          required
                          placeholder="Apresente-se e explique porque é o candidato ideal para este projeto..."
                          class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-black focus:border-black focus:ring-0 outline-none transition-colors resize-none leading-relaxed"></textarea>
            </div>

            {{-- Perguntas de Triagem no Modal --}}
            @if($job->screeningQuestions->count() > 0)
                <div class="bg-gray-50 rounded-xl p-4">
                    <h3 class="font-bold text-black text-sm mb-3 flex items-center gap-2">
                        <span class="material-symbols-outlined text-brand-orange text-[18px]">help</span>
                        Responda às perguntas de triagem:
                    </h3>
                    <div class="flex flex-col gap-4">
                        @foreach($job->screeningQuestions as $index => $question)
                            <div>
                                <label class="block text-sm font-medium text-black mb-2">
                                    {{ $index + 1 }}. {{ $question->question }}
                                </label>
                                <textarea name="screening_answers[{{ $question->id }}]"
                                          rows="2"
                                          required
                                          class="w-full px-3 py-2 border border-gray-200 rounded-lg text-black text-sm focus:border-black focus:ring-0 outline-none resize-none"></textarea>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Botões --}}
            <div class="flex gap-3 pt-2">
                <button type="button"
                        onclick="closeProposalModal()"
                        class="flex-1 border-2 border-gray-300 text-gray-700 py-3 rounded-xl font-bold text-sm hover:border-black hover:text-black transition-colors">
                    Cancelar
                </button>
                <button type="submit"
                        id="submit-proposal-btn"
                        class="flex-1 bg-brand-orange text-white py-3 rounded-xl font-bold text-sm hover:bg-orange-600 transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">send</span>
                    Enviar Proposta
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // ===== MODAL DE PROPOSTA =====
    function openProposalModal() {
        const modal = document.getElementById('proposal-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeProposalModal() {
        const modal = document.getElementById('proposal-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    function closeModalOnBackdrop(event) {
        if (event.target === document.getElementById('proposal-modal')) {
            closeProposalModal();
        }
    }

    // ===== ENVIO DA PROPOSTA VIA AJAX =====
    document.getElementById('proposal-form')?.addEventListener('submit', async function(e) {
        e.preventDefault();

        const btn = document.getElementById('submit-proposal-btn');
        btn.disabled = true;
        btn.innerHTML = '<span class="material-symbols-outlined text-[18px] animate-spin">progress_activity</span> A enviar...';

        const formData = new FormData(this);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        try {
            const response = await fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok && data.success) {
                closeProposalModal();
                showToast('✅ Proposta enviada com sucesso!', 'success');

                // Atualizar botão de envio
                const sendBtn = document.querySelector('[onclick*="openProposalModal"]');
                if (sendBtn) {
                    sendBtn.disabled = true;
                    sendBtn.className = 'w-full bg-gray-200 text-gray-500 py-4 rounded-xl font-bold text-sm cursor-not-allowed flex items-center justify-center gap-2';
                    sendBtn.innerHTML = '<span class="material-symbols-outlined text-[18px]">check_circle</span> Proposta Enviada';
                }

                // Atualizar contador de propostas
                const countEl = document.querySelector('[data-proposals-count]');
                if (countEl) {
                    countEl.textContent = parseInt(countEl.textContent) + 1;
                }
            } else {
                showToast(data.message ?? 'Erro ao enviar proposta.', 'error');
            }
        } catch (error) {
            showToast('Erro de conexão. Tente novamente.', 'error');
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<span class="material-symbols-outlined text-[18px]">send</span> Enviar Proposta';
        }
    });

    // ===== GUARDAR JOB =====
    async function toggleSaveJob(jobId) {
        const btn = document.getElementById('save-job-btn');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        try {
            const response = await fetch(`/freelancer/jobs/${jobId}/save`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            const data = await response.json();

            if (data.saved) {
                btn.innerHTML = '<span class="material-symbols-outlined text-[18px]" style="font-variation-settings: \'FILL\' 1">favorite</span> Job Guardado';
                showToast('❤️ Job guardado!', 'success');
            } else {
                btn.innerHTML = '<span class="material-symbols-outlined text-[18px]">favorite_border</span> Guardar Trabalho';
                showToast('Job removido dos guardados.', 'info');
            }
        } catch {
            showToast('Erro ao guardar job.', 'error');
        }
    }

    // ===== COPIAR LINK =====
    function copyJobLink() {
        navigator.clipboard.writeText(window.location.href);
        showToast('🔗 Link copiado!', 'success');
    }

    // ===== SISTEMA DE TOAST =====
    function showToast(message, type = 'success') {
        const colors = {
            success: 'bg-black text-brand-lime',
            error: 'bg-red-600 text-white',
            info: 'bg-gray-800 text-white'
        };

        const toast = document.createElement('div');
        toast.className = `fixed bottom-24 md:bottom-8 left-1/2 -translate-x-1/2 z-[200] px-6 py-3 rounded-full font-bold text-sm shadow-xl ${colors[type]} transition-all duration-300 opacity-0 translate-y-4`;
        toast.textContent = message;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.classList.remove('opacity-0', 'translate-y-4');
        }, 10);

        setTimeout(() => {
            toast.classList.add('opacity-0', 'translate-y-4');
            setTimeout(() => toast.remove(), 300);
        }, 3500);
    }

    // Fechar modal com ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeProposalModal();
    });
</script>
@endpush