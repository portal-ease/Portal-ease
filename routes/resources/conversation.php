<?php

use App\Http\Controllers\ConversationController;

Route::middleware(['auth', 'verified', 'portal-feature:conversations'])->group(function () {
    Route::get('/{portal}/user/{user}/chat', [ConversationController::class, 'index'])->name('portal.user.chat');
});
