@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
            
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
                        @foreach($value->indicator5_4 as $row)
                            {!!$row['performance']!!}<br><br>          
                        @endforeach
                    </td>
                        <td class="text-center">
                        @foreach($value->indicator5_4 as $row)
                            @if($row['status']==1)
                            <i class="fa fa-check "></i>
                            @endif
                        @endforeach
                        </td>
                        
                        <td class="text-center">
                        @foreach($value->indicator5_4 as $row)
                            @if($row['status']==0)
                            <i class="fa fa-check"></i>
                            @endif
                            @endforeach
                        </td>
                        <td>
                        <?php $getcount=count($value->indicator5_4);?>
                                @if($getcount!=0)
                                @foreach($value->indicator5_4 as $row)
                                @if($checkedit)<a href="/getindicator5_4/{{$row['id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i></a> @endif                                                                 
                                        @foreach($row->doc_indicator5_4 as $key2=>$row1)
                                        {{$id}}.{{$key+1}}-{{$key2+1}} {{$row1['doc_file']}}
                                        <br>
                                        @endforeach
                                 @endforeach
                                @else
                                @if($checkedit)<a href="/addindicator5-4/{{$value['id']}}" class="btn btn-success fr ml-1"><i class='fa fa-plus'></i></a>@endif
                                @endif
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
                    <?php
                    $get=0;
                    if($result!=0){
                      $get=$resultpassall*100/$result;
                    }
                     ?>
                    <?php $result1 = round($get)  ?>
                    <td class="text-center" colspan="3">{{$result1}}</td>
                </tr>
              </tbody></table>
</div>
<div class="box-body">

            <ins>ผลการประเมินตนเอง</ins>
            <table class="table table-bordered text-center">
                <tbody><tr>
                  <th width="30%" >ตัวบ่งชี้</th>
                  <th width="20%">เป้าหมาย</th>
                  @if($per1!=null)
                      <th colspan="2" width="20%">ผลการดำเนินงาน</th>
                  @else
                      <th  width="20%">ผลการดำเนินงาน</th>
                  @endif
                  <th width="20%">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @if($inc!="[]")
                @foreach($inc as $row)
                
                <tr>
                  <td rowspan="2">ตัวบ่งชี้ที่ {{$row['Indicator_id']." ".$row['Indicator_name']}}</td>           
                  <td rowspan="2">{{$row['target']}}</td>
                  @if($per1!=null)
                    <td >{{$row['performance1']}}</td>
                  @endif  
                  <td rowspan="2">{{$row['performance3']}}</td>
                  <td rowspan="2">
                  @if($checkedit!="")<a href="/getself_assessment_results2/5.4" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>@endif
                  {{$row['score']}}</td>
                </tr>
                <tr>
                @if($per1!=null)
                    <td >{{$row['performance2']}}</td>
                  @endif  
                </tr>
                <tr>
                @endforeach
                @else
                <tr>
                  <td rowspan="2">ตัวบ่งชี้ที่ {{$id}} {{$name}}</td>           
                  <td rowspan="2"></td>
                  @if($per1!=null)
                    <td ></td>
                  @endif  
                  <td rowspan="2"></td>
                  <td rowspan="2">@if($checkedit!="")<a href="/getself_assessment_results/5.4" class="btn btn-success fr ml-1"><i class='fa fa-plus'></i> เพิ่มข้อมูล</a>@endif</td>
                </tr>
                <tr>
                @if($per1!=null)
                    <td ></td>
                  @endif  
                </tr>
                <tr>
                @endif
              </tbody></table>
            </div>
</div>
              @endsection
