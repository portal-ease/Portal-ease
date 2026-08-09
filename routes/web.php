<?php

use App\Notifications\EmailVerified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Website
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

// Resources
include './resources/auth.php';
include './resources/conversation.php';
include './resources/file.php';
include './resources/invoice.php';
include './resources/portal.php';
include './resources/project.php';
include './resources/user.php';

/** @todo this will be replaced with controllers/service way */
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
