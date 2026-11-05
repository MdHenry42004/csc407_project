<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DonationController;

Route::redirect('/', '/contacts');

Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/contacts/{id}', [ContactController::class, 'show'])->name('contacts.show');
Route::post('/contacts/{id}/register-event', [ContactController::class, 'registerEvent'])->name('contacts.register-event');
Route::post('/contacts/{id}/donate', [ContactController::class, 'storeDonation'])->name('contacts.donate');

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/donations', [DonationController::class, 'index'])->name('donations.index');