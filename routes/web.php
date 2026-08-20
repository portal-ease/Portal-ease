<?php

use App\Notifications\EmailVerified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Resources
require __DIR__.'/resources/website.php';
require __DIR__.'/resources/auth.php';
require __DIR__.'/resources/conversation.php';
require __DIR__.'/resources/file.php';
require __DIR__.'/resources/invoice.php';
require __DIR__.'/resources/portal.php';
require __DIR__.'/resources/project.php';
require __DIR__.'/resources/user.php';

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
