<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecargaRequest;
use App\Services\WalletService;

class RecargaController extends Controller
{
    public function create()
    {
        return view('carteira.recarga');
    }

    public function store(RecargaRequest $request, WalletService $walletService)
    {
        $perfil = auth()->user()->perfil;
        $carteira = $walletService->getOrCreateWallet($perfil);
        $walletService->depositar($carteira, $request->valor, ['metodo' => 'Multicaixa Express (Simulado)']);
        return redirect()->route('carteira.show')->with('success', 'Saldo carregado com sucesso!');
    }
}