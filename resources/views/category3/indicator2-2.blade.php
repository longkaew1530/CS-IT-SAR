@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
            <a href="/getindicator2_2/{{$factor[0]['id']}}" class="btn btn-warning fr "><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>
            <h3><li ><b>ร้อยละของบัณฑิตปริญญาตรีที่ได้งานทำหรือประกอบอาชีพอิสระภายใน 1 ปี (ตัวบ่งชี้ 2.2)</b></li></h3>
            <ins>ผลการดำเนินงาน</ins>
            <table class="table table-bordered">
                <tbody><tr>
                  <th width="50%" class="text-center">ข้อมูลพื้นฐาน</th>
                  <th width="10%" class="text-center">จำนวน</th>
                  <th width="10%" class="text-center">ร้อยละ</th>
                  @foreach($factor as $value)
                </tr>
                <tr>
                <td>1. จำนวนบัณฑิตทั้งหมด</td>
                <td class="text-center">{{$value['total']}}</td>
                <td class="text-center">{{$value['totalpersen']}}</td>
                </tr>
               
                <tr>
                <td >2. จำนวนบัณฑิตที่ตอบแบบสำรวจ</td>
                <td class="text-center">{{$value['answer']}}</td>
                <td class="text-center">{{$value['answerpersen']}}</td>
                </tr>
                
                <tr>
                <td >3. จำนวนบัณฑิตที่ได้งานทำหลังสำเร็จการศึกษา<br>
                (ไม่นับรวมผู้ประกอบอาชีพอิสระ)<br>
                    - ตรงสาขาที่เรียน<br>
                    - ไม่ตรงสาขาที่เรียน
                </td>
                <td class="text-center">{{$value['job']}}<br><br>
                    {{$value['straight_line']}}<br>
                    {{$value['not_straight_line']}}
                </td>
                <td class="text-center">{{$value['jobpersen']}}<br><br>
                    {{$value['straight_linepersen']}}<br>
                    {{$value['not_straight_linepersen']}}
                </td>
                </tr>
                <tr>
                <td>4. จำนวนบัณฑิตที่ประกอบอาชีพอิสระ</td>
                <td class="text-center">{{$value['freelance']}}</td>
                 <td class="text-center">{{$value['freelancepersen']}}</td>
                </tr>
                
                <tr>
                <td>5. จำนวนผู้สำเร็จการศึกษาที่มีงานทำก่อนเข้าศึกษา</td>
                <td class="text-center">{{$value['before']}}</td>
                <td class="text-center">{{$value['beforepersen']}}</td>
                </tr>
                <tr>
                <td>6. จำนวนบัณฑิตที่ศึกษาต่อ</td>
                <td class="text-center">{{$value['continue_study']}}</td>
                <td class="text-center">{{$value['continue_studypersen']}}</td>
                </tr>
                <tr>
                <td>7. จำนวนบัณฑิตที่อุปสมบท</td>
                <td class="text-center">{{$value['ordain']}}</td>
                <td class="text-center">{{$value['ordainpersen']}}</td>
                </tr>
                <tr>
                <td>8. จำนวนบัณฑิตที่เกณฑ์ทหาร</td>
                <td class="text-center">{{$value['soldier']}}</td>
                <td class="text-center">{{$value['soldierpersen']}}</td>
                </tr>
                <tr>
                <td>9. จำนวนบัณฑิตที่ไม่มีงานทำ</td>
                <td class="text-center">{{$value['unemployed']}}</td>
                <td class="text-center">{{$value['unemployedpersen']}}</td>
                </tr>
              </tbody></table>
              <div class="mt-3"><b>การวิเคราะผลที่ได้</b><br>
              {!!$value['result']!!}</div>
              @endforeach
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
                @foreach($pdca as $row)
                @if($row['target']!="")
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
                @endif
                @endforeach
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