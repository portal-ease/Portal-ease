<?php

use App\Http\Controllers\ProjectController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware('block-clients')->group(function () {
        Route::get('/portal/{portal}/project', [ProjectController::class, 'index'])->name('portal.project.index');
        Route::get('/portal/{portal}/project/create', [ProjectController::class, 'create'])->name('portal.project.create');
        Route::post('/portal/{portal}/project', [ProjectController::class, 'store'])->name('portal.project.store');
        Route::get('/portal/{portal}/project/{project}/edit', [ProjectController::class, 'edit'])->name('portal.project.edit');
        Route::put('/portal/{portal}/project/{project}', [ProjectController::class, 'update'])->name('portal.project.update');
        Route::delete('/portal/{portal}/project/{project}', [ProjectController::class, 'destroy'])->name('portal.project.destroy');
    });
    Route::get('/portal/{portal}/project/{project}', [ProjectController::class, 'show'])->name('portal.project.show');
});
