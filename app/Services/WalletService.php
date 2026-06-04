<?php

namespace App\Services;

use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WalletService
{
    public function getOrCreateWallet($profile): Wallet
    {
        $wallet = Wallet::firstOrCreate(
            [
                'usuario_id' => $profile->id,
                'tipo' => 'usuario'
            ],
            [
                'saldo' => 0,
                'moeda' => 'AOA'
            ]
        );

        // Gera IBAN virtual se ainda não existir
        if (!$wallet->iban_virtual && app()->bound(IbanService::class)) {
            app(IbanService::class)->gerarParaCarteira($wallet);
        }

        return $wallet;
    }

    public function createWalletForProfile(string $profileId): Wallet
    {
        return Wallet::create([
            'usuario_id' => $profileId,
            'tipo'       => 'usuario',
            'saldo'      => 0,
            'moeda'      => 'AOA',
        ]);
    }

    public function deposit(
        Wallet $destination,
        float $amount,
        array $meta = []
    ): WalletTransaction {
        return DB::transaction(function () use ($destination, $amount, $meta) {

            $wallet = Wallet::where('id', $destination->id)
                ->lockForUpdate()
                ->firstOrFail();

            $wallet->saldo += $amount;
            $wallet->save();

            return WalletTransaction::create([
                'id'                    => Str::uuid(),
                'carteira_destino_id'   => $wallet->id,
                'valor'                 => $amount,
                'tipo'                  => 'recarga',
                'status'                => 'concluido',
                'descricao'             => $meta['descricao'] ?? 'Recarga de saldo',
                'metodo_pagamento'      => $meta['metodo'] ?? 'interno',
                'id_referencia'         => $meta['id_referencia'] ?? null,
                'tipo_referencia'       => $meta['tipo_referencia'] ?? null,
            ]);
        });
    }

    public function withdraw(
        Wallet $origin,
        float $amount,
        string $type,
        array $meta = []
    ): WalletTransaction {
        return DB::transaction(function () use ($origin, $amount, $type, $meta) {

            $wallet = Wallet::where('id', $origin->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($wallet->saldo < $amount) {
                throw new \Exception('Saldo insuficiente.');
            }

            $wallet->saldo -= $amount;
            $wallet->save();

            return WalletTransaction::create([
                'id'                  => Str::uuid(),
                'carteira_origem_id'  => $wallet->id,
                'valor'               => $amount,
                'tipo'                => $type,
                'status'              => 'concluido',
                'descricao'           => $meta['descricao'] ?? 'Débito',
                'metodo_pagamento'    => $meta['metodo'] ?? 'interno',
                'id_referencia'       => $meta['id_referencia'] ?? null,
                'tipo_referencia'     => $meta['tipo_referencia'] ?? null,
            ]);
        });
    }
}