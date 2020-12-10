@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
            <div class="box-header">
              <h1 class="box-title"><li>คุณภาพอาจารย์ (ตัวบ่งชี้ที่ 4.2)</li></h1>
              <br><br><br>
            <ins>ข้อมูลพื้นฐานตัวบ่งชี้</ins>
            
            <br><br><b>1. ข้อมูลคุณวุฒิปริญญาเอกและตำแหน่งทางวิชาการ</b>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="50%">รายการข้อมูล</th>
                  <th width="30%">จำนวน</th>
                </tr>
                
                <tr>
                  <td>1. จำนวนอาจารย์ผู้รับผิดชอบหลักสูตรทั้งหมด</td>
                  <td>1</td>
               </tr>
               <tr>
                  <td>2. จำนวนอาจารย์ผู้รับผิดชอบหลักสูตรที่มีคุณวุฒิปริญญาเอก</td>
                  <td>1</td>
               </tr>
               <tr>
                  <td>3. จำนวนอาจารย์ผู้รับผิดชอบหลักสูตรที่เป็น ผู้ช่วยศาสตราจารย์</td>
                  <td>1</td>
               </tr>
               <tr>
                  <td>4. จำนวนอาจารย์ผู้รับผิดชอบหลักสูตรที่เป็น รองศาตราจารย์</td>
                  <td>1</td>
               </tr>
               <tr>
                  <td>5. จำนวนอาจารย์ผู้รับผิดชอบหลักสูตรที่เป็น ศาสตราจารย์</td>
                  <td>1</td>
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
                @foreach($category_re as $key =>$row )
                <tr>
                  <td>-ตัวบ่งชี้ที่{{$row['name']}}<br>
                     @foreach($row->research_results as $key =>$value )
                       <li>{{$value['teacher_name'].". (".$value['research_results_year']
                       ."). ".$value['research_results_name'].". ".
                       $value['research_results_description']}}</li>
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
                <td>รวม</td>
                <td></td>
                <td><?php echo $totalqty ?></td>
                <td><?php echo $total ?></td>
                </tr>
              </tbody></table>
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