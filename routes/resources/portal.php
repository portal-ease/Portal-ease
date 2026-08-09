<?php

use App\Http\Controllers\PortalController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/portal', [PortalController::class, 'index'])->name('portal.index');
    Route::get('/portal/create', [PortalController::class, 'create'])->name('portal.create');
    Route::post('/portal', [PortalController::class, 'store'])->name('portal.store');
    Route::get('/portal/{portal}', [PortalController::class, 'show'])->name('portal.show');

    Route::middleware('block-clients')->group(function () {
        Route::get('/portal/{portal}/edit', [PortalController::class, 'edit'])->name('portal.edit');
        Route::put('/portal/{portal}', [PortalController::class, 'update'])->name('portal.update');
        Route::delete('/portal/{portal}', [PortalController::class, 'destroy'])->name('portal.destroy');
    });
    Route::get('/portal/{portal}/verify', [PortalController::class, 'verify'])->name('portal.verify');
});
