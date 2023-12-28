<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// Add this ↓
Route::post('register', [RegisterController::class, 'register'])
    ->middleware('restrictothers');

// This serves as the create token page
Route::get('dashboard', function () {
    if(Auth::check() && Auth::user()-> role === 1) {
        return auth()
            ->user()
            ->createToken('auth_token', ['admin'])
            ->plainTextToken;
    }
    return redirect("/");

})->middleware('auth');

Route::get('clear/token', function () {
    if(Auth::check() && Auth::user()->role === 1) {
        Auth::user()->tokens()->delete();
    }

    return 'Token Cleared';
})->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
