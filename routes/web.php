<?php

use App\Http\Controllers\FriendController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::view('/', 'welcome');
Route::view('/authorize', 'pages.authorize');
Route::post('/authorize', [UserController::class, 'authorization']);
Route::get('/register', [UserController::class, 'showRegister']);
Route::post('/register', [UserController::class, 'register']);
Route::get('/users/search', [UserController::class, 'search']);

Route::group(['middleware' => ['authorized']], function () {
    Route::get('/profile', [UserController::class, 'showProfile']);
    Route::get('/users', [UserController::class, 'showUsers']);
    Route::get('/friends', [FriendController::class, 'list']);
    Route::get('/friends/{id}/add', [FriendController::class, 'addToFriendsList'])->name('add_to_friends_list');
    Route::get('/friends/{id}/remove', [FriendController::class, 'removeFromFriendsList'])->name('remove_from_friends_list');
});
