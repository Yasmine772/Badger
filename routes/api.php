<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\ArticleController;
use App\Http\Controllers\API\V1\AuthorController;
use App\Http\Controllers\UserController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [UserController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});


Route::post('signup', [UserController::class, 'signup']);
Route::post('signin', [UserController::class, 'signin']);


Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function () {
    //Articles
    Route::apiResource('articles', ArticleController::class);

    //Authors
    Route::get('authors/{user}', [AuthorController::class, 'show'])->name('authors.show');
});
