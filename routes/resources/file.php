<?php

use App\Http\Controllers\FileController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware('block-clients')->group(function () {
        Route::get('/{portal}/file/create', [FileController::class, 'create'])->name('portal.file.create');
        Route::post('/{portal}/file', [FileController::class, 'store'])->name('portal.file.store');
        Route::get('/{portal}/file/{file}/edit', [FileController::class, 'edit'])->name('portal.file.edit');
        Route::put('/{portal}/file/{file}', [FileController::class, 'update'])->name('portal.file.update');
        Route::delete('/{portal}/file/{file}', [FileController::class, 'destroy'])->name('portal.file.destroy');
    });

    Route::get('/{portal}/file', [FileController::class, 'index'])->name('portal.file.index');
    Route::get('/{portal}/file/{file}', [FileController::class, 'show'])->name('portal.file.show');
    Route::get('/{portal}/file/{file}/download', [FileController::class, 'download'])->name('portal.file.download');
});
