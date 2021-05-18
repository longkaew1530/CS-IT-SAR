<?php

namespace App\Http\Controllers;
use App\User;
use App\PDCA;
use App\DocPDCA;
use App\Groupmenu;
use App\Course;
use App\composition;
use App\indicator1_1;
use App\branch;
use App\indicator2_1;
use App\indicator2_2;
use App\indicator4_3;
use App\indicator5_4;
use App\performance3_3;
use App\category3_GD;
use App\course_detail;
use App\category3_infostudent;
use App\category3_infostudent_qty;
use App\year_acceptance_graduate;
use App\category3_resignation;
use App\category4_teaching_quality;
use App\category4_course_results;
use App\ModelAJ\category4_academic_performance;
use App\category4_notcourse_results;
use  App\ModelAJ\category4_incomplete_content;
use App\Year;
use App\category4_effectiveness;
use App\category4_newteacher;
use App\category4_activity;
use App\category5_course_manage;
use App\category6_assessment_summary;
use App\category6_comment_course;
use App\category7_strength;
use App\category7_development_proposal_detail;
use App\category7_newstrength;
use App\category7_strengths_summary;
use App\category3_graduate;
use App\Tps;
use App\usergroup;
use App\defaulindicator;
use App\Menu;
use App\category;
use App\instructor;
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
    
        $user=auth()->user();
        $user_course=$user->user_course;
        $user_group=$user->user_group_id;
        $year=Year::where('active',1)
        ->get();
        $getAllyear=Year::all();
        if($getAllyear!="[]"){
            foreach($year as $value){
                $y_name=$value['year_name'];
                $y_id=$value['year_id'];
            }
            session()->put('year',$y_name);
            session()->put('year_id',$y_id);
        }
        if($user_group!=2){
            session()->put('branch_id',$user->user_branch);
        }
        
        session()->put('usercourse',$user_course);
        $groupmenu=Groupmenu::all();
        $menu=Menu::all();
        $indica=defaulindicator::all();
        $rolepermiss=rolepermission::leftjoin('menu','role_permission.m_id','=','menu.m_id')
        ->where('user_group_id',$user_group)
        ->get();
       
         foreach ($groupmenu as $key => $value){
            $value->menu->first(); 
         }
         session()->put('checkindica',$indica);
        session()->put('groupmenu',$groupmenu);
        session()->put('roleper',$rolepermiss);
        session()->put('menu',$menu);
        $category=category::all();
        $getfaculty=faculty::where('faculty_id',$user->user_faculty)->get();
        session()->put('checkyear_id',$y_id);
        session()->put('getfaculty',$getfaculty);
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

        $querygetwork=user_permission::where('user_id',$user->id)
        ->where('year_id',session()->get('year_id'))
        ->get();
        $getwork=count($querygetwork);
        if($user_group==1){
            session()->put('m_menu1',1);  
            session()->put('m_menu2',10);
            session()->put('putput',0);  
            return view('dashboard/year',compact('year','getAllyear'));
        }
       else if($user_group==3){
            session()->put('putput',3);
            return view('dashboard/dashboard');
       }
       else if($user_group==2){
        if(session()->get('checkbranch')!=1){
            $querycourse=Course::where('faculty_id',$user->user_faculty)->get();
            $queryb=branch::where('course_id',$querycourse[0]['course_id'])->get();
            session()->put('branch_id',$queryb[0]['branch_id']);
        }
        session()->put('putput',3);
        
        return view('dashboard/dashboard3');
        }
       else{
        session()->put('putput',3);
            return view('dashboard/dashboard2',compact('getwork'));
       }
    }
    public function index2()
    {
        $course=Course::all();
        $branch=branch::all();
        $faculty=Faculty::all();
        $groupuser=groupuser::all();
        $user=User::leftjoin('course','users.user_course','=','course.course_id')
        ->leftjoin('faculty','users.user_faculty','=','faculty.faculty_id')
        ->leftjoin('branch','users.user_branch','=','branch.branch_id')
        ->leftjoin('user_group','users.user_group_id','=','user_group.user_group_id')
        ->get();
        return view('dashboard.addmember',compact('user','course','faculty','groupuser','branch'));
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
        $getcoursedetail=course_detail::all();
        return view('dashboard/course',compact('course','faculty','getcoursedetail'));
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
        ->where('assessment_results.course_id',session()->get('usercourse'))
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
        // $tc=User::select('*')->whereNotIn('book_price', [100,200])
        // ->where('user_course',session()->get('usercourse'))
        // ->paginate(10);
        $tc=User::whereNotIn('users.id', function($join1)
            {
                
                $join1->select('user_id')->from('course_teacher')
                ->where('course_teacher.course_id',session()->get('usercourse'))
             ->where('course_teacher.year_id',session()->get('year_id'));

            })
            ->where('user_course',session()->get('usercourse'))
            ->where('user_branch',session()->get('branch_id'))
            ->where('user_group_id','!=',2)
            ->where('user_group_id','!=',1)
            ->get();
        return view('dashboard/tc_course',compact('tc_course','tc'));
    }
    public function index20()
    {
        $tc_course= instructor::leftjoin('users','instructor.user_id','=','users.id')
         ->where('instructor.course_id',session()->get('usercourse'))
         ->where('instructor.year_id',session()->get('year_id'))
         ->get();
         $tc=User::whereNotIn('users.id', function($join1)
         {
             
             $join1->select('user_id')->from('instructor')
             ->where('instructor.course_id',session()->get('usercourse'))
             ->where('instructor.year_id',session()->get('year_id'));

         })
         ->where('user_course',session()->get('usercourse'))
         ->where('user_branch',session()->get('branch_id'))
         ->where('user_group_id','!=',2)
            ->where('user_group_id','!=',1)
         ->get();
        return view('dashboard/instructor1',compact('tc_course','tc'));
    }
    public function index21()
    {
        $getusergroup=User::where('user_course',session()->get('usercourse'))
        ->where('user_branch',session()->get('branch_id'))
        ->where('user_group_id','!=',1)
        ->where('user_group_id','!=',2)
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
         ->where('course_responsible_teacher.branch_id',session()->get('branch_id'))
         ->where('course_responsible_teacher.year_id',session()->get('year_id'))
         ->get();
         $tc=User::whereNotIn('users.id', function($join1)
         {
             
             $join1->select('user_id')->from('course_responsible_teacher')
             ->where('course_responsible_teacher.course_id',session()->get('usercourse'))
             ->where('course_responsible_teacher.branch_id',session()->get('branch_id'))
             ->where('course_responsible_teacher.year_id',session()->get('year_id'));

         })
         ->where('user_course',session()->get('usercourse'))
         ->where('user_branch',session()->get('branch_id'))
         ->where('user_group_id','!=',2)
            ->where('user_group_id','!=',1)
        ->get();
        return view('dashboard/crt',compact('tc_course','tc'));
    }
    public function index23()
    {
        
        $getyear=Year::where('year_id','<',session()->get('checkyear_id'))
        ->get();
        return view('dashboard/dashboard4',compact('getyear'));
    }
}
