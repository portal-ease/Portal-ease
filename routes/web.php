<?php

use App\Http\Controllers\ConversationController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\AuthenticatedController;
use App\Http\Controllers\FileController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/features', function () {
    return view('features');
})->name('features');
Route::get('/support', function () {
    return view('support');
})->name('support');
Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::resource('portal', PortalController::class);
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('portal.user', UserController::class);
    Route::get('/portal/{portal}/user/{user}/chat', [ConversationController::class, 'index'])->name('portal.user.chat');
    Route::resource('portal.invoice', InvoiceController::class);
    Route::get('/portal/{portal}/notifications', [UserController::class, 'notification'])->name('portal.notification.index');
    Route::resource('portal.project', ProjectController::class);
    Route::resource('portal.file', FileController::class);
    Route::post('/portal/{portal}/user/{user}/picture', [UserController::class, 'editProfilePicture'])->name('portal.user.profile');
    //File download
    Route::get('/portal/{file}/download', [FileController::class, 'download'])->name('portal.file.download');
    Route::get('/portal/{portal}/verify', [PortalController::class, 'verify'])->name('portal.verify');
    //Downloading invoice file and paying invoice
    Route::get('/portal/{invoice}/download', [InvoiceController::class, 'download'])->name('portal.invoice.download');
    Route::patch('/{portal}/{invoice}/payment', [InvoiceController::class, 'payment'])->name('portal.invoice.payment');
});

// auth routes
Route::post('/login/request', [AuthenticatedController::class, 'store'])->name('login.request');
Route::get('/logout/request', [AuthenticatedController::class, 'destroy'])->name('logout.request');
