<?php

namespace App\Services;

use App\Models\Proposal;
use App\Models\Contract;
use App\Models\Profile;
use App\Models\Job;
use Illuminate\Support\Facades\DB;
use Exception;

class ProposalService {
    
    // O Freelancer envia a proposta
    public function sendProposal(array $data, $freelancerId) {
        $freelancer = Profile::findOrFail($freelancerId);

        // 1. Verificar se tem créditos
        if ($freelancer->saldo_creditos < 1) {
            throw new Exception("Você não possui créditos suficientes para enviar esta proposta.");
        }

        // 2. Deduzir crédito e salvar proposta
        return DB::transaction(function () use ($freelancer, $data) {
            $freelancer->decrement('saldo_creditos', 1);
            
            return Proposal::create([
                'trabalho_id' => $data['trabalho_id'],
                'freelancer_id' => $freelancer->id,
                'carta_apresentacao' => $data['carta_apresentacao'],
                'valor_proposto' => $data['valor_proposto'],
                'dias_entrega' => $data['dias_entrega'],
                'creditos_gastos' => 1,
                'status' => 'pendente'
            ]);
        });
    }

    // O Cliente aceita a proposta
    public function acceptProposal($proposalId, $clientId, EscrowService $escrowService) {
        return DB::transaction(function () use ($proposalId, $clientId, $escrowService) {
            $proposal = Proposal::lockForUpdate()->findOrFail($proposalId);
            $job = Job::findOrFail($proposal->trabalho_id);

            if ($job->cliente_id !== $clientId) {
                throw new Exception("Apenas o dono do trabalho pode aceitar a proposta.");
            }

            if ($proposal->status !== 'pendente') {
                throw new Exception("Esta proposta já foi processada.");
            }

            // 1. Atualizar status da proposta e do job
            $proposal->update(['status' => 'aceita']);
            $job->update(['status' => 'em_andamento', 'proposta_aceita_id' => $proposal->id]);

            // 2. Calcular comissão (ex: 10%)
            $valorAcordado = $proposal->valor_proposto;
            $comissao = $valorAcordado * 0.10;
            $valorFreelancer = $valorAcordado - $comissao;

            // 3. Criar o Contrato
            $contract = Contract::create([
                'trabalho_id' => $job->id,
                'proposta_id' => $proposal->id,
                'cliente_id' => $clientId,
                'freelancer_id' => $proposal->freelancer_id,
                'valor_acordado' => $valorAcordado,
                'comissao_plataforma' => $comissao,
                'valor_freelancer' => $valorFreelancer,
                'dias_entrega' => $proposal->dias_entrega,
                'status_pagamento' => 'pendente',
            ]);

            // 4. ACIONAR ESCROW (Retém o dinheiro do cliente)
            // Aqui chamamos o serviço da Fase 3
            $escrowService->holdFunds($contract->id, $clientId, $proposal->freelancer_id, $valorAcordado);
            
            $contract->update(['status_pagamento' => 'retido']);

            return $contract;
        });
    }
}