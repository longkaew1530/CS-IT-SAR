@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
            @if($checkedit!="")<a href="/getcourse_results" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>@endif
            <b><h4>สรุปผลรายวิชาที่เปิดสอนในภาค/ปีการศึกษา</h4></b>
              <table class="table table-bordered" >
                <tbody><tr>
                  <th width="25%" class="text-center" rowspan="3">รหัส ชื่อวิชา</th>
                  <th width="10%" class="text-center" rowspan="3">ภาค/ปีการศึกษา</th>
                  <th width="50%" class="text-center" colspan="7">การกระจายของระดับคะแนน(ร้อยละ)</th>
                  <th width="15%" class="text-center" colspan="2">จำนวนนักศึกษา</th>
                </tr>
                <tr>
                <th width="10%" class="text-center" rowspan="2">A</th>
                <th width="10%" class="text-center" rowspan="2">B+</th>
                <th width="10%" class="text-center" rowspan="2">B</th>
                <th width="10%" class="text-center" rowspan="2">C+</th>
                <th width="10%" class="text-center" rowspan="2">C</th>
                <th width="10%" class="text-center" rowspan="2">D</th>
                <th width="10%" class="text-center" rowspan="2">F</th>
                <th width="10%" class="text-center" rowspan="2">ลงทะเบียน</th>
                <th width="10%" class="text-center" rowspan="2">สอบผ่าน</th>
                </tr>
                <tr></tr>
                @if($ccr!="[]")
                @foreach($ccr as $key=>$value)
                @if($key>0)
              <tr>
                  <td>
                  {{$value['course_name']}}
                  </td>
                  <td class="text-center">{{$value['term_year']}}</td>
                  <td class="text-center">{{$value['a']}}</td>
                  <td class="text-center">{{$value['BB']}}</td>
                  <td class="text-center">{{$value['b']}}</td>
                  <td class="text-center">{{$value['CC']}}</td>
                  <td class="text-center">{{$value['c']}}</td>
                  <td class="text-center">{{$value['d']}}</td>
                  <td class="text-center">{{$value['f']}}</td>
                  <td class="text-center">{{$value['register']}}</td>
                  <td class="text-center">{{$value['pass_exam']}}</td>
              </tr>
              @endif
              @endforeach
              @else
              <tr>
                  <td>
                  -
                  </td>
                  <td class="text-center">-</td>
                  <td class="text-center">-</td>
                  <td class="text-center">-</td>
                  <td class="text-center">-</td>
                  <td class="text-center">-</td>
                  <td class="text-center">-</td>
                  <td class="text-center">-</td>
                  <td class="text-center">-</td>
                  <td class="text-center">-</td>
                  <td class="text-center">-</td>
              </tr>
              @endif
              </tbody></table>
</div></div>
              @endsection
