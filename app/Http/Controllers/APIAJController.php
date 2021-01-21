<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelAJ\Educational_background;
use App\ModelAJ\Research_results;
use App\ModelAJ\Research_results_user;
use App\ModelAJ\categoty_researh;
use App\User;
use App\PDCA;
use App\docpdca;
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

    /////ผลงานวิจัย/////ผลงานวิจัย/////ผลงานวิจัย/////ผลงานวิจัย/////ผลงานวิจัย/////ผลงานวิจัย
    public function getresearch_results($id)
    {
        $groupmenu = Research_results::where('id',$id)->get();
        return $groupmenu;
    }
    public function addresearch_results(Request $request)
    {
        $getdata=$request->all();
        $countgetname=count($getdata['teacher_name']);
        $text="";
        $i=1;
        foreach($getdata['teacher_name'] as $row){
            $query=User::find($row);
            if($i!=$countgetname){
                $text=$text."".$query->user_fullname.", ";
            }
            else{
                $text=$text." และ".$query->user_fullname;
            }
            $i++;
        }
        $data=new Research_results;
        $data->teacher_name=$text;
        $data->research_results_category=$request->research_results_category;
        $data->research_results_year=$request->research_results_year;
        $data->research_results_name=$request->research_results_name;
        $data->research_results_description=$request->research_results_description;
        $data->research_results_salary=$request->research_results_salary;
        $data->save();
        foreach($getdata['teacher_name'] as $row){
            $query=User::find($row);
            $insert=new Research_results_user;
            $insert->research_results_research_results_id=$data->research_results_id;
            $insert->user_id=$row;
            $insert->save();
        }
    }
    public function updatresearch_results(Request $request)
    {
        $id=$request->input('id');
        $data = Research_results::find($id);
        $data->eb_yearsuccess = $request->input('eb_yearsuccess');
        $data->eb_name = $request->input('eb_name');
        $data->eb_fieldofstudy = $request->input('eb_fieldofstudy');
        $data->abbreviations = $request->input('abbreviations');
        $data->education = $request->input('education');
        $data->save();
        return redirect('/educational_background');
    }
    public function deleteresearch_results($id)
    {
        $product = Research_results::find($id);
        $product1 = Research_results_user::find($id);
        $product->delete();
        $product1->delete();
        return redirect('/educational_background');
    }
    /////ผลงานวิจัย/////ผลงานวิจัย/////ผลงานวิจัย/////ผลงานวิจัย/////ผลงานวิจัย/////ผลงานวิจัย

    /////pdca/////pdca/////pdca/////pdca/////pdca/////pdca
    public function getpdca($id)
    {
        $groupmenu = Research_results::where('id',$id)->get();
        return $groupmenu;
    }
    public function addpdca(Request $request)
    {
        $validatedData = $request->validate([
            'doc_file' => 'required',
            'doc_file.*' => 'mimes:csv,txt,xlx,xls,pdf'
            ]);
        $data=new PDCA;
        $data->course_id=session()->get('usercourse');
        $data->year_id=session()->get('year_id');
        $data->category_pdca=$request->category_pdca;
        $data->p=$request->editor1;
        $data->d=$request->editor2;
        $data->c=$request->editor3;
        $data->a=$request->editor4;
        $data->save();
        print($request->p);
        $querymaxiddoc = docpdca::whereRaw('doc_id = (select max(`doc_id`) from doc_pdca)')->get();
        $maxiddoc=$querymaxiddoc[0]['doc_id'];
            if($request->TotalFiles > 0)
            {
                    
               for ($x = 0; $x < $request->TotalFiles; $x++) 
               {
                   if ($request->hasFile('doc_file')) 
                    {
                        $getfile = $request->file('doc_file');
                        $path = 'public/PDCA';
                        $name = $getfile[$x]->getClientOriginalName();
                        $fullfile=$path."/".$name;
                        $getfile[$x]->move($path, $name);                 
                        $insert[$x]['doc_file'] = $fullfile;
                        $insert[$x]['doc_name'] = $name;
                        $insert[$x]['pdca_id'] = $data->pdca_id;
                        $insert[$x]['doc_id'] = $maxiddoc+($x+1);                     
                    }            
               }           
               $success=docpdca::insert($insert);
            }
        return $success;
    }
    public function updatpdca(Request $request)
    {
        $id=$request->input('id');
        $data = Research_results::find($id);
        $data->eb_yearsuccess = $request->input('eb_yearsuccess');
        $data->eb_name = $request->input('eb_name');
        $data->eb_fieldofstudy = $request->input('eb_fieldofstudy');
        $data->abbreviations = $request->input('abbreviations');
        $data->education = $request->input('education');
        $data->save();
        return redirect('/educational_background');
    }
    public function deletepdca($id)
    {
        $product = Research_results::find($id);
        $product1 = Research_results_user::find($id);
        $product->delete();
        $product1->delete();
        return redirect('/educational_background');
    }
    /////pdca/////pdca/////pdca/////pdca/////pdca/////pdca

    public function getidmenu($id)
    {
        session()->put('test',$id);
    }
}
