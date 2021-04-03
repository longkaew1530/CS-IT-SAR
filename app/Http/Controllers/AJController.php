<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelAJ\Educational_background;
use App\ModelAJ\Research_results;
use App\ModelAJ\categoty_researh;
use App\User;
use App\Menu;
use App\indicator4_3;
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
use App\category4_course_results;
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
        $userall=User::where('user_course',$user->user_course)->get();
        // $researchresults=Research_results::rightjoin('research_results_user','research_results_user.research_results_research_results_id','=','research_results.research_results_id')
        // ->leftjoin('category_research_results','category_research_results.id','=','research_results.research_results_category')
        // ->where('research_results_user.user_id',$user->id)
        // ->get();
        $researchresults=Research_results::where('owner',$user->id)
        ->get();
        $category=categoty_researh::all();
        return view('AJ/research_results',compact('researchresults','category','userall'));
    }
    public function addpdca($id)
    {
        $menuname=Menu::where('m_id',$id)
        ->get();
        $pdca=PDCA::leftjoin('indicator','pdca.Indicator_id','=','indicator.indicator_id')
        ->where('pdca.Indicator_id',$menuname[0]['Indicator_id'])
        ->where('pdca.course_id',session()->get('usercourse'))
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
    public function add4_3()
    {
        $in4_3 = indicator4_3::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if(count($in4_3)===0){
            return view('AJ/add4_3');
        }
        else{
            return view('category/indicator4-3',compact('in4_3'));
        }
    }
    public function addinfostd()
    {
            $get=year_acceptance::where('course_id',session()->get('usercourse'))
            ->where('year_id',session()->get('year_id'))
            ->get();
            $getinfo=category3_infostudent::where('course_id',session()->get('usercourse'))
            ->get();
            $getyear=category3_infostudent::where('course_id',session()->get('usercourse'))
            ->where('year_add',session()->get('year'))
            ->get();
            if(count($get)==0){
                $get="";
            }
            if(count($getyear)===0){
                return view('AJ/addinfostd',compact('get','getinfo'));
            }
            else{
                $get=year_acceptance::where('course_id',session()->get('usercourse'))
                    ->where('year_id',session()->get('year_id'))
                    ->get();
                $getinfo=category3_infostudent::where('course_id',session()->get('usercourse'))
                    ->get();
                    if(count($get)==0){
                        $get="";
                    }
                $getqty=category3_infostudent_qty::where('course_id',session()->get('usercourse'))
                ->where('year_id',session()->get('year_id'))
                ->get();
                $countnumber=count($getinfo);
                return view('category3/infostudents',compact('get','getinfo','getqty','countnumber'));
            }
            
    }
    public function addfactor($id)
    {
        $menuname=indicator::where('id',$id)
        ->get();

        $factor=category3_GD::where('category_factor',$menuname[0]['Indicator_name'])
        ->where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if(count($factor)===0){
            return view('AJ/addfactor',compact('menuname'));
        }
        else{
            if($menuname[0]['category_factor']=="ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา"){
                return view('category3/Impactfactors',compact('factor'));
            }
            else{
                return view('category3/Impactgraduation',compact('factor'));
            }
        }
    }
    public function addindicator2_1()
    {
        $factor=indicator2_1::where('course_id',session()->get('usercourse'))
         ->where('year_id',session()->get('year_id'))
         ->get();
        if(count($factor)===0){
            return view('AJ/addindicator2-1');
        }
        else{
            return view('category3/indicator2-1',compact('factor'));
        } 
            
    }
    public function addindicator2_2()
    {
        $factor=indicator2_2::where('course_id',session()->get('usercourse'))
         ->where('year_id',session()->get('year_id'))
         ->get();
        if(count($factor)===0){
            return view('AJ/addindicator2-2');
        }
        else{
            return view('category3/indicator2-2',compact('factor'));
        }      
    }
    public function addindicator3_3()
    {   
        $in3_3=performance3_3::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if(count($in3_3)===0){
            return view('AJ/add3_3');
        }
        else{
            return view('category3/perfoment3_3',compact('in3_3'));
        }
            
    }
    public function addcourse_results()
    {
        $ccr=category4_course_results::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if(count($ccr)===0){
            return view('AJ/addcourse_results');
        }
        else{
            return view('category4/course_summary',compact('ccr'));
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
        ->where('year_id',session()->get('year_id'))
        ->get();
        if(count($academic)===0){
            return view('AJ/addacademic_performance');
        }
        else{
            return view('category4/academic_performance',compact('academic'));
        } 
                      
    }
    public function addnot_offered()
    {
        $ccr=category4_notcourse_results::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if(count($ccr)===0){
            return view('AJ/addnot_offered');
        }
        else{
            return view('category4/not_course_summary',compact('ccr'));
        }               
    }
    public function addincomplete_content()
    {
        $ccr=category4_incomplete_content::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if(count($ccr)===0){
            return view('AJ/addincomplete_content');
        }
        else{
            return view('category4/not_course_summary',compact('ccr'));
        }               
    }
    public function addeffectiveness()
    {
            return view('AJ/addeffectiveness');        
    }
    public function addteacher_orientation()
    {
        $th=category4_newteacher::where('course_id',session()->get('usercourse'))
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
            return view('category4/newteacher',compact('th','checkpass'));
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
        $menuname=Menu::where('m_id',$id)
        ->get();
        $check=category6_assessment_summary::where('category_assessor',$menuname[0]['m_name'])
        ->get();
        $assessmentsummary=category6_assessment_summary::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
         if(count($check)===0){
            return view('AJ/addassessment_summary',compact('menuname'));
        }
        else{
            return view('category6/assessment_summary',compact('assessmentsummary'));
        }
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
            $getcateid=indicator::where('id',$getindi[0]['Indicator_id'])
            ->get();
            return view('AJ/addp',compact('getindi','getcateid'));
             
    }
    public function addd($id)
    {
            $getindi=categorypdca::where('id',$id)
            ->get();
            $getcateid=indicator::where('id',$getindi[0]['Indicator_id'])
            ->get();
            return view('AJ/addD',compact('getindi','getcateid'));
             
    }

    public function addc($id)
    {
            $getindi=categorypdca::where('id',$id)
            ->get();
            $getcateid=indicator::where('id',$getindi[0]['Indicator_id'])
            ->get();
            return view('AJ/addC',compact('getindi','getcateid'));
             
    }
    public function adda($id)
    {
            $getindi=categorypdca::where('id',$id)
            ->get();
            $getcateid=indicator::where('id',$getindi[0]['Indicator_id'])
            ->get();
            return view('AJ/addA',compact('getindi','getcateid'));
             
    }
    public function addstrengths_summary()
    {
        $get=composition::all();
        $check=category7_strengths_summary::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $getdata[0]=0;
        $getdata[1]=0;
        $getdata[2]=0;
        $getdata[3]=0;
        $getdata[4]=0;
        $getdata[5]=0;
        foreach($check as $key=>$row){
                $getdata[$key]=$row['composition_id'];          
        }
            return view('AJ/addstrengths_summary',compact('get','getdata'));
             
    }
    public function addgraduate()
    {
        $get=year_acceptance_graduate::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $getinfo=category3_graduate::where('course_id',session()->get('usercourse'))
        ->get();
        $getyear=category3_graduate::where('course_id',session()->get('usercourse'))
        ->where('year_add',session()->get('year'))
        ->get();
        $getinfo2=category3_infostudent::where('course_id',session()->get('usercourse'))
            ->get();
        if(count($get)==0){
            $get="";
        }

        if(count($getyear)===0){
            return view('AJ/addgraduate',compact('get','getinfo','getyear'));
        }
        else{
            return view('category3/graduatesqty',compact('get','getinfo','getyear','getinfo2'));
        }
           
             
    }
}
