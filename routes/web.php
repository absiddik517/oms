<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Letter\FolderController;
use App\Http\Controllers\Letter\LetterTypeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\OfficeController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('offices', OfficeController::class)->middleware(['auth', 'verified']);
Route::resource('letter-types', LetterTypeController::class)->middleware(['auth', 'verified']);
Route::resource('folders', FolderController::class)->middleware(['auth', 'verified']);

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
