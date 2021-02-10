@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-header">
              <h3 class="box-title">ผลการประเมินคุณภาพหลักสูตรรายตัวบ่งชี้</h3>
            </div>
            <table class="table table-bordered ">
                <tbody><tr>
                  <th width="50%" >ตัวบ่งชี้</th>
                  <th width="10%"class="text-center">เป้าหมาย</th>
                  <th colspan="2" width="20%" class="text-center">ผลการดำเนินงาน</th>
                  <th width="10%" class="text-center">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @foreach($getall as $key=>$value)
                @php
                $i = $key
                @endphp
                @foreach($pdca as $row)
                  @if($value['id']==$row['composition_id']&&$row['target']!=null)
                <tr>
                @if($i+1==$value['id'])
                  <td rowspan="2">
                  <ins><b>องประกอบที่ {{$value['id']}}{{$value['name']}}</b></ins><br><br>
                  ตัวบ่งชี้ที่ {{$row['Indicator_id']." ".$row['Indicator_name']}}
                  </td>
                @else
                  <td rowspan="2">
                  ตัวบ่งชี้ที่ {{$row['Indicator_id']." ".$row['Indicator_name']}}
                  </td>
                @endif
                  <td class="text-center" rowspan="2">{{$row['target']}}</td>  
                  @if($row['performance1']!=null)<td class="text-center" >{{$row['performance1']}}</td>
                  <td rowspan="2" class="text-center">{{$row['performance3']}}</td>
                  @else
                  <td colspan="2" class="text-center">{{$row['performance3']}}</td> 
                  @endif
                  
                  <td class="text-center" rowspan="2">{{$row['score']}}</td> 
                </tr>
                <tr>
                @if($row['performance1']!=null)
                    <td class="text-center">{{$row['performance2']}}</td>
                  @endif  
                </tr>
                  @php
                  $i++
                  @endphp
                  @endif
                  @endforeach      
                <tr>
                @endforeach
              </tbody></table>  
</div></div>
              @endsection
