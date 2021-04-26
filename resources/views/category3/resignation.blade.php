@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
@if($checkedit!="")<a href="/getresignation" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>@endif
<b>จำนวนที่ลาออกและคัดชื่อออกสะสมจนถึงสิ้นปีการศึกษา</b>
            @if($get!="[]")
            <div class="box-body">
            <table class="table table-bordered text-center">
                <tbody><tr>
                  <th width="5%" rowspan="5" style="background-color:#9ddfd3">ปีการศึกษาที่รับเข้า</th>
                  <th width="5%" rowspan="5" style="background-color:#9ddfd3">จำนวนที่รับเข้า</th>
                  <?php $zero2=0 ?>
                  <?php $yearname=session()->get('year'); ?>
                  @foreach($gropby as $key=>$value)
                  <?php $zero1=0 ?>
                    @foreach($getinfo as $c)
                      @if($c['reported_year']==$value['year_add']&&$c['reported_year_qty']!=0)
                            <?php $zero1=$zero1+1 ?>
                      @endif
                    @endforeach
                    @if($zero1!=0)
                    <?php $zero2=$zero2+1 ?>
                    @endif
                  @endforeach
                  <th width="5%" rowspan="4" colspan="{{$zero2}}" style="background-color:#9ddfd3">จำนวนสำเร็จการศึกษาตามหลักสูตร</th>
                  <th width="5%" rowspan="5"  style="background-color:#9ddfd3">จำนวนที่ลาออกและคัดชื่อออกสะสมจนถึงสิ้นปีการศึกษา</th>
                  <th width="5%" rowspan="5"  style="background-color:#9ddfd3">อัตราการสำเร็จการศึกษา</th>
                  <th width="5%" rowspan="5"  style="background-color:#9ddfd3">อัตราการคงอยู่</th>
                  </tr>
                  <tr></tr>
                  <tr></tr>
                  <tr></tr>
                  <tr>
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
                  @if($zero!=0)<th width="5%"  style="background-color:#9ddfd3">{{$value['year_add']}}</th>@endif
                  
                  @endforeach
                  </tr>
                  <tr>
                  </tr>
                  <tr></tr>
                  <tr>
                  <?php $n=0 ?>
                  @for($y=$get[0]['year_add'];$y<=$yearname; $y++)
                  <?php $qtyavgsuccess=0 ?>
                  <?php $data=$getinfo->where('year_add',$y); ?>
                  <?php $check1=0; ?>
                  @foreach($data as $t)
                  @if($t['reported_year_qty']!=0)
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
                            @for($x =$get[0]['year_add'];$x<=$yearname; $x++)
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
                                  <?php $qtyavgsuccess=$qtyavgsuccess+$value['reported_year_qty'] ?>
                                  @endif
                                  <?php $k++ ?>
                                @endforeach
                            @else
                                <td ></td>
                                <td><input type="text" class="form-control text-center" ></td>
                            @endif    
                            <?php $n++ ?>                        
                            @endfor
                            <?php $getre=$re->where('year_add',$value['year_add']); ?>
                            @if($getre!="[]")
                            @foreach($getre as $getvalue)
                            <td>{{$getvalue['qty']}}</td> 
                            
                            <?php $getyearqty=$getinfo2->where('year_add',$value['year_add'])->where('reported_year_qty','!=',0)->first();
                                  $resultqtysuccess=sprintf('%.2f',($qtyavgsuccess*100)/$getyearqty['reported_year_qty']);
                            ?>
                            <td>{{$resultqtysuccess}}%</td>
                            <?php $getget=sprintf('%.2f',($getyearqty['reported_year_qty']-$getvalue['qty'])*100/$getyearqty['reported_year_qty']) 
                            
                            ?>
                            <td>{{$getget}}%</td>
                            @endforeach
                            @else
                            <td></td>
                            <td></td>
                            <td></td>
                            @endif
                </tr>
                @endfor
                
              </tbody></table></div></div>@endif
   <style>
   .b{
     background-color:black;
   }
   </style>           
              
              
              @endsection
