<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommunityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnnouncementController;


use App\Http\Controllers\Api\ScoreController;
use Illuminate\Http\Request;
use App\Models\Score;

// Public Route
Route::get('/', function () {
    return view ('welcome');
});

// 🔐 Authenticated Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Authenticated Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
//score saving
Route::middleware(['web','auth'])->post('/scores', [ScoreController::class, 'store']);
//play games
Route::middleware(['auth'])->get('/play1', function () {
    return view('play1');
});
Route::middleware(['auth'])->get('/play2', function () {
    return view('play2');
});

Route::middleware(['auth'])->get('/user', function (Request $request) {
    return response()->json(['id' => $request->user()->id]);
});


Route::post('/scores', function (Request $request) {
    $request->validate([
        'score' => 'required|integer',
        'user_id' => 'required|exists:users,id',
    ]);

    $score = Score::create([
        'score' => $request->score,
        'user_id' => $request->user_id,
    ]);

    return response()->json([
        'status' => 'ok',
        'saved' => $score,
    ]);
});

// 🔐 Authenticated Routes
Route::middleware('auth')->group(function () {

    // 📘 Community
    Route::get('/community', [CommunityController::class, 'index'])->name('community');
    Route::post('/community', [CommunityController::class, 'store'])->name('community.store');
    Route::post('/community/{post}/reply', [CommunityController::class, 'reply'])->name('community.reply');
    Route::get('/community/{post}/edit', [CommunityController::class, 'edit'])->name('community.edit');
    Route::put('/community/{post}', [CommunityController::class, 'update'])->name('community.update');
    Route::delete('/community/{post}', [CommunityController::class, 'destroy'])->name('community.destroy');

    // 📚 Modules
    Route::get('/modules', fn() => view('modules'))->name('modules');
    Route::resource('modules', ModuleController::class);


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

    // 📘 Replies
    Route::get('/replies/{reply}/edit', [CommunityController::class, 'editReply'])->name('replies.edit');
    Route::put('/replies/{reply}', [CommunityController::class, 'updateReply'])->name('replies.update');
    Route::delete('/replies/{reply}', [CommunityController::class, 'destroyReply'])->name('replies.destroy');

    Route::resource('announcements', AnnouncementController::class);

    Route::middleware(['role:instructor'])->group(function () {
    Route::get('/instructor/dashboard', [InstructorController::class, 'index']);
    });

    Route::middleware(['role:student'])->group(function () {
        Route::get('/student/dashboard', [StudentController::class, 'index']);
    });

    Route::resource('modules', ModuleController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


});

require __DIR__.'/auth.php';
