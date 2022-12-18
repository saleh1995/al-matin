<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController as APIAuthController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InsurnaceController;
use App\Http\Controllers\PenaltyController;
use App\Http\Controllers\SalaryController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [APIAuthController::class, 'register']);
Route::post('login', [APIAuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::get('/', [HomeController::class, 'api']);
    Route::get('/salary', [SalaryController::class, 'showApi']);
    Route::get('/followup', [FollowUpController::class, 'showApi']);
    Route::get('/insurance', [InsurnaceController::class, 'showApi']);
    Route::get('/penalty', [PenaltyController::class, 'showApi']);
    Route::get('/evaluation', [EvaluationController::class, 'showApi']);
});

// Route::post('users/import', [UserController::class, 'store']);
// Route::post('salary/import', [SalaryController::class, 'store']);
// Route::post('evaluation/import', [EvaluationController::class, 'store']);
// Route::post('followup/import', [FollowUpController::class, 'store']);
// Route::post('insurance/import', [InsurnaceController::class, 'store']);
// Route::post('penalty/import', [PenaltyController::class, 'store']);
