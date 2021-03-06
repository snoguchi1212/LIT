<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Student\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Student\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Student\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Student\Auth\NewPasswordController;
use App\Http\Controllers\Student\Auth\PasswordResetLinkController;
use App\Http\Controllers\Student\Auth\RegisteredUserController;
use App\Http\Controllers\Student\Auth\VerifyEmailController;
use App\Http\Controllers\Student;
use App\Http\Controllers\Student\TestsController;

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
//     return view('student.welcome');
// });

Route::get('/dashboard', function () {
    return view('student.dashboard');
})->middleware(['auth:students'])->name('dashboard');

// Route::middleware('auth:students')->group(function () {
    //     Route::get('tests/indexOrderedSubject', [TestsController::class, 'indexOrderedSubject'])
    //                 ->name('tests.indexOrderSubject');
    // });
Route::prefix('tests')
    ->middleware('auth:students')->group(function () {
        Route::get('indexOrderBySubject', [TestsController::class, 'indexOrderBySubject'])->name('tests.indexOrderBySubject');
});

    Route::resource('tests', TestsController::class)
    ->middleware('auth:students');



Route::middleware('guest:students')->group(function () {
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

Route::middleware('auth:students')->group(function () {
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
