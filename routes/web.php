<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

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

//Route::get('/', function () {
//    return view('login');
//});


Route::middleware(['guest:web'])->group(function (){
    Route::view('/' , 'login')->name('login');
    Route::post('/checkLogin', [AuthController::class, 'login'])->name('checkLogin');
});

Route::middleware(['auth:web'])->group(function (){
    Route::post('/logout' , [AuthController::class, 'logout'])->name('logout');
    Route::resource('/home', HomeController::class);
    Route::resource('/companies',CompanyController::class);
    Route::resource('/employees',EmployeeController::class);
});
