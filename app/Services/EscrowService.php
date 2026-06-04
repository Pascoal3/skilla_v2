<?php

namespace App\Services;

use App\Models\Contract;
use App\Models\EscrowTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EscrowService
{
    public function __construct(private WalletService $walletService) {}

    public function reter(Contract $contrato): void
    {
        DB::transaction(function () use ($contrato) {
            $clienteCarteira = $this->walletService->getOrCreateWallet($contrato->cliente);
            $freelancerCarteira = $this->walletService->getOrCreateWallet($contrato->freelancer);
            $plataformaCarteira = \App\Models\Carteira::where('tipo', 'plataforma')->firstOrFail();

            $valor = $contrato->valor_acordado;
            $comissaoPercentual = config('skilla.comissao_percentual', 0.10);
            $valorComissao = round($valor * $comissaoPercentual, 2);
            $valorLiquido = $valor - $valorComissao;

            $this->walletService->debitar($clienteCarteira, $valor, 'debito_escrow', [
                'descricao' => 'Retenção para contrato',
                'id_referencia' => $contrato->id,
                'tipo_referencia' => 'contrato'
            ]);

            EscrowTransaction::create([
                'id' => Str::uuid(),
                'contrato_id' => $contrato->id,
                'carteira_origem_id' => $clienteCarteira->id,
                'carteira_destino_id' => $freelancerCarteira->id,
                'valor' => $valor,
                'valor_comissao' => $valorComissao,
                'valor_liquido_freelancer' => $valorLiquido,
                'status_pagamento' => 'retido',
                'retido_em' => now(),
            ]);

            $contrato->update([
                'status_pagamento' => 'retido',
                'comissao_plataforma' => $valorComissao,
                'valor_freelancer' => $valorLiquido,
            ]);
        });
    }

    public function liberar(Contract $contrato): void
    {
        DB::transaction(function () use ($contrato) {
            $escrow = EscrowTransaction::where('contrato_id', $contrato->id)->where('status_pagamento', 'retido')->firstOrFail();
            $freelancerCarteira = $this->walletService->getOrCreateWallet($contrato->freelancer);
            $plataformaCarteira = \App\Models\Carteira::where('tipo', 'plataforma')->firstOrFail();

            $escrow->update(['status_pagamento' => 'liberado', 'liberado_em' => now()]);

            // Creditar freelancer
            $this->walletService->depositar($freelancerCarteira, $escrow->valor_liquido_freelancer, [
                'descricao' => 'Pagamento do contrato',
                'tipo' => 'credito_escrow'
            ]);

            // Creditar plataforma
            if ($escrow->valor_comissao > 0) {
                $this->walletService->depositar($plataformaCarteira, $escrow->valor_comissao, [
                    'descricao' => 'Comissão da plataforma',
                    'tipo' => 'comissao'
                ]);
            }

            $contrato->update(['status_pagamento' => 'liberado', 'status_contrato' => 'concluido', 'aprovado_em' => now()]);
        });
    }

    public function reembolsarTotal(Contract $contrato): void
    {
        DB::transaction(function () use ($contrato) {
            $escrow = EscrowTransaction::where('contrato_id', $contrato->id)->where('status_pagamento', 'retido')->firstOrFail();
            $clienteCarteira = $this->walletService->getOrCreateWallet($contrato->cliente);

            $escrow->update(['status_pagamento' => 'devolvido_cliente']);

            $this->walletService->depositar($clienteCarteira, $escrow->valor, [
                'descricao' => 'Reembolso total do contrato',
                'tipo' => 'reembolso_escrow'
            ]);

            $contrato->update(['status_pagamento' => 'devolvido_cliente', 'status_contrato' => 'cancelado']);
        });
    }
}