@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
            @if($factor!="[]"&&$checkedit!="")<a href="/getindicator2_2/{{$factor[0]['id']}}" class="btn btn-warning fr "><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>@endif
            <h3><li ><b>ร้อยละของบัณฑิตปริญญาตรีที่ได้งานทำหรือประกอบอาชีพอิสระภายใน 1 ปี (ตัวบ่งชี้ 2.2)</b></li></h3>
            <ins>ผลการดำเนินงาน</ins>
            <table class="table table-bordered">
                <tbody><tr>
                  <th width="50%" class="text-center">ข้อมูลพื้นฐาน</th>
                  <th width="10%" class="text-center">จำนวน</th>
                  <th width="10%" class="text-center">ร้อยละ</th>
                </tr>
                @foreach($factor as $value)
                <tr>
                <td>จำนวนบัณฑิตทั้งหมด</td>
                <td class="text-center">@if($value['total']!=0){{$value['total']}}@else-@endif</td>
                <td class="text-center">@if($value['totalpersen']!=0){{$value['totalpersen']}}@else-@endif</td>
                </tr>
               
                <tr>
                <td >จำนวนบัณฑิตที่ตอบแบบสำรวจ</td>
                <td class="text-center">@if($value['answer']!=0){{$value['answer']}}@else-@endif</td>
                <td class="text-center">@if($value['answerpersen']!=0){{$value['answerpersen']}}@else-@endif</td>
                </tr>
                
                <tr>
                <td >จำนวนบัณฑิตที่ได้งานทำหลังสำเร็จการศึกษา<br>
                (ไม่นับรวมผู้ประกอบอาชีพอิสระ)<br>
                    - ตรงสาขาที่เรียน<br>
                    - ไม่ตรงสาขาที่เรียน
                </td>
                <td class="text-center">@if($value['job']!=0){{$value['job']}}@else-@endif<br><br>
                @if($value['straight_line']!=0){{$value['straight_line']}}@endif<br>
                @if($value['not_straight_line']!=0){{$value['not_straight_line']}}@endif
                </td>
                <td class="text-center">@if($value['jobpersen']!=0){{$value['jobpersen']}}@else-@endif<br><br>
                @if($value['straight_linepersen']!=0){{$value['straight_linepersen']}}@endif<br>
                @if($value['not_straight_linepersen']!=0){{$value['not_straight_linepersen']}}@endif
                </td>
                </tr>
                <tr>
                <td>จำนวนบัณฑิตที่ประกอบอาชีพอิสระ</td>
                <td class="text-center">@if($value['freelance']!=0){{$value['freelance']}}@else-@endif</td>
                 <td class="text-center">@if($value['freelancepersen']!=0){{$value['freelancepersen']}}@else-@endif</td>
                </tr>
                
                <tr>
                <td>จำนวนผู้สำเร็จการศึกษาที่มีงานทำก่อนเข้าศึกษา</td>
                <td class="text-center">@if($value['before']!=0){{$value['before']}}@else-@endif</td>
                <td class="text-center">@if($value['beforepersen']!=0){{$value['beforepersen']}}@else-@endif</td>
                </tr>
                <tr>
                <td>จำนวนบัณฑิตที่ศึกษาต่อ</td>
                <td class="text-center">@if($value['continue_study']!=0){{$value['continue_study']}}@else-@endif</td>
                <td class="text-center">@if($value['continue_studypersen']!=0){{$value['continue_studypersen']}}@else-@endif</td>
                </tr>
                <tr>
                <td>จำนวนบัณฑิตที่อุปสมบท</td>
                <td class="text-center">@if($value['ordain']!=0){{$value['ordain']}}@else-@endif</td>
                <td class="text-center">@if($value['ordainpersen']!=0){{$value['ordainpersen']}}@else-@endif</td>
                </tr>
                <tr>
                <td>จำนวนบัณฑิตที่เกณฑ์ทหาร</td>
                <td class="text-center">@if($value['soldier']!=0){{$value['soldier']}}@else-@endif</td>
                <td class="text-center">@if($value['soldierpersen']!=0){{$value['soldierpersen']}}@else-@endif</td>
                </tr>
                <tr>
                <td>จำนวนบัณฑิตที่ไม่มีงานทำ</td>
                <td class="text-center">@if($value['unemployed']!=0){{$value['unemployed']}}@else-@endif</td>
                <td class="text-center">@if($value['unemployedpersen']!=0){{$value['unemployedpersen']}}@else-@endif</td>
                </tr>
                @endforeach
              </tbody></table>
              <div class="mt-3"><b>การวิเคราะผลที่ได้</b><br>
              @if($factor!="[]"){!!$factor[0]['result']!!}@endif</div>
              
</div>
            <div class="box-body">
            <ins>ผลการประเมินตนเอง</ins>
            <table class="table table-bordered">
                <tbody><tr>
                  <th width="30%" class="text-center">ตัวบ่งชี้</th>
                  <th width="15%" class="text-center">เป้าหมาย</th>
                  @if($per1!=null)
                      <th colspan="2" width="15%" class="text-center">ผลการดำเนินงาน</th>
                  @else
                      <th  width="15%" class="text-center">ผลการดำเนินงาน</th>
                  @endif
                  <th width="15%" class="text-center">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @if($pdca!="[]")
                @foreach($pdca as $row)
                <tr>
                  <td rowspan="2" >ตัวบ่งชี้ที่ {{$row['Indicator_id']." ".$row['Indicator_name']}}</td>           
                  <td rowspan="2" class="text-center">{{$row['target']}}</td>
                  @if($per1!=null)
                    <td class="text-center">{{$row['performance1']}}</td>
                  @endif  
                  <td rowspan="2" class="text-center">{{$row['performance3']}}</td>
                  <td rowspan="2" class="text-center">{{$row['score']}}</td>
                </tr>
                <tr>
                @if($per1!=null)
                    <td class="text-center">{{$row['performance2']}}</td>
                  @endif  
                </tr>
                <tr>
                @endforeach
                @else
                <tr>
                  <td rowspan="2" >ตัวบ่งชี้ที่ {{$id}} {{$name}}</td>           
                  <td rowspan="2" class="text-center"></td>
                  @if($per1!=null)
                    <td class="text-center"></td>
                  @endif  
                  <td rowspan="2" class="text-center"></td>
                  <td rowspan="2" class="text-center"></td>
                </tr>
                <tr>
                @if($per1!=null)
                    <td class="text-center"></td>
                  @endif  
                </tr>
                <tr>
                @endif
              </tbody></table>
            </div>
</div>
<style>
   .b{
     background-color:black;
     
   }
   .ml-1{
  margin-left:10px
}
.ml-2{
  margin-left:20px
}
.mt-3{
  margin-top:30px;
}
h3{
  font-size: 15px;
}
   </style>
              @endsection