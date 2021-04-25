@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl" id="exportContent">
<div class="box-header" >
              <h3 class="text-center">หมวดที่3 นักศึกษาและบัณฑิต</h3><br>
              <div class="box-body">
              <h4>ข้อมูลนักศึกษา</h4>
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

            <div class="box-body">
            <h4>จำนวนผู้สำเร็จการศึกษา</h4>
            <table class="table table-bordered text-center">
                <tbody><tr>
                  <th width="5%" rowspan="3" style="background-color:#9ddfd3">ปีการศึกษาที่รับเข้า</th>
                  <th width="5%" rowspan="3" style="background-color:#9ddfd3">จำนวนที่รับเข้า</th>
                  <?php $i=0 ?>
                  <?php $yearname=session()->get('year'); ?>
                  @foreach($gropby as $key=>$value)
                  <?php $zero=0 ?>
                 
                    @foreach($getinfo1 as $c)
                      @if($c['reported_year']==$value['year_add']&&$c['reported_year_qty']!=0)
                            <?php $zero=$zero+1 ?>
                      @endif
                    @endforeach
                         
                    @if($zero!=0)
                    <?php $getinfo1[$key]['check']=1; ?>
                    <?php $yearresult[$i]=$value['year_add'];?>
                    <?php $i++ ?>
                    @endif
                  @if($zero!=0)<th width="5%" colspan="2" style="background-color:#9ddfd3">{{$value['year_add']}}</th>@endif
                  @endforeach
                  </tr>
                  <tr>
                  @foreach($gropby as $key=>$value)
                  <?php $zero=0 ?>
                    @foreach($getinfo1 as $c)
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
                  <?php $n=0 ;
                        $data=[];
                  ?>
                  @for($y=$get2[0]['year_add'];$y<=$yearname; $y++)
                  <?php $data=$getinfo1->where('year_add',$y); 
                        $countdata=count($data);
                        $countdata2=intval($countdata)-1; 
                  ?>
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
                            @for($x =$get2[0]['year_add'];$x<=$yearname; $x++)
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
                
              </tbody></table></div>

              <div class="box-body">
              <h4>การคงอยู่ของนักศึกษา</h4>
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

            </div>
            <div class="box-body">
              <h4>ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา</h4>
            @foreach($factor as $row)
                {!!$row['factor']!!}
             @endforeach 
            </div>

            <div class="box-body">
            <h4>จำนวนผู้สำเร็จการศึกษา</h4>
            <table class="table table-bordered text-center">
                <tbody><tr>
                  <th width="5%" rowspan="3" style="background-color:#9ddfd3">ปีการศึกษาที่รับเข้า</th>
                  <th width="5%" rowspan="3" style="background-color:#9ddfd3">จำนวนที่รับเข้า</th>
                  <?php $i=0 ?>
                  <?php $yearname=session()->get('year'); ?>
                  @foreach($gropby as $key=>$value)
                  <?php $zero=0 ?>
                 
                    @foreach($getinfo1 as $c)
                      @if($c['reported_year']==$value['year_add']&&$c['reported_year_qty']!=0)
                            <?php $zero=$zero+1 ?>
                      @endif
                    @endforeach
                         
                    @if($zero!=0)
                    <?php $getinfo1[$key]['check']=1; ?>
                    <?php $yearresult[$i]=$value['year_add'];?>
                    <?php $i++ ?>
                    @endif
                  @if($zero!=0)<th width="5%" colspan="2" style="background-color:#9ddfd3">{{$value['year_add']}}</th>@endif
                  @endforeach
                  </tr>
                  <tr>
                  @foreach($gropby as $key=>$value)
                  <?php $zero=0 ?>
                    @foreach($getinfo1 as $c)
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
                  <?php $n=0 ;
                        $data=[];
                  ?>
                  @for($y=$get2[0]['year_add'];$y<=$yearname; $y++)
                  <?php $data=$getinfo1->where('year_add',$y); 
                        $countdata=count($data);
                        $countdata2=intval($countdata)-1; 
                  ?>
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
                            @for($x =$get2[0]['year_add'];$x<=$yearname; $x++)
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
                
              </tbody></table></div>
              <div class="box-body">
              <h4>ปัจจัยที่มีผลกระทบต่อการสำเร็จการศึกษา</h4>
            @foreach($factor2 as $row)
                {!!$row['factor']!!}
             @endforeach 
            </div>

            <div class="box-body">
            <h4>คุณภาพบัณฑิตตามกรอบมาตรฐานคุณวุฒิระดับอุดมศึกษาแห่งชาติ (ตัวบ่งชี้ที่ 2.1)</h4>
              <table class="table table-bordered mt-1">
                <tbody><tr>
                  <th width="80%" class="text-center">ข้อมูลพื้นฐาน</th>
                  <th width="10%" class="text-center">จำนวน</th>
                  @foreach($factor3 as $value)
                </tr>
                <td>1. จำนวนบัณฑิตที่สำเร็จการศึกษาในหลักสูตรนี้ทั้งหมด</td>
                <td class="text-center">{{$value['qtyall']}}</td>
                <tr>
                </tr>
                <td>2. จำนวนบัณฑิตในหลักสูตรที่ได้รับการประเมินจากผู้ใช้บัณฑิต</td>
                <td class="text-center">{{$value['qtyrate']}}</td>
                <tr>
                </tr>
                <td>3. ร้อยละของบัณฑิตที่ได้รับจากการประเมินผู้ใช้บัณฑิตต่อจำนวนบัณฑิตที่สำเร็จการศึกษาทั้งหมด</td>
                <td class="text-center">{{$value['persen']}}</td>
                <tr>
                </tr>
                <td>4. ผลรวมของค่าคะแนนที่ได้จากการประเมินบัณฑิต</td>
                <td class="text-center">{{$value['sumscore']}}</td>
                <tr>
                </tr>
                <td>5. ค่าเฉลี่ยของคะแนนประเมินบัณฑิต (คะแนนเต็ม5)</td>
                <td class="text-center">{{$value['resultscore']}}</td>
                <tr>
                </tr>
                @endforeach
              </tbody></table></div>
              <div class="box-body">
            <ins>ผลการประเมินตนเอง</ins>
            <table class="table table-bordered">
                <tbody><tr>
                  <th width="30%" class="text-center">ตัวบ่งชี้</th>
                  <th width="15%" class="text-center">เป้าหมาย</th>
                  @if($per1!=null)
                      <th colspan="2" width="15%" class="text-center">ผลการดำเนินงาน</th>
                  @else
                      <th  width="15%" class="text-center">ผลการดำเนินงาน</th>
                  @endif
                  <th width="15%" class="text-center">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @if($pdca!="[]")
                @foreach($pdca as $row)
                <tr>
                  <td rowspan="2" >ตัวบ่งชี้ที่ {{$row['Indicator_id']." ".$row['Indicator_name']}}</td>           
                  <td rowspan="2" class="text-center">{{$row['target']}}</td>
                  @if($per1!=null)
                    <td class="text-center">{{$row['performance1']}}</td>
                  @endif  
                  <td rowspan="2" class="text-center">{{$row['performance3']}}</td>
                  <td rowspan="2" class="text-center">{{$row['score']}}</td>
                </tr>
                <tr>
                @if($per1!=null)
                    <td class="text-center">{{$row['performance2']}}</td>
                  @endif  
                </tr>
                <tr>
                @endforeach
                @else
                <tr>
                  <td rowspan="2" >ตัวบ่งชี้ที่ {{$id}} {{$name}}</td>           
                  <td rowspan="2" class="text-center"></td>
                  @if($per1!=null)
                    <td class="text-center"></td>
                  @endif  
                  <td rowspan="2" class="text-center"></td>
                  <td rowspan="2" class="text-center"></td>
                </tr>
                <tr>
                @if($per1!=null)
                    <td class="text-center"></td>
                  @endif  
                </tr>
                <tr>
                @endif
              </tbody></table>
            </div>

            <div class="box-body">
            <h4><li >ร้อยละของบัณฑิตปริญญาตรีที่ได้งานทำหรือประกอบอาชีพอิสระภายใน 1 ปี (ตัวบ่งชี้ 2.2)</li></h4>
            <ins>ผลการดำเนินงาน</ins>
            <table class="table table-bordered">
                <tbody><tr>
                  <th width="50%" class="text-center">ข้อมูลพื้นฐาน</th>
                  <th width="10%" class="text-center">จำนวน</th>
                  <th width="10%" class="text-center">ร้อยละ</th>
                </tr>
                @foreach($factor4 as $value)
                <tr>
                <td>1. จำนวนบัณฑิตทั้งหมด</td>
                <td class="text-center">{{$value['total']}}</td>
                <td class="text-center">{{$value['totalpersen']}}</td>
                </tr>
               
                <tr>
                <td >2. จำนวนบัณฑิตที่ตอบแบบสำรวจ</td>
                <td class="text-center">{{$value['answer']}}</td>
                <td class="text-center">{{$value['answerpersen']}}</td>
                </tr>
                
                <tr>
                <td >3. จำนวนบัณฑิตที่ได้งานทำหลังสำเร็จการศึกษา<br>
                (ไม่นับรวมผู้ประกอบอาชีพอิสระ)<br>
                    - ตรงสาขาที่เรียน<br>
                    - ไม่ตรงสาขาที่เรียน
                </td>
                <td class="text-center">{{$value['job']}}<br><br>
                    {{$value['straight_line']}}<br>
                    {{$value['not_straight_line']}}
                </td>
                <td class="text-center">{{$value['jobpersen']}}<br><br>
                    {{$value['straight_linepersen']}}<br>
                    {{$value['not_straight_linepersen']}}
                </td>
                </tr>
                <tr>
                <td>4. จำนวนบัณฑิตที่ประกอบอาชีพอิสระ</td>
                <td class="text-center">{{$value['freelance']}}</td>
                 <td class="text-center">{{$value['freelancepersen']}}</td>
                </tr>
                
                <tr>
                <td>5. จำนวนผู้สำเร็จการศึกษาที่มีงานทำก่อนเข้าศึกษา</td>
                <td class="text-center">{{$value['before']}}</td>
                <td class="text-center">{{$value['beforepersen']}}</td>
                </tr>
                <tr>
                <td>6. จำนวนบัณฑิตที่ศึกษาต่อ</td>
                <td class="text-center">{{$value['continue_study']}}</td>
                <td class="text-center">{{$value['continue_studypersen']}}</td>
                </tr>
                <tr>
                <td>7. จำนวนบัณฑิตที่อุปสมบท</td>
                <td class="text-center">{{$value['ordain']}}</td>
                <td class="text-center">{{$value['ordainpersen']}}</td>
                </tr>
                <tr>
                <td>8. จำนวนบัณฑิตที่เกณฑ์ทหาร</td>
                <td class="text-center">{{$value['soldier']}}</td>
                <td class="text-center">{{$value['soldierpersen']}}</td>
                </tr>
                <tr>
                <td>9. จำนวนบัณฑิตที่ไม่มีงานทำ</td>
                <td class="text-center">{{$value['unemployed']}}</td>
                <td class="text-center">{{$value['unemployedpersen']}}</td>
                </tr>
                @endforeach
              </tbody></table>
              <div class="mt-3"><b>การวิเคราะผลที่ได้</b><br>
              @if($factor4!="[]"){!!$factor4[0]['result']!!}@endif</div>
              
</div>
            <div class="box-body">
            <ins>ผลการประเมินตนเอง</ins>
            <table class="table table-bordered">
                <tbody><tr>
                  <th width="30%" class="text-center">ตัวบ่งชี้</th>
                  <th width="15%" class="text-center">เป้าหมาย</th>
                  @if($per1!=null)
                      <th colspan="2" width="15%" class="text-center">ผลการดำเนินงาน</th>
                  @else
                      <th  width="15%" class="text-center">ผลการดำเนินงาน</th>
                  @endif
                  <th width="15%" class="text-center">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @if($pdca!="[]")
                @foreach($pdca2 as $row)
                <tr>
                  <td rowspan="2" >ตัวบ่งชี้ที่ {{$row['Indicator_id']." ".$row['Indicator_name']}}</td>           
                  <td rowspan="2" class="text-center">{{$row['target']}}</td>
                  @if($per1!=null)
                    <td class="text-center">{{$row['performance1']}}</td>
                  @endif  
                  <td rowspan="2" class="text-center">{{$row['performance3']}}</td>
                  <td rowspan="2" class="text-center">{{$row['score']}}</td>
                </tr>
                <tr>
                @if($per1!=null)
                    <td class="text-center">{{$row['performance2']}}</td>
                  @endif  
                </tr>
                <tr>
                @endforeach
                @else
                <tr>
                  <td rowspan="2" >ตัวบ่งชี้ที่ {{$id}} {{$name}}</td>           
                  <td rowspan="2" class="text-center"></td>
                  @if($per1!=null)
                    <td class="text-center"></td>
                  @endif  
                  <td rowspan="2" class="text-center"></td>
                  <td rowspan="2" class="text-center"></td>
                </tr>
                <tr>
                @if($per1!=null)
                    <td class="text-center"></td>
                  @endif  
                </tr>
                <tr>
                @endif
              </tbody></table>
            </div>


            <br> <div class="box-body">
              <h1 class="box-title">{{$name3_1}} (ตัวบ่งชี้ที่ {{$id3_1}})</h1>
              <br>
              <ins>เกณฑ์การประเมิน</ins>
              <ul>-มีระบบ มีกลไกล</ul>
              <ul>-มีการนำระบบกลไกสู่การปฏิบัติ/ดำเนินงาน</ul>
              <ul>-มีการประเมินกระบวนการ</ul>
              <ul>-มีการปรับปรุง/พัฒนากระบวนการจากผลการประเมิน</ul>
              <ul>-มีผลจากการปรับปรุงเห็นชัดเจนเป็นรูปธรรม</ul>
              <ul>-มีแนวทางปฏิบัติที่ดี โดยมีหลักฐานเชิงประจักษ์ยืนยัน และกรรมการผู้ตรวจประเมินสามารถให้เหตุผลอธิบายการเป็นแนวปฏิบัติที่ดีได้ชัดเจน</ul>
              
              <br><ins>ผลการดำเนินงาน</ins>
            
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="60%">ประเด็นอธิบาย</th>
                  <th width="30%">หลักฐานอ้างอิง</th>
                </tr>
                @foreach($getcategorypdca3_1 as $key=>$value)
                
                <tr>
                @foreach($value->Categorypdca as $row)
                  <td><b>{{$row['category_name']}}</b><br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspหลักสูตร{{$getcourse3_1[0]['course_name']}} สาขา{{$getcourse3_1[0]['branch']}}  มีการนำระบบกลไกในการ{{$row['category_name']}}
                  โดยใช้กระบวนการ PDCA เป็นพื้นฐานและมีผลการดำเนินงานในปีการศึกษา {{ Session::get('year')}} ดังนี้ <br><br><br>
                  @if(count($row->pdca)!=0)
                  @foreach($row->pdca as $row1)
                  @if($row1['p']!=null&&$checkedit!="")<a href="/getp/{{$row1['pdca_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>
                  @else
                  @if($checkedit!="")<a href="/addp/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  @endif
                  <ins><b>ขั้นตอนการวางแผน (P)</b></ins><br>
                  {!!$row1['p']!!}<br><br>
                  @if($row1['d']!=null&&$checkedit!="")<a href="/getd/{{$row1['pdca_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>
                  @else
                  @if($checkedit!="")<a href="/addd/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  @endif
                  <ins><b>การดำเนินงานตามแผน (D)</b></ins><br>
                  {!!$row1['d']!!}</b><br><br>
                  @if($row1['c']!=null&&$checkedit!="")<a href="/getc/{{$row1['pdca_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>
                  @else
                  @if($checkedit!="")<a href="/addc/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  @endif
                  <ins><b>การประเมินกระบวนการ (C)</b></ins><br>
                  {!!$row1['c']!!}</b><br><br>
                  @if($row1['a']!=null&&$checkedit!="")<a href="/geta/{{$row1['pdca_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>
                  @else
                  @if($checkedit!="")<a href="/adda/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  @endif
                  <ins><b>การปรับปรุง/พัฒนา/บูรณาการกระบวนการจากผลการประเมิน (A)</b></ins><br>
                  {!!$row1['a']!!}</b><br><br>
                  </td>
                  <td>
                  @foreach($row1->docpdca as $key2 =>$row2)
                   {{$row2['doc_file']}}<br>
                  @endforeach
                  </td> 
                  @endforeach
                  @else
                  @if($checkedit!="")<a href="/addp/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  <ins><b>ขั้นตอนการวางแผน (P)</b></ins><br>
                  <br><br>
                  @if($checkedit!="")<a href="/addd/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  <ins><b>การดำเนินงานตามแผน (D)</b></ins><br>
                  <br><br>
                  @if($checkedit!="")<a href="/addc/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  <ins><b>การประเมินกระบวนการ (C)</b></ins><br>
                  <br><br>
                  @if($checkedit!="")<a href="/adda/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  <ins><b>การปรับปรุง/พัฒนา/บูรณาการกระบวนการจากผลการประเมิน (A)</b></ins><br>
                  <br><br>
                  </td> 
                  <td>
                  </td>
                  @endif       
                  
                </tr>
                @endforeach
                <tr>
                @endforeach
              </tbody></table>
            </div>
            <div class="box-body">
            <ins>ผลการประเมินตนเอง</ins>
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="30%">ตัวบ่งชี้</th>
                  <th width="20%">เป้าหมาย</th>
                  <th width="20%">ผลการดำเนินงาน</th>
                  <th width="20%">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @if($inc3_1!="")
                @foreach($inc3_1 as $key =>$row )
                <tr>
                  <td>ตัวบ่งชี้ที่{{$row['Indicator_id']." ".$row['Indicator_name']}}</td>             
                  <td>{{$row['target']}}</td>
                  <td>{{$row['performance3']}}</td>
                  <td>            
                  @if($checkedit!="")<a href="/getself_assessment_results2/{{$row['Indicator_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>@endif
                  {{$row['score']}}</td>
                </tr>
                <tr>
                @endforeach
                @else
                <tr>
                  <td>ตัวบ่งชี้ที่ {{$id3_1}} {{$name3_1}} </td>             
                  <td></td>
                  <td></td>
                  <td>            
                  @if($checkedit!="")<a href="/getself_assessment_results/{{$id}}" class="btn btn-success fr ml-1"><i class='fa fa-plus'></i>เพิ่ม</a>@endif
                  </td>
                </tr>
                <tr>
                @endif
              </tbody></table>
            </div>
              </div>

              <br> <div class="box-body">
              <h1 class="box-title">{{$name3_2}} (ตัวบ่งชี้ที่ {{$id3_2}})</h1>
              <br>
              <ins>เกณฑ์การประเมิน</ins>
              <ul>-มีระบบ มีกลไกล</ul>
              <ul>-มีการนำระบบกลไกสู่การปฏิบัติ/ดำเนินงาน</ul>
              <ul>-มีการประเมินกระบวนการ</ul>
              <ul>-มีการปรับปรุง/พัฒนากระบวนการจากผลการประเมิน</ul>
              <ul>-มีผลจากการปรับปรุงเห็นชัดเจนเป็นรูปธรรม</ul>
              <ul>-มีแนวทางปฏิบัติที่ดี โดยมีหลักฐานเชิงประจักษ์ยืนยัน และกรรมการผู้ตรวจประเมินสามารถให้เหตุผลอธิบายการเป็นแนวปฏิบัติที่ดีได้ชัดเจน</ul>
              
              <br><ins>ผลการดำเนินงาน</ins>
            
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="60%">ประเด็นอธิบาย</th>
                  <th width="30%">หลักฐานอ้างอิง</th>
                </tr>
                @foreach($getcategorypdca3_2 as $key=>$value)
                
                <tr>
                @foreach($value->Categorypdca as $row)
                  <td><b>{{$row['category_name']}}</b><br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspหลักสูตร{{$getcourse3_2[0]['course_name']}} สาขา{{$getcourse3_2[0]['branch']}}  มีการนำระบบกลไกในการ{{$row['category_name']}}
                  โดยใช้กระบวนการ PDCA เป็นพื้นฐานและมีผลการดำเนินงานในปีการศึกษา {{ Session::get('year')}} ดังนี้ <br><br><br>
                  @if(count($row->pdca)!=0)
                  @foreach($row->pdca as $row1)
                  @if($row1['p']!=null&&$checkedit!="")<a href="/getp/{{$row1['pdca_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>
                  @else
                  @if($checkedit!="")<a href="/addp/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  @endif
                  <ins><b>ขั้นตอนการวางแผน (P)</b></ins><br>
                  {!!$row1['p']!!}<br><br>
                  @if($row1['d']!=null&&$checkedit!="")<a href="/getd/{{$row1['pdca_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>
                  @else
                  @if($checkedit!="")<a href="/addd/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  @endif
                  <ins><b>การดำเนินงานตามแผน (D)</b></ins><br>
                  {!!$row1['d']!!}</b><br><br>
                  @if($row1['c']!=null&&$checkedit!="")<a href="/getc/{{$row1['pdca_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>
                  @else
                  @if($checkedit!="")<a href="/addc/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  @endif
                  <ins><b>การประเมินกระบวนการ (C)</b></ins><br>
                  {!!$row1['c']!!}</b><br><br>
                  @if($row1['a']!=null&&$checkedit!="")<a href="/geta/{{$row1['pdca_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>
                  @else
                  @if($checkedit!="")<a href="/adda/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  @endif
                  <ins><b>การปรับปรุง/พัฒนา/บูรณาการกระบวนการจากผลการประเมิน (A)</b></ins><br>
                  {!!$row1['a']!!}</b><br><br>
                  </td>
                  <td>
                  @foreach($row1->docpdca as $key2 =>$row2)
                   {{$row2['doc_file']}}<br>
                  @endforeach
                  </td> 
                  @endforeach
                  @else
                  @if($checkedit!="")<a href="/addp/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  <ins><b>ขั้นตอนการวางแผน (P)</b></ins><br>
                  <br><br>
                  @if($checkedit!="")<a href="/addd/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  <ins><b>การดำเนินงานตามแผน (D)</b></ins><br>
                  <br><br>
                  @if($checkedit!="")<a href="/addc/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  <ins><b>การประเมินกระบวนการ (C)</b></ins><br>
                  <br><br>
                  @if($checkedit!="")<a href="/adda/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  <ins><b>การปรับปรุง/พัฒนา/บูรณาการกระบวนการจากผลการประเมิน (A)</b></ins><br>
                  <br><br>
                  </td> 
                  <td>
                  </td>
                  @endif       
                  
                </tr>
                @endforeach
                <tr>
                @endforeach
              </tbody></table>
            </div>
            <div class="box-body">
            <ins>ผลการประเมินตนเอง</ins>
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="30%">ตัวบ่งชี้</th>
                  <th width="20%">เป้าหมาย</th>
                  <th width="20%">ผลการดำเนินงาน</th>
                  <th width="20%">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @if($inc3_2!="")
                @foreach($inc3_2 as $key =>$row )
                <tr>
                  <td>ตัวบ่งชี้ที่{{$row['Indicator_id']." ".$row['Indicator_name']}}</td>             
                  <td>{{$row['target']}}</td>
                  <td>{{$row['performance3']}}</td>
                  <td>            
                  @if($checkedit!="")<a href="/getself_assessment_results2/{{$row['Indicator_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>@endif
                  {{$row['score']}}</td>
                </tr>
                <tr>
                @endforeach
                @else
                <tr>
                  <td>ตัวบ่งชี้ที่ {{$id3_2}} {{$name3_2}} </td>             
                  <td></td>
                  <td></td>
                  <td>            
                  @if($checkedit!="")<a href="/getself_assessment_results/{{$id}}" class="btn btn-success fr ml-1"><i class='fa fa-plus'></i>เพิ่ม</a>@endif
                  </td>
                </tr>
                <tr>
                @endif
              </tbody></table>
            </div>
              </div>

              <br><div class="box-body">
              <h4>ผลที่เกิดกับนักศึกษา (ตัวบ่งชี้ 3.3)</h4>
              <br><ins><b>เกณฑ์การประเมิน</b></ins><br><p>
              -มีการรายงานผลการดำเนินงานครบทุกเรื่องตามคำอธิบายในตัวบ่งชี้ (อัตราการคงอยู่ของนักศึกษา, อัตราการสำเร็จการศึกษา, ความพึงพอใจของนักศึกษาต่อการบริหารหลักสูตร,
              ผลการจัดการข้อร้องเรียนของนักศึกษา)<br></p>
              -มีแนวโน้มผลการดำเนินงานที่ดีขึ้นในทุกเรื่อง (อัตราการคงอยู่ของนักศึกษา, อัตราการสำเร็จการศึกษา, ความพึงพอใจของนักศึกษาต่อการบริหารหลักสูตร,
              ผลการจัดการข้อร้องเรียนของนักศึกษา)<br>
              -มีผลการดำเนินงานที่โดดเด่น เทียบเคียงกับหลักสูตรนั้นในสถาบันกลุ่มเดียวกัน โดยมีหลักฐานเชิงประจักษ์ยืนยัน และ กรรมการผู้ตรวจประเมินสามารถให้เหตุผลอธิบายว่าเป็นผลการ
              ดำเนินงานที่โดดเด่นอย่างแท้จริง
              <br><ins><b>หมายเหตุ</b></ins><br><p>
              1.  การประเมินความพึงพอใจของนักศึกษา เป็นการประเมินความพึงพอใจของนักศึกษาต่อกระบวนที่ดำเนินการให้กับนักศึกษาตามกิจกรรมในตัวบ่งชี้ 3.1 และ 3.2<br></p>
              2.  อัตราการคงอยู่ของนักศึกษา คิดจากจำนวนนักศึกษาที่เข้าในแต่ละรุ่น ลบด้วยจำนวนนักศึกษาที่ออกทุกกรณีนับถึงสิ้นปีการศึกษาที่ประเมิน ยกเว้นเสียชีวิต
                  การย้ายสถานที่ทำงานของนักศึกษาในระดับบัณฑิตศึกษา คิดเป็นร้อยละของจำนวนที่รับเข้าในแต่ละรุ่นที่มีบัณฑิตสำเร็จการศึกษาแล้ว<br>
              <p class="text-center">ตารางคำนวณอัตราการคงอยู่และการสำเร็จการศึกษาของนักศึกษา</p>
            <table class="table table-bordered text-center">
                <tbody><tr>
                  <th width="5%" rowspan="5" style="background-color:#9ddfd3">ปีการศึกษาที่รับเข้า</th>
                  <th width="5%" rowspan="5" style="background-color:#9ddfd3">จำนวนที่รับเข้า</th>
                  <?php $zero2=0 ?>
                  <?php $yearname=session()->get('year'); ?>
                  @foreach($gropby5 as $key=>$value)
                  <?php $zero1=0 ?>
                    @foreach($getinfo5 as $c)
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
                  @foreach($gropby5 as $key=>$value)
                  
                  <?php $zero=0 ?>
                 
                    @foreach($getinfo5 as $c)
                      @if($c['reported_year']==$value['year_add']&&$c['reported_year_qty']!=0)
                            <?php $zero=$zero+1 ?>
                      @endif
                    @endforeach
                    
                    @if($zero!=0)
                    <?php $getinfo5[$key]['check']=1; ?>
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
                  @for($y=$get5[0]['year_add'];$y<=$yearname; $y++)
                  <?php $qtyavgsuccess=0 ?>
                  <?php $data=$getinfo5->where('year_add',$y); ?>
                  <?php $check1=0; ?>
                  @foreach($data as $t)
                  @if($t['reported_year_qty']!=0)
                  <?php $check1=1 ?>
                  @endif
                  @endforeach
                  @if($check1==0)
                  @continue
                  @endif
                  <?php $data1=$getinfo6->where('year_add',$y)->where('reported_year_qty','!=',0)->first(); ?>
                            
                            <td style="background-color:#9ddfd3">{{$y}}</td>
                            <td>{{$data1['reported_year_qty']}}</td>
                            <?php $k=0 ?>
                            @for($x =$get5[0]['year_add'];$x<=$yearname; $x++)
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
                            <?php $getre=$re5->where('year_add',$value['year_add']); ?>
                            @if($getre!="[]")
                            @foreach($getre as $getvalue)
                            <td>{{$getvalue['qty']}}</td> 
                            
                            <?php $getyearqty=$getinfo6->where('year_add',$value['year_add'])->where('reported_year_qty','!=',0)->first();
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
                
              </tbody></table></div></div>

              <div class="box-body">
            <ins>ผลการดำเนินงาน</ins>
              <table class="table table-bordered " >
                <tbody><tr>
                  <th width="60%" class="text-center">ประเด็นอธิบาย</th>
                  <th width="15%" class="text-center">หลักฐานอ้างอิง</th>
                </tr>
                @if($in3_3!="[]")
                @foreach($in3_3 as $value)
              <tr>
                <td><b>{{$value['category_retention_rate']}}</b><br>
                {!!$value['retention_rate']!!}
                
                </td>
                <td>
                @foreach($value->doc_performance3_3 as $row)
                -{!!$row['doc_file']!!}<br>
                @endforeach
                </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td>-
                </td>
                <td>-
                </td>
              </tr>
              @endif
              </tbody></table>
              </div>
        <div class="box-body">
            <ins>ผลการประเมินตนเอง</ins>
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="30%" class="text-center">ตัวบ่งชี้</th>
                  <th width="20%" class="text-center">เป้าหมาย</th>
                  <th width="20%" class="text-center">ผลการดำเนินงาน</th>
                  <th width="20%" class="text-center">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @if($inc3_3!="[]")
                @foreach($inc3_3 as $key =>$row )
                <tr>
                  <td>ตัวบ่งชี้ที่{{$row['Indicator_id']." ".$row['Indicator_name']}}</td>             
                  <td class="text-center">{{$row['target']}}</td>
                  <td class="text-center">{{$row['performance3']}}</td>
                  <td class="text-center">{{$row['score']}}</td>
                </tr>
                <tr>
                @endforeach
                @else
                <tr>
                  <td>ตัวบ่งชี้ที่ {{$id}} {{$name}}</td>             
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                </tr>
                <tr>
                @endif
              </tbody></table>
            </div>
              
</div>
</div>
<style>
.marginl{
  padding:10px;
}
.wid10{
  width:10%;
}
.wid20{
  width:20%;
}
.wid30{
  width:30%;
}
.wid40{
  width:40%;
}
.wid50{
  width:50%;
}
.mt20{
  margin-top:50px
}
.ml-1{
  margin-left:10px
}
.ml-2{
  margin-left:20px
}
.mt-3{
  margin-top:30px;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){      
  Export2Word('exportContent','หมวดที่3 นักศึกษาและบัณฑิต');
  window.history.back();
 }); 

 function Export2Word(element, filename = ''){
    var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
    var postHtml = "</body></html>";
    var html = preHtml+document.getElementById(element).innerHTML+postHtml;

    var blob = new Blob(['\ufeff', html], {
        type: 'application/msword'
    });
    
    // Specify link url
    var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
    
    // Specify file name
    filename = filename?filename+'.doc':'document.doc';
    
    // Create download link element
    var downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob ){
        navigator.msSaveOrOpenBlob(blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = url;
        
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
    
    document.body.removeChild(downloadLink);
}
</script>
@endsection