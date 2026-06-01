<?php

namespace App\Http\Controllers;

use App\Services\ContractService;
use Illuminate\Http\Request;

class ContractController extends Controller {
    protected $contractService;

    public function __construct(ContractService $contractService) {
        $this->contractService = $contractService;
    }

    public function submit(Request $request, $id) {
        try {
            $userId = $request->header('X-User-Id');
            $contract = $this->contractService->submitWork($id, $userId);
            return response()->json(['message' => 'Trabalho entregue!', 'contract' => $contract]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function approve(Request $request, $id) {
        try {
            $userId = $request->header('X-User-Id');
            $contract = $this->contractService->approveWork($id, $userId);
            return response()->json(['message' => 'Trabalho aprovado e pagamento liberado!', 'contract' => $contract]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function dispute(Request $request, $id) {
        try {
            $userId = $request->header('X-User-Id');
            $dispute = $this->contractService->openDispute($id, $userId, $request->motivo);
            return response()->json(['message' => 'Disputa aberta. Fundos congelados.', 'dispute' => $dispute]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
