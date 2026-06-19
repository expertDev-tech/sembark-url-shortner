<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\AcceptInvitationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/invitations/create', [
        InvitationController::class,
        'create',
    ])->name('invitations.create');

    Route::post('/invitations', [
        InvitationController::class,
        'store',
    ])->name('invitations.store');
});

Route::get(
    '/accept-invitation/{token}',
    [AcceptInvitationController::class, 'show']
)->name('invitations.accept');

Route::post(
    '/accept-invitation/{token}',
    [AcceptInvitationController::class, 'store']
)->name('invitations.accept.store');

require __DIR__.'/auth.php';
