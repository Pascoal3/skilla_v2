<?php

return [
    'comissao_percentual' => 0.10,
    'pacotes_creditos' => [
        ['id' => 'basic', 'creditos' => 10, 'preco' => 1500.00],
        ['id' => 'pro', 'creditos' => 30, 'preco' => 4000.00],
        ['id' => 'premium', 'creditos' => 100, 'preco' => 12000.00],
    ],
    'limites' => [
        'min_recarga' => 500,
        'min_saque' => 1000,
    ]
];