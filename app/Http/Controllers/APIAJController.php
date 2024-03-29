<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelAJ\Educational_background;
use App\ModelAJ\Research_results;
use App\ModelAJ\Research_results_user;
use App\ModelAJ\past_performance;
use App\ModelAJ\categoty_researh;
use App\User;
use App\publish_work;
use App\publish_work_user;
use App\PDCA;
use App\user_permission_status;
use App\category4_teaching_quality;
use App\Year;
use App\Course;
use App\user_permission;
use App\docpdca;
use App\category3_resignation;
use App\course_responsible_teacher;
use App\indicator4_3;
use App\course_teacher;
use App\indicator2_1;
use App\indicator1_1;
use App\defaulindicator;
use App\indicator2_2;
use App\category;
use App\composition;
use App\category3_infostudent_qty;
use App\year_acceptance_graduate;
use App\year_acceptance;
use App\category3_graduate;
use App\indicator5_4;
use App\performance3_3;
use App\indicator;
use App\docindicator4_3;
use App\doc_indicator5_4;
use App\doc_performance3_3;
use App\category6_comment_course;
use App\category7_strength;
use App\category7_newstrength;
use App\category3_infostudent;
use App\category6_assessment_summary;
use App\category4_course_results;
use App\category4_activity;
use App\category7_strengths_summary;
use App\category7_development_proposal;
use App\category7_development_proposal_detail;
use App\category4_effectiveness;
use App\category4_notcourse_results;
use App\category5_course_manage;
use App\assessment_results;
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
use App\Imports\Addnewstrength;
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
        return $data;
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
        return $data;
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
        $data = Research_results::join('research_results_user','research_results.research_results_id','=','research_results_user.research_results_research_results_id')
        ->join('users','research_results_user.user_id','=','users.id')
        ->where('research_results_user.research_results_research_results_id',$id)
        ->get();
        return $data;
    }
    public function addresearch_results(Request $request)
    {
        $getdata=$request->all();

        $contractDateBegin = date('Y-m-d', strtotime($request->research_results_date));
        $contractDateEnd = date('Y-m-d', strtotime($request->research_results_date2));
            
        if ($contractDateBegin>=$contractDateEnd){
            return false;
        }

        if(isset($getdata['teacher_name'])){
            $countgetname=count($getdata['teacher_name']);
        }
        $getname=User::where('id',$request->owner)
        ->get();
        $text=$getname[0]['user_fullname'];
        $i=1;
        if(isset($getdata['teacher_name'])){
        foreach($getdata['teacher_name'] as $row){
            $query=User::find($row);
            if($i!=$countgetname){
                $text=$text.", ".$query->user_fullname;
            }
            else{
                $text=$text." และ".$query->user_fullname;
            }
            $i++;
        }
    }
    
        
        $data=new Research_results;
        $date = explode('-', $request->research_results_date);
        $geti=(int)$date[0];
        $data->research_results_year=$geti;
        $data->owner=$request->owner;
        $data->teacher_name=$text;
        $data->research_results_category=$request->research_results_category;
        $data->research_results_date=$request->research_results_date;
        $data->research_results_date2=$request->research_results_date2;
        $data->research_results_name=$request->research_results_name;
        $data->research_results_source_salary=$request->research_results_source_salary;
        $data->source_salary=$request->source_salary;
        $data->research_results_salary=$request->research_results_salary;
        $data->save();

        $insert3=new Research_results_user;
        $insert3->research_results_research_results_id=$data->research_results_id;
        $insert3->user_id=$request->owner;
        $insert3->save();
        if(isset($getdata['teacher_name'])){
        foreach($getdata['teacher_name'] as $row){
            $query=User::find($row);
            $insert=new Research_results_user;
            $insert->research_results_research_results_id=$data->research_results_id;
            $insert->user_id=$row;
            $insert->save();
        }
    }
     return $insert3;
    }
    public function updateresearch_results(Request $request)
    {
        $getdata=$request->all();
        $contractDateBegin = date('Y-m-d', strtotime($request->research_results_date));
        $contractDateEnd = date('Y-m-d', strtotime($request->research_results_date2));
            
        if ($contractDateBegin>=$contractDateEnd){
            return false;
        }
        if(isset($getdata['teacher_name'])){
        $countgetname=count($getdata['teacher_name']);
        }
        $getname=User::where('id',$request->owner)
        ->get();
        $text=$getname[0]['user_fullname'];
        $i=1;
        if(isset($getdata['teacher_name'])){
        foreach($getdata['teacher_name'] as $row){
            $query=User::find($row);
            if($i!=$countgetname){
                $text=$text.", ".$query->user_fullname;
            }
            else{
                $text=$text." และ".$query->user_fullname;
            }
            $i++;
        }
        }
        
        $data=Research_results::find($request->id);
        $date = explode('-', $request->research_results_date);
        $geti=(int)$date[0];
        $data->research_results_year=$geti;
        $data->owner=$request->owner;
        $data->teacher_name=$text;
        $data->research_results_category=$request->research_results_category;
        $data->research_results_date=$request->research_results_date;
        $data->research_results_date2=$request->research_results_date2;
        $data->research_results_name=$request->research_results_name;
        $data->research_results_source_salary=$request->research_results_source_salary;
        $data->research_results_salary=$request->research_results_salary;
        $data->source_salary=$request->source_salary;
        $data->save();
        $checkdata=Research_results_user::where('research_results_research_results_id',$request->id);
        if($checkdata!="[]"){
            $checkdata->delete();
        }
        $insert3=new Research_results_user;
        $insert3->research_results_research_results_id=$data->research_results_id;
        $insert3->user_id=$request->owner;
        $insert3->save();
        if(isset($getdata['teacher_name'])){
        foreach($getdata['teacher_name'] as $row){
            $query=User::find($row);
            $insert=new Research_results_user;
            $insert->research_results_research_results_id=$data->research_results_id;
            $insert->user_id=$row;
            $insert->save();
        }
        }
        return $insert3;
    }
    public function deleteresearch_results($id)
    {
        $product = Research_results::find($id);
        $product1 = Research_results_user::find($id);
        $product->delete();
        $product1->delete();
        return $product1;
    }
    /////ผลงานวิจัย/////ผลงานวิจัย/////ผลงานวิจัย/////ผลงานวิจัย/////ผลงานวิจัย/////ผลงานวิจัย

    /////เผยแพร่ผลงาน/////เผยแพร่ผลงาน/////เผยแพร่ผลงาน/////เผยแพร่ผลงาน/////เผยแพร่ผลงาน/////เผยแพร่ผลงาน
    public function getpublish_work($id)
    {
        $data = publish_work::join('publish_work_user','publish_work.publish_id','=','publish_work_user.publish_work_publish_id')
        ->join('users','publish_work_user.user_id','=','users.id')
        ->where('publish_work_user.publish_work_publish_id',$id)
        ->get();
        return $data;
    }
    public function addpublish_work(Request $request)
    {
        $getdata=$request->all();

        if($request->checkinfo==1){
            $contractDateBegin = date('Y-m-d', strtotime($request->publish_work_year));
            $contractDateEnd = date('Y-m-d', strtotime($request->publish_work_yearnew));
                
            if ($contractDateBegin>=$contractDateEnd){
                return false;
            }
        }
        else{
            $contractDateBegin = date('Y-m-d', strtotime($request->publish_work_yearanddate2));
            $contractDateEnd = date('Y-m-d', strtotime($request->publish_work_yearnew2));
                
            if ($contractDateBegin>=$contractDateEnd){
                return false;
            }
        }

        
        if(isset($getdata['teacher_name'])){
            $countgetname=count($getdata['teacher_name']);
        }
        if(isset($getdata['teacher_name2'])){
            $countgetname=count($getdata['teacher_name2']);
        }
        $getname=User::where('id',$request->owner)
        ->get();
        $text="";
        $i=1;
        if(isset($getdata['teacher_name'])){
        foreach($getdata['teacher_name'] as $row){
            $query=User::find($row);
            if($i!=$countgetname){
                $text=$text.$query->user_fullname.", ";
            }
            else{
                $text=$text." และ".$query->user_fullname;
            }
            $i++;
        }
        }
        if(isset($getdata['teacher_name2'])){
            foreach($getdata['teacher_name2'] as $row){
                $query=User::find($row);
                if($i!=$countgetname){
                    $text=$text.$query->user_fullname.", ";
                }
                else{
                    $text=$text." และ".$query->user_fullname;
                }
                $i++;
            }
            }
        $data=new publish_work;
        if($request->checkinfo==1){
            if(isset($request->owner)){
                $data->owner=$request->owner;
            }
            else{
                $data->owner=$request->owner2;
            }
            
            $data->teacher_name=$text;
            $data->category_publish_work=$request->category_publish_work;
            $date = explode('/', $request->publish_work_yearnew);
            $geti=(int)$date[0];
            if($geti<=2500){
                $gety=$geti+543;
            }
            else{
                $gety=$geti;
            }
            $data->publish_work_year=$gety;
            $data->publish_work_yearshow=$request->publish_work_yearnew;
            $data->publish_work_yearanddate=$request->publish_work_year;
            $data->publish_work_yearanddate2=$request->publish_work_yearnew;
            $data->publish_work_name=$request->publish_work_name;
            $data->publish_work_issue=$request->publish_work_issue;
            $data->publish_work_page=$request->publish_work_page;
            $data->journal_name=$request->journal_name;
            $data->category=1;
            $data->save();
            if(isset($getdata['teacher_name'])){
                foreach($getdata['teacher_name'] as $row){
                    $query=User::find($row);
                    $insert=new publish_work_user;
                    $insert->publish_work_publish_id=$data->publish_id;
                    $insert->user_id=$row;
                    $insert->save();
                }
        }
        }
        else{
            $get_date=explode(" ",$request->publish_work_date2);
            if(isset($request->owner)){
                $data->owner=$request->owner;
            }
            else{
                $data->owner=$request->owner2;
            }
            $data->teacher_name=$text;
            $data->category_publish_work=$request->category_publish_work2;
            $date = explode('/', $request->publish_work_yearnew2);
            $geti=(int)$date[0];
            // if(isset($get_date[2])){
            //     $data->publish_work_year=$get_date[2];
            //     $data->publish_work_date=$request->publish_work_date2;
            // }
            // else{
            //     $data->publish_work_year=$get_date[0]+543;
            //     $data->publish_work_date=1;
            // }
            if($geti<=2500){
                $gety=$geti+543;
            }
            else{
                $gety=$geti;
            }
            $data->publish_work_year=$gety;
            $data->publish_work_yearanddate=$request->publish_work_yearanddate2;
            $data->publish_work_yearanddate2=$request->publish_work_yearnew2;
            // if(isset($request->publish_work_date2)){
            //     $data->publish_work_date=$request->publish_work_date2;
            // }
            // else{
            //     $data->publish_work_date=1;
            // }
            $getdate1 = explode("/" ,$request->publish_work_yearanddate2);
            $getdate2 = explode("/" ,$request->publish_work_yearnew2);

            if($getdate1[1]=="01"){
                $setname="มกราคม";
            }
            else if($getdate1[1]=="02"){
                $setname="กุมภาพันธ์";
            }
            else if($getdate1[1]=="03"){
                $setname="มีนาคม";
            }
            else if($getdate1[1]=="04"){
                $setname="เมษายน";
            }
            else if($getdate1[1]=="05"){
                $setname="พฤษภาคม";
            }
            else if($getdate1[1]=="06"){
                $setname="มิถุนายน";
            }
            else if($getdate1[1]=="07"){
                $setname="กรกฎาคม";
            }
            else if($getdate1[1]=="08"){
                $setname="สิงหาคม";
            }
            else if($getdate1[1]=="09"){
                $setname="กันยายน";
            }
            else if($getdate1[1]=="10"){
                $setname="ตุลาคม";
            }
            else if($getdate1[1]=="11"){
                $setname="พฤศจิกายน";
            }
            else{
                $setname="ธันวาคม";
            }
            if(isset($request->publish_work_yearnew2)){
                $getyear=(int)$getdate1[2]."-".(int)$getdate2[2]." ".$setname." ".$getdate2[0];
            }
            else{
                $getyear=(int)$getdate1[2]." ".$setname." ".$getdate1[0];
            }
            $getdate2 = explode(" " ,$request->journal_name5);
            if($getdate2[0]=="Proceedings"){
                $data->publish_work_date="1";
            }
            else{
                $data->publish_work_date=$getyear;
            }
            
            $data->publish_work_name=$request->publish_work_name2;
            $data->journal_name=$request->journal_name5;
            $data->publish_work_page=$request->publish_work_page2;
            $data->publish_work_place=$request->publish_work_place2;
            $data->province=$request->province;
            $data->country=$request->country;
            $data->category=0;
            $data->save();
            if(isset($getdata['teacher_name2'])){
                foreach($getdata['teacher_name2'] as $row){
                    $query=User::find($row);
                    $insert=new publish_work_user;
                    $insert->publish_work_publish_id=$data->publish_id;
                    $insert->user_id=$row;
                    $insert->save();
                }
        }  
            }
     return $insert;
    }
    public function updatepublish_work(Request $request)
    {   
        $getdata=$request->all();

        if($request->category==1){
            $contractDateBegin = date('Y-m-d', strtotime($request->publish_work_year));
            $contractDateEnd = date('Y-m-d', strtotime($request->publish_work_yearnew));
                
            if ($contractDateBegin>=$contractDateEnd){
                return false;
            }
        }
        else{
            $contractDateBegin = date('Y-m-d', strtotime($request->publish_work_yearanddate3));
            $contractDateEnd = date('Y-m-d', strtotime($request->publish_work_yearnew3));
                
            if ($contractDateBegin>=$contractDateEnd){
                return false;
            }
        }

        if(isset($getdata['teacher_name3'])){
            $countgetname=count($getdata['teacher_name3']);
        }
        if(isset($getdata['teacher_name4'])){
            $countgetname=count($getdata['teacher_name4']);
        }
        $getname=User::where('id',$request->owner)
        ->get();
        $text="";
        $i=1;
        if(isset($getdata['teacher_name3'])){
        foreach($getdata['teacher_name3'] as $row){
            $query=User::find($row);
            if($i!=$countgetname){
                $text=$text.$query->user_fullname.", ";
            }
            else{
                $text=$text." และ".$query->user_fullname;
            }
            $i++;
        }
        }
        if(isset($getdata['teacher_name4'])){
            foreach($getdata['teacher_name4'] as $row){
                $query=User::find($row);
                if($i!=$countgetname){
                    $text=$text.$query->user_fullname.", ";
                }
                else{
                    $text=$text." และ".$query->user_fullname;
                }
                $i++;
            }
            }

        $data=publish_work::find($request->id);
        if($request->category==1){
        $data->category_publish_work=$request->category_publish_work;
        $date = explode('/', $request->publish_work_yearnew);
            $geti=(int)$date[0];
            if($geti<=2500){
                $gety=$geti+543;
            }
            else{
                $gety=$geti;
            }

        $data->owner=$request->owner3;
        $data->teacher_name=$text;
        $data->publish_work_year=$gety;
        $data->publish_work_yearshow=$request->publish_work_yearnew;
        $data->publish_work_yearanddate=$request->publish_work_year;
        $data->publish_work_yearanddate2=$request->publish_work_yearnew;
        $data->publish_work_name=$request->publish_work_name;
        $data->publish_work_issue=$request->publish_work_issue;
        $data->publish_work_page=$request->publish_work_page;
        $data->journal_name=$request->journal_name;
        $data->save();
        $checkdata=publish_work_user::where('publish_work_publish_id',$request->id);
        if($checkdata!="[]"){
            $checkdata->delete();
        }
        if(isset($getdata['teacher_name3'])){
            foreach($getdata['teacher_name3'] as $row){
                $query=User::find($row);
                $insert=new publish_work_user;
                $insert->publish_work_publish_id=$data->publish_id;
                $insert->user_id=$row;
                $insert->save();
            }
        }  
        }
        else{
        $data->category_publish_work=$request->category_publish_work3;
        $data->owner=$request->owner3;
        $data->teacher_name=$text;
        $date = explode('/', $request->publish_work_yearnew3);
        $geti=(int)$date[0];

        if($geti<=2500){
            $gety=$geti+543;
        }
        else{
            $gety=$geti;
        }
        // if($request->publish_work_date3=='-'){
        //     $data->publish_work_date=1;
        // }
        // else{
        //     $data->publish_work_date=$request->publish_work_date3;
        // }
        $getdate1 = explode("/" ,$request->publish_work_yearanddate3);
            $getdate2 = explode("/" ,$request->publish_work_yearnew3);

            if($getdate1[1]=="01"){
                $setname="มกราคม";
            }
            else if($getdate1[1]=="02"){
                $setname="กุมภาพันธ์";
            }
            else if($getdate1[1]=="03"){
                $setname="มีนาคม";
            }
            else if($getdate1[1]=="04"){
                $setname="เมษายน";
            }
            else if($getdate1[1]=="05"){
                $setname="พฤษภาคม";
            }
            else if($getdate1[1]=="06"){
                $setname="มิถุนายน";
            }
            else if($getdate1[1]=="07"){
                $setname="กรกฎาคม";
            }
            else if($getdate1[1]=="08"){
                $setname="สิงหาคม";
            }
            else if($getdate1[1]=="09"){
                $setname="กันยายน";
            }
            else if($getdate1[1]=="10"){
                $setname="ตุลาคม";
            }
            else if($getdate1[1]=="11"){
                $setname="พฤศจิกายน";
            }
            else{
                $setname="ธันวาคม";
            }
            if(isset($request->publish_work_yearnew3)){
                $getyear=(int)$getdate1[2]."-".(int)$getdate2[2]." ".$setname." ".$getdate2[0];
            }
            else{
                $getyear=(int)$getdate1[2]." ".$setname." ".$getdate1[0];
            }
            $getdate2 = explode(" " ,$request->journal_name3);
            if($getdate2[0]=="Proceedings"){
                $data->publish_work_date="1";
            }
            else{
                $data->publish_work_date=$getyear;
            }

            
        $data->publish_work_year=$gety;
         $data->publish_work_yearanddate=$request->publish_work_yearanddate3;
         $data->publish_work_yearanddate2=$request->publish_work_yearnew3;
            
        $data->publish_work_name=$request->publish_work_name3;
        $data->journal_name=$request->journal_name3;
         $data->publish_work_page=$request->publish_work_page3;
         $data->publish_work_place=$request->publish_work_place3;
        $data->province=$request->province3;
        $data->country=$request->country3;
        $data->save();

        $checkdata=publish_work_user::where('publish_work_publish_id',$request->id);
        if($checkdata!="[]"){
            $checkdata->delete();
        }
        if(isset($getdata['teacher_name4'])){
            foreach($getdata['teacher_name4'] as $row){
                $query=User::find($row);
                $insert=new publish_work_user;
                $insert->publish_work_publish_id=$data->publish_id;
                $insert->user_id=$row;
                $insert->save();
            }
        }
        }

        return $data;
    }
    public function deletepublish_work($id)
    {
        $product = publish_work::find($id);
        $product1 = publish_work_user::find($id);
        $product->delete();
        $product1->delete();
        return $product1;
    }
    /////เผยแพร่ผลงาน/////เผยแพร่ผลงาน/////เผยแพร่ผลงาน/////เผยแพร่ผลงาน/////เผยแพร่ผลงาน/////เผยแพร่ผลงาน

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
        $data->branch_id=session()->get('branch_id');
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
    public function getaddindicator4_3($id)
    {
        $editdata = indicator4_3::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();

        $pdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',$id)
        ->get();
        $per1="";
        if($id=="4.2"&&$id=="2.1"&&$id=="2.2"&&$id=="5.4")
        {
            $per1="asdsadsad";
        }
        return view('AJ/edit4_3',compact('editdata','pdca','per1'));
    }
    public function addindicator4_3(Request $request)
    {
        $validatedData = $request->validate([
            'doc_file1' => 'required',
            'doc_file1.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx,doc',
            'doc_file2' => 'required',
            'doc_file2.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx,doc'
            ]);
        $data=new indicator4_3;
        $data->course_id=session()->get('usercourse');
        $data->branch_id=session()->get('branch_id');
        $data->year_id=session()->get('year_id');
        $data->retention_rate=$request->retention_rate1;
        $data->category_retention_rate="อัตราการคงอยู่ของอาจารย์";
        $data->save();
        if(count($request->doc_file1) > 0)
        {
                
           for ($x = 0; $x < count($request->doc_file1); $x++) 
           {
               if ($request->hasFile('doc_file1')) 
                {
                    $getfile = $request->file('doc_file1');
                    $path = 'public/indicator';
                    $name = $getfile[$x]->getClientOriginalName();
                    $fullfile=$path."/".$name;
                    $getfile[$x]->move($path, $name);                 
                    $insert[$x]['doc_file'] = $request->name1[$x];
                    $insert[$x]['doc_name'] = $fullfile;
                    $insert[$x]['doc_id'] = $data->id;                    
                }            
           }           
           $success=docindicator4_3::insert($insert);
        }


        $data1=new indicator4_3;
        $data1->course_id=session()->get('usercourse');
        $data1->branch_id=session()->get('branch_id');
        $data1->year_id=session()->get('year_id');
        $data1->retention_rate=$request->retention_rate2;
        $data1->category_retention_rate="ความพึงพอใจของอาจารย์ต่อการบริหารหลักสูตร";
        $data1->save();
        if(count($request->doc_file2) > 0)
        {
                
           for ($x = 0; $x < count($request->doc_file2); $x++) 
           {
               if ($request->hasFile('doc_file2')) 
                {
                    $getfile = $request->file('doc_file2');
                    $path = 'public/indicator';
                    $name = $getfile[$x]->getClientOriginalName();
                    $fullfile=$path."/".$name;
                    $getfile[$x]->move($path, $name);                 
                    $insert2[$x]['doc_file'] = $request->name2[$x];
                    $insert2[$x]['doc_name'] = $fullfile;
                    $insert2[$x]['doc_id'] = $data1->id;                    
                }            
           }           
           $success=docindicator4_3::insert($insert2);
        }
        
            $data2=new PDCA;
            $data2->Indicator_id=$request->Indicator_id;
            $data2->target=$request->target;
            $data2->performance3=$request->performance3;
            $data2->score=$request->score;
            $data2->course_id=session()->get('usercourse');
            $data2->branch_id=session()->get('branch_id');
            $data2->year_id=session()->get('year_id');
            $data2->save();
        return $data2;
    }
    public function updateaddindicator4_3(Request $request)
    {   
        $querymaxiddoc = docindicator4_3::whereRaw('Indicator_id = (select max(`Indicator_id`) from doc_indicator4_3)')->get();
        $validatedData = $request->validate([
            'doc_file1.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx,doc',
            'doc_file2.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx,doc'
            ]);
            if(isset($request->doc_file1)){
            if(count($request->doc_file1) > 0)
            {  
               for ($x = 0; $x < count($request->doc_file1); $x++) 
               {
                   if ($request->hasFile('doc_file1')) 
                    {
                        $getfile = $request->file('doc_file1');
                        $path = 'public/indicator';
                        $name = $getfile[$x]->getClientOriginalName();
                        $fullfile=$path."/".$name;
                        $getfile[$x]->move($path, $name);               
                        $insert[$x]['doc_file'] = $request->name1[$x];
                        $insert[$x]['doc_name'] = $fullfile;
                        $insert[$x]['doc_id'] = $request->id;                
                    }         
               } 
                 docindicator4_3::insert($insert);           
            }
        }
            if(isset($request->doc_file2)){
                if(count($request->doc_file2) > 0)
                {      
                   for ($x1 = 0; $x1 < count($request->doc_file2); $x1++) 
                   {
                       if ($request->hasFile('doc_file2')) 
                        {
                            $getfile1 = $request->file('doc_file2');
                            $path1 = 'public/indicator';
                            $name1 = $getfile1[$x1]->getClientOriginalName();
                            $fullfile1=$path1."/".$name1;
                            $getfile1[$x1]->move($path1, $name1);             
                            $insert1[$x1]['doc_file'] = $request->name2[$x1];
                            $insert1[$x1]['doc_name'] = $fullfile1;
                            $insert1[$x1]['doc_id'] = $request->id2;                     
                        }              
                   } 
                   docindicator4_3::insert($insert1);            
                }
            }
            
        $data=indicator4_3::find($request->id);
        $data->retention_rate=$request->retention_rate1;
        $data->save();
        $data1=indicator4_3::find($request->id2);
        $data1->retention_rate=$request->retention_rate2;
        $data1->save();
        $data2=PDCA::find($request->Indicator_id);
            $data2->target=$request->target;
            $data2->performance3=$request->performance3;
            $data2->score=$request->score;
            $data2->save();
        return $data2;
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
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        return view('AJ/editfactor',compact('editdata'));
    }
    function addfactor(Request $request)
    {
        $data=new category3_GD;
        $data->course_id=session()->get('usercourse');
        $data->branch_id=session()->get('branch_id');
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
        $editdata = indicator2_1::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $pdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',$id)
        ->where('pdca.target','!=',null)
        ->get();
        $per1="aaa";
        return view('AJ/editindicator2-1',compact('editdata','pdca','per1'));
    }
    function addindicator2_1(Request $request)
    {
        $data=new indicator2_1;
        $data->course_id=session()->get('usercourse');
        $data->branch_id=session()->get('branch_id');
        $data->year_id=session()->get('year_id');
        $data->qtyall=$request->qtyall;
        $data->qtyrate=$request->qtyrate;
        $data->persen=$request->persen;
        $data->sumscore=$request->sumscore;
        $data->resultscore=$request->resultscore;
        $data->save();    
        $data2=new PDCA;
        $data2->Indicator_id=$request->Indicator_id;
        $data2->target=$request->target;
        $data2->performance1=$request->performance1;
        $data2->performance2=$request->performance2;
        $data2->performance3=$request->performance3;
        $data2->score=$request->score;
        $data2->course_id=session()->get('usercourse');
        $data2->branch_id=session()->get('branch_id');
        $data2->year_id=session()->get('year_id');
        $data2->save(); 
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
        $data2=PDCA::find($request->Indicator_id);
            $data2->target=$request->target;
            $data2->performance1=$request->performance1;
            $data2->performance2=$request->performance2;
            $data2->performance3=$request->performance3;
            $data2->score=$request->score;
            $data2->save();   
        return $data;
    }
    /////indicator2_1/////indicator2_1/////indicator2_1/////indicator2_1/////indicator2_1/////indicator2_1

     /////indicator2_1/////indicator2_1/////indicator2_1/////indicator2_1/////indicator2_1/////indicator2_1
     public function getindicator2_2($id)
     {
         $editdata = indicator2_2::where('id',$id)
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
         $pdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',2.2)
        ->where('pdca.target','!=',null)
        ->get();
        $per1="aaa";
         return view('AJ/editindicator2-2',compact('editdata','pdca','per1'));
     }
     function addindicator2_2(Request $request)
     {
         $data=new indicator2_2;
         $data->course_id=session()->get('usercourse');
         $data->branch_id=session()->get('branch_id');
         $data->year_id=session()->get('year_id');
         if($request->total==""){
            $data->total=0;
         }
         else{
            $data->total=$request->total;
         }
         
         if($request->totalpersen==""){
            $data->totalpersen=0;
         }
         else{
            $data->totalpersen=$request->totalpersen;
         }

         if($request->answer==""){
            $data->answer=0;
         }
         else{
            $data->answer=$request->answer;
         }

         if($request->answerpersen==""){
            $data->answerpersen=0;
         }
         else{
            $data->answerpersen=$request->answerpersen;
         }

         if($request->job==""){
            $data->job=0;
         }
         else{
            $data->job=$request->job;
         }

         if($request->jobpersen==""){
            $data->jobpersen=0;
         }
         else{
            $data->jobpersen=$request->jobpersen;
         }

         if($request->straight_line==""){
            $data->straight_line=0;
         }
         else{
            $data->straight_line=$request->straight_line;
         }

         if($request->straight_linepersen==""){
            $data->straight_linepersen=0;
         }
         else{
            $data->straight_linepersen=$request->straight_linepersen;
         }

         if($request->not_straight_line==""){
            $data->not_straight_line=0;
         }
         else{
            $data->not_straight_line=$request->not_straight_line;
         }

         if($request->not_straight_linepersen==""){
            $data->not_straight_linepersen=0;
         }
         else{
            $data->not_straight_linepersen=$request->not_straight_linepersen;
         }

         if($request->freelance==""){
            $data->freelance=0;
         }
         else{
            $data->freelance=$request->freelance;
         }

         if($request->freelancepersen==""){
            $data->freelancepersen=0;
         }
         else{
            $data->freelancepersen=$request->freelancepersen;
         }
         
         if($request->before==""){
            $data->before=0;
         }
         else{
            $data->before=$request->before;
         }
         if($request->beforepersen==""){
            $data->beforepersen=0;
         }
         else{
            $data->beforepersen=$request->beforepersen;
         }
         if($request->continue_study==""){
            $data->continue_study=0;
         }
         else{
            $data->continue_study=$request->continue_study;
         }
         if($request->continue_studypersen==""){
            $data->continue_studypersen=0;
         }
         else{
            $data->continue_studypersen=$request->continue_studypersen;
         }
         if($request->ordain==""){
            $data->ordain=0;
         }
         else{
            $data->ordain=$request->ordain;
         }
         if($request->ordainpersen==""){
            $data->ordainpersen=0;
         }
         else{
            $data->ordainpersen=$request->ordainpersen;
         }
         if($request->soldier==""){
            $data->soldier=0;
         }
         else{
            $data->soldier=$request->soldier;
         }
         if($request->soldierpersen==""){
            $data->soldierpersen=0;
         }
         else{
            $data->soldierpersen=$request->soldierpersen;
         }
         if($request->unemployed==""){
            $data->unemployed=0;
         }
         else{
            $data->unemployed=$request->unemployed;
         }
         if($request->unemployedpersen==""){
            $data->unemployedpersen=0;
         }
         else{
            $data->unemployedpersen=$request->unemployedpersen;
         }
         if($request->result==""){
            $data->result=0;
         }
         else{
            $data->result=$request->result;
         }

         
         $data->save();     
         $data2=new PDCA;
        $data2->Indicator_id=$request->Indicator_id;
        $data2->target=$request->target;
        $data2->performance1=$request->performance1;
        $data2->performance2=$request->performance2;
        $data2->performance3=$request->performance3;
        $data2->score=$request->score;
        $data2->course_id=session()->get('usercourse');
        $data2->branch_id=session()->get('branch_id');
        $data2->year_id=session()->get('year_id');
        $data2->save(); 
         return $data2;
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
         $data2=PDCA::find($request->Indicator_id);
            $data2->target=$request->target;
            $data2->performance1=$request->performance1;
            $data2->performance2=$request->performance2;
            $data2->performance3=$request->performance3;
            $data2->score=$request->score;
            $data2->save(); 
         $data2->save();     
         return $data;
     }
     /////indicator2_1/////indicator2_1/////indicator2_1/////indicator2_1/////indicator2_1/////indicator2_1

     /////addindicator3_3/////addindicator3_3/////addindicator3_3/////addindicator3_3/////addindicator3_3/////addindicator3_3
    public function getindicator3_3($id)
    {
        $editdata = performance3_3::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $pdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',$id)
        ->where('pdca.target','!=',null)
        ->get();
        $per1="";
        return view('AJ/edit3_3',compact('editdata','pdca','per1'));
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
        $data->branch_id=session()->get('branch_id');
        $data->year_id=session()->get('year_id');
        $data->retention_rate=$request->retention_rate1;
        $data->category_retention_rate="อัตราการคงอยู่ของนักศึกษา";
        $data->save();
        if(count($request->doc_file1) > 0)
        {
                
           for ($x = 0; $x < count($request->doc_file1); $x++) 
           {
               if ($request->hasFile('doc_file1')) 
                {
                    $getfile = $request->file('doc_file1');
                    $path = 'public/indicator';
                    $name = $getfile[$x]->getClientOriginalName();
                    $fullfile=$path."/".$name;
                    $getfile[$x]->move($path, $name);                 
                    $insert[$x]['doc_file'] = $request->name1[$x];
                    $insert[$x]['doc_name'] = $fullfile;
                    $insert[$x]['doc_id'] = $data->id;                    
                }            
           }           
           $success=doc_performance3_3::insert($insert);
        }

        $data1=new performance3_3;
        $data1->course_id=session()->get('usercourse');
        $data1->branch_id=session()->get('branch_id');
        $data1->year_id=session()->get('year_id');
        $data1->retention_rate=$request->retention_rate2;
        $data1->category_retention_rate="การสำเร็จการศึกษา";
        $data1->save();
        if(count($request->doc_file2) > 0)
        {
                
           for ($x2 = 0; $x2 < count($request->doc_file2); $x2++) 
           {
               if ($request->hasFile('doc_file2')) 
                {
                    $getfile = $request->file('doc_file2');
                    $path = 'public/indicator';
                    $name = $getfile[$x2]->getClientOriginalName();
                    $fullfile=$path."/".$name;
                    $getfile[$x2]->move($path, $name);                 
                    $insert2[$x2]['doc_file'] = $request->name2[$x2];
                    $insert2[$x2]['doc_name'] = $fullfile;
                    $insert2[$x2]['doc_id'] = $data1->id;                    
                }            
           }           
           $success=doc_performance3_3::insert($insert2);
        }

        $data2=new performance3_3;
        $data2->course_id=session()->get('usercourse');
        $data2->branch_id=session()->get('branch_id');
        $data2->year_id=session()->get('year_id');
        $data2->retention_rate=$request->retention_rate3;
        $data2->category_retention_rate="ความพึงพอใจและผลการจัดการข้อร้องเรียนของนักศึกษา";
        $data2->save();
        if(count($request->doc_file3) > 0)
        {
                
           for ($x3 = 0; $x3 < count($request->doc_file3); $x3++) 
           {
               if ($request->hasFile('doc_file3')) 
                {
                    $getfile = $request->file('doc_file3');
                    $path = 'public/indicator';
                    $name = $getfile[$x3]->getClientOriginalName();
                    $fullfile=$path."/".$name;
                    $getfile[$x3]->move($path, $name);                 
                    $insert3[$x3]['doc_file'] = $request->name3[$x3];
                    $insert3[$x3]['doc_name'] = $fullfile;
                    $insert3[$x3]['doc_id'] = $data2->id;                    
                }            
           }           
           $success=doc_performance3_3::insert($insert3);
        }
            $data3=new PDCA;
            $data3->Indicator_id=$request->Indicator_id;
            $data3->target=$request->target;
            $data3->performance3=$request->performance3;
            $data3->score=$request->score;
            $data3->course_id=session()->get('usercourse');
            $data3->branch_id=session()->get('branch_id');
            $data3->year_id=session()->get('year_id');
            $data3->save(); 
        return $data3;
    }
    public function updateindicator3_3(Request $request)
    {   
        $validatedData = $request->validate([
            'doc_file1.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx',
            'doc_file2.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx',
            'doc_file3.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx'
            ]);
            if(isset($request->doc_file1)){
                if(count($request->doc_file1) > 0)
                {
                        
                   for ($x = 0; $x < count($request->doc_file1); $x++) 
                   {
                       if ($request->hasFile('doc_file1')) 
                        {
                            $getfile = $request->file('doc_file1');
                            $path = 'public/indicator';
                            $name = $getfile[$x]->getClientOriginalName();
                            $fullfile=$path."/".$name;
                            $getfile[$x]->move($path, $name);                 
                            $insert[$x]['doc_file'] = $request->name1[$x];
                            $insert[$x]['doc_name'] = $fullfile;
                            $insert[$x]['doc_id'] = $request->id;                    
                        }            
                   }           
                   $success=doc_performance3_3::insert($insert);
                }
            }
            if(isset($request->doc_file2)){
                if(count($request->doc_file2) > 0)
                {
                        
                   for ($x2 = 0; $x2 < count($request->doc_file2); $x2++) 
                   {
                       if ($request->hasFile('doc_file2')) 
                        {
                            $getfile = $request->file('doc_file2');
                            $path = 'public/indicator';
                            $name = $getfile[$x2]->getClientOriginalName();
                            $fullfile=$path."/".$name;
                            $getfile[$x2]->move($path, $name);                 
                            $insert2[$x2]['doc_file'] = $request->name2[$x2];
                            $insert2[$x2]['doc_name'] = $fullfile;
                            $insert2[$x2]['doc_id'] = $request->id2;                    
                        }            
                   }           
                   $success=doc_performance3_3::insert($insert2);
                }
            }
            if(isset($request->doc_file3)){
                if(count($request->doc_file3) > 0)
                {
                        
                   for ($x3 = 0; $x3 < count($request->doc_file3); $x3++) 
                   {
                       if ($request->hasFile('doc_file3')) 
                        {
                            $getfile = $request->file('doc_file3');
                            $path = 'public/indicator';
                            $name = $getfile[$x3]->getClientOriginalName();
                            $fullfile=$path."/".$name;
                            $getfile[$x3]->move($path, $name);                 
                            $insert3[$x3]['doc_file'] = $request->name3[$x3];
                            $insert3[$x3]['doc_name'] = $fullfile;
                            $insert3[$x3]['doc_id'] = $request->id3;                    
                        }            
                   }           
                   $success=doc_performance3_3::insert($insert3);
                }
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
        $data3=PDCA::find($request->Indicator_id);
        $data3->target=$request->target;
        $data3->performance3=$request->performance3;
        $data3->score=$request->score;
        $data3->save();
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
        ->where('branch_id',session()->get('branch_id'))
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
        $query=indicator5_4::where('id',$id)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if($query[0]['status']==1){
            $status1=1;
            $status2=0;
        }
        else{
            $status1=0;
            $status2=1;
        }
        
        return view('AJ/edit5_4',compact('query','status1','status2'));
    }
    public function addindicator5_4(Request $request)
    {
        $validatedData = $request->validate([
            'doc_file' => 'required',
            'doc_file.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx',
            ]);
        $data=new indicator5_4;
        $data->course_id=session()->get('usercourse');
        $data->branch_id=session()->get('branch_id');
        $data->year_id=session()->get('year_id');
        $data->performance=$request->performance;
        $data->status=$request->status;
        $data->in_index_id=$request->id;
        $data->save();
            if(count($request->doc_file) > 0)
            {
                    
               for ($x = 0; $x < count($request->doc_file); $x++) 
               {
                   if ($request->hasFile('doc_file')) 
                    {
                        $getfile = $request->file('doc_file');
                        $path = 'public/indicator';
                        $name = $getfile[$x]->getClientOriginalName();
                        $fullfile=$path."/".$name;
                        $getfile[$x]->move($path, $name);                 
                        $insert[$x]['doc_file'] = $request->name[$x];
                        $insert[$x]['doc_name'] = $fullfile;
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
            if(isset($request->doc_file)){
                if(count($request->doc_file) > 0)
                {  
                   for ($x = 0; $x < count($request->doc_file); $x++) 
                   {
                       if ($request->hasFile('doc_file')) 
                        {
                            $getfile = $request->file('doc_file');
                            $path = 'public/indicator';
                            $name = $getfile[$x]->getClientOriginalName();
                            $fullfile=$path."/".$name;
                            $getfile[$x]->move($path, $name);  
                            $insert[$x]['doc_file'] = $request->name[$x];
                            $insert[$x]['doc_name'] = $fullfile;
                            $insert[$x]['doc_id'] = $request->id;                
                        }         
                   } 
                     doc_indicator5_4::insert($insert);           
                }
            }
        $data=indicator5_4::find($request->id);
        $data->performance=$request->performance;
        $data->status=$request->status;
        $data->save();
        return $data;
    }
    /////addindicator5_4/////addindicator5_4/////addindicator5_4/////addindicator5_4/////addindicator5_4/////addindicator5_4

    /////academic_performance/////academic_performance/////academic_performance/////academic_performance/////academic_performance/////academic_performance
    public function getacademic_performance()
    {
        $editdata=category4_academic_performance::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
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
        $data->branch_id=session()->get('branch_id');
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
        ->where('branch_id',session()->get('branch_id'))
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
        $data->branch_id=session()->get('branch_id');
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
        ->where('branch_id',session()->get('branch_id'))
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
        $data->branch_id=session()->get('branch_id');
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
        $data->branch_id=session()->get('branch_id');
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
        $data->branch_id=session()->get('branch_id');
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
        $data->branch_id=session()->get('branch_id');
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
        $data->branch_id=session()->get('branch_id');
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
        $data->branch_id=session()->get('branch_id');
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
        $editdata=category6_assessment_summary::where('category_assessor',$id)
        ->where('year_id',session()->get('year_id'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('course_id',session()->get('usercourse'))
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
        $data->branch_id=session()->get('branch_id');
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
    public function getstrength($id)
    {
        $editdata=category7_strength::where('id',$id)
        ->get();
        return view('AJ/editstrength',compact('editdata'));
    }
    function addstrength(Request $request)
    {
        $data=new category7_strength;
        $data->composition=$request->composition;
        $data->strength=$request->strength;
        $data->should_develop=$request->should_develop;
        $data->development_approach=$request->development_approach;
        $data->course_id=session()->get('usercourse');
        $data->branch_id=session()->get('branch_id');
        $data->year_id=session()->get('year_id');
        $data->save();
     return true;
    }
    public function updatestrength(Request $request)
    {
        $data=category7_strength::find($request->id);
        $data->composition=$request->composition;
        $data->strength=$request->strength;
        $data->should_develop=$request->should_develop;
        $data->development_approach=$request->development_approach;
        $data->save();
              
        return $data;
    }
     /////getstrength/////getstrength/////getstrength/////getstrength/////getstrength/////getstrength

     /////development_proposal////development_proposal/////development_proposal/////development_proposal/////development_proposal/////development_proposal
    public function getdevelopment_proposal($id)
    {
        $editdata=category7_development_proposal_detail::where('id',$id)
        ->get();
        return view('AJ/editdevelopment_proposal2',compact('editdata'));
    }
    function adddevelopment_proposal(Request $request)
    {
            $row=new category7_development_proposal_detail;
            $row->detail=$request->editor1;
            $row->topic=$request->topic;
            $row->course_id=session()->get('usercourse');
            $row->branch_id=session()->get('branch_id');
            $row->year_id=session()->get('year_id');
            $row->save();
     return $row;
    }
    public function updatedevelopment_proposal(Request $request)
    {
        $data=category7_development_proposal_detail::find($request->getid);
        $data->detail=$request->editor1;
        $data->topic=$request->topic;
        $data->save();   
        return $data;
    }
     /////development_proposal/////development_proposal/////development_proposal/////development_proposal/////development_proposal/////development_proposal

     /////getnewstrength/////getnewstrength/////getnewstrength/////getnewstrength/////getnewstrength/////getnewstrength
    public function getnewstrength($id)
    {
        $editdata=category7_newstrength::where('id',$id)
        ->get();
        return view('AJ/editnewstrength',compact('editdata'));
    }
    function addnewstrength(Request $request)
    {
        $data=new category7_newstrength;
        $data->composition=$request->composition;
        $data->strength=$request->strength;
        $data->should_develop=$request->should_develop;
        $data->course_id=session()->get('usercourse');
        $data->branch_id=session()->get('branch_id');
        $data->year_id=session()->get('year_id');
        $data->save();
     return true;
    }
    public function updatenewstrength(Request $request)
    {
        $data=category7_newstrength::find($request->id);
        $data->composition=$request->composition;
        $data->strength=$request->strength;
        $data->should_develop=$request->should_develop;
        $data->save();
              
           return true;
    }
     /////getstrength/////getstrength/////getstrength/////getstrength/////getstrength/////getstrength

     /////addp/////addp/////addp/////addp/////addp/////addp
     public function getp($id)
    {
        $editdata=PDCA::leftjoin('categorypdca','pdca.category_pdca','=','categorypdca.id')
        ->where('pdca_id',$id)
        ->get();
        // foreach($editdata as $row){
        //     foreach($row->docpdca as $value){
        //         if($value['categorypdca']=='p'){
        //             $doc[$i]=
        //         }
        //     }
        // }
        return view('AJ/editp',compact('editdata'));
    }
     public function addp(Request $request)
    {
        if(isset($request->doc_file)){
        $validatedData = $request->validate([
            'doc_file.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx,doc'
            ]);
        }
            $get= PDCA::where('Indicator_id',$request->Indicator_id)
            ->where('category_pdca',$request->category_id)
            ->where('course_id',session()->get('usercourse'))
            ->where('branch_id',session()->get('branch_id'))
            ->where('year_id',session()->get('year_id'))
            ->get();
        if(count($get)!=0){
            $data= PDCA::where('Indicator_id',$request->Indicator_id)
            ->where('year_id',session()->get('year_id'))
            ->where('course_id',session()->get('usercourse'))
            ->where('branch_id',session()->get('branch_id'))
            ->where('category_pdca',$request->category_id)
            ->first();
            $data->p=$request->editor1;
            $data->save();
        }
        else{
            $data=new PDCA;
            $data->course_id=session()->get('usercourse');
            $data->branch_id=session()->get('branch_id');
            $data->year_id=session()->get('year_id');
            $data->category_pdca=$request->category_id;
            $data->Indicator_id=$request->Indicator_id;
            $data->m_id=$request->m_id;
            $data->p=$request->editor1;
            $data->save();
        }
            if(isset($request->doc_file))
            {
                    
               for ($x = 0; $x < count($request->doc_file); $x++) 
               {
                   if ($request->hasFile('doc_file')) 
                    {
                        $getfile = $request->file('doc_file');
                        $path = 'public/PDCA';
                        $name = $getfile[$x]->getClientOriginalName();
                        $fullfile=$path."/".$name;
                        $getfile[$x]->move($path, $name);                 
                        $insert[$x]['doc_file'] = $request->name[$x];
                        $insert[$x]['doc_name'] = $fullfile;
                        $insert[$x]['categorypdca'] = 'p';
                        $insert[$x]['pdca_id'] = $data->pdca_id;                    
                    }            
               }           
               $success=docpdca::insert($insert);
            }
            if($data){
                return $data;
            }
            else{
                return $success;
            }
    }

    public function updatep(Request $request)
    {   
        $validatedData = $request->validate([
            'doc_file.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx,doc',
            ]);
            if(isset($request->doc_file)){
                if(count($request->doc_file) > 0)
                {  
                   for ($x = 0; $x < count($request->doc_file); $x++) 
                   {
                       if ($request->hasFile('doc_file')) 
                        {
                            $getfile = $request->file('doc_file');
                            $path = 'public/indicator';
                            $name = $getfile[$x]->getClientOriginalName();
                            $fullfile=$path."/".$name;
                            File::delete('public/indicator/'.$name);
                            $getfile[$x]->move($path, $name);                
                            $insert[$x]['doc_file'] = $request->name[$x];
                            $insert[$x]['doc_name'] = $fullfile;
                            $insert[$x]['categorypdca'] = 'p';
                            $insert[$x]['pdca_id'] = $request->pdca_id;                
                        }         
                   } 
                   docpdca::insert($insert);           
                }
                }
        $data=PDCA::find($request->pdca_id);
        $data->p=$request->editor1;
        $data->save();
        return $data;
    }
    /////addp/////addp/////addp/////addp/////addp/////addp

    /////addd/////addd/////addd/////addd/////addd/////addd
    public function getd($id)
    {
        $editdata=PDCA::leftjoin('categorypdca','pdca.category_pdca','=','categorypdca.id')
        ->where('pdca_id',$id)
        ->get();
        // foreach($editdata as $row){
        //     foreach($row->docpdca as $value){
        //         if($value['categorypdca']=='p'){
        //             $doc[$i]=
        //         }
        //     }
        // }
        return view('AJ/editD',compact('editdata'));
    }
    public function addd(Request $request)
    {
        if($request->hasFile('doc_file')){
            $validatedData = $request->validate([
                'doc_file.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx,doc'
                ]);
        }
        
            $get= PDCA::where('Indicator_id',$request->Indicator_id)
            ->where('year_id',session()->get('year_id'))
            ->where('course_id',session()->get('usercourse'))
            ->where('branch_id',session()->get('branch_id'))
            ->where('category_pdca',$request->category_id)
            ->get();
        if(count($get)!=0){
            $data= PDCA::where('Indicator_id',$request->Indicator_id)
            ->where('year_id',session()->get('year_id'))
            ->where('course_id',session()->get('usercourse'))
            ->where('branch_id',session()->get('branch_id'))
            ->where('category_pdca',$request->category_id)
            ->first();
            $data->d=$request->editor1;
            $data->save();
        }
        else{
            $data=new PDCA;
            $data->course_id=session()->get('usercourse');
            $data->branch_id=session()->get('branch_id');
            $data->year_id=session()->get('year_id');
            $data->category_pdca=$request->category_id;
            $data->Indicator_id=$request->Indicator_id;
            $data->d=$request->editor1;
            $data->save();
        }
        if($request->hasFile('doc_file'))
        {
                
           for ($x = 0; $x < count($request->doc_file); $x++) 
           {
               if ($request->hasFile('doc_file')) 
                {
                    $getfile = $request->file('doc_file');
                    $path = 'public/PDCA';
                    $name = $getfile[$x]->getClientOriginalName();
                    $fullfile=$path."/".$name;
                    $getfile[$x]->move($path, $name);                 
                    $insert[$x]['doc_file'] = $request->name[$x];
                    $insert[$x]['doc_name'] = $fullfile;
                    $insert[$x]['categorypdca'] = 'd';
                    $insert[$x]['pdca_id'] = $data->pdca_id;                    
                }            
           }           
           $success=docpdca::insert($insert);
        }
            if($data){
                return $data;
            }
            else{
                return $success;
            }
        
    }
    public function updated(Request $request)
    {   
        $validatedData = $request->validate([
            'doc_file.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx,doc',
            ]);
            if(isset($request->doc_file)){
            if(count($request->doc_file) > 0)
            {  
               for ($x = 0; $x < count($request->doc_file); $x++) 
               {
                   if ($request->hasFile('doc_file')) 
                    {
                        $getfile = $request->file('doc_file');
                        $path = 'public/indicator';
                        $name = $getfile[$x]->getClientOriginalName();
                        $fullfile=$path."/".$name;
                        File::delete('public/indicator/'.$name);
                        $getfile[$x]->move($path, $name);                
                        $insert[$x]['doc_file'] = $request->name[$x];
                        $insert[$x]['doc_name'] = $fullfile;
                        $insert[$x]['categorypdca'] = 'd';
                        $insert[$x]['pdca_id'] = $request->pdca_id;                
                    }         
               } 
               docpdca::insert($insert);           
            }
            }
        $data=PDCA::find($request->pdca_id);
        $data->d=$request->editor1;
        $data->save();
        return $data;
    }
    /////addd/////addd/////addd/////addd/////addd/////addd

      /////addc/////addc/////addc/////addc/////addc/////addc
      public function getc($id)
    {
        $editdata=PDCA::leftjoin('categorypdca','pdca.category_pdca','=','categorypdca.id')
        ->where('pdca_id',$id)
        ->get();
        // foreach($editdata as $row){
        //     foreach($row->docpdca as $value){
        //         if($value['categorypdca']=='p'){
        //             $doc[$i]=
        //         }
        //     }
        // }
        return view('AJ/editC',compact('editdata'));
    }
      public function addc(Request $request)
      {
          if(isset($request->doc_file)){
          $validatedData = $request->validate([
              'doc_file.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx,doc'
              ]);
          }
              $get= PDCA::where('Indicator_id',$request->Indicator_id)
              ->where('year_id',session()->get('year_id'))
            ->where('course_id',session()->get('usercourse'))
            ->where('branch_id',session()->get('branch_id'))
              ->where('category_pdca',$request->category_id)
              ->get();
          if(count($get)!=0){
              $data= PDCA::where('Indicator_id',$request->Indicator_id)
              ->where('year_id',session()->get('year_id'))
            ->where('course_id',session()->get('usercourse'))
            ->where('branch_id',session()->get('branch_id'))
              ->where('category_pdca',$request->category_id)
              ->first();
              $data->c=$request->editor1;
              $data->save();
          }
          else{
              $data=new PDCA;
              $data->course_id=session()->get('usercourse');
              $data->branch_id=session()->get('branch_id');
              $data->year_id=session()->get('year_id');
              $data->category_pdca=$request->category_id;
              $data->Indicator_id=$request->Indicator_id;
              $data->m_id=$request->m_id;
              $data->c=$request->editor1;
              $data->save();
          }
          if(isset($request->doc_file))
          {
                  
             for ($x = 0; $x < count($request->doc_file); $x++) 
             {
                 if ($request->hasFile('doc_file')) 
                  {
                      $getfile = $request->file('doc_file');
                      $path = 'public/PDCA';
                      $name = $getfile[$x]->getClientOriginalName();
                      $fullfile=$path."/".$name;
                      $getfile[$x]->move($path, $name);                 
                      $insert[$x]['doc_file'] = $request->name[$x];
                      $insert[$x]['doc_name'] = $fullfile;
                      $insert[$x]['categorypdca'] = 'c';
                      $insert[$x]['pdca_id'] = $data->pdca_id;                    
                  }            
             }           
             $success=docpdca::insert($insert);
          }
            if($data){
                return $data;
            }
            else{
                return $success;
            }
      }
      public function updatec(Request $request)
    {   
        $validatedData = $request->validate([
            'doc_file.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx,doc',
            ]);
            if(isset($request->doc_file)){
                if(count($request->doc_file) > 0)
                {  
                   for ($x = 0; $x < count($request->doc_file); $x++) 
                   {
                       if ($request->hasFile('doc_file')) 
                        {
                            $getfile = $request->file('doc_file');
                            $path = 'public/indicator';
                            $name = $getfile[$x]->getClientOriginalName();
                            $fullfile=$path."/".$name;
                            File::delete('public/indicator/'.$name);
                            $getfile[$x]->move($path, $name);                
                            $insert[$x]['doc_file'] = $request->name[$x];
                            $insert[$x]['doc_name'] = $fullfile;
                            $insert[$x]['categorypdca'] = 'c';
                            $insert[$x]['pdca_id'] = $request->pdca_id;                
                        }         
                   } 
                   docpdca::insert($insert);           
                }
                }
        $data=PDCA::find($request->pdca_id);
        $data->c=$request->editor1;
        $data->save();
        return $data;
    }
      /////addc/////addc/////addc/////addc/////addc/////addc

      /////adda/////adda/////adda/////adda/////adda/////adda
      public function geta($id)
    {
        $editdata=PDCA::leftjoin('categorypdca','pdca.category_pdca','=','categorypdca.id')
        ->where('pdca_id',$id)
        ->get();
        // foreach($editdata as $row){
        //     foreach($row->docpdca as $value){
        //         if($value['categorypdca']=='p'){
        //             $doc[$i]=
        //         }
        //     }
        // }
        return view('AJ/editA',compact('editdata'));
    }
      public function adda(Request $request)
      {
        if(isset($request->doc_file)){
          $validatedData = $request->validate([
              'doc_file.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx,doc'
              ]);
          }
              $get= PDCA::where('Indicator_id',$request->Indicator_id)
              ->where('year_id',session()->get('year_id'))
            ->where('course_id',session()->get('usercourse'))
            ->where('branch_id',session()->get('branch_id'))
              ->where('category_pdca',$request->category_id)
              ->get();
          if(count($get)!=0){
              $data= PDCA::where('Indicator_id',$request->Indicator_id)
              ->where('year_id',session()->get('year_id'))
            ->where('course_id',session()->get('usercourse'))
            ->where('branch_id',session()->get('branch_id'))
              ->where('category_pdca',$request->category_id)
              ->first();
              $data->a=$request->editor1;
              $data->save();
          }
          else{
              $data=new PDCA;
              $data->course_id=session()->get('usercourse');
              $data->branch_id=session()->get('branch_id');
              $data->year_id=session()->get('year_id');
              $data->category_pdca=$request->category_id;
              $data->Indicator_id=$request->Indicator_id;
              $data->m_id=$request->m_id;
              $data->a=$request->editor1;
              $data->save();
          }
                if(isset($request->doc_file))
                {
                        
                    for ($x = 0; $x < count($request->doc_file); $x++) 
                    {
                        if ($request->hasFile('doc_file')) 
                        {
                            $getfile = $request->file('doc_file');
                            $path = 'public/PDCA';
                            $name = $getfile[$x]->getClientOriginalName();
                            $fullfile=$path."/".$name;
                            $getfile[$x]->move($path, $name);                 
                            $insert[$x]['doc_file'] = $request->name[$x];
                            $insert[$x]['doc_name'] = $fullfile;
                            $insert[$x]['categorypdca'] = 'a';
                            $insert[$x]['pdca_id'] = $data->pdca_id;                    
                        }            
                    }           
                    $success=docpdca::insert($insert);
                }
              if($data){
                return $data;
            }
            else{
                return $success;
            }
      }
      public function updatea(Request $request)
    {   
        $validatedData = $request->validate([
            'doc_file.*' => 'mimes:csv,txt,xlsx,xls,pdf,docx,doc',
            ]);
            if(isset($request->doc_file)){
                if(count($request->doc_file) > 0)
                {  
                   for ($x = 0; $x < count($request->doc_file); $x++) 
                   {
                       if ($request->hasFile('doc_file')) 
                        {
                            $getfile = $request->file('doc_file');
                            $path = 'public/indicator';
                            $name = $getfile[$x]->getClientOriginalName();
                            $fullfile=$path."/".$name;
                            File::delete('public/indicator/'.$name);
                            $getfile[$x]->move($path, $name);                
                            $insert[$x]['doc_file'] = $request->name[$x];
                            $insert[$x]['doc_name'] = $fullfile;
                            $insert[$x]['categorypdca'] = 'a';
                            $insert[$x]['pdca_id'] = $request->pdca_id;                
                        }         
                   } 
                   docpdca::insert($insert);           
                }
                }
        $data=PDCA::find($request->pdca_id);
        $data->a=$request->editor1;
        $data->save();
        return $data;
    }
      /////adda/////adda/////adda/////adda/////adda/////adda
      public function deletedoc($id)
    {
        $data=docpdca::where('doc_id',$id)
        ->first();
        $data->delete();
        return $data;
    }
    public function deletedoc4_3($id)
    {
        $data=docindicator4_3::where('Indicator_id',$id)
        ->first();
        $data->delete();
       return $data;
    }
    public function deletedoc3_3($id)
    {
        $data=doc_performance3_3::where('Indicator_id',$id)
        ->first();
        $data->delete();
       return $data;
    }
    public function deletedoc5_4($id)
    {
        $data=doc_indicator5_4::where('Indicator_id',$id)
        ->first();
        $data->delete();
       return $data;
    }
    /////strengths_summary/////strengths_summary/////strengths_summary/////strengths_summary/////strengths_summary/////strengths_summary
    public function getstrengths_summary($id)
    {
        $query=category7_strengths_summary::where('id',$id)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        return view('AJ/editstrengths_summary',compact('query'));
    }
    function addstrengths_summary(Request $request)
    {
        $data=new category7_strengths_summary;
        $data->strength=$request->strength;
        $data->points_development=$request->points_development;
        $data->development_approach=$request->development_approach;
        $data->composition_id=$request->composition_id;
        $data->course_id=session()->get('usercourse');
        $data->branch_id=session()->get('branch_id');
        $data->year_id=session()->get('year_id');
        $data->save();

     return $data;
    }
    public function updatestrengths_summary(Request $request)
    {
        $data=category7_strengths_summary::find($request->id);
        $data->strength=$request->strength;
        $data->points_development=$request->points_development;
        $data->development_approach=$request->development_approach;
        $data->save();
        return $data;
    }
     /////strengths_summary/////strengths_summary/////strengths_summary/////strengths_summary/////strengths_summary/////strengths_summary


     /////infostudent/////infostudent/////infostudent/////infostudent/////infostudent/////infostudent

     public function getinfostudent()
     {
        $get=year_acceptance::where('course_id',session()->get('usercourse'))
        ->get();
        $getinfo=category3_infostudent::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_add', '>=',$get[0]['year_add'])
        ->where('year_add', '<=',session()->get('year'))
        ->get();
        $getyear=category3_infostudent::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_add',session()->get('year'))
        ->get();
        if(count($get)==0){
            $get="";
        }
       $getqty=category3_infostudent_qty::where('course_id',session()->get('usercourse'))
       ->where('branch_id',session()->get('branch_id'))
       ->where('year_id',session()->get('year_id'))
       ->get();
        return view('AJ/editinfostd',compact('get','getinfo','getqty'));
        
     }
     function addyear_acceptance(Request $request)
    {
        $get=year_acceptance::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->get();
        if(count($get)!=0){
        $get=year_acceptance::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->delete();
        }
        $data=new year_acceptance;
        $data->year_add=$request->year_add;
        // $data->reported_year=$request->reported_year;
        $data->course_id=session()->get('usercourse');
        $data->branch_id=session()->get('branch_id');
        // $data->year_id=session()->get('year_id');
        $data->save();
     return true;
    }
    function addinfostudent(Request $request)
    {
        $get=year_acceptance::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
            ->get();
        $getall=$request->all();
        
   
        $yearname=session()->get('year');
        for($i=$get[0]['year_add'];$i<=$yearname; $i++){
            $getcount=$get[0]['year_add'];
            foreach($getall['y'.$i] as $key=>$value){
                $checkdata=category3_infostudent::where('course_id',session()->get('usercourse'))
                ->where('branch_id',session()->get('branch_id'))
                ->where('year_add',$i)
                ->where('reported_year',$getcount)
                ->get();
                if(count($checkdata)!=0){
                    $data1=category3_infostudent::find($checkdata[0]['id']);
                    $data1->reported_year_qty=$value;
                    $data1->save();
                }
                else{

                    if($value!=null){
                        $data[$key]['reported_year_qty']=$value;
                    }
                    else{
                        $data[$key]['reported_year']=0;
                    }
                    $data[$key]['year_add']=$i;
                    $data[$key]['reported_year']=$getcount;
                    $data[$key]['course_id']=session()->get('usercourse');
                    $data[$key]['branch_id']=session()->get('branch_id');
                    $data[$key]['year_id']=session()->get('year_id');  
                } 
                $getcount++;
            }
            if(isset($data)){
                category3_infostudent::insert($data);
            }
            
        }
        $checkqty=category3_infostudent_qty::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if(count($checkqty)!=0){
            $data2=category3_infostudent_qty::find($checkqty[0]['id']);
            $data2->qty=$request->qty;
            $data2->save();
        }
        else{
            $data2=new category3_infostudent_qty;
            $data2->qty=$request->qty;
            $data2->course_id=session()->get('usercourse');
            $data2->branch_id=session()->get('branch_id');
            $data2->year_id=session()->get('year_id');
            $data2->save();
        }
        
     return $data2;
    }
    public function updateinfostudent(Request $request)
    {
        $get=year_acceptance::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
            ->where('year_id',session()->get('year_id'))
            ->get();
        $getall=$request->all();
        $checkdata=category3_infostudent::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'));
        if(isset($checkdata)){
            $checkdata->delete();
        }
        
        for($i=$get[0]['year_add'];$i<=$get[0]['reported_year']; $i++){
            $getcount=$get[0]['year_add'];
            foreach($getall['y'.$i] as $key=>$value){
                if($value!=null){
                    $data[$key]['reported_year_qty']=$value;
                }
                else{
                    $data[$key]['reported_year']=0;
                }
                $data[$key]['year_add']=$i;
                $data[$key]['reported_year']=$getcount;
                $data[$key]['course_id']=session()->get('usercourse');
                $data2[$key]['branch_id']=session()->get('branch_id');
                $data[$key]['year_id']=session()->get('year_id');
                $getcount++;
            }
            category3_infostudent::insert($data);
        }
        $data2=category3_infostudent_qty::find($request->getid);
        $data2->qty=$request->qty;
        $data2->course_id=session()->get('usercourse');
        $data2->branch_id=session()->get('branch_id');
        $data2->year_id=session()->get('year_id');
        $data2->save();
     return $data2;
    }
        /////infostudent/////infostudent/////infostudent/////infostudent/////infostudent/////infostudent



    public function getassessment_results()
    {
        $Assessment_results=assessment_results::leftjoin('category','assessment_results.category_id','=','category.category_id')
        ->where('assessment_results.year_id',session()->get('year_id'))
        ->where('assessment_results.course_id',session()->get('usercourse'))
        ->where('assessment_results.branch_id',session()->get('branch_id'))
        ->get();
        // foreach($Assessment_results as $key=>$value){
        //     $row[$key] = array(
        //         'name' => $value['category_id'],
        //     );
            
        // }
        return response()->json($Assessment_results);
        
    }
    public function getclidincategory($id)
    {
        $clind=indicator::where('category_id',$id)
        ->where('year_id',session()->get('year_id'))
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->get();
        // foreach($Assessment_results as $key=>$value){
        //     $row[$key] = array(
        //         'name' => $value['category_id'],
        //     );
            
        // }
        return response()->json($clind);
        
    }
    
    public function updateactive(Request $request ,$id)
    {
        $data=assessment_results::find($id);
        $data->active=$request->value;
        $data->save();
        $cate=assessment_results::where('id',$id)->get();
        $getdata=indicator::where('category_id',$cate[0]['category_id'])
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();

        foreach($getdata as $value){
            $data2=indicator::find($value['id']);
            $data2->active=$request->value;
            $data2->save();
        }
        return $getdata;
    }
    public function updateactive2(Request $request ,$id)
    {
        $data=indicator::find($id);
        $data->active=$request->value;
        $data->save();
        return $data;
    }


    /////graduate/////graduate/////graduate/////graduate/////graduate/////graduate

    public function getgraduate()
    {
        $get=year_acceptance_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->get();
        
        $getinfo=category3_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_add', '>=',$get[0]['year_add'])
        ->where('year_add', '<=',session()->get('year'))
        ->where('reported_year', '>=',$get[0]['year_add'])
        ->where('reported_year', '<=',session()->get('year'))
        ->get();
        $getyear=category3_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_add',session()->get('year'))
        ->get();
        $getinfo2=category3_infostudent::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_add', '>=',$get[0]['year_add'])
        ->where('year_add', '<=',session()->get('year'))
        ->where('reported_year', '>=',$get[0]['year_add'])
        ->where('reported_year', '<=',session()->get('year'))
        ->get();
       return view('AJ/editgraduate',compact('get','getinfo','getyear','getinfo2'));
       
    }
    function addyear_graduate(Request $request)
   {
       $get=year_acceptance_graduate::where('course_id',session()->get('usercourse'))
       ->where('branch_id',session()->get('branch_id'))
       ->get();
       if(count($get)!=0){
        $get=year_acceptance_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
       ->delete();
       }
       $data=new year_acceptance_graduate;
       $data->year_add=$request->year_add;
       $data->reported_year=2556;
       $data->course_id=session()->get('usercourse');
       $data->branch_id=session()->get('branch_id');
       $data->year_id=session()->get('year_id');
       $data->save();
    return true;
   }
   function addgraduate(Request $request)
   {
       $get=year_acceptance_graduate::where('course_id',session()->get('usercourse'))
       ->where('branch_id',session()->get('branch_id'))
       ->get();
       $getall=$request->all();
       $yearname=session()->get('year');
       for($i=$get[0]['year_add'];$i<=$yearname; $i++){
           $getcount=$get[0]['year_add'];
           foreach($getall['y'.$i] as $key=>$value){
            $checkdata=category3_graduate::where('course_id',session()->get('usercourse'))
            ->where('branch_id',session()->get('branch_id'))
            ->where('year_add',$i)
            ->where('reported_year',$getcount)
            ->get();
            if(count($checkdata)!=0){
                $data1=category3_graduate::find($checkdata[0]['id']);
                $data1->reported_year_qty=$value;
                $data1->save();
            }
            else{
                if($value!=null){
                    $data[$key]['reported_year_qty']=$value;
                }
                else{
                    $data[$key]['reported_year']=0;
                }
                $data[$key]['year_add']=$i;
                $data[$key]['reported_year']=$getcount;
                $data[$key]['course_id']=session()->get('usercourse');
                $data[$key]['branch_id']=session()->get('branch_id');
                
            }
            $getcount++;
           }
           if(isset($data)){
            category3_graduate::insert($data);
           }
       }
       if(isset($data)){
        return $data;
       }
       else{
        return $data1;
       }
   }
   public function updategraduate(Request $request)
   {
            $get=year_acceptance_graduate::where('course_id',session()->get('usercourse'))
            ->where('branch_id',session()->get('branch_id'))
            ->where('year_id',session()->get('year_id'))
            ->get();
        $getall=$request->all();
        $checkdata=category3_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'));
        if(isset($checkdata)){
            $checkdata->delete();
        }

        for($i=$get[0]['year_add'];$i<=$get[0]['reported_year']; $i++){
            $getcount=$get[0]['year_add'];
            foreach($getall['y'.$i] as $key=>$value){
                if($value!=null){
                    $data[$key]['reported_year_qty']=$value;
                }
                else{
                    $data[$key]['reported_year']=0;
                }
                $data[$key]['year_add']=$i;
                $data[$key]['reported_year']=$getcount;
                $data[$key]['course_id']=session()->get('usercourse');
                $data[$key]['branch_id']=session()->get('branch_id');
                $getcount++;
            }
            category3_graduate::insert($data);
        }
        return $data;
   }
       /////infostudent/////infostudent/////infostudent/////infostudent/////infostudent/////infostudent

      public function getoverview()
    {
        $role=category::leftjoin('assessment_results','category.category_id','=','assessment_results.category_id')
        ->where('branch_id',session()->get('branch_id'))
        ->where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->where('active',1)
        ->orderBy('assessment_results.category_id','asc')
        ->get();

        $crt=course_responsible_teacher::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $ct=course_teacher::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        // ////ตัวบ่งชี้ 2.1
        // $getscore2_1=0;
        // $getscore2_1result=0;
        // $score2_1=0;
        // $queryindicator2_1=indicator2_1::where('year_id',session()->get('year_id'))
        // ->where('course_id',session()->get('usercourse'))
        // ->where('branch_id',session()->get('branch_id'))
        // ->get();
        // $queryindicator2_1result= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        // ->where('pdca.course_id',session()->get('usercourse'))
        // ->where('pdca.branch_id',session()->get('branch_id'))
        // ->where('pdca.year_id',session()->get('year_id'))
        // ->where('pdca.Indicator_id',2.1)
        // ->where('pdca.target','!=',null)
        // ->get();
        // if(count($queryindicator2_1)!=0){
        //     $getscore2_1++;
        // }
        // if(count($queryindicator2_1result)!=0){
        //     $getscore2_1++;
        // }
        // $score2_1=($getscore2_1*100)/2;
        // ////ตัวบ่งชี้ 2.1

        ////หมวดที่ 1 
         ////ตัวบ่งชี้ 1.1
         $getscore1_1=0;
         $getscore1_1result=0;
         $score1_1=0;
         $queryindicator1_1=indicator1_1::where('year_id',session()->get('year_id'))
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->get();
         
         $queryindicator1_1result= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
         ->where('pdca.branch_id',session()->get('branch_id'))
         ->where('pdca.year_id',session()->get('year_id'))
         ->where('pdca.Indicator_id',1.1)
         ->where('pdca.target','!=',null)
         ->get();
 
         //ดึงค่าตารางอาจารย์ผู้รับผิดชอบหลักสูตร
         $trc = course_responsible_teacher::join('year','course_responsible_teacher.year_id','=','year.year_id')
         ->where('course_responsible_teacher.course_id',session()->get('usercourse'))
         ->where('course_responsible_teacher.branch_id',session()->get('branch_id'))
         ->where('year.year_id',session()->get('year_id'))
         ->get();
          ////ดึงสาขาวิชาที่จบของอาจารย์ประจำหลักสูตร
          $tc_course= User::leftjoin('course_teacher','users.id','=','course_teacher.user_id')
          ->where('users.user_course',session()->get('usercourse'))
          ->where('users.user_branch',session()->get('branch_id'))
          ->where('course_teacher.year_id',session()->get('year_id'))
          ->get();
 
          ////ดึงสาขาวิชาที่จบของอาจารย์ผู้สอน
          $instructor= User::leftjoin('instructor','users.id','=','instructor.user_id')
          ->where('users.user_course',session()->get('usercourse'))
          ->where('users.user_branch',session()->get('branch_id'))
          ->where('instructor.year_id',session()->get('year_id'))
          ->get();
          if(count($trc)!=0){
             $getscore1_1++;
         }
 
         if(count($tc_course)!=0){
             $getscore1_1++;
         }
         if(count($instructor)!=0){
             $getscore1_1++;
         }
         if(count($queryindicator1_1)!=0){
             if($queryindicator1_1[0]['result1']!=""){
                 $getscore1_1++;
             }
             if($queryindicator1_1[0]['result2']!=""){
                 $getscore1_1++;
             }
             if($queryindicator1_1[0]['result3']!=""){
                 $getscore1_1++;
             }
             if($queryindicator1_1[0]['result4']!=""){
                 $getscore1_1++;
             }
             if($queryindicator1_1[0]['result5']!=""){
                 $getscore1_1++;
             }
         }
         if(count($queryindicator1_1result)!=0){
             $getscore1_1result++;
         }
         
         ////ตัวบ่งชี้ 1.1
        ////ปิดหมวดที่ 1


        ////หมวดที่ 2 ตัวบ่งชี้ 4.1
        $score4_1resultdoc1=0;
        $score4_1resultdoc2=0;
        $score4_1resultdoc3=0;
        $score4_1result1=0;
        $score4_1result2=0;
        $score4_1result3=0;
        $score4_1resultpdca=0;
        $queryindicator4_1result1= PDCA::where('category_pdca',1)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',4.1)
        ->get();
        if($queryindicator4_1result1!="[]"){
            $queryindicator4_1resultdoc1p= docpdca::where('pdca_id',$queryindicator4_1result1[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator4_1resultdoc1p)!=0){
                $score4_1resultdoc1++;
            }
            $queryindicator4_1resultdoc1d= docpdca::where('pdca_id',$queryindicator4_1result1[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator4_1resultdoc1d)!=0){
                $score4_1resultdoc1++;
            }
            $queryindicator4_1resultdoc1c= docpdca::where('pdca_id',$queryindicator4_1result1[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator4_1resultdoc1c)!=0){
                $score4_1resultdoc1++;
            }
            $queryindicator4_1resultdoc1a= docpdca::where('pdca_id',$queryindicator4_1result1[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator4_1resultdoc1a)!=0){
                $score4_1resultdoc1++;
            }
        }
        
        $queryindicator4_1result2= PDCA::where('category_pdca',2)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',4.1)
        ->get();
        if($queryindicator4_1result2!="[]"){
            $queryindicator4_1resultdoc2p= docpdca::where('pdca_id',$queryindicator4_1result2[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator4_1resultdoc2p)!=0){
                $score4_1resultdoc2++;
            }
            $queryindicator4_1resultdoc2d= docpdca::where('pdca_id',$queryindicator4_1result2[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator4_1resultdoc2d)!=0){
                $score4_1resultdoc2++;
            }
            $queryindicator4_1resultdoc2c= docpdca::where('pdca_id',$queryindicator4_1result2[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator4_1resultdoc2c)!=0){
                $score4_1resultdoc2++;
            }
            $queryindicator4_1resultdoc2a= docpdca::where('pdca_id',$queryindicator4_1result2[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator4_1resultdoc2a)!=0){
                $score4_1resultdoc2++;
            }
        }
        $queryindicator4_1result3= PDCA::where('category_pdca',3)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',4.1)
        ->get();
        if($queryindicator4_1result3!="[]"){
            $queryindicator4_1resultdoc3p= docpdca::where('pdca_id',$queryindicator4_1result3[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator4_1resultdoc3p)!=0){
                $score4_1resultdoc3++;
            }
            $queryindicator4_1resultdoc3d= docpdca::where('pdca_id',$queryindicator4_1result3[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator4_1resultdoc3d)!=0){
                $score4_1resultdoc3++;
            }
            $queryindicator4_1resultdoc3c= docpdca::where('pdca_id',$queryindicator4_1result3[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator4_1resultdoc3c)!=0){
                $score4_1resultdoc3++;
            }
            $queryindicator4_1resultdoc3a= docpdca::where('pdca_id',$queryindicator4_1result3[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator4_1resultdoc3a)!=0){
                $score4_1resultdoc3++;
            }
        }
        $queryindicator2_1result= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',2.1)
        ->where('pdca.target','!=',null)
        ->get();
        if($queryindicator4_1result1!="[]"){
            if($queryindicator4_1result1[0]['p']!=""){
                $score4_1result1++;
            }
            if($queryindicator4_1result1[0]['d']!=""){
                $score4_1result1++;
            }
            if($queryindicator4_1result1[0]['c']!=""){
                $score4_1result1++;
            }
            if($queryindicator4_1result1[0]['a']!=""){
                $score4_1result1++;
            }
        }
        
        if($queryindicator4_1result2!="[]"){
        if($queryindicator4_1result2[0]['p']!=""){
            $score4_1result2++;
        }
        if($queryindicator4_1result2[0]['d']!=""){
            $score4_1result2++;
        }
        if($queryindicator4_1result2[0]['c']!=""){
            $score4_1result2++;
        }
        if($queryindicator4_1result2[0]['a']!=""){
            $score4_1result2++;
        }
        }

        if($queryindicator4_1result3!="[]"){
        if($queryindicator4_1result3[0]['p']!=""){
            $score4_1result3++;
        }
        if($queryindicator4_1result3[0]['d']!=""){
            $score4_1result3++;
        }
        if($queryindicator4_1result3[0]['c']!=""){
            $score4_1result3++;
        }
        if($queryindicator4_1result3[0]['a']!=""){
            $score4_1result3++;
        }
       }
       $queryindicator4_1resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',4.1)
        ->where('pdca.target','!=',null)
        ->get();
        if($queryindicator4_1resultpdca!="[]"){
            $score4_1resultpdca++;
        }
        ////หมวดที่ 2 ตัวบ่งชี้ 4.1

        ////หมวดที่ 2 ตัวบ่งชี้ 4.2
        //// ตัวบ่งชี้ 4.2
        $score4_2result1=0;
        $score4_2result2=0;
        $score4_2resultpdca=0;
        //ดึงค่าตารางอาจารย์ผู้รับผิดชอบหลักสูตร
          $trc = course_responsible_teacher::join('year','course_responsible_teacher.year_id','=','year.year_id')
          ->where('course_responsible_teacher.course_id',session()->get('usercourse'))
          ->where('course_responsible_teacher.branch_id',session()->get('branch_id'))
          ->where('year.year_id',session()->get('year_id'))
          ->get();
          $educ_bg= User::leftjoin('course_responsible_teacher','users.id','=','course_responsible_teacher.user_id')
          ->where('users.user_course',session()->get('usercourse'))
          ->where('users.user_branch',session()->get('branch_id'))
          ->where('course_responsible_teacher.year_id',session()->get('year_id'))
          ->get();
          foreach($educ_bg as $key=>$t){
              if(count($educ_bg[$key]->research_results)!=0){
                      $score4_2result2=1;
              }
          }
         
          $queryindicator4_2resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
          ->where('pdca.course_id',session()->get('usercourse'))
          ->where('pdca.branch_id',session()->get('branch_id'))
          ->where('pdca.year_id',session()->get('year_id'))
          ->where('pdca.Indicator_id',4.2)
          ->where('pdca.target','!=',null)
          ->get();
          if($trc!="[]"){
              if(count($trc)!=0){
                  $score4_2result1++;
              }
          }
          if($queryindicator4_2resultpdca!="[]"){
              $score4_2resultpdca++;
          }
        ////ปิด ตัวบ่งชี้ 4.2
        ////หมวดที่ 2 ตัวบ่งชี้ 4.2

        ////หมวดที่ 2 ตัวบ่งชี้ 4.3
        $score4_3resultdoc1=0;
        $score4_3resultdoc2=0;
        $score4_3result1=0;
        $score4_3result2=0;

        $score4_3resultpdca=0;
        $queryindicator4_3result=indicator4_3::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if($queryindicator4_3result!="[]"){
            // $queryindicator4_3resultdoc= docpdca::where('doc_id',$queryindicator4_3result[0]['id'])
            // ->get();
            // if(count($queryindicator4_3resultdoc)!=0){
            //     $score4_3resultdoc1++;
            // }
            if(count($queryindicator4_3result)==2){
                $score4_3result1++;
                $score4_3result2++;
            }
        }
        $queryindicator4_3resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',4.3)
        ->where('pdca.target','!=',null)
        ->get();
        if($queryindicator4_3resultpdca!="[]"){
            $score4_3resultpdca++;
        }
        ////หมวดที่ 2 ตัวบ่งชี้ 4.3

        ///หมวดที่ 3 
         ////ตัวบ่งชี้ 2.1
         $getscore2_1=0;
         $getscore2_1result=0;
         $score2_1=0;
         $queryindicator2_1=indicator2_1::where('year_id',session()->get('year_id'))
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->get();
         $queryindicator2_1result= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
         ->where('pdca.branch_id',session()->get('branch_id'))
         ->where('pdca.year_id',session()->get('year_id'))
         ->where('pdca.Indicator_id',2.1)
         ->where('pdca.target','!=',null)
         ->get();
         if(count($queryindicator2_1)!=0){
             $getscore2_1++;
         }
         if(count($queryindicator2_1result)!=0){
             $getscore2_1++;
         }
         
         ////ตัวบ่งชี้ 2.1
 
         ////ตัวบ่งชี้ 2.2
         $getscore2_2=0;
         $getscore2_2result=0;
         $queryindicator2_2=indicator2_2::where('year_id',session()->get('year_id'))
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->get();
         $queryindicator2_2result= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
         ->where('pdca.branch_id',session()->get('branch_id'))
         ->where('pdca.year_id',session()->get('year_id'))
         ->where('pdca.Indicator_id',2.2)
         ->where('pdca.target','!=',null)
         ->get();
         if(count($queryindicator2_2)!=0){
             $getscore2_2++;
         }
         if(count($queryindicator2_2result)!=0){
             $getscore2_2++;
         }
         
         ////ตัวบ่งชี้ 2.2

         //// ตัวบ่งชี้ 3.1
        $score3_1resultdoc1=0;
        $score3_1resultdoc2=0;
        $score3_1result1=0;
        $score3_1result2=0;
        $score3_1resultpdca=0;
        $queryindicator3_1result1= PDCA::where('category_pdca',4)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',3.1)
        ->get();
        if($queryindicator3_1result1!="[]"){
            $queryindicator3_1resultdoc1p= docpdca::where('pdca_id',$queryindicator3_1result1[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator3_1resultdoc1p)!=0){
                $score3_1resultdoc1++;
            }
            $queryindicator3_1resultdoc1d= docpdca::where('pdca_id',$queryindicator3_1result1[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator3_1resultdoc1d)!=0){
                $score3_1resultdoc1++;
            }
            $queryindicator3_1resultdoc1c= docpdca::where('pdca_id',$queryindicator3_1result1[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator3_1resultdoc1c)!=0){
                $score3_1resultdoc1++;
            }
            $queryindicator3_1resultdoc1a= docpdca::where('pdca_id',$queryindicator3_1result1[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator3_1resultdoc1a)!=0){
                $score3_1resultdoc1++;
            }
        }
        
        $queryindicator3_1result2= PDCA::where('category_pdca',5)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',3.1)
        ->get();
        if($queryindicator3_1result2!="[]"){
            $queryindicator3_1resultdoc2p= docpdca::where('pdca_id',$queryindicator3_1result2[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator3_1resultdoc2p)!=0){
                $score3_1resultdoc2++;
            }
            $queryindicator3_1resultdoc2d= docpdca::where('pdca_id',$queryindicator3_1result2[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator3_1resultdoc2d)!=0){
                $score3_1resultdoc2++;
            }
            $queryindicator3_1resultdoc2c= docpdca::where('pdca_id',$queryindicator3_1result2[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator3_1resultdoc2c)!=0){
                $score3_1resultdoc2++;
            }
            $queryindicator3_1resultdoc2a= docpdca::where('pdca_id',$queryindicator3_1result2[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator3_1resultdoc2a)!=0){
                $score3_1resultdoc2++;
            }
        }
 

        if($queryindicator3_1result1!="[]"){
            if($queryindicator3_1result1[0]['p']!=""){
                $score3_1result1++;
            }
            if($queryindicator3_1result1[0]['d']!=""){
                $score3_1result1++;
            }
            if($queryindicator3_1result1[0]['c']!=""){
                $score3_1result1++;
            }
            if($queryindicator3_1result1[0]['a']!=""){
                $score3_1result1++;
            }
        }
        
        if($queryindicator3_1result2!="[]"){
        if($queryindicator3_1result2[0]['p']!=""){
            $score3_1result2++;
        }
        if($queryindicator3_1result2[0]['d']!=""){
            $score3_1result2++;
        }
        if($queryindicator3_1result2[0]['c']!=""){
            $score3_1result2++;
        }
        if($queryindicator3_1result2[0]['a']!=""){
            $score3_1result2++;
        }
        }

       $queryindicator3_1resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',3.1)
        ->where('pdca.target','!=',null)
        ->get();
        if($queryindicator3_1resultpdca!="[]"){
            $score3_1resultpdca++;
        }
        //// ปิดตัวบ่งชี้ 3.1


        //// ตัวบ่งชี้ 3.2
        $score3_2resultdoc1=0;
        $score3_2resultdoc2=0;
        $score3_2result1=0;
        $score3_2result2=0;
        $score3_2resultpdca=0;
        $queryindicator3_2result1= PDCA::where('category_pdca',6)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',3.2)
        ->get();
        if($queryindicator3_2result1!="[]"){
            $queryindicator3_2resultdoc1p= docpdca::where('pdca_id',$queryindicator3_2result1[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator3_2resultdoc1p)!=0){
                $score3_2resultdoc1++;
            }
            $queryindicator3_2resultdoc1d= docpdca::where('pdca_id',$queryindicator3_2result1[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator3_2resultdoc1d)!=0){
                $score3_2resultdoc1++;
            }
            $queryindicator3_2resultdoc1c= docpdca::where('pdca_id',$queryindicator3_2result1[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator3_2resultdoc1c)!=0){
                $score3_2resultdoc1++;
            }
            $queryindicator3_2resultdoc1a= docpdca::where('pdca_id',$queryindicator3_2result1[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator3_2resultdoc1a)!=0){
                $score3_2resultdoc1++;
            }
        }
        
        $queryindicator3_2result2= PDCA::where('category_pdca',7)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',3.2)
        ->get();
        if($queryindicator3_2result2!="[]"){
            $queryindicator3_2resultdoc2p= docpdca::where('pdca_id',$queryindicator3_2result2[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator3_2resultdoc2p)!=0){
                $score3_2resultdoc2++;
            }
            $queryindicator3_2resultdoc2d= docpdca::where('pdca_id',$queryindicator3_2result2[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator3_2resultdoc2d)!=0){
                $score3_2resultdoc2++;
            }
            $queryindicator3_2resultdoc2c= docpdca::where('pdca_id',$queryindicator3_2result2[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator3_2resultdoc2c)!=0){
                $score3_2resultdoc2++;
            }
            $queryindicator3_2resultdoc2a= docpdca::where('pdca_id',$queryindicator3_2result2[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator3_2resultdoc2a)!=0){
                $score3_2resultdoc2++;
            }
        }
 

        if($queryindicator3_2result1!="[]"){
            if($queryindicator3_2result1[0]['p']!=""){
                $score3_2result1++;
            }
            if($queryindicator3_2result1[0]['d']!=""){
                $score3_2result1++;
            }
            if($queryindicator3_2result1[0]['c']!=""){
                $score3_2result1++;
            }
            if($queryindicator3_2result1[0]['a']!=""){
                $score3_2result1++;
            }
        }
        
        if($queryindicator3_2result2!="[]"){
        if($queryindicator3_2result2[0]['p']!=""){
            $score3_2result2++;
        }
        if($queryindicator3_2result2[0]['d']!=""){
            $score3_2result2++;
        }
        if($queryindicator3_2result2[0]['c']!=""){
            $score3_2result2++;
        }
        if($queryindicator3_2result2[0]['a']!=""){
            $score3_2result2++;
        }
        }

       $queryindicator3_2resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',3.2)
        ->where('pdca.target','!=',null)
        ->get();
        if($queryindicator3_2resultpdca!="[]"){
            $score3_2resultpdca++;
        }
        //// ปิดตัวบ่งชี้ 3.2

         ////ตัวบ่งชี้ 3.3
         $score3_3resultdoc1=0;
         $score3_3resultdoc2=0;
         $score3_3result1=0;
         $score3_3result2=0;
         $score3_3result3=0;
         $score3_3resultpdca=0;
         $queryindicator3_3result=performance3_3::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
         if($queryindicator3_3result!="[]"){
             // $queryindicator3_3resultdoc= docpdca::where('doc_id',$queryindicator3_3result[0]['id'])
             // ->get();
             // if(count($queryindicator3_3resultdoc)!=0){
             //     $score3_3resultdoc1++;
             // }
             if(count($queryindicator3_3result)==3){
                 $score3_3result1++;
                 $score3_3result2++;
                 $score3_3result3++;
             }
         }
         $queryindicator3_3resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
         ->where('pdca.branch_id',session()->get('branch_id'))
         ->where('pdca.year_id',session()->get('year_id'))
         ->where('pdca.Indicator_id',3.3)
         ->where('pdca.target','!=',null)
         ->get();
         if($queryindicator3_3resultpdca!="[]"){
             $score3_3resultpdca++;
         }
         ////ปิดตัวบ่งชี้ 3.3

          ////ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา
          $scorfactor=0;
          $factor=category3_GD::where('category_factor','ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา')
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
          ->where('year_id',session()->get('year_id'))
         ->get();
         if($factor!="[]"){
             $scorfactor++;
         }
          ////ปิด ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา
 
           ////ปัยจัยที่มีผลกระทบต่อการสำเร็จการศึกษา
           $scorfactor2=0;
           $factor2=category3_GD::where('category_factor','ปัยจัยที่มีผลกระทบต่อการสำเร็จการศึกษา')
          ->where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
           ->where('year_id',session()->get('year_id'))
          ->get();
          if($factor2!="[]"){
              $scorfactor2++;
          }
           ////ปิด ปัยจัยที่มีผลกระทบต่อการสำเร็จการศึกษา
 
          ////ข้อมูลนักศึกษา
          $scoreinfo=0;
          $scoreinfoqty=0;
          $getyear=category3_infostudent::where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
             ->where('year_add',session()->get('year'))
             ->get();
         $getqty=category3_infostudent_qty::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
             ->where('year_id',session()->get('year_id'))
             ->get();
         if($getyear!="[]"){
             $scoreinfo++;
         }
         if($getqty!="[]"){
             $scoreinfoqty++;
         }
          ////ปิด ข้อมูลนักศึกษา
 
         ////จำนวนผู้สำเร็จการศึกษา
         $get=year_acceptance_graduate::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->get();
         $scoregraduate=0;
         if($get!="[]"){
            $getinfo=category3_graduate::where('course_id',session()->get('usercourse'))
            ->where('branch_id',session()->get('branch_id'))
            ->where('year_add',session()->get('year'))
            ->get();
             if($getinfo!="[]"){
                $scoregraduate++;
            }
         }
        
        
         ////ปิด จำนวนผู้สำเร็จการศึกษา
 
        ////จำนวนที่ลาออกและคัดชื่อออกสะสมจนถึงสิ้นปีการศึกษา
        $scorere=0;
         $re=category3_resignation::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_present',session()->get('year'))
         ->get();
       if($re!="[]"){
           $scorere++;
       }
        ////ปิด จำนวนที่ลาออกและคัดชื่อออกสะสมจนถึงสิ้นปีการศึกษา
        ///ปิดหมวดที่ 3 

        ///หมวดที่ 4 
        //// ตัวบ่งชี้ 5.1
        $score5_1resultdoc1=0;
        $score5_1resultdoc2=0;
        $score5_1resultdoc3=0;
        $score5_1result1=0;
        $score5_1result2=0;
        $score5_1result3=0;
        $score5_1resultpdca=0;
        $queryindicator5_1result1= PDCA::where('category_pdca',12)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',5.1)
        ->get();
        if($queryindicator5_1result1!="[]"){
            $queryindicator5_1resultdoc1p= docpdca::where('pdca_id',$queryindicator5_1result1[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator5_1resultdoc1p)!=0){
                $score5_1resultdoc1++;
            }
            $queryindicator5_1resultdoc1d= docpdca::where('pdca_id',$queryindicator5_1result1[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator5_1resultdoc1d)!=0){
                $score5_1resultdoc1++;
            }
            $queryindicator5_1resultdoc1c= docpdca::where('pdca_id',$queryindicator5_1result1[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator5_1resultdoc1c)!=0){
                $score5_1resultdoc1++;
            }
            $queryindicator5_1resultdoc1a= docpdca::where('pdca_id',$queryindicator5_1result1[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator5_1resultdoc1a)!=0){
                $score5_1resultdoc1++;
            }
        }
        
        $queryindicator5_1result2= PDCA::where('category_pdca',13)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',5.1)
        ->get();
        if($queryindicator5_1result2!="[]"){
            $queryindicator5_1resultdoc2p= docpdca::where('pdca_id',$queryindicator5_1result2[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator5_1resultdoc2p)!=0){
                $score5_1resultdoc2++;
            }
            $queryindicator5_1resultdoc2d= docpdca::where('pdca_id',$queryindicator5_1result2[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator5_1resultdoc2d)!=0){
                $score5_1resultdoc2++;
            }
            $queryindicator5_1resultdoc2c= docpdca::where('pdca_id',$queryindicator5_1result2[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator5_1resultdoc2c)!=0){
                $score5_1resultdoc2++;
            }
            $queryindicator5_1resultdoc2a= docpdca::where('pdca_id',$queryindicator5_1result2[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator5_1resultdoc2a)!=0){
                $score5_1resultdoc2++;
            }
        }
        $queryindicator5_1result3= PDCA::where('category_pdca',14)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',5.1)
        ->get();
        if($queryindicator5_1result3!="[]"){
            $queryindicator5_1resultdoc3p= docpdca::where('pdca_id',$queryindicator5_1result3[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator5_1resultdoc3p)!=0){
                $score5_1resultdoc3++;
            }
            $queryindicator5_1resultdoc3d= docpdca::where('pdca_id',$queryindicator5_1result3[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator5_1resultdoc3d)!=0){
                $score5_1resultdoc3++;
            }
            $queryindicator5_1resultdoc3c= docpdca::where('pdca_id',$queryindicator5_1result3[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator5_1resultdoc3c)!=0){
                $score5_1resultdoc3++;
            }
            $queryindicator5_1resultdoc3a= docpdca::where('pdca_id',$queryindicator5_1result3[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator5_1resultdoc3a)!=0){
                $score5_1resultdoc3++;
            }
        }

        if($queryindicator5_1result1!="[]"){
            if($queryindicator5_1result1[0]['p']!=""){
                $score5_1result1++;
            }
            if($queryindicator5_1result1[0]['d']!=""){
                $score5_1result1++;
            }
            if($queryindicator5_1result1[0]['c']!=""){
                $score5_1result1++;
            }
            if($queryindicator5_1result1[0]['a']!=""){
                $score5_1result1++;
            }
        }
        
        if($queryindicator5_1result2!="[]"){
        if($queryindicator5_1result2[0]['p']!=""){
            $score5_1result2++;
        }
        if($queryindicator5_1result2[0]['d']!=""){
            $score5_1result2++;
        }
        if($queryindicator5_1result2[0]['c']!=""){
            $score5_1result2++;
        }
        if($queryindicator5_1result2[0]['a']!=""){
            $score5_1result2++;
        }
        }

        if($queryindicator5_1result3!="[]"){
        if($queryindicator5_1result3[0]['p']!=""){
            $score5_1result3++;
        }
        if($queryindicator5_1result3[0]['d']!=""){
            $score5_1result3++;
        }
        if($queryindicator5_1result3[0]['c']!=""){
            $score5_1result3++;
        }
        if($queryindicator5_1result3[0]['a']!=""){
            $score5_1result3++;
        }
       }
       $queryindicator5_1resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',5.1)
        ->where('pdca.target','!=',null)
        ->get();
        if($queryindicator5_1resultpdca!="[]"){
            $score5_1resultpdca++;
        }
        //// ปิด ตัวบ่งชี้ 5.1

        //// ตัวบ่งชี้ 5.2
        $score5_2resultdoc1=0;
        $score5_2resultdoc2=0;
        $score5_2resultdoc3=0;
        $score5_2result1=0;
        $score5_2result2=0;
        $score5_2result3=0;
        $score5_2resultpdca=0;
        $queryindicator5_2result1= PDCA::where('category_pdca',8)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',5.2)
        ->get();
        if($queryindicator5_2result1!="[]"){
            $queryindicator5_2resultdoc1p= docpdca::where('pdca_id',$queryindicator5_2result1[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator5_2resultdoc1p)!=0){
                $score5_2resultdoc1++;
            }
            $queryindicator5_2resultdoc1d= docpdca::where('pdca_id',$queryindicator5_2result1[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator5_2resultdoc1d)!=0){
                $score5_2resultdoc1++;
            }
            $queryindicator5_2resultdoc1c= docpdca::where('pdca_id',$queryindicator5_2result1[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator5_2resultdoc1c)!=0){
                $score5_2resultdoc1++;
            }
            $queryindicator5_2resultdoc1a= docpdca::where('pdca_id',$queryindicator5_2result1[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator5_2resultdoc1a)!=0){
                $score5_2resultdoc1++;
            }
        }
        
        $queryindicator5_2result2= PDCA::where('category_pdca',9)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',5.2)
        ->get();
        if($queryindicator5_2result2!="[]"){
            $queryindicator5_2resultdoc2p= docpdca::where('pdca_id',$queryindicator5_2result2[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator5_2resultdoc2p)!=0){
                $score5_2resultdoc2++;
            }
            $queryindicator5_2resultdoc2d= docpdca::where('pdca_id',$queryindicator5_2result2[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator5_2resultdoc2d)!=0){
                $score5_2resultdoc2++;
            }
            $queryindicator5_2resultdoc2c= docpdca::where('pdca_id',$queryindicator5_2result2[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator5_2resultdoc2c)!=0){
                $score5_2resultdoc2++;
            }
            $queryindicator5_2resultdoc2a= docpdca::where('pdca_id',$queryindicator5_2result2[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator5_2resultdoc2a)!=0){
                $score5_2resultdoc2++;
            }
        }
        $queryindicator5_2result3= PDCA::where('category_pdca',10)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',5.2)
        ->get();
        if($queryindicator5_2result3!="[]"){
            $queryindicator5_2resultdoc3p= docpdca::where('pdca_id',$queryindicator5_2result3[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator5_2resultdoc3p)!=0){
                $score5_2resultdoc3++;
            }
            $queryindicator5_2resultdoc3d= docpdca::where('pdca_id',$queryindicator5_2result3[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator5_2resultdoc3d)!=0){
                $score5_2resultdoc3++;
            }
            $queryindicator5_2resultdoc3c= docpdca::where('pdca_id',$queryindicator5_2result3[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator5_2resultdoc3c)!=0){
                $score5_2resultdoc3++;
            }
            $queryindicator5_2resultdoc3a= docpdca::where('pdca_id',$queryindicator5_2result3[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator5_2resultdoc3a)!=0){
                $score5_2resultdoc3++;
            }
        }

        if($queryindicator5_2result1!="[]"){
            if($queryindicator5_2result1[0]['p']!=""){
                $score5_2result1++;
            }
            if($queryindicator5_2result1[0]['d']!=""){
                $score5_2result1++;
            }
            if($queryindicator5_2result1[0]['c']!=""){
                $score5_2result1++;
            }
            if($queryindicator5_2result1[0]['a']!=""){
                $score5_2result1++;
            }
        }
        
        if($queryindicator5_2result2!="[]"){
        if($queryindicator5_2result2[0]['p']!=""){
            $score5_2result2++;
        }
        if($queryindicator5_2result2[0]['d']!=""){
            $score5_2result2++;
        }
        if($queryindicator5_2result2[0]['c']!=""){
            $score5_2result2++;
        }
        if($queryindicator5_2result2[0]['a']!=""){
            $score5_2result2++;
        }
        }

        if($queryindicator5_2result3!="[]"){
        if($queryindicator5_2result3[0]['p']!=""){
            $score5_2result3++;
        }
        if($queryindicator5_2result3[0]['d']!=""){
            $score5_2result3++;
        }
        if($queryindicator5_2result3[0]['c']!=""){
            $score5_2result3++;
        }
        if($queryindicator5_2result3[0]['a']!=""){
            $score5_2result3++;
        }
       }
       $queryindicator5_2resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',5.2)
        ->where('pdca.target','!=',null)
        ->get();
        if($queryindicator5_2resultpdca!="[]"){
            $score5_2resultpdca++;
        }
        //// ปิด ตัวบ่งชี้ 5.2

        //// ตัวบ่งชี้ 5.3
       $score5_3resultdoc1=0;
       $score5_3resultdoc2=0;
       $score5_3result1=0;
       $score5_3result2=0;
       $score5_3resultpdca=0;
       $queryindicator5_3result1= PDCA::where('category_pdca',15)
       ->where('course_id',session()->get('usercourse'))
       ->where('branch_id',session()->get('branch_id'))
       ->where('year_id',session()->get('year_id'))
       ->where('Indicator_id',5.3)
       ->get();
       if($queryindicator5_3result1!="[]"){
           $queryindicator5_3resultdoc1p= docpdca::where('pdca_id',$queryindicator5_3result1[0]['pdca_id'])
           ->where('categorypdca','p')
           ->get();
           if(count($queryindicator5_3resultdoc1p)!=0){
               $score5_3resultdoc1++;
           }
           $queryindicator5_3resultdoc1d= docpdca::where('pdca_id',$queryindicator5_3result1[0]['pdca_id'])
           ->where('categorypdca','d')
           ->get();
           if(count($queryindicator5_3resultdoc1d)!=0){
               $score5_3resultdoc1++;
           }
           $queryindicator5_3resultdoc1c= docpdca::where('pdca_id',$queryindicator5_3result1[0]['pdca_id'])
           ->where('categorypdca','c')
           ->get();
           if(count($queryindicator5_3resultdoc1c)!=0){
               $score5_3resultdoc1++;
           }
           $queryindicator5_3resultdoc1a= docpdca::where('pdca_id',$queryindicator5_3result1[0]['pdca_id'])
           ->where('categorypdca','a')
           ->get();
           if(count($queryindicator5_3resultdoc1a)!=0){
               $score5_3resultdoc1++;
           }
       }
       
       $queryindicator5_3result2= PDCA::where('category_pdca',16)
       ->where('course_id',session()->get('usercourse'))
       ->where('branch_id',session()->get('branch_id'))
       ->where('year_id',session()->get('year_id'))
       ->where('Indicator_id',5.3)
       ->get();
       if($queryindicator5_3result2!="[]"){
           $queryindicator5_3resultdoc2p= docpdca::where('pdca_id',$queryindicator5_3result2[0]['pdca_id'])
           ->where('categorypdca','p')
           ->get();
           if(count($queryindicator5_3resultdoc2p)!=0){
               $score5_3resultdoc2++;
           }
           $queryindicator5_3resultdoc2d= docpdca::where('pdca_id',$queryindicator5_3result2[0]['pdca_id'])
           ->where('categorypdca','d')
           ->get();
           if(count($queryindicator5_3resultdoc2d)!=0){
               $score5_3resultdoc2++;
           }
           $queryindicator5_3resultdoc2c= docpdca::where('pdca_id',$queryindicator5_3result2[0]['pdca_id'])
           ->where('categorypdca','c')
           ->get();
           if(count($queryindicator5_3resultdoc2c)!=0){
               $score5_3resultdoc2++;
           }
           $queryindicator5_3resultdoc2a= docpdca::where('pdca_id',$queryindicator5_3result2[0]['pdca_id'])
           ->where('categorypdca','a')
           ->get();
           if(count($queryindicator5_3resultdoc2a)!=0){
               $score5_3resultdoc2++;
           }
       }


       if($queryindicator5_3result1!="[]"){
           if($queryindicator5_3result1[0]['p']!=""){
               $score5_3result1++;
           }
           if($queryindicator5_3result1[0]['d']!=""){
               $score5_3result1++;
           }
           if($queryindicator5_3result1[0]['c']!=""){
               $score5_3result1++;
           }
           if($queryindicator5_3result1[0]['a']!=""){
               $score5_3result1++;
           }
       }
       
       if($queryindicator5_3result2!="[]"){
       if($queryindicator5_3result2[0]['p']!=""){
           $score5_3result2++;
       }
       if($queryindicator5_3result2[0]['d']!=""){
           $score5_3result2++;
       }
       if($queryindicator5_3result2[0]['c']!=""){
           $score5_3result2++;
       }
       if($queryindicator5_3result2[0]['a']!=""){
           $score5_3result2++;
       }
       }

      $queryindicator5_3resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
       ->where('pdca.course_id',session()->get('usercourse'))
       ->where('pdca.branch_id',session()->get('branch_id'))
       ->where('pdca.year_id',session()->get('year_id'))
       ->where('pdca.Indicator_id',5.3)
       ->where('pdca.target','!=',null)
       ->get();
       if($queryindicator5_3resultpdca!="[]"){
           $score5_3resultpdca++;
       }
       //// ปิดตัวบ่งชี้ 5.3

       //// ตัวบ่งชี้ 5.4
       $score5_4result1=0;
       $score5_4resultpdca=0;
       $perfor=indicator5_4::where('course_id',session()->get('usercourse'))
       ->where('branch_id',session()->get('branch_id'))
       ->where('year_id',session()->get('year_id'))
       ->get();
       $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
       ->where('pdca.course_id',session()->get('usercourse'))
       ->where('pdca.branch_id',session()->get('branch_id'))
       ->where('pdca.year_id',session()->get('year_id'))
       ->where('pdca.indicator_id',5.4)
       ->where('pdca.target','!=',null)
       ->get();
       if($inc!="[]"){
           $score5_4resultpdca++;
       }
       if($perfor!="[]"){
           $score5_4result1++;
       }
       //// ปิด ตัวบ่งชี้ 5.4

        //// คุณภาพการสอน
        $scoreteachqua=0;
        $teachqua=category4_teaching_quality::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
       ->where('year_id',session()->get('year_id'))
       ->get();
        if($teachqua!="[]"){
            $scoreteachqua++;
        }
        //// ปิด คุณภาพการสอน

        //// สรุปผลรายวิชาที่เปิดสอนในภาค/ปีการศึกษา
        $scoreccr=0;
        $ccr=category4_course_results::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
       ->where('year_id',session()->get('year_id'))
       ->get();
        if($ccr!="[]"){
            $scoreccr++;
        }
        //// ปิด สรุปผลรายวิชาที่เปิดสอนในภาค/ปีการศึกษา

        //// การวิเคราะห์รายวิชาที่มีผลการเรียนที่ไม่ปกติ
        $scoreacademic=0;
        $academic=category4_academic_performance::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
       ->where('year_id',session()->get('year_id'))
       ->get();
        if($academic!="[]"){
            $scoreacademic++;
        }
        //// ปิด การวิเคราะห์รายวิชาที่มีผลการเรียนที่ไม่ปกติ
        
        //// รายวิชาที่ไม่ได้เปิดสอนในปีการศึกษา
        $scorenot_offered=0;
        $not_offered=category4_notcourse_results::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
       ->where('year_id',session()->get('year_id'))
       ->get();
        if($not_offered!="[]"){
            $scorenot_offered++;
        }
        //// ปิด รายวิชาที่ไม่ได้เปิดสอนในปีการศึกษา

        //// รายวิชาที่สอนเนื้อหาไม่ครบในปีการศึกษา
        $scoreincomplete_content=0;
        $queryincomplete_content=category4_incomplete_content::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
       ->where('year_id',session()->get('year_id'))
       ->get();
        if($queryincomplete_content!="[]"){
            $scoreincomplete_content++;
        }
        //// ปิด รายวิชาที่สอนเนื้อหาไม่ครบในปีการศึกษา

        //// ประสิทธิผลของกลยุทธ์การสอน
        $scoreeffec=0;
        $effec=category4_effectiveness::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if($effec!="[]"){
            $scoreeffec++;
        }
        //// ปิด ประสิทธิผลของกลยุทธ์การสอน

        //// การปฐมนิเทศอาจารย์ใหม่
        $scorenewteacher=0;
        $th=category4_newteacher::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
       ->where('year_id',session()->get('year_id'))
       ->get();
        if($th!="[]"){
            $scorenewteacher++;
        }
        //// ปิด การปฐมนิเทศอาจารย์ใหม่
        
        //// กิจกรรมการพัฒนาวิชาชีพของอาจารย์
        $scoreactivity=0;
        $activity=category4_activity::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if($activity!="[]"){
            $scoreactivity++;
        }
        //// ปิด กิจกรรมการพัฒนาวิชาชีพของอาจารย์
        ///ปิดหมวดที่ 4
        ///หมวดที่ 5 

        //// ตัวบ่งชี้ 6.1
        $score6_1resultdoc1=0;
        $score6_1result1=0;
        $score6_1resultpdca=0;
        $queryindicator6_1result1= PDCA::where('category_pdca',11)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',6.1)
        ->get();
        if($queryindicator6_1result1!="[]"){
            $queryindicator6_1resultdoc1p= docpdca::where('pdca_id',$queryindicator6_1result1[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator6_1resultdoc1p)!=0){
                $score6_1resultdoc1++;
            }
            $queryindicator6_1resultdoc1d= docpdca::where('pdca_id',$queryindicator6_1result1[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator6_1resultdoc1d)!=0){
                $score6_1resultdoc1++;
            }
            $queryindicator6_1resultdoc1c= docpdca::where('pdca_id',$queryindicator6_1result1[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator6_1resultdoc1c)!=0){
                $score6_1resultdoc1++;
            }
            $queryindicator6_1resultdoc1a= docpdca::where('pdca_id',$queryindicator6_1result1[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator6_1resultdoc1a)!=0){
                $score6_1resultdoc1++;
            }
        }
 

        if($queryindicator6_1result1!="[]"){
            if($queryindicator6_1result1[0]['p']!=""){
                $score6_1result1++;
            }
            if($queryindicator6_1result1[0]['d']!=""){
                $score6_1result1++;
            }
            if($queryindicator6_1result1[0]['c']!=""){
                $score6_1result1++;
            }
            if($queryindicator6_1result1[0]['a']!=""){
                $score6_1result1++;
            }
        }
       $queryindicator6_1resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',6.1)
        ->where('pdca.target','!=',null)
        ->get();
        if($queryindicator6_1resultpdca!="[]"){
            $score6_1resultpdca++;
        }
        //// ปิดตัวบ่งชี้ 6.1

        //// การบริหารหลักสูตร
        $scorecoursemanage=0;
        $coursemanage=category5_course_manage::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if($coursemanage!="[]"){
            $scorecoursemanage++;
        }
        //// ปิด การบริหารหลักสูตร


        ///ปิดหมวดที่ 5 

        ////หมวดที่ 6 
         //// สรุปการประเมินหลักสูตร	
         $scoreassessmentsummary=0;
         $scoreassessmentsummary2=0;
         $queryassessmentsummary=category6_assessment_summary::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('category_assessor','=','การประเมินจากผู้ที่สำเร็จการศึกษา')
         ->where('year_id',session()->get('year_id'))
         ->get();
         if($queryassessmentsummary!="[]"){
             $scoreassessmentsummary++;
         }        
         $queryassessmentsummary2=category6_assessment_summary::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('category_assessor','=','การประเมินจากผู้ที่มีส่วนเกี่ยวข้อง')
         ->where('year_id',session()->get('year_id'))
         ->get();
         if($queryassessmentsummary2!="[]"){
             $scoreassessmentsummary2++;
         }
         //// ปิด สรุปการประเมินหลักสูตร
 
         //// ข้อคิดเห็น และข้อเสนอแนะเกี่ยวกับคุณภาพหลักสูตรจากผู้ประเมิน
         $scorecomment_course=0;
         $querycomment_course=category6_comment_course::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
         if($querycomment_course!="[]"){
             $scorecomment_course++;
         }
         //// ปิด ข้อคิดเห็น และข้อเสนอแนะเกี่ยวกับคุณภาพหลักสูตรจากผู้ประเมิน
        ////ปิดหมวดที่ 6

        ////หมวดที่ 7 
         //// ความก้าวหน้าของการดำเนินงานตามแผนที่เสนอในรายงานของปีที่ผ่านมา
        $scorestrength=0;
        $querystrength=category7_strength::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if($querystrength!="[]"){
            $scorestrength++;
        }
        //// ปิด ความก้าวหน้าของการดำเนินงานตามแผนที่เสนอในรายงานของปีที่ผ่านมา


        //// ข้อเสนอในการพัฒนาหลักสูตร
        $scoredevelopment_proposal=0;
        $querydevelopment_proposal=category7_development_proposal_detail::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if($querydevelopment_proposal!="[]"){
            $scoredevelopment_proposal++;
        }
        //// ปิด ข้อเสนอในการพัฒนาหลักสูตร

         //// แผนปฏิบัติการใหม่
         $scorenewstrength=0;
         $querynewstrength=category7_newstrength::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
         if($querynewstrength!="[]"){
             $scorenewstrength++;
         }
         //// ปิด แผนปฏิบัติการใหม่
        ////ปิดหมวดที่7
        
        ////สรุปผลการดำเนินงาน
        //// สรุปจุดแข็ง จุดที่ควรพัฒนา และแนวทางการพัฒนา
        $scorestrengths_summary=0;
        $querynewstrength2=category7_strengths_summary::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('composition_id',2)
        ->get();
        $querynewstrength3=category7_strengths_summary::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('composition_id',3)
        ->get();
        $querynewstrength4=category7_strengths_summary::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('composition_id',4)
        ->get();
        $querynewstrength5=category7_strengths_summary::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('composition_id',5)
        ->get();
        $querynewstrength6=category7_strengths_summary::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('composition_id',6)
        ->get();

        if($querynewstrength2!="[]"){
           $scorestrengths_summary++;
       }
       if($querynewstrength3!="[]"){
           $scorestrengths_summary++;
       }
       if($querynewstrength4!="[]"){
           $scorestrengths_summary++;
       }
       if($querynewstrength5!="[]"){
           $scorestrengths_summary++;
       }
       if($querynewstrength6!="[]"){
           $scorestrengths_summary++;
       }
        //// ปิด สรุปจุดแข็ง จุดที่ควรพัฒนา และแนวทางการพัฒนา
        ////ปิด  สรุปผลการดำเนินงาน
        $getpermiss=indicator::where('active',1)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $check1=0;
        $check2=0;
        $check3=0;
        $check4=0;
        $check5=0;
        $check6=0;
        $check7=0;
        $check8=0;
        $check9=0;
        $check10=0;
        $check11=0;
        $check12=0;
        $check13=0;
        $check14=0;
        $check15=0;
        $check16=0;
        $check17=0;
        $check18=0;
        $check19=0;
        $check20=0;
        $check21=0;
        $check22=0;
        $check23=0;
        $check24=0;
        $check25=0;
        $check26=0;
        $check27=0;
        $check28=0;
        $check29=0;
        $check30=0;
        $check31=0;
        $check32=0;
        $check33=0;
        $check34=0;


        $checkdis1=0;
        $checkdis2=0;
        $checkdis3=0;
        $checkdis4=0;
        $checkdis5=0;
        $checkdis6=0;
        $checkdis7=0;
        $checkdis8=0;
        $checkdis9=0;
        $checkdis10=0;
        $checkdis11=0;
        $checkdis12=0;
        $checkdis13=0;
        $checkdis14=0;
        $checkdis15=0;
        $checkdis16=0;
        $checkdis17=0;
        $checkdis18=0;
        $checkdis19=0;
        $checkdis20=0;
        $checkdis21=0;
        $checkdis22=0;
        $checkdis23=0;
        $checkdis24=0;
        $checkdis25=0;
        $checkdis26=0;
        $checkdis27=0;
        $checkdis28=0;
        $checkdis29=0;
        $checkdis30=0;
        $checkdis31=0;
        $checkdis32=0;
        $checkdis33=0;
        $checkdis34=0;

        foreach($getpermiss as $checkper){
            if($checkper['Indicator_id']=="1.1"){
                $check1=9;
                $checkdis1=1;
            }
             if($checkper['Indicator_id']=="2.1"){
                $check2=2;
                $checkdis2=1;
            }
            if($checkper['Indicator_id']=="2.2"){
                $check3=3;
                $checkdis3=1;
            }
             if($checkper['Indicator_id']=="3.1"){
                $check4=17;
                $checkdis4=1;
            }
             if($checkper['Indicator_id']=="3.2"){
                $check5=17;
                $checkdis5=1;
            }
             if($checkper['Indicator_id']=="3.3"){
                $check6=4;
                $checkdis6=1;
            }
             if($checkper['Indicator_id']=="4.1"){
                $check7=25;
                $checkdis7=1;
            }
            if($checkper['Indicator_id']=="4.2"){
                $check8=3;
                $checkdis8=1;
           }
           if($checkper['Indicator_id']=="4.3"){
            $check9=3;
            $checkdis9=1;
           }
           if($checkper['Indicator_id']=="5.1"){
            $check10=25;
            $checkdis10=1;
           }
           if($checkper['Indicator_id']=="5.2"){
            $check11=25;
            $checkdis11=1;
           }
           if($checkper['Indicator_id']=="5.3"){
            $check12=17;
            $checkdis12=1;
           }
           if($checkper['Indicator_id']=="5.4"){
            $check13=2;
            $checkdis13=1;
           }
           if($checkper['Indicator_id']=="6.1"){
            $check14=9;
            $checkdis14=1;
               }
           
               if($checkper['Indicator_name']=="คุณภาพการสอน"){
                $check15=1;
                $checkdis15=1;
                   }
                if($checkper['Indicator_name']=="ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา"){
                    $check16=1;
                    $checkdis16=1;
                       }
                if($checkper['Indicator_name']=="ปัยจัยที่มีผลกระทบต่อการสำเร็จการศึกษา"){
                    $check17=1;
                    $checkdis17=1;
                           }
              if($checkper['Indicator_name']=="สรุปการประเมินหลักสูตร"){
                $check18=2;
                $checkdis18=1;
                               }
               if($checkper['Indicator_name']=="สรุปผลรายวิชาที่เปิดสอน"){
                $check19=1;
                $checkdis19=1;       
                                       }
               if($checkper['Indicator_name']=="รายวิชาที่มีผลการเรียนที่ไม่ปกติ"){
                $check20=1;
                $checkdis20=1;            
                                           }
               if($checkper['Indicator_name']=="รายวิชาที่ไม่ได้เปิดสอน"){
                $check21=1;
                $checkdis21=1;                
                                               }
               if($checkper['Indicator_name']=="รายวิชาที่สอนเนื้อหาไม่ครบ"){
                $check22=1;
                $checkdis22=1;                     
                                                   }
               if($checkper['Indicator_name']=="ประสิทธิผลของกลยุทธ์การสอน"){
                $check23=1;
                $checkdis23=1;                          
                                                       }
               if($checkper['Indicator_name']=="การปฐมนิเทศอาจารย์ใหม่"){
                $check24=1;
                $checkdis24=1;                              
                                                         }
              if($checkper['Indicator_name']=="กิจกรรมการพัฒนาวิชาชีพ"){
                $check25=1;
                $checkdis25=1;                                   
                                                            }
             if($checkper['Indicator_name']=="การบริหารหลักสูตร"){
                $check26=1;
                $checkdis26=1;                                        
                                                                }
            if($checkper['Indicator_name']=="ข้อคิดเห็น และข้อเสนอแนะ"){
                $check27=1;
                $checkdis27=1;                                             
                                                                 }
           if($checkper['Indicator_name']=="ความก้าวหน้าของการดำเนินงาน"){
            $check28=1;
            $checkdis28=1;                                                
                                                                   }
           if($checkper['Indicator_name']=="ข้อเสนอในการพัฒนาหลักสูตร"){
            $check29=1;
            $checkdis29=1;                                                     
                                                                 }
          if($checkper['Indicator_name']=="แผนปฏิบัติการใหม่"){
            $check30=1;
            $checkdis30=1;                                                            
                                                        }
          if($checkper['Indicator_name']=="ข้อมูลนักศึกษา"){
            $check31=2;
            $checkdis31=1;                                                                
                                                         }
        if($checkper['Indicator_name']=="จุดแข็ง จุดที่ควรพัฒนา"){
            $check32=5;
            $checkdis32=1;                                                                  
                                                          }
        if($checkper['Indicator_name']=="จำนวนผู้สำเร็จการศึกษา"){
            $check33=1;
            $checkdis33=1;                                                                        
                                                          }
        if($checkper['Indicator_name']=="จำนวนการลาออกและคัดชื่อออก"){
            $check34=1;
            $checkdis34=1;                                                      
                                                               }
        }
        
        if($checkdis1==0){
            $getscore1_1=0;
            $getscore1_1result=0;
        }
        if($checkdis2==0){
            $getscore2_1=0;
        }
        if($checkdis3==0){
            $getscore2_2=0;
        }
        if($checkdis4==0){
            $score3_1result1=0;
            $score3_1result2=0;
            $score3_1resultdoc1=0;
            $score3_1resultdoc2=0;
            $score3_1resultpdca=0;
        }
        if($checkdis5==0){
            $score3_2result1=0;
            $score3_2result2=0;
            $score3_2resultdoc1=0;
            $score3_2resultdoc2=0;
            $score3_2resultpdca=0;
        }
        if($checkdis6==0){
            $score3_3result1=0;
            $score3_3result2=0;
            $score3_3result3=0;
            $score3_3resultpdca=0;
        }
        if($checkdis7==0){
            $score4_1result1=0;
            $score4_1result2=0;
            $score4_1result3=0;
            $score4_1resultdoc1=0;
            $score4_1resultdoc2=0;
            $score4_1resultdoc3=0;
            $score4_1resultpdca=0;
        }
        if($checkdis8==0){
            $score4_2result1=0;
            $score4_2result2=0;
            $score4_2resultpdca=0;
        }
        if($checkdis9==0){
            $score4_3result1=0;
            $score4_3result2=0;
            $score4_3resultpdca=0;
        }
        if($checkdis10==0){
            $score5_1result1=0;
            $score5_1result2=0;
            $score5_1result3=0;
            $score5_1resultdoc1=0;
            $score5_1resultdoc2=0;
            $score5_1resultdoc3=0;
            $score5_1resultpdca=0;
        }
        if($checkdis11==0){
            $score5_2result1=0;
            $score5_2result2=0;
            $score5_2result3=0;
            $score5_2resultdoc1=0;
            $score5_2resultdoc2=0;
            $score5_2resultdoc3=0;
            $score5_2resultpdca=0;
        }
        if($checkdis12==0){
            $score5_3result1=0;
            $score5_3result2=0;
            $score5_3resultdoc1=0;
            $score5_3resultdoc2=0;
            $score5_3resultpdca=0;
        }
        if($checkdis13==0){
            $score5_4result1=0;
            $score5_4resultpdca=0;
        }
        if($checkdis14==0){
            $score6_1result1=0;
            $score6_1resultdoc1=0;
            $score6_1resultpdca=0;
        }
        if($checkdis15==0){
            $scoreteachqua=0;
        }
        if($checkdis16==0){
            $scorfactor=0;
        }
        if($checkdis17==0){
            $scorfactor2=0;
        }
        if($checkdis18==0){
            $scoreassessmentsummary=0;
            $scoreassessmentsummary2=0;
        }
        if($checkdis19==0){
            $scoreccr=0;
        }
        if($checkdis20==0){
            $scoreacademic=0;
        }
        if($checkdis21==0){
            $scorenot_offered=0;
        }
        if($checkdis22==0){
            $scoreincomplete_content=0;
        }
        if($checkdis23==0){
            $scoreeffec=0;
        }
        if($checkdis24==0){
            $scorenewteacher=0;
        }
        if($checkdis25==0){
            $scoreactivity=0;
        }
        if($checkdis26==0){
            $scorecoursemanage=0;
        }
        if($checkdis27==0){
            $scorecomment_course=0;
        }
        if($checkdis28==0){
            $scorestrength=0;
        }
        if($checkdis29==0){
            $scoredevelopment_proposal=0;
        }
        if($checkdis30==0){
            $scorenewstrength=0;
        }
        if($checkdis31==0){
            $scoreinfo=0;
            $scoreinfoqty=0;
        }
        if($checkdis32==0){
            $scorestrengths_summary=0;
        }
        if($checkdis33==0){
            $scoregraduate=0;
        }
        if($checkdis34==0){
            $scorere=0;
        }


        $discount1=$check1;
        $discount2=$check7+$check8+$check9;
        $discount3=$check2+$check3+$check4+$check5+$check6+$check16+$check17+$check31+$check33+$check34;
        $discount4=$check10+$check11+$check12+$check13+$check15+$check19+$check20+$check21+$check22+$check23+$check24+$check25;
        $discount5=$check14+$check26;
        $discount6=$check18+$check27;
        $discount7=$check28+$check29+$check30;
        $discount8=$check32;
        

        $result1=0;
        $result2=0;
        $result3=0;
        $result4=0;
        $result5=0;
        $result6=0;
        $result7=0;
        $result8=0;



        if($discount1!=0){
        $result1=(($getscore1_1+$getscore1_1result)*100)/$discount1;
        }
        if($discount2!=0){
        $result2=(($score4_1result1+$score4_1result2+$score4_1result3+$score4_1resultdoc1+$score4_1resultdoc2+
        $score4_1resultdoc3+$score4_1resultpdca+$score4_2result1+$score4_2result2+$score4_2resultpdca+$score4_3result1+
        $score4_3result2+$score4_3resultpdca)*100)/$discount2;
        }

        if($discount3!=0){
        $result3=(($getscore2_1+$getscore2_2+$score3_1result1+$score3_1result2+$score3_1resultdoc1+$score3_1resultdoc2+$score3_1resultpdca
                +$score3_2result1+$score3_2result2+$score3_2resultdoc1+$score3_2resultdoc2+$score3_2resultpdca
                +$score3_3result1+$score3_3result2+$score3_3result3+$score3_3resultpdca
                +$scorfactor+$scorfactor2+$scoreinfo+$scoreinfoqty+$scoregraduate+$scoregraduate+$scorere)*100)/$discount3;
        }
        if($discount4!=0){
        $result4=(($score5_1result1+$score5_1result2+$score5_1result3+$score5_1resultdoc1+$score5_1resultdoc2+
                    $score5_1resultdoc3+$score5_1resultpdca+$score5_2result1+$score5_2result2+$score5_2result3+
                    $score5_2resultdoc1+$score5_2resultdoc2+$score5_2resultdoc3+$score5_2resultpdca+
                    $score5_3result1+$score5_3result2+$score5_3resultdoc1+$score5_3resultdoc2+$score5_3resultpdca+
                    $score5_4result1+$score5_4resultpdca+$scoreteachqua+$scoreccr+$scoreacademic+$scorenot_offered+
                    $scoreincomplete_content+$scoreeffec+$scorenewteacher+$scoreactivity)*100)/$discount4;
        }
        if($discount5!=0){
        $result5=(($score6_1result1+$score6_1resultdoc1+$score6_1resultpdca+$scorecoursemanage)*100)/$discount5;
        }
        if($discount6!=0){
            $result6=(($scoreassessmentsummary+$scoreassessmentsummary2+$scorecomment_course)*100)/$discount6; 
        }
        if($discount7!=0){
            $result7=(($scorestrength+$scoredevelopment_proposal+$scorenewstrength)*100)/$discount7;
        }
        if($discount8!=0){
            $result8=($scorestrengths_summary*100)/$discount8;
        }
        $scorecategory1 = sprintf('%.0f',$result1);
        $scorecategory2 = sprintf('%.0f',$result2);
        $scorecategory3 = sprintf('%.0f',$result3);
        $scorecategory4 = sprintf('%.0f',$result4);
        $scorecategory5 = sprintf('%.0f',$result5);
        $scorecategory6 = sprintf('%.0f',$result6);
        $scorecategory7 = sprintf('%.0f',$result7);
        $scorecategory8 = sprintf('%.0f',$result8);
        $scoreall=0;
        if(count($crt)==5){
            $crtscore=25;
        }
        else if(count($crt)==4){
            $crtscore=20;
        }
        else if(count($crt)==3){
            $crtscore=15;
        }
        else if(count($crt)==2){
            $crtscore=10;
        }
        else if(count($crt)==1){
            $crtscore=5;
        }
        else {
            $crtscore=0;
        }

        if(count($ct)==5){
            $crt=25;
        }
        else if(count($crt)==4){
            $crt=20;
        }
        else if(count($crt)==3){
            $crt=15;
        }
        else if(count($crt)==2){
            $crt=10;
        }
        else if(count($crt)==1){
            $crt=5;
        }
        else {
            $crt=0;
        }
         ////สรุปคะแนน
        $max=count($role);
        $i=0;
        foreach($role as $getrole){

        
        if($getrole['category_id']==1){
            $role[$i]['score']=$scorecategory1;
            if($scorecategory1<=25){
                $role[$i]['color']='danger';
                $role[$i]['color2']='red';
            }
            else if($scorecategory1<=50){
                $role[$i]['color']='yellow';
                $role[$i]['color2']='yellow';
            }
            else if($scorecategory1<=75){
                $role[$i]['color']='striped';
                $role[$i]['color2']='blue';
            }
            else if($scorecategory1<=100){
                $role[$i]['color']='success';
                $role[$i]['color2']='green';
            }
            if($i<$max){
                $i++;
            }
           
        }
         if($getrole['category_id']==2){
            $role[$i]['score']=$scorecategory2;
            if($scorecategory2<=25){
                $role[$i]['color']='danger';
                $role[$i]['color2']='red';
            }
            else if($scorecategory2<=50){
                $role[$i]['color']='yellow';
                $role[$i]['color2']='yellow';
            }
            else if($scorecategory2<=75){
                $role[$i]['color']='striped';
                $role[$i]['color2']='blue';
            }
            else if($scorecategory2<=100){
                $role[$i]['color']='success';
                $role[$i]['color2']='green';
            }
            
            if($i<$max){
                $i++;
            }
        }
        if($getrole['category_id']==3){
            $role[$i]['score']=$scorecategory3;
            if($scorecategory3<=25){
                $role[$i]['color']='danger';
                $role[$i]['color2']='red';
            }
            else if($scorecategory3<=50){
                $role[$i]['color']='yellow';
                $role[$i]['color2']='yellow';
            }
            else if($scorecategory3<=75){
                $role[$i]['color']='striped';
                $role[$i]['color2']='blue';
            }
            else if($scorecategory3<=100){
                $role[$i]['color']='success';
                $role[$i]['color2']='green';
            }
            if($i<$max){
                $i++;
            }
        }
         if($getrole['category_id']==4){
            $role[$i]['score']=$scorecategory4;
            if($scorecategory4<=25){
                $role[$i]['color']='danger';
                $role[$i]['color2']='red';
            }
            else if($scorecategory4<=50){
                $role[$i]['color']='yellow';
                $role[$i]['color2']='yellow';
            }
            else if($scorecategory4<=75){
                $role[$i]['color']='striped';
                $role[$i]['color2']='blue';
            }
            else if($scorecategory4<=100){
                $role[$i]['color']='success';
                $role[$i]['color2']='green';
            }
            if($i!=$max){
                $i++;
            }
        }
         if($getrole['category_id']==5){
            $role[$i]['score']=$scorecategory5;
            if($scorecategory5<=25){
                $role[$i]['color']='danger';
                $role[$i]['color2']='red';
            }
            else if($scorecategory5<=50){
                $role[$i]['color']='yellow';
                $role[$i]['color2']='yellow';
            }
            else if($scorecategory5<=75){
                $role[$i]['color']='striped';
                $role[$i]['color2']='blue';
            }
            else if($scorecategory5<=100){
                $role[$i]['color']='success';
                $role[$i]['color2']='green';
            }
            if($i!=$max){
                $i++;
            }
        }
         if($getrole['category_id']==6){
            $role[$i]['score']=$scorecategory6;
            if($scorecategory6<=25){
                $role[$i]['color']='danger';
                $role[$i]['color2']='red';
            }
            else if($scorecategory6<=50){
                $role[$i]['color']='yellow';
                $role[$i]['color2']='yellow';
            }
            else if($scorecategory6<=75){
                $role[$i]['color']='striped';
                $role[$i]['color2']='blue';
            }
            else if($scorecategory6<=100){
                $role[$i]['color']='success';
                $role[$i]['color2']='green';
            }
            if($i!=$max){
                $i++;
            }
        }
         if($getrole['category_id']==7){
            $role[$i]['score']=$scorecategory7;
            if($scorecategory7<=25){
                $role[$i]['color']='danger';
                $role[$i]['color2']='red';
            }
            else if($scorecategory7<=50){
                $role[$i]['color']='yellow';
                $role[$i]['color2']='yellow';
            }
            else if($scorecategory7<=75){
                $role[$i]['color']='striped';
                $role[$i]['color2']='blue';
            }
            else if($scorecategory7<=100){
                $role[$i]['color']='success';
                $role[$i]['color2']='green';
            }
            if($i!=$max){
                $i++;
            }
        }
        if($getrole['category_id']==8){
            $role[$i]['score']=$scorecategory8;
            if($scorecategory8<=25){
                $role[$i]['color']='danger';
                $role[$i]['color2']='red';
            }
            else if($scorecategory8<=50){
                $role[$i]['color']='yellow';
                $role[$i]['color2']='yellow';
            }
            else if($scorecategory8<=75){
                $role[$i]['color']='striped';
                $role[$i]['color2']='blue';
            }
            else if($scorecategory8<=100){
                $role[$i]['color']='success';
                $role[$i]['color2']='green';
            }
            if($i!=$max){
                $i++;
            }
        }
    }
            $userpermis=user_permission::leftjoin('users','user_permission.user_id','=','users.id')
            ->where('user_permission.year_id',session()->get('year_id'))
            ->where('users.user_course',session()->get('usercourse'))
            ->where('users.user_branch',session()->get('branch_id'))
            ->groupBy('user_permission.category_id')
            ->groupBy('user_permission.user_id')
            ->get();
            $c1=0;
            $c2=0;
            $c3=0;
            $c4=0;
            $c5=0;
            $c6=0;
            $c7=0;
            $c8=0;
            $c9=0;
            $getcounn=count($userpermis);
            $x=0;
            $getgetget=$getcounn*2;
            if($getgetget>8){
                $getgetget=8;
            }
            $userpermis3=user_permission::leftjoin('users','user_permission.user_id','=','users.id')
            ->where('user_permission.year_id',session()->get('year_id'))
            ->where('users.user_course',session()->get('usercourse'))
            ->where('users.user_branch',session()->get('branch_id'))
            ->groupBy('user_permission.category_id')
            ->groupBy('user_permission.user_id')
            ->first();
            $userpermis4=user_permission::leftjoin('users','user_permission.user_id','=','users.id')
            ->where('user_permission.year_id',session()->get('year_id'))
            ->where('users.user_course',session()->get('usercourse'))
            ->where('users.user_branch',session()->get('branch_id'))
            ->groupBy('user_permission.category_id')
            ->groupBy('user_permission.user_id')
            ->orderBy('category_id', 'desc')->first();

            if($getcounn!=0){
            for($s=$userpermis3['category_id'];$s<=$userpermis4['category_id'];$s++){
                $userpermis2=$userpermis->where('category_id',$s);
                
                if($userpermis2!="[]")
                {
                    $pass=0;
                    foreach($userpermis2 as $per){
                        $getkey=0;
                        foreach($role as $key2=>$checkdata){
                            if($checkdata['category_id']==$per['category_id']){
                                $role[$key2]['code']=$role[$key2]['code'].'<span class="badge bg-green">'.$per['user_fullname'].'</span>';
                            }
                        }
                         
                         
                    }
                }
            }
            }

                // if($per['category_id']==2){
                //     $role[$x]['code']=$role[$x]['code'].'<span class="badge bg-green">'.$per['user_fullname'].'</span>';
                //     $x++;
                // }
                // if($per['category_id']==3){
                //     $role[$x]['code']=$role[$x]['code'].'<span class="badge bg-green">'.$per['user_fullname'].'</span>';
                //     $x++;
                // }
                // if($per['category_id']==4){
                //     $role[$x]['code']=$role[$x]['code'].'<span class="badge bg-green">'.$per['user_fullname'].'</span>';
                //     $x++;
                // }
                // if($per['category_id']==5){
                //     $role[$x]['code']=$role[$x]['code'].'<span class="badge bg-green">'.$per['user_fullname'].'</span>';
                //     $x++;
                // }
                // if($per['category_id']==6){
                //     $role[$x]['code']=$role[$x]['code'].'<span class="badge bg-green">'.$per['user_fullname'].'</span>';
                //     $x++;
                // }
                // if($per['category_id']==7){
                //     $role[$x]['code']=$role[$x]['code'].'<span class="badge bg-green">'.$per['user_fullname'].'</span>';
                //     $x++;
                // }
                // if($per['category_id']==8){
                //     $role[$x]['code']=$role[$x]['code'].'<span class="badge bg-green">'.$per['user_fullname'].'</span>';
                //     $x++;
                // }
           
            
         ////สรุปคะแนน
       return $role;
       
    }
    public function getclidincategory2($id)
    {
        $clind=indicator::where('category_id',$id)
        ->where('year_id',session()->get('year_id'))
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('active',1)
        ->get();

        ////ตัวบ่งชี้ 1.1
        $getscore1_1=0;
        $getscore1_1result=0;
        $score1_1=0;
        $queryindicator1_1=indicator1_1::where('year_id',session()->get('year_id'))
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->get();
        
        $queryindicator1_1result= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',1.1)
        ->where('pdca.target','!=',null)
        ->get();

        //ดึงค่าตารางอาจารย์ผู้รับผิดชอบหลักสูตร
        $trc = course_responsible_teacher::join('year','course_responsible_teacher.year_id','=','year.year_id')
        ->where('course_responsible_teacher.course_id',session()->get('usercourse'))
        ->where('course_responsible_teacher.branch_id',session()->get('branch_id'))
        ->where('year.year_id',session()->get('year_id'))
        ->get();
         ////ดึงสาขาวิชาที่จบของอาจารย์ประจำหลักสูตร
         $tc_course= User::leftjoin('course_teacher','users.id','=','course_teacher.user_id')
         ->where('users.user_course',session()->get('usercourse'))
         ->where('users.user_branch',session()->get('branch_id'))
         ->where('course_teacher.year_id',session()->get('year_id'))
         ->get();

         ////ดึงสาขาวิชาที่จบของอาจารย์ผู้สอน
         $instructor= User::leftjoin('instructor','users.id','=','instructor.user_id')
         ->where('users.user_course',session()->get('usercourse'))
         ->where('users.user_branch',session()->get('branch_id'))
         ->where('instructor.year_id',session()->get('year_id'))
         ->get();
         if(count($trc)!=0){
            $getscore1_1++;
        }

        if(count($tc_course)!=0){
            $getscore1_1++;
        }
        if(count($instructor)!=0){
            $getscore1_1++;
        }
        if(count($queryindicator1_1)!=0){
            if($queryindicator1_1[0]['result1']!=""){
                $getscore1_1++;
            }
            if($queryindicator1_1[0]['result2']!=""){
                $getscore1_1++;
            }
            if($queryindicator1_1[0]['result3']!=""){
                $getscore1_1++;
            }
            if($queryindicator1_1[0]['result4']!=""){
                $getscore1_1++;
            }
            if($queryindicator1_1[0]['result5']!=""){
                $getscore1_1++;
            }
        }
        if(count($queryindicator1_1result)!=0){
            $getscore1_1result++;
        }
        
        ////ตัวบ่งชี้ 1.1


        ////ตัวบ่งชี้ 2.1
        $getscore2_1=0;
        $getscore2_1result=0;
        $score2_1=0;
        $queryindicator2_1=indicator2_1::where('year_id',session()->get('year_id'))
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->get();
        $queryindicator2_1result= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',2.1)
        ->where('pdca.target','!=',null)
        ->get();
        if(count($queryindicator2_1)!=0){
            $getscore2_1++;
        }
        if(count($queryindicator2_1result)!=0){
            $getscore2_1++;
        }
        
        ////ตัวบ่งชี้ 2.1

        ////ตัวบ่งชี้ 2.2
        $getscore2_2=0;
        $getscore2_2result=0;
        $queryindicator2_2=indicator2_2::where('year_id',session()->get('year_id'))
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->get();
        $queryindicator2_2result= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',2.2)
        ->where('pdca.target','!=',null)
        ->get();
        if(count($queryindicator2_2)!=0){
            $getscore2_2++;
        }
        if(count($queryindicator2_2result)!=0){
            $getscore2_2++;
        }
        
        ////ตัวบ่งชี้ 2.2

        //// ตัวบ่งชี้ 3.1
        $score3_1resultdoc1=0;
        $score3_1resultdoc2=0;
        $score3_1result1=0;
        $score3_1result2=0;
        $score3_1resultpdca=0;
        $queryindicator3_1result1= PDCA::where('category_pdca',4)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',3.1)
        ->get();
        if($queryindicator3_1result1!="[]"){
            $queryindicator3_1resultdoc1p= docpdca::where('pdca_id',$queryindicator3_1result1[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator3_1resultdoc1p)!=0){
                $score3_1resultdoc1++;
            }
            $queryindicator3_1resultdoc1d= docpdca::where('pdca_id',$queryindicator3_1result1[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator3_1resultdoc1d)!=0){
                $score3_1resultdoc1++;
            }
            $queryindicator3_1resultdoc1c= docpdca::where('pdca_id',$queryindicator3_1result1[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator3_1resultdoc1c)!=0){
                $score3_1resultdoc1++;
            }
            $queryindicator3_1resultdoc1a= docpdca::where('pdca_id',$queryindicator3_1result1[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator3_1resultdoc1a)!=0){
                $score3_1resultdoc1++;
            }
        }
        
        $queryindicator3_1result2= PDCA::where('category_pdca',5)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',3.1)
        ->get();
        if($queryindicator3_1result2!="[]"){
            $queryindicator3_1resultdoc2p= docpdca::where('pdca_id',$queryindicator3_1result2[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator3_1resultdoc2p)!=0){
                $score3_1resultdoc2++;
            }
            $queryindicator3_1resultdoc2d= docpdca::where('pdca_id',$queryindicator3_1result2[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator3_1resultdoc2d)!=0){
                $score3_1resultdoc2++;
            }
            $queryindicator3_1resultdoc2c= docpdca::where('pdca_id',$queryindicator3_1result2[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator3_1resultdoc2c)!=0){
                $score3_1resultdoc2++;
            }
            $queryindicator3_1resultdoc2a= docpdca::where('pdca_id',$queryindicator3_1result2[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator3_1resultdoc2a)!=0){
                $score3_1resultdoc2++;
            }
        }
 

        if($queryindicator3_1result1!="[]"){
            if($queryindicator3_1result1[0]['p']!=""){
                $score3_1result1++;
            }
            if($queryindicator3_1result1[0]['d']!=""){
                $score3_1result1++;
            }
            if($queryindicator3_1result1[0]['c']!=""){
                $score3_1result1++;
            }
            if($queryindicator3_1result1[0]['a']!=""){
                $score3_1result1++;
            }
        }
        
        if($queryindicator3_1result2!="[]"){
        if($queryindicator3_1result2[0]['p']!=""){
            $score3_1result2++;
        }
        if($queryindicator3_1result2[0]['d']!=""){
            $score3_1result2++;
        }
        if($queryindicator3_1result2[0]['c']!=""){
            $score3_1result2++;
        }
        if($queryindicator3_1result2[0]['a']!=""){
            $score3_1result2++;
        }
        }

       $queryindicator3_1resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',3.1)
        ->where('pdca.target','!=',null)
        ->get();
        if($queryindicator3_1resultpdca!="[]"){
            $score3_1resultpdca++;
        }
        //// ปิดตัวบ่งชี้ 3.1


        //// ตัวบ่งชี้ 3.2
        $score3_2resultdoc1=0;
        $score3_2resultdoc2=0;
        $score3_2result1=0;
        $score3_2result2=0;
        $score3_2resultpdca=0;
        $queryindicator3_2result1= PDCA::where('category_pdca',6)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',3.2)
        ->get();
        if($queryindicator3_2result1!="[]"){
            $queryindicator3_2resultdoc1p= docpdca::where('pdca_id',$queryindicator3_2result1[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator3_2resultdoc1p)!=0){
                $score3_2resultdoc1++;
            }
            $queryindicator3_2resultdoc1d= docpdca::where('pdca_id',$queryindicator3_2result1[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator3_2resultdoc1d)!=0){
                $score3_2resultdoc1++;
            }
            $queryindicator3_2resultdoc1c= docpdca::where('pdca_id',$queryindicator3_2result1[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator3_2resultdoc1c)!=0){
                $score3_2resultdoc1++;
            }
            $queryindicator3_2resultdoc1a= docpdca::where('pdca_id',$queryindicator3_2result1[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator3_2resultdoc1a)!=0){
                $score3_2resultdoc1++;
            }
        }
        
        $queryindicator3_2result2= PDCA::where('category_pdca',7)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',3.2)
        ->get();
        if($queryindicator3_2result2!="[]"){
            $queryindicator3_2resultdoc2p= docpdca::where('pdca_id',$queryindicator3_2result2[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator3_2resultdoc2p)!=0){
                $score3_2resultdoc2++;
            }
            $queryindicator3_2resultdoc2d= docpdca::where('pdca_id',$queryindicator3_2result2[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator3_2resultdoc2d)!=0){
                $score3_2resultdoc2++;
            }
            $queryindicator3_2resultdoc2c= docpdca::where('pdca_id',$queryindicator3_2result2[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator3_2resultdoc2c)!=0){
                $score3_2resultdoc2++;
            }
            $queryindicator3_2resultdoc2a= docpdca::where('pdca_id',$queryindicator3_2result2[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator3_2resultdoc2a)!=0){
                $score3_2resultdoc2++;
            }
        }
 

        if($queryindicator3_2result1!="[]"){
            if($queryindicator3_2result1[0]['p']!=""){
                $score3_2result1++;
            }
            if($queryindicator3_2result1[0]['d']!=""){
                $score3_2result1++;
            }
            if($queryindicator3_2result1[0]['c']!=""){
                $score3_2result1++;
            }
            if($queryindicator3_2result1[0]['a']!=""){
                $score3_2result1++;
            }
        }
        
        if($queryindicator3_2result2!="[]"){
        if($queryindicator3_2result2[0]['p']!=""){
            $score3_2result2++;
        }
        if($queryindicator3_2result2[0]['d']!=""){
            $score3_2result2++;
        }
        if($queryindicator3_2result2[0]['c']!=""){
            $score3_2result2++;
        }
        if($queryindicator3_2result2[0]['a']!=""){
            $score3_2result2++;
        }
        }

       $queryindicator3_2resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',3.2)
        ->where('pdca.target','!=',null)
        ->get();
        if($queryindicator3_2resultpdca!="[]"){
            $score3_2resultpdca++;
        }
        //// ปิดตัวบ่งชี้ 3.2

         ////ตัวบ่งชี้ 3.3
         $score3_3resultdoc1=0;
         $score3_3resultdoc2=0;
         $score3_3result1=0;
         $score3_3result2=0;
         $score3_3result3=0;
         $score3_3resultpdca=0;
         $queryindicator3_3result=performance3_3::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
         if($queryindicator3_3result!="[]"){
             // $queryindicator3_3resultdoc= docpdca::where('doc_id',$queryindicator3_3result[0]['id'])
             // ->get();
             // if(count($queryindicator3_3resultdoc)!=0){
             //     $score3_3resultdoc1++;
             // }
             if(count($queryindicator3_3result)==3){
                 $score3_3result1++;
                 $score3_3result2++;
                 $score3_3result3++;
             }
         }
         $queryindicator3_3resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
         ->where('pdca.branch_id',session()->get('branch_id'))
         ->where('pdca.year_id',session()->get('year_id'))
         ->where('pdca.Indicator_id',3.3)
         ->where('pdca.target','!=',null)
         ->get();
         if($queryindicator3_3resultpdca!="[]"){
             $score3_3resultpdca++;
         }
         ////ปิดตัวบ่งชี้ 3.3

         ////ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา
         $scorfactor=0;
         $factor=category3_GD::where('category_factor','ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา')
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
        ->get();
        if($factor!="[]"){
            $scorfactor++;
        }
         ////ปิด ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา

          ////ปัยจัยที่มีผลกระทบต่อการสำเร็จการศึกษา
          $scorfactor2=0;
          $factor2=category3_GD::where('category_factor','ปัยจัยที่มีผลกระทบต่อการสำเร็จการศึกษา')
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
          ->where('year_id',session()->get('year_id'))
         ->get();
         if($factor2!="[]"){
             $scorfactor2++;
         }
          ////ปิด ปัยจัยที่มีผลกระทบต่อการสำเร็จการศึกษา

         ////ข้อมูลนักศึกษา
         $scoreinfo=0;
         $scoreinfoqty=0;
         $getyear=category3_infostudent::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
            ->where('year_add',session()->get('year'))
            ->get();
        $getqty=category3_infostudent_qty::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
            ->where('year_id',session()->get('year_id'))
            ->get();
        if($getyear!="[]"){
            $scoreinfo++;
        }
        if($getqty!="[]"){
            $scoreinfoqty++;
        }
         ////ปิด ข้อมูลนักศึกษา

        ////จำนวนผู้สำเร็จการศึกษา
        $get=year_acceptance_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->get();
        $scoregraduate=0;
        if($get!="[]"){
            $getinfo=category3_graduate::where('course_id',session()->get('usercourse'))
            ->where('branch_id',session()->get('branch_id'))
            ->where('reported_year',session()->get('year'))
            ->get();
            if($getinfo!="[]"){
                $scoregraduate++;
            }
        }
       
       
        ////ปิด จำนวนผู้สำเร็จการศึกษา

       ////จำนวนที่ลาออกและคัดชื่อออกสะสมจนถึงสิ้นปีการศึกษา
       $scorere=0;
        $re=category3_resignation::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_present',session()->get('year'))
        ->get();
      if($re!="[]"){
          $scorere++;
      }
       ////ปิด จำนวนที่ลาออกและคัดชื่อออกสะสมจนถึงสิ้นปีการศึกษา

          //// ตัวบ่งชี้ 4.1
          $score4_1resultdoc1=0;
          $score4_1resultdoc2=0;
          $score4_1resultdoc3=0;
          $score4_1result1=0;
          $score4_1result2=0;
          $score4_1result3=0;
          $score4_1resultpdca=0;
          $queryindicator4_1result1= PDCA::where('category_pdca',1)
          ->where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
          ->where('year_id',session()->get('year_id'))
          ->where('Indicator_id',4.1)
          ->get();
          if($queryindicator4_1result1!="[]"){
              $queryindicator4_1resultdoc1p= docpdca::where('pdca_id',$queryindicator4_1result1[0]['pdca_id'])
              ->where('categorypdca','p')
              ->get();
              if(count($queryindicator4_1resultdoc1p)!=0){
                  $score4_1resultdoc1++;
              }
              $queryindicator4_1resultdoc1d= docpdca::where('pdca_id',$queryindicator4_1result1[0]['pdca_id'])
              ->where('categorypdca','d')
              ->get();
              if(count($queryindicator4_1resultdoc1d)!=0){
                  $score4_1resultdoc1++;
              }
              $queryindicator4_1resultdoc1c= docpdca::where('pdca_id',$queryindicator4_1result1[0]['pdca_id'])
              ->where('categorypdca','c')
              ->get();
              if(count($queryindicator4_1resultdoc1c)!=0){
                  $score4_1resultdoc1++;
              }
              $queryindicator4_1resultdoc1a= docpdca::where('pdca_id',$queryindicator4_1result1[0]['pdca_id'])
              ->where('categorypdca','a')
              ->get();
              if(count($queryindicator4_1resultdoc1a)!=0){
                  $score4_1resultdoc1++;
              }
          }
          
          $queryindicator4_1result2= PDCA::where('category_pdca',2)
          ->where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
          ->where('year_id',session()->get('year_id'))
          ->where('Indicator_id',4.1)
          ->get();
          if($queryindicator4_1result2!="[]"){
              $queryindicator4_1resultdoc2p= docpdca::where('pdca_id',$queryindicator4_1result2[0]['pdca_id'])
              ->where('categorypdca','p')
              ->get();
              if(count($queryindicator4_1resultdoc2p)!=0){
                  $score4_1resultdoc2++;
              }
              $queryindicator4_1resultdoc2d= docpdca::where('pdca_id',$queryindicator4_1result2[0]['pdca_id'])
              ->where('categorypdca','d')
              ->get();
              if(count($queryindicator4_1resultdoc2d)!=0){
                  $score4_1resultdoc2++;
              }
              $queryindicator4_1resultdoc2c= docpdca::where('pdca_id',$queryindicator4_1result2[0]['pdca_id'])
              ->where('categorypdca','c')
              ->get();
              if(count($queryindicator4_1resultdoc2c)!=0){
                  $score4_1resultdoc2++;
              }
              $queryindicator4_1resultdoc2a= docpdca::where('pdca_id',$queryindicator4_1result2[0]['pdca_id'])
              ->where('categorypdca','a')
              ->get();
              if(count($queryindicator4_1resultdoc2a)!=0){
                  $score4_1resultdoc2++;
              }
          }
          $queryindicator4_1result3= PDCA::where('category_pdca',3)
          ->where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
          ->where('year_id',session()->get('year_id'))
          ->where('Indicator_id',4.1)
          ->get();
          if($queryindicator4_1result3!="[]"){
              $queryindicator4_1resultdoc3p= docpdca::where('pdca_id',$queryindicator4_1result3[0]['pdca_id'])
              ->where('categorypdca','p')
              ->get();
              if(count($queryindicator4_1resultdoc3p)!=0){
                  $score4_1resultdoc3++;
              }
              $queryindicator4_1resultdoc3d= docpdca::where('pdca_id',$queryindicator4_1result3[0]['pdca_id'])
              ->where('categorypdca','d')
              ->get();
              if(count($queryindicator4_1resultdoc3d)!=0){
                  $score4_1resultdoc3++;
              }
              $queryindicator4_1resultdoc3c= docpdca::where('pdca_id',$queryindicator4_1result3[0]['pdca_id'])
              ->where('categorypdca','c')
              ->get();
              if(count($queryindicator4_1resultdoc3c)!=0){
                  $score4_1resultdoc3++;
              }
              $queryindicator4_1resultdoc3a= docpdca::where('pdca_id',$queryindicator4_1result3[0]['pdca_id'])
              ->where('categorypdca','a')
              ->get();
              if(count($queryindicator4_1resultdoc3a)!=0){
                  $score4_1resultdoc3++;
              }
          }
          $queryindicator2_1result= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
          ->where('pdca.course_id',session()->get('usercourse'))
          ->where('pdca.branch_id',session()->get('branch_id'))
          ->where('pdca.year_id',session()->get('year_id'))
          ->where('pdca.Indicator_id',2.1)
          ->where('pdca.target','!=',null)
          ->get();
          if($queryindicator4_1result1!="[]"){
              if($queryindicator4_1result1[0]['p']!=""){
                  $score4_1result1++;
              }
              if($queryindicator4_1result1[0]['d']!=""){
                  $score4_1result1++;
              }
              if($queryindicator4_1result1[0]['c']!=""){
                  $score4_1result1++;
              }
              if($queryindicator4_1result1[0]['a']!=""){
                  $score4_1result1++;
              }
          }
          
          if($queryindicator4_1result2!="[]"){
          if($queryindicator4_1result2[0]['p']!=""){
              $score4_1result2++;
          }
          if($queryindicator4_1result2[0]['d']!=""){
              $score4_1result2++;
          }
          if($queryindicator4_1result2[0]['c']!=""){
              $score4_1result2++;
          }
          if($queryindicator4_1result2[0]['a']!=""){
              $score4_1result2++;
          }
          }
  
          if($queryindicator4_1result3!="[]"){
          if($queryindicator4_1result3[0]['p']!=""){
              $score4_1result3++;
          }
          if($queryindicator4_1result3[0]['d']!=""){
              $score4_1result3++;
          }
          if($queryindicator4_1result3[0]['c']!=""){
              $score4_1result3++;
          }
          if($queryindicator4_1result3[0]['a']!=""){
              $score4_1result3++;
          }
         }
         $queryindicator4_1resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
          ->where('pdca.course_id',session()->get('usercourse'))
          ->where('pdca.branch_id',session()->get('branch_id'))
          ->where('pdca.year_id',session()->get('year_id'))
          ->where('pdca.Indicator_id',4.1)
          ->where('pdca.target','!=',null)
          ->get();
          if($queryindicator4_1resultpdca!="[]"){
              $score4_1resultpdca++;
          }
          //// ตัวบ่งชี้ 4.1


          //// ตัวบ่งชี้ 4.2
          $score4_2result1=0;
          $score4_2result2=0;
          $score4_2resultpdca=0;
          //ดึงค่าตารางอาจารย์ผู้รับผิดชอบหลักสูตร
            $trc = course_responsible_teacher::join('year','course_responsible_teacher.year_id','=','year.year_id')
            ->where('course_responsible_teacher.course_id',session()->get('usercourse'))
            ->where('course_responsible_teacher.branch_id',session()->get('branch_id'))
            ->where('year.year_id',session()->get('year_id'))
            ->get();
            $educ_bg= User::leftjoin('course_responsible_teacher','users.id','=','course_responsible_teacher.user_id')
            ->where('users.user_course',session()->get('usercourse'))
            ->where('users.user_branch',session()->get('branch_id'))
            ->where('course_responsible_teacher.year_id',session()->get('year_id'))
            ->get();
            foreach($educ_bg as $key=>$t){
                if(count($educ_bg[$key]->research_results)!=0){
                        $score4_2result2=1;
                }
            }
           
            $queryindicator4_2resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
            ->where('pdca.course_id',session()->get('usercourse'))
            ->where('pdca.branch_id',session()->get('branch_id'))
            ->where('pdca.year_id',session()->get('year_id'))
            ->where('pdca.Indicator_id',4.2)
            ->where('pdca.target','!=',null)
            ->get();
            if($trc!="[]"){
                if(count($trc)!=0){
                    $score4_2result1++;
                }
            }
            if($queryindicator4_2resultpdca!="[]"){
                $score4_2resultpdca++;
            }
          ////ปิด ตัวบ่งชี้ 4.2

          ////ตัวบ่งชี้ 4.3
        $score4_3resultdoc1=0;
        $score4_3resultdoc2=0;
        $score4_3result1=0;
        $score4_3result2=0;

        $score4_3resultpdca=0;
        $queryindicator4_3result=indicator4_3::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if($queryindicator4_3result!="[]"){
            // $queryindicator4_3resultdoc= docpdca::where('doc_id',$queryindicator4_3result[0]['id'])
            // ->get();
            // if(count($queryindicator4_3resultdoc)!=0){
            //     $score4_3resultdoc1++;
            // }
            if(count($queryindicator4_3result)==2){
                $score4_3result1++;
                $score4_3result2++;
            }
        }
        $queryindicator4_3resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',4.3)
        ->where('pdca.target','!=',null)
        ->get();
        if($queryindicator4_3resultpdca!="[]"){
            $score4_3resultpdca++;
        }
        ////ตัวบ่งชี้ 4.3

         //// ตัวบ่งชี้ 5.1
         $score5_1resultdoc1=0;
         $score5_1resultdoc2=0;
         $score5_1resultdoc3=0;
         $score5_1result1=0;
         $score5_1result2=0;
         $score5_1result3=0;
         $score5_1resultpdca=0;
         $queryindicator5_1result1= PDCA::where('category_pdca',12)
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->where('Indicator_id',5.1)
         ->get();
         if($queryindicator5_1result1!="[]"){
             $queryindicator5_1resultdoc1p= docpdca::where('pdca_id',$queryindicator5_1result1[0]['pdca_id'])
             ->where('categorypdca','p')
             ->get();
             if(count($queryindicator5_1resultdoc1p)!=0){
                 $score5_1resultdoc1++;
             }
             $queryindicator5_1resultdoc1d= docpdca::where('pdca_id',$queryindicator5_1result1[0]['pdca_id'])
             ->where('categorypdca','d')
             ->get();
             if(count($queryindicator5_1resultdoc1d)!=0){
                 $score5_1resultdoc1++;
             }
             $queryindicator5_1resultdoc1c= docpdca::where('pdca_id',$queryindicator5_1result1[0]['pdca_id'])
             ->where('categorypdca','c')
             ->get();
             if(count($queryindicator5_1resultdoc1c)!=0){
                 $score5_1resultdoc1++;
             }
             $queryindicator5_1resultdoc1a= docpdca::where('pdca_id',$queryindicator5_1result1[0]['pdca_id'])
             ->where('categorypdca','a')
             ->get();
             if(count($queryindicator5_1resultdoc1a)!=0){
                 $score5_1resultdoc1++;
             }
         }
         
         $queryindicator5_1result2= PDCA::where('category_pdca',13)
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->where('Indicator_id',5.1)
         ->get();
         if($queryindicator5_1result2!="[]"){
             $queryindicator5_1resultdoc2p= docpdca::where('pdca_id',$queryindicator5_1result2[0]['pdca_id'])
             ->where('categorypdca','p')
             ->get();
             if(count($queryindicator5_1resultdoc2p)!=0){
                 $score5_1resultdoc2++;
             }
             $queryindicator5_1resultdoc2d= docpdca::where('pdca_id',$queryindicator5_1result2[0]['pdca_id'])
             ->where('categorypdca','d')
             ->get();
             if(count($queryindicator5_1resultdoc2d)!=0){
                 $score5_1resultdoc2++;
             }
             $queryindicator5_1resultdoc2c= docpdca::where('pdca_id',$queryindicator5_1result2[0]['pdca_id'])
             ->where('categorypdca','c')
             ->get();
             if(count($queryindicator5_1resultdoc2c)!=0){
                 $score5_1resultdoc2++;
             }
             $queryindicator5_1resultdoc2a= docpdca::where('pdca_id',$queryindicator5_1result2[0]['pdca_id'])
             ->where('categorypdca','a')
             ->get();
             if(count($queryindicator5_1resultdoc2a)!=0){
                 $score5_1resultdoc2++;
             }
         }
         $queryindicator5_1result3= PDCA::where('category_pdca',14)
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->where('Indicator_id',5.1)
         ->get();
         if($queryindicator5_1result3!="[]"){
             $queryindicator5_1resultdoc3p= docpdca::where('pdca_id',$queryindicator5_1result3[0]['pdca_id'])
             ->where('categorypdca','p')
             ->get();
             if(count($queryindicator5_1resultdoc3p)!=0){
                 $score5_1resultdoc3++;
             }
             $queryindicator5_1resultdoc3d= docpdca::where('pdca_id',$queryindicator5_1result3[0]['pdca_id'])
             ->where('categorypdca','d')
             ->get();
             if(count($queryindicator5_1resultdoc3d)!=0){
                 $score5_1resultdoc3++;
             }
             $queryindicator5_1resultdoc3c= docpdca::where('pdca_id',$queryindicator5_1result3[0]['pdca_id'])
             ->where('categorypdca','c')
             ->get();
             if(count($queryindicator5_1resultdoc3c)!=0){
                 $score5_1resultdoc3++;
             }
             $queryindicator5_1resultdoc3a= docpdca::where('pdca_id',$queryindicator5_1result3[0]['pdca_id'])
             ->where('categorypdca','a')
             ->get();
             if(count($queryindicator5_1resultdoc3a)!=0){
                 $score5_1resultdoc3++;
             }
         }

         if($queryindicator5_1result1!="[]"){
             if($queryindicator5_1result1[0]['p']!=""){
                 $score5_1result1++;
             }
             if($queryindicator5_1result1[0]['d']!=""){
                 $score5_1result1++;
             }
             if($queryindicator5_1result1[0]['c']!=""){
                 $score5_1result1++;
             }
             if($queryindicator5_1result1[0]['a']!=""){
                 $score5_1result1++;
             }
         }
         
         if($queryindicator5_1result2!="[]"){
         if($queryindicator5_1result2[0]['p']!=""){
             $score5_1result2++;
         }
         if($queryindicator5_1result2[0]['d']!=""){
             $score5_1result2++;
         }
         if($queryindicator5_1result2[0]['c']!=""){
             $score5_1result2++;
         }
         if($queryindicator5_1result2[0]['a']!=""){
             $score5_1result2++;
         }
         }
 
         if($queryindicator5_1result3!="[]"){
         if($queryindicator5_1result3[0]['p']!=""){
             $score5_1result3++;
         }
         if($queryindicator5_1result3[0]['d']!=""){
             $score5_1result3++;
         }
         if($queryindicator5_1result3[0]['c']!=""){
             $score5_1result3++;
         }
         if($queryindicator5_1result3[0]['a']!=""){
             $score5_1result3++;
         }
        }
        $queryindicator5_1resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
         ->where('pdca.branch_id',session()->get('branch_id'))
         ->where('pdca.year_id',session()->get('year_id'))
         ->where('pdca.Indicator_id',5.1)
         ->where('pdca.target','!=',null)
         ->get();
         if($queryindicator5_1resultpdca!="[]"){
             $score5_1resultpdca++;
         }
         //// ปิด ตัวบ่งชี้ 5.1

         //// ตัวบ่งชี้ 5.2
         $score5_2resultdoc1=0;
         $score5_2resultdoc2=0;
         $score5_2resultdoc3=0;
         $score5_2result1=0;
         $score5_2result2=0;
         $score5_2result3=0;
         $score5_2resultpdca=0;
         $queryindicator5_2result1= PDCA::where('category_pdca',8)
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->where('Indicator_id',5.2)
         ->get();
         if($queryindicator5_2result1!="[]"){
             $queryindicator5_2resultdoc1p= docpdca::where('pdca_id',$queryindicator5_2result1[0]['pdca_id'])
             ->where('categorypdca','p')
             ->get();
             if(count($queryindicator5_2resultdoc1p)!=0){
                 $score5_2resultdoc1++;
             }
             $queryindicator5_2resultdoc1d= docpdca::where('pdca_id',$queryindicator5_2result1[0]['pdca_id'])
             ->where('categorypdca','d')
             ->get();
             if(count($queryindicator5_2resultdoc1d)!=0){
                 $score5_2resultdoc1++;
             }
             $queryindicator5_2resultdoc1c= docpdca::where('pdca_id',$queryindicator5_2result1[0]['pdca_id'])
             ->where('categorypdca','c')
             ->get();
             if(count($queryindicator5_2resultdoc1c)!=0){
                 $score5_2resultdoc1++;
             }
             $queryindicator5_2resultdoc1a= docpdca::where('pdca_id',$queryindicator5_2result1[0]['pdca_id'])
             ->where('categorypdca','a')
             ->get();
             if(count($queryindicator5_2resultdoc1a)!=0){
                 $score5_2resultdoc1++;
             }
         }
         
         $queryindicator5_2result2= PDCA::where('category_pdca',9)
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->where('Indicator_id',5.2)
         ->get();
         if($queryindicator5_2result2!="[]"){
             $queryindicator5_2resultdoc2p= docpdca::where('pdca_id',$queryindicator5_2result2[0]['pdca_id'])
             ->where('categorypdca','p')
             ->get();
             if(count($queryindicator5_2resultdoc2p)!=0){
                 $score5_2resultdoc2++;
             }
             $queryindicator5_2resultdoc2d= docpdca::where('pdca_id',$queryindicator5_2result2[0]['pdca_id'])
             ->where('categorypdca','d')
             ->get();
             if(count($queryindicator5_2resultdoc2d)!=0){
                 $score5_2resultdoc2++;
             }
             $queryindicator5_2resultdoc2c= docpdca::where('pdca_id',$queryindicator5_2result2[0]['pdca_id'])
             ->where('categorypdca','c')
             ->get();
             if(count($queryindicator5_2resultdoc2c)!=0){
                 $score5_2resultdoc2++;
             }
             $queryindicator5_2resultdoc2a= docpdca::where('pdca_id',$queryindicator5_2result2[0]['pdca_id'])
             ->where('categorypdca','a')
             ->get();
             if(count($queryindicator5_2resultdoc2a)!=0){
                 $score5_2resultdoc2++;
             }
         }
         $queryindicator5_2result3= PDCA::where('category_pdca',10)
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->where('Indicator_id',5.2)
         ->get();
         if($queryindicator5_2result3!="[]"){
             $queryindicator5_2resultdoc3p= docpdca::where('pdca_id',$queryindicator5_2result3[0]['pdca_id'])
             ->where('categorypdca','p')
             ->get();
             if(count($queryindicator5_2resultdoc3p)!=0){
                 $score5_2resultdoc3++;
             }
             $queryindicator5_2resultdoc3d= docpdca::where('pdca_id',$queryindicator5_2result3[0]['pdca_id'])
             ->where('categorypdca','d')
             ->get();
             if(count($queryindicator5_2resultdoc3d)!=0){
                 $score5_2resultdoc3++;
             }
             $queryindicator5_2resultdoc3c= docpdca::where('pdca_id',$queryindicator5_2result3[0]['pdca_id'])
             ->where('categorypdca','c')
             ->get();
             if(count($queryindicator5_2resultdoc3c)!=0){
                 $score5_2resultdoc3++;
             }
             $queryindicator5_2resultdoc3a= docpdca::where('pdca_id',$queryindicator5_2result3[0]['pdca_id'])
             ->where('categorypdca','a')
             ->get();
             if(count($queryindicator5_2resultdoc3a)!=0){
                 $score5_2resultdoc3++;
             }
         }

         if($queryindicator5_2result1!="[]"){
             if($queryindicator5_2result1[0]['p']!=""){
                 $score5_2result1++;
             }
             if($queryindicator5_2result1[0]['d']!=""){
                 $score5_2result1++;
             }
             if($queryindicator5_2result1[0]['c']!=""){
                 $score5_2result1++;
             }
             if($queryindicator5_2result1[0]['a']!=""){
                 $score5_2result1++;
             }
         }
         
         if($queryindicator5_2result2!="[]"){
         if($queryindicator5_2result2[0]['p']!=""){
             $score5_2result2++;
         }
         if($queryindicator5_2result2[0]['d']!=""){
             $score5_2result2++;
         }
         if($queryindicator5_2result2[0]['c']!=""){
             $score5_2result2++;
         }
         if($queryindicator5_2result2[0]['a']!=""){
             $score5_2result2++;
         }
         }
 
         if($queryindicator5_2result3!="[]"){
         if($queryindicator5_2result3[0]['p']!=""){
             $score5_2result3++;
         }
         if($queryindicator5_2result3[0]['d']!=""){
             $score5_2result3++;
         }
         if($queryindicator5_2result3[0]['c']!=""){
             $score5_2result3++;
         }
         if($queryindicator5_2result3[0]['a']!=""){
             $score5_2result3++;
         }
        }
        $queryindicator5_2resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
         ->where('pdca.branch_id',session()->get('branch_id'))
         ->where('pdca.year_id',session()->get('year_id'))
         ->where('pdca.Indicator_id',5.2)
         ->where('pdca.target','!=',null)
         ->get();
         if($queryindicator5_2resultpdca!="[]"){
             $score5_2resultpdca++;
         }
         //// ปิด ตัวบ่งชี้ 5.2

         //// ตัวบ่งชี้ 5.3
        $score5_3resultdoc1=0;
        $score5_3resultdoc2=0;
        $score5_3result1=0;
        $score5_3result2=0;
        $score5_3resultpdca=0;
        $queryindicator5_3result1= PDCA::where('category_pdca',15)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',5.3)
        ->get();
        if($queryindicator5_3result1!="[]"){
            $queryindicator5_3resultdoc1p= docpdca::where('pdca_id',$queryindicator5_3result1[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator5_3resultdoc1p)!=0){
                $score5_3resultdoc1++;
            }
            $queryindicator5_3resultdoc1d= docpdca::where('pdca_id',$queryindicator5_3result1[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator5_3resultdoc1d)!=0){
                $score5_3resultdoc1++;
            }
            $queryindicator5_3resultdoc1c= docpdca::where('pdca_id',$queryindicator5_3result1[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator5_3resultdoc1c)!=0){
                $score5_3resultdoc1++;
            }
            $queryindicator5_3resultdoc1a= docpdca::where('pdca_id',$queryindicator5_3result1[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator5_3resultdoc1a)!=0){
                $score5_3resultdoc1++;
            }
        }
        
        $queryindicator5_3result2= PDCA::where('category_pdca',16)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',5.3)
        ->get();
        if($queryindicator5_3result2!="[]"){
            $queryindicator5_3resultdoc2p= docpdca::where('pdca_id',$queryindicator5_3result2[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator5_3resultdoc2p)!=0){
                $score5_3resultdoc2++;
            }
            $queryindicator5_3resultdoc2d= docpdca::where('pdca_id',$queryindicator5_3result2[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator5_3resultdoc2d)!=0){
                $score5_3resultdoc2++;
            }
            $queryindicator5_3resultdoc2c= docpdca::where('pdca_id',$queryindicator5_3result2[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator5_3resultdoc2c)!=0){
                $score5_3resultdoc2++;
            }
            $queryindicator5_3resultdoc2a= docpdca::where('pdca_id',$queryindicator5_3result2[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator5_3resultdoc2a)!=0){
                $score5_3resultdoc2++;
            }
        }
 

        if($queryindicator5_3result1!="[]"){
            if($queryindicator5_3result1[0]['p']!=""){
                $score5_3result1++;
            }
            if($queryindicator5_3result1[0]['d']!=""){
                $score5_3result1++;
            }
            if($queryindicator5_3result1[0]['c']!=""){
                $score5_3result1++;
            }
            if($queryindicator5_3result1[0]['a']!=""){
                $score5_3result1++;
            }
        }
        
        if($queryindicator5_3result2!="[]"){
        if($queryindicator5_3result2[0]['p']!=""){
            $score5_3result2++;
        }
        if($queryindicator5_3result2[0]['d']!=""){
            $score5_3result2++;
        }
        if($queryindicator5_3result2[0]['c']!=""){
            $score5_3result2++;
        }
        if($queryindicator5_3result2[0]['a']!=""){
            $score5_3result2++;
        }
        }

       $queryindicator5_3resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',5.3)
        ->where('pdca.target','!=',null)
        ->get();
        if($queryindicator5_3resultpdca!="[]"){
            $score5_3resultpdca++;
        }
        //// ปิดตัวบ่งชี้ 5.3

        //// ตัวบ่งชี้ 5.4
        $score5_4result1=0;
        $score5_4resultpdca=0;
        $perfor=indicator5_4::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',5.4)
        ->where('pdca.target','!=',null)
        ->get();
        if($inc!="[]"){
            $score5_4resultpdca++;
        }
        if($perfor!="[]"){
            $score5_4result1++;
        }
        //// ปิด ตัวบ่งชี้ 5.4

         //// คุณภาพการสอน
         $scoreteachqua=0;
         $teachqua=category4_teaching_quality::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
         if($teachqua!="[]"){
             $scoreteachqua++;
         }
         //// ปิด คุณภาพการสอน

         //// สรุปผลรายวิชาที่เปิดสอนในภาค/ปีการศึกษา
         $scoreccr=0;
         $ccr=category4_course_results::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
         if($ccr!="[]"){
             $scoreccr++;
         }
         //// ปิด สรุปผลรายวิชาที่เปิดสอนในภาค/ปีการศึกษา

         //// การวิเคราะห์รายวิชาที่มีผลการเรียนที่ไม่ปกติ
         $scoreacademic=0;
         $academic=category4_academic_performance::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
         if($academic!="[]"){
             $scoreacademic++;
         }
         //// ปิด การวิเคราะห์รายวิชาที่มีผลการเรียนที่ไม่ปกติ
         
         //// รายวิชาที่ไม่ได้เปิดสอนในปีการศึกษา
         $scorenot_offered=0;
         $not_offered=category4_notcourse_results::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
         if($not_offered!="[]"){
             $scorenot_offered++;
         }
         //// ปิด รายวิชาที่ไม่ได้เปิดสอนในปีการศึกษา

         //// รายวิชาที่สอนเนื้อหาไม่ครบในปีการศึกษา
         $scoreincomplete_content=0;
         $queryincomplete_content=category4_incomplete_content::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
         if($queryincomplete_content!="[]"){
             $scoreincomplete_content++;
         }
         //// ปิด รายวิชาที่สอนเนื้อหาไม่ครบในปีการศึกษา

         //// ประสิทธิผลของกลยุทธ์การสอน
         $scoreeffec=0;
         $effec=category4_effectiveness::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
         if($effec!="[]"){
             $scoreeffec++;
         }
         //// ปิด ประสิทธิผลของกลยุทธ์การสอน

         //// การปฐมนิเทศอาจารย์ใหม่
         $scorenewteacher=0;
         $th=category4_newteacher::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
         if($th!="[]"){
             $scorenewteacher++;
         }
         //// ปิด การปฐมนิเทศอาจารย์ใหม่
         
         //// กิจกรรมการพัฒนาวิชาชีพของอาจารย์
         $scoreactivity=0;
         $activity=category4_activity::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
         if($activity!="[]"){
             $scoreactivity++;
         }
         //// ปิด กิจกรรมการพัฒนาวิชาชีพของอาจารย์

         //// ตัวบ่งชี้ 6.1
        $score6_1resultdoc1=0;
        $score6_1result1=0;
        $score6_1resultpdca=0;
        $queryindicator6_1result1= PDCA::where('category_pdca',11)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',6.1)
        ->get();
        if($queryindicator6_1result1!="[]"){
            $queryindicator6_1resultdoc1p= docpdca::where('pdca_id',$queryindicator6_1result1[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator6_1resultdoc1p)!=0){
                $score6_1resultdoc1++;
            }
            $queryindicator6_1resultdoc1d= docpdca::where('pdca_id',$queryindicator6_1result1[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator6_1resultdoc1d)!=0){
                $score6_1resultdoc1++;
            }
            $queryindicator6_1resultdoc1c= docpdca::where('pdca_id',$queryindicator6_1result1[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator6_1resultdoc1c)!=0){
                $score6_1resultdoc1++;
            }
            $queryindicator6_1resultdoc1a= docpdca::where('pdca_id',$queryindicator6_1result1[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator6_1resultdoc1a)!=0){
                $score6_1resultdoc1++;
            }
        }
 

        if($queryindicator6_1result1!="[]"){
            if($queryindicator6_1result1[0]['p']!=""){
                $score6_1result1++;
            }
            if($queryindicator6_1result1[0]['d']!=""){
                $score6_1result1++;
            }
            if($queryindicator6_1result1[0]['c']!=""){
                $score6_1result1++;
            }
            if($queryindicator6_1result1[0]['a']!=""){
                $score6_1result1++;
            }
        }
       $queryindicator6_1resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',6.1)
        ->where('pdca.target','!=',null)
        ->get();
        if($queryindicator6_1resultpdca!="[]"){
            $score6_1resultpdca++;
        }
        //// ปิดตัวบ่งชี้ 6.1

        //// การบริหารหลักสูตร
        $scorecoursemanage=0;
        $coursemanage=category5_course_manage::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if($coursemanage!="[]"){
            $scorecoursemanage++;
        }
        //// ปิด การบริหารหลักสูตร


        //// สรุปการประเมินหลักสูตร	
        $scoreassessmentsummary=0;
        $scoreassessmentsummary2=0;
        $queryassessmentsummary=category6_assessment_summary::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('category_assessor','=','การประเมินจากผู้ที่สำเร็จการศึกษา')
        ->where('year_id',session()->get('year_id'))
        ->get();
        if($queryassessmentsummary!="[]"){
            $scoreassessmentsummary++;
        }

        $queryassessmentsummary2=category6_assessment_summary::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('category_assessor','=','การประเมินจากผู้ที่มีส่วนเกี่ยวข้อง')
        ->where('year_id',session()->get('year_id'))
        ->get();
        if($queryassessmentsummary2!="[]"){
            $scoreassessmentsummary2++;
        }
        //// ปิด สรุปการประเมินหลักสูตร

        //// ข้อคิดเห็น และข้อเสนอแนะเกี่ยวกับคุณภาพหลักสูตรจากผู้ประเมิน
        $scorecomment_course=0;
        $querycomment_course=category6_comment_course::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if($querycomment_course!="[]"){
            $scorecomment_course++;
        }
        //// ปิด ข้อคิดเห็น และข้อเสนอแนะเกี่ยวกับคุณภาพหลักสูตรจากผู้ประเมิน

        //// ความก้าวหน้าของการดำเนินงานตามแผนที่เสนอในรายงานของปีที่ผ่านมา
        $scorestrength=0;
        $querystrength=category7_strength::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if($querystrength!="[]"){
            $scorestrength++;
        }
        //// ปิด ความก้าวหน้าของการดำเนินงานตามแผนที่เสนอในรายงานของปีที่ผ่านมา


        //// ข้อเสนอในการพัฒนาหลักสูตร
        $scoredevelopment_proposal=0;
        $querydevelopment_proposal=category7_development_proposal_detail::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if($querydevelopment_proposal!="[]"){
            $scoredevelopment_proposal++;
        }
        //// ปิด ข้อเสนอในการพัฒนาหลักสูตร

         //// แผนปฏิบัติการใหม่
         $scorenewstrength=0;
         $querynewstrength=category7_newstrength::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
         if($querynewstrength!="[]"){
             $scorenewstrength++;
         }
         //// ปิด แผนปฏิบัติการใหม่

         //// สรุปจุดแข็ง จุดที่ควรพัฒนา และแนวทางการพัฒนา
         $scorestrengths_summary=0;
         $querynewstrength2=category7_strengths_summary::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->where('composition_id',2)
         ->get();
         $querynewstrength3=category7_strengths_summary::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->where('composition_id',3)
         ->get();
         $querynewstrength4=category7_strengths_summary::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->where('composition_id',4)
         ->get();
         $querynewstrength5=category7_strengths_summary::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->where('composition_id',5)
         ->get();
         $querynewstrength6=category7_strengths_summary::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->where('composition_id',6)
         ->get();

         if($querynewstrength2!="[]"){
            $scorestrengths_summary++;
        }
        if($querynewstrength3!="[]"){
            $scorestrengths_summary++;
        }
        if($querynewstrength4!="[]"){
            $scorestrengths_summary++;
        }
        if($querynewstrength5!="[]"){
            $scorestrengths_summary++;
        }
        if($querynewstrength6!="[]"){
            $scorestrengths_summary++;
        }
         //// ปิด สรุปจุดแข็ง จุดที่ควรพัฒนา และแนวทางการพัฒนา

        $result1_1=(($getscore1_1+$getscore1_1result)*100)/9;
        $result2_1=($getscore2_1*100)/2;
        $result2_2=($getscore2_2*100)/2;
        $result3_1=(($score3_1result1+$score3_1result2+$score3_1resultdoc1+$score3_1resultdoc2+$score3_1resultpdca)*100)/17;
        $result3_2=(($score3_2result1+$score3_2result2+$score3_2resultdoc1+$score3_2resultdoc2+$score3_2resultpdca)*100)/17;
        $result3_3=(($score3_3result1+$score3_3result2+$score3_3result3+$score3_3resultpdca)*100)/4;
        $resultscorfactor=($scorfactor*100)/1;
        $resultscorfactor2=($scorfactor2*100)/1;
        $resultinfo=(($scoreinfo+$scoreinfoqty)*100)/2;
        $resultgraduate=($scoregraduate*100)/1;
        $resultscorere=($scorere*100)/1;
        $result4_3=(($score4_3result1+$score4_3result2+$score4_3resultpdca)*100)/3;
        $result4_2=(($score4_2result1+$score4_2result2+$score4_2resultpdca)*100)/3;
        $result4_1=(($score4_1result1+$score4_1result2+$score4_1result3+$score4_1resultdoc1+$score4_1resultdoc2+
                    $score4_1resultdoc3+$score4_1resultpdca)*100)/25;
        $result5_1=(($score5_1result1+$score5_1result2+$score5_1result3+$score5_1resultdoc1+$score5_1resultdoc2+
                    $score5_1resultdoc3+$score5_1resultpdca)*100)/25;
        $result5_2=(($score5_2result1+$score5_2result2+$score5_2result3+$score5_2resultdoc1+$score5_2resultdoc2+
                    $score5_2resultdoc3+$score5_2resultpdca)*100)/25;
        $result5_3=(($score5_3result1+$score5_3result2+$score5_3resultdoc1+$score5_3resultdoc2+$score5_3resultpdca)*100)/17;
        $result5_4=(($score5_4result1+$score5_4resultpdca)*100)/2;
        $resultteachqua=($scoreteachqua*100)/1;
        $resultscoreccr=($scoreccr*100)/1;
        $resultscoreacademic=($scoreacademic*100)/1;
        $resultscorenot_offered=($scorenot_offered*100)/1;
        $resultscoreincomplete_content=($scoreincomplete_content*100)/1;
        $resultscoreeffec=($scoreeffec*100)/1;
        $resultscorenewteacher=($scorenewteacher*100)/1;
        $resultscoreactivity=($scoreactivity*100)/1;
        $result6_1=(($score6_1result1+$score6_1resultdoc1+$score6_1resultpdca)*100)/9;
        $course_manage=($scorecoursemanage*100)/1;
        $assessmentsummary=(($scoreassessmentsummary+$scoreassessmentsummary2)*100)/2;
        $resultscorecomment_course=($scorecomment_course*100)/1;
        $resultscorestrength=($scorestrength*100)/1;
        $resultscoredevelopment_proposal=($scoredevelopment_proposal*100)/1;
        $resultscorenewstrength=($scorenewstrength*100)/1;
        $resultscorestrengths_summary=($scorestrengths_summary*100)/5;


        $indicator1_1 = sprintf('%.0f',$result1_1);
        $indicator2_1 = sprintf('%.0f',$result2_1);
        $indicator2_2 = sprintf('%.0f',$result2_2);
        $indicator3_1 = sprintf('%.0f',$result3_1);
        $indicator3_2 = sprintf('%.0f',$result3_2);
        $indicator3_3 = sprintf('%.0f',$result3_3);
        $factor = sprintf('%.0f',$resultscorfactor);
        $factor2 = sprintf('%.0f',$resultscorfactor2);
        $infostd = sprintf('%.0f',$resultinfo);
        $graduate = sprintf('%.0f',$resultgraduate);
        $resignation = sprintf('%.0f',$resultscorere);
        $indicator4_1 = sprintf('%.0f',$result4_1);
        $indicator4_2 = sprintf('%.0f',$result4_2);
        $indicator4_3 = sprintf('%.0f',$result4_3);
        $indicator5_1 = sprintf('%.0f',$result5_1);
        $indicator5_2 = sprintf('%.0f',$result5_2);
        $indicator5_3 = sprintf('%.0f',$result5_3);
        $indicator5_4 = sprintf('%.0f',$result5_4);
        $teachqua = sprintf('%.0f',$resultteachqua);
        $course_results = sprintf('%.0f',$resultscoreccr);
        $academic = sprintf('%.0f',$resultscoreacademic);
        $not_offered = sprintf('%.0f',$resultscorenot_offered);
        $incomplete_content = sprintf('%.0f',$resultscoreincomplete_content);
        $effectiveness = sprintf('%.0f',$resultscoreeffec);
        $newteacher = sprintf('%.0f',$resultscorenewteacher);
        $activity = sprintf('%.0f',$resultscoreactivity);
        $indicator6_1 = sprintf('%.0f',$result6_1);
        $getcourse_manage = sprintf('%.0f',$course_manage);
        $getassessmentsummary = sprintf('%.0f',$assessmentsummary);
        $getresultscorecomment_course = sprintf('%.0f',$resultscorecomment_course);
        $getresultscorestrength = sprintf('%.0f',$resultscorestrength);
        $getscoredevelopment_proposal = sprintf('%.0f',$resultscoredevelopment_proposal);
        $getresultscorenewstrength = sprintf('%.0f',$resultscorenewstrength);
        $getresultscorestrengths_summary = sprintf('%.0f',$resultscorestrengths_summary);
         ////สรุปคะแนน
         $i=0;
         foreach($clind as $value){
         if($value['Indicator_id']=="1.1"){
             $clind[$i]['score']=$indicator1_1;
             if($indicator1_1<=25){
                 $clind[$i]['color']='danger';
                 $clind[$i]['color2']='red';
             }
             else if($indicator1_1<=50){
                 $clind[$i]['color']='yellow';
                 $clind[$i]['color2']='yellow';
             }
             else if($indicator1_1<=75){
                 $clind[$i]['color']='striped';
                 $clind[$i]['color2']='blue';
             }
             else if($indicator1_1<=100){
                 $clind[$i]['color']='success';
                 $clind[$i]['color2']='green';
             }
             $i++;
         }
          if($value['Indicator_id']=="2.1"){
             $clind[$i]['score']=$result2_1;
             if($result2_1<=25){
                 $clind[$i]['color']='danger';
                 $clind[$i]['color2']='red';
             }
             else if($result2_1<=50){
                 $clind[$i]['color']='yellow';
                 $clind[$i]['color2']='yellow';
             }
             else if($result2_1<=75){
                 $clind[$i]['color']='striped';
                 $clind[$i]['color2']='blue';
             }
             else if($result2_1<=100){
                 $clind[$i]['color']='success';
                 $clind[$i]['color2']='green';
             }
             
             $i++;
         }
         if($value['Indicator_id']=="2.2"){
             $clind[$i]['score']=$result2_2;
             if($result2_2<=25){
                $clind[$i]['color']='danger';
                $clind[$i]['color2']='red';
            }
            else if($result2_2<=50){
                $clind[$i]['color']='yellow';
                $clind[$i]['color2']='yellow';
            }
            else if($result2_2<=75){
                $clind[$i]['color']='striped';
                $clind[$i]['color2']='blue';
            }
            else if($result2_2<=100){
                $clind[$i]['color']='success';
                $clind[$i]['color2']='green';
            }
            $i++;
         }
          if($value['Indicator_id']=="3.1"){
             $clind[$i]['score']=$indicator3_1;
             if($indicator3_1<=25){
                $clind[$i]['color']='danger';
                $clind[$i]['color2']='red';
            }
            else if($indicator3_1<=50){
                $clind[$i]['color']='yellow';
                $clind[$i]['color2']='yellow';
            }
            else if($indicator3_1<=75){
                $clind[$i]['color']='striped';
                $clind[$i]['color2']='blue';
            }
            else if($indicator3_1<=100){
                $clind[$i]['color']='success';
                $clind[$i]['color2']='green';
            }
            $i++;
         }
          if($value['Indicator_id']=="3.2"){
             $clind[$i]['score']=$indicator3_2;
             if($indicator3_2<=25){
                 $clind[$i]['color']='danger';
                 $clind[$i]['color2']='red';
             }
             else if($indicator3_2<=50){
                 $clind[$i]['color']='yellow';
                 $clind[$i]['color2']='yellow';
             }
             else if($indicator3_2<=75){
                 $clind[$i]['color']='striped';
                 $clind[$i]['color2']='blue';
             }
             else if($indicator3_2<=100){
                 $clind[$i]['color']='success';
                 $clind[$i]['color2']='green';
             }
             $i++;
         }
          if($value['Indicator_id']=="3.3"){
             $clind[$i]['score']=$indicator3_3;
             if($indicator3_3<=25){
                 $clind[$i]['color']='danger';
                 $clind[$i]['color2']='red';
             }
             else if($indicator3_3<=50){
                 $clind[$i]['color']='yellow';
                 $clind[$i]['color2']='yellow';
             }
             else if($indicator3_3<=75){
                 $clind[$i]['color']='striped';
                 $clind[$i]['color2']='blue';
             }
             else if($indicator3_3<=100){
                 $clind[$i]['color']='success';
                 $clind[$i]['color2']='green';
             }
             $i++;
         }
          if($value['Indicator_id']=="4.1"){
             $clind[$i]['score']=$indicator4_1;
             if($indicator4_1<=25){
                 $clind[$i]['color']='danger';
                 $clind[$i]['color2']='red';
             }
             else if($indicator4_1<=50){
                 $clind[$i]['color']='yellow';
                 $clind[$i]['color2']='yellow';
             }
             else if($indicator4_1<=75){
                 $clind[$i]['color']='striped';
                 $clind[$i]['color2']='blue';
             }
             else if($indicator4_1<=100){
                 $clind[$i]['color']='success';
                 $clind[$i]['color2']='green';
             }
             $i++;
         }
         if($value['Indicator_id']=="4.2"){
            $clind[$i]['score']=$indicator4_2;
            if($indicator4_2<=25){
                 $clind[$i]['color']='danger';
                 $clind[$i]['color2']='red';
             }
             else if($indicator4_2<=50){
                 $clind[$i]['color']='yellow';
                 $clind[$i]['color2']='yellow';
             }
             else if($indicator4_2<=75){
                 $clind[$i]['color']='striped';
                 $clind[$i]['color2']='blue';
             }
             else if($indicator4_2<=100){
                 $clind[$i]['color']='success';
                 $clind[$i]['color2']='green';
             }
             $i++;
        }
        if($value['Indicator_id']=="4.3"){
            $clind[$i]['score']=$indicator4_3;
            if($indicator4_3<=25){
                 $clind[$i]['color']='danger';
                 $clind[$i]['color2']='red';
             }
             else if($indicator4_3<=50){
                 $clind[$i]['color']='yellow';
                 $clind[$i]['color2']='yellow';
             }
             else if($indicator4_3<=75){
                 $clind[$i]['color']='striped';
                 $clind[$i]['color2']='blue';
             }
             else if($indicator4_3<=100){
                 $clind[$i]['color']='success';
                 $clind[$i]['color2']='green';
             }
             $i++;
        }
        if($value['Indicator_id']=="5.1"){
            $clind[$i]['score']=$indicator5_1;
            if($indicator5_1<=25){
                 $clind[$i]['color']='danger';
                 $clind[$i]['color2']='red';
             }
             else if($indicator5_1<=50){
                 $clind[$i]['color']='yellow';
                 $clind[$i]['color2']='yellow';
             }
             else if($indicator5_1<=75){
                 $clind[$i]['color']='striped';
                 $clind[$i]['color2']='blue';
             }
             else if($indicator5_1<=100){
                 $clind[$i]['color']='success';
                 $clind[$i]['color2']='green';
             }
             $i++;
        }
        if($value['Indicator_id']=="5.2"){
            $clind[$i]['score']=$indicator5_2;
            if($indicator5_2<=25){
                 $clind[$i]['color']='danger';
                 $clind[$i]['color2']='red';
             }
             else if($indicator5_2<=50){
                 $clind[$i]['color']='yellow';
                 $clind[$i]['color2']='yellow';
             }
             else if($indicator5_2<=75){
                 $clind[$i]['color']='striped';
                 $clind[$i]['color2']='blue';
             }
             else if($indicator5_2<=100){
                 $clind[$i]['color']='success';
                 $clind[$i]['color2']='green';
             }
             $i++;
        }
        if($value['Indicator_id']=="5.3"){
            $clind[$i]['score']=$indicator5_3;
            if($indicator5_3<=25){
                 $clind[$i]['color']='danger';
                 $clind[$i]['color2']='red';
             }
             else if($indicator5_3<=50){
                 $clind[$i]['color']='yellow';
                 $clind[$i]['color2']='yellow';
             }
             else if($indicator5_3<=75){
                 $clind[$i]['color']='striped';
                 $clind[$i]['color2']='blue';
             }
             else if($indicator5_3<=100){
                 $clind[$i]['color']='success';
                 $clind[$i]['color2']='green';
             }
             $i++;
        }
        if($value['Indicator_id']=="5.4"){
            $clind[$i]['score']=$indicator5_4;
            if($indicator5_4<=25){
                 $clind[$i]['color']='danger';
                 $clind[$i]['color2']='red';
             }
             else if($indicator5_4<=50){
                 $clind[$i]['color']='yellow';
                 $clind[$i]['color2']='yellow';
             }
             else if($indicator5_4<=75){
                 $clind[$i]['color']='striped';
                 $clind[$i]['color2']='blue';
             }
             else if($indicator5_4<=100){
                 $clind[$i]['color']='success';
                 $clind[$i]['color2']='green';
             }
             $i++;
        }
        if($value['Indicator_id']=="6.1"){
            $clind[$i]['score']=$indicator6_1;
            if($indicator6_1<=25){
                 $clind[$i]['color']='danger';
                 $clind[$i]['color2']='red';
             }
             else if($indicator6_1<=50){
                 $clind[$i]['color']='yellow';
                 $clind[$i]['color2']='yellow';
             }
             else if($indicator6_1<=75){
                 $clind[$i]['color']='striped';
                 $clind[$i]['color2']='blue';
             }
             else if($indicator6_1<=100){
                 $clind[$i]['color']='success';
                 $clind[$i]['color2']='green';
             }
             $i++;
            }
        
            if($value['Indicator_name']=="คุณภาพการสอน"){
                $clind[$i]['score']=$teachqua;
                if($teachqua<=25){
                     $clind[$i]['color']='danger';
                     $clind[$i]['color2']='red';
                 }
                 else if($teachqua<=50){
                     $clind[$i]['color']='yellow';
                     $clind[$i]['color2']='yellow';
                 }
                 else if($teachqua<=75){
                     $clind[$i]['color']='striped';
                     $clind[$i]['color2']='blue';
                 }
                 else if($teachqua<=100){
                     $clind[$i]['color']='success';
                     $clind[$i]['color2']='green';
                 }
                 $i++;
                }
                if($value['Indicator_name']=="ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา"){
                    $clind[$i]['score']=$factor;
                    if($factor<=25){
                         $clind[$i]['color']='danger';
                         $clind[$i]['color2']='red';
                     }
                     else if($factor<=50){
                         $clind[$i]['color']='yellow';
                         $clind[$i]['color2']='yellow';
                     }
                     else if($factor<=75){
                         $clind[$i]['color']='striped';
                         $clind[$i]['color2']='blue';
                     }
                     else if($factor<=100){
                         $clind[$i]['color']='success';
                         $clind[$i]['color2']='green';
                     }
                     $i++;
                    }
                    if($value['Indicator_name']=="ปัยจัยที่มีผลกระทบต่อการสำเร็จการศึกษา"){
                        $clind[$i]['score']=$factor2;
                        if($factor2<=25){
                             $clind[$i]['color']='danger';
                             $clind[$i]['color2']='red';
                         }
                         else if($factor2<=50){
                             $clind[$i]['color']='yellow';
                             $clind[$i]['color2']='yellow';
                         }
                         else if($factor2<=75){
                             $clind[$i]['color']='striped';
                             $clind[$i]['color2']='blue';
                         }
                         else if($factor2<=100){
                             $clind[$i]['color']='success';
                             $clind[$i]['color2']='green';
                         }
                         $i++;
                        }
                        if($value['Indicator_name']=="สรุปการประเมินหลักสูตร"){
                            $clind[$i]['score']=$getassessmentsummary;
                            if($getassessmentsummary<=25){
                                 $clind[$i]['color']='danger';
                                 $clind[$i]['color2']='red';
                             }
                             else if($getassessmentsummary<=50){
                                 $clind[$i]['color']='yellow';
                                 $clind[$i]['color2']='yellow';
                             }
                             else if($getassessmentsummary<=75){
                                 $clind[$i]['color']='striped';
                                 $clind[$i]['color2']='blue';
                             }
                             else if($getassessmentsummary<=100){
                                 $clind[$i]['color']='success';
                                 $clind[$i]['color2']='green';
                             }
                             $i++;
                            }
                                if($value['Indicator_name']=="สรุปผลรายวิชาที่เปิดสอน"){
                                    $clind[$i]['score']=$course_results;
                                    if($course_results<=25){
                                         $clind[$i]['color']='danger';
                                         $clind[$i]['color2']='red';
                                     }
                                     else if($course_results<=50){
                                         $clind[$i]['color']='yellow';
                                         $clind[$i]['color2']='yellow';
                                     }
                                     else if($course_results<=75){
                                         $clind[$i]['color']='striped';
                                         $clind[$i]['color2']='blue';
                                     }
                                     else if($course_results<=100){
                                         $clind[$i]['color']='success';
                                         $clind[$i]['color2']='green';
                                     }
                                     $i++;
                                    }
                                    if($value['Indicator_name']=="รายวิชาที่มีผลการเรียนที่ไม่ปกติ"){
                                        $clind[$i]['score']=$academic;
                                        if($academic<=25){
                                             $clind[$i]['color']='danger';
                                             $clind[$i]['color2']='red';
                                         }
                                         else if($academic<=50){
                                             $clind[$i]['color']='yellow';
                                             $clind[$i]['color2']='yellow';
                                         }
                                         else if($academic<=75){
                                             $clind[$i]['color']='striped';
                                             $clind[$i]['color2']='blue';
                                         }
                                         else if($academic<=100){
                                             $clind[$i]['color']='success';
                                             $clind[$i]['color2']='green';
                                         }
                                         $i++;
                                        }
                                        if($value['Indicator_name']=="รายวิชาที่ไม่ได้เปิดสอน"){
                                            $clind[$i]['score']=$not_offered;
                                            if($not_offered<=25){
                                                 $clind[$i]['color']='danger';
                                                 $clind[$i]['color2']='red';
                                             }
                                             else if($not_offered<=50){
                                                 $clind[$i]['color']='yellow';
                                                 $clind[$i]['color2']='yellow';
                                             }
                                             else if($not_offered<=75){
                                                 $clind[$i]['color']='striped';
                                                 $clind[$i]['color2']='blue';
                                             }
                                             else if($not_offered<=100){
                                                 $clind[$i]['color']='success';
                                                 $clind[$i]['color2']='green';
                                             }
                                             $i++;
                                            }
                                            if($value['Indicator_name']=="รายวิชาที่สอนเนื้อหาไม่ครบ"){
                                                $clind[$i]['score']=$incomplete_content;
                                                if($incomplete_content<=25){
                                                     $clind[$i]['color']='danger';
                                                     $clind[$i]['color2']='red';
                                                 }
                                                 else if($incomplete_content<=50){
                                                     $clind[$i]['color']='yellow';
                                                     $clind[$i]['color2']='yellow';
                                                 }
                                                 else if($incomplete_content<=75){
                                                     $clind[$i]['color']='striped';
                                                     $clind[$i]['color2']='blue';
                                                 }
                                                 else if($incomplete_content<=100){
                                                     $clind[$i]['color']='success';
                                                     $clind[$i]['color2']='green';
                                                 }
                                                 $i++;
                                                }
                                                if($value['Indicator_name']=="ประสิทธิผลของกลยุทธ์การสอน"){
                                                    $clind[$i]['score']=$effectiveness;
                                                    if($effectiveness<=25){
                                                         $clind[$i]['color']='danger';
                                                         $clind[$i]['color2']='red';
                                                     }
                                                     else if($effectiveness<=50){
                                                         $clind[$i]['color']='yellow';
                                                         $clind[$i]['color2']='yellow';
                                                     }
                                                     else if($effectiveness<=75){
                                                         $clind[$i]['color']='striped';
                                                         $clind[$i]['color2']='blue';
                                                     }
                                                     else if($effectiveness<=100){
                                                         $clind[$i]['color']='success';
                                                         $clind[$i]['color2']='green';
                                                     }
                                                     $i++;
                                                    }
                                                    if($value['Indicator_name']=="การปฐมนิเทศอาจารย์ใหม่"){
                                                        $clind[$i]['score']=$newteacher;
                                                        if($newteacher<=25){
                                                             $clind[$i]['color']='danger';
                                                             $clind[$i]['color2']='red';
                                                         }
                                                         else if($newteacher<=50){
                                                             $clind[$i]['color']='yellow';
                                                             $clind[$i]['color2']='yellow';
                                                         }
                                                         else if($newteacher<=75){
                                                             $clind[$i]['color']='striped';
                                                             $clind[$i]['color2']='blue';
                                                         }
                                                         else if($newteacher<=100){
                                                             $clind[$i]['color']='success';
                                                             $clind[$i]['color2']='green';
                                                         }
                                                         $i++;
                                                        }
                                                        if($value['Indicator_name']=="กิจกรรมการพัฒนาวิชาชีพ"){
                                                            $clind[$i]['score']=$activity;
                                                            if($activity<=25){
                                                                 $clind[$i]['color']='danger';
                                                                 $clind[$i]['color2']='red';
                                                             }
                                                             else if($activity<=50){
                                                                 $clind[$i]['color']='yellow';
                                                                 $clind[$i]['color2']='yellow';
                                                             }
                                                             else if($activity<=75){
                                                                 $clind[$i]['color']='striped';
                                                                 $clind[$i]['color2']='blue';
                                                             }
                                                             else if($activity<=100){
                                                                 $clind[$i]['color']='success';
                                                                 $clind[$i]['color2']='green';
                                                             }
                                                             $i++;
                                                            }
                                                            if($value['Indicator_name']=="การบริหารหลักสูตร"){
                                                                $clind[$i]['score']=$getcourse_manage;
                                                                if($getcourse_manage<=25){
                                                                     $clind[$i]['color']='danger';
                                                                     $clind[$i]['color2']='red';
                                                                 }
                                                                 else if($getcourse_manage<=50){
                                                                     $clind[$i]['color']='yellow';
                                                                     $clind[$i]['color2']='yellow';
                                                                 }
                                                                 else if($getcourse_manage<=75){
                                                                     $clind[$i]['color']='striped';
                                                                     $clind[$i]['color2']='blue';
                                                                 }
                                                                 else if($getcourse_manage<=100){
                                                                     $clind[$i]['color']='success';
                                                                     $clind[$i]['color2']='green';
                                                                 }
                                                                 $i++;
                                                                }
                                                                if($value['Indicator_name']=="ข้อคิดเห็น และข้อเสนอแนะ"){
                                                                    $clind[$i]['score']=$resultscorecomment_course;
                                                                    if($resultscorecomment_course<=25){
                                                                         $clind[$i]['color']='danger';
                                                                         $clind[$i]['color2']='red';
                                                                     }
                                                                     else if($resultscorecomment_course<=50){
                                                                         $clind[$i]['color']='yellow';
                                                                         $clind[$i]['color2']='yellow';
                                                                     }
                                                                     else if($resultscorecomment_course<=75){
                                                                         $clind[$i]['color']='striped';
                                                                         $clind[$i]['color2']='blue';
                                                                     }
                                                                     else if($resultscorecomment_course<=100){
                                                                         $clind[$i]['color']='success';
                                                                         $clind[$i]['color2']='green';
                                                                     }
                                                                     $i++;
                                                                    }
                                                                    if($value['Indicator_name']=="ความก้าวหน้าของการดำเนินงาน"){
                                                                        $clind[$i]['score']=$getresultscorestrength;
                                                                        if($getresultscorestrength<=25){
                                                                             $clind[$i]['color']='danger';
                                                                             $clind[$i]['color2']='red';
                                                                         }
                                                                         else if($getresultscorestrength<=50){
                                                                             $clind[$i]['color']='yellow';
                                                                             $clind[$i]['color2']='yellow';
                                                                         }
                                                                         else if($getresultscorestrength<=75){
                                                                             $clind[$i]['color']='striped';
                                                                             $clind[$i]['color2']='blue';
                                                                         }
                                                                         else if($getresultscorestrength<=100){
                                                                             $clind[$i]['color']='success';
                                                                             $clind[$i]['color2']='green';
                                                                         }
                                                                         $i++;
                                                                        }
                                                                        if($value['Indicator_name']=="ข้อเสนอในการพัฒนาหลักสูตร"){
                                                                            $clind[$i]['score']=$getscoredevelopment_proposal;
                                                                            if($getscoredevelopment_proposal<=25){
                                                                                 $clind[$i]['color']='danger';
                                                                                 $clind[$i]['color2']='red';
                                                                             }
                                                                             else if($getscoredevelopment_proposal<=50){
                                                                                 $clind[$i]['color']='yellow';
                                                                                 $clind[$i]['color2']='yellow';
                                                                             }
                                                                             else if($getscoredevelopment_proposal<=75){
                                                                                 $clind[$i]['color']='striped';
                                                                                 $clind[$i]['color2']='blue';
                                                                             }
                                                                             else if($getscoredevelopment_proposal<=100){
                                                                                 $clind[$i]['color']='success';
                                                                                 $clind[$i]['color2']='green';
                                                                             }
                                                                             $i++;
                                                                            }
                                                                            if($value['Indicator_name']=="แผนปฏิบัติการใหม่"){
                                                                                $clind[$i]['score']=$getresultscorenewstrength;
                                                                                if($getresultscorenewstrength<=25){
                                                                                     $clind[$i]['color']='danger';
                                                                                     $clind[$i]['color2']='red';
                                                                                 }
                                                                                 else if($getresultscorenewstrength<=50){
                                                                                     $clind[$i]['color']='yellow';
                                                                                     $clind[$i]['color2']='yellow';
                                                                                 }
                                                                                 else if($getresultscorenewstrength<=75){
                                                                                     $clind[$i]['color']='striped';
                                                                                     $clind[$i]['color2']='blue';
                                                                                 }
                                                                                 else if($getresultscorenewstrength<=100){
                                                                                     $clind[$i]['color']='success';
                                                                                     $clind[$i]['color2']='green';
                                                                                 }
                                                                                 $i++;
                                                                                }
                                                                                if($value['Indicator_name']=="ข้อมูลนักศึกษา"){
                                                                                    $clind[$i]['score']=$infostd;
                                                                                    if($infostd<=25){
                                                                                         $clind[$i]['color']='danger';
                                                                                         $clind[$i]['color2']='red';
                                                                                     }
                                                                                     else if($infostd<=50){
                                                                                         $clind[$i]['color']='yellow';
                                                                                         $clind[$i]['color2']='yellow';
                                                                                     }
                                                                                     else if($infostd<=75){
                                                                                         $clind[$i]['color']='striped';
                                                                                         $clind[$i]['color2']='blue';
                                                                                     }
                                                                                     else if($infostd<=100){
                                                                                         $clind[$i]['color']='success';
                                                                                         $clind[$i]['color2']='green';
                                                                                     }
                                                                                     $i++;
                                                                                    }
                                                                                    if($value['Indicator_name']=="จุดแข็ง จุดที่ควรพัฒนา"){
                                                                                        $clind[$i]['score']=$getresultscorestrengths_summary;
                                                                                        if($getresultscorestrengths_summary<=25){
                                                                                             $clind[$i]['color']='danger';
                                                                                             $clind[$i]['color2']='red';
                                                                                         }
                                                                                         else if($getresultscorestrengths_summary<=50){
                                                                                             $clind[$i]['color']='yellow';
                                                                                             $clind[$i]['color2']='yellow';
                                                                                         }
                                                                                         else if($getresultscorestrengths_summary<=75){
                                                                                             $clind[$i]['color']='striped';
                                                                                             $clind[$i]['color2']='blue';
                                                                                         }
                                                                                         else if($getresultscorestrengths_summary<=100){
                                                                                             $clind[$i]['color']='success';
                                                                                             $clind[$i]['color2']='green';
                                                                                         }
                                                                                         $i++;
                                                                                        }
                                                                                        if($value['Indicator_name']=="จำนวนผู้สำเร็จการศึกษา"){
                                                                                            $clind[$i]['score']=$graduate;
                                                                                            if($graduate<=25){
                                                                                                 $clind[$i]['color']='danger';
                                                                                                 $clind[$i]['color2']='red';
                                                                                             }
                                                                                             else if($graduate<=50){
                                                                                                 $clind[$i]['color']='yellow';
                                                                                                 $clind[$i]['color2']='yellow';
                                                                                             }
                                                                                             else if($graduate<=75){
                                                                                                 $clind[$i]['color']='striped';
                                                                                                 $clind[$i]['color2']='blue';
                                                                                             }
                                                                                             else if($graduate<=100){
                                                                                                 $clind[$i]['color']='success';
                                                                                                 $clind[$i]['color2']='green';
                                                                                             }
                                                                                             $i++;
                                                                                            }
                                                                            if($value['Indicator_name']=="จำนวนการลาออกและคัดชื่อออก"){
                                                                           $clind[$i]['score']=$resignation;
                                                                              if($resignation<=25){
                                                                                  $clind[$i]['color']='danger';
                                                                                  $clind[$i]['color2']='red';
                                                                                }
                                                                                else if($resignation<=50){
                                                                                 $clind[$i]['color']='yellow';
                                                                                 $clind[$i]['color2']='yellow';
                                                                               }
                                                                              else if($resignation<=75){
                                                                                 $clind[$i]['color']='striped';
                                                                                 $clind[$i]['color2']='blue';
                                                                               }
                                                                               else if($resignation<=100){
                                                                                  $clind[$i]['color']='success';
                                                                                 $clind[$i]['color2']='green';
                                                                               }
                                                                              $i++;
                                                                                }
        }

        $userpermis=user_permission::leftjoin('users','user_permission.user_id','=','users.id')
            ->where('user_permission.year_id',session()->get('year_id'))
            ->where('users.user_course',session()->get('usercourse'))
            ->where('users.user_branch',session()->get('branch_id'))
            ->get();
            
            $getcounn=count($userpermis);
                    foreach($clind as $key2=>$checkdata){
                            $userpermis2=$userpermis->where('Indicator_id',$checkdata['id']);
                            foreach($userpermis2 as $uservalue){

                                if($checkdata['Indicator_id']!=""){
                                    if($checkdata['id']==$uservalue['Indicator_id']){
                                        $clind[$key2]['code']=$clind[$key2]['code'].'<span class="badge bg-green">'.$uservalue['user_fullname'].'</span>';
                                    }
                                }
                                else{
                                    $getname=indicator::where('id',$checkdata['id'])->get();
                                    if($checkdata['Indicator_name']==$getname[0]['Indicator_name']){  
                                        $clind[$key2]['code']=$clind[$key2]['code'].'<span class="badge bg-green">'.$uservalue['user_fullname'].'</span>';
                                    }
                                }
                            }
                        }
        return response()->json($clind);
        
    }
     /////defualindicator/////defualindicator/////defualindicator/////defualindicator/////defualindicator/////defualindicator
     public function getdefualindicator($id)
     {
         $editdata=defaulindicator::where('id',$id)
         ->get();
         return $editdata;
     }
     function adddefualindicator(Request $request)
     {
         $data=new defaulindicator;
         $data->Indicator_id=$request->Indicator_id;
         $data->Indicator_name=$request->Indicator_name;
         $data->category_id=$request->category_id;
         $data->composition_id=$request->composition_id;
         $data->url=$request->url;
         $data->save();
        return  $data;
     }
     public function updatedefualindicator(Request $request)
     {
         $data=defaulindicator::find($request->id);
         $data->Indicator_id=$request->Indicator_id;
         $data->Indicator_name=$request->Indicator_name;
         $data->category_id=$request->category_id;
         $data->composition_id=$request->composition_id;
         $data->url=$request->url;
         $data->save();
               
         return $data;
     }
     public function deletedefualindicator($id)
    {   
        $indi=defaulindicator::where('id',$id)->get();
        $checkuser=PDCA::where('Indicator_id',$indi[0]['Indicator_id'])->get();
        if($checkuser=="[]"){
            $data = defaulindicator::find($id);
             $data->delete();
            return $product;
        }
        else{
            return "ไม่สามารถลบข้อมูลได้เนื่องจากข้อมูลสัมพันธ์กัน";
        }

    }
      /////defualindicator/////defualindicator/////defualindicator/////defualindicator/////defualindicator/////defualindicator

      /////self_assessment_results/////self_assessment_results/////self_assessment_results/////self_assessment_results/////self_assessment_results/////self_assessment_results
      public function getself_assessment_results($id)
      {
         $pdca= defaulindicator::where('indicator_id',$id)
        ->get();
        $per1="";
        if($id=="4.2"||$id=="2.1"||$id=="2.2"||$id=="5.4")
        {
            $per1="asdsadsad";
        }
          return view('category3/addassessment_results',compact('pdca','per1'));
      }
      public function getself_assessment_results2($id)
      {
        $pdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',$id)
        ->where('pdca.target','!=',null)
        ->get();
        $per1="";
        if($id=="4.2"||$id=="2.1"||$id=="2.2"||$id=="5.4")
        {
            $per1="asdsadsad";
        }
          return view('category3/editassessment_results',compact('pdca','per1'));
      }
      function addself_assessment_results(Request $request)
      {
          $data=new PDCA;
          $data->Indicator_id=$request->Indicator_id;
          $data->target=$request->target;
          if(isset($request->performance1)){
            $data->performance1=$request->performance1;
          }
          if(isset($request->performance2)){
            $data->performance2=$request->performance2;
          }
          $data->performance3=$request->performance3;
          $data->score=$request->score;
          $data->course_id=session()->get('usercourse');
          $data->branch_id=session()->get('branch_id');
          $data->year_id=session()->get('year_id');
          $data->save();
  
       return $data;
      }
      public function updateself_assessment_results(Request $request)
      {
          $data=PDCA::find($request->Indicator_id);
          $data->target=$request->target;
          if(isset($request->performance1)){
            $data->performance1=$request->performance1;
          }
          if(isset($request->performance2)){
            $data->performance2=$request->performance2;
          }
          $data->performance3=$request->performance3;
          $data->score=$request->score;
          $data->save();
                
          return $data;
      }
       /////assessment_results/////assessment_results/////assessment_results/////assessment_results/////assessment_results/////assessment_results


        /////teaching_quality/////teaching_quality/////teaching_quality/////teaching_quality/////teaching_quality/////teaching_quality
     public function getteaching_quality()
     {
        $data=category4_teaching_quality::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        
        $data2=category4_teaching_quality::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('result','!=',"")
        ->get();
         return view('AJ/editteaching_quality',compact('data','data2'));
     }
     function addteaching_quality(Request $request)
     {  $data=category4_course_results::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('course_name','!=','รหัสชื่อวิชา')
        ->get();
        $getall=$request->all();
        $numItems = count($data);
        $i = 0;
        foreach($data as $key=>$value){
            $data1[$key]['student_year']=$getall['student_year'.$value['id']];
            $data1[$key]['stu_year_of_admission']=$value['id']; 
            $data1[$key]['course_name']=$value['course_name'];
            $data1[$key]['term_year']=$value['term_year'];
            $data1[$key]['status']=$getall['result'.$value['id']];
            $data1[$key]['description']=$getall['planupdate'.$value['id']];
            $data1[$key]['result']="";
            $data1[$key]['year_id']=session()->get('year_id');
            $data1[$key]['course_id']=session()->get('usercourse');
            $data1[$key]['branch_id']=session()->get('branch_id');
            if(++$i === $numItems) {
                $data1[$key]['result']=$request->resultall;
              }
        }
        category4_teaching_quality::insert($data1);
        return  $data1;
     }
     public function updateteaching_quality(Request $request)
     {  
        $checkdata=category4_teaching_quality::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'));
        if(isset($checkdata)){
            $checkdata->delete();
        }
        $data=category4_course_results::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('course_name','!=','รหัสชื่อวิชา')
        ->get();
        $getall=$request->all();
        $numItems = count($data);
        $i = 0;
        foreach($data as $key=>$value){
            $data1[$key]['student_year']=$getall['student_year'.$value['id']];
            $data1[$key]['stu_year_of_admission']=$value['id']; 
            $data1[$key]['course_name']=$value['course_name'];
            $data1[$key]['term_year']=$value['term_year'];
            $data1[$key]['status']=$getall['result'.$value['id']];
            $data1[$key]['description']=$getall['planupdate'.$value['id']];
            $data1[$key]['result']="";
            $data1[$key]['year_id']=session()->get('year_id');
            $data1[$key]['course_id']=session()->get('usercourse');
            $data1[$key]['branch_id']=session()->get('branch_id');
            if(++$i === $numItems) {
                $data1[$key]['result']=$request->resultall;
              }
        }
        category4_teaching_quality::insert($data1);
        return $data1;
     }
      /////teaching_quality/////teaching_quality/////teaching_quality/////teaching_quality/////teaching_quality/////teaching_quality


      /////Resignation/////Resignation/////Resignation/////Resignation/////Resignation/////Resignation

    public function getresignation()
    {
        $get=year_acceptance_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->get();
        $getinfo="";
        $getinfo2="";
        $gropby="";
        if($get!='[]'){
        $getinfo=category3_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_add', '>=',$get[0]['year_add'])
        ->where('year_add', '<=',session()->get('year'))
        ->where('reported_year', '>=',$get[0]['year_add'])
        ->where('reported_year', '<=',session()->get('year'))
        ->get();
        
        $getinfo2=category3_infostudent::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_add', '>=',$get[0]['year_add'])
        ->where('year_add', '<=',session()->get('year'))
        ->where('reported_year', '>=',$get[0]['year_add'])
        ->where('reported_year', '<=',session()->get('year'))
        ->get();
        $gropby=category3_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_add', '>=',$get[0]['year_add'])
        ->where('year_add', '<=',session()->get('year'))
        ->where('reported_year', '>=',$get[0]['year_add'])
        ->where('reported_year', '<=',session()->get('year'))
        ->groupBy('year_add')
        ->get();
        }
        $getyear=category3_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_add',session()->get('year'))
        ->get();
        $re=category3_resignation::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_present',session()->get('year'))
        ->get();
       return view('AJ/addresignation',compact('get','getinfo','getyear','getinfo2','gropby','re'));
       
    }
   function addresignation(Request $request)
   {
       $get=$request->all();
       

       $s=count($get['qty']);
       foreach($get['qty'] as $key=>$value){
            $check=category3_resignation::where('course_id',session()->get('usercourse'))
            ->where('branch_id',session()->get('branch_id'))
            ->where('year_present',session()->get('year'))
            ->where('year_add',$get['yearadd'][$key])
            ->get();
          if(count($check)!=0){
            $data=category3_resignation::find($check[0]['id']);
            $data->qty=$value;
            $data->save();
          }
          else{
            $data=new category3_resignation;
            $data->year_add=$get['yearadd'][$key];
            $data->qty=$value;
            $data->course_id=session()->get('usercourse');
            $data->branch_id=session()->get('branch_id');
            $data->year_present=session()->get('year');
            $data->save();
          }
          
       }
    return $data;
   }
   public function updateresignation(Request $request)
   {
            $get=year_acceptance_graduate::where('course_id',session()->get('usercourse'))
            ->where('branch_id',session()->get('branch_id'))
            ->where('year_id',session()->get('year_id'))
            ->get();
        $getall=$request->all();
        $checkdata=category3_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'));
        if(isset($checkdata)){
            $checkdata->delete();
        }

        for($i=$get[0]['year_add'];$i<=$get[0]['reported_year']; $i++){
            $getcount=$get[0]['year_add'];
            foreach($getall['y'.$i] as $key=>$value){
                if($value!=null){
                    $data[$key]['reported_year_qty']=$value;
                }
                else{
                    $data[$key]['reported_year']=0;
                }
                $data[$key]['year_add']=$i;
                $data[$key]['reported_year']=$getcount;
                $data[$key]['course_id']=session()->get('usercourse');
                $data[$key]['branch_id']=session()->get('branch_id');
                $getcount++;
            }
            category3_resignation::insert($data);
        }
        return $data;
   }
       /////Resignation/////Resignation/////Resignation/////Resignation/////Resignation/////Resignation

       public function addpastperformance(Request $request)
    {
        $getdata=$request->all();
        $countgetname=count($getdata['teacher_name']);
        $getname=User::where('id',$request->owner)
        ->get();
        $text=$getname[0]['user_fullname'];
        $i=1;
        foreach($getdata['teacher_name'] as $row){
            $query=User::find($row);
            if($i!=$countgetname){
                $text=$text.", ".$query->user_fullname.", ";
            }
            else{
                $text=$text." และ".$query->user_fullname;
            }
            $i++;
        }
        $data=new past_performance;
        $data->teacher_name=$text;
        $data->work_name=$work_name;
        $data->detail=$request->detail;
        $data->year=$request->year;
        $data->save();
        foreach($getdata['teacher_name'] as $row){
            $query=User::find($row);
            $insert=new Research_results_user;
            $insert->research_results_research_results_id=$data->research_results_id;
            $insert->user_id=$row;
            $insert->save();
        }
    }

    public function getteacheroverview()
    {

        ////หมวดที่ 1 
         ////ตัวบ่งชี้ 1.1
         $getscore1_1=0;
         $getscore1_1result=0;
         $score1_1=0;
         $queryindicator1_1=indicator1_1::where('year_id',session()->get('year_id'))
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->get();
         
         $queryindicator1_1result= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
         ->where('pdca.branch_id',session()->get('branch_id'))
         ->where('pdca.year_id',session()->get('year_id'))
         ->where('pdca.Indicator_id',1.1)
         ->where('pdca.target','!=',null)
         ->get();
 
         //ดึงค่าตารางอาจารย์ผู้รับผิดชอบหลักสูตร
         $trc = course_responsible_teacher::join('year','course_responsible_teacher.year_id','=','year.year_id')
         ->where('course_responsible_teacher.course_id',session()->get('usercourse'))
         ->where('course_responsible_teacher.branch_id',session()->get('branch_id'))
         ->where('year.year_id',session()->get('year_id'))
         ->get();
          ////ดึงสาขาวิชาที่จบของอาจารย์ประจำหลักสูตร
          $tc_course= User::leftjoin('course_teacher','users.id','=','course_teacher.user_id')
          ->where('users.user_course',session()->get('usercourse'))
          ->where('users.user_branch',session()->get('branch_id'))
          ->where('course_teacher.year_id',session()->get('year_id'))
          ->get();
 
          ////ดึงสาขาวิชาที่จบของอาจารย์ผู้สอน
          $instructor= User::leftjoin('instructor','users.id','=','instructor.user_id')
          ->where('users.user_course',session()->get('usercourse'))
          ->where('users.user_branch',session()->get('branch_id'))
          ->where('instructor.year_id',session()->get('year_id'))
          ->get();
          if(count($trc)!=0){
             $getscore1_1++;
         }
 
         if(count($tc_course)!=0){
             $getscore1_1++;
         }
         if(count($instructor)!=0){
             $getscore1_1++;
         }
         if(count($queryindicator1_1)!=0){
             if($queryindicator1_1[0]['result1']!=""){
                 $getscore1_1++;
             }
             if($queryindicator1_1[0]['result2']!=""){
                 $getscore1_1++;
             }
             if($queryindicator1_1[0]['result3']!=""){
                 $getscore1_1++;
             }
             if($queryindicator1_1[0]['result4']!=""){
                 $getscore1_1++;
             }
             if($queryindicator1_1[0]['result5']!=""){
                 $getscore1_1++;
             }
         }
         if(count($queryindicator1_1result)!=0){
             $getscore1_1result++;
         }
         
         ////ตัวบ่งชี้ 1.1
        ////ปิดหมวดที่ 1


        ////หมวดที่ 2 ตัวบ่งชี้ 4.1
        $score4_1resultdoc1=0;
        $score4_1resultdoc2=0;
        $score4_1resultdoc3=0;
        $score4_1result1=0;
        $score4_1result2=0;
        $score4_1result3=0;
        $score4_1resultpdca=0;
        $queryindicator4_1result1= PDCA::where('category_pdca',1)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',4.1)
        ->get();
        if($queryindicator4_1result1!="[]"){
            $queryindicator4_1resultdoc1p= docpdca::where('pdca_id',$queryindicator4_1result1[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator4_1resultdoc1p)!=0){
                $score4_1resultdoc1++;
            }
            $queryindicator4_1resultdoc1d= docpdca::where('pdca_id',$queryindicator4_1result1[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator4_1resultdoc1d)!=0){
                $score4_1resultdoc1++;
            }
            $queryindicator4_1resultdoc1c= docpdca::where('pdca_id',$queryindicator4_1result1[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator4_1resultdoc1c)!=0){
                $score4_1resultdoc1++;
            }
            $queryindicator4_1resultdoc1a= docpdca::where('pdca_id',$queryindicator4_1result1[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator4_1resultdoc1a)!=0){
                $score4_1resultdoc1++;
            }
        }
        
        $queryindicator4_1result2= PDCA::where('category_pdca',2)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',4.1)
        ->get();
        if($queryindicator4_1result2!="[]"){
            $queryindicator4_1resultdoc2p= docpdca::where('pdca_id',$queryindicator4_1result2[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator4_1resultdoc2p)!=0){
                $score4_1resultdoc2++;
            }
            $queryindicator4_1resultdoc2d= docpdca::where('pdca_id',$queryindicator4_1result2[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator4_1resultdoc2d)!=0){
                $score4_1resultdoc2++;
            }
            $queryindicator4_1resultdoc2c= docpdca::where('pdca_id',$queryindicator4_1result2[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator4_1resultdoc2c)!=0){
                $score4_1resultdoc2++;
            }
            $queryindicator4_1resultdoc2a= docpdca::where('pdca_id',$queryindicator4_1result2[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator4_1resultdoc2a)!=0){
                $score4_1resultdoc2++;
            }
        }
        $queryindicator4_1result3= PDCA::where('category_pdca',3)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',4.1)
        ->get();
        if($queryindicator4_1result3!="[]"){
            $queryindicator4_1resultdoc3p= docpdca::where('pdca_id',$queryindicator4_1result3[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator4_1resultdoc3p)!=0){
                $score4_1resultdoc3++;
            }
            $queryindicator4_1resultdoc3d= docpdca::where('pdca_id',$queryindicator4_1result3[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator4_1resultdoc3d)!=0){
                $score4_1resultdoc3++;
            }
            $queryindicator4_1resultdoc3c= docpdca::where('pdca_id',$queryindicator4_1result3[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator4_1resultdoc3c)!=0){
                $score4_1resultdoc3++;
            }
            $queryindicator4_1resultdoc3a= docpdca::where('pdca_id',$queryindicator4_1result3[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator4_1resultdoc3a)!=0){
                $score4_1resultdoc3++;
            }
        }
        $queryindicator2_1result= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',2.1)
        ->where('pdca.target','!=',null)
        ->get();
        if($queryindicator4_1result1!="[]"){
            if($queryindicator4_1result1[0]['p']!=""){
                $score4_1result1++;
            }
            if($queryindicator4_1result1[0]['d']!=""){
                $score4_1result1++;
            }
            if($queryindicator4_1result1[0]['c']!=""){
                $score4_1result1++;
            }
            if($queryindicator4_1result1[0]['a']!=""){
                $score4_1result1++;
            }
        }
        
        if($queryindicator4_1result2!="[]"){
        if($queryindicator4_1result2[0]['p']!=""){
            $score4_1result2++;
        }
        if($queryindicator4_1result2[0]['d']!=""){
            $score4_1result2++;
        }
        if($queryindicator4_1result2[0]['c']!=""){
            $score4_1result2++;
        }
        if($queryindicator4_1result2[0]['a']!=""){
            $score4_1result2++;
        }
        }

        if($queryindicator4_1result3!="[]"){
        if($queryindicator4_1result3[0]['p']!=""){
            $score4_1result3++;
        }
        if($queryindicator4_1result3[0]['d']!=""){
            $score4_1result3++;
        }
        if($queryindicator4_1result3[0]['c']!=""){
            $score4_1result3++;
        }
        if($queryindicator4_1result3[0]['a']!=""){
            $score4_1result3++;
        }
       }
       $queryindicator4_1resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',4.1)
        ->where('pdca.target','!=',null)
        ->get();
        if($queryindicator4_1resultpdca!="[]"){
            $score4_1resultpdca++;
        }
        ////หมวดที่ 2 ตัวบ่งชี้ 4.1

        ////หมวดที่ 2 ตัวบ่งชี้ 4.2
        //// ตัวบ่งชี้ 4.2
        $score4_2result1=0;
        $score4_2result2=0;
        $score4_2resultpdca=0;
        //ดึงค่าตารางอาจารย์ผู้รับผิดชอบหลักสูตร
          $trc = course_responsible_teacher::join('year','course_responsible_teacher.year_id','=','year.year_id')
          ->where('course_responsible_teacher.course_id',session()->get('usercourse'))
          ->where('course_responsible_teacher.branch_id',session()->get('branch_id'))
          ->where('year.year_id',session()->get('year_id'))
          ->get();
          $educ_bg= User::leftjoin('course_responsible_teacher','users.id','=','course_responsible_teacher.user_id')
          ->where('users.user_course',session()->get('usercourse'))
          ->where('users.user_branch',session()->get('branch_id'))
          ->where('course_responsible_teacher.year_id',session()->get('year_id'))
          ->get();
          foreach($educ_bg as $key=>$t){
              if(count($educ_bg[$key]->research_results)!=0){
                      $score4_2result2=1;
              }
          }
         
          $queryindicator4_2resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
          ->where('pdca.course_id',session()->get('usercourse'))
          ->where('pdca.branch_id',session()->get('branch_id'))
          ->where('pdca.year_id',session()->get('year_id'))
          ->where('pdca.Indicator_id',4.2)
          ->where('pdca.target','!=',null)
          ->get();
          if($trc!="[]"){
              if(count($trc)!=0){
                  $score4_2result1++;
              }
          }
          if($queryindicator4_2resultpdca!="[]"){
              $score4_2resultpdca++;
          }
        ////ปิด ตัวบ่งชี้ 4.2
        ////หมวดที่ 2 ตัวบ่งชี้ 4.2

        ////หมวดที่ 2 ตัวบ่งชี้ 4.3
        $score4_3resultdoc1=0;
        $score4_3resultdoc2=0;
        $score4_3result1=0;
        $score4_3result2=0;

        $score4_3resultpdca=0;
        $queryindicator4_3result=indicator4_3::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if($queryindicator4_3result!="[]"){
            // $queryindicator4_3resultdoc= docpdca::where('doc_id',$queryindicator4_3result[0]['id'])
            // ->get();
            // if(count($queryindicator4_3resultdoc)!=0){
            //     $score4_3resultdoc1++;
            // }
            if(count($queryindicator4_3result)==2){
                $score4_3result1++;
                $score4_3result2++;
            }
        }
        $queryindicator4_3resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',4.3)
        ->where('pdca.target','!=',null)
        ->get();
        if($queryindicator4_3resultpdca!="[]"){
            $score4_3resultpdca++;
        }
        ////หมวดที่ 2 ตัวบ่งชี้ 4.3

        ///หมวดที่ 3 
         ////ตัวบ่งชี้ 2.1
         $getscore2_1=0;
         $getscore2_1result=0;
         $score2_1=0;
         $queryindicator2_1=indicator2_1::where('year_id',session()->get('year_id'))
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->get();
         $queryindicator2_1result= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
         ->where('pdca.branch_id',session()->get('branch_id'))
         ->where('pdca.year_id',session()->get('year_id'))
         ->where('pdca.Indicator_id',2.1)
         ->where('pdca.target','!=',null)
         ->get();
         if(count($queryindicator2_1)!=0){
             $getscore2_1++;
         }
         if(count($queryindicator2_1result)!=0){
             $getscore2_1++;
         }
         
         ////ตัวบ่งชี้ 2.1
 
         ////ตัวบ่งชี้ 2.2
         $getscore2_2=0;
         $getscore2_2result=0;
         $queryindicator2_2=indicator2_2::where('year_id',session()->get('year_id'))
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->get();
         $queryindicator2_2result= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
         ->where('pdca.branch_id',session()->get('branch_id'))
         ->where('pdca.year_id',session()->get('year_id'))
         ->where('pdca.Indicator_id',2.2)
         ->where('pdca.target','!=',null)
         ->get();
         if(count($queryindicator2_2)!=0){
             $getscore2_2++;
         }
         if(count($queryindicator2_2result)!=0){
             $getscore2_2++;
         }
         
         ////ตัวบ่งชี้ 2.2

         //// ตัวบ่งชี้ 3.1
        $score3_1resultdoc1=0;
        $score3_1resultdoc2=0;
        $score3_1result1=0;
        $score3_1result2=0;
        $score3_1resultpdca=0;
        $queryindicator3_1result1= PDCA::where('category_pdca',4)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',3.1)
        ->get();
        if($queryindicator3_1result1!="[]"){
            $queryindicator3_1resultdoc1p= docpdca::where('pdca_id',$queryindicator3_1result1[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator3_1resultdoc1p)!=0){
                $score3_1resultdoc1++;
            }
            $queryindicator3_1resultdoc1d= docpdca::where('pdca_id',$queryindicator3_1result1[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator3_1resultdoc1d)!=0){
                $score3_1resultdoc1++;
            }
            $queryindicator3_1resultdoc1c= docpdca::where('pdca_id',$queryindicator3_1result1[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator3_1resultdoc1c)!=0){
                $score3_1resultdoc1++;
            }
            $queryindicator3_1resultdoc1a= docpdca::where('pdca_id',$queryindicator3_1result1[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator3_1resultdoc1a)!=0){
                $score3_1resultdoc1++;
            }
        }
        
        $queryindicator3_1result2= PDCA::where('category_pdca',5)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',3.1)
        ->get();
        if($queryindicator3_1result2!="[]"){
            $queryindicator3_1resultdoc2p= docpdca::where('pdca_id',$queryindicator3_1result2[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator3_1resultdoc2p)!=0){
                $score3_1resultdoc2++;
            }
            $queryindicator3_1resultdoc2d= docpdca::where('pdca_id',$queryindicator3_1result2[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator3_1resultdoc2d)!=0){
                $score3_1resultdoc2++;
            }
            $queryindicator3_1resultdoc2c= docpdca::where('pdca_id',$queryindicator3_1result2[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator3_1resultdoc2c)!=0){
                $score3_1resultdoc2++;
            }
            $queryindicator3_1resultdoc2a= docpdca::where('pdca_id',$queryindicator3_1result2[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator3_1resultdoc2a)!=0){
                $score3_1resultdoc2++;
            }
        }
 

        if($queryindicator3_1result1!="[]"){
            if($queryindicator3_1result1[0]['p']!=""){
                $score3_1result1++;
            }
            if($queryindicator3_1result1[0]['d']!=""){
                $score3_1result1++;
            }
            if($queryindicator3_1result1[0]['c']!=""){
                $score3_1result1++;
            }
            if($queryindicator3_1result1[0]['a']!=""){
                $score3_1result1++;
            }
        }
        
        if($queryindicator3_1result2!="[]"){
        if($queryindicator3_1result2[0]['p']!=""){
            $score3_1result2++;
        }
        if($queryindicator3_1result2[0]['d']!=""){
            $score3_1result2++;
        }
        if($queryindicator3_1result2[0]['c']!=""){
            $score3_1result2++;
        }
        if($queryindicator3_1result2[0]['a']!=""){
            $score3_1result2++;
        }
        }

       $queryindicator3_1resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',3.1)
        ->where('pdca.target','!=',null)
        ->get();
        if($queryindicator3_1resultpdca!="[]"){
            $score3_1resultpdca++;
        }
        //// ปิดตัวบ่งชี้ 3.1


        //// ตัวบ่งชี้ 3.2
        $score3_2resultdoc1=0;
        $score3_2resultdoc2=0;
        $score3_2result1=0;
        $score3_2result2=0;
        $score3_2resultpdca=0;
        $queryindicator3_2result1= PDCA::where('category_pdca',6)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',3.2)
        ->get();
        if($queryindicator3_2result1!="[]"){
            $queryindicator3_2resultdoc1p= docpdca::where('pdca_id',$queryindicator3_2result1[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator3_2resultdoc1p)!=0){
                $score3_2resultdoc1++;
            }
            $queryindicator3_2resultdoc1d= docpdca::where('pdca_id',$queryindicator3_2result1[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator3_2resultdoc1d)!=0){
                $score3_2resultdoc1++;
            }
            $queryindicator3_2resultdoc1c= docpdca::where('pdca_id',$queryindicator3_2result1[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator3_2resultdoc1c)!=0){
                $score3_2resultdoc1++;
            }
            $queryindicator3_2resultdoc1a= docpdca::where('pdca_id',$queryindicator3_2result1[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator3_2resultdoc1a)!=0){
                $score3_2resultdoc1++;
            }
        }
        
        $queryindicator3_2result2= PDCA::where('category_pdca',7)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',3.2)
        ->get();
        if($queryindicator3_2result2!="[]"){
            $queryindicator3_2resultdoc2p= docpdca::where('pdca_id',$queryindicator3_2result2[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator3_2resultdoc2p)!=0){
                $score3_2resultdoc2++;
            }
            $queryindicator3_2resultdoc2d= docpdca::where('pdca_id',$queryindicator3_2result2[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator3_2resultdoc2d)!=0){
                $score3_2resultdoc2++;
            }
            $queryindicator3_2resultdoc2c= docpdca::where('pdca_id',$queryindicator3_2result2[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator3_2resultdoc2c)!=0){
                $score3_2resultdoc2++;
            }
            $queryindicator3_2resultdoc2a= docpdca::where('pdca_id',$queryindicator3_2result2[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator3_2resultdoc2a)!=0){
                $score3_2resultdoc2++;
            }
        }
 

        if($queryindicator3_2result1!="[]"){
            if($queryindicator3_2result1[0]['p']!=""){
                $score3_2result1++;
            }
            if($queryindicator3_2result1[0]['d']!=""){
                $score3_2result1++;
            }
            if($queryindicator3_2result1[0]['c']!=""){
                $score3_2result1++;
            }
            if($queryindicator3_2result1[0]['a']!=""){
                $score3_2result1++;
            }
        }
        
        if($queryindicator3_2result2!="[]"){
        if($queryindicator3_2result2[0]['p']!=""){
            $score3_2result2++;
        }
        if($queryindicator3_2result2[0]['d']!=""){
            $score3_2result2++;
        }
        if($queryindicator3_2result2[0]['c']!=""){
            $score3_2result2++;
        }
        if($queryindicator3_2result2[0]['a']!=""){
            $score3_2result2++;
        }
        }

       $queryindicator3_2resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',3.2)
        ->where('pdca.target','!=',null)
        ->get();
        if($queryindicator3_2resultpdca!="[]"){
            $score3_2resultpdca++;
        }
        //// ปิดตัวบ่งชี้ 3.2

         ////ตัวบ่งชี้ 3.3
         $score3_3resultdoc1=0;
         $score3_3resultdoc2=0;
         $score3_3result1=0;
         $score3_3result2=0;
         $score3_3result3=0;
         $score3_3resultpdca=0;
         $queryindicator3_3result=performance3_3::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
         if($queryindicator3_3result!="[]"){
             // $queryindicator3_3resultdoc= docpdca::where('doc_id',$queryindicator3_3result[0]['id'])
             // ->get();
             // if(count($queryindicator3_3resultdoc)!=0){
             //     $score3_3resultdoc1++;
             // }
             if(count($queryindicator3_3result)==3){
                 $score3_3result1++;
                 $score3_3result2++;
                 $score3_3result3++;
             }
         }
         $queryindicator3_3resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
         ->where('pdca.branch_id',session()->get('branch_id'))
         ->where('pdca.year_id',session()->get('year_id'))
         ->where('pdca.Indicator_id',3.3)
         ->where('pdca.target','!=',null)
         ->get();
         if($queryindicator3_3resultpdca!="[]"){
             $score3_3resultpdca++;
         }
         ////ปิดตัวบ่งชี้ 3.3

          ////ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา
          $scorfactor=0;
          $factor=category3_GD::where('category_factor','ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา')
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
          ->where('year_id',session()->get('year_id'))
         ->get();
         if($factor!="[]"){
             $scorfactor++;
         }
          ////ปิด ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา
 
           ////ปัยจัยที่มีผลกระทบต่อการสำเร็จการศึกษา
           $scorfactor2=0;
           $factor2=category3_GD::where('category_factor','ปัยจัยที่มีผลกระทบต่อการสำเร็จการศึกษา')
          ->where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
           ->where('year_id',session()->get('year_id'))
          ->get();
          if($factor2!="[]"){
              $scorfactor2++;
          }
           ////ปิด ปัยจัยที่มีผลกระทบต่อการสำเร็จการศึกษา
 
          ////ข้อมูลนักศึกษา
          $scoreinfo=0;
          $scoreinfoqty=0;
          $getyear=category3_infostudent::where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
             ->where('year_add',session()->get('year'))
             ->get();
         $getqty=category3_infostudent_qty::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
             ->where('year_id',session()->get('year_id'))
             ->get();
         if($getyear!="[]"){
             $scoreinfo++;
         }
         if($getqty!="[]"){
             $scoreinfoqty++;
         }
          ////ปิด ข้อมูลนักศึกษา
 
         ////จำนวนผู้สำเร็จการศึกษา
         $get=year_acceptance_graduate::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->get();
         $scoregraduate=0;
         if($get!="[]"){
            $getinfo=category3_graduate::where('course_id',session()->get('usercourse'))
            ->where('branch_id',session()->get('branch_id'))
            ->where('year_add',session()->get('year'))
            ->get();
             if($getinfo!="[]"){
                $scoregraduate++;
            }
         }
        
        
         ////ปิด จำนวนผู้สำเร็จการศึกษา
 
        ////จำนวนที่ลาออกและคัดชื่อออกสะสมจนถึงสิ้นปีการศึกษา
        $scorere=0;
         $re=category3_resignation::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_present',session()->get('year'))
         ->get();
       if($re!="[]"){
           $scorere++;
       }
        ////ปิด จำนวนที่ลาออกและคัดชื่อออกสะสมจนถึงสิ้นปีการศึกษา
        ///ปิดหมวดที่ 3 

        ///หมวดที่ 4 
        //// ตัวบ่งชี้ 5.1
        $score5_1resultdoc1=0;
        $score5_1resultdoc2=0;
        $score5_1resultdoc3=0;
        $score5_1result1=0;
        $score5_1result2=0;
        $score5_1result3=0;
        $score5_1resultpdca=0;
        $queryindicator5_1result1= PDCA::where('category_pdca',12)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',5.1)
        ->get();
        if($queryindicator5_1result1!="[]"){
            $queryindicator5_1resultdoc1p= docpdca::where('pdca_id',$queryindicator5_1result1[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator5_1resultdoc1p)!=0){
                $score5_1resultdoc1++;
            }
            $queryindicator5_1resultdoc1d= docpdca::where('pdca_id',$queryindicator5_1result1[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator5_1resultdoc1d)!=0){
                $score5_1resultdoc1++;
            }
            $queryindicator5_1resultdoc1c= docpdca::where('pdca_id',$queryindicator5_1result1[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator5_1resultdoc1c)!=0){
                $score5_1resultdoc1++;
            }
            $queryindicator5_1resultdoc1a= docpdca::where('pdca_id',$queryindicator5_1result1[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator5_1resultdoc1a)!=0){
                $score5_1resultdoc1++;
            }
        }
        
        $queryindicator5_1result2= PDCA::where('category_pdca',13)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',5.1)
        ->get();
        if($queryindicator5_1result2!="[]"){
            $queryindicator5_1resultdoc2p= docpdca::where('pdca_id',$queryindicator5_1result2[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator5_1resultdoc2p)!=0){
                $score5_1resultdoc2++;
            }
            $queryindicator5_1resultdoc2d= docpdca::where('pdca_id',$queryindicator5_1result2[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator5_1resultdoc2d)!=0){
                $score5_1resultdoc2++;
            }
            $queryindicator5_1resultdoc2c= docpdca::where('pdca_id',$queryindicator5_1result2[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator5_1resultdoc2c)!=0){
                $score5_1resultdoc2++;
            }
            $queryindicator5_1resultdoc2a= docpdca::where('pdca_id',$queryindicator5_1result2[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator5_1resultdoc2a)!=0){
                $score5_1resultdoc2++;
            }
        }
        $queryindicator5_1result3= PDCA::where('category_pdca',14)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',5.1)
        ->get();
        if($queryindicator5_1result3!="[]"){
            $queryindicator5_1resultdoc3p= docpdca::where('pdca_id',$queryindicator5_1result3[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator5_1resultdoc3p)!=0){
                $score5_1resultdoc3++;
            }
            $queryindicator5_1resultdoc3d= docpdca::where('pdca_id',$queryindicator5_1result3[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator5_1resultdoc3d)!=0){
                $score5_1resultdoc3++;
            }
            $queryindicator5_1resultdoc3c= docpdca::where('pdca_id',$queryindicator5_1result3[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator5_1resultdoc3c)!=0){
                $score5_1resultdoc3++;
            }
            $queryindicator5_1resultdoc3a= docpdca::where('pdca_id',$queryindicator5_1result3[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator5_1resultdoc3a)!=0){
                $score5_1resultdoc3++;
            }
        }

        if($queryindicator5_1result1!="[]"){
            if($queryindicator5_1result1[0]['p']!=""){
                $score5_1result1++;
            }
            if($queryindicator5_1result1[0]['d']!=""){
                $score5_1result1++;
            }
            if($queryindicator5_1result1[0]['c']!=""){
                $score5_1result1++;
            }
            if($queryindicator5_1result1[0]['a']!=""){
                $score5_1result1++;
            }
        }
        
        if($queryindicator5_1result2!="[]"){
        if($queryindicator5_1result2[0]['p']!=""){
            $score5_1result2++;
        }
        if($queryindicator5_1result2[0]['d']!=""){
            $score5_1result2++;
        }
        if($queryindicator5_1result2[0]['c']!=""){
            $score5_1result2++;
        }
        if($queryindicator5_1result2[0]['a']!=""){
            $score5_1result2++;
        }
        }

        if($queryindicator5_1result3!="[]"){
        if($queryindicator5_1result3[0]['p']!=""){
            $score5_1result3++;
        }
        if($queryindicator5_1result3[0]['d']!=""){
            $score5_1result3++;
        }
        if($queryindicator5_1result3[0]['c']!=""){
            $score5_1result3++;
        }
        if($queryindicator5_1result3[0]['a']!=""){
            $score5_1result3++;
        }
       }
       $queryindicator5_1resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',5.1)
        ->where('pdca.target','!=',null)
        ->get();
        if($queryindicator5_1resultpdca!="[]"){
            $score5_1resultpdca++;
        }
        //// ปิด ตัวบ่งชี้ 5.1

        //// ตัวบ่งชี้ 5.2
        $score5_2resultdoc1=0;
        $score5_2resultdoc2=0;
        $score5_2resultdoc3=0;
        $score5_2result1=0;
        $score5_2result2=0;
        $score5_2result3=0;
        $score5_2resultpdca=0;
        $queryindicator5_2result1= PDCA::where('category_pdca',8)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',5.2)
        ->get();
        if($queryindicator5_2result1!="[]"){
            $queryindicator5_2resultdoc1p= docpdca::where('pdca_id',$queryindicator5_2result1[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator5_2resultdoc1p)!=0){
                $score5_2resultdoc1++;
            }
            $queryindicator5_2resultdoc1d= docpdca::where('pdca_id',$queryindicator5_2result1[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator5_2resultdoc1d)!=0){
                $score5_2resultdoc1++;
            }
            $queryindicator5_2resultdoc1c= docpdca::where('pdca_id',$queryindicator5_2result1[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator5_2resultdoc1c)!=0){
                $score5_2resultdoc1++;
            }
            $queryindicator5_2resultdoc1a= docpdca::where('pdca_id',$queryindicator5_2result1[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator5_2resultdoc1a)!=0){
                $score5_2resultdoc1++;
            }
        }
        
        $queryindicator5_2result2= PDCA::where('category_pdca',9)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',5.2)
        ->get();
        if($queryindicator5_2result2!="[]"){
            $queryindicator5_2resultdoc2p= docpdca::where('pdca_id',$queryindicator5_2result2[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator5_2resultdoc2p)!=0){
                $score5_2resultdoc2++;
            }
            $queryindicator5_2resultdoc2d= docpdca::where('pdca_id',$queryindicator5_2result2[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator5_2resultdoc2d)!=0){
                $score5_2resultdoc2++;
            }
            $queryindicator5_2resultdoc2c= docpdca::where('pdca_id',$queryindicator5_2result2[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator5_2resultdoc2c)!=0){
                $score5_2resultdoc2++;
            }
            $queryindicator5_2resultdoc2a= docpdca::where('pdca_id',$queryindicator5_2result2[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator5_2resultdoc2a)!=0){
                $score5_2resultdoc2++;
            }
        }
        $queryindicator5_2result3= PDCA::where('category_pdca',10)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',5.2)
        ->get();
        if($queryindicator5_2result3!="[]"){
            $queryindicator5_2resultdoc3p= docpdca::where('pdca_id',$queryindicator5_2result3[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator5_2resultdoc3p)!=0){
                $score5_2resultdoc3++;
            }
            $queryindicator5_2resultdoc3d= docpdca::where('pdca_id',$queryindicator5_2result3[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator5_2resultdoc3d)!=0){
                $score5_2resultdoc3++;
            }
            $queryindicator5_2resultdoc3c= docpdca::where('pdca_id',$queryindicator5_2result3[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator5_2resultdoc3c)!=0){
                $score5_2resultdoc3++;
            }
            $queryindicator5_2resultdoc3a= docpdca::where('pdca_id',$queryindicator5_2result3[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator5_2resultdoc3a)!=0){
                $score5_2resultdoc3++;
            }
        }

        if($queryindicator5_2result1!="[]"){
            if($queryindicator5_2result1[0]['p']!=""){
                $score5_2result1++;
            }
            if($queryindicator5_2result1[0]['d']!=""){
                $score5_2result1++;
            }
            if($queryindicator5_2result1[0]['c']!=""){
                $score5_2result1++;
            }
            if($queryindicator5_2result1[0]['a']!=""){
                $score5_2result1++;
            }
        }
        
        if($queryindicator5_2result2!="[]"){
        if($queryindicator5_2result2[0]['p']!=""){
            $score5_2result2++;
        }
        if($queryindicator5_2result2[0]['d']!=""){
            $score5_2result2++;
        }
        if($queryindicator5_2result2[0]['c']!=""){
            $score5_2result2++;
        }
        if($queryindicator5_2result2[0]['a']!=""){
            $score5_2result2++;
        }
        }

        if($queryindicator5_2result3!="[]"){
        if($queryindicator5_2result3[0]['p']!=""){
            $score5_2result3++;
        }
        if($queryindicator5_2result3[0]['d']!=""){
            $score5_2result3++;
        }
        if($queryindicator5_2result3[0]['c']!=""){
            $score5_2result3++;
        }
        if($queryindicator5_2result3[0]['a']!=""){
            $score5_2result3++;
        }
       }
       $queryindicator5_2resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',5.2)
        ->where('pdca.target','!=',null)
        ->get();
        if($queryindicator5_2resultpdca!="[]"){
            $score5_2resultpdca++;
        }
        //// ปิด ตัวบ่งชี้ 5.2

        //// ตัวบ่งชี้ 5.3
       $score5_3resultdoc1=0;
       $score5_3resultdoc2=0;
       $score5_3result1=0;
       $score5_3result2=0;
       $score5_3resultpdca=0;
       $queryindicator5_3result1= PDCA::where('category_pdca',15)
       ->where('course_id',session()->get('usercourse'))
       ->where('branch_id',session()->get('branch_id'))
       ->where('year_id',session()->get('year_id'))
       ->where('Indicator_id',5.3)
       ->get();
       if($queryindicator5_3result1!="[]"){
           $queryindicator5_3resultdoc1p= docpdca::where('pdca_id',$queryindicator5_3result1[0]['pdca_id'])
           ->where('categorypdca','p')
           ->get();
           if(count($queryindicator5_3resultdoc1p)!=0){
               $score5_3resultdoc1++;
           }
           $queryindicator5_3resultdoc1d= docpdca::where('pdca_id',$queryindicator5_3result1[0]['pdca_id'])
           ->where('categorypdca','d')
           ->get();
           if(count($queryindicator5_3resultdoc1d)!=0){
               $score5_3resultdoc1++;
           }
           $queryindicator5_3resultdoc1c= docpdca::where('pdca_id',$queryindicator5_3result1[0]['pdca_id'])
           ->where('categorypdca','c')
           ->get();
           if(count($queryindicator5_3resultdoc1c)!=0){
               $score5_3resultdoc1++;
           }
           $queryindicator5_3resultdoc1a= docpdca::where('pdca_id',$queryindicator5_3result1[0]['pdca_id'])
           ->where('categorypdca','a')
           ->get();
           if(count($queryindicator5_3resultdoc1a)!=0){
               $score5_3resultdoc1++;
           }
       }
       
       $queryindicator5_3result2= PDCA::where('category_pdca',16)
       ->where('course_id',session()->get('usercourse'))
       ->where('branch_id',session()->get('branch_id'))
       ->where('year_id',session()->get('year_id'))
       ->where('Indicator_id',5.3)
       ->get();
       if($queryindicator5_3result2!="[]"){
           $queryindicator5_3resultdoc2p= docpdca::where('pdca_id',$queryindicator5_3result2[0]['pdca_id'])
           ->where('categorypdca','p')
           ->get();
           if(count($queryindicator5_3resultdoc2p)!=0){
               $score5_3resultdoc2++;
           }
           $queryindicator5_3resultdoc2d= docpdca::where('pdca_id',$queryindicator5_3result2[0]['pdca_id'])
           ->where('categorypdca','d')
           ->get();
           if(count($queryindicator5_3resultdoc2d)!=0){
               $score5_3resultdoc2++;
           }
           $queryindicator5_3resultdoc2c= docpdca::where('pdca_id',$queryindicator5_3result2[0]['pdca_id'])
           ->where('categorypdca','c')
           ->get();
           if(count($queryindicator5_3resultdoc2c)!=0){
               $score5_3resultdoc2++;
           }
           $queryindicator5_3resultdoc2a= docpdca::where('pdca_id',$queryindicator5_3result2[0]['pdca_id'])
           ->where('categorypdca','a')
           ->get();
           if(count($queryindicator5_3resultdoc2a)!=0){
               $score5_3resultdoc2++;
           }
       }


       if($queryindicator5_3result1!="[]"){
           if($queryindicator5_3result1[0]['p']!=""){
               $score5_3result1++;
           }
           if($queryindicator5_3result1[0]['d']!=""){
               $score5_3result1++;
           }
           if($queryindicator5_3result1[0]['c']!=""){
               $score5_3result1++;
           }
           if($queryindicator5_3result1[0]['a']!=""){
               $score5_3result1++;
           }
       }
       
       if($queryindicator5_3result2!="[]"){
       if($queryindicator5_3result2[0]['p']!=""){
           $score5_3result2++;
       }
       if($queryindicator5_3result2[0]['d']!=""){
           $score5_3result2++;
       }
       if($queryindicator5_3result2[0]['c']!=""){
           $score5_3result2++;
       }
       if($queryindicator5_3result2[0]['a']!=""){
           $score5_3result2++;
       }
       }

      $queryindicator5_3resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
       ->where('pdca.course_id',session()->get('usercourse'))
       ->where('pdca.branch_id',session()->get('branch_id'))
       ->where('pdca.year_id',session()->get('year_id'))
       ->where('pdca.Indicator_id',5.3)
       ->where('pdca.target','!=',null)
       ->get();
       if($queryindicator5_3resultpdca!="[]"){
           $score5_3resultpdca++;
       }
       //// ปิดตัวบ่งชี้ 5.3

       //// ตัวบ่งชี้ 5.4
       $score5_4result1=0;
       $score5_4resultpdca=0;
       $perfor=indicator5_4::where('course_id',session()->get('usercourse'))
       ->where('branch_id',session()->get('branch_id'))
       ->where('year_id',session()->get('year_id'))
       ->get();
       $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
       ->where('pdca.course_id',session()->get('usercourse'))
       ->where('pdca.branch_id',session()->get('branch_id'))
       ->where('pdca.year_id',session()->get('year_id'))
       ->where('pdca.indicator_id',5.4)
       ->where('pdca.target','!=',null)
       ->get();
       if($inc!="[]"){
           $score5_4resultpdca++;
       }
       if($perfor!="[]"){
           $score5_4result1++;
       }
       //// ปิด ตัวบ่งชี้ 5.4

        //// คุณภาพการสอน
        $scoreteachqua=0;
        $teachqua=category4_teaching_quality::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
       ->where('year_id',session()->get('year_id'))
       ->get();
        if($teachqua!="[]"){
            $scoreteachqua++;
        }
        //// ปิด คุณภาพการสอน

        //// สรุปผลรายวิชาที่เปิดสอนในภาค/ปีการศึกษา
        $scoreccr=0;
        $ccr=category4_course_results::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
       ->where('year_id',session()->get('year_id'))
       ->get();
        if($ccr!="[]"){
            $scoreccr++;
        }
        //// ปิด สรุปผลรายวิชาที่เปิดสอนในภาค/ปีการศึกษา

        //// การวิเคราะห์รายวิชาที่มีผลการเรียนที่ไม่ปกติ
        $scoreacademic=0;
        $academic=category4_academic_performance::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
       ->where('year_id',session()->get('year_id'))
       ->get();
        if($academic!="[]"){
            $scoreacademic++;
        }
        //// ปิด การวิเคราะห์รายวิชาที่มีผลการเรียนที่ไม่ปกติ
        
        //// รายวิชาที่ไม่ได้เปิดสอนในปีการศึกษา
        $scorenot_offered=0;
        $not_offered=category4_notcourse_results::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
       ->where('year_id',session()->get('year_id'))
       ->get();
        if($not_offered!="[]"){
            $scorenot_offered++;
        }
        //// ปิด รายวิชาที่ไม่ได้เปิดสอนในปีการศึกษา

        //// รายวิชาที่สอนเนื้อหาไม่ครบในปีการศึกษา
        $scoreincomplete_content=0;
        $queryincomplete_content=category4_incomplete_content::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
       ->where('year_id',session()->get('year_id'))
       ->get();
        if($queryincomplete_content!="[]"){
            $scoreincomplete_content++;
        }
        //// ปิด รายวิชาที่สอนเนื้อหาไม่ครบในปีการศึกษา

        //// ประสิทธิผลของกลยุทธ์การสอน
        $scoreeffec=0;
        $effec=category4_effectiveness::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if($effec!="[]"){
            $scoreeffec++;
        }
        //// ปิด ประสิทธิผลของกลยุทธ์การสอน

        //// การปฐมนิเทศอาจารย์ใหม่
        $scorenewteacher=0;
        $th=category4_newteacher::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
       ->where('year_id',session()->get('year_id'))
       ->get();
        if($th!="[]"){
            $scorenewteacher++;
        }
        //// ปิด การปฐมนิเทศอาจารย์ใหม่
        
        //// กิจกรรมการพัฒนาวิชาชีพของอาจารย์
        $scoreactivity=0;
        $activity=category4_activity::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if($activity!="[]"){
            $scoreactivity++;
        }
        //// ปิด กิจกรรมการพัฒนาวิชาชีพของอาจารย์
        ///ปิดหมวดที่ 4
        ///หมวดที่ 5 

        //// ตัวบ่งชี้ 6.1
        $score6_1resultdoc1=0;
        $score6_1result1=0;
        $score6_1resultpdca=0;
        $queryindicator6_1result1= PDCA::where('category_pdca',11)
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('Indicator_id',6.1)
        ->get();
        if($queryindicator6_1result1!="[]"){
            $queryindicator6_1resultdoc1p= docpdca::where('pdca_id',$queryindicator6_1result1[0]['pdca_id'])
            ->where('categorypdca','p')
            ->get();
            if(count($queryindicator6_1resultdoc1p)!=0){
                $score6_1resultdoc1++;
            }
            $queryindicator6_1resultdoc1d= docpdca::where('pdca_id',$queryindicator6_1result1[0]['pdca_id'])
            ->where('categorypdca','d')
            ->get();
            if(count($queryindicator6_1resultdoc1d)!=0){
                $score6_1resultdoc1++;
            }
            $queryindicator6_1resultdoc1c= docpdca::where('pdca_id',$queryindicator6_1result1[0]['pdca_id'])
            ->where('categorypdca','c')
            ->get();
            if(count($queryindicator6_1resultdoc1c)!=0){
                $score6_1resultdoc1++;
            }
            $queryindicator6_1resultdoc1a= docpdca::where('pdca_id',$queryindicator6_1result1[0]['pdca_id'])
            ->where('categorypdca','a')
            ->get();
            if(count($queryindicator6_1resultdoc1a)!=0){
                $score6_1resultdoc1++;
            }
        }
 

        if($queryindicator6_1result1!="[]"){
            if($queryindicator6_1result1[0]['p']!=""){
                $score6_1result1++;
            }
            if($queryindicator6_1result1[0]['d']!=""){
                $score6_1result1++;
            }
            if($queryindicator6_1result1[0]['c']!=""){
                $score6_1result1++;
            }
            if($queryindicator6_1result1[0]['a']!=""){
                $score6_1result1++;
            }
        }
       $queryindicator6_1resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',6.1)
        ->where('pdca.target','!=',null)
        ->get();
        if($queryindicator6_1resultpdca!="[]"){
            $score6_1resultpdca++;
        }
        //// ปิดตัวบ่งชี้ 6.1

        //// การบริหารหลักสูตร
        $scorecoursemanage=0;
        $coursemanage=category5_course_manage::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if($coursemanage!="[]"){
            $scorecoursemanage++;
        }
        //// ปิด การบริหารหลักสูตร


        ///ปิดหมวดที่ 5 

        ////หมวดที่ 6 
         //// สรุปการประเมินหลักสูตร	
         $scoreassessmentsummary=0;
         $scoreassessmentsummary2=0;
         $queryassessmentsummary=category6_assessment_summary::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('category_assessor','=','การประเมินจากผู้ที่สำเร็จการศึกษา')
         ->where('year_id',session()->get('year_id'))
         ->get();
         if($queryassessmentsummary!="[]"){
             $scoreassessmentsummary++;
         }        
         $queryassessmentsummary2=category6_assessment_summary::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('category_assessor','=','การประเมินจากผู้ที่มีส่วนเกี่ยวข้อง')
         ->where('year_id',session()->get('year_id'))
         ->get();
         if($queryassessmentsummary2!="[]"){
             $scoreassessmentsummary2++;
         }
         //// ปิด สรุปการประเมินหลักสูตร
 
         //// ข้อคิดเห็น และข้อเสนอแนะเกี่ยวกับคุณภาพหลักสูตรจากผู้ประเมิน
         $scorecomment_course=0;
         $querycomment_course=category6_comment_course::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
         if($querycomment_course!="[]"){
             $scorecomment_course++;
         }
         //// ปิด ข้อคิดเห็น และข้อเสนอแนะเกี่ยวกับคุณภาพหลักสูตรจากผู้ประเมิน
        ////ปิดหมวดที่ 6

        ////หมวดที่ 7 
         //// ความก้าวหน้าของการดำเนินงานตามแผนที่เสนอในรายงานของปีที่ผ่านมา
        $scorestrength=0;
        $querystrength=category7_strength::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if($querystrength!="[]"){
            $scorestrength++;
        }
        //// ปิด ความก้าวหน้าของการดำเนินงานตามแผนที่เสนอในรายงานของปีที่ผ่านมา


        //// ข้อเสนอในการพัฒนาหลักสูตร
        $scoredevelopment_proposal=0;
        $querydevelopment_proposal=category7_development_proposal_detail::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if($querydevelopment_proposal!="[]"){
            $scoredevelopment_proposal++;
        }
        //// ปิด ข้อเสนอในการพัฒนาหลักสูตร

         //// แผนปฏิบัติการใหม่
         $scorenewstrength=0;
         $querynewstrength=category7_newstrength::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
         if($querynewstrength!="[]"){
             $scorenewstrength++;
         }
         //// ปิด แผนปฏิบัติการใหม่
        ////ปิดหมวดที่7
        
        ////สรุปผลการดำเนินงาน
        //// สรุปจุดแข็ง จุดที่ควรพัฒนา และแนวทางการพัฒนา
        $scorestrengths_summary=0;
        $querynewstrength2=category7_strengths_summary::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('composition_id',2)
        ->get();
        $querynewstrength3=category7_strengths_summary::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('composition_id',3)
        ->get();
        $querynewstrength4=category7_strengths_summary::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('composition_id',4)
        ->get();
        $querynewstrength5=category7_strengths_summary::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('composition_id',5)
        ->get();
        $querynewstrength6=category7_strengths_summary::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->where('composition_id',6)
        ->get();

        if($querynewstrength2!="[]"){
           $scorestrengths_summary++;
       }
       if($querynewstrength3!="[]"){
           $scorestrengths_summary++;
       }
       if($querynewstrength4!="[]"){
           $scorestrengths_summary++;
       }
       if($querynewstrength5!="[]"){
           $scorestrengths_summary++;
       }
       if($querynewstrength6!="[]"){
           $scorestrengths_summary++;
       }
        //// ปิด สรุปจุดแข็ง จุดที่ควรพัฒนา และแนวทางการพัฒนา
        ////ปิด  สรุปผลการดำเนินงาน
        ////ปิด  สรุปผลการดำเนินงาน
         $result1_1=(($getscore1_1+$getscore1_1result)*100)/9;
        $result2_1=($getscore2_1*100)/2;
        $result2_2=($getscore2_2*100)/2;
        $result3_1=(($score3_1result1+$score3_1result2+$score3_1resultdoc1+$score3_1resultdoc2+$score3_1resultpdca)*100)/17;
        $result3_2=(($score3_2result1+$score3_2result2+$score3_2resultdoc1+$score3_2resultdoc2+$score3_2resultpdca)*100)/17;
        $result3_3=(($score3_3result1+$score3_3result2+$score3_3result3+$score3_3resultpdca)*100)/4;
        $resultscorfactor=($scorfactor*100)/1;
        $resultscorfactor2=($scorfactor2*100)/1;
        $resultinfo=(($scoreinfo+$scoreinfoqty)*100)/2;
        $resultgraduate=($scoregraduate*100)/1;
        $resultscorere=($scorere*100)/1;
        $result4_3=(($score4_3result1+$score4_3result2+$score4_3resultpdca)*100)/3;
        $result4_2=(($score4_2result1+$score4_2result2+$score4_2resultpdca)*100)/3;
        $result4_1=(($score4_1result1+$score4_1result2+$score4_1result3+$score4_1resultdoc1+$score4_1resultdoc2+
                    $score4_1resultdoc3+$score4_1resultpdca)*100)/25;
        $result5_1=(($score5_1result1+$score5_1result2+$score5_1result3+$score5_1resultdoc1+$score5_1resultdoc2+
                    $score5_1resultdoc3+$score5_1resultpdca)*100)/25;
        $result5_2=(($score5_2result1+$score5_2result2+$score5_2result3+$score5_2resultdoc1+$score5_2resultdoc2+
                    $score5_2resultdoc3+$score5_2resultpdca)*100)/25;
        $result5_3=(($score5_3result1+$score5_3result2+$score5_3resultdoc1+$score5_3resultdoc2+$score5_3resultpdca)*100)/17;
        $result5_4=(($score5_4result1+$score5_4resultpdca)*100)/2;
        $resultteachqua=($scoreteachqua*100)/1;
        $resultscoreccr=($scoreccr*100)/1;
        $resultscoreacademic=($scoreacademic*100)/1;
        $resultscorenot_offered=($scorenot_offered*100)/1;
        $resultscoreincomplete_content=($scoreincomplete_content*100)/1;
        $resultscoreeffec=($scoreeffec*100)/1;
        $resultscorenewteacher=($scorenewteacher*100)/1;
        $resultscoreactivity=($scoreactivity*100)/1;
        $result6_1=(($score6_1result1+$score6_1resultdoc1+$score6_1resultpdca)*100)/9;
        $course_manage=($scorecoursemanage*100)/1;
        $assessmentsummary=(($scoreassessmentsummary+$scoreassessmentsummary2)*100)/2;
        $resultscorecomment_course=($scorecomment_course*100)/1;
        $resultscorestrength=($scorestrength*100)/1;
        $resultscoredevelopment_proposal=($scoredevelopment_proposal*100)/1;
        $resultscorenewstrength=($scorenewstrength*100)/1;
        $resultscorestrengths_summary=($scorestrengths_summary*100)/5;


        $indicator1_1 = sprintf('%.0f',$result1_1);
        $indicator2_1 = sprintf('%.0f',$result2_1);
        $indicator2_2 = sprintf('%.0f',$result2_2);
        $indicator3_1 = sprintf('%.0f',$result3_1);
        $indicator3_2 = sprintf('%.0f',$result3_2);
        $indicator3_3 = sprintf('%.0f',$result3_3);
        $factor = sprintf('%.0f',$resultscorfactor);
        $factor2 = sprintf('%.0f',$resultscorfactor2);
        $infostd = sprintf('%.0f',$resultinfo);
        $graduate = sprintf('%.0f',$resultgraduate);
        $resignation = sprintf('%.0f',$resultscorere);
        $indicator4_1 = sprintf('%.0f',$result4_1);
        $indicator4_2 = sprintf('%.0f',$result4_2);
        $indicator4_3 = sprintf('%.0f',$result4_3);
        $indicator5_1 = sprintf('%.0f',$result5_1);
        $indicator5_2 = sprintf('%.0f',$result5_2);
        $indicator5_3 = sprintf('%.0f',$result5_3);
        $indicator5_4 = sprintf('%.0f',$result5_4);
        $teachqua = sprintf('%.0f',$resultteachqua);
        $course_results = sprintf('%.0f',$resultscoreccr);
        $academic = sprintf('%.0f',$resultscoreacademic);
        $not_offered = sprintf('%.0f',$resultscorenot_offered);
        $incomplete_content = sprintf('%.0f',$resultscoreincomplete_content);
        $effectiveness = sprintf('%.0f',$resultscoreeffec);
        $newteacher = sprintf('%.0f',$resultscorenewteacher);
        $activity = sprintf('%.0f',$resultscoreactivity);
        $indicator6_1 = sprintf('%.0f',$result6_1);
        $getcourse_manage = sprintf('%.0f',$course_manage);
        $getassessmentsummary = sprintf('%.0f',$assessmentsummary);
        $getresultscorecomment_course = sprintf('%.0f',$resultscorecomment_course);
        $getresultscorestrength = sprintf('%.0f',$resultscorestrength);
        $getscoredevelopment_proposal = sprintf('%.0f',$resultscoredevelopment_proposal);
        $getresultscorenewstrength = sprintf('%.0f',$resultscorenewstrength);
        $getresultscorestrengths_summary = sprintf('%.0f',$resultscorestrengths_summary);
        /////หน้าแรก
        $queryworkandindicator=User::where('user_course',session()->get('usercourse'))
        ->where('user_branch',session()->get('branch_id'))
        ->where('user_group_id','!=',2)
        ->where('user_group_id','!=',1)
        ->get();
        $i=0;
        $m=1;
        foreach($queryworkandindicator as $value){
            $getdataall=0;
            $countr=0;
            foreach($value->user_permission as $row){

           
            if($row['Indicator_id']=="1.1"){
                $getdataall+=$indicator1_1;
                $countr+=100;
                
            }
             if($row['Indicator_id']=="2.1"){
                $getdataall+=$result2_1;
                $countr+=100;
                
            }
            if($row['Indicator_id']=="2.2"){
                $getdataall+=$result2_2;
                $countr+=100;
                
            }
             if($row['Indicator_id']=="3.1"){
                $getdataall+=$indicator3_1;
                $countr+=100;
                
            }
             if($row['Indicator_id']=="3.2"){
                $getdataall+=$indicator3_2;
                $countr+=100;
            }
             if($row['Indicator_id']=="3.3"){
                $getdataall+=$indicator3_3;
                $countr+=100;
            }
             if($row['Indicator_id']=="4.1"){
                $getdataall+=$indicator4_1;
                $countr+=100;
            }
            if($row['Indicator_id']=="4.2"){
               $getdataall+=$indicator4_2;
                $countr+=100;
           }
           if($row['Indicator_id']=="4.3"){
               $getdataall+=$indicator4_3;
                $countr+=100;
           }
           if($row['Indicator_id']=="5.1"){
               $getdataall+=$indicator5_1;
               $countr+=100;
           }
           if($row['Indicator_id']=="5.2"){
               $getdataall+=$indicator5_2;
               $countr+=100;
           }
           if($row['Indicator_id']=="5.3"){
               $getdataall+=$indicator5_3;
               $countr+=100;
           }
           if($row['Indicator_id']=="5.4"){
               $getdataall+=$indicator5_4;
               $countr+=100;
           }
           if($row['Indicator_id']=="6.1"){
               $getdataall+=$indicator6_1;
               $countr+=100;
               }
           
               if($row['Indicator_name']=="คุณภาพการสอน"){
                   $getdataall+=$teachqua;
                   $countr+=100;
                   }
                   if($row['Indicator_name']=="ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา"){
                       $getdataall+=$factor;
                       $countr+=100;
                       }
                       if($row['Indicator_name']=="ปัยจัยที่มีผลกระทบต่อการสำเร็จการศึกษา"){
                           $getdataall+=$factor2;
                           $countr+=100;
                           }
                           if($row['Indicator_name']=="สรุปการประเมินหลักสูตร"){
                               $getdataall+=$getassessmentsummary;
                               $countr+=100;
                               }
                                   if($row['Indicator_name']=="สรุปผลรายวิชาที่เปิดสอน"){
                                       $getdataall+=$course_results;
                                       $countr+=100;
                                       }
                                       if($row['Indicator_name']=="รายวิชาที่มีผลการเรียนที่ไม่ปกติ"){
                                           $getdataall+=$academic;
                                           $countr+=100;
                                           }
                                           if($row['Indicator_name']=="รายวิชาที่ไม่ได้เปิดสอน"){
                                               $getdataall+=$not_offered;
                                               $countr+=100;
                                               }
                                               if($row['Indicator_name']=="รายวิชาที่สอนเนื้อหาไม่ครบ"){
                                                   $getdataall+=$incomplete_content;
                                                    $countr+=100;
                                                   }
                                                   if($row['Indicator_name']=="ประสิทธิผลของกลยุทธ์การสอน"){
                                                       $getdataall+=$effectiveness;
                                                        $countr+=100;
                                                       }
                                                       if($row['Indicator_name']=="การปฐมนิเทศอาจารย์ใหม่"){
                                                           $getdataall+=$newteacher;
                                                             $countr+=100;
                                                           }
                                                           if($row['Indicator_name']=="กิจกรรมการพัฒนาวิชาชีพ"){
                                                               $getdataall+=$activity;
                                                               $countr+=100;
                                                               }
                                                               if($row['Indicator_name']=="การบริหารหลักสูตร"){
                                                                   $getdataall+=$getcourse_manage;
                                                                    $countr+=100;
                                                                   }
                                                                   if($row['Indicator_name']=="ข้อคิดเห็น และข้อเสนอแนะ"){
                                                                       $getdataall+=$resultscorecomment_course;
                                                                       $countr+=100;
                                                                       }
                                                                       if($row['Indicator_name']=="ความก้าวหน้าของการดำเนินงาน"){
                                                                           $getdataall+=$getresultscorestrength;
                                                                       $countr+=100;
                                                                           }
                                                                           if($row['Indicator_name']=="ข้อเสนอในการพัฒนาหลักสูตร"){
                                                                               $getdataall+=$getscoredevelopment_proposal;
                                                                               $countr+=100;
                                                                               }
                                                                               if($row['Indicator_name']=="แผนปฏิบัติการใหม่"){
                                                                                   $getdataall+=$getresultscorenewstrength;
                                                                                     $countr+=100;
                                                                                   }
                                                                                   if($row['Indicator_name']=="ข้อมูลนักศึกษา"){
                                                                                       $getdataall+=$infostd;
                                                                                        $countr+=100;
                                                                                       }
                                                                                       if($row['Indicator_name']=="จุดแข็ง จุดที่ควรพัฒนา"){
                                                                                
                                                                                           $getdataall+=$getresultscorestrengths_summary;
                                                                                             $countr+=100;
                                                                                           }
                                                                                           if($row['Indicator_name']=="จำนวนผู้สำเร็จการศึกษา"){
                                                                                            
                                                                                               $getdataall+=$graduate;
                                                                                             $countr+=100;
                                                                                               }
                                                                               if($row['Indicator_name']=="จำนวนการลาออกและคัดชื่อออก"){
                                                                             
                                                                              $getdataall+=$resignation;
                                                                              $countr+=100;
                                                                                }
                                                                            }
                                                                            $avgresult=0;
                                                                            if($countr!=0){
                                                                                $avgresult=($getdataall*100)/$countr;
                                                                                $avgresult2 = sprintf('%.0f',$avgresult);
                                                                                $queryworkandindicator[$i]['score']=$avgresult2;
                                                                            }
                                                                            else{
                                                                                $queryworkandindicator[$i]['score']=0;
                                                                            }
                                                                            if($avgresult<=25){
                                                                                $queryworkandindicator[$i]['color']='danger';
                                                                                $queryworkandindicator[$i]['color2']='red';
                                                                            }
                                                                            else if($avgresult<=50){
                                                                                $queryworkandindicator[$i]['color']='yellow';
                                                                                $queryworkandindicator[$i]['color2']='yellow';
                                                                            }
                                                                            else if($avgresult<=75){
                                                                                $queryworkandindicator[$i]['color']='striped';
                                                                                $queryworkandindicator[$i]['color2']='blue';
                                                                            }
                                                                            else if($avgresult<=100){
                                                                                $queryworkandindicator[$i]['color']='success';
                                                                                $queryworkandindicator[$i]['color2']='green';
                                                                            }
                                                                            $queryworkandindicator[$i]['getid']=$m;
                                                                            $m++;
                                                                            $i++;
                                                                        }
                                                                            
                                                                           
         ////สรุปคะแนน
       return $queryworkandindicator;
       
    }
    public function getclidincategory3($id)
    {
        $clind=user_permission::leftjoin('indicator','user_permission.Indicator_id','=','indicator.id')
        ->where('user_permission.user_id',$id)
        ->where('user_permission.year_id',session()->get('year_id'))
        ->get();

         ////ตัวบ่งชี้ 1.1
         $getscore1_1=0;
         $getscore1_1result=0;
         $score1_1=0;
         $queryindicator1_1=indicator1_1::where('year_id',session()->get('year_id'))
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->get();
         
         $queryindicator1_1result= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
         ->where('pdca.branch_id',session()->get('branch_id'))
         ->where('pdca.year_id',session()->get('year_id'))
         ->where('pdca.Indicator_id',1.1)
         ->where('pdca.target','!=',null)
         ->get();
 
         //ดึงค่าตารางอาจารย์ผู้รับผิดชอบหลักสูตร
         $trc = course_responsible_teacher::join('year','course_responsible_teacher.year_id','=','year.year_id')
         ->where('course_responsible_teacher.course_id',session()->get('usercourse'))
         ->where('course_responsible_teacher.branch_id',session()->get('branch_id'))
         ->where('year.year_id',session()->get('year_id'))
         ->get();
          ////ดึงสาขาวิชาที่จบของอาจารย์ประจำหลักสูตร
          $tc_course= User::leftjoin('course_teacher','users.id','=','course_teacher.user_id')
          ->where('users.user_course',session()->get('usercourse'))
          ->where('users.user_branch',session()->get('branch_id'))
          ->where('course_teacher.year_id',session()->get('year_id'))
          ->get();
 
          ////ดึงสาขาวิชาที่จบของอาจารย์ผู้สอน
          $instructor= User::leftjoin('instructor','users.id','=','instructor.user_id')
          ->where('users.user_course',session()->get('usercourse'))
          ->where('users.user_branch',session()->get('branch_id'))
          ->where('instructor.year_id',session()->get('year_id'))
          ->get();
          if(count($trc)!=0){
             $getscore1_1++;
         }
 
         if(count($tc_course)!=0){
             $getscore1_1++;
         }
         if(count($instructor)!=0){
             $getscore1_1++;
         }
         if(count($queryindicator1_1)!=0){
             if($queryindicator1_1[0]['result1']!=""){
                 $getscore1_1++;
             }
             if($queryindicator1_1[0]['result2']!=""){
                 $getscore1_1++;
             }
             if($queryindicator1_1[0]['result3']!=""){
                 $getscore1_1++;
             }
             if($queryindicator1_1[0]['result4']!=""){
                 $getscore1_1++;
             }
             if($queryindicator1_1[0]['result5']!=""){
                 $getscore1_1++;
             }
         }
         if(count($queryindicator1_1result)!=0){
             $getscore1_1result++;
         }
         
         ////ตัวบ่งชี้ 1.1
 
 
         ////ตัวบ่งชี้ 2.1
         $getscore2_1=0;
         $getscore2_1result=0;
         $score2_1=0;
         $queryindicator2_1=indicator2_1::where('year_id',session()->get('year_id'))
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->get();
         $queryindicator2_1result= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
         ->where('pdca.branch_id',session()->get('branch_id'))
         ->where('pdca.year_id',session()->get('year_id'))
         ->where('pdca.Indicator_id',2.1)
         ->where('pdca.target','!=',null)
         ->get();
         if(count($queryindicator2_1)!=0){
             $getscore2_1++;
         }
         if(count($queryindicator2_1result)!=0){
             $getscore2_1++;
         }
         
         ////ตัวบ่งชี้ 2.1
 
         ////ตัวบ่งชี้ 2.2
         $getscore2_2=0;
         $getscore2_2result=0;
         $queryindicator2_2=indicator2_2::where('year_id',session()->get('year_id'))
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->get();
         $queryindicator2_2result= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
         ->where('pdca.branch_id',session()->get('branch_id'))
         ->where('pdca.year_id',session()->get('year_id'))
         ->where('pdca.Indicator_id',2.2)
         ->where('pdca.target','!=',null)
         ->get();
         if(count($queryindicator2_2)!=0){
             $getscore2_2++;
         }
         if(count($queryindicator2_2result)!=0){
             $getscore2_2++;
         }
         
         ////ตัวบ่งชี้ 2.2
 
         //// ตัวบ่งชี้ 3.1
         $score3_1resultdoc1=0;
         $score3_1resultdoc2=0;
         $score3_1result1=0;
         $score3_1result2=0;
         $score3_1resultpdca=0;
         $queryindicator3_1result1= PDCA::where('category_pdca',4)
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->where('Indicator_id',3.1)
         ->get();
         if($queryindicator3_1result1!="[]"){
             $queryindicator3_1resultdoc1p= docpdca::where('pdca_id',$queryindicator3_1result1[0]['pdca_id'])
             ->where('categorypdca','p')
             ->get();
             if(count($queryindicator3_1resultdoc1p)!=0){
                 $score3_1resultdoc1++;
             }
             $queryindicator3_1resultdoc1d= docpdca::where('pdca_id',$queryindicator3_1result1[0]['pdca_id'])
             ->where('categorypdca','d')
             ->get();
             if(count($queryindicator3_1resultdoc1d)!=0){
                 $score3_1resultdoc1++;
             }
             $queryindicator3_1resultdoc1c= docpdca::where('pdca_id',$queryindicator3_1result1[0]['pdca_id'])
             ->where('categorypdca','c')
             ->get();
             if(count($queryindicator3_1resultdoc1c)!=0){
                 $score3_1resultdoc1++;
             }
             $queryindicator3_1resultdoc1a= docpdca::where('pdca_id',$queryindicator3_1result1[0]['pdca_id'])
             ->where('categorypdca','a')
             ->get();
             if(count($queryindicator3_1resultdoc1a)!=0){
                 $score3_1resultdoc1++;
             }
         }
         
         $queryindicator3_1result2= PDCA::where('category_pdca',5)
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->where('Indicator_id',3.1)
         ->get();
         if($queryindicator3_1result2!="[]"){
             $queryindicator3_1resultdoc2p= docpdca::where('pdca_id',$queryindicator3_1result2[0]['pdca_id'])
             ->where('categorypdca','p')
             ->get();
             if(count($queryindicator3_1resultdoc2p)!=0){
                 $score3_1resultdoc2++;
             }
             $queryindicator3_1resultdoc2d= docpdca::where('pdca_id',$queryindicator3_1result2[0]['pdca_id'])
             ->where('categorypdca','d')
             ->get();
             if(count($queryindicator3_1resultdoc2d)!=0){
                 $score3_1resultdoc2++;
             }
             $queryindicator3_1resultdoc2c= docpdca::where('pdca_id',$queryindicator3_1result2[0]['pdca_id'])
             ->where('categorypdca','c')
             ->get();
             if(count($queryindicator3_1resultdoc2c)!=0){
                 $score3_1resultdoc2++;
             }
             $queryindicator3_1resultdoc2a= docpdca::where('pdca_id',$queryindicator3_1result2[0]['pdca_id'])
             ->where('categorypdca','a')
             ->get();
             if(count($queryindicator3_1resultdoc2a)!=0){
                 $score3_1resultdoc2++;
             }
         }
  
 
         if($queryindicator3_1result1!="[]"){
             if($queryindicator3_1result1[0]['p']!=""){
                 $score3_1result1++;
             }
             if($queryindicator3_1result1[0]['d']!=""){
                 $score3_1result1++;
             }
             if($queryindicator3_1result1[0]['c']!=""){
                 $score3_1result1++;
             }
             if($queryindicator3_1result1[0]['a']!=""){
                 $score3_1result1++;
             }
         }
         
         if($queryindicator3_1result2!="[]"){
         if($queryindicator3_1result2[0]['p']!=""){
             $score3_1result2++;
         }
         if($queryindicator3_1result2[0]['d']!=""){
             $score3_1result2++;
         }
         if($queryindicator3_1result2[0]['c']!=""){
             $score3_1result2++;
         }
         if($queryindicator3_1result2[0]['a']!=""){
             $score3_1result2++;
         }
         }
 
        $queryindicator3_1resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
         ->where('pdca.branch_id',session()->get('branch_id'))
         ->where('pdca.year_id',session()->get('year_id'))
         ->where('pdca.Indicator_id',3.1)
         ->where('pdca.target','!=',null)
         ->get();
         if($queryindicator3_1resultpdca!="[]"){
             $score3_1resultpdca++;
         }
         //// ปิดตัวบ่งชี้ 3.1
 
 
         //// ตัวบ่งชี้ 3.2
         $score3_2resultdoc1=0;
         $score3_2resultdoc2=0;
         $score3_2result1=0;
         $score3_2result2=0;
         $score3_2resultpdca=0;
         $queryindicator3_2result1= PDCA::where('category_pdca',6)
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->where('Indicator_id',3.2)
         ->get();
         if($queryindicator3_2result1!="[]"){
             $queryindicator3_2resultdoc1p= docpdca::where('pdca_id',$queryindicator3_2result1[0]['pdca_id'])
             ->where('categorypdca','p')
             ->get();
             if(count($queryindicator3_2resultdoc1p)!=0){
                 $score3_2resultdoc1++;
             }
             $queryindicator3_2resultdoc1d= docpdca::where('pdca_id',$queryindicator3_2result1[0]['pdca_id'])
             ->where('categorypdca','d')
             ->get();
             if(count($queryindicator3_2resultdoc1d)!=0){
                 $score3_2resultdoc1++;
             }
             $queryindicator3_2resultdoc1c= docpdca::where('pdca_id',$queryindicator3_2result1[0]['pdca_id'])
             ->where('categorypdca','c')
             ->get();
             if(count($queryindicator3_2resultdoc1c)!=0){
                 $score3_2resultdoc1++;
             }
             $queryindicator3_2resultdoc1a= docpdca::where('pdca_id',$queryindicator3_2result1[0]['pdca_id'])
             ->where('categorypdca','a')
             ->get();
             if(count($queryindicator3_2resultdoc1a)!=0){
                 $score3_2resultdoc1++;
             }
         }
         
         $queryindicator3_2result2= PDCA::where('category_pdca',7)
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->where('Indicator_id',3.2)
         ->get();
         if($queryindicator3_2result2!="[]"){
             $queryindicator3_2resultdoc2p= docpdca::where('pdca_id',$queryindicator3_2result2[0]['pdca_id'])
             ->where('categorypdca','p')
             ->get();
             if(count($queryindicator3_2resultdoc2p)!=0){
                 $score3_2resultdoc2++;
             }
             $queryindicator3_2resultdoc2d= docpdca::where('pdca_id',$queryindicator3_2result2[0]['pdca_id'])
             ->where('categorypdca','d')
             ->get();
             if(count($queryindicator3_2resultdoc2d)!=0){
                 $score3_2resultdoc2++;
             }
             $queryindicator3_2resultdoc2c= docpdca::where('pdca_id',$queryindicator3_2result2[0]['pdca_id'])
             ->where('categorypdca','c')
             ->get();
             if(count($queryindicator3_2resultdoc2c)!=0){
                 $score3_2resultdoc2++;
             }
             $queryindicator3_2resultdoc2a= docpdca::where('pdca_id',$queryindicator3_2result2[0]['pdca_id'])
             ->where('categorypdca','a')
             ->get();
             if(count($queryindicator3_2resultdoc2a)!=0){
                 $score3_2resultdoc2++;
             }
         }
  
 
         if($queryindicator3_2result1!="[]"){
             if($queryindicator3_2result1[0]['p']!=""){
                 $score3_2result1++;
             }
             if($queryindicator3_2result1[0]['d']!=""){
                 $score3_2result1++;
             }
             if($queryindicator3_2result1[0]['c']!=""){
                 $score3_2result1++;
             }
             if($queryindicator3_2result1[0]['a']!=""){
                 $score3_2result1++;
             }
         }
         
         if($queryindicator3_2result2!="[]"){
         if($queryindicator3_2result2[0]['p']!=""){
             $score3_2result2++;
         }
         if($queryindicator3_2result2[0]['d']!=""){
             $score3_2result2++;
         }
         if($queryindicator3_2result2[0]['c']!=""){
             $score3_2result2++;
         }
         if($queryindicator3_2result2[0]['a']!=""){
             $score3_2result2++;
         }
         }
 
        $queryindicator3_2resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
         ->where('pdca.branch_id',session()->get('branch_id'))
         ->where('pdca.year_id',session()->get('year_id'))
         ->where('pdca.Indicator_id',3.2)
         ->where('pdca.target','!=',null)
         ->get();
         if($queryindicator3_2resultpdca!="[]"){
             $score3_2resultpdca++;
         }
         //// ปิดตัวบ่งชี้ 3.2
 
          ////ตัวบ่งชี้ 3.3
          $score3_3resultdoc1=0;
          $score3_3resultdoc2=0;
          $score3_3result1=0;
          $score3_3result2=0;
          $score3_3result3=0;
          $score3_3resultpdca=0;
          $queryindicator3_3result=performance3_3::where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
          ->where('year_id',session()->get('year_id'))
          ->get();
          if($queryindicator3_3result!="[]"){
              // $queryindicator3_3resultdoc= docpdca::where('doc_id',$queryindicator3_3result[0]['id'])
              // ->get();
              // if(count($queryindicator3_3resultdoc)!=0){
              //     $score3_3resultdoc1++;
              // }
              if(count($queryindicator3_3result)==3){
                  $score3_3result1++;
                  $score3_3result2++;
                  $score3_3result3++;
              }
          }
          $queryindicator3_3resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
          ->where('pdca.course_id',session()->get('usercourse'))
          ->where('pdca.branch_id',session()->get('branch_id'))
          ->where('pdca.year_id',session()->get('year_id'))
          ->where('pdca.Indicator_id',3.3)
          ->where('pdca.target','!=',null)
          ->get();
          if($queryindicator3_3resultpdca!="[]"){
              $score3_3resultpdca++;
          }
          ////ปิดตัวบ่งชี้ 3.3
 
          ////ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา
          $scorfactor=0;
          $factor=category3_GD::where('category_factor','ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา')
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
          ->where('year_id',session()->get('year_id'))
         ->get();
         if($factor!="[]"){
             $scorfactor++;
         }
          ////ปิด ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา
 
           ////ปัยจัยที่มีผลกระทบต่อการสำเร็จการศึกษา
           $scorfactor2=0;
           $factor2=category3_GD::where('category_factor','ปัยจัยที่มีผลกระทบต่อการสำเร็จการศึกษา')
          ->where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
           ->where('year_id',session()->get('year_id'))
          ->get();
          if($factor2!="[]"){
              $scorfactor2++;
          }
           ////ปิด ปัยจัยที่มีผลกระทบต่อการสำเร็จการศึกษา
 
          ////ข้อมูลนักศึกษา
          $scoreinfo=0;
          $scoreinfoqty=0;
          $getyear=category3_infostudent::where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
             ->where('year_add',session()->get('year'))
             ->get();
         $getqty=category3_infostudent_qty::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
             ->where('year_id',session()->get('year_id'))
             ->get();
         if($getyear!="[]"){
             $scoreinfo++;
         }
         if($getqty!="[]"){
             $scoreinfoqty++;
         }
          ////ปิด ข้อมูลนักศึกษา
 
         ////จำนวนผู้สำเร็จการศึกษา
         $get=year_acceptance_graduate::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->get();
         $scoregraduate=0;
         if($get!="[]"){
             $getinfo=category3_graduate::where('course_id',session()->get('usercourse'))
             ->where('branch_id',session()->get('branch_id'))
             ->where('year_add', '>=',$get[0]['year_add'])
             ->where('year_add', '<=',session()->get('year'))
             ->where('reported_year', '>=',$get[0]['year_add'])
             ->where('reported_year', '<=',session()->get('year'))
             ->get();
             if($getinfo!="[]"){
                 $scoregraduate++;
             }
         }
        
        
         ////ปิด จำนวนผู้สำเร็จการศึกษา
 
        ////จำนวนที่ลาออกและคัดชื่อออกสะสมจนถึงสิ้นปีการศึกษา
        $scorere=0;
         $re=category3_resignation::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_present',session()->get('year'))
         ->get();
       if($re!="[]"){
           $scorere++;
       }
        ////ปิด จำนวนที่ลาออกและคัดชื่อออกสะสมจนถึงสิ้นปีการศึกษา
 
           //// ตัวบ่งชี้ 4.1
           $score4_1resultdoc1=0;
           $score4_1resultdoc2=0;
           $score4_1resultdoc3=0;
           $score4_1result1=0;
           $score4_1result2=0;
           $score4_1result3=0;
           $score4_1resultpdca=0;
           $queryindicator4_1result1= PDCA::where('category_pdca',1)
           ->where('course_id',session()->get('usercourse'))
           ->where('branch_id',session()->get('branch_id'))
           ->where('year_id',session()->get('year_id'))
           ->where('Indicator_id',4.1)
           ->get();
           if($queryindicator4_1result1!="[]"){
               $queryindicator4_1resultdoc1p= docpdca::where('pdca_id',$queryindicator4_1result1[0]['pdca_id'])
               ->where('categorypdca','p')
               ->get();
               if(count($queryindicator4_1resultdoc1p)!=0){
                   $score4_1resultdoc1++;
               }
               $queryindicator4_1resultdoc1d= docpdca::where('pdca_id',$queryindicator4_1result1[0]['pdca_id'])
               ->where('categorypdca','d')
               ->get();
               if(count($queryindicator4_1resultdoc1d)!=0){
                   $score4_1resultdoc1++;
               }
               $queryindicator4_1resultdoc1c= docpdca::where('pdca_id',$queryindicator4_1result1[0]['pdca_id'])
               ->where('categorypdca','c')
               ->get();
               if(count($queryindicator4_1resultdoc1c)!=0){
                   $score4_1resultdoc1++;
               }
               $queryindicator4_1resultdoc1a= docpdca::where('pdca_id',$queryindicator4_1result1[0]['pdca_id'])
               ->where('categorypdca','a')
               ->get();
               if(count($queryindicator4_1resultdoc1a)!=0){
                   $score4_1resultdoc1++;
               }
           }
           
           $queryindicator4_1result2= PDCA::where('category_pdca',2)
           ->where('course_id',session()->get('usercourse'))
           ->where('branch_id',session()->get('branch_id'))
           ->where('year_id',session()->get('year_id'))
           ->where('Indicator_id',4.1)
           ->get();
           if($queryindicator4_1result2!="[]"){
               $queryindicator4_1resultdoc2p= docpdca::where('pdca_id',$queryindicator4_1result2[0]['pdca_id'])
               ->where('categorypdca','p')
               ->get();
               if(count($queryindicator4_1resultdoc2p)!=0){
                   $score4_1resultdoc2++;
               }
               $queryindicator4_1resultdoc2d= docpdca::where('pdca_id',$queryindicator4_1result2[0]['pdca_id'])
               ->where('categorypdca','d')
               ->get();
               if(count($queryindicator4_1resultdoc2d)!=0){
                   $score4_1resultdoc2++;
               }
               $queryindicator4_1resultdoc2c= docpdca::where('pdca_id',$queryindicator4_1result2[0]['pdca_id'])
               ->where('categorypdca','c')
               ->get();
               if(count($queryindicator4_1resultdoc2c)!=0){
                   $score4_1resultdoc2++;
               }
               $queryindicator4_1resultdoc2a= docpdca::where('pdca_id',$queryindicator4_1result2[0]['pdca_id'])
               ->where('categorypdca','a')
               ->get();
               if(count($queryindicator4_1resultdoc2a)!=0){
                   $score4_1resultdoc2++;
               }
           }
           $queryindicator4_1result3= PDCA::where('category_pdca',3)
           ->where('course_id',session()->get('usercourse'))
           ->where('branch_id',session()->get('branch_id'))
           ->where('year_id',session()->get('year_id'))
           ->where('Indicator_id',4.1)
           ->get();
           if($queryindicator4_1result3!="[]"){
               $queryindicator4_1resultdoc3p= docpdca::where('pdca_id',$queryindicator4_1result3[0]['pdca_id'])
               ->where('categorypdca','p')
               ->get();
               if(count($queryindicator4_1resultdoc3p)!=0){
                   $score4_1resultdoc3++;
               }
               $queryindicator4_1resultdoc3d= docpdca::where('pdca_id',$queryindicator4_1result3[0]['pdca_id'])
               ->where('categorypdca','d')
               ->get();
               if(count($queryindicator4_1resultdoc3d)!=0){
                   $score4_1resultdoc3++;
               }
               $queryindicator4_1resultdoc3c= docpdca::where('pdca_id',$queryindicator4_1result3[0]['pdca_id'])
               ->where('categorypdca','c')
               ->get();
               if(count($queryindicator4_1resultdoc3c)!=0){
                   $score4_1resultdoc3++;
               }
               $queryindicator4_1resultdoc3a= docpdca::where('pdca_id',$queryindicator4_1result3[0]['pdca_id'])
               ->where('categorypdca','a')
               ->get();
               if(count($queryindicator4_1resultdoc3a)!=0){
                   $score4_1resultdoc3++;
               }
           }
           $queryindicator2_1result= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
           ->where('pdca.course_id',session()->get('usercourse'))
           ->where('pdca.branch_id',session()->get('branch_id'))
           ->where('pdca.year_id',session()->get('year_id'))
           ->where('pdca.Indicator_id',2.1)
           ->where('pdca.target','!=',null)
           ->get();
           if($queryindicator4_1result1!="[]"){
               if($queryindicator4_1result1[0]['p']!=""){
                   $score4_1result1++;
               }
               if($queryindicator4_1result1[0]['d']!=""){
                   $score4_1result1++;
               }
               if($queryindicator4_1result1[0]['c']!=""){
                   $score4_1result1++;
               }
               if($queryindicator4_1result1[0]['a']!=""){
                   $score4_1result1++;
               }
           }
           
           if($queryindicator4_1result2!="[]"){
           if($queryindicator4_1result2[0]['p']!=""){
               $score4_1result2++;
           }
           if($queryindicator4_1result2[0]['d']!=""){
               $score4_1result2++;
           }
           if($queryindicator4_1result2[0]['c']!=""){
               $score4_1result2++;
           }
           if($queryindicator4_1result2[0]['a']!=""){
               $score4_1result2++;
           }
           }
   
           if($queryindicator4_1result3!="[]"){
           if($queryindicator4_1result3[0]['p']!=""){
               $score4_1result3++;
           }
           if($queryindicator4_1result3[0]['d']!=""){
               $score4_1result3++;
           }
           if($queryindicator4_1result3[0]['c']!=""){
               $score4_1result3++;
           }
           if($queryindicator4_1result3[0]['a']!=""){
               $score4_1result3++;
           }
          }
          $queryindicator4_1resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
           ->where('pdca.course_id',session()->get('usercourse'))
           ->where('pdca.branch_id',session()->get('branch_id'))
           ->where('pdca.year_id',session()->get('year_id'))
           ->where('pdca.Indicator_id',4.1)
           ->where('pdca.target','!=',null)
           ->get();
           if($queryindicator4_1resultpdca!="[]"){
               $score4_1resultpdca++;
           }
           //// ตัวบ่งชี้ 4.1
 
 
           //// ตัวบ่งชี้ 4.2
           $score4_2result1=0;
           $score4_2result2=0;
           $score4_2resultpdca=0;
           //ดึงค่าตารางอาจารย์ผู้รับผิดชอบหลักสูตร
             $trc = course_responsible_teacher::join('year','course_responsible_teacher.year_id','=','year.year_id')
             ->where('course_responsible_teacher.course_id',session()->get('usercourse'))
             ->where('course_responsible_teacher.branch_id',session()->get('branch_id'))
             ->where('year.year_id',session()->get('year_id'))
             ->get();
             $educ_bg= User::leftjoin('course_responsible_teacher','users.id','=','course_responsible_teacher.user_id')
             ->where('users.user_course',session()->get('usercourse'))
             ->where('users.user_branch',session()->get('branch_id'))
             ->where('course_responsible_teacher.year_id',session()->get('year_id'))
             ->get();
             foreach($educ_bg as $key=>$t){
                 if(count($educ_bg[$key]->research_results)!=0){
                         $score4_2result2=1;
                 }
             }
            
             $queryindicator4_2resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
             ->where('pdca.course_id',session()->get('usercourse'))
             ->where('pdca.branch_id',session()->get('branch_id'))
             ->where('pdca.year_id',session()->get('year_id'))
             ->where('pdca.Indicator_id',4.2)
             ->where('pdca.target','!=',null)
             ->get();
             if($trc!="[]"){
                 if(count($trc)!=0){
                     $score4_2result1++;
                 }
             }
             if($queryindicator4_2resultpdca!="[]"){
                 $score4_2resultpdca++;
             }
           ////ปิด ตัวบ่งชี้ 4.2
 
           ////ตัวบ่งชี้ 4.3
         $score4_3resultdoc1=0;
         $score4_3resultdoc2=0;
         $score4_3result1=0;
         $score4_3result2=0;
 
         $score4_3resultpdca=0;
         $queryindicator4_3result=indicator4_3::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
         if($queryindicator4_3result!="[]"){
             // $queryindicator4_3resultdoc= docpdca::where('doc_id',$queryindicator4_3result[0]['id'])
             // ->get();
             // if(count($queryindicator4_3resultdoc)!=0){
             //     $score4_3resultdoc1++;
             // }
             if(count($queryindicator4_3result)==2){
                 $score4_3result1++;
                 $score4_3result2++;
             }
         }
         $queryindicator4_3resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
         ->where('pdca.branch_id',session()->get('branch_id'))
         ->where('pdca.year_id',session()->get('year_id'))
         ->where('pdca.Indicator_id',4.3)
         ->where('pdca.target','!=',null)
         ->get();
         if($queryindicator4_3resultpdca!="[]"){
             $score4_3resultpdca++;
         }
         ////ตัวบ่งชี้ 4.3
 
          //// ตัวบ่งชี้ 5.1
          $score5_1resultdoc1=0;
          $score5_1resultdoc2=0;
          $score5_1resultdoc3=0;
          $score5_1result1=0;
          $score5_1result2=0;
          $score5_1result3=0;
          $score5_1resultpdca=0;
          $queryindicator5_1result1= PDCA::where('category_pdca',12)
          ->where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
          ->where('year_id',session()->get('year_id'))
          ->where('Indicator_id',5.1)
          ->get();
          if($queryindicator5_1result1!="[]"){
              $queryindicator5_1resultdoc1p= docpdca::where('pdca_id',$queryindicator5_1result1[0]['pdca_id'])
              ->where('categorypdca','p')
              ->get();
              if(count($queryindicator5_1resultdoc1p)!=0){
                  $score5_1resultdoc1++;
              }
              $queryindicator5_1resultdoc1d= docpdca::where('pdca_id',$queryindicator5_1result1[0]['pdca_id'])
              ->where('categorypdca','d')
              ->get();
              if(count($queryindicator5_1resultdoc1d)!=0){
                  $score5_1resultdoc1++;
              }
              $queryindicator5_1resultdoc1c= docpdca::where('pdca_id',$queryindicator5_1result1[0]['pdca_id'])
              ->where('categorypdca','c')
              ->get();
              if(count($queryindicator5_1resultdoc1c)!=0){
                  $score5_1resultdoc1++;
              }
              $queryindicator5_1resultdoc1a= docpdca::where('pdca_id',$queryindicator5_1result1[0]['pdca_id'])
              ->where('categorypdca','a')
              ->get();
              if(count($queryindicator5_1resultdoc1a)!=0){
                  $score5_1resultdoc1++;
              }
          }
          
          $queryindicator5_1result2= PDCA::where('category_pdca',13)
          ->where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
          ->where('year_id',session()->get('year_id'))
          ->where('Indicator_id',5.1)
          ->get();
          if($queryindicator5_1result2!="[]"){
              $queryindicator5_1resultdoc2p= docpdca::where('pdca_id',$queryindicator5_1result2[0]['pdca_id'])
              ->where('categorypdca','p')
              ->get();
              if(count($queryindicator5_1resultdoc2p)!=0){
                  $score5_1resultdoc2++;
              }
              $queryindicator5_1resultdoc2d= docpdca::where('pdca_id',$queryindicator5_1result2[0]['pdca_id'])
              ->where('categorypdca','d')
              ->get();
              if(count($queryindicator5_1resultdoc2d)!=0){
                  $score5_1resultdoc2++;
              }
              $queryindicator5_1resultdoc2c= docpdca::where('pdca_id',$queryindicator5_1result2[0]['pdca_id'])
              ->where('categorypdca','c')
              ->get();
              if(count($queryindicator5_1resultdoc2c)!=0){
                  $score5_1resultdoc2++;
              }
              $queryindicator5_1resultdoc2a= docpdca::where('pdca_id',$queryindicator5_1result2[0]['pdca_id'])
              ->where('categorypdca','a')
              ->get();
              if(count($queryindicator5_1resultdoc2a)!=0){
                  $score5_1resultdoc2++;
              }
          }
          $queryindicator5_1result3= PDCA::where('category_pdca',14)
          ->where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
          ->where('year_id',session()->get('year_id'))
          ->where('Indicator_id',5.1)
          ->get();
          if($queryindicator5_1result3!="[]"){
              $queryindicator5_1resultdoc3p= docpdca::where('pdca_id',$queryindicator5_1result3[0]['pdca_id'])
              ->where('categorypdca','p')
              ->get();
              if(count($queryindicator5_1resultdoc3p)!=0){
                  $score5_1resultdoc3++;
              }
              $queryindicator5_1resultdoc3d= docpdca::where('pdca_id',$queryindicator5_1result3[0]['pdca_id'])
              ->where('categorypdca','d')
              ->get();
              if(count($queryindicator5_1resultdoc3d)!=0){
                  $score5_1resultdoc3++;
              }
              $queryindicator5_1resultdoc3c= docpdca::where('pdca_id',$queryindicator5_1result3[0]['pdca_id'])
              ->where('categorypdca','c')
              ->get();
              if(count($queryindicator5_1resultdoc3c)!=0){
                  $score5_1resultdoc3++;
              }
              $queryindicator5_1resultdoc3a= docpdca::where('pdca_id',$queryindicator5_1result3[0]['pdca_id'])
              ->where('categorypdca','a')
              ->get();
              if(count($queryindicator5_1resultdoc3a)!=0){
                  $score5_1resultdoc3++;
              }
          }
 
          if($queryindicator5_1result1!="[]"){
              if($queryindicator5_1result1[0]['p']!=""){
                  $score5_1result1++;
              }
              if($queryindicator5_1result1[0]['d']!=""){
                  $score5_1result1++;
              }
              if($queryindicator5_1result1[0]['c']!=""){
                  $score5_1result1++;
              }
              if($queryindicator5_1result1[0]['a']!=""){
                  $score5_1result1++;
              }
          }
          
          if($queryindicator5_1result2!="[]"){
          if($queryindicator5_1result2[0]['p']!=""){
              $score5_1result2++;
          }
          if($queryindicator5_1result2[0]['d']!=""){
              $score5_1result2++;
          }
          if($queryindicator5_1result2[0]['c']!=""){
              $score5_1result2++;
          }
          if($queryindicator5_1result2[0]['a']!=""){
              $score5_1result2++;
          }
          }
  
          if($queryindicator5_1result3!="[]"){
          if($queryindicator5_1result3[0]['p']!=""){
              $score5_1result3++;
          }
          if($queryindicator5_1result3[0]['d']!=""){
              $score5_1result3++;
          }
          if($queryindicator5_1result3[0]['c']!=""){
              $score5_1result3++;
          }
          if($queryindicator5_1result3[0]['a']!=""){
              $score5_1result3++;
          }
         }
         $queryindicator5_1resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
          ->where('pdca.course_id',session()->get('usercourse'))
          ->where('pdca.branch_id',session()->get('branch_id'))
          ->where('pdca.year_id',session()->get('year_id'))
          ->where('pdca.Indicator_id',5.1)
          ->where('pdca.target','!=',null)
          ->get();
          if($queryindicator5_1resultpdca!="[]"){
              $score5_1resultpdca++;
          }
          //// ปิด ตัวบ่งชี้ 5.1
 
          //// ตัวบ่งชี้ 5.2
          $score5_2resultdoc1=0;
          $score5_2resultdoc2=0;
          $score5_2resultdoc3=0;
          $score5_2result1=0;
          $score5_2result2=0;
          $score5_2result3=0;
          $score5_2resultpdca=0;
          $queryindicator5_2result1= PDCA::where('category_pdca',8)
          ->where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
          ->where('year_id',session()->get('year_id'))
          ->where('Indicator_id',5.2)
          ->get();
          if($queryindicator5_2result1!="[]"){
              $queryindicator5_2resultdoc1p= docpdca::where('pdca_id',$queryindicator5_2result1[0]['pdca_id'])
              ->where('categorypdca','p')
              ->get();
              if(count($queryindicator5_2resultdoc1p)!=0){
                  $score5_2resultdoc1++;
              }
              $queryindicator5_2resultdoc1d= docpdca::where('pdca_id',$queryindicator5_2result1[0]['pdca_id'])
              ->where('categorypdca','d')
              ->get();
              if(count($queryindicator5_2resultdoc1d)!=0){
                  $score5_2resultdoc1++;
              }
              $queryindicator5_2resultdoc1c= docpdca::where('pdca_id',$queryindicator5_2result1[0]['pdca_id'])
              ->where('categorypdca','c')
              ->get();
              if(count($queryindicator5_2resultdoc1c)!=0){
                  $score5_2resultdoc1++;
              }
              $queryindicator5_2resultdoc1a= docpdca::where('pdca_id',$queryindicator5_2result1[0]['pdca_id'])
              ->where('categorypdca','a')
              ->get();
              if(count($queryindicator5_2resultdoc1a)!=0){
                  $score5_2resultdoc1++;
              }
          }
          
          $queryindicator5_2result2= PDCA::where('category_pdca',9)
          ->where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
          ->where('year_id',session()->get('year_id'))
          ->where('Indicator_id',5.2)
          ->get();
          if($queryindicator5_2result2!="[]"){
              $queryindicator5_2resultdoc2p= docpdca::where('pdca_id',$queryindicator5_2result2[0]['pdca_id'])
              ->where('categorypdca','p')
              ->get();
              if(count($queryindicator5_2resultdoc2p)!=0){
                  $score5_2resultdoc2++;
              }
              $queryindicator5_2resultdoc2d= docpdca::where('pdca_id',$queryindicator5_2result2[0]['pdca_id'])
              ->where('categorypdca','d')
              ->get();
              if(count($queryindicator5_2resultdoc2d)!=0){
                  $score5_2resultdoc2++;
              }
              $queryindicator5_2resultdoc2c= docpdca::where('pdca_id',$queryindicator5_2result2[0]['pdca_id'])
              ->where('categorypdca','c')
              ->get();
              if(count($queryindicator5_2resultdoc2c)!=0){
                  $score5_2resultdoc2++;
              }
              $queryindicator5_2resultdoc2a= docpdca::where('pdca_id',$queryindicator5_2result2[0]['pdca_id'])
              ->where('categorypdca','a')
              ->get();
              if(count($queryindicator5_2resultdoc2a)!=0){
                  $score5_2resultdoc2++;
              }
          }
          $queryindicator5_2result3= PDCA::where('category_pdca',10)
          ->where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
          ->where('year_id',session()->get('year_id'))
          ->where('Indicator_id',5.2)
          ->get();
          if($queryindicator5_2result3!="[]"){
              $queryindicator5_2resultdoc3p= docpdca::where('pdca_id',$queryindicator5_2result3[0]['pdca_id'])
              ->where('categorypdca','p')
              ->get();
              if(count($queryindicator5_2resultdoc3p)!=0){
                  $score5_2resultdoc3++;
              }
              $queryindicator5_2resultdoc3d= docpdca::where('pdca_id',$queryindicator5_2result3[0]['pdca_id'])
              ->where('categorypdca','d')
              ->get();
              if(count($queryindicator5_2resultdoc3d)!=0){
                  $score5_2resultdoc3++;
              }
              $queryindicator5_2resultdoc3c= docpdca::where('pdca_id',$queryindicator5_2result3[0]['pdca_id'])
              ->where('categorypdca','c')
              ->get();
              if(count($queryindicator5_2resultdoc3c)!=0){
                  $score5_2resultdoc3++;
              }
              $queryindicator5_2resultdoc3a= docpdca::where('pdca_id',$queryindicator5_2result3[0]['pdca_id'])
              ->where('categorypdca','a')
              ->get();
              if(count($queryindicator5_2resultdoc3a)!=0){
                  $score5_2resultdoc3++;
              }
          }
 
          if($queryindicator5_2result1!="[]"){
              if($queryindicator5_2result1[0]['p']!=""){
                  $score5_2result1++;
              }
              if($queryindicator5_2result1[0]['d']!=""){
                  $score5_2result1++;
              }
              if($queryindicator5_2result1[0]['c']!=""){
                  $score5_2result1++;
              }
              if($queryindicator5_2result1[0]['a']!=""){
                  $score5_2result1++;
              }
          }
          
          if($queryindicator5_2result2!="[]"){
          if($queryindicator5_2result2[0]['p']!=""){
              $score5_2result2++;
          }
          if($queryindicator5_2result2[0]['d']!=""){
              $score5_2result2++;
          }
          if($queryindicator5_2result2[0]['c']!=""){
              $score5_2result2++;
          }
          if($queryindicator5_2result2[0]['a']!=""){
              $score5_2result2++;
          }
          }
  
          if($queryindicator5_2result3!="[]"){
          if($queryindicator5_2result3[0]['p']!=""){
              $score5_2result3++;
          }
          if($queryindicator5_2result3[0]['d']!=""){
              $score5_2result3++;
          }
          if($queryindicator5_2result3[0]['c']!=""){
              $score5_2result3++;
          }
          if($queryindicator5_2result3[0]['a']!=""){
              $score5_2result3++;
          }
         }
         $queryindicator5_2resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
          ->where('pdca.course_id',session()->get('usercourse'))
          ->where('pdca.branch_id',session()->get('branch_id'))
          ->where('pdca.year_id',session()->get('year_id'))
          ->where('pdca.Indicator_id',5.2)
          ->where('pdca.target','!=',null)
          ->get();
          if($queryindicator5_2resultpdca!="[]"){
              $score5_2resultpdca++;
          }
          //// ปิด ตัวบ่งชี้ 5.2
 
          //// ตัวบ่งชี้ 5.3
         $score5_3resultdoc1=0;
         $score5_3resultdoc2=0;
         $score5_3result1=0;
         $score5_3result2=0;
         $score5_3resultpdca=0;
         $queryindicator5_3result1= PDCA::where('category_pdca',15)
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->where('Indicator_id',5.3)
         ->get();
         if($queryindicator5_3result1!="[]"){
             $queryindicator5_3resultdoc1p= docpdca::where('pdca_id',$queryindicator5_3result1[0]['pdca_id'])
             ->where('categorypdca','p')
             ->get();
             if(count($queryindicator5_3resultdoc1p)!=0){
                 $score5_3resultdoc1++;
             }
             $queryindicator5_3resultdoc1d= docpdca::where('pdca_id',$queryindicator5_3result1[0]['pdca_id'])
             ->where('categorypdca','d')
             ->get();
             if(count($queryindicator5_3resultdoc1d)!=0){
                 $score5_3resultdoc1++;
             }
             $queryindicator5_3resultdoc1c= docpdca::where('pdca_id',$queryindicator5_3result1[0]['pdca_id'])
             ->where('categorypdca','c')
             ->get();
             if(count($queryindicator5_3resultdoc1c)!=0){
                 $score5_3resultdoc1++;
             }
             $queryindicator5_3resultdoc1a= docpdca::where('pdca_id',$queryindicator5_3result1[0]['pdca_id'])
             ->where('categorypdca','a')
             ->get();
             if(count($queryindicator5_3resultdoc1a)!=0){
                 $score5_3resultdoc1++;
             }
         }
         
         $queryindicator5_3result2= PDCA::where('category_pdca',16)
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->where('Indicator_id',5.3)
         ->get();
         if($queryindicator5_3result2!="[]"){
             $queryindicator5_3resultdoc2p= docpdca::where('pdca_id',$queryindicator5_3result2[0]['pdca_id'])
             ->where('categorypdca','p')
             ->get();
             if(count($queryindicator5_3resultdoc2p)!=0){
                 $score5_3resultdoc2++;
             }
             $queryindicator5_3resultdoc2d= docpdca::where('pdca_id',$queryindicator5_3result2[0]['pdca_id'])
             ->where('categorypdca','d')
             ->get();
             if(count($queryindicator5_3resultdoc2d)!=0){
                 $score5_3resultdoc2++;
             }
             $queryindicator5_3resultdoc2c= docpdca::where('pdca_id',$queryindicator5_3result2[0]['pdca_id'])
             ->where('categorypdca','c')
             ->get();
             if(count($queryindicator5_3resultdoc2c)!=0){
                 $score5_3resultdoc2++;
             }
             $queryindicator5_3resultdoc2a= docpdca::where('pdca_id',$queryindicator5_3result2[0]['pdca_id'])
             ->where('categorypdca','a')
             ->get();
             if(count($queryindicator5_3resultdoc2a)!=0){
                 $score5_3resultdoc2++;
             }
         }
  
 
         if($queryindicator5_3result1!="[]"){
             if($queryindicator5_3result1[0]['p']!=""){
                 $score5_3result1++;
             }
             if($queryindicator5_3result1[0]['d']!=""){
                 $score5_3result1++;
             }
             if($queryindicator5_3result1[0]['c']!=""){
                 $score5_3result1++;
             }
             if($queryindicator5_3result1[0]['a']!=""){
                 $score5_3result1++;
             }
         }
         
         if($queryindicator5_3result2!="[]"){
         if($queryindicator5_3result2[0]['p']!=""){
             $score5_3result2++;
         }
         if($queryindicator5_3result2[0]['d']!=""){
             $score5_3result2++;
         }
         if($queryindicator5_3result2[0]['c']!=""){
             $score5_3result2++;
         }
         if($queryindicator5_3result2[0]['a']!=""){
             $score5_3result2++;
         }
         }
 
        $queryindicator5_3resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
         ->where('pdca.branch_id',session()->get('branch_id'))
         ->where('pdca.year_id',session()->get('year_id'))
         ->where('pdca.Indicator_id',5.3)
         ->where('pdca.target','!=',null)
         ->get();
         if($queryindicator5_3resultpdca!="[]"){
             $score5_3resultpdca++;
         }
         //// ปิดตัวบ่งชี้ 5.3
 
         //// ตัวบ่งชี้ 5.4
         $score5_4result1=0;
         $score5_4resultpdca=0;
         $perfor=indicator5_4::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
         $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
         ->where('pdca.branch_id',session()->get('branch_id'))
         ->where('pdca.year_id',session()->get('year_id'))
         ->where('pdca.indicator_id',5.4)
         ->where('pdca.target','!=',null)
         ->get();
         if($inc!="[]"){
             $score5_4resultpdca++;
         }
         if($perfor!="[]"){
             $score5_4result1++;
         }
         //// ปิด ตัวบ่งชี้ 5.4
 
          //// คุณภาพการสอน
          $scoreteachqua=0;
          $teachqua=category4_teaching_quality::where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
          if($teachqua!="[]"){
              $scoreteachqua++;
          }
          //// ปิด คุณภาพการสอน
 
          //// สรุปผลรายวิชาที่เปิดสอนในภาค/ปีการศึกษา
          $scoreccr=0;
          $ccr=category4_course_results::where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
          if($ccr!="[]"){
              $scoreccr++;
          }
          //// ปิด สรุปผลรายวิชาที่เปิดสอนในภาค/ปีการศึกษา
 
          //// การวิเคราะห์รายวิชาที่มีผลการเรียนที่ไม่ปกติ
          $scoreacademic=0;
          $academic=category4_academic_performance::where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
          if($academic!="[]"){
              $scoreacademic++;
          }
          //// ปิด การวิเคราะห์รายวิชาที่มีผลการเรียนที่ไม่ปกติ
          
          //// รายวิชาที่ไม่ได้เปิดสอนในปีการศึกษา
          $scorenot_offered=0;
          $not_offered=category4_notcourse_results::where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
          if($not_offered!="[]"){
              $scorenot_offered++;
          }
          //// ปิด รายวิชาที่ไม่ได้เปิดสอนในปีการศึกษา
 
          //// รายวิชาที่สอนเนื้อหาไม่ครบในปีการศึกษา
          $scoreincomplete_content=0;
          $queryincomplete_content=category4_incomplete_content::where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
          if($queryincomplete_content!="[]"){
              $scoreincomplete_content++;
          }
          //// ปิด รายวิชาที่สอนเนื้อหาไม่ครบในปีการศึกษา
 
          //// ประสิทธิผลของกลยุทธ์การสอน
          $scoreeffec=0;
          $effec=category4_effectiveness::where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
          ->where('year_id',session()->get('year_id'))
          ->get();
          if($effec!="[]"){
              $scoreeffec++;
          }
          //// ปิด ประสิทธิผลของกลยุทธ์การสอน
 
          //// การปฐมนิเทศอาจารย์ใหม่
          $scorenewteacher=0;
          $th=category4_newteacher::where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
          if($th!="[]"){
              $scorenewteacher++;
          }
          //// ปิด การปฐมนิเทศอาจารย์ใหม่
          
          //// กิจกรรมการพัฒนาวิชาชีพของอาจารย์
          $scoreactivity=0;
          $activity=category4_activity::where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
          ->where('year_id',session()->get('year_id'))
          ->get();
          if($activity!="[]"){
              $scoreactivity++;
          }
          //// ปิด กิจกรรมการพัฒนาวิชาชีพของอาจารย์
 
          //// ตัวบ่งชี้ 6.1
         $score6_1resultdoc1=0;
         $score6_1result1=0;
         $score6_1resultpdca=0;
         $queryindicator6_1result1= PDCA::where('category_pdca',11)
         ->where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->where('Indicator_id',6.1)
         ->get();
         if($queryindicator6_1result1!="[]"){
             $queryindicator6_1resultdoc1p= docpdca::where('pdca_id',$queryindicator6_1result1[0]['pdca_id'])
             ->where('categorypdca','p')
             ->get();
             if(count($queryindicator6_1resultdoc1p)!=0){
                 $score6_1resultdoc1++;
             }
             $queryindicator6_1resultdoc1d= docpdca::where('pdca_id',$queryindicator6_1result1[0]['pdca_id'])
             ->where('categorypdca','d')
             ->get();
             if(count($queryindicator6_1resultdoc1d)!=0){
                 $score6_1resultdoc1++;
             }
             $queryindicator6_1resultdoc1c= docpdca::where('pdca_id',$queryindicator6_1result1[0]['pdca_id'])
             ->where('categorypdca','c')
             ->get();
             if(count($queryindicator6_1resultdoc1c)!=0){
                 $score6_1resultdoc1++;
             }
             $queryindicator6_1resultdoc1a= docpdca::where('pdca_id',$queryindicator6_1result1[0]['pdca_id'])
             ->where('categorypdca','a')
             ->get();
             if(count($queryindicator6_1resultdoc1a)!=0){
                 $score6_1resultdoc1++;
             }
         }
  
 
         if($queryindicator6_1result1!="[]"){
             if($queryindicator6_1result1[0]['p']!=""){
                 $score6_1result1++;
             }
             if($queryindicator6_1result1[0]['d']!=""){
                 $score6_1result1++;
             }
             if($queryindicator6_1result1[0]['c']!=""){
                 $score6_1result1++;
             }
             if($queryindicator6_1result1[0]['a']!=""){
                 $score6_1result1++;
             }
         }
        $queryindicator6_1resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
         ->where('pdca.branch_id',session()->get('branch_id'))
         ->where('pdca.year_id',session()->get('year_id'))
         ->where('pdca.Indicator_id',6.1)
         ->where('pdca.target','!=',null)
         ->get();
         if($queryindicator6_1resultpdca!="[]"){
             $score6_1resultpdca++;
         }
         //// ปิดตัวบ่งชี้ 6.1
 
         //// การบริหารหลักสูตร
         $scorecoursemanage=0;
         $coursemanage=category5_course_manage::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
         if($coursemanage!="[]"){
             $scorecoursemanage++;
         }
         //// ปิด การบริหารหลักสูตร
 
 
         //// สรุปการประเมินหลักสูตร	
         $scoreassessmentsummary=0;
         $scoreassessmentsummary2=0;
         $queryassessmentsummary=category6_assessment_summary::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('category_assessor','=','การประเมินจากผู้ที่สำเร็จการศึกษา')
         ->where('year_id',session()->get('year_id'))
         ->get();
         if($queryassessmentsummary!="[]"){
             $scoreassessmentsummary++;
         }
 
         $queryassessmentsummary2=category6_assessment_summary::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('category_assessor','=','การประเมินจากผู้ที่มีส่วนเกี่ยวข้อง')
         ->where('year_id',session()->get('year_id'))
         ->get();
         if($queryassessmentsummary2!="[]"){
             $scoreassessmentsummary2++;
         }
         //// ปิด สรุปการประเมินหลักสูตร
 
         //// ข้อคิดเห็น และข้อเสนอแนะเกี่ยวกับคุณภาพหลักสูตรจากผู้ประเมิน
         $scorecomment_course=0;
         $querycomment_course=category6_comment_course::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
         if($querycomment_course!="[]"){
             $scorecomment_course++;
         }
         //// ปิด ข้อคิดเห็น และข้อเสนอแนะเกี่ยวกับคุณภาพหลักสูตรจากผู้ประเมิน
 
         //// ความก้าวหน้าของการดำเนินงานตามแผนที่เสนอในรายงานของปีที่ผ่านมา
         $scorestrength=0;
         $querystrength=category7_strength::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
         if($querystrength!="[]"){
             $scorestrength++;
         }
         //// ปิด ความก้าวหน้าของการดำเนินงานตามแผนที่เสนอในรายงานของปีที่ผ่านมา
 
 
         //// ข้อเสนอในการพัฒนาหลักสูตร
         $scoredevelopment_proposal=0;
         $querydevelopment_proposal=category7_development_proposal_detail::where('course_id',session()->get('usercourse'))
         ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
         if($querydevelopment_proposal!="[]"){
             $scoredevelopment_proposal++;
         }
         //// ปิด ข้อเสนอในการพัฒนาหลักสูตร
 
          //// แผนปฏิบัติการใหม่
          $scorenewstrength=0;
          $querynewstrength=category7_newstrength::where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
          ->where('year_id',session()->get('year_id'))
          ->get();
          if($querynewstrength!="[]"){
              $scorenewstrength++;
          }
          //// ปิด แผนปฏิบัติการใหม่
 
          //// สรุปจุดแข็ง จุดที่ควรพัฒนา และแนวทางการพัฒนา
          $scorestrengths_summary=0;
          $querynewstrength2=category7_strengths_summary::where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
          ->where('year_id',session()->get('year_id'))
          ->where('composition_id',2)
          ->get();
          $querynewstrength3=category7_strengths_summary::where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
          ->where('year_id',session()->get('year_id'))
          ->where('composition_id',3)
          ->get();
          $querynewstrength4=category7_strengths_summary::where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
          ->where('year_id',session()->get('year_id'))
          ->where('composition_id',4)
          ->get();
          $querynewstrength5=category7_strengths_summary::where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
          ->where('year_id',session()->get('year_id'))
          ->where('composition_id',5)
          ->get();
          $querynewstrength6=category7_strengths_summary::where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
          ->where('year_id',session()->get('year_id'))
          ->where('composition_id',6)
          ->get();
 
          if($querynewstrength2!="[]"){
             $scorestrengths_summary++;
         }
         if($querynewstrength3!="[]"){
             $scorestrengths_summary++;
         }
         if($querynewstrength4!="[]"){
             $scorestrengths_summary++;
         }
         if($querynewstrength5!="[]"){
             $scorestrengths_summary++;
         }
         if($querynewstrength6!="[]"){
             $scorestrengths_summary++;
         }
          //// ปิด สรุปจุดแข็ง จุดที่ควรพัฒนา และแนวทางการพัฒนา

        $result1_1=(($getscore1_1+$getscore1_1result)*100)/9;
        $result2_1=($getscore2_1*100)/2;
        $result2_2=($getscore2_2*100)/2;
        $result3_1=(($score3_1result1+$score3_1result2+$score3_1resultdoc1+$score3_1resultdoc2+$score3_1resultpdca)*100)/17;
        $result3_2=(($score3_2result1+$score3_2result2+$score3_2resultdoc1+$score3_2resultdoc2+$score3_2resultpdca)*100)/17;
        $result3_3=(($score3_3result1+$score3_3result2+$score3_3result3+$score3_3resultpdca)*100)/4;
        $resultscorfactor=($scorfactor*100)/1;
        $resultscorfactor2=($scorfactor2*100)/1;
        $resultinfo=(($scoreinfo+$scoreinfoqty)*100)/2;
        $resultgraduate=($scoregraduate*100)/1;
        $resultscorere=($scorere*100)/1;
        $result4_3=(($score4_3result1+$score4_3result2+$score4_3resultpdca)*100)/3;
        $result4_2=(($score4_2result1+$score4_2result2+$score4_2resultpdca)*100)/3;
        $result4_1=(($score4_1result1+$score4_1result2+$score4_1result3+$score4_1resultdoc1+$score4_1resultdoc2+
                    $score4_1resultdoc3+$score4_1resultpdca)*100)/25;
        $result5_1=(($score5_1result1+$score5_1result2+$score5_1result3+$score5_1resultdoc1+$score5_1resultdoc2+
                    $score5_1resultdoc3+$score5_1resultpdca)*100)/25;
        $result5_2=(($score5_2result1+$score5_2result2+$score5_2result3+$score5_2resultdoc1+$score5_2resultdoc2+
                    $score5_2resultdoc3+$score5_2resultpdca)*100)/25;
        $result5_3=(($score5_3result1+$score5_3result2+$score5_3resultdoc1+$score5_3resultdoc2+$score5_3resultpdca)*100)/17;
        $result5_4=(($score5_4result1+$score5_4resultpdca)*100)/2;
        $resultteachqua=($scoreteachqua*100)/1;
        $resultscoreccr=($scoreccr*100)/1;
        $resultscoreacademic=($scoreacademic*100)/1;
        $resultscorenot_offered=($scorenot_offered*100)/1;
        $resultscoreincomplete_content=($scoreincomplete_content*100)/1;
        $resultscoreeffec=($scoreeffec*100)/1;
        $resultscorenewteacher=($scorenewteacher*100)/1;
        $resultscoreactivity=($scoreactivity*100)/1;
        $result6_1=(($score6_1result1+$score6_1resultdoc1+$score6_1resultpdca)*100)/9;
        $course_manage=($scorecoursemanage*100)/1;
        $assessmentsummary=(($scoreassessmentsummary+$scoreassessmentsummary2)*100)/2;
        $resultscorecomment_course=($scorecomment_course*100)/1;
        $resultscorestrength=($scorestrength*100)/1;
        $resultscoredevelopment_proposal=($scoredevelopment_proposal*100)/1;
        $resultscorenewstrength=($scorenewstrength*100)/1;
        $resultscorestrengths_summary=($scorestrengths_summary*100)/5;


        $indicator1_1 = sprintf('%.0f',$result1_1);
        $indicator2_1 = sprintf('%.0f',$result2_1);
        $indicator2_2 = sprintf('%.0f',$result2_2);
        $indicator3_1 = sprintf('%.0f',$result3_1);
        $indicator3_2 = sprintf('%.0f',$result3_2);
        $indicator3_3 = sprintf('%.0f',$result3_3);
        $factor = sprintf('%.0f',$resultscorfactor);
        $factor2 = sprintf('%.0f',$resultscorfactor2);
        $infostd = sprintf('%.0f',$resultinfo);
        $graduate = sprintf('%.0f',$resultgraduate);
        $resignation = sprintf('%.0f',$resultscorere);
        $indicator4_1 = sprintf('%.0f',$result4_1);
        $indicator4_2 = sprintf('%.0f',$result4_2);
        $indicator4_3 = sprintf('%.0f',$result4_3);
        $indicator5_1 = sprintf('%.0f',$result5_1);
        $indicator5_2 = sprintf('%.0f',$result5_2);
        $indicator5_3 = sprintf('%.0f',$result5_3);
        $indicator5_4 = sprintf('%.0f',$result5_4);
        $teachqua = sprintf('%.0f',$resultteachqua);
        $course_results = sprintf('%.0f',$resultscoreccr);
        $academic = sprintf('%.0f',$resultscoreacademic);
        $not_offered = sprintf('%.0f',$resultscorenot_offered);
        $incomplete_content = sprintf('%.0f',$resultscoreincomplete_content);
        $effectiveness = sprintf('%.0f',$resultscoreeffec);
        $newteacher = sprintf('%.0f',$resultscorenewteacher);
        $activity = sprintf('%.0f',$resultscoreactivity);
        $indicator6_1 = sprintf('%.0f',$result6_1);
        $getcourse_manage = sprintf('%.0f',$course_manage);
        $getassessmentsummary = sprintf('%.0f',$assessmentsummary);
        $getresultscorecomment_course = sprintf('%.0f',$resultscorecomment_course);
        $getresultscorestrength = sprintf('%.0f',$resultscorestrength);
        $getscoredevelopment_proposal = sprintf('%.0f',$resultscoredevelopment_proposal);
        $getresultscorenewstrength = sprintf('%.0f',$resultscorenewstrength);
        $getresultscorestrengths_summary = sprintf('%.0f',$resultscorestrengths_summary);
         ////สรุปคะแนน
         $i=0;
         foreach($clind as $value){
         if($value['Indicator_id']=="1.1"){
             $clind[$i]['score']=$indicator1_1;
             if($indicator1_1<=25){
                 $clind[$i]['color']='danger';
                 $clind[$i]['color2']='red';
             }
             else if($indicator1_1<=50){
                 $clind[$i]['color']='yellow';
                 $clind[$i]['color2']='yellow';
             }
             else if($indicator1_1<=75){
                 $clind[$i]['color']='striped';
                 $clind[$i]['color2']='blue';
             }
             else if($indicator1_1<=100){
                 $clind[$i]['color']='success';
                 $clind[$i]['color2']='green';
             }
             $i++;
         }
          if($value['Indicator_id']=="2.1"){
             $clind[$i]['score']=$result2_1;
             if($result2_1<=25){
                 $clind[$i]['color']='danger';
                 $clind[$i]['color2']='red';
             }
             else if($result2_1<=50){
                 $clind[$i]['color']='yellow';
                 $clind[$i]['color2']='yellow';
             }
             else if($result2_1<=75){
                 $clind[$i]['color']='striped';
                 $clind[$i]['color2']='blue';
             }
             else if($result2_1<=100){
                 $clind[$i]['color']='success';
                 $clind[$i]['color2']='green';
             }
             
             $i++;
         }
         if($value['Indicator_id']=="2.2"){
             $clind[$i]['score']=$result2_2;
             if($result2_2<=25){
                $clind[$i]['color']='danger';
                $clind[$i]['color2']='red';
            }
            else if($result2_2<=50){
                $clind[$i]['color']='yellow';
                $clind[$i]['color2']='yellow';
            }
            else if($result2_2<=75){
                $clind[$i]['color']='striped';
                $clind[$i]['color2']='blue';
            }
            else if($result2_2<=100){
                $clind[$i]['color']='success';
                $clind[$i]['color2']='green';
            }
            $i++;
         }
          if($value['Indicator_id']=="3.1"){
             $clind[$i]['score']=$indicator3_1;
             if($indicator3_1<=25){
                $clind[$i]['color']='danger';
                $clind[$i]['color2']='red';
            }
            else if($indicator3_1<=50){
                $clind[$i]['color']='yellow';
                $clind[$i]['color2']='yellow';
            }
            else if($indicator3_1<=75){
                $clind[$i]['color']='striped';
                $clind[$i]['color2']='blue';
            }
            else if($indicator3_1<=100){
                $clind[$i]['color']='success';
                $clind[$i]['color2']='green';
            }
            $i++;
         }
          if($value['Indicator_id']=="3.2"){
             $clind[$i]['score']=$indicator3_2;
             if($indicator3_2<=25){
                 $clind[$i]['color']='danger';
                 $clind[$i]['color2']='red';
             }
             else if($indicator3_2<=50){
                 $clind[$i]['color']='yellow';
                 $clind[$i]['color2']='yellow';
             }
             else if($indicator3_2<=75){
                 $clind[$i]['color']='striped';
                 $clind[$i]['color2']='blue';
             }
             else if($indicator3_2<=100){
                 $clind[$i]['color']='success';
                 $clind[$i]['color2']='green';
             }
             $i++;
         }
          if($value['Indicator_id']=="3.3"){
             $clind[$i]['score']=$indicator3_3;
             if($indicator3_3<=25){
                 $clind[$i]['color']='danger';
                 $clind[$i]['color2']='red';
             }
             else if($indicator3_3<=50){
                 $clind[$i]['color']='yellow';
                 $clind[$i]['color2']='yellow';
             }
             else if($indicator3_3<=75){
                 $clind[$i]['color']='striped';
                 $clind[$i]['color2']='blue';
             }
             else if($indicator3_3<=100){
                 $clind[$i]['color']='success';
                 $clind[$i]['color2']='green';
             }
             $i++;
         }
          if($value['Indicator_id']=="4.1"){
             $clind[$i]['score']=$indicator4_1;
             if($indicator4_1<=25){
                 $clind[$i]['color']='danger';
                 $clind[$i]['color2']='red';
             }
             else if($indicator4_1<=50){
                 $clind[$i]['color']='yellow';
                 $clind[$i]['color2']='yellow';
             }
             else if($indicator4_1<=75){
                 $clind[$i]['color']='striped';
                 $clind[$i]['color2']='blue';
             }
             else if($indicator4_1<=100){
                 $clind[$i]['color']='success';
                 $clind[$i]['color2']='green';
             }
             $i++;
         }
         if($value['Indicator_id']=="4.2"){
            $clind[$i]['score']=$indicator4_2;
            if($indicator4_2<=25){
                 $clind[$i]['color']='danger';
                 $clind[$i]['color2']='red';
             }
             else if($indicator4_2<=50){
                 $clind[$i]['color']='yellow';
                 $clind[$i]['color2']='yellow';
             }
             else if($indicator4_2<=75){
                 $clind[$i]['color']='striped';
                 $clind[$i]['color2']='blue';
             }
             else if($indicator4_2<=100){
                 $clind[$i]['color']='success';
                 $clind[$i]['color2']='green';
             }
             $i++;
        }
        if($value['Indicator_id']=="4.3"){
            $clind[$i]['score']=$indicator4_3;
            if($indicator4_3<=25){
                 $clind[$i]['color']='danger';
                 $clind[$i]['color2']='red';
             }
             else if($indicator4_3<=50){
                 $clind[$i]['color']='yellow';
                 $clind[$i]['color2']='yellow';
             }
             else if($indicator4_3<=75){
                 $clind[$i]['color']='striped';
                 $clind[$i]['color2']='blue';
             }
             else if($indicator4_3<=100){
                 $clind[$i]['color']='success';
                 $clind[$i]['color2']='green';
             }
             $i++;
        }
        if($value['Indicator_id']=="5.1"){
            $clind[$i]['score']=$indicator5_1;
            if($indicator5_1<=25){
                 $clind[$i]['color']='danger';
                 $clind[$i]['color2']='red';
             }
             else if($indicator5_1<=50){
                 $clind[$i]['color']='yellow';
                 $clind[$i]['color2']='yellow';
             }
             else if($indicator5_1<=75){
                 $clind[$i]['color']='striped';
                 $clind[$i]['color2']='blue';
             }
             else if($indicator5_1<=100){
                 $clind[$i]['color']='success';
                 $clind[$i]['color2']='green';
             }
             $i++;
        }
        if($value['Indicator_id']=="5.2"){
            $clind[$i]['score']=$indicator5_2;
            if($indicator5_2<=25){
                 $clind[$i]['color']='danger';
                 $clind[$i]['color2']='red';
             }
             else if($indicator5_2<=50){
                 $clind[$i]['color']='yellow';
                 $clind[$i]['color2']='yellow';
             }
             else if($indicator5_2<=75){
                 $clind[$i]['color']='striped';
                 $clind[$i]['color2']='blue';
             }
             else if($indicator5_2<=100){
                 $clind[$i]['color']='success';
                 $clind[$i]['color2']='green';
             }
             $i++;
        }
        if($value['Indicator_id']=="5.3"){
            $clind[$i]['score']=$indicator5_3;
            if($indicator5_3<=25){
                 $clind[$i]['color']='danger';
                 $clind[$i]['color2']='red';
             }
             else if($indicator5_3<=50){
                 $clind[$i]['color']='yellow';
                 $clind[$i]['color2']='yellow';
             }
             else if($indicator5_3<=75){
                 $clind[$i]['color']='striped';
                 $clind[$i]['color2']='blue';
             }
             else if($indicator5_3<=100){
                 $clind[$i]['color']='success';
                 $clind[$i]['color2']='green';
             }
             $i++;
        }
        if($value['Indicator_id']=="5.4"){
            $clind[$i]['score']=$indicator5_4;
            if($indicator5_4<=25){
                 $clind[$i]['color']='danger';
                 $clind[$i]['color2']='red';
             }
             else if($indicator5_4<=50){
                 $clind[$i]['color']='yellow';
                 $clind[$i]['color2']='yellow';
             }
             else if($indicator5_4<=75){
                 $clind[$i]['color']='striped';
                 $clind[$i]['color2']='blue';
             }
             else if($indicator5_4<=100){
                 $clind[$i]['color']='success';
                 $clind[$i]['color2']='green';
             }
             $i++;
        }
        if($value['Indicator_id']=="6.1"){
            $clind[$i]['score']=$indicator6_1;
            if($indicator6_1<=25){
                 $clind[$i]['color']='danger';
                 $clind[$i]['color2']='red';
             }
             else if($indicator6_1<=50){
                 $clind[$i]['color']='yellow';
                 $clind[$i]['color2']='yellow';
             }
             else if($indicator6_1<=75){
                 $clind[$i]['color']='striped';
                 $clind[$i]['color2']='blue';
             }
             else if($indicator6_1<=100){
                 $clind[$i]['color']='success';
                 $clind[$i]['color2']='green';
             }
             $i++;
            }
        
            if($value['Indicator_name']=="คุณภาพการสอน"){
                $clind[$i]['score']=$teachqua;
                if($teachqua<=25){
                     $clind[$i]['color']='danger';
                     $clind[$i]['color2']='red';
                 }
                 else if($teachqua<=50){
                     $clind[$i]['color']='yellow';
                     $clind[$i]['color2']='yellow';
                 }
                 else if($teachqua<=75){
                     $clind[$i]['color']='striped';
                     $clind[$i]['color2']='blue';
                 }
                 else if($teachqua<=100){
                     $clind[$i]['color']='success';
                     $clind[$i]['color2']='green';
                 }
                 $i++;
                }
                if($value['Indicator_name']=="ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา"){
                    $clind[$i]['score']=$factor;
                    if($factor<=25){
                         $clind[$i]['color']='danger';
                         $clind[$i]['color2']='red';
                     }
                     else if($factor<=50){
                         $clind[$i]['color']='yellow';
                         $clind[$i]['color2']='yellow';
                     }
                     else if($factor<=75){
                         $clind[$i]['color']='striped';
                         $clind[$i]['color2']='blue';
                     }
                     else if($factor<=100){
                         $clind[$i]['color']='success';
                         $clind[$i]['color2']='green';
                     }
                     $i++;
                    }
                    if($value['Indicator_name']=="ปัยจัยที่มีผลกระทบต่อการสำเร็จการศึกษา"){
                        $clind[$i]['score']=$factor2;
                        if($factor2<=25){
                             $clind[$i]['color']='danger';
                             $clind[$i]['color2']='red';
                         }
                         else if($factor2<=50){
                             $clind[$i]['color']='yellow';
                             $clind[$i]['color2']='yellow';
                         }
                         else if($factor2<=75){
                             $clind[$i]['color']='striped';
                             $clind[$i]['color2']='blue';
                         }
                         else if($factor2<=100){
                             $clind[$i]['color']='success';
                             $clind[$i]['color2']='green';
                         }
                         $i++;
                        }
                        if($value['Indicator_name']=="สรุปการประเมินหลักสูตร"){
                            $clind[$i]['score']=$getassessmentsummary;
                            if($getassessmentsummary<=25){
                                 $clind[$i]['color']='danger';
                                 $clind[$i]['color2']='red';
                             }
                             else if($getassessmentsummary<=50){
                                 $clind[$i]['color']='yellow';
                                 $clind[$i]['color2']='yellow';
                             }
                             else if($getassessmentsummary<=75){
                                 $clind[$i]['color']='striped';
                                 $clind[$i]['color2']='blue';
                             }
                             else if($getassessmentsummary<=100){
                                 $clind[$i]['color']='success';
                                 $clind[$i]['color2']='green';
                             }
                             $i++;
                            }
                                if($value['Indicator_name']=="สรุปผลรายวิชาที่เปิดสอน"){
                                    $clind[$i]['score']=$course_results;
                                    if($course_results<=25){
                                         $clind[$i]['color']='danger';
                                         $clind[$i]['color2']='red';
                                     }
                                     else if($course_results<=50){
                                         $clind[$i]['color']='yellow';
                                         $clind[$i]['color2']='yellow';
                                     }
                                     else if($course_results<=75){
                                         $clind[$i]['color']='striped';
                                         $clind[$i]['color2']='blue';
                                     }
                                     else if($course_results<=100){
                                         $clind[$i]['color']='success';
                                         $clind[$i]['color2']='green';
                                     }
                                     $i++;
                                    }
                                    if($value['Indicator_name']=="รายวิชาที่มีผลการเรียนที่ไม่ปกติ"){
                                        $clind[$i]['score']=$academic;
                                        if($academic<=25){
                                             $clind[$i]['color']='danger';
                                             $clind[$i]['color2']='red';
                                         }
                                         else if($academic<=50){
                                             $clind[$i]['color']='yellow';
                                             $clind[$i]['color2']='yellow';
                                         }
                                         else if($academic<=75){
                                             $clind[$i]['color']='striped';
                                             $clind[$i]['color2']='blue';
                                         }
                                         else if($academic<=100){
                                             $clind[$i]['color']='success';
                                             $clind[$i]['color2']='green';
                                         }
                                         $i++;
                                        }
                                        if($value['Indicator_name']=="รายวิชาที่ไม่ได้เปิดสอน"){
                                            $clind[$i]['score']=$not_offered;
                                            if($not_offered<=25){
                                                 $clind[$i]['color']='danger';
                                                 $clind[$i]['color2']='red';
                                             }
                                             else if($not_offered<=50){
                                                 $clind[$i]['color']='yellow';
                                                 $clind[$i]['color2']='yellow';
                                             }
                                             else if($not_offered<=75){
                                                 $clind[$i]['color']='striped';
                                                 $clind[$i]['color2']='blue';
                                             }
                                             else if($not_offered<=100){
                                                 $clind[$i]['color']='success';
                                                 $clind[$i]['color2']='green';
                                             }
                                             $i++;
                                            }
                                            if($value['Indicator_name']=="รายวิชาที่สอนเนื้อหาไม่ครบ"){
                                                $clind[$i]['score']=$incomplete_content;
                                                if($incomplete_content<=25){
                                                     $clind[$i]['color']='danger';
                                                     $clind[$i]['color2']='red';
                                                 }
                                                 else if($incomplete_content<=50){
                                                     $clind[$i]['color']='yellow';
                                                     $clind[$i]['color2']='yellow';
                                                 }
                                                 else if($incomplete_content<=75){
                                                     $clind[$i]['color']='striped';
                                                     $clind[$i]['color2']='blue';
                                                 }
                                                 else if($incomplete_content<=100){
                                                     $clind[$i]['color']='success';
                                                     $clind[$i]['color2']='green';
                                                 }
                                                 $i++;
                                                }
                                                if($value['Indicator_name']=="ประสิทธิผลของกลยุทธ์การสอน"){
                                                    $clind[$i]['score']=$effectiveness;
                                                    if($effectiveness<=25){
                                                         $clind[$i]['color']='danger';
                                                         $clind[$i]['color2']='red';
                                                     }
                                                     else if($effectiveness<=50){
                                                         $clind[$i]['color']='yellow';
                                                         $clind[$i]['color2']='yellow';
                                                     }
                                                     else if($effectiveness<=75){
                                                         $clind[$i]['color']='striped';
                                                         $clind[$i]['color2']='blue';
                                                     }
                                                     else if($effectiveness<=100){
                                                         $clind[$i]['color']='success';
                                                         $clind[$i]['color2']='green';
                                                     }
                                                     $i++;
                                                    }
                                                    if($value['Indicator_name']=="การปฐมนิเทศอาจารย์ใหม่"){
                                                        $clind[$i]['score']=$newteacher;
                                                        if($newteacher<=25){
                                                             $clind[$i]['color']='danger';
                                                             $clind[$i]['color2']='red';
                                                         }
                                                         else if($newteacher<=50){
                                                             $clind[$i]['color']='yellow';
                                                             $clind[$i]['color2']='yellow';
                                                         }
                                                         else if($newteacher<=75){
                                                             $clind[$i]['color']='striped';
                                                             $clind[$i]['color2']='blue';
                                                         }
                                                         else if($newteacher<=100){
                                                             $clind[$i]['color']='success';
                                                             $clind[$i]['color2']='green';
                                                         }
                                                         $i++;
                                                        }
                                                        if($value['Indicator_name']=="กิจกรรมการพัฒนาวิชาชีพ"){
                                                            $clind[$i]['score']=$activity;
                                                            if($activity<=25){
                                                                 $clind[$i]['color']='danger';
                                                                 $clind[$i]['color2']='red';
                                                             }
                                                             else if($activity<=50){
                                                                 $clind[$i]['color']='yellow';
                                                                 $clind[$i]['color2']='yellow';
                                                             }
                                                             else if($activity<=75){
                                                                 $clind[$i]['color']='striped';
                                                                 $clind[$i]['color2']='blue';
                                                             }
                                                             else if($activity<=100){
                                                                 $clind[$i]['color']='success';
                                                                 $clind[$i]['color2']='green';
                                                             }
                                                             $i++;
                                                            }
                                                            if($value['Indicator_name']=="การบริหารหลักสูตร"){
                                                                $clind[$i]['score']=$getcourse_manage;
                                                                if($getcourse_manage<=25){
                                                                     $clind[$i]['color']='danger';
                                                                     $clind[$i]['color2']='red';
                                                                 }
                                                                 else if($getcourse_manage<=50){
                                                                     $clind[$i]['color']='yellow';
                                                                     $clind[$i]['color2']='yellow';
                                                                 }
                                                                 else if($getcourse_manage<=75){
                                                                     $clind[$i]['color']='striped';
                                                                     $clind[$i]['color2']='blue';
                                                                 }
                                                                 else if($getcourse_manage<=100){
                                                                     $clind[$i]['color']='success';
                                                                     $clind[$i]['color2']='green';
                                                                 }
                                                                 $i++;
                                                                }
                                                                if($value['Indicator_name']=="ข้อคิดเห็น และข้อเสนอแนะ"){
                                                                    $clind[$i]['score']=$resultscorecomment_course;
                                                                    if($resultscorecomment_course<=25){
                                                                         $clind[$i]['color']='danger';
                                                                         $clind[$i]['color2']='red';
                                                                     }
                                                                     else if($resultscorecomment_course<=50){
                                                                         $clind[$i]['color']='yellow';
                                                                         $clind[$i]['color2']='yellow';
                                                                     }
                                                                     else if($resultscorecomment_course<=75){
                                                                         $clind[$i]['color']='striped';
                                                                         $clind[$i]['color2']='blue';
                                                                     }
                                                                     else if($resultscorecomment_course<=100){
                                                                         $clind[$i]['color']='success';
                                                                         $clind[$i]['color2']='green';
                                                                     }
                                                                     $i++;
                                                                    }
                                                                    if($value['Indicator_name']=="ความก้าวหน้าของการดำเนินงาน"){
                                                                        $clind[$i]['score']=$getresultscorestrength;
                                                                        if($getresultscorestrength<=25){
                                                                             $clind[$i]['color']='danger';
                                                                             $clind[$i]['color2']='red';
                                                                         }
                                                                         else if($getresultscorestrength<=50){
                                                                             $clind[$i]['color']='yellow';
                                                                             $clind[$i]['color2']='yellow';
                                                                         }
                                                                         else if($getresultscorestrength<=75){
                                                                             $clind[$i]['color']='striped';
                                                                             $clind[$i]['color2']='blue';
                                                                         }
                                                                         else if($getresultscorestrength<=100){
                                                                             $clind[$i]['color']='success';
                                                                             $clind[$i]['color2']='green';
                                                                         }
                                                                         $i++;
                                                                        }
                                                                        if($value['Indicator_name']=="ข้อเสนอในการพัฒนาหลักสูตร"){
                                                                            $clind[$i]['score']=$getscoredevelopment_proposal;
                                                                            if($getscoredevelopment_proposal<=25){
                                                                                 $clind[$i]['color']='danger';
                                                                                 $clind[$i]['color2']='red';
                                                                             }
                                                                             else if($getscoredevelopment_proposal<=50){
                                                                                 $clind[$i]['color']='yellow';
                                                                                 $clind[$i]['color2']='yellow';
                                                                             }
                                                                             else if($getscoredevelopment_proposal<=75){
                                                                                 $clind[$i]['color']='striped';
                                                                                 $clind[$i]['color2']='blue';
                                                                             }
                                                                             else if($getscoredevelopment_proposal<=100){
                                                                                 $clind[$i]['color']='success';
                                                                                 $clind[$i]['color2']='green';
                                                                             }
                                                                             $i++;
                                                                            }
                                                                            if($value['Indicator_name']=="แผนปฏิบัติการใหม่"){
                                                                                $clind[$i]['score']=$getresultscorenewstrength;
                                                                                if($getresultscorenewstrength<=25){
                                                                                     $clind[$i]['color']='danger';
                                                                                     $clind[$i]['color2']='red';
                                                                                 }
                                                                                 else if($getresultscorenewstrength<=50){
                                                                                     $clind[$i]['color']='yellow';
                                                                                     $clind[$i]['color2']='yellow';
                                                                                 }
                                                                                 else if($getresultscorenewstrength<=75){
                                                                                     $clind[$i]['color']='striped';
                                                                                     $clind[$i]['color2']='blue';
                                                                                 }
                                                                                 else if($getresultscorenewstrength<=100){
                                                                                     $clind[$i]['color']='success';
                                                                                     $clind[$i]['color2']='green';
                                                                                 }
                                                                                 $i++;
                                                                                }
                                                                                if($value['Indicator_name']=="ข้อมูลนักศึกษา"){
                                                                                    $clind[$i]['score']=$infostd;
                                                                                    if($infostd<=25){
                                                                                         $clind[$i]['color']='danger';
                                                                                         $clind[$i]['color2']='red';
                                                                                     }
                                                                                     else if($infostd<=50){
                                                                                         $clind[$i]['color']='yellow';
                                                                                         $clind[$i]['color2']='yellow';
                                                                                     }
                                                                                     else if($infostd<=75){
                                                                                         $clind[$i]['color']='striped';
                                                                                         $clind[$i]['color2']='blue';
                                                                                     }
                                                                                     else if($infostd<=100){
                                                                                         $clind[$i]['color']='success';
                                                                                         $clind[$i]['color2']='green';
                                                                                     }
                                                                                     $i++;
                                                                                    }
                                                                                    if($value['Indicator_name']=="จุดแข็ง จุดที่ควรพัฒนา"){
                                                                                        $clind[$i]['score']=$getresultscorestrengths_summary;
                                                                                        if($getresultscorestrengths_summary<=25){
                                                                                             $clind[$i]['color']='danger';
                                                                                             $clind[$i]['color2']='red';
                                                                                         }
                                                                                         else if($getresultscorestrengths_summary<=50){
                                                                                             $clind[$i]['color']='yellow';
                                                                                             $clind[$i]['color2']='yellow';
                                                                                         }
                                                                                         else if($getresultscorestrengths_summary<=75){
                                                                                             $clind[$i]['color']='striped';
                                                                                             $clind[$i]['color2']='blue';
                                                                                         }
                                                                                         else if($getresultscorestrengths_summary<=100){
                                                                                             $clind[$i]['color']='success';
                                                                                             $clind[$i]['color2']='green';
                                                                                         }
                                                                                         $i++;
                                                                                        }
                                                                                        if($value['Indicator_name']=="จำนวนผู้สำเร็จการศึกษา"){
                                                                                            $clind[$i]['score']=$graduate;
                                                                                            if($graduate<=25){
                                                                                                 $clind[$i]['color']='danger';
                                                                                                 $clind[$i]['color2']='red';
                                                                                             }
                                                                                             else if($graduate<=50){
                                                                                                 $clind[$i]['color']='yellow';
                                                                                                 $clind[$i]['color2']='yellow';
                                                                                             }
                                                                                             else if($graduate<=75){
                                                                                                 $clind[$i]['color']='striped';
                                                                                                 $clind[$i]['color2']='blue';
                                                                                             }
                                                                                             else if($graduate<=100){
                                                                                                 $clind[$i]['color']='success';
                                                                                                 $clind[$i]['color2']='green';
                                                                                             }
                                                                                             $i++;
                                                                                            }
                                                                            if($value['Indicator_name']=="จำนวนการลาออกและคัดชื่อออก"){
                                                                           $clind[$i]['score']=$resignation;
                                                                              if($resignation<=25){
                                                                                  $clind[$i]['color']='danger';
                                                                                  $clind[$i]['color2']='red';
                                                                                }
                                                                                else if($resignation<=50){
                                                                                 $clind[$i]['color']='yellow';
                                                                                 $clind[$i]['color2']='yellow';
                                                                               }
                                                                              else if($resignation<=75){
                                                                                 $clind[$i]['color']='striped';
                                                                                 $clind[$i]['color2']='blue';
                                                                               }
                                                                               else if($resignation<=100){
                                                                                  $clind[$i]['color']='success';
                                                                                 $clind[$i]['color2']='green';
                                                                               }
                                                                              $i++;
                                                                                }
        }
        return response()->json($clind);
        
    }
    public function getindicator1_1()
    {
        $data=indicator1_1::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
         //ดึงค่าปี
         $year=Year::where('active',1)
         ->get();
         foreach($year as $value){
             $y=$value['year_name'];
          }
         //ดึงค่าตารางหลักสูตร
         $course = Course::where('course_id',session()->get('usercourse'))
         ->get();
 
         //ดึงค่าตารางอาจารย์ผู้รับผิดชอบหลักสูตร
         $trc = course_responsible_teacher::join('year','course_responsible_teacher.year_id','=','year.year_id')
         ->where('course_responsible_teacher.course_id',session()->get('usercourse'))
         ->where('course_responsible_teacher.branch_id',session()->get('branch_id'))
         ->where('year.year_id',session()->get('year_id'))
         ->get();
         ///นับอาจารย์ผู้รีบผิดชอบหลักสูตร
         $count=count($trc);
 
         foreach($course as $value)
         {
             $c=$value['course_name'];
         }
         
         ///SELECT user_fullname
         // FROM course_responsible_teacher
         // left JOIN users on course_responsible_teacher.user_id=users.id
         // LEFT JOIN year on course_responsible_teacher.year_id=year.year_id
         // WHERE users.user_course=1 AND year.year_id=1
         ///join table course_responsible_teacher และ users เพื่อให้ได้ชื่อ user ที่เป็นอาจารย์ผู้รับผิดชอบหลักสูตร
         $nameteacher = course_responsible_teacher::leftjoin('users','course_responsible_teacher.user_id','=','users.id')
         ->where('users.user_course',session()->get('usercourse'))
         ->where('users.user_branch',session()->get('branch_id'))
         ->where('course_responsible_teacher.year_id',session()->get('year_id'))
         ->get();
 
         ////ดึงสาขาวิชาที่จบของอาจารย์ผู้รับผิดชอบหลักสูตร
         $educ_bg= User::leftjoin('course_responsible_teacher','users.id','=','course_responsible_teacher.user_id')
         ->where('users.user_course',session()->get('usercourse'))
         ->where('users.user_branch',session()->get('branch_id'))
         ->where('course_responsible_teacher.year_id',session()->get('year_id'))
         ->get();
          ////ดึงสาขาวิชาที่จบของอาจารย์ประจำหลักสูตร
          $tc_course= User::leftjoin('course_teacher','users.id','=','course_teacher.user_id')
          ->where('users.user_course',session()->get('usercourse'))
          ->where('users.user_branch',session()->get('branch_id'))
          ->where('course_teacher.year_id',session()->get('year_id'))
          ->get();
 
          ////ดึงสาขาวิชาที่จบของอาจารย์ผู้สอน
          $instructor= User::leftjoin('instructor','users.id','=','instructor.user_id')
          ->where('users.user_course',session()->get('usercourse'))
          ->where('users.user_branch',session()->get('branch_id'))
          ->where('instructor.year_id',session()->get('year_id'))
          ->get();
          ////ดึงสาขาวิชาที่จบของอาจารย์ผู้สอนพิเศษ
          $specialinstructor= User::leftjoin('special_teacher','users.id','=','special_teacher.user_id')
          ->where('users.user_course',session()->get('usercourse'))
          ->where('users.user_branch',session()->get('branch_id'))
          ->where('special_teacher.year_id',session()->get('year_id'))
          ->get();
 
          $getresult=indicator1_1::where('year_id',session()->get('year_id'))
          ->where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
          ->get();
          $get1=0;
          $get2=0;
          $get3=0;
          $get4=0;
          $get5=0;
          $result1=0;
          $result2=0;
          $result3=0;
          $result4=0;
          $result5=0;
          $result6=0;
          $result7=0;
          $result8=0;
          $result9=0;
          $result10=0;
          if($getresult!="[]"){
             foreach($getresult as $value){
                 $get1=$value['result1'];
                 $get2=$value['result2'];
                 $get3=$value['result3'];
                 $get4=$value['result4'];
                 $get5=$value['result5'];
             }
             if($get1==2){
                $result1=1;
                $result2=0;
             }
             else if($get1==1){
                $result1=0;
                $result2=1;
             }
             else{
                 $result1=0;
                 $result2=0;
             }
            // ----------
             if($get2==2){
                $result3=1;
                $result4=0;
             }
             else if($get2==1){
                 $result3=0;
                 $result4=1;
              }
              else{
                  $result3=0;
                  $result4=0;
              }
            // ----------
             if($get3==2){
                $result5=1;
                $result6=0;
             }
             else if($get3==1){
                 $result5=0;
                 $result6=1;
              }
              else{
                  $result5=0;
                  $result6=0;
              }
              // ----------
             if($get4==2){
                $result7=1;
                $result8=0;
             }
             else if($get4==1){
                 $result7=0;
                 $result8=1;
              }
              else{
                  $result7=0;
                  $result8=0;
              }
 
             if($get5==2){
                 $result9=1;
                 $result10=0;
              }
              else if($get5==1){
                 $result9=0;
                 $result10=1;
              }
              else{
                  $result9=0;
                  $result10=0;
              }
          }
          $getcategorypdca=defaulindicator::where('id',1)
         ->get();
         $name="";
         $id="";
         foreach($getcategorypdca as $value)
         {
             $name=$value['Indicator_name'];
             $id=$value['Indicator_id'];
         }
         
          ////ดึงผลการประเมินตนเอง ตัวบ่งชี้ที่ 1.1
         $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
         ->where('pdca.branch_id',session()->get('branch_id'))
         ->where('pdca.year_id',session()->get('year_id'))
         ->where('pdca.indicator_id',1.1)
         ->get();
          foreach ($educ_bg as $key => $value){
             $value->educational_background->first(); 
          }
         //ตรวจสอบ 1.จำนวนอาจารย์ผู้รับผิดชอบหลักสูตร
         if($count>=5)
         {
             $checkpass=true;
             $checknotpass=false;
         }
         else
         {
             $checknotpass=true;
             $checkpass=false;
         }

      $pdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
      ->where('pdca.course_id',session()->get('usercourse'))
      ->where('pdca.branch_id',session()->get('branch_id'))
      ->where('pdca.year_id',session()->get('year_id'))
      ->where('pdca.indicator_id',1.1)
      ->where('pdca.target','!=',null)
      ->get();
      $per1="";
       $get1_1=indicator1_1::where('course_id',session()->get('usercourse'))
       ->where('branch_id',session()->get('branch_id'))
       ->where('year_id',session()->get('year_id'))
       ->get();
      return view('category/editindicator1-1',compact('pdca','per1','get1_1','c','count','nameteacher'
      ,'educ_bg','y','checkpass','checknotpass','id','name','tc_course','instructor','specialinstructor','inc','result1','result2','result3','result4','result5','result6','result7','result8','result9','result10'));
    }
    function addindicator1_1(Request $request)
    {
        $data=new indicator1_1;
        $data->result1=$request->result1;
        $data->result2=$request->result2;
        $data->result3=$request->result3;
        $data->result4=$request->result4;
        $data->result5=$request->result5;
        $data->course_id=session()->get('usercourse');
        $data->branch_id=session()->get('branch_id');
        $data->year_id=session()->get('year_id');
        $data->save();
        $data3=new PDCA;
        $data3->Indicator_id=1.1;
        $data3->target=$request->target;
        $data3->performance3=$request->performance3;
        $data3->score=$request->score;
        $data3->course_id=session()->get('usercourse');
        $data3->branch_id=session()->get('branch_id');
        $data3->year_id=session()->get('year_id');
        $data3->save(); 
     return $data3;
    }
    public function updateindicator1_1(Request $request)
    {
        $data=indicator1_1::find($request->id);
        $data->result1=$request->result1;
        $data->result2=$request->result2;
        $data->result3=$request->result3;
        $data->result4=$request->result4;
        $data->result5=$request->result5;
        $data->save();
        $data3=PDCA::find($request->Indicator_id);
        $data3->target=$request->target;
        $data3->performance3=$request->performance3;
        $data3->score=$request->score;
        $data3->save(); 
        return $data3;
    }

}

