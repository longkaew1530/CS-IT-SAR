<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelAJ\Educational_background;
class APIAJController extends Controller
{
    /////วุติการศึกษา/////วุติการศึกษา/////วุติการศึกษา/////วุติการศึกษา/////วุติการศึกษา/////วุติการศึกษา
    public function geteducational_background($id)
    {
        $groupmenu = Educational_background::where('id',$id)->get();
        return $groupmenu;
    }
    public function addeducational_background(Request $request)
    {
        $user=auth()->user();
        $data['user_id']=$user->id;
        $data['eb_yearsuccess']=$request->eb_yearsuccess;
        $data['eb_name']=$request->eb_name;
        $data['eb_fieldofstudy']=$request->eb_fieldofstudy;
        $data['abbreviations']=$request->abbreviations;
        $data['education']=$request->education;
        Educational_background::insert($data);
        return redirect('/educational_background');
    }
    public function updateeducational_background(Request $request)
    {
        $id=$request->input('id');
        $data = Educational_background::find($id);
        $data->eb_yearsuccess = $request->input('eb_yearsuccess');
        $data->eb_name = $request->input('eb_name');
        $data->eb_fieldofstudy = $request->input('eb_fieldofstudy');
        $data->abbreviations = $request->input('abbreviations');
        $data->education = $request->input('education');
        $data->save();
        return redirect('/educational_background');
    }
    public function deleteeducational_background($id)
    {
        $product = Educational_background::find($id);
        $product->delete();
        
        return redirect('/educational_background');
    }
    /////วุติการศึกษา/////วุติการศึกษา/////วุติการศึกษา/////วุติการศึกษา/////วุติการศึกษา/////วุติการศึกษา
}
