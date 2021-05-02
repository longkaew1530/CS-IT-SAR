<?php

namespace App\Http\Controllers; 
use App\User;
use App\PDCA;
use App\DocPDCA;
use App\Groupmenu;
use App\defaulindicator;
use App\Menu;
use App\Course;
use App\indicator;
use App\categoty_researh;
use App\ModelAJ\Research_results;
use App\Year;
use App\Tps;
use App\branch;
use App\indicator4_3;
use App\indicator1_1;
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
        //ดึงค่าปี
        $year=Year::where('active',1)
        ->get();
        foreach($year as $value){
            $y=$value['year_name'];
         }
        //ดึงค่าตารางหลักสูตร
        $course = Course::where('course_id',session()->get('usercourse'))->get();

        //ดึงค่าตารางอาจารย์ผู้รับผิดชอบหลักสูตร
        $trc = course_responsible_teacher::join('year','course_responsible_teacher.year_id','=','year.year_id')
        ->where('course_responsible_teacher.course_id',session()->get('usercourse'))
        ->where('year.year_id',session()->get('year_id'))
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
        ->where('users.user_course',session()->get('usercourse'))
        ->where('course_responsible_teacher.year_id',session()->get('year_id'))
        ->get();

        ////ดึงสาขาวิชาที่จบของอาจารย์ผู้รับผิดชอบหลักสูตร
        $educ_bg= User::leftjoin('course_responsible_teacher','users.id','=','course_responsible_teacher.user_id')
        ->where('users.user_course',session()->get('usercourse'))
        ->where('course_responsible_teacher.year_id',session()->get('year_id'))
        ->get();
         ////ดึงสาขาวิชาที่จบของอาจารย์ประจำหลักสูตร
         $tc_course= User::leftjoin('course_teacher','users.id','=','course_teacher.user_id')
         ->where('users.user_course',session()->get('usercourse'))
         ->where('course_teacher.year_id',session()->get('year_id'))
         ->get();

         ////ดึงสาขาวิชาที่จบของอาจารย์ผู้สอน
         $instructor= User::leftjoin('instructor','users.id','=','instructor.user_id')
         ->where('users.user_course',session()->get('usercourse'))
         ->where('instructor.year_id',session()->get('year_id'))
         ->get();
         ////ดึงสาขาวิชาที่จบของอาจารย์ผู้สอนพิเศษ
         $specialinstructor= User::leftjoin('special_teacher','users.id','=','special_teacher.user_id')
         ->where('users.user_course',session()->get('usercourse'))
         ->where('special_teacher.year_id',session()->get('year_id'))
         ->get();

         $getresult=indicator1_1::where('year_id',session()->get('year_id'))
         ->where('course_id',session()->get('usercourse'))
         ->get();
         $get1=0;
         $get2=0;
         $get3=0;
         $get4=0;
         $get5=0;
         $result1=0;
         $result2=0;
         $result3=0;
         $result4=0;
         $result5=0;
         $result6=0;
         $result7=0;
         $result8=0;
         $result9=0;
         $result10=0;
         if($getresult!="[]"){
            foreach($getresult as $value){
                $get1=$value['result1'];
                $get2=$value['result2'];
                $get3=$value['result3'];
                $get4=$value['result4'];
                $get5=$value['result5'];
            }
            if($get1==2){
               $result1=1;
               $result2=0;
            }
            else if($get1==1){
               $result1=0;
               $result2=1;
            }
            else{
                $result1=0;
                $result2=0;
            }
           // ----------
            if($get2==2){
               $result3=1;
               $result4=0;
            }
            else if($get2==1){
                $result3=0;
                $result4=1;
             }
             else{
                 $result3=0;
                 $result4=0;
             }
           // ----------
            if($get3==2){
               $result5=1;
               $result6=0;
            }
            else if($get3==1){
                $result5=0;
                $result6=1;
             }
             else{
                 $result5=0;
                 $result6=0;
             }
             // ----------
            if($get4==2){
               $result7=1;
               $result8=0;
            }
            else if($get4==1){
                $result7=0;
                $result8=1;
             }
             else{
                 $result7=0;
                 $result8=0;
             }

            if($get5==2){
                $result9=1;
                $result10=0;
             }
             else if($get5==1){
                $result9=0;
                $result10=1;
             }
             else{
                 $result9=0;
                 $result10=0;
             }
         }
         $getcategorypdca=defaulindicator::where('id',1)
        ->get();
        $name="";
        $id="";
        foreach($getcategorypdca as $value)
        {
            $name=$value['Indicator_name'];
            $id=$value['Indicator_id'];
        }
        $checkedit="asdsad";
         ////ดึงผลการประเมินตนเอง ตัวบ่งชี้ที่ 1.1
        $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',1.1)
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
        ,'educ_bg','y','checkpass','checknotpass','checkedit','id','name','tc_course','instructor','specialinstructor','inc','result1','result2','result3','result4','result5','result6','result7','result8','result9','result10'));
    }
    public function category1()
    {
        
        
        //ดึงค่าปี
        $year=Year::where('active',1)
        ->get();
        foreach($year as $value){
            $y=$value['year_name'];
         }
        //ดึงค่าตารางหลักสูตร
        $course = Course::where('course_id',session()->get('usercourse'))->get();
        $course_detail = course_detail::where('course_id',session()->get('usercourse'))->get();
        $user=auth()->user();
        $user_branch=branch::where('id',$user->user_branch)->get();
        //ดึงค่าตารางอาจารย์ผู้รับผิดชอบหลักสูตร
        $trc = course_responsible_teacher::join('year','course_responsible_teacher.year_id','=','year.year_id')
        ->where('course_responsible_teacher.course_id',session()->get('usercourse'))
        ->where('year.year_id',session()->get('year_id'))
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
        ->where('users.user_course',session()->get('usercourse'))
        ->where('course_responsible_teacher.year_id',session()->get('year_id'))
        ->get();

        ////ดึงสาขาวิชาที่จบของอาจารย์ผู้รับผิดชอบหลักสูตร
        $educ_bg= User::leftjoin('course_responsible_teacher','users.id','=','course_responsible_teacher.user_id')
        ->where('users.user_course',session()->get('usercourse'))
        ->where('course_responsible_teacher.year_id',session()->get('year_id'))
        ->get();

         ////ดึงสาขาวิชาที่จบของอาจารย์ประจำหลักสูตร
         $tc_course= User::leftjoin('course_teacher','users.id','=','course_teacher.user_id')
         ->where('users.user_course',session()->get('usercourse'))
         ->where('course_teacher.year_id',session()->get('year_id'))
         ->get();

         ////ดึงสาขาวิชาที่จบของอาจารย์ผู้สอน
         $instructor= User::leftjoin('instructor','users.id','=','instructor.user_id')
         ->where('users.user_course',session()->get('usercourse'))
         ->where('instructor.year_id',session()->get('year_id'))
         ->get();
         ////ดึงสาขาวิชาที่จบของอาจารย์ผู้สอนพิเศษ
         $specialinstructor= User::leftjoin('special_teacher','users.id','=','special_teacher.user_id')
         ->where('users.user_course',session()->get('usercourse'))
         ->where('special_teacher.year_id',session()->get('year_id'))
         ->get();
        
         ////ดึงผลการประเมินตนเอง ตัวบ่งชี้ที่ 1.1
         $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
         ->where('pdca.year_id',session()->get('year_id'))
         ->where('pdca.indicator_id',1.1)
         ->get();
         $per="asdasd";
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
        ,'educ_bg','y','checkpass','checknotpass','tc_course','instructor','specialinstructor','inc','course','per','user_branch','course_detail'));
    }
    public function indicator4_1($id)
    {
        $pdca=PDCA::leftjoin('indicator','pdca.Indicator_id','=','indicator.indicator_id')
        ->where('pdca.Indicator_id',$id)
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->get();
        foreach ($pdca as $key => $value){
            $value->docpdca->first(); 
         }
        ///ดึงผลการประเมินตนเอง ตามID ตัวบ่งชี้ ในตางราง PDCA


        return view('category/indicator4-1',compact('pdca'));
    }
    public function indicator4_2()
    {
       
        //ดึงค่าปี
        $year=Year::where('year_name',2563)->get();
        foreach($year as $value){
            $y=$value['year_name'];
         }
        // $category_re=categoty_researh::rightjoin('research_results','category_research_results.id','=','research_results.research_results_category')
        // ->leftjoin('course_responsible_teacher','research_results.user_id','=','course_responsible_teacher.user_id')
        // ->get();
        

        $cate=categoty_researh::all();

        // $category_re=Research_results::rightjoin('research_results_user', function($join1)
        //     {
                
        //         $join1->on('research_results.research_results_id', '=', 'research_results_user.research_results_research_results_id');
        //         $join1->leftjoin('course_responsible_teacher', function($join2)
        //         {
        //           $join2->where('course_responsible_teacher.course_id',session()->get('usercourse'));
        //           $join2->on('research_results_user.user_id', '=', 'course_responsible_teacher.user_id');
                  
        //         });
        //     })
        // ->groupBy('research_results_id')
        // ->leftjoin('category_research_results','research_results.research_results_category','=','category_research_results.id')
        // ->get();
        $category_re = Research_results::rightjoin('course_responsible_teacher','research_results.owner','=','course_responsible_teacher.user_id')
        ->leftjoin('category_research_results','research_results.research_results_category','=','category_research_results.id')
        ->where('course_responsible_teacher.year_id',session()->get('year_id'))
        ->where('course_responsible_teacher.course_id',session()->get('usercourse'))
        ->where('research_results.research_results_year',session()->get('year'))
        ->get();
    //    dd($category_re);
        //ดึงค่าตารางอาจารย์ผู้รับผิดชอบหลักสูตร
        $trc = course_responsible_teacher::join('year','course_responsible_teacher.year_id','=','year.year_id')
        ->where('course_responsible_teacher.course_id',session()->get('usercourse'))
        ->where('course_responsible_teacher.year_id',session()->get('year_id'))
        ->get();
        ///นับอาจารย์ผู้รีบผิดชอบหลักสูตร
        $count=count($trc);
        
        $educ_bg= User::leftjoin('course_responsible_teacher','users.id','=','course_responsible_teacher.user_id')
        ->where('users.user_course',session()->get('usercourse'))
        ->where('course_responsible_teacher.year_id',session()->get('year_id'))
        ->get();
         $counteb_name=0;
         $countposition1=0;
         $countposition2=0;
         $countposition3=0;
        foreach($educ_bg as $value)
        {
            foreach($value->educational_background as $row)
            {
                if($row['eb_name']=='ปริญญาเอก')
                {
                    $counteb_name=$counteb_name+1;
                }
            }
            if($value['academic_position']=='ผู้ช่วยศาสตราจารย์')
            {
                $countposition1=$countposition1+1;
            }
            else if($value['academic_position']=='รองศาตราจารย์')
            {
                $countposition2=$countposition2+1;
            }
            else if($value['academic_position']=='ศาสตราจารย์'){
                $countposition3=$countposition3+1;
            }
        }
        $countcate=0;
        foreach($category_re as $value){
            if($value['research_results_year']==session()->get('year')){
                $countcate=$countcate+$value['score'];
            }
            
        }

        $inc=PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',4.2)
        ->where('pdca.target','!=',null)
        ->get();
        session()->put('result',3);
        ///ที่มีวุติปริญญาเอก
        $B=0;
        $C=0;
        $E=0;
        if($count!=0){
            $B=($counteb_name*100)/$count;
        }
        
        $qty1=($B*5)/20;
        //ที่มีตำแหน่งทางวิชาการ
        $A=$countposition1+$countposition2+$countposition3;
        if($count!=0){
        $C=($A*100)/$count;
        }
        $qty2=($C*5)/60;
        ///ผลงานทางวิชาการ
        if($count!=0){
        $E=($countcate*100)/$count;
        }
        $qty3=($E*5)/20;
        if($qty1>5){
            $qty1=5;
        }
        else if($qty2>5){
            $qty2=5;
        }
        else if($qty3>5){
            $qty3=5;
        }
        $getcategorypdca=defaulindicator::where('id',9)
        ->get();
        $name4_2="";
        $id4_2="";
        $checkedit="asdasd";
        foreach($getcategorypdca as $value)
        {
            $name4_2=$value['Indicator_name'];
            $id4_2=$value['Indicator_id'];
        }
        return view('category/indicator4-2',compact('checkedit','category_re','count','counteb_name','countposition1','countposition2','countposition3'
                    ,'cate','qty1','B','qty2','C','qty3','E','inc','id4_2','name4_2'));
    }
    public function indicator4_3()
    {
        $in4_3="";
        $in4_3=indicator4_3::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',4.3)
        ->get();
        $checkedit="asdsad";
        $getcategorypdca=defaulindicator::where('id',10)
        ->get();
        $name="";
        $id="";
        foreach($getcategorypdca as $value)
        {
            $name=$value['Indicator_name'];
            $id=$value['Indicator_id'];
        }
        
        return view('category/indicator4-3',compact('in4_3','inc','checkedit','id','name','getcategorypdca'));
    }
}
