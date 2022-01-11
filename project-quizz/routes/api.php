<?php

use App\Http\Controllers\AnswerController;



use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuizQuestionController;
use App\Http\Controllers\UserQuizController;
use App\Http\Controllers\QuizResultController;



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

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);



Route::get('question',[QuestionController::class,'create']);
Route::get('/questions',[QuestionController::class,'index'])->name('questions.index');
Route::post('/questions',[QuestionController::class,'store'])->name('questions.store');
Route::get('/questions/{id}',[QuestionController::class, 'show'])->name('questions.show');
Route::put('/questions/{id}', [QuestionController::class, 'update'])->name('questions.update');
Route::delete('/questions/{id}', [QuestionController::class, 'destroy'])->name('questions.destroy');


Route::delete('/answers/{id}', [AnswerController::class, 'destroy']);

Route::get('/quizzes', [QuizController::class, 'index']);
Route::post('/quizzes', [QuizController::class, 'store']);

    Route::get('/doExam/{id}',[UserQuizController::class,'index']);
    Route::post('/',[UserQuizController::class,'doQuiz'])->name('quiz.submit');
    Route::get('/result/{quizId}/user/{userId}',[QuizResultController::class,'showResult'])->name('quiz.result');

Route::group(['middleware' => 'manager.role', 'prefix' => 'quiz-question'], function () {
    Route::post('/store', [QuizQuestionController::class,'store'])->name('quizQuestion.store');
    Route::get('/{id}/delete', [QuizQuestionController::class,'destroy'])->name('quizQuestion.destroy');
    Route::post('/multiDelete', [QuizQuestionController::class,'multiDestroy'])->name('quizQuestion.multiDestroy');
});
