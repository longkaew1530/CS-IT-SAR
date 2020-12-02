<?php

namespace App\Http\Controllers;
use App\User;
use App\PDCA;
use App\Groupmenu;
use App\Course;
use App\course_responsible_teacher;
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
        
       
        return view('dashboard/year');
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
        
        return view('dashboard/Groupmenu');
    }
    public function index6()
    {
        
        return view('dashboard/Menu');
    }
    public function index7()
    {
        $Getall=PDCA::all();
        // $role=GroupMenu::all();
        
        
        //  foreach ($role as $key => $value){
        //     $value->menu->first(); 
        //  }
        return view('dashboard.permission');
        dd($role);
    }
    public function index8()
    {
        
        return view('dashboard/course');
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
        $user=auth()->user();
        $user_course=$user->user_course;

        //ดึงค่าตารางหลักสูตร
        $course = Course::where('course_id',$user_course)->get();

        //ดึงค่าตารางอาจารย์ผู้รับผิดชอบหลักสูตร
        $trc = course_responsible_teacher::join('year','course_responsible_teacher.year_id','=','year.year_id')
        ->where('course_responsible_teacher.course_id',$user_course)
        ->where('year.year_id',1)
        ->get();
        ///นับอาจารย์ผู้รีบผิดชอบหลักสูตร
        $count=count($trc);

        foreach($course as $value)
        {
            $c=$value['course_name'];
        }
        ///SELECT user_fullname
        // FROM course_responsible_teacher
        // left JOIN users on course_responsible_teacher.user_id=users.id
        // LEFT JOIN year on course_responsible_teacher.year_id=year.year_id
        // WHERE users.user_course=1 AND year.year_id=1
        ///join table course_responsible_teacher และ users เพื่อให้ได้ชื่อ user ที่เป็นอาจารย์ผู้รับผิดชอบหลักสูตร
        $nameteacher = course_responsible_teacher::leftjoin('users','course_responsible_teacher.user_id','=','users.id')
        ->leftjoin('year','course_responsible_teacher.year_id','=','year.year_id')
        ->where('users.user_course',$user_course)
        ->where('year.year_id',1)
        ->get();
        return view('category/category1',compact('c','count','nameteacher'));
    }
}
