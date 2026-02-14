<?php
use App\Http\Controllers\Api\ProfileApiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProfileApiController::class, 'show']);
Route::patch('/', [ProfileApiController::class, 'update']);
Route::delete('/', [ProfileApiController::class, 'destroy']);