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
use App\indicator4_3;
use App\docindicator4_3;
use File;
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
        $pdca = PDCA::where('pdca_id',$id)->get();
        return view('AJ/editpdca',compact('pdca'));
    }
    public function addpdca(Request $request)
    {
        $validatedData = $request->validate([
            'doc_file' => 'required',
            'doc_file.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx'
            ]);
        $data=new PDCA;
        $data->course_id=session()->get('usercourse');
        $data->year_id=session()->get('year_id');
        $data->category_pdca=$request->category_pdca;
        $data->Indicator_id=$request->Indicator_id;
        $data->m_id=$request->m_id;
        $data->p=$request->editor1;
        $data->d=$request->editor2;
        $data->c=$request->editor3;
        $data->a=$request->editor4;
        $data->save();
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
                    }            
               }           
               $success=docpdca::insert($insert);
            }
        return $success;
    }
    public function updatepdca(Request $request)
    {
        $validatedData = $request->validate([
            'doc_file.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx',
            ]);
            if($request->TotalFiles > 0)
            {      
               for ($x = 0; $x < $request->TotalFiles; $x++) 
               {
                   if ($request->hasFile('doc_file')) 
                    {
                        $getfile = $request->file('doc_file');
                        $path = 'public/pdca';
                        $name = $getfile[$x]->getClientOriginalName();
                        $fullfile=$path."/".$name;
                        File::delete('public/pdca/'.$name);
                        $getfile[$x]->move($path, $name);
                        $insert3=docpdca::find($request->pdca_id);
                        if (isset($insert3)) {
                            $insert3->delete();
                         }              
                        $insert[$x]['doc_file'] = $fullfile;
                        $insert[$x]['doc_name'] = $name;
                        $insert[$x]['pdca_id'] = $request->pdca_id;                     
                    }              
               } 
               docpdca::insert($insert);            
            }
        $data=PDCA::find($request->pdca_id);
        $data->p=$request->editor1;
        $data->d=$request->editor2;
        $data->c=$request->editor3;
        $data->a=$request->editor4;
        $data->save();

        return $data;
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

    /////addindicator4_3/////addindicator4_3/////addindicator4_3/////addindicator4_3/////addindicator4_3/////addindicator4_3
    public function getaddindicator4_3()
    {
        $editdata = indicator4_3::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        return view('AJ/edit4_3',compact('editdata'));
    }
    public function addindicator4_3(Request $request)
    {
        $validatedData = $request->validate([
            'doc_file1' => 'required',
            'doc_file1.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx',
            'doc_file2' => 'required',
            'doc_file2.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx'
            ]);
        $data=new indicator4_3;
        $data->course_id=session()->get('usercourse');
        $data->year_id=session()->get('year_id');
        $data->retention_rate=$request->retention_rate1;
        $data->category_retention_rate="อัตราการคงอยู่ของอาจารย์";
        $data->save();
            if($request->TotalFiles1 > 0)
            {
                    
               for ($x = 0; $x < $request->TotalFiles1; $x++) 
               {
                   if ($request->hasFile('doc_file1')) 
                    {
                        $getfile = $request->file('doc_file1');
                        $path = 'public/indicator';
                        $name = $getfile[$x]->getClientOriginalName();
                        $fullfile=$path."/".$name;
                        $getfile[$x]->move($path, $name);                 
                        $insert[$x]['doc_file'] = $fullfile;
                        $insert[$x]['doc_name'] = $name;
                        $insert[$x]['doc_id'] = $data->id;                     
                    }            
               }           
               $success=docindicator4_3::insert($insert);
            }


        $data1=new indicator4_3;
        $data1->course_id=session()->get('usercourse');
        $data1->year_id=session()->get('year_id');
        $data1->retention_rate=$request->retention_rate2;
        $data1->category_retention_rate="ความพึงพอใจของอาจารย์ต่อการบริหารหลักสูตร";
        $data1->save();
            if($request->TotalFiles1 > 0)
            {
                    
               for ($x1 = 0; $x1 < $request->TotalFiles1; $x1++) 
               {
                   if ($request->hasFile('doc_file2')) 
                    {
                        $getfile1 = $request->file('doc_file2');
                        $path1 = 'public/indicator';
                        $name1 = $getfile1[$x1]->getClientOriginalName();
                        $fullfile1=$path1."/".$name1;
                        $getfile1[$x1]->move($path1, $name1);                 
                        $insert1[$x1]['doc_file'] = $fullfile1;
                        $insert1[$x1]['doc_name'] = $name1;
                        $insert1[$x1]['doc_id'] = $data1->id;                     
                    }            
               }           
               $success1=docindicator4_3::insert($insert1);
            }
        
        return $success1;
    }
    public function updateaddindicator4_3(Request $request)
    {   
        $querymaxiddoc = docindicator4_3::whereRaw('Indicator_id = (select max(`Indicator_id`) from doc_indicator4_3)')->get();
        $validatedData = $request->validate([
            'doc_file1.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx',
            'doc_file2.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx'
            ]);
            if($request->TotalFiles1 > 0)
            {  
               for ($x = 0; $x < $request->TotalFiles1; $x++) 
               {
                   if ($request->hasFile('doc_file1')) 
                    {
                        $getfile = $request->file('doc_file1');
                        $path = 'public/indicator';
                        $name = $getfile[$x]->getClientOriginalName();
                        $fullfile=$path."/".$name;
                        File::delete('public/indicator/'.$name);
                        $getfile[$x]->move($path, $name);  
                        $insert2=docindicator4_3::find($request->id);
                        if (isset($insert2)) {
                            $insert2->delete();
                         }              
                        $insert[$x]['doc_file'] = $fullfile;
                        $insert[$x]['doc_name'] = $name;
                        $insert[$x]['doc_id'] = $request->id;                
                    }         
               } 
                 docindicator4_3::insert($insert);           
            }
            if($request->TotalFiles2 > 0)
            {      
               for ($x1 = 0; $x1 < $request->TotalFiles2; $x1++) 
               {
                   if ($request->hasFile('doc_file2')) 
                    {
                        $getfile1 = $request->file('doc_file2');
                        $path1 = 'public/indicator';
                        $name1 = $getfile1[$x1]->getClientOriginalName();
                        $fullfile1=$path1."/".$name1;
                        File::delete('public/indicator/'.$name1);
                        $getfile1[$x1]->move($path1, $name1);
                        $insert3=docindicator4_3::find($request->id2);
                        if (isset($insert3)) {
                            $insert3->delete();
                         }              
                        $insert1[$x1]['doc_file'] = $fullfile1;
                        $insert1[$x1]['doc_name'] = $name1;
                        $insert1[$x1]['doc_id'] = $request->id2;                     
                    }              
               } 
               docindicator4_3::insert($insert1);            
            }
        $data=indicator4_3::find($request->id);
        $data->retention_rate=$request->retention_rate1;
        $data->save();
        $data1=indicator4_3::find($request->id2);
        $data1->retention_rate=$request->retention_rate2;
        $data1->save();
        return $data1;
    }
    public function deleteaddindicator4_3($id)
    {
        $product = indicator4_3::find($id);
        $product1 = indicator4_3::find($id);
        $product->delete();
        $product1->delete();
        return redirect('/educational_background');
    }
    /////addindicator4_3/////addindicator4_3/////addindicator4_3/////addindicator4_3/////addindicator4_3/////addindicator4_3


}
