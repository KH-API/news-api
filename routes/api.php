<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
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
Route::post('register',[RegisteredUserController::class,'store']);
Route::middleware(['auth:sanctum'])->group(function(){
    Route::apiResource('advertising', NewsAdvertisingController::class)->except(['create']);
    Route::apiResource('articles', NewsArticleController::class)->except(['create']);
    Route::apiResource('categories', NewsCategoryController::class)->except(['create']);
    Route::apiResource('tags', NewsTagController::class)->except(['create']);
    Route::apiResource('product/category', ProductCategoryController::class)->except(['create']);
    Route::apiResource('product/status', ProductStatusController::class)->except(['create']);
    Route::apiResource('product/attribute', ProductAttributeController::class)->except(['create']);
    Route::apiResource('product', ProductController::class)->except(['create']);
    Route::apiResource('province', ProvinceController::class)->except(['create']);
});

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
