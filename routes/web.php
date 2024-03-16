<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\EmailVerificationController;

// Route::get('/', function () {
//     return view('');
// });

Route::controller(MemberController::class)->group(function () {
    Route::get('/', 'create');
    Route::post('/verify', 'store')->name('store');
    Route::post('/verify/{id}', 'resendVerificationMail')->name('resend-mail');
});

Route::get('/verify/{id}/{hash}', EmailVerificationController::class)->name('verify');

Route::view('/mail-sent', 'email-sent')->name('mail-sent');
