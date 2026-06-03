@extends('layouts.freelancer')

@section('title', 'Jobs - Skilla')

@section('content')
<div class="p-6 md:p-8 pb-24 md:pb-8">

    {{-- ===== BARRA DE BUSCA + PILLS ===== --}}
    <div class="mb-6">
        <form method="GET" action="{{ route('freelancer.jobs.index') }}" id="search-form">
            {{-- Preservar outros filtros --}}
            @foreach(request()->except(['search', 'page']) as $key => $value)
                @if(is_array($value))
                    @foreach($value as $v)
                        <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                    @endforeach
                @else
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endif
            @endforeach

            <div class="flex flex-col gap-4">
                {{-- Busca --}}
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">search</span>
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Pesquisar projetos, clientes..."
                           class="w-full pl-12 pr-4 py-4 rounded-2xl border-none bg-white text-black placeholder-gray-400 text-body-md focus:ring-2 focus:ring-black shadow-lg outline-none">
                </div>

                {{-- Pills de Categoria --}}
                <div class="flex overflow-x-auto gap-3 pb-1 scrollbar-hide">
                    @php
                        $categories = [
                            '' => 'Todos',
                            'design' => 'Design',
                            'desenvolvimento' => 'Desenvolvimento',
                            'mobile' => 'Mobile',
                            'video' => 'Vídeo',
                            'urgente' => '🔥 Urgente',
                            'remoto' => 'Remoto',
                            'luanda' => 'Luanda',
                        ];
                    @endphp
                    @foreach($categories as $value => $label)
                        <a href="{{ route('freelancer.jobs.index', array_merge(request()->except(['category', 'page']), $value ? ['category' => $value] : [])) }}"
                           class="px-5 py-2 rounded-full font-bold text-label-md whitespace-nowrap shadow-sm transition-colors flex items-center gap-1
                                  {{ request('category', '') === $value
                                     ? 'bg-black text-brand-lime'
                                     : 'bg-white text-black hover:bg-gray-100' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>
        </form>
    </div>

    {{-- ===== LAYOUT: FILTROS + CARDS ===== --}}
    <div class="flex flex-col lg:flex-row gap-6">

        {{-- ===== PAINEL DE FILTROS (25%) ===== --}}
        <aside class="w-full lg:w-1/4 shrink-0">
            <form method="GET" action="{{ route('freelancer.jobs.index') }}" id="filter-form">
                {{-- Preservar busca e categoria --}}
                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if(request('sort'))
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                @endif

                <div class="glass-card p-6 hard-shadow text-black sticky top-24">
                    {{-- Título --}}
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="font-headline-sm text-[20px] font-bold">Filtros</h2>
                        <a href="{{ route('freelancer.jobs.index') }}"
                           class="text-xs text-gray-500 hover:text-red-500 underline transition-colors">
                            Limpar
                        </a>
                    </div>

                    {{-- Orçamento --}}
                    <div class="mb-6">
                        <h3 class="font-label-md text-label-md font-bold uppercase tracking-wider mb-3 text-black">
                            Orçamento (Kz)
                        </h3>
                        <input type="range"
                               name="budget_max"
                               id="budget-slider"
                               min="10000"
                               max="500000"
                               step="5000"
                               value="{{ request('budget_max', 500000) }}"
                               class="w-full">
                        <div class="flex justify-between mt-2 text-xs text-gray-500">
                            <span>10K</span>
                            <span class="font-bold text-black" id="budget-display">
                                Até {{ number_format(request('budget_max', 500000), 0, ',', '.') }} Kz
                            </span>
                            <span>500K+</span>
                        </div>
                    </div>

                    <hr class="border-gray-100 mb-6">

                    {{-- Prazo --}}
                    <div class="mb-6">
                        <h3 class="font-label-md text-label-md font-bold uppercase tracking-wider mb-3 text-black">
                            Prazo
                        </h3>
                        <div class="flex flex-col gap-3">
                            @php
                                $prazos = [
                                    'menos-1-semana' => 'Menos de 1 semana',
                                    '1-4-semanas' => '1 a 4 semanas',
                                    '1-3-meses' => '1 a 3 meses',
                                    'mais-3-meses' => 'Mais de 3 meses',
                                ];
                            @endphp
                            @foreach($prazos as $value => $label)
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="checkbox"
                                           name="prazo[]"
                                           value="{{ $value }}"
                                           {{ in_array($value, (array) request('prazo', [])) ? 'checked' : '' }}
                                           class="w-4 h-4 rounded border-gray-300 accent-black">
                                    <span class="text-body-md text-gray-700 group-hover:text-black transition-colors">
                                        {{ $label }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <hr class="border-gray-100 mb-6">

                    {{-- Nível --}}
                    <div class="mb-6">
                        <h3 class="font-label-md text-label-md font-bold uppercase tracking-wider mb-3 text-black">
                            Nível de Experiência
                        </h3>
                        <div class="flex flex-col gap-3">
                            @foreach($levelCounts as $level => $count)
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="checkbox"
                                           name="nivel[]"
                                           value="{{ $level }}"
                                           {{ in_array($level, (array) request('nivel', [])) ? 'checked' : '' }}
                                           class="w-4 h-4 rounded border-gray-300 accent-black">
                                    <span class="text-body-md text-gray-700 group-hover:text-black transition-colors flex-1">
                                        {{ ucfirst($level) }}
                                    </span>
                                    <span class="text-xs text-gray-400 bg-gray-100 px-2 py-0.5 rounded-md">
                                        {{ $count }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <hr class="border-gray-100 mb-6">

                    {{-- Localização --}}
                    <div class="mb-6">
                        <h3 class="font-label-md text-label-md font-bold uppercase tracking-wider mb-3 text-black">
                            Localização
                        </h3>
                        <div class="flex flex-col gap-3">
                            @foreach($locationCounts as $location => $count)
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="checkbox"
                                           name="localizacao[]"
                                           value="{{ $location }}"
                                           {{ in_array($location, (array) request('localizacao', [])) ? 'checked' : '' }}
                                           class="w-4 h-4 rounded border-gray-300 accent-black">
                                    <span class="text-body-md text-gray-700 group-hover:text-black transition-colors flex-1">
                                        {{ $location }}
                                    </span>
                                    <span class="text-xs text-gray-400 bg-gray-100 px-2 py-0.5 rounded-md">
                                        {{ $count }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full py-3 bg-black text-white rounded-xl font-bold text-label-md hover:bg-gray-800 transition-colors shadow-md">
                        Aplicar Filtros
                    </button>
                </div>
            </form>
        </aside>

        {{-- ===== LISTA DE JOBS (75%) ===== --}}
        <section class="flex-1 flex flex-col gap-5">

            {{-- Barra de Ordenação --}}
            <div class="flex justify-between items-center bg-white/60 backdrop-blur-sm p-4 rounded-xl border border-white/40">
                <p class="font-body-md text-black font-medium">
                    <span class="font-bold">{{ $jobs->total() }}</span> projetos encontrados
                </p>
                <div class="flex items-center gap-2">
                    <span class="text-xs text-gray-700">Ordenar por:</span>
                    <select name="sort"
                            form="filter-form"
                            onchange="document.getElementById('filter-form').submit()"
                            class="bg-white border-none rounded-lg text-black font-medium text-xs focus:ring-0 py-2 pl-3 pr-8 shadow-sm cursor-pointer outline-none">
                        <option value="latest" {{ request('sort', 'latest') === 'latest' ? 'selected' : '' }}>
                            Mais recentes
                        </option>
                        <option value="budget_desc" {{ request('sort') === 'budget_desc' ? 'selected' : '' }}>
                            Maior orçamento
                        </option>
                        <option value="proposals_asc" {{ request('sort') === 'proposals_asc' ? 'selected' : '' }}>
                            Menos propostas
                        </option>
                    </select>
                </div>
            </div>

            {{-- Cards de Jobs --}}
            @forelse($jobs as $job)
                @include('freelancer.jobs._card', ['job' => $job])
            @empty
                <div class="glass-card p-12 hard-shadow text-center">
                    <span class="material-symbols-outlined text-6xl text-gray-300 mb-4 block">search_off</span>
                    <h3 class="font-headline-sm text-[20px] text-black mb-2">Nenhum job encontrado</h3>
                    <p class="text-gray-500 text-body-md">Tente ajustar os filtros ou pesquisa.</p>
                    <a href="{{ route('freelancer.jobs.index') }}"
                       class="inline-block mt-4 bg-black text-white px-6 py-3 rounded-xl font-bold text-label-md hover:bg-gray-800 transition-colors">
                        Ver todos os jobs
                    </a>
                </div>
            @endforelse

            {{-- Paginação --}}
            @if($jobs->hasPages())
                <div class="flex justify-center mt-6">
                    <div class="flex items-center gap-1 bg-white rounded-xl p-1 shadow-sm border border-gray-200">
                        {{-- Anterior --}}
                        @if($jobs->onFirstPage())
                            <span class="p-2 text-gray-300 cursor-not-allowed">
                                <span class="material-symbols-outlined">chevron_left</span>
                            </span>
                        @else
                            <a href="{{ $jobs->previousPageUrl() }}"
                               class="p-2 text-black hover:bg-gray-100 rounded-lg transition-colors">
                                <span class="material-symbols-outlined">chevron_left</span>
                            </a>
                        @endif

                        {{-- Números --}}
                        @foreach($jobs->getUrlRange(1, $jobs->lastPage()) as $page => $url)
                            @if($page === $jobs->currentPage())
                                <span class="w-10 h-10 rounded-lg bg-black text-white font-bold text-sm flex items-center justify-center">
                                    {{ $page }}
                                </span>
                            @elseif($page === 1 || $page === $jobs->lastPage() || abs($page - $jobs->currentPage()) <= 1)
                                <a href="{{ $url }}"
                                   class="w-10 h-10 rounded-lg text-black hover:bg-gray-100 font-bold text-sm flex items-center justify-center transition-colors">
                                    {{ $page }}
                                </a>
                            @elseif(abs($page - $jobs->currentPage()) === 2)
                                <span class="px-1 text-gray-400">...</span>
                            @endif
                        @endforeach

                        {{-- Próxima --}}
                        @if($jobs->hasMorePages())
                            <a href="{{ $jobs->nextPageUrl() }}"
                               class="p-2 text-black hover:bg-gray-100 rounded-lg transition-colors">
                                <span class="material-symbols-outlined">chevron_right</span>
                            </a>
                        @else
                            <span class="p-2 text-gray-300 cursor-not-allowed">
                                <span class="material-symbols-outlined">chevron_right</span>
                            </span>
                        @endif
                    </div>
                </div>
            @endif
        </section>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Range slider - atualizar display
    const slider = document.getElementById('budget-slider');
    const display = document.getElementById('budget-display');

    if (slider && display) {
        slider.addEventListener('input', function () {
            const value = parseInt(this.value);
            if (value >= 500000) {
                display.textContent = '500K+ Kz';
            } else {
                display.textContent = 'Até ' + value.toLocaleString('pt-AO') + ' Kz';
            }
        });
    }
</script>
@endpush