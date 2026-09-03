<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;

Route::get('/{portal}/forgot-password', [ForgotPasswordController::class, 'create'])
    ->name('password.request');

Route::post('/{portal}/forgot-password', [ForgotPasswordController::class, 'store'])
    ->name('password.email');

Route::get('/{portal}/reset-password/{token}', [ResetPasswordController::class, 'create'])
    ->name('password.reset');

Route::post('/{portal}/reset-password', [ResetPasswordController::class, 'store'])
    ->name('password.update');
