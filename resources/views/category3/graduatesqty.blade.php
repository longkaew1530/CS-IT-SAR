@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
<b>จำนวนผู้สำเร็จการศึกษา</b>
            <div class="box-body">
            <table class="table table-bordered text-center">
                <tbody><tr>
                  <th width="5%" rowspan="3" style="background-color:#9ddfd3">ปีการศึกษาที่รับเข้า</th>
                  <th width="5%" rowspan="3" style="background-color:#9ddfd3">จำนวนที่รับเข้า</th>
                  @for($i =$get[0]['year_add'];$i<=$get[0]['reported_year']; $i++)
                  <?php $checkdata=$getinfo->where('year_add',$i); ?>
                  
                  <th width="5%" colspan="2" style="background-color:#9ddfd3">{{$i}}</th>
                  @endfor
                  </tr>
                  <tr>
                  @for($i =$get[0]['year_add'];$i<=$get[0]['reported_year']; $i++)
                  <th width="5%" rowspan="2" style="background-color:#9ddfd3">จำนวนผู้สำเร็จการศึกษา</th>
                  <th width="5%" rowspan="2" style="background-color:#9ddfd3">ร้อยละ</th>
                  @endfor
                  </tr>
                  <tr></tr>
                  <tr>
                  <?php $n=0 ?>
                  @for($y=$get[0]['year_add'];$y<=$get[0]['reported_year']; $y++)
                  <?php $data=$getinfo->where('year_add',$y); ?>
                  @foreach($data as $t)
                  @if($t['reported_year_qty']==0)
                  <?php $check1=0 ?>
                  @else
                  <?php $check1=1 ?>
                  @endif
                  @endforeach
                  @if($check1==0)
                  @continue
                  @endif
                  <?php $data1=$getinfo2->where('year_add',$y)->where('reported_year_qty','!=',0)->first(); ?>
                            
                            <td style="background-color:#9ddfd3">{{$y}}</td>
                            <td>{{$data1['reported_year_qty']}}</td>
                            @for($x =$get[0]['year_add'];$x<=$get[0]['reported_year']; $x++)
                            <?php $data2=[] ?>
                            <?php $data2=$data->where('reported_year',$x)->where('year_add',$y); ?>

                            @if($data2!='[]')
                                @foreach($data2 as $key=>$value)    
                                <?php $result=$value['reported_year_qty']*100/$data1['reported_year_qty']; ?> 
                                <?php  $result2 = sprintf('%.2f',$result); ?>            
                                  <td>{{$value['reported_year_qty']}}</td>
                                  <td>{{$result2}}</td>
                                @endforeach  
                            @else
                                <td ></td>
                                <td><input type="text" class="form-control text-center" ></td>
                            @endif    
                            <?php $n++ ?>                        
                            @endfor

                </tr>
                @endfor
                
              </tbody></table></div></div>
   <style>
   .b{
     background-color:black;
   }
   </style>           
              
              
              @endsection
