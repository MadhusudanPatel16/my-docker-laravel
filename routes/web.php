<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

     Route::get('/users', [UserController::class, 'index'])->name('users.index');
     Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
     Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.delete');

       Route::prefix('books')->group(function () {
        Route::get('/', [BookController::class, 'manageBookList'])->name('books.list');
        Route::post('/store', [BookController::class, 'manageBookData'])->name('books.store');
        Route::put('/update/{book_id}', [BookController::class, 'manageBookData'])->name('books.update');
        Route::delete('/delete/{id}', [BookController::class, 'deleteBook'])->name('books.delete');
    });
});

require __DIR__.'/auth.php';
