<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProposalController;


/*
|--------------------------------------------------------------------------
| PÚBLICAS
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => view('home.inicio'))->name('inicio');

Route::get('/escolher-funcao', fn () => view('home.pagina_escolher_funcao'))
    ->name('pagina_escolher_funcao');

Route::get('/login', fn () => view('registar.tela_login'))
    ->name('login');

Route::get('/registar/cliente', fn () => view('registar.cliente'))
    ->name('registar.cliente');

Route::get('/registar/freelancer', fn () => view('registar.freela'))
    ->name('registar.freela');

Route::get('/painel/cliente/teste2', fn () =>
    view('painel.painel_cliente_teste')
)->name('painel.cliente.teste');

Route::get('/painel/freelancer/teste3', fn () =>
    view('teste_previa.painel_freela_teste')
)->name('painel.freelancer.teste3');

Route::get('/tela-sala-trabalho/teste', fn () =>
    view('teste_previa.tela_mensagem_sala_trabalho_teste')
)->name('tela.sala.trabalho.teste');

Route::get('tela_mensaem_inbox/teste', fn () =>
    view('teste_previa.tela_mensagem_inbox')
)->name('tela.mensagem.inbox.teste');

Route::get('/painel/cliente/teste3', fn () =>
    view('teste_previa.painel_cliente_teste')
)->name('painel.cliente.teste');

Route::get('/painel/freelancer/teste2', fn () =>
    view('painel.painel_freela_teste')
)->name('painel.freelancer.teste');
/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::post('/registar', [AuthController::class, 'registar']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout-api', [AuthController::class, 'logoutApi'])->name('logout.api');

Route::get('/check-auth', [AuthController::class, 'checkAuth'])->name('check.auth');
Route::post('/refresh-token', [AuthController::class, 'refresh'])->name('refresh.token');

/*
|--------------------------------------------------------------------------
| CLIENTE (PROTEGIDO)
|--------------------------------------------------------------------------
*/

Route::middleware(['jwt.cookie', 'role:cliente'])->group(function () {

    Route::get('/painel/cliente', [DashboardController::class, 'cliente'])
        ->name('painel.cliente');

    Route::get('/api/cliente/dashboard', [DashboardController::class, 'clienteData'])
        ->name('api.cliente.dashboard');

    Route::get('/painel/cliente/teste', fn () =>
        view('painel.painel_cliente')
    );
});

/*
|--------------------------------------------------------------------------
| FREELANCER (PROTEGIDO)
|--------------------------------------------------------------------------
*/

Route::middleware(['jwt.cookie', 'role:freelancer'])->group(function () {

    Route::get('/painel/freelancer', [DashboardController::class, 'freelancer'])
        ->name('painel.freelancer');

    Route::get('/api/freelancer/dashboard', [DashboardController::class, 'freelancerData'])
        ->name('api.freelancer.dashboard');

    Route::get('/painel/freelancer/teste', fn () =>
        view('painel.painel_freelancer')
    );

    /*
    |--------------------------------------------------------------------------
    | JOBS
    |--------------------------------------------------------------------------
    */

    Route::prefix('jobs')->name('jobs.')->group(function () {

        Route::get('/', [JobController::class, 'index'])->name('index');

        Route::get('/{job}', [JobController::class, 'show'])->name('show');

        Route::post('/{job}/save', [JobController::class, 'toggleSave'])
            ->name('save');
    });

    /*
    |--------------------------------------------------------------------------
    | PROPOSALS
    |--------------------------------------------------------------------------
    */

    Route::prefix('proposals')->name('proposals.')->group(function () {

        Route::get('/', [ProposalController::class, 'index'])->name('index');

        Route::post('/', [ProposalController::class, 'store'])->name('store');
    });

    /*
    |--------------------------------------------------------------------------
    | ÁREA FREELANCER
    |--------------------------------------------------------------------------
    */

    Route::get('/mensagens', fn () => view('freelancer.messages.index'))->name('messages.index');

    Route::get('/carteira', fn () => view('freelancer.wallet.index'))->name('wallet.index');

    Route::get('/perfil', fn () => view('freelancer.profile.index'))->name('profile.index');

    Route::get('/definicoes', fn () => view('freelancer.settings.index'))->name('settings.index');

    Route::get('/creditos', fn () => view('freelancer.credits.index'))->name('credits.index');

    Route::get('/perfil/{id}', fn ($id) =>
        view('freelancer.profile.show', ['userId' => $id])
    )->name('profile.show');
});

/*
|--------------------------------------------------------------------------
| PROFILES (público ou proteger depois)
|--------------------------------------------------------------------------
*/

Route::prefix('profiles')->group(function () {

    Route::get('/{id}', [ProfileController::class, 'show']);

    Route::put('/{id}', [ProfileController::class, 'update']);

    Route::post('/{id}/skills', [ProfileController::class, 'updateSkills']);
});

Route::prefix('carteira')->group(function () {

    Route::get('/', [CarteiraController::class, 'show'])
        ->name('carteira.show');

        Route::get('/minha-carteira', fn () =>
        view('freelancer.wallet.index')
        )->name('wallet.index');

    Route::get('/extrato', [CarteiraController::class, 'extrato'])
        ->name('carteira.extrato');

    Route::get('/creditos/extrato', [CarteiraController::class, 'extratoCreditos'])
        ->name('carteira.creditos.extrato');

    Route::get('/recarga', [RecargaController::class, 'create'])
        ->name('carteira.recarga');

    Route::post('/recarga', [RecargaController::class, 'store'])
        ->name('carteira.recarga.store');
});

Route::prefix('creditos')->group(function () {

    Route::get('/comprar', [CreditosController::class, 'create'])
        ->name('creditos.comprar');

    Route::post('/comprar', [CreditosController::class, 'store'])
        ->name('creditos.comprar.store');
});

Route::prefix('contratos/{contrato}/escrow')->group(function () {

    Route::post('/confirmar', [EscrowController::class, 'confirmar'])
        ->name('escrow.confirmar');

    Route::post('/liberar', [EscrowController::class, 'liberar'])
        ->name('escrow.liberar');

    Route::post('/reembolsar', [EscrowController::class, 'reembolsarTotal'])
        ->name('escrow.reembolsar');
});