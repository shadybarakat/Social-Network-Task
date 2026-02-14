<?php
use App\Http\Controllers\api\posts\DeleteController;
use App\Http\Controllers\api\posts\StoreController;
use App\Http\Controllers\api\posts\IndexController;
use App\Http\Controllers\api\posts\UpdateController;
use App\Http\Controllers\api\posts\ShowController;
use App\Http\Controllers\api\posts\LikeController;
use Illuminate\Support\Facades\Route;


Route::get('/my-posts', IndexController::class);
Route::post('/', StoreController::class);
Route::patch('/{post}', UpdateController::class)->middleware('can:update,post');
Route::delete('/{post}', DeleteController::class)->middleware('can:delete,post');
Route::get('/{post}', ShowController::class);
Route::post('/{post}/like', LikeController::class);