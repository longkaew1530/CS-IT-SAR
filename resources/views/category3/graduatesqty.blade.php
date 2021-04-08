@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
<a href="/getgraduate" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>
<b>จำนวนผู้สำเร็จการศึกษา</b>
            <div class="box-body">
            <table class="table table-bordered text-center">
                <tbody><tr>
                  <th width="5%" rowspan="3" style="background-color:#9ddfd3">ปีการศึกษาที่รับเข้า</th>
                  <th width="5%" rowspan="3" style="background-color:#9ddfd3">จำนวนที่รับเข้า</th>
                  <?php $i=0 ?>
                  @foreach($gropby as $key=>$value)
                  <?php $zero=0 ?>
                 
                    @foreach($getinfo as $c)
                      @if($c['reported_year']==$value['year_add']&&$c['reported_year_qty']!=0)
                            <?php $zero=$zero+1 ?>
                      @endif
                    @endforeach
                    
                    @if($zero!=0)
                    <?php $getinfo[$key]['check']=1; ?>
                    <?php $yearresult[$i]=$value['year_add'];?>
                    <?php $i++ ?>
                    @endif
                  @if($zero!=0)<th width="5%" colspan="2" style="background-color:#9ddfd3">{{$value['year_add']}}</th>@endif
                  @endforeach
                  </tr>
                  <tr>
                  @foreach($gropby as $key=>$value)
                  <?php $zero=0 ?>
                    @foreach($getinfo as $c)
                      @if($c['reported_year']==$value['year_add']&&$c['reported_year_qty']!=0)
                            <?php $zero=1 ?>
                      @endif
                    @endforeach
                  @if($zero!=0)<th width="5%" rowspan="2" style="background-color:#9ddfd3">จำนวนผู้สำเร็จการศึกษา</th>
                  <th width="5%" rowspan="2" style="background-color:#9ddfd3">ร้อยละ</th>@endif
                  @endforeach
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
                            <?php $k=0 ?>
                            @for($x =$get[0]['year_add'];$x<=$get[0]['reported_year']; $x++)
                            <?php $data2=[] ?>
                            <?php $data2=$data->where('reported_year',$x)->where('year_add',$y); ?>
                            @if($data2!='[]')
                                @foreach($data2 as $key2=>$value)    
                                <?php $result=$value['reported_year_qty']*100/$data1['reported_year_qty']; ?> 
                                <?php  $result2 = sprintf('%.2f',$result); ?>
                                <?php $getc=count($yearresult); ?>
                                <?php $show=0 ?>
                                @for($ii=0;$ii<$getc;$ii++)
                                @if($yearresult[$ii]==$value['reported_year'])
                                <?php $show=1 ?>
                                @endif
                                @endfor    
                                  @if($show==1)<td>{{$value['reported_year_qty']}}</td>
                                  <td>{{$result2}}</td>@endif
                                  <?php $k++ ?>
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
