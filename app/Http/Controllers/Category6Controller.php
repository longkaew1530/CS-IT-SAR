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
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $checkedit="asds";
        return view('category6/comment_course',compact('coursemanage','checkedit'));
    }
    public function assessment_summary()
    {
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
        $checkedit="asds";
        return view('category6/assessment_summary',compact('assessmentsummary','assessmentsummary2','checkedit'));
    }
}
