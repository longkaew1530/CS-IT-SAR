@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
            @if($checkedit!="")<a href="/addeffectiveness" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่มข้อมูล</a>@endif
            <b><h4>ประสิทธิผลของกลยุทธ์การสอน</h4></b>
              <table class="table table-bordered" >
                <tbody><tr>
                  <th width="30%" class="text-center" >มาตรฐานผลการเรียนรู้</th>
                  <th width="30%" class="text-center">สรุปข้อคิดเห็นของผู้สอน และข้อมูลป้อนกลับจากแหล่งต่าง ๆ </th>
                  <th width="30%" class="text-center" >แนวทางแก้ไขปรับปรุง</th>
                </tr>
                <tr></tr>
                @if($effec!="[]")
                @foreach($effec as $value)
              <tr>
                  <td >{!!$value['learning_standards']!!}</td>
                  <td >{!!$value['comment']!!}</td>
                  <td >@if($checkedit!="")<a href="/geteffectiveness/{{$value['id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i>แก้ไขข้อมูล</a>@endif
                  {!!$value['solution']!!}</td>
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
