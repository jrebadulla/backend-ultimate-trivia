<?php
use App\Http\Controllers\GameController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserGameProgressController;

Route::get('/getUsers', [LoginController::class, 'getUsers']);
Route::post('/insertUsers', [LoginController::class, 'insertUsers']);
Route::post('/userLogin', [LoginController::class, 'login']);


Route::resource('levels', LevelController::class);
Route::resource('questions', QuestionController::class);
Route::resource('games', GameController::class);

Route::resource('user_game_progress', UserGameProgressController::class);

Route::post('/store', [QuestionController::class,'store']);

Route::get('/quiz-questions', [QuizController::class, 'getQuizQuestions']);
Route::post('/{gameId}/add-question', [QuizController::class, 'addQuestionToGame']);
