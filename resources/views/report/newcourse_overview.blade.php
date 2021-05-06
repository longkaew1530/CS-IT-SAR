@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-header">
              <h3 class="box-title">รายงานผลการดำเนินงานในภาพรวมของหลักสูตร</h3>
            </div>
            <table class="table table-bordered ">
                <tbody><tr>
                  <th width="25%" class="text-center">องค์ประกอบที่</th>
                  <th width="5%" class="text-center">คะแนนผ่าน</th>
                  <th width="5%" class="text-center">จำนวนตัวบ่งชี้</th>
                  <th width="10%"class="text-center">I</th>
                  <th width="10%"  class="text-center">P</th>
                  <th width="10%" class="text-center">O</th>
                  <th width="10%" class="text-center">คะแนนเฉลี่ย</th>
                  <th width="40%" >ผลการประเมิน<br>0.01-2.00 ระดับคุณภาพน้อย<br>2.01-3.00 ระดับคุณภาพปานกลาง<br>3.01-4.00 ระดับคุณภาพดี<br>4.01-5.00 ระดับคุณภาพดีมาก</th>
                </tr>
                @foreach($getall as $key=>$value)
                <tr>
                <td>องค์ประกอบที่ {{$key+1}} {{$value['name']}}</td>
                @if($key+1==1)
                <td colspan="6" class="text-center">{{$data[0]['o']}}</td>
                <?php 
                if($data[0]['o']==="ผ่านการประเมิน")
                {
                    $gett="หลักสูตรได้มาตรฐาน";
                }
                else if($data[0]['o']==="ไม่ผ่านการประเมิน"){
                  $gett="หลักสูตรไม่ได้มาตรฐาน";
                }
                else{
                  $gett="";
                }
                ?>
                <td class="text-center"><b>{{$gett}}</b></td>
                @else
                @if($key+1==2)
                <td rowspan="6" class="text-center"></td>
                @endif
                <td  class="text-center">{{$data[$key]['cindi']}}</td>
                <td class="text-center">@if(isset($data[$key]['i'])){{$data[$key]['i']}}@else-@endif</td>
                <td class="text-center">@if(isset($data[$key]['p'])){{$data[$key]['p']}}@else-@endif</td>
                <td class="text-center">@if(isset($data[$key]['o'])){{$data[$key]['o']}}@else-@endif</td>
                <td class="text-center">@if(isset($data[$key]['avr']))<b>{{$data[$key]['avr']}}</b>@else-@endif</td>
                <td class="text-center">@if(isset($data[$key]['result']))<b>{{$data[$key]['result']}}</b>@endif</td>
                @endif
                </tr>
                @endforeach
                <tr>
                  <td class="text-center"><b>รวม</b></td>
                  <td class="text-center"><b>{{$data[0]['cindiall']}}</b></td>
                  <td class="text-center"><b>{{$data[0]['resultindicatori']}}</b></td>
                  <td class="text-center"><b>{{$data[0]['resultindicatorp']}}</b></td>
                  <td class="text-center"><b>{{$data[0]['resultindicatoro']}}</b></td>
                  <td rowspan="2" class="text-center"><b>{{$data[0]['avgall']}}</b></td>
                  <td rowspan="2" class="text-center"><b>@if($data[0]['resultavg']!=""){{$data[0]['resultavg']}}@endif</b></td>
                </tr>
                <tr>
                  <td colspan="3" class="text-center">ผลการประเมิน</td>
                  <td class="text-center"><b>{{$data[0]['resultipo1']}}</b></td>
                  <td class="text-center"><b>{{$data[0]['resultipo2']}}</b></td>
                  <td class="text-center"><b>{{$data[0]['resultipo3']}}</b></td>
                </tr>
              </tbody></table>  
</div></div>
              @endsection
