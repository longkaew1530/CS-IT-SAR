<?php

namespace App\Http\Controllers;
use App\category7_strength;
use App\category7_newstrength;
use App\category7_development_proposal;
use Illuminate\Http\Request;

class Category7Controller extends Controller
{
    public function strength()
    {
        $querystrength=category7_strength::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();

        $querynewstrength=category7_newstrength::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();

        $querydevelopment_proposal=category7_development_proposal::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();

        $year=session()->get('year');
        return view('category7/strength',compact('querystrength','querynewstrength','querydevelopment_proposal','year'));
    }
}
