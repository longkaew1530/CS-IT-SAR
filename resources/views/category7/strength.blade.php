@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
            <a href="/addstrength" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่มข้อมูล</a>
           <h4>ความก้าวหน้าของการดำเนินงานตามแผนที่เสนอในรายงานของปีที่ผ่านมา</h4>
              <table class="table table-bordered" >
                <tbody><tr>
                  <th width="30%" class="text-center" >แผนการดำเนินการ</th>
                  <th width="20%" class="text-center">กำหนดเวลาที่แล้วเสร็จ</th>
                  <th width="20%" class="text-center" >ผู้รับผิดชอบ</th>
                  <th width="20%" class="text-center" >ความสำเร็จของแผน/เหตุผลที่ไม่สามารถดำเนินการไม่สำเร็จ</th>
                </tr>
                <tr></tr>
                @if($querystrength!="[]")
                @foreach($querystrength as $key=>$value)
              <tr>
                  <td >{{$key+1}}) {{$value['composition']}}</td>
                  <td >{{$value['strength']}}</td>
                  <td >{{$value['should_develop']}}</td>
                  <td >@if($checkedit!="")<a href="/getstrength/{{$value['id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>@endif
                  {{$value['development_approach']}}</td>
              </tr>
                @endforeach
                @else
                <tr>
                  <td >-</td>
                  <td >-</td>
                  <td >-</td>
                  <td >-</td>
              </tr>
                @endif
              </tbody></table>
              </div>
</div></div>
              @endsection
