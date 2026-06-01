<?php

namespace App\Services;

use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;

class WalletService {
    public function createWalletForProfile($profileId) {
        return Wallet::create(['usuario_id' => $profileId, 'saldo' => 0]);
    }

    public function deposit($walletId, $amount, $description = 'Recarga de saldo') {
        return DB::transaction(function () use ($walletId, $amount, $description) {
            $wallet = Wallet::findOrFail($walletId);
            $wallet->increment('saldo', $amount);

            return WalletTransaction::create([
                'carteira_destino_id' => $walletId,
                'valor' => $amount,
                'tipo' => 'recarga',
                'descricao' => $description,
            ]);
        });
    }

    public function withdraw($walletId, $amount, $type, $description, $referenceId = null) {
        return DB::transaction(function () use ($walletId, $amount, $type, $description, $referenceId) {
            $wallet = Wallet::findOrFail($walletId);

            if ($wallet->saldo < $amount) {
                throw new \Exception("Saldo insuficiente na carteira.");
            }

            $wallet->decrement('saldo', $amount);

            return WalletTransaction::create([
                'carteira_origem_id' => $walletId,
                'valor' => $amount,
                'tipo' => $type,
                'descricao' => $description,
                'id_referencia' => $referenceId,
            ]);
        });
    }
}