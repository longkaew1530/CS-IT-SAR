@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
            <br><br><b><h4>ประสิทธิผลของกลยุทธ์การสอน</h4></b><br><br>
              <table class="table table-bordered" >
                <tbody><tr>
                  <th width="30%" class="text-center" >มาตรฐานผลการเรียนรู้</th>
                  <th width="30%" class="text-center">สรุปข้อคิดเห็นของผู้สอน และข้อมูลป้อนกลับจากแหล่งต่าง ๆ </th>
                  <th width="30%" class="text-center" >แนวทางแก้ไขปรับปรุง</th>
                </tr>
                <tr></tr>
                @foreach($effec as $value)
              <tr>
                  <td >{{$value['learning_standards']}}</td>
                  <td >{{$value['comment']}}</td>
                  <td >{{$value['solution']}}</td>
              </tr>
                @endforeach
              </tbody></table>
</div></div>
              @endsection
