<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/ideas', [IdeaController::class, 'store'])->name('ideas.create');
Route::delete('/ideas/{id}', [IdeaController::class, 'destroy'])->name('ideas.destroy');



Route::get('/terms', function () {
    return view('terms');
});


Route::get('/profile', [ProfileController::class, 'index']);


