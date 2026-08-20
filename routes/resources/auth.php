<?php

use App\Http\Controllers\AuthenticatedController;

Route::post('/login/request', [AuthenticatedController::class, 'store'])->name('login.request');
Route::get('/logout/request', [AuthenticatedController::class, 'destroy'])->name('logout.request');
