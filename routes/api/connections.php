<?php

use App\Http\Controllers\Api\Connections\AcceptController;
use App\Http\Controllers\Api\Connections\IndexController;
use App\Http\Controllers\Api\Connections\RejectController;
use App\Http\Controllers\Api\Connections\SendController;
use Illuminate\Support\Facades\Route;

    Route::post('/send/{user}', SendController::class);
    Route::post('/accept/{connection}', AcceptController::class);
    Route::post('/reject/{connection}', RejectController::class);
    Route::get('/', IndexController::class);
