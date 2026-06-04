<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComprarCreditosRequest;
use App\Services\CreditService;

class CreditosController extends Controller
{
    public function create()
    {
        $pacotes = config('skilla.pacotes_creditos');
        return view('creditos.comprar', compact('pacotes'));
    }

    public function store(ComprarCreditosRequest $request, CreditService $creditService)
    {
        $perfil = auth()->user()->perfil;
        $pacote = collect(config('skilla.pacotes_creditos'))->firstWhere('id', $request->pacote_id);
        $creditService->comprarCreditos($perfil, $pacote);
        return redirect()->route('carteira.show')->with('success', 'Créditos comprados com sucesso!');
    }
}