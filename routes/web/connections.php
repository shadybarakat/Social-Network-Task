<?php

use App\Http\Controllers\Connections\AcceptController;
use App\Http\Controllers\Connections\FriendsController;
use App\Http\Controllers\Connections\FriendsRequestsController;
use App\Http\Controllers\Connections\RejectController;
use App\Http\Controllers\Connections\SendController;
use Illuminate\Support\Facades\Route;

    Route::post('/send/{user}', SendController::class)->name('send');
    Route::post('/accept/{connection}', AcceptController::class)->name('accept');
    Route::post('/reject/{connection}', RejectController::class)->name('reject');
    Route::get('/friends', FriendsController::class)->name('friends');
    Route::get('/requests', FriendsRequestsController::class)->name('requests');