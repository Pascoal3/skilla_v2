<?php

use App\Http\Controllers\JobController;

Route::prefix('jobs')->group(function () {
    Route::get('/', [JobController::class, 'index']); // Listar abertos
    Route::post('/save', [JobController::class, 'store']); // Salvar rascunho
    Route::patch('/{id}/publish', [JobController::class, 'publish']); // Publicar
    Route::post('/{id}/skills', [JobController::class, 'updateSkills']); // Habilidades
});

use App\Http\Controllers\WalletController;

Route::prefix('wallet')->group(function () {
    Route::get('/balance', [WalletController::class, 'balance']);
    Route::post('/deposit', [WalletController::class, 'deposit']);
});

use App\Http\Controllers\ProposalController;

Route::prefix('proposals')->group(function () {
    Route::post('/send', [ProposalController::class, 'store']); // Freelancer envia
    Route::post('/{id}/accept', [ProposalController::class, 'accept']); // Cliente aceita
});

use App\Http\Controllers\ContractController;
use App\Http\Controllers\ReviewController;

// Gestão de Contratos (Ciclo de vida)
Route::prefix('contracts')->group(function () {
    Route::patch('/{id}/submit', [ContractController::class, 'submit']);   // Freelancer entrega
    Route::patch('/{id}/approve', [ContractController::class, 'approve']); // Cliente aprova
    Route::post('/{id}/dispute', [ContractController::class, 'dispute']);  // Abrir disputa
});

// Avaliações
Route::post('/reviews', [ReviewController::class, 'store']);

use App\Http\Controllers\ChatController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\HighlightController;

Route::prefix('chat')->group(function () {
    Route::post('/send', [ChatController::class, 'send']);
    Route::get('/{conversaId}/messages', [ChatController::class, 'messages']);
});

Route::prefix('notifications')->group(function () {
    Route::get('/', [NotificationController::class, 'index']);
    Route::patch('/{id}/read', [NotificationController::class, 'markAsRead']);
});

Route::post('/highlight', [HighlightController::class, 'store']);