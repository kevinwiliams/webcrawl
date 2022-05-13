<?php

use App\Http\Controllers\ShrinkController;
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

//get top 100 links
Route::get('/top', [ShrinkController::class, 'getTopLinks']);

//shrink link
Route::post('/shortn', [ShrinkController::class, 'shrink']);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
