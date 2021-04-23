<?php

namespace App\Http\Controllers;
use App\category7_strength;
use App\category7_newstrength;
use App\category7_development_proposal_detail;
use App\composition;
use App\category7_strengths_summary;
use Illuminate\Http\Request;

class Category7Controller extends Controller
{
    public function strength()
    {
        $querystrength=category7_strength::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $checkedit="asdasd";
        return view('category7/strength',compact('querystrength','checkedit'));
    }
    public function development_proposal()
    {
        $querydevelopment_proposal=category7_development_proposal_detail::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $checkedit="asdasd";
        $year=session()->get('year');
        return view('category7/development_proposal',compact('querydevelopment_proposal','checkedit'));
    }
    public function newstrength()
    {
        $querynewstrength=category7_newstrength::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $checkedit="asdsad";
        return view('category7/newstrength',compact('querynewstrength','checkedit'));
    }
    public function strengths_summary()
    {
        $querynewstrength=composition::where('id','!=',1)
        ->get();
        $getnewstrength=category7_strengths_summary::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $checkedit="asdsad";
        return view('category7/strengths_summary',compact('querynewstrength','getnewstrength','checkedit'));
    }
}
