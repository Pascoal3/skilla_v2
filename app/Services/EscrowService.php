<?php

namespace App\Services;

use App\Models\EscrowTransaction;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;

class EscrowService {
    protected $walletService;

    public function __construct(WalletService $walletService) {
        $this->walletService = $walletService;
    }

    // Tira dinheiro do cliente e "congela" no Escrow
    public function holdFunds($contractId, $clientWalletId, $freelancerWalletId, $amount) {
        return DB::transaction(function () use ($contractId, $clientWalletId, $freelancerWalletId, $amount) {
            // 1. Retira o dinheiro da carteira do cliente
            $this->walletService->withdraw($clientWalletId, $amount, 'debito_escrow', 'Pagamento retido para contrato', $contractId);

            // 2. Calcula comissão (10%)
            $commission = $amount * 0.10;
            $netAmount = $amount - $commission;

            // 3. Cria o registro no Escrow
            return EscrowTransaction::create([
                'contrato_id' => $contractId,
                'carteira_origem_id' => $clientWalletId,
                'carteira_destino_id' => $freelancerWalletId,
                'valor' => $amount,
                'valor_comissao' => $commission,
                'valor_liquido_freelancer' => $netAmount,
                'status_pagamento' => 'retido',
            ]);
        });
    }

    // Libera o dinheiro do Escrow para o Freelancer e a Comissão para a Plataforma
    public function releaseFunds($escrowId) {
        return DB::transaction(function () use ($escrowId) {
            $escrow = EscrowTransaction::findOrFail($escrowId);

            if ($escrow->status_pagamento !== 'retido') {
                throw new \Exception("Este pagamento já foi processado.");
            }

            // 1. Credita o freelancer (Valor Líquido)
            $freelancerWallet = Wallet::findOrFail($escrow->carteira_destino_id);
            $freelancerWallet->increment('saldo', $escrow->valor_liquido_freelancer);
            
            WalletTransaction::create([
                'carteira_destino_id' => $freelancerWallet->id,
                'valor' => $escrow->valor_liquido_freelancer,
                'tipo' => 'credito_escrow',
                'descricao' => 'Pagamento recebido do projeto',
                'id_referencia' => $escrow->id
            ]);

            // 2. Credita a plataforma (Comissão)
            // Nota: Você precisará de uma carteira com tipo 'plataforma' no banco
            $platformWallet = Wallet::where('tipo', 'plataforma')->first();
            if ($platformWallet) {
                $platformWallet->increment('saldo', $escrow->valor_comissao);
                WalletTransaction::create([
                    'carteira_destino_id' => $platformWallet->id,
                    'valor' => $escrow->valor_comissao,
                    'tipo' => 'comissao',
                    'descricao' => 'Comissão sobre contrato ' . $escrow->contrato_id
                ]);
            }

            $escrow->update([
                'status_pagamento' => 'liberado',
                'liberado_em' => now()
            ]);

            return $escrow;
        });
    }
}