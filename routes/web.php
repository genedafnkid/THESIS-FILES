<?php

use App\Http\Controllers\AchievementsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommunityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnnouncementController;
use Illuminate\Http\Request;

// Public Route
Route::get('/', function () {
    return view('welcome');
});

// 🔐 Authenticated Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/leaderboards', [\App\Http\Controllers\LeaderboardController::class, 'index'])
    ->name('leaderboards');

// Provide user ID for Unity
Route::middleware(['auth'])->get('/user', function (Request $request) {
    return response()->json(['id' => $request->user()->id]);
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
        Route::get('/admin/users/approved', [AdminController::class, 'approved'])->name('admin.users.approved');
        Route::post('/admin/approve-user/{id}/{role}', [AdminController::class, 'approveUser'])->name('admin.approveUser');
        Route::patch('/admin/deny-user/{id}', [AdminController::class, 'denyUser'])->name('admin.denyUser');
        Route::patch('/admin/revoke-user/{id}', [AdminController::class, 'revokeUser'])->name('admin.revokeUser');
        Route::post('/admin/change-role/{id}/{role}', [AdminController::class, 'changeRole'])->name('admin.changeRole');
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
    Route::get('/achievements', [AchievementsController::class, 'index'])->name('achievements');

    // 🎮 Play game views
    Route::get('/play{game}', function ($game) {
        $view = 'play' . (int) $game;
        if (!view()->exists($view)) {
            abort(404, "Game view not found.");
        }
        return view($view, ['gameNumber' => (int) $game]);
    })->whereNumber('game');
});

require __DIR__ . '/auth.php';
