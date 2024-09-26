<?php
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PlaytimesController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserGameProgressController;
use App\Http\Controllers\UsersAnswersController;

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

Route::get('user-progress', [UserGameProgressController::class, 'getProgress']);

Route::get('updateScore', [UserGameProgressController::class, 'updateScore']);
Route::post('saveUserScore', [UserGameProgressController::class, 'saveUserScore']);
Route::get('users-score', [UserGameProgressController::class, 'getUserProgress']);

Route::post('/chat', [ChatController::class, 'handleChat']);

Route::get('/user-high-score', [UserGameProgressController::class, 'getUserHighScore']);

Route::post('/user-answers', [UsersAnswersController::class, 'store']);

Route::get('/user-difficulty', [UsersAnswersController::class, 'getDifficulty']);

Route::get('/games-name', [GameController::class, 'apiGames']);

Route::get('/user-playtime', [PlaytimesController::class, 'getUserPlaytime']);





