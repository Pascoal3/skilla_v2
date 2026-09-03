<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class HabilidadesSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

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

        foreach ($habilidades as $hab) {
            $categoriaId = DB::table('categorias')->where('slug', $hab['categoria_slug'])->value('id');

            if (!$categoriaId) {
                throw new \RuntimeException("Categoria não encontrada para slug: {$hab['categoria_slug']}");
            }

            DB::table('habilidades')->updateOrInsert(
                ['nome' => $hab['nome']],
                [
                    'id' => DB::raw("COALESCE(id, '" . (string) Str::uuid() . "')"),
                    'categoria_id' => $categoriaId,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
