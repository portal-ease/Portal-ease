<?php

use App\Http\Controllers\InvoiceController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware('block-clients')->group(function () {
        Route::get('/portal/{portal}/invoice', [InvoiceController::class, 'index'])->name('portal.invoice.index');
        Route::get('/portal/{portal}/invoice/create', [InvoiceController::class, 'create'])->name('portal.invoice.create');
        Route::post('/portal/{portal}/invoice', [InvoiceController::class, 'store'])->name('portal.invoice.store');
        Route::get('/portal/{portal}/invoice/{invoice}/edit', [InvoiceController::class, 'edit'])->name('portal.invoice.edit');
        Route::put('/portal/{portal}/invoice/{invoice}', [InvoiceController::class, 'update'])->name('portal.invoice.update');
        Route::delete('/portal/{portal}/invoice/{invoice}', [InvoiceController::class, 'destroy'])->name('portal.invoice.destroy');
    });
    Route::get('/portal/{portal}/invoice/{invoice}', [InvoiceController::class, 'show'])->name('portal.invoice.show');
    Route::get('/portal/{invoice}/download', [InvoiceController::class, 'download'])->name('portal.invoice.download');
    Route::patch('/{portal}/{invoice}/payment', [InvoiceController::class, 'payment'])->name('portal.invoice.payment');
});
