<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// company
Route::get('/company/', 'CompanyController@index')->name('company');
Route::get('/company/create', 'CompanyController@create');
Route::post('/company/store', 'CompanyController@store');
Route::get('/company/edit/{id}', 'CompanyController@edit');
Route::put('/company/update', 'CompanyController@update');
Route::get('/company/delete/{id}', 'CompanyController@destroy');

// employee
Route::get('/employee', 'EmployeeController@index')->name('employee');
Route::get('/employee/create', 'EmployeeController@create');
Route::post('/employee/store', 'EmployeeController@store');
Route::get('/employee/edit/{id}', 'EmployeeController@edit');
Route::put('/employee/update', 'EmployeeController@update');
Route::get('/employee/delete/{id}', 'EmployeeController@destroy');
