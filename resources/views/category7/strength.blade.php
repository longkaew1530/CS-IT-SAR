@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
            <a href="/getstrength/{{$querystrength[0]['id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>
           <h4>ความก้าวหน้าของการดำเนินงานตามแผนที่เสนอในรายงานของปีที่ผ่านมา</h4>
              <table class="table table-bordered" >
                <tbody><tr>
                  <th width="30%" class="text-center" >แผนการดำเนินการ</th>
                  <th width="20%" class="text-center">กำหนดเวลาที่แล้วเสร็จ</th>
                  <th width="20%" class="text-center" >ผู้รับผิดชอบ</th>
                  <th width="20%" class="text-center" >ความสำเร็จของแผน/เหตุผลที่ไม่สามารถดำเนินการไม่สำเร็จ</th>
                </tr>
                <tr></tr>
                @foreach($querystrength as $key=>$value)
              <tr>
                  <td >{{$key+1}}) {{$value['composition']}}</td>
                  <td >{{$value['strength']}}</td>
                  <td >{{$value['should_develop']}}</td>
                  <td >{{$value['development_approach']}}</td>
              </tr>
                @endforeach
              </tbody></table>
              </div>
</div></div>
              @endsection
