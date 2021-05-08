@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
              <h4>สรุปจุดแข็ง จุดที่ควรพัฒนา และแนวทางการพัฒนา</h4></br>
              @foreach($querynewstrength as $key=>$value)
                  <b>องค์ประกอบที่ {{$value['id']}} {{$value['name']}}</b><br>
                  <table class="table table-bordered" >
                    <tbody><tr>
                      <th width="30%" class="text-center" >จุดแข็ง</th>
                      <th width="30%" class="text-center">จุดที่ควรพัฒนา</th>
                      <th width="30%" class="text-center" >แนวทางการพัฒนา</th>
                    </tr>
                    <tr></tr>
                    @if($value->category7_strengths_summary!="[]")
                    @foreach($value->category7_strengths_summary as $row)
                    <tr>
                      <td>{!!$row['strength']!!}</td>
                      <td>{!!$row['points_development']!!}</td>
                      <td>
                      @if($checkedit!="")<a href="/getstrengths_summary/{{$row['id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>@endif
                      {!!$row['development_approach']!!}
                      </td>
                  
                   </tr>
                   @endforeach
                   @else
                   <tr>
                      <td>-</td>
                      <td>-</td>
                      <td>
                      @if($checkedit!="")<a href="/addstrengths_summary/{{$value['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                      -
                      </td>
                  
                   </tr>
                   @endif
              </tbody></table><br>
              @endforeach
</div></div>
              @endsection
