<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CategoryController;


use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;


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





Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users',[UserController::class,'index']);
    Route::post('/logout', [AuthController::class, 'logout']);

});
Route::post('/login', [AuthController::class,'login']);
Route::post('/register', [AuthController::class, 'register']);




Route::get('/questions',[\App\Http\Controllers\QuestionController::class,'index'])->name('questions.index');
Route::post('/questions',[\App\Http\Controllers\QuestionController::class,'store'])->name('questions.store');
Route::get('/questions/{id}',[\App\Http\Controllers\QuestionController::class, 'show'])->name('questions.show');
Route::put('/questions/{id}', [\App\Http\Controllers\QuestionController::class, 'update'])->name('questions.update');
Route::delete('/questions/{id}', [\App\Http\Controllers\QuestionController::class, 'destroy'])->name('questions.destroy');

Route::get('/tests', [TestController::class, 'index'])->name('tests.all');
Route::get('/tests/{testId}', [TestController::class, 'show'])->name('tests.show');
Route::post('/tests', [TestController::class, 'store'])->name('tests.store');
Route::put('/tests/{testId}', [TestController::class, 'update'])->name('tests.update');
Route::delete('/tests/{testId}', [TestController::class, 'destroy'])->name('tests.destroy');
Route::get('/testsbyquestion/{id}', [TestController::class, 'getAllTestByQuestion']);
Route::get('/questionsbytest/{id}', [TestController::class, 'getAllQuestionByTest']);

Route::get('/answers', [AnswerController::class, 'index']);
Route::get('/answers/{id}', [AnswerController::class, 'show']);
Route::post('/answers', [AnswerController::class, 'store']);
Route::put('/answers/{id}', [AnswerController::class, 'update']);
Route::delete('/answers/{id}', [AnswerController::class, 'destroy']);



