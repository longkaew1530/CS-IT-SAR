@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
<b>จำนวนผู้สำเร็จการศึกษา</b>
            <div class="box-body">
              <table class="table table-bordered text-center">
                <tbody><tr>
                  <th width="5%" rowspan="5">ปีการศึกษาที่รับเข้า</th>
                  <th width="5%" rowspan="5">จำนวนที่รับเข้า</th>
                  <th colspan="8" width="80%">ปีการศึกษาที่สำเร็จการศึกษา</th>
                </tr>
                
                <tr>
                @foreach($gd as $row)
                @if($row['gd_year_of_admission']!=null)
                <th  width="10%" colspan="2">{{$row['gd_year_of_admission']+3}}</th>   
                @endif       
                @endforeach 
                </tr>
                <tr>
                @foreach($gd as $row)
                @if($row['gd_year_of_admission']!=null)
                <td rowspan="3" width="5%">จำนวนผู้สำเร็จการศึกษา</td>
                <td rowspan="3" width="5%">ร้อยละ</td>
                @endif 
                @endforeach
                </tr>
                <tr></tr>
                <tr></tr>
                @foreach($gd as $row)
                @if($row['gd_year_of_admission']!=null)
                <tr>
                <td>{{$row['gd_year_of_admission']}}</td>
                <td>{{$row['gd_of_ad_qty']}}</td>
                @if($row['gd_qty1']==null)
                <td class="b" ></td>
                @else
                <td>{{$row['gd_qty1']}}</td>
                @endif
                @if($row['gd_persen1']==null)
                <td class="b"></td>
                @else
                <td>{{$row['gd_persen1']}}</td>
                @endif
                
                @if($row['gd_qty2']==null)
                <td class="b" ></td>
                @else
                <td>{{$row['gd_qty2']}}</td>
                @endif
                @if($row['gd_persen2']==null)
                <td class="b"></td>
                @else
                <td>{{$row['gd_persen2']}}</td>
                @endif

                @if($row['gd_qty3']==null)
                <td class="b" ></td>
                @else
                <td>{{$row['gd_qty3']}}</td>
                @endif
                @if($row['gd_persen3']==null)
                <td class="b"></td>
                @else
                <td>{{$row['gd_persen3']}}</td>
                @endif

                @if($row['gd_qty4']==null)
                <td class="b" ></td>
                @else
                <td>{{$row['gd_qty4']}}</td>
                @endif
                @if($row['gd_persen4']==null)
                <td class="b"></td>
                @else
                <td>{{$row['gd_persen4']}}</td>
                @endif
                </tr>
                @endif 
                @endforeach
              </tbody></table></div></div>
   <style>
   .b{
     background-color:black;
   }
   </style>           
              
              
              @endsection
