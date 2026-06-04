<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Freelancer\JobController;
use App\Http\Controllers\Freelancer\ProposalController;

/*
|--------------------------------------------------------------------------
| Públicas
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => view('home.inicio'))
    ->name('inicio');

Route::get('/escolher-funcao', fn () => view('home.pagina_escolher_funcao'))
    ->name('pagina_escolher_funcao');

Route::get('/login', fn () => view('registar.tela_login'))
    ->name('login');

Route::get('/registar/cliente', fn () => view('registar.cliente'))
    ->name('registar.cliente');

Route::get('/registar/freelancer', fn () => view('registar.freelancer'))
    ->name('registar.freelancer');

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/

Route::post('/registar', [AuthController::class, 'registar']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::post('/logout-api', [AuthController::class, 'logoutApi'])
    ->name('logout.api');

Route::get('/check-auth', [AuthController::class, 'checkAuth'])
    ->name('check.auth');

Route::post('/refresh-token', [AuthController::class, 'refresh'])
    ->name('refresh.token');

/*
|--------------------------------------------------------------------------
| Cliente
|--------------------------------------------------------------------------
*/

Route::middleware(['jwt.auth', 'role:cliente'])
    ->group(function () {

        Route::get('/painel/cliente', [DashboardController::class, 'cliente'])
            ->name('painel.cliente');

        Route::get('/api/cliente/dashboard', [DashboardController::class, 'clienteData'])
            ->name('api.cliente.dashboard');

        Route::get('/painel/cliente/teste', function () {
            return view('painel.painel_cliente');
        })->name('painel.cliente.teste');
    });

/*
|--------------------------------------------------------------------------
| Freelancer
|--------------------------------------------------------------------------
*/

Route::middleware(['jwt.auth', 'role:freelancer'])
    ->group(function () {

        Route::get('/painel/freelancer', [DashboardController::class, 'freelancer'])
            ->name('painel.freelancer');

        Route::get('/api/freelancer/dashboard', [DashboardController::class, 'freelancerData'])
            ->name('api.freelancer.dashboard');

        Route::get('/painel/freelancer/teste', function () {
            return view('painel.painel_freelancer');
        })->name('painel.freelancer.teste');

        /*
        |--------------------------------------------------------------------------
        | Jobs
        |--------------------------------------------------------------------------
        */

        Route::prefix('jobs')
            ->name('jobs.')
            ->group(function () {

                Route::get('/', [JobController::class, 'index'])
                    ->name('index');

                Route::get('/{job}', [JobController::class, 'show'])
                    ->name('show');

                Route::post('/{job}/save', [JobController::class, 'toggleSave'])
                    ->name('save');
            });

        /*
        |--------------------------------------------------------------------------
        | Proposals
        |--------------------------------------------------------------------------
        */

        Route::prefix('proposals')
            ->name('proposals.')
            ->group(function () {

                Route::get('/', [ProposalController::class, 'index'])
                    ->name('index');

                Route::post('/', [ProposalController::class, 'store'])
                    ->name('store');
            });

        /*
        |--------------------------------------------------------------------------
        | Área Freelancer
        |--------------------------------------------------------------------------
        */

        Route::get('/mensagens', fn () => view('freelancer.messages.index'))
            ->name('messages.index');

        Route::get('/carteira', fn () => view('freelancer.wallet.index'))
            ->name('wallet.index');

        Route::get('/perfil', fn () => view('freelancer.profile.index'))
            ->name('profile.index');

        Route::get('/definicoes', fn () => view('freelancer.settings.index'))
            ->name('settings.index');

        Route::get('/creditos', fn () => view('freelancer.credits.index'))
            ->name('credits.index');

        Route::get('/perfil/{id}', function ($id) {
            return view('freelancer.profile.show', [
                'userId' => $id
            ]);
        })->name('profile.show');
    });

/*
|--------------------------------------------------------------------------
| Profiles
|--------------------------------------------------------------------------
*/

Route::prefix('profiles')->group(function () {

    Route::get('/{id}', [ProfileController::class, 'show']);

    Route::put('/{id}', [ProfileController::class, 'update']);

    Route::post('/{id}/skills', [ProfileController::class, 'updateSkills']);
});