<?php

namespace App\Http\Controllers;

use App\Services\ProposalService;
use App\Services\EscrowService;
use Illuminate\Http\Request;

class ProfileController extends Controller {
    protected $proposalService;

    public function __construct(ProposalService $proposalService) {
        $this->proposalService = $proposalService;
    }

    public function store(Request $request) {
        try {
            $freelancerId = $request->header('X-User-Id');
            $proposal = $this->proposalService->sendProposal($request->all(), $freelancerId);
            return response()->json($proposal, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function accept(Request $request, $id, EscrowService $escrowService) {
        try {
            $clientId = $request->header('X-User-Id');
            $contract = $this->proposalService->acceptProposal($id, $clientId, $escrowService);
            return response()->json([
                'message' => 'Proposta aceita e fundos retidos no Escrow!',
                'contract' => $contract
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}