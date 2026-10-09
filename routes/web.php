<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ResolveShortUrlController;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\TeamController;
use App\Http\Middleware\EnsureRole;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

// public short urls to anyoone can access .
Route::get('/s/{code}', [ResolveShortUrlController::class, 'show'])->name('short.resolve');

// Invitation links for user who do not have an account yet.
Route::middleware('guest')->group(function () {
    Route::get('/invitations/{token}', [InvitationController::class, 'show'])->name('invitations.accept');
    Route::post('/invitations/{token}', [InvitationController::class, 'accept'])->name('invitations.store');
});

// Authenticated user can handle this route group.
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Short urls Admin + Member can create; the list is scoped by role.
    Route::get('/short-urls', [ShortUrlController::class, 'index'])->name('short-urls.index');
    Route::get('/short-urls/create', [ShortUrlController::class, 'create'])->name('short-urls.create');
    Route::post('/short-urls', [ShortUrlController::class, 'store'])->name('short-urls.store');

    // SuperAdmin invite a new company.
    Route::middleware(EnsureRole::class.':'.User::ROLE_SUPER_ADMIN)
        ->prefix('clients')
        ->name('clients.')
        ->group(function () {
            Route::get('/', [ClientController::class, 'index'])->name('index');
            Route::get('/create', [ClientController::class, 'create'])->name('create');
            Route::post('/', [ClientController::class, 'store'])->name('store');
        });

    // Admin invite Admin or Member into their own company.
    Route::middleware(EnsureRole::class.':'.User::ROLE_ADMIN)
        ->prefix('team')
        ->name('team.')
        ->group(function () {
            Route::get('/', [TeamController::class, 'index'])->name('index');
            Route::get('/invite', [TeamController::class, 'create'])->name('create');
            Route::post('/invite', [TeamController::class, 'store'])->name('store');
        });
});
