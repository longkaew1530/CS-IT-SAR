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
Route::get('/addmember', 'DashboardController@index2');
Route::get('/index3', 'DashboardController@index3');
Route::get('/permission', 'DashboardController@index4');
Route::get('/MenuGroup', 'DashboardController@index5');
Route::get('/Menu', 'DashboardController@index6');
Route::get('/permission', 'DashboardController@index7');
Route::get('/course', 'DashboardController@index8');
Route::get('/board', 'DashboardController@index9');
Route::get('/category', 'DashboardController@index10');
Route::get('/Indicator', 'DashboardController@index11');
Route::get('/usercategory', 'DashboardController@index12');
Route::get('/faculty', 'DashboardController@index13');
Route::get('/usergroup', 'DashboardController@index14');
Route::get('/branch', 'DashboardController@index15');
Route::get('/assessment_results', 'DashboardController@index16');
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
Route::get('/addcourse_results', 'AJController@addcourse_results');
Route::get('/addindicator5-4', 'AJController@addindicator5_4');
Route::get('/addacademic_performance', 'AJController@addacademic_performance');
Route::get('/addnot_offered', 'AJController@addnot_offered');
Route::get('/addincomplete_content', 'AJController@addincomplete_content');
Route::get('/addeffectiveness', 'AJController@addeffectiveness');
Route::get('/addteacher_orientation', 'AJController@addteacher_orientation');
Route::get('/addactivity', 'AJController@addactivity');
Route::get('/addcourse_manage', 'AJController@addcourse_manage');
Route::get('/addcomment_course', 'AJController@addcomment_course');
Route::get('/addassessment_summary/{id}', 'AJController@addassessment_summary');
Route::get('/addstrength', 'AJController@addstrength');
Route::get('/adddevelopment_proposal', 'AJController@adddevelopment_proposal');
Route::get('/addnewstrength', 'AJController@addnewstrength');
Route::get('/addp/{id}', 'AJController@addp');
Route::get('/addd/{id}', 'AJController@addd');
Route::get('/addc/{id}', 'AJController@addc');
Route::get('/adda/{id}', 'AJController@adda');
/////รายงาน
Route::get('/overview', 'ReportController@overview');
Route::get('/instructor', 'ReportController@instructor');
Route::get('/performance_summary', 'ReportController@performance_summary');
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
Route::get('/category4/academic_performance', 'Category4Controller@academic_performance');
Route::get('/category4/incomplete_content', 'Category4Controller@incomplete_content');
////หมวด5
Route::get('/category5/course_administration', 'Category5Controller@course_administration');

////หมวด6
Route::get('/category6/comment_course', 'Category6Controller@comment_course');
Route::get('/category6/assessment_summary', 'Category6Controller@assessment_summary');

////หมวด7
Route::get('/category7/strength', 'Category7Controller@strength');
Route::get('/category7/newstrength', 'Category7Controller@newstrength');
Route::get('/category7/development_proposal', 'Category7Controller@development_proposal');
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

/////addinfostd
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
/////addcourse_results
Route::post('/addcourse_results','APIAJController@addcourse_results');
Route::get('/getcourse_results','APIAJController@getcourse_results');
Route::post('/updatecourse_results','APIAJController@updatecourse_results');
/////addindicator5_4
Route::post('/addindicator5_4','APIAJController@addindicator5_4');
Route::get('/getindicator5_4/{id}','APIAJController@getindicator5_4');
Route::post('/updateindicator5_4','APIAJController@updateindicator5_4');
/////addacademic_performance
Route::post('/addacademic_performance','APIAJController@addacademic_performance');
Route::get('/getacademic_performance','APIAJController@getacademic_performance');
Route::post('/updateacademic_performance','APIAJController@updateacademic_performance');
/////addnot_offered
Route::post('/addnot_offered','APIAJController@addnot_offered');
Route::get('/getnot_offered','APIAJController@getnot_offered');
Route::post('/updatenot_offered','APIAJController@updatenot_offered');
/////incomplete_content
Route::post('/addincomplete_content','APIAJController@addincomplete_content');
Route::get('/getincomplete_content','APIAJController@getincomplete_content');
Route::post('/updateincomplete_content','APIAJController@updateincomplete_content');
/////effectiveness
Route::post('/addeffectiveness','APIAJController@addeffectiveness');
Route::get('/geteffectiveness/{id}','APIAJController@geteffectiveness');
Route::post('/updateeffectiveness','APIAJController@updateeffectiveness');
/////teacher_orientation
Route::post('/addteacher_orientation','APIAJController@addteacher_orientation');
Route::get('/getteacher_orientation/{id}','APIAJController@getteacher_orientation');
Route::post('/updateteacher_orientation','APIAJController@updateteacher_orientation');
/////activity
Route::post('/addactivity','APIAJController@addactivity');
Route::get('/getactivity/{id}','APIAJController@getactivity');
Route::post('/updateactivity','APIAJController@updateactivity');
/////course_manage
Route::post('/addcourse_manage','APIAJController@addcourse_manage');
Route::get('/getcourse_manage/{id}','APIAJController@getcourse_manage');
Route::post('/updatecourse_manage','APIAJController@updatecourse_manage');
/////comment_course
Route::post('/addcomment_course','APIAJController@addcomment_course');
Route::get('/getcomment_course/{id}','APIAJController@getcomment_course');
Route::post('/updatecomment_course','APIAJController@updatecomment_course');
/////assessment_summary
Route::post('/addassessment_summary','APIAJController@addassessment_summary');
Route::get('/getassessment_summary/{id}','APIAJController@getassessment_summary');
Route::post('/updateassessment_summary','APIAJController@updateassessment_summary');
/////strength
Route::post('/addstrength','APIAJController@addstrength');
Route::get('/getstrength','APIAJController@getstrength');
Route::post('/updatestrength','APIAJController@updatestrength');
/////development_proposal
Route::post('/adddevelopment_proposal','APIAJController@adddevelopment_proposal');
Route::get('/getdevelopment_proposal/{id}','APIAJController@getdevelopment_proposal');
Route::post('/updatedevelopment_proposal','APIAJController@updatedevelopment_proposal');
/////newstrength
Route::post('/addnewstrength','APIAJController@addnewstrength');
Route::get('/getnewstrength','APIAJController@getnewstrength');
Route::post('/updatenewstrength','APIAJController@updatenewstrength');
/////category
Route::post('/addcategory', 'APIController@addcategory');
Route::delete('/deletecategory/{id}', 'APIController@deletecategory');
Route::put('/updatecategory','APIController@updatecategory');
Route::get('/getcategory/{id}','APIController@getcategory');
/////branch
Route::post('/addbranch', 'APIController@addbranch');
Route::delete('/deletebranch/{id}', 'APIController@deletebranch');
Route::put('/updatebranch','APIController@updatebranch');
Route::get('/getbranch/{id}','APIController@getbranch');
/////assessment_results
Route::post('/addassessment_results', 'APIController@addassessment_results');
/////addp
Route::post('/addp','APIAJController@addp');
Route::get('/getp/{id}','APIAJController@getp');
Route::post('/updatep','APIAJController@updatep');
Route::delete('/deletedoc/{id}','APIAJController@deletedoc');
/////addd
Route::post('/addd','APIAJController@addd');
Route::get('/getd/{id}','APIAJController@getd');
Route::post('/updated','APIAJController@updated');
/////addc
Route::post('/addc','APIAJController@addc');
Route::get('/getc/{id}','APIAJController@getc');
Route::post('/updatec','APIAJController@updatec');
/////adda
Route::post('/adda','APIAJController@adda');
Route::get('/geta/{id}','APIAJController@geta');
Route::post('/updatea','APIAJController@updatea');

Route::get('/getrolepermisson/{id}','APIController@getrolepermission');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
