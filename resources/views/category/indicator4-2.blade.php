@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
            <div class="box-header">
              <h1 class="box-title"><li>คุณภาพอาจารย์ (ตัวบ่งชี้ที่ 4.2)</li></h1>
              <br><br><br>
            <ins>ข้อมูลพื้นฐานตัวบ่งชี้</ins>
            
            <br><br><b>1. ข้อมูลคุณวุฒิปริญญาเอกและตำแหน่งทางวิชาการ</b>
            <div class="box-body">
              <table class="table table-bordered ">
                <tbody><tr>
                  <th width="50%" class="text-center">รายการข้อมูล</th>
                  <th width="30%" class="text-center">จำนวน</th>
                </tr>
                
                <tr>
                  <td>1. จำนวนอาจารย์ผู้รับผิดชอบหลักสูตรทั้งหมด</td>
                  <td class="text-center">{{$count}}</td>
               </tr>
               <tr>
                  <td>2. จำนวนอาจารย์ผู้รับผิดชอบหลักสูตรที่มีคุณวุฒิปริญญาเอก</td>
                  <td class="text-center">
                  {{$counteb_name}}
                  </td>
               </tr>
               <tr>
                  <td>3. จำนวนอาจารย์ผู้รับผิดชอบหลักสูตรที่เป็น ผู้ช่วยศาสตราจารย์</td>
                  <td class="text-center">{{$countposition1}}</td>
               </tr>
               <tr>
                  <td>4. จำนวนอาจารย์ผู้รับผิดชอบหลักสูตรที่เป็น รองศาตราจารย์</td>
                  <td class="text-center">{{$countposition2}}</td>
               </tr>
               <tr>
                  <td>5. จำนวนอาจารย์ผู้รับผิดชอบหลักสูตรที่เป็น ศาสตราจารย์</td>
                  <td class="text-center">{{$countposition3}}</td>
               </tr>
              </tbody></table>
            </div>
            <?php $totalqty=0;
                  $total=0;
            ?>
            <br><br><b>2. ข้อมูลผลงานทางวิชาการของอาจารย์ผู้รับผิดชอบหลักสูตร (นับผลงานตามปีการศึกษา)</b>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="50%" class="text-center">ระดับคุณภาพ</th>
                  <th width="5%">ค่าน้ำหนัก</th>
                  <th width="5%">จำนวนผลงาน</th>
                  <th width="5%">ค่าถ่วงน้ำหนัก</th>
                </tr>
                @foreach($cate as $key =>$row)
                <tr>
                  <td>-{{$row['name']}}<br>
                     @foreach($row->research_results as $key =>$value)
                     @if($value['research_results_year']==session()->get('year'))
                       <li class="ml-2">{{$value['teacher_name'].". (".$value['research_results_year']
                       ."). ".$value['research_results_name'].". ".
                       $value['research_results_description']}}</li>
                       @endif 
                      @endforeach
                  </td>           
                  <td class="text-center">
                  {{$row['score']}}
                  </td>
                  <td class="text-center">
                  <?php $i=0 ?>
                  @foreach($row->research_results as $ke =>$value1)
                        @if($value1['research_results_year']==session()->get('year'))
                       <?php $i++ ?>
                       @endif
                  @endforeach
                  <?php  $totalqty=$totalqty+$i;?>
                  @if( $i!=0)
                  <?php echo $i ?>
                  @endif
                  </td>
                  <td class="text-center">
                  @if( $i!=0)
                  <?php echo $i*$row['score'];
                        $total=$total+($i*$row['score']);
                  ?>
                  @endif
                  </td>
                @endforeach
                </tr>
                <tr>
                <td colspan="2" class="text-right">รวม</td>
                <td class="text-center"><?php echo $totalqty ?></td>
                <td class="text-center"><?php echo $total ?></td>
                </tr>
                <tr>
                <td colspan="3" class="text-right">ร้อยละของผลรวมถ่วงน้ำหนักของผลงานที่ตีพิมพ์หรือเผยแพร่ต่ออาจารย์ผู้รับผิดชอบหลักสูตรทั้งหมด</td>
                <td class="text-center">{{$E}}</td>
                </tr>
              </tbody></table>
            </div>

            <br><br><b>3. รายละเอียดข้อมูลผลงานทางวิชาการของอาจารย์ผู้รับผิดชอบหลักสูตร</b>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="20%" class="text-center">ชื่อผลงาน</th>
                  <th width="15%" class="text-center">ชื่อเจ้าของผลงาน</th>
                  <th width="30%" class="text-center">แหล่งเผยแพร่<br>(ชื่อการประชุม/ชื่อวารสาร เล่มที่/ชื่อฐานข้อมูล/<br>รูปแบบการเผยแพร่)</th>
                  <th width="10%" class="text-center">ค่าน้ำหนัก</th>
                </tr>
                @foreach($category_re as $key =>$value)
                <tr>
                  <td><li>{{$value['research_results_name']}}</li> </td>           
                  <td>{{$value['teacher_name']}}</td>
                  <td>{{$value['research_results_description']}}</td>
                  <td>{{$value['score']}}</td>
                </tr>
                @endforeach
              </tbody></table>
            </div>
            <br><br><b><ins>ผลการดำเนินงาน</ins> </b>
            <div class="box-body">
              <table class="table table-bordered" >
                <tbody><tr>
                  <th width="30%" class="text-center">ประเด็นการประเมิน</th>
                  <th width="15%" class="text-center">ร้อยละ</th>
                  <th width="20%" class="text-center">เกณฑ์คะแนน</th>
                  <th width="15%" class="text-center">คะแนนที่ได้</th>
                </tr>
                <tr>
                  <td>1. ร้อยละของอาจารย์ผู้รับผิดชอบหลักสูตรที่มีคุณวุติปริญญาเอก</td> 
                  <td class="text-center">@if($B<=20)
                      {{$B}}
                      @else
                      20
                      @endif
                  </td>  
                  <td class="text-center">ร้อยละ 20=5</td>
                  <?php  $result1 = sprintf('%.2f',$qty1); ?>  
                  <td class="text-center">{{$result1}}</td>            
                </tr>
                <tr>
                  <td>2. ร้อยละของอาจารย์ผู้รับผิดชอบหลักสูตรที่มีตำแหน่งทางวิชาการ</td> 
                  <td class="text-center">@if($C<=60)
                      {{$C}}
                      @else
                      60
                      @endif
                  </td>  
                  <td class="text-center">ร้อยละ 60=5</td>  
                  <?php  $result2 = sprintf('%.2f',$qty2); ?> 
                  <td class="text-center">{{$result2}}</td>            
                </tr>
                <tr>
                  <td>3. ผลงานทางวิชาการของอาจารย์ผู้รับผิดชอบหลักสูตร</td>   
                  <td class="text-center">@if($E<=20)
                      {{$E}}
                      @else
                      20
                      @endif
                  </td>  
                  <td class="text-center">ร้อยละ 20=5</td>  
                  <?php  $result3 = sprintf('%.2f',$qty3); ?>
                  <td class="text-center">{{$result3}}</td>          
                </tr>
                <tr>
                  <td class="text-center" colspan="3">คะแนนเฉลี่ยรวม</td>  
                  <?php  $result4 = sprintf('%.2f',$qty1+$qty2+$qty3); ?>  
                  <?php  session()->put('resultpass',$result4); ?>
                  <?php
                    $get=session()->get('resultpass');
                    $get2=session()->get('result');
                    $get3 = sprintf('%.2f',$get/$get2);
                    session()->put('resultavg',$get3); 
                    ?>
                    
                  <td class="text-center">{{$result4}}</td>          
                </tr>
              </tbody></table>
            </div>
            
            
            <ins>ผลการประเมินตนเอง</ins>
            <div class="box-body">
              <table class="table table-bordered text-center">
                <tbody><tr>
                  <th width="30%" >ตัวบ่งชี้</th>
                  <th width="20%">เป้าหมาย</th>
                  <th colspan="2" width="20%">ผลการดำเนินงาน</th>
                  <th width="20%">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @if(isset($inc[0]['target']))
                @foreach($inc as $key =>$row )
                <tr >
                  <td rowspan="2">ตัวบ่งชี้ที่ {{$row['Indicator_id']." ".$row['Indicator_name']}}</td>           
                  <td rowspan="2">{{$row['target']}}</td>
                  <td >{{$row['performance1']}}</td>
                  <td rowspan="2">{{$row['performance3']}}</td>
                  <td rowspan="2">
                  @if($checkedit!="")<a href="/getself_assessment_results2/4.2" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>@endif
                  {{$row['score']}}</td>
                </tr>
                <tr>
                <td>{{$row['performance2']}}</td>
                </tr>
                <tr>
                @endforeach
                @else
                <tr>
                  <td rowspan="2">ตัวบ่งชี้ที่ {{$id4_2}} {{$name4_2}}</td>           
                  <td rowspan="2"></td>
                  <td ></td>
                  <td rowspan="2"></td>
                  <td rowspan="2">@if($checkedit!="")<a href="/getself_assessment_results/4.2" class="btn btn-success fr ml-1"><i class='fa fa-plus'></i> เพิ่ม</a>@endif</td>
                </tr>
                <tr>
                <td></td>
                </tr>
                <tr>
                @endif
              </tbody></table>
            </div>
          </div>         
          </div> 

          

          </div>            

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
@endsection