<?php

namespace App\Http\Controllers;
use App\User;
use App\PDCA;
use App\DocPDCA;
use App\Groupmenu;
use App\Course;
use App\category3_resignation;
use App\categoty_researh;
use App\ModelAJ\Research_results;
use App\Year;
use App\Tps;
use App\indicator4_3;
use App\publish_work;
use App\branch;
use App\indicator;
use App\indicator2_1;
use App\indicator2_2;
use App\category3_infostudent;
use App\defaulindicator;
use App\category3_infostudent_qty;
use App\year_acceptance;
use App\performance3_3;
use App\categorypdca;
use App\category3_GD;
use App\Menu;
use App\ModelAJ\category3_inforstudent;
use App\course_responsible_teacher;
use App\year_acceptance_graduate;
use App\category3_graduate;
use App\Educational_background;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class Category3Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function graduatesQTY()
    {
        $get=year_acceptance_graduate::where('course_id',session()->get('usercourse'))
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
       $checkedit="asdas";
        $getyear=category3_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_add',session()->get('year'))
        ->get();
        return view('category3/graduatesqty',compact('get','getinfo','getyear','getinfo2','gropby','checkedit'));
    }
    public function resignation()
    {
        $get=year_acceptance_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $getinfo=category3_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->get();
        $getyear=category3_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_add',session()->get('year'))
        ->get();
        $getinfo2=category3_infostudent::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
            ->get();
        $gropby=category3_graduate::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->groupBy('year_add')
        ->get();
        $re=category3_resignation::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_present',session()->get('year'))
        ->get();
        $checkedit="asd";
        return view('category3/resignation',compact('get','getinfo','getyear','getinfo2','gropby','re','checkedit'));
    }
    public function Studentsinfo()
    {
        $get=year_acceptance::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
            ->get();
        $getinfo=category3_infostudent::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->get();
            if(count($get)==0){
                $get="";
            }
            
        $getqty=category3_infostudent_qty::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $countnumber=count($getinfo);
        $checkedit="klkl";
        $checkinfo=category3_infostudent::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_add',session()->get('year'))
        ->get();
        return view('category3/infostudents',compact('checkinfo','get','getinfo','getqty','countnumber','checkedit'));
    }
    public function Impactfactors()
    {
        $factor=category3_GD::where('category_factor','ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา')
        ->where('branch_id',session()->get('branch_id'))
        ->where('course_id',session()->get('usercourse'))
         ->where('year_id',session()->get('year_id'))
        ->get();
        $checkedit="asdasd";
        return view('category3/Impactfactors',compact('factor','checkedit'));
    }
    public function Impactgraduation()
    {
        $factor=category3_GD::where('category_factor','ปัยจัยที่มีผลกระทบต่อการสำเร็จการศึกษา')
        ->where('branch_id',session()->get('branch_id'))
        ->where('course_id',session()->get('usercourse'))
         ->where('year_id',session()->get('year_id'))
         ->get();
         $checkedit="asdasd";
        return view('category3/Impactgraduation',compact('factor','checkedit'));
    }
    public function indicator2_1()
    {
        $factor=indicator2_1::where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
         ->where('year_id',session()->get('year_id'))
         ->get();
         $pdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
         ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',2.1)
        ->where('pdca.target','!=',null)
        ->get();
        $per1="ssssss";
        $getcategorypdca=defaulindicator::where('id',2)
        ->get();
        $name="";
        $id="";
        $checkedit="asdasd";
        foreach($getcategorypdca as $value)
        {
            $name=$value['Indicator_name'];
            $id=$value['Indicator_id'];
        }
        return view('category3/indicator2-1',compact('factor','pdca','per1','name','id','checkedit'));
    }
    public function assess()
    {
        $pdca=PDCA::leftjoin('indicator','pdca.Indicator_id','=','indicator.indicator_id')
        ->where('pdca.Indicator_id',$id)
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->get();
        $checkedit="asdasd";
        return view('category3/assessment',compact('pdca','checkedit'));
    }
    public function showassess($id)
    {
        $pdca=PDCA::leftjoin('indicator','pdca.Indicator_id','=','indicator.indicator_id')
        ->where('pdca.Indicator_id',$id)
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->get();
        $per1="";
        $checkedit="asdasd";
        foreach($pdca as $value)
        {
            $per1=$value['performance1'];
        }
        return view('category3/showassessment',compact('pdca','per1','checkedit'));
    }
    public function indicator2_2()
    {
        $factor=indicator2_2::where('course_id',session()->get('usercourse'))
         ->where('year_id',session()->get('year_id'))
         ->get();
         $pdca= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.Indicator_id',2.2)
        ->where('pdca.target','!=',null)
        ->get();
        $per1="ssssss";
        $checkedit="asdasd";
        return view('category3/indicator2-2',compact('factor','pdca','per1','checkedit'));
    }
    public function getpdca()
    {
        $menuname=Menu::where('m_id',$id)
        ->get();

        $pdca=PDCA::leftjoin('indicator','pdca.Indicator_id','=','indicator.indicator_id')
        ->where('pdca.Indicator_id',$menuname[0]['Indicator_id'])
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->get();
        $getcourse=Course::where('course_id',session()->get('usercourse'))
        ->get();
        return view('category3/pdca',compact('pdca','getcourse'));
    }
    public function showpdca($id)
    {   
        // $menuname=Menu::where('m_id',$id)
        // ->get();
        session()->put('idmenu',$id);
        $getcategorypdca=indicator::where('id',$id)
        ->get();
        $pdca=PDCA::leftjoin('indicator','pdca.Indicator_id','=','indicator.indicator_id')
        ->where('pdca.Indicator_id',$getcategorypdca[0]['Indicator_id'])
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->get();
        $getcourse=Course::where('course_id',session()->get('usercourse'))
        ->get();
        $getbranch=branch::where('branch_id',session()->get('branch_id'))
        ->get();
     
        $name="";
        $id="";
        ////ดึงผลการประเมินตนเอง ตัวบ่งชี้ที่ 1.1
        $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',$getcategorypdca[0]['Indicator_id'])
        ->where('pdca.target','!=',null)
        ->get();
        $tran=User::rightjoin('course_responsible_teacher','users.id','=','course_responsible_teacher.user_id')
        ->where('users.user_course',session()->get('usercourse'))
        ->where('users.user_branch',session()->get('branch_id'))
        ->where('course_responsible_teacher.year_id',session()->get('year_id'))
        ->get();
        $trc = course_responsible_teacher::join('year','course_responsible_teacher.year_id','=','year.year_id')
        ->where('course_responsible_teacher.course_id',session()->get('usercourse'))
        ->where('course_responsible_teacher.branch_id',session()->get('branch_id'))
        ->where('course_responsible_teacher.year_id',session()->get('year_id'))
        ->get();
        $category_re2 = Research_results::rightjoin('course_responsible_teacher','research_results.owner','=','course_responsible_teacher.user_id')
        ->where('course_responsible_teacher.year_id',session()->get('year_id'))
        ->where('course_responsible_teacher.course_id',session()->get('usercourse'))
        ->where('course_responsible_teacher.branch_id',session()->get('branch_id'))
        ->get();
        
        ///นับอาจารย์ผู้รีบผิดชอบหลักสูตร
        $count=count($trc);
        if(count($inc)==0){
            $inc="";
        }
        foreach($getcategorypdca as $value)
        {
            $name=$value['Indicator_name'];
            $id=$value['Indicator_id'];
        }
        $checkedit="asdsad";
        return view('category3/showpdca',compact('category_re2','count','pdca','name','id','getcourse','getcategorypdca','inc','checkedit','getbranch','tran'));
    }
    public function indicator3_3()
    {
        $in3_3=performance3_3::where('course_id',session()->get('usercourse'))
        ->where('year_id',session()->get('year_id'))
        ->get();
        $inc= PDCA::leftjoin('defaulindicator','pdca.indicator_id','=','defaulindicator.indicator_id')
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('pdca.branch_id',session()->get('branch_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.indicator_id',3.3)
        ->where('pdca.target','!=',null)
        ->get();
        $checkedit="asdasd";
        $getcategorypdca=defaulindicator::where('id',7)
        ->get();
        $name="";
        $id="";
        foreach($getcategorypdca as $value)
        {
            $name=$value['Indicator_name'];
            $id=$value['Indicator_id'];
        }
        return view('category3/perfoment3_3',compact('in3_3','inc','checkedit','name','id'));
    }
}
