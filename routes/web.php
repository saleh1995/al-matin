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
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {

  Route::get('salary', 'SalaryController@show')->name('salary');

  Route::get('evaluation', function () {
    return view('evaluation');
  })->name('evaluation');

  Route::get('vacation_request', function () {
    return view('vacation_request');
  })->name('vacation_request');
});

// Route::post('/upload-employees', 'ImportController@employee')->name('import.employee');
