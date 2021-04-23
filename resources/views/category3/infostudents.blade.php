@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
@if($checkedit!="")<a href="/getinfostudent" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>@endif
<h4>ข้อมูลนักศึกษา </h4>
</div>
            <div class="box-body">
            <table class="table table-bordered text-center">
                <tbody><tr>
                  <th width="10%" rowspan="2" style="background-color:#9ddfd3">ปีการศึกษาที่รับเข้า</th>
                  <th width="10%" colspan="{{$countnumber}}" style="background-color:#9ddfd3">ปีการศึกษาที่รับเข้า</th>
                  </tr>
                  <tr>
                  <?php $yearname=session()->get('year'); ?>
                  <?php $sss=0; 
                        $getname[]=0;
                  ?>
                  @for($s=$get[0]['year_add'];$s<=$yearname; $s++)
                  <?php $checkdata=$getinfo->where('year_add',$s)->last();
                        $getcheckdata=$checkdata['reported_year_qty'];
                  ?>
                  @if($getcheckdata==0)
                  <?php $getname[$sss]=$checkdata['year_add'];
                  $sss++;
                  ?>
                  @endif
                  @endfor
                  
                  @for($i =$get[0]['year_add'];$i<=$yearname; $i++)
                  <?php $checkdata2=$getinfo->where('year_add',$i)->last();
                        $getcheckdata2=$checkdata2['reported_year_qty'];
                  ?>
                  @if($getcheckdata2!=0)<th width="5%" style="background-color:#9ddfd3">{{$i}}</th>@endif
                  @endfor
                  </tr>
                  <?php $n=0 ?>
                  @for($y=$get[0]['year_add'];$y<=$yearname; $y++)
                  
                  <?php $data=$getinfo->where('year_add',$y); ?>
                  <?php $checkdata=$getinfo->where('year_add',$y)->last();
                        $getcheckdata=$checkdata['reported_year_qty'];
                  ?>
                  @if($getcheckdata!=0)
                 <tr>
                            <td style="background-color:#9ddfd3">{{$y}}</td>
                            
                            @for($x=$get[0]['year_add'];$x<=$yearname; $x++)
                            @if($getcheckdata==0)
                            <?php $x++; ?>
                            @endif
                            <?php $data2=[] ?>
                            <?php $data2=$data->where('reported_year',$x)->where('year_add',$y); ?>
                            @if($data2!='[]')
                                @foreach($data2 as $key=>$value) 
                                      @if($value['reported_year_qty']!=0)                
                                        <td>{{$value['reported_year_qty']}}</td>
                                      @else
                                          <?php $gg=0 ?>
                                                @foreach($getname as $checkget)
                                                    @if($value['reported_year']==$checkget)
                                                          <?php $gg=1; ?>
                                                    @endif
                                                @endforeach
                                          @if($gg==1)
                                          @else
                                          <td></td>
                                          @endif
                                         
                                      @endif
                                @endforeach  
                            @else
                                <td >aaaaa</td>
                            @endif    
                            <?php $n++ ?>                        
                            @endfor
                           
                            

                </tr>
                @endif
                @endfor
               
              </tbody></table>
              
              
            
           @if($getqty!="[]") จำนวนนักศึกษาที่รับเข้าตามแผน (ตาม มคอ2 ของปีที่ประเมิน) {{$getqty[0]['qty']}} คน @endif
            </div>
   <style>
   .b{
     background-color:black;
   }
   </style>           
              
              
              @endsection
