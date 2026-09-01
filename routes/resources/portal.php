<?php

use App\Http\Controllers\PortalController;

Route::get('/portal', [PortalController::class, 'index'])->name('portal.index');
Route::get('/portal/create', [PortalController::class, 'create'])->name('portal.create');
Route::post('/portal', [PortalController::class, 'store'])->name('portal.store');
Route::get('/{portal}', [PortalController::class, 'show'])->name('portal.show');

Route::middleware('auth')->group(function () {
    Route::get('/portal/{portal}/verify', [PortalController::class, 'verify'])->name('portal.verify');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware('block-clients')->group(function () {
        Route::get('/{portal}/edit', [PortalController::class, 'edit'])->name('portal.edit');
        Route::put('/{portal}', [PortalController::class, 'update'])->name('portal.update');
        Route::delete('/{portal}', [PortalController::class, 'destroy'])->name('portal.destroy');
    });
});
