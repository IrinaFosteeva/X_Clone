<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaLikeController;
use App\Http\Controllers\FeedController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['prefix' => '/ideas', 'as' => 'ideas.', 'middleware' => 'auth'], function (){

});

Route::resource('ideas', IdeaController::class)->except(['index', 'create', 'show'])->middleware('auth');
Route::resource('ideas', IdeaController::class)->only(['show']);


//Route::post('/ideas/{idea}/comments', [CommentController::class, 'store'])->name('ideas.comments.store')>middleware('auth');
//Route::delete('/ideas/{idea}/comments/{comment}', [CommentController::class, 'destroy'])->name('ideas.comments.destroy')>middleware('auth');
//OR ----
Route::resource('ideas.comments', CommentController::class)->only(['store', 'destroy'])->middleware('auth');

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/feed', FeedController::class)->middleware('auth')->name('feed');


Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/profile', [ProfileController::class, 'index']);

Route::resource('users', UserController::class)->only( 'show', 'update');
Route::resource('users', UserController::class)->only( 'edit', 'update')->middleware('auth');
Route::get('profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');

Route::post('users/{user}/follow', [FollowerController::class, 'follow'])->middleware('auth')->name('users.follow');
Route::post('users/{user}/unfollow', [FollowerController::class, 'unfollow'])->middleware('auth')->name('users.unfollow');

Route::post('ideas/{idea}/like', [IdeaLikeController::class, 'like'])->middleware('auth')->name('ideas.like');
Route::post('ideas/{idea}/unlike', [IdeaLikeController::class, 'unlike'])->middleware('auth')->name('ideas.unlike');








Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



