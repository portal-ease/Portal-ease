<?php

use App\Http\Controllers\AuthenticatedController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Notifications\EmailVerified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/features', function () {
    return view('features');
})->name('features');

Route::get('/support', function () {
    return view('support');
})->name('support');

Route::get('/about', function () {
    return view('about');
})->name('about');

//
// Portal routes
//
Route::get('/portal', [PortalController::class, 'index'])->name('portal.index');
Route::get('/portal/create', [PortalController::class, 'create'])->name('portal.create');
Route::post('/portal', [PortalController::class, 'store'])->name('portal.store');
Route::get('/portal/{portal}', [PortalController::class, 'show'])->name('portal.show');

Route::middleware(['auth', 'verified'])->group(function () {

    //
    // Service provider routes
    //
    Route::middleware('block-clients')->group(function () {
        Route::get('/portal/{portal}/user', [UserController::class, 'index'])->name('portal.user.index');
        Route::get('/portal/{portal}/user/create', [UserController::class, 'create'])->name('portal.user.create');
        Route::get('/portal/{portal}/invoice', [InvoiceController::class, 'index'])->name('portal.invoice.index');
        Route::get('/portal/{portal}/invoice/create', [InvoiceController::class, 'create'])->name('portal.invoice.create');
        Route::post('/portal/{portal}/invoice', [InvoiceController::class, 'store'])->name('portal.invoice.store');
        Route::get('/portal/{portal}/invoice/{invoice}/edit', [InvoiceController::class, 'edit'])->name('portal.invoice.edit');
        Route::put('/portal/{portal}/invoice/{invoice}', [InvoiceController::class, 'update'])->name('portal.invoice.update');
        Route::delete('/portal/{portal}/invoice/{invoice}', [InvoiceController::class, 'destroy'])->name('portal.invoice.destroy');
        Route::get('/portal/{portal}/project', [ProjectController::class, 'index'])->name('portal.project.index');
        Route::get('/portal/{portal}/project/create', [ProjectController::class, 'create'])->name('portal.project.create');
        Route::post('/portal/{portal}/project', [ProjectController::class, 'store'])->name('portal.project.store');
        Route::get('/portal/{portal}/project/{project}/edit', [ProjectController::class, 'edit'])->name('portal.project.edit');
        Route::put('/portal/{portal}/project/{project}', [ProjectController::class, 'update'])->name('portal.project.update');
        Route::delete('/portal/{portal}/project/{project}', [ProjectController::class, 'destroy'])->name('portal.project.destroy');
        Route::get('/portal/{portal}/file/create', [FileController::class, 'create'])->name('portal.file.create');
        Route::post('/portal/{portal}/file', [FileController::class, 'store'])->name('portal.file.store');
        Route::get('/portal/{portal}/file/{file}/edit', [FileController::class, 'edit'])->name('portal.file.edit');
        Route::put('/portal/{portal}/file/{file}', [FileController::class, 'update'])->name('portal.file.update');
        Route::delete('/portal/{portal}/file/{file}', [FileController::class, 'destroy'])->name('portal.file.destroy');
        Route::get('/portal/{portal}/edit', [PortalController::class, 'edit'])->name('portal.edit');
        Route::put('/portal/{portal}', [PortalController::class, 'update'])->name('portal.update');
        Route::delete('/portal/{portal}', [PortalController::class, 'destroy'])->name('portal.destroy');
        Route::post('/portal/{portal}/user', [UserController::class, 'store'])->name('portal.user.store');
        Route::put('/portal/{portal}/user/{user}', [UserController::class, 'update'])->name('portal.user.update');
        Route::delete('/portal/{portal}/user/{user}', [UserController::class, 'destroy'])->name('portal.user.destroy');

    });
    //
    // User routes
    //
    Route::get('/portal/{portal}/user/{user}', [UserController::class, 'show'])->name('portal.user.show');
    Route::get('/portal/{portal}/user/{user}/edit', [UserController::class, 'edit'])->name('portal.user.edit');

    Route::get('/portal/{portal}/notifications', [UserController::class, 'notification'])->name('portal.notification.index');
    Route::post('/portal/{portal}/user/{user}/picture', [UserController::class, 'editProfilePicture'])->name('portal.user.profile');

    //
    // Conversation routes
    //
    Route::get('/portal/{portal}/user/{user}/chat', [ConversationController::class, 'index'])->name('portal.user.chat');

    //
    // Invoice routes
    //
    Route::get('/portal/{portal}/invoice/{invoice}', [InvoiceController::class, 'show'])->name('portal.invoice.show');

    //
    // Project routes
    //
    Route::get('/portal/{portal}/project/{project}', [ProjectController::class, 'show'])->name('portal.project.show');

    //
    // File routes
    //
    Route::get('/portal/{portal}/file', [FileController::class, 'index'])->name('portal.file.index');

    //
    // Extra routes
    //
    Route::get('/portal/{file}/download', [FileController::class, 'download'])->name('portal.file.download');

    Route::get('/portal/{portal}/verify', [PortalController::class, 'verify'])->name('portal.verify');

    Route::get('/portal/{invoice}/download', [InvoiceController::class, 'download'])->name('portal.invoice.download');

    Route::patch('/{portal}/{invoice}/payment', [InvoiceController::class, 'payment'])->name('portal.invoice.payment');
});

//
// Authentication
//
Route::post('/login/request', [AuthenticatedController::class, 'store'])->name('login.request');
Route::get('/logout/request', [AuthenticatedController::class, 'destroy'])->name('logout.request');

Route::middleware('auth')->group(function () {

    // Show the "Please verify your email" page
    Route::get('/email/verify', function () {
        return view('portal.verify');
    })->name('verification.notice');

    // Handle the verification link
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        $portal = $request->user()->portal;
        $user = $request->user();

        $user->notify(new EmailVerified($user));

        return redirect()->route('portal.show', compact('portal', 'user'));
    })->middleware(['signed'])->name('verification.verify');

    // Resend verification email
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    })->middleware(['throttle:6,1'])->name('verification.send');
});
