@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
           <h4>ความก้าวหน้าของการดำเนินงานตามแผนที่เสนอในรายงานของปีที่ผ่านมา</h4></br>
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
              <br><br><b><h4>ข้อเสนอในการพัฒนาหลักสูตร</h4></b>
              @foreach($querydevelopment_proposal as $key=>$value)
              <b>{{$key+1}}. {{$value['topic']}}</b><br>
              @foreach($value->development_proposal_detail as $row)
              - {{$row['detail']}}<br>
              @endforeach
              @endforeach

              <h4>แผนปฏิบัติการใหม่ สำหรับปี {{$year}}</h4></br>
              <table class="table table-bordered" >
                <tbody><tr>
                  <th width="30%" class="text-center" >แผนการดำเนินการ</th>
                  <th width="20%" class="text-center">กำหนดเวลาที่แล้วเสร็จ</th>
                  <th width="20%" class="text-center" >ผู้รับผิดชอบ</th>
                </tr>
                <tr></tr>
                @foreach($querynewstrength as $key=>$value)
              <tr>
                  <td >{{$key+1}}) {{$value['composition']}}</td>
                  <td >{{$value['strength']}}</td>
                  <td >{{$value['should_develop']}}</td>
              </tr>
                @endforeach
              </tbody></table>
</div></div>
              @endsection
