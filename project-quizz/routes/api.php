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
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('/answers')->group(function () {
        Route::get('/', [AnswerController::class, 'index']);
        Route::get('/{id}', [AnswerController::class, 'show']);
        Route::post('/', [AnswerController::class, 'store']);
        Route::put('/{id}', [AnswerController::class, 'update']);
        Route::delete('/answers/{id}', [AnswerController::class, 'destroy']);
    });

    Route::get('/showResult/{id}/{userId}', [QuizResultController::class, 'showResult']);

    Route::post('/test', [UserQuizController::class, 'doQuiz']);

    Route::prefix('/quizzes')->group(function () {
        Route::get('/', [QuizController::class, 'index']);
        Route::get('/{id}', [QuizController::class, 'show']);
        Route::post('/', [QuizController::class, 'store']);
        Route::get('/{id}/questions-answers', [UserQuizController::class, 'index']);

    });
    Route::prefix('/categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('/{id}', [CategoryController::class, 'show']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::put('/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
    });

    Route::prefix('/questions')->group(function () {
        Route::get('question', [QuestionController::class, 'create']);
        Route::get('/', [QuestionController::class, 'index'])->name('questions.index');
        Route::post('/', [QuestionController::class, 'store'])->name('questions.store');
        Route::get('/{id}', [QuestionController::class, 'show'])->name('questions.show');
        Route::put('/{id}', [QuestionController::class, 'update'])->name('questions.update');
        Route::delete('/{id}', [QuestionController::class, 'destroy'])->name('questions.destroy');
    });

    Route::get('/user/{userId}/result', [QuizResultController::class, 'showUserResults']);
    Route::get('/all-result/{id}', [QuizResultController::class, 'showAllResults']);
    Route::get('/quizzes/getQuestion', [QuizController::class, 'getAllQuestion']);
    Route::get('/userQuiz/{id}', [UserQuizController::class, 'index']);
    Route::get('/result/{quizId}/user/{userId}', [QuizResultController::class, 'showResult']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::group(['middleware' => 'manager.role', 'prefix' => 'quiz-question'], function () {
    Route::post('/store', [QuizQuestionController::class, 'store'])->name('quizQuestion.store');
    Route::get('/{id}/delete', [QuizQuestionController::class, 'destroy'])->name('quizQuestion.destroy');
    Route::post('/multiDelete', [QuizQuestionController::class, 'multiDestroy'])->name('quizQuestion.multiDestroy');
});

