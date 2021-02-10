@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
            <a href="/addindicator5-4" class="btn btn-success fr ml-1"><i class='fa fa-plus'></i> เพิ่มข้อมูล</a>
           <b><h4>ผลการดำเนินงานหลักสูตรตามกรอบมาตรฐานคุณวุฒิระดับอุดมศึกษาแห่งชาติ (ตัวบ่งชี้ที่ 5.4)</h4></b><br>
            <table class="table table-bordered" >
                <tbody ><tr>
                  <th  class="text-center" colspan="3">ผลการดำเนินงานตามกรอบมาตรฐานคุณวุฒิ</th>
                  <th width="20%" class="text-center" rowspan="2">หลักฐานอ้างอิง</th>
                </tr>
                <tr>
                  <th  class="text-center">ดัชนีบ่งชี้ผลการดำเนินงาน<br>(Key performance indicators)</th>
                  <th width="10%" class="text-center">เป็นไปตามเกณฑ์</th>
                  <th width="10%" class="text-center">ไม่เป็นไปตามเกณฑ์</th>
                </tr>
                @foreach($indi as $key=>$value)
                <tr>
                    <td ><b>{{($key + 1)}}) {{$value['name']}}</b><br>
                        <ins>ผลการดำเนินงาน</ins><br>
                        @foreach($perfor as $row)
                        @if($row['category']==$value['id'])
                            {!!$row['performance']!!}<br><br>
                        @endif
                        @endforeach
                    </td>
                        <td class="text-center">
                        @foreach($perfor as $row)
                            @if($row['status']==1&&$row['category']==$value['id'])
                            <i class="fa fa-check "></i>
                            @endif
                        @endforeach
                        </td>
                        <td class="text-center">
                        @foreach($perfor as $row)
                            @if($row['status']==0&&$row['category']==$value['id'])
                            <i class="fa fa-check"></i>
                            @endif
                        @endforeach
                        </td>
                        <td>
                        
                        @foreach($perfor as $row)
                            @if($row['category']==$value['id'])
                            <a href="/getindicator5_4/{{$row['id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i></a>
                                @foreach($row->doc_indicator5_4 as $row1)
                                -{{$row1['doc_name']}}
                                <br>
                                @endforeach
                                
                            @endif
                        @endforeach
                        </td>
                </tr>
                @endforeach
                <tr>
                    <td class="text-center">รวมตัวบ่งชี้ในปีนี้</td>
                    <td class="text-center" colspan="3">{{$result}}</td>
                </tr>
                <tr>
                    <td class="text-center">จำนวนตัวบ่งชี้ที่ดำเนินการผ่านเฉพาะตัวบ่งชี้ที่ 1-5</td>
                    <td class="text-center" colspan="3">{{$resultpass1_5}}</td>
                </tr>
                <tr>
                    <td class="text-center">ร้อยละของตัวบ่งชี้ 1-5 </td>
                    <td class="text-center" colspan="3">{{$resultpass1_5persen}}</td>
                </tr>
                <tr>
                    <td class="text-center">จำนวนตัวบ่งชี้ในปีนี้ที่ดำเนินการผ่าน</td>
                    <td class="text-center" colspan="3">{{$resultpassall}}</td>
                </tr>
                <tr>
                    <td class="text-center">ร้อยละของตัวบ่งชี้ทั้งหมดในปีนี้</td>
                    <td class="text-center" colspan="3"></td>
                </tr>
              </tbody></table>
</div></div>
              @endsection
