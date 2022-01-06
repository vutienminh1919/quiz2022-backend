<?php


use App\Http\Controllers\CategoryController;

use App\Http\Controllers\AuthController;
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


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{categoryId}',[CategoryController::class, 'show'])->name('categories.show');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::put('/categories/{categoryId}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{categoryId}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users',[UserController::class,'index']);
});
Route::post('/login', [AuthController::class,'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);


Route::get('/questions/{id}',[\App\Http\Controllers\QuestionController::class,'index'])->name('questions.index');
Route::post('/questions',[\App\Http\Controllers\QuestionController::class,'store'])->name('questions.store');
Route::get('/questions/{id}',[\App\Http\Controllers\QuestionController::class, 'show'])->name('questions.show');
Route::post('/questions/{id}', [\App\Http\Controllers\QuestionController::class, 'update'])->name('questions.update');
Route::delete('/questions/{id}', [\App\Http\Controllers\QuestionController::class, 'destroy'])->name('questions.destroy');
