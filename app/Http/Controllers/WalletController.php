<?php

namespace App\Http\Controllers;

use App\Services\WalletService;
use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller {
    protected $walletService;

    public function __construct(WalletService $walletService) {
        $this->walletService = $walletService;
    }

    public function balance(Request $request) {
        $wallet = Wallet::where('usuario_id', $request->header('X-User-Id'))->firstOrFail();
        return response()->json(['saldo' => $wallet->saldo, 'moeda' => $wallet->moeda]);
    }

    public function deposit(Request $request) {
        $request->validate(['amount' => 'required|numeric|min:1']);
        $wallet = Wallet::where('usuario_id', $request->header('X-User-Id'))->firstOrFail();
        
        $transaction = $this->walletService->deposit($wallet->id, $request->amount);
        return response()->json(['message' => 'Saldo recarregado com sucesso!', 'transaction' => $transaction]);
    }
}
