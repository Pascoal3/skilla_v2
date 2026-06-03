<?php

namespace App\Http\Controllers;

use App\Services\JobService;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\SavedJob;
use App\Models\Proposal;
use Illuminate\Http\Request;

class JobController extends Controller {
    protected $jobService;

    public function __construct(JobService $jobService) {
        $this->jobService = $jobService;
    }

    // Lista jobs abertos para freelancers
    public function index() {
        $jobs = Job::with(['client', 'category'])
                   ->where('status', 'aberto')
                   ->orderBy('created_at', 'desc')
                   ->paginate(15);
        return response()->json($jobs);
    }

    // Salvar rascunho (Passo a passo do Wizard)
    public function store(Request $request) {
        // Simulando auth id, substitua por Auth::id()
        $clientId = $request->header('X-User-Id'); 
        $job = $this->jobService->saveDraft($request->all(), $clientId, $request->id);
        return response()->json($job);
    }

    // Publicar o Job
    public function publish(Request $request, $id) {
        try {
            $job = Job::findOrFail($id);
            // Verifica se o job pertence ao cliente logado
            if ($job->cliente_id !== $request->header('X-User-Id')) {
                return response()->json(['error' => 'Não autorizado'], 403);
            }

            $publishedJob = $this->jobService->publishJob($job, $request->all());
            return response()->json($publishedJob);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    // Vincular habilidades ao Job
    public function updateSkills(Request $request, $id) {
        $job = Job::findOrFail($id);
        $this->jobService->syncJobSkills($job, $request->skills);
        return response()->json(['message' => 'Habilidades vinculadas com sucesso!']);
    }
    /**
     * Feed de Jobs com filtros
     */
    public function index2(Request $request)
    {
        $query = Job::query()
            ->with(['client', 'skills', 'category'])
            ->withCount('proposals')
            ->where('status', 'open');

        // Busca textual
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Filtro por categoria
        if ($request->filled('category')) {
            if ($request->category === 'urgente') {
                $query->where('is_urgent', true);
            } elseif ($request->category === 'remoto') {
                $query->where('is_remote', true);
            } else {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('slug', $request->category);
                });
            }
        }

        // Filtro de orçamento máximo
        if ($request->filled('budget_max') && $request->budget_max < 500000) {
            $query->where('budget', '<=', $request->budget_max);
        }

        // Filtro de prazo
        if ($request->filled('prazo')) {
            $prazos = (array) $request->prazo;
            $query->where(function ($q) use ($prazos) {
                foreach ($prazos as $prazo) {
                    $q->orWhere('deadline_type', $prazo);
                }
            });
        }

        // Filtro de nível
        if ($request->filled('nivel')) {
            $query->whereIn('experience_level', (array) $request->nivel);
        }

        // Filtro de localização
        if ($request->filled('localizacao')) {
            $query->whereIn('location', (array) $request->localizacao);
        }

        // Ordenação
        match ($request->get('sort', 'latest')) {
            'budget_desc'    => $query->orderBy('budget', 'desc'),
            'proposals_asc'  => $query->orderBy('proposals_count', 'asc'),
            default          => $query->orderBy('is_featured', 'desc')
                                      ->orderBy('created_at', 'desc'),
        };

        $jobs = $query->paginate(10)->withQueryString();

        // Dados para os filtros (contagens)
        $levelCounts = Job::where('status', 'open')
            ->selectRaw('experience_level, count(*) as count')
            ->groupBy('experience_level')
            ->pluck('count', 'experience_level');

        $locationCounts = Job::where('status', 'open')
            ->selectRaw('location, count(*) as count')
            ->whereNotNull('location')
            ->groupBy('location')
            ->orderByDesc('count')
            ->limit(8)
            ->pluck('count', 'location');

        return view('freelancer.jobs.index', compact(
            'jobs',
            'levelCounts',
            'locationCounts'
        ));
    }

    /**
     * Detalhe de um Job
     */
    public function show(Job $job)
    {
        // Incrementar views (evitar duplicatas com session)
        $viewKey = 'job_viewed_' . $job->id;
        if (!session()->has($viewKey)) {
            $job->increment('views_count');
            session()->put($viewKey, true);
        }

        $job->load([
            'client',
            'skills',
            'category',
            'deliverables',
            'screeningQuestions',
            'proposals.freelancer',
        ]);

        // Jobs similares
        $similarJobs = Job::where('status', 'open')
            ->where('id', '!=', $job->id)
            ->where(function ($q) use ($job) {
                if ($job->category_id) {
                    $q->where('category_id', $job->category_id);
                }
            })
            ->withCount('proposals')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        // Verificar se o freelancer já enviou proposta
        $alreadyApplied = Proposal::where('job_id', $job->id)
            ->where('freelancer_id', Auth::id())
            ->exists();

        // Verificar se o job está guardado
        $isSaved = SavedJob::where('job_id', $job->id)
            ->where('user_id', Auth::id())
            ->exists();

        return view('freelancer.jobs.show', compact(
            'job',
            'similarJobs',
            'alreadyApplied',
            'isSaved'
        ));
    }

    /**
     * Guardar/Remover Job dos favoritos
     */
    public function toggleSave(Request $request, Job $job)
    {
        $saved = SavedJob::where('job_id', $job->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($saved) {
            $saved->delete();
            return response()->json(['saved' => false]);
        }

        SavedJob::create([
            'job_id'  => $job->id,
            'user_id' => Auth::id(),
        ]);

        return response()->json(['saved' => true]);
    }
}
