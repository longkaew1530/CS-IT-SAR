@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
            @if($checkedit!="")<a href="/addactivity" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่มข้อมูล</a>@endif
            <h4 >กิจกรรมการพัฒนาวิชาชีพของอาจารย์และบุคลากรสายสนับสนุน</h4></b>
            <table class="table table-bordered" >
                <tbody ><tr>
                  <th width="25%" class="text-center" rowspan="2">กิจกรรมที่จัดหรือเข้าร่วม</th>
                  <th  class="text-center" colspan="2">จำนวน</th>
                  <th  class="text-center" colspan="2" rowspan="2">สรุปข้อคิดเห็น และประโยชน์ที่ผู้เข้าร่วมกิจกรรมได้รับ</th>
                </tr>
                  <tr>
                  <th width="10%" class="text-center">อาจารย์</th>
                  <th width="10%" class="text-center">บุคลากรสายสนับสนุน</th>
                  </tr>
                  @if($activity!="[]")
                @foreach($activity as $key=>$value)
                <tr>
                    <td >{!!$value['organized_activities']!!}</td>
                    <td class="text-center">
                            @if($value['status']==1)
                            <i class="fa fa-check "></i>
                            @endif
                    </td>
                    <td class="text-center">
                            @if($value['status']==0)
                            <i class="fa fa-check "></i>
                            @endif
                    </td>
                    <td>@if($checkedit!="")<a href="/getactivity/{{$value['id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i>แก้ไขข้อมูล</a>@endif{!!$value['comment']!!}
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td class="text-center">-</td>
                    <td class="text-center">
                           -
                    </td>
                    <td class="text-center">
                            -
                    </td>
                    <td class="text-center">-
                    </td>
                </tr>
                @endif
              </tbody></table><br><br>
          

</div></div>
              @endsection
