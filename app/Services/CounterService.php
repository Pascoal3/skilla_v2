<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class CounterService
{
    public function next(string $chave): int
    {
        return DB::transaction(function () use ($chave) {
            $contador = DB::table('contadores')
                ->where('chave', $chave)
                ->lockForUpdate()
                ->first();

            if (!$contador) {
                DB::table('contadores')->insert([
                    'chave' => $chave,
                    'valor_atual' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                return 1;
            }

            $novoValor = $contador->valor_atual + 1;
            DB::table('contadores')
                ->where('chave', $chave)
                ->update(['valor_atual' => $novoValor, 'updated_at' => now()]);

            return $novoValor;
        });
    }
}