<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Owner\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Owner\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Owner\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Owner\Auth\NewPasswordController;
use App\Http\Controllers\Owner\Auth\PasswordResetLinkController;
use App\Http\Controllers\Owner\Auth\RegisteredUserController;
use App\Http\Controllers\Owner\Auth\VerifyEmailController;
use App\Http\Controllers\Owner\StudentsController;
use App\Http\Controllers\Owner\TeachersController;
use App\Http\Controllers\Owner\StudentsInChargeController;

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

Route::get('/', function () {
    return view('owner.welcome');
});

Route::get('/dashboard', function () {
    return view('owner.dashboard');
})->middleware(['auth:owner'])->name('dashboard');

Route::prefix('students', StudentsController::class)
    ->middleware('auth:owner')->group(function(){
        Route::get('createFromCSV', [StudentsController::class, 'createFromCSV'])->name('students.createFromCSV');
        Route::post('createFromCSV', [StudentsController::class, 'storeFromCSV'])->name('students.storeFromCSV');
    });

Route::prefix('students/tests', StudentsController::class)
    ->middleware('auth:owner')->group(function(){
        Route::get('postCSV',  [StudentsController::class, 'postCSV'])->name('students.tests.postCSV');
    });

Route::resource('students', StudentsController::class)
    ->middleware('auth:owner');

Route::prefix('leaved-students')->
middleware('auth:owner')->group(function(){
    Route::get('index', [StudentsController::class, 'leavedStudentsIndex'])->name('leaved-students.index');
    Route::post('destroy/{student}', [StudentsController::class, 'leavedStudentsDestroy'])->name('leaved-students.destroy');
});

Route::prefix('teachers/studentsInCharge')->
middleware('auth:owner')->group(function(){
    Route::get('index/{teacher}', [StudentsInChargeController::class, 'index'])->name('teachers.studentsInCharge.index');
    Route::get('edit/{teacher}/{gradeId?}', [StudentsInChargeController::class, 'edit'])->name('teachers.studentsInCharge.edit');
    Route::post('upsert/{teacher}', [StudentsInChargeController::class, 'upsert'])->name('teachers.studentsInCharge.upsert');
});

Route::prefix('teachers', TeachersController::class)
    ->middleware('auth:owner')->group(function(){
        Route::get('createFromCSV', [TeachersController::class, 'createFromCSV'])->name('teachers.createFromCSV');
        Route::post('createFromCSV', [TeachersController::class, 'storeFromCSV'])->name('teachers.storeFromCSV');
    });

Route::resource('teachers', TeachersController::class)
    ->middleware('auth:owner');

Route::prefix('leaved-teachers')->
middleware('auth:owner')->group(function(){
    Route::get('index', [TeachersController::class, 'leavedTeachersIndex'])->name('leaved-teachers.index');
    Route::post('destroy/{student}', [TeachersController::class, 'leavedTeachersDestroy'])->name('leaved-teachers.destroy');
});

Route::middleware('guest:owner')->group(function () {
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

Route::middleware('auth:owner')->group(function () {
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
