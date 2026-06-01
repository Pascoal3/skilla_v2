<?php

namespace App\Services;

use App\Models\Job;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class JobService {
    
    // Cria ou atualiza um rascunho (não valida campos obrigatórios)
    public function saveDraft(array $data, $clientId, $jobId = null) {
        $data['cliente_id'] = $clientId;
        $data['status'] = 'rascunho';

        if ($jobId) {
            $job = Job::findOrFail($jobId);
            $job->update($data);
            return $job;
        }

        return Job::create($data);
    }

    // Publica o trabalho (valida campos obrigatórios)
    public function publishJob(Job $job, array $data) {
        // Validação rigorosa para publicação
        $validator = Validator::make(array_merge($job->toArray(), $data), [
            'titulo' => 'required|string|min:5',
            'categoria_id' => 'required|exists:categorias,id',
            'descricao' => 'required|string|min:20',
            'tipo_trabalho' => 'required|in:preco_fixo,por_hora',
        ]);

        if ($validator->fails()) {
            throw new \Exception("Erro ao publicar: " . $validator->errors()->first());
        }

        $job->update([
            'status' => 'aberto',
            'expira_em' => Carbon::now()->addDays(30), // Expira em 30 dias
            ...$data
        ]);

        return $job;
    }

    public function syncJobSkills(Job $job, array $skillIds) {
        return $job->skills()->sync($skillIds);
    }
}