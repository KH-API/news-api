<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\News\NewsAdvertisingController;
use App\Http\Controllers\Api\News\NewsArticleController;
use App\Http\Controllers\Api\News\NewsCategoryController;
use App\Http\Controllers\Api\News\NewsTagController;
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
Route::post('logins', [AuthenticatedSessionController::class, 'login']);
Route::post('login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');
Route::get('articles', [NewsArticleController::class,'index']);
Route::post('articles', [NewsArticleController::class,'store']);
Route::get('articles/{id}', [NewsArticleController::class,'edit']);
Route::put('articles/{id}', [NewsArticleController::class,'update']);
Route::middleware(['auth:sanctum'])->group(function(){
    Route::apiResource('advertising', NewsAdvertisingController::class)->except(['create', 'show']);
    // Route::resource('articles', [NewsArticleController::class])->except(['create', 'show']);
    Route::apiResource('categories', NewsCategoryController::class)->except(['create', 'show']);
    Route::apiResource('tags', NewsTagController::class)->except(['create', 'show']);
});

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
