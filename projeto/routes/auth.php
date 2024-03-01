<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendasController;
use App\Models\VendaModel;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    //PRODUTOS
    Route::get('produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');
    Route::get('produtos/index', [ProdutoController::class, 'index'])->name('produtos.index');
    Route::post('produtos', [ProdutoController::class, 'store'])->name('produtos.store');
    Route::delete('produtos/{produtos}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');
    Route::match(['get', 'put'] , 'produtos/{produto}', [ProdutoController::class, 'edit'])->name('produtos.edit');
    Route::put('produtos/{produto}', [ProdutoController::class, 'update'])->name('produtos.update');

    //CLIENTES

    Route::get('clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
    Route::get('clientes/index', [ClienteController::class, 'index'])->name('clientes.index');
    Route::match(['get', 'put'], 'clientes/{cliente}', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::post('clientes', [ClienteController::class, 'store'])->name('clientes.store');
    Route::delete('clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
    Route::put('clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');

    //VENDAS

    Route::get('vendas/create', [VendasController::class, 'create'])->name('vendas.create');
    Route::get('vendas/index', [VendasController::class, 'index'])->name('vendas.index');
    Route::match(['get', 'put'], 'vendas/{venda}', [VendasController::class, 'edit'])->name('vendas.edit');
    Route::post('vendas', [VendasController::class, 'store'])->name('vendas.store');
    Route::delete('vendas/{venda}', [VendasController::class, 'destroy'])->name('vendas.destroy');
    Route::put('vendas/{venda}', [VendasController::class, 'update'])->name('vendas.update');




    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
