<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\ShowtimesController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\TicketsController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthenticationController::class, 'loginform'])->name('login');
Route::post('/login', [AuthenticationController::class, 'authenticate']);
Route::get('/signup', [AuthenticationController::class, 'signupform']);
Route::post('/signup', [AuthenticationController::class, 'signup']);
Route::get('/logout', [AuthenticationController::class, 'logout']);

Route::get('/', [ShowtimesController::class, 'index']);
Route::get('/movies/{id}', [MoviesController::class, 'show']);


Route::middleware(['auth'])->group(function () {
    Route::get('/comments/new/{type}/{id}', [CommentsController::class, 'create']);
    Route::post('/comments', [CommentsController::class, 'store']);

    Route::get('/showtimes/new', [ShowtimesController::class, 'create']);
    Route::post('/showtimes', [ShowtimesController::class, 'store']);

    Route::get('/statistics', [StatisticsController::class, 'index']);

    Route::get('/tickets', [TicketsController::class, 'index']);
    Route::get('/tickets/new', [TicketsController::class, 'create']);
    Route::post('/tickets', [TicketsController::class, 'store']);
});

