<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerExample;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function() {
    // list all posts
    Route::get('posts', [ControllerExample::class, 'post']);
    // get a post
    Route::get('posts/{id}', [ControllerExample::class, 'singlePost']);
    // add a new post
    Route::post('posts', [ControllerExample::class, 'createPost']);
    // updating a post
    Route::put('posts/{id}', [ControllerExample::class, 'updatePost']);
    // delete a post
    Route::delete('posts/{id}', [ControllerExample::class, 'deletePost']);
    // add a new user with writer scope
    Route::post('users/writer', [ControllerExample::class, 'createWriter']);
    // add a new user with subscriber scope
    Route::post(
        'users/subscriber',
        [ControllerExample::class, 'createSubscriber']
    );
    // delete a user
    Route::delete('users/{id}', [ControllerExample::class, 'deleteUser']);
});
