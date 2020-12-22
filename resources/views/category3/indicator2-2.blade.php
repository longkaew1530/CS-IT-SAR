@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">

<ins>ผลการดำเนินงาน</ins>
            <div class="box-body">
            <table class="table table-bordered ">
                <tbody><tr>
                  <th width="50%" class="text-center">ข้อมูลพื้นฐาน</th>
                  <th width="10%" class="text-center">จำนวน</th>
                  <th width="10%" class="text-center">ร้อยละ</th>
                  @foreach($factor as $value)
                </tr>
                
                <tr>
                <td>1. จำนวนบัณฑิตทั้งหมด</td>
                <td>{{$value['total']}}</td>
                <td>{{$value['totalpersen']}}</td>
                </tr>
               
                <tr>
                <td>2. จำนวนบัณฑิตที่ตอบแบบสำรวจ</td>
                <td>{{$value['answer']}}</td>
                <td>{{$value['answerpersen']}}</td>
                </tr>
                
                <tr>
                <td >3. จำนวนบัณฑิตที่ได้งานทำหลังสำเร็จการศึกษา<br>
                (ไม่นับรวมผู้ประกอบอาชีพอิสระ)<br>
                    - ตรงสาขาที่เรียน<br>
                    - ไม่ตรงสาขาที่เรียน
                </td>
                <td>{{$value['job']}}<br><br>
                    {{$value['straight_line']}}<br>
                    {{$value['not_straight_line']}}
                </td>
                <td>{{$value['jobpersen']}}<br><br>
                    {{$value['straight_linepersen']}}<br>
                    {{$value['not_straight_linepersen']}}
                </td>
                </tr>
                <tr>
                <td>4. จำนวนบัณฑิตที่ประกอบอาชีพอิสระ</td>
                <td>{{$value['freelance']}}</td>
                 <td>{{$value['freelancepersen']}}</td>
                </tr>
                
                <tr>
                <td>5. จำนวนผู้สำเร็จการศึกษาที่มีงานทำก่อนเข้าศึกษา</td>
                <td>{{$value['before']}}</td>
                <td>{{$value['beforepersen']}}</td>
                </tr>
                <tr>
                <td>6. จำนวนบัณฑิตที่ศึกษาต่อ</td>
                <td>{{$value['continue_study']}}</td>
                <td>{{$value['continue_studypersen']}}</td>
                </tr>
                <tr>
                <td>7. จำนวนบัณฑิตที่อุปสมบท</td>
                <td>{{$value['ordain']}}</td>
                <td>{{$value['ordainpersen']}}</td>
                </tr>
                <tr>
                <td>8. จำนวนบัณฑิตที่เกณฑ์ทหาร</td>
                <td>{{$value['soldier']}}</td>
                <td>{{$value['soldierpersen']}}</td>
                </tr>
                <tr>
                <td>9. จำนวนบัณฑิตที่ไม่มีงานทำ</td>
                <td>{{$value['unemployed']}}</td>
                <td>{{$value['unemployedpersen']}}</td>
                </tr>
              </tbody></table>
              <b>การวิเคราะผลที่ได้</b><br>
              {{$value['result']}}
              @endforeach
</div></div>
              @endsection
