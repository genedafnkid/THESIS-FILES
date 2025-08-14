<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ScoreController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/scores', [ScoreController::class, 'store']);
Route::get('/scores/latest', [ScoreController::class, 'latest']);
Route::get('/scores/leaderboard', [ScoreController::class, 'leaderboard']);

Route::post('/scores-test', function (Request $r) {
    \Log::info('scores-test', $r->all());   // writes to storage/logs/laravel.log
    return response()->json(['ok' => true, 'got' => $r->all()]);
});

// routes/api.php
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

