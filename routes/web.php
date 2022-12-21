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

Route::get('/', 'HomeController@index')->name('home');
Route::middleware('auth')->group(function () {
  Route::get('salary', 'SalaryController@show')->name('salary');
  Route::get('evaluation', 'EvaluationController@show')->name('evaluation');
  Route::get('departmentEmployees', 'UserController@departmentEmployees')->name('department.employees');

  Route::get('vacation_request', function () {
    return view('vacation_request');
  })->name('vacation_request');

  Route::get('management', function () {
    return view('management');
  })->name('management');

  Route::get('management', function () {
    return view('management');
  })->name('management');
});

// Route::post('/upload-employees', 'ImportController@employee')->name('import.employee');
