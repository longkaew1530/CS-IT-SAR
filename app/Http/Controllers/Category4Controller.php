<?php

namespace App\Http\Controllers;
use App\User;
use App\category4_course_results;
use App\category4_notcourse_results;
use App\in_index;
use App\indicator5_4;
use App\category4_teaching_quality;
use App\category4_effectiveness;
use App\PDCA;
use App\category4_newteacher;
use App\category4_activity;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\ModelAJ\category4_academic_performance;
use App\ModelAJ\category4_incomplete_content;
use Illuminate\Http\Request;

class Category4Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function coursesummary()
    {
        $ccr=category4_course_results::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        return view('category4/course_summary',compact('ccr'));
    }
    public function notcoursesummary()
    {
        $ccr=category4_notcourse_results::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        return view('category4/not_course_summary',compact('ccr'));
    }
    public function indicator5_4()
    {
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
        return view('category4/indicator5_4',compact('indi','perfor','result','resultpass1_5','resultpass1_5persen','resultpassall','inc','per1'));
    }
    public function teachingquality()
    {
       $teachqua=category4_teaching_quality::where('course_id',session()->get('usercourse'))
       ->where('year_id',session()->get('year_id'))
       ->get();
       $teachquagroup=category4_teaching_quality::groupBy('student_year')
       ->get();
        return view('category4/teaching_quality',compact('teachqua','teachquagroup'));
    }
    public function effectiveness()
    {
        $effec=category4_effectiveness::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        return view('category4/effectiveness',compact('effec'));
    }
    public function newteacher()
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
        return view('category4/newteacher',compact('th','checkpass'));
    }
    public function activity()
    {
        $activity=category4_activity::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        return view('category4/activity',compact('activity'));
    }
    public function academic_performance()
    {
        $academic=category4_academic_performance::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        return view('category4/academic_performance',compact('academic'));
    }
    public function incomplete_content()
    {
        $academic=category4_incomplete_content::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        return view('category4/incomplete_content',compact('academic'));
    }
}
