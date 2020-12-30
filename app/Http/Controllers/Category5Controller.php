<?php

namespace App\Http\Controllers;
use App\category5_course_manage;
use Illuminate\Http\Request;

class Category5Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function course_administration()
    {
        $coursemanage=category5_course_manage::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        return view('category5/course_administration',compact('coursemanage'));
    }
}
