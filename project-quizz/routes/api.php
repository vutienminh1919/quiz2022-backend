<?php

use App\Http\Controllers\CategoryController;
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
