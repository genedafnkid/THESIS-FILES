<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommunityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ModuleController;


// 🔓 Public Route
Route::get('/', function () {
    return view('welcome');
});

// 🔐 Authenticated Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 🔐 Authenticated Routes
Route::middleware('auth')->group(function () {

    // 📘 Community
    Route::get('/community', [CommunityController::class, 'index'])->name('community');
    Route::post('/community', [CommunityController::class, 'store'])->name('community.store');
    Route::post('/community/{post}/reply', [CommunityController::class, 'reply'])->name('community.reply');


    // 📚 Modules
    Route::get('/modules', fn() => view('modules'))->name('modules');

    // 🕊️ Virtual Faith Room
    Route::get('/faith-room', fn() => view('faith-room'))->name('faith-room');

    // ⚙️ Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 🛠 Admin-only routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users');
        Route::post('/admin/approve-user/{id}/{role}', [AdminController::class, 'approveUser'])->name('admin.approveUser');
    });

    Route::middleware(['role:instructor'])->group(function () {
    Route::get('/instructor/dashboard', [InstructorController::class, 'index']);
    });

    Route::middleware(['role:student'])->group(function () {
        Route::get('/student/dashboard', [StudentController::class, 'index']);
    });

    Route::resource('modules', ModuleController::class);


});

require __DIR__.'/auth.php';
