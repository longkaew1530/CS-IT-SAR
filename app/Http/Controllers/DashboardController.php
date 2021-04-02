<?php

namespace App\Http\Controllers;
use App\User;
use App\PDCA;
use App\DocPDCA;
use App\Groupmenu;
use App\Course;
use App\composition;
use App\Year;
use App\Tps;
use App\usergroup;
use App\defaulindicator;
use App\Menu;
use App\category;
use App\instructor;
use App\branch;
use App\indicator;
use App\user_permission;
use App\rolepermission;
use App\assessment_results;
use App\Faculty;
use App\groupuser;
use App\course_responsible_teacher;
use App\Educational_background;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // $user=auth()->user();
        // $userrole=$user->role;
        // $role=Role::findByName($userrole);
        // dd($role);

        // $user = auth()->user();
        // $permissions = $user->getAllPermissions();
        // foreach($permissions as $value)
        // {
        //     dd($value->id);
        // }
        $user=auth()->user();
        $user_course=$user->user_course;
        $user_group=$user->user_group_id;
        $year=Year::where('active',1)
        ->get();
        $getAllyear=Year::all();
        foreach($year as $value){
            $y_name=$value['year_name'];
            $y_id=$value['year_id'];
        }
        session()->put('usercourse',$user_course);
        session()->put('year',$y_name);
        session()->put('year_id',$y_id);
        $groupmenu=Groupmenu::all();
        $rolepermiss=rolepermission::leftjoin('menu','role_permission.m_id','=','menu.m_id')
        ->where('user_group_id',$user_group)
        ->get();
       
         foreach ($groupmenu as $key => $value){
            $value->menu->first(); 
         }
        session()->put('groupmenu',$groupmenu);
        session()->put('roleper',$rolepermiss);

        $category=category::all();
        $roleindicator=user_permission::leftjoin('indicator','user_permission.indicator_id','=','indicator.id')
        ->where('user_permission.user_id',$user->id)
        ->where('user_permission.year_id',session()->get('year_id'))
        ->get();
        foreach ($category as $key => $value){
            $value->indicator->first(); 
         }
        session()->put('category',$category);
        if(count($roleindicator)!=0){
            session()->put('roleindicator',$roleindicator);
        }
        else{
            session()->put('roleindicator',"");
        }
        if($user_group==1){
            return view('dashboard/year',compact('year','getAllyear'));
        }
       else if($user_group==2||$user_group==3){
        return view('dashboard/dashboard');
       }
       else{
        return view('dashboard/dashboard2');
       }
    }
    public function index2()
    {
        $course=Course::all();
        $faculty=Faculty::all();
        $groupuser=groupuser::all();
        $user=User::leftjoin('course','users.user_course','=','course.course_id')
        ->leftjoin('faculty','users.user_faculty','=','faculty.faculty_id')
        ->leftjoin('user_group','users.user_group_id','=','user_group.user_group_id')
        ->get();
        return view('dashboard.addmember',compact('user','course','faculty','groupuser'));
    }
    public function index3()
    {
        
        return view('dashboard/index3');
    }
    public function index4()
    {
        
        return view('dashboard/permission');
    }
    public function index5()
    {
        $getgroupmenu=Groupmenu::all();
        return view('dashboard/Groupmenu',compact('getgroupmenu'));
    }
    public function index6()
    {
        $getmenu=Menu::leftjoin('menu_group','menu.g_id','=','menu_group.g_id')
        ->get();
        $getgroupmenu=Groupmenu::all();
        return view('dashboard/Menu',compact('getmenu','getgroupmenu'));
    }
    public function index7()
    {
        $getusergroup=usergroup::all();
        $role=GroupMenu::all();
         foreach ($role as $key => $value){
            $value->menu->first(); 
         }
         $getper=rolepermission::leftjoin('menu','role_permission.m_id','=','menu.m_id')
         ->get();
         $user=auth()->user();
        $user_group=$user->user_group_id;
        $rolepermiss=rolepermission::where('user_group_id',$user_group)->get();

        session()->put('roleper',$rolepermiss);
        return view('dashboard.permission',compact('getusergroup','role','getper'));
        dd($role);
    }
    public function index8()
    {   $faculty=Faculty::all();
        $course=Course::leftjoin('faculty','course.faculty_id','=','faculty.faculty_id')
        ->get();
        return view('dashboard/course',compact('course','faculty'));
    }
    public function index9()
    {
        
        return view('dashboard/board');
    }
    public function index10()
    {
      $Category=category::all();
      return view('dashboard/category',compact('Category'));
    }
    public function index11()
    {
        $indicator=defaulindicator::all();
        $category=category::all();
        $composition=composition::all();
        return view('dashboard/Indicator',compact('indicator','category','composition'));
    }
    public function index12()
    {
        
        return view('dashboard/usercategory');
    }
    public function index13()
    {
        $faculty=Faculty::all();
        return view('dashboard/faculty',compact('faculty'));
    }
    public function index14()
    {
        $groupuser=groupuser::all();
        return view('dashboard/addgroupmember',compact('groupuser'));
    }
    public function index15()
    {
        $Branch=branch::leftjoin('course','branch.course_id','=','course.course_id')
        ->get();
        $course=Course::all();
        return view('dashboard/branch',compact('Branch','course'));
    }
    public function index16()
    {
        $course=Course::all();
        $Assessment_results=assessment_results::leftjoin('category','assessment_results.category_id','=','category.category_id')
        ->where('assessment_results.year_id',session()->get('year_id'))
        ->get();
        $Category=category::all();
        $ccate=count($Category);
        $cAss=count($Assessment_results);
        $dis="";
        if($ccate==$cAss){
            $dis="disabled";
        }
        return view('dashboard/assessment_results',compact('Assessment_results','Category','dis','cAss','course'));
    }
    public function index17()
    {
        return view('dashboard/dashboard');
    }
    public function index18()
    {
        $user=auth()->user();
        $user_id=$user->id;
        $data=User::leftjoin('user_group','users.user_group_id','=','user_group.user_group_id')
        ->leftjoin('course','users.user_course','=','course.course_id')
        ->where('id',$user_id)
        ->get();
        return view('dashboard/profile',compact('data'));
    }
    public function index19()
    {
        $tc_course= User::leftjoin('course_teacher','users.id','=','course_teacher.user_id')
         ->where('users.user_course',session()->get('usercourse'))
         ->where('course_teacher.year_id',session()->get('year_id'))
         ->get();
        $tc=User::where('user_course',session()->get('usercourse'))
        ->paginate(10);
        return view('dashboard/tc_course',compact('tc_course','tc'));
    }
    public function index20()
    {
        $tc_course= instructor::leftjoin('users','instructor.user_id','=','users.id')
         ->where('instructor.course_id',session()->get('usercourse'))
         ->where('instructor.year_id',session()->get('year_id'))
         ->get();
        $tc=User::where('user_course',session()->get('usercourse'))
        ->paginate(10);
        return view('dashboard/instructor1',compact('tc_course','tc'));
    }
    public function index21()
    {
        $getusergroup=User::where('user_course',session()->get('usercourse'))
        ->get();
        $role=GroupMenu::all();
        $getper=rolepermission::leftjoin('menu','role_permission.m_id','=','menu.m_id')
         ->get();
         $user=auth()->user();
        $user_group=$user->user_group_id;
        $rolepermiss=rolepermission::where('user_group_id',$user_group)->get();

        session()->put('roleper',$rolepermiss);
        return view('dashboard/addindicator',compact('getusergroup','role','getper'));
    }
    public function index22()
    {
        $tc_course= course_responsible_teacher::leftjoin('users','course_responsible_teacher.user_id','=','users.id')
         ->where('course_responsible_teacher.course_id',session()->get('usercourse'))
         ->where('course_responsible_teacher.year_id',session()->get('year_id'))
         ->get();
        $tc=User::where('user_course',session()->get('usercourse'))
        ->paginate(10);
        return view('dashboard/crt',compact('tc_course','tc'));
    }
}
