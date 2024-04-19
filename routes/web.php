<?php
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Public routes
Route::get('/', function () {
    return Inertia::render('Welcome');
});

// Authenticated routes group
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard route
    Route::get('/dashboard', [SiteController::class, 'index'])->name('dashboard');

    // Books routes
    Route::prefix('books')->group(function () {
        Route::get('/', [BookController::class, 'index'])->name('books');
        Route::get('/create', [BookController::class, 'create'])->name('books.create');
        Route::post('/store', [BookController::class, 'store'])->name('books.store');
        Route::post('/update', [BookController::class, 'update'])->name('books.update');
        Route::post('/delete', [BookController::class, 'delete'])->name('books.delete');
        Route::get('/edit/{id}', [BookController::class, 'edit'])->name('books.edit');
        Route::get('/{id}', [BookController::class, 'read'])->name('books.read');
    });

    // Stores routes
    Route::prefix('stores')->group(function () {
        Route::get('/', [StoreController::class, 'index'])->name('stores');
        Route::get('/delete-books', [StoreController::class, 'deleteBooks'])->name('stores.deleteBooks');
        Route::get('/create', [StoreController::class, 'create'])->name('stores.create');
        Route::post('/update', [StoreController::class, 'update'])->name('stores.update');
        Route::post('/delete', [StoreController::class, 'delete'])->name('stores.delete');
        Route::post('/store', [StoreController::class, 'store'])->name('stores.store');
        Route::get('/edit/{id}', [StoreController::class, 'edit'])->name('stores.edit');
        Route::get('/{id}', [StoreController::class, 'read'])->name('stores.read');
    });

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include authentication routes
require __DIR__.'/auth.php';
