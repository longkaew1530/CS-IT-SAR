@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body"><h4 class="text-center">คุณภาพการสอน</h4></b><br><br>
            <b>การประเมินรายวิชาที่เปิดสอนในปีที่รายงาน<br>
            รายวิชาที่มีการประเมินคุณภาพการสอน และแผนการปรับปรุงจากผลการประเมิน</b><br>
            @foreach($teachquagroup as $row)
            <b>นักศึกษาชั้นปี {{$row['student_year']}} เข้าปี {{$row['stu_year_of_admission']}}</b><br>
            <table class="table table-bordered" >
                <tbody ><tr>
                  <th width="25%" class="text-center" rowspan="2">รหัส ชื่อวิชา</th>
                  <th width="15%" class="text-center" rowspan="2">ภาคการศึกษา</th>
                  <th  class="text-center" colspan="2">ผลการประเมินโดยนักศึกษา</th>
                  <th  class="text-center" rowspan="2">แผนการปรับปรุง</th>
                </tr>
                  <tr>
                  <th width="10%" class="text-center">มี</th>
                  <th width="10%" class="text-center">ไม่มี</th>
                  </tr>
                @foreach($teachqua as $key=>$value)
                <tr>
                    @if($value['student_year']==$row['student_year'])
                    <td >{{$value['course_code']}} {{$value['course_name']}}</td>
                    <td class="text-center">{{$value['term']}}/{{$value['course_year']}}</td>
                    <td class="text-center">
                            @if($value['status']==1)
                            <i class="fa fa-check "></i>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($value['status']==0)
                            <i class="fa fa-check "></i>
                            @endif
                        </td>
                    <td>{{$row['description']}}</td>
                    @endif
                </tr>
                @endforeach
              </tbody></table><br><br>
              @endforeach
              <b>ผลการประเมินคุณภาพการสอนโดยรวม</b>
              @foreach($teachqua as $key=>$value)
              @if($value['result']!=null)
              <br>{{$value['result']}}
              @endif
              @endforeach
</div></div>
              @endsection
