<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommunityController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // 📘 Community routes
    Route::get('/community', [CommunityController::class, 'index'])->name('community');
    Route::post('/community', [CommunityController::class, 'store'])->name('community.store');

    // 📚 Modules route (static page for now)
    Route::get('/modules', function () {
        return view('modules');
    })->name('modules');

    // ⚙️ Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
