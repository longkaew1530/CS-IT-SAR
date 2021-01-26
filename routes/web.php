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
Route::get('/Menu', 'DashboardController@index6');
Route::get('/dashboard/permission', 'DashboardController@index7');
Route::get('/dashboard/course', 'DashboardController@index8');
Route::get('/dashboard/board', 'DashboardController@index9');
Route::get('/dashboard/category', 'DashboardController@index10');
Route::get('/dashboard/Indicator', 'DashboardController@index11');
Route::get('/dashboard/usercategory', 'DashboardController@index12');
Route::get('/dashboard/faculty', 'DashboardController@index13');
Route::get('/dashboard/usergroup', 'DashboardController@index14');
/////อาจารย์
Route::get('/educational_background', 'AJController@educational_background');
Route::get('/research_results', 'AJController@research_results');
Route::get('/pdca/{id}', 'AJController@addpdca');
Route::get('/addindicator4-3', 'AJController@add4_3');
Route::get('/addindicator3-3', 'AJController@addindicator3_3');
Route::get('/addinfostudent', 'AJController@addinfostd');
Route::get('/addimpactfactor/{id}', 'AJController@addfactor');
Route::get('/addindicator2-1', 'AJController@addindicator2_1');
Route::get('/addindicator2-2', 'AJController@addindicator2_2');
/////หมวด1-2
Route::get('/category/indicator1-1', 'CategoryController@indicator1_1');
Route::get('/category/category1', 'CategoryController@category1');
Route::get('/category/indicator4-1/{id}', 'CategoryController@indicator4_1');
Route::get('/category/indicator4-2/{id}', 'CategoryController@indicator4_2');
Route::get('/category/indicator4-3', 'CategoryController@indicator4_3');

//////หมวด3
Route::get('/category3/graduatesqty', 'Category3Controller@graduatesqty');
Route::get('/category3/Impactfactors', 'Category3Controller@Impactfactors');
Route::get('/category3/Impactgraduation', 'Category3Controller@Impactgraduation');
Route::get('/category3/indicator2-1', 'Category3Controller@indicator2_1');
Route::get('/category3/assessment/{id}', 'Category3Controller@showassess');
Route::get('/category3/indicator2-2', 'Category3Controller@indicator2_2');
Route::get('/category3/pdca/{id}', 'Category3Controller@showpdca');
Route::get('/category3/performance', 'Category3Controller@indicator3_3');
Route::get('/category3/studentinfomation', 'Category3Controller@Studentsinfo');
////หมวด4
Route::get('/category4/course_summary', 'Category4Controller@coursesummary');
Route::get('/category4/notcourse_summary', 'Category4Controller@notcoursesummary');
Route::get('/category4/indicator5_4', 'Category4Controller@indicator5_4');
Route::get('/category4/teachingquality', 'Category4Controller@teachingquality');
Route::get('/category4/effectiveness', 'Category4Controller@effectiveness');
Route::get('/category4/newteacher', 'Category4Controller@newteacher');
Route::get('/category4/activity', 'Category4Controller@activity');

////หมวด5
Route::get('/category5/course_administration', 'Category5Controller@course_administration');

////หมวด6
Route::get('/category6/comment_course', 'Category6Controller@comment_course');
Route::get('/category6/assessment_summary', 'Category6Controller@assessment_summary');

////หมวด7
Route::get('/category7/strength', 'Category7Controller@strength');

///API
Route::post('/save', 'APIController@store');
Route::post('/addper', 'APIController@addpermission');
/////groupmenu
Route::post('/addgroupmenu', 'APIController@addgroupmenu');
Route::delete('/deletegroupmenu/{id}', 'APIController@deletegroupmenu');
Route::put('/updategroupmenu','APIController@updategroupmenu');
Route::get('/getgroupmenu/{id}','APIController@getgroupmenu');
/////menu
Route::post('/addmenu', 'APIController@addmenu');
Route::delete('/deletemenu/{id}', 'APIController@deletemenu');
Route::put('/updatemenu','APIController@updatemenu');
Route::get('/getmenu/{id}','APIController@getmenu');
/////course
Route::post('/addcourse', 'APIController@addcourse');
Route::delete('/deletecourse/{id}', 'APIController@deletecourse');
Route::put('/updatecourse','APIController@updatecourse');
Route::get('/getcourse/{id}','APIController@getcourse');
/////faculty
Route::post('/addfaculty', 'APIController@addfaculty');
Route::delete('/deletefaculty/{id}', 'APIController@deletefaculty');
Route::put('/updatefaculty','APIController@updatefaculty');
Route::get('/getfaculty/{id}','APIController@getfaculty');
/////usergroup
Route::post('/addusergroup', 'APIController@addusergroup');
Route::delete('/deleteusergroup/{id}', 'APIController@deleteusergroup');
Route::put('/updateusergroup','APIController@updateusergroup');
Route::get('/getusergroup/{id}','APIController@getusergroup');
/////nextyear
Route::put('/nextyear','APIController@nextyear');
/////backyear
Route::put('/backyear','APIController@backyear');
/////user
Route::post('/adduser','APIController@adduser');
Route::delete('/deleteuser/{id}', 'APIController@deleteuser');
Route::get('/getuser/{id}','APIController@getuser');
Route::put('/updateuser','APIController@updateuser');
/////educational_background
Route::post('/addeducational_background','APIAJController@addeducational_background');
Route::post('/deleteeducational_background/{id}', 'APIAJController@deleteeducational_background');
Route::get('/geteducational_background/{id}','APIAJController@geteducational_background');
Route::put('/updateeducational_background','APIAJController@updateeducational_background');
/////research_results
Route::post('/addresearch_results','APIAJController@addresearch_results');
Route::post('/deleteresearch_results/{id}', 'APIAJController@deleteresearch_results');
Route::get('/getresearch_results/{id}','APIAJController@getresearch_results');
Route::put('/updateresearch_results','APIAJController@updateresearch_results');

/////pdca
Route::post('/addpdca','APIAJController@addpdca');
Route::post('/deletepdca/{id}', 'APIAJController@deletepdca');
Route::get('/getpdca/{id}','APIAJController@getpdca');
Route::post('/updatepdca','APIAJController@updatepdca');
/////addindicator4_3
Route::post('/addindicator4_3','APIAJController@addindicator4_3');
Route::get('/getindicator4_3','APIAJController@getaddindicator4_3');
Route::post('/updateindicator4_3','APIAJController@updateaddindicator4_3');

/////addindicator4_3
Route::post('/addinfostd','APIAJController@addinfostd');
/////addfactor
Route::post('/addfactor','APIAJController@addfactor');
Route::get('/getfactor/{id}','APIAJController@getfactor');
Route::post('/updatefactor','APIAJController@updatefactor');
/////addindicator2_1
Route::post('/addindicator2_1','APIAJController@addindicator2_1');
Route::get('/getindicator2_1/{id}','APIAJController@getindicator2_1');
Route::post('/updateindicator2_1','APIAJController@updateindicator2_1');
/////addindicator2_2
Route::post('/addindicator2_2','APIAJController@addindicator2_2');
Route::get('/getindicator2_2/{id}','APIAJController@getindicator2_2');
Route::post('/updateindicator2_2','APIAJController@updateindicator2_2');
/////addindicator2_2
Route::post('/addindicator3_3','APIAJController@addindicator3_3');
Route::get('/getindicator3_3','APIAJController@getindicator3_3');
Route::post('/updateindicator3_3','APIAJController@updateindicator3_3');

Route::get('/getrolepermisson/{id}','APIController@getrolepermission');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
