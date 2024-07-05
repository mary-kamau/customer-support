<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeminiTestController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test-gemini', [GeminiTestController::class, 'test']);