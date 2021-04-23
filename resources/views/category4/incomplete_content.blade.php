@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
            @if($checkedit!="")<a href="/getincomplete_content" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>@endif
            <h4>รายวิชาที่สอนเนื้อหาไม่ครบในปีการศึกษา</h4></b>
            <table class="table table-bordered" >
                <tbody><tr>
                  <th width="20%" class="text-center">รหัส ชื่อวิชา</th>
                  <th width="20%" class="text-center">ภาค/ปีการศึกษา</th>
                  <th width="20%" class="text-center">หัวข้อที่ขาด</th>
                  <th width="20%" class="text-center">เหตุผลที่ไม่เปิดสอน</th>
                  <th width="20%" class="text-center">มาตรการที่ดำเนิน</th>
                </tr>
                @if($academic!="[]")
                @foreach($academic as $value)
              <tr>
                <td>{{$value['code_name']}}
                </td>
                <td>{{$value['term']}}
                </td>
                <td>{{$value['topic']}}
                </td>
                <td>{{$value['untraceable']}}
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
              </tr>
              @endif
              </tbody></table>
</div></div>
              @endsection
