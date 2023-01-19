<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FibonacciController;
use Illuminate\Support\Facades\DB;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//add in queue
Route::post('/fibonacci',[ FibonacciController::class,'store']);

//get all jobs
Route::get('/fibonacci',[ FibonacciController::class,'index']);

//get result by id
Route::get('/fibonacci/{id}',[ FibonacciController::class,'show']);
