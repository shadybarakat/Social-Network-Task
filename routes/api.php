<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\UserSearchController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    //posts
    Route::prefix('posts')->as('posts.')->group(base_path(
        'routes/api/posts.php'
    ));
    //connections
    Route::prefix('connections')->group(base_path(
        'routes/api/connections.php'
    ));
    //comments
    Route::prefix('comments')->group(base_path(
        'routes/api/comments.php'
    ));
    //profile
    Route::prefix('profile')->group(base_path(
        'routes/api/profile.php'
    ));
    //users search
    Route::get('/users/search', [UserSearchController::class, 'index'])
        ->middleware('auth:sanctum');
});
