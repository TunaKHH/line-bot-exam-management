<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizApiController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

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

Route::resource('quizzes', QuizController::class)->middleware(['auth', 'verified']);
Route::resource('question', QuestionController::class)->middleware(['auth', 'verified']);
Route::resource('option', OptionController::class)->middleware(['auth', 'verified']);
Route::get('/question/{question}/options', [OptionController::class, 'index'])->name('option.index');



Route::prefix('api')->group(function () {
    Route::get('quizzes/{quiz}/start', [QuizApiController::class, 'start'])->name('quizzes.start');
    Route::post('quizzes/{quiz}/submit', [QuizApiController::class, 'submit'])->name('quizzes.submit');
});

Route::get('/', function () {
    // 導向到dashboard
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
