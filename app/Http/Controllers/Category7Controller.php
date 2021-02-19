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
        return view('category7/strength',compact('querystrength'));
    }
    public function development_proposal()
    {
        $querydevelopment_proposal=category7_development_proposal_detail::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();

        $year=session()->get('year');
        return view('category7/development_proposal',compact('querydevelopment_proposal'));
    }
    public function newstrength()
    {
        $querynewstrength=category7_newstrength::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        return view('category7/newstrength',compact('querynewstrength'));
    }
    public function strengths_summary()
    {
        $querynewstrength=composition::all();
        return view('category7/strengths_summary',compact('querynewstrength'));
    }
}
