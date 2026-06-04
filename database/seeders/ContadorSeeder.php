<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContadorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contadores')->updateOrInsert(
            ['chave' => 'numero_conta_interno'],
            ['valor_atual' => 0, 'updated_at' => now()]
        );
    }
}