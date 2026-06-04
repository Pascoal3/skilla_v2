<?php

namespace App\Services;

use App\Models\Perfil;
use App\Models\TransacaoCredito;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreditService
{
    public function __construct(private WalletService $walletService) {}

    public function comprarCreditos(Perfil $freelancer, array $pacote): void
    {
        DB::transaction(function () use ($freelancer, $pacote) {
            $carteira = $this->walletService->getOrCreateWallet($freelancer);
            $this->walletService->debitar($carteira, $pacote['preco'], 'compra_creditos', [
                'descricao' => "Compra do pacote de {$pacote['creditos']} créditos"
            ]);

            $freelancer->saldo_creditos += $pacote['creditos'];
            $freelancer->save();

            TransacaoCredito::create([
                'id' => Str::uuid(),
                'perfil_id' => $freelancer->id,
                'quantidade' => $pacote['creditos'],
                'tipo' => 'compra',
                'descricao' => 'Compra de créditos via carteira Kz',
            ]);
        });
    }

    public function gastarCreditos(Perfil $freelancer, int $quantidade, string $tipo, array $ref = []): void
    {
        DB::transaction(function () use ($freelancer, $quantidade, $tipo, $ref) {
            if ($freelancer->saldo_creditos < $quantidade) {
                throw new \Exception('Créditos insuficientes.');
            }

            $freelancer->saldo_creditos -= $quantidade;
            $freelancer->save();

            TransacaoCredito::create([
                'id' => Str::uuid(),
                'perfil_id' => $freelancer->id,
                'quantidade' => -$quantidade,
                'tipo' => $tipo,
                'id_referencia' => $ref['id_referencia'] ?? null,
                'tipo_referencia' => $ref['tipo_referencia'] ?? null,
            ]);
        });
    }
}