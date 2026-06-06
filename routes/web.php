<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\LandingController::class, 'index']);
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');
