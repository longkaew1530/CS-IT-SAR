@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body"><h4 >กิจกรรมการพัฒนาวิชาชีพของอาจารย์และบุคลากรสายสนับสนุน</h4></b><br><br>
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
                @foreach($activity as $key=>$value)
                <tr>
                    <td >{{$value['organized_activities']}}</td>
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
                    <td>{{$value['comment']}}</td>
                </tr>
                @endforeach
              </tbody></table><br><br>
          

</div></div>
              @endsection
