<?php

use App\Http\Controllers\UserController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware('block-clients')->group(function () {
        Route::get('/portal/{portal}/user', [UserController::class, 'index'])->name('portal.user.index');
        Route::get('/portal/{portal}/user/create', [UserController::class, 'create'])->name('portal.user.create');
        Route::post('/portal/{portal}/user', [UserController::class, 'store'])->name('portal.user.store');
        Route::put('/portal/{portal}/user/{user}', [UserController::class, 'update'])->name('portal.user.update');
        Route::delete('/portal/{portal}/user/{user}', [UserController::class, 'destroy'])->name('portal.user.destroy');

    });
    Route::get('/portal/{portal}/user/{user}', [UserController::class, 'show'])->name('portal.user.show');
    Route::get('/portal/{portal}/user/{user}/edit', [UserController::class, 'edit'])->name('portal.user.edit');
    Route::get('/portal/{portal}/notifications', [UserController::class, 'notification'])->name('portal.notification.index');
    Route::post('/portal/{portal}/user/{user}/picture', [UserController::class, 'editProfilePicture'])->name('portal.user.profile');
});
