<?php

namespace App\Services;

use App\Models\Carteira;

class IbanService
{
    public function __construct(private CounterService $counterService) {}

    public function gerarParaCarteira(Carteira $carteira): Carteira
    {
        if ($carteira->numero_conta_interno) {
            return $carteira;
        }

        $numero = $this->counterService->next('numero_conta_interno');
        $accountNumber = str_pad((string) $numero, 11, '0', STR_PAD_LEFT);
        $iban = 'AO06' . '0010' . '0000' . $accountNumber;

        $carteira->update([
            'numero_conta_interno' => $numero,
            'iban_virtual' => $iban,
        ]);

        return $carteira->fresh();
    }

    public function formatar(string $iban): string
    {
        $clean = str_replace(' ', '', $iban);
        return trim(chunk_split($clean, 4, ' '));
    }
}