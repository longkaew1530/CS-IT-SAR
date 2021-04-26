<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelAJ\Educational_background;
use App\ModelAJ\Research_results;
use App\ModelAJ\Research_results_user;
use App\ModelAJ\past_performance;
use App\ModelAJ\categoty_researh;
use App\User;
use App\PDCA;
use App\Year;
use App\Course;
use App\category4_teaching_quality;
use App\docpdca;
use App\category3_resignation;
use App\course_responsible_teacher;
use App\indicator4_3;
use App\course_teacher;
use App\indicator2_1;
use App\indicator1_1;
use App\defaulindicator;
use App\indicator2_2;
use App\category;
use App\composition;
use App\category3_infostudent_qty;
use App\year_acceptance_graduate;
use App\year_acceptance;
use App\category3_graduate;
use App\indicator5_4;
use App\performance3_3;
use App\indicator;
use App\docindicator4_3;
use App\doc_indicator5_4;
use App\doc_performance3_3;
use App\category6_comment_course;
use App\category7_strength;
use App\category7_newstrength;
use App\category3_infostudent;
use App\category6_assessment_summary;
use App\category4_course_results;
use App\category4_activity;
use App\category7_strengths_summary;
use App\category7_development_proposal;
use App\category7_development_proposal_detail;
use App\category4_effectiveness;
use App\category4_notcourse_results;
use App\category5_course_manage;
use App\assessment_results;
use App\category4_newteacher;
use App\ModelAJ\category4_academic_performance;
use App\ModelAJ\category4_incomplete_content;
use App\in_index;
use File;
use Maatwebsite\Excel\Facades\Excel;
use App\ModelAJ\category3_inforstudent;
use App\Imports\AddstdImport;
use App\Imports\Addcourse_results;
use App\Imports\Addstrength;
use App\Imports\Addnewstrength;
use App\category3_GD;

class ShowCategoryController extends Controller
{
    public function category2()
    {
        session()->put('idmenu',$id);
        $getcategorypdca=indicator::where('id',$id)
        ->get();
        $pdca=PDCA::leftjoin('indicator','pdca.Indicator_id','=','indicator.indicator_id')
        ->where('pdca.Indicator_id',$getcategorypdca[0]['Indicator_id'])
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->get();
        $getcourse=Course::where('course_id',session()->get('usercourse'))
        ->get();
        $name="";
        $id="";
        ////ดึงผลการประเมินตนเอง ตัวบ่งชี้ที่ 1.1
        $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',$getcategorypdca[0]['Indicator_id'])
        ->where('pdca.target','!=',null)
        ->get();
        $checkedit="";
        if(count($inc)==0){
            $inc="";
        }
        foreach($getcategorypdca as $value)
        {
            $name=$value['Indicator_name'];
            $id=$value['Indicator_id'];
        }
        return view('category3/category2',compact('pdca','name','id','getcourse','getcategorypdca','inc','checkedit'));
    }
    public function showindicator($id)
    {
        if($id=="1.1"){
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
            $checkedit="";
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
         if($id=="2.1"){
            $factor=indicator2_1::where('course_id',session()->get('usercourse'))
            ->where('year_id',session()->get('year_id'))
            ->get();
            $pdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
           ->where('pdca.course_id',session()->get('usercourse'))
           ->where('pdca.year_id',session()->get('year_id'))
           ->where('pdca.Indicator_id',2.1)
           ->where('pdca.target','!=',null)
           ->get();
           $per1="ssssss";
           $checkedit="";
           $getcategorypdca=defaulindicator::where('id',2)
            ->get();
            $name="";
            $id="";
            foreach($getcategorypdca as $value)
            {
                $name=$value['Indicator_name'];
                $id=$value['Indicator_id'];
            }
           return view('category3/indicator2-1',compact('factor','pdca','per1','checkedit','id','name'));
        }
        if($id=="2.2"){
            $factor=indicator2_2::where('course_id',session()->get('usercourse'))
         ->where('year_id',session()->get('year_id'))
         ->get();
         $pdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',2.2)
        ->where('pdca.target','!=',null)
        ->get();
        $per1="ssssss";
        $getcategorypdca=defaulindicator::where('id',4)
        ->get();
        $name="";
        $id="";
        $checkedit="";
        foreach($getcategorypdca as $value)
        {
            $name=$value['Indicator_name'];
            $id=$value['Indicator_id'];
        }
        return view('category3/indicator2-2',compact('factor','pdca','per1','id','name','checkedit'));
        }
         if($id=="3.1"){
            $getcategorypdca=indicator::where('Indicator_id',3.1)
            ->where('course_id',session()->get('usercourse'))
            ->where('year_id',session()->get('year_id'))
            ->get();
            $pdca=PDCA::leftjoin('indicator','pdca.Indicator_id','=','indicator.indicator_id')
            ->where('pdca.Indicator_id',3.1)
            ->where('pdca.course_id',session()->get('usercourse'))
            ->where('pdca.year_id',session()->get('year_id'))
            ->get();
            $getcourse=Course::where('course_id',session()->get('usercourse'))
            ->get();
            $name="";
            $id="";
            ////ดึงผลการประเมินตนเอง ตัวบ่งชี้ที่ 1.1
            $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
            ->where('pdca.course_id',session()->get('usercourse'))
            ->where('pdca.year_id',session()->get('year_id'))
            ->where('pdca.indicator_id',3.1)
            ->where('pdca.target','!=',null)
            ->get();
            if(count($inc)==0){
                $inc="";
            }
            foreach($getcategorypdca as $value)
            {
                $name=$value['Indicator_name'];
                $id=$value['Indicator_id'];
            }
            $checkedit="";
            return view('category3/showpdca',compact('pdca','name','id','getcourse','getcategorypdca','inc','checkedit'));
        }
         if($id=="3.2"){
            $getcategorypdca=indicator::where('Indicator_id',3.2)
            ->where('course_id',session()->get('usercourse'))
            ->where('year_id',session()->get('year_id'))
            ->get();
            $pdca=PDCA::leftjoin('indicator','pdca.Indicator_id','=','indicator.indicator_id')
            ->where('pdca.Indicator_id',3.2)
            ->where('pdca.course_id',session()->get('usercourse'))
            ->where('pdca.year_id',session()->get('year_id'))
            ->get();
            $getcourse=Course::where('course_id',session()->get('usercourse'))
            ->get();
            $name="";
            $id="";
            ////ดึงผลการประเมินตนเอง ตัวบ่งชี้ที่ 1.1
            $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
            ->where('pdca.course_id',session()->get('usercourse'))
            ->where('pdca.year_id',session()->get('year_id'))
            ->where('pdca.indicator_id',3.2)
            ->where('pdca.target','!=',null)
            ->get();
            if(count($inc)==0){
                $inc="";
            }
            foreach($getcategorypdca as $value)
            {
                $name=$value['Indicator_name'];
                $id=$value['Indicator_id'];
            }
            $checkedit="";
            return view('category3/showpdca',compact('pdca','name','id','getcourse','getcategorypdca','inc','checkedit'));
        }
         if($id=="3.3"){
            $in3_3=performance3_3::where('course_id',session()->get('usercourse'))
            ->where('year_id',session()->get('year_id'))
            ->get();
            $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
            ->where('pdca.course_id',session()->get('usercourse'))
            ->where('pdca.year_id',session()->get('year_id'))
            ->where('pdca.indicator_id',3.3)
            ->where('pdca.target','!=',null)
            ->get();
            $getcategorypdca=defaulindicator::where('id',7)
            ->get();
            $name="";
            $id="";
            $checkedit="";
            foreach($getcategorypdca as $value)
            {
                $name=$value['Indicator_name'];
                $id=$value['Indicator_id'];
            }
            return view('category3/perfoment3_3',compact('in3_3','inc','id','name','checkedit'));
        }
         if($id=="4.1"){

            $getcategorypdca=indicator::where('Indicator_id',4.1)
            ->where('course_id',session()->get('usercourse'))
            ->where('year_id',session()->get('year_id'))
            ->get();
            $pdca=PDCA::leftjoin('indicator','pdca.Indicator_id','=','indicator.indicator_id')
            ->where('pdca.Indicator_id',4.1)
            ->where('pdca.course_id',session()->get('usercourse'))
            ->where('pdca.year_id',session()->get('year_id'))
            ->get();
            $getcourse=Course::where('course_id',session()->get('usercourse'))
            ->get();
            $name="";
            $id="";
            ////ดึงผลการประเมินตนเอง ตัวบ่งชี้ที่ 1.1
            $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
            ->where('pdca.course_id',session()->get('usercourse'))
            ->where('pdca.year_id',session()->get('year_id'))
            ->where('pdca.indicator_id',4.1)
            ->where('pdca.target','!=',null)
            ->get();
            if(count($inc)==0){
                $inc="";
            }
            foreach($getcategorypdca as $value)
            {
                $name=$value['Indicator_name'];
                $id=$value['Indicator_id'];
            }
            $checkedit="";
            return view('category3/showpdca',compact('pdca','name','id','getcourse','getcategorypdca','inc','checkedit'));
        }
        if($id=="4.2"){
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
        $name="";
        $id="";
        $checkedit="";
        foreach($getcategorypdca as $value)
        {
            $name=$value['Indicator_name'];
            $id=$value['Indicator_id'];
        }
        return view('category/indicator4-2',compact('category_re','count','counteb_name','countposition1','countposition2','countposition3'
                    ,'cate','qty1','B','qty2','C','qty3','E','inc','id','name','checkedit'));
       }
       if($id=="4.3"){
        $in4_3=indicator4_3::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',4.3)
        ->where('pdca.target','!=',null)
        ->get();
        $checkedit="";
        $getcategorypdca=defaulindicator::where('id',10)
        ->get();
        $name="";
        $id="";
        foreach($getcategorypdca as $value)
        {
            $name=$value['Indicator_name'];
            $id=$value['Indicator_id'];
        }
        return view('category/indicator4-3',compact('in4_3','inc','checkedit','name','id','getcategorypdca'));
       }
       if($id=="5.1"){
        $getcategorypdca=indicator::where('Indicator_id',5.1)
        ->where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $pdca=PDCA::leftjoin('indicator','pdca.Indicator_id','=','indicator.indicator_id')
        ->where('pdca.Indicator_id',5.1)
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->get();
        $getcourse=Course::where('course_id',session()->get('usercourse'))
        ->get();
        $name="";
        $id="";
        ////ดึงผลการประเมินตนเอง ตัวบ่งชี้ที่ 1.1
        $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',5.1)
        ->where('pdca.target','!=',null)
        ->get();
        if(count($inc)==0){
            $inc="";
        }
        foreach($getcategorypdca as $value)
        {
            $name=$value['Indicator_name'];
            $id=$value['Indicator_id'];
        }
        $checkedit="";
        return view('category3/showpdca',compact('pdca','name','id','getcourse','getcategorypdca','inc','checkedit'));
       }
       if($id=="5.2"){
        $getcategorypdca=indicator::where('Indicator_id',5.2)
        ->where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $pdca=PDCA::leftjoin('indicator','pdca.Indicator_id','=','indicator.indicator_id')
        ->where('pdca.Indicator_id',5.2)
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->get();
        $getcourse=Course::where('course_id',session()->get('usercourse'))
        ->get();
        $name="";
        $id="";
        ////ดึงผลการประเมินตนเอง ตัวบ่งชี้ที่ 1.1
        $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',5.2)
        ->where('pdca.target','!=',null)
        ->get();
        if(count($inc)==0){
            $inc="";
        }
        foreach($getcategorypdca as $value)
        {
            $name=$value['Indicator_name'];
            $id=$value['Indicator_id'];
        }
        $checkedit="";
        return view('category3/showpdca',compact('pdca','name','id','getcourse','getcategorypdca','inc','checkedit'));
       }
       if($id=="5.3"){
        $getcategorypdca=indicator::where('Indicator_id',5.3)
        ->where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $pdca=PDCA::leftjoin('indicator','pdca.Indicator_id','=','indicator.indicator_id')
        ->where('pdca.Indicator_id',5.3)
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->get();
        $getcourse=Course::where('course_id',session()->get('usercourse'))
        ->get();
        $name="";
        $id="";
        ////ดึงผลการประเมินตนเอง ตัวบ่งชี้ที่ 1.1
        $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',5.3)
        ->where('pdca.target','!=',null)
        ->get();
        if(count($inc)==0){
            $inc="";
        }
        foreach($getcategorypdca as $value)
        {
            $name=$value['Indicator_name'];
            $id=$value['Indicator_id'];
        }
        $checkedit="";
        return view('category3/showpdca',compact('pdca','name','id','getcourse','getcategorypdca','inc','checkedit'));
       }
       if($id=="5.4"){
        $indi=in_index::all();
        $perfor=indicator5_4::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',5.4)
        ->where('pdca.target','!=',null)
        ->get();
        $per1="asdsad";
        $result=0;
        $resultpass1_5=0;
        $resultpass1_5persen=0;
        $resultpass1_5count=0;
        $resultpassall=0;
        $result=count($perfor);
        foreach($perfor as $value){
            if($value['in_index_id']==1||$value['in_index_id']==2||$value['in_index_id']==3||$value['in_index_id']==4||$value['in_index_id']==5){
                $resultpass1_5count++;
                if($value['status']==1){
                    $resultpass1_5++;
                }
            }
            if($value['status']==1){
                $resultpassall++;
            }
        }
        $resultpass1_5persen=($resultpass1_5count*100)/5;
        if($resultpassall!=0&&$resultpassall!=0){
            $resultavg=($resultpassall*100)/$result;
        }
        else{
            $resultavg=0;
        }
        session()->put('resultpass',$resultpassall);
        session()->put('result',$result);
        $resultavg2=0;
        if($resultavg>=1&&$resultavg<=20){
            $resultavg2=1;
           }
           else if($resultavg>=21&&$resultavg<=40){
            $resultavg2=2;
           }
           else if($resultavg>=41&&$resultavg<=60){
            $resultavg2=3;
          }
          else if($resultavg>=61&&$resultavg<=80){
            $resultavg2=4;
          }
          else if($resultavg>=81&&$resultavg<=100){
            $resultavg2=5;
          }
        session()->put('resultavg',$resultavg2);
        $checkedit="";
        $getcategorypdca=defaulindicator::where('id',14)
          ->get();
          $name="";
          $id="";
          foreach($getcategorypdca as $value)
          {
              $name=$value['Indicator_name'];
              $id=$value['Indicator_id'];
          }
        return view('category4/indicator5_4',compact('checkedit','id','name','indi','perfor','result','resultpass1_5','resultpass1_5persen','resultpassall','inc','per1'));
       }
       if($id=="6.1"){
        $getcategorypdca=indicator::where('Indicator_id',6.1)
        ->where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $pdca=PDCA::leftjoin('indicator','pdca.Indicator_id','=','indicator.indicator_id')
        ->where('pdca.Indicator_id',6.1)
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->get();
        $getcourse=Course::where('course_id',session()->get('usercourse'))
        ->get();
        $name="";
        $id="";
        ////ดึงผลการประเมินตนเอง ตัวบ่งชี้ที่ 1.1
        $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',6.1)
        ->where('pdca.target','!=',null)
        ->get();
        if(count($inc)==0){
            $inc="";
        }
        foreach($getcategorypdca as $value)
        {
            $name=$value['Indicator_name'];
            $id=$value['Indicator_id'];
        }
        $checkedit="";
        return view('category3/showpdca',compact('pdca','name','id','getcourse','getcategorypdca','inc','checkedit'));
           }
       
           if($id=="คุณภาพการสอน"){
                $teachqua=category4_teaching_quality::where('course_id',session()->get('usercourse'))
                ->where('year_id',session()->get('year_id'))
                ->get();
                $teachquagroup=category4_teaching_quality::groupBy('student_year')
                ->get();
                $checkedit="";
                return view('category4/teaching_quality',compact('teachqua','teachquagroup','checkedit'));
               }
               if($id=="ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา"){
                $factor=category3_GD::where('category_factor','ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา')
                ->where('course_id',session()->get('usercourse'))
                 ->where('year_id',session()->get('year_id'))
                ->get();
                $checkedit="";
                return view('category3/Impactfactors',compact('factor','checkedit'));
                   }

                   if($id=="ปัยจัยที่มีผลกระทบต่อการสำเร็จการศึกษา"){
                    $factor=category3_GD::where('category_factor','ปัยจัยที่มีผลกระทบต่อการสำเร็จการศึกษา')
                    ->where('course_id',session()->get('usercourse'))
                     ->where('year_id',session()->get('year_id'))
                     ->get();
                     $checkedit="";
                    return view('category3/Impactgraduation',compact('factor','checkedit'));
                       }

                       if($id=="สรุปการประเมินหลักสูตร"){
                        $assessmentsummary=category6_assessment_summary::where('course_id',session()->get('usercourse'))
                        ->where('category_assessor','การประเมินจากผู้ที่สำเร็จการศึกษา')
                        ->where('year_id',session()->get('year_id'))
                        ->get();
                        $assessmentsummary2=category6_assessment_summary::where('course_id',session()->get('usercourse'))
                            ->where('category_assessor','การประเมินจากผู้ที่มีส่วนเกี่ยวข้อง')
                            ->where('year_id',session()->get('year_id'))
                            ->get();
                        $checkedit="";
                        return view('category6/assessment_summary',compact('assessmentsummary','assessmentsummary2','checkedit'));
                           }
                               if($id=="สรุปผลรายวิชาที่เปิดสอน"){
                                $ccr=category4_course_results::where('course_id',session()->get('usercourse'))
                                ->where('year_id',session()->get('year_id'))
                                ->get();
                                $checkedit="";
                                    return view('category4/course_summary',compact('ccr','checkedit'));
                                   }
                                   if($id=="รายวิชาที่มีผลการเรียนที่ไม่ปกติ"){
                                    $academic=category4_academic_performance::where('course_id',session()->get('usercourse'))
                                    ->where('year_id',session()->get('year_id'))
                                    ->get();
                                    $checkedit="";
                                    return view('category4/academic_performance',compact('academic','checkedit'));
                                       }
                                       if($id=="รายวิชาที่ไม่ได้เปิดสอน"){
                                        $ccr=category4_notcourse_results::where('course_id',session()->get('usercourse'))
                                        ->where('year_id',session()->get('year_id'))
                                        ->get();
                                        $checkedit="";
                                        return view('category4/not_course_summary',compact('ccr','checkedit'));
                                           }
                                           if($id=="รายวิชาที่สอนเนื้อหาไม่ครบ"){
                                            $academic=category4_incomplete_content::where('course_id',session()->get('usercourse'))
                                            ->where('year_id',session()->get('year_id'))
                                            ->get();
                                            $checkedit="";
                                            return view('category4/incomplete_content',compact('academic','checkedit'));
                                               }
                                               if($id=="ประสิทธิผลของกลยุทธ์การสอน"){
                                                $effec=category4_effectiveness::where('course_id',session()->get('usercourse'))
                                                ->where('year_id',session()->get('year_id'))
                                                ->get();
                                                $checkedit="";
                                                return view('category4/effectiveness',compact('effec','checkedit'));
                                                   }
                                                   if($id=="การปฐมนิเทศอาจารย์ใหม่"){
                                                    $th=category4_newteacher::where('course_id',session()->get('usercourse'))
                                                    ->where('year_id',session()->get('year_id'))
                                                    ->get();
                                                    $checkpass=false;
                                                    foreach($th as $row){
                                                        if($row['point_out']==1){
                                                            $checkpass=true;
                                                        }
                                                    }
                                                    $checkedit="";
                                                    return view('category4/newteacher',compact('th','checkpass','checkedit'));
                                                       }
                                                       if($id=="กิจกรรมการพัฒนาวิชาชีพ"){
                                                        $activity=category4_activity::where('course_id',session()->get('usercourse'))
                                                        ->where('year_id',session()->get('year_id'))
                                                        ->get();
                                                        $checkedit="";
                                                        return view('category4/activity',compact('activity','checkedit'));
                                                           }
                                                           if($id=="การบริหารหลักสูตร"){
                                                            $coursemanage=category5_course_manage::where('course_id',session()->get('usercourse'))
                                                            ->where('year_id',session()->get('year_id'))
                                                            ->get();
                                                            $checkedit="";
                                                            return view('category5/course_administration',compact('coursemanage','checkedit'));
                                                               }
                                                               if($id=="ข้อคิดเห็น และข้อเสนอแนะ"){
                                                                $coursemanage=category6_comment_course::where('course_id',session()->get('usercourse'))
                                                                ->where('year_id',session()->get('year_id'))
                                                                ->get();
                                                                $checkedit="";
                                                                return view('category6/comment_course',compact('coursemanage','checkedit'));
                                                                   }
                                                                   if($id=="ความก้าวหน้าของการดำเนินงาน"){
                                                                    $querystrength=category7_strength::where('course_id',session()->get('usercourse'))
                                                                    ->where('year_id',session()->get('year_id'))
                                                                    ->get();
                                                                    $checkedit="";
                                                                    return view('category7/strength',compact('querystrength','checkedit'));
                                                                       }
                                                                       if($id=="ข้อเสนอในการพัฒนาหลักสูตร"){
                                                                        $querydevelopment_proposal=category7_development_proposal_detail::where('course_id',session()->get('usercourse'))
                                                                        ->where('year_id',session()->get('year_id'))
                                                                        ->get();
                                                                        $checkedit="";
                                                                        $year=session()->get('year');
                                                                        return view('category7/development_proposal',compact('querydevelopment_proposal','checkedit'));
                                                                           }
                                                                           if($id=="แผนปฏิบัติการใหม่"){
                                                                            $querynewstrength=category7_newstrength::where('course_id',session()->get('usercourse'))
                                                                            ->where('year_id',session()->get('year_id'))
                                                                            ->get();
                                                                            $checkedit="";
                                                                            return view('category7/newstrength',compact('querynewstrength','checkedit'));
                                                                               }
                                                                               if($id=="ข้อมูลนักศึกษา"){
                                                                                $get=year_acceptance::where('course_id',session()->get('usercourse'))
                                                                                ->get();
                                                                                $getinfo="";
                                                                                if($get!="[]"){
                                                                                    $getinfo=category3_infostudent::where('course_id',session()->get('usercourse'))
                                                                                    ->where('year_add', '>=',$get[0]['year_add'])
                                                                                    ->where('year_add', '<=',session()->get('year'))
                                                                                    ->where('reported_year', '>=',$get[0]['year_add'])
                                                                                    ->where('reported_year', '<=',session()->get('year'))
                                                                                    ->get();
                                                                                }
                                                                                if(count($get)==0){
                                                                                    $get="";
                                                                                }
                                                                                $checkedit="";
                                                                            $getqty=category3_infostudent_qty::where('course_id',session()->get('usercourse'))
                                                                            ->where('year_id',session()->get('year_id'))
                                                                            ->get();
                                                                            $countnumber=0;
                                                                            if($getinfo!=""){
                                                                                $countnumber=count($getinfo);
                                                                            }
                                                                            
                                                                            return view('category3/infostudents',compact('checkedit','get','getinfo','getqty','countnumber'));
                                                                                   }
                                                                                   if($id=="จุดแข็ง จุดที่ควรพัฒนา"){
                                                                                    $querynewstrength=composition::where('id','!=',1)
                                                                                    ->get();
                                                                                    $getnewstrength=category7_strengths_summary::where('course_id',session()->get('usercourse'))
                                                                                    ->where('year_id',session()->get('year_id'))
                                                                                    ->get();
                                                                                    $checkedit="";
                                                                                    return view('category7/strengths_summary',compact('querynewstrength','getnewstrength','checkedit'));
                                                                                       }
                                                                                       if($id=="จำนวนผู้สำเร็จการศึกษา"){
                                                                                        $get=year_acceptance_graduate::where('course_id',session()->get('usercourse'))
                                                                                        ->get();
                                                                                        $getinfo="";
                                                                                        $getinfo2="";
                                                                                        $gropby="";
                                                                                        if($get!='[]'){
                                                                                        $getinfo=category3_graduate::where('course_id',session()->get('usercourse'))
                                                                                        ->where('year_add', '>=',$get[0]['year_add'])
                                                                                        ->where('year_add', '<=',session()->get('year'))
                                                                                        ->where('reported_year', '>=',$get[0]['year_add'])
                                                                                        ->where('reported_year', '<=',session()->get('year'))
                                                                                        ->get();
                                                                                        $getinfo2=category3_infostudent::where('course_id',session()->get('usercourse'))
                                                                                        ->where('year_add', '>=',$get[0]['year_add'])
                                                                                        ->where('year_add', '<=',session()->get('year'))
                                                                                        ->where('reported_year', '>=',$get[0]['year_add'])
                                                                                        ->where('reported_year', '<=',session()->get('year'))
                                                                                        ->get();
                                                                                        $gropby=category3_graduate::where('course_id',session()->get('usercourse'))
                                                                                        ->where('year_add', '>=',$get[0]['year_add'])
                                                                                        ->where('year_add', '<=',session()->get('year'))
                                                                                        ->where('reported_year', '>=',$get[0]['year_add'])
                                                                                        ->where('reported_year', '<=',session()->get('year'))
                                                                                        ->groupBy('year_add')
                                                                                        ->get();
                                                                                             }
                                                                                             $checkedit="";
                                                                                        $getyear=category3_graduate::where('course_id',session()->get('usercourse'))
                                                                                        ->where('year_add',session()->get('year'))
                                                                                        ->get();
                                                                                        return view('category3/graduatesqty',compact('get','getinfo','getyear','getinfo2','gropby','checkedit'));
                                                                                           }
                                                                           if($id=="จำนวนการลาออกและคัดชื่อออก"){
                                                                            $get=year_acceptance_graduate::where('course_id',session()->get('usercourse'))
                                                                            ->get();
                                                                            $getinfo="";
                                                                            $getinfo2="";
                                                                            $gropby="";
                                                                            if($get!='[]'){
                                                                            $getinfo=category3_graduate::where('course_id',session()->get('usercourse'))
                                                                            ->where('year_add', '>=',$get[0]['year_add'])
                                                                            ->where('year_add', '<=',session()->get('year'))
                                                                            ->where('reported_year', '>=',$get[0]['year_add'])
                                                                            ->where('reported_year', '<=',session()->get('year'))
                                                                            ->get();
                                                                            
                                                                            $getinfo2=category3_infostudent::where('course_id',session()->get('usercourse'))
                                                                            ->where('year_add', '>=',$get[0]['year_add'])
                                                                            ->where('year_add', '<=',session()->get('year'))
                                                                            ->where('reported_year', '>=',$get[0]['year_add'])
                                                                            ->where('reported_year', '<=',session()->get('year'))
                                                                            ->get();
                                                                            $gropby=category3_graduate::where('course_id',session()->get('usercourse'))
                                                                            ->where('year_add', '>=',$get[0]['year_add'])
                                                                            ->where('year_add', '<=',session()->get('year'))
                                                                            ->where('reported_year', '>=',$get[0]['year_add'])
                                                                            ->where('reported_year', '<=',session()->get('year'))
                                                                            ->groupBy('year_add')
                                                                            ->get();
                                                                            }
                                                                            $getyear=category3_graduate::where('course_id',session()->get('usercourse'))
                                                                            ->where('year_add',session()->get('year'))
                                                                            ->get();
                                                                            $re=category3_resignation::where('course_id',session()->get('usercourse'))
                                                                            ->where('year_present',session()->get('year'))
                                                                            ->get();
                                                                            $checkedit="";
                                                                            return view('category3/resignation',compact('get','getinfo','getyear','getinfo2','gropby','re','checkedit'));
                                                                              }
        
                                                            
    }
}
