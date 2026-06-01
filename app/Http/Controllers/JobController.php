<?php

namespace App\Http\Controllers;

use App\Services\JobService;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
