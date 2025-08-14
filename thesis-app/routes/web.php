<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommunityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ScoreController;
use Illuminate\Http\Request;
use App\Models\Score;

// Public Route
Route::get('/', function () {
    return view('welcome');
});

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

