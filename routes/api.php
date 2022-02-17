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
Route::get('login', function(){ return 111; });
Route::post('login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');

Route::middleware(['auth:sanctum'])->group(function(){
    
    Route::resource('advertising', NewsAdvertisingController::class)->except(['create', 'show']);
    Route::resource('articles', NewsArticleController::class)->except(['create', 'show']);
    Route::resource('categories', NewsCategoryController::class)->except(['create', 'show']);
    Route::resource('tags', NewsTagController::class)->except(['create', 'show']);

});

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
