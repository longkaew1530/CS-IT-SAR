<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelAJ\Educational_background;
use App\ModelAJ\Research_results;
use App\ModelAJ\categoty_researh;
use App\User;
use App\Menu;
class AJController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function educational_background()
    {
        $user=auth()->user();
        $eductional=Educational_background::where('user_id',$user->id)
        ->get();
        return view('AJ/educational_background',compact('eductional'));
    }
    public function research_results()
    {
        $user=auth()->user();
        $userall=User::where('user_course',$user->user_course)->get();
        $researchresults=Research_results::rightjoin('research_results_user','research_results_user.research_results_research_results_id','=','research_results.research_results_id')
        ->leftjoin('category_research_results','category_research_results.id','=','research_results.research_results_category')
        ->where('research_results_user.user_id',$user->id)
        ->get();
        $category=categoty_researh::all();
        return view('AJ/research_results',compact('researchresults','category','userall'));
    }
    public function addpdca($id)
    {
        $menuname=Menu::where('m_id',$id)->get();
        return view('AJ/addpdca',compact('menuname'));
    }
    public function add4_3()
    {
        return view('AJ/add4_3');
    }
}
