<article class="glass-card p-6 hard-shadow text-black transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl
                {{ $job->is_featured ? 'border-l-[6px] border-brand-orange relative' : 'border border-gray-100' }}">

    {{-- Badge Destaque --}}
    @if($job->is_featured)
        <div class="absolute -top-3 right-6 bg-brand-orange text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest shadow-md flex items-center gap-1">
            <span class="material-symbols-outlined text-[14px]">star</span> Destaque
        </div>
    @endif

    {{-- Badges de Urgência --}}
    @if($job->is_urgent)
        <div class="flex mb-3">
            <span class="bg-red-100 text-red-600 text-[10px] font-bold px-3 py-1 rounded-full border border-red-200 flex items-center gap-1">
                <span class="material-symbols-outlined text-[12px]">local_fire_department</span> URGENTE
            </span>
        </div>
    @endif

    {{-- Título + Preço --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-start gap-4 mb-4">
        <h3 class="font-headline-sm text-[20px] leading-tight font-bold group-hover:text-brand-orange transition-colors">
            {{ $job->title }}
        </h3>
        <div class="bg-gray-50 px-4 py-2 rounded-xl border border-gray-100 shrink-0 text-right">
            <span class="font-bold text-[18px] block">
                {{ number_format($job->budget, 0, ',', '.') }} Kz
            </span>
            <span class="text-[11px] text-gray-500 uppercase tracking-wide">
                {{ $job->budget_type === 'fixed' ? 'Orçamento Fixo' : 'Por hora' }}
            </span>
        </div>
    </div>

    {{-- Metadados --}}
    <div class="flex flex-wrap items-center gap-4 text-xs text-gray-500 mb-4">
        <div class="flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">location_on</span>
            {{ $job->location ?? 'Remoto' }}
        </div>
        <div class="flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">schedule</span>
            {{ $job->deadline_label }}
        </div>
        <div class="flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">work</span>
            {{ $job->project_type_label }}
        </div>
        @if($job->is_payment_verified)
            <div class="flex items-center gap-1 text-green-600">
                <span class="material-symbols-outlined text-[16px]">verified</span>
                Pagamento Verificado
            </div>
        @else
            <div class="flex items-center gap-1 text-gray-400">
                <span class="material-symbols-outlined text-[16px]">gpp_maybe</span>
                Pagamento Não Verificado
            </div>
        @endif
    </div>

    {{-- Descrição --}}
    <p class="text-body-md text-gray-600 mb-4 line-clamp-2">{{ $job->description }}</p>

    {{-- Tags de Skills --}}
    @if($job->skills->count() > 0)
        <div class="flex flex-wrap gap-2 mb-5">
            @foreach($job->skills->take(5) as $skill)
                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-lg text-xs border border-gray-200">
                    {{ $skill->name }}
                </span>
            @endforeach
            @if($job->skills->count() > 5)
                <span class="bg-gray-100 text-gray-500 px-3 py-1 rounded-lg text-xs border border-gray-200">
                    +{{ $job->skills->count() - 5 }}
                </span>
            @endif
        </div>
    @endif

    <hr class="border-gray-100 mb-4">

    {{-- Footer do Card --}}
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        {{-- Info do Cliente --}}
        <div class="flex items-center gap-3">
            @if($job->client->avatar_url)
                <img src="{{ $job->client->avatar_url }}"
                     alt="{{ $job->client->name }}"
                     class="w-10 h-10 rounded-full border-2 {{ $job->is_featured ? 'border-brand-orange' : 'border-gray-200' }} object-cover">
            @else
                <div class="w-10 h-10 rounded-full bg-brand-lime flex items-center justify-center font-bold text-black border-2 border-gray-200">
                    {{ strtoupper(substr($job->client->name, 0, 1)) }}
                </div>
            @endif
            <div>
                <p class="font-bold text-sm text-black">{{ $job->client->name }}</p>
                @if($job->client->rating > 0)
                    <div class="flex items-center gap-1 text-brand-orange">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="material-symbols-outlined text-[12px]"
                                  style="font-variation-settings: 'FILL' {{ $i <= $job->client->rating ? 1 : 0 }}">
                                star
                            </span>
                        @endfor
                        <span class="text-xs text-gray-500 ml-1">({{ $job->client->reviews_count }})</span>
                    </div>
                @else
                    <span class="text-xs text-gray-400">Cliente Novo</span>
                @endif
            </div>
        </div>

        {{-- Meta + Botão --}}
        <div class="flex items-center gap-4 w-full md:w-auto">
            <div class="text-right hidden md:block">
                <p class="font-bold text-sm text-black">{{ $job->proposals_count }} {{ $job->proposals_count === 1 ? 'proposta' : 'propostas' }}</p>
                <p class="text-xs text-gray-500">{{ $job->created_at->diffForHumans() }}</p>
            </div>
            <a href="{{ route('freelancer.jobs.show', $job->id) }}"
               class="flex-1 md:flex-none border-2 border-black text-black px-6 py-2 rounded-xl font-bold text-sm hover:bg-black hover:text-white transition-colors text-center whitespace-nowrap">
                Ver job
            </a>
        </div>
    </div>
</article>