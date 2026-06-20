<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\AcceptInvitationController;
use App\Http\Controllers\ShortUrlController;

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

    Route::get('/invitations/create', [InvitationController::class,'create',])->name('invitations.create');

    Route::post('/invitations', [InvitationController::class,'store',])->name('invitations.store');

    Route::get('/short-urls/create',[ShortUrlController::class, 'create'])->name('short-urls.create');

    Route::post('/short-urls',[ShortUrlController::class, 'store'])->name('short-urls.store');

    Route::get('/short-urls',[ShortUrlController::class, 'index'])->name('short-urls.index');

});

Route::get('/accept-invitation/{token}',[AcceptInvitationController::class, 'show'])->name('invitations.accept');

Route::post('/accept-invitation/{token}',[AcceptInvitationController::class, 'store'])->name('invitations.accept.store');

Route::get('/s/{shortCode}',[ShortUrlController::class, 'redirect'])->name('short-urls.redirect');

require __DIR__.'/auth.php';
