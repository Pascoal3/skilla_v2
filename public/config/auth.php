<?php

use App\Models\Perfil; // ← MUDOU

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
        ],
        'api' => [
        'driver' => 'jwt',
        'provider' => 'perfis',
    ],
],

'providers' => [
    // ... outros providers
    
    'perfis' => [
        'driver' => 'eloquent',
        'model' => App\Models\Perfil::class,
    ],
    ],


    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];