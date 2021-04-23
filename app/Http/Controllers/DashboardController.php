<?php

namespace App\Http\Controllers;
use App\User;
use App\PDCA;
use App\DocPDCA;
use App\Groupmenu;
use App\Course;
use App\composition;
use App\indicator1_1;
use App\indicator2_1;
use App\indicator2_2;
use App\indicator4_3;
use App\indicator5_4;
use App\performance3_3;
use App\category3_GD;
use App\category3_infostudent;
use App\category3_infostudent_qty;
use App\year_acceptance_graduate;
use App\category3_resignation;
use App\category4_teaching_quality;
use App\category4_course_results;
use App\ModelAJ\category4_academic_performance;
use App\category4_notcourse_results;
use  App\ModelAJ\category4_incomplete_content;
use App\Year;
use App\category4_effectiveness;
use App\category4_newteacher;
use App\category4_activity;
use App\category5_course_manage;
use App\category6_assessment_summary;
use App\category6_comment_course;
use App\category7_strength;
use App\category7_development_proposal_detail;
use App\category7_newstrength;
use App\category7_strengths_summary;
use App\category3_graduate;
use App\Tps;
use App\usergroup;
use App\defaulindicator;
use App\Menu;
use App\category;
use App\instructor;
use App\branch;
use App\indicator;
use App\user_permission;
use App\rolepermission;
use App\assessment_results;
use App\Faculty;
use App\groupuser;
use App\course_responsible_teacher;
use App\Educational_background;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {   
         ////หมวดที่ 1 
         ////ตัวบ่งชี้ 1.1
         $getscore1_1=0;
         $getscore1_1result=0;
         $score1_1=0;
         $queryindicator1_1=indicator1_1::where('year_id',session()->get('year_id'))
         ->where('course_id',session()->get('usercourse'))
         ->get();
         
         $queryindicator1_1result= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
         ->where('pdca.year_id',session()->get('year_id'))
         ->where('pdca.Indicator_id',1.1)
         ->where('pdca.target','!=',null)
         ->get();
 
         //ดึงค่าตารางอาจารย์ผู้รับผิดชอบหลักสูตร
         $trc = course_responsible_teacher::join('year','course_responsible_teacher.year_id','=','year.year_id')
         ->where('course_responsible_teacher.course_id',session()->get('usercourse'))
         ->where('year.year_id',session()->get('year_id'))
         ->get();
          ////ดึงสาขาวิชาที่จบของอาจารย์ประจำหลักสูตร
          $tc_course= User::leftjoin('course_teacher','users.id','=','course_teacher.user_id')
          ->where('users.user_course',session()->get('usercourse'))
          ->where('course_teacher.year_id',session()->get('year_id'))
          ->get();
 
          ////ดึงสาขาวิชาที่จบของอาจารย์ผู้สอน
          $instructor= User::leftjoin('instructor','users.id','=','instructor.user_id')
          ->where('users.user_course',session()->get('usercourse'))
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
          ->where('year.year_id',session()->get('year_id'))
          ->get();
          $educ_bg= User::leftjoin('course_responsible_teacher','users.id','=','course_responsible_teacher.user_id')
          ->where('users.user_course',session()->get('usercourse'))
          ->where('course_responsible_teacher.year_id',session()->get('year_id'))
          ->get();
          foreach($educ_bg as $key=>$t){
              if(count($educ_bg[$key]->research_results)!=0){
                      $score4_2result2=1;
              }
          }
         
          $queryindicator4_2resultpdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
          ->where('pdca.course_id',session()->get('usercourse'))
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
         ->get();
         $queryindicator2_1result= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
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
         ->get();
         $queryindicator2_2result= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.course_id',session()->get('usercourse'))
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
             ->where('year_add',session()->get('year'))
             ->get();
         $getqty=category3_infostudent_qty::where('course_id',session()->get('usercourse'))
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
         ->get();
         $scoregraduate=0;
         if($get!="[]"){
             $getinfo=category3_graduate::where('course_id',session()->get('usercourse'))
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
       ->where('year_id',session()->get('year_id'))
       ->get();
       $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
       ->where('pdca.course_id',session()->get('usercourse'))
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
       ->where('year_id',session()->get('year_id'))
       ->get();
        if($teachqua!="[]"){
            $scoreteachqua++;
        }
        //// ปิด คุณภาพการสอน

        //// สรุปผลรายวิชาที่เปิดสอนในภาค/ปีการศึกษา
        $scoreccr=0;
        $ccr=category4_course_results::where('course_id',session()->get('usercourse'))
       ->where('year_id',session()->get('year_id'))
       ->get();
        if($ccr!="[]"){
            $scoreccr++;
        }
        //// ปิด สรุปผลรายวิชาที่เปิดสอนในภาค/ปีการศึกษา

        //// การวิเคราะห์รายวิชาที่มีผลการเรียนที่ไม่ปกติ
        $scoreacademic=0;
        $academic=category4_academic_performance::where('course_id',session()->get('usercourse'))
       ->where('year_id',session()->get('year_id'))
       ->get();
        if($academic!="[]"){
            $scoreacademic++;
        }
        //// ปิด การวิเคราะห์รายวิชาที่มีผลการเรียนที่ไม่ปกติ
        
        //// รายวิชาที่ไม่ได้เปิดสอนในปีการศึกษา
        $scorenot_offered=0;
        $not_offered=category4_notcourse_results::where('course_id',session()->get('usercourse'))
       ->where('year_id',session()->get('year_id'))
       ->get();
        if($not_offered!="[]"){
            $scorenot_offered++;
        }
        //// ปิด รายวิชาที่ไม่ได้เปิดสอนในปีการศึกษา

        //// รายวิชาที่สอนเนื้อหาไม่ครบในปีการศึกษา
        $scoreincomplete_content=0;
        $queryincomplete_content=category4_incomplete_content::where('course_id',session()->get('usercourse'))
       ->where('year_id',session()->get('year_id'))
       ->get();
        if($queryincomplete_content!="[]"){
            $scoreincomplete_content++;
        }
        //// ปิด รายวิชาที่สอนเนื้อหาไม่ครบในปีการศึกษา

        //// ประสิทธิผลของกลยุทธ์การสอน
        $scoreeffec=0;
        $effec=category4_effectiveness::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if($effec!="[]"){
            $scoreeffec++;
        }
        //// ปิด ประสิทธิผลของกลยุทธ์การสอน

        //// การปฐมนิเทศอาจารย์ใหม่
        $scorenewteacher=0;
        $th=category4_newteacher::where('course_id',session()->get('usercourse'))
       ->where('year_id',session()->get('year_id'))
       ->get();
        if($th!="[]"){
            $scorenewteacher++;
        }
        //// ปิด การปฐมนิเทศอาจารย์ใหม่
        
        //// กิจกรรมการพัฒนาวิชาชีพของอาจารย์
        $scoreactivity=0;
        $activity=category4_activity::where('course_id',session()->get('usercourse'))
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
        ->where('year_id',session()->get('year_id'))
        ->get();
        if($coursemanage!="[]"){
            $scorecoursemanage++;
        }
        //// ปิด การบริหารหลักสูตร


        ///ปิดหมวดที่ 5 

        ////หมวดที่ 6 
         //// การประเมินจากผู้ที่สำเร็จการศึกษา
         $scoreassessmentsummary=0;
         $queryassessmentsummary=category6_assessment_summary::where('course_id',session()->get('usercourse'))
         ->where('category_assessor','=','การประเมินจากผู้ที่สำเร็จการศึกษา')
         ->where('year_id',session()->get('year_id'))
         ->get();
         if($queryassessmentsummary!="[]"){
             $scoreassessmentsummary++;
         }
         //// ปิด การประเมินจากผู้ที่สำเร็จการศึกษา
         
         //// การประเมินจากผู้ที่สำเร็จการศึกษา
         $scoreassessmentsummary2=0;
         $queryassessmentsummary2=category6_assessment_summary::where('course_id',session()->get('usercourse'))
         ->where('category_assessor','=','การประเมินจากผู้ที่มีส่วนเกี่ยวข้อง')
         ->where('year_id',session()->get('year_id'))
         ->get();
         if($queryassessmentsummary2!="[]"){
             $scoreassessmentsummary2++;
         }
         //// ปิด การประเมินจากผู้ที่สำเร็จการศึกษา
 
         //// ข้อคิดเห็น และข้อเสนอแนะเกี่ยวกับคุณภาพหลักสูตรจากผู้ประเมิน
         $scorecomment_course=0;
         $querycomment_course=category6_comment_course::where('course_id',session()->get('usercourse'))
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
        ->where('year_id',session()->get('year_id'))
        ->get();
        if($querystrength!="[]"){
            $scorestrength++;
        }
        //// ปิด ความก้าวหน้าของการดำเนินงานตามแผนที่เสนอในรายงานของปีที่ผ่านมา


        //// ข้อเสนอในการพัฒนาหลักสูตร
        $scoredevelopment_proposal=0;
        $querydevelopment_proposal=category7_development_proposal_detail::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        if($querydevelopment_proposal!="[]"){
            $scoredevelopment_proposal++;
        }
        //// ปิด ข้อเสนอในการพัฒนาหลักสูตร

         //// แผนปฏิบัติการใหม่
         $scorenewstrength=0;
         $querynewstrength=category7_newstrength::where('course_id',session()->get('usercourse'))
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
        ->where('year_id',session()->get('year_id'))
        ->where('composition_id',2)
        ->get();
        $querynewstrength3=category7_strengths_summary::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->where('composition_id',3)
        ->get();
        $querynewstrength4=category7_strengths_summary::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->where('composition_id',4)
        ->get();
        $querynewstrength5=category7_strengths_summary::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->where('composition_id',5)
        ->get();
        $querynewstrength6=category7_strengths_summary::where('course_id',session()->get('usercourse'))
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


       


        $allcategory1=(($getscore1_1+$getscore1_1result+$score4_1result1+$score4_1result2+$score4_1result3+$score4_1resultdoc1+$score4_1resultdoc2+
        $score4_1resultdoc3+$score4_1resultpdca+$score4_2result1+$score4_2result2+$score4_2resultpdca+$score4_3result1+
        $score4_3result2+$score4_3resultpdca+$getscore2_1+$getscore2_2+$score3_1result1+$score3_1result2+$score3_1resultdoc1+$score3_1resultdoc2+$score3_1resultpdca
        +$score3_2result1+$score3_2result2+$score3_2resultdoc1+$score3_2resultdoc2+$score3_2resultpdca
        +$score3_3result1+$score3_3result2+$score3_3result3+$score3_3resultpdca
        +$scorfactor+$scorfactor2+$scoreinfo+$scoreinfoqty+$scoregraduate+$scoregraduate+$scorere+$score5_1result1+$score5_1result2+$score5_1result3+$score5_1resultdoc1+$score5_1resultdoc2+
        $score5_1resultdoc3+$score5_1resultpdca+$score5_2result1+$score5_2result2+$score5_2result3+
        $score5_2resultdoc1+$score5_2resultdoc2+$score5_2resultdoc3+$score5_2resultpdca+
        $score5_3result1+$score5_3result2+$score5_3resultdoc1+$score5_3resultdoc2+$score5_3resultpdca+
        $score5_4result1+$score5_4resultpdca+$scoreteachqua+$scoreccr+$scoreacademic+$scorenot_offered+
        $scoreincomplete_content+$scoreeffec+$scorenewteacher+$scoreactivity+$score6_1result1+$score6_1resultdoc1+$score6_1resultpdca+$scorecoursemanage+
        $scoreassessmentsummary+$scoreassessmentsummary2+$scorecomment_course+$scorestrength+$scoredevelopment_proposal+$scorenewstrength+
        $scorestrengths_summary)*100)/187;


        $color="";
        $allcategory = sprintf('%.0f',$allcategory1);
        if($allcategory<=25){
            $color='red';
        }
        else if($allcategory<=50){
            $color='yellow';
        }
        else if($allcategory<=75){
            $color='blue';
        }
        else if($allcategory<=100){
            $color='green';
        }
        // $user=auth()->user();
        // $userrole=$user->role;
        // $role=Role::findByName($userrole);
        // dd($role);

        // $user = auth()->user();
        // $permissions = $user->getAllPermissions();
        // foreach($permissions as $value)
        // {
        //     dd($value->id);
        // }
        $user=auth()->user();
        $user_course=$user->user_course;
        $user_group=$user->user_group_id;
        $year=Year::where('active',1)
        ->get();
        $getAllyear=Year::all();
        foreach($year as $value){
            $y_name=$value['year_name'];
            $y_id=$value['year_id'];
        }
        session()->put('usercourse',$user_course);
        session()->put('year',$y_name);
        session()->put('year_id',$y_id);
        $groupmenu=Groupmenu::all();
        $rolepermiss=rolepermission::leftjoin('menu','role_permission.m_id','=','menu.m_id')
        ->where('user_group_id',$user_group)
        ->get();
       
         foreach ($groupmenu as $key => $value){
            $value->menu->first(); 
         }
        session()->put('groupmenu',$groupmenu);
        session()->put('roleper',$rolepermiss);

        $category=category::all();
        $roleindicator=user_permission::leftjoin('indicator','user_permission.indicator_id','=','indicator.id')
        ->where('user_permission.user_id',$user->id)
        ->where('user_permission.year_id',session()->get('year_id'))
        ->get();
        foreach ($category as $key => $value){
            $value->indicator->first(); 
         }
        session()->put('category',$category);
        if(count($roleindicator)!=0){
            session()->put('roleindicator',$roleindicator);
        }
        else{
            session()->put('roleindicator',"");
        }


        /////หน้าแรก
        $querygetwork=user_permission::where('user_id',$user->id)
        ->where('year_id',session()->get('year_id'))
        ->get();
        $getwork=count($querygetwork);
        if($user_group==1){
            return view('dashboard/year',compact('year','getAllyear'));
        }
       else if($user_group==2||$user_group==3){
            return view('dashboard/dashboard',compact('allcategory','getwork','color'));
       }
       else{
            return view('dashboard/dashboard2',compact('allcategory','getwork','color'));
       }
    }
    public function index2()
    {
        $course=Course::all();
        $faculty=Faculty::all();
        $groupuser=groupuser::all();
        $user=User::leftjoin('course','users.user_course','=','course.course_id')
        ->leftjoin('faculty','users.user_faculty','=','faculty.faculty_id')
        ->leftjoin('user_group','users.user_group_id','=','user_group.user_group_id')
        ->get();
        return view('dashboard.addmember',compact('user','course','faculty','groupuser'));
    }
    public function index3()
    {
        
        return view('dashboard/index3');
    }
    public function index4()
    {
        
        return view('dashboard/permission');
    }
    public function index5()
    {
        $getgroupmenu=Groupmenu::all();
        return view('dashboard/Groupmenu',compact('getgroupmenu'));
    }
    public function index6()
    {
        $getmenu=Menu::leftjoin('menu_group','menu.g_id','=','menu_group.g_id')
        ->get();
        $getgroupmenu=Groupmenu::all();
        return view('dashboard/Menu',compact('getmenu','getgroupmenu'));
    }
    public function index7()
    {
        $getusergroup=usergroup::all();
        $role=GroupMenu::all();
         foreach ($role as $key => $value){
            $value->menu->first(); 
         }
         $getper=rolepermission::leftjoin('menu','role_permission.m_id','=','menu.m_id')
         ->get();
         $user=auth()->user();
        $user_group=$user->user_group_id;
        $rolepermiss=rolepermission::where('user_group_id',$user_group)->get();

        session()->put('roleper',$rolepermiss);
        return view('dashboard.permission',compact('getusergroup','role','getper'));
        dd($role);
    }
    public function index8()
    {   $faculty=Faculty::all();
        $course=Course::leftjoin('faculty','course.faculty_id','=','faculty.faculty_id')
        ->get();
        return view('dashboard/course',compact('course','faculty'));
    }
    public function index9()
    {
        
        return view('dashboard/board');
    }
    public function index10()
    {
      $Category=category::all();
      return view('dashboard/category',compact('Category'));
    }
    public function index11()
    {
        $indicator=defaulindicator::all();
        $category=category::all();
        $composition=composition::all();
        return view('dashboard/Indicator',compact('indicator','category','composition'));
    }
    public function index12()
    {
        
        return view('dashboard/usercategory');
    }
    public function index13()
    {
        $faculty=Faculty::all();
        return view('dashboard/faculty',compact('faculty'));
    }
    public function index14()
    {
        $groupuser=groupuser::all();
        return view('dashboard/addgroupmember',compact('groupuser'));
    }
    public function index15()
    {
        $Branch=branch::leftjoin('course','branch.course_id','=','course.course_id')
        ->get();
        $course=Course::all();
        return view('dashboard/branch',compact('Branch','course'));
    }
    public function index16()
    {
        $course=Course::all();
        $Assessment_results=assessment_results::leftjoin('category','assessment_results.category_id','=','category.category_id')
        ->where('assessment_results.year_id',session()->get('year_id'))
        ->where('assessment_results.course_id',session()->get('usercourse'))
        ->get();
        $Category=category::all();
        $ccate=count($Category);
        $cAss=count($Assessment_results);
        $dis="";
        if($ccate==$cAss){
            $dis="disabled";
        }
        return view('dashboard/assessment_results',compact('Assessment_results','Category','dis','cAss','course'));
    }
    public function index17()
    {
        return view('dashboard/dashboard');
    }
    public function index18()
    {
        $user=auth()->user();
        $user_id=$user->id;
        $data=User::leftjoin('user_group','users.user_group_id','=','user_group.user_group_id')
        ->leftjoin('course','users.user_course','=','course.course_id')
        ->where('id',$user_id)
        ->get();
        return view('dashboard/profile',compact('data'));
    }
    public function index19()
    {
        $tc_course= User::leftjoin('course_teacher','users.id','=','course_teacher.user_id')
         ->where('users.user_course',session()->get('usercourse'))
         ->where('course_teacher.year_id',session()->get('year_id'))
         ->get();
        $tc=User::where('user_course',session()->get('usercourse'))
        ->paginate(10);
        return view('dashboard/tc_course',compact('tc_course','tc'));
    }
    public function index20()
    {
        $tc_course= instructor::leftjoin('users','instructor.user_id','=','users.id')
         ->where('instructor.course_id',session()->get('usercourse'))
         ->where('instructor.year_id',session()->get('year_id'))
         ->get();
        $tc=User::where('user_course',session()->get('usercourse'))
        ->paginate(10);
        return view('dashboard/instructor1',compact('tc_course','tc'));
    }
    public function index21()
    {
        $getusergroup=User::where('user_course',session()->get('usercourse'))
        ->get();
        $role=GroupMenu::all();
        $getper=rolepermission::leftjoin('menu','role_permission.m_id','=','menu.m_id')
         ->get();
         $user=auth()->user();
        $user_group=$user->user_group_id;
        $rolepermiss=rolepermission::where('user_group_id',$user_group)->get();

        session()->put('roleper',$rolepermiss);
        return view('dashboard/addindicator',compact('getusergroup','role','getper'));
    }
    public function index22()
    {
        $tc_course= course_responsible_teacher::leftjoin('users','course_responsible_teacher.user_id','=','users.id')
         ->where('course_responsible_teacher.course_id',session()->get('usercourse'))
         ->where('course_responsible_teacher.year_id',session()->get('year_id'))
         ->get();
        $tc=User::where('user_course',session()->get('usercourse'))
        ->paginate(10);
        return view('dashboard/crt',compact('tc_course','tc'));
    }
}
