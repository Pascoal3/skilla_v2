<?php
namespace App\Services;
use App\Models\Profile;
use App\Models\Highlight;
use Exception;
use Carbon\Carbon;

class HighlightService {
    public function boostProfile($profileId, $days = 7) {
        $profile = Profile::findOrFail($profileId);
        $cost = 5; // Exemplo: 5 créditos por boost

        if ($profile->saldo_creditos < $cost) {
            throw new Exception("Créditos insuficientes para destacar o perfil.");
        }

        $profile->decrement('saldo_creditos', $cost);

        return Highlight::create([
            'freelancer_id' => $profileId,
            'creditos_gastos' => $cost,
            'expira_em' => Carbon::now()->addDays($days),
        ]);
        
        $profile->update([
            'esta_destacado' => true,
            'destaque_expira_em' => Carbon::now()->addDays($days)
        ]);
    }
}