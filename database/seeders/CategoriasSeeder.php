<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CategoriasSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $categorias = [
            [
                'nome' => 'Design Gráfico',
                'slug' => 'design-grafico',
                'descricao' => 'Logos, branding e peças visuais.',
                'url_icone' => '/icons/categories/design.svg',
                'ordem' => 1,
                'filhas' => [
                    [
                        'nome' => 'Logotipos e Branding',
                        'slug' => 'logotipos-branding',
                        'descricao' => 'Identidade visual, logos e brand guidelines.',
                        'url_icone' => '/icons/categories/logo.svg',
                        'ordem' => 1,
                    ],
                    [
                        'nome' => 'Social Media Design',
                        'slug' => 'social-media-design',
                        'descricao' => 'Posts, banners e artes para redes sociais.',
                        'url_icone' => '/icons/categories/social.svg',
                        'ordem' => 2,
                    ],
                ],
            ],
            [
                'nome' => 'Web Development',
                'slug' => 'web-development',
                'descricao' => 'Sites, landing pages e sistemas web.',
                'url_icone' => '/icons/categories/web.svg',
                'ordem' => 2,
                'filhas' => [
                    [
                        'nome' => 'Landing Pages',
                        'slug' => 'landing-pages',
                        'descricao' => 'Páginas de conversão e apresentação de serviços.',
                        'url_icone' => '/icons/categories/landing.svg',
                        'ordem' => 1,
                    ],
                    [
                        'nome' => 'Websites e Sistemas',
                        'slug' => 'websites-sistemas',
                        'descricao' => 'Sites institucionais, portais e sistemas sob medida.',
                        'url_icone' => '/icons/categories/system.svg',
                        'ordem' => 2,
                    ],
                ],
            ],
            [
                'nome' => 'Mobile Apps',
                'slug' => 'mobile-apps',
                'descricao' => 'Apps Android e iOS.',
                'url_icone' => '/icons/categories/mobile.svg',
                'ordem' => 3,
                'filhas' => [
                    [
                        'nome' => 'Android',
                        'slug' => 'android',
                        'descricao' => 'Apps nativas e integração com serviços.',
                        'url_icone' => '/icons/categories/android.svg',
                        'ordem' => 1,
                    ],
                    [
                        'nome' => 'iOS',
                        'slug' => 'ios',
                        'descricao' => 'Apps iPhone/iPad com experiência premium.',
                        'url_icone' => '/icons/categories/ios.svg',
                        'ordem' => 2,
                    ],
                ],
            ],
            [
                'nome' => 'Marketing Digital',
                'slug' => 'marketing-digital',
                'descricao' => 'Anúncios, SEO e conteúdo.',
                'url_icone' => '/icons/categories/marketing.svg',
                'ordem' => 4,
                'filhas' => [
                    [
                        'nome' => 'Gestão de Tráfego (Ads)',
                        'slug' => 'gestao-de-trafego-ads',
                        'descricao' => 'Campanhas, otimização e performance.',
                        'url_icone' => '/icons/categories/ads.svg',
                        'ordem' => 1,
                    ],
                    [
                        'nome' => 'SEO e Conteúdo',
                        'slug' => 'seo-conteudo',
                        'descricao' => 'Conteúdo estratégico e posicionamento orgânico.',
                        'url_icone' => '/icons/categories/seo.svg',
                        'ordem' => 2,
                    ],
                ],
            ],
        ];

        foreach ($categorias as $cat) {
            // upsert categoria principal
            DB::table('categorias')->updateOrInsert(
                ['slug' => $cat['slug']],
                [
                    'id' => DB::raw("COALESCE(id, '" . (string) Str::uuid() . "')"),
                    'parent_id' => null,
                    'nome' => $cat['nome'],
                    'descricao' => $cat['descricao'] ?? null,
                    'url_icone' => $cat['url_icone'] ?? null,
                    'ordem' => $cat['ordem'] ?? 0,
                    'ativo' => true,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );

            $parentId = DB::table('categorias')->where('slug', $cat['slug'])->value('id');

            foreach ($cat['filhas'] as $filha) {
                DB::table('categorias')->updateOrInsert(
                    ['slug' => $filha['slug']],
                    [
                        'id' => DB::raw("COALESCE(id, '" . (string) Str::uuid() . "')"),
                        'parent_id' => $parentId,
                        'nome' => $filha['nome'],
                        'descricao' => $filha['descricao'] ?? null,
                        'url_icone' => $filha['url_icone'] ?? null,
                        'ordem' => $filha['ordem'] ?? 0,
                        'ativo' => true,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
            }
        }
    }
}