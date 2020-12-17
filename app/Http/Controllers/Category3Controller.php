<?php

namespace App\Http\Controllers;
use App\User;
use App\PDCA;
use App\DocPDCA;
use App\Groupmenu;
use App\Course;
use App\categoty_researh;
use App\Research_results;
use App\Year;
use App\Tps;
use App\indicator4_3;
use App\category3_GD;
use App\course_responsible_teacher;
use App\Educational_background;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class Category3Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function graduatesQTY()
    {
        $year = session()->get('year_id');
        $gd=category3_GD::where('year_id',$year)
        ->get();
        return view('category3/graduatesqty',compact('gd'));
    }
    public function Studentsinfo()
    {
        $gd=category3_GD::all();
        
        return view('category3/infostudents',compact('gd'));
    }
    public function Impactfactors()
    {
        $factor=category3_GD::where('category_factor','ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา')
        ->where('course_id',session()->get('usercourse'))
         ->where('year_id',session()->get('year_id'))
        ->get();
        
        return view('category3/Impactfactors',compact('factor'));
    }
    public function Impactgraduation()
    {
        $factor=category3_GD::where('category_factor','ปัจจัยที่มีผลกระทบต่อการสำเร็จการศึกษา')
        ->where('course_id',session()->get('usercourse'))
         ->where('year_id',session()->get('year_id'))
         ->get();
        return view('category3/Impactgraduation',compact('factor'));
    }
    public function indicator2_1()
    {
        $factor=category3_GD::where('category_factor','ปัจจัยที่มีผลกระทบต่อการสำเร็จการศึกษา')
        ->where('course_id',session()->get('usercourse'))
         ->where('year_id',session()->get('year_id'))
         ->get();
        return view('category3/indicator2-1',compact('factor'));
    }
}
