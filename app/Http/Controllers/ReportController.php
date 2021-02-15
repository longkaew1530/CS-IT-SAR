<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\PDCA;
use App\composition;
use App\indicator;
use App\category;
use App\assessment_results;
class ReportController extends Controller
{
    public function overview()
    {
        $query=assessment_results::leftjoin('category','assessment_results.category_id','=','category.category_id')
        ->where('assessment_results.year_id',session()->get('year_id'))
        ->get();
            return view('report/overview',compact('query'));
    }
    public function instructor()
    {
            $instructor= User::leftjoin('instructor','users.id','=','instructor.user_id')
            ->where('users.user_course',session()->get('usercourse'))
            ->where('instructor.year_id',1)
            ->get();
            return view('report/instructor',compact('instructor'));
    }
    public function performance_summary()
    {
        $getall=composition::all();
        $pdca=indicator::leftjoin('pdca','indicator.Indicator_id','=','pdca.indicator_id')
        ->where('indicator.year_id',session()->get('year_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.course_id',session()->get('usercourse'))
        ->get();
        $per1="";
        foreach($pdca as $value)
        {
            $per1=$value['performance1'];
        }
            return view('report/performance_summary',compact('pdca','per1','getall'));
    }
}
