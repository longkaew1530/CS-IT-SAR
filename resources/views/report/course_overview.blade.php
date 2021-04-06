@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-header">
              <h3 class="box-title">รายงานผลการดำเนินงานในภาพรวมของหลักสูตร</h3>
            </div>
            <table class="table table-bordered ">
                <tbody><tr>
                  <th width="30%" >องค์ประกอบ</th>
                  <th width="10%"class="text-center">I</th>
                  <th width="10%"  class="text-center">P</th>
                  <th width="10%" class="text-center">O</th>
                  <th width="10%" class="text-center">คะแนนเฉลี่ย</th>
                  <th width="40%" class="text-center">ผลการประเมิน<br>0.01-2.00 ระดับคุณภาพน้อย<br>2.01-3.00 ระดับคุณภาพปานกลาง<br>3.01-4.00 ระดับคุณภาพดี<br>4.01-5.00 ระดับคุณภาพดีมาก</th>
                </tr>
                @foreach($getall as $key=>$value)
                <tr>
                <td>{{$key+1}}. {{$value['name']}}</td>
                @if($key+1==1)
                <td colspan="5" class="text-center">{{$data[0]['o']}}</td>
                @else
                <td class="text-center">@if(isset($data[$key]['i'])){{$data[$key]['i']}}@else-@endif</td>
                <td class="text-center">@if(isset($data[$key]['p'])){{$data[$key]['p']}}@else-@endif</td>
                <td class="text-center">@if(isset($data[$key]['o'])){{$data[$key]['o']}}@else-@endif</td>
                <td class="text-center">@if(isset($data[$key]['avr'])){{$data[$key]['avr']}}@else-@endif</td>
                <td class="text-center">@if(isset($data[$key]['result'])){{$data[$key]['result']}}@endif</td>
                @endif
                </tr>
                @endforeach
              </tbody></table>  
</div></div>
              @endsection
