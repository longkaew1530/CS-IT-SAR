@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
            <br><br><b><h4>การบริหารหลักสูตร</h4></b>
              <table class="table table-bordered" >
                <tbody><tr>
                  <th width="30%" class="text-center" >ปัญหาในการบริหารหลักสูตร</th>
                  <th width="30%" class="text-center">ผลกระทบของปัญหาต่อสัมฤทธิผลตามวัตถุประสงค์ของหลักสูตร</th>
                  <th width="30%" class="text-center" >แนวทางการป้องกันและแก้ไขปัญหาในอนาคต</th>
                </tr>
                <tr></tr>
                @foreach($coursemanage as $value)
              <tr>
                  <td >{{$value['problem']}}</td>
                  <td >{{$value['effect']}}</td>
                  <td >{{$value['solution']}}</td>
              </tr>
                @endforeach
              </tbody></table>
</div></div>
              @endsection
