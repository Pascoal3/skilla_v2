<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provincia;
use Illuminate\Support\Str;

class ProvinciaSeeder extends Seeder
{
    public function run()
    {
        $provincias = [
            ['nome' => 'Bengo', 'sigla' => 'BG'],
            ['nome' => 'Benguela', 'sigla' => 'BGU'],
            ['nome' => 'Bié', 'sigla' => 'BE'],
            ['nome' => 'Cabinda', 'sigla' => 'CAB'],
            ['nome' => 'Cunene', 'sigla' => 'CNN'],
            ['nome' => 'Huambo', 'sigla' => 'HUA'],
            ['nome' => 'Huíla', 'sigla' => 'HUI'],
            ['nome' => 'Kuando Kubango', 'sigla' => 'KK'],
            ['nome' => 'Kwanza Norte', 'sigla' => 'KN'],
            ['nome' => 'Kwanza Sul', 'sigla' => 'KS'],
            ['nome' => 'Luanda', 'sigla' => 'LUA'],
            ['nome' => 'Lunda Norte', 'sigla' => 'LN'],
            ['nome' => 'Lunda Sul', 'sigla' => 'LS'],
            ['nome' => 'Malanje', 'sigla' => 'MAL'],
            ['nome' => 'Moxico', 'sigla' => 'MOX'],
            ['nome' => 'Namibe', 'sigla' => 'NAM'],
            ['nome' => 'Uíge', 'sigla' => 'UIG'],
            ['nome' => 'Zaire', 'sigla' => 'ZAI'],
        ];

        foreach ($provincias as $provincia) {
            Provincia::create($provincia);
        }
    }
}