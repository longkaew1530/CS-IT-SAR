@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
            <a href="/addcourse_manage" class="btn btn-success fr ml-1"><i class='fa fa-plus'></i> เพิ่มข้อมูล</a>
            <b><h4>การบริหารหลักสูตร</h4></b>
              <table class="table table-bordered" >
                <tbody><tr>
                  <th width="30%" class="text-center" >ปัญหาในการบริหารหลักสูตร</th>
                  <th width="30%" class="text-center">ผลกระทบของปัญหาต่อสัมฤทธิผลตามวัตถุประสงค์ของหลักสูตร</th>
                  <th width="30%" class="text-center" >แนวทางการป้องกันและแก้ไขปัญหาในอนาคต</th>
                </tr>
                <tr></tr>
                @foreach($coursemanage as $value)
              <tr>
                  <td >{!!$value['problem']!!}</td>
                  <td >{!!$value['effect']!!}</td>
                  <td ><a href="/getcourse_manage/{{$value['id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i></a>{!!$value['solution']!!}</td>
              </tr>
                @endforeach
              </tbody></table>
</div></div>
              @endsection
