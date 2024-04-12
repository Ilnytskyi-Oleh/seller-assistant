<?php

use App\Http\Controllers\API\V1\Upload\IndexController;
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

Route::post('/v1/upload', IndexController::class);
Route::get('/v1/import-tasks', \App\Http\Controllers\API\V1\ImportTask\IndexController::class);
