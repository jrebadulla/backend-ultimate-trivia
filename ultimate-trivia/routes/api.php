<?php
use App\Http\Controllers\LoginController;

Route::get('/getUsers', [LoginController::class, 'getUsers']);
Route::post('/insertUsers', [LoginController::class, 'insertUsers']);
Route::post('/userLogin', [LoginController::class, 'login']);