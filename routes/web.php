<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/kunden');

Route::livewire('/login', 'pages::login')->name('login')->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::livewire('/kunden', 'pages::kunden.index');
    Route::livewire('/kunden/{customer}', 'pages::kunden.show');
    Route::livewire('/kunden/{customer}/bearbeiten', 'pages::kunden.edit');

    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    })->name('logout');
});
