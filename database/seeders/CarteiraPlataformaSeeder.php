<?php

namespace Database\Seeders;

use App\Models\Carteira;
use App\Services\IbanService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CarteiraPlataformaSeeder extends Seeder
{
    public function run(IbanService $ibanService): void
    {
        $carteira = Carteira::firstOrCreate(
            ['tipo' => 'plataforma'],
            [
                'id' => Str::uuid(),
                'saldo' => 0,
                'moeda' => 'AOA',
            ]
        );

        if (is_null($carteira->numero_conta_interno)) {
            $ibanService->gerarParaCarteira($carteira);
        }
    }
}