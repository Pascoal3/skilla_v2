<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HabilidadesSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $habilidades = [
            ['nome' => 'Figma', 'categoria_slug' => 'logotipos-branding'],
            ['nome' => 'Canva', 'categoria_slug' => 'social-media-design'],
            ['nome' => 'HTML/CSS', 'categoria_slug' => 'landing-pages'],
            ['nome' => 'Laravel', 'categoria_slug' => 'websites-sistemas'],
            ['nome' => 'Kotlin', 'categoria_slug' => 'android'],
            ['nome' => 'Swift', 'categoria_slug' => 'ios'],
            ['nome' => 'Meta Ads', 'categoria_slug' => 'gestao-de-trafego-ads'],
            ['nome' => 'SEO', 'categoria_slug' => 'seo-conteudo'],
        ];

        $rows = [];

        foreach ($habilidades as $hab) {
            $categoriaId = DB::table('categorias')->where('slug', $hab['categoria_slug'])->value('id');

            if (!$categoriaId) {
                throw new \RuntimeException("Categoria não encontrada para slug: {$hab['categoria_slug']}");
            }

            $rows[] = [
                'id' => (string) Str::uuid(),
                'nome' => $hab['nome'],
                'categoria_id' => $categoriaId,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('habilidades')->upsert(
            $rows,
            ['nome'],
            ['categoria_id', 'updated_at']
        );
    }
}