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
use App\indicator2_1;
use App\indicator2_2;
use App\indicator5_4;
use App\performance3_3;
use App\docindicator4_3;
use App\doc_indicator5_4;
use App\doc_performance3_3;
use App\category6_comment_course;
use App\category7_strength;
use App\category6_assessment_summary;
use App\category4_course_results;
use App\category4_activity;
use App\category7_development_proposal;
use App\category7_development_proposal_detail;
use App\category4_effectiveness;
use App\category4_notcourse_results;
use App\category5_course_manage;
use App\category4_newteacher;
use App\ModelAJ\category4_academic_performance;
use App\ModelAJ\category4_incomplete_content;
use App\in_index;
use File;
use Maatwebsite\Excel\Facades\Excel;
use App\ModelAJ\category3_inforstudent;
use App\Imports\AddstdImport;
use App\Imports\Addcourse_results;
use App\Imports\Addstrength;
use App\category3_GD;
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
    /////addinfostd/////addinfostd/////addinfostd/////addinfostd/////addinfostd/////addinfostd

    function addinfostd(Request $request)
    {
     $this->validate($request, [
      'infostd'  => 'required|mimes:xls,xlsx'
     ]);

     $path = $request->file('infostd')->getRealPath();

     $data = Excel::import(new AddstdImport,$path);
        
     return true;
    }
    /////addfactor/////addfactor/////addfactor/////addfactor/////addfactor/////addfactor
    public function getfactor($id)
    {
        $editdata = category3_GD::where('id',$id)
        ->where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        return view('AJ/editfactor',compact('editdata'));
    }
    function addfactor(Request $request)
    {
        $data=new category3_GD;
        $data->course_id=session()->get('usercourse');
        $data->year_id=session()->get('year_id');
        $data->factor=$request->factor;
        $data->category_factor=$request->category_factor;
        $data->save();     
        return $data;
    }
    function updatefactor(Request $request)
    {
        $data=category3_GD::find($request->id);
        $data->factor=$request->factor;
        $data->save();     
        return $data;
    }
    /////addfactor/////addfactor/////addfactor/////addfactor/////addfactor/////addfactor

    /////indicator2_1/////indicator2_1/////indicator2_1/////indicator2_1/////indicator2_1/////indicator2_1
    public function getindicator2_1($id)
    {
        $editdata = indicator2_1::where('id',$id)
        ->where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        return view('AJ/editindicator2-1',compact('editdata'));
    }
    function addindicator2_1(Request $request)
    {
        $data=new indicator2_1;
        $data->course_id=session()->get('usercourse');
        $data->year_id=session()->get('year_id');
        $data->qtyall=$request->qtyall;
        $data->qtyrate=$request->qtyrate;
        $data->persen=$request->persen;
        $data->sumscore=$request->sumscore;
        $data->resultscore=$request->resultscore;
        $data->save();     
        return $data;
    }
    function updateindicator2_1(Request $request)
    {
        $data=indicator2_1::find($request->id);
        $data->qtyall=$request->qtyall;
        $data->qtyrate=$request->qtyrate;
        $data->persen=$request->persen;
        $data->sumscore=$request->sumscore;
        $data->resultscore=$request->resultscore;
        $data->save();     
        return $data;
    }
    /////indicator2_1/////indicator2_1/////indicator2_1/////indicator2_1/////indicator2_1/////indicator2_1

     /////indicator2_1/////indicator2_1/////indicator2_1/////indicator2_1/////indicator2_1/////indicator2_1
     public function getindicator2_2($id)
     {
         $editdata = indicator2_2::where('id',$id)
         ->where('course_id',session()->get('usercourse'))
         ->where('year_id',session()->get('year_id'))
         ->get();
         return view('AJ/editindicator2-2',compact('editdata'));
     }
     function addindicator2_2(Request $request)
     {
         $data=new indicator2_2;
         $data->course_id=session()->get('usercourse');
         $data->year_id=session()->get('year_id');
         $data->total=$request->total;
         $data->totalpersen=$request->totalpersen;
         $data->answer=$request->answer;
         $data->answerpersen=$request->answerpersen;
         $data->job=$request->job;
         $data->jobpersen=$request->jobpersen;
         $data->straight_line=$request->straight_line;
         $data->straight_linepersen=$request->straight_linepersen;
         $data->not_straight_line=$request->not_straight_line;
         $data->not_straight_linepersen=$request->not_straight_linepersen;
         $data->freelance=$request->freelance;
         $data->freelancepersen=$request->freelancepersen;
         $data->before=$request->before;
         $data->beforepersen=$request->beforepersen;
         $data->continue_study=$request->continue_study;
         $data->continue_studypersen=$request->continue_studypersen;
         $data->ordain=$request->ordain;
         $data->ordainpersen=$request->ordainpersen;
         $data->soldier=$request->soldier;
         $data->soldierpersen=$request->soldierpersen;
         $data->unemployed=$request->unemployed;
         $data->unemployedpersen=$request->unemployedpersen;
         $data->result=$request->result;
         $data->save();     
         return $data;
     }
     function updateindicator2_2(Request $request)
     {
         $data=indicator2_2::find($request->id);
         $data->total=$request->total;
         $data->totalpersen=$request->totalpersen;
         $data->answer=$request->answer;
         $data->answerpersen=$request->answerpersen;
         $data->job=$request->job;
         $data->jobpersen=$request->jobpersen;
         $data->straight_line=$request->straight_line;
         $data->straight_linepersen=$request->straight_linepersen;
         $data->not_straight_line=$request->not_straight_line;
         $data->not_straight_linepersen=$request->not_straight_linepersen;
         $data->freelance=$request->freelance;
         $data->freelancepersen=$request->freelancepersen;
         $data->before=$request->before;
         $data->beforepersen=$request->beforepersen;
         $data->continue_study=$request->continue_study;
         $data->continue_studypersen=$request->continue_studypersen;
         $data->ordain=$request->ordain;
         $data->ordainpersen=$request->ordainpersen;
         $data->soldier=$request->soldier;
         $data->soldierpersen=$request->soldierpersen;
         $data->unemployed=$request->unemployed;
         $data->unemployedpersen=$request->unemployedpersen;
         $data->result=$request->result;
         $data->save();     
         return $data;
     }
     /////indicator2_1/////indicator2_1/////indicator2_1/////indicator2_1/////indicator2_1/////indicator2_1

     /////addindicator3_3/////addindicator3_3/////addindicator3_3/////addindicator3_3/////addindicator3_3/////addindicator3_3
    public function getindicator3_3()
    {
        $editdata = performance3_3::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        return view('AJ/edit3_3',compact('editdata'));
    }
    public function addindicator3_3(Request $request)
    {
        $validatedData = $request->validate([
            'doc_file1' => 'required',
            'doc_file1.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx',
            'doc_file2' => 'required',
            'doc_file2.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx',
            'doc_file3' => 'required',
            'doc_file3.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx'
            ]);
        $data=new performance3_3;
        $data->course_id=session()->get('usercourse');
        $data->year_id=session()->get('year_id');
        $data->retention_rate=$request->retention_rate1;
        $data->category_retention_rate="อัตราการคงอยู่ของนักศึกษา";
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
               $success=doc_performance3_3::insert($insert);
            }


        $data1=new performance3_3;
        $data1->course_id=session()->get('usercourse');
        $data1->year_id=session()->get('year_id');
        $data1->retention_rate=$request->retention_rate2;
        $data1->category_retention_rate="การสำเร็จการศึกษา";
        $data1->save();
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
                        $getfile1[$x1]->move($path1, $name1);                 
                        $insert1[$x1]['doc_file'] = $fullfile1;
                        $insert1[$x1]['doc_name'] = $name1;
                        $insert1[$x1]['doc_id'] = $data1->id;                     
                    }            
               }           
               $success1=doc_performance3_3::insert($insert1);
            }

        $data2=new performance3_3;
        $data2->course_id=session()->get('usercourse');
        $data2->year_id=session()->get('year_id');
        $data2->retention_rate=$request->retention_rate3;
        $data2->category_retention_rate="ความพึงพอใจและผลการจัดการข้อร้องเรียนของนักศึกษา";
        $data2->save();
            if($request->TotalFiles3 > 0)
            {
                    
               for ($x2 = 0; $x2 < $request->TotalFiles3; $x2++) 
               {
                   if ($request->hasFile('doc_file3')) 
                    {
                        $getfile2 = $request->file('doc_file3');
                        $path2 = 'public/indicator';
                        $name2 = $getfile2[$x2]->getClientOriginalName();
                        $fullfile2=$path2."/".$name2;
                        $getfile2[$x2]->move($path2, $name2);                 
                        $insert2[$x2]['doc_file'] = $fullfile2;
                        $insert2[$x2]['doc_name'] = $name2;
                        $insert2[$x2]['doc_id'] = $data2->id;                     
                    }            
               }           
               $success2=doc_performance3_3::insert($insert2);
            }
        
        return $success2;
    }
    public function updateindicator3_3(Request $request)
    {   
        $validatedData = $request->validate([
            'doc_file1.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx',
            'doc_file2.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx',
            'doc_file3.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx'
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
                        $insert2=doc_performance3_3::find($request->id);
                        if (isset($insert2)) {
                            $insert2->delete();
                         }              
                        $insert[$x]['doc_file'] = $fullfile;
                        $insert[$x]['doc_name'] = $name;
                        $insert[$x]['doc_id'] = $request->id;                
                    }         
               } 
               doc_performance3_3::insert($insert);           
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
                        $insert3=doc_performance3_3::find($request->id2);
                        if (isset($insert3)) {
                            $insert3->delete();
                         }              
                        $insert1[$x1]['doc_file'] = $fullfile1;
                        $insert1[$x1]['doc_name'] = $name1;
                        $insert1[$x1]['doc_id'] = $request->id2;                     
                    }              
               } 
               doc_performance3_3::insert($insert1);            
            }
            if($request->TotalFiles3 > 0)
            {      
               for ($x2 = 0; $x2 < $request->TotalFiles3; $x2++) 
               {
                   if ($request->hasFile('doc_file3')) 
                    {
                        $getfile2 = $request->file('doc_file3');
                        $path2 = 'public/indicator';
                        $name2 = $getfile2[$x2]->getClientOriginalName();
                        $fullfile2=$path2."/".$name2;
                        File::delete('public/indicator/'.$name2);
                        $getfile2[$x2]->move($path2, $name2);
                        $insert3=doc_performance3_3::find($request->id3);
                        if (isset($insert3)) {
                            $insert3->delete();
                         }              
                        $insert2[$x2]['doc_file'] = $fullfile2;
                        $insert2[$x2]['doc_name'] = $name2;
                        $insert2[$x2]['doc_id'] = $request->id3;                     
                    }              
               } 
               doc_performance3_3::insert($insert2);            
            }
        $data=performance3_3::find($request->id);
        $data->retention_rate=$request->retention_rate1;
        $data->save();
        $data1=performance3_3::find($request->id2);
        $data1->retention_rate=$request->retention_rate2;
        $data1->save();
        $data2=performance3_3::find($request->id3);
        $data2->retention_rate=$request->retention_rate3;
        $data2->save();
        return $data2;
    }
    /////addindicator3_3/////addindicator3_3/////addindicator3_3/////addindicator3_3/////addindicator3_3/////addindicator3_3

    /////addcourse_results/////addcourse_results/////addcourse_results/////addcourse_results/////addcourse_results/////addcourse_results
    public function getcourse_results()
    {
        return view('AJ/editcourse_results');
    }
    function addcourse_results(Request $request)
    {
     $this->validate($request, [
      'infostd'  => 'required|mimes:xls,xlsx'
     ]);

     $path = $request->file('infostd')->getRealPath();

     $data = Excel::import(new Addcourse_results,$path);
        
     return true;
    }
    public function updatecourse_results(Request $request)
    {
        $getdata=category4_course_results::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'));
        $getdata->delete();
        
        $this->validate($request, [
            'infostd'  => 'required|mimes:xls,xlsx'
           ]);
      
           $path = $request->file('infostd')->getRealPath();
      
           $data = Excel::import(new Addcourse_results,$path);
              
           return true;
    }
     /////addcourse_results/////addcourse_results/////addcourse_results/////addcourse_results/////addcourse_results/////addcourse_results

     /////addindicator5_4/////addindicator5_4/////addindicator5_4/////addindicator5_4/////addindicator5_4/////addindicator5_4
    public function getindicator5_4($id)
    {
        $get=in_index::all();
        $check=indicator5_4::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $query=indicator5_4::where('id',$id)
        ->where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $getdata[0]=0;
        $getdata[1]=0;
        $getdata[2]=0;
        $getdata[3]=0;
        $getdata[4]=0;
        $getdata[5]=0;
        $getdata[6]=0;
        $getdata[7]=0;
        $getdata[8]=0;
        $getdata[9]=0;
        $getdata[10]=0;
        $getdata[11]=0;
        $getdata[12]=0;
        foreach($check as $key=>$row){
                $getdata[$key]=$row['category'];          
        }
        if($query[0]['status']==1){
            $status1=1;
            $status2=0;
        }
        else{
            $status1=0;
            $status2=1;
        }
        
        return view('AJ/edit5_4',compact('get','getdata','query','status1','status2'));
    }
    public function addindicator5_4(Request $request)
    {
        $validatedData = $request->validate([
            'doc_file' => 'required',
            'doc_file.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx',
            ]);
        $data=new indicator5_4;
        $data->course_id=session()->get('usercourse');
        $data->year_id=session()->get('year_id');
        $data->performance=$request->performance;
        $data->status=$request->status;
        $data->category=$request->category;
        $data->save();
            if($request->TotalFiles > 0)
            {
                    
               for ($x = 0; $x < $request->TotalFiles; $x++) 
               {
                   if ($request->hasFile('doc_file')) 
                    {
                        $getfile = $request->file('doc_file');
                        $path = 'public/indicator';
                        $name = $getfile[$x]->getClientOriginalName();
                        $fullfile=$path."/".$name;
                        $getfile[$x]->move($path, $name);                 
                        $insert[$x]['doc_file'] = $fullfile;
                        $insert[$x]['doc_name'] = $name;
                        $insert[$x]['doc_id'] = $data->id;                     
                    }            
               }           
               $success=doc_indicator5_4::insert($insert);
            }
        return $success;
    }
    public function updateindicator5_4(Request $request)
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
                        $path = 'public/indicator';
                        $name = $getfile[$x]->getClientOriginalName();
                        $fullfile=$path."/".$name;
                        File::delete('public/indicator/'.$name);
                        $getfile[$x]->move($path, $name);  
                        $insert2=doc_indicator5_4::find($request->id);
                        if (isset($insert2)) {
                            $insert2->delete();
                         }              
                        $insert[$x]['doc_file'] = $fullfile;
                        $insert[$x]['doc_name'] = $name;
                        $insert[$x]['doc_id'] = $request->id;                
                    }         
               } 
               doc_indicator5_4::insert($insert);           
            }
        $data=indicator5_4::find($request->id);
        $data->performance=$request->performance;
        $data->status=$request->status;
        $data->category=$request->category;
        $data->save();
        return $data;
    }
    /////addindicator5_4/////addindicator5_4/////addindicator5_4/////addindicator5_4/////addindicator5_4/////addindicator5_4

    /////academic_performance/////academic_performance/////academic_performance/////academic_performance/////academic_performance/////academic_performance
    public function getacademic_performance()
    {
        $editdata=category4_academic_performance::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        return view('AJ/editacademic_performance',compact('editdata'));
    }
    function addacademic_performance(Request $request)
    {
        $data=new category4_academic_performance;
        $data->code_name=$request->code_name;
        $data->term=$request->term;
        $data->anomaly=$request->anomaly;
        $data->tocheck=$request->tocheck;
        $data->reason=$request->reason;
        $data->plan_update=$request->plan_update;
        $data->course_id=session()->get('usercourse');
        $data->year_id=session()->get('year_id');
        $data->save();

     return $data;
    }
    public function updateacademic_performance(Request $request)
    {
        $data=category4_academic_performance::find($request->id);
        $data->code_name=$request->code_name;
        $data->term=$request->term;
        $data->anomaly=$request->anomaly;
        $data->tocheck=$request->tocheck;
        $data->reason=$request->reason;
        $data->plan_update=$request->plan_update;
        $data->save();
              
        return $data;
    }
     /////academic_performance/////academic_performance/////academic_performance/////academic_performance/////academic_performance/////academic_performance

     /////not_offered/////not_offered/////not_offered/////not_offered/////not_offered/////not_offered
    public function getnot_offered()
    {
        $editdata=category4_notcourse_results::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        return view('AJ/editnot_offered',compact('editdata'));
    }
    function addnot_offered(Request $request)
    {
        $data=new category4_notcourse_results;
        $data->code_name=$request->code_name;
        $data->term=$request->term;
        $data->description=$request->description;
        $data->measure=$request->measure;
        $data->course_id=session()->get('usercourse');
        $data->year_id=session()->get('year_id');
        $data->save();

     return $data;
    }
    public function updatenot_offered(Request $request)
    {
        $data=category4_notcourse_results::find($request->id);
        $data->code_name=$request->code_name;
        $data->term=$request->term;
        $data->description=$request->description;
        $data->measure=$request->measure;
        $data->save();
              
        return $data;
    }
    /////not_offered/////not_offered/////not_offered/////not_offered/////not_offered/////not_offered

    /////incomplete_content/////incomplete_content/////incomplete_content/////incomplete_content/////incomplete_content/////incomplete_content
    public function getincomplete_content()
    {
        $editdata=category4_incomplete_content::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        return view('AJ/editincomplete_content',compact('editdata'));
    }
    function addincomplete_content(Request $request)
    {
        $data=new category4_incomplete_content;
        $data->code_name=$request->code_name;
        $data->term=$request->term;
        $data->topic=$request->topic;
        $data->untraceable=$request->untraceable;
        $data->plan_update=$request->plan_update;
        $data->course_id=session()->get('usercourse');
        $data->year_id=session()->get('year_id');
        $data->save();

     return $data;
    }
    public function updateincomplete_content(Request $request)
    {
        $data=category4_incomplete_content::find($request->id);
        $data->code_name=$request->code_name;
        $data->term=$request->term;
        $data->topic=$request->topic;
        $data->untraceable=$request->untraceable;
        $data->plan_update=$request->plan_update;
        $data->save();
              
        return $data;
    }
     /////incomplete_content/////incomplete_content/////incomplete_content/////incomplete_content/////incomplete_content/////incomplete_content

      /////effectiveness/////effectiveness/////effectiveness/////effectiveness/////effectiveness/////effectiveness
    public function geteffectiveness($id)
    {
        $editdata=category4_effectiveness::where('id',$id)
        ->get();
        return view('AJ/editeffectiveness',compact('editdata'));
    }
    function addeffectiveness(Request $request)
    {
        $data=new category4_effectiveness;
        $data->learning_standards=$request->learning_standards;
        $data->comment=$request->comment;
        $data->solution=$request->solution;
        $data->course_id=session()->get('usercourse');
        $data->year_id=session()->get('year_id');
        $data->save();

     return $data;
    }
    public function updateeffectiveness(Request $request)
    {
        $data=category4_effectiveness::find($request->id);
        $data->learning_standards=$request->learning_standards;
        $data->comment=$request->comment;
        $data->solution=$request->solution;
        $data->save();
              
        return $data;
    }
     /////effectiveness/////effectiveness/////effectiveness/////effectiveness/////effectiveness/////effectiveness

      /////teacher_orientation/////teacher_orientation/////teacher_orientation/////teacher_orientation/////teacher_orientation/////teacher_orientation
    public function getteacher_orientation($id)
    {
        $editdata=category4_newteacher::where('id',$id)
        ->get();
        $check=$editdata[0]['point_out'];
        return view('AJ/editteacher_orientation',compact('editdata','check'));
    }
    function addteacher_orientation(Request $request)
    {
        $data=new category4_newteacher;
        $data->point_out=$request->point_out;
        $data->new_teacher_qty=$request->new_teacher_qty;
        $data->teacher_point_out_qty=$request->teacher_point_out_qty;
        $data->course_id=session()->get('usercourse');
        $data->year_id=session()->get('year_id');
        $data->save();

     return $data;
    }
    public function updateteacher_orientation(Request $request)
    {
        $data=category4_newteacher::find($request->id);
        $data->point_out=$request->point_out;
        if(isset($request->new_teacher_qty)){
            $data->new_teacher_qty=$request->new_teacher_qty;
        }
        else{
            $data->new_teacher_qty="";
        }
        if(isset($request->teacher_point_out_qty)){
            $data->teacher_point_out_qty=$request->teacher_point_out_qty;
        }
        else{
            $data->teacher_point_out_qty="";
        }
        $data->save();
              
        return $data;
    }
     /////teacher_orientation/////teacher_orientation/////teacher_orientation/////teacher_orientation/////teacher_orientation/////teacher_orientation

      /////activity/////activity/////activity/////activity/////activity/////activity
    public function getactivity($id)
    {
        $editdata=category4_activity::where('id',$id)
        ->get();
        $check=$editdata[0]['status'];
        return view('AJ/editactivity',compact('editdata','check'));
    }
    function addactivity(Request $request)
    {
        $data=new category4_activity;
        $data->organized_activities=$request->organized_activities;
        $data->status=$request->status;
        $data->comment=$request->comment;
        $data->course_id=session()->get('usercourse');
        $data->year_id=session()->get('year_id');
        $data->save();

     return $data;
    }
    public function updateactivity(Request $request)
    {
        $data=category4_activity::find($request->id);
        $data->organized_activities=$request->organized_activities;
        $data->status=$request->status;
        $data->comment=$request->comment;
        $data->save();
              
        return $data;
    }
     /////activity/////activity/////activity/////activity/////activity/////activity

     /////course_manage/////course_manage/////course_manage/////course_manage/////course_manage/////course_manage
    public function getcourse_manage($id)
    {
        $editdata=category5_course_manage::where('id',$id)
        ->get();
        return view('AJ/editcourse_manage',compact('editdata'));
    }
    function addcourse_manage(Request $request)
    {
        $data=new category5_course_manage;
        $data->problem=$request->problem;
        $data->effect=$request->effect;
        $data->solution=$request->solution;
        $data->course_id=session()->get('usercourse');
        $data->year_id=session()->get('year_id');
        $data->save();

     return $data;
    }
    public function updatecourse_manage(Request $request)
    {
        $data=category5_course_manage::find($request->id);
        $data->problem=$request->problem;
        $data->effect=$request->effect;
        $data->solution=$request->solution;
        $data->save();
              
        return $data;
    }
     /////activity/////activity/////activity/////activity/////activity/////activity

     /////comment-course/////comment-course/////comment-course/////comment-course/////comment-course/////comment-course
    public function getcomment_course($id)
    {
        $editdata=category6_comment_course::where('id',$id)
        ->get();
        return view('AJ/editcomment_course',compact('editdata'));
    }
    function addcomment_course(Request $request)
    {
        $data=new category6_comment_course;
        $data->comment_assessor=$request->comment_assessor;
        $data->comment_course_responsible_person=$request->comment_course_responsible_person;
        $data->update_course=$request->update_course;
        $data->course_id=session()->get('usercourse');
        $data->year_id=session()->get('year_id');
        $data->save();

     return $data;
    }
    public function updatecomment_course(Request $request)
    {
        $data=category6_comment_course::find($request->id);
        $data->comment_assessor=$request->comment_assessor;
        $data->comment_course_responsible_person=$request->comment_course_responsible_person;
        $data->update_course=$request->update_course;
        $data->save();
              
        return $data;
    }
     /////comment-course/////comment-course/////comment-course/////comment-course/////comment-course/////comment-course

     
     /////assessment_summary////assessment_summary/////assessment_summary/////assessment_summary/////assessment_summary/////assessment_summary
    public function getassessment_summary($id)
    {
        $editdata=category6_assessment_summary::where('id',$id)
        ->get();
        return view('AJ/editassessment_summary',compact('editdata'));
    }
    function addassessment_summary(Request $request)
    {
        $data=new category6_assessment_summary;
        $data->category_assessor=$request->category_assessor;
        $data->evaluation_results=$request->evaluation_results;
        $data->comment_faculty=$request->comment_faculty;
        $data->change_proposal=$request->change_proposal;
        $data->course_id=session()->get('usercourse');
        $data->year_id=session()->get('year_id');
        $data->save();

     return $data;
    }
    public function updateassessment_summary(Request $request)
    {
        $data=category6_assessment_summary::find($request->id);
        $data->evaluation_results=$request->evaluation_results;
        $data->comment_faculty=$request->comment_faculty;
        $data->change_proposal=$request->change_proposal;
        $data->save();
              
        return $data;
    }
     /////assessment_summary/////assessment_summary/////assessment_summary/////assessment_summary/////assessment_summary/////assessment_summary

     /////getstrength/////getstrength/////getstrength/////getstrength/////getstrength/////getstrength
    public function getstrength()
    {
        return view('AJ/editstrength');
    }
    function addstrength(Request $request)
    {
     $this->validate($request, [
      'infostd'  => 'required|mimes:xls,xlsx'
     ]);

     $path = $request->file('infostd')->getRealPath();

     $data = Excel::import(new Addstrength,$path);
        
     return true;
    }
    public function updatestrength(Request $request)
    {
        $getdata=category7_strength::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'));
        $getdata->delete();
        
        $this->validate($request, [
            'infostd'  => 'required|mimes:xls,xlsx'
           ]);
      
           $path = $request->file('infostd')->getRealPath();
      
           $data = Excel::import(new Addstrength,$path);
              
           return true;
    }
     /////getstrength/////getstrength/////getstrength/////getstrength/////getstrength/////getstrength

     /////development_proposal////development_proposal/////development_proposal/////development_proposal/////development_proposal/////development_proposal
    public function getdevelopment_proposal($id)
    {
        $editdata=category7_development_proposal::where('id',$id)
        ->get();
        return view('AJ/editdevelopment_proposal',compact('editdata'));
    }
    function adddevelopment_proposal(Request $request)
    {
        $data=new category7_development_proposal;
        $data->topic=$request->topic;
        $data->course_id=session()->get('usercourse');
        $data->year_id=session()->get('year_id');
        $data->save();
        foreach($request->detail as $value){
            $row=new category7_development_proposal_detail;
            $row->detail=$value;
            $row->proposal_id =$data->id;
            $row->save();
        }
     return $data;
    }
    public function updatedevelopment_proposal(Request $request)
    {
        $data=category7_development_proposal::find($request->getid);
        $data->topic=$request->topic;
        $data->save();
        foreach($request->detail as $key=>$value){
            $row=category7_development_proposal_detail::find($request->id[$key+1]);
            $row->detail=$value;
            $row->save();
        }      
        return $data;
    }
     /////development_proposal/////development_proposal/////development_proposal/////development_proposal/////development_proposal/////development_proposal
}
