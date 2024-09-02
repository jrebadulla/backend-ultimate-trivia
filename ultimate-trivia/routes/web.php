<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserGameProgressController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LevelController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('levels', LevelController::class);
Route::resource('questions', QuestionController::class);
Route::resource('games', GameController::class);
Route::resource('user_game_progress', UserGameProgressController::class);

