<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\PDCA;
use App\defaulindicator;
use App\composition;
use App\indicator;
use App\category;
use App\assessment_results;
use Exception;
class ReportController extends Controller
{
    public function overview()
    {
        $query=assessment_results::leftjoin('category','assessment_results.category_id','=','category.category_id')
        ->where('assessment_results.year_id',session()->get('year_id'))
        ->get();
            return view('report/overview',compact('query'));
    }
    public function instructor()
    {
            $instructor= User::leftjoin('instructor','users.id','=','instructor.user_id')
            ->where('users.user_course',session()->get('usercourse'))
            ->where('instructor.year_id',1)
            ->get();
            return view('report/instructor',compact('instructor'));
    }
    public function performance_summary()
    {
        $getall=composition::all();
        $indicator=defaulindicator::where('Indicator_id','!=',null)
        ->get();
        $pdca=indicator::leftjoin('pdca','indicator.Indicator_id','=','pdca.indicator_id')
        ->where('indicator.year_id',session()->get('year_id'))
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('target','!=',null)
        ->get();
        $per1="";
        foreach($pdca as $value)
        {
            $per1=$value['performance1'];
        }
            return view('report/performance_summary',compact('pdca','per1','getall','indicator'));
    }
    public function generateDocx()
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();


        $section = $phpWord->addSection();


        



        $section->addText($description);


        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path('helloWorld.docx'));
        } catch (Exception $e) {
        }


        return response()->download(storage_path('helloWorld.docx'));
    }
    public function download()
    {
        $query=assessment_results::leftjoin('category','assessment_results.category_id','=','category.category_id')
        ->where('assessment_results.year_id',session()->get('year_id'))
        ->get();
            return view('report/download',compact('query'));
    }
    public function course_overview()
    {
        $getall=composition::all();
        $indicator=defaulindicator::where('Indicator_id','!=',null)
        ->get();
        $pdca=defaulindicator::leftjoin('pdca','defaulindicator.Indicator_id','=','pdca.indicator_id')
        ->where('pdca.year_id',session()->get('year_id'))
        ->where('pdca.course_id',session()->get('usercourse'))
        ->where('target','!=',null)
        ->get();
        $per1="";
        $result1_1="";
        $result2_1="";
        $result2_1="";
        $result3_1="";
        $result3_2="";
        $result3_3="";
        $result4_1="";
        $result4_2="";
        $result4_3="";
        $result5_1="";
        $result5_2="";
        $result5_3="";
        $result5_4="";
        $result6_1="";
        foreach($pdca as $row){
            if($row['Indicator_id']==1.1){
                    if($row['score']=="ผ่านมาตรฐาน"){
                        $result1_1="ผ่านการประเมิน";
                    }
                    else{
                        $result1_1="ไม่ผ่านการประเมิน";
                    }
            }
            else if($row['Indicator_id']==2.1){
                $result2_1=$row['score'];
            }
            else if($row['Indicator_id']==2.2){
                $result2_2=$row['score'];
            }
            else if($row['Indicator_id']==3.1){
                $result3_1=$row['performance3'];
            }
            else if($row['Indicator_id']==3.2){
                $result3_2=$row['performance3'];
            }
            else if($row['Indicator_id']==3.3){
                $result3_3=$row['score'];
            }
            else if($row['Indicator_id']==4.1){
                $result4_1=$row['performance3'];
            }
            else if($row['Indicator_id']==4.2){
                $result4_2=$row['target'];
            }
            else if($row['Indicator_id']==4.3){
                $result4_3=$row['score'];
            }
            else if($row['Indicator_id']==5.1){
                $result5_1=$row['performance3'];
            }
            else if($row['Indicator_id']==5.2){
                $result5_2=$row['performance3'];
            }
            else if($row['Indicator_id']==5.3){
                $result5_3=$row['performance3'];
            }
            else if($row['Indicator_id']==5.4){
                $result5_4=$row['score'];
            }
            else if($row['Indicator_id']==6.1){
                $result6_1=$row['performance3'];
            }
        }
        $data[0]['o']=$result1_1;
        $data[1]['o']=($result2_1+$result2_2)/2;
        $data[1]['avr']=($result2_1+$result2_2)/2;
        $data[2]['p']=($result3_1+$result3_2)/2;
        $data[2]['o']=$result3_3;
        $data[2]['avr']=($result3_1+$result3_2+$result3_3)/3;
        $data[3]['i']=$result4_2;
        $data[3]['p']=$result4_1;
        $data[3]['o']=$result4_3;
        $data[3]['avr']=($result4_2+$result4_1+$result4_3)/3;
        $data[4]['p']=($result5_1+$result5_2+$result5_3)/3;
        $data[4]['o']=$result5_4;
        $data[4]['avr']=($result5_1+$result5_2+$result5_3+$result5_4)/4;
        $data[5]['p']=$result6_1;
        $data[5]['avr']=$result6_1;
        for($i = 1; $i <= 5; $i++){
            if($data[$i]['avr']>=0.01&&$data[$i]['avr']<=2.00){
                $data[$i]['result']="น้อย";
            }
            else if($data[$i]['avr']>=2.01&&$data[$i]['avr']<=3.00){
                $data[$i]['result']="ปานกลาง";
            }
            else if($data[$i]['avr']>=3.01&&$data[$i]['avr']<=4.00){
                $data[$i]['result']="ดี";
            }
            else if($data[$i]['avr']>=4.01&&$data[$i]['avr']<=5.00){
                $data[$i]['result']="ดีมาก";
            }
        }
        foreach($pdca as $value)
        {
            $per1=$value['performance1'];
        }
            return view('report/course_overview',compact('pdca','per1','getall','indicator','data'));
    }
}
