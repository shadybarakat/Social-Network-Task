<?php

use App\Http\Controllers\Posts\CommentController;
use App\Http\Controllers\Posts\DeleteController;
use App\Http\Controllers\Posts\EditController;
use App\Http\Controllers\Posts\CreateController;
use App\Http\Controllers\Posts\StoreController;
use App\Http\Controllers\Posts\IndexController;
use App\Http\Controllers\Posts\LikeController;
use App\Http\Controllers\Posts\UpdateController;
use App\Http\Controllers\Posts\ShowController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/my-posts', IndexController::class)->name('myPosts');
Route::get('/create', CreateController::class)->name('create');
Route::post('/', StoreController::class)->name('store');

Route::get('/{post}/edit', EditController::class)->name('edit')->middleware('can:update,post');
Route::patch('/{post}', UpdateController::class)->name('update')->middleware('can:update,post');
Route::delete('/{post}', DeleteController::class)->name('delete')->middleware('can:delete,post');
Route::post('/{post}/like', LikeController::class)->name('like');
Route::post('/{post}/comment', CommentController::class)->name('comment');
Route::get('/{post}', ShowController::class)->name('show');