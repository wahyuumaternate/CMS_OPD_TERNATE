<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{
    AuthenticatedSessionController,
    ConfirmablePasswordController,
    EmailVerificationNotificationController,
    EmailVerificationPromptController,
    NewPasswordController,
    PasswordController,
    PasswordResetLinkController,
    VerifyEmailController
};

// ===============================
// ✅ Routes untuk Tamu (guest)
// ===============================
Route::middleware('guest')->group(function () {
    // === Login ===
    Route::get('/cms-opd-ternate/cp/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/cms-opd-ternate/cp/login', [AuthenticatedSessionController::class, 'store']);

    // === Forgot Password ===
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    // === Reset Password ===
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});


// ===============================
// ✅ Routes untuk Pengguna Login
// ===============================
Route::middleware('auth')->group(function () {
    // === Verifikasi Email ===
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1']) // signed untuk keamanan URL
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // === Konfirmasi Password Sebelum Aksi Sensitif ===
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // === Update Password ===
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    // === Logout ===
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
