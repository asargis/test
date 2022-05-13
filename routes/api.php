<?php

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

Route::get('articles', [\App\Http\Controllers\ArticleController::class, 'index']);
Route::get('articles/last', [\App\Http\Controllers\ArticleController::class, 'last']);
Route::get('articles/{slug}', [\App\Http\Controllers\ArticleController::class, 'article']);

Route::post('articles/like', [\App\Http\Controllers\ArticleController::class, 'like']);
Route::get('articles/likes', [\App\Http\Controllers\ArticleController::class, 'likes']);

Route::post('articles/view', [\App\Http\Controllers\ArticleController::class, 'view']);
Route::get('articles/views', [\App\Http\Controllers\ArticleController::class, 'views']);

Route::post('articles/comment', [\App\Http\Controllers\ArticleController::class, 'comment']);
Route::get('articles/comments', [\App\Http\Controllers\ArticleController::class, 'comments']);

