<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('payment')->group(function () {
        Route::get('/create-boleto', [PaymentController::class, 'createBoleto'])->name('payment.create-boleto');
        Route::get('/create-credit-card', [PaymentController::class, 'createCreditCard'])->name('payment.create-credit-card');
        Route::post('/validate', [PaymentController::class, 'validatePayment'])->name('payment.validate');

    });
});

require __DIR__.'/auth.php';
