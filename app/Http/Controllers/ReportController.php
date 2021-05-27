<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\PDCA;
use App\defaulindicator;
use App\composition;
use App\indicator;
use App\category;
use App\publish_work;
use App\assessment_results;
use App\category6_comment_course;
use App\course_detail;
use App\category6_assessment_summary;
use App\category5_course_manage;
use App\indicator1_1;
use App\user_permission;
use App\indicator2_1;
use App\branch;
use App\category3_resignation;
use App\categoty_researh;
use App\ModelAJ\Research_results;
use App\Year;
use App\Tps;
use App\indicator4_3;
use App\indicator2_2;
use App\category3_infostudent;
use App\category3_infostudent_qty;
use App\year_acceptance;
use App\performance3_3;
use App\categorypdca;
use App\category3_GD;
use App\Menu;
use App\ModelAJ\category3_inforstudent;
use App\course_responsible_teacher;
use App\year_acceptance_graduate;
use App\category3_graduate;
use App\Educational_background;
use App\category4_course_results;
use App\category4_notcourse_results;
use App\in_index;
use App\indicator5_4;
use App\category4_teaching_quality;
use App\category4_effectiveness;
use App\category4_newteacher;
use App\category4_activity;
use App\category7_strength;
use App\category7_newstrength;
use App\category7_development_proposal_detail;
use App\category7_strengths_summary;
use App\DocPDCA;
use App\ModelAJ\category4_academic_performance;
use App\ModelAJ\category4_incomplete_content;
use App\Groupmenu;
use App\Course;
use Exception;
class ReportController extends Controller
{
    public function overview()
    {
        $query=assessment_results::leftjoin('category','assessment_results.category_id','=','category.category_id')
        ->where('assessment_results.year_id',session()->get('year_id'))
        ->get();
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
            return view('report/overview',compact('query'));
    }
    public function teacheroverview()
    {
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
        $query=assessment_results::leftjoin('category','assessment_results.category_id','=','category.category_id')
        ->where('assessment_results.year_id',session()->get('year_id'))
        ->get();
        
            return view('report/teacheroverview',compact('query'));
    }
    public function instructor()
    {
            $instructor= User::leftjoin('instructor','users.id','=','instructor.user_id')
            ->where('users.user_course',session()->get('usercourse'))
            ->where('users.user_branch',session()->get('branch_id'))
            ->where('instructor.year_id',1)
            ->get();
            return view('report/instructor',compact('instructor'));
    }
    public function performance_summary()
    {
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
        $getall=composition::all();
        $indicator=defaulindicator::where('Indicator_id','!=',null)
        ->get();
        $pdca=indicator::leftjoin('pdca','indicator.Indicator_id','=','pdca.indicator_id')
        ->where('indicator.course_id',session()->get('usercourse'))
        ->where('indicator.branch_id',session()->get('branch_id'))
        ->where('indicator.year_id',session()->get('year_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('target','!=',null)
        ->get();
        
        $per1="";
        foreach($pdca as $value)
        {
            $per1=$value['performance1'];
        }
            return view('report/newperformance_summary',compact('pdca','per1','getall','indicator'));
    }
    public function generateDocx()
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();


        $section = $phpWord->addSection();


        



        $section->addText($description);


        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path('helloWorld.docx'));
        } catch (Exception $e) {
        }


        return response()->download(storage_path('helloWorld.docx'));
    }
    public function download()
    {
        $query=assessment_results::leftjoin('category','assessment_results.category_id','=','category.category_id')
        ->where('assessment_results.year_id',session()->get('year_id'))
        ->where('assessment_results.course_id',session()->get('usercourse'))
        ->where('assessment_results.branch_id',session()->get('branch_id'))
        ->where('assessment_results.active',1)
        ->get();
            return view('report/download',compact('query'));
    }
    public function course_overview()
    {
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
        $getall=composition::all();
        $indicator=defaulindicator::where('Indicator_id','!=',null)
        ->get();
        $pdca=defaulindicator::leftjoin('pdca','defaulindicator.Indicator_id','=','pdca.indicator_id')
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('target','!=',null)
        ->get();
        $data[0]['cindiall']=0;
        foreach($getall as $key11=>$getallvalue){
                    $data[$key11]['cindi']=0;
            foreach($indicator as $getindi){
                if($getallvalue['id']==$getindi['composition_id']&&$getindi['Indicator_id']!=1.1){
                    $data[$key11]['cindi']++;
                    $data[0]['cindiall']++;
                }
            }
        }
        
        $per1="";
        $result1_1=0;
        $result2_1=0;
        $result2_2=0;
        $result3_1=0;
        $result3_2=0;
        $result3_3=0;
        $result4_1=0;
        $result4_2=0;
        $result4_3=0;
        $result5_1=0;
        $result5_2=0;
        $result5_3=0;
        $result5_4=0;
        $result6_1=0;
        foreach($pdca as $row){
            if($row['Indicator_id']==1.1){
                    if($row['score']=="ผ่านมาตรฐาน"&&$row['performance3']=="ผ่านมาตรฐาน"&&$row['target']=="ผ่านมาตรฐาน"){
                        $result1_1="ผ่านการประเมิน";
                    }
                    else{
                        $result1_1="ไม่ผ่านการประเมิน";
                    }
            }
            else if($row['Indicator_id']==2.1){
                $result2_1=$row['performance3'];
            }
            else if($row['Indicator_id']==2.2){
                $result2_2=$row['performance3']/20;
            }
            else if($row['Indicator_id']==3.1){
                $result3_1=$row['performance3'];
            }
            else if($row['Indicator_id']==3.2){
                $result3_2=$row['performance3'];
            }
            else if($row['Indicator_id']==3.3){
                $result3_3=$row['performance3'];
            }
            else if($row['Indicator_id']==4.1){
                $result4_1=$row['performance3'];
            }
            else if($row['Indicator_id']==4.2){
                $result4_2=$row['performance3'];
            }
            else if($row['Indicator_id']==4.3){
                $result4_3=$row['performance3'];
            }
            else if($row['Indicator_id']==5.1){
                $result5_1=$row['performance3'];
            }
            else if($row['Indicator_id']==5.2){
                $result5_2=$row['performance3'];
            }
            else if($row['Indicator_id']==5.3){
                $result5_3=$row['performance3'];
            }
            else if($row['Indicator_id']==5.4){
                $result5_4=$row['performance3'];
            }
            else if($row['Indicator_id']==6.1){
                $result6_1=$row['performance3'];
            }
        }
        $data[0]['o']=$result1_1;
        $data[1]['o']=sprintf('%.2f',($result2_1+$result2_2)/$data[1]['cindi']);
        $data[1]['counto']=2; 
        $data[1]['avr']=sprintf('%.2f',($result2_1+$result2_2)/$data[1]['cindi']);
        $data[2]['i']=sprintf('%.2f',($result3_1+$result3_2+$result3_3)/$data[2]['cindi']); 
        $data[2]['counti']=3;      
        $data[2]['avr']=sprintf('%.2f',($result3_1+$result3_2+$result3_3)/$data[2]['cindi']);       
        $data[3]['i']=sprintf('%.2f',($result4_2+$result4_1+$result4_3)/$data[3]['cindi']);
        $data[3]['counti']=3;
        $data[3]['avr']=sprintf('%.2f',($result4_2+$result4_1+$result4_3)/$data[3]['cindi']);
        $data[4]['i']=sprintf('%.2f',$result5_1);
        $data[4]['counti']=1;
        $data[4]['p']=sprintf('%.2f',($result5_4+$result5_2+$result5_3)/($data[4]['cindi']-1));
        $data[4]['countp']=3; 
        $data[4]['avr']=sprintf('%.2f',($result5_1+$result5_2+$result5_3+$result5_4)/$data[4]['cindi']);
        $data[5]['p']=sprintf('%.2f',$result6_1);
        $data[5]['countp']=1;
        $data[5]['avr']=sprintf('%.2f',$result6_1);

        $data[0]['resultipo1']=sprintf('%.2f',($result3_1+$result3_2+$result3_3+$result4_2+$result4_1+$result4_3+$result5_1)/7);
        $data[0]['resultipo2']=sprintf('%.2f',($result5_4+$result5_2+$result5_3+$result6_1)/4);
        $data[0]['resultipo3']=sprintf('%.2f',($result2_1+$result2_2)/2);
        $data[0]['resultindicatori']=$data[2]['counti']+$data[3]['counti']+$data[4]['counti'];
        $data[0]['resultindicatorp']=$data[4]['countp']+$data[5]['countp'];
        $data[0]['resultindicatoro']=$data[1]['counto'];
        $data[0]['avgall']=sprintf('%.2f',($data[1]['avr']+$data[2]['avr']+$data[3]['avr']+$data[4]['avr']+$data[5]['avr'])/5);
        $data[0]['resultavg']="";
        if($data[0]['avgall']>=0.01&&$data[0]['avgall']<=2.00){
            $data[0]['resultavg']="น้อย";
        }
        else if($data[0]['avgall']>=2.01&&$data[0]['avgall']<=3.00){
            $data[0]['resultavg']="ปานกลาง";
        }
        else if($data[0]['avgall']>=3.01&&$data[0]['avgall']<=4.00){
            $data[0]['resultavg']="ดี";
        }
        else if($data[0]['avgall']>=4.01&&$data[0]['avgall']<=5.00){
            $data[0]['resultavg']="ดีมาก";
        }

        for($i = 1; $i <= 5; $i++){
            if($data[$i]['avr']>=0.01&&$data[$i]['avr']<=2.00){
                $data[$i]['result']="น้อย";
            }
            else if($data[$i]['avr']>=2.01&&$data[$i]['avr']<=3.00){
                $data[$i]['result']="ปานกลาง";
            }
            else if($data[$i]['avr']>=3.01&&$data[$i]['avr']<=4.00){
                $data[$i]['result']="ดี";
            }
            else if($data[$i]['avr']>=4.01&&$data[$i]['avr']<=5.00){
                $data[$i]['result']="ดีมาก";
            }
        }
        foreach($pdca as $value)
        {
            $per1=$value['performance1'];
        }
            return view('report/newcourse_overview',compact('pdca','per1','getall','indicator','data'));
    }
    public function showcategory($id)
    {
        $query=assessment_results::leftjoin('category','assessment_results.category_id','=','category.category_id')
        ->where('assessment_results.year_id',session()->get('year_id'))
        ->get();
        if($id==1){
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
        ->where('course_responsible_teacher.branch_id',session()->get('branch_id'))
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
        ->where('users.user_branch',session()->get('branch_id'))
        ->where('course_responsible_teacher.year_id',session()->get('year_id'))
        ->get();

        ////ดึงสาขาวิชาที่จบของอาจารย์ผู้รับผิดชอบหลักสูตร
        $educ_bg= User::leftjoin('course_responsible_teacher','users.id','=','course_responsible_teacher.user_id')
        ->where('users.user_course',session()->get('usercourse'))
        ->where('users.user_branch',session()->get('branch_id'))
        ->where('course_responsible_teacher.year_id',session()->get('year_id'))
        ->get();

         ////ดึงสาขาวิชาที่จบของอาจารย์ประจำหลักสูตร
         $tc_course= User::leftjoin('course_teacher','users.id','=','course_teacher.user_id')
         ->where('users.user_course',session()->get('usercourse'))
         ->where('users.user_branch',session()->get('branch_id'))
         ->where('course_teacher.year_id',session()->get('year_id'))
         ->get();

         ////ดึงสาขาวิชาที่จบของอาจารย์ผู้สอน
         $instructor= User::leftjoin('instructor','users.id','=','instructor.user_id')
         ->where('users.user_course',session()->get('usercourse'))
         ->where('users.user_branch',session()->get('branch_id'))
         ->where('instructor.year_id',session()->get('year_id'))
         ->get();
         ////ดึงสาขาวิชาที่จบของอาจารย์ผู้สอนพิเศษ
         $specialinstructor= User::leftjoin('special_teacher','users.id','=','special_teacher.user_id')
         ->where('users.user_course',session()->get('usercourse'))
         ->where('users.user_branch',session()->get('branch_id'))
         ->where('special_teacher.year_id',session()->get('year_id'))
         ->get();
        
         ////ดึงผลการประเมินตนเอง ตัวบ่งชี้ที่ 1.1
        $inc= Tps::leftjoin('indicator','tps.indicator_id','=','indicator.indicator_id')
        ->where('tps.course_id',session()->get('usercourse'))
        ->where('tps.year_id',session()->get('year_id'))
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

        $getresult=indicator1_1::where('year_id',session()->get('year_id'))
        ->where('branch_id',session()->get('branch_id'))
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
         $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',1.1)
        ->get();
         $getcategorypdca=defaulindicator::where('id',1)
        ->get();
        $name="";
        $id="";
        $checkedit="";
        foreach($getcategorypdca as $value)
        {
            $name=$value['Indicator_name'];
            $id=$value['Indicator_id'];
        }
        $user=auth()->user();
        $user_branch=branch::where('branch_id',$user->user_branch)->get();
        $getpermiss=indicator::where('active',1)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $check1_1=0;
        foreach($getpermiss as $checkper){
            if($checkper['Indicator_id']==1.1){
                $check1_1=1;
            }
        }
        $course_detail = course_detail::where('course_id',session()->get('usercourse'))
        ->orderBy('academic_position','asc')
        ->get();
        $getbranch=branch::where('branch_id',session()->get('branch_id'))
        ->get();
        return view('category/category1',compact('getbranch','c','count','nameteacher'
        ,'educ_bg','y','checkpass','checknotpass','tc_course','instructor','specialinstructor'
        ,'inc','course','result1','result2','result3','result4','result5','result6','result7'
        ,'result8','result9','result10','id','name','checkedit','inc','user_branch','check1_1','course_detail'));
        }
        else if($id==2){

        $getcategorypdca=indicator::where('Indicator_id',4.1)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $pdca=PDCA::leftjoin('indicator','pdca.Indicator_id','=','indicator.indicator_id')
        ->where('pdca.Indicator_id',4.1)
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->get();
        $getcourse=Course::where('course_id',session()->get('usercourse'))
        ->get();
        $name="";
        $id="";
        ////ดึงผลการประเมินตนเอง ตัวบ่งชี้ที่ 1.1
        $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
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

        //////ตัวบ่งชี้ 4.2
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
        $category_re = publish_work::rightjoin('course_responsible_teacher','publish_work.owner','=','course_responsible_teacher.user_id')
        ->leftjoin('category_research_results','publish_work.category_publish_work','=','category_research_results.id')
        ->where('course_responsible_teacher.year_id',session()->get('year_id'))
        ->where('course_responsible_teacher.course_id',session()->get('usercourse'))
        ->where('course_responsible_teacher.branch_id',session()->get('branch_id'))
        ->where('publish_work.publish_work_yearanddate','>=',session()->get('yearBegin'))
        ->where('publish_work.publish_work_yearanddate','<=',session()->get('yearEnd'))
        ->orderBy('category_research_results.score','desc')
        ->get();
    //    dd($category_re);
        //ดึงค่าตารางอาจารย์ผู้รับผิดชอบหลักสูตร
        $trc = course_responsible_teacher::join('year','course_responsible_teacher.year_id','=','year.year_id')
        ->where('course_responsible_teacher.course_id',session()->get('usercourse'))
        ->where('course_responsible_teacher.branch_id',session()->get('branch_id'))
        ->where('course_responsible_teacher.year_id',session()->get('year_id'))
        ->get();
        ///นับอาจารย์ผู้รีบผิดชอบหลักสูตร
        $count=count($trc);
        
        $educ_bg= User::leftjoin('course_responsible_teacher','users.id','=','course_responsible_teacher.user_id')
        ->where('users.user_course',session()->get('usercourse'))
        ->where('users.user_branch',session()->get('branch_id'))
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
            else if($value['academic_position']=='รองศาสตราจารย์')
            {
                $countposition2=$countposition2+1;
            }
            else if($value['academic_position']=='ศาสตราจารย์'){
                $countposition3=$countposition3+1;
            }
        }
        $countcate=0;
        foreach($category_re as $value){
                $countcate=$countcate+$value['score']; 
        }

        $inc4_2=PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
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
        $getcategorypdca2=defaulindicator::where('id',9)
        ->get();
        $name4_2="";
        $id4_2="";
        foreach($getcategorypdca2 as $value)
        {
            $name4_2=$value['Indicator_name'];
            $id4_2=$value['Indicator_id'];
        }
        /////ตัวบ่งชี้ที่ 4.3
        $in4_3=indicator4_3::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $inc3= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',4.3)
        ->where('pdca.target','!=',null)
        ->get();
        
        $getcategorypdca4_3=defaulindicator::where('id',10)
        ->get();
        $name4_3="";
        $id4_3="";
        foreach($getcategorypdca4_3 as $value)
        {
            $name4_3=$value['Indicator_name'];
            $id4_3=$value['Indicator_id'];
        }
        
        ////4.3
        $getpermiss=indicator::where('active',1)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $check4_1=0;
        $check4_2=0;
        $check4_3=0;
        foreach($getpermiss as $checkper){
            if($checkper['Indicator_id']==4.1){
                $check4_1=1;
            }
            else if($checkper['Indicator_id']==4.2){
                $check4_2=1;
            }
            else if($checkper['Indicator_id']==4.3){
                $check4_3=1;
            }
        }
        $getbranch=branch::where('branch_id',session()->get('branch_id'))
        ->get();
        $tran=User::rightjoin('course_responsible_teacher','users.id','=','course_responsible_teacher.user_id')
            ->where('users.user_course',session()->get('usercourse'))
            ->where('users.user_branch',session()->get('branch_id'))
            ->where('course_responsible_teacher.year_id',session()->get('year_id'))
            ->get();
        return view('category3/category2',compact('tran','getbranch','check4_1','check4_2','check4_3','pdca','name','id','getcourse','getcategorypdca','inc','checkedit','category_re','count','counteb_name','countposition1','countposition2','countposition3'
                    ,'cate','qty1','B','qty2','C','qty3','E','inc4_2','id4_2','name4_2','in4_3','inc3','name4_3','id4_3','getcategorypdca4_3'));
        }
        else if($id==3){
            $get=year_acceptance::where('course_id',session()->get('usercourse'))
            ->get();
                    $getinfo="";
                    if($get!="[]"){
                        $getinfo=category3_infostudent::where('course_id',session()->get('usercourse'))
                        ->where('branch_id',session()->get('branch_id'))
                        ->where('year_add', '>=',$get[0]['year_add'])
                        ->where('year_add', '<=',session()->get('year'))
                        ->where('reported_year', '>=',$get[0]['year_add'])
                        ->where('reported_year', '<=',session()->get('year'))
                        ->get();
                    }
                    if(count($get)==0){
                        $get="";
                    }
                    $checkinfo=category3_infostudent::where('course_id',session()->get('usercourse'))
                    ->where('branch_id',session()->get('branch_id'))
                    ->where('year_add',session()->get('year'))
                    ->get();
                $getqty=category3_infostudent_qty::where('course_id',session()->get('usercourse'))
                ->where('branch_id',session()->get('branch_id'))
                ->where('year_id',session()->get('year_id'))
                ->get();
                $countnumber=0;
                if($getinfo!=""){
                $countnumber=count($getinfo);
                }
                $checkedit="";


        $get2=year_acceptance_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->get();
        $getinfo1="";
        $getinfo2="";
        $gropby="";
        if($get2!='[]'){
        $getinfo1=category3_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_add', '>=',$get[0]['year_add'])
        ->where('year_add', '<=',session()->get('year'))
        ->where('reported_year', '>=',$get[0]['year_add'])
        ->where('reported_year', '<=',session()->get('year'))
        ->get();
        $getinfo2=category3_infostudent::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_add', '>=',$get[0]['year_add'])
        ->where('year_add', '<=',session()->get('year'))
        ->where('reported_year', '>=',$get[0]['year_add'])
        ->where('reported_year', '<=',session()->get('year'))
        ->get();
        $gropby=category3_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_add', '>=',$get[0]['year_add'])
        ->where('year_add', '<=',session()->get('year'))
        ->where('reported_year', '>=',$get[0]['year_add'])
        ->where('reported_year', '<=',session()->get('year'))
        ->groupBy('year_add')
        ->get();
             }
             $checkinfo2=category3_graduate::where('course_id',session()->get('usercourse'))
                    ->where('branch_id',session()->get('branch_id'))
                    ->where('year_add',session()->get('year'))
                    ->get();
             $getyear=category3_graduate::where('course_id',session()->get('usercourse'))
             ->where('branch_id',session()->get('branch_id'))
        ->where('year_add',session()->get('year'))
        ->get();
        if(count($get2)==0){
            $get2="";
        }
        $factor=category3_GD::where('category_factor','ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา')
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
        ->get();
        $factor2=category3_GD::where('category_factor','ปัยจัยที่มีผลกระทบต่อการสำเร็จการศึกษา')
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
        ->get();
        

        $factor3=indicator2_1::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
         $pdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',2.1)
        ->where('pdca.target','!=',null)
        ->get();
        $per1="ssssss";
        $getcategorypdca=defaulindicator::where('id',2)
        ->get();
        $name="";
        $id="";
        foreach($getcategorypdca as $value)
        {
            $name=$value['Indicator_name'];
            $id=$value['Indicator_id'];
        }

        $factor4=indicator2_2::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
         $pdca2= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',2.2)
        ->where('pdca.target','!=',null)
        ->get();

        $getcategorypdca3_1=indicator::where('Indicator_id',3.1)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $pdca3_1=PDCA::leftjoin('indicator','pdca.Indicator_id','=','indicator.indicator_id')
        ->where('pdca.Indicator_id',3.1)
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->get();
        $getcourse3_1=Course::where('course_id',session()->get('usercourse'))
        ->get();
        $name3_1="";
        $id3_1="";
        ////ดึงผลการประเมินตนเอง ตัวบ่งชี้ที่ 1.1
        $inc3_1= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',3.1)
        ->where('pdca.target','!=',null)
        ->get();
        if(count($inc3_1)==0){
            $inc3_1="";
        }
        foreach($getcategorypdca3_1 as $value)
        {
            $name3_1=$value['Indicator_name'];
            $id3_1=$value['Indicator_id'];
        }

        $getcategorypdca3_2=indicator::where('Indicator_id',3.2)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $pdca3_2=PDCA::leftjoin('indicator','pdca.Indicator_id','=','indicator.indicator_id')
        ->where('pdca.Indicator_id',3.2)
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->get();
        $getcourse3_2=Course::where('course_id',session()->get('usercourse'))
        ->get();
        $name3_2="";
        $id3_2="";
        ////ดึงผลการประเมินตนเอง ตัวบ่งชี้ที่ 1.1
        $inc3_2= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',3.2)
        ->where('pdca.target','!=',null)
        ->get();
        if(count($inc3_2)==0){
            $inc3_2="";
        }
        foreach($getcategorypdca3_2 as $value)
        {
            $name3_2=$value['Indicator_name'];
            $id3_2=$value['Indicator_id'];
        }


        $get5=year_acceptance_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->get();
        $getinfo5="";
        $getinfo6="";
        $gropby5="";
        if($get5!='[]'){
        $getinfo5=category3_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_add', '>=',$get[0]['year_add'])
        ->where('year_add', '<=',session()->get('year'))
        ->where('reported_year', '>=',$get[0]['year_add'])
        ->where('reported_year', '<=',session()->get('year'))
        ->get();
        
        $getinfo6=category3_infostudent::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_add', '>=',$get[0]['year_add'])
        ->where('year_add', '<=',session()->get('year'))
        ->where('reported_year', '>=',$get[0]['year_add'])
        ->where('reported_year', '<=',session()->get('year'))
        ->get();
        $gropby5=category3_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_add', '>=',$get[0]['year_add'])
        ->where('year_add', '<=',session()->get('year'))
        ->where('reported_year', '>=',$get[0]['year_add'])
        ->where('reported_year', '<=',session()->get('year'))
        ->groupBy('year_add')
        ->get();
        }
        $getyear5=category3_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_add',session()->get('year'))
        ->get();
        $re5=category3_resignation::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_present',session()->get('year'))
        ->get();
        $in3_3=performance3_3::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $inc3_3= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',3.3)
        ->where('pdca.target','!=',null)
        ->get();
        $getcategorypdca3_3=defaulindicator::where('id',7)
        ->get();
        $name3_3="";
        $id3_3="";
        foreach($getcategorypdca3_3 as $value)
        {
            $name3_3=$value['Indicator_name'];
            $id3_3=$value['Indicator_id'];
        }
        $getpermiss=indicator::where('active',1)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $check2_1=0;
        $check2_2=0;
        $check3_1=0;
        $check3_2=0;
        $check3_3=0;
        $checkfoctor1=0;
        $checkfoctor2=0;
        $checkinfostd=0;
        $checkgdqty=0;
        $checkres=0;
        foreach($getpermiss as $checkper){
            if($checkper['Indicator_id']==2.1){
                $check2_1=1;
            }
            else if($checkper['Indicator_id']==2.2){
                $check2_2=1;
            }
            else if($checkper['Indicator_id']==3.1){
                $check3_1=1;
            }
            if($checkper['Indicator_id']==3.2){
                $check3_2=1;
            }
            else if($checkper['Indicator_id']==3.3){
                $check3_3=1;
            }
            else if($checkper['Indicator_name']=="ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา"){
                $checkfoctor1=1;
            }
            if($checkper['Indicator_name']=="ปัยจัยที่มีผลกระทบต่อการสำเร็จการศึกษา"){
                $checkfoctor2=1;
            }
            else if($checkper['Indicator_name']=="ข้อมูลนักศึกษา"){
                $checkinfostd=1;
            }
            else if($checkper['Indicator_name']=="จำนวนผู้สำเร็จการศึกษา"){
                $checkgdqty=1;
            }
            else if($checkper['Indicator_name']=="จำนวนการลาออกและคัดชื่อออก"){
                $checkres=1;
            }
        }
        $getbranch=branch::where('branch_id',session()->get('branch_id'))
        ->get();
            return view('showcategory/category3',compact('checkinfo','checkinfo2','getbranch','get','getinfo','getqty','countnumber'
            ,'checkedit','get2','getinfo1','getyear','getinfo2','gropby','factor','factor2',
            'factor3','pdca','per1','name','id','factor4','pdca2','pdca3_1','name3_1',
            'id3_1','getcourse3_1','getcategorypdca3_1','inc3_1','pdca3_2','name3_2',
            'id3_2','getcourse3_2','getcategorypdca3_2','inc3_2',
            'get5','getinfo5','getyear5','getinfo6','gropby5','re5','in3_3','inc3_3','name3_3','id3_3',
            'check2_1','check2_2','check3_1','check3_2','check3_3','checkfoctor1','checkfoctor2','checkinfostd','checkgdqty','checkres'
            ));
        }
        else if($id==4){
            $ccr=category4_course_results::where('course_id',session()->get('usercourse'))
            ->where('branch_id',session()->get('branch_id'))
            ->where('year_id',session()->get('year_id'))
            ->get();
            $checkedit="";
            $ccr2=category4_notcourse_results::where('course_id',session()->get('usercourse'))
            ->where('branch_id',session()->get('branch_id'))
            ->where('year_id',session()->get('year_id'))
            ->get();
        $getcategorypdca5_1=indicator::where('Indicator_id',5.1)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $pdca5_1=PDCA::leftjoin('indicator','pdca.Indicator_id','=','indicator.indicator_id')
        ->where('pdca.Indicator_id',5.1)
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->get();
        $getcourse5_1=Course::where('course_id',session()->get('usercourse'))
        ->get();
        $name5_1="";
        $id5_1="";
        ////ดึงผลการประเมินตนเอง ตัวบ่งชี้ที่ 1.1
        $inc5_1= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',5.1)
        ->where('pdca.target','!=',null)
        ->get();
        if(count($inc5_1)==0){
            $inc5_1="";
        }
        foreach($getcategorypdca5_1 as $value)
        {
            $name5_1=$value['Indicator_name'];
            $id5_1=$value['Indicator_id'];
        }

        $getcategorypdca5_2=indicator::where('Indicator_id',5.2)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $pdca5_2=PDCA::leftjoin('indicator','pdca.Indicator_id','=','indicator.indicator_id')
        ->where('pdca.Indicator_id',5.2)
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->get();
        $getcourse5_2=Course::where('course_id',session()->get('usercourse'))
        ->get();
        $name5_2="";
        $id5_2="";
        ////ดึงผลการประเมินตนเอง ตัวบ่งชี้ที่ 1.1
        $inc5_2= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',5.2)
        ->where('pdca.target','!=',null)
        ->get();
        if(count($inc5_2)==0){
            $inc5_2="";
        }
        foreach($getcategorypdca5_2 as $value)
        {
            $name5_2=$value['Indicator_name'];
            $id5_2=$value['Indicator_id'];
        }

        $getcategorypdca5_3=indicator::where('Indicator_id',5.3)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $pdca5_3=PDCA::leftjoin('indicator','pdca.Indicator_id','=','indicator.indicator_id')
        ->where('pdca.Indicator_id',5.3)
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->get();
        $getcourse5_3=Course::where('course_id',session()->get('usercourse'))
        ->get();
        $name5_3="";
        $id5_3="";
        ////ดึงผลการประเมินตนเอง ตัวบ่งชี้ที่ 1.1
        $inc5_3= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',5.3)
        ->where('pdca.target','!=',null)
        ->get();
        if(count($inc5_3)==0){
            $inc5_3="";
        }
        foreach($getcategorypdca5_3 as $value)
        {
            $name5_3=$value['Indicator_name'];
            $id5_3=$value['Indicator_id'];
        }


        $indi=in_index::all();
        $perfor=indicator5_4::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $inc5_4= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
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
          $getcategorypdca5_4=defaulindicator::where('id',14)
          ->get();
          $name5_4="";
          $id5_4="";
          foreach($getcategorypdca5_4 as $value)
          {
              $name5_4=$value['Indicator_name'];
              $id5_4=$value['Indicator_id'];
          }
        session()->put('resultavg',$resultavg2);   
        

        $academic=category4_academic_performance::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();

        $academic2=category4_incomplete_content::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $teachqua=category4_teaching_quality::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
       ->where('year_id',session()->get('year_id'))
       ->get();
       $teachquagroup=category4_teaching_quality::groupBy('student_year')
       ->get();

       $effec=category4_effectiveness::where('course_id',session()->get('usercourse'))
       ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $th=category4_newteacher::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $checkpass=false;
        foreach($th as $row){
            if($row['point_out']==1){
                $checkpass=true;
            }
        }

        $activity=category4_activity::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();

        $getpermiss=indicator::where('active',1)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $check5_1=0;
        $check5_2=0;
        $check5_3=0;
        $check5_4=0;
        $check1=0;
        $check2=0;
        $check3=0;
        $check4=0;
        $check5=0;
        $check6=0;
        $check7=0;
        $check8=0;
        foreach($getpermiss as $checkper){
            if($checkper['Indicator_id']==5.1){
                $check5_1=1;
            }
            else if($checkper['Indicator_id']==5.2){
                $check5_2=1;
            }
            else if($checkper['Indicator_id']==5.3){
                $check5_3=1;
            }
            if($checkper['Indicator_id']==5.4){
                $check5_4=1;
            }
            else if($checkper['Indicator_name']=="คุณภาพการสอน"){
                $check1=1;
            }
            else if($checkper['Indicator_name']=="สรุปผลรายวิชาที่เปิดสอน"){
                $check2=1;
            }
            if($checkper['Indicator_name']=="รายวิชาที่มีผลการเรียนที่ไม่ปกติ"){
                $check3=1;
            }
            else if($checkper['Indicator_name']=="รายวิชาที่ไม่ได้เปิดสอน"){
                $check4=1;
            }
            else if($checkper['Indicator_name']=="รายวิชาที่สอนเนื้อหาไม่ครบ"){
                $check5=1;
            }
            else if($checkper['Indicator_name']=="ประสิทธิผลของกลยุทธ์การสอน"){
                $check6=1;
            }
            else if($checkper['Indicator_name']=="การปฐมนิเทศอาจารย์ใหม่"){
                $check7=1;
            }
            else if($checkper['Indicator_name']=="กิจกรรมการพัฒนาวิชาชีพ"){
                $check8=1;
            }
        }
        $getbranch=branch::where('branch_id',session()->get('branch_id'))
        ->get();
            return view('showcategory/category4',compact('getbranch','ccr','ccr2','checkedit','pdca5_1','name5_1',
            'id5_1','getcourse5_1','getcategorypdca5_1','inc5_1','pdca5_2','name5_2','id5_2','getcourse5_2',
            'getcategorypdca5_2','inc5_2','pdca5_3','name5_3','id5_3','getcourse5_3','getcategorypdca5_3','inc5_3'
         ,'indi','id5_4','name5_4','perfor','result','resultpass1_5','resultpass1_5persen','resultpassall','inc5_4',
         'per1','academic','academic2','teachqua','teachquagroup','effec','th','checkpass','activity',
        'check5_1','check5_2','check5_3','check5_4','check1','check2','check3','check4','check5','check6','check7','check8',));
        }
        else if($id==5){
            $coursemanage=category5_course_manage::where('course_id',session()->get('usercourse'))
            ->where('branch_id',session()->get('branch_id'))
            ->where('year_id',session()->get('year_id'))
            ->get();
            $checkedit="";

            $getcategorypdca=indicator::where('Indicator_id',6.1)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $pdca=PDCA::leftjoin('indicator','pdca.Indicator_id','=','indicator.indicator_id')
        ->where('pdca.Indicator_id',6.1)
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->get();
        $getcourse=Course::where('course_id',session()->get('usercourse'))
        ->get();
        $name="";
        $id="";
        ////ดึงผลการประเมินตนเอง ตัวบ่งชี้ที่ 1.1
        $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
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
        $getpermiss=indicator::where('active',1)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $check6_1=0;
        $check1=0;
        foreach($getpermiss as $checkper){
            if($checkper['Indicator_id']==6.1){
                $check6_1=1;
            }
            else if($checkper['Indicator_name']=="การบริหารหลักสูตร"){
                $check1=1;
            }
            }
            $getbranch=branch::where('branch_id',session()->get('branch_id'))
        ->get();
            return view('showcategory/category5',compact('getbranch','coursemanage','checkedit','pdca','name','id'
            ,'getcourse','getcategorypdca','inc','check6_1','check1'));
        }
        else if($id==6){
            $coursemanage=category6_comment_course::where('course_id',session()->get('usercourse'))
            ->where('branch_id',session()->get('branch_id'))
            ->where('year_id',session()->get('year_id'))
            ->get();
            $checkedit="";
            $assessmentsummary=category6_assessment_summary::where('course_id',session()->get('usercourse'))
            ->where('branch_id',session()->get('branch_id'))
            ->where('category_assessor',"การประเมินจากผู้ที่สำเร็จการศึกษา")
            ->where('year_id',session()->get('year_id'))
            ->get();
            $assessmentsummary2=category6_assessment_summary::where('course_id',session()->get('usercourse'))
            ->where('branch_id',session()->get('branch_id'))
            ->where('category_assessor',"การประเมินจากผู้ที่มีส่วนเกี่ยวข้อง")
            ->where('year_id',session()->get('year_id'))
            ->get();
            $getpermiss=indicator::where('active',1)
            ->where('course_id',session()->get('usercourse'))
            ->where('branch_id',session()->get('branch_id'))
            ->where('year_id',session()->get('year_id'))
            ->get();
            $check1=0;
            $check2=0;
            foreach($getpermiss as $checkper){
                if($checkper['Indicator_name']=="สรุปการประเมินหลักสูตร"){
                    $check1=1;
                }
                else if($checkper['Indicator_name']=="ข้อคิดเห็น และข้อเสนอแนะ"){
                    $check2=1;
                }
                }
            return view('showcategory/category6',compact('coursemanage','checkedit','assessmentsummary'
            ,'assessmentsummary2','check1','check2'));
        }
        else if($id==7){
            $querystrength=category7_strength::where('course_id',session()->get('usercourse'))
            ->where('branch_id',session()->get('branch_id'))
          ->where('year_id',session()->get('year_id'))
         ->get();
         $checkedit="";

         $querydevelopment_proposal=category7_development_proposal_detail::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
         $year=session()->get('year');
         $querynewstrength=category7_newstrength::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $getpermiss=indicator::where('active',1)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $check1=0;
        $check2=0;
        $check3=0;
        foreach($getpermiss as $checkper){
                if($checkper['Indicator_name']=="ความก้าวหน้าของการดำเนินงาน"){
                    $check1=1;
                }
                else if($checkper['Indicator_name']=="ข้อเสนอในการพัฒนาหลักสูตร"){
                    $check2=1;
                }
                else if($checkper['Indicator_name']=="แผนปฏิบัติการใหม่"){
                    $check3=1;
                }
        }
            return view('showcategory/category7',compact('querystrength','checkedit','querydevelopment_proposal'
            ,'querynewstrength','check1','check2','check3'));
        }
        else if($id==8){
            $getall=composition::all();
            $indicator=defaulindicator::where('Indicator_id','!=',null)
            ->get();
            $pdca=indicator::leftjoin('pdca','indicator.Indicator_id','=','pdca.indicator_id')
            ->where('indicator.course_id',session()->get('usercourse'))
            ->where('indicator.branch_id',session()->get('branch_id'))
            ->where('indicator.year_id',session()->get('year_id'))
            ->where('pdca.year_id',session()->get('year_id'))
            ->where('pdca.course_id',session()->get('usercourse'))
            ->where('pdca.branch_id',session()->get('branch_id'))
            ->where('target','!=',null)
            ->get();
    
            $per1="";
            foreach($pdca as $value)
            {
                $per1=$value['performance1'];
            }

        $getall2=composition::all();
        $indicator2=defaulindicator::where('Indicator_id','!=',null)
        ->get();
        $pdca2=defaulindicator::leftjoin('pdca','defaulindicator.Indicator_id','=','pdca.indicator_id')
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('target','!=',null)
        ->get();
        $data[0]['cindiall']=0;
        foreach($getall2 as $key11=>$getallvalue){
                    $data[$key11]['cindi']=0;
            foreach($indicator as $getindi){
                if($getallvalue['id']==$getindi['composition_id']&&$getindi['Indicator_id']!=1.1){
                    $data[$key11]['cindi']++;
                    $data[0]['cindiall']++;
                }
            }
        }
        $per1="";
        $per2="";
        $result1_1=0;
        $result2_1=0;
        $result2_2=0;
        $result3_1=0;
        $result3_2=0;
        $result3_3=0;
        $result4_1=0;
        $result4_2=0;
        $result4_3=0;
        $result5_1=0;
        $result5_2=0;
        $result5_3=0;
        $result5_4=0;
        $result6_1=0;
        foreach($pdca2 as $row){
            if($row['Indicator_id']==1.1){
                    if($row['score']=="ผ่านมาตรฐาน"){
                        $result1_1="ผ่านการประเมิน";
                    }
                    else{
                        $result1_1="ไม่ผ่านการประเมิน";
                    }
            }
            else if($row['Indicator_id']==2.1){
                $result2_1=$row['score'];
            }
            else if($row['Indicator_id']==2.2){
                $result2_2=$row['score'];
            }
            else if($row['Indicator_id']==3.1){
                $result3_1=$row['performance3'];
            }
            else if($row['Indicator_id']==3.2){
                $result3_2=$row['performance3'];
            }
            else if($row['Indicator_id']==3.3){
                $result3_3=$row['score'];
            }
            else if($row['Indicator_id']==4.1){
                $result4_1=$row['performance3'];
            }
            else if($row['Indicator_id']==4.2){
                $result4_2=$row['target'];
            }
            else if($row['Indicator_id']==4.3){
                $result4_3=$row['score'];
            }
            else if($row['Indicator_id']==5.1){
                $result5_1=$row['performance3'];
            }
            else if($row['Indicator_id']==5.2){
                $result5_2=$row['performance3'];
            }
            else if($row['Indicator_id']==5.3){
                $result5_3=$row['performance3'];
            }
            else if($row['Indicator_id']==5.4){
                $result5_4=$row['score'];
            }
            else if($row['Indicator_id']==6.1){
                $result6_1=$row['performance3'];
            }
        }
        $data[0]['o']=$result1_1;
        $data[1]['o']=sprintf('%.2f',($result2_1+$result2_2)/$data[1]['cindi']);
        $data[1]['counto']=2; 
        $data[1]['avr']=sprintf('%.2f',($result2_1+$result2_2)/$data[1]['cindi']);
        $data[2]['i']=sprintf('%.2f',($result3_1+$result3_2+$result3_3)/$data[2]['cindi']); 
        $data[2]['counti']=3;      
        $data[2]['avr']=sprintf('%.2f',($result3_1+$result3_2+$result3_3)/$data[2]['cindi']);       
        $data[3]['i']=sprintf('%.2f',($result4_2+$result4_1+$result4_3)/$data[3]['cindi']);
        $data[3]['counti']=3;
        $data[3]['avr']=sprintf('%.2f',($result4_2+$result4_1+$result4_3)/$data[3]['cindi']);
        $data[4]['i']=sprintf('%.2f',$result5_1);
        $data[4]['counti']=1;
        $data[4]['p']=sprintf('%.2f',($result5_4+$result5_2+$result5_3)/($data[4]['cindi']-1));
        $data[4]['countp']=3; 
        $data[4]['avr']=sprintf('%.2f',($result5_1+$result5_2+$result5_3+$result5_4)/$data[4]['cindi']);
        $data[5]['p']=sprintf('%.2f',$result6_1);
        $data[5]['countp']=1;
        $data[5]['avr']=sprintf('%.2f',$result6_1);

        $data[0]['resultipo1']=sprintf('%.2f',($result3_1+$result3_2+$result3_3+$result4_2+$result4_1+$result4_3+$result5_1)/7);
        $data[0]['resultipo2']=sprintf('%.2f',($result5_4+$result5_2+$result5_3+$result6_1)/4);
        $data[0]['resultipo3']=sprintf('%.2f',($result2_1+$result2_2)/2);
        $data[0]['resultindicatori']=$data[2]['counti']+$data[3]['counti']+$data[4]['counti'];
        $data[0]['resultindicatorp']=$data[4]['countp']+$data[5]['countp'];
        $data[0]['resultindicatoro']=$data[1]['counto'];
        $data[0]['avgall']=sprintf('%.2f',($data[1]['avr']+$data[2]['avr']+$data[3]['avr']+$data[4]['avr']+$data[5]['avr'])/5);
        $data[0]['resultavg']="";
        if($data[0]['avgall']>=0.01&&$data[0]['avgall']<=2.00){
            $data[0]['resultavg']="น้อย";
        }
        else if($data[0]['avgall']>=2.01&&$data[0]['avgall']<=3.00){
            $data[0]['resultavg']="ปานกลาง";
        }
        else if($data[0]['avgall']>=3.01&&$data[0]['avgall']<=4.00){
            $data[0]['resultavg']="ดี";
        }
        else if($data[0]['avgall']>=4.01&&$data[0]['avgall']<=5.00){
            $data[0]['resultavg']="ดีมาก";
        }

        for($i = 1; $i <= 5; $i++){
            if($data[$i]['avr']>=0.01&&$data[$i]['avr']<=2.00){
                $data[$i]['result']="น้อย";
            }
            else if($data[$i]['avr']>=2.01&&$data[$i]['avr']<=3.00){
                $data[$i]['result']="ปานกลาง";
            }
            else if($data[$i]['avr']>=3.01&&$data[$i]['avr']<=4.00){
                $data[$i]['result']="ดี";
            }
            else if($data[$i]['avr']>=4.01&&$data[$i]['avr']<=5.00){
                $data[$i]['result']="ดีมาก";
            }
        }
        foreach($pdca2 as $value)
        {
            $per2=$value['performance1'];
        }


        $querynewstrength=composition::where('id','!=',1)
        ->get();
        $getnewstrength=category7_strengths_summary::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $checkedit="";
        $getpermiss=indicator::where('active',1)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $check1=0;
        foreach($getpermiss as $checkper){
                if($checkper['Indicator_name']=="จุดแข็ง จุดที่ควรพัฒนา"){
                    $check1=1;
                }
        }
            return view('showcategory/category8',compact('querynewstrength','getnewstrength','checkedit','pdca'
            ,'per1','getall','indicator','pdca2','per2','getall2','indicator2','data','check1'));
        }
         
    }
}
