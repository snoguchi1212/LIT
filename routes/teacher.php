<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Teacher\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Teacher\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Teacher\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Teacher\Auth\NewPasswordController;
use App\Http\Controllers\Teacher\Auth\PasswordResetLinkController;
use App\Http\Controllers\Teacher\Auth\RegisteredUserController;
use App\Http\Controllers\Teacher\Auth\VerifyEmailController;
use App\Http\Controllers\Teacher\StudentsInChargeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('teacher.welcome');
// });

Route::get('/dashboard', function () {
    return view('teacher.dashboard');
})->middleware(['auth:teachers'])->name('dashboard');

Route::prefix('studentsInCharge')
->middleware('auth:teachers')->group(function () {
    Route::get('index', [StudentsInChargeController::class, 'index'])->name('studentsInCharge');
    Route::get('show/{student}', [StudentsInChargeController::class, 'show'])->name('studentsInCharge.show');
    Route::get('showOrderBySubject/{student}', [StudentsInChargeController::class, 'showOrderBySubject'])->name('studentsInCharge.showOrderBySubject');
});

Route::middleware('guest:teachers')->group(function () {
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
                ->name('password.update');
});

Route::middleware('auth:teachers')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
