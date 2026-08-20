<?php
use App\Http\Controllers\WebsiteController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/features', function () {
    return view('features');
})->name('features');

Route::get('/support', function () {
    return view('support');
})->name('support');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::post('/contact', [WebsiteController::class, 'contact'])->name('website.contact');
