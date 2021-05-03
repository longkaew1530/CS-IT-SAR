@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
  <a href="/addnewstrength" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>
            <div class="box-body">
              <h4>แผนปฏิบัติการใหม่ สำหรับปี {{ Session::get('year')}}</h4></br>
              <table class="table table-bordered" >
                <tbody><tr>
                  <th width="30%" class="text-center" >แผนการดำเนินการ</th>
                  <th width="20%" class="text-center">กำหนดเวลาที่แล้วเสร็จ</th>
                  <th width="20%" class="text-center" >ผู้รับผิดชอบ</th>
                </tr>
                <tr></tr>
                @if($querynewstrength!="[]")
                @foreach($querynewstrength as $key=>$value)
              <tr>
                  <td >{{$key+1}}) {{$value['composition']}}</td>
                  <td >{{$value['strength']}}</td>
                  <td > @if($checkedit!="")<a href="/getnewstrength/{{$value['id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>@endif
                  {{$value['should_develop']}}</td>
              </tr>
                @endforeach
                @else
                <tr>
                  <td >-</td>
                  <td >-</td>
                  <td >-</td>
              </tr>
                @endif
              </tbody></table>
</div></div>
              @endsection
