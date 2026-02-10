<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes (Customer / General User)
|--------------------------------------------------------------------------
*/

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
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Full Access Control)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // 📊 Admin Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // 📦 Product Management
    Route::prefix('products')->name('products.')->group(function () {
        // Main List (Active)
        Route::get('/', [ProductController::class, 'index'])->name('index');
        
        // Archived List Page
        Route::get('/archived-list', [ProductController::class, 'archived'])->name('archived');
        
        // Add / Store
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        
        // --- ADDED THIS LINE TO FIX THE 404 ERROR WHEN VIEWING ---
        Route::get('/{id}', [ProductController::class, 'show'])->name('show');
        
        // --- ADDED THIS LINE TO FIX THE ERROR ---
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
        
        // Update (Used by Edit Modal)
        Route::put('/{id}/update', [ProductController::class, 'update'])->name('update');
        
        // Archive Action (Requirement: Redirects to Archived Page)
        Route::patch('/{id}/archive', [ProductController::class, 'archive'])->name('archive');
        
        // Delete (Permanent)
        Route::delete('/{id}/delete', [ProductController::class, 'destroy'])->name('destroy');

        // 📥 Tools
        Route::post('/import', [ProductController::class, 'import'])->name('import');
        Route::get('/export', [ProductController::class, 'export'])->name('export');
        Route::post('/batch-upload', [ProductController::class, 'batchUpload'])->name('batch.upload');
    });

    // ⚙️ Admin Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Authentication Requirements
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
require __DIR__.'/admin-auth.php';
require __DIR__.'/teacher-auth.php';