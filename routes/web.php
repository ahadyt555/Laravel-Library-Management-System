<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BorrowRequestController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', [AdminController::class, 'admin'])
   ->middleware(['auth', 'verified'])->name('admin.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => 'book', 'as' => 'books.'], function(){
        Route::get('/create', [BookController::class, 'create'])->name('create');
        Route::post('/create', [BookController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BookController::class, 'edit'])->name('edit');
        Route::post('/update', [BookController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [BookController::class, 'destroy'])->name('delete');
        Route::post('/books/{id}/assign', [BookController::class, 'assignBook'])->name('assign');
        Route::post('/books/{id}/return', [BookController::class, 'returnBook'])->name('return');
    });

    Route::post('/borrow-request', [BorrowRequestController::class, 'store'])->name('borrow.request');
});

require __DIR__.'/auth.php';
