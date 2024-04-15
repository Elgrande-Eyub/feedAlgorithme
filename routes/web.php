<?php

use App\Http\Controllers\algorithme;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class,'getLogin'])->name('login');
Route::post('/login', [AuthController::class,'postLogin'])->name('postLogin');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/threads', [algorithme::class,'threads'])->name('getThreads');
    Route::get('/generateScores', [algorithme::class,'generateScores'])->name('getThreads');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
