<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Letter\FolderController;
use App\Http\Controllers\Letter\RecipientController;
use App\Http\Controllers\Letter\TopicController;
use App\Http\Controllers\Office\OfficerController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\OfficeController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('offices', OfficeController::class)->middleware(['auth', 'verified']);
Route::resource('folders', FolderController::class)->middleware(['auth', 'verified']);
Route::resource('topics', TopicController::class)->middleware(['auth', 'verified']);
Route::resource('recipients', RecipientController::class)->middleware(['auth', 'verified']);

Route::group(['prefix' => 'letters', 'as' => 'letters.', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', [App\Http\Controllers\Letter\LetterController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\Letter\LetterController::class, 'create'])->name('create');
    Route::post('/', [App\Http\Controllers\Letter\LetterController::class, 'store'])->name('store');
    Route::get('/{letter}/edit', [App\Http\Controllers\Letter\LetterController::class, 'edit'])->name('edit');
    Route::post('/{letter}/update', [App\Http\Controllers\Letter\LetterController::class, 'update'])->name('update');
    Route::delete('/{letter}', [App\Http\Controllers\Letter\LetterController::class, 'destroy'])->name('destroy');
    Route::get('/{letter}', [App\Http\Controllers\Letter\LetterController::class, 'show'])->name('show');
});

Route::resource('officers', OfficerController::class)->middleware(['auth', 'verified']);    



require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
