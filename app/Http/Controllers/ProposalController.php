<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Proposal;
use App\Models\ProposalAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProposalController extends Controller
{
    /**
     * Enviar proposta para um job
     */
    public function store(Request $request)
    {
        $request->validate([
            'job_id'           => 'required|exists:jobs,id',
            'amount'           => 'required|numeric|min:1',
            'delivery_days'    => 'required|integer|min:1',
            'cover_letter'     => 'required|string|min:50|max:2000',
            'screening_answers' => 'nullable|array',
            'screening_answers.*' => 'nullable|string|max:1000',
        ], [
            'job_id.required'        => 'Job inválido.',
            'amount.required'        => 'Informe o valor da proposta.',
            'amount.numeric'         => 'O valor deve ser numérico.',
            'delivery_days.required' => 'Informe o prazo de entrega.',
            'cover_letter.required'  => 'A carta de apresentação é obrigatória.',
            'cover_letter.min'       => 'A carta deve ter pelo menos 50 caracteres.',
        ]);

        $job = Job::findOrFail($request->job_id);

        // Verificar se está aberto
        if (!$job->proposals_open) {
            return response()->json([
                'success' => false,
                'message' => 'Este job não está a aceitar propostas.'
            ], 422);
        }

        // Verificar duplicata
        $exists = Proposal::where('job_id', $request->job_id)
            ->where('freelancer_id', Auth::id())
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Já enviou uma proposta para este job.'
            ], 422);
        }

        // Verificar créditos do freelancer
        $freelancer = Auth::user()->freelancer;
        if ($freelancer->credits < 1) {
            return response()->json([
                'success' => false,
                'message' => 'Não tem créditos suficientes para enviar uma proposta.'
            ], 422);
        }

        DB::transaction(function () use ($request, $freelancer) {
            // Criar proposta
            $proposal = Proposal::create([
                'job_id'        => $request->job_id,
                'freelancer_id' => Auth::id(),
                'amount'        => $request->amount,
                'delivery_days' => $request->delivery_days,
                'cover_letter'  => $request->cover_letter,
                'status'        => 'pending',
            ]);

            // Guardar respostas de triagem
            if ($request->filled('screening_answers')) {
                foreach ($request->screening_answers as $questionId => $answer) {
                    if (!empty($answer)) {
                        ProposalAnswer::create([
                            'proposal_id'          => $proposal->id,
                            'screening_question_id' => $questionId,
                            'answer'               => $answer,
                        ]);
                    }
                }
            }

            // Deduzir crédito
            $freelancer->decrement('credits', 1);
        });

        return response()->json([
            'success' => true,
            'message' => 'Proposta enviada com sucesso!'
        ]);
    }
}
