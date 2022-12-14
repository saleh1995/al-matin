<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController as APIAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\PenaltyController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\VacationController;

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
    Route::get('/insurance', [InsuranceController::class, 'showApi']);
    Route::get('/penalty', [PenaltyController::class, 'showApi']);
    Route::get('/evaluation', [EvaluationController::class, 'showApi']);
    Route::get('/departmentEmployees', [UserController::class, 'departmentEmployeesApi']);

    Route::post('/management', [UserController::class, 'showEmployeeApi']);
    Route::post('/management/editEmployee', [UserController::class, 'updateِApi']);
    Route::post('/management/editEmployee/changePassword', [UserController::class, 'changePasswordApi']);
    Route::post('/management/deleteEmployee', [UserController::class, 'deleteApi']);
    Route::post('/followup/edit', [FollowUpController::class, 'editApi']);
    Route::post('/followup/update', [FollowUpController::class, 'updateApi']);

    Route::get('/allRequestVacations', [VacationController::class, 'showAllApi']);
    Route::get('/requestVacation', [VacationController::class, 'showRequestApi']);
    Route::post('/requestVacation', [VacationController::class, 'makeRequestApi']);
    Route::post('/acceptVacation', [VacationController::class, 'acceptApi']);
    Route::post('/denyVacation', [VacationController::class, 'denyApi']);
    Route::post('/deleteVacation', [VacationController::class, 'deleteVacationApi']);

    Route::get('/statistics', [UserController::class, 'statisticsApi']);
    Route::post('/statistics', [UserController::class, 'statisticsVacationApi']);




    // Route::get('management/statistics/vacations/excel/export', 'UserController@statisticsVacationExcelExport');
});

Route::post('users/import', [UserController::class, 'store']);
Route::post('salary/import', [SalaryController::class, 'store']);
Route::post('evaluation/import', [EvaluationController::class, 'store']);
Route::post('followup/import', [FollowUpController::class, 'store']);
Route::post('insurance/import', [InsuranceController::class, 'store']);
Route::post('penalty/import', [PenaltyController::class, 'store']);
