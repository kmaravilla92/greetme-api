<?php

use App\Http\Controllers\Rest\CardController;
use App\Http\Controllers\Rest\CardSignController;
use App\Http\Controllers\Rest\CardTemplateController;
use App\Http\Controllers\Rest\CardTemplateCategoryController;
use App\Http\Controllers\Rest\TokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::apiResource('/tokens', TokenController::class);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/cards', CardController::class);
    Route::apiResource('/card-signs', CardSignController::class);
    Route::apiResource('/card-templates', CardTemplateController::class);
    Route::apiResource('/card-template-categories', CardTemplateCategoryController::class);
});