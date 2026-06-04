<?php

namespace App\Http\Controllers;

use App\Services\WalletService;
use Illuminate\Http\Request;

class CarteiraController extends Controller
{
    public function show(WalletService $walletService)
    {
        $perfil = auth()->user()->perfil;
        $carteira = $walletService->getOrCreateWallet($perfil);
        return view('carteira.show', compact('carteira', 'perfil'));
    }

    public function extrato()
    {
        $perfil = auth()->user()->perfil;
        $carteira = $perfil->carteira;
        $transacoes = $carteira->transacoes()->paginate(15);
        return view('carteira.extrato', compact('transacoes'));
    }

    public function extratoCreditos()
    {
        $perfil = auth()->user()->perfil;
        $transacoes = $perfil->transacoesCreditos()->paginate(15);
        return view('carteira.creditos-extrato', compact('transacoes'));
    }
}