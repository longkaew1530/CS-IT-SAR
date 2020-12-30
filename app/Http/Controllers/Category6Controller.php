<?php

namespace App\Http\Controllers;
use App\category6_comment_course;
use App\category6_assessment_summary;
use Illuminate\Http\Request;

class Category6Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function comment_course()
    {
        $coursemanage=category6_comment_course::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        return view('category6/comment_course',compact('coursemanage'));
    }
    public function assessment_summary()
    {
        $assessmentsummary=category6_assessment_summary::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        return view('category6/assessment_summary',compact('assessmentsummary'));
    }
}
