<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelAJ\Educational_background;
use App\ModelAJ\Research_results;
use App\ModelAJ\categoty_researh;
use App\User;
use App\Menu;
use App\Year;
use App\branch;
use App\training_information;
use App\category3_resignation;
use App\course_responsible_teacher;
use App\indicator4_3;
use App\indicator1_1;
use App\category4_teaching_quality;
use App\category4_course_results;
use App\defaulindicator;
use App\indicator;
use App\year_acceptance;
use App\year_acceptance_graduate;
use App\indicator2_2;
use App\indicator2_1;
use App\Course;
use App\category3_graduate;
use App\indicator5_4;
use App\category3_infostudent;
use App\category3_infostudent_qty;
use App\composition;
use App\category7_strengths_summary;
use App\categorypdca;
use App\PDCA;
use App\category3_GD;
use App\category6_assessment_summary;
use App\performance3_3;
use App\ModelAJ\category4_academic_performance;
use App\ModelAJ\category4_incomplete_content;
use App\category4_notcourse_results;
use App\category4_effectiveness;
use App\category4_newteacher;
use App\category4_activity;
use App\category7_strength;
use App\category7_newstrength;
use App\category7_development_proposal;
use App\in_index;
class AJController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function educational_background()
    {
        $user=auth()->user();
        $eductional=Educational_background::where('user_id',$user->id)
        ->get();
        return view('AJ/educational_background',compact('eductional'));
    }
    public function research_results()
    {
        $user=auth()->user();
        $userall=User::where('user_course',$user->user_course)
        ->where('user_branch',session()->get('branch_id'))
        ->where('user_group_id','!=',2)
        ->where('user_group_id','!=',1)
        ->get();
        $researchresults=Research_results::rightjoin('research_results_user','research_results_user.research_results_research_results_id','=','research_results.research_results_id')
        ->leftjoin('category_research_results','category_research_results.id','=','research_results.research_results_category')
        ->where('research_results_user.user_id',$user->id)
        ->get();
        // $researchresults=Research_results::leftjoin('category_research_results','category_research_results.id','=','research_results.research_results_category')
        // ->where('owner',$user->id)
        // ->get();
        $category=categoty_researh::all();
        return view('AJ/research_results',compact('researchresults','category','userall'));
    }
    public function training_information()
    {
        $user=auth()->user();
        $userall=training_information::where('user_id',$user->id)
        ->where('year_id',session()->get('year_id'))
        ->get();

        return view('AJ/training_information',compact('userall'));
    }
    public function past_performance()
    {
        $user=auth()->user();
        $userall=User::where('user_course',$user->user_course)->get();
        // $researchresults=Research_results::rightjoin('research_results_user','research_results_user.research_results_research_results_id','=','research_results.research_results_id')
        // ->leftjoin('category_research_results','category_research_results.id','=','research_results.research_results_category')
        // ->where('research_results_user.user_id',$user->id)
        // ->get();
        $researchresults=Research_results::leftjoin('category_research_results','category_research_results.id','=','research_results.research_results_category')
        ->where('owner',$user->id)
        ->get();
        $category=categoty_researh::all();
        return view('AJ/past_performance',compact('researchresults','category','userall'));
    }
    public function addpdca($id)
    {
        $menuname=Menu::where('m_id',$id)
        ->get();
        $pdca=PDCA::leftjoin('indicator','pdca.Indicator_id','=','indicator.indicator_id')
        ->where('pdca.Indicator_id',$menuname[0]['Indicator_id'])
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',1)
        ->get();
        $name="";
        $id="";
        foreach($pdca as $value)
        {
            $name=$value['Indicator_name'];
            $id=$value['Indicator_id'];
        }
        $getpdca = PDCA::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('category_pdca',$menuname[0]['m_name'])
        ->where('year_id',session()->get('year_id'))
        ->get();
        $getcourse=Course::where('course_id',session()->get('usercourse'))
        ->get();
        if(!count($getpdca)){
            return view('AJ/addpdca',compact('menuname'));   
        }
        else if($getpdca[0]['p']==null&&$getpdca[0]['d']==null&&$getpdca[0]['c']==null&&$getpdca[0]['a']==null){
            return view('AJ/addpdca',compact('menuname'));
        }
        else{
            return view('category3/showpdca',compact('pdca','name','id','getcourse'));
        }
    }
    public function add4_3($id)
    {
        $menuname=indicator::where('id',$id)
        ->get();
        $pdca= defaulindicator::where('Indicator_id',$menuname[0]['Indicator_id'])
        ->get();
        $per1="";
        if($id=="4.2"&&$id=="2.1"&&$id=="2.2"&&$id=="5.4")
        {
            $per1="asdsadsad";
        }
        $in4_3 = indicator4_3::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
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
        if(count($in4_3)===0){
            return view('AJ/add4_3',compact('pdca','per1'));
        }
        else{
            return view('category/indicator4-3',compact('in4_3','inc','checkedit','name','id','getcategorypdca'));
        }
    }
    public function addinfostd()
    {
            $get=year_acceptance::where('course_id',session()->get('usercourse'))
            ->get();
            $getinfo="";
            if($get!='[]'){
                $getinfo=category3_infostudent::where('course_id',session()->get('usercourse'))
                ->where('branch_id',session()->get('branch_id'))
                ->where('year_add', '>=',$get[0]['year_add'])
                ->where('year_add', '<=',session()->get('year'))
                ->where('reported_year', '>=',$get[0]['year_add'])
                ->where('reported_year', '<=',session()->get('year'))
                ->get();
            }
            
            $getyear=category3_infostudent::where('course_id',session()->get('usercourse'))
            ->where('branch_id',session()->get('branch_id'))
            ->where('year_add',session()->get('year'))
            ->get();
            $getqty=category3_infostudent_qty::where('course_id',session()->get('usercourse'))
            ->where('branch_id',session()->get('branch_id'))
            ->where('year_id',session()->get('year_id'))
            ->get();
            if(count($get)==0){
                $get="";
            }
            if(count($getyear)==0||$getqty=='[]'){
                return view('AJ/addinfostd',compact('get','getinfo'));
            }
            else{
                $get=year_acceptance::where('course_id',session()->get('usercourse'))
                     ->where('branch_id',session()->get('branch_id'))
                    ->get();
                    $getinfo="";
                    if($get!=""){
                        $getinfo=category3_infostudent::where('course_id',session()->get('usercourse'))
                        ->where('branch_id',session()->get('branch_id'))
                        ->where('year_add', '>=',$get[0]['year_add'])
                        ->where('year_add', '<=',session()->get('year'))
                        ->where('reported_year', '>=',$get[0]['year_add'])
                        ->where('reported_year', '<=',session()->get('year'))
                        ->orderBy('year_add','desc')
                        ->get();
                        
                    }
                    if(count($get)==0){
                        $get="";
                    }
                $getqty=category3_infostudent_qty::where('course_id',session()->get('usercourse'))
                ->where('branch_id',session()->get('branch_id'))
                ->where('year_id',session()->get('year_id'))
                ->get();
                $countnumber=count($getyear);
                $checkedit="asdsad";
                $checkinfo=category3_infostudent::where('course_id',session()->get('usercourse'))
                ->where('branch_id',session()->get('branch_id'))
                ->where('year_add',session()->get('year'))
                ->get();
                return view('category3/infostudents',compact('checkinfo','get','getinfo','getqty','countnumber','checkedit'));
            }
            
    }
    public function addfactor($id)
    {
        $menuname=indicator::where('id',$id)
        ->get();

        $factor=category3_GD::where('category_factor',$menuname[0]['Indicator_name'])
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $checkedit="asdas";
        if(count($factor)===0){
            return view('AJ/addfactor',compact('menuname'));
        }
        else{
            if($menuname[0]['category_factor']=="ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา"){
                return view('category3/Impactfactors',compact('factor','checkedit'));
            }
            else{
                return view('category3/Impactgraduation',compact('factor','checkedit'));
            }
        }
    }
    public function addindicator2_1()
    {
        $pdca= defaulindicator::where('Indicator_id',2.1)
        ->get();
        $per1="asdsadsad";
        $factor=indicator2_1::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
        if(count($factor)===0){
            return view('AJ/addindicator2-1',compact('pdca','per1'));
        }
        else{
            $pdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',2.1)
        ->where('pdca.target','!=',null)
        ->get();
        $getcategorypdca=defaulindicator::where('id',2)
        ->get();
        $name="";
        $id="";
        $checkedit="asdsad";
        foreach($getcategorypdca as $value)
        {
            $name=$value['Indicator_name'];
            $id=$value['Indicator_id'];
        }
            return view('category3/indicator2-1',compact('factor','pdca','per1','name','id','checkedit'));
        } 
            
    }
    public function addindicator2_2()
    {
        $pdca= defaulindicator::where('Indicator_id',2.2)
        ->get();
        $per1="asdsadsad";
        $factor=indicator2_2::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
        if(count($factor)===0){
            return view('AJ/addindicator2-2',compact('pdca','per1'));
        }
        else{
            $pdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',2.2)
        ->where('pdca.target','!=',null)
        ->get();
        $getcategorypdca=defaulindicator::where('id',4)
        ->get();
        $name="";
        $id="";
        $checkedit="asdsad";
        foreach($getcategorypdca as $value)
        {
            $name=$value['Indicator_name'];
            $id=$value['Indicator_id'];
        }
            return view('category3/indicator2-2',compact('factor','pdca','per1','name','id','checkedit'));
        }      
    }
    public function addindicator3_3()
    {   
        $pdca= defaulindicator::where('Indicator_id',3.3)
        ->get();
        $per1="";
        $in3_3=performance3_3::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',3.3)
        ->where('pdca.target','!=',null)
        ->get();
        $getcategorypdca=defaulindicator::where('id',7)
        ->get();
        $name="";
        $id="";
        $checkedit="asdsad";
        foreach($getcategorypdca as $value)
        {
            $name=$value['Indicator_name'];
            $id=$value['Indicator_id'];
        }
        if(count($in3_3)===0){
            return view('AJ/add3_3',compact('pdca','per1'));
        }
        else{
            return view('category3/perfoment3_3',compact('in3_3','pdca','per1','inc','name','id','checkedit'));
        }
            
    }
    public function addcourse_results()
    {
        $ccr=category4_course_results::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if(count($ccr)===0){
            return view('AJ/addcourse_results');
        }
        else{
            $checkedit="asdasd";
            return view('category4/course_summary',compact('ccr','checkedit'));
        }
            
    }
    public function addindicator5_4($id)
    {
        $get=in_index::where('id',$id)
        ->get();
        return view('AJ/add5_4',compact('get'));
        
        // $check=indicator5_4::where('course_id',session()->get('usercourse'))
        // ->where('year_id',session()->get('year_id'))
        // ->get();
        // $getdata[0]=0;
        // $getdata[1]=0;
        // $getdata[2]=0;
        // $getdata[3]=0;
        // $getdata[4]=0;
        // $getdata[5]=0;
        // $getdata[6]=0;
        // $getdata[7]=0;
        // $getdata[8]=0;
        // $getdata[9]=0;
        // $getdata[10]=0;
        // $getdata[11]=0;
        // $getdata[12]=0;
        // foreach($check as $key=>$row){
        //         $getdata[$key]=$row['category'];          
        // }
        // $indi=in_index::all();
        // $perfor=indicator5_4::where('course_id',session()->get('usercourse'))
        // ->where('year_id',session()->get('year_id'))
        // ->get();

        // $result=0;
        // $resultpass1_5=0;
        // $resultpass1_5persen=0;
        // $resultpass1_5count=0;
        // $resultpassall=0;
        // $result=count($perfor);
        // foreach($perfor as $value){
        //     if($value['category']==1||$value['category']==2||$value['category']==3||$value['category']==4||$value['category']==5){
        //         $resultpass1_5count++;
        //         if($value['status']==1){
        //             $resultpass1_5++;
        //         }
        //     }
        //     if($value['status']==1){
        //         $resultpassall++;
        //     }
        // }
        // $resultpass1_5persen=($resultpass1_5count*100)/5;
        //     if(count($check)===12){
        //         return view('category4/indicator5_4',compact('indi','perfor','result','resultpass1_5','resultpass1_5persen','resultpassall'));
        //     }
        //     else{
        //         return view('AJ/add5_4',compact('get','getdata'));
        //     }
    }
    public function addacademic_performance()
    {
        $academic=category4_academic_performance::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $checkedit="asdasd";
        if(count($academic)===0){
            return view('AJ/addacademic_performance');
        }
        else{
            return view('category4/academic_performance',compact('academic','checkedit'));
        } 
                      
    }
    public function addnot_offered()
    {
        $ccr=category4_notcourse_results::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if(count($ccr)===0){
            return view('AJ/addnot_offered');
        }
        else{
            $checkedit="asdasd";
            return view('category4/not_course_summary',compact('ccr','checkedit'));
        }               
    }
    public function addincomplete_content()
    {
        $academic=category4_incomplete_content::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if(count($academic)===0){
            return view('AJ/addincomplete_content');
        }
        else{
            $checkedit="asdasd";
            return view('category4/incomplete_content',compact('academic','checkedit'));
        }               
    }
    public function addeffectiveness()
    {
            return view('AJ/addeffectiveness');        
    }
    public function addteacher_orientation()
    {
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
        if(count($th)===0){
            return view('AJ/addteacher_orientation');
        }
        else{
            $checkedit="aa";
            return view('category4/newteacher',compact('th','checkpass','checkedit'));
        }               
    }
    public function addactivity()
    {
            return view('AJ/addactivity');
             
    }
    public function addcourse_manage()
    {
            return view('AJ/addcourse_manage');
             
    }
    public function addcomment_course()
    {
            return view('AJ/addcomment_course');
             
    }
    public function addassessment_summary($id)
    {
        if($id=="การประเมินจากผู้ที่สำเร็จการศึกษา"){
            $menuname="การประเมินจากผู้ที่สำเร็จการศึกษา";
        }
        else
        {
            $menuname="การประเมินจากผู้ที่มีส่วนเกี่ยวข้อง";
        }
            return view('AJ/addassessment_summary',compact('menuname'));
    }
    public function addstrength()
    {
            return view('AJ/addstrength');
            
    }
    public function adddevelopment_proposal()
    {
            return view('AJ/adddevelopment_proposal2');
             
    }
    public function addnewstrength()
    {
            return view('AJ/addnewstrength');
    }
    public function addp($id)
    {
            $getindi=categorypdca::where('id',$id)
            ->get();
            $getcateid=indicator::where('Indicator_id',$getindi[0]['get'])
            ->get();
            return view('AJ/addp',compact('getindi','getcateid'));
             
    }
    public function addd($id)
    {
        $getindi=categorypdca::where('id',$id)
        ->get();
        $getcateid=indicator::where('Indicator_id',$getindi[0]['get'])
        ->get();
            return view('AJ/addD',compact('getindi','getcateid'));
             
    }

    public function addc($id)
    {
        $getindi=categorypdca::where('id',$id)
        ->get();
        $getcateid=indicator::where('Indicator_id',$getindi[0]['get'])
        ->get();
            return view('AJ/addC',compact('getindi','getcateid'));
             
    }
    public function adda($id)
    {
        $getindi=categorypdca::where('id',$id)
        ->get();
        $getcateid=indicator::where('Indicator_id',$getindi[0]['get'])
        ->get();
            return view('AJ/addA',compact('getindi','getcateid'));
             
    }
    public function addstrengths_summary($id)
    {
        $get=composition::where('id',$id)->get();
        return view('AJ/addstrengths_summary',compact('get'));
             
    }
    public function addgraduate()
    {
        $get=year_acceptance_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->get();
        $getinfo="";
        $getinfo2="";
        $gropby="";
        if($get!='[]'){
        $getinfo=category3_graduate::where('course_id',session()->get('usercourse'))
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
        $getyear=category3_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_add',session()->get('year'))
        ->get();
        if(count($get)==0){
            $get="";
        }
        if(count($getyear)==0){
            return view('AJ/addgraduate',compact('get','getinfo','getyear'));
        }
        else{
            $checkedit="asdasd";
            return view('category3/graduatesqty',compact('get','getinfo','getyear','getinfo2','gropby','checkedit'));
        }
           
             
    }
    public function addteaching_quality()
    {
        $data=category4_course_results::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('course_name','!=','รหัสชื่อวิชา')
        ->get();
        $teachqua=category4_teaching_quality::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
       ->where('year_id',session()->get('year_id'))
       ->get();
       $teachquagroup=category4_teaching_quality::groupBy('student_year')
       ->get();
        $checkedit="asdasd";
        if(count($teachqua)===0){
            return view('AJ/addteaching_quality',compact('data'));
        }
        else{
            return view('category4/teaching_quality',compact('teachqua','teachquagroup','checkedit'));
        }
            
             
    }

    public function addresignation()
    {
        $get=year_acceptance_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->get();
        $getinfo="";
        $getinfo2="";
        $gropby="";
        if($get!='[]'){
        $getinfo=category3_graduate::where('course_id',session()->get('usercourse'))
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
        $getyear=category3_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_add',session()->get('year'))
        ->get();
        $re=category3_resignation::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_present',session()->get('year'))
        ->get();
        $i=0;
        if(count($re)===0){
            return view('AJ/addresignation',compact('get','getinfo','getyear','getinfo2','gropby','re')); 
            
        }   
        else{
            $checkedit="asdasd";
            return view('category3/resignation',compact('get','getinfo','getyear','getinfo2','gropby','re','checkedit'));
        }      
    }

    public function addindicator1_1()
    {
        $data=indicator1_1::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
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
         ->where('users.user_branch',session()->get('branch_id'))
         ->where('users.user_course',session()->get('usercourse'))
         ->where('course_responsible_teacher.year_id',session()->get('year_id'))
         ->get();
 
         ////ดึงสาขาวิชาที่จบของอาจารย์ผู้รับผิดชอบหลักสูตร
         $educ_bg= User::leftjoin('course_responsible_teacher','users.id','=','course_responsible_teacher.user_id')
         ->where('users.user_branch',session()->get('branch_id'))
         ->where('users.user_course',session()->get('usercourse'))
         ->where('course_responsible_teacher.year_id',session()->get('year_id'))
         ->get();
          ////ดึงสาขาวิชาที่จบของอาจารย์ประจำหลักสูตร
          $tc_course= User::leftjoin('course_teacher','users.id','=','course_teacher.user_id')
          ->where('users.user_branch',session()->get('branch_id'))
          ->where('users.user_course',session()->get('usercourse'))
          ->where('course_teacher.year_id',session()->get('year_id'))
          ->get();
 
          ////ดึงสาขาวิชาที่จบของอาจารย์ผู้สอน
          $instructor= User::leftjoin('instructor','users.id','=','instructor.user_id')
          ->where('users.user_branch',session()->get('branch_id'))
          ->where('users.user_course',session()->get('usercourse'))
          ->where('instructor.year_id',session()->get('year_id'))
          ->get();
          ////ดึงสาขาวิชาที่จบของอาจารย์ผู้สอนพิเศษ
          $specialinstructor= User::leftjoin('special_teacher','users.id','=','special_teacher.user_id')
          ->where('users.user_branch',session()->get('branch_id'))
          ->where('users.user_course',session()->get('usercourse'))
          ->where('special_teacher.year_id',session()->get('year_id'))
          ->get();
 
          $getresult=indicator1_1::where('year_id',session()->get('year_id'))
          ->where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
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
         
          ////ดึงผลการประเมินตนเอง ตัวบ่งชี้ที่ 1.1
         $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
         ->where('pdca.branch_id',session()->get('branch_id'))
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
        if(count($data)==0){
            $checkedit="aa";
            return view('category/addindicator1-1',compact('c','count','nameteacher'
            ,'educ_bg','y','checkpass','checknotpass','checkedit','id','name','tc_course','instructor','specialinstructor','inc','result1','result2','result3','result4','result5','result6','result7','result8','result9','result10'));
        }
        else{
            $checkedit="aa";
            return view('category/indicator1-1',compact('c','count','nameteacher'
            ,'educ_bg','y','checkpass','checknotpass','checkedit','id','name','tc_course','instructor','specialinstructor','inc','result1','result2','result3','result4','result5','result6','result7','result8','result9','result10'));
        }
            
             
    }
}
