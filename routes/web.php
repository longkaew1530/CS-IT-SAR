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

/////หมวด1-2
Route::get('/category/indicator1-1', 'CategoryController@indicator1_1');
Route::get('/category/category1', 'CategoryController@category1');
Route::get('/category/indicator4-1/{id}', 'CategoryController@indicator4_1');
Route::get('/category/indicator4-2/{id}', 'CategoryController@indicator4_2');
Route::get('/category/indicator4-3/{id}', 'CategoryController@indicator4_3');

//////หมวด3
Route::get('/category3/graduatesqty', 'Category3Controller@graduatesqty');
Route::get('/category3/Impactfactors', 'Category3Controller@Impactfactors');
Route::get('/category3/Impactgraduation', 'Category3Controller@Impactgraduation');
Route::get('/category3/indicator2-1', 'Category3Controller@indicator2_1');
Route::get('/category3/assessment/{id}', 'Category3Controller@showassess');
Route::get('/category3/indicator2-2', 'Category3Controller@indicator2_2');
Route::get('/category3/pdca/{id}', 'Category3Controller@showpdca');
Route::get('/category3/performance', 'Category3Controller@indicator3_3');

////หมวด4
Route::get('/category4/course_summary', 'Category4Controller@coursesummary');
Route::get('/category4/notcourse_summary', 'Category4Controller@notcoursesummary');

Route::post('/save', 'PDCAController@store');
Route::post('/addper', 'PDCAController@addpermission');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
