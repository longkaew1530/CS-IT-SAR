<?php

namespace App\Http\Controllers;
use App\User;
use App\PDCA;
use App\DocPDCA;
use App\Groupmenu;
use App\Course;
use App\categoty_researh;
use App\Year;
use App\Tps;
use App\course_responsible_teacher;
use App\Educational_background;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function indicator1_1()
    {
        $user=auth()->user();
        $user_course=$user->user_course;
        //ดึงค่าปี
        $year=Year::where('year_name',2563)->get();
        foreach($year as $value){
            $y=$value['year_name'];
         }
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
        ->where('users.user_course',$user_course)
        ->where('course_responsible_teacher.year_id',1)
        ->get();

        ////ดึงสาขาวิชาที่จบของอาจารย์ผู้รับผิดชอบหลักสูตร
        $educ_bg= User::leftjoin('course_responsible_teacher','users.id','=','course_responsible_teacher.user_id')
        ->where('users.user_course',$user_course)
        ->where('course_responsible_teacher.year_id',1)
        ->get();
        
         ////ดึงสาขาวิชาที่จบของอาจารย์ประจำหลักสูตร
         $tc_course= User::leftjoin('course_teacher','users.id','=','course_teacher.user_id')
         ->where('users.user_course',$user_course)
         ->where('course_teacher.year_id',1)
         ->get();

         ////ดึงสาขาวิชาที่จบของอาจารย์ผู้สอน
         $instructor= User::leftjoin('instructor','users.id','=','instructor.user_id')
         ->where('users.user_course',$user_course)
         ->where('instructor.year_id',1)
         ->get();
         ////ดึงสาขาวิชาที่จบของอาจารย์ผู้สอนพิเศษ
         $specialinstructor= User::leftjoin('special_teacher','users.id','=','special_teacher.user_id')
         ->where('users.user_course',$user_course)
         ->where('special_teacher.year_id',1)
         ->get();
        
         ////ดึงผลการประเมินตนเอง ตัวบ่งชี้ที่ 1.1
        $inc= Tps::leftjoin('indicator','tps.indicator_id','=','indicator.indicator_id')
        ->where('tps.course_id',$user_course)
        ->where('tps.year_id',1)
        ->get();
         foreach ($educ_bg as $key => $value){
            $value->educational_background->first(); 
         }
        //ตรวจสอบ 1.จำนวนอาจารย์ผู้รับผิดชอบหลักสูตร
        if($count>=5)
        {
            $checkpass=true;
            $checknotpass=false;
        }
        else
        {
            $checknotpass=true;
            $checkpass=false;
        }
        return view('category/indicator1-1',compact('c','count','nameteacher'
        ,'educ_bg','y','checkpass','checknotpass','tc_course','instructor','specialinstructor','inc'));
    }
    public function category1()
    {
        
        $user=auth()->user();
        $user_course=$user->user_course;
        //ดึงค่าปี
        $year=Year::where('year_name',2563)->get();
        foreach($year as $value){
            $y=$value['year_name'];
         }
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
        ->where('users.user_course',$user_course)
        ->where('course_responsible_teacher.year_id',1)
        ->get();

        ////ดึงสาขาวิชาที่จบของอาจารย์ผู้รับผิดชอบหลักสูตร
        $educ_bg= User::leftjoin('course_responsible_teacher','users.id','=','course_responsible_teacher.user_id')
        ->where('users.user_course',$user_course)
        ->where('course_responsible_teacher.year_id',1)
        ->get();

         ////ดึงสาขาวิชาที่จบของอาจารย์ประจำหลักสูตร
         $tc_course= User::leftjoin('course_teacher','users.id','=','course_teacher.user_id')
         ->where('users.user_course',$user_course)
         ->where('course_teacher.year_id',1)
         ->get();

         ////ดึงสาขาวิชาที่จบของอาจารย์ผู้สอน
         $instructor= User::leftjoin('instructor','users.id','=','instructor.user_id')
         ->where('users.user_course',$user_course)
         ->where('instructor.year_id',1)
         ->get();
         ////ดึงสาขาวิชาที่จบของอาจารย์ผู้สอนพิเศษ
         $specialinstructor= User::leftjoin('special_teacher','users.id','=','special_teacher.user_id')
         ->where('users.user_course',$user_course)
         ->where('special_teacher.year_id',1)
         ->get();
        
         ////ดึงผลการประเมินตนเอง ตัวบ่งชี้ที่ 1.1
        $inc= Tps::leftjoin('indicator','tps.indicator_id','=','indicator.indicator_id')
        ->where('tps.course_id',$user_course)
        ->where('tps.year_id',1)
        ->get();
         foreach ($educ_bg as $key => $value){
            $value->educational_background->first(); 
         }
        //ตรวจสอบ 1.จำนวนอาจารย์ผู้รับผิดชอบหลักสูตร
        if($count>=5)
        {
            $checkpass=true;
            $checknotpass=false;
        }
        else
        {
            $checknotpass=true;
            $checkpass=false;
        }
        return view('category/category1',compact('c','count','nameteacher'
        ,'educ_bg','y','checkpass','checknotpass','tc_course','instructor','specialinstructor','inc','course'));
    }
    public function indicator4_1($id)
    {
        $pdca=PDCA::leftjoin('indicator','pdca.Indicator_id','=','indicator.indicator_id')
        ->where('pdca.Indicator_id',$id)
        ->where('pdca.course_id',1)
        ->where('pdca.year_id',1)
        ->get();
        foreach ($pdca as $key => $value){
            $value->docpdca->first(); 
         }
        ///ดึงผลการประเมินตนเอง ตามID ตัวบ่งชี้ ในตางราง PDCA


        return view('category/indicator4-1',compact('pdca'));
    }
    public function indicator4_2($id)
    {
        // $category_re=categoty_researh::rightjoin('research_results','category_research_results.id','=','research_results.research_results_category')
        // ->leftjoin('course_responsible_teacher','research_results.user_id','=','course_responsible_teacher.user_id')
        // ->get();
        $category_re=categoty_researh::all();

        

        return view('category/indicator4-2',compact('category_re'));
    }
}
