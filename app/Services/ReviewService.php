<?php

namespace App\Services;

use App\Models\Review;
use App\Models\Contract;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Exception;

class ReviewService {

    public function createReview(array $data, $reviewerId) {
        return DB::transaction(function () use ($data, $reviewerId) {
            $contract = Contract::findOrFail($data['contrato_id']);

            // Só pode avaliar contrato concluído
            if ($contract->status_contrato !== 'concluido') {
                throw new Exception("Você só pode avaliar contratos concluídos.");
            }

            // Definir quem está sendo avaliado (o outro lado do contrato)
            $reviewedId = ($contract->cliente_id === $reviewerId) 
                          ? $contract->freelancer_id 
                          : $contract->cliente_id;

            // Criar a avaliação
            $review = Review::create([
                'contrato_id' => $data['contrato_id'],
                'avaliador_id' => $reviewerId,
                'avaliado_id' => $reviewedId,
                'nota' => $data['nota'],
                'comentario' => $data['comentario'] ?? null,
            ]);

            // Recalcular a média do avaliado
            $this->recalculateRating($reviewedId);

            return $review;
        });
    }

    private function recalculateRating($profileId) {
        $profile = Profile::findOrFail($profileId);
        $reviews = Review::where('avaliado_id', $profileId);

        $count = $reviews->count();
        $average = $reviews->avg('nota');

        $profile->update([
            'avaliacao_media' => round($average, 2),
            'total_avaliacoes' => $count
        ]);
    }
}