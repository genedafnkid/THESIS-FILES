<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommunityController;
use Illuminate\Support\Facades\Route;

// 🔓 Public Route
Route::get('/', function () {
    return view('welcome');
});

// 🔐 Authenticated Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 🔐 Authenticated Group
Route::middleware('auth')->group(function () {
    // 📘 Community routes
    Route::get('/community', [CommunityController::class, 'index'])->name('community');
    Route::post('/community', [CommunityController::class, 'store'])->name('community.store');

    // 📚 Modules route
    Route::get('/modules', function () {
        return view('modules');
    })->name('modules');

    // 🕊️ Virtual Faith Room
    Route::get('/faith-room', function () {
        return view('faith-room');
    })->name('faith-room');

    // ⚙️ Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

