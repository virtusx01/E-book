<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;


// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Kategori
Route::resource('categories', CategoryController::class);

// Buku
Route::prefix('books')->name('books.')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('index');
    Route::get('/add', [BookController::class, 'addBookForm'])->name('add');
    Route::post('/store', [BookController::class, 'storeBook'])->name('store');
    Route::get('/{book}/edit', [BookController::class, 'editBook'])->name('edit');
    Route::put('/{book}/update', [BookController::class, 'storeBook'])->name('update');
    Route::delete('/{book}', [BookController::class, 'deleteBook'])->name('delete');
    Route::get('/{book}', [BookController::class, 'show'])->name('show');
});