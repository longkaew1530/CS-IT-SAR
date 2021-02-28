@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
            <a href="/addstrengths_summary" class="btn btn-success fr ml-1"><i class='fa fa-plus'></i> เพิ่มข้อมูล</a>
              <h4>3.  สรุปจุดแข็ง จุดที่ควรพัฒนา และแนวทางการพัฒนา</h4></br>
              @foreach($querynewstrength as $key=>$value)
              @foreach($value->category7_strengths_summary as $row)
              <b>องค์ประกอบที่ {{$value['id']}} {{$value['name']}}</b><br>
              <table class="table table-bordered" >
                <tbody><tr>
                  <th width="30%" class="text-center" >จุดแข็ง</th>
                  <th width="30%" class="text-center">จุดที่ควรพัฒนา</th>
                  <th width="30%" class="text-center" >แนวทางการพัฒนา</th>
                </tr>
                <tr></tr>
               
              <tr>
                  <td >
                  {!!$row['strength']!!}</td>
                  <td >{!!$row['points_development']!!}</td>
                  <td ><a href="/getstrengths_summary/{{$row['id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>{!!$row['development_approach']!!}</td>
              @endforeach
              </tr>
              </tbody></table>
              @endforeach
</div></div>
              @endsection
