<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Comments\DeleteController;
use App\Http\Controllers\Api\Comments\StoreController;
use App\Http\Controllers\Api\Comments\UpdateController;

Route::post('/{post}', StoreController::class);
Route::patch('/{comment}', UpdateController::class)
    ->middleware('can:update,comment');
Route::delete('/{comment}', DeleteController::class)
    ->middleware('can:delete,comment');
