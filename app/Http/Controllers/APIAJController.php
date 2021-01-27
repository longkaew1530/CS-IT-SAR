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
use App\performance3_3;
use App\docindicator4_3;
use App\doc_performance3_3;
use App\category4_course_results;
use File;
use Maatwebsite\Excel\Facades\Excel;
use App\ModelAJ\category3_inforstudent;
use App\Imports\AddstdImport;
use App\Imports\Addcourse_results;
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
}
