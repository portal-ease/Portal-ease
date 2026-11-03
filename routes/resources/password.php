<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ActivateAccountController;

Route::get('/{portal}/forgot-password', [ForgotPasswordController::class, 'create'])
    ->name('password.request');

Route::post('/{portal}/forgot-password', [ForgotPasswordController::class, 'store'])
    ->name('password.email');

Route::get('/{portal}/reset-password/{token}', [ResetPasswordController::class, 'create'])
    ->name('password.reset');

Route::post('/{portal}/reset-password', [ResetPasswordController::class, 'store'])
    ->name('password.update');

Route::get('/{portal}/activate-account/{token}', [ActivateAccountController::class, 'create'])
    ->name('activation.create');

Route::post('/{portal}/activate-account', [ActivateAccountController::class, 'store'])
    ->name('activation.store');
