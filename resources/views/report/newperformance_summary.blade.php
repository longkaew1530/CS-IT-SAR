@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-header">
              <h3 class="box-title">ผลการประเมินคุณภาพหลักสูตรรายตัวบ่งชี้</h3>
            </div>
            <table class="table table-bordered ">
                <tbody><tr>
                  <th rowspan="4" width="50%" class="text-center">ตัวบ่งชี้คุณภาพ</th>
                  <th rowspan="4" width="10%"class="text-center">เป้าหมาย</th>
                  <th colspan="3" width="10%"class="text-center">ประเมินตนเอง</th>   
                </tr>
                <tr>
                <th colspan="2" width="20%" class="text-center">ผลการดำเนินงาน</th>
                  <th rowspan="3" width="10%" class="text-center">คะแนนอิงเกณฑ์</th>
                </tr>
                <tr>
                <th width="10%"class="text-center">ตัวตั้ง</th>
                  <th rowspan="2" width="10%"class="text-center">ผลลัพธ์ (%, สัดส่วน)</th>
                  
                </tr>
                <tr>
                <th width="10%"class="text-center">ตัวหาร</th>
                </tr>
                <?php $resultall=0;
                      $getloop=0; ?>
           
                @foreach($indicator as $row)
                    <tr>

                      <td rowspan="2">
                      ตัวบ่งชี้ที่ {{$row['Indicator_id']." ".$row['Indicator_name']}}
                      </td>

                    <?php $check=$pdca->where('Indicator_id',$row['Indicator_id']); ?>
                    @if($check=='[]')
                    <td rowspan="2" class="text-center">0</td>
                    <td colspan="2" class="text-center">0</td>
                    <td rowspan="2" class="text-center">0.00</td>
                    </tr>
                    <tr></tr>
                    @endif
                   @foreach($pdca as $row1)
                      @if($row1['Indicator_id']==$row['Indicator_id'])
                      <?php 
                            $getvalue=0.0000001;
                            $getvalue=(float)$row1['score'];
                             $resultall=$resultall+$getvalue;
                            $getloop++;
                            $gett=gettype($getvalue);
                      ?>
                      <td class="text-center" rowspan="2">{{$row1['target']}}</td>  
                      @if($row1['performance1']!=null)<td class="text-center" >{{$row1['performance1']}}</td>
                      <td rowspan="2" class="text-center">{{$row1['performance3']}}</td>
                      @else
                      <td colspan="2" class="text-center">{{$row1['performance3']}}</td> 
                      @endif
                      <?php
                        $getpass="";
                       if($row1['Indicator_id']==1.1){
                            if($row1['score']=="ผ่านมาตรฐาน"){
                              $getpass="หลักสูตรได้มาตรฐาน";
                            }
                            else if($row1['score']=="ไม่ผ่านมาตรฐาน"){
                              $getpass="หลักสูตรไม่ได้มาตรฐาน";
                            }
                            else{
                              $getpass="";
                            }
                          }
                      else{
                        $getscore= sprintf('%.2f',$row1['score']);
                      }
                     
                      ?>
                      <td class="text-center" rowspan="2">@if($row1['Indicator_id']==1.1){{$getpass}}@else{{$getscore}}@endif</td> 
                    </tr>
                    <tr>
                      @if($row1['performance1']!=null)
                          <td class="text-center">{{$row1['performance2']}}</td>
                        @endif 
                    </tr>    
                    @endif
                  @endforeach 
                  @endforeach      
                <tr>
                <tr>
                <td class="text-center" colspan="2">ผลการประเมิน</td>
                <?php
                $getget=0;

                if($getloop!=1&&$getloop!=0&&$resultall!=0){
                  $getget=$resultall/($getloop-1); 
                  $scorecategory1 = sprintf('%.2f',$getget);
                 }
                 else{
                   $scorecategory1 =0.00;
                 }
                ?>
                <td  class="text-center" colspan="3">{{$scorecategory1}}</td>
                </tr>
              </tbody></table>  
</div></div>
              @endsection
