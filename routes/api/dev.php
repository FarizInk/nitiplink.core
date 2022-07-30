<?php

use Illuminate\Support\Facades\Route;

// Authorization
Route::post('register', \App\Actions\Authorization\Register::class);
Route::post('login', \App\Actions\Authorization\Login::class);

Route::middleware('freeForAll:sanctum')->group(function() {
    Route::prefix('user')->group(function () {
        Route::get('/hash/{hash}', [\App\Http\Controllers\Api\Dev\UserController::class, 'getUserByHash']);
        Route::get('/username/{username}', [\App\Http\Controllers\Api\Dev\UserController::class, 'getUserByUsername']);
        Route::post('/check/email', [\App\Http\Controllers\Api\Dev\UserController::class, 'checkEmail']);
        Route::post('/check/username', [\App\Http\Controllers\Api\Dev\UserController::class, 'checkUsername']);
    });

    Route::prefix('group')->group(function () {
        Route::get('/list', [\App\Http\Controllers\Api\Dev\GroupController::class, 'getListGroup']);
        Route::get('/unique_path/{unique_path}', [\App\Http\Controllers\Api\Dev\GroupController::class, 'getGroupByUniquePath']);
        Route::get('/{hash}', [\App\Http\Controllers\Api\Dev\GroupController::class, 'getGroupByHash']);
        Route::get('/{hash}/categories', [\App\Http\Controllers\Api\Dev\GroupController::class, 'getCategories']);
        Route::get('/{hash}/links', [\App\Http\Controllers\Api\Dev\GroupController::class, 'getLinks']);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\Dev\UserController::class, 'getProfile']);
        Route::post('/update/name', [\App\Http\Controllers\Api\Dev\UserController::class, 'updateName']);
        Route::post('/update/username', [\App\Http\Controllers\Api\Dev\UserController::class, 'updateUsername']);
        Route::post('/update/email', [\App\Http\Controllers\Api\Dev\UserController::class, 'updateEmail']);
        Route::post('/update/password', [\App\Http\Controllers\Api\Dev\UserController::class, 'updatePassword']);
    });

    Route::prefix('group')->group(function () {
        Route::post('/create', [\App\Http\Controllers\Api\Dev\GroupController::class, 'create']);
        // must be member of group
        Route::post('/edit/{hash}', [\App\Http\Controllers\Api\Dev\GroupController::class, 'edit']);
        Route::get('/invite/list/{hash}', [\App\Http\Controllers\Api\Dev\GroupController::class, 'getInviteList']);
        Route::post('/invite/generate/{hash}', [\App\Http\Controllers\Api\Dev\GroupController::class, 'generateInviteLink']);
        Route::post('/invite/accept/{hash}', [\App\Http\Controllers\Api\Dev\GroupController::class, 'acceptInviteLink']);
    });

    Route::prefix('category')->group(function () {
        Route::post('/create', [\App\Http\Controllers\Api\Dev\CategoryController::class, 'create']);
        Route::post('/edit', [\App\Http\Controllers\Api\Dev\CategoryController::class, 'edit']);
        Route::delete('/delete', [\App\Http\Controllers\Api\Dev\CategoryController::class, 'delete']);
    });

    Route::prefix('link')->group(function () {
        Route::post('/create', [\App\Http\Controllers\Api\Dev\LinkController::class, 'create']);
        Route::post('/edit', [\App\Http\Controllers\Api\Dev\LinkController::class, 'edit']);
        Route::delete('/delete', [\App\Http\Controllers\Api\Dev\LinkController::class, 'delete']);
    });
});
