@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
<a href="/getinfostudent" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>
<h4>ข้อมูลนักศึกษา </h4>
</div>
            <div class="box-body">
            <table class="table table-bordered text-center">
                <tbody><tr>
                  <th width="10%" rowspan="2" style="background-color:#9ddfd3">ปีการศึกษาที่รับเข้า</th>
                  <th width="10%" colspan="{{$countnumber}}" style="background-color:#9ddfd3">ปีการศึกษาที่รับเข้า</th>
                  </tr>
                  <tr>
                  @for($i =$get[0]['year_add'];$i<=$get[0]['reported_year']; $i++)
                  <th width="5%" style="background-color:#9ddfd3">{{$i}}</th>
                  @endfor
                  </tr>
                  <?php $n=0 ?>
                  @for($y=$get[0]['year_add'];$y<=$get[0]['reported_year']; $y++)
                  <?php $data=$getinfo->where('year_add',$y); ?>
                 <tr>
                            <td style="background-color:#9ddfd3">{{$y}}</td>
                            @for($x =$get[0]['year_add'];$x<=$get[0]['reported_year']; $x++)
                            <?php $data2=[] ?>
                            <?php $data2=$data->where('reported_year',$x)->where('year_add',$y); ?>
                            @if($data2!='[]')
                                @foreach($data2 as $key=>$value) 
                                      @if($value['reported_year_qty']!=0)                
                                        <td>{{$value['reported_year_qty']}}</td>
                                      @else
                                        <td style="background-color:#393232"></td>
                                      @endif
                                @endforeach  
                            @else
                                
                                <td ><input type="number" class="form-control text-center" name="y{{$y}}[]" value="0"></td>
                            @endif    
                            <?php $n++ ?>                        
                            @endfor

                </tr>
                @endfor
               
              </tbody></table>
              
              
            
            จำนวนนักศึกษาที่รับเข้าตามแผน (ตาม มคอ2 ของปีที่ประเมิน) {{$getqty[0]['qty']}} คน 
            </div>
   <style>
   .b{
     background-color:black;
   }
   </style>           
              
              
              @endsection
