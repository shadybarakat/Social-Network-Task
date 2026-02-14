<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserSearchController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //users search
    Route::get('/users/search', [UserSearchController::class, 'index'])
        ->name('users.search');

    // Public profile
    Route::get('/users/{user}', [ProfileController::class, 'show'])
        ->name('users.profile');

    //homepage
    Route::get('/', action: HomepageController::class)->name('homepage');

    //posts
    Route::prefix('posts')->as('posts.')->group(base_path(
        'routes/web/posts.php'
    ));

    //connections
    Route::prefix('connections')->as('connections.')->group(base_path(
        'routes/web/connections.php'
    ));
});

require __DIR__ . '/auth.php';
