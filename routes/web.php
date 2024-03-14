<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;

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


Route::get('/terms', function () {
    return view('terms');
});

Route::get('/profile', [ProfileController::class, 'index']);


