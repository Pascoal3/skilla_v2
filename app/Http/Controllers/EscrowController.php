<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Services\EscrowService;
use Illuminate\Http\Request;

class EscrowController extends Controller
{
    public function confirmar(Contract $Contract, EscrowService $escrowService)
    {
        $escrowService->reter($Contract);
        return response()->json(['success' => true]);
    }

    public function liberar(Contract $Contract, EscrowService $escrowService)
    {
        $escrowService->liberar($Contract);
        return response()->json(['success' => true]);
    }

    public function reembolsarTotal(Contract $Contract, EscrowService $escrowService)
    {
        $escrowService->reembolsarTotal($Contract);
        return response()->json(['success' => true]);
    }
}