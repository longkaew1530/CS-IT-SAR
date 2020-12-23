<?php

namespace App\Http\Controllers;
use App\User;
use App\category4_course_results;
use App\category4_notcourse_results;
use App\in_index;
use App\indicator5_4;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
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

        $result=0;
        $resultpass1_5=0;
        $resultpass1_5persen=0;
        $resultpass1_5count=0;
        $resultpassall=0;
        $result=count($perfor);
        foreach($perfor as $value){
            if($value['category']==1||$value['category']==2||$value['category']==3||$value['category']==4||$value['category']==5){
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
        return view('category4/indicator5_4',compact('indi','perfor','result','resultpass1_5','resultpass1_5persen','resultpassall'));
    }
}
