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
                  <th width="50%">รายการข้อมูล</th>
                  <th width="30%">จำนวน</th>
                </tr>
                
                <tr>
                  <td>1. จำนวนอาจารย์ผู้รับผิดชอบหลักสูตรทั้งหมด</td>
                  <td>{{$count}}</td>
               </tr>
               <tr>
                  <td>2. จำนวนอาจารย์ผู้รับผิดชอบหลักสูตรที่มีคุณวุฒิปริญญาเอก</td>
                  <td>
                  {{$counteb_name}}
                  </td>
               </tr>
               <tr>
                  <td>3. จำนวนอาจารย์ผู้รับผิดชอบหลักสูตรที่เป็น ผู้ช่วยศาสตราจารย์</td>
                  <td>{{$countposition1}}</td>
               </tr>
               <tr>
                  <td>4. จำนวนอาจารย์ผู้รับผิดชอบหลักสูตรที่เป็น รองศาตราจารย์</td>
                  <td>{{$countposition2}}</td>
               </tr>
               <tr>
                  <td>5. จำนวนอาจารย์ผู้รับผิดชอบหลักสูตรที่เป็น ศาสตราจารย์</td>
                  <td>{{$countposition3}}</td>
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
                  <th width="50%">ระดับคุณภาพ</th>
                  <th width="10%">ค่าน้ำหนัก</th>
                  <th width="10%">จำนวนผลงาน</th>
                  <th width="10%">ค่าถ่วงน้ำหนัก</th>
                </tr>
                @foreach($cate as $key =>$row)
                <tr>
                  <td>-{{$row['name']}}<br>
                     @foreach($category_re as $key =>$value)
                     @if($value['research_results_category']==$row['id'])
                       <li>{{$value['teacher_name'].". (".$value['research_results_year']
                       ."). ".$value['research_results_name'].". ".
                       $value['research_results_description']}}</li>
                       @endif 
                      @endforeach
                  </td>           
                  <td>
                  {{$row['score']}}
                  </td>
                  <td>
                  <?php $i=0 ?>
                  @foreach($row->research_results as $ke =>$value1)
                       <?php $i++ ?>
                  @endforeach
                  <?php  $totalqty=$totalqty+$i;?>
                  @if( $i!=0)
                  <?php echo $i ?>
                  @endif
                  </td>
                  <td>
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
                <td><?php echo $totalqty ?></td>
                <td><?php echo $total ?></td>
                </tr>
                <tr>
                <td colspan="3" class="text-right">ร้อยละของผลรวมถ่วงน้ำหนักของผลงานที่ตีพิมพ์หรือเผยแพร่ต่ออาจารย์ผู้รับผิดชอบหลักสูตรทั้งหมด</td>
                <td>{{$E}}</td>
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
                  <td>{{$B}}</td>  
                  <td class="text-center">ร้อยละ 20=5</td>  
                  <td>{{$qty1}}</td>            
                </tr>
                <tr>
                  <td>2. ร้อยละของอาจารย์ผู้รับผิดชอบหลักสูตรที่มีตำแหน่งทางวิชาการ</td> 
                  <td>{{$C}}</td>  
                  <td class="text-center">ร้อยละ 60=5</td>  
                  <td>{{$qty2}}</td>            
                </tr>
                <tr>
                  <td>3. ผลงานทางวิชาการของอาจารย์ผู้รับผิดชอบหลักสูตร</td>   
                  <td>{{$E}}</td>  
                  <td class="text-center">ร้อยละ 20=5</td>  
                  <td>{{$qty3}}</td>          
                </tr>
                <tr>
                  <td class="text-center" colspan="3">คะแนนเฉลี่ยรวม</td>    
                  <td>{{$qty1+$qty2+$qty3}}</td>          
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
                @foreach($pdca as $key =>$row )
                <tr >
                  <td rowspan="2">ตัวบ่งชี้ที่ {{$row['Indicator_id']." ".$row['Indicator_name']}}</td>           
                  <td rowspan="2">{{$row['target']}}</td>
                  <td >{{$row['performance1']}}</td>
                  <td rowspan="2">{{$row['performance3']}}</td>
                  <td rowspan="2">{{$row['score']}}</td>
                </tr>
                <tr>
                <td>{{$row['performance2']}}</td>
                </tr>
                <tr>
                @endforeach
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