<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('signup', [App\Http\Controllers\AuthController::class, 'signUp'])->name('signUp');

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout',[App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
        Route::get('/user', [App\Http\Controllers\AuthController::class, 'user'])->name('user');
        Route::post('user-group',[App\Http\Controllers\GroupController::class, 'saveUserGroup'])->name('user-group');
        Route::post('save-group',[App\Http\Controllers\GroupController::class, 'saveGroup'])->name('save-group');
        Route::get('/groups', [App\Http\Controllers\GroupController::class, 'getGroups'])->name('groups');
        Route::get('/users-group/{id_group}', [App\Http\Controllers\GroupController::class, 'getUserGroups']);
        Route::post('/delete', [App\Http\Controllers\GroupController::class, 'deleteGroup'])->name('delete');
    });
});