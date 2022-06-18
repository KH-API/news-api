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
Route::post('user-login', [AuthenticatedSessionController::class, 'user_login']);
Route::post('login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');
Route::post('logout',[AuthenticatedSessionController::class,'logout']);
Route::post('register',[RegisteredUserController::class,'register']);
Route::post('reset_password',[RegisteredUserController::class,'reset_password']);
Route::post('forgot_password',[RegisteredUserController::class,'forgot_password']);
Route::post('verifyToken',[RegisteredUserController::class,'verifyToken']);
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
