<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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

       Route::prefix('books')->group(function () {
        Route::get('/', [BookController::class, 'manageBookList'])->name('books.list');
        Route::get('/create', [BookController::class, 'addBookView'])->name('books.create');
        Route::post('/store', [BookController::class, 'manageBookData'])->name('books.store');
        Route::get('/edit/{id}', [BookController::class, 'getBookData'])->name('books.edit');
        Route::put('/update/{book_id}', [BookController::class, 'manageBookData'])->name('books.update');
        Route::delete('/delete/{id}', [BookController::class, 'deleteBook'])->name('books.delete');
    });
});

require __DIR__.'/auth.php';
