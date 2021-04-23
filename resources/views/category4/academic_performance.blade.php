@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
            
                            @if($checkedit!="")<a href="/getacademic_performance" class="btn btn-warning fr"><i class='fa fas fa-edit'></i></a>@endif
                            <h4>การวิเคราะห์รายวิชาที่มีผลการเรียนที่ไม่ปกติ</h4></b>
            <table class="table table-bordered" >
                <tbody><tr>
                  <th width="10%" class="text-center">รหัส ชื่อวิชา</th>
                  <th width="10%" class="text-center">ภาคการศึกษา</th>
                  <th width="10%" class="text-center">ความผิดปกติ</th>
                  <th width="10%" class="text-center">การตรวจสอบ</th>
                  <th width="10%" class="text-center">เหตุที่ทำให้ผิดปกติ</th>
                  <th width="10%" class="text-center">มาตรการแก้ไข</th>
                </tr>
                @if($academic!="[]")
                @foreach($academic as $value)
              <tr>
                <td>{{$value['code_name']}}
                </td>
                <td>{{$value['term']}}
                </td>
                <td>{{$value['anomaly']}}
                </td>
                <td>{{$value['tocheck']}}
                </td>
                <td>{{$value['reason']}}
                </td>
                <td>{{$value['plan_update']}}
                </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td>-
                </td>
                <td>-
                </td>
                <td>-
                </td>
                <td>-
                </td>
                <td>-
                </td>
                <td>-
                </td>
              </tr>
              @endif
              </tbody></table>
                               </div>
</div></div>
              @endsection
