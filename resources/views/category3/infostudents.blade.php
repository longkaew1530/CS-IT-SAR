@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
<b>ข้อมูลนักศึกษา </b>
            <div class="box-body">
              <table class="table table-bordered text-center">
                <tbody><tr>
                  <th width="10%" rowspan="5">ปีที่รับเข้า</th>
                  <th colspan="8" width="80%">ปีการศึกษาที่สำเร็จการศึกษา</th>

                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr>
                @foreach($infostd as $key=>$row)
                @if($key==0)
                            <td>{{$row['y1']}}</td>
                            <td>{{$row['y2']}}</td>
                            <td>{{$row['y3']}}</td>
                            <td>{{$row['y4']}}</td>
                            <td>{{$row['y5']}}</td>
                            <td>{{$row['y6']}}</td>
                            <td>{{$row['y7']}}</td>
                            <td>{{$row['y8']}}</td>
                            <td>{{$row['y9']}}</td>
                            <td>{{$row['y10']}}</td>
                            <td>{{$row['y11']}}</td>
                            @endif
                @endforeach
                </tr>
                <tr>
                @foreach($infostd as $key=>$value)
                @if($key!=0)<td>{{$value['yearadd']}}</td>
                <td>@if($value['y1']!=null){{$value['y1']}}@endif</td>
                <td>@if($value['y2']!=null){{$value['y2']}}@endif</td>
                <td>@if($value['y3']!=null){{$value['y3']}}@endif</td>
                <td>@if($value['y4']!=null){{$value['y4']}}@endif</td>
                <td>@if($value['y5']!=null){{$value['y5']}}@endif</td>
                <td>@if($value['y6']!=null){{$value['y6']}}@endif</td>
                <td>@if($value['y7']!=null){{$value['y7']}}@endif</td>
                <td>@if($value['y8']!=null){{$value['y8']}}@endif</td>
                <td>@if($value['y9']!=null){{$value['y9']}}@endif</td>
                <td>@if($value['y10']!=null){{$value['y10']}}@endif</td>
                <td>@if($value['y11']!=null){{$value['y11']}}@endif</td>@endif
                </tr>
               @endforeach
              </tbody></table></div></div>
   <style>
   .b{
     background-color:black;
   }
   </style>           
              
              
              @endsection
