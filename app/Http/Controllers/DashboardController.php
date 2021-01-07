<?php

namespace App\Http\Controllers;
use App\User;
use App\PDCA;
use App\DocPDCA;
use App\Groupmenu;
use App\Course;
use App\Year;
use App\Tps;
use App\usergroup;
use App\Menu;
use App\rolepermission;
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
        $year=Year::all();
        foreach($year as $value){
            $y_name=$value['year_name'];
            $y_id=$value['year_id'];
        }
        session()->put('usercourse',$user_course);
        session()->put('year',$y_name);
        session()->put('year_id',$y_id);
        $groupmenu=Groupmenu::all();
        $rolepermiss=rolepermission::where('user_group_id',$user_group)->get();
       
         foreach ($groupmenu as $key => $value){
            $value->menu->first(); 
         }
        session()->put('groupmenu',$groupmenu);
        session()->put('roleper',$rolepermiss);
        return view('dashboard/year',compact('year'));
    }
    public function index2()
    {
        
        $Getall=User::all();
        return view('dashboard.addmember',compact('Getall'));
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
        $getmenu=Menu::all();
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
      
        return view('dashboard/category');
    }
    public function index11()
    {
        
        return view('dashboard/Indicator');
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
}
