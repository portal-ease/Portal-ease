<?php

use App\Http\Controllers\ChatController;
use \App\Http\Controllers\MessageController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\AuthenticatedController;
use App\Http\Controllers\FileController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::resource('portal', PortalController::class);
Route::middleware(['auth', 'verified'])->group( function () {
    Route::resource('portal.user', UserController::class);
    Route::resource('portal.invoice', InvoiceController::class );
    Route::resource('portal.chat', ChatController::class);
    Route::resource('portal.chat.message', MessageController::class);
    Route::resource('portal.project', ProjectController::class);
    Route::resource('portal.project.task', TaskController::class);
    Route::resource('portal.file', FileController::class);
    Route::get('/portal/{portal}/notifications', [UserController::class, 'notification'])->name('portal.notification.index');
    Route::post('/portal/{portal}/user/{user}/picture', [UserController::class, 'editProfilePicture'])->name('portal.user.profile');
    //File download
    Route::get('/portal/{file}/download', [FileController::class, 'download'])->name('portal.file.download');

    //Downloading invoice file and paying invoice
    Route::get('/portal/{invoice}/download', [InvoiceController::class, 'download'])->name('portal.invoice.download');
    Route::patch('/{portal}/{invoice}/payment', [InvoiceController::class, 'payment'])->name('portal.invoice.payment');
});

// auth routes
Route::post('/login/request', [AuthenticatedController::class, 'store'])->name('login.request');
Route::get('/logout/request', [AuthenticatedController::class , 'destroy'])->name('logout.request');
