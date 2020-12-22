@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
            <br><br><b><h4>รายวิชาที่ไม่ได้เปิดสอนในปีการศึกษา</h4></b><br><br>
            <table class="table table-bordered" >
                <tbody><tr>
                  <th width="20%" class="text-center">รหัส ชื่อวิชา</th>
                  <th width="20%" class="text-center">ภาค/ปีการศึกษา</th>
                  <th width="20%" class="text-center">เหตุผลที่ไม่เปิดสอน</th>
                  <th width="20%" class="text-center">มาตรการที่ดำเนิน</th>
                </tr>
                @foreach($ccr as $value)
              <tr>
                <td><b>{{$value['course_code']}}</b><br>
                       {{$value['course_code']}}
                </td>
              </tr>
              @endforeach
              </tbody></table>
</div></div>
              @endsection
