@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
<b>ข้อมูลนักศึกษา </b>
            <div class="box-body">
              <table class="table table-bordered text-center">
                <tbody><tr>
                  <th width="5%" rowspan="5">ปีการศึกษาที่รับเข้า</th>
                  <th colspan="8" width="80%">ปีการศึกษาที่สำเร็จการศึกษา</th>

                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr>
                @foreach($infostd as $value)
                <?php $set=1;?>
                <?php if($value['yearadd']>session()->get('year')){
                          $set=1;
                }?>
                <td>{{$value['yearadd']}}</td>
                <td>@if($value['y1']!=null&&$set!=1){{$value['y1']}}@endif</td>
                <td>@if($value['y2']!=null&&$set!=1){{$value['y2']}}@endif</td>
                <td>@if($value['y3']!=null&&$set!=1){{$value['y3']}}@endif</td>
                <td>@if($value['y4']!=null&&$set!=1){{$value['y4']}}@endif</td>
                <td>@if($value['y5']!=null&&$set!=1){{$value['y5']}}@endif</td>
                <td>@if($value['y6']!=null&&$set!=1){{$value['y6']}}@endif</td>
                <td>@if($value['y7']!=null&&$set!=1){{$value['y7']}}@endif</td>
                <td>@if($value['y8']!=null&&$set!=1){{$value['y8']}}@endif</td>
                <td>@if($value['y9']!=null&&$set!=1){{$value['y9']}}@endif</td>
                <td>@if($value['y10']!=null&&$set!=1){{$value['y10']}}@endif</td>
                <td>@if($value['y11']!=null&&$set!=1){{$value['y11']}}@endif</td>
                </tr>
               @endforeach
              </tbody></table></div></div>
   <style>
   .b{
     background-color:black;
   }
   </style>           
              
              
              @endsection
