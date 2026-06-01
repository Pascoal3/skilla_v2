<?php

namespace App\Services;

use App\Models\Contract;
use App\Models\Dispute;
use App\Models\Job;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;

class ContractService {
    
    protected $escrowService;

    public function __construct(EscrowService $escrowService) {
        $this->escrowService = $escrowService;
    }

    // Freelancer marca o trabalho como entregue
    public function submitWork($contractId, $freelancerId) {
        $contract = Contract::findOrFail($contractId);

        if ($contract->freelancer_id !== $freelancerId) {
            throw new Exception("Apenas o freelancer responsável pode entregar o trabalho.");
        }

        if ($contract->status_contrato !== 'ativo') {
            throw new Exception("Este contrato não está ativo.");
        }

        $contract->update(['trabalho_entregue_em' => Carbon::now()]);
        return $contract;
    }

    // Cliente APROVA o trabalho -> Libera o dinheiro
    public function approveWork($contractId, $clientId) {
        return DB::transaction(function () use ($contractId, $clientId) {
            $contract = Contract::lockForUpdate()->findOrFail($contractId);

            if ($contract->cliente_id !== $clientId) {
                throw new Exception("Apenas o cliente pode aprovar o trabalho.");
            }

            if ($contract->status_pagamento !== 'retido') {
                throw new Exception("O pagamento não está retido ou já foi processado.");
            }

            // 1. Liberar fundos do Escrow para o Freelancer (Fase 3)
            $this->escrowService->releaseFunds($contract->id);

            // 2. Atualizar Contrato
            $contract->update([
                'status_contrato' => 'concluido',
                'status_pagamento' => 'liberado',
                'aprovado_em' => Carbon::now()
            ]);

            // 3. Atualizar Trabalho
            Job::where('id', $contract->trabalho_id)->update(['status' => 'concluido']);

            // 4. Incrementar contagem de trabalhos do freelancer
            Profile::where('id', $contract->freelancer_id)->increment('total_trabalhos_concluidos');

            return $contract;
        });
    }

    // Abrir uma Disputa -> Congela tudo
    public function openDispute($contractId, $userId, $motivo) {
        return DB::transaction(function () use ($contractId, $userId, $motivo) {
            $contract = Contract::findOrFail($contractId);

            // Verifica se o usuário faz parte do contrato
            if ($contract->cliente_id !== $userId && $contract->freelancer_id !== $userId) {
                throw new Exception("Você não faz parte deste contrato.");
            }

            // Muda status do contrato para congelar
            $contract->update(['status_contrato' => 'em_disputa']);

            // Cria o registro da disputa
            return Dispute::create([
                'contrato_id' => $contractId,
                'aberta_por' => $userId,
                'motivo' => $motivo,
                'status' => 'aberta'
            ]);
        });
    }
}