<?php

use App\Http\Controllers\web\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/', [AuthController::class, 'viewLogin']);

// Route::post('/login', [AuthController::class, 'login']);

// Route::get('/hi', function () {
//     if (Auth::user()) {
//         return Auth::user()->name;
//     }
//     return 'hello';
// });+-

Auth::routes();

Route::middleware('auth')->group(function () {
  Route::get('/', 'HomeController@index')->name('home');
  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('/resetpassword', 'HomeController@resetpassword')->name('home.resetpassword');
  Route::post('/resetpassword', 'HomeController@resetPasswordPage')->name('home.resetpassword.post');
  Route::get('salary', 'SalaryController@show')->name('salary');
  Route::post('salary', 'SalaryController@upload')->name('salary.upload');
  Route::get('evaluation', 'EvaluationController@show')->name('evaluation');
  Route::post('evaluation', 'EvaluationController@upload')->name('evaluation.upload');
  Route::post('followup', 'FollowUpController@upload')->name('followup.upload');
  Route::post('employees', 'UserController@upload')->name('employees.upload');
  Route::post('penalty', 'PenaltyController@upload')->name('penalty.upload');
  Route::post('insurance', 'InsuranceController@upload')->name('insurance.upload');


  Route::get('departmentEmployees', 'UserController@departmentEmployees')->name('user.departmentEmployees');
  Route::get('departmentEmployees/vacations', 'VacationController@showAll')->name('vacations');
  Route::get('departmentEmployees/vacations/accept/{id}', 'VacationController@accept')->name('vacations.accept');
  Route::get('departmentEmployees/vacations/deny/{id}', 'VacationController@deny')->name('vacations.deny');

  Route::get('vacation', 'VacationController@show')->name('vacation');
  Route::post('vacation', 'VacationController@makeRequest')->name('vacation.makeRequest');
  Route::get('vacation/deleteRequest/{id}', 'VacationController@deleteRequest')->name('vacation.deleteRequest');


  Route::get('management', 'UserController@management')->name('user.management');
  Route::post('management', 'UserController@showEmployee')->name('user.showEmployee');
  Route::get('management/editEmployee/{id}', 'UserController@edit')->name('user.edit');
  Route::post('management/editEmployee', 'UserController@update')->name('user.update');
  Route::post('management/editEmployee/changePassword', 'UserController@changePassword')->name('user.changePassword');
  Route::get('management/deleteEmployee/{id}', 'UserController@delete')->name('user.delete');

  Route::get('management/statistics', 'UserController@statistics')->name('user.statistics');
  Route::post('management/statistics', 'UserController@statisticsVacation')->name('user.statisticsVacation');
  Route::get('management/statistics/vacations/excel/export', 'UserController@statisticsVacationExcelExport')->name('user.statisticsVacationExcelExport');

  Route::get('management/upload', 'HomeController@upload')->name('upload');

  Route::post('followup/update', 'FollowUpController@update')->name('followup.update');
});
