<?php

namespace App\Http\Controllers;
use App\User;
use App\category4_course_results;
use App\category4_notcourse_results;
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
}
