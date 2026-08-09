<?php

use App\Http\Controllers\FileController;

Route::middleware('block-clients')->group(function () {
    Route::get('/portal/{portal}/file/create', [FileController::class, 'create'])->name('portal.file.create');
    Route::post('/portal/{portal}/file', [FileController::class, 'store'])->name('portal.file.store');
    Route::get('/portal/{portal}/file/{file}/edit', [FileController::class, 'edit'])->name('portal.file.edit');
    Route::put('/portal/{portal}/file/{file}', [FileController::class, 'update'])->name('portal.file.update');
    Route::delete('/portal/{portal}/file/{file}', [FileController::class, 'destroy'])->name('portal.file.destroy');
});
Route::get('/portal/{portal}/file', [FileController::class, 'index'])->name('portal.file.index');
Route::get('/portal/{portal}/file/{file}', [FileController::class, 'show'])->name('portal.file.show');
Route::get('/portal/{file}/download', [FileController::class, 'download'])->name('portal.file.download');
