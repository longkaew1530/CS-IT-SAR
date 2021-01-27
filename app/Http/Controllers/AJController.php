<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelAJ\Educational_background;
use App\ModelAJ\Research_results;
use App\ModelAJ\categoty_researh;
use App\User;
use App\Menu;
use App\indicator4_3;
use App\PDCA;
use App\category3_GD;
use App\performance3_3;
use App\category4_course_results;
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
        $researchresults=Research_results::rightjoin('research_results_user','research_results_user.research_results_research_results_id','=','research_results.research_results_id')
        ->leftjoin('category_research_results','category_research_results.id','=','research_results.research_results_category')
        ->where('research_results_user.user_id',$user->id)
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
        if(!count($getpdca)){
            return view('AJ/addpdca',compact('menuname'));   
        }
        else if($getpdca[0]['p']==null&&$getpdca[0]['d']==null&&$getpdca[0]['c']==null&&$getpdca[0]['a']==null){
            return view('AJ/addpdca',compact('menuname'));
        }
        else{
            return view('category3/showpdca',compact('pdca','name','id'));
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
            return view('AJ/addinfostd');
    }
    public function addfactor($id)
    {
        $menuname=Menu::where('m_id',$id)
        ->get();

        $factor=category3_GD::where('category_factor',$menuname[0]['m_name'])
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
            return view('AJ/addindicator2-1');
    }
    public function addindicator2_2()
    {
            return view('AJ/addindicator2-2');
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
    public function addindicator5_4()
    {
        $get=in_index::all();
            return view('AJ/add5_4',compact('get'));
            
    }
}
