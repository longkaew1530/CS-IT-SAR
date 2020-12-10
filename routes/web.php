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

Route::get('/', 'DashboardController@index');
Route::get('/dashboard', 'DashboardController@index');
Route::get('/dashboard/addmember', 'DashboardController@index2');
Route::get('/dashboard/index3', 'DashboardController@index3');
Route::get('/dashboard/permission', 'DashboardController@index4');
Route::get('/dashboard/MenuGroup', 'DashboardController@index5');
Route::get('/dashboard/Menu', 'DashboardController@index6');
Route::get('/dashboard/permission', 'DashboardController@index7');
Route::get('/dashboard/course', 'DashboardController@index8');
Route::get('/dashboard/board', 'DashboardController@index9');
Route::get('/dashboard/category', 'DashboardController@index10');
Route::get('/dashboard/Indicator', 'DashboardController@index11');
Route::get('/dashboard/usercategory', 'DashboardController@index12');

/////หมวด1-7
Route::get('/category/indicator1-1', 'CategoryController@indicator1_1');
Route::get('/category/category1', 'CategoryController@category1');
Route::get('/category/indicator4-1/{id}', 'CategoryController@indicator4_1');
Route::get('/category/indicator4-2/{id}', 'CategoryController@indicator4_2');


Route::post('/save', 'PDCAController@store');
Route::post('/addper', 'PDCAController@addpermission');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
