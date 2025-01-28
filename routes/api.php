<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TranslationController;
use App\Http\Controllers\API\ExportController;

Route::middleware('auth:sanctum')->group([], function () {
    Route::apiResource('translations', TranslationController::class);
    Route::get('translations/export', [ExportController::class, 'export']);
});
